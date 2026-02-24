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
                padding: 6mm !important;
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
                font-size: 10px !important;
                padding: 3px !important;
                word-break: break-word;
            }

            tr {
                page-break-inside: avoid;
            }

            .invoice-one .invoice-table table tr td {
                height: 30px !important;
            }

            .invoice-one .invoice-table {
                margin: 0 !important;
                padding: 0 0 0px !important;
            }

            .invoice-one .inv-content {
                border: 1px solid #BDBDBD;
                margin: 0 !important;
                padding: 10px !important;
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
                                '/public/assets/img/logo2.png');

                        $logoDark =
                            $templateSettings['visual_elements.logo_dark']->value ??
                            ($templateSettings['visual_elements.logo_dark']->default_value ??
                                '/public/assets/img/logo2-white.png');

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
                    <div class="invoice-header">

                        {{-- LEFT --}}
                        @if ($invoiceTitleVisible || $companyNameVisible || $companyAddressVisible)
                            <div class="inv-header-left">

                                @if ($invoiceTitleVisible)
                                    <h4>{{ $invoiceTitle }}</h4>
                                @endif

                                @if ($companyNameVisible || $companyAddressVisible)
                                    <div class="company-details">
                                        <div class="gst-details">

                                            @if ($companyNameVisible)
                                                <h6>{{ $companyName }}</h6>
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
                                    <div class="col-sm-4">
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

                                            @if ($paymentStatusVisible)
                                                <div class="payment-status">
                                                    {{ $paymentStatusLabel }}
                                                    <p>
                                                        <span>{{ $invoice->status ?? 'Pending' }}</span>
                                                    </p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                                {{-- BILLING ADDRESS --}}
                                @if ($billingVisible)
                                    <div class="col-sm-4">
                                        <div class="patient-detailed">
                                            <div class="bill-add">
                                                {{ $billingAddressLabel }} :
                                            </div>
                                            <div class="add-details">
                                                {{ $customer->address1 }}
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                {{-- SHIPPING ADDRESS --}}
                                @if ($shippingVisible)
                                    <div class="col-sm-4">
                                        <div class="patient-detailed">
                                            <div class="bill-add">
                                                {{ $shippingAddressLabel }} :
                                            </div>
                                            <div class="add-details">
                                                {{ $invoice->shipping_address ?: $customer->address1 }}
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

                    <div class="invoice-table">
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr class="ecommercetable">
                                        @if ($columnVisibility['sr_no'])
                                            <th>{{ $columnLabels['sr_no'] }}</th>
                                        @endif
                                        @if ($columnVisibility['category'])
                                            <th>{{ $columnLabels['category'] }}</th>
                                        @endif
                                        @if ($columnVisibility['subcategory'])
                                            <th>{{ $columnLabels['subcategory'] }}</th>
                                        @endif
                                        @if ($columnVisibility['item'])
                                            <th>{{ $columnLabels['item'] }}</th>
                                        @endif
                                        @if ($columnVisibility['pre_code'])
                                            <th>{{ $columnLabels['pre_code'] }}</th>
                                        @endif
                                        @if ($columnVisibility['post_code'])
                                            <th>{{ $columnLabels['post_code'] }}</th>
                                        @endif
                                        @if ($columnVisibility['barcode'])
                                            <th>{{ $columnLabels['barcode'] }}</th>
                                        @endif
                                        @if ($columnVisibility['hsn_code'])
                                            <th>{{ $columnLabels['hsn_code'] }}</th>
                                        @endif
                                        @if ($columnVisibility['purity'])
                                            <th>{{ $columnLabels['purity'] }}</th>
                                        @endif
                                        @if ($columnVisibility['qty'])
                                            <th>{{ $columnLabels['qty'] }}</th>
                                        @endif
                                        @if ($columnVisibility['metal_rate'])
                                            <th>{{ $columnLabels['metal_rate'] }}</th>
                                        @endif
                                        @if ($columnVisibility['gross_wt'])
                                            <th>{{ $columnLabels['gross_wt'] }}</th>
                                        @endif
                                        @if ($columnVisibility['net_wt'])
                                            <th>{{ $columnLabels['net_wt'] }}</th>
                                        @endif
                                        @if ($columnVisibility['fine_wt'])
                                            <th>{{ $columnLabels['fine_wt'] }}</th>
                                        @endif
                                        @if ($columnVisibility['size'])
                                            <th>{{ $columnLabels['size'] }}</th>
                                        @endif
                                        @if ($columnVisibility['wastage'])
                                            <th>{{ $columnLabels['wastage'] }}</th>
                                        @endif
                                        @if ($columnVisibility['making'])
                                            <th>{{ $columnLabels['making'] }}</th>
                                        @endif
                                        @if ($columnVisibility['gst_percent'])
                                            <th>{{ $columnLabels['gst_percent'] }}</th>
                                        @endif
                                        @if ($columnVisibility['gst_amount'])
                                            <th>{{ $columnLabels['gst_amount'] }}</th>
                                        @endif
                                        @if ($columnVisibility['other_charges'])
                                            <th>{{ $columnLabels['other_charges'] }}</th>
                                        @endif
                                        @if ($columnVisibility['diamond_amount'])
                                            <th>{{ $columnLabels['diamond_amount'] }}</th>
                                        @endif
                                        @if ($columnVisibility['stone_amount'])
                                            <th>{{ $columnLabels['stone_amount'] }}</th>
                                        @endif
                                        @if ($columnVisibility['packet_amount'])
                                            <th>{{ $columnLabels['packet_amount'] }}</th>
                                        @endif
                                        @if ($columnVisibility['amount'])
                                            <th class="text-end">{{ $columnLabels['amount'] }}</th>
                                        @endif
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($invoice->items as $item)
                                        {{-- MAIN PRODUCT ROW --}}
                                        <tr>
                                            @if ($columnVisibility['sr_no'])
                                                <td>{{ $loop->iteration }}</td>
                                            @endif
                                            @if ($columnVisibility['category'])
                                                <td>{{ $item->category }}</td>
                                            @endif
                                            @if ($columnVisibility['subcategory'])
                                                <td>{{ $item->subcategory }}</td>
                                            @endif
                                            @if ($columnVisibility['item'])
                                                <td>{{ $item->item_name }}</td>
                                            @endif
                                            @if ($columnVisibility['pre_code'])
                                                <td>{{ $item->pre_code }}</td>
                                            @endif
                                            @if ($columnVisibility['post_code'])
                                                <td>{{ $item->post_code }}</td>
                                            @endif
                                            @if ($columnVisibility['barcode'])
                                                <td>{{ $item->barcode }}</td>
                                            @endif
                                            @if ($columnVisibility['hsn_code'])
                                                <td>{{ $item->hsn_code }}</td>
                                            @endif
                                            @if ($columnVisibility['purity'])
                                                <td>{{ $item->purity }}</td>
                                            @endif
                                            @if ($columnVisibility['qty'])
                                                <td>{{ $item->quantity }}</td>
                                            @endif
                                            @if ($columnVisibility['metal_rate'])
                                                <td>{{ number_format($item->metal_rate, 2) }}</td>
                                            @endif
                                            @if ($columnVisibility['gross_wt'])
                                                <td>{{ number_format($item->gross_weight, 3) }}</td>
                                            @endif
                                            @if ($columnVisibility['net_wt'])
                                                <td>{{ number_format($item->net_weight, 3) }}</td>
                                            @endif
                                            @if ($columnVisibility['fine_wt'])
                                                <td>{{ number_format($item->final_fn_weight ?? 0, 3) }}</td>
                                            @endif
                                            @if ($columnVisibility['size'])
                                                <td>{{ $item->size }}</td>
                                            @endif
                                            @if ($columnVisibility['wastage'])
                                                <td>{{ $item->wastage_percent }}%</td>
                                            @endif
                                            @if ($columnVisibility['making'])
                                                <td>{{ number_format($item->making_final_amount ?? 0, 2) }}</td>
                                            @endif
                                            @if ($columnVisibility['gst_percent'])
                                                <td>{{ $item->gst_percent }}%</td>
                                            @endif
                                            @if ($columnVisibility['gst_amount'])
                                                <td>{{ number_format($item->gst_amount ?? 0, 2) }}</td>
                                            @endif
                                            @if ($columnVisibility['other_charges'])
                                                <td>{{ number_format($item->other_charges ?? 0, 2) }}</td>
                                            @endif
                                            @if ($columnVisibility['diamond_amount'])
                                                <td>{{ number_format($item->diamond_amount ?? 0, 2) }}</td>
                                            @endif
                                            @if ($columnVisibility['stone_amount'])
                                                <td>{{ number_format($item->stone_amount ?? 0, 2) }}</td>
                                            @endif
                                            @if ($columnVisibility['packet_amount'])
                                                <td>{{ number_format($item->packet_amount ?? 0, 2) }}</td>
                                            @endif
                                            @if ($columnVisibility['amount'])
                                                <td class="text-end">{{ number_format($item->final_price ?? 0, 2) }}</td>
                                            @endif
                                        </tr>

                                        {{-- UNIFIED GEMS & PACKET DETAILS ROW --}}
                                        @if (
                                            ($item->diamonds && $item->diamonds->count() > 0) ||
                                                ($item->stones && $item->stones->count() > 0) ||
                                                ($item->packets && $item->packets->count() > 0))
                                            <tr class="item-details-row">
                                                <td colspan="{{ count(array_filter($columnVisibility)) }}"
                                                    style="padding:4px 12px; border-top:none; background-color: #fcfcfc;">

                                                    {{-- Diamonds --}}
                                                    @if ($item->diamonds && $item->diamonds->count() > 0)
                                                        @foreach ($item->diamonds as $diamond)
                                                            <div
                                                                style="font-size:9.5px; margin:0; padding:1px 0; color: #444;">
                                                                <strong>Dia:</strong> {{ $diamond->diamond_weight }}ct |
                                                                {{ $diamond->pieces }}Pcs |
                                                                {{ $diamond->clarity }}/{{ $diamond->color }} |
                                                                {{ $diamond->cut }}
                                                            </div>
                                                        @endforeach
                                                    @endif

                                                    {{-- Stones --}}
                                                    @if ($item->stones && $item->stones->count() > 0)
                                                        @foreach ($item->stones as $stone)
                                                            <div
                                                                style="font-size:9.5px; margin:0; padding:1px 0; color: #444;">
                                                                <strong>St:</strong> {{ $stone->stone_name }} |
                                                                {{ $stone->stone_weight }}ct |
                                                                {{ $stone->pieces ?? 0 }}Pcs
                                                            </div>
                                                        @endforeach
                                                    @endif

                                                    {{-- Packets --}}
                                                    @if ($item->packets && $item->packets->count() > 0)
                                                        @foreach ($item->packets as $packet)
                                                            <div
                                                                style="font-size:9.5px; margin:0; padding:1px 0; color: #444;">
                                                                <strong>Pk:</strong> {{ $packet->packet_no }} |
                                                                {{ $packet->stone }} |
                                                                {{ $packet->weight }}CT |
                                                                {{ $packet->pcs }} Pcs
                                                                @if ($packet->clarity)
                                                                    | {{ $packet->clarity }}
                                                                @endif
                                                                @if ($packet->color)
                                                                    | {{ $packet->color }}
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
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

                        $finalAmount = $grossTotal;
                        $roundOff = $finalAmount - $grossTotal;

                        /* ===============================
                 | PAYMENT DETAILS
                 =============================== */
                        $cash = $invoice->cash_received ?? 0;
                        $online = $invoice->online_received ?? 0;
                        $bank = $invoice->bank_received ?? 0;
                        $card = $invoice->card_received ?? 0;

                        $totalReceived = $cash + $online + $bank + $card;
                        $balanceAmount = $finalAmount - $totalReceived;

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
                                '/public/assets/img/paid.svg');

                        $paidLogoVisible = $templateSettings['visual_elements.paid_logo']->is_visible ?? true;
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
                            <div class="table-footer-left notes">
                                @if ($status === 'paid' && $paidLogoVisible)
                                    <img src="{{ asset($paidLogo) }}" alt="Paid">
                                @elseif($status === 'partial')
                                    <span class="badge bg-warning">Partially Paid</span>
                                @else
                                    <span class="badge bg-danger">Unpaid</span>
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
                                '/public/assets/img/qr-code.svg');

                        $signatureImage =
                            $templateSettings['visual_elements.signature_image']->value ??
                            ($templateSettings['visual_elements.signature_image']->default_value ??
                                '/public/assets/img/signature.png');

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

                    @if ($qrVisible || $paymentVisible || $signatureVisible || $termsVisible)
                        <div class="bank-details">
                            <div class="row align-items-start">

                                {{-- QR COLUMN --}}
                                @if ($qrVisible)
                                    <div class="col-md-4 text-center">
                                        <div class="qr">
                                            <img src="{{ asset($qrCode) }}" alt="QR Code" style="max-width:120px;">
                                            @if ($scanTextVisible)
                                                <h6 class="scan-details mt-2">{{ $scanDetailsLabel }}</h6>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                                {{-- PAYMENT INFO COLUMN --}}
                                @if ($paymentVisible)
                                    <div class="col-md-4">
                                        <div class="pay-details">
                                            <span class="payment-title d-block mb-1">{{ $paymentInfoLabel }}</span>
                                            <div><span>Debit Card :</span> 465 *************645</div>
                                            <div><span>Amount :</span> $1,815</div>
                                        </div>
                                    </div>
                                @endif

                                {{-- SIGNATURE COLUMN --}}
                                @if ($signatureVisible)
                                    <div class="col-md-4">
                                        <div class="signature-box">
                                            <img src="{{ asset($signatureImage) }}" alt="Signature"
                                                style="max-width:150px;">
                                            <div class="signature-label mt-1">{{ $signatureLabel }}</div>
                                        </div>
                                    </div>
                                @endif

                            </div>

                            {{-- TERMS (FULL WIDTH) --}}
                            @if ($termsVisible)
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <div class="terms-condition">
                                            <span>{{ $termsLabel }}</span>
                                            <ol>
                                                <li>Goods once sold cannot be taken back or exchanged.</li>
                                                <li>Manufacturer warranty applies as per company policy.</li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif



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


