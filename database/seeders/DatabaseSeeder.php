<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(ExceptionalPermissionsSeeder::class);
        $this->call(ContractTemplateSeeder::class);
        $this->call(CurrencySeeder::class);
    }
}
