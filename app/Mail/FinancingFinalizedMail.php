<?php

namespace App\Mail;

use App\Models\FinancingRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FinancingFinalizedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public FinancingRequest $financing,
        public string           $repaymentStartDate,
        public bool              $wasCredited,
        public float             $creditedAmount,
    ) {}

    public function envelope(): Envelope
    {
        $locale = $this->financing->contract_language ?? 'fr';
        $ref    = $this->financing->reference;

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
            view: 'emails.financing-finalized',
            with: [
                'financing'          => $this->financing,
                'locale'             => $this->financing->contract_language ?? 'fr',
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
