<?php

namespace App\Mail;

use App\Models\LoanRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LoanValidatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public LoanRequest $loan,
        public string      $mailSubject,
        public string      $htmlBody,
        public string      $pdfPath,
        public string      $amortizationPdfPath = '',
        public string      $conditionsPdfPath = '',
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: $this->mailSubject);
    }

    public function content(): Content
    {
        return new Content(htmlString: $this->htmlBody);
    }

    public function attachments(): array
    {
        $attachments = [];

        if (file_exists($this->pdfPath)) {
            $attachments[] = Attachment::fromPath($this->pdfPath)
                ->as('Contrat_' . $this->loan->reference . '.pdf')
                ->withMime('application/pdf');
        }

        if ($this->amortizationPdfPath && file_exists($this->amortizationPdfPath)) {
            $attachments[] = Attachment::fromPath($this->amortizationPdfPath)
                ->as('Tableau_Amortissement_' . $this->loan->reference . '.pdf')
                ->withMime('application/pdf');
        }

        if ($this->conditionsPdfPath && file_exists($this->conditionsPdfPath)) {
            $attachments[] = Attachment::fromPath($this->conditionsPdfPath)
                ->as('Conditions_Generales_' . $this->loan->reference . '.pdf')
                ->withMime('application/pdf');
        }

        return $attachments;
    }
}
