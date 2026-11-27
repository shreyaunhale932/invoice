<?php

namespace App\Mail;

use App\Models\SubscriptionInvoice;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;


class SubscriptionInvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public SubscriptionInvoice $invoice) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your JewelERP Subscription Tax Invoice - ' . $this->invoice->invoice_number
        );
    }

    public function content(): Content
    {
        return new Content(view: 'emails.subscription-invoice');
    }

    // public function attachments(): array
    // {
    //     $pdf = Pdf::loadView('subscription.invoice-pdf', [
    //         'invoice' => $this->invoice,
    //     ])->output();

    //     return [
    //         Attachment::fromData(
    //             fn () => $pdf,
    //             str_replace('/', '_', $this->invoice->invoice_number) . '.pdf'
    //         )->withMime('application/pdf'),
    //     ];
    // }
    public function attachments(): array
    {
        return [
            Attachment::fromStorageDisk('local', $this->invoice->pdf_path)
                ->as(str_replace('/', '_', $this->invoice->invoice_number) . '.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
