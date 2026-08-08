<?php

namespace App\Mail;

use App\Models\SupportMessage;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminSupportMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $locale;

    public function __construct(
        public User $client,
        public SupportMessage $message,
        ?string $locale = null,
    ) {
        $this->locale = $locale ?? 'fr';
    }

    public function envelope(): Envelope
    {
        $subjects = [
            'fr' => 'Nouveau message de ' . $this->client->name . ' — Support Solberg Grupo',
            'en' => 'New message from ' . $this->client->name . ' — Solberg Grupo Support',
            'es' => 'Nuevo mensaje de ' . $this->client->name . ' — Soporte Solberg Grupo',
            'pl' => 'Nowa wiadomość od ' . $this->client->name . ' — Wsparcie Solberg Grupo',
            'bg' => 'Ново съобщение от ' . $this->client->name . ' — Поддръжка Solberg Grupo',
            'hu' => 'Új üzenet — ' . $this->client->name . ' — Solberg Grupo ügyfélszolgálat',
            'it' => 'Nuovo messaggio da ' . $this->client->name . ' — Assistenza Solberg Grupo',
            'de' => 'Neue Nachricht von ' . $this->client->name . ' — Solberg Grupo Support',
            'lt' => 'Naujas pranešimas nuo ' . $this->client->name . ' — Solberg Grupo pagalba',
            'ro' => 'Mesaj nou de la ' . $this->client->name . ' — Suport Solberg Grupo',
            'lv' => 'Jauns ziņojums no ' . $this->client->name . ' — Solberg Grupo atbalsts',
            'nl' => 'Nieuw bericht van ' . $this->client->name . ' — Solberg Grupo Support',
            'pt' => 'Nova mensagem de ' . $this->client->name . ' — Suporte Solberg Grupo',
        ];

        return new Envelope(
            subject: $subjects[$this->locale] ?? $subjects['fr'],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.admin-support',
            with: ['locale' => $this->locale],
        );
    }
}
