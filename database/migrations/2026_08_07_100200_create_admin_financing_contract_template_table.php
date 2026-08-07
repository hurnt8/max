<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admin_financing_template', function (Blueprint $table) {
            $table->foreignId('admin_id')
                  ->constrained('users')
                  ->cascadeOnDelete();
            $table->foreignId('financing_template_id')
                  ->constrained('financing_contract_templates')
                  ->cascadeOnDelete();
            $table->primary(['admin_id', 'financing_template_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admin_financing_template');
    }
};
