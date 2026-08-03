<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Currency extends Model
{
    protected $fillable = [
        'code',
        'name',
        'symbol',
        'flag_emoji',
        'preset_amounts',
        'is_active',
        'is_default',
        'sort_order',
    ];

    protected $casts = [
        'preset_amounts' => 'array',
        'is_active'      => 'boolean',
        'is_default'     => 'boolean',
        'sort_order'     => 'integer',
    ];

    protected static function booted(): void
    {
        static::saved(fn () => static::forgetCache());
        static::deleted(fn () => static::forgetCache());
    }

    public static function forgetCache(): void
    {
        Cache::forget('currencies.codes');
        Cache::forget('currencies.default_code');
        Cache::forget('currencies.symbols');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public static function codes(): array
    {
        return Cache::rememberForever('currencies.codes', function () {
            return static::active()->orderBy('sort_order')->pluck('code')->all();
        });
    }

    public static function defaultCode(): string
    {
        return Cache::rememberForever('currencies.default_code', function () {
            return static::where('is_default', true)->value('code')
                ?? static::active()->orderBy('sort_order')->value('code')
                ?? 'EUR';
        });
    }

    public static function symbols(): array
    {
        return Cache::rememberForever('currencies.symbols', function () {
            return static::active()->pluck('symbol', 'code')->all();
        });
    }
}
