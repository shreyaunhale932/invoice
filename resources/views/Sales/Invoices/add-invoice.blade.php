<?php $page = 'add-invoice'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <!-- Select2 CSS -->

    <script src="{{ asset('/assets/js/sellcalculation.js') }}"></script>
    <!-- <script src="{{ asset('/assets/js/sellcalculation.js') }}"></script> -->
    <!-- Summernote CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/css/intlTelInput.css" />
    <!-- Intl-Tel-Input CSS -->
    <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet"> -->


    <style>
        .readonly-field {
            pointer-events: none;
            background-color: #e9ecef;
            cursor: not-allowed;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.1);
            border-radius: 15px;
            transition: all 0.3s ease;
        }

        .dark .glass-card {
            background: rgba(30, 30, 30, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3);
        }

        .glass-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 40px 0 rgba(31, 38, 135, 0.15);
        }

        .form-group-item {
            background: transparent !important;
            border: none !important;
            padding: 0 !important;
        }

        .section-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 700;
            margin-bottom: 20px;
            border-bottom: 2px solid rgba(118, 75, 162, 0.2);
            padding-bottom: 10px;
            display: inline-block;
        }

        .dark .section-header {
            background: linear-gradient(135deg, #a18cd1 0%, #fbc2eb 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            border-bottom: 2px solid rgba(251, 194, 235, 0.2);
        }

        .form-control,
        .form-select,
        .select {
            border-radius: 8px;
            border: 1px solid #ced4da;
            padding: 10px 15px;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #764ba2;
            box-shadow: 0 0 0 0.25rem rgba(118, 75, 162, 0.25);
        }

        .dark .form-control,
        .dark .form-select,
        .dark .select {
            background-color: #2b2b2b;
            border-color: #444;
            color: #fff;
        }

        .dark .form-control:focus,
        .dark .form-select:focus {
            border-color: #a18cd1;
            box-shadow: 0 0 0 0.25rem rgba(161, 140, 209, 0.25);
        }

        label {
            font-weight: 600;
            color: #4a5568;
            margin-bottom: 8px;
        }

        .dark label {
            color: #e2e8f0;
        }

        .custom-btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 8px;
            padding: 10px 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .custom-btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(118, 75, 162, 0.4);
        }

        /* Invoice specific fixes */
        .invoice-total-box {
            background: transparent !important;
            border: none !important;
        }

        .glass-card table {
            background: transparent !important;
        }

        .glass-card th {
            background: rgba(118, 75, 162, 0.1) !important;
            color: #4a5568 !important;
            font-weight: 600 !important;
            border-color: rgba(0, 0, 0, 0.08) !important;
        }

        .dark .glass-card th {
            background: rgba(161, 140, 209, 0.1) !important;
            color: #cbd5e0 !important;
            border-color: rgba(255, 255, 255, 0.05) !important;
        }

        .glass-card td {
            border-color: rgba(0, 0, 0, 0.08) !important;
        }

        .dark .glass-card td {
            border-color: rgba(255, 255, 255, 0.05) !important;
        }


        /* Grid layout for entryTable */
        #entryTable {
            border: none !important;
            display: block;
            width: 100%;
        }

        #entryTable thead {
            display: none;
        }

        #entryTable tbody {
            display: block;
            width: 100%;
        }

        #entryTable tr {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            background: rgba(255, 255, 255, 0.4);
            padding: 20px;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .dark #entryTable tr {
            background: rgba(30, 30, 30, 0.4);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        #entryTable td {
            display: block;
            flex: 1 1 calc(25% - 15px);
            /* 4 columns */
            min-width: 200px;
            border: none !important;
            padding: 0 !important;
        }

        @media (max-width: 992px) {
            #entryTable td {
                flex: 1 1 calc(50% - 15px);
                /* 2 columns */
            }
        }

        @media (max-width: 576px) {
            #entryTable td {
                flex: 1 1 100%;
                /* 1 column */
            }
        }

        .entry-label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 5px;
            color: #4a5568;
        }

        .dark .entry-label {
            color: #cbd5e0;
        }

        /* Payments breakdown styling */
        .payment-system-container {
            background: rgba(255, 255, 255, 0.9) !important;
            border: 1px solid rgba(0, 0, 0, 0.1) !important;
            border-radius: 12px !important;
        }

        .dark .payment-system-container {
            background: rgba(45, 45, 45, 0.9) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
        }

        .payment-row-item {
            transition: all 0.2s ease-in-out;
            border: 1px solid rgba(0, 0, 0, 0.08) !important;
        }

        .dark .payment-row-item {
            background: #333 !important;
            border: 1px solid rgba(255, 255, 255, 0.08) !important;
        }

        .payment-row-item:hover {
            background-color: #f8f9fa !important;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .dark .payment-row-item:hover {
            background-color: #3d3d3d !important;
        }

        .payment-account-select,
        .payment-ref-input,
        .payment-details-input,
        .payment-amount-input {
            background-color: #fff !important;
            color: #333 !important;
            border: 1px solid #ced4da !important;
            border-radius: 4px !important;
            padding: 4px 8px !important;
        }

        .dark .payment-account-select,
        .dark .payment-ref-input,
        .dark .payment-details-input,
        .dark .payment-amount-input {
            background-color: #2b2b2b !important;
            color: #fff !important;
            border: 1px solid #555 !important;
        }
    </style>


    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="container-fluid p-0">
                <div class="page-header mb-4">
                    <h2 class="section-header fs-3 mb-0">
                        Add Invoice
                    </h2>
                </div>

                <form action="{{ route('invoices.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">

                            <!-- BASIC DETAILS -->
                            <div class="card glass-card mb-4 p-4">
                                <h4 class="section-header">Basic Details</h4>
                                <div class="form-group-item border-0 mb-0">
                                    <div class="row align-items-center">
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <label>Invoice Number</label>
                                                <input type="text" class="form-control" value="{{ $previewInvoiceNo }}"
                                                    name="invoice_no" readonly>

                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <label>Customer Name</label>
                                                <ul class="form-group-plus css-equal-heights">
                                                    <li>
                                                        <select class="select" name="customer_id" id="customerDropdown"
                                                            required>
                                                            <option value="">Choose Customer</option>
                                                            @foreach ($customers as $customer)
                                                                <option value="{{ $customer->id }}"
                                                                    data-state="{{ $customer->state }}">
                                                                    {{ $customer->name }}</option>
                                                            @endforeach
                                                        </select>



                                                    </li>
                                                    <li>
                                                        <button type="button" class="btn custom-btn-primary text-white"
                                                            data-bs-toggle="modal" data-bs-target="#addCustomerModal">
                                                            +
                                                        </button>

                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <label>Invoice Date</label>
                                                <div class="cal-icon cal-icon-info">
                                                    <input type="text" class="datetimepicker form-control"
                                                        placeholder="Select Date" name="invoice_date"
                                                        value="{{ date('d-m-Y') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="due_date" value="">
                                        {{-- <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="input-block mb-3">
                                            <label>Status</label>
                                            <select class="select" name="status">
                                                <option>Choose a Status</option>
                                                <option>Unpaid</option>
                                                <option>Partially paid</option>
                                                <option>Paid</option>
                                                <option>Overdue</option>
                                                <option>Cancelled</option>
                                                <option>Refunded</option>
                                                <option>Draft</option>
                                            </select>
                                        </div>
                                    </div> --}}

                                        <div id="custom-fields-container" class="input-block mb-3">
                                            @foreach ($customFields as $field)
                                                <label>{{ $field->field_label }}</label>
                                                <input class="form-control" type="text"
                                                    name="custom_fields_existing[{{ $field->id }}]" />
                                            @endforeach


                                        </div>
                                        {{-- <div id="custom-fields-container" class="input-block mb-3">
                                        <div class="row custom-field">
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <input
                                                    type="text"
                                                    name="custom_fields_new[0][label]"
                                                    placeholder="Field Label"
                                                    class="form-control" />
                                            </div>

                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <input
                                                    type="text"
                                                    name="custom_fields_new[0][value]"
                                                    placeholder="Field Value"
                                                    class="form-control" />
                                            </div>
                                        </div>
                                    </div> --}}

                                    </div>
                                    {{-- <button class="btn btn-outline-primary" type="button" id="add-custom-field">Add Custom Field</button> --}}
                                </div>

                                {{-- <button type="button" id="addItemBtn" class="btn btn-outline-primary">+ Add Item</button> --}}
                                {{-- <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#gstConfigModal">
                                Configure GST
                            </button>
                            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editColumnsModal">
                                Customize Columns
                            </button> --}}
                            </div>

                            <!-- PRODUCT ITEMS -->
                            <div class="card glass-card mb-4 p-4">
                                <h4 class="section-header">Product Items</h4>
                                <div class="row mb-3">
                                    <div class="col-lg-6 col-md-8 col-sm-12">
                                        <label>Search Product Code</label>
                                        <input type="text" id="productBarcodeSearch" list="productSearchSuggestions"
                                            class="form-control" placeholder="Enter Barcode / Product Code" autofocus>
                                        <datalist id="productSearchSuggestions">
                                            @foreach ($products as $product)
                                                <option
                                                    value="{{ $product->pre_code }}-{{ $product->post_code }}-{{ $product->barcode }}">
                                                    {{ $product->product_name }}</option>
                                            @endforeach
                                        </datalist>
                                        <select id="productSearch" style="display: none;">
                                            <option value="">Search by Product Code/Barcode</option>

                                            @foreach ($products as $product)
                                                @php
                                                    $gstAmount = $product->gst_amount ?? 0;
                                                    $goldPrice = $product->gold_price ?? 0;
                                                    $finalPrice = $product->final_price ?? 0;

                                                    $goldWithoutGst = max(0, $goldPrice - $gstAmount);
                                                    $finalWithoutGst = max(0, $finalPrice - $gstAmount);

                                                    $packetsJson = $product->packets
                                                        ->map(function ($p) {
                                                            return [
                                                                'packet_no' => $p->packet_no,
                                                                'packet_type' => $p->packet_type ?? 'Diamond',
                                                                'pcs' => $p->pcs,
                                                                'certificate_no' => $p->certificate_no,
                                                                'stone' => optional($p->stone)->name,
                                                                'clarity' => optional($p->clarity)->name,
                                                                'color' => optional($p->color)->name,
                                                                'cut' => optional($p->cut)->name,
                                                                'shape' => optional($p->shape)->name,
                                                                // 'chalni' => optional($p->chalni)->name,
                                                                'mm' => optional($p->mm)->name,
                                                                'weight' => $p->weight,
                                                                'wt_in_gram' => $p->wt_in_gram,
                                                                'uom' => $p->uom,
                                                                'rate' => $p->rate,
                                                                'amount' => $p->amount,
                                                            ];
                                                        })
                                                        ->values();
                                                @endphp

                                                <option value="{{ $product->id }}"
                                                    data-name="{{ $product->product_name }}"
                                                    data-barcode="{{ $product->barcode }}"
                                                    data-hsn="{{ $product->hsn_code }}"
                                                    data-gross_weight="{{ $product->gross_weight }}"
                                                    data-net_weight="{{ $product->net_weight }}"
                                                    data-final_fn_weight="{{ $product->final_fn_weight }}"
                                                    data-size="{{ $product->size }}"
                                                    data-quantity="{{ $product->quantity }}"
                                                    data-wastage_percent="{{ $product->wastage_percent }}"
                                                    data-wastage_amount="{{ $product->wastage_amount }}"
                                                    data-making_price="{{ $product->making_price }}" {{-- CATEGORY --}}
                                                    data-making_type="{{ $product->making_type }}"
                                                    data-making_final_amount="{{ $product->making_final_amount }}"
                                                    data-category-id="{{ $product->category_id }}"
                                                    data-category-name="{{ optional($product->category)->category_name }}"
                                                    {{-- SUBCATEGORY --}}
                                                    data-subcategory-id="{{ $product->subcategory_id }}"
                                                    data-subcategory-name="{{ optional($product->subcategory)->subcategory_name }}"
                                                    data-gst_percent="{{ $product->gst_percent }}"
                                                    data-gst_amount="{{ $gstAmount }}"
                                                    data-metal_rate="{{ optional($product->metalRate)->price_per_gram }}"
                                                    {{-- ✅ GST REMOVED VALUES --}}
                                                    data-gold_price="{{ number_format($goldWithoutGst, 2, '.', '') }}"
                                                    data-final_price="{{ number_format($finalWithoutGst, 2, '.', '') }}"
                                                    data-pre_code="{{ $product->pre_code }}"
                                                    data-post_code="{{ $product->post_code }}"
                                                    data-diamonds='@json($product->diamonds)'
                                                    data-stones='@json($product->stones)'
                                                    data-packets='@json($packetsJson)'>
                                                    {{ $product->pre_code }}-{{ $product->post_code }}-{{ $product->barcode }}
                                                    ({{ $product->product_name }})
                                                </option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>




                                <div id="productInfoSection" style="display: none;">
                                    <table class="table table-bordered" id="entryTable">
                                        <thead>
                                            <tr>
                                                <th>Category</th>
                                                <th>SubCategory</th>
                                                <th>Product Name</th>
                                                <th>Item Code</th>
                                                <th>Post Code</th>
                                                {{-- <th>Prod Code</th> --}}
                                                {{-- <th>Barcode</th --}}
                                                {{-- <th>HSN Code</th> --}}
                                                <th>Metal Rate</th>
                                                <th>Qty</th>
                                                <th>GS Wt</th>
                                                <th>Net Wt</th>
                                                <th>Fn Wt</th>
                                                <th>Size</th>
                                                <th>Wastage %</th>
                                                <th>Mkg</th>
                                                <th>Mkg Type</th>
                                                <th>Mkg Amt</th>
                                                <th>Gold Price</th>
                                                <th>Final price</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td style="display:none">
                                                    <input type="hidden" name="product_id[]" id="entry_product_id">
                                                </td>

                                                <td>
                                                    <span class="entry-label">Category</span>
                                                    <input type="text" name="category[]" class="form-control"
                                                        style="pointer-events: none; background-color: #e9ecef;">
                                                </td>
                                                <td>
                                                    <span class="entry-label">SubCategory</span>
                                                    <input type="text" name="subcategory[]" class="form-control"
                                                        style="pointer-events: none; background-color: #e9ecef;">
                                                </td>
                                                <td>
                                                    <span class="entry-label">Product Name</span>
                                                    <input type="text" name="product_name[]" class="form-control"
                                                        style="pointer-events: none; background-color: #e9ecef;">
                                                </td>
                                                <td>
                                                    <span class="entry-label">Item Code</span>
                                                    <input type="text" name="pre_code[]" class="form-control"
                                                        style="pointer-events: none; background-color: #e9ecef;">
                                                </td>
                                                <td>
                                                    <span class="entry-label">Post Code</span>
                                                    <input type="text" name="post_code[]" class="form-control"
                                                        style="pointer-events: none; background-color: #e9ecef;">
                                                </td>
                                                <input type="hidden" name="barcode[]"
                                                    class="form-control"style="pointer-events: none; background-color: #e9ecef;">

                                                <input type="hidden" name="hsn_code[]" class="form-control"
                                                    style="pointer-events: none; background-color: #e9ecef;">
                                                <td>
                                                    <span class="entry-label">Metal Rate</span>
                                                    <input type="number" step="0.01" name="metal_rate[]"
                                                        class="form-control">
                                                </td>
                                                <td>
                                                    <span class="entry-label">Qty</span>
                                                    <input type="number" name="quantity[]" class="form-control"
                                                        value="1"
                                                        style="pointer-events: none; background-color: #e9ecef;">
                                                </td>
                                                <td>
                                                    <span class="entry-label">GS Wt</span>
                                                    <input type="number" step="0.001" name="gross_weight[]"
                                                        class="form-control"
                                                        style="pointer-events: none; background-color: #e9ecef;">
                                                </td>
                                                <td>
                                                    <span class="entry-label">Net Wt</span>
                                                    <input type="number" step="0.001" name="net_weight[]"
                                                        class="form-control"
                                                        style="pointer-events: none; background-color: #e9ecef;">
                                                </td>
                                                <td>
                                                    <span class="entry-label">Fn Wt</span>
                                                    <input type="number" step="0.001" name="final_fn_weight[]"
                                                        class="form-control"
                                                        style="pointer-events: none; background-color: #e9ecef;">
                                                </td>
                                                <td>
                                                    <span class="entry-label">Size</span>
                                                    <input type="text" name="size[]" class="form-control"
                                                        style="pointer-events: none; background-color: #e9ecef;">
                                                </td>
                                                <td>
                                                    <span class="entry-label">Wastage %</span>
                                                    <input type="number" step="0.01" name="wastage_percent[]"
                                                        class="form-control"
                                                        style="pointer-events: none; background-color: #e9ecef;">
                                                </td>
                                                <td>
                                                    <span class="entry-label">Wastage Amt</span>
                                                    <input type="number" step="0.01" name="wastage_amount[]"
                                                        class="form-control"
                                                        style="pointer-events: none; background-color: #e9ecef;">
                                                </td>
                                                <td>
                                                    <span class="entry-label">Mkg</span>
                                                    <input type="number" step="0.01" name="making_price[]"
                                                        class="form-control">
                                                </td>
                                                <td>
                                                    <span class="entry-label">Mkg Type</span>
                                                    <select name="making_type[]" class="form-control">
                                                        <option value="val">Value</option>
                                                        <option value="per_gld_val">% of Gold Value</option>
                                                        <option value="per_pcs">Per Pcs</option>
                                                        <option value="per_gm_nw" selected>Rate/Gm of Nw</option>
                                                        <option value="per_gm_gw">Rate/Gm of Gw</option>
                                                        <option value="per_gm_fine_wt">Rate/Gm of Fine Wt</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <span class="entry-label">Mkg Amt</span>
                                                    <input type="number" step="0.01" name="making_final_amount[]"
                                                        class="form-control">
                                                    <input type="hidden" name="gst_percent[]">
                                                    <input type="hidden" name="gst_amount[]">
                                                </td>
                                                <td>
                                                    <span class="entry-label">Gold Price</span>
                                                    <input type="number" step="0.01" name="total_amount[]"
                                                        class="form-control"
                                                        style="pointer-events: none; background-color: #e9ecef;">
                                                </td>
                                                <td>
                                                    <span class="entry-label">Final price</span>
                                                    <input type="number" step="0.01" name="final_price[]"
                                                        class="form-control"
                                                        style="pointer-events: none; background-color: #e9ecef;">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div id="diamondSection">
                                        <h5 class="mt-4">Diamonds</h5>
                                        <table class="table table-bordered" id="diamondTable">
                                            <thead>
                                                <tr>
                                                    <th>Clarity</th>
                                                    <th>Cut</th>
                                                    <th>Color</th>
                                                    <th>Pieces</th>
                                                    <th>Diamond Weight (carat)</th>
                                                    <th>Price Per Carat</th>
                                                    <th>Final Price</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                    <div id="stoneSection">
                                        <h5 class="mt-4">Stones</h5>
                                        <table class="table table-bordered" id="stoneTable">
                                            <thead>
                                                <tr>
                                                    <th>Stone Name</th>
                                                    <th>Weight</th>
                                                    <th>Rate</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                    <div id="packetSection">
                                        <h5 class="mt-4">Packets</h5>
                                        <table class="table table-bordered" id="packetTable">
                                            <thead>
                                                <tr>
                                                    <th>Packet No</th>
                                                    <th>Packet Type</th>
                                                    <th>Pieces</th>
                                                    <th>Cert.No.</th>
                                                    <th>Stone</th>
                                                    <th>Clarity</th>
                                                    <th>Color</th>
                                                    <th>Cut</th>
                                                    <th>Shape</th>
                                                    {{-- <th>Chalni</th> --}}
                                                    <th>MM</th>
                                                    <th>Wt(CT)</th>
                                                    <th>Wt(GM)</th>
                                                    <th>UOM</th>
                                                    <th>Rate</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>




                                    <button type="button" id="addItemBtn" class="btn btn-success mt-2">
                                        + Add Item
                                    </button>
                                </div>
                                <h5 class="mt-4">Added Items</h5>

                                <table class="table table-bordered" id="itemsTable">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            {{-- <th>Code</th> --}}
                                            <th>Barcode</th>
                                            <th>Gs Wt</th>
                                            <th>Net Wt</th>
                                            <th>Fn Wt</th>
                                            <th>Metal Rate</th>
                                            <th>Wastage Amt</th>
                                            <th>Making</th>
                                            {{-- <th>Diamond Amt</th>
                                            <th>Stone Amt</th> --}}
                                            <th>Pkt Diamond Amt</th>
                                            <th>Pkt Stone Amt</th>
                                            <th>Final Amt</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>

                            </div>
                            <!-- Exchange / Old Gold Section -->
                            <div class="card glass-card mt-4 p-4 border-0 shadow-none bg-transparent">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Exchange/Old Gold</h5>
                                    <button type="button" class="btn btn-warning btn-sm" id="addExchangeItem">
                                        + Purchase Old Gold
                                    </button>
                                </div>
                                <div class="card-body p-0">
                                    <table class="table table-bordered mb-0" id="exchangeTable">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>Desc</th>
                                                <th>Metal</th>
                                                <th>GW</th>
                                                <th>LW</th>
                                                <th>NW</th>
                                                <th>Purity</th>
                                                <th>Fine Wt</th>
                                                <th>Rate</th>
                                                <th>Amount</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Dynamic rows will be added here -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Diamond Exchange Section -->
                            <div class="card glass-card mt-4 p-4 border-0 shadow-none bg-transparent">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Diamond Exchange</h5>
                                    <button type="button" class="btn btn-warning btn-sm" id="addExchangeDiamond">
                                        + Exchange Diamond
                                    </button>
                                </div>
                                <div class="card-body p-0">
                                    <table class="table table-bordered mb-0" id="exchangeDiamondTable">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>Desc</th>
                                                <th>Clarity</th>
                                                <th>Cut</th>
                                                <th>Color</th>
                                                <th>Pieces</th>
                                                <th>Weight (carat)</th>
                                                <th>Rate/Carat</th>
                                                <th>Amount</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Dynamic rows will be added here -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Unsettled Advances / Udhar Section -->
                            <div class="card mt-4" id="unsettledEntriesSection" style="display: none;">
                                <div class="card-header">
                                    <h5 class="mb-0" style="color:red;">Customer Unsettled Advance/Udhar</h5>
                                </div>
                                <div class="card-body p-0">
                                    <table class="table table-bordered mb-0" id="unsettledEntriesTable">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>Date</th>
                                                <th>Type</th>
                                                <th>Total Amount</th>
                                                <th>Remaining Amount</th>
                                                <th>Settle?</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Dynamic rows -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>








                            <!-- <h4 class="mt-3">Grand Total: ₹<span id="grandTotal">0.00</span></h4> -->
                            {{-- <button class="btn btn-outline-secondary" id="showTermsBtn">+ Add Terms & Conditions</button>

                            <button class="btn btn-outline-danger" id="addNoteBtn">+ Add Note</button>

                            <button class="btn btn-outline-success" id="addDocBtn">+ Add Attachments</button>

                            <button class="btn btn-outline-secondary" id="addContactBtn">+ Add Contact</button>

                            <button class="btn btn-outline-primary" id="addInfoBtn">+ Add Additional Info</button> --}}
                            <div class="card glass-card mt-4 p-4">
                                <h4 class="section-header">Totals & Adjustments</h4>
                                <div class="form-group-item border-0 p-0">
                                    <div class="row">



                                        <div class="col-xl-6 col-lg-12">
                                            <div class="form-group-bank">

                                                <!-- hidden states -->
                                                <input type="hidden" id="businessState" value="">
                                                <input type="hidden" id="customerState" value="">

                                                <div class="invoice-total-box">
                                                    <div class="invoice-total-inner">

                                                        <!-- Taxable Amount -->
                                                        {{-- <p>
                                                            Taxable Amount
                                                            <span id="taxableAmount">₹0.00</span>
                                                            <input type="hidden" id="taxableAmountInput" value="0">
                                                        </p> --}}

                                                        <!-- Making Charge Section -->
                                                        <div
                                                            class="d-flex justify-content-between align-items-center mb-2">
                                                            <label>Total Making Charge</label>
                                                            <span id="totalMakingAmount">₹0.00</span>
                                                            <input type="hidden" id="totalMakingAmountInput"
                                                                value="">
                                                        </div>

                                                        <div
                                                            class="d-flex justify-content-between align-items-center mb-2">
                                                            <label>Making Discount %</label>
                                                            <input type="number" id="makingDiscountPercent"
                                                                class="form-control w-25" value="">
                                                            <span id="makingDiscountAmount">₹0.00</span>
                                                        </div>

                                                        <hr>

                                                        <!-- Wastage Charge Section -->
                                                        <div
                                                            class="d-flex justify-content-between align-items-center mb-2">
                                                            <label>Total Wastage Charge</label>
                                                            <span id="totalWastageAmount">₹0.00</span>
                                                            <input type="hidden" id="totalWastageAmountInput"
                                                                value="">
                                                        </div>

                                                        <div
                                                            class="d-flex justify-content-between align-items-center mb-2">
                                                            <label>Wastage Discount %</label>
                                                            <input type="number" id="wastageDiscountPercent"
                                                                class="form-control w-25" value="">
                                                            <span id="wastageDiscountAmount">₹0.00</span>
                                                        </div>

                                                        <hr>

                                                        <!-- Diamond/Stone/Packet Section -->
                                                        <div
                                                            class="d-flex justify-content-between align-items-center mb-2">
                                                            <label>Total Diamond Amount </label>
                                                            <span id="totalDiamondCombinedAmount">₹0.00</span>
                                                        </div>

                                                        <div
                                                            class="d-flex justify-content-between align-items-center mb-2">
                                                            <label>Total Stone/Other Amount</label>
                                                            <span id="totalStoneCombinedAmount">₹0.00</span>
                                                        </div>

                                                        <div
                                                            class="d-flex justify-content-between align-items-center mb-2">
                                                            <label>Total Diamond & Stone Price</label>
                                                            <span id="totalDiamondStonePacketAmount">₹0.00</span>
                                                            <input type="hidden" id="totalDiamondStonePacketAmountInput"
                                                                value="">
                                                        </div>

                                                        <div
                                                            class="d-flex justify-content-between align-items-center mb-2">
                                                            <label>Diamond Discount %</label>
                                                            <input type="number" id="diamondDiscountPercent"
                                                                class="form-control w-25" value="">
                                                            <span id="diamondDiscountAmount">₹0.00</span>
                                                        </div>

                                                        <hr>

                                                        <p>
                                                            Taxable Amount
                                                            <span id="taxableAmount">₹0.00</span>
                                                            <input type="hidden" id="taxableAmountInput" value="">
                                                        </p>


                                                        <div
                                                            class="d-flex justify-content-between align-items-center mb-2">
                                                            <label>Total Exchange</label>
                                                            <span id="totalExchangeAmount">₹0.00</span>
                                                            <input type="hidden" id="totalExchangeAmountInput"
                                                                value="">
                                                        </div>

                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <label>Final Discount %</label>
                                                            <input type="number" id="discountPercent"
                                                                class="form-control w-25" value="">
                                                            <span id="discountAmount">₹0.00</span>
                                                        </div>

                                                        <!-- Discounts breakdown and You Save badge -->
                                                        <div id="discountsUnderTaxable"
                                                            style="display: none; padding: 10px; margin-top: 10px; margin-bottom: 12px; background-color: rgba(40, 167, 69, 0.05); border-radius: 8px; border: 1px dashed rgba(40, 167, 69, 0.25);">
                                                            <div class="d-flex justify-content-between align-items-center mb-1"
                                                                style="font-size: 0.85rem; color: #555;">
                                                                <span>Making Discount:</span>
                                                                <span id="displayMakingDiscount">₹0.00</span>
                                                            </div>
                                                            <div class="d-flex justify-content-between align-items-center mb-1"
                                                                style="font-size: 0.85rem; color: #555;">
                                                                <span>Wastage Discount:</span>
                                                                <span id="displayWastageDiscount">₹0.00</span>
                                                            </div>
                                                            <div class="d-flex justify-content-between align-items-center mb-1"
                                                                style="font-size: 0.85rem; color: #555;">
                                                                <span>Diamond Discount:</span>
                                                                <span id="displayDiamondDiscount">₹0.00</span>
                                                            </div>
                                                            <div class="d-flex justify-content-between align-items-center mb-2"
                                                                style="font-size: 0.85rem; color: #555;">
                                                                <span>Final Discount:</span>
                                                                <span id="displayFinalDiscount">₹0.00</span>
                                                            </div>
                                                            <div class="d-flex justify-content-between align-items-center pt-2"
                                                                style="border-top: 1px solid rgba(40, 167, 69, 0.15);">
                                                                <span
                                                                    style="font-size: 0.85em; padding: 3px 6px; background-color: #28a745; color: white; border-radius: 4px; display: inline-block; font-weight: bold;">You
                                                                    Save</span>
                                                                <span id="totalSavedAmount" class="text-success fw-bold"
                                                                    style="font-size: 0.95rem;">₹0.00</span>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <!-- CGST -->
                                                        <div class="d-flex justify-content-between align-items-center"
                                                            id="cgstdiv">
                                                            <label>CGST %</label>
                                                            <input type="number" id="cgstPercent"
                                                                class="form-control w-25" value="">
                                                            <span id="cgstAmount">₹0.00</span>
                                                        </div>

                                                        <!-- SGST -->
                                                        <div class="d-flex justify-content-between align-items-center"
                                                            id="sgstdiv">
                                                            <label>SGST %</label>
                                                            <input type="number" id="sgstPercent"
                                                                class="form-control w-25" value="">
                                                            <span id="sgstAmount">₹0.00</span>
                                                        </div>

                                                        <!-- IGST -->
                                                        <div class="d-flex justify-content-between align-items-center"
                                                            id="igstdiv">
                                                            <label>IGST %</label>
                                                            <input type="number" id="igstPercent"
                                                                class="form-control w-25" value="">
                                                            <span id="igstAmount">₹0.00</span>
                                                        </div>

                                                        <!-- Final Discount -->

                                                        <hr>
                                                        <div
                                                            class="d-flex justify-content-between align-items-center mb-2">
                                                            <label>Total Amount</label>
                                                            <span id="totalInvoiceAmount">₹0.00</span>
                                                        </div>
                                                        <div
                                                            class="d-flex justify-content-between align-items-center mb-2">
                                                            <label>Round Off</label>
                                                            <span id="roundOffAmount">₹0.00</span>
                                                        </div>
                                                        <hr>
                                                        <h4>
                                                            Payable Amount
                                                            <span id="payableAmount">₹0.00</span>
                                                        </h4>
                                                        <hr>
                                                        <div
                                                            class="d-flex justify-content-between align-items-center mb-2">
                                                            <label>Total Settled (Udhar/Adv)</label>
                                                            <span id="totalSettledAmount">₹0.00</span>
                                                        </div>
                                                        <hr>
                                                        <h4>
                                                            Remaining Amount
                                                            <span id="remainingAmountFooter">₹0.00</span>
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-12">
                                            <div class="form-group-bank">

                                                <!-- hidden states -->
                                                <input type="hidden" id="businessState" value="">
                                                <input type="hidden" id="customerState" value="">

                                                <div class="invoice-total-box">
                                                    <div class="invoice-total-inner">
                                                        <!-- Dynamic Multiple Payments System -->
                                                        <div
                                                            class="payment-system-container p-3 mb-3 border rounded bg-light shadow-sm">
                                                            <h5
                                                                class="mb-3 d-flex align-items-center justify-content-between">
                                                                <span><i
                                                                        class="feather-credit-card me-2 text-primary"></i>Payment
                                                                    Breakdown</span>
                                                                <span class="badge bg-primary fs-6"
                                                                    id="totalPaymentsBadge">Total: ₹0.00</span>
                                                            </h5>

                                                            <!-- Cash Payments -->
                                                            <div class="payment-method-section mb-3 p-2 border-bottom">
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center mb-2">
                                                                    <span class="fw-bold text-secondary"><i
                                                                            class="feather-dollar-sign me-1"></i>Cash
                                                                        Payments</span>
                                                                    <button type="button"
                                                                        class="btn btn-sm btn-outline-success add-payment-row-btn"
                                                                        data-method="cash">
                                                                        <i class="feather-plus"></i> + Cash Row
                                                                    </button>
                                                                </div>
                                                                <div class="payment-rows-container"
                                                                    id="cashPaymentsContainer"></div>
                                                            </div>

                                                            <!-- Card Payments -->
                                                            <div class="payment-method-section mb-3 p-2 border-bottom">
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center mb-2">
                                                                    <span class="fw-bold text-secondary"><i
                                                                            class="feather-credit-card me-1"></i>Card
                                                                        Payments</span>
                                                                    <button type="button"
                                                                        class="btn btn-sm btn-outline-primary add-payment-row-btn"
                                                                        data-method="card">
                                                                        <i class="feather-plus"></i> + Card Row
                                                                    </button>
                                                                </div>
                                                                <div class="payment-rows-container"
                                                                    id="cardPaymentsContainer"></div>
                                                            </div>

                                                            <!-- Cheque Payments -->
                                                            <div class="payment-method-section mb-3 p-2 border-bottom">
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center mb-2">
                                                                    <span class="fw-bold text-secondary"><i
                                                                            class="feather-file-text me-1"></i>Cheque
                                                                        Payments</span>
                                                                    <button type="button"
                                                                        class="btn btn-sm btn-outline-info add-payment-row-btn"
                                                                        data-method="cheque">
                                                                        <i class="feather-plus"></i> + Cheque Row
                                                                    </button>
                                                                </div>
                                                                <div class="payment-rows-container"
                                                                    id="chequePaymentsContainer"></div>
                                                            </div>

                                                            <!-- UPI Payments -->
                                                            <div class="payment-method-section mb-3 p-2">
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center mb-2">
                                                                    <span class="fw-bold text-secondary"><i
                                                                            class="feather-smartphone me-1"></i>UPI
                                                                        Payments</span>
                                                                    <button type="button"
                                                                        class="btn btn-sm btn-outline-warning add-payment-row-btn"
                                                                        data-method="upi">
                                                                        <i class="feather-plus"></i> + UPI Row
                                                                    </button>
                                                                </div>
                                                                <div class="payment-rows-container"
                                                                    id="upiPaymentsContainer"></div>
                                                            </div>

                                                            <!-- Legacy hidden inputs for compatibility with other scripts -->
                                                            <input type="hidden" id="cashReceived" value="">
                                                            <input type="hidden" id="bankReceived" value="">
                                                            <input type="hidden" id="onlineReceived" value="">
                                                            <input type="hidden" id="cardReceived" value="">
                                                            <input type="hidden" id="roundOffInput" name="round_off"
                                                                value="">
                                                        </div>
                                                    </div>

                                                </div>
                                                <hr>

                                                <!-- Footer -->
                                                <div class="invoice-total-footer">

                                                    <h5 class="text-danger">
                                                        Remaining Amount
                                                        <span id="remainingAmount">₹0.00</span>
                                                        <input type="hidden" id="remainingamountInput" value="">

                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="card glass-card mt-4 p-4 text-end">
                            <div><a href="{{ route('invoices') }}" class="btn btn-light me-2">Cancel</a>
                                <button type="button" id="saveInvoiceBtn"
                                    class="btn custom-btn-primary text-white me-2">Save</button>
                                <button type="button" id="savePrintInvoiceBtn"
                                    class="btn custom-btn-primary text-white">Save & Print</button>

                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <!-- Edit Columns Modal ---->


    <div class="modal fade" id="addCustomerModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Add Customer</h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form id="customerForm">
                    @csrf

                    <div class="modal-body">

                        <div class="row">

                            <!-- Name -->
                            <div class="col-md-6 mb-3">
                                <label>Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" placeholder="Enter Name"
                                    required>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="col-md-6 mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control"
                                    placeholder="Enter Email Address">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Phone -->
                            <div class="col-md-6 mb-3">
                                <label>Phone <span class="text-danger">*</span></label>
                                <input type="text" name="phone" class="form-control" placeholder="Phone Number"
                                    required>
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- City -->
                            <div class="col-md-6 mb-3">
                                <label>City</label>
                                <input type="text" name="city" class="form-control" placeholder="Enter City">
                            </div>

                            <!-- Date of Birth -->
                            <div class="col-md-6 mb-3">
                                <label>Date of Birth</label>
                                <input type="date" name="dob" class="form-control">
                                @error('dob')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Anniversary Date -->
                            <div class="col-md-6 mb-3">
                                <label>Anniversary Date</label>
                                <input type="date" name="anniversary_date" class="form-control">
                                @error('anniversary_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Billing Address -->
                            <div class="row">

                                <div class="col-md-12 mb-2">
                                    <h6 class="fw-bold">Billing Address</h6>
                                </div>

                                <!-- Address -->
                                <div class="col-md-6 mb-3">
                                    <label>Address (Area)</label>
                                    <input type="text" name="address" class="form-control"
                                        placeholder="Enter Address (Area)">
                                </div>

                                <!-- Country -->
                                <div class="col-md-6 mb-3">
                                    <label>Country</label>
                                    <input type="text" name="country" class="form-control" value="INDIA"
                                        placeholder="Enter Country">
                                </div>

                                <!-- State -->
                                <div class="col-md-6 mb-3">
                                    <label>State <span class="text-danger">*</span></label>
                                    <select class="form-control" name="state" required>
                                        <option value="">Select State</option>
                                        <option value="Andhra Pradesh">Andhra Pradesh</option>
                                        <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                        <option value="Assam">Assam</option>
                                        <option value="Bihar">Bihar</option>
                                        <option value="Chhattisgarh">Chhattisgarh</option>
                                        <option value="Goa">Goa</option>
                                        <option value="Gujarat">Gujarat</option>
                                        <option value="Haryana">Haryana</option>
                                        <option value="Himachal Pradesh">Himachal Pradesh</option>
                                        <option value="Jharkhand">Jharkhand</option>
                                        <option value="Karnataka">Karnataka</option>
                                        <option value="Kerala">Kerala</option>
                                        <option value="Madhya Pradesh">Madhya Pradesh</option>
                                        <option value="Maharashtra">Maharashtra</option>
                                        <option value="Manipur">Manipur</option>
                                        <option value="Meghalaya">Meghalaya</option>
                                        <option value="Mizoram">Mizoram</option>
                                        <option value="Nagaland">Nagaland</option>
                                        <option value="Odisha">Odisha</option>
                                        <option value="Punjab">Punjab</option>
                                        <option value="Rajasthan">Rajasthan</option>
                                        <option value="Sikkim">Sikkim</option>
                                        <option value="Tamil Nadu">Tamil Nadu</option>
                                        <option value="Telangana">Telangana</option>
                                        <option value="Tripura">Tripura</option>
                                        <option value="Uttar Pradesh">Uttar Pradesh</option>
                                        <option value="Uttarakhand">Uttarakhand</option>
                                        <option value="West Bengal">West Bengal</option>
                                        <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                                        <option value="Chandigarh">Chandigarh</option>
                                        <option value="Dadra and Nagar Haveli and Daman and Diu">Dadra and Nagar Haveli and
                                            Daman and Diu</option>
                                        <option value="Delhi">Delhi</option>
                                        <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                                        <option value="Ladakh">Ladakh</option>
                                        <option value="Lakshadweep">Lakshadweep</option>
                                        <option value="Puducherry">Puducherry</option>
                                    </select>
                                    @error('state')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- City -->
                                <div class="col-md-6 mb-3">
                                    <label>City</label>
                                    <input type="text" name="city" class="form-control" placeholder="Enter City">
                                </div>

                                <!-- Pincode -->
                                <div class="col-md-6 mb-3">
                                    <label>Pincode</label>
                                    <input type="text" name="pincode" class="form-control"
                                        placeholder="Enter Pincode">
                                </div>

                            </div>

                            <hr>

                            <!-- Tax & Identity Details -->
                            <div class="row">

                                <div class="col-md-12 mb-2">
                                    <h6 class="fw-bold">Tax & Identity Details</h6>
                                </div>

                                <!-- GST -->
                                <div class="col-md-6 mb-3">
                                    <label>GST No.</label>
                                    <input type="text" name="gst_no" class="form-control"
                                        placeholder="Enter GST Number">
                                </div>

                                <!-- Aadhaar -->
                                <div class="col-md-6 mb-3">
                                    <label>Aadhaar No.</label>
                                    <input type="text" name="adhaar_no" class="form-control"
                                        placeholder="Enter Aadhaar Number">
                                </div>

                                <!-- PAN -->
                                <div class="col-md-6 mb-3">
                                    <label>PAN No.</label>
                                    <input type="text" name="pan_no" class="form-control"
                                        placeholder="Enter PAN Number">
                                </div>

                                <!-- TAN -->
                                <div class="col-md-6 mb-3">
                                    <label>TAN</label>
                                    <input type="text" name="tan" class="form-control" placeholder="Enter TAN">
                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" id="saveCustomerBtn" class="btn btn-success">
                            Save Customer
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
    <!-- GST Configuration Modal -->
    <!-- GST Configuration Modal -->
    <div class="modal fade" id="gstConfigModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Configure GST</h5>
                </div>
                <div class="modal-body">
                    <label>Select GST Type:</label>
                    <select id="gstTypeSelect" class="form-control">
                        <option value="">-- Select --</option>
                        <option value="cgst_sgst">CGST + SGST</option>
                        <option value="igst">IGST</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn custom-btn-primary text-white" id="applyGstConfig">Apply</button>
                </div>
            </div>
        </div>
    </div>


    <!-- /Page Wrapper -->
    <!-- Select2 JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css">




    <script>
        const productOptions = @json($products);
    </script>


    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script> -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.js"></script>
    <script>
        // Get elements
        const showTermsBtn = document.getElementById('showTermsBtn');
        const termsDiv = document.getElementById('termsDiv');
        const addTermBtn = document.getElementById('addTermBtn');
        const closeTermsBtn = document.getElementById('closeTermsBtn');
        const termsList = document.getElementById('termsList');
        const termsForm = document.getElementById('termsForm');

        // Show the terms div
        showTermsBtn.addEventListener('click', () => {
            event.preventDefault();
            termsDiv.style.display = 'block';
            showTermsBtn.style.display = 'none';
        });

        // Close the terms div
        closeTermsBtn.addEventListener('click', () => {
            event.preventDefault();
            termsDiv.style.display = 'none';
            showTermsBtn.style.display = 'inline-block';
        });

        // Add new term
        addTermBtn.addEventListener('click', () => {
            event.preventDefault();
            addTermInput('');
        });

        // Function to add a new input
        function addTermInput(value = '') {
            const termItem = document.createElement('div');
            termItem.className = 'term-item';

            termItem.innerHTML = `
    <input type="text" name="terms[]" class="form-control" placeholder="Enter term" value="${value}">
    <button type="button" class="removeTermBtn">x</button>
  `;

            // Append to terms list
            termsList.appendChild(termItem);

            // Remove functionality
            termItem.querySelector('.removeTermBtn').addEventListener('click', () => {
                event.preventDefault();
                termItem.remove();
            });

            // Also append the input into the real form
            termsForm.appendChild(termItem);
        }

        // Optional: Add first term input by default
        addTermInput();
    </script>
    <script>
        // $(document).ready(function() {
        // Initialize Summernote (but keep hidden initially)
        $('#summernote').summernote({
            height: 200
        });

        // Show editor, hide button
        $('#addNoteBtn').on('click', function(event) {
            event.preventDefault();
            // alert("ok");
            $(this).hide();
            $('#noteEditor').show();
        });

        // Close editor, show button back
        $('#closeNoteBtn').on('click', function() {
            event.preventDefault();
            $('#noteEditor').hide();
            $('#addNoteBtn').show();

            // Optional: Clear summernote content
            $('#summernote').summernote('reset');
        });
        //});
    </script>
    <script>
        const allowedTypes = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'jpg', 'jpeg', 'png'];
        const maxFileSizeMB = 10;

        const addMoreBtn = document.getElementById('addMoreBtn');
        const fileInputsDiv = document.getElementById('fileInputs');

        addMoreBtn.addEventListener('click', (event) => {
            event.preventDefault();

            const wrapper = document.createElement('div');
            wrapper.className = 'file-input-row';
            wrapper.style.marginBottom = '8px';

            const newInput = document.createElement('input');
            newInput.type = 'file';
            newInput.name = 'attachments[]';
            newInput.classList.add('attachment-input');

            // Error message span
            const errorMsg = document.createElement('span');
            errorMsg.className = 'error-msg';
            errorMsg.style.color = 'red';
            errorMsg.style.fontSize = '12px';
            errorMsg.style.marginLeft = '10px';

            // Attach validation handler
            newInput.addEventListener('change', function() {
                validateFile(this, errorMsg);
            });

            const removeBtn = document.createElement('button');
            removeBtn.type = 'button';
            removeBtn.textContent = '❌';
            removeBtn.style.marginLeft = '8px';
            removeBtn.style.cursor = 'pointer';
            removeBtn.style.color = 'red';
            removeBtn.style.border = 'none';
            removeBtn.style.background = 'transparent';
            removeBtn.style.fontSize = '16px';

            removeBtn.addEventListener('click', () => {
                fileInputsDiv.removeChild(wrapper);
            });

            wrapper.appendChild(newInput);
            wrapper.appendChild(removeBtn);
            wrapper.appendChild(errorMsg); // Add error span to the row
            fileInputsDiv.appendChild(wrapper);
        });

        function validateFile(input, errorElement) {
            const file = input.files[0];
            errorElement.textContent = ''; // Clear previous error

            if (!file) return;

            const fileExtension = file.name.split('.').pop().toLowerCase();
            const fileSizeMB = file.size / (1024 * 1024); // convert to MB

            if (!allowedTypes.includes(fileExtension)) {
                errorElement.textContent = 'Invalid file type.';
                input.value = ''; // Clear input
                return;
            }

            if (fileSizeMB > maxFileSizeMB) {
                errorElement.textContent = 'File size exceeds 10MB.';
                input.value = ''; // Clear input
                return;
            }
        }

        // Initial file input validation for existing input(s)
        document.querySelectorAll('input[type="file"][name="attachments[]"]').forEach((input) => {
            const wrapper = input.closest('.file-input-row');
            let errorElement = wrapper.querySelector('.error-msg');

            // If no error span exists, create it
            if (!errorElement) {
                errorElement = document.createElement('span');
                errorElement.className = 'error-msg';
                errorElement.style.color = 'red';
                errorElement.style.fontSize = '12px';
                errorElement.style.marginLeft = '10px';
                wrapper.appendChild(errorElement);
            }

            input.addEventListener('change', function() {
                validateFile(this, errorElement);
            });
        });

        // Show/hide section logic
        const addDocBtn = document.getElementById('addDocBtn');
        const attachmentSection = document.getElementById('attachmentSection');
        const closeBtn = document.getElementById('closeBtn');

        addDocBtn.addEventListener('click', (event) => {
            event.preventDefault();
            attachmentSection.style.display = 'block';
            addDocBtn.style.display = 'none';
        });

        closeBtn.addEventListener('click', (event) => {
            event.preventDefault();
            attachmentSection.style.display = 'none';
            addDocBtn.style.display = 'inline-block';
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/intlTelInput.min.js"></script>
    <script>
        $(document).ready(function() {

            $('.select').select2({
                theme: 'bootstrap-5',
                width: '100%'
            });


        });
    </script>

    <script>
        const addContactBtn = document.getElementById('addContactBtn');
        const contactSection = document.getElementById('contactSection');
        const closeContactBtn = document.getElementById('closeContactBtn');

        const emailInput = document.getElementById('contactEmail');
        const phoneInput = document.getElementById('contactPhone');
        const emailError = document.getElementById('emailError');
        const phoneError = document.getElementById('phoneError');

        // Toggle display
        addContactBtn.addEventListener('click', () => {
            event.preventDefault();
            contactSection.style.display = 'block';
            addContactBtn.style.display = 'none';
        });

        closeContactBtn.addEventListener('click', () => {
            event.preventDefault();
            contactSection.style.display = 'none';
            addContactBtn.style.display = 'inline-block';
            clearForm();
        });

        function clearForm() {
            emailInput.value = '';
            phoneInput.value = '';
            emailError.textContent = '';
            phoneError.textContent = '';
        }

        // Email validation
        emailInput.addEventListener('blur', () => {
            event.preventDefault();
            emailError.textContent = '';
            const email = emailInput.value.trim();
            if (email && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                emailError.textContent = 'Please enter a valid email address.';
            }
        });

        // intl-tel-input
        const iti = window.intlTelInput(phoneInput, {
            preferredCountries: ['in', 'us', 'gb'],
            separateDialCode: true,
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/utils.js"
        });

        phoneInput.addEventListener('blur', () => {
            event.preventDefault();
            phoneError.textContent = '';
            if (phoneInput.value.trim() && !iti.isValidNumber()) {
                phoneError.textContent = 'Invalid phone number.';
            }
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            event.preventDefault();
            const addInfoBtn = document.getElementById('addInfoBtn');
            const infoSection = document.getElementById('infoSection');
            const fieldsContainer = document.getElementById('fieldsContainer');
            const addMoreBtn = document.getElementById('addMoreInfo');
            const closeSectionBtn = document.getElementById('closeSectionBtn');

            // Show section
            addInfoBtn.addEventListener('click', function() {
                event.preventDefault();
                infoSection.style.display = 'block';
                addInfoBtn.style.display = 'none';
            });

            // Close section
            closeSectionBtn.addEventListener('click', function() {
                event.preventDefault();
                infoSection.style.display = 'none';
                addInfoBtn.style.display = 'inline-block';
            });

            // Add more fields
            addMoreBtn.addEventListener('click', function() {
                event.preventDefault();
                const newRow = document.createElement('div');
                newRow.classList.add('key-value-row');
                newRow.innerHTML = `
        <input type="text" name="info_key[]" placeholder="Field Name">
        <input type="text" name="info_value[]" placeholder="Value">
        <button class="removeFieldBtn">Remove</button>
      `;
                fieldsContainer.appendChild(newRow);
            });

            // Remove individual key-value pair (event delegation)
            fieldsContainer.addEventListener('click', function(e) {
                event.preventDefault();
                if (e.target && e.target.classList.contains('removeFieldBtn')) {
                    e.preventDefault();
                    e.target.parentElement.remove();
                }
            });
        });
    </script>
    <script>
        let fieldIndex = 1;

        document.getElementById('add-custom-field').addEventListener('click', function() {

            const container = document.getElementById('custom-fields-container');

            const row = document.createElement('div');
            row.className = 'row custom-field mb-2';

            row.innerHTML = `
            <div class="col-lg-6 col-md-6 col-sm-12">
                <input
                    type="text"
                    name="custom_fields_new[${fieldIndex}][label]"
                    placeholder="Field Label"
                    class="form-control"
                />
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12">
                <input
                    type="text"
                    name="custom_fields_new[${fieldIndex}][value]"
                    placeholder="Field Value"
                    class="form-control"
                />
            </div>
        `;

            container.appendChild(row);
            fieldIndex++;
        });
    </script>
    <script>
        $(document).ready(function() {

            let lastSearchedValue = '';

            function searchProductByBarcode(showAlertOnFailure = false) {
                let searchValue = $('#productBarcodeSearch').val().trim();
                if (!searchValue) {
                    return;
                }
                if (searchValue === lastSearchedValue) {
                    return;
                }
                lastSearchedValue = searchValue;

                let matchedOption = null;
                $('#productSearch option').each(function() {
                    let option = $(this);
                    let barcode = String(option.data('barcode')).trim();
                    let preCode = String(option.data('pre_code')).trim();
                    let postCode = String(option.data('post_code')).trim();
                    let fullCode = (preCode + '-' + postCode + '-' + barcode).trim();

                    if (barcode === searchValue || fullCode === searchValue || option.val() ===
                        searchValue) {
                        matchedOption = option;
                        return false;
                    }
                });

                if (matchedOption) {
                    $('#productSearch').val(matchedOption.val()).trigger('change');
                    $('#productBarcodeSearch').val('');
                    lastSearchedValue = '';
                } else {
                    if (showAlertOnFailure) {
                        alert('Product with barcode/code "' + searchValue + '" not found.');
                        $('#productBarcodeSearch').val('').focus();
                    }
                    lastSearchedValue = '';
                }
            }

            $('#productBarcodeSearch').on('keydown', function(e) {
                if (e.key === 'Enter' || e.keyCode === 13) {
                    e.preventDefault();
                    searchProductByBarcode(true);
                }
            });

            $('#productBarcodeSearch').on('blur', function() {
                searchProductByBarcode(false);
            });

            $('#productBarcodeSearch').on('input', function() {
                searchProductByBarcode(false);
            });

            $('#productSearch').on('change', function() {

                let option = $(this).find(':selected');
                if (!option.val()) {
                    $('#productInfoSection').hide();
                    return;
                }

                $('#productInfoSection').show();

                // Existing product fill (keep this)
                let row = $('#entryTable tbody tr').first();
                row.find('#entry_product_id').val(option.val());

                // BASIC DATA
                row.find('input[name="pre_code[]"]').val(option.data('pre_code'));
                row.find('input[name="post_code[]"]').val(option.data('post_code'));
                row.find('input[name="product_name[]"]').val(option.data('name'));
                row.find('input[name="barcode[]"]').val(option.data('barcode'));
                row.find('input[name="hsn_code[]"]').val(option.data('hsn'));
                row.find('input[name="metal_rate[]"]').val(option.data('metal_rate'));
                row.find('input[name="gross_weight[]"]').val(option.data('gross_weight'));
                row.find('input[name="net_weight[]"]').val(option.data('net_weight'));
                row.find('input[name="final_fn_weight[]"]').val(option.data('final_fn_weight'));
                row.find('input[name="size[]"]').val(option.data('size'));
                row.find('input[name="wastage_percent[]"]').val(option.data('wastage_percent'));
                row.find('input[name="wastage_amount[]"]').val(option.data('wastage_amount'));
                row.find('input[name="making_price[]"]').val(option.data('making_price'));
                row.find('select[name="making_type[]"]').val(option.data('making_type'));
                row.find('input[name="making_final_amount[]"]').val(option.data('making_final_amount'));
                row.find('input[name="category[]"]').val(option.data('category-name'));
                row.find('input[name="subcategory[]"]').val(option.data('subcategory-name'));
                row.find('input[name="gst_amount[]"]').val(option.data('gst_amount'));
                row.find('input[name="gst_percent[]"]').val(option.data('gst_percent'));
                row.find('input[name="metal_rate[]"]').val(option.data('metal_rate'));
                row.find('input[name="total_amount[]"]').val(option.data('gold_price'));
                row.find('input[name="final_price[]"]').val(option.data('final_price'));
                row.find('input[name="quantity[]"]').val(option.data('quantity'));
                console.log('Quantity:', option.data('quantity'));

                // ✅ NEW PART
                let diamonds = option.data('diamonds') || [];
                let stones = option.data('stones') || [];
                let packets = option.data('packets') || [];

                // Show / Hide Diamond Section
                if (Array.isArray(diamonds) && diamonds.length > 0) {
                    $('#diamondSection').show();
                    renderDiamonds(diamonds);
                } else {
                    $('#diamondSection').hide();
                }

                // Show / Hide Stone Section
                if (Array.isArray(stones) && stones.length > 0) {
                    $('#stoneSection').show();
                    renderStones(stones);
                } else {
                    $('#stoneSection').hide();
                }

                // Show / Hide Packet Section
                if (Array.isArray(packets) && packets.length > 0) {
                    $('#packetSection').show();
                    renderPackets(packets);
                } else {
                    $('#packetSection').hide();
                }

                renderDiamonds(diamonds);
                renderStones(stones);
                renderPackets(packets);
                calculateRow(row);
            });

            function renderDiamonds(diamonds) {
                const tbody = $('#diamondTable tbody');
                tbody.empty();

                if (!Array.isArray(diamonds) || diamonds.length === 0) {
                    tbody.append(`<tr><td colspan="7" class="text-center">No Diamonds</td></tr>`);
                    return;
                }

                diamonds.forEach((d, index) => {
                    tbody.append(`
            <tr data-index="${index}">
                <td>
                    <input type="text"
                           class="form-control clarity"
                           name="diamonds[${index}][clarity]"
                           value="${d.clarity ?? ''}" style="pointer-events: none; background-color: #e9ecef;">
                </td>

                <td>
                    <input type="text"
                           class="form-control cut"
                           name="diamonds[${index}][cut]"
                           value="${d.cut ?? ''}" style="pointer-events: none; background-color: #e9ecef;">
                </td>

                <td>
                    <input type="text"
                           class="form-control color"
                           name="diamonds[${index}][color]"
                           value="${d.color ?? ''}" style="pointer-events: none; background-color: #e9ecef;">
                </td>

                <td>
                    <input type="number"
                           class="form-control pieces"
                           name="diamonds[${index}][pieces]"
                           value="${d.pieces ?? 0}" style="pointer-events: none; background-color: #e9ecef;">
                </td>

                <td>
                    <input type="number" step="0.001"
                           class="form-control diamond-weight"
                           name="diamonds[${index}][diamond_weight]"
                           value="${d.diamond_weight ?? 0}" style="pointer-events: none; background-color: #e9ecef;">
                </td>

                <td>
                    <input type="number" step="0.01"
                           class="form-control price-per-carat"
                           name="diamonds[${index}][price_per_carat]"
                           value="${d.price_per_carat ?? 0}">
                </td>

                <td>
                    <input type="number" step="0.01"
                           class="form-control diamond-total"
                           name="diamonds[${index}][diamond_final_price]"
                           value="${d.diamond_final_price ?? 0}"
                           style="pointer-events: none; background-color: #e9ecef;">
                </td>
            </tr>
        `);
                });
            }


            function renderStones(stones) {
                const tbody = $('#stoneTable tbody');
                tbody.empty();

                if (!Array.isArray(stones) || stones.length === 0) {
                    tbody.append(`<tr><td colspan="4" class="text-center">No Stones</td></tr>`);
                    return;
                }

                stones.forEach((s, index) => {
                    tbody.append(`
            <tr data-index="${index}">
                <td>
                    <input type="text"
                           class="form-control stone-name"
                           name="stones[${index}][stone_name]"
                           value="${s.stone_name ?? ''}" style="pointer-events: none; background-color: #e9ecef;">
                </td>

                <td>
                    <input type="number" step="0.001"
                           class="form-control stone-weight"
                           name="stones[${index}][stone_weight]"
                           value="${s.stone_weight ?? 0}" style="pointer-events: none; background-color: #e9ecef;">
                </td>

                <td>
                    <input type="number" step="0.01"
                           class="form-control stone-price"
                           name="stones[${index}][stone_price]"
                           value="${s.stone_price ?? 0}" >
                </td>

                <td>
                    <input type="number" step="0.01"
                           class="form-control stone-total"
                           name="stones[${index}][stone_final_price]"
                           value="${s.stone_final_price ?? 0}"
                           style="pointer-events: none; background-color: #e9ecef;">
                </td>
            </tr>
        `);
                });
            }


            function renderPackets(packets) {
                // alert('hiii');
                const tbody = $('#packetTable tbody');
                tbody.empty();

                if (!Array.isArray(packets) || packets.length === 0) {
                    tbody.append(`<tr><td colspan="15" class="text-center">No Packets</td></tr>`);
                    return;
                }

                packets.forEach((p, index) => {
                    tbody.append(`
        <tr data-index="${index}">
            <td>
                <input type="text" class="form-control"
                    name="packets[${index}][packet_no]"
                    value="${p.packet_no ?? ''}"
                    style="pointer-events: none; background-color: #e9ecef;">
            </td>

            <td>
                <select class="form-control" name="packets[${index}][packet_type]">
                    ${generateSelectOptions(masterPacketTypes, p.packet_type || 'Diamond')}
                </select>
            </td>

            <td>
                <input type="number" class="form-control"
                    name="packets[${index}][pcs]"
                    value="${p.pcs ?? 0}">
            </td>
             <td>
                <input type="text" class="form-control"
                    name="packets[${index}][certificate_no]"
                    value="${p.certificate_no ?? 0}">
            </td>

            <td>
                <select class="form-control" name="packets[${index}][stone]">
                    ${generateSelectOptions(masterStones, p.stone)}
                </select>
            </td>

            <td>
                <select class="form-control" name="packets[${index}][clarity]">
                    ${generateSelectOptions(masterClarities, p.clarity)}
                </select>
            </td>

            <td>
                <select class="form-control" name="packets[${index}][color]">
                    ${generateSelectOptions(masterColors, p.color)}
                </select>
            </td>

            <td>
                <select class="form-control" name="packets[${index}][cut]">
                    ${generateSelectOptions(masterCuts, p.cut)}
                </select>
            </td>

            <td>
                <select class="form-control" name="packets[${index}][shape]">
                    ${generateSelectOptions(masterShapes, p.shape)}
                </select>
            </td>

            <td>
                <select class="form-control" name="packets[${index}][mm]">
                    ${generateSelectOptions(masterMms, p.mm)}
                </select>
            </td>

            <td>
                <input type="number" step="0.001" class="form-control"
                    name="packets[${index}][weight]"
                    value="${p.weight ?? 0}">
            </td>
            <td>
                <input type="number" step="0.001" class="form-control"
                    name="packets[${index}][wt_in_gram]"
                    value="${p.wt_in_gram ?? 0}">
            </td>
            <td>
                <select class="form-control"
                    name="packets[${index}][uom]">
                    <option value="">Select UOM</option>
                    <option value="PCS" ${p.uom === 'PCS' ? 'selected' : ''}>PCS</option>
                    <option value="CT" ${p.uom === 'CT' ? 'selected' : ''}>CT</option>
                    <option value="WT" ${!p.uom || p.uom === 'WT' ? 'selected' : ''}>WT</option>
                </select>
            </td>

            <td>
                <input type="number" step="0.01" class="form-control packet-rate"
                    name="packets[${index}][rate]"
                    value="${p.rate ?? 0}">
            </td>

            <td>
                <input type="number" step="0.01" class="form-control packet-amount"
                    name="packets[${index}][amount]"
                    value="${p.amount ?? 0}"
                    style="pointer-events: none; background-color: #e9ecef;">
            </td>
        </tr>
        `);
                });
            }


        });
    </script>
    <script>
        let globalInvoiceItems = [];
        let editingItemId = null;
        let globalInvoiceId = null;

        document.addEventListener("DOMContentLoaded", function() {
            // Save button
            const saveInvoiceBtn = document.getElementById('saveInvoiceBtn');
            if (saveInvoiceBtn) {
                saveInvoiceBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    finalizeInvoice(false);
                });
            }

            // Save & Print button
            const savePrintInvoiceBtn = document.getElementById('savePrintInvoiceBtn');
            if (savePrintInvoiceBtn) {
                savePrintInvoiceBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    finalizeInvoice(true);
                });
            }
        });

        // ---------------------------------------------------------
        // ADD / UPDATE ITEM
        // ---------------------------------------------------------

        function showError(message) {
            alert(message);
            return false;
        }

        function isEmpty(val) {
            return val === null || val === undefined || val === '' || val == 0;
        }

        document.getElementById('addItemBtn').addEventListener('click', function(e) {
            e.preventDefault();

            const entryRow = document.querySelector('#entryTable tbody tr');

            const invoiceNo = document.querySelector('input[name="invoice_no"]').value;
            const invoiceDate = document.querySelector('input[name="invoice_date"]').value;
            const dueDate = document.querySelector('input[name="due_date"]').value;
            const customerId = document.querySelector('#customerDropdown').value;
            const productId = entryRow.querySelector('#entry_product_id').value;

            const category = entryRow.querySelector('input[name="category[]"]').value;
            const subcategory = entryRow.querySelector('input[name="subcategory[]"]').value;
            const metalRate = entryRow.querySelector('input[name="metal_rate[]"]').value;
            const grossWt = entryRow.querySelector('input[name="gross_weight[]"]').value;
            const netWt = entryRow.querySelector('input[name="net_weight[]"]').value;
            const fnWt = entryRow.querySelector('input[name="final_fn_weight[]"]').value;
            const goldPrice = entryRow.querySelector('input[name="total_amount[]"]').value;
            const finalPrice = entryRow.querySelector('input[name="final_price[]"]').value;

            if (!productId) {
                alert('Please select a product');
                return;
            }
            if (!customerId) {
                alert('Please select a customer first');
                return;
            }

            if (isEmpty(invoiceNo)) {
                return showError('Invoice number is required');
            }

            if (isEmpty(customerId)) {
                return showError('Please select a customer');
            }

            if (isEmpty(invoiceDate)) {
                return showError('Invoice date is required');
            }

            if (isEmpty(productId)) {
                return showError('Please select a product');
            }

            if (isEmpty(category)) {
                return showError('Category is required');
            }

            if (isEmpty(subcategory)) {
                return showError('Sub-category is required');
            }

            if (isEmpty(metalRate) || metalRate <= 0) {
                return showError('Metal rate must be greater than 0');
            }

            if (isEmpty(grossWt) || grossWt <= 0) {
                return showError('Gross weight must be greater than 0');
            }

            if (isEmpty(netWt) || netWt <= 0) {
                return showError('Net weight must be greater than 0');
            }
            if (isEmpty(fnWt) || fnWt <= 0) {
                return showError('fine weight must be greater than 0');
            }

            if (parseFloat(netWt) > parseFloat(grossWt)) {
                return showError('Net weight cannot be greater than Gross weight');
            }

            if (isEmpty(goldPrice) || goldPrice <= 0) {
                return showError('Gold price must be calculated');
            }

            if (isEmpty(finalPrice) || finalPrice <= 0) {
                return showError('Final price must be calculated');
            }


            const payload = {
                _token: '{{ csrf_token() }}',
                item_id: editingItemId, // Null if adding
                sell_invoice_id: globalInvoiceId, // Pass current invoice ID if exists
                // If editing, we need to send the invoice_id too? The controller finds it from item,
                // but for ADD we need it.
                // For ADD, the controller currently looks for existing pending invoice.

                product_id: productId,
                invoice_no: document.querySelector('input[name="invoice_no"]').value,
                customer_id: customerId,
                invoice_date: document.querySelector('input[name="invoice_date"]').value,
                due_date: document.querySelector('input[name="due_date"]').value,

                product_name: entryRow.querySelector('input[name="product_name[]"]').value,
                pre_code: entryRow.querySelector('input[name="pre_code[]"]').value,
                post_code: entryRow.querySelector('input[name="post_code[]"]').value,
                barcode: entryRow.querySelector('input[name="barcode[]"]').value,
                hsn_code: entryRow.querySelector('input[name="hsn_code[]"]').value,
                product_name: entryRow.querySelector('input[name="product_name[]"]').value,
                pre_code: entryRow.querySelector('input[name="pre_code[]"]').value,
                post_code: entryRow.querySelector('input[name="post_code[]"]').value,
                barcode: entryRow.querySelector('input[name="barcode[]"]').value,
                hsn_code: entryRow.querySelector('input[name="hsn_code[]"]').value,

                net_weight: entryRow.querySelector('input[name="net_weight[]"]').value,
                final_fn_weight: entryRow.querySelector('input[name="final_fn_weight[]"]').value,
                gross_weight: entryRow.querySelector('input[name="gross_weight[]"]').value,
                metal_rate: entryRow.querySelector('input[name="metal_rate[]"]').value,
                net_weight: entryRow.querySelector('input[name="net_weight[]"]').value,
                final_fn_weight: entryRow.querySelector('input[name="final_fn_weight[]"]').value,
                gross_weight: entryRow.querySelector('input[name="gross_weight[]"]').value,
                metal_rate: entryRow.querySelector('input[name="metal_rate[]"]').value,

                making_price: entryRow.querySelector('input[name="making_price[]"]').value,
                wastage_percent: entryRow.querySelector('input[name="wastage_percent[]"]').value,
                wastage_amount: entryRow.querySelector('input[name="wastage_amount[]"]').value,

                making_type: entryRow.querySelector('select[name="making_type[]"]').value,
                making_final_amount: entryRow.querySelector('input[name="making_final_amount[]"]').value,


                gst_amount: entryRow.querySelector('input[name="gst_amount[]"]').value,
                gst_percent: entryRow.querySelector('input[name="gst_percent[]"]').value,
                gst_amount: entryRow.querySelector('input[name="gst_amount[]"]').value,
                gst_percent: entryRow.querySelector('input[name="gst_percent[]"]').value,

                total_amount: entryRow.querySelector('input[name="total_amount[]"]').value,
                final_price: entryRow.querySelector('input[name="final_price[]"]').value,
                total_amount: entryRow.querySelector('input[name="total_amount[]"]').value,
                final_price: entryRow.querySelector('input[name="final_price[]"]').value,

                category: entryRow.querySelector('input[name="category[]"]').value,
                subcategory: entryRow.querySelector('input[name="subcategory[]"]').value,
                size: entryRow.querySelector('input[name="size[]"]').value,
                category: entryRow.querySelector('input[name="category[]"]').value,
                subcategory: entryRow.querySelector('input[name="subcategory[]"]').value,
                size: entryRow.querySelector('input[name="size[]"]').value,
                quantity: entryRow.querySelector('input[name="quantity[]"]').value,

                diamonds: collectDiamonds(),
                stones: collectStones(),
                packets: collectPackets(),
            };

            const url = editingItemId ?
                '{{ route('sell.invoice.updateItem') }}' :
                '{{ route('sell.invoice.addItem') }}';

            fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(payload)
                })
                .then(res => res.json())
                .then(res => {
                    if (!res.success) {
                        alert(res.message || 'Failed to save item');
                        return;
                    }

                    // Clear Form & Reset State
                    resetEntryForm();

                    // Refresh Items
                    fetchPendingInvoice(customerId);
                })
                .catch(error => {
                    console.error(error);
                    alert('Error saving item');
                });
        });

        // ---------------------------------------------------------
        // EDIT ITEM (Populate Form)
        // ---------------------------------------------------------
        function editItem(id) {
            const item = globalInvoiceItems.find(i => i.id == id);
            if (!item) return;

            $('#productInfoSection').show();

            editingItemId = id;
            document.getElementById('addItemBtn').textContent = 'Update Item';
            document.getElementById('addItemBtn').classList.remove('btn-success');
            document.getElementById('addItemBtn').classList.add('btn-warning');

            const p = item.product || {};
            const cat = p.category || {};
            const sub = p.subcategory || {};

            // Populate Entry Row
            const row = $('#entryTable tbody tr').first();
            row.find('#entry_product_id').val(item.product_id);

            // Category / Subcategory - Try direct item field first, then Product Relation
            row.find('input[name="category[]"]').val(
                item.category_name ||
                item.category ||
                item.product?.category?.category_name ||
                ''
            );

            // ✅ SUBCATEGORY NAME
            row.find('input[name="subcategory[]"]').val(
                item.subcategory_name ||
                item.subcategory ||
                item.product?.subcategory?.subcategory_name ||
                ''
            );
            row.find('input[name="product_name[]"]').val(item.item_name || p.product_name || '');

            row.find('input[name="pre_code[]"]').val(item.pre_code || p.pre_code || '');
            row.find('input[name="post_code[]"]').val(item.post_code || p.post_code || '');
            row.find('input[name="barcode[]"]').val(item.barcode || p.barcode || '');
            row.find('input[name="hsn_code[]"]').val(item.hsn_code || p.hsn_code || '');

            row.find('input[name="metal_rate[]"]').val(item.metal_rate || 0);
            row.find('input[name="quantity[]"]').val(item.quantity || p.quantity || 1); // Quantity
            row.find('input[name="gross_weight[]"]').val(item.gross_weight || 0);

            row.find('input[name="net_weight[]"]').val(item.net_weight || 0);
            row.find('input[name="final_fn_weight[]"]').val(item.final_fn_weight || 0);
            row.find('input[name="size[]"]').val(item.size || p.size || ''); // Size

            row.find('input[name="wastage_percent[]"]').val(item.wastage_percent || 0);
            row.find('input[name="wastage_amount[]"]').val(item.wastage_amount || 0);
            row.find('input[name="making_price[]"]').val(item.making_price || p.making_price || 0); // Making
            row.find('select[name="making_type[]"]').val(item.making_type || p.making_type || 0);
            row.find('input[name="making_final_amount[]"]').val(item.making_final_amount || p.making_final_amount || 0);

            row.find('input[name="gst_percent[]"]').val(item.gst_percent || p.gst_percent || 0);
            row.find('input[name="gst_amount[]"]').val(item.gst_amount || 0);
            row.find('input[name="total_amount[]"]').val(item.total_amount || 0);
            row.find('input[name="final_price[]"]').val(item.final_price || 0);

            // Populate Diamonds
            renderDiamonds(item.diamonds || []);
            // Populate Stones
            renderStones(item.stones || []);
            renderPackets(item.packets || []);

            // Re-trigger calculation to visually confirm?
            // calculateRow(row[0]); // Optional, might overwrite values
        }

        function resetEntryForm() {
            editingItemId = null;
            $('#productInfoSection').hide();
            $('#productSearch').val('').trigger('change'); // Reset product search select
            $('#productBarcodeSearch').val('').focus();
            lastSearchedValue = '';

            document.getElementById('addItemBtn').textContent = '+ Add Item';
            document.getElementById('addItemBtn').classList.remove('btn-warning');
            document.getElementById('addItemBtn').classList.add('btn-success');

            const entryRow = document.querySelector('#entryTable tbody tr');
            entryRow.querySelectorAll('input').forEach(input => {
                if (!input.hasAttribute('readonly') && input.type !== 'hidden') {
                    // Don't clear readonlies or hiddens blindly, but for entry row we want to clear most things
                    // Actually, most fields are readonly except weights/rates.
                    // Best way: Trigger the "Select Product" reset or just clear values.
                }
                // Determine which to clear. Currently clearing everything relevant.
                input.value = '';
            });
            // Clear tables
            document.querySelector('#diamondTable tbody').innerHTML = '';
            document.querySelector('#stoneTable tbody').innerHTML = '';
        }

        // ---------------------------------------------------------
        // FETCH PENDING (or Specific Invoice)
        // ---------------------------------------------------------
        $(document).ready(function() {
            // Check if we are in Edit Mode (Server passed invoice_id)
            var preloadedInvoiceId = "{{ $invoice_id ?? '' }}";
            var preloadedCustomerId = "{{ $customer_id ?? '' }}";

            if (preloadedInvoiceId && preloadedCustomerId) {
                // Set Customer
                $('#customerDropdown').val(preloadedCustomerId).trigger('change');
                // The change event below will fire, BUT standard logic fetches "Pending".
                // If we want to edit a "Completed" invoice, getPending might fail or return a different draft.
                // WE SHOULD CHANGE fetchPendingInvoice to accept optional InvoiceID or create a fetchInvoiceById.

                // Let's modify fetch logic to allow fetching by ID if provided, otherwise pending.
                // OR just rely on 'getPending' if we assume we are editing *that* user's invoice.
                // But USER might have multiple invoices?
                // The current controller logic 'getPendingInvoice' gets status='pending'.
                // If we are editing a PAID invoice, getPending returns nothing.

                // FIX: If we are specifically editing, we should fetch THAT invoice.
                fetchInvoiceDetails(preloadedInvoiceId);
            } else {
                updateAvailableProducts([]);
            }

            $('#customerDropdown').on('change', function() {



                let customerId = $(this).val();



                // Clear unsettled entries
                let tbody = $('#unsettledEntriesTable tbody');
                tbody.empty();
                $('#unsettledEntriesSection').hide();

                if (!customerId) return;

                let CustomerState = $(this).find(':selected').data('state');
                console.log('CustomerState=' + CustomerState);

                let AdminState =
                    "{{ optional(Auth::guard('admin')->user())->state ?? (optional(Auth::guard('web')->user())->state ?? '') }}";
                console.log('AdminState->' + AdminState);

                // Auto GST Logic
                if (AdminState === CustomerState) {

                    // ✅ SAME STATE → CGST + SGST
                    $('#cgstPercent').val(1.5);
                    $('#sgstPercent').val(1.5);
                    $('#igstPercent').val(0);

                    // SHOW CGST + SGST
                    // $('#cgstdiv').attr('style', 'display: flex !important;');
                    // $('#sgstdiv').attr('style', 'display: flex !important;');

                    // // HIDE IGST
                    // $('#igstdiv').attr('style', 'display: none !important;');

                } else {


                    // ✅ DIFFERENT STATE → IGST
                    $('#cgstPercent').val(0);
                    $('#sgstPercent').val(0);
                    $('#igstPercent').val(3);

                    // HIDE CGST + SGST
                    // $('#cgstdiv').attr('style', 'display: none !important;');
                    // $('#sgstdiv').attr('style', 'display: none !important;');

                    // // SHOW IGST
                    // $('#igstdiv').attr('style', 'display: flex !important;');
                }

                // 🔄 Recalculate totals
                if (typeof calculateInvoiceTotals === "function") {
                    calculateInvoiceTotals();
                }

                // 1️⃣ Load Pending Invoice
                fetchPendingInvoice(customerId);

                // 2️⃣ Load Unsettled Transactions
                $.ajax({
                    url: "/sell-invoice/customer-unsettled-entries/" + customerId,
                    type: "GET",
                    success: function(res) {

                        if (res.success && res.data.length > 0) {

                            $('#unsettledEntriesSection').show();

                            res.data.forEach((entry, index) => {

                                let tr = `
                        <tr>
                            <td>
                                ${entry.transaction_date}
                                <input type="hidden" class="settle-id" value="${entry.id}">
                            </td>

                            <td>
                                <span class="badge bg-secondary">
                                    ${entry.transaction_type}
                                </span>
                            </td>

                            <td>₹${parseFloat(entry.amount).toFixed(2)}</td>

                            <td class="remaining-amt" data-val="${entry.remaining_amount}">₹${parseFloat(entry.remaining_amount).toFixed(2)}</td>

                            <td>
                                <input type="checkbox"
                                    class="settle-checkbox"
                                    style="width: 20px; height: 20px;"
                                    data-type="${entry.transaction_type}">
                            </td>
                        </tr>
                    `;

                                tbody.append(tr);
                            });

                        }

                    },
                    error: function(err) {
                        console.log("Unsettled entry fetch error", err);
                    }
                });

            });
        });

        // New function to fetch specific invoice (for Edit / Paid invoices)
        function fetchInvoiceDetails(invoiceId) {
            $('#itemsTable tbody').empty();

            $.ajax({
                url: "{{ route('sell.invoice.getById', ':id') }}".replace(':id', invoiceId),
                type: 'GET',
                success: function(response) {
                    if (response.success && response.invoice) {
                        loadInvoiceData(response.invoice);
                    }
                },
                error: function(xhr) {
                    console.error('Error fetching invoice', xhr);
                }
            });

        }

        function ensureProductsInSearch(items) {
            if (!Array.isArray(items)) return;
            const productSearch = $('#productSearch');
            items.forEach(item => {
                if (item.product && item.product_id) {
                    let exists = productSearch.find(`option[value="${item.product_id}"]`).length > 0;
                    if (!exists) {
                        let p = item.product;
                        let option = $('<option>')
                            .val(p.id)
                            .attr('data-name', p.product_name || '')
                            .attr('data-barcode', p.barcode || '')
                            .attr('data-hsn', p.hsn_code || '')
                            .attr('data-gross_weight', p.gross_weight || 0)
                            .attr('data-net_weight', p.net_weight || 0)
                            .attr('data-final_fn_weight', p.final_fn_weight || 0)
                            .attr('data-size', p.size || '')
                            .attr('data-quantity', p.quantity || 1)
                            .attr('data-wastage_percent', p.wastage_percent || 0)
                            .attr('data-wastage_amount', p.wastage_amount || 0)
                            .attr('data-making_price', p.making_price || 0)
                            .attr('data-making_type', p.making_type || 0)
                            .attr('data-making_final_amount', p.making_final_amount || 0)
                            .attr('data-category-id', p.category_id || '')
                            .attr('data-category-name', p.category?.category_name || item.category_name || item
                                .category || '')
                            .attr('data-subcategory-id', p.subcategory_id || '')
                            .attr('data-subcategory-name', p.subcategory?.subcategory_name || item
                                .subcategory_name || item.subcategory || '')
                            .attr('data-gst_percent', p.gst_percent || 0)
                            .attr('data-gst_amount', p.gst_amount || 0)
                            .attr('data-pre_code', p.pre_code || '')
                            .attr('data-post_code', p.post_code || '')
                            .attr('data-diamonds', JSON.stringify(p.diamonds || []))
                            .attr('data-stones', JSON.stringify(p.stones || []))
                            .attr('data-packets', JSON.stringify(p.packets || []))
                            .text(
                                `${p.pre_code || ''}-${p.post_code || ''}-${p.barcode || ''} (${p.product_name || ''})`
                                );

                        productSearch.append(option);
                    }
                }
            });
        }

        function loadInvoiceData(invoice) {
            if (invoice && invoice.items) {
                ensureProductsInSearch(invoice.items);
            }
            globalInvoiceItems = invoice.items || [];
            globalInvoiceId = invoice.id;

            // Invoice Details
            $('input[name="invoice_no"]').val(invoice.invoice_no);
            if (invoice.invoice_date) {
                var date = new Date(invoice.invoice_date);
                var formattedDate = ("0" + date.getDate()).slice(-2) + "-" + (
                        "0" + (date.getMonth() + 1)).slice(-2) + "-" + date
                    .getFullYear();
                $('input[name="invoice_date"]').val(formattedDate);
            }
            if (invoice.invoice_due_date) {
                var dueDate = new Date(invoice.invoice_due_date);
                var formattedDueDate = ("0" + dueDate.getDate()).slice(-2) +
                    "-" + ("0" + (dueDate.getMonth() + 1)).slice(-2) + "-" +
                    dueDate.getFullYear();
                $('input[name="due_date"]').val(formattedDueDate);
            }

            // Set Totals / Payments
            $('#makingDiscountPercent').val(invoice.making_discount_percent);
            $('#diamondDiscountPercent').val(invoice.diamond_discount_percent);
            $('#discountPercent').val(invoice.discount_percent);
            // $('#cgstPercent').val(invoice.cgst_percent);
            // $('#sgstPercent').val(invoice.sgst_percent);
            // $('#igstPercent').val(invoice.igst_percent);
            // Payments
            $('#cashReceived').val(invoice.cash_received);
            $('#bankReceived').val(invoice.bank_received);
            $('#onlineReceived').val(invoice.online_received);
            $('#cardReceived').val(invoice.card_received);

            // Populate dynamic payment breakdown container
            $('.payment-rows-container').empty();
            if (invoice.payments && invoice.payments.length > 0) {
                invoice.payments.forEach(p => {
                    PaymentBreakdownManager.addPaymentRow(p.payment_method, p);
                });
            } else {
                if (parseFloat(invoice.cash_received) > 0) PaymentBreakdownManager.addPaymentRow('cash', {
                    amount: invoice.cash_received
                });
                if (parseFloat(invoice.bank_received) > 0) PaymentBreakdownManager.addPaymentRow('cheque', {
                    amount: invoice.bank_received
                });
                if (parseFloat(invoice.online_received) > 0) PaymentBreakdownManager.addPaymentRow('upi', {
                    amount: invoice.online_received
                });
                if (parseFloat(invoice.card_received) > 0) PaymentBreakdownManager.addPaymentRow('card', {
                    amount: invoice.card_received
                });

                if (
                    !(parseFloat(invoice.cash_received) > 0) &&
                    !(parseFloat(invoice.bank_received) > 0) &&
                    !(parseFloat(invoice.online_received) > 0) &&
                    !(parseFloat(invoice.card_received) > 0)
                ) {
                    PaymentBreakdownManager.addPaymentRow('cash');
                    PaymentBreakdownManager.addPaymentRow('cheque');
                    PaymentBreakdownManager.addPaymentRow('upi');
                    PaymentBreakdownManager.addPaymentRow('card');

                    // alert('hii');
                }
            }

            renderItemsTable(globalInvoiceItems);
            renderExchangeTable(invoice.exchange_items || []);
            calculateInvoiceTotals();

            // Update Button State to 'Update'
            const saveBtn = document.getElementById('saveInvoiceBtn');
            if (saveBtn) saveBtn.textContent = "Update";
            const savePrintBtn = document.getElementById('savePrintInvoiceBtn');
            if (savePrintBtn) savePrintBtn.textContent = "Update & Print";
        }

        function fetchPendingInvoice(customerId) {
            $('#itemsTable tbody').empty();
            const url = "{{ route('sell.invoice.getPending', ':customerId') }}".replace(':customerId', customerId);

            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    if (response.success && response.invoice) {
                        loadInvoiceData(response.invoice);
                    } else {
                        globalInvoiceItems = [];
                        globalInvoiceId = null;
                        renderItemsTable([]);
                    }
                }
            });
        }

        function updateAvailableProducts(items) {
            if (!items) {
                items = globalInvoiceItems || [];
            }
            let addedProductIds = items.map(item => String(item.product_id));

            const datalist = $('#productSearchSuggestions');
            datalist.empty();

            $('#productSearch option').each(function() {
                let opt = $(this);
                let val = opt.val();
                if (!val) return;
                let productId = String(val);

                if (!addedProductIds.includes(productId)) {
                    let barcode = (opt.data('barcode') || '').toString().trim();
                    let preCode = (opt.data('pre_code') || '').toString().trim();
                    let postCode = (opt.data('post_code') || '').toString().trim();
                    let fullCode = (preCode + '-' + postCode + '-' + barcode).trim();
                    let productName = opt.data('name') || '';

                    datalist.append(`<option value="${fullCode}">${productName}</option>`);
                }
            });
        }

        function renderItemsTable(items) {
            const tbody = $('#itemsTable tbody');
            tbody.empty();

            items.forEach(function(item) {

                // 🔹 Calculate Diamond Total
                let diamondTotal = 0;
                if (Array.isArray(item.diamonds)) {
                    item.diamonds.forEach(d => {
                        diamondTotal += parseFloat(d.diamond_final_price || 0);
                    });
                }

                // 🔹 Calculate Stone Total
                let stoneTotal = 0;
                if (Array.isArray(item.stones)) {
                    item.stones.forEach(s => {
                        stoneTotal += parseFloat(s.stone_final_price || 0);
                    });
                }

                let packetDiamondTotal = 0;
                let packetStoneTotal = 0;
                if (Array.isArray(item.packets)) {
                    item.packets.forEach(p => {
                        const pType = p.packet_type || '';
                        if (/dia|diamond/i.test(pType)) {
                            packetDiamondTotal += parseFloat(p.amount || 0);
                        } else {
                            packetStoneTotal += parseFloat(p.amount || 0);
                        }
                    });
                }

                const tr = `
            <tr>
                <td>
                    ${item.item_name || ''}
                    <!-- Used for invoice-level calculation -->
                    <input type="hidden" name="total_amount[]" value="${item.final_price || 0}">
                </td>


                <td>${item.barcode || ''}</td>
                <td>${item.gross_weight || ''}</td>
                <td>${item.net_weight || 0}</td>
                <td>${item.final_fn_weight || 0}</td>
                <td>${item.metal_rate || 0}</td>
                <td>${item.wastage_amount || 0}</td>
                <td>${item.making_final_amount || 0}</td>

                <td>₹${packetDiamondTotal.toFixed(2)}</td>
                <td>₹${packetStoneTotal.toFixed(2)}</td>

                <td>₹${parseFloat(item.final_price || 0).toFixed(2)}</td>

                <td>
                    <button type="button"
                            class="btn btn-warning btn-sm"
                            onclick="editItem(${item.id})">
                        Edit
                    </button>

                    <button type="button"
                            class="btn btn-danger btn-sm removeItem"
                            data-id="${item.id}">
                        X
                    </button>
                </td>
            </tr>
        `;
                tbody.append(tr);
            });
            updateAvailableProducts(items);
        }

        function renderExchangeTable(exchangeItems) {
            const tbody = $('#exchangeTable tbody');
            tbody.empty();

            exchangeItems.forEach(function(ex) {
                const tr = `
                <tr class="exchange-row">
                    <td><input type="text" name="exchange_description[]" class="form-control" value="${ex.description || ''}"></td>
                    <td>
                        <select name="exchange_metal[]" class="form-control">
                            <option value="Gold" ${ex.metal === 'Gold' ? 'selected' : ''}>Gold</option>
                            <option value="Silver" ${ex.metal === 'Silver' ? 'selected' : ''}>Silver</option>
                        </select>
                    </td>
                    <td><input type="number" step="0.001" name="exchange_gross[]" class="form-control exchange-gross" value="${ex.gross_weight || 0}"></td>
                    <td><input type="number" step="0.001" name="exchange_less[]" class="form-control exchange-less" value="${ex.less_weight || 0}"></td>
                    <td><input type="number" step="0.001" name="exchange_net[]" class="form-control exchange-net" readonly style="background-color: #e9ecef;" value="${ex.net_weight || 0}"></td>
                    <td><input type="number" step="0.01" name="exchange_purity[]" class="form-control exchange-purity" value="${ex.purity || ''}"></td>
                    <td><input type="number" step="0.001" name="exchange_fine[]" class="form-control exchange-fine" readonly style="background-color: #e9ecef;" value="${ex.fine_weight || 0}"></td>
                    <td><input type="number" step="0.01" name="exchange_rate[]" class="form-control exchange-rate" value="${ex.rate || 0}"></td>
                    <td><input type="number" step="0.01" name="exchange_amount[]" class="form-control exchange-amount" readonly style="background-color: #e9ecef;" value="${ex.amount || 0}"></td>
                    <td><button type="button" class="btn btn-danger btn-sm remove-exchange-row">X</button></td>
                </tr>
            `;
                tbody.append(tr);
            });
        }
        // FINALIZE INVOICE
        // ---------------------------------------------------------
        function finalizeInvoice(shouldPrint = false) {
            if (!globalInvoiceId) {
                alert('No active invoice to save.');
                return;
            }
            // Collect Exchange Items
            const exchange_items = [];
            $('.exchange-row').each(function() {
                const row = $(this);
                exchange_items.push({
                    description: row.find('input[name="exchange_description[]"]').val(),
                    metal: row.find('select[name="exchange_metal[]"]').val(),
                    purity: row.find('input[name="exchange_purity[]"]').val(),
                    gross_weight: row.find('input[name="exchange_gross[]"]').val(),
                    less_weight: row.find('input[name="exchange_less[]"]').val(),
                    net_weight: row.find('input[name="exchange_net[]"]').val(),
                    fine_weight: row.find('input[name="exchange_fine[]"]').val(),
                    wanted_amt: 0,
                    rate: row.find('input[name="exchange_rate[]"]').val(),
                    amount: row.find('input[name="exchange_amount[]"]').val(),
                });
            });

            // Collect Exchange Diamonds
            const exchange_diamonds = [];
            $('.exchange-diamond-row').each(function() {
                const row = $(this);
                exchange_diamonds.push({
                    description: row.find('input[name="exchange_dia_description[]"]').val(),
                    clarity: row.find('select[name="exchange_dia_clarity[]"]').val(),
                    cut: row.find('select[name="exchange_dia_cut[]"]').val(),
                    color: row.find('select[name="exchange_dia_color[]"]').val(),
                    pieces: row.find('input[name="exchange_dia_pieces[]"]').val(),
                    weight: row.find('input[name="exchange_dia_weight[]"]').val(),
                    rate: row.find('input[name="exchange_dia_rate[]"]').val(),
                    amount: row.find('input[name="exchange_dia_amount[]"]').val(),
                });
            });

            // Collect Invoice Level Data
            const payload = {
                _token: '{{ csrf_token() }}',
                sell_invoice_id: globalInvoiceId,
                customer_id: document.querySelector('#customerDropdown').value,
                invoice_date: document.querySelector('input[name="invoice_date"]').value,
                due_date: document.querySelector('input[name="due_date"]').value,
                taxable_amount: document.getElementById('taxableAmountInput').value,

                total_exchange_amount: document.getElementById('totalExchangeAmountInput').value,
                exchange_items: exchange_items,
                exchange_diamonds: exchange_diamonds,

                discount_percent: document.getElementById('discountPercent').value || 0,
                cgst_percent: document.getElementById('cgstPercent').value || 0,
                sgst_percent: document.getElementById('sgstPercent').value || 0,
                igst_percent: document.getElementById('igstPercent').value || 0,

                // New Discount Fields
                total_making_charge: document.getElementById('totalMakingAmountInput').value,
                making_discount_percent: document.getElementById('makingDiscountPercent').value,
                making_discount_amount: document.getElementById('makingDiscountAmount').innerText.replace('₹', '')
                    .replace(',', ''),
                total_wastage_charge: document.getElementById('totalWastageAmountInput').value,
                wastage_discount_percent: document.getElementById('wastageDiscountPercent').value,
                wastage_discount_amount: document.getElementById('wastageDiscountAmount').innerText.replace('₹', '')
                    .replace(',', ''),
                total_wastage_charge: document.getElementById('totalWastageAmountInput').value,
                wastage_discount_percent: document.getElementById('wastageDiscountPercent').value,
                wastage_discount_amount: document.getElementById('wastageDiscountAmount').innerText.replace('₹', '')
                    .replace(',', ''),
                total_diamond_stone_packet: document.getElementById('totalDiamondStonePacketAmountInput').value,
                diamond_discount_percent: document.getElementById('diamondDiscountPercent').value,
                diamond_discount_amount: document.getElementById('diamondDiscountAmount').innerText.replace('₹', '')
                    .replace(',', ''),
                diamond_total_amount: document.getElementById('totalDiamondStonePacketAmountInput').value - document
                    .getElementById('diamondDiscountAmount').innerText.replace('₹', '').replace(',', ''),

                cash_received: document.getElementById('cashReceived').value || 0,
                bank_received: document.getElementById('bankReceived').value || 0,
                online_received: document.getElementById('onlineReceived').value || 0,
                card_received: document.getElementById('cardReceived').value || 0,
                round_off: document.getElementById('roundOffInput').value || 0,
                payments: typeof PaymentBreakdownManager !== 'undefined' ? PaymentBreakdownManager.getPaymentsData() :
                [],
                settled_transactions: collectSettledTransactions(),
            };

            fetch('{{ route('sell.invoice.finalize') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(payload)
                })
                .then(res => res.json())
                .then(res => {
                    if (res.success) {
                        // alert('Invoice Saved Successfully!');

                        if (shouldPrint && res.print_url) {
                            let iframe = document.getElementById('invoicePrintIframe');
                            if (!iframe) {
                                iframe = document.createElement('iframe');
                                iframe.id = 'invoicePrintIframe';
                                iframe.style.position = 'fixed';
                                iframe.style.top = '0';
                                iframe.style.left = '0';
                                iframe.style.width = '100%';
                                iframe.style.height = '100vh';
                                iframe.style.zIndex = '9999';
                                iframe.style.border = 'none';
                                iframe.style.backgroundColor = '#fff';
                                document.body.appendChild(iframe);
                            }

                            iframe.style.display = 'block';
                            iframe.src = res.print_url + '?auto_print=1';

                            // Listen for message from iframe when print is done
                            window.addEventListener('message', function printListener(e) {
                                if (e.data === 'print_completed') {
                                    iframe.style.display = 'none';
                                    window.removeEventListener('message', printListener);
                                    window.location.href = res.redirect_url;
                                }
                            });
                        } else {
                            window.location.href = res.redirect_url;
                        }
                    } else {
                        alert('Error: ' + res.message);
                    }
                })
                .catch(err => {
                    console.error(err);
                    alert('An error occurred while finalizing.');
                });
        }

        // ---------------------------------------------------------
        // HELPERS (Existing Logic + Updates)
        // ---------------------------------------------------------
        function collectDiamonds() {
            let diamonds = [];
            document.querySelectorAll('#diamondTable tbody tr').forEach(row => {
                diamonds.push({
                    clarity: row.querySelector('.clarity')?.value,
                    cut: row.querySelector('.cut')?.value,
                    color: row.querySelector('.color')?.value,
                    pieces: row.querySelector('.pieces')?.value,
                    diamond_weight: row.querySelector('.diamond-weight')?.value,
                    price_per_carat: row.querySelector('.price-per-carat')?.value,
                    diamond_final_price: row.querySelector('.diamond-total')?.value,
                });
            });
            return diamonds;
        }

        function collectStones() {
            let stones = [];
            document.querySelectorAll('#stoneTable tbody tr').forEach(row => {
                stones.push({
                    stone_name: row.querySelector('.stone-name')?.value,
                    stone_weight: row.querySelector('.stone-weight')?.value,
                    stone_price: row.querySelector('.stone-price')?.value,
                    stone_final_price: row.querySelector('.stone-total')?.value,
                });
            });
            return stones;
        }

        function collectPackets() {
            let packets = [];

            document.querySelectorAll('#packetTable tbody tr').forEach(row => {
                packets.push({
                    packet_no: row.querySelector('[name*="[packet_no]"]')?.value,
                    packet_type: row.querySelector('[name*="[packet_type]"]')?.value,
                    pcs: row.querySelector('[name*="[pcs]"]')?.value,
                    certificate_no: row.querySelector('[name*="[certificate_no]"]')?.value,
                    stone: row.querySelector('[name*="[stone]"]')?.value,
                    clarity: row.querySelector('[name*="[clarity]"]')?.value,
                    color: row.querySelector('[name*="[color]"]')?.value,
                    cut: row.querySelector('[name*="[cut]"]')?.value,
                    shape: row.querySelector('[name*="[shape]"]')?.value,
                    // chalni: row.querySelector('[name*="[chalni]"]')?.value,
                    mm: row.querySelector('[name*="[mm]"]')?.value,
                    weight: row.querySelector('[name*="[weight]"]')?.value,
                    wt_in_gram: row.querySelector('[name*="[wt_in_gram]"]')?.value,
                    uom: row.querySelector('[name*="[uom]"]')?.value,
                    rate: row.querySelector('[name*="[rate]"]')?.value,
                    amount: row.querySelector('[name*="[amount]"]')?.value,
                });
            });

            return packets;
        }

        function collectSettledTransactions() {
            let transactions = [];
            $('.settle-checkbox:checked').each(function() {
                let row = $(this).closest('tr');
                transactions.push({
                    id: row.find('.settle-id').val(),
                    amount: row.find('.remaining-amt').data('val')
                });
            });
            return transactions;
        }


        function renderDiamonds(diamonds) {
            const tbody = $('#diamondTable tbody');
            tbody.empty();
            if (!Array.isArray(diamonds) || diamonds.length === 0) {
                tbody.append(`<tr><td colspan="7" class="text-center">No Diamonds</td></tr>`);
                return;
            }
            diamonds.forEach((d, index) => {
                tbody.append(`
        <tr data-index="${index}">
            <td><input type="text" class="form-control clarity" name="diamonds[${index}][clarity]" value="${d.clarity ?? ''}" ></td>
            <td><input type="text" class="form-control cut" name="diamonds[${index}][cut]" value="${d.cut ?? ''}" ></td>
            <td><input type="text" class="form-control color" name="diamonds[${index}][color]" value="${d.color ?? ''}" ></td>
            <td><input type="number" class="form-control pieces" name="diamonds[${index}][pieces]" value="${d.pieces ?? 0}" ></td>
            <td><input type="number" step="0.001" class="form-control diamond-weight" name="diamonds[${index}][diamond_weight]" value="${d.diamond_weight ?? 0}" ></td>
            <td><input type="number" step="0.01" class="form-control price-per-carat" name="diamonds[${index}][price_per_carat]" value="${d.price_per_carat ?? 0}"></td>
            <td><input type="number" step="0.01" class="form-control diamond-total" name="diamonds[${index}][diamond_final_price]" value="${d.diamond_final_price ?? 0}" style="pointer-events: none; background-color: #e9ecef;"></td>
        </tr>`);
            });
        }

        function renderStones(stones) {
            const tbody = $('#stoneTable tbody');
            tbody.empty();
            if (!Array.isArray(stones) || stones.length === 0) {
                tbody.append(`<tr><td colspan="4" class="text-center">No Stones</td></tr>`);
                return;
            }
            stones.forEach((s, index) => {
                tbody.append(`
         <tr data-index="${index}">
             <td><input type="text" class="form-control stone-name" name="stones[${index}][stone_name]" value="${s.stone_name ?? ''}" ></td>
             <td><input type="number" step="0.001" class="form-control stone-weight" name="stones[${index}][stone_weight]" value="${s.stone_weight ?? 0}" ></td>
             <td><input type="number" step="0.01" class="form-control stone-price" name="stones[${index}][stone_price]" value="${s.stone_price ?? 0}" ></td>
             <td><input type="number" step="0.01" class="form-control stone-total" name="stones[${index}][stone_final_price]" value="${s.stone_final_price ?? 0}" style="pointer-events: none; background-color: #e9ecef;"></td>
         </tr>`);
            });
        }

        const masterStones = @json($stones);
        const masterClarities = @json($clarities);
        const masterColors = @json($colors);
        const masterCuts = @json($cuts);
        const masterShapes = @json($shapes);
        const masterMms = @json($mms);
        const masterPacketTypes = @json($packet_types);

        function generateSelectOptions(list, selectedValue) {
            let options = '<option value="">Select</option>';
            list.forEach(item => {
                const isSelected = (item.name == selectedValue) ? 'selected' : '';
                options += `<option value="${item.name}" ${isSelected}>${item.name}</option>`;
            });
            return options;
        }

        function renderPackets(packets) {
            const tbody = $('#packetTable tbody');
            tbody.empty();

            if (!Array.isArray(packets) || packets.length === 0) {
                tbody.append(`<tr><td colspan="15" class="text-center">No Packets</td></tr>`);
                return;
            }

            packets.forEach((p, index) => {
                tbody.append(`
            <tr data-index="${index}">
                <td><input type="text" class="form-control" name="packets[${index}][packet_no]" value="${p.packet_no ?? ''}"></td>
                <td>
                    <select class="form-control" name="packets[${index}][packet_type]">
                        ${generateSelectOptions(masterPacketTypes, p.packet_type || 'Diamond')}
                    </select>
                </td>
                <td><input type="number" class="form-control" name="packets[${index}][pcs]" value="${p.pcs ?? 0}"></td>
                <td><input type="text" class="form-control" name="packets[${index}][certificate_no]" value="${p.certificate_no ?? 0}"></td>
                <td>
                    <select class="form-control" name="packets[${index}][stone]">
                        ${generateSelectOptions(masterStones, p.stone)}
                    </select>
                </td>
                <td>
                    <select class="form-control" name="packets[${index}][clarity]">
                        ${generateSelectOptions(masterClarities, p.clarity)}
                    </select>
                </td>
                <td>
                    <select class="form-control" name="packets[${index}][color]">
                        ${generateSelectOptions(masterColors, p.color)}
                    </select>
                </td>
                <td>
                    <select class="form-control" name="packets[${index}][cut]">
                        ${generateSelectOptions(masterCuts, p.cut)}
                    </select>
                </td>
                <td>
                    <select class="form-control" name="packets[${index}][shape]">
                        ${generateSelectOptions(masterShapes, p.shape)}
                    </select>
                </td>
                 <td>
                    <select class="form-control" name="packets[${index}][mm]">
                        ${generateSelectOptions(masterMms, p.mm)}
                    </select>
                 </td>
                <td><input type="number" step="0.001" class="form-control" name="packets[${index}][weight]" value="${p.weight ?? 0}"></td>
                <td><input type="number" step="0.001" class="form-control" name="packets[${index}][wt_in_gram]" value="${p.wt_in_gram ?? 0}"></td>
                <td>
                    <select class="form-control" name="packets[${index}][uom]">
                        <option value="PCS" ${p.uom === 'PCS' ? 'selected' : ''}>PCS</option>
                        <option value="CT" ${p.uom === 'CT' ? 'selected' : ''}>CT</option>
                        <option value="WT" ${p.uom === 'WT' ? 'selected' : ''}>WT</option>
                    </select>
                </td>
                <td><input type="number" step="0.01" class="form-control packet-rate" name="packets[${index}][rate]" value="${p.rate ?? 0}"></td>
                <td><input type="number" step="0.01" class="form-control packet-amount" name="packets[${index}][amount]" value="${p.amount ?? 0}"></td>
            </tr>
        `);
            });
        }
        // ---------------------------------------------------------
        // EXCHANGE / OLD GOLD LOGIC
        // ---------------------------------------------------------
        const defaultGoldRate24k =
            {{ \App\Models\MetalRate::where('admin_id', Auth::guard('admin')->id())->where('metal_type', 'Gold')->where('karat', '24')->value('price_per_gram') ?? 0 }};
        const defaultSilverRate =
            {{ \App\Models\MetalRate::where('admin_id', Auth::guard('admin')->id())->where('metal_type', 'Silver')->value('price_per_gram') ?? 0 }};

        $('#addExchangeItem').on('click', function() {
            const rowCount = $('#exchangeTable tbody tr').length;
            const tr = `
                <tr class="exchange-row">
                    <td><input type="text" name="exchange_description[]" class="form-control"></td>
                    <td>
                        <select name="exchange_metal[]" class="form-control exchange-metal">
                            <option value="Gold">Gold</option>
                            <option value="Silver">Silver</option>
                        </select>
                    </td>
                    <td><input type="number" step="0.001" name="exchange_gross[]" class="form-control exchange-gross"></td>
                    <td><input type="number" step="0.001" name="exchange_less[]" class="form-control exchange-less"></td>
                    <td><input type="number" step="0.001" name="exchange_net[]" class="form-control exchange-net" readonly style="background-color: #e9ecef;"></td>
                    <td><input type="number" step="0.01" name="exchange_purity[]" class="form-control exchange-purity"></td>
                    <td><input type="number" step="0.001" name="exchange_fine[]" class="form-control exchange-fine" readonly style="background-color: #e9ecef;"></td>
                    <td><input type="number" step="0.01" name="exchange_rate[]" class="form-control exchange-rate" value="${defaultGoldRate24k}"></td>
                    <td><input type="number" step="0.01" name="exchange_amount[]" class="form-control exchange-amount" readonly style="background-color: #e9ecef;"></td>
                    <td><button type="button" class="btn btn-danger btn-sm remove-exchange-row">X</button></td>
                </tr>
            `;
            $('#exchangeTable tbody').append(tr);
        });

        $(document).on('click', '.remove-exchange-row', function() {
            $(this).closest('tr').remove();
            calculateInvoiceTotals();
        });

        $('#addExchangeDiamond').on('click', function() {
            const tr = `
                <tr class="exchange-diamond-row">
                    <td><input type="text" name="exchange_dia_description[]" class="form-control"></td>
                    <td>
                        <select name="exchange_dia_clarity[]" class="form-control">
                            <option value="">Select Clarity</option>
                            @foreach ($clarities as $clarity)
                                <option value="{{ $clarity->name }}">{{ $clarity->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select name="exchange_dia_cut[]" class="form-control">
                            <option value="">Select Cut</option>
                            @foreach ($cuts as $cut)
                                <option value="{{ $cut->name }}">{{ $cut->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select name="exchange_dia_color[]" class="form-control">
                            <option value="">Select Color</option>
                            @foreach ($colors as $color)
                                <option value="{{ $color->name }}">{{ $color->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td><input type="number" name="exchange_dia_pieces[]" class="form-control exchange-dia-pieces" value="0"></td>
                    <td><input type="number" step="0.001" name="exchange_dia_weight[]" class="form-control exchange-dia-weight" value="0"></td>
                    <td><input type="number" step="0.01" name="exchange_dia_rate[]" class="form-control exchange-dia-rate" value="0"></td>
                    <td><input type="number" step="0.01" name="exchange_dia_amount[]" class="form-control exchange-dia-amount exchange-amount" readonly style="background-color: #e9ecef;" value="0"></td>
                    <td><button type="button" class="btn btn-danger btn-sm remove-exchange-diamond-row">X</button></td>
                </tr>
            `;
            $('#exchangeDiamondTable tbody').append(tr);
        });

        $(document).on('click', '.remove-exchange-diamond-row', function() {
            $(this).closest('tr').remove();
            calculateInvoiceTotals();
        });

        $(document).on('input', '.exchange-dia-weight, .exchange-dia-rate', function() {
            let row = $(this).closest('tr');
            let weight = parseFloat(row.find('.exchange-dia-weight').val()) || 0;
            let rate = parseFloat(row.find('.exchange-dia-rate').val()) || 0;
            let amount = weight * rate;
            row.find('.exchange-dia-amount').val(amount.toFixed(2));
            calculateInvoiceTotals();
        });

        $(document).on('change', '.exchange-metal', function() {
            let row = $(this).closest('tr');
            let metal = $(this).val();
            if (metal === 'Gold') {
                row.find('.exchange-rate').val(defaultGoldRate24k).trigger('input');
            } else if (metal === 'Silver') {
                row.find('.exchange-rate').val(defaultSilverRate).trigger('input');
            }
        });

        $(document).on('input', '.exchange-gross, .exchange-less, .exchange-purity', function() {
            let row = $(this).closest('tr');
            let gross = parseFloat(row.find('.exchange-gross').val()) || 0;
            let less = parseFloat(row.find('.exchange-less').val()) || 0;
            let net = gross - less;
            let purity = parseFloat(row.find('.exchange-purity').val()) || 0;
            let fine = (net * purity) / 100;
            row.find('.exchange-fine').val(fine.toFixed(3));
            row.find('.exchange-net').val(net.toFixed(3));

            let rate = parseFloat(row.find('.exchange-rate').val()) || 0;
            let amount = fine * rate;
            row.find('.exchange-amount').val(amount.toFixed(2));
            calculateInvoiceTotals();
        });

        $(document).on('input', '.exchange-rate', function() {
            let row = $(this).closest('tr');
            let rate = parseFloat($(this).val()) || 0;
            let fine = parseFloat(row.find('.exchange-fine').val()) || 0;

            let amount = fine * rate;
            row.find('.exchange-amount').val(amount.toFixed(2));
            calculateInvoiceTotals();
        });

        // REMOVE ITEM
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('removeItem')) {
                const btn = e.target;
                const itemId = btn.getAttribute('data-id');
                if (!confirm('Are you sure you want to remove this item?')) return;

                fetch('{{ route('sell.invoice.removeItem') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            item_id: itemId
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            const customerId = document.querySelector('#customerDropdown').value;
                            fetchPendingInvoice(customerId);
                        } else {
                            alert('Failed to remove item');
                        }
                    });
            }
        });

        // --- CALCULATION LOGIC (Keep existing calculateInvoiceTotals) ---
        // Just ensuring it reads the updated DOM properly
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // 1. Initial Calculation on Load (if items exist)
            calculateInvoiceTotals();

            // 2. Event Listeners for invoice-level inputs
            const summaryIds = [
                'makingDiscountPercent',
                'diamondDiscountPercent', 'wastageDiscountPercent',
                'discountPercent',
                'cgstPercent', 'sgstPercent', 'igstPercent',
                'cashReceived', 'bankReceived', 'onlineReceived', 'cardReceived'
            ];

            summaryIds.forEach(id => {
                const el = document.getElementById(id);
                if (el) {
                    el.addEventListener('input', calculateInvoiceTotals);
                }
            });

            // 3. Observer for Items Table (Detects added/removed rows)
            const itemsTableBody = document.querySelector('#itemsTable tbody');
            if (itemsTableBody) {
                const observer = new MutationObserver(function() {
                    calculateInvoiceTotals();
                });
                observer.observe(itemsTableBody, {
                    childList: true,
                    subtree: true
                });
            }
        });

        /**
         * Main Calculation Function
         * Recalculates all invoice totals based on items and rules.
         */
        function calculateInvoiceTotals() {

            let totalGold = 0;
            let totalWastage = 0;
            let totalMaking = 0;
            let totalDiamondItem = 0;
            let totalStoneItem = 0;
            let totalPacketDiamond = 0;
            let totalPacketStone = 0;

            globalInvoiceItems.forEach(item => {

                let goldenPrice = parseFloat(item.total_amount) || 0;

                totalGold += goldenPrice;
                totalWastage += parseFloat(item.wastage_amount) || 0;
                totalMaking += parseFloat(item.making_final_amount) || 0;

                if (Array.isArray(item.diamonds)) {
                    item.diamonds.forEach(d => {
                        totalDiamondItem += parseFloat(d.diamond_final_price || 0);
                    });
                }

                if (Array.isArray(item.stones)) {
                    item.stones.forEach(s => {
                        totalStoneItem += parseFloat(s.stone_final_price || 0);
                    });
                }

                if (Array.isArray(item.packets)) {
                    item.packets.forEach(p => {
                        const pType = p.packet_type || '';
                        if (/dia|diamond/i.test(pType)) {
                            totalPacketDiamond += parseFloat(p.amount || 0);
                        } else {
                            totalPacketStone += parseFloat(p.amount || 0);
                        }
                    });
                }
            });

            let combinedDiamondTotal = totalDiamondItem + totalPacketDiamond;
            let combinedStoneTotal = totalStoneItem + totalPacketStone;
            let totalDiaStonePkt = combinedDiamondTotal + combinedStoneTotal;

            // -------------------------
            // 1️⃣ Discounts (Only Calculate, Don't Affect Taxable)
            // -------------------------
            const makingDiscountPercent = parseFloat(document.getElementById('makingDiscountPercent')?.value) || 0;
            const makingDiscountAmount = (totalMaking * makingDiscountPercent) / 100;

            const wastageDiscountPercent = parseFloat(document.getElementById('wastageDiscountPercent')?.value) || 0;
            const wastageDiscountAmount = (totalWastage * wastageDiscountPercent) / 100;

            const diamondDiscountPercent = parseFloat(document.getElementById('diamondDiscountPercent')?.value) || 0;
            const diamondDiscountAmount = (combinedDiamondTotal * diamondDiscountPercent) / 100;

            setBoxText('totalMakingAmount', totalMaking);
            document.getElementById('totalMakingAmountInput').value = totalMaking.toFixed(2);
            setBoxText('makingDiscountAmount', makingDiscountAmount);

            setBoxText('totalWastageAmount', totalWastage);
            document.getElementById('totalWastageAmountInput').value = totalWastage.toFixed(2);
            setBoxText('wastageDiscountAmount', wastageDiscountAmount);

            setBoxText('totalDiamondCombinedAmount', combinedDiamondTotal);
            setBoxText('totalStoneCombinedAmount', combinedStoneTotal);
            setBoxText('totalDiamondStonePacketAmount', totalDiaStonePkt);
            document.getElementById('totalDiamondStonePacketAmountInput').value = totalDiaStonePkt.toFixed(2);
            setBoxText('diamondDiscountAmount', diamondDiscountAmount);

            // -------------------------
            // 2️⃣ FIXED TAXABLE AMOUNT (NO DISCOUNT MINUS)
            // -------------------------
            const taxableAmount = totalGold + totalDiaStonePkt;

            setBoxText('taxableAmount', taxableAmount);
            document.getElementById('taxableAmountInput').value = taxableAmount.toFixed(2);

            // -------------------------
            // 3️⃣ Final Discount (Same Logic As Before)
            // -------------------------
            const finalDiscountPercent = parseFloat(document.getElementById('discountPercent')?.value) || 0;
            const finalDiscountAmount = (taxableAmount * finalDiscountPercent) / 100;

            console.log('taxableAmount=-----------------------------' + taxableAmount);
            console.log('finalDiscountAmount--' + finalDiscountAmount);
            console.log('diamondDiscountAmount--' + diamondDiscountAmount);
            const amountAfterFinalDiscount = Number((
                taxableAmount -
                finalDiscountAmount -
                diamondDiscountAmount -
                makingDiscountAmount -
                wastageDiscountAmount
            ).toFixed(2));

            setBoxText('discountAmount', finalDiscountAmount);

            // Calculate and display all discounts under taxable amount
            const totalSaved = makingDiscountAmount + wastageDiscountAmount + diamondDiscountAmount + finalDiscountAmount;
            setBoxText('displayMakingDiscount', makingDiscountAmount);
            setBoxText('displayWastageDiscount', wastageDiscountAmount);
            setBoxText('displayDiamondDiscount', diamondDiscountAmount);
            setBoxText('displayFinalDiscount', finalDiscountAmount);
            setBoxText('totalSavedAmount', totalSaved);

            const discountsContainer = document.getElementById('discountsUnderTaxable');
            if (discountsContainer) {
                if (totalSaved > 0) {
                    discountsContainer.style.display = 'block';
                } else {
                    discountsContainer.style.display = 'none';
                }
            }

            // -------------------------
            // 4️⃣ GST (Same As Your Working Logic)
            // -------------------------
            const cgstPercent = parseFloat(document.getElementById('cgstPercent')?.value) || 0;
            const sgstPercent = parseFloat(document.getElementById('sgstPercent')?.value) || 0;
            const igstPercent = parseFloat(document.getElementById('igstPercent')?.value) || 0;

            const cgstAmount = Number(((amountAfterFinalDiscount * cgstPercent) / 100).toFixed(2));
            const sgstAmount = Number(((amountAfterFinalDiscount * sgstPercent) / 100).toFixed(2));
            const igstAmount = Number(((amountAfterFinalDiscount * igstPercent) / 100).toFixed(2));
            // alert('igstAmount==-->'+igstAmount);

            setBoxText('cgstAmount', cgstAmount);
            setBoxText('sgstAmount', sgstAmount);
            setBoxText('igstAmount', igstAmount);

            // -------------------------
            // 5️⃣ Final Invoice Amount (UNCHANGED FLOW)
            // -------------------------
            let totalExchange = 0;
            $('.exchange-amount').each(function() {
                totalExchange += parseFloat($(this).val()) || 0;
            });
            setBoxText('totalExchangeAmount', totalExchange);
            document.getElementById('totalExchangeAmountInput').value = totalExchange.toFixed(2);
            console.log('amountAfterFinalDiscount==' + amountAfterFinalDiscount);
            console.log('cgstAmount=' + cgstAmount);
            console.log('sgstAmount=' + sgstAmount);
            console.log('igstAmount=' + igstAmount);

            const totalInvoiceAmount = Number((
                amountAfterFinalDiscount +
                cgstAmount +
                sgstAmount +
                igstAmount -
                totalExchange
            ).toFixed(2));
            setBoxText('totalInvoiceAmount', totalInvoiceAmount);

            const roundedTotal = Math.round(totalInvoiceAmount);
            const roundOff = Number((roundedTotal - totalInvoiceAmount).toFixed(2));
            setBoxText('roundOffAmount', roundOff);
            $('#roundOffInput').val(roundOff);
            setBoxText('payableAmount', roundedTotal);

            // -------------------------
            // 6️⃣ Payment + Remaining
            // -------------------------
            let totalPaid = 0;
            if (typeof PaymentBreakdownManager !== 'undefined' && typeof PaymentBreakdownManager.getPaymentsData ===
                'function') {
                const dynamicPayments = PaymentBreakdownManager.getPaymentsData();
                dynamicPayments.forEach(p => {
                    totalPaid += p.amount;
                });
            } else {
                const cash = parseFloat(document.getElementById('cashReceived')?.value) || 0;
                const bank = parseFloat(document.getElementById('bankReceived')?.value) || 0;
                const online = parseFloat(document.getElementById('onlineReceived')?.value) || 0;
                const card = parseFloat(document.getElementById('cardReceived')?.value) || 0;
                totalPaid = cash + bank + online + card;
            }
            totalPaid = Number(totalPaid.toFixed(2));

            let totalSettled = 0;
            $('.settle-checkbox:checked').each(function() {
                let row = $(this).closest('tr');
                let type = $(this).data('type');
                let val = parseFloat(row.find('.remaining-amt').data('val')) || 0;

                if (type === 'advance') {
                    totalSettled += val; // Money already with us (Payment)
                } else if (type === 'udhaar_get' || type === 'udhaar_payment') {
                    totalSettled -= val; // Money they owe us (Debt to be added)
                }
            });

            setBoxText('totalSettledAmount', totalSettled);
            console.log('totalInvoiceAmount==' + totalInvoiceAmount);
            console.log('totalPaid==' + totalPaid);
            console.log('totalSettled==' + totalSettled);

            let remaining = Number((
                roundedTotal - (totalPaid + totalSettled)
            ).toFixed(2));
            console.log('remaining==' + remaining);
            // if (remaining < 0) remaining = 0;+

            setBoxText('remainingAmount', remaining);
            setBoxText('remainingAmountFooter', roundedTotal - totalSettled);
        }


        function setBoxText(elementId, amount) {
            const el = document.getElementById(elementId);
            if (el) {
                // Output format: ₹123.00
                el.textContent = '₹' + parseFloat(amount).toFixed(2);
            }
        }

        // Fetch unsettled entries on customer change
        //         $('#customerDropdown').on('change', function () {

        //     let customerId = $(this).val();

        //     // reset unsettled table
        //     let tbody = $('#unsettledEntriesTable tbody');
        //     tbody.empty();
        //     $('#unsettledEntriesSection').hide();

        //     if (!customerId) return;

        //     // 1️⃣ Fetch Pending Invoice
        //     fetchPendingInvoice(customerId);

        //     // 2️⃣ Fetch Unsettled Entries
        //     $.ajax({
        //         url: `/sell-invoice/customer-unsettled-entries/${customerId}`,
        //         type: 'GET',
        //         success: function(res) {

        //             if (res.success && res.data.length > 0) {

        //                 $('#unsettledEntriesSection').show();

        //                 res.data.forEach((entry, index) => {

        //                     let tr = `
    //                         <tr>
    //                             <td>${entry.transaction_date}
    //                                 <input type="hidden" name="settled_transactions[${index}][id]" value="${entry.id}">
    //                             </td>

    //                             <td>
    //                                 <span class="badge bg-secondary">
    //                                     ${entry.transaction_type}
    //                                 </span>
    //                             </td>

    //                             <td>₹${parseFloat(entry.amount).toFixed(2)}</td>

    //                             <td>₹${parseFloat(entry.remaining_amount).toFixed(2)}</td>

    //                             <td>
    //                                 <input type="number"
    //                                        class="form-control settle-amount-input"
    //                                        name="settled_transactions[${index}][amount]"
    //                                        max="${entry.remaining_amount}"
    //                                        min="0"
    //                                        step="0.01"
    //                                        placeholder="0.00">
    //                             </td>

    //                             <td>
    //                                 <button type="button"
    //                                     class="btn btn-sm btn-primary max-settle-btn"
    //                                     data-max="${entry.remaining_amount}">
    //                                     Max
    //                                 </button>
    //                             </td>
    //                         </tr>
    //                     `;

        //                     tbody.append(tr);
        //                 });

        //             }

        //         }
        //     });

        // });

        $(document).on('change', '.settle-checkbox', function() {
            calculateInvoiceTotals();
        });
    </script>
    <script>
        $(document).ready(function() {

            // setup csrf token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#saveCustomerBtn').click(function(e) {

                e.preventDefault();
                e.stopPropagation();

                let formData = $('#customerForm').serialize();

                $.ajax({
                    url: "{{ route('customers.store') }}",
                    type: "POST",
                    data: formData,

                    success: function(response) {

                        if (response.success) {

                            let option = new Option(
                                response.customer.name,
                                response.customer.id,
                                true,
                                true
                            );

                            $('#customerDropdown')
                                .append(option)
                                .trigger('change');

                            $('#addCustomerModal').modal('hide');

                            $('#customerForm')[0].reset();

                            alert('Customer Added Successfully');
                        }
                    },

                    error: function(xhr) {

                        console.log(xhr.responseText);

                        alert('Customer not saved');
                    }
                });

            });

        });
    </script>

    <script>
        window.ledgerAccounts = @json($accounts);

        const PaymentBreakdownManager = {
            accounts: [],

            init(accounts) {
                this.accounts = accounts || [];
                this.bindEvents();

                // Add a default cash row if container is empty
                if ($('.payment-row-item').length === 0) {
                    this.addPaymentRow('cash');
                    this.addPaymentRow('card');
                    this.addPaymentRow('cheque');
                    this.addPaymentRow('upi');

                }
            },

            bindEvents() {
                const self = this;
                $(document).on('click', '.add-payment-row-btn', function(e) {
                    e.preventDefault();
                    const method = $(this).data('method');
                    self.addPaymentRow(method);
                });

                $(document).on('click', '.remove-payment-row-btn', function(e) {
                    e.preventDefault();
                    $(this).closest('.payment-row-item').remove();
                    self.recalculateTotals();
                });

                $(document).on('blur', '.payment-amount-input, .payment-account-select', function() {
                    self.recalculateTotals();
                });
            },

            getFilteredAccounts(method, selectedAccountId = null) {
                let defaultAccountId = null;
                let filtered = [];

                this.accounts.forEach(acc => {
                    const name = acc.name.toLowerCase();
                    const subType = (acc.sub_type || '').toLowerCase();

                    let matches = false;
                    let isDefault = false;

                    if (method === 'cash') {
                        const isAsset = acc.group && acc.group.type === 'Asset';
                        const isNormal = subType === 'normal';
                        const isExcluded = name === 'stock' || name.includes('debtor') || name ===
                            'old metal received';
                        if ((isAsset && isNormal && !isExcluded) || name.includes('cash')) {
                            matches = true;
                        }
                        if (name === 'cash in hand') {
                            isDefault = true;
                            matches = true;
                        }
                    } else if (method === 'card') {
                        if (subType === 'card' || subType === 'bank') {
                            matches = true;
                        }
                        if (name === 'card receivable') {
                            isDefault = true;
                            matches = true;
                        }
                    } else if (method === 'cheque') {
                        if (subType === 'bank') {
                            matches = true;
                        }
                        if (name === 'bank') {
                            isDefault = true;
                            matches = true;
                        }
                    } else if (method === 'upi') {
                        if (subType === 'upi' || subType === 'bank') {
                            matches = true;
                        }
                        if (name === 'upi clearing') {
                            isDefault = true;
                            matches = true;
                        }
                    }

                    // Ensure currently selected account is always present in dropdown
                    if (acc.id == selectedAccountId) {
                        matches = true;
                    }

                    if (matches) {
                        filtered.push({
                            account: acc,
                            isDefault: isDefault
                        });
                    }
                });

                // Set a default if none explicitly matches
                if (filtered.length > 0) {
                    const hasDefault = filtered.some(f => f.isDefault);
                    if (!hasDefault) {
                        filtered[0].isDefault = true;
                    }
                }

                // Fallback to all accounts if filtered is empty
                if (filtered.length === 0) {
                    this.accounts.forEach(acc => {
                        filtered.push({
                            account: acc,
                            isDefault: false
                        });
                    });
                }

                filtered.forEach(f => {
                    if (f.isDefault) {
                        defaultAccountId = f.account.id;
                    }
                });

                let optionsHtml = '';
                filtered.forEach(f => {
                    const acc = f.account;
                    const isSel = (selectedAccountId !== null) ?
                        (acc.id == selectedAccountId) :
                        f.isDefault;
                    optionsHtml += `<option value="${acc.id}" ${isSel ? 'selected' : ''}>${acc.name}</option>`;
                });

                return {
                    optionsHtml,
                    defaultAccountId: selectedAccountId || defaultAccountId
                };
            },

            addPaymentRow(method, data = null) {
                const containerId = `#${method}PaymentsContainer`;
                const container = $(containerId);
                const today = new Date().toISOString().split('T')[0];
                if (!container.length) return;

                let selectedAccountId = data && data.account_id ? data.account_id : null;

                const {
                    optionsHtml,
                    defaultAccountId
                } = this.getFilteredAccounts(method, selectedAccountId);

                let selectHtml =
                    `<select class="form-select form-select-sm payment-account-select" style="width: 100%; font-size: 12px;">
                        ${optionsHtml}
                    </select>`;

                let rowHtml = `
                    <div class="payment-row-item p-2 mb-2 bg-white rounded border" data-method="${method}">
                        <!-- First line: Account Select, Amount, and Remove Button -->
                        <div class="d-flex align-items-center gap-2">
                            <div class="flex-grow-1">
                                ${selectHtml}
                            </div>
                            <div style="width: 100px; flex-shrink: 0;">
                                <input type="number" class="form-control form-control-sm payment-amount-input text-end" placeholder="Amount" style="font-size: 12px; width: 100px;" value="${data && data.amount ? data.amount : '0'}" min="0" step="0.01">
                            </div>
                            <div style="width: 25px; flex-shrink: 0; text-align: center;">
                                <button type="button" class="btn btn-sm btn-link text-danger remove-payment-row-btn p-0 m-0" style="width: 25px; height: 25px; line-height: 1;"><i class="feather-trash-2"></i></button>
                            </div>
                        </div>
                `;

                // Second line for details if non-cash
                if (method === 'card') {
                    rowHtml += `
                        <div class="d-flex align-items-center gap-2 mt-1">
                            <div style="width: 120px; flex-shrink: 0;">
                                <input type="text" class="form-control form-control-sm payment-ref-input" placeholder="Card No." style="font-size: 12px;" value="${data && data.reference_no ? data.reference_no : ''}">
                            </div>
                            <div class="flex-grow-1">
                                <input type="text" class="form-control form-control-sm payment-details-input" placeholder="Bank Name" style="font-size: 12px;" value="${data && data.payment_details ? data.payment_details : ''}">
                            </div>
                            <div style="width: 130px; flex-shrink: 0;">
                                <input type="date" class="form-control form-control-sm payment-date-input" style="font-size: 12px;" value="${data && data.transaction_date ? data.transaction_date : today}">
                            </div>
                        </div>
                    `;
                } else if (method === 'cheque') {
                    rowHtml += `
                        <div class="d-flex align-items-center gap-2 mt-1">
                            <div style="width: 120px; flex-shrink: 0;">
                                <input type="text" class="form-control form-control-sm payment-ref-input" placeholder="Cheque No." style="font-size: 12px;" value="${data && data.reference_no ? data.reference_no : ''}">
                            </div>
                            <div class="flex-grow-1">
                                <input type="text" class="form-control form-control-sm payment-details-input" placeholder="Bank Name" style="font-size: 12px;" value="${data && data.payment_details ? data.payment_details : ''}">
                            </div>
                            <div style="width: 130px; flex-shrink: 0;">
                                <input type="date" class="form-control form-control-sm payment-date-input" style="font-size: 12px;" value="${data && data.transaction_date ? data.transaction_date : today}">
                            </div>
                        </div>
                    `;
                } else if (method === 'upi') {
                    rowHtml += `
                        <div class="d-flex align-items-center gap-2 mt-1">
                            <div class="flex-grow-1">
                                <input type="text" class="form-control form-control-sm payment-ref-input" placeholder="UPI Txn ID / Ref No." style="font-size: 12px;" value="${data && data.reference_no ? data.reference_no : ''}">
                            </div>
                            <div style="width: 130px; flex-shrink: 0;">
                                <input type="date" class="form-control form-control-sm payment-date-input" style="font-size: 12px;" value="${data && data.transaction_date ? data.transaction_date : today}">
                            </div>
                        </div>
                    `;
                }

                rowHtml += `
                    </div>
                `;

                container.append(rowHtml);
                this.recalculateTotals();
            },

            getPaymentsData() {
                const payments = [];
                $('.payment-row-item').each(function() {
                    const row = $(this);
                    const amount = parseFloat(row.find('.payment-amount-input').val()) || 0;
                    if (amount > 0) {
                        payments.push({
                            payment_method: row.attr('data-method'),
                            account_id: row.find('.payment-account-select').val(),
                            amount: amount,
                            reference_no: row.find('.payment-ref-input').val() || null,
                            payment_details: row.find('.payment-details-input').val() || null,
                            transaction_date: row.find('.payment-date-input').val() || null
                        });
                    }
                });
                return payments;
            },

            recalculateTotals() {
                let total = 0;
                let cashTotal = 0;
                let cardTotal = 0;
                let chequeTotal = 0;
                let upiTotal = 0;

                $('.payment-row-item').each(function() {
                    const row = $(this);
                    const method = row.attr('data-method');
                    const amount = parseFloat(row.find('.payment-amount-input').val()) || 0;
                    total += amount;

                    if (method === 'cash') cashTotal += amount;
                    else if (method === 'card') cardTotal += amount;
                    else if (method === 'cheque') chequeTotal += amount;
                    else if (method === 'upi') upiTotal += amount;
                });

                $('#totalPaymentsBadge').text(`Total: ₹${total.toFixed(2)}`);

                // Update legacy fields
                $('#cashReceived').val(cashTotal);
                $('#cardReceived').val(cardTotal);
                $('#bankReceived').val(chequeTotal);
                $('#onlineReceived').val(upiTotal);

                // Call calculateInvoiceTotals to update Remaining Amount
                if (typeof calculateInvoiceTotals === 'function') {
                    calculateInvoiceTotals();
                }
            }
        };

        $(document).ready(function() {
            PaymentBreakdownManager.init(window.ledgerAccounts);
        });
    </script>
    <script>
        $(document).on('keydown', 'input, select, textarea', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();

                let formElements = $(this)
                    .closest('form')
                    .find('input, select, textarea, button')
                    .filter(':visible:not([readonly]):not([disabled])');

                let index = formElements.index(this);

                if (index > -1 && index < formElements.length - 1) {
                    formElements.eq(index + 1).focus();
                }
            }
        });
    </script>
@endsection
