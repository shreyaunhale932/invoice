<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Http;
use App\Models\SellInvoice;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $invoice;

    public function __construct($invoice)
    {
        $this->invoice = $invoice;
    }

    public function build()
    {
        $invoice = SellInvoice::with([
            'items.product',
            'customer'
        ])->findOrFail($this->invoice->id);

        $html = view('pdf.invo', [
            'invoice' => $invoice,
            'customer' => $invoice->customer
        ])->render();

        $pdf = Pdf::loadHTML($html)->setPaper('A4', 'portrait');

        return $this->subject('Invoice #' . $invoice->invoice_no)
            ->view('emails.invoice')
            ->attachData(
                $pdf->output(),
                'Invoice-' . $invoice->invoice_no . '.pdf',
                ['mime' => 'application/pdf']
            );
    }
}
