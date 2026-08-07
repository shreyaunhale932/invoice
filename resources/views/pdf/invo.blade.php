   <?php $page = 'invoice-one-a'; ?>
@extends('layout.mainlayout')
@section('content')
 @php
        use App\Helpers\NumberHelper;
    @endphp
    <style>
        /* =========================
       PRINT FIX – ADD ONLY
       ========================= */

.container {
  width: 100%;
  max-width: 1140px;
  padding-left: 15px;
  padding-right: 15px;
  margin: 0 auto;
}



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

            /* -----------------------------
           PAGE RESET
           ----------------------------- */
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

            /* -----------------------------
           CONTAINER / WRAPPER
           ----------------------------- */
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

            /* -----------------------------
           HEADINGS
           ----------------------------- */
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

            /* -----------------------------
           HEADER COMPRESSION
           ----------------------------- */
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

            /* LOGO – MUCH SMALLER */
            .invoice-one .inv-header-right a img {
                max-width: 140px !important;
                margin-bottom: 4px !important;
            }

            /* -----------------------------
           CUSTOMER INFO
           ----------------------------- */
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

            /* -----------------------------
           TABLE COMPRESSION
           ----------------------------- */
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

            /* -----------------------------
           TOTALS / PAYMENT BLOCKS
           ----------------------------- */
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

            /* -----------------------------
           QR + TERMS
           ----------------------------- */
            .qr img {
                max-width: 70px !important;
            }

            .scan-details {
                font-size: 8.5px !important;
                margin-top: 2px !important;
            }

            .terms-condition ol {
                padding-left: 12px !important;
                margin: 0 !important;
            }

            .terms-condition li {
                font-size: 8.5px !important;
                line-height: 1.2 !important;
            }

            /* -----------------------------
           FINAL MESSAGE
           ----------------------------- */
            .thanks-msg {
                font-size: 9px !important;
                margin-top: 6px !important;
                text-align: center;
            }

            /* -----------------------------
           HIDE ACTION BUTTONS
           ----------------------------- */
            .file-link {
                display: none !important;
            }

            /* -----------------------------
           PRESERVE COLORS
           ----------------------------- */
            * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            .invoice-table-footer .notes img {
                max-width: 70px !important;
            }

            /* -----------------------------
           PAGE SETUP
           ----------------------------- */
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


    {{-- <div class="main-wrapper invoice-one" style="visibility: visible;"> --}}
        <div class="container">
            <div class="invoice-wrapper download_section">
                <div class="inv-content">
                    <span class="line"></span>
                    @php
                        /* =====================================================
                 | HEADER / COMPANY TEXT VALUES
                 ===================================================== */
                        $invoiceTitle = $templateSettings['invoice_header.title']->label ?? 'Invoice';

                        $companyName =
                            $templateSettings['text_elements.company_name']->value ??
                            ($templateSettings['text_elements.company_name']->default_value ?? '');

                        $companyAddress =
                            $templateSettings['text_elements.company_address']->value ??
                            ($templateSettings['text_elements.company_address']->default_value ?? '');

                        /* =====================================================
                 | HEADER VISIBILITY FLAGS
                 ===================================================== */
                        $invoiceTitleVisible = $templateSettings['invoice_header.title']->is_visible ?? true;
                        $companyNameVisible = $templateSettings['text_elements.company_name']->is_visible ?? true;
                        $companyAddressVisible = $templateSettings['text_elements.company_address']->is_visible ?? true;

                        $logoLightVisible = $templateSettings['visual_elements.logo_light']->is_visible ?? true;
                        $logoDarkVisible = $templateSettings['visual_elements.logo_dark']->is_visible ?? true;

                        $invoiceNoVisible = $templateSettings['invoice_meta.invoice_no']->is_visible ?? true;
                        $invoiceDateVisible = $templateSettings['invoice_meta.invoice_date']->is_visible ?? true;
                        $dueDateVisible = $templateSettings['invoice_meta.due_date']->is_visible ?? true;

                        /* =====================================================
                 | LOGOS
                 ===================================================== */
                        $logoLight =
                            $templateSettings['visual_elements.logo_light']->value ??
                            ($templateSettings['visual_elements.logo_light']->default_value ??
                                '/assets/img/logo2.png');

                        $logoDark =
                            $templateSettings['visual_elements.logo_dark']->value ??
                            ($templateSettings['visual_elements.logo_dark']->default_value ??
                                '/assets/img/logo2-white.png');

                        /* =====================================================
                 | INVOICE META LABELS
                 ===================================================== */
                        $invoiceNoLabel = $templateSettings['invoice_meta.invoice_no']->label ?? 'Invoice No';
                        $invoiceDateLabel = $templateSettings['invoice_meta.invoice_date']->label ?? 'Invoice Date';
                        $dueDateLabel = $templateSettings['invoice_meta.due_date']->label ?? 'Due Date';

                        /* =====================================================
                 | CUSTOMER INFO VALUES & VISIBILITY
                 ===================================================== */
                        $customerInfoVisible = $templateSettings['customer_info.section_title']->is_visible ?? true;
                        $customerDetailsVisible =
                            $templateSettings['customer_info.customer_details_label']->is_visible ?? true;
                        $billingVisible = $templateSettings['customer_info.billing_address_label']->is_visible ?? true;
                        $shippingVisible =
                            $templateSettings['customer_info.shipping_address_label']->is_visible ?? true;
                        $paymentStatusVisible =
                            $templateSettings['customer_info.payment_status_label']->is_visible ?? true;
                        $gstinVisible = $templateSettings['customer_info.gstin_label']->is_visible ?? true;

                        $sectionTitle =
                            $templateSettings['customer_info.section_title']->label ?? 'Customer Information';
                        $customerDetailsLabel =
                            $templateSettings['customer_info.customer_details_label']->label ?? 'Customer Details';
                        $billingAddressLabel =
                            $templateSettings['customer_info.billing_address_label']->label ?? 'Billing Address';
                        $shippingAddressLabel =
                            $templateSettings['customer_info.shipping_address_label']->label ?? 'Shipping Address';
                        $paymentStatusLabel =
                            $templateSettings['customer_info.payment_status_label']->label ?? 'Payment Status';
                        $gstinLabel = $templateSettings['customer_info.gstin_label']->label ?? 'GSTIN';
                    @endphp


                    {{-- ================= HEADER ================= --}}
                    @if ($invoiceTitleVisible)
                        <div class="invoice-title-centered" style="width: 100% !important; text-align: center !important; margin-bottom: 10px !important;">
                            <h4 style="margin: 0 !important; font-size: 24px !important; font-weight: bold !important; color: #6e46e5 !important; text-align: center !important;">{{ $invoiceTitle }}</h4>
                        </div>
                    @endif
                    <div class="invoice-header">

                        {{-- LEFT --}}
                        @if ($companyNameVisible || $companyAddressVisible)
                            <div class="inv-header-left">

                                @if ($companyNameVisible || $companyAddressVisible)
                                    <div class="company-details">
                                        <div class="gst-details">

                                            @if ($companyNameVisible)
                                                <h6 style="font-size: 15px !important; font-weight: bold !important; margin-bottom: 4px !important; color: #333 !important;">{{ $companyName }}</h6>
                                            @endif

                                            @if ($companyAddressVisible)
                                                <span>{!! nl2br(e($companyAddress)) !!}</span>
                                            @endif

                                        </div>
                                        <div class="address-bg"></div>
                                    </div>
                                @endif

                            </div>
                        @endif

                        {{-- RIGHT --}}
                        @if ($logoLightVisible || $logoDarkVisible || $invoiceNoVisible || $invoiceDateVisible || $dueDateVisible)
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

                                @if ($invoiceNoVisible)
                                    <h6>
                                        {{ $invoiceNoLabel }} :
                                        <span>#{{ $invoice->invoice_no }}</span>
                                    </h6>
                                @endif

                                @if ($invoiceDateVisible)
                                    <h6>
                                        {{ $invoiceDateLabel }} :
                                        <span>{{ date('d-m-Y', strtotime($invoice->invoice_date)) }}</span>
                                    </h6>
                                @endif

                                @if ($dueDateVisible)
                                    <p>
                                        <span>
                                            {{ $dueDateLabel }} :
                                            {{ date('d-m-Y', strtotime($invoice->invoice_due_date)) }}
                                        </span>
                                    </p>
                                @endif

                            </div>
                        @endif
                    </div>

                    @if ($invoiceTitleVisible || $companyNameVisible || $companyAddressVisible)
                        <span class="line"></span>
                    @endif


                    {{-- ================= CUSTOMER INFO ================= --}}
                    @if ($customerInfoVisible)

                        <h5>{{ $sectionTitle }}</h5>

                        <div class="patient-infos">
                            <div class="row">

                                {{-- CUSTOMER DETAILS --}}
                                @if ($customerDetailsVisible)
                                    <div class="col-sm-3">
                                        <div class="patient-detailed">
                                            <div class="bill-add">
                                                {{ $customerDetailsLabel }} :
                                            </div>

                                            <div class="customer-name">
                                                {{ $customer->name }}

                                                @if ($gstinVisible && !empty($customer->gstin))
                                                    <p>
                                                        <span>{{ $gstinLabel }} : {{ $customer->gstin }}</span>
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                {{-- PAYMENT STATUS --}}
                                @if ($paymentStatusVisible)
                                    <div class="col-sm-3">
                                        <div class="patient-detailed">
                                            <div class="bill-add">
                                                {{ $paymentStatusLabel }} :
                                            </div>
                                            <div class="payment-status">
                                                <p>
                                                    <span class="badge bg-success-light" style="font-weight: bold; text-transform: uppercase;">{{ $invoice->status ?? 'Pending' }}</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                {{-- BILLING ADDRESS --}}
                                @if ($billingVisible)
                                    <div class="col-sm-3">
                                        <div class="patient-detailed">
                                            <div class="bill-add">
                                                {{ $billingAddressLabel }} :
                                            </div>
                                            <div class="add-details">
                                                {{ $customer->address }}
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                {{-- SHIPPING ADDRESS --}}
                                @if ($shippingVisible)
                                    <div class="col-sm-3">
                                        <div class="patient-detailed">
                                            <div class="bill-add">
                                                {{ $shippingAddressLabel }} :
                                            </div>
                                            <div class="add-details">
                                                {{ $invoice->shipping_address ?: $customer->address }}
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </div>

                    @endif


                    @php
                        $columnLabels = [
                            'sr_no' => $templateSettings['item_table.column_sr_no']->label ?? '#',
                            'category' => $templateSettings['item_table.column_category']->label ?? 'Category',
                            'subcategory' =>
                                $templateSettings['item_table.column_subcategory']->label ?? 'Sub Category',
                            'item' => $templateSettings['item_table.column_item']->label ?? 'Item',
                            'pre_code' => $templateSettings['item_table.column_pre_code']->label ?? 'Pre Code',
                            'post_code' => $templateSettings['item_table.column_post_code']->label ?? 'Post Code',
                            'barcode' => $templateSettings['item_table.column_barcode']->label ?? 'Barcode',
                            'hsn_code' => $templateSettings['item_table.column_hsn_code']->label ?? 'HSN Code',
                            'purity' => $templateSettings['item_table.column_purity']->label ?? 'Purity',
                            'qty' => $templateSettings['item_table.column_qty']->label ?? 'Qty',
                            'metal_rate' => $templateSettings['item_table.column_metal_rate']->label ?? 'Metal Rate',
                            'gross_wt' => $templateSettings['item_table.column_gross_wt']->label ?? 'Gross Wt',
                            'net_wt' => $templateSettings['item_table.column_net_wt']->label ?? 'Net Wt',
                            'fine_wt' => $templateSettings['item_table.column_fine_wt']->label ?? 'Fine Wt',
                            'size' => $templateSettings['item_table.column_size']->label ?? 'Size',
                            'wastage' => $templateSettings['item_table.column_wastage_percent']->label ?? 'Wastage %',
                            'making' => $templateSettings['item_table.column_making']->label ?? 'Making',
                            'gst_percent' => $templateSettings['item_table.column_gst_percent']->label ?? 'GST %',
                            'gst_amount' => $templateSettings['item_table.column_gst_amount']->label ?? 'GST Amount',
                            'other_charges' =>
                                $templateSettings['item_table.column_other_charges']->label ?? 'Other Charges',
                            'diamond_amount' =>
                                $templateSettings['item_table.column_diamond_amount']->label ?? 'Diamond Amount',
                            'stone_amount' =>
                                $templateSettings['item_table.column_stone_amount']->label ?? 'Stone Amount',
                            'packet_amount' =>
                                $templateSettings['item_table.column_packet_amount']->label ?? 'Packet Amount',
                            'amount' => $templateSettings['item_table.column_amount']->label ?? 'Amount',
                        ];

                        $columnVisibility = [
                            'sr_no' => $templateSettings['item_table.column_sr_no']->is_visible ?? true,
                            'category' => $templateSettings['item_table.column_category']->is_visible ?? true,
                            'subcategory' => $templateSettings['item_table.column_subcategory']->is_visible ?? false,
                            'item' => $templateSettings['item_table.column_item']->is_visible ?? true,
                            'pre_code' => $templateSettings['item_table.column_pre_code']->is_visible ?? false,
                            'post_code' => $templateSettings['item_table.column_post_code']->is_visible ?? false,
                            'barcode' => $templateSettings['item_table.column_barcode']->is_visible ?? false,
                            'hsn_code' => $templateSettings['item_table.column_hsn_code']->is_visible ?? false,
                            'purity' => $templateSettings['item_table.column_purity']->is_visible ?? false,
                            'qty' => $templateSettings['item_table.column_qty']->is_visible ?? true,
                            'metal_rate' => $templateSettings['item_table.column_metal_rate']->is_visible ?? true,
                            'gross_wt' => $templateSettings['item_table.column_gross_wt']->is_visible ?? true,
                            'net_wt' => $templateSettings['item_table.column_net_wt']->is_visible ?? true,
                            'fine_wt' => $templateSettings['item_table.column_fine_wt']->is_visible ?? false,
                            'size' => $templateSettings['item_table.column_size']->is_visible ?? false,
                            'wastage' => $templateSettings['item_table.column_wastage_percent']->is_visible ?? false,
                            'making' => $templateSettings['item_table.column_making']->is_visible ?? true,
                            'gst_percent' => $templateSettings['item_table.column_gst_percent']->is_visible ?? false,
                            'gst_amount' => $templateSettings['item_table.column_gst_amount']->is_visible ?? false,
                            'other_charges' => $templateSettings['item_table.column_other_charges']->is_visible ?? true,
                            'diamond_amount' =>
                                $templateSettings['item_table.column_diamond_amount']->is_visible ?? true,
                            'stone_amount' => $templateSettings['item_table.column_stone_amount']->is_visible ?? true,
                            'packet_amount' => $templateSettings['item_table.column_packet_amount']->is_visible ?? true,
                            'amount' => $templateSettings['item_table.column_amount']->is_visible ?? true,
                        ];
                    @endphp

                @php
                    $totalGrossWt = 0;
                    $totalNetWt = 0;
                    $totalGoldAmount = 0;
                    $totalStoneWt = 0;
                    $totalDiamondPcs = 0;
                    $totalDiamondCt = 0;
                    $totalMaking = 0;
                    $totalAmount = 0;

                    foreach ($invoice->items as $item) {
                        $totalGrossWt += $item->gross_weight;
                        $totalNetWt += $item->net_weight;
                        
                        $goldAmt = (($item->gold_amount > 0) ? $item->gold_amount : ($item->net_weight * $item->metal_rate)) + ($item->wastage_amount ?? 0);
                        $totalGoldAmount += $goldAmt;

                        $totalStoneWt += ($item->gross_weight - $item->net_weight);

                        if ($item->diamonds && $item->diamonds->count() > 0) {
                            foreach ($item->diamonds as $diamond) {
                                $totalDiamondPcs += $diamond->pieces;
                                $totalDiamondCt += $diamond->diamond_weight;
                            }
                        }
                        if ($item->packets && $item->packets->count() > 0) {
                            foreach ($item->packets as $packet) {
                                $pType = $packet->packet_type ?? '';
                                $isDiamond = stripos($pType, 'dia') !== false || stripos($pType, 'diamond') !== false;
                                if ($isDiamond) {
                                    $totalDiamondPcs += $packet->pcs;
                                    $totalDiamondCt += $packet->weight;
                                }
                            }
                        }

                        $totalMaking += $item->making_final_amount;
                        $totalAmount += $item->final_price;
                    }
                @endphp

                <div class="invoice-table">
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr class="ecommercetable">
                                    @if ($columnVisibility['sr_no'])
                                        <th rowspan="2" style="vertical-align: middle; text-align: center;">SL No.</th>
                                    @endif
                                    @if ($columnVisibility['item'])
                                        <th rowspan="2" style="vertical-align: middle; text-align: center;">Item Description</th>
                                    @endif
                                    @if ($columnVisibility['qty'])
                                        <th rowspan="2" style="vertical-align: middle; text-align: center;">Pcs</th>
                                    @endif
                                    @if ($columnVisibility['hsn_code'])
                                        <th rowspan="2" style="vertical-align: middle; text-align: center;">HSN</th>
                                    @endif
                                    @if ($columnVisibility['purity'])
                                        <th rowspan="2" style="vertical-align: middle; text-align: center;">Purity</th>
                                    @endif
                                    @if ($columnVisibility['gross_wt'])
                                        <th rowspan="2" style="vertical-align: middle; text-align: center;">Gr. wt. (Gm.)</th>
                                    @endif
                                    @if ($columnVisibility['net_wt'])
                                        <th rowspan="2" style="vertical-align: middle; text-align: center;">Net. wt. (Gm.)</th>
                                    @endif
                                    @if ($columnVisibility['wastage'])
                                        <th rowspan="2" style="vertical-align: middle; text-align: center;">Wastage (Gm)</th>
                                    @endif
                                    @if ($columnVisibility['metal_rate'])
                                        <th rowspan="2" style="vertical-align: middle; text-align: center;">Gold Rate (Gm)</th>
                                    @endif
                                    @if ($columnVisibility['gross_wt'] || $columnVisibility['net_wt'])
                                        <th rowspan="2" style="vertical-align: middle; text-align: center;">Stone/Oth. wt. (Gm)</th>
                                    @endif
                                    @if ($columnVisibility['diamond_amount'] || $columnVisibility['stone_amount'] || $columnVisibility['packet_amount'])
                                        <th colspan="3" style="text-align: center;">Diamond/Stone</th>
                                    @endif
                                    @if ($columnVisibility['making'])
                                        <th rowspan="2" style="vertical-align: middle; text-align: center;">Making</th>
                                    @endif
                                    @if ($columnVisibility['amount'])
                                        <th rowspan="2" style="vertical-align: middle; text-align: center; text-align: right;">Amount</th>
                                    @endif
                                </tr>
                                @if ($columnVisibility['diamond_amount'] || $columnVisibility['stone_amount'] || $columnVisibility['packet_amount'])
                                    <tr class="ecommercetable">
                                        <th style="text-align: center;">Pcs</th>
                                        <th style="text-align: center;">Ct</th>
                                        <th style="text-align: center;">Rate</th>
                                    </tr>
                                @endif
                            </thead>

                            <tbody>
                                @foreach ($invoice->items as $item)
                                    {{-- MAIN PRODUCT ROW --}}
                                    <tr>
                                        @if ($columnVisibility['sr_no'])
                                            <td style="text-align: center;">{{ $loop->iteration }}</td>
                                        @endif
                                        @if ($columnVisibility['item'])
                                            <td style="text-align: center; font-weight: bold;">{{ strtoupper($item->item_name) }}</td>
                                        @endif
                                        @if ($columnVisibility['qty'])
                                            <td style="text-align: center;">{{ $item->quantity }}</td>
                                        @endif
                                        @if ($columnVisibility['hsn_code'])
                                            <td style="text-align: center;">{{ $item->hsn_code }}</td>
                                        @endif
                                        @if ($columnVisibility['purity'])
                                            <td style="text-align: center;">
                                                @php
                                                    $purityValue = '';
                                                    if ($item->product && $item->product->metalRate) {
                                                        $purityValue = ($item->product->metalRate->karat ?? '') . ($item->product->metalRate->purity_type == 'karat' ? 'KT' : '%');
                                                    } else {
                                                        $purityValue = $item->purity;
                                                    }
                                                @endphp
                                                {{ $purityValue }}
                                            </td>
                                        @endif
                                        @if ($columnVisibility['gross_wt'])
                                            <td style="text-align: right;">{{ number_format($item->gross_weight, 3) }}</td>
                                        @endif
                                        @if ($columnVisibility['net_wt'])
                                            <td style="text-align: right;">{{ number_format($item->net_weight, 3) }}</td>
                                        @endif
                                        @if ($columnVisibility['wastage'])
                                            <td style="text-align: right;">{{ number_format($item->wastage_amount ?? 0, 3) }}</td>
                                        @endif
                                        @if ($columnVisibility['metal_rate'])
                                            <td style="text-align: right;">{{ number_format($item->metal_rate, 2) }}</td>
                                        @endif
                                        @if ($columnVisibility['gross_wt'] || $columnVisibility['net_wt'])
                                            <td style="text-align: right;">{{ number_format($item->gross_weight - $item->net_weight, 3) }}</td>
                                        @endif
                                        @if ($columnVisibility['diamond_amount'] || $columnVisibility['stone_amount'] || $columnVisibility['packet_amount'])
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        @endif
                                        @if ($columnVisibility['making'])
                                            <td></td>
                                        @endif
                                        @if ($columnVisibility['amount'])
                                            <td style="text-align: right;">
                                                @php
                                                    $goldAmt = (($item->gold_amount > 0) ? $item->gold_amount : ($item->net_weight * $item->metal_rate)) + ($item->wastage_amount ?? 0);
                                                @endphp
                                                {{ number_format($goldAmt, 2) }}
                                            </td>
                                        @endif
                                    </tr>

                                    {{-- DIAMOND DETAILS ROWS --}}
                                    @if ($item->diamonds && $item->diamonds->count() > 0)
                                        @foreach ($item->diamonds as $diamond)
                                            <tr>
                                                @if ($columnVisibility['sr_no'])
                                                    <td></td>
                                                @endif
                                                @if ($columnVisibility['item'])
                                                    <td style="padding-left: 20px;">Dia: {{ $diamond->clarity }}/{{ $diamond->color }} {{ $diamond->cut }}</td>
                                                @endif
                                                @if ($columnVisibility['qty'])
                                                    <td></td>
                                                @endif
                                                @if ($columnVisibility['hsn_code'])
                                                    <td></td>
                                                @endif
                                                @if ($columnVisibility['purity'])
                                                    <td></td>
                                                @endif
                                                @if ($columnVisibility['gross_wt'])
                                                    <td></td>
                                                @endif
                                                @if ($columnVisibility['net_wt'])
                                                    <td></td>
                                                @endif
                                                @if ($columnVisibility['wastage'])
                                                    <td></td>
                                                @endif
                                                @if ($columnVisibility['metal_rate'])
                                                    <td></td>
                                                @endif
                                                @if ($columnVisibility['gross_wt'] || $columnVisibility['net_wt'])
                                                    <td></td>
                                                @endif
                                                @if ($columnVisibility['diamond_amount'] || $columnVisibility['stone_amount'] || $columnVisibility['packet_amount'])
                                                    <td style="text-align: center;">{{ $diamond->pieces }}</td>
                                                    <td style="text-align: right;">{{ number_format($diamond->diamond_weight, 3) }}</td>
                                                    <td style="text-align: right;">{{ number_format($diamond->price_per_carat, 2) }}</td>
                                                @endif
                                                @if ($columnVisibility['making'])
                                                    <td></td>
                                                @endif
                                                @if ($columnVisibility['amount'])
                                                    <td style="text-align: right;">{{ number_format($diamond->diamond_final_price, 2) }}</td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    @endif

                                    {{-- STONE DETAILS ROWS --}}
                                    @if ($item->stones && $item->stones->count() > 0)
                                        @foreach ($item->stones as $stone)
                                            <tr>
                                                @if ($columnVisibility['sr_no'])
                                                    <td></td>
                                                @endif
                                                @if ($columnVisibility['item'])
                                                    <td style="padding-left: 20px;">St: {{ $stone->stone_name }}</td>
                                                @endif
                                                @if ($columnVisibility['qty'])
                                                    <td></td>
                                                @endif
                                                @if ($columnVisibility['hsn_code'])
                                                    <td></td>
                                                @endif
                                                @if ($columnVisibility['purity'])
                                                    <td></td>
                                                @endif
                                                @if ($columnVisibility['gross_wt'])
                                                    <td></td>
                                                @endif
                                                @if ($columnVisibility['net_wt'])
                                                    <td></td>
                                                @endif
                                                @if ($columnVisibility['wastage'])
                                                    <td></td>
                                                @endif
                                                @if ($columnVisibility['metal_rate'])
                                                    <td></td>
                                                @endif
                                                @if ($columnVisibility['gross_wt'] || $columnVisibility['net_wt'])
                                                    <td></td>
                                                @endif
                                                @if ($columnVisibility['diamond_amount'] || $columnVisibility['stone_amount'] || $columnVisibility['packet_amount'])
                                                    <td style="text-align: center;">{{ $stone->pieces }}</td>
                                                    <td style="text-align: right;">{{ number_format($stone->stone_weight, 3) }}</td>
                                                    <td style="text-align: right;">{{ number_format($stone->stone_price, 2) }}</td>
                                                @endif
                                                @if ($columnVisibility['making'])
                                                    <td></td>
                                                @endif
                                                @if ($columnVisibility['amount'])
                                                    <td style="text-align: right;">{{ number_format($stone->stone_final_price, 2) }}</td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    @endif

                                    {{-- PACKET DETAILS ROWS --}}
                                    @if ($item->packets && $item->packets->count() > 0)
                                        @foreach ($item->packets as $packet)
                                            <tr>
                                                @if ($columnVisibility['sr_no'])
                                                    <td></td>
                                                @endif
                                                @if ($columnVisibility['item'])
                                                    <td style="padding-left: 20px;">{{ $packet->stone ?: 'Pkt' }} [ {{ $packet->packet_no }} ]</td>
                                                @endif
                                                @if ($columnVisibility['qty'])
                                                    <td></td>
                                                @endif
                                                @if ($columnVisibility['hsn_code'])
                                                    <td></td>
                                                @endif
                                                @if ($columnVisibility['purity'])
                                                    <td></td>
                                                @endif
                                                @if ($columnVisibility['gross_wt'])
                                                    <td></td>
                                                @endif
                                                @if ($columnVisibility['net_wt'])
                                                    <td></td>
                                                @endif
                                                @if ($columnVisibility['wastage'])
                                                    <td></td>
                                                @endif
                                                @if ($columnVisibility['metal_rate'])
                                                    <td></td>
                                                @endif
                                                @if ($columnVisibility['gross_wt'] || $columnVisibility['net_wt'])
                                                    <td></td>
                                                @endif
                                                @if ($columnVisibility['diamond_amount'] || $columnVisibility['stone_amount'] || $columnVisibility['packet_amount'])
                                                    <td style="text-align: center;">{{ $packet->pcs ?: '' }}</td>
                                                    <td style="text-align: right;">{{ number_format($packet->weight, 3) }}</td>
                                                    <td style="text-align: right;">{{ number_format($packet->rate, 2) }}</td>
                                                @endif
                                                @if ($columnVisibility['making'])
                                                    <td></td>
                                                @endif
                                                @if ($columnVisibility['amount'])
                                                    <td style="text-align: right;">{{ number_format($packet->amount, 2) }}</td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    @endif

                                    {{-- MAKING ROW --}}
                                    @if (($item->making_final_amount > 0 || $item->making_charges > 0) && $columnVisibility['making'])
                                        <tr>
                                            @if ($columnVisibility['sr_no'])
                                                <td></td>
                                            @endif
                                            @if ($columnVisibility['item'])
                                                <td style="padding-left: 20px;">Making:</td>
                                            @endif
                                            @if ($columnVisibility['qty'])
                                                <td></td>
                                            @endif
                                            @if ($columnVisibility['hsn_code'])
                                                <td></td>
                                            @endif
                                            @if ($columnVisibility['purity'])
                                                <td></td>
                                            @endif
                                            @if ($columnVisibility['gross_wt'])
                                                <td></td>
                                            @endif
                                            @if ($columnVisibility['net_wt'])
                                                <td></td>
                                            @endif
                                            @if ($columnVisibility['wastage'])
                                                <td></td>
                                            @endif
                                            @if ($columnVisibility['metal_rate'])
                                                <td></td>
                                            @endif
                                            @if ($columnVisibility['gross_wt'] || $columnVisibility['net_wt'])
                                                <td></td>
                                            @endif
                                            @if ($columnVisibility['diamond_amount'] || $columnVisibility['stone_amount'] || $columnVisibility['packet_amount'])
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            @endif
                                            @if ($columnVisibility['making'])
                                                <td style="text-align: right;">{{ number_format($item->making_price, 2) }}</td>
                                            @endif
                                            @if ($columnVisibility['amount'])
                                                <td style="text-align: right;">{{ number_format($item->making_final_amount, 2) }}</td>
                                            @endif
                                        </tr>
                                    @endif

                                    {{-- OTHER CHARGES ROW --}}
                                    @if ($item->other_charges > 0 && $columnVisibility['other_charges'])
                                        <tr>
                                            @if ($columnVisibility['sr_no'])
                                                <td></td>
                                            @endif
                                            @if ($columnVisibility['item'])
                                                <td style="padding-left: 20px;">Other Charges:</td>
                                            @endif
                                            @if ($columnVisibility['qty'])
                                                <td></td>
                                            @endif
                                            @if ($columnVisibility['hsn_code'])
                                                <td></td>
                                            @endif
                                            @if ($columnVisibility['purity'])
                                                <td></td>
                                            @endif
                                            @if ($columnVisibility['gross_wt'])
                                                <td></td>
                                            @endif
                                            @if ($columnVisibility['net_wt'])
                                                <td></td>
                                            @endif
                                            @if ($columnVisibility['wastage'])
                                                <td></td>
                                            @endif
                                            @if ($columnVisibility['metal_rate'])
                                                <td></td>
                                            @endif
                                            @if ($columnVisibility['gross_wt'] || $columnVisibility['net_wt'])
                                                <td></td>
                                            @endif
                                            @if ($columnVisibility['diamond_amount'] || $columnVisibility['stone_amount'] || $columnVisibility['packet_amount'])
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            @endif
                                            @if ($columnVisibility['making'])
                                                <td></td>
                                            @endif
                                            @if ($columnVisibility['amount'])
                                                <td style="text-align: right;">{{ number_format($item->other_charges, 2) }}</td>
                                            @endif
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>

                            <tfoot>
                                <tr class="total-row">
                                    @if ($columnVisibility['sr_no'])
                                        <td></td>
                                    @endif
                                    @if ($columnVisibility['item'])
                                        <td></td>
                                    @endif
                                    @if ($columnVisibility['qty'])
                                        <td></td>
                                    @endif
                                    @if ($columnVisibility['hsn_code'])
                                        <td></td>
                                    @endif
                                    @if ($columnVisibility['purity'])
                                        <td>Total</td>
                                    @endif
                                    @if ($columnVisibility['gross_wt'])
                                        <td style="text-align: right;">{{ number_format($totalGrossWt, 3) }}</td>
                                    @endif
                                    @if ($columnVisibility['net_wt'])
                                        <td style="text-align: right;">{{ number_format($totalNetWt, 3) }}</td>
                                    @endif
                                    @if ($columnVisibility['wastage'])
                                        <td></td>
                                    @endif
                                    @if ($columnVisibility['metal_rate'])
                                        <td class="text-end" style="text-align: right;">₹{{ number_format($totalGoldAmount, 2) }}</td>
                                    @endif
                                    @if ($columnVisibility['gross_wt'] || $columnVisibility['net_wt'])
                                        <td style="text-align: right;">{{ number_format($totalStoneWt, 3) }}</td>
                                    @endif
                                    @if ($columnVisibility['diamond_amount'] || $columnVisibility['stone_amount'] || $columnVisibility['packet_amount'])
                                        <td>{{ $totalDiamondPcs > 0 ? $totalDiamondPcs : '' }}</td>
                                        <td style="text-align: right;">{{ number_format($totalDiamondCt, 3) }}</td>
                                        <td></td>
                                    @endif
                                    @if ($columnVisibility['making'])
                                        <td class="text-end" style="text-align: right;">{{ number_format($totalMaking, 2) }}</td>
                                    @endif
                                    @if ($columnVisibility['amount'])
                                        <td class="text-end" style="text-align: right;">₹{{ number_format($totalAmount, 2) }}</td>
                                    @endif
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                    {{-- EXCHANGE ITEMS (OLD METAL) --}}
                    @if ($invoice->exchangeItems && $invoice->exchangeItems->count() > 0)
                        <div class="mt-4">
                            <h5>Old Metal Received</h5>
                            <div class="invoice-table">
                                <div class="table-responsive">
                                    <table>
                                        <thead>
                                            <tr class="ecommercetable">
                                                <th>#</th>
                                                <th>Desc</th>
                                                <th>Metal</th>
                                                <th>GW</th>
                                                <th>LW</th>
                                                <th>NW</th>
                                                <th>Purity</th>
                                                <th>Fine Wt</th>
                                                <th>Rate</th>
                                                <th class="text-end">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($invoice->exchangeItems as $ex)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $ex->description }}</td>
                                                    <td>{{ $ex->metal }}</td>
                                                    <td>{{ number_format($ex->gross_weight, 3) }}</td>
                                                    <td>{{ number_format($ex->less_weight, 3) }}</td>
                                                    <td>{{ number_format($ex->net_weight, 3) }}</td>
                                                    <td>{{ $ex->purity }}</td>
                                                    <td>{{ number_format($ex->fine_weight, 3) }}</td>
                                                    <td>{{ number_format($ex->rate, 2) }}</td>
                                                    <td class="text-end">₹{{ number_format($ex->amount, 2) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- EXCHANGE DIAMONDS --}}
                    @if ($invoice->exchangeDiamonds && $invoice->exchangeDiamonds->count() > 0)
                        <div class="mt-4">
                            <h5>Old Diamonds Received</h5>
                            <div class="invoice-table">
                                <div class="table-responsive">
                                    <table>
                                        <thead>
                                            <tr class="ecommercetable">
                                                <th>#</th>
                                                <th>Desc</th>
                                                <th>Clarity</th>
                                                <th>Cut</th>
                                                <th>Color</th>
                                                <th>Pieces</th>
                                                <th>Weight (ct)</th>
                                                <th>Rate/Carat</th>
                                                <th class="text-end">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($invoice->exchangeDiamonds as $dia)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $dia->description }}</td>
                                                    <td>{{ $dia->clarity }}</td>
                                                    <td>{{ $dia->cut }}</td>
                                                    <td>{{ $dia->color }}</td>
                                                    <td>{{ $dia->pieces }}</td>
                                                    <td>{{ number_format($dia->weight, 3) }}</td>
                                                    <td>{{ number_format($dia->rate, 2) }}</td>
                                                    <td class="text-end">₹{{ number_format($dia->amount, 2) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif

                    @php
                        /* ===============================
                 | BASIC AMOUNTS
                 =============================== */
                        $taxableAmount = $invoice->taxable_amount ?? 0;

                        $cgstPercent = $invoice->cgst_percent ?? 0;
                        $sgstPercent = $invoice->sgst_percent ?? 0;

                        $cgstAmount = $invoice->cgst_amount ?? 0;
                        $sgstAmount = $invoice->sgst_amount ?? 0;
                        $igstAmount = $invoice->igst_amount ?? 0;

                        $discountPercent = $invoice->discount_percent ?? 0;
                        $discountAmount = $invoice->discount_amount ?? 0;

                        /* ===============================
                 | TOTAL CALCULATION
                 =============================== */
                        $grossTotal = $taxableAmount + $cgstAmount + $sgstAmount + $igstAmount - $discountAmount;

                        $finalAmount = $invoice->final_amount ?? $grossTotal;
                        $roundOff = $invoice->round_off ?? 0;

                        /* ===============================
                 | PAYMENT DETAILS
                 =============================== */
                        $cash = $invoice->cash_received ?? 0;
                        $online = $invoice->online_received ?? 0;
                        $bank = $invoice->bank_received ?? 0;
                        $card = $invoice->card_received ?? 0;

                        $totalReceived = $cash + $online + $bank + $card;
                        $balanceAmount = $invoice->amount_left ?? ($finalAmount - $totalReceived);

                        /* ===============================
                 | INVOICE STATUS
                 =============================== */
                        if ($balanceAmount <= 0) {
                            $status = 'paid';
                        } elseif ($totalReceived > 0) {
                            $status = 'partial';
                        } else {
                            $status = 'pending';
                        }

                        /* ===============================
                 | VISIBILITY FLAGS
                 =============================== */
                        $taxableVisible = $templateSettings['invoice_footer.taxable_amount_label']->is_visible ?? true;
                        $cgstVisible = $templateSettings['invoice_footer.cgst_label']->is_visible ?? true;
                        $sgstVisible = $templateSettings['invoice_footer.sgst_label']->is_visible ?? true;
                        $igstVisible = $templateSettings['invoice_footer.igst_label']->is_visible ?? true;
                        $discountVisible = $templateSettings['invoice_footer.discount_label']->is_visible ?? true;
                        $roundOffVisible = $templateSettings['invoice_footer.round_off_label']->is_visible ?? true;
                        $totalVisible = $templateSettings['invoice_footer.total_amount_label']->is_visible ?? true;

                        /* ===============================
                 | LABELS
                 =============================== */
                        $taxableLabel =
                            $templateSettings['invoice_footer.taxable_amount_label']->label ?? 'Taxable Amount';
                        $cgstLabel = $templateSettings['invoice_footer.cgst_label']->label ?? 'CGST';
                        $sgstLabel = $templateSettings['invoice_footer.sgst_label']->label ?? 'SGST';
                        $igstLabel = $templateSettings['invoice_footer.igst_label']->label ?? 'IGST';
                        $discountLabel = $templateSettings['invoice_footer.discount_label']->label ?? 'Discount';
                        $roundOffLabel = $templateSettings['invoice_footer.round_off_label']->label ?? 'Round Off';
                        $totalLabel = $templateSettings['invoice_footer.total_amount_label']->label ?? 'Total Amount';

                        /* ===============================
                 | PAID LOGO
                 =============================== */
                        $paidLogo =
                            $templateSettings['visual_elements.paid_logo']->value ??
                            ($templateSettings['visual_elements.paid_logo']->default_value ??
                                '/assets/img/paid.svg');

                        $paidLogoVisible = $templateSettings['visual_elements.paid_logo']->is_visible ?? true;

                        $termsLabel =
                            $templateSettings['text_elements.terms_label']->value ??
                            ($templateSettings['text_elements.terms_label']->default_value ?? 'Terms & Conditions:');

                        $termsValue =
                            $templateSettings['text_elements.terms_value']->value ??
                            ($templateSettings['text_elements.terms_value']->default_value ?? "Goods once sold cannot be taken back or exchanged.\nManufacturer warranty applies as per company policy.");

                        $termsVisible = $templateSettings['text_elements.terms_label']->is_visible ?? true;
                    @endphp


                    {{-- ===============================
                 | TAX / GST / DISCOUNT
                 =============================== --}}
                    @if (
                        $taxableVisible ||
                            $cgstVisible ||
                            $sgstVisible ||
                            $igstVisible ||
                            ($discountVisible && $discountAmount > 0) ||
                            $roundOffVisible)
                        <div class="invoice-table-footer">
                            <div class="table-footer-left notes" style="display: flex; flex-direction: column; align-items: flex-start; justify-content: flex-start;">
                                @if ($status === 'paid' && $paidLogoVisible)
                                    <div class="mb-3">
                                        <img src="{{ asset($paidLogo) }}" alt="Paid" style="max-height: 85px;">
                                    </div>
                                @elseif($status === 'partial')
                                    <span class="badge bg-warning">Partially Paid</span>
                                @else
                                    <span class="badge bg-danger">Unpaid</span>
                                @endif

                                {{-- TERMS AND CONDITIONS BELOW PAID LOGO --}}
                                @if ($termsVisible)
                                    <div class="terms-condition mt-3" style="max-width: 450px; text-align: left;">
                                        <span style="font-weight: bold; font-size: 11px; display: block; margin-bottom: 5px;">{{ $termsLabel }}</span>
                                        @php
                                            $rawTerms = preg_split('/(?=\d+\.)|\R/', $termsValue);
                                            $termsList = [];
                                            foreach ($rawTerms as $t) {
                                                $trimmed = trim($t);
                                                if (!empty($trimmed)) {
                                                    $termsList[] = preg_replace('/^\s*(?:\d+\.|\-|\*)\s*/', '', $trimmed);
                                                }
                                            }
                                        @endphp
                                        @if (!empty($termsList))
                                            <ol style="padding-left: 15px; margin: 0; font-size: 10px; line-height: 1.4;">
                                                @foreach ($termsList as $term)
                                                    <li>{{ $term }}</li>
                                                @endforeach
                                            </ol>
                                        @endif
                                    </div>
                                @endif
                            </div>

                            <div class="table-footer-right text-end">
                                <table>
                                    <tbody>

                                        @if ($taxableVisible)
                                            <tr>
                                                <td>{{ $taxableLabel }}</td>
                                                <td>₹{{ number_format($taxableAmount, 2) }}</td>
                                            </tr>
                                        @endif

                                        @if ($igstAmount > 0 && $igstVisible)
                                            <tr>
                                                <td>{{ $igstLabel }} {{ $cgstPercent + $sgstPercent }}%</td>
                                                <td>₹{{ number_format($igstAmount, 2) }}</td>
                                            </tr>
                                        @else
                                            @if ($cgstVisible)
                                                <tr>
                                                    <td>{{ $cgstLabel }} {{ $cgstPercent }}%</td>
                                                    <td>₹{{ number_format($cgstAmount, 2) }}</td>
                                                </tr>
                                            @endif

                                            @if ($sgstVisible)
                                                <tr>
                                                    <td>{{ $sgstLabel }} {{ $sgstPercent }}%</td>
                                                    <td>₹{{ number_format($sgstAmount, 2) }}</td>
                                                </tr>
                                            @endif
                                        @endif

                                        @if ($discountVisible && $discountAmount > 0)
                                            <tr>
                                                <td>{{ $discountLabel }} ({{ $discountPercent }}%)</td>
                                                <td>-₹{{ number_format($discountAmount, 2) }}</td>
                                            </tr>
                                        @endif

                                        @if ($roundOffVisible)
                                            <tr>
                                                <td>{{ $roundOffLabel }}</td>
                                                <td>{{ $roundOff >= 0 ? '+' : '' }}₹{{ number_format($roundOff, 2) }}
                                                </td>
                                            </tr>
                                        @endif

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif


                    {{-- ===============================
                 | TOTAL AMOUNT
                 =============================== --}}
                    @if ($totalVisible)
                        <div class="invoice-table-footer totalamount-footer">
                            <div class="table-footer-right">
                                <table class="totalamt-table">
                                    <tbody>
                                        <tr>
                                            <td><strong>{{ $totalLabel }}</strong></td>
                                            <td><strong>₹{{ number_format($finalAmount, 2) }}</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif


                    {{-- ===============================
 | AMOUNT RECEIVED
 =============================== --}}
                    @php
                        /* ===============================
  | LABELS
  =============================== */
                        $cashReceivedLabel =
                            $templateSettings['invoice_footer.cash_received_label']->label ?? 'Cash Received';
                        $onlineReceivedLabel =
                            $templateSettings['invoice_footer.online_received_label']->label ?? 'Online Received';
                        $bankReceivedLabel =
                            $templateSettings['invoice_footer.bank_received_label']->label ?? 'Bank Received';
                        $cardReceivedLabel =
                            $templateSettings['invoice_footer.card_received_label']->label ?? 'Card Received';
                        $totalReceivedLabel =
                            $templateSettings['invoice_footer.total_received_label']->label ?? 'Total Received';
                        $balanceDueLabel =
                            $templateSettings['invoice_footer.balance_due_label']->label ?? 'Balance Due';

                        /* ===============================
  | VISIBILITY FLAGS
  =============================== */
                        $cashVisible = $templateSettings['invoice_footer.cash_received_label']->is_visible ?? true;
                        $onlineVisible = $templateSettings['invoice_footer.online_received_label']->is_visible ?? true;
                        $bankVisible = $templateSettings['invoice_footer.bank_received_label']->is_visible ?? true;
                        $cardVisible = $templateSettings['invoice_footer.card_received_label']->is_visible ?? true;
                        $totalReceivedVisible =
                            $templateSettings['invoice_footer.total_received_label']->is_visible ?? true;
                        $balanceDueVisible = $templateSettings['invoice_footer.balance_due_label']->is_visible ?? true;
                    @endphp

                    @if (
                        ($cashVisible && $cash > 0) ||
                            ($onlineVisible && $online > 0) ||
                            ($bankVisible && $bank > 0) ||
                            ($cardVisible && $card > 0) ||
                            $totalReceivedVisible ||
                            $balanceDueVisible)
                        <div class="invoice-table-footer payment-footer">
                            <div class="table-footer-right">
                                <table class="totalamt-table">
                                    <tbody>

                                        @if ($cashVisible && $cash > 0)
                                            <tr>
                                                <td>{{ $cashReceivedLabel }}</td>
                                                <td>₹{{ number_format($cash, 2) }}</td>
                                            </tr>
                                        @endif

                                        @if ($onlineVisible && $online > 0)
                                            <tr>
                                                <td>{{ $onlineReceivedLabel }}</td>
                                                <td>₹{{ number_format($online, 2) }}</td>
                                            </tr>
                                        @endif

                                        @if ($bankVisible && $bank > 0)
                                            <tr>
                                                <td>{{ $bankReceivedLabel }}</td>
                                                <td>₹{{ number_format($bank, 2) }}</td>
                                            </tr>
                                        @endif

                                        @if ($cardVisible && $card > 0)
                                            <tr>
                                                <td>{{ $cardReceivedLabel }}</td>
                                                <td>₹{{ number_format($card, 2) }}</td>
                                            </tr>
                                        @endif

                                        @if ($totalReceivedVisible)
                                            <tr>
                                                <td><strong>{{ $totalReceivedLabel }}</strong></td>
                                                <td><strong>₹{{ number_format($totalReceived, 2) }}</strong></td>
                                            </tr>
                                        @endif

                                        @if ($balanceDueVisible)
                                            <tr>
                                                <td>
                                                    <strong>
                                                        {{ $balanceAmount > 0 ? $balanceDueLabel : 'Change Return' }}
                                                    </strong>
                                                </td>
                                                <td>
                                                    <strong>₹{{ number_format(abs($balanceAmount), 2) }}</strong>
                                                </td>
                                            </tr>
                                        @endif

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif


                    <div class="total-amountdetails">
                        <p>Total amount ( in words): <span>
                                {{ NumberHelper::convertToWords((int) round(abs($finalAmount))) }}.</span></p>
                    </div>
                    @php
                        /* ===============================
 | VALUES
 =============================== */
                        $qrCode =
                            $templateSettings['visual_elements.qr_code']->value ??
                            ($templateSettings['visual_elements.qr_code']->default_value ??
                                '/assets/img/qr-code.svg');

                        $signatureImage =
                            $templateSettings['visual_elements.signature_image']->value ??
                            ($templateSettings['visual_elements.signature_image']->default_value ??
                                '/assets/img/signature.png');

                        $scanDetailsLabel =
                            $templateSettings['text_elements.scan_details_label']->value ??
                            ($templateSettings['text_elements.scan_details_label']->default_value ??
                                'Scan to View Receipt');

                        $paymentInfoLabel =
                            $templateSettings['text_elements.payment_info_label']->value ??
                            ($templateSettings['text_elements.payment_info_label']->default_value ?? 'Payment Info:');

                        $termsLabel =
                            $templateSettings['text_elements.terms_label']->value ??
                            ($templateSettings['text_elements.terms_label']->default_value ?? 'Terms & Conditions:');

                        $termsValue =
                            $templateSettings['text_elements.terms_value']->value ??
                            ($templateSettings['text_elements.terms_value']->default_value ?? "Goods once sold cannot be taken back or exchanged.\nManufacturer warranty applies as per company policy.");

                        /* ===============================
 | VISIBILITY
 =============================== */
                        $qrVisible = $templateSettings['visual_elements.qr_code']->is_visible ?? true;
                        $scanTextVisible = $templateSettings['text_elements.scan_details_label']->is_visible ?? true;
                        $paymentVisible = $templateSettings['text_elements.payment_info_label']->is_visible ?? true;
                        $signatureVisible = $templateSettings['visual_elements.signature_image']->is_visible ?? true;
                        $termsVisible = $templateSettings['text_elements.terms_label']->is_visible ?? true;
                        $signatureLabel =
                            $templateSettings['visual_elements.signature_image']->label ?? 'Authorized Signature';
                    @endphp

                    <div class="bank-details" style="margin-top: 15px; margin-bottom: 10px; width: 100%;">
                        <div class="row align-items-end" style="display: flex !important; flex-direction: row !important; justify-content: space-between !important; align-items: flex-end !important; width: 100% !important; margin: 0 !important;">
                            {{-- CUSTOMER SIGNATURE (LEFT SIDE) --}}
                            <div style="width: 50% !important; float: left !important; text-align: left !important;">
                                <div class="customer-signature-box" style="padding-left: 20px;">
                                    <div style="height: 35px;"></div>
                                    <div style="border-top: 1px solid #ccc; width: 180px; margin-bottom: 5px;"></div>
                                    <div style="font-weight: bold; font-size: 11px; color: #555;">Customer Signature</div>
                                </div>
                            </div>

                            {{-- AUTHORIZED SIGNATURE (RIGHT SIDE) --}}
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



                    @php
                        $thanksMessage = isset($templateSettings['text_elements.thanks_message'])
                            ? $templateSettings['text_elements.thanks_message']->value ??
                                ($templateSettings['text_elements.thanks_message']->default_value ??
                                    'Thanks for your Business')
                            : 'Thanks for your Business';
                    @endphp
                    {{-- Custom Content Blocks --}}
                    @if (isset($customBlocks) && $customBlocks->count() > 0)
                        @foreach ($customBlocks as $block)
                            @if ($block->position === 'before_footer' || $block->position === 'custom')
                                <div class="custom-block mt-3 {{ $block->css_class ?? '' }}"
                                    @if ($block->custom_css) style="{{ $block->custom_css }}" @endif>
                                    @if ($block->block_type === 'image' && $block->image_path)
                                        <img src="{{ asset($block->image_path) }}" alt="{{ $block->block_name }}"
                                            class="img-fluid">
                                    @elseif($block->block_type === 'info' && $block->content)
                                        <div>{!! $block->content !!}</div>
                                    @elseif($block->block_type === 'mixed')
                                        @if ($block->image_path)
                                            <img src="{{ asset($block->image_path) }}" alt="{{ $block->block_name }}"
                                                class="img-fluid mb-2">
                                        @endif
                                        @if ($block->content)
                                            <div>{!! $block->content !!}</div>
                                        @endif
                                    @else
                                        @if ($block->content)
                                            <div>{!! $block->content !!}</div>
                                        @endif
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    @endif

                    <div class="thanks-msg text-center">
                        {{ $thanksMessage }}
                    </div>
                </div>
            </div>
            <div class="file-link">
                <button class="download_btn download-link">
                    <i class="feather-download-cloud me-1"></i> <span>Download</span>
                </button>
                <a href="javascript:void(0)" onclick="printInvoiceSection()" class="print-link">
                    <i class="feather-printer"></i> <span>Print</span>
                </a>

            </div>

        </div>
    {{-- </div> --}}
    <script>
        function printInvoiceSection() {
            // const printContents = document.querySelector('.print-section').innerHTML;
            // const originalContents = document.body.innerHTML;

            // document.body.innerHTML = printContents;

            window.print();

            // document.body.innerHTML = originalContents;
            // window.location.reload(); // ensure JS & layout restored properly
        }
    </script>

    @endsection


