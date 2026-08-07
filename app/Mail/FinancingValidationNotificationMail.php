<?php

namespace App\Mail;

use App\Models\FinancingRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FinancingValidationNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public FinancingRequest $financing,
        public string           $mailSubject,
        public string           $htmlBody,
        public ?string          $pdfPath = null,
        public ?string          $amortizationPdfPath = null,
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

        if ($this->pdfPath && file_exists($this->pdfPath)) {
            $attachments[] = Attachment::fromPath($this->pdfPath)
                ->as($this->financing->documentFileName('notification'))
                ->withMime('application/pdf');
        }

        if ($this->amortizationPdfPath && file_exists($this->amortizationPdfPath)) {
            $attachments[] = Attachment::fromPath($this->amortizationPdfPath)
                ->as($this->financing->documentFileName('amortization'))
                ->withMime('application/pdf');
        }

        return $attachments;
    }
}
