<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('code', 3)->unique();
            $table->string('name');
            $table->string('symbol', 10);
            $table->string('flag_emoji', 10)->nullable();
            $table->json('preset_amounts')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_default')->default(false);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        $rows = [
            ['EUR', 'Euro', '€', '🇪🇺', [1000, 3000, 5000, 10000, 20000, 50000, 75000, 95000], true],
            ['GBP', 'Livre sterling (GBP)', '£', '🇬🇧', [1000, 2500, 5000, 10000, 20000, 40000, 65000, 80000], false],
            ['CHF', 'Franc suisse (CHF)', 'CHF', '🇨🇭', [1000, 3000, 5000, 10000, 20000, 50000, 75000, 95000], false],
            ['NOK', 'Couronne norvégienne (NOK)', 'kr', '🇳🇴', [10000, 30000, 50000, 100000, 200000, 500000, 750000, 950000], false],
            ['SEK', 'Couronne suédoise (SEK)', 'kr', '🇸🇪', [10000, 30000, 50000, 100000, 200000, 500000, 750000, 950000], false],
            ['DKK', 'Couronne danoise (DKK)', 'kr', '🇩🇰', [7000, 20000, 35000, 75000, 150000, 375000, 550000, 700000], false],
            ['PLN', 'Złoty (PLN)', 'zł', '🇵🇱', [5000, 10000, 20000, 50000, 100000, 200000, 350000, 500000], false],
            ['CZK', 'Couronne tchèque (CZK)', 'Kč', '🇨🇿', [25000, 75000, 125000, 250000, 500000, 1000000, 1500000, 2000000], false],
            ['HUF', 'Forint (HUF)', 'Ft', '🇭🇺', [500000, 1000000, 2000000, 4000000, 8000000, 20000000, 30000000, 40000000], false],
            ['RON', 'Leu roumain (RON)', 'lei', '🇷🇴', [5000, 15000, 25000, 50000, 100000, 250000, 375000, 475000], false],
            ['BRL', 'Real brésilien (BRL)', 'R$', '🇧🇷', [6000, 18000, 30000, 60000, 120000, 300000, 450000, 570000], false],
            ['PEN', 'Sol péruvien (PEN)', 'S/', '🇵🇪', [4000, 12000, 20000, 40000, 80000, 200000, 300000, 380000], false],
        ];

        foreach ($rows as $i => [$code, $name, $symbol, $flag, $presets, $isDefault]) {
            DB::table('currencies')->insert([
                'code'           => $code,
                'name'           => $name,
                'symbol'         => $symbol,
                'flag_emoji'     => $flag,
                'preset_amounts' => json_encode($presets),
                'is_active'      => true,
                'is_default'     => $isDefault,
                'sort_order'     => $i + 1,
                'created_at'     => now(),
                'updated_at'     => now(),
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('currencies');
    }
};
