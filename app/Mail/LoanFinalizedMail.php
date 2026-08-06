<?php

namespace App\Mail;

use App\Models\LoanRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LoanFinalizedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public LoanRequest $loan,
        public string      $repaymentStartDate,
        public bool         $wasCredited,
        public float        $creditedAmount,
    ) {}

    public function envelope(): Envelope
    {
        $locale = $this->loan->contract_language ?? 'fr';
        $ref    = $this->loan->reference;

        $subjects = [
            'fr' => "Dossier {$ref} — Financement débloqué",
            'en' => "File {$ref} — Funds released",
            'pl' => "Wniosek {$ref} — Środki uwolnione",
            'es' => "Expediente {$ref} — Fondos liberados",
            'bg' => "Досие {$ref} — Средствата са отпуснати",
            'hu' => "Ügy {$ref} — Finanszírozás folyósítva",
            'it' => "Pratica {$ref} — Fondi erogati",
            'de' => "Akte {$ref} — Mittel freigegeben",
            'lt' => "Byla {$ref} — Lėšos išmokėtos",
            'ro' => "Dosar {$ref} — Fonduri deblocate",
            'lv' => "Lieta {$ref} — Līdzekļi izmaksāti",
            'nl' => "Dossier {$ref} — Financiering vrijgegeven",
            'pt' => "Processo {$ref} — Fundos liberados",
        ];

        return new Envelope(subject: $subjects[$locale] ?? $subjects['fr']);
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.loan-finalized',
            with: [
                'loan'               => $this->loan,
                'locale'             => $this->loan->contract_language ?? 'fr',
                'repaymentStartDate' => $this->repaymentStartDate,
                'wasCredited'        => $this->wasCredited,
                'creditedAmount'     => $this->creditedAmount,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
