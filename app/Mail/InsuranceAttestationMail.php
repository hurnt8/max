<?php

namespace App\Mail;

use App\Models\LoanRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InsuranceAttestationMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $mailLocale;

    public function __construct(
        public LoanRequest $loan,
        public string      $pdfPath,
        string             $locale = 'fr',
    ) {
        $this->mailLocale = $locale;
    }

    public function envelope(): Envelope
    {
        $subjects = [
            'fr' => 'Votre attestation d\'assurance emprunteur — N°' . $this->loan->reference . ' — SOLBERG GRUPO',
            'en' => 'Your borrower insurance certificate — N°' . $this->loan->reference . ' — SOLBERG GRUPO',
            'pl' => 'Zaświadczenie ubezpieczenia kredytobiorcy — nr ' . $this->loan->reference . ' — SOLBERG GRUPO',
            'es' => 'Su certificado de seguro de prestatario — N°' . $this->loan->reference . ' — SOLBERG GRUPO',
            'bg' => 'Вашето удостоверение за застраховка на кредитополучателя — №' . $this->loan->reference . ' — SOLBERG GRUPO',
            'hu' => 'Adósvédelmi biztosítási igazolása — sz. ' . $this->loan->reference . ' — SOLBERG GRUPO',
            'it' => 'Il tuo attestato di assicurazione del mutuatario — N°' . $this->loan->reference . ' — SOLBERG GRUPO',
            'de' => 'Ihre Restschuldversicherungsbescheinigung — Nr. ' . $this->loan->reference . ' — SOLBERG GRUPO',
            'lt' => 'Jūsų skolininko draudimo pažymėjimas — Nr. ' . $this->loan->reference . ' — SOLBERG GRUPO',
            'ro' => 'Certificatul dumneavoastră de asigurare a împrumutatului — nr. ' . $this->loan->reference . ' — SOLBERG GRUPO',
            'lv' => 'Jūsu aizņēmēja apdrošināšanas apliecība — Nr. ' . $this->loan->reference . ' — SOLBERG GRUPO',
        ];

        return new Envelope(
            subject: $subjects[$this->mailLocale] ?? $subjects['fr'],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.insurance-attestation',
            with: [
                'loan'   => $this->loan,
                'locale' => $this->mailLocale,
            ],
        );
    }

    public function attachments(): array
    {
        if (!file_exists($this->pdfPath)) {
            return [];
        }

        return [
            Attachment::fromPath($this->pdfPath)
                ->as('Assurance_' . $this->loan->reference . '.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
