
<p>Hello {{ $invoice->customer_name }},</p>

<p>Thank you for subscribing to JewelERP.</p>

<p>Your subscription payment has been received successfully.</p>

<p><strong>Invoice Number:</strong> {{ $invoice->invoice_number }}</p>

<p><strong>Amount:</strong> ₹{{ number_format($invoice->total_amount, 2) }}</p>

<p>Please find your GST tax invoice attached to this email.</p>

<p>Regards,<br>
{{ config('subscription.supplier.name') }}</p>
