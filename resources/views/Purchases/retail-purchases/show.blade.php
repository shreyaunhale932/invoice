@extends('layout.mainlayout')
@section('content')
    @php
        use App\Helpers\NumberHelper;
    @endphp
    <style>
        /* =========================
           PRINT FIX – ADD ONLY
           ========================= */
        .container,
        .container-fluid {
            max-width: none !important;
            width: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        .invoice-wrapper {
            max-width: none !important;
            width: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        @media print {
            .company-details {
                background: var(--color-gradient, linear-gradient(320deg, #DBECFF 0%, #DDCEFF 100%)) !important;
                border-radius: 14px 77px 14px 14px !important;
            }
        }

        /* =====================================================
           PRINT CSS – ULTRA COMPACT (ALL INVOICES)
           ===================================================== */
        @media print {

            /* PAGE RESET */
            html,
            body {
                margin: 0 !important;
                padding: 0 !important;
                width: 100% !important;
                height: 100% !important;
                font-size: 9.5px !important;
                line-height: 1.2 !important;
                font-family: Arial, Helvetica, sans-serif !important;
            }

            /* Hide everything except invoice */
            body * {
                visibility: hidden !important;
            }

            .download_section,
            .download_section * {
                visibility: visible !important;
            }

            /* CONTAINER / WRAPPER */
            .container,
            .container-fluid,
            .invoice-one,
            .invoice-wrapper {
                max-width: 100% !important;
                width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            .download_section {
                position: absolute;
                top: 0;
                left: 0;
                width: 210mm !important;
                min-height: 297mm;
                padding: 4mm 5mm !important;
                background: #fff !important;
            }

            /* HEADINGS */
            .add-details {
                font-size: 9.5px !important;
            }

            .invoice-table-footer {
                padding: 0px !important;
            }

            h4 {
                font-size: 15px !important;
                margin: 0 0 3px !important;
            }

            h5 {
                font-size: 11px !important;
                margin: 0 0 4px !important;
            }

            h6 {
                font-size: 9.5px !important;
                margin: 0 0 2px !important;
            }

            span {
                font-size: 9.5px !important;
            }

            p {
                margin: 0 0 3px !important;
                font-size: 9px !important;
            }

            /* HEADER COMPRESSION */
            .invoice-header {
                margin-bottom: 6px !important;
                padding-bottom: 4px !important;
            }

            .invoice-one .inv-content .invoice-header .inv-header-left {
                width: 60% !important;
            }

            .company-details {
                padding: 6px !important;
                border-radius: 10px 55px 10px 10px !important;
            }

            .gst-details {
                padding: 8px 12px !important;
                margin: 0 !important;
                color: #fff !important;
            }

            /* LOGO */
            .invoice-one .inv-header-right a img {
                max-width: 140px !important;
                margin-bottom: 4px !important;
            }

            /* CUSTOMER / SUPPLIER INFO */
            .patient-infos {
                margin-bottom: 6px !important;
            }

            .patient-detailed {
                padding: 4px !important;
            }

            .bill-add {
                font-size: 9px !important;
                margin-bottom: 1px !important;
            }

            .customer-name,
            .payment-status {
                font-size: 9px !important;
            }

            /* TABLE COMPRESSION */
            table {
                width: 100% !important;
                table-layout: fixed !important;
                border-collapse: collapse !important;
            }

            thead {
                display: table-header-group;
            }

            th {
                font-size: 10px !important;
                padding: 3px !important;
            }

            td {
                font-size: 9.5px !important;
                padding: 2px 3px !important;
                word-break: break-word;
            }

            tr {
                page-break-inside: avoid;
            }

            .invoice-one .invoice-table table tr td {
                height: auto !important;
            }

            .invoice-one .invoice-table {
                margin: 0 !important;
                padding: 0 0 0px !important;
            }

            .invoice-one .inv-content {
                border: 1px solid #BDBDBD;
                margin: 0 !important;
                padding: 8px !important;
            }

            /* TOTALS / PAYMENT BLOCKS */
            .invoice-table-footer {
                margin-top: 4px !important;
                padding-top: 4px !important;
                page-break-inside: avoid;
            }

            .invoice-table-footer table td {
                font-size: 10px !important;
                padding: 2px 3px !important;
            }

            .totalamount-footer td {
                font-size: 10px !important;
            }

            /* QR + TERMS */
            .terms-condition ol {
                padding-left: 12px !important;
                margin: 0 !important;
            }

            .terms-condition li {
                font-size: 8.5px !important;
                line-height: 1.2 !important;
            }

            /* FINAL MESSAGE */
            .thanks-msg {
                font-size: 9px !important;
                margin-top: 6px !important;
                text-align: center;
            }

            /* HIDE ACTION BUTTONS */
            .file-link {
                display: none !important;
            }

            /* PRESERVE COLORS */
            * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            /* PAGE SETUP */
            @page {
                size: A4;
                margin: 0;
            }
        }

        .packet-row td {
            background: #f9f9f9;
            padding-top: 2px !important;
            padding-bottom: 4px !important;
            border-top: none !important;
        }

        .packet-row td div {
            margin: 0 !important;
            line-height: 1.2;
        }

        .invoice-table table {
            border-collapse: collapse !important;
            width: 100% !important;
        }

        .invoice-table table thead tr {
            background-color: #F2F2F2 !important;
            color: #333333 !important;
        }

        .invoice-table table thead th {
            background-color: #F2F2F2 !important;
            color: #333333 !important;
            border: 1px solid #cccccc !important;
            text-align: center;
            vertical-align: middle;
            font-size: 10px !important;
            padding: 4px !important;
        }

        .invoice-table table tbody td {
            border: 1px solid #e0e0e0 !important;
            font-size: 10px !important;
            padding: 4px !important;
            vertical-align: middle;
        }

        /* Total row styling */
        .invoice-table table tfoot tr.total-row td {
            background-color: #F2F2F2 !important;
            color: #333333 !important;
            font-weight: bold;
            border: 1px solid #cccccc !important;
            padding: 4px !important;
            text-align: center;
            font-size: 10px !important;
        }

        .invoice-table table tfoot tr.total-row td.text-end {
            text-align: right !important;
        }
    </style>

    <div class="container">
        <div class="invoice-wrapper download_section">
            <div class="inv-content">

                @php
                    /* =====================================================
                     | HEADER / COMPANY TEXT VALUES
                     ===================================================== */
                    $invoiceTitle = 'PURCHASE INVOICE';

                    $companyName =
                        $templateSettings['text_elements.company_name']->value ??
                        ($templateSettings['text_elements.company_name']->default_value ?? ($business->company_name ?? ''));

                    $companyAddress =
                        $templateSettings['text_elements.company_address']->value ??
                        ($templateSettings['text_elements.company_address']->default_value ?? ($business->address ?? ''));

                    /* =====================================================
                     | HEADER VISIBILITY FLAGS
                     ===================================================== */
                    $invoiceTitleVisible = true;
                    $companyNameVisible = true;
                    $companyAddressVisible = true;

                    $logoLightVisible = $templateSettings['visual_elements.logo_light']->is_visible ?? true;
                    $logoDarkVisible = $templateSettings['visual_elements.logo_dark']->is_visible ?? true;

                    /* =====================================================
                     | LOGOS
                     ===================================================== */
                    $logoLight =
                        $templateSettings['visual_elements.logo_light']->value ??
                        ($templateSettings['visual_elements.logo_light']->default_value ?? '/assets/img/logo2.png');

                    $logoDark =
                        $templateSettings['visual_elements.logo_dark']->value ??
                        ($templateSettings['visual_elements.logo_dark']->default_value ?? '/assets/img/logo2-white.png');

                    /* =====================================================
                     | SUPPLIER INFO VALUES
                     ===================================================== */
                    $supplier = $purchase->supplier;
                    $supplierName = $supplier->name ?? 'Direct Supplier / Cash';
                    $shopName = $supplier->shop_name ?? '';
                    $supplierGstin = $supplier->gst_no ?? '';
                    $supplierPhone = $supplier->phone ?? '';
                    $supplierAddress = trim(($supplier->address ?? '') . ($supplier->city ? ', ' . $supplier->city : ''));
                @endphp

                {{-- ================= HEADER ================= --}}
                @if ($invoiceTitleVisible)
                    <div class="invoice-title-centered" style="width: 100% !important; text-align: center !important;">
                        <h4 style="margin: 0 !important; font-size: 24px !important; font-weight: bold !important; color: #6e46e5 !important; text-align: center !important;">{{ $invoiceTitle }}</h4>
                    </div>
                @endif

                <div class="invoice-header">
                    {{-- LEFT: COMPANY DETAILS --}}
                    @if ($companyNameVisible || $companyAddressVisible)
                        <div class="inv-header-left">
                            <div class="company-details">
                                <div class="gst-details">
                                    @if ($companyNameVisible && $companyName)
                                        <h6 style="font-size: 18px !important; font-weight: bold !important; margin-bottom: 4px !important; color: #333 !important;">{{ $companyName }}</h6>
                                    @endif
                                    @if ($companyAddressVisible && $companyAddress)
                                        <span>{!! nl2br(e($companyAddress)) !!}</span>
                                    @endif
                                </div>
                                <div class="address-bg"></div>
                            </div>
                        </div>
                    @endif

                    {{-- RIGHT: LOGO & INVOICE META --}}
                    <div class="inv-header-right">
                        @if ($logoLightVisible || $logoDarkVisible)
                            <a href="javascript:void(0)">
                                @if ($logoLightVisible)
                                    <img class="logo-lightmode" src="{{ asset($logoLight) }}" alt="Logo">
                                @endif
                                @if ($logoDarkVisible)
                                    <img class="logo-darkmode" src="{{ asset($logoDark) }}" alt="Logo">
                                @endif
                            </a>
                        @endif

                        <h6>Purchase No : <span>#{{ $purchase->purchase_no }}</span></h6>
                        <h6>Purchase Date : <span>{{ \Carbon\Carbon::parse($purchase->purchase_date)->format('d-m-Y') }}</span></h6>
                        @if ($purchase->reference_no)
                            <h6>Supplier Ref : <span>{{ $purchase->reference_no }}</span></h6>
                        @endif
                        @if ($purchase->due_date)
                            <h6>Due Date : <span>{{ \Carbon\Carbon::parse($purchase->due_date)->format('d-m-Y') }}</span></h6>
                        @endif
                    </div>
                </div>

                {{-- ================= SUPPLIER / VENDOR INFO ================= --}}
                <div class="patient-infos">
                    <div class="row">
                        {{-- SUPPLIER DETAILS --}}
                        <div class="col-sm-3">
                            <div class="patient-detailed">
                                <div class="bill-add">Supplier Details :</div>
                                <div class="customer-name">
                                    <strong>{{ $supplierName }}</strong>
                                    @if ($shopName)
                                        <p class="mb-0"><span>Shop: {{ $shopName }}</span></p>
                                    @endif
                                    @if (!empty($supplierGstin))
                                        <p class="mb-0"><span>GSTIN : {{ $supplierGstin }}</span></p>
                                    @endif
                                    @if (!empty($supplierPhone))
                                        <p class="mb-0"><span>Phone : {{ $supplierPhone }}</span></p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- PAYMENT STATUS --}}
                        <div class="col-sm-3">
                            <div class="patient-detailed">
                                <div class="bill-add">Payment Status :</div>
                                <div class="payment-status">
                                    <p>
                                        @if($purchase->payment_status === 'paid')
                                            <span class="badge bg-success-light" style="font-weight: bold; text-transform: uppercase;">PAID</span>
                                        @elseif($purchase->payment_status === 'partial')
                                            <span class="badge bg-warning-light text-warning" style="font-weight: bold; text-transform: uppercase;">PARTIAL</span>
                                        @else
                                            <span class="badge bg-danger-light text-danger" style="font-weight: bold; text-transform: uppercase;">UNPAID</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- SUPPLIER ADDRESS --}}
                        <div class="col-sm-3">
                            <div class="patient-detailed">
                                <div class="bill-add">Address :</div>
                                <div class="add-details">
                                    {{ $supplierAddress ?: 'N/A' }}
                                </div>
                            </div>
                        </div>

                        {{-- PAYMENT METHOD --}}
                        <div class="col-sm-3">
                            <div class="patient-detailed">
                                <div class="bill-add">Payment Method :</div>
                                <div class="add-details fw-bold text-uppercase">
                                    {{ $purchase->payment_method ?? 'CASH' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ================= ITEMS TABLE ================= --}}
                @php
                    $totalGrossWt = 0;
                    $totalNetWt = 0;
                    $totalMetalAmount = 0;
                    $totalStoneWt = 0;
                    $totalDiamondPcs = 0;
                    $totalDiamondCt = 0;
                    $totalMaking = 0;
                    $totalAmount = 0;

                    foreach ($purchase->items as $item) {
                        $totalGrossWt += $item->gross_weight;
                        $totalNetWt += $item->net_weight;

                        $metalAmt = ($item->metal_amount > 0) ? $item->metal_amount : ($item->net_weight * $item->purchase_rate);
                        $totalMetalAmount += $metalAmt;

                        $itemStoneWt = ($item->stone_weight + $item->diamond_weight + $item->packet_weight);
                        $totalStoneWt += $itemStoneWt;

                        if ($item->packetItems && $item->packetItems->count() > 0) {
                            foreach ($item->packetItems as $pkt) {
                                $totalDiamondPcs += $pkt->pcs;
                                $totalDiamondCt += $pkt->weight;
                            }
                        }

                        $totalMaking += $item->making_final_amount;
                        $totalAmount += $item->total_amount;
                    }
                @endphp

                <div class="invoice-table">
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr class="ecommercetable">
                                    <th rowspan="2" style="vertical-align: middle; text-align: center;">SL No.</th>
                                    <th rowspan="2" style="vertical-align: middle; text-align: center;">Item Desc</th>
                                    <th rowspan="2" style="vertical-align: middle; text-align: center;">Pcs</th>
                                    <th rowspan="2" style="vertical-align: middle; text-align: center;">HSN</th>
                                    <th rowspan="2" style="vertical-align: middle; text-align: center;">Purity</th>
                                    <th rowspan="2" style="vertical-align: middle; text-align: center;">Gr. wt. (Gm.)</th>
                                    <th rowspan="2" style="vertical-align: middle; text-align: center;">Net. wt. (Gm.)</th>
                                    <th rowspan="2" style="vertical-align: middle; text-align: center;">Wastage %</th>
                                    <th rowspan="2" style="vertical-align: middle; text-align: center;">Gold Rate (Gm)</th>
                                    <th rowspan="2" style="vertical-align: middle; text-align: center;">Stone/Oth. wt. (Gm)</th>
                                    <th colspan="3" style="text-align: center;">Diamond/Stone</th>
                                    <th rowspan="2" style="vertical-align: middle; text-align: center;">Making</th>
                                    <th rowspan="2" style="vertical-align: middle; text-align: center; text-align: right;">Amount</th>
                                </tr>
                                <tr class="ecommercetable">
                                    <th style="text-align: center;">Pcs</th>
                                    <th style="text-align: center;">Ct</th>
                                    <th style="text-align: center;">Rate</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($purchase->items as $item)
                                    {{-- MAIN PRODUCT ROW --}}
                                    <tr>
                                        <td style="text-align: center;">{{ $loop->iteration }}</td>
                                        <td style="font-weight: bold;">
                                            {{ strtoupper($item->item_name) }}
                                            @if($item->pre_code || $item->post_code)
                                                <br><small class="text-muted">Code: {{ $item->pre_code }}-{{ $item->post_code }}</small>
                                            @endif
                                        </td>
                                        <td style="text-align: center;">{{ $item->quantity }} {{ $item->unit ?? '' }}</td>
                                        <td style="text-align: center;">{{ $item->hsn_code ?? optional($item->category)->hsn_code ?? '-' }}</td>
                                        <td style="text-align: center;">
                                            {{ optional($item->purity)->purity_name ?? $item->purity_name ?? '-' }}
                                        </td>
                                        <td style="text-align: right;">{{ number_format($item->gross_weight, 3) }}</td>
                                        <td style="text-align: right;">{{ number_format($item->net_weight, 3) }}</td>
                                        <td style="text-align: right;">{{ $item->wastage_percent ? number_format($item->wastage_percent, 2).'%' : '-' }}</td>
                                        <td style="text-align: right;">{{ number_format($item->purchase_rate, 2) }}</td>
                                        <td style="text-align: right;">{{ number_format($item->stone_weight + $item->diamond_weight + $item->packet_weight, 3) }}</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td style="text-align: right;">{{ number_format($item->making_final_amount, 2) }}</td>
                                        <td style="text-align: right;">
                                            @php
                                                $metalAmt = ($item->metal_amount > 0) ? $item->metal_amount : ($item->net_weight * $item->purchase_rate);
                                            @endphp
                                            {{ number_format($metalAmt, 2) }}
                                        </td>
                                    </tr>

                                    {{-- PACKET / DIAMOND / STONE DETAILS ROWS --}}
                                    @if ($item->packetItems && $item->packetItems->count() > 0)
                                        @foreach ($item->packetItems as $pkt)
                                            <tr>
                                                <td></td>
                                                <td style="padding-left: 20px;">
                                                    {{ $pkt->stone ?: 'Packet' }} [ {{ $pkt->packet_no }} ]
                                                    @if($pkt->packet_type || $pkt->clarity || $pkt->color)
                                                        - {{ $pkt->packet_type }} {{ $pkt->clarity ? '('.$pkt->clarity.'/'.$pkt->color.')' : '' }}
                                                    @endif
                                                </td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td style="text-align: center;">{{ $pkt->pcs ?: '' }}</td>
                                                <td style="text-align: right;">{{ number_format($pkt->weight, 3) }}</td>
                                                <td style="text-align: right;">{{ number_format($pkt->rate, 2) }}</td>
                                                <td></td>
                                                <td style="text-align: right;">{{ number_format($pkt->amount, 2) }}</td>
                                            </tr>
                                        @endforeach
                                    @endif

                                    {{-- MAKING CHARGES ROW IF NEEDED SEPARATELY --}}
                                    @if ($item->making_final_amount > 0 && $item->making_price > 0)
                                        <tr>
                                            <td></td>
                                            <td style="padding-left: 20px;">Making Charges:</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td style="text-align: right;">{{ number_format($item->making_price, 2) }}</td>
                                            <td style="text-align: right;">{{ number_format($item->making_final_amount, 2) }}</td>
                                            <td style="text-align: right;">{{ number_format($item->making_final_amount, 2) }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>

                            <tfoot>
                                <tr class="total-row">
                                    <td></td>
                                    <td style="text-align: left;">Total</td>
                                    <td style="text-align: center;">-</td>
                                    <td></td>
                                    <td></td>
                                    <td style="text-align: right;">{{ number_format($totalGrossWt, 3) }}</td>
                                    <td style="text-align: right;">{{ number_format($totalNetWt, 3) }}</td>
                                    <td></td>
                                    <td class="text-end" style="text-align: right;">₹{{ number_format($totalMetalAmount, 2) }}</td>
                                    <td style="text-align: right;">{{ number_format($totalStoneWt, 3) }}</td>
                                    <td style="text-align: center;">{{ $totalDiamondPcs > 0 ? $totalDiamondPcs : '' }}</td>
                                    <td style="text-align: right;">{{ $totalDiamondCt > 0 ? number_format($totalDiamondCt, 3) : '' }}</td>
                                    <td></td>
                                    <td class="text-end" style="text-align: right;">₹{{ number_format($totalMaking, 2) }}</td>
                                    <td class="text-end" style="text-align: right;">₹{{ number_format($purchase->subtotal, 2) }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                {{-- ================= SUMMARY & FOOTER ================= --}}
                @php
                    $taxableAmount = $purchase->taxable_amount ?? $purchase->subtotal;
                    $cgstPercent = $purchase->cgst_percent ?? 0;
                    $sgstPercent = $purchase->sgst_percent ?? 0;
                    $igstPercent = $purchase->igst_percent ?? 0;

                    $cgstAmount = $purchase->cgst_amount ?? 0;
                    $sgstAmount = $purchase->sgst_amount ?? 0;
                    $igstAmount = $purchase->igst_amount ?? 0;

                    $discountPercent = $purchase->discount_percent ?? 0;
                    $discountAmount = $purchase->discount_amount ?? 0;
                    $otherCharges = $purchase->other_charges ?? 0;
                    $roundOff = $purchase->round_off ?? 0;

                    $grandTotal = $purchase->grand_total;
                    $paidAmount = $purchase->paid_amount ?? 0;
                    $balanceDue = max(0, $grandTotal - $paidAmount);
                @endphp

                <div class="invoice-table-footer">
                    <div class="table-footer-left notes" style="display: flex; flex-direction: column; align-items: flex-start; justify-content: flex-start;">
                        @if ($purchase->gold_payment_grams > 0 || $purchase->gold_payment_amount > 0)
                            <div class="terms-condition mt-3 p-2 rounded" style="background: rgba(255, 243, 205, 0.7); border: 1px solid #ffeba7; max-width: 450px; text-align: left;">
                                <span style="font-weight: bold; font-size: 11px; display: block; margin-bottom: 4px; color: #856404;">
                                    Gold / Metal Payment Summary:
                                </span>
                                <table style="width: 100%; font-size: 9.5px; border-collapse: collapse;">
                                    <tr>
                                        <td>Metal Given:</td>
                                        <td style="text-align: right; font-weight: bold;">{{ number_format($purchase->gold_payment_grams, 3) }} g ({{ number_format($purchase->gold_payment_purity, 2) }}%)</td>
                                    </tr>
                                    <tr>
                                        <td>Fine Wt Given:</td>
                                        <td style="text-align: right; font-weight: bold;">{{ number_format($purchase->gold_payment_fine_wt, 3) }} g</td>
                                    </tr>
                                    <tr>
                                        <td>Metal Rate Applied:</td>
                                        <td style="text-align: right;">₹{{ number_format($purchase->gold_payment_rate, 2) }} / g</td>
                                    </tr>
                                    <tr style="border-top: 1px solid #e0c975;">
                                        <td style="font-weight: bold;">Gold Value Settled:</td>
                                        <td style="text-align: right; font-weight: bold; color: #28a745;">₹{{ number_format($purchase->gold_payment_amount, 2) }}</td>
                                    </tr>
                                    @if($purchase->remaining_metal_wt > 0)
                                        <tr>
                                            <td style="font-weight: bold; color: #dc3545;">Remaining Metal Wt:</td>
                                            <td style="text-align: right; font-weight: bold; color: #dc3545;">{{ number_format($purchase->remaining_metal_wt, 3) }} g</td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                        @endif

                        @if ($purchase->notes)
                            <div class="terms-condition mt-3" style="max-width: 450px; text-align: left;">
                                <span style="font-weight: bold; font-size: 11px; display: block; margin-bottom: 5px;">Purchase Notes:</span>
                                <p style="font-size: 10px; margin: 0;">{{ $purchase->notes }}</p>
                            </div>
                        @endif

                        <div class="terms-condition mt-3" style="max-width: 450px; text-align: left;">
                            <span style="font-weight: bold; font-size: 11px; display: block; margin-bottom: 5px;">Terms & Conditions:</span>
                            <ol style="padding-left: 15px; margin: 0; font-size: 10px; line-height: 1.4;">
                                <li>All items received subject to inspection and quality check.</li>
                                <li>Payment as per agreed terms and credit period.</li>
                                <li>Disputes subject to local jurisdiction only.</li>
                            </ol>
                        </div>
                    </div>

                    <div class="table-footer-right text-end">
                        <table>
                            <tbody>
                                <tr>
                                    <td>Subtotal</td>
                                    <td>₹{{ number_format($purchase->subtotal, 2) }}</td>
                                </tr>

                                @if ($discountAmount > 0)
                                    <tr>
                                        <td>Discount {{ $discountPercent > 0 ? '('.$discountPercent.'%)' : '' }}</td>
                                        <td class="text-danger">-₹{{ number_format($discountAmount, 2) }}</td>
                                    </tr>
                                @endif

                                <tr>
                                    <td>Taxable Amount</td>
                                    <td>₹{{ number_format($taxableAmount, 2) }}</td>
                                </tr>

                                @if ($igstAmount > 0)
                                    <tr>
                                        <td>IGST {{ $igstPercent }}%</td>
                                        <td>+₹{{ number_format($igstAmount, 2) }}</td>
                                    </tr>
                                @else
                                    @if ($cgstAmount > 0)
                                        <tr>
                                            <td>CGST {{ $cgstPercent }}%</td>
                                            <td>+₹{{ number_format($cgstAmount, 2) }}</td>
                                        </tr>
                                    @endif
                                    @if ($sgstAmount > 0)
                                        <tr>
                                            <td>SGST {{ $sgstPercent }}%</td>
                                            <td>+₹{{ number_format($sgstAmount, 2) }}</td>
                                        </tr>
                                    @endif
                                @endif

                                @if ($otherCharges > 0)
                                    <tr>
                                        <td>Other Charges</td>
                                        <td>+₹{{ number_format($otherCharges, 2) }}</td>
                                    </tr>
                                @endif

                                @if ($roundOff != 0)
                                    <tr>
                                        <td>Round Off</td>
                                        <td>{{ $roundOff >= 0 ? '+' : '' }}₹{{ number_format($roundOff, 2) }}</td>
                                    </tr>
                                @endif

                                <tr class="total-tr">
                                    <td><strong>Grand Total</strong></td>
                                    <td><strong>₹{{ number_format($grandTotal, 2) }}</strong></td>
                                </tr>

                                @if ($purchase->gold_payment_amount > 0)
                                    <tr>
                                        <td><strong>Gold Payment Settled</strong></td>
                                        <td><strong class="text-success">₹{{ number_format($purchase->gold_payment_amount, 2) }}</strong></td>
                                    </tr>
                                @endif

                                <tr>
                                    <td><strong>Amount Paid</strong></td>
                                    <td><strong class="text-success">₹{{ number_format($paidAmount, 2) }}</strong></td>
                                </tr>

                                <tr>
                                    <td><strong>Balance Due</strong></td>
                                    <td><strong class="{{ $balanceDue > 0 ? 'text-danger' : 'text-success' }}">₹{{ number_format($balanceDue, 2) }}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- TOTAL IN WORDS --}}
                <div class="total-amountdetails" style="margin-top: 15px;">
                    <p><strong>Total amount (in words): </strong><span>
                        {{ NumberHelper::convertToWords((int) round(abs($grandTotal))) }}.</span></p>
                </div>

                {{-- SIGNATURES --}}
                @php
                    $signatureImage =
                        $templateSettings['visual_elements.signature_image']->value ??
                        ($templateSettings['visual_elements.signature_image']->default_value ?? '/assets/img/signature.png');
                    $signatureVisible = $templateSettings['visual_elements.signature_image']->is_visible ?? true;
                    $signatureLabel = $templateSettings['visual_elements.signature_image']->label ?? 'Authorized Signature';
                @endphp

                <div class="bank-details" style="margin-top: 25px; margin-bottom: 10px; width: 100%;">
                    <div class="row align-items-end" style="display: flex !important; flex-direction: row !important; justify-content: space-between !important; align-items: flex-end !important; width: 100% !important; margin: 0 !important;">
                        {{-- SUPPLIER / VENDOR SIGNATURE --}}
                        <div style="width: 50% !important; float: left !important; text-align: left !important;">
                            <div class="customer-signature-box" style="padding-left: 20px;">
                                <div style="height: 35px;"></div>
                                <div style="border-top: 1px solid #ccc; width: 180px; margin-bottom: 5px;"></div>
                                <div style="font-weight: bold; font-size: 11px; color: #555;">Supplier / Vendor Signature</div>
                            </div>
                        </div>

                        {{-- AUTHORIZED SIGNATURE --}}
                        @if ($signatureVisible)
                            <div style="width: 50% !important; float: right !important; text-align: right !important;">
                                <div class="signature-box" style="display: inline-block; text-align: right; padding-right: 20px;">
                                    <img src="{{ asset($signatureImage) }}" alt="Signature" style="max-width: 130px; max-height: 50px;">
                                    <div style="border-top: 1px solid #ccc; width: 180px; margin-top: 5px; margin-bottom: 5px; margin-left: auto;"></div>
                                    <div class="signature-label" style="font-weight: bold; font-size: 11px; color: #555;">{{ $signatureLabel }}</div>
                                </div>
                            </div>
                        @endif
                        <div style="clear: both !important;"></div>
                    </div>
                </div>

                <div class="thanks-msg text-center mt-3">
                    Thank you for your business!
                </div>
                <div class="text-center mt-1">
                    <small style="font-size: 10px;">This is an electronically generated document. Powered by Sirsonite.com</small>
                </div>
            </div>
        </div>

        {{-- ACTION BUTTONS --}}
        <div class="file-link d-flex justify-content-center gap-2 mt-4">
            <a href="{{ route('purchases.index') }}" class="btn btn-outline-secondary">
                <i class="feather-arrow-left me-1"></i> <span>Back to Wholesale Purchases</span>
            </a>
            <a href="{{ route('purchases.edit', $purchase->id) }}" class="btn btn-primary">
                <i class="feather-edit me-1"></i> <span>Edit Purchase</span>
            </a>
            <a href="javascript:void(0)" onclick="printInvoiceSection()" class="print-link btn btn-success text-white">
                <i class="feather-printer me-1"></i> <span>Print Purchase Invoice</span>
            </a>
        </div>
    </div>

    <script>
        function printInvoiceSection() {
            window.print();
        }

        @if(request()->has('auto_print'))
        window.addEventListener('load', function() {
            setTimeout(function() {
                window.print();
            }, 500);
        });

        window.addEventListener('afterprint', function() {
            if (window.parent) {
                window.parent.postMessage('print_completed', '*');
            }
        });
        @endif
    </script>
@endsection
