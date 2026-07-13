<?php

namespace App\Mail;

use App\Models\LoanRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LoanRequestApprovedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public LoanRequest $loan,
        public string      $mailLocale = 'fr',
    ) {}

    public function envelope(): Envelope
    {
        $subjects = [
            'fr' => 'Votre demande N°' . $this->loan->reference . ' a été approuvée — SOLBERG GRUPO',
            'en' => 'Your application N°' . $this->loan->reference . ' has been approved — SOLBERG GRUPO',
            'es' => 'Su solicitud N°' . $this->loan->reference . ' ha sido aprobada — SOLBERG GRUPO',
            'pl' => 'Wniosek nr ' . $this->loan->reference . ' został zatwierdzony — SOLBERG GRUPO',
            'bg' => 'Вашата заявка №' . $this->loan->reference . ' беше одобрена — SOLBERG GRUPO',
            'hu' => 'Kérelme sz. ' . $this->loan->reference . ' jóváhagyásra került — SOLBERG GRUPO',
            'it' => 'La tua richiesta N°' . $this->loan->reference . ' è stata approvata — SOLBERG GRUPO',
            'de' => 'Ihr Antrag Nr. ' . $this->loan->reference . ' wurde genehmigt — SOLBERG GRUPO',
            'lt' => 'Jūsų paraiška Nr. ' . $this->loan->reference . ' buvo patvirtinta — SOLBERG GRUPO',
            'ro' => 'Cererea dumneavoastră nr. ' . $this->loan->reference . ' a fost aprobată — SOLBERG GRUPO',
            'lv' => 'Jūsu pieteikums Nr. ' . $this->loan->reference . ' ir apstiprināts — SOLBERG GRUPO',
            'nl' => 'Uw aanvraag nr. ' . $this->loan->reference . ' is goedgekeurd — SOLBERG GRUPO',
        ];

        return new Envelope(subject: $subjects[$this->mailLocale] ?? $subjects['fr']);
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.loan-approved',
            with: ['loan' => $this->loan, 'locale' => $this->mailLocale],
        );
    }
}
