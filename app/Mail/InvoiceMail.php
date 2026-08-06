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
            'fr' => 'Facture ' . $ref . ' : AURELIS CAPITAL GROUP',
            'en' => 'Invoice ' . $ref . ' : AURELIS CAPITAL GROUP',
            'es' => 'Factura ' . $ref . ' : AURELIS CAPITAL GROUP',
            'pl' => 'Faktura ' . $ref . ' : AURELIS CAPITAL GROUP',
            'bg' => 'Фактура ' . $ref . ' : AURELIS CAPITAL GROUP',
            'hu' => 'Számla ' . $ref . ' : AURELIS CAPITAL GROUP',
            'it' => 'Fattura ' . $ref . ' : AURELIS CAPITAL GROUP',
            'de' => 'Rechnung ' . $ref . ' : AURELIS CAPITAL GROUP',
            'lt' => 'Sąskaita faktūra ' . $ref . ' : AURELIS CAPITAL GROUP',
            'ro' => 'Factura ' . $ref . ' : AURELIS CAPITAL GROUP',
            'lv' => 'Rēķins ' . $ref . ' : AURELIS CAPITAL GROUP',
            'nl' => 'Factuur ' . $ref . ' : AURELIS CAPITAL GROUP',
            'pt' => 'Fatura ' . $ref . ' : AURELIS CAPITAL GROUP',
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
