<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Invoice {{ $invoice->invoice_no ?? '' }}</title>
    <style>
        @page {
            margin: 24px 28px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            color: #222;
            font-family: DejaVu Sans, sans-serif;
            font-size: 9.5pt;
            line-height: 1.4;
        }

        .page {
            width: 100%;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        .plain-table,
        .plain-table td,
        .plain-table th {
            border: 0 !important;
        }

        .header-table td {
            vertical-align: middle;
            padding: 0 4px 8px;
        }

        .header-qr {
            width: 17%;
            text-align: left;
        }

        .header-title {
            width: 53%;
            text-align: center;
        }

        .header-logo {
            width: 30%;
            text-align: right;
        }

        .qr-image {
            max-width: 88px;
            max-height: 88px;
        }

        .company-logo {
            max-width: 135px;
            max-height: 78px;
        }

        .invoice-title {
            margin: 0;
            font-size: 17pt;
            font-weight: bold;
            text-transform: uppercase;
        }

        .copy-title {
            margin-top: 3px;
            font-size: 9pt;
            font-weight: bold;
        }

        .company-meta {
            margin-top: 3px;
            font-size: 8.5pt;
        }

        .business-meta td {
            vertical-align: top;
            padding: 5px 5px 8px;
        }

        .business-left {
            width: 58%;
        }

        .business-right {
            width: 42%;
            text-align: right;
        }

        .business-name {
            font-size: 12pt;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 3px;
        }

        .invoice-meta {
            display: inline-table;
            width: auto;
            min-width: 225px;
        }

        .invoice-meta td {
            padding: 1px 0 1px 7px;
        }

        .invoice-meta td:first-child {
            font-weight: bold;
            text-align: right;
            white-space: nowrap;
        }

        .invoice-meta td:last-child {
            text-align: left;
            white-space: nowrap;
        }

        .rule {
            border-top: 1px solid #333;
            margin: 2px 0 9px;
        }

        .section-heading {
            font-size: 9pt;
            font-weight: bold;
            text-transform: uppercase;
            margin: 10px 0 5px;
        }

        .customer-table td {
            border: 0;
            vertical-align: top;
            padding: 2px 5px;
        }

        .customer-label {
            width: 17%;
            font-weight: bold;
        }

        .customer-name {
            font-weight: bold;
            font-size: 10pt;
        }

        .customer-info {
            margin-top: 2px;
        }

        .status {
            font-weight: bold;
            text-transform: uppercase;
        }

        .items {
            margin-top: 8px;
            table-layout: fixed;
        }

        .items th,
        .items td {
            border: 1px solid #555;
            padding: 5px 4px;
            vertical-align: top;
        }

        .items th {
            background: #f0f0f0;
            font-weight: bold;
            text-align: center;
            font-size: 8pt;
        }

        .items td {
            font-size: 8.5pt;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .item-name {
            font-weight: bold;
            text-transform: uppercase;
        }

        .sub-row td {
            font-size: 8pt !important;
            color: #333;
        }

        .sub-label {
            padding-left: 12px !important;
        }

        .items tfoot td {
            font-weight: bold;
            background: #f7f7f7;
        }

        .exchange {
            margin-top: 9px;
        }

        .exchange th,
        .exchange td {
            border: 1px solid #666;
            padding: 4px 3px;
            font-size: 8pt;
        }

        .exchange th {
            background: #f0f0f0;
            text-align: center;
        }

        .summary-layout {
            margin-top: 9px;
        }

        .summary-layout>tbody>tr>td {
            border: 0;
            vertical-align: top;
            padding: 3px 5px;
        }

        .summary-left {
            width: 52%;
        }

        .summary-right {
            width: 48%;
        }

        .totals {
            width: 100%;
            margin-left: auto;
        }

        .totals td {
            border: 0;
            padding: 2px 3px;
        }

        .totals td:last-child {
            text-align: right;
            white-space: nowrap;
        }

        .totals .grand-total td {
            border-top: 1px solid #333;
            border-bottom: 1px solid #333;
            font-size: 9pt;
            font-weight: bold;
            padding-top: 5px;
            padding-bottom: 5px;
        }

        .totals .balance td {
            border-top: 1px solid #999;
            font-weight: bold;
            padding-top: 4px;
        }

        .amount-words {
            margin-top: 7px;
            padding: 5px;
            border-top: 1px solid #555;
            border-bottom: 1px solid #555;
        }

        .footer-table {
            margin-top: 8px;
        }

        .footer-table>tbody>tr>td {
            border: 0;
            vertical-align: top;
            padding: 3px 5px;
        }

        .footer-left {
            width: 60%;
        }

        .footer-right {
            width: 40%;
            text-align: right;
        }

        .footer-heading {
            font-weight: bold;
            margin-bottom: 3px;
        }

        .terms {
            margin: 0;
            padding-left: 14px;
        }

        .terms li {
            margin-bottom: 2px;
        }

        .bank-table {
            width: auto;
            margin-top: 4px;
        }

        .bank-table td {
            border: 0;
            padding: 1px 5px 1px 0;
        }

        .signature-area {
            margin-top: 20px;
            text-align: right;
        }

        .signature-image {
            max-width: 115px;
            max-height: 42px;
        }

        .signature-line {
            border-top: 1px solid #555;
            width: 145px;
            margin: 5px 0 3px auto;
        }

        .receiver {
            margin-top: 28px;
            text-align: left;
        }

        .receiver-line {
            border-top: 1px solid #555;
            width: 140px;
            margin: 0 0 3px;
        }

        .thank-you {
            margin-top: 10px;
            text-align: center;
            font-weight: bold;
        }

        .generated-note {
            margin-top: 4px;
            text-align: center;
            font-size: 8pt;
            color: #666;
        }

        .muted {
            color: #555;
        }
    </style>
</head>

<body>
    @php
        $settings = $templateSettings ?? collect();
        $setting = function ($key, $property = 'value', $default = null) use ($settings) {
            $row = $settings[$key] ?? null;
            if (!$row) {
                return $default;
            }
            $value = $row->{$property} ?? null;
            if (($value === null || $value === '') && $property === 'value') {
                $value = $row->default_value ?? $default;
            }
            return $value === null || $value === '' ? $default : $value;
        };
        $pick = function ($source, array $keys, $default = '') {
            foreach ($keys as $key) {
                $value = data_get($source, $key);
                if ($value !== null && $value !== '') {
                    return $value;
                }
            }
            return $default;
        };

        // Match the original invoice view: company name/address come from InvoiceTemplateSetting.
        $companyName = $setting('text_elements.company_name', 'value', '');
        if (trim((string) $companyName) === '' || strtolower(trim((string) $companyName)) === 'company') {
            $companyName = $pick(
                $business ?? null,
                [
                    'business_name',
                    'businessName',
                    'company_name',
                    'companyName',
                    'firm_name',
                    'firmName',
                    'shop_name',
                    'shopName',
                    'trade_name',
                    'name',
                ],
                '',
            );
        }

        $companyAddress = $setting('text_elements.company_address', 'value', '');
        if (trim((string) $companyAddress) === '') {
            $companyAddress = $pick(
                $business ?? null,
                ['business_address', 'businessAddress', 'company_address', 'companyAddress', 'address', 'full_address'],
                '',
            );
        }
        $companyPhone = $pick(
            $business ?? null,
            ['phone', 'mobile', 'mobile_number', 'mobileNumber', 'contact_number', 'contactNumber', 'phone_number'],
            '',
        );
        $companyEmail = $pick($business ?? null, ['email', 'business_email', 'company_email'], '');
        $companyGstin = $pick($business ?? null, ['gstin', 'gst_no', 'gst_number', 'gstNumber', 'gst'], '');
        $companyWebsite = $pick($business ?? null, ['website', 'website_url'], '');
        $companyState = $pick($business ?? null, ['state', 'state_name'], '');
        $companyStateCode = $pick($business ?? null, ['state_code'], '');

        $logoPath = $setting(
            'visual_elements.logo_light',
            'value',
            $setting('visual_elements.logo_light', 'default_value', '/assets/img/logo2.png'),
        );
        if (!$logoPath) {
            $logoPath = $pick($business ?? null, ['logo', 'logo_path', 'company_logo'], '');
        }
        $qrPath = $setting(
            'visual_elements.qr_code',
            'value',
            $setting('visual_elements.qr_code', 'default_value', '/assets/img/qr-code.svg'),
        );
        $signaturePath = $setting(
            'visual_elements.signature_image',
            'value',
            $setting('visual_elements.signature_image', 'default_value', '/assets/img/signature.png'),
        );
        $invoiceTitle = $setting('invoice_header.title', 'label', 'Tax Invoice');
        $invoiceNoLabel = $setting('invoice_meta.invoice_no', 'label', 'Invoice No');
        $invoiceDateLabel = $setting('invoice_meta.invoice_date', 'label', 'Date');
        $dueDateLabel = $setting('invoice_meta.due_date', 'label', 'Due Date');

        $cashReceivedLabel = $setting('invoice_footer.cash_received_label', 'label', 'Cash Received');
        $onlineReceivedLabel = $setting('invoice_footer.online_received_label', 'label', 'Online Received');
        $bankReceivedLabel = $setting('invoice_footer.bank_received_label', 'label', 'Bank Received');
        $cardReceivedLabel = $setting('invoice_footer.card_received_label', 'label', 'Card Received');
        $totalReceivedLabel = $setting('invoice_footer.total_received_label', 'label', 'Total Received');
        $balanceDueLabel = $setting('invoice_footer.balance_due_label', 'label', 'Balance Due');
        $advSettledLabel = $setting('invoice_footer.adv_settled_label', 'label', 'Advance Settled');
        $udharSettledLabel = $setting('invoice_footer.udhar_settled_label', 'label', 'Udhar Settled');

        $customerName = data_get($customer ?? null, 'name', '');
        $customerPhone = data_get($customer ?? null, 'phone', '');
        $customerEmail = data_get($customer ?? null, 'email', '');
        $customerGstin = data_get($customer ?? null, 'gstin', '');

        $totalGrossWt = 0;
        $totalNetWt = 0;
        $totalGoldAmount = 0;
        $totalMaking = 0;
        $totalAmount = 0;
        foreach ($invoice->items as $item) {
            $totalGrossWt += (float) ($item->gross_weight ?? 0);
            $totalNetWt += (float) ($item->net_weight ?? 0);
            $goldAmount =
                (($item->gold_amount ?? 0) > 0
                    ? $item->gold_amount
                    : ($item->net_weight ?? 0) * ($item->metal_rate ?? 0)) + (float) ($item->wastage_amount ?? 0);
            $totalGoldAmount += $goldAmount;
            $totalMaking += (float) ($item->making_final_amount ?? 0);
            $totalAmount += (float) ($item->final_price ?? 0);
        }

        // Keep the same invoice-stored totals and payment calculations used in the existing invoice view.
        $taxableAmount = (float) ($invoice->taxable_amount ?? 0);
        $cgstPercent = (float) ($invoice->cgst_percent ?? 0);
        $sgstPercent = (float) ($invoice->sgst_percent ?? 0);
        $cgstAmount = (float) ($invoice->cgst_amount ?? 0);
        $sgstAmount = (float) ($invoice->sgst_amount ?? 0);
        $igstAmount = (float) ($invoice->igst_amount ?? 0);
        $discountPercent = (float) ($invoice->discount_percent ?? 0);
        $discountAmount = (float) ($invoice->discount_amount ?? 0);
        $grossTotal = $taxableAmount + $cgstAmount + $sgstAmount + $igstAmount - $discountAmount;
        $finalAmount = (float) ($invoice->final_amount ?? $grossTotal);
        $roundOff = (float) ($invoice->round_off ?? 0);
        $advSettled = (float) ($invoice->paymentTransactions ? $invoice->paymentTransactions->where('transaction_type', 'refund')->sum('amount') : 0);
        $udharSettled = (float) ($invoice->paymentTransactions ? $invoice->paymentTransactions->where('transaction_type', 'udhaar_return')->sum('amount') : 0);
        $totalExchangeAmt = (float) ($invoice->total_exchange_amount ?? 0);
        $cash = (float) ($invoice->cash_received ?? 0);
        $online = (float) ($invoice->online_received ?? 0);
        $bankReceived = (float) ($invoice->bank_received ?? 0);
        $card = (float) ($invoice->card_received ?? 0);
        $totalReceived = $cash + $online + $bankReceived + $card + $totalExchangeAmt;
        $balanceAmount = (float) ($invoice->amount_left ?? ($finalAmount - $totalReceived - $advSettled + $udharSettled));
        $balanceAmount = round($balanceAmount);
        $status = $balanceAmount <= 0 ? 'Paid' : (($totalReceived > 0 || $advSettled > 0) ? 'Partially Paid' : 'Pending');

        $termsValue = $setting(
            'text_elements.terms_value',
            'value',
            "Goods once sold cannot be taken back or exchanged.\nManufacturer warranty applies as per company policy.",
        );
        $termsLabel = $setting('text_elements.terms_label', 'value', 'Terms & Conditions');
        $terms = preg_split('/\R/', (string) $termsValue);
        $terms = array_values(
            array_filter(
                array_map(function ($line) {
                    return trim(preg_replace('/^\s*(?:\d+\.|[-*])\s*/', '', $line));
                }, $terms),
            ),
        );

        $bankName = $pick($bank ?? null, ['bank_name', 'name'], '');
        $bankAccountName = $pick($bank ?? null, ['account_name', 'account_holder_name', 'holder_name'], '');
        $bankAccountNo = $pick($bank ?? null, ['account_number', 'account_no', 'bank_account_number'], '');
        $bankBranch = $pick($bank ?? null, ['branch_name', 'branch'], '');
        $bankIfsc = $pick($bank ?? null, ['ifsc_code', 'ifsc'], '');

        $imageSource = function ($path) {
            if (!$path) {
                return null;
            }
            if (preg_match('/^(https?:\/\/|data:image\/)/i', $path)) {
                return $path;
            }
            $clean = ltrim(str_replace('\\', '/', $path), '/');
            $candidates = [
                public_path($clean),
                public_path('storage/' . $clean),
                storage_path('app/public/' . preg_replace('#^storage/#', '', $clean)),
            ];
            foreach ($candidates as $candidate) {
                if (is_file($candidate)) {
                    return $candidate;
                }
            }
            return null;
        };
        $logoSource = $imageSource($logoPath);
        $qrSource = $imageSource($qrPath);
        $signatureSource = $imageSource($signaturePath);
    @endphp

    <div class="page">
        {{-- Header: images and invoice title are intentionally NOT enclosed in bordered boxes. --}}
        <table class="plain-table header-table">
            <tr>
               
                </td>
                <td class="header-title">
                    <div class="invoice-title">{{ $invoiceTitle ?: 'Invoice' }}</div>
                    
                </td>
                <td class="header-logo">
                    @if ($logoSource)
                        <img class="company-logo" src="{{ $logoSource }}" alt="Company Logo">
                    @endif
                </td>
            </tr>
        </table>

        <table class="plain-table business-meta">
            <tr>
                <td class="business-left">
                    @if ($companyName)
                        <div class="business-name">{{ $companyName }}</div>
                    @endif
                    @if ($companyAddress)
                        <div>{!! nl2br(e($companyAddress)) !!}</div>
                    @endif
                    @if ($companyState || $companyStateCode)
                        <div>
                            {{ $companyStateCode ? 'State Code: ' . $companyStateCode : '' }}{{ $companyStateCode && $companyState ? ' - ' : '' }}{{ $companyState }}
                        </div>
                    @endif
                    <div class="company-meta">
                        @if ($companyPhone)
                            Mob: {{ $companyPhone }}
                        @endif
                        @if ($companyEmail)
                            {{ $companyPhone ? ' | ' : '' }}Email: {{ $companyEmail }}
                        @endif
                    </div>
                    @if ($companyGstin)
                        <div><strong>GSTIN: {{ $companyGstin }}</strong></div>
                    @endif
                    @if ($companyWebsite)
                        <div>Web: {{ $companyWebsite }}</div>
                    @endif
                </td>
                <td class="business-right">
                    <table class="plain-table invoice-meta">
                        <tr>
                            <td>{{ $invoiceNoLabel }}:</td>
                            <td>{{ $invoice->invoice_no }}</td>
                        </tr>
                        <tr>
                            <td>{{ $invoiceDateLabel }}:</td>
                            <td>{{ $invoice->invoice_date ? \Carbon\Carbon::parse($invoice->invoice_date)->format('d/m/Y') : '' }}
                            </td>
                        </tr>
                        @if (!empty($invoice->invoice_due_date))
                            <tr>
                                <td>{{ $dueDateLabel }}:</td>
                                <td>{{ \Carbon\Carbon::parse($invoice->invoice_due_date)->format('d/m/Y') }}</td>
                            </tr>
                        @endif
                        @if (!empty($invoice->challan_no))
                            <tr>
                                <td>Challan No:</td>
                                <td>{{ $invoice->challan_no }}</td>
                            </tr>
                        @endif
                        @if (!empty($invoice->purchase_no))
                            <tr>
                                <td>Purchase No:</td>
                                <td>{{ $invoice->purchase_no }}</td>
                            </tr>
                        @endif
                    </table>
                </td>
            </tr>
        </table>
        <div class="rule"></div>

        {{-- Customer block: no billing or shipping address panels. --}}
        <table class="plain-table customer-table">
            <tr>
                <td class="customer-label">Buyer:</td>
                <td>
                    <div class="customer-name">{{ $customerName }}</div>
                    @if ($customerPhone)
                        <div class="customer-info">Mob: {{ $customerPhone }}</div>
                    @endif
                    @if ($customerEmail)
                        <div class="customer-info">Email: {{ $customerEmail }}</div>
                    @endif
                    @if ($customerGstin)
                        <div class="customer-info">GSTIN: {{ $customerGstin }}</div>
                    @endif
                </td>
                <td style="width: 25%; text-align: right;">
                    <span class="muted">Payment Status:</span> <span class="status">{{ $status }}</span>
                </td>
            </tr>
        </table>

        {{-- Jewellery item table --}}
        <div class="section-heading">Jewellery Particulars</div>
        <table class="items">
            <thead>
                <tr>
                    <th style="width:5%;">S.N.</th>
                    <th style="width:30%;">Particulars</th>
                    <th style="width:8%;">HSN</th>
                    <th style="width:6%;">Qty</th>
                    <th style="width:9%;">Purity</th>
                    <th style="width:11%;">Gross Wt.</th>
                    <th style="width:11%;">Net Wt.</th>
                    <th style="width:20%;">Amount (₹)</th>
                </tr>
            </thead>
            <tbody>
                @forelse($invoice->items as $item)
                    @php
                        $purityValue = '';
                        if ($item->product && $item->product->metalRate) {
                            $karat = $item->product->metalRate->karat ?? '';
                            $purityType = $item->product->metalRate->purity_type ?? '';
                            $purityValue = $karat . ($purityType === 'karat' ? 'KT' : ($purityType ? '%' : ''));
                        } else {
                            $purityValue = $item->purity ?? '';
                        }
                        $goldAmt =
                            (($item->gold_amount ?? 0) > 0
                                ? $item->gold_amount
                                : ($item->net_weight ?? 0) * ($item->metal_rate ?? 0)) +
                            (float) ($item->wastage_amount ?? 0);
                    @endphp
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>
                            <div class="item-name">{{ $item->item_name }}</div>
                            <div class="muted" style="margin-top:3px;">Gold Rate:
                                ₹{{ number_format((float) ($item->metal_rate ?? 0), 2) }} / g</div>
                            @if (($item->wastage_amount ?? 0) > 0)
                                <div class="muted">Wastage: ₹{{ number_format((float) $item->wastage_amount, 2) }}
                                </div>
                            @endif
                        </td>
                        <td class="text-center">{{ $item->hsn_code }}</td>
                        <td class="text-center">{{ $item->quantity }}</td>
                        <td class="text-center">{{ $purityValue }}</td>
                        <td class="text-right">{{ number_format((float) $item->gross_weight, 3) }}</td>
                        <td class="text-right">{{ number_format((float) $item->net_weight, 3) }}</td>
                        <td class="text-right">{{ number_format((float) $goldAmt, 2) }}</td>
                    </tr>

                    @if ($item->diamonds && $item->diamonds->count())
                        @foreach ($item->diamonds as $diamond)
                            <tr class="sub-row">
                                <td></td>
                                <td colspan="6" class="sub-label">Diamond:
                                    {{ $diamond->clarity }}/{{ $diamond->color }} {{ $diamond->cut }} ·
                                    {{ $diamond->pieces }} pcs ·
                                    {{ number_format((float) $diamond->diamond_weight, 3) }} ct · Rate
                                    ₹{{ number_format((float) $diamond->price_per_carat, 2) }} / ct</td>
                                <td class="text-right">{{ number_format((float) $diamond->diamond_final_price, 2) }}
                                </td>
                            </tr>
                        @endforeach
                    @endif

                    @if ($item->stones && $item->stones->count())
                        @foreach ($item->stones as $stone)
                            <tr class="sub-row">
                                <td></td>
                                <td colspan="6" class="sub-label">Stone: {{ $stone->stone_name }} ·
                                    {{ $stone->pieces }} pcs · {{ number_format((float) $stone->stone_weight, 3) }} wt
                                    · Rate ₹{{ number_format((float) $stone->stone_price, 2) }}</td>
                                <td class="text-right">{{ number_format((float) $stone->stone_final_price, 2) }}</td>
                            </tr>
                        @endforeach
                    @endif

                    @if ($item->packets && $item->packets->count())
                        @foreach ($item->packets as $packet)
                            <tr class="sub-row">
                                <td></td>
                                <td colspan="6" class="sub-label">{{ $packet->stone ?: 'Packet' }}
                                    [{{ $packet->packet_no }}] · {{ $packet->pcs }} pcs ·
                                    {{ number_format((float) $packet->weight, 3) }} wt · Rate
                                    ₹{{ number_format((float) $packet->rate, 2) }}</td>
                                <td class="text-right">{{ number_format((float) $packet->amount, 2) }}</td>
                            </tr>
                        @endforeach
                    @endif

                    @if (($item->making_final_amount ?? 0) > 0 || ($item->making_charges ?? 0) > 0)
                        <tr class="sub-row">
                            <td></td>
                            <td colspan="6" class="sub-label">Making Charges (Final)</td>
                            <td class="text-right">{{ number_format((float) $item->making_final_amount, 2) }}</td>
                        </tr>
                    @endif
                    @if (($item->other_charges ?? 0) > 0)
                        <tr class="sub-row">
                            <td></td>
                            <td colspan="6" class="sub-label">Other Charges</td>
                            <td class="text-right">{{ number_format((float) $item->other_charges, 2) }}</td>
                        </tr>
                    @endif
                @empty
                    <tr>
                        <td colspan="8" class="text-center">No invoice items found.</td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" class="text-right">Total</td>
                    <td class="text-right">{{ number_format($totalGrossWt, 3) }}</td>
                    <td class="text-right">{{ number_format($totalNetWt, 3) }}</td>
                    <td class="text-right">{{ number_format($totalAmount, 2) }}</td>
                </tr>
            </tfoot>
        </table>

        {{-- Old metal exchange --}}
        @if ($invoice->exchangeItems && $invoice->exchangeItems->count())
            <div class="section-heading">Old Metal Received / Exchange</div>
            <table class="exchange">
                <thead>
                    <tr>
                        <th style="width:4%;">#</th>
                        <th>Description</th>
                        <th>Metal</th>
                        <th>Gross Wt.</th>
                        <th>Less Wt.</th>
                        <th>Net Wt.</th>
                        <th>Purity</th>
                        <th>Fine Wt.</th>
                        <th>Rate</th>
                        <th>Amount (₹)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($invoice->exchangeItems as $exchange)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $exchange->description }}</td>
                            <td>{{ $exchange->metal }}</td>
                            <td class="text-right">{{ number_format((float) $exchange->gross_weight, 3) }}</td>
                            <td class="text-right">{{ number_format((float) $exchange->less_weight, 3) }}</td>
                            <td class="text-right">{{ number_format((float) $exchange->net_weight, 3) }}</td>
                            <td class="text-center">{{ $exchange->purity }}</td>
                            <td class="text-right">{{ number_format((float) $exchange->fine_weight, 3) }}</td>
                            <td class="text-right">{{ number_format((float) $exchange->rate, 2) }}</td>
                            <td class="text-right">{{ number_format((float) $exchange->amount, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        {{-- Old diamond exchange --}}
        @if ($invoice->exchangeDiamonds && $invoice->exchangeDiamonds->count())
            <div class="section-heading">Old Diamonds Received / Exchange</div>
            <table class="exchange">
                <thead>
                    <tr>
                        <th style="width:4%;">#</th>
                        <th>Description</th>
                        <th>Clarity</th>
                        <th>Cut</th>
                        <th>Color</th>
                        <th>Pieces</th>
                        <th>Weight (ct)</th>
                        <th>Rate / Carat</th>
                        <th>Amount (₹)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($invoice->exchangeDiamonds as $diamond)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $diamond->description }}</td>
                            <td>{{ $diamond->clarity }}</td>
                            <td>{{ $diamond->cut }}</td>
                            <td>{{ $diamond->color }}</td>
                            <td class="text-center">{{ $diamond->pieces }}</td>
                            <td class="text-right">{{ number_format((float) $diamond->weight, 3) }}</td>
                            <td class="text-right">{{ number_format((float) $diamond->rate, 2) }}</td>
                            <td class="text-right">{{ number_format((float) $diamond->amount, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        {{-- Summary, GST and payments --}}
        <table class="plain-table summary-layout">
            <tr>
                <td class="summary-left">
                    <div class="footer-heading">Payment Status: {{ strtoupper($status) }}</div>
                    @if ($terms)
                        <div class="footer-heading" style="margin-top:7px;">{{ $termsLabel }}</div>
                        <ol class="terms">
                            @foreach ($terms as $term)
                                <li>{{ $term }}</li>
                            @endforeach
                        </ol>
                    @endif
                </td>
                <td class="summary-right">
                    <table class="totals">
                        <tr>
                            <td>Taxable Value</td>
                            <td>₹{{ number_format($taxableAmount, 2) }}</td>
                        </tr>
                        @if ($igstAmount > 0)
                            <tr>
                                <td>IGST ({{ number_format($cgstPercent + $sgstPercent, 2) }}%)</td>
                                <td>₹{{ number_format($igstAmount, 2) }}</td>
                            </tr>
                        @else
                            @if ($cgstAmount > 0)
                                <tr>
                                    <td>CGST ({{ number_format($cgstPercent, 2) }}%)</td>
                                    <td>₹{{ number_format($cgstAmount, 2) }}</td>
                                </tr>
                            @endif
                            @if ($sgstAmount > 0)
                                <tr>
                                    <td>SGST ({{ number_format($sgstPercent, 2) }}%)</td>
                                    <td>₹{{ number_format($sgstAmount, 2) }}</td>
                                </tr>
                            @endif
                        @endif
                        @if ($discountAmount > 0)
                            <tr>
                                <td>Discount ({{ number_format($discountPercent, 2) }}%)</td>
                                <td>- ₹{{ number_format($discountAmount, 2) }}</td>
                            </tr>
                        @endif
                        @if ($roundOff != 0)
                            <tr>
                                <td>Round Off</td>
                                <td>{{ $roundOff >= 0 ? '+' : '-' }} ₹{{ number_format(abs($roundOff), 2) }}</td>
                            </tr>
                        @endif
                        <tr class="grand-total">
                            <td>Grand Total</td>
                            <td>₹{{ number_format($finalAmount, 2) }}</td>
                        </tr>
                        @if ($totalExchangeAmt > 0)
                            <tr>
                                <td>Exchange Amount</td>
                                <td>₹{{ number_format($totalExchangeAmt, 2) }}</td>
                            </tr>
                        @endif
                        @if ($advSettled > 0)
                            <tr>
                                <td>{{ $advSettledLabel }}</td>
                                <td>₹{{ number_format($advSettled, 2) }}</td>
                            </tr>
                        @endif
                        @if ($udharSettled > 0)
                            <tr>
                                <td>{{ $udharSettledLabel }}</td>
                                <td>₹{{ number_format($udharSettled, 2) }}</td>
                            </tr>
                        @endif
                        @if ($cash > 0)
                            <tr>
                                <td>{{ $cashReceivedLabel }}</td>
                                <td>₹{{ number_format($cash, 2) }}</td>
                            </tr>
                        @endif
                        @if ($online > 0)
                            <tr>
                                <td>{{ $onlineReceivedLabel }}</td>
                                <td>₹{{ number_format($online, 2) }}</td>
                            </tr>
                        @endif
                        @if ($bankReceived > 0)
                            <tr>
                                <td>{{ $bankReceivedLabel }}</td>
                                <td>₹{{ number_format($bankReceived, 2) }}</td>
                            </tr>
                        @endif
                        @if ($card > 0)
                            <tr>
                                <td>{{ $cardReceivedLabel }}</td>
                                <td>₹{{ number_format($card, 2) }}</td>
                            </tr>
                        @endif
                        <tr>
                            <td>{{ $totalReceivedLabel ?: 'Total Received' }}</td>
                            <td>₹{{ number_format($totalReceived, 2) }}</td>
                        </tr>
                        <tr class="balance">
                            <td>{{ $balanceAmount > 0 ? ($balanceDueLabel ?: 'Balance Due') : 'Change Return' }}</td>
                            <td>₹{{ number_format(abs($balanceAmount), 2) }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <div class="amount-words">
            <strong>Amount Chargeable (in words):</strong>
            {{ \App\Helpers\NumberHelper::convertToWords((int) round(abs($finalAmount))) }}.
        </div>

        {{-- Bank/signature footer. No border is placed around logo, QR, invoice number or signature image. --}}
        <table class="plain-table footer-table">
            <tr>
                <td class="footer-left">
                    @if ($bankName || $bankAccountName || $bankAccountNo || $bankBranch || $bankIfsc)
                        <div class="footer-heading">Bank Details</div>
                        <table class="plain-table bank-table">
                            @if ($bankName)
                                <tr>
                                    <td><strong>Bank:</strong></td>
                                    <td>{{ $bankName }}</td>
                                </tr>
                            @endif
                            @if ($bankAccountName)
                                <tr>
                                    <td><strong>Account Name:</strong></td>
                                    <td>{{ $bankAccountName }}</td>
                                </tr>
                            @endif
                            @if ($bankAccountNo)
                                <tr>
                                    <td><strong>A/C No.:</strong></td>
                                    <td>{{ $bankAccountNo }}</td>
                                </tr>
                            @endif
                            @if ($bankBranch)
                                <tr>
                                    <td><strong>Branch:</strong></td>
                                    <td>{{ $bankBranch }}</td>
                                </tr>
                            @endif
                            @if ($bankIfsc)
                                <tr>
                                    <td><strong>IFSC:</strong></td>
                                    <td>{{ $bankIfsc }}</td>
                                </tr>
                            @endif
                        </table>
                    @endif
                    <div class="receiver">
                        <div class="receiver-line"></div>
                        Receiver's Signature
                    </div>
                </td>
                <td class="footer-right">
                    @if ($signatureSource)
                        <img class="signature-image" src="{{ $signatureSource }}" alt="Authorized Signature">
                    @endif
                    <div class="signature-line"></div>
                    <strong>For {{ $companyName ?: 'Authorized Seller' }}</strong><br>
                    Authorized Signatory
                </td>
            </tr>
        </table>

        <div class="thank-you">Thank you for your purchase!</div>
        <div class="generated-note">This is a computer generated invoice.</div>
    </div>
</body>

</html>
