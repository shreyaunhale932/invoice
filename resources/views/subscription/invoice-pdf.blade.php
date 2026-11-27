
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Subscription Tax Invoice</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 25px;
        }
        .section {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 9px;
            text-align: left;
        }
        th {
            background: #f2f2f2;
        }
        .right {
            text-align: right;
        }
        .total {
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>{{ config('subscription.supplier.name') }}</h2>
        <p>GSTIN: {{ config('subscription.supplier.gstin') }}</p>
        <p>{{ config('subscription.supplier.address') }}</p>
        <h3>TAX INVOICE</h3>
    </div>

    <div class="section">
        <strong>Invoice Number:</strong> {{ $invoice->invoice_number }}<br>
        <strong>Invoice Date:</strong> {{ $invoice->issued_at?->format('d-m-Y') }}
    </div>

    <div class="section">
        <strong>Bill To:</strong><br>
        {{ $invoice->customer_name }}<br>
        {{ $invoice->billing_address }}<br>
        GSTIN: {{ $invoice->customer_gstin ?: 'Unregistered' }}<br>
        Place of Supply: {{ $invoice->place_of_supply }}
    </div>

    <table>
        <thead>
            <tr>
                <th>Description</th>
                <th>Taxable Amount</th>
                <th>GST</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>JewelERP {{ $invoice->subscription->plan_name }} Subscription</td>
                <td>₹{{ number_format($invoice->taxable_amount, 2) }}</td>
                <td>₹{{ number_format(
                    $invoice->cgst_amount +
                    $invoice->sgst_amount +
                    $invoice->igst_amount, 2
                ) }}</td>
                <td>₹{{ number_format($invoice->total_amount, 2) }}</td>
            </tr>
        </tbody>
    </table>

    <br>

    <table>
        <tr>
            <td>Taxable Amount</td>
            <td class="right">₹{{ number_format($invoice->taxable_amount, 2) }}</td>
        </tr>
        <tr>
            <td>CGST</td>
            <td class="right">₹{{ number_format($invoice->cgst_amount, 2) }}</td>
        </tr>
        <tr>
            <td>SGST</td>
            <td class="right">₹{{ number_format($invoice->sgst_amount, 2) }}</td>
        </tr>
        <tr>
            <td>IGST</td>
            <td class="right">₹{{ number_format($invoice->igst_amount, 2) }}</td>
        </tr>
        <tr class="total">
            <td>Grand Total</td>
            <td class="right">₹{{ number_format($invoice->total_amount, 2) }}</td>
        </tr>
    </table>

</body>
</html>
