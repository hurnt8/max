<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('financing_requests', function (Blueprint $table) {
            $table->dropColumn([
                'duration_months',
                'interest_rate',
                'monthly_payment',
                'total_cost',
                'total_with_interest',
                'amortization_schedule',
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('financing_requests', function (Blueprint $table) {
            $table->decimal('duration_months', 15, 2)->nullable();
            $table->decimal('interest_rate', 5, 2)->nullable();
            $table->decimal('monthly_payment', 15, 2)->nullable();
            $table->decimal('total_cost', 15, 2)->nullable();
            $table->decimal('total_with_interest', 15, 2)->nullable();
            $table->longText('amortization_schedule')->nullable();
        });
    }
};
