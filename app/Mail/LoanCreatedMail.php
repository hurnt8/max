<?php

namespace App\Mail;

use App\Models\LoanRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LoanCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public LoanRequest $loan,
        public string      $contractPdfPath,
        public string      $amortizationPdfPath,
        public string      $locale = 'fr',
    ) {}

    public function envelope(): Envelope
    {
        $subjects = [
            'fr' => 'Votre dossier de financement N°' . $this->loan->reference . ' — SOLBERG GRUPO',
            'pl' => 'Twój wniosek o finansowanie nr ' . $this->loan->reference . ' — SOLBERG GRUPO',
            'en' => 'Your financing file N°' . $this->loan->reference . ' — SOLBERG GRUPO',
            'es' => 'Su expediente de financiación N°' . $this->loan->reference . ' — SOLBERG GRUPO',
            'bg' => 'Вашето досие за финансиране №' . $this->loan->reference . ' — SOLBERG GRUPO',
            'hu' => 'Finanszírozási ügye sz. ' . $this->loan->reference . ' — SOLBERG GRUPO',
            'it' => 'La tua pratica di finanziamento N°' . $this->loan->reference . ' — SOLBERG GRUPO',
            'de' => 'Ihre Finanzierungsakte Nr. ' . $this->loan->reference . ' — SOLBERG GRUPO',
            'lt' => 'Jūsų finansavimo byla Nr. ' . $this->loan->reference . ' — SOLBERG GRUPO',
            'ro' => 'Dosarul dumneavoastră de finanțare nr. ' . $this->loan->reference . ' — SOLBERG GRUPO',
            'lv' => 'Jūsu finansējuma lieta Nr. ' . $this->loan->reference . ' — SOLBERG GRUPO',
            'nl' => 'Uw financieringsdossier Nr. ' . $this->loan->reference . ' — SOLBERG GRUPO',
            'pt' => 'O seu processo de financiamento N.º' . $this->loan->reference . ' — SOLBERG GRUPO',
        ];

        return new Envelope(subject: $subjects[$this->locale] ?? $subjects['fr']);
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.loan-created',
            with: ['loan' => $this->loan, 'locale' => $this->locale],
        );
    }

    public function attachments(): array
    {
        $attachments = [];

        if (file_exists($this->contractPdfPath)) {
            $attachments[] = Attachment::fromPath($this->contractPdfPath)
                ->as($this->loan->documentFileName('contract'))
                ->withMime('application/pdf');
        }

        if (file_exists($this->amortizationPdfPath)) {
            $attachments[] = Attachment::fromPath($this->amortizationPdfPath)
                ->as($this->loan->documentFileName('amortization'))
                ->withMime('application/pdf');
        }

        return $attachments;
    }
}
