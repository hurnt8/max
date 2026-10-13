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
            'fr' => 'Facture ' . $ref . ' — MELLENTHIN FOUNDATION',
            'en' => 'Invoice ' . $ref . ' — MELLENTHIN FOUNDATION',
            'es' => 'Factura ' . $ref . ' — MELLENTHIN FOUNDATION',
            'pl' => 'Faktura ' . $ref . ' — MELLENTHIN FOUNDATION',
            'bg' => 'Фактура ' . $ref . ' — MELLENTHIN FOUNDATION',
            'hu' => 'Számla ' . $ref . ' — MELLENTHIN FOUNDATION',
            'it' => 'Fattura ' . $ref . ' — MELLENTHIN FOUNDATION',
            'de' => 'Rechnung ' . $ref . ' — MELLENTHIN FOUNDATION',
            'lt' => 'Sąskaita faktūra ' . $ref . ' — MELLENTHIN FOUNDATION',
            'ro' => 'Factura ' . $ref . ' — MELLENTHIN FOUNDATION',
            'lv' => 'Rēķins ' . $ref . ' — MELLENTHIN FOUNDATION',
            'nl' => 'Factuur ' . $ref . ' — MELLENTHIN FOUNDATION',
            'pt' => 'Fatura ' . $ref . ' — MELLENTHIN FOUNDATION',
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
