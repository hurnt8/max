<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('financing_contract_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('content');
            $table->boolean('is_default')->default(false);
            $table->string('template_type', 10)->default('html');
            $table->string('locale', 5)->nullable();
            $table->string('watermark_path')->nullable();
            $table->string('logo_left_path')->nullable();
            $table->string('logo_right_path')->nullable();
            $table->string('stamp_path')->nullable();
            $table->string('signature_admin_path')->nullable();
            $table->string('signature_agent_path')->nullable();
            $table->string('docx_template_path')->nullable();
            $table->unsignedInteger('docx_version')->default(0);
            $table->json('docx_detected_vars')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('financing_contract_templates');
    }
};
