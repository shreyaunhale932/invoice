
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice {{ $invoice->invoice_no }}</title>

    <style>
        @page {
            size: A4;
            margin: 18px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
            color: #333;
            margin: 0;
            line-height: 1.45;
        }

        .invoice {
            width: 100%;
        }

        .header {
            width: 100%;
            border-bottom: 2px solid #6946c7;
            padding-bottom: 14px;
            margin-bottom: 16px;
        }

        .header-table,
        .info-table,
        .items-table,
        .totals-table,
        .payment-table {
            width: 100%;
            border-collapse: collapse;
        }

        .company-name {
            font-size: 20px;
            font-weight: bold;
            color: #6946c7;
            margin-bottom: 5px;
        }

        .invoice-heading {
            text-align: right;
            font-size: 23px;
            font-weight: bold;
            color: #6946c7;
        }

        .invoice-meta {
            text-align: right;
            line-height: 1.8;
        }

        .section-title {
            font-size: 11px;
            font-weight: bold;
            color: #6946c7;
            margin: 15px 0 7px;
            text-transform: uppercase;
        }

        .info-table td {
            width: 50%;
            vertical-align: top;
            padding: 9px;
            border: 1px solid #e5e1ef;
        }

        .info-label {
            color: #777;
            font-size: 9px;
        }

        .info-value {
            font-weight: bold;
            margin-top: 3px;
        }

        .items-table {
            margin-top: 8px;
        }

        .items-table th {
            background: #6946c7;
            color: #fff;
            padding: 8px 5px;
            text-align: center;
            font-size: 9px;
        }

        .items-table td {
            border: 1px solid #e5e1ef;
            padding: 7px 5px;
            vertical-align: top;
        }

        .items-table .detail-row td {
            background: #faf9fd;
            color: #555;
            font-size: 9px;
        }

        .right {
            text-align: right;
        }

        .center {
            text-align: center;
        }

        .totals-wrapper {
            width: 100%;
            margin-top: 14px;
        }

        .totals-table {
            width: 55%;
            margin-left: auto;
        }

        .totals-table td,
        .payment-table td {
            padding: 5px 7px;
            border-bottom: 1px solid #eee;
        }

        .grand-total td {
            background: #f1edfb;
            color: #51349f;
            font-size: 13px;
            font-weight: bold;
            border-top: 2px solid #6946c7;
        }

        .payment-status {
            display: inline-block;
            padding: 4px 9px;
            border-radius: 3px;
            background: #eee;
            font-weight: bold;
            text-transform: uppercase;
        }

        .footer {
            margin-top: 25px;
            border-top: 1px solid #ddd;
            padding-top: 12px;
        }

        .terms {
            font-size: 9px;
            color: #666;
            margin-top: 15px;
        }

        .thanks {
            text-align: center;
            color: #6946c7;
            font-weight: bold;
            margin-top: 20px;
        }

        .muted {
            color: #777;
        }

        .avoid-break {
            page-break-inside: avoid;
        }
    </style>
</head>

<body>
@php
    use App\Helpers\NumberHelper;

    $settings = $templateSettings ?? [];

    $settingValue = function ($key, $default = '') use ($settings) {
        $setting = $settings[$key] ?? null;

        return $setting->value
            ?? $setting->default_value
            ?? $default;
    };

    $companyName = $settingValue('text_elements.company_name', '');
    $companyAddress = $settingValue('text_elements.company_address', '');

    $invoiceTitle = $settings['invoice_header.title']->label ?? 'TAX INVOICE';

    $customer = $customer ?? $invoice->customer;

    $taxableAmount = $invoice->taxable_amount ?? 0;
    $cgstPercent = $invoice->cgst_percent ?? 0;
    $sgstPercent = $invoice->sgst_percent ?? 0;

    $cgstAmount = $invoice->cgst_amount ?? 0;
    $sgstAmount = $invoice->sgst_amount ?? 0;
    $igstAmount = $invoice->igst_amount ?? 0;

    $discountPercent = $invoice->discount_percent ?? 0;
    $discountAmount = $invoice->discount_amount ?? 0;

    $grossTotal = $taxableAmount
        + $cgstAmount
        + $sgstAmount
        + $igstAmount
        - $discountAmount;

    $finalAmount = $invoice->final_amount ?? $grossTotal;
    $roundOff = $invoice->round_off ?? 0;

    $cash = $invoice->cash_received ?? 0;
    $online = $invoice->online_received ?? 0;
    $bankReceived = $invoice->bank_received ?? 0;
    $card = $invoice->card_received ?? 0;

    $totalReceived = $cash + $online + $bankReceived + $card;

    $balanceAmount = $invoice->amount_left
        ?? ($finalAmount - $totalReceived);

    $status = $balanceAmount <= 0
        ? 'Paid'
        : ($totalReceived > 0 ? 'Partial' : 'Pending');

    $totalGrossWt = 0;
    $totalNetWt = 0;
    $totalGoldAmount = 0;
    $totalMaking = 0;
    $totalAmount = 0;

    foreach ($invoice->items as $item) {
        $totalGrossWt += $item->gross_weight ?? 0;
        $totalNetWt += $item->net_weight ?? 0;

        $goldAmount = (
            ($item->gold_amount > 0)
                ? $item->gold_amount
                : (($item->net_weight ?? 0) * ($item->metal_rate ?? 0))
        ) + ($item->wastage_amount ?? 0);

        $totalGoldAmount += $goldAmount;
        $totalMaking += $item->making_final_amount ?? 0;
        $totalAmount += $item->final_price ?? 0;
    }

    $termsLabel = $settingValue(
        'text_elements.terms_label',
        'Terms & Conditions:'
    );

    $termsValue = $settingValue(
        'text_elements.terms_value',
        'Goods once sold cannot be taken back or exchanged.'
    );

    $thanksMessage = $settingValue(
        'text_elements.thanks_message',
        'Thank you for your business!'
    );
@endphp

<div class="invoice">

    {{-- HEADER --}}
    <table class="header header-table">
        <tr>
            <td width="60%">
                <div class="company-name">
                    {{ $companyName ?: 'Company' }}
                </div>

                <div class="muted">
                    {!! nl2br(e($companyAddress)) !!}
                </div>
            </td>

            <td width="40%" class="invoice-meta">
                <div class="invoice-heading">{{ $invoiceTitle }}</div>

                <strong>Invoice No:</strong>
                {{ $invoice->invoice_no }}<br>

                <strong>Invoice Date:</strong>
                {{ $invoice->invoice_date
                    ? date('d-m-Y', strtotime($invoice->invoice_date))
                    : '-' }}<br>

                <strong>Due Date:</strong>
                {{ $invoice->invoice_due_date
                    ? date('d-m-Y', strtotime($invoice->invoice_due_date))
                    : '-' }}
            </td>
        </tr>
    </table>

    {{-- CUSTOMER INFORMATION --}}
    <div class="section-title">Customer Information</div>

    <table class="info-table">
        <tr>
            <td>
                <div class="info-label">Customer Name</div>
                <div class="info-value">
                    {{ $customer->name ?? '-' }}
                </div>

                @if(!empty($customer->phone))
                    <div>Phone: {{ $customer->phone }}</div>
                @endif

                @if(!empty($customer->email))
                    <div>Email: {{ $customer->email }}</div>
                @endif

                @if(!empty($customer->gstin))
                    <div>GSTIN: {{ $customer->gstin }}</div>
                @endif
            </td>

            <td>
                <div class="info-label">Billing Address</div>
                <div class="info-value">
                    {{ $customer->address ?? '-' }}
                </div>

                <br>

                <div class="info-label">Shipping Address</div>
                <div>
                    {{ $invoice->shipping_address ?: ($customer->address ?? '-') }}
                </div>
            </td>
        </tr>
    </table>

    <div style="margin-top:10px;">
        <strong>Payment Status:</strong>
        <span class="payment-status">{{ $status }}</span>
    </div>

    {{-- PRODUCT DETAILS --}}
    <div class="section-title">Invoice Items</div>

    <table class="items-table">
        <thead>
            <tr>
                <th width="5%">#</th>
                <th width="29%">Description</th>
                <th width="8%">Qty</th>
                <th width="12%">Gross Wt</th>
                <th width="12%">Net Wt</th>
                <th width="15%">Rate</th>
                <th width="19%">Amount</th>
            </tr>
        </thead>

        <tbody>
            @forelse($invoice->items as $item)
                @php
                    $goldAmount = (
                        ($item->gold_amount > 0)
                            ? $item->gold_amount
                            : (($item->net_weight ?? 0) * ($item->metal_rate ?? 0))
                    ) + ($item->wastage_amount ?? 0);

                    $purityValue = '';

                    if ($item->product && $item->product->metalRate) {
                        $purityValue = ($item->product->metalRate->karat ?? '')
                            . ($item->product->metalRate->purity_type == 'karat' ? 'KT' : '%');
                    } else {
                        $purityValue = $item->purity ?? '';
                    }
                @endphp

                <tr>
                    <td class="center">{{ $loop->iteration }}</td>

                    <td>
                        <strong>{{ strtoupper($item->item_name ?? '') }}</strong>

                        @if($purityValue)
                            <br><span class="muted">Purity: {{ $purityValue }}</span>
                        @endif

                        @if($item->hsn_code)
                            <br><span class="muted">HSN: {{ $item->hsn_code }}</span>
                        @endif
                    </td>

                    <td class="center">{{ $item->quantity }}</td>

                    <td class="right">
                        {{ number_format($item->gross_weight ?? 0, 3) }}
                    </td>

                    <td class="right">
                        {{ number_format($item->net_weight ?? 0, 3) }}
                    </td>

                    <td class="right">
                        ₹{{ number_format($item->metal_rate ?? 0, 2) }}
                    </td>

                    <td class="right">
                        ₹{{ number_format($goldAmount, 2) }}
                    </td>
                </tr>

                {{-- DIAMONDS --}}
                @foreach($item->diamonds as $diamond)
                    <tr class="detail-row">
                        <td></td>
                        <td>
                            Diamond:
                            {{ $diamond->clarity }}/{{ $diamond->color }}
                            {{ $diamond->cut }}
                        </td>
                        <td class="center">{{ $diamond->pieces }}</td>
                        <td></td>
                        <td class="right">
                            {{ number_format($diamond->diamond_weight, 3) }} Ct
                        </td>
                        <td class="right">
                            ₹{{ number_format($diamond->price_per_carat, 2) }}
                        </td>
                        <td class="right">
                            ₹{{ number_format($diamond->diamond_final_price, 2) }}
                        </td>
                    </tr>
                @endforeach

                {{-- STONES --}}
                @foreach($item->stones as $stone)
                    <tr class="detail-row">
                        <td></td>
                        <td>Stone: {{ $stone->stone_name }}</td>
                        <td class="center">{{ $stone->pieces }}</td>
                        <td></td>
                        <td class="right">
                            {{ number_format($stone->stone_weight, 3) }}
                        </td>
                        <td class="right">
                            ₹{{ number_format($stone->stone_price, 2) }}
                        </td>
                        <td class="right">
                            ₹{{ number_format($stone->stone_final_price, 2) }}
                        </td>
                    </tr>
                @endforeach

                {{-- PACKETS --}}
                @foreach($item->packets as $packet)
                    <tr class="detail-row">
                        <td></td>
                        <td>
                            {{ $packet->stone ?: 'Packet' }}
                            [{{ $packet->packet_no }}]
                        </td>
                        <td class="center">{{ $packet->pcs }}</td>
                        <td></td>
                        <td class="right">
                            {{ number_format($packet->weight, 3) }}
                        </td>
                        <td class="right">
                            ₹{{ number_format($packet->rate, 2) }}
                        </td>
                        <td class="right">
                            ₹{{ number_format($packet->amount, 2) }}
                        </td>
                    </tr>
                @endforeach

                {{-- MAKING --}}
                @if(($item->making_final_amount ?? 0) > 0 || ($item->making_charges ?? 0) > 0)
                    <tr class="detail-row">
                        <td></td>
                        <td>Making Charges</td>
                        <td></td><td></td><td></td>
                        <td class="right">
                            ₹{{ number_format($item->making_price ?? 0, 2) }}
                        </td>
                        <td class="right">
                            ₹{{ number_format($item->making_final_amount ?? 0, 2) }}
                        </td>
                    </tr>
                @endif

                {{-- OTHER CHARGES --}}
                @if(($item->other_charges ?? 0) > 0)
                    <tr class="detail-row">
                        <td></td>
                        <td>Other Charges</td>
                        <td></td><td></td><td></td><td></td>
                        <td class="right">
                            ₹{{ number_format($item->other_charges, 2) }}
                        </td>
                    </tr>
                @endif
            @empty
                <tr>
                    <td colspan="7" class="center">No invoice items found.</td>
                </tr>
            @endforelse
        </tbody>

        <tfoot>
            <tr>
                <td colspan="3"><strong>Total</strong></td>
                <td class="right">
                    <strong>{{ number_format($totalGrossWt, 3) }}</strong>
                </td>
                <td class="right">
                    <strong>{{ number_format($totalNetWt, 3) }}</strong>
                </td>
                <td></td>
                <td class="right">
                    <strong>₹{{ number_format($totalAmount, 2) }}</strong>
                </td>
            </tr>
        </tfoot>
    </table>

    {{-- EXCHANGE ITEMS --}}
    @if($invoice->exchangeItems && $invoice->exchangeItems->count())
        <div class="section-title">Old Metal Received</div>

        <table class="items-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Description</th>
                    <th>Metal</th>
                    <th>Gross Wt</th>
                    <th>Net Wt</th>
                    <th>Purity</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoice->exchangeItems as $ex)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $ex->description }}</td>
                        <td>{{ $ex->metal }}</td>
                        <td class="right">{{ number_format($ex->gross_weight, 3) }}</td>
                        <td class="right">{{ number_format($ex->net_weight, 3) }}</td>
                        <td>{{ $ex->purity }}</td>
                        <td class="right">₹{{ number_format($ex->amount, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    {{-- EXCHANGE DIAMONDS --}}
    @if($invoice->exchangeDiamonds && $invoice->exchangeDiamonds->count())
        <div class="section-title">Old Diamonds Received</div>

        <table class="items-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Description</th>
                    <th>Clarity</th>
                    <th>Cut</th>
                    <th>Color</th>
                    <th>Pieces</th>
                    <th>Weight</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoice->exchangeDiamonds as $diamond)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $diamond->description }}</td>
                        <td>{{ $diamond->clarity }}</td>
                        <td>{{ $diamond->cut }}</td>
                        <td>{{ $diamond->color }}</td>
                        <td>{{ $diamond->pieces }}</td>
                        <td class="right">{{ number_format($diamond->weight, 3) }}</td>
                        <td class="right">₹{{ number_format($diamond->amount, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    {{-- TAX AND TOTALS --}}
    <div class="totals-wrapper">
        <table class="totals-table">
            <tbody>
                <tr>
                    <td>Taxable Amount</td>
                    <td class="right">₹{{ number_format($taxableAmount, 2) }}</td>
                </tr>

                @if($igstAmount > 0)
                    <tr>
                        <td>IGST ({{ $cgstPercent + $sgstPercent }}%)</td>
                        <td class="right">₹{{ number_format($igstAmount, 2) }}</td>
                    </tr>
                @else
                    <tr>
                        <td>CGST ({{ $cgstPercent }}%)</td>
                        <td class="right">₹{{ number_format($cgstAmount, 2) }}</td>
                    </tr>
                    <tr>
                        <td>SGST ({{ $sgstPercent }}%)</td>
                        <td class="right">₹{{ number_format($sgstAmount, 2) }}</td>
                    </tr>
                @endif

                @if($discountAmount > 0)
                    <tr>
                        <td>Discount ({{ $discountPercent }}%)</td>
                        <td class="right">-₹{{ number_format($discountAmount, 2) }}</td>
                    </tr>
                @endif

                <tr>
                    <td>Round Off</td>
                    <td class="right">
                        {{ $roundOff >= 0 ? '+' : '' }}₹{{ number_format($roundOff, 2) }}
                    </td>
                </tr>

                <tr class="grand-total">
                    <td>Grand Total</td>
                    <td class="right">₹{{ number_format($finalAmount, 2) }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- PAYMENT DETAILS --}}
    <div class="section-title">Payment Details</div>

    <table class="payment-table">
        <tbody>
            @if($cash > 0)
                <tr>
                    <td>Cash Received</td>
                    <td class="right">₹{{ number_format($cash, 2) }}</td>
                </tr>
            @endif

            @if($online > 0)
                <tr>
                    <td>Online Received</td>
                    <td class="right">₹{{ number_format($online, 2) }}</td>
                </tr>
            @endif

            @if($bankReceived > 0)
                <tr>
                    <td>Bank Received</td>
                    <td class="right">₹{{ number_format($bankReceived, 2) }}</td>
                </tr>
            @endif

            @if($card > 0)
                <tr>
                    <td>Card Received</td>
                    <td class="right">₹{{ number_format($card, 2) }}</td>
                </tr>
            @endif

            <tr>
                <td><strong>Total Received</strong></td>
                <td class="right">
                    <strong>₹{{ number_format($totalReceived, 2) }}</strong>
                </td>
            </tr>

            <tr>
                <td><strong>{{ $balanceAmount > 0 ? 'Balance Due' : 'Change Return' }}</strong></td>
                <td class="right">
                    <strong>₹{{ number_format(abs($balanceAmount), 2) }}</strong>
                </td>
            </tr>
        </tbody>
    </table>

    {{-- TERMS --}}
    <div class="footer">
        @if($termsValue)
            <div class="terms">
                <strong>{{ $termsLabel }}</strong><br>
                {!! nl2br(e($termsValue)) !!}
            </div>
        @endif

        <div class="thanks">
            {{ $thanksMessage }}
        </div>
    </div>

</div>
</body>
</html>
