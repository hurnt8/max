<?php

namespace App\Mail;

use App\Models\FinancingRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FinancingValidatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public FinancingRequest $financing,
        public string           $mailSubject,
        public string           $htmlBody,
        public string           $pdfPath,
        public string           $amortizationPdfPath = '',
        public string           $conditionsPdfPath = '',
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
                ->as($this->financing->documentFileName('contract'))
                ->withMime('application/pdf');
        }

        if ($this->amortizationPdfPath && file_exists($this->amortizationPdfPath)) {
            $attachments[] = Attachment::fromPath($this->amortizationPdfPath)
                ->as($this->financing->documentFileName('amortization'))
                ->withMime('application/pdf');
        }

        if ($this->conditionsPdfPath && file_exists($this->conditionsPdfPath)) {
            $attachments[] = Attachment::fromPath($this->conditionsPdfPath)
                ->as($this->financing->documentFileName('conditions'))
                ->withMime('application/pdf');
        }

        return $attachments;
    }
}
