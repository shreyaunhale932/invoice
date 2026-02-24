<h2>Invoice Details</h2>

<p><strong>Invoice No:</strong> {{ $invoice->invoice_no }}</p>
<p><strong>Date:</strong> {{ $invoice->invoice_date }}</p>
<p><strong>Total:</strong> ₹ {{ number_format($invoice->final_amount,2) }}</p>
<p><strong>Paid:</strong> ₹ {{ number_format($invoice->total_received ?? 0,2) }}</p>
<p><strong>Balance:</strong> ₹ {{ number_format($invoice->amount_left ?? 0,2) }}</p>

<p>Thank you for your business.</p>
