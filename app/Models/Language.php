<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Collection;

class Language extends Model
{
    protected $fillable = [
        'code',
        'native_name',
        'flag_asset',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active'  => 'boolean',
        'sort_order' => 'integer',
    ];

    protected static function booted(): void
    {
        static::saved(fn () => static::forgetCache());
        static::deleted(fn () => static::forgetCache());
    }

    public static function forgetCache(): void
    {
        Cache::forget('languages.active_codes');
        Cache::forget('languages.active');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public static function activeCodes(): array
    {
        return Cache::rememberForever('languages.active_codes', function () {
            return static::active()->orderBy('sort_order')->pluck('code')->all();
        });
    }

    public static function active(): Collection
    {
        return Cache::rememberForever('languages.active', function () {
            return static::active()->orderBy('sort_order')->get(['code', 'native_name', 'flag_asset']);
        });
    }

    public static function hasTranslationFiles(string $code): bool
    {
        return is_dir(lang_path($code));
    }

    /**
     * Pourcentage de clés (à plat, y compris imbriquées) présentes dans lang/{code}
     * par rapport à lang/fr — sert d'indicateur de complétude dans l'admin.
     */
    public static function completeness(string $code): int
    {
        if (!static::hasTranslationFiles($code)) {
            return 0;
        }

        $frDir = lang_path('fr');
        $files = collect(glob($frDir . '/*.php'));

        if ($files->isEmpty()) {
            return 100;
        }

        $total = 0;
        $present = 0;

        foreach ($files as $frFile) {
            $fileName = basename($frFile);
            $targetFile = lang_path($code) . '/' . $fileName;

            $frKeys = self::flattenKeys(include $frFile);
            $targetKeys = is_file($targetFile) ? self::flattenKeys(include $targetFile) : [];

            $total += count($frKeys);
            $present += count(array_intersect($frKeys, $targetKeys));
        }

        return $total > 0 ? (int) round($present / $total * 100) : 100;
    }

    private static function flattenKeys(array $arr, string $prefix = ''): array
    {
        $keys = [];
        foreach ($arr as $k => $v) {
            $key = $prefix === '' ? $k : "$prefix.$k";
            if (is_array($v)) {
                $keys = array_merge($keys, self::flattenKeys($v, $key));
            } else {
                $keys[] = $key;
            }
        }
        return $keys;
    }
}
