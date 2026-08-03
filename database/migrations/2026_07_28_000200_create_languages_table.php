<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('code', 2)->unique();
            $table->string('native_name');
            $table->string('flag_asset')->nullable();
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        $rows = [
            ['fr', 'Francais',    true],
            ['en', 'English',     true],
            ['pl', 'Polski',      true],
            ['es', 'Espanol',     true],
            ['bg', 'Balgarski',   true],
            ['hu', 'Magyar',      true],
            ['it', 'Italiano',    true],
            ['de', 'Deutsch',     true],
            ['lt', 'Lietuviu',    true],
            ['ro', 'Romana',      true],
            ['lv', 'Latviesu',    true],
            ['nl', 'Nederlands',  true],
            ['pt', 'Portugues',   true],
            ['hr', 'Hrvatski',       false],
            ['mt', 'Malti',          false],
            ['sl', 'Slovenscina',    false],
        ];

        foreach ($rows as $i => [$code, $nativeName, $isActive]) {
            DB::table('languages')->insert([
                'code'        => $code,
                'native_name' => $nativeName,
                'flag_asset'  => $code . '.' . ($code === 'pl' ? 'svg' : 'png'),
                'is_active'   => $isActive,
                'sort_order'  => $i + 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('languages');
    }
};
