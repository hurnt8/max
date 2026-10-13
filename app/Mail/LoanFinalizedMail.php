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
                'fr' => "Dossier {$ref} finalisé — Fonds crédités — MELLENTHIN FOUNDATION",
                'en' => "File {$ref} finalized — Funds credited — MELLENTHIN FOUNDATION",
                'es' => "Expediente {$ref} finalizado — Fondos abonados — MELLENTHIN FOUNDATION",
                'pl' => "Wniosek {$ref} sfinalizowany — Środki zaksięgowane — MELLENTHIN FOUNDATION",
                'bg' => "Досие {$ref} финализирано — Средствата са преведени — MELLENTHIN FOUNDATION",
                'hu' => "A(z) {$ref} ügy véglegesítve — Összeg jóváírva — MELLENTHIN FOUNDATION",
                'it' => "Pratica {$ref} finalizzata — Fondi accreditati — MELLENTHIN FOUNDATION",
                'de' => "Akte {$ref} abgeschlossen — Betrag gutgeschrieben — MELLENTHIN FOUNDATION",
                'lt' => "Byla {$ref} užbaigta — Lėšos pervestos — MELLENTHIN FOUNDATION",
                'ro' => "Dosarul {$ref} finalizat — Fonduri creditate — MELLENTHIN FOUNDATION",
                'lv' => "Lieta {$ref} pabeigta — Līdzekļi ieskaitīti — MELLENTHIN FOUNDATION",
                'nl' => "Dossier {$ref} afgerond — Bedrag gestort — MELLENTHIN FOUNDATION",
                'pt' => "Processo {$ref} finalizado — Fundos creditados — MELLENTHIN FOUNDATION",
            ],
            'not_credited' => [
                'fr' => "Dossier {$ref} finalisé — MELLENTHIN FOUNDATION",
                'en' => "File {$ref} finalized — MELLENTHIN FOUNDATION",
                'es' => "Expediente {$ref} finalizado — MELLENTHIN FOUNDATION",
                'pl' => "Wniosek {$ref} sfinalizowany — MELLENTHIN FOUNDATION",
                'bg' => "Досие {$ref} финализирано — MELLENTHIN FOUNDATION",
                'hu' => "A(z) {$ref} ügy véglegesítve — MELLENTHIN FOUNDATION",
                'it' => "Pratica {$ref} finalizzata — MELLENTHIN FOUNDATION",
                'de' => "Akte {$ref} abgeschlossen — MELLENTHIN FOUNDATION",
                'lt' => "Byla {$ref} užbaigta — MELLENTHIN FOUNDATION",
                'ro' => "Dosarul {$ref} finalizat — MELLENTHIN FOUNDATION",
                'lv' => "Lieta {$ref} pabeigta — MELLENTHIN FOUNDATION",
                'nl' => "Dossier {$ref} afgerond — MELLENTHIN FOUNDATION",
                'pt' => "Processo {$ref} finalizado — MELLENTHIN FOUNDATION",
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
