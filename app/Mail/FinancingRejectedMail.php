<?php

namespace App\Mail;

use App\Models\FinancingRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FinancingRejectedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public FinancingRequest $financing,
        public string           $reason,
    ) {}

    public function envelope(): Envelope
    {
        $locale = $this->financing->contract_language ?? 'fr';
        $ref    = $this->financing->reference;

        $subjects = [
            'fr' => "Dossier {$ref} — Demande refusée",
            'en' => "File {$ref} — Request declined",
            'pl' => "Wniosek {$ref} — Wniosek odrzucony",
            'es' => "Expediente {$ref} — Solicitud rechazada",
            'bg' => "Досие {$ref} — Заявката е отхвърлена",
            'hu' => "Ügy {$ref} — Kérelem elutasítva",
            'it' => "Pratica {$ref} — Richiesta respinta",
            'de' => "Akte {$ref} — Antrag abgelehnt",
            'lt' => "Byla {$ref} — Paraiška atmesta",
            'ro' => "Dosar {$ref} — Cerere respinsă",
            'lv' => "Lieta {$ref} — Pieteikums noraidīts",
            'nl' => "Dossier {$ref} — Aanvraag afgewezen",
            'pt' => "Processo {$ref} — Pedido recusado",
            'sk' => "Spis {$ref} — Žiadosť zamietnutá",
            'el' => "Φάκελος {$ref} — Η αίτηση απορρίφθηκε",
        ];

        return new Envelope(subject: $subjects[$locale] ?? $subjects['fr']);
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.financing-rejected',
            with: [
                'financing' => $this->financing,
                'locale'    => $this->financing->contract_language ?? 'fr',
                'reason'    => $this->reason,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
