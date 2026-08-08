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

    public string $mailLocale;

    public function __construct(
        public LoanRequest $loan,
        public bool         $credited,
        string              $locale = 'fr',
    ) {
        $this->mailLocale = $locale;
    }

    public function envelope(): Envelope
    {
        $ref = $this->loan->reference;

        $subjects = [
            'credited' => [
                'fr' => "Dossier {$ref} finalisé — Fonds crédités — SOLBERG GRUPO",
                'en' => "File {$ref} finalized — Funds credited — SOLBERG GRUPO",
                'es' => "Expediente {$ref} finalizado — Fondos abonados — SOLBERG GRUPO",
                'pl' => "Wniosek {$ref} sfinalizowany — Środki zaksięgowane — SOLBERG GRUPO",
                'bg' => "Досие {$ref} финализирано — Средствата са преведени — SOLBERG GRUPO",
                'hu' => "A(z) {$ref} ügy véglegesítve — Összeg jóváírva — SOLBERG GRUPO",
                'it' => "Pratica {$ref} finalizzata — Fondi accreditati — SOLBERG GRUPO",
                'de' => "Akte {$ref} abgeschlossen — Betrag gutgeschrieben — SOLBERG GRUPO",
                'lt' => "Byla {$ref} užbaigta — Lėšos pervestos — SOLBERG GRUPO",
                'ro' => "Dosarul {$ref} finalizat — Fonduri creditate — SOLBERG GRUPO",
                'lv' => "Lieta {$ref} pabeigta — Līdzekļi ieskaitīti — SOLBERG GRUPO",
                'nl' => "Dossier {$ref} afgerond — Bedrag gestort — SOLBERG GRUPO",
                'pt' => "Processo {$ref} finalizado — Fundos creditados — SOLBERG GRUPO",
            ],
            'not_credited' => [
                'fr' => "Dossier {$ref} finalisé — SOLBERG GRUPO",
                'en' => "File {$ref} finalized — SOLBERG GRUPO",
                'es' => "Expediente {$ref} finalizado — SOLBERG GRUPO",
                'pl' => "Wniosek {$ref} sfinalizowany — SOLBERG GRUPO",
                'bg' => "Досие {$ref} финализирано — SOLBERG GRUPO",
                'hu' => "A(z) {$ref} ügy véglegesítve — SOLBERG GRUPO",
                'it' => "Pratica {$ref} finalizzata — SOLBERG GRUPO",
                'de' => "Akte {$ref} abgeschlossen — SOLBERG GRUPO",
                'lt' => "Byla {$ref} užbaigta — SOLBERG GRUPO",
                'ro' => "Dosarul {$ref} finalizat — SOLBERG GRUPO",
                'lv' => "Lieta {$ref} pabeigta — SOLBERG GRUPO",
                'nl' => "Dossier {$ref} afgerond — SOLBERG GRUPO",
                'pt' => "Processo {$ref} finalizado — SOLBERG GRUPO",
            ],
        ];

        $key = $this->credited ? 'credited' : 'not_credited';

        return new Envelope(subject: $subjects[$key][$this->mailLocale] ?? $subjects[$key]['fr']);
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.loan-finalized',
            with: [
                'loan'     => $this->loan,
                'credited' => $this->credited,
                'locale'   => $this->mailLocale,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
