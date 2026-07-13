<?php

namespace App\Mail;

use App\Models\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Invoice $invoice) {}

    public function envelope(): Envelope
    {
        $ref    = $this->invoice->reference;
        $locale = $this->invoice->client->locale ?? 'fr';

        $subjects = [
            'fr' => 'Facture ' . $ref . ' — SOLBERG GRUPO',
            'en' => 'Invoice ' . $ref . ' — SOLBERG GRUPO',
            'es' => 'Factura ' . $ref . ' — SOLBERG GRUPO',
            'pl' => 'Faktura ' . $ref . ' — SOLBERG GRUPO',
            'bg' => 'Фактура ' . $ref . ' — SOLBERG GRUPO',
            'hu' => 'Számla ' . $ref . ' — SOLBERG GRUPO',
            'it' => 'Fattura ' . $ref . ' — SOLBERG GRUPO',
            'de' => 'Rechnung ' . $ref . ' — SOLBERG GRUPO',
            'lt' => 'Sąskaita faktūra ' . $ref . ' — SOLBERG GRUPO',
            'ro' => 'Factura ' . $ref . ' — SOLBERG GRUPO',
            'lv' => 'Rēķins ' . $ref . ' — SOLBERG GRUPO',
            'nl' => 'Factuur ' . $ref . ' — SOLBERG GRUPO',
        ];

        return new Envelope(subject: $subjects[$locale] ?? $subjects['fr']);
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.invoice',
            with: [
                'invoice' => $this->invoice,
                'locale'  => $this->invoice->client->locale ?? 'fr',
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
