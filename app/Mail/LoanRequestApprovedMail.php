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
            'fr' => 'Votre demande N°' . $this->loan->reference . ' a été approuvée : AURELIS CAPITAL GROUP',
            'en' => 'Your application N°' . $this->loan->reference . ' has been approved : AURELIS CAPITAL GROUP',
            'es' => 'Su solicitud N°' . $this->loan->reference . ' ha sido aprobada : AURELIS CAPITAL GROUP',
            'pl' => 'Wniosek nr ' . $this->loan->reference . ' został zatwierdzony : AURELIS CAPITAL GROUP',
            'bg' => 'Вашата заявка №' . $this->loan->reference . ' беше одобрена : AURELIS CAPITAL GROUP',
            'hu' => 'Kérelme sz. ' . $this->loan->reference . ' jóváhagyásra került : AURELIS CAPITAL GROUP',
            'it' => 'La tua richiesta N°' . $this->loan->reference . ' è stata approvata : AURELIS CAPITAL GROUP',
            'de' => 'Ihr Antrag Nr. ' . $this->loan->reference . ' wurde genehmigt : AURELIS CAPITAL GROUP',
            'lt' => 'Jūsų paraiška Nr. ' . $this->loan->reference . ' buvo patvirtinta : AURELIS CAPITAL GROUP',
            'ro' => 'Cererea dumneavoastră nr. ' . $this->loan->reference . ' a fost aprobată : AURELIS CAPITAL GROUP',
            'lv' => 'Jūsu pieteikums Nr. ' . $this->loan->reference . ' ir apstiprināts : AURELIS CAPITAL GROUP',
            'nl' => 'Uw aanvraag nr. ' . $this->loan->reference . ' is goedgekeurd : AURELIS CAPITAL GROUP',
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
