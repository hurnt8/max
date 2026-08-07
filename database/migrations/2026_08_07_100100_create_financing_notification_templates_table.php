<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('financing_notification_templates', function (Blueprint $table) {
            $table->id();
            $table->string('locale');
            $table->string('type')->default('validation');
            $table->string('name');
            $table->string('subject')->nullable();
            $table->longText('content')->nullable();
            $table->string('docx_template_path')->nullable();
            $table->unsignedInteger('docx_version')->default(0);
            $table->json('docx_detected_vars')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->unique(['locale', 'type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('financing_notification_templates');
    }
};
