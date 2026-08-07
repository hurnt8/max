<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('financing_requests', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();

            // Références
            $table->string('reference')->unique()->nullable();
            $table->string('archive_ref')->nullable();

            // Liaisons
            $table->foreignId('admin_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('client_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('contract_template_id')->nullable()
                  ->constrained('financing_contract_templates')->nullOnDelete();
            $table->foreignId('insurance_template_id')->nullable()
                  ->constrained('financing_contract_templates')->nullOnDelete();

            // Contact
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('address');

            // Financier
            $table->decimal('amount', 15, 2);
            $table->decimal('interest_rate', 5, 2)->default(5.00);
            $table->string('currency', 10)->default('EUR');
            $table->decimal('duration_months', 15, 2);
            $table->date('start_date')->nullable();
            $table->decimal('monthly_payment', 15, 2)->nullable();
            $table->decimal('total_cost', 15, 2)->nullable();
            $table->decimal('total_with_interest', 15, 2)->nullable();
            $table->decimal('admin_fees', 15, 2)->nullable();
            $table->decimal('frais_assurance', 12, 2)->nullable();
            $table->date('date_fin_assurance')->nullable();
            $table->text('bank_account')->nullable();
            $table->string('agent_suivi')->nullable();
            $table->string('directeur')->nullable();
            $table->string('notaire')->nullable();

            // Objet / conditions
            $table->string('objet')->nullable();
            $table->string('financing_type')->nullable();
            $table->text('subject')->nullable();
            $table->text('npi')->nullable();
            $table->longText('extra_fields')->nullable();
            $table->text('special_conditions')->nullable();

            // Contrat & documents
            $table->longText('contract_content')->nullable();
            $table->string('contract_pdf_path')->nullable();
            $table->string('notification_pdf_path')->nullable();
            $table->string('conditions_pdf_path')->nullable();
            $table->string('insurance_pdf_path')->nullable();
            $table->string('contract_language', 5)->default('fr');
            $table->longText('amortization_schedule')->nullable();

            // Suivi & statut
            $table->string('status')->default('draft');
            $table->text('notes')->nullable();
            $table->json('files')->nullable();
            $table->timestamp('validated_at')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->timestamp('signed_received_at')->nullable();
            $table->timestamp('finalized_at')->nullable();
            $table->timestamp('rejected_at')->nullable();
            $table->text('rejection_reason')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('financing_requests');
    }
};
