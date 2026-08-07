<?php

namespace App\Mail;

use App\Models\FinancingRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FinancingSignedAcknowledgementMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $mailLocale;

    public function __construct(
        public FinancingRequest $financing,
        string                  $locale = 'fr',
    ) {
        $this->mailLocale = $locale;
    }

    public function envelope(): Envelope
    {
        $subjects = [
            'fr' => 'Réception de votre contrat signé N°' . $this->financing->reference . ' : AURELIS CAPITAL GROUP',
            'pl' => 'Potwierdzenie otrzymania podpisanej umowy nr ' . $this->financing->reference . ' : AURELIS CAPITAL GROUP',
            'en' => 'Receipt of your signed contract N°' . $this->financing->reference . ' : AURELIS CAPITAL GROUP',
            'es' => 'Recepción de su contrato firmado N°' . $this->financing->reference . ' : AURELIS CAPITAL GROUP',
            'bg' => 'Получаване на вашия подписан договор №' . $this->financing->reference . ' : AURELIS CAPITAL GROUP',
            'hu' => 'Aláírt szerződésének beérkezése sz. ' . $this->financing->reference . ' : AURELIS CAPITAL GROUP',
            'it' => 'Ricezione del tuo contratto firmato N°' . $this->financing->reference . ' : AURELIS CAPITAL GROUP',
            'de' => 'Eingang Ihres unterschriebenen Vertrags Nr. ' . $this->financing->reference . ' : AURELIS CAPITAL GROUP',
            'lt' => 'Jūsų pasirašytos sutarties Nr. ' . $this->financing->reference . ' gavimas : AURELIS CAPITAL GROUP',
            'ro' => 'Primirea contractului dumneavoastră semnat nr. ' . $this->financing->reference . ' : AURELIS CAPITAL GROUP',
            'lv' => 'Jūsu parakstītā līguma Nr. ' . $this->financing->reference . ' saņemšana : AURELIS CAPITAL GROUP',
            'nl' => 'Ontvangst van uw ondertekend contract nr. ' . $this->financing->reference . ' : AURELIS CAPITAL GROUP',
            'pt' => 'Receção do seu contrato assinado N.º' . $this->financing->reference . ' : AURELIS CAPITAL GROUP',
        ];

        return new Envelope(subject: $subjects[$this->mailLocale] ?? $subjects['fr']);
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.financing-signed-acknowledgement',
            with: ['financing' => $this->financing, 'locale' => $this->mailLocale],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
