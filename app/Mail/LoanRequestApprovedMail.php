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
            'fr' => 'Votre demande N°' . $this->loan->reference . ' a été approuvée — MELLENTHIN FOUNDATION',
            'en' => 'Your application N°' . $this->loan->reference . ' has been approved — MELLENTHIN FOUNDATION',
            'es' => 'Su solicitud N°' . $this->loan->reference . ' ha sido aprobada — MELLENTHIN FOUNDATION',
            'pl' => 'Wniosek nr ' . $this->loan->reference . ' został zatwierdzony — MELLENTHIN FOUNDATION',
            'bg' => 'Вашата заявка №' . $this->loan->reference . ' беше одобрена — MELLENTHIN FOUNDATION',
            'hu' => 'Kérelme sz. ' . $this->loan->reference . ' jóváhagyásra került — MELLENTHIN FOUNDATION',
            'it' => 'La tua richiesta N°' . $this->loan->reference . ' è stata approvata — MELLENTHIN FOUNDATION',
            'de' => 'Ihr Antrag Nr. ' . $this->loan->reference . ' wurde genehmigt — MELLENTHIN FOUNDATION',
            'lt' => 'Jūsų paraiška Nr. ' . $this->loan->reference . ' buvo patvirtinta — MELLENTHIN FOUNDATION',
            'ro' => 'Cererea dumneavoastră nr. ' . $this->loan->reference . ' a fost aprobată — MELLENTHIN FOUNDATION',
            'lv' => 'Jūsu pieteikums Nr. ' . $this->loan->reference . ' ir apstiprināts — MELLENTHIN FOUNDATION',
            'nl' => 'Uw aanvraag nr. ' . $this->loan->reference . ' is goedgekeurd — MELLENTHIN FOUNDATION',
            'pt' => 'O seu pedido N.º' . $this->loan->reference . ' foi aprovado — MELLENTHIN FOUNDATION',
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
