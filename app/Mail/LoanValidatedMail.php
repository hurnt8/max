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

    public string $mailLocale;
    public string $amortizationPdfPath;

    public function __construct(
        public LoanRequest $loan,
        public string      $pdfPath,
        string             $locale = 'fr',
        string             $amortizationPdfPath = '',
    ) {
        $this->mailLocale          = $locale;
        $this->amortizationPdfPath = $amortizationPdfPath;
    }

    public function envelope(): Envelope
    {
        $subjects = [
            'fr' => 'Validation de votre demande N°' . $this->loan->reference . ' — SOLBERG GRUPO',
            'pl' => 'Zatwierdzenie wniosku nr ' . $this->loan->reference . ' — SOLBERG GRUPO',
            'en' => 'Approval of your application N°' . $this->loan->reference . ' — SOLBERG GRUPO',
            'es' => 'Validación de su solicitud N°' . $this->loan->reference . ' — SOLBERG GRUPO',
            'bg' => 'Одобрение на вашата заявка №' . $this->loan->reference . ' — SOLBERG GRUPO',
            'hu' => 'Kérelme jóváhagyása sz. ' . $this->loan->reference . ' — SOLBERG GRUPO',
            'it' => 'Convalida della tua richiesta N°' . $this->loan->reference . ' — SOLBERG GRUPO',
            'de' => 'Genehmigung Ihres Antrags Nr. ' . $this->loan->reference . ' — SOLBERG GRUPO',
            'lt' => 'Jūsų paraiškos Nr. ' . $this->loan->reference . ' patvirtinimas — SOLBERG GRUPO',
            'ro' => 'Validarea cererii dumneavoastră nr. ' . $this->loan->reference . ' — SOLBERG GRUPO',
            'lv' => 'Jūsu pieteikuma Nr. ' . $this->loan->reference . ' apstiprinājums — SOLBERG GRUPO',
            'nl' => 'Goedkeuring van uw aanvraag nr. ' . $this->loan->reference . ' — SOLBERG GRUPO',
        ];

        return new Envelope(subject: $subjects[$this->mailLocale] ?? $subjects['fr']);
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.loan-validated',
            with: ['loan' => $this->loan, 'locale' => $this->mailLocale],
        );
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

        return $attachments;
    }
}
