<?php

namespace App\Mail;

use App\Models\LoanRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SignedContractAcknowledgementMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $mailLocale;

    public function __construct(
        public LoanRequest $loan,
        string             $locale = 'fr',
    ) {
        $this->mailLocale = $locale;
    }

    public function envelope(): Envelope
    {
        $subjects = [
            'fr' => 'Réception de votre contrat signé N°' . $this->loan->reference . ' — SOLBERG GRUPO',
            'pl' => 'Potwierdzenie otrzymania podpisanej umowy nr ' . $this->loan->reference,
            'en' => 'Receipt of your signed contract N°' . $this->loan->reference . ' — SOLBERG GRUPO',
            'es' => 'Recepción de su contrato firmado N°' . $this->loan->reference . ' — SOLBERG GRUPO',
            'bg' => 'Получаване на вашия подписан договор №' . $this->loan->reference . ' — SOLBERG GRUPO',
            'hu' => 'Aláírt szerződésének beérkezése sz. ' . $this->loan->reference . ' — SOLBERG GRUPO',
            'it' => 'Ricezione del tuo contratto firmato N°' . $this->loan->reference . ' — SOLBERG GRUPO',
            'de' => 'Eingang Ihres unterschriebenen Vertrags Nr. ' . $this->loan->reference . ' — SOLBERG GRUPO',
            'lt' => 'Jūsų pasirašytos sutarties Nr. ' . $this->loan->reference . ' gavimas — SOLBERG GRUPO',
            'ro' => 'Primirea contractului dumneavoastră semnat nr. ' . $this->loan->reference . ' — SOLBERG GRUPO',
            'lv' => 'Jūsu parakstītā līguma Nr. ' . $this->loan->reference . ' saņemšana — SOLBERG GRUPO',
            'nl' => 'Ontvangst van uw ondertekend contract nr. ' . $this->loan->reference . ' — SOLBERG GRUPO',
            'pt' => 'Receção do seu contrato assinado N.º' . $this->loan->reference . ' — SOLBERG GRUPO',
        ];

        return new Envelope(subject: $subjects[$this->mailLocale] ?? $subjects['fr']);
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.signed-contract-acknowledgement',
            with: ['loan' => $this->loan, 'locale' => $this->mailLocale],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
