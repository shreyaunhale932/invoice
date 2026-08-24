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
    hr {
    margin: 5px 0;
}
    .form-control:focus,
        .form-select:focus,
        .select:focus{
            box-shadow: none !important;
        }
        .btn-cust-new{
            font-size: 12px !important;
            padding: 6px 10px
        }
        .add-payment-row-btn{
            padding: 5px 10px;
            font-size: 11px !important;

        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
    font-size: 12px !important;
}
.select2-container--default .select2-selection--single .select2-selection__rendered {
        font-size: 12px !important;
    }
        .form-label{
            margin-bottom: 0px;
            color: #4a5568;
        }
        .form-select {
          font-size: 12px;
          color: #4a5568;
        }
        #itemsTable .btn{
            font-size: 11px !important;
        }
        #packetTable tbody tr td{
                min-width: 100px;
        }
        .table tbody tr td {
    font-size: 12px;
}
        .select2-container .select2-selection--single {
                height: 33px;
            }

            .select2-container--default .select2-selection--single .select2-selection__arrow {
                height: 26px;
                position: absolute;
                top: 1px;
                right: 1px;
                width: 7px;
                font-size: 12px;
            }

            .select2-container--default .select2-selection--single .select2-selection__arrow b {
                margin-left: -7px;
            }

            .select2-container--default .select2-selection--single .select2-selection__placeholder {
                color: #868080;
                font-size: 12px;
            }

            .select2-container--default .select2-selection--single .select2-selection__arrow {
                height: 31px;
                right: 1px;
            }

            .select2-container--default .select2-selection--single .select2-selection__arrow {
                width: 16px;
                padding: 7px;
                border-radius: 10px;
                background-color: #fff;
            }

            .select2-container--default .select2-selection--single .select2-selection__rendered {
                line-height: 30px;
                padding-right: 0px;
                padding-left: 4px;
            }
            .select2-container--bootstrap-5 .select2-selection--single .select2-selection__rendered {
                color: #4a5568;
                font-size: 12px;
            }
            .select2-container--bootstrap-5 .select2-dropdown .select2-results__options .select2-results__option {
                font-size: 12px !important;
            }
            .select2-container--bootstrap-5 .select2-dropdown .select2-search .select2-search__field{
                font-size: 12px !important;
            }
            .table thead tr th {
    font-size: 12px;
    font-weight: 500 !important;
}
.btn {
    font-size: 13px;}
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
    font-weight: 500;
    font-size: 13px;
    display: block;
    color: #fff;
    padding: 7px;
    margin-bottom: 10px;
    }
    .dark .section-header {
        background: linear-gradient(135deg, #a18cd1 0%, #fbc2eb 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        border-bottom: 2px solid rgba(251, 194, 235, 0.2);
    }
    .form-control, .form-select, .select {
        border-radius: 8px;
        border: 1px solid #ced4da;
        padding: 7px 7px;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
    .form-control:focus, .form-select:focus {
        border-color: #764ba2;
        box-shadow: 0 0 0 0.25rem rgba(118, 75, 162, 0.25);
    }
    .dark .form-control, .dark .form-select, .dark .select {
        background-color: #2b2b2b;
        border-color: #444;
        color: #fff;
    }
    .dark .form-control:focus, .dark .form-select:focus {
        border-color: #a18cd1;
        box-shadow: 0 0 0 0.25rem rgba(161, 140, 209, 0.25);
    }
    .direct-sell-btn {
    padding: 6px 12px;
    font-size: 12px;
}
    label {
        font-weight: 500;
                color: #4a5568;
                margin-bottom: 1px;
                font-size: 12px;
    }
    .dark label {
        color: #e2e8f0;
    }
    .custom-btn-primary {
         background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    border-radius: 8px;
    padding: 8px 15px;
    font-weight: 600;
    transition: all 0.3s ease;
    }
    .custom-btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(118, 75, 162, 0.4);
    }
    /* Invoice specific fixes */
    .invoice-total-box { background: transparent !important; border: none !important; }
    .invoice-total-inner .form-control {
    padding: 3px 10px !important;
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
    flex: 1 1 calc(16.666% - 15px);
    border: none !important;
    padding: 0 !important;
}
.remove-exchange-row{
        border-radius: 8px;
        padding: 6px 12px;
    font-size: 12px;
}
.remove-exchange-diamond-row{
     border-radius: 8px;
        padding: 6px 12px;
    font-size: 12px;
}
    @media (max-width: 992px) {
        #entryTable td {
            flex: 1 1 calc(50% - 15px); /* 2 columns */
        }
    }
    @media (max-width: 576px) {
        #entryTable td {
            flex: 1 1 100%; /* 1 column */
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
        /* background: rgba(255, 255, 255, 0.9) !important;
        border: 1px solid rgba(0, 0, 0, 0.1) !important;
        border-radius: 12px !important; */
    }
    .dark .payment-system-container {
        background: rgba(45, 45, 45, 0.9) !important;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
    }
    .payment-row-item {
        /* transition: all 0.2s ease-in-out;
        border: 1px solid rgba(0, 0, 0, 0.08) !important; */
    }
    .dark .payment-row-item {
        background: #333 !important;
        border: 1px solid rgba(255, 255, 255, 0.08) !important;
    }
    .payment-row-item:hover {
        /* background-color: #f8f9fa !important;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05); */
    }
    .dark .payment-row-item:hover {
        background-color: #3d3d3d !important;
    }
    .payment-account-select, .payment-ref-input, .payment-details-input, .payment-amount-input {
        background-color: #fff !important;
        color: #333 !important;
        border: 1px solid #ced4da !important;
        border-radius: 4px !important;
        padding: 4px 8px !important;
    }
    .dark .payment-account-select, .dark .payment-ref-input, .dark .payment-details-input, .dark .payment-amount-input {
        background-color: #2b2b2b !important;
        color: #fff !important;
        border: 1px solid #555 !important;
    }
</style>

    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="container-fluid p-0">
                    <div class="page-header mb-4">
                        <h5 class=" mb-0">
                            Edit Invoice
                        </h5>
                    </div>

                    <form action="{{ route('sell.invoice.update') }}" method="POST"> <!-- AJAX handles it -->
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12">

<!-- BASIC DETAILS -->
<div class="card glass-card mb-4 p-4">
                                <div class="form-group-item border-0 mb-0">
                                    <div class="row align-items-center">
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <label>Invoice Number</label>
                                                <input type="text" class="form-control" value="{{ $previewInvoiceNo }}"
                                                    name="invoice_no" readonly>

                                            </div>
                                        </div>
                                        <!-- Customer dropdown logic remains similar to show selected customer -->

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
                                                                    data-state="{{ $customer->state }}"
                                                                    {{ isset($invoice) && $invoice->user_id == $customer->id ? 'selected' : '' }}>
                                                                    {{ $customer->name }}</option>
                                                            @endforeach
                                                        </select>



                                                    </li>
                                                    <li>
                                                        <a class="btn btn-primary form-plus-btn"
                                                            href="{{ url('add-customer') }}">
                                                            <i class="fe fe-plus-circle"></i>
                                                        </a>
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
                                                        value="{{ isset($invoice) && $invoice->invoice_date ? \Carbon\Carbon::parse($invoice->invoice_date)->format('d-m-Y') : '' }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">

                                          <label>Search Product Code</label>
                                          <div class="d-flex gap-2">
                                              <div class="position-relative flex-grow-1">
                                                  <input type="text" id="productBarcodeSearch" list="productSearchSuggestions" class="form-control" placeholder="Enter Barcode / Product Code" autofocus>
                                                  <datalist id="productSearchSuggestions">
                                                      @foreach ($products as $product)
                                                          <option value="{{ $product->pre_code }}-{{ $product->post_code }}-{{ $product->barcode }}">{{ $product->product_name }}</option>
                                                      @endforeach
                                                  </datalist>
                                              </div>
                                              <button type="button" class="btn btn-primary direct-sell-btn" style="white-space: nowrap;" data-bs-toggle="modal" data-bs-target="#directSellModal">
                                                  Add Direct Sell
                                              </button>
                                          </div>
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
                                                    {{ $product->pre_code }}-{{ $product->post_code }}-{{ $product->barcode }} ({{ $product->product_name }})
                                                </option>
                                            @endforeach
                                        </select>
                                         <div id="productInfoSection" style="display: none;">
                                    <table class="table table-bordered" id="entryTable">
                                        <thead>
                                            <tr>
                                                <th>Category</th>
                                                <th>SubCategory</th>
                                                <th>Product Name</th>
                                                <th>Item Code</th>
                                                <th>Post Code</th>
                                                {{-- <th>Barcode</th> --}}
                                                {{-- <th>HSN Code</th> --}}
                                                <th>Metal Rate</th>
                                                <th>Qty</th>
                                                <th>GS Wt</th>
                                                <th>Net Wt</th>
                                                <th>Fn Wt</th>
                                                <th>Size</th>
                                                <th>Wastage %</th>
                                                <th>Making</th>
                                                <th>Making Type</th>
                                                <th>Making Final Amount</th>
                                                {{-- <th>GST %</th> --}}
                                                {{-- <th>GST Amount</th> --}}
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
                                                    <input type="text" name="category[]" class="form-control readonly-field"
                                                        style="pointer-events: none; background-color: #e9ecef;">
                                                </td>
                                                <td>
                                                    <span class="entry-label">SubCategory</span>
                                                    <input type="text" name="subcategory[]" class="form-control readonly-field"
                                                        style="pointer-events: none; background-color: #e9ecef;">
                                                </td>
                                                <td>
                                                    <span class="entry-label">Product Name</span>
                                                    <input type="text" name="product_name[]" class="form-control readonly-field"
                                                        style="pointer-events: none; background-color: #e9ecef;">
                                                </td>
                                                <td>
                                                    <span class="entry-label">Item Code</span>
                                                    <input type="text" name="pre_code[]" class="form-control readonly-field"
                                                        style="pointer-events: none; background-color: #e9ecef;">
                                                </td>
                                                <td>
                                                    <span class="entry-label">Post Code</span>
                                                    <input type="text" name="post_code[]" class="form-control readonly-field"
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
                                                    <input type="number" name="quantity[]" class="form-control readonly-field"
                                                        value="1"
                                                        style="pointer-events: none; background-color: #e9ecef;">
                                                </td>
                                                <td>
                                                    <span class="entry-label">GS Wt</span>
                                                    <input type="number" step="0.001" name="gross_weight[]"
                                                        class="form-control readonly-field"
                                                        style="pointer-events: none; background-color: #e9ecef;">
                                                </td>
                                                <td>
                                                    <span class="entry-label">Net Wt</span>
                                                    <input type="number" step="0.001" name="net_weight[]"
                                                        class="form-control readonly-field"
                                                        style="pointer-events: none; background-color: #e9ecef;">
                                                </td>
                                                <td>
                                                    <span class="entry-label">Fn Wt</span>
                                                    <input type="number" step="0.001" name="final_fn_weight[]"
                                                        class="form-control readonly-field"
                                                        style="pointer-events: none; background-color: #e9ecef;">
                                                </td>
                                                <td>
                                                    <span class="entry-label">Size</span>
                                                    <input type="text" name="size[]" class="form-control readonly-field"
                                                        style="pointer-events: none; background-color: #e9ecef;">
                                                </td>
                                                <td>
                                                    <span class="entry-label">Wastage %</span>
                                                    <input type="number" step="0.01" name="wastage_percent[]"
                                                        class="form-control readonly-field"
                                                        style="pointer-events: none; background-color: #e9ecef;">
                                                </td>
                                                <td>
                                                    <span class="entry-label">Wastage Amt</span>
                                                    <input type="number" step="0.01" name="wastage_amount[]"
                                                        class="form-control readonly-field"
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
                                                        class="form-control readonly-field"
                                                        style="pointer-events: none; background-color: #e9ecef;">
                                                </td>
                                                <td>
                                                    <span class="entry-label">Final price</span>
                                                    <input type="number" step="0.01" name="final_price[]"
                                                        class="form-control readonly-field"
                                                        style="pointer-events: none; background-color: #e9ecef;">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div id="diamondSection" style="display:none;">
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
                                    <div id="stoneSection" style="display:none;">
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
                                        <!-- <h5 class="mt-4">Packets</h5> -->
                                        <div class="table-responsive no-pagination">
                                        <table class="table table-bordered" id="packetTable">
                                            <thead>
                                                <tr>
                                                    <th>Packet No</th>
                                                    <th>Packet Type</th>
                                                    <th>Pieces</th>
                                                    <th>Cert. No</th>
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
                                    </div>



                                    <button type="button" id="addItemBtn" class="btn custom-btn-primary text-white mt-2">
                                        + Add Item
                                    </button>
                                </div>

                                        </div>
                                        <div class="col-lg-12">
                                            <h6 class="mt-4">Added Items</h6>
                                            <div class="table-responsive no-pagination">
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
                                    <tbody>
                                        @foreach ($invoice->items as $item)
                                            @php
                                                $pktDiamond = $item->packets ? $item->packets->filter(function($p) {
                                                    $type = $p->packet_type ?? '';
                                                    return stripos($type, 'dia') !== false || stripos($type, 'diamond') !== false;
                                                })->sum('amount') : 0;
                                                $pktStone = $item->packets ? $item->packets->filter(function($p) {
                                                    $type = $p->packet_type ?? '';
                                                    return stripos($type, 'dia') === false && stripos($type, 'diamond') === false;
                                                })->sum('amount') : 0;
                                            @endphp
                                            <tr>
                                                <td>{{ $item->product->product_name }}</td>
                                                {{-- <td>{{ $item->pre_code }}-{{ $item->post_code }}</td> --}}
                                                <td>{{ $item->barcode }}</td>
                                                <td>{{ $item->gross_weight }}</td>
                                                <td>{{ $item->net_weight }}</td>
                                                <td>{{ $item->final_fn_weight }}</td>
                                                <td>{{ $item->metal_rate }}</td>
                                                <td>{{ $item->wastage_amount }}</td>
                                                <td>{{ $item->making_final_amount }}</td>
                                                {{-- <td>₹{{ number_format($item->diamond_amount, 2) }}</td>
                                                <td>₹{{ number_format($item->stone_amount, 2) }}</td> --}}
                                                <td>₹{{ number_format($pktDiamond, 2) }}</td>
                                                <td>₹{{ number_format($pktStone, 2) }}</td>
                                                <td>₹{{ number_format($item->final_price, 2) }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-warning btn-sm"
                                                        onclick="editItem({{ $item->id }})"><i class="fa fa-pencil"></i></button>
                                                    <button type="button" class="btn btn-danger btn-sm removeItem"
                                                        data-id="{{ $item->id }}"><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
</div>
                                        </div>
                                        








                                        <input type="hidden" name="due_date" value="{{ isset($invoice) && $invoice->invoice_due_date ? \Carbon\Carbon::parse($invoice->invoice_due_date)->format('d-m-Y') : '' }}">
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
</div>

                                {{-- <button type="button" id="addItemBtn" class="btn btn-outline-primary">+ Add Item</button> --}}
                                {{-- <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#gstConfigModal">
                                Configure GST
                            </button>
                            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editColumnsModal">
                                Customize Columns
                            </button> --}}




                               
</div>



                                <!-- Exchange / Old Gold Section -->
                                <div class="card glass-card mb-4 p-4">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <h6 class="mb-0">Exchange / Old Gold</h6>
                                        <button type="button" class="btn btn-primary btn-cust-new btn-sm" id="addExchangeItem">
                                            + Purchase Old Gold
                                        </button>
                                    </div>
                                    <div class="table-responsive">
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
                                                @foreach ($invoice->exchangeItems as $ex)
                                                    <tr class="exchange-row">
                                                        <td><input type="text" name="exchange_description[]"
                                                                class="form-control" value="{{ $ex->description }}"></td>
                                                        <td>
                                                            <select name="exchange_metal[]" class="form-control">
                                                                <option value="Gold"
                                                                    {{ $ex->metal == 'Gold' ? 'selected' : '' }}>Gold
                                                                </option>
                                                                <option value="Silver"
                                                                    {{ $ex->metal == 'Silver' ? 'selected' : '' }}>Silver
                                                                </option>
                                                            </select>
                                                        </td>
                                                        <td><input type="number" step="0.001" name="exchange_gross[]"
                                                                class="form-control exchange-gross"
                                                                value="{{ $ex->gross_weight }}"></td>
                                                        <td><input type="number" step="0.001" name="exchange_less[]"
                                                                class="form-control exchange-less"
                                                                value="{{ $ex->less_weight }}"></td>
                                                        <td><input type="number" step="0.001" name="exchange_net[]"
                                                                class="form-control exchange-net" readonly
                                                                style="background-color: #e9ecef;"
                                                                value="{{ $ex->net_weight }}"></td>
                                                        <td><input type="number" step="0.01" name="exchange_purity[]"
                                                                class="form-control exchange-purity"
                                                                value="{{ $ex->purity }}"></td>
                                                        <td><input type="number" step="0.001" name="exchange_fine[]"
                                                                class="form-control exchange-fine" readonly
                                                                style="background-color: #e9ecef;"
                                                                value="{{ $ex->fine_weight }}"></td>
                                                        <td><input type="number" step="0.01" name="exchange_rate[]"
                                                                class="form-control exchange-rate"
                                                                value="{{ $ex->rate }}"></td>
                                                        <td><input type="number" step="0.01" name="exchange_amount[]"
                                                                class="form-control exchange-amount" readonly
                                                                style="background-color: #e9ecef;"
                                                                value="{{ $ex->amount }}"></td>
                                                        <td><button type="button"
                                                                class="btn btn-danger btn-sm remove-exchange-row">X</button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Diamond Exchange Section -->
                                <div class="card glass-card mb-4 p-4">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <h6 class="mb-0">Diamond Exchange</h6>
                                        <button type="button" class="btn btn-primary btn-cust-new  btn-sm" id="addExchangeDiamond">
                                            + Exchange Diamond
                                        </button>
                                    </div>
                                    <div class="table-responsive">
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
                                                @foreach ($invoice->exchangeDiamonds as $dia)
                                                    <tr class="exchange-diamond-row">
                                                        <td><input type="text" name="exchange_dia_description[]"
                                                                class="form-control" value="{{ $dia->description }}"></td>
                                                        <td>
                                                            <select name="exchange_dia_clarity[]" class="form-control">
                                                                <option value="">Select Clarity</option>
                                                                @foreach ($clarities as $clarity)
                                                                    <option value="{{ $clarity->name }}"
                                                                        {{ $dia->clarity == $clarity->name ? 'selected' : '' }}>{{ $clarity->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select name="exchange_dia_cut[]" class="form-control">
                                                                <option value="">Select Cut</option>
                                                                @foreach ($cuts as $cut)
                                                                    <option value="{{ $cut->name }}"
                                                                        {{ $dia->cut == $cut->name ? 'selected' : '' }}>{{ $cut->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select name="exchange_dia_color[]" class="form-control">
                                                                <option value="">Select Color</option>
                                                                @foreach ($colors as $color)
                                                                    <option value="{{ $color->name }}"
                                                                        {{ $dia->color == $color->name ? 'selected' : '' }}>{{ $color->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td><input type="number" name="exchange_dia_pieces[]" class="form-control exchange-dia-pieces" value="{{ $dia->pieces }}"></td>
                                                        <td><input type="number" step="0.001" name="exchange_dia_weight[]" class="form-control exchange-dia-weight" value="{{ $dia->weight }}"></td>
                                                        <td><input type="number" step="0.01" name="exchange_dia_rate[]" class="form-control exchange-dia-rate" value="{{ $dia->rate }}"></td>
                                                        <td><input type="number" step="0.01" name="exchange_dia_amount[]" class="form-control exchange-dia-amount exchange-amount" readonly style="background-color: #e9ecef;" value="{{ $dia->amount }}"></td>
                                                        <td><button type="button" class="btn btn-danger btn-sm remove-exchange-diamond-row">X</button></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Unsettled Advances / Udhar Section -->
                                <div class="card glass-card mb-4 p-4" id="unsettledEntriesSection" style="display: none;">
                                    <div class="card-header">
                                        <h5 class="mb-0">Unsettled Advances / Udhar</h5>
                                    </div>
                                    <div class="table-responsive">
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
<!-- TOTALS & ADJUSTMENTS -->
<div class="card glass-card mb-4 p-4">
<h4 class="section-header">Totals & Adjustments</h4>
 
                                <div class="form-group-item border-0 p-0">
                                    <div class="row">



                                        <div class="col-xl-5 col-lg-5">
                                            <div class="form-group-bank">

                                                <!-- hidden states -->
                                                <input type="hidden" id="businessState" value="">
                                                <input type="hidden" id="customerState" value="">

                                                <div class="invoice-total-box">
                                                    <div class="invoice-total-inner">

                                                        <!-- Making Charge Section -->
                                                        <div
                                                            class="d-flex justify-content-between align-items-center mb-1">
                                                            <label>Total Making Charge</label>
                                                            <span class="fs-12"
                                                                id="totalMakingAmount">₹{{ number_format($invoice->total_making_charge ?? 0, 2) }}</span>
                                                            <input type="hidden" id="totalMakingAmountInput"
                                                                value="{{ $invoice->total_making_charge ?? 0 }}">
                                                        </div>

                                                        <div
                                                            class="d-flex justify-content-between align-items-center mb-1">
                                                            <label>Making Discount %</label>
                                                            <input type="number" id="makingDiscountPercent"
                                                                class="form-control w-25"
                                                                value="{{ $invoice->making_discount_percent ?? 0 }}">
                                                            <span class="fs-12"
                                                                id="makingDiscountAmount">₹{{ number_format($invoice->making_discount_amount ?? 0, 2) }}</span>
                                                        </div>

                                                        <hr>

                                                        <!-- Wastage Charge Section -->
                                                        <div
                                                            class="d-flex justify-content-between align-items-center mb-1">
                                                            <label>Total Wastage Charge</label>
                                                            <span class="fs-12"
                                                                id="totalWastageAmount">₹{{ number_format($invoice->total_wastage_charge ?? 0, 2) }}</span>
                                                            <input type="hidden" id="totalWastageAmountInput"
                                                                value="{{ $invoice->total_wastage_charge ?? 0 }}">
                                                        </div>

                                                        <div
                                                            class="d-flex justify-content-between align-items-center mb-1">
                                                            <label>Wastage Discount %</label>
                                                            <input type="number" id="wastageDiscountPercent"
                                                                class="form-control w-25"
                                                                value="{{ $invoice->wastage_discount_percent ?? 0 }}">
                                                            <span class="fs-12"
                                                                id="wastageDiscountAmount">₹{{ number_format($invoice->wastage_discount_amount ?? 0, 2) }}</span>
                                                        </div>

                                                        <hr>

                                                        <!-- Diamond/Stone/Packet Section -->
                                                        <div
                                                            class="d-flex justify-content-between align-items-center mb-1">
                                                            <label>Total Diamond Amount</label>
                                                            <span class="fs-12"
                                                                id="totalDiamondCombinedAmount">₹0.00</span>
                                                        </div>

                                                        <div
                                                            class="d-flex justify-content-between align-items-center mb-1">
                                                            <label>Total Stone/Other Amount</label>
                                                            <span class="fs-12"
                                                                id="totalStoneCombinedAmount">₹0.00</span>
                                                        </div>

                                                        <div
                                                            class="d-flex justify-content-between align-items-center mb-1">
                                                            <label>Total Diamond & Stone Price</label>
                                                            <span class="fs-12"
                                                                id="totalDiamondStonePacketAmount">₹{{ number_format($invoice->total_diamond_stone_packet ?? 0, 2) }}</span>
                                                            <input type="hidden" id="totalDiamondStonePacketAmountInput"
                                                                value="{{ $invoice->total_diamond_stone_packet ?? 0 }}">
                                                        </div>

                                                        <div
                                                            class="d-flex justify-content-between align-items-center mb-1">
                                                            <label>Diamond Discount %</label>
                                                            <input type="number" id="diamondDiscountPercent"
                                                                class="form-control w-25"
                                                                value="{{ $invoice->diamond_discount_percent ?? 0 }}">
                                                            <span class="fs-12"
                                                                id="diamondDiscountAmount">₹{{ number_format($invoice->diamond_discount_amount ?? 0, 2) }}</span>
                                                        </div>

                                                        <hr>

                                                        <p>
                                                            Taxable Amount
                                                            <span
                                                                id="taxableAmount">₹{{ number_format($invoice->taxable_amount ?? 0, 2) }}</span>
                                                            <input type="hidden" id="taxableAmountInput"
                                                                value="{{ $invoice->taxable_amount ?? 0 }}">
                                                        </p>


                                                        <div
                                                            class="d-flex justify-content-between align-items-center mb-1">
                                                            <label>Total Exchange</label>
                                                            <span class="fs-12"
                                                                id="totalExchangeAmount">₹{{ number_format($invoice->total_exchange_amount ?? 0, 2) }}</span>
                                                            <input type="hidden" id="totalExchangeAmountInput"
                                                                value="{{ $invoice->total_exchange_amount ?? 0 }}">
                                                        </div>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <label>Final Discount %</label>
                                                            <input type="number" id="discountPercent"
                                                                class="form-control w-25"
                                                                value="{{ $invoice->discount_percent ?? 0 }}">
                                                            <span class="fs-12"
                                                                id="discountAmount">₹{{ number_format($invoice->discount_amount ?? 0, 2) }}</span>
                                                        </div>

                                                         <!-- Discounts breakdown and You Save badge -->
                                                         <div id="discountsUnderTaxable" style="display: none; padding: 10px; margin-top: 10px; margin-bottom: 12px; background-color: rgba(40, 167, 69, 0.05); border-radius: 8px; border: 1px dashed rgba(40, 167, 69, 0.25);">
                                                             <div class="d-flex justify-content-between align-items-center mb-1" style="font-size: 0.85rem; color: #555;">
                                                                 <span>Making Discount:</span>
                                                                 <span class="fs-12" id="displayMakingDiscount">₹0.00</span>
                                                             </div>
                                                             <div class="d-flex justify-content-between align-items-center mb-1" style="font-size: 0.85rem; color: #555;">
                                                                 <span>Wastage Discount:</span>
                                                                 <span class="fs-12" id="displayWastageDiscount">₹0.00</span>
                                                             </div>
                                                             <div class="d-flex justify-content-between align-items-center mb-1" style="font-size: 0.85rem; color: #555;">
                                                                 <span>Diamond Discount:</span>
                                                                 <span class="fs-12" id="displayDiamondDiscount">₹0.00</span>
                                                             </div>
                                                             <div class="d-flex justify-content-between align-items-center mb-1" style="font-size: 0.85rem; color: #555;">
                                                                 <span>Final Discount:</span>
                                                                 <span class="fs-12" id="displayFinalDiscount">₹0.00</span>
                                                             </div>
                                                             <div class="d-flex justify-content-between align-items-center pt-2" style="border-top: 1px solid rgba(40, 167, 69, 0.15);">
                                                                 <span style="font-size: 0.85em; padding: 3px 6px; background-color: #28a745; color: white; border-radius: 4px; display: inline-block; font-weight: bold;">You Save</span>
                                                                 <span id="totalSavedAmount" class="text-success fw-bold" style="font-size: 0.95rem;">₹0.00</span>
                                                             </div>
                                                         </div>
                                                        <hr>

                                                        <!-- CGST -->
                                                        <div class="d-flex justify-content-between align-items-center"
                                                            id="cgstdiv">
                                                            <label>CGST %</label>
                                                            <input type="number" id="cgstPercent"
                                                                class="form-control w-25"
                                                                value="{{ $invoice->cgst_percent ?? 0 }}">
                                                            <span class="fs-12"
                                                                id="cgstAmount">₹{{ number_format($invoice->cgst_amount ?? 0, 2) }}</span>
                                                        </div>

                                                        <!-- SGST -->
                                                        <div class="d-flex justify-content-between align-items-center"
                                                            id="sgstdiv">
                                                            <label>SGST %</label>
                                                            <input type="number" id="sgstPercent"
                                                                class="form-control w-25"
                                                                value="{{ $invoice->sgst_percent ?? 0 }}" >
                                                            <span class="fs-12"
                                                                id="sgstAmount">₹{{ number_format($invoice->sgst_amount ?? 0, 2) }}</span>
                                                        </div>

                                                        <!-- IGST -->
                                                        <div class="d-flex justify-content-between align-items-center"
                                                            id="igstdiv">
                                                            <label>IGST %</label>
                                                            <input type="number" id="igstPercent"
                                                                class="form-control w-25"
                                                                value="{{ $invoice->igst_percent ?? 0 }}" >
                                                            <span class="fs-12"
                                                                id="igstAmount">₹{{ number_format($invoice->igst_amount ?? 0, 2) }}</span>
                                                        </div>

                                                                                                <hr>
                                                         <div
                                                             class="d-flex justify-content-between align-items-center mb-1">
                                                             <label>Total Amount</label>
                                                             <span id="totalInvoiceAmount" class="fs-12">₹{{ number_format($invoice->total_amount ?? 0, 2) }}</span>
                                                         </div>
                                                         <div
                                                             class="d-flex justify-content-between align-items-center mb-1">
                                                             <label>Round Off</label>
                                                             <span id="roundOffAmount" class="fs-12">₹{{ number_format($invoice->round_off ?? 0, 2) }}</span>
                                                         </div>
                                                         <hr>
                                                         <h6>
                                                             Payable Amount
                                                             <span id="payableAmount" >₹{{ number_format($invoice->final_amount ?? 0, 2) }}</span>
                                                         </h6>
                                                        <hr>
                                                        <div
                                                            class="d-flex justify-content-between align-items-center mb-1">
                                                            <label>Total Settled (Udhar/Adv)</label>
                                                            <span id="totalSettledAmount">₹0.00</span>
                                                        </div>
                                                        <hr>
                                                        <h6>
                                                            Remaining Amount
                                                            <span
                                                                id="remainingAmountFooter">₹{{ number_format($invoice->amount_left ?? 0, 2) }}</span>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-7 col-lg-7">
                                            <div class="form-group-bank">

                                                <!-- hidden states -->
                                                <input type="hidden" id="businessState" value="">
                                                <input type="hidden" id="customerState" value="">

                                                <div class="invoice-total-box">
                                                         <!-- Dynamic Multiple Payments System -->
                                                         <div class="payment-system-container mb-3  bg-light ">
                                                             <div class="mb-3 d-flex align-items-center justify-content-between">
                                                                 <h6 class="fw-bold">Payment Breakdown</h6>
                                                                 <span class="badge bg-primary" id="totalPaymentsBadge">Total: ₹0.00</span>
                                                             </div>

                                                             <!-- Cash Payments -->
                                                             <div class="payment-method-section mb-3 p-2 border-bottom">
                                                                 <div class="d-flex justify-content-between align-items-center mb-2">
                                                                     <span class="fw-bold">Cash Payments</span>
                                                                     <button type="button" class="btn btn-sm btn-success add-payment-row-btn" data-method="cash">
                                                                         <i class="feather-plus"></i> + Cash Row
                                                                     </button>
                                                                 </div>
                                                                 <div class="payment-rows-container" id="cashPaymentsContainer"></div>
                                                             </div>

                                                             <!-- Card Payments -->
                                                             <div class="payment-method-section mb-3 p-2 border-bottom">
                                                                 <div class="d-flex justify-content-between align-items-center mb-2">
                                                                     <span class="fw-bold">Card Payments</span>
                                                                     <button type="button" class="btn btn-sm btn-success add-payment-row-btn" data-method="card">
                                                                         <i class="feather-plus"></i> + Card Row
                                                                     </button>
                                                                 </div>
                                                                 <div class="payment-rows-container" id="cardPaymentsContainer"></div>
                                                             </div>

                                                             <!-- Cheque Payments -->
                                                             <div class="payment-method-section mb-3 p-2 border-bottom">
                                                                 <div class="d-flex justify-content-between align-items-center mb-2">
                                                                     <span class="fw-bold"><i class="feather-file-text me-1"></i>Cheque Payments</span>
                                                                     <button type="button" class="btn btn-sm btn-success add-payment-row-btn" data-method="cheque">
                                                                         <i class="feather-plus"></i> + Cheque Row
                                                                     </button>
                                                                 </div>
                                                                 <div class="payment-rows-container" id="chequePaymentsContainer"></div>
                                                             </div>

                                                             <!-- UPI Payments -->
                                                             <div class="payment-method-section mb-3 p-2">
                                                                 <div class="d-flex justify-content-between align-items-center mb-2">
                                                                     <span class="fw-bold"><i class="feather-smartphone me-1"></i>UPI Payments</span>
                                                                     <button type="button" class="btn btn-sm btn-success add-payment-row-btn" data-method="upi">
                                                                         <i class="feather-plus"></i> + UPI Row
                                                                     </button>
                                                                 </div>
                                                                 <div class="payment-rows-container" id="upiPaymentsContainer"></div>
                                                             </div>

                                                             <!-- Legacy hidden inputs for compatibility with other scripts -->
                                                             <input type="hidden" id="cashReceived" value="0">
                                                             <input type="hidden" id="bankReceived" value="0">
                                                             <input type="hidden" id="onlineReceived" value="0">
                                                             <input type="hidden" id="cardReceived" value="0">
                                                             <input type="hidden" id="roundOffInput" name="round_off" value="{{ $invoice->round_off ?? 0 }}">
                                                         </div>
                                                    </div>
                                                    <hr>

                                                    <!-- Footer -->
                                                    <div class="invoice-total-footer">

                                                        <h6 class="text-danger">
                                                            Remaining Amount
                                                            <span id="remainingAmount">₹0.00</span>
                                                            <input type="hidden" id="remainingamountInput"
                                                                value="0">
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="d-flex justify-content-end align-items-center mt-3">
                                    <a href="{{ route('invoices') }}" class="btn btn-light me-2">Cancel</a>
                                    <button type="button" id="saveInvoiceBtn" class="btn custom-btn-primary text-white me-2">Save</button>
                                    <button type="button" id="savePrintInvoiceBtn" class="btn custom-btn-primary text-white">Save & Print</button>
                                </div>

                                </div>

                                
                                
                                
</div>

                               

                            </div>
                        </div>
                    </form>
        </div>
    </div>
    <!-- Edit Columns Modal ---->
    <!-- Edit Columns Modal ---->
    <div class="modal fade" id="editColumnsModal" tabindex="-1" aria-labelledby="editColumnsLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="edit-columns-form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editColumnsLabel">Edit Columns</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <table class="table table-bordered" id="columns-edit-table">
                            <thead>
                                <tr>
                                    <th>Column Name</th>
                                    <th>Type</th>
                                    <th>Visible</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            {{-- <tbody>
                                @foreach ($visibleColumns as $column)
                                    <tr data-id="{{ $column['key'] }}" data-is-custom="{{ $column['is_custom'] }}">

                                        <td>

                                            <input type="hidden" name="columns[{{ $column['key'] }}][key]"
                                                value="{{ $column['key'] }}">
                                            <input type="hidden" name="columns[{{ $column['key'] }}][type]"
                                                value="{{ $column['type'] }}">
                                            <input type="text" name="columns[{{ $column['key'] }}][name]"
                                                value="{{ $column['name'] }}">

                                        </td>

                                        <td>
                                            @if ($column['is_custom'])
                                                <select class="form-select column-type-select"
                                                    name="columns[{{ $column['key'] }}][type]">
                                                    <option value="text"
                                                        {{ $column['type'] == 'text' ? 'selected' : '' }}>Text</option>
                                                    <option value="number"
                                                        {{ $column['type'] == 'number' ? 'selected' : '' }}>Number</option>
                                                    <!-- <option value="formula" {{ $column['type'] == 'formula' ? 'selected' : '' }}>Formula</option> -->
                                                </select>
                                            @else
                                                <input type="hidden" name="columns[{{ $column['key'] }}][type]"
                                                    value="{{ $column['type'] }}">
                                                <span class="text-muted">{{ ucfirst($column['type']) }}</span>
                                            @endif
                                        </td>
                                        <td class="formula-field-td"
                                            style="{{ $column['type'] === 'formula' ? '' : 'display:none;' }}">
                                            <input type="text" class="form-control formula-input"
                                                name="columns[{{ $column['key'] }}][formula]"
                                                placeholder="e.g., qty * rate - discount"
                                                value="{{ $column['formula'] ?? '' }}">
                                        </td>
                                        <td class="text-center">

                                            <input type="checkbox" name="columns[{{ $column['key'] }}][is_visible]"
                                                {{ $column['is_visible'] ? 'checked' : '' }}>

                                        </td>


                                        <td class="text-center">
                                            @if ($column['is_custom'])
                                                <button type="button"
                                                    class="btn btn-danger btn-sm remove-column">Delete</button>
                                            @else
                                                <span class="badge bg-secondary">System</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody> --}}
                        </table>

                        <button type="button" class="btn btn-success btn-sm mt-2" id="add-column-btn">+ Add
                            Column</button>
                    </div>

                    <div class="modal-footer">
                        <button id="updateColumnsBtn" type="button" class="btn btn-primary">Save Changes</button>
                    </div>
                </div>
            </form>
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
                    <button type="button" class="btn btn-primary" id="applyGstConfig">Apply</button>
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

                    if (barcode === searchValue || fullCode === searchValue || option.val() === searchValue) {
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
        let alreadySettled = 0;
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
            if (isEmpty(fnWt) || netWt <= 0) {
                return showError('Fine weight must be greater than 0');
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
                sell_invoice_id: globalInvoiceId, // Pass current invoice ID
                // If editing, we need to send the invoice_id too? The controller finds it from item,
                // but for ADD we need it.
                // For ADD, the controller currently looks for existing pending invoice.
                from: 'edit',
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

                net_weight: entryRow.querySelector('input[name="net_weight[]"]').value,
                final_fn_weight: entryRow.querySelector('input[name="final_fn_weight[]"]').value,
                gross_weight: entryRow.querySelector('input[name="gross_weight[]"]').value,
                metal_rate: entryRow.querySelector('input[name="metal_rate[]"]').value,

                making_price: entryRow.querySelector('input[name="making_price[]"]').value,
                making_type: entryRow.querySelector('select[name="making_type[]"]').value,
                making_final_amount: entryRow.querySelector('input[name="making_final_amount[]"]').value,
                wastage_percent: entryRow.querySelector('input[name="wastage_percent[]"]').value,
                wastage_amount: entryRow.querySelector('input[name="wastage_amount[]"]').value,

                gst_amount: entryRow.querySelector('input[name="gst_amount[]"]').value,
                gst_percent: entryRow.querySelector('input[name="gst_percent[]"]').value,

                total_amount: entryRow.querySelector('input[name="total_amount[]"]').value,
                final_price: entryRow.querySelector('input[name="final_price[]"]').value,

                category: entryRow.querySelector('input[name="category[]"]').value,
                subcategory: entryRow.querySelector('input[name="subcategory[]"]').value,
                size: entryRow.querySelector('input[name="size[]"]').value,
                quantity: entryRow.querySelector('input[name="quantity[]"]').value || 1,

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
                    window.location.reload();
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
            row.find('input[name="category[]"]').val(cat.category_name || p.category_id || p.category || '');
            row.find('input[name="subcategory[]"]').val(sub.subcategory_name || p.subcategory_id || p.subcategory || '');

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
            row.find('input[name="making_price[]"]').val(item.making_charges || p.making_price || 0); // Making
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
                            .attr('data-category-name', p.category?.category_name || item.category_name || item.category || '')
                            .attr('data-subcategory-id', p.subcategory_id || '')
                            .attr('data-subcategory-name', p.subcategory?.subcategory_name || item.subcategory_name || item.subcategory || '')
                            .attr('data-gst_percent', p.gst_percent || 0)
                            .attr('data-gst_amount', p.gst_amount || 0)
                            .attr('data-pre_code', p.pre_code || '')
                            .attr('data-post_code', p.post_code || '')
                            .attr('data-diamonds', JSON.stringify(p.diamonds || []))
                            .attr('data-stones', JSON.stringify(p.stones || []))
                            .attr('data-packets', JSON.stringify(p.packets || []))
                            .text(`${p.pre_code || ''}-${p.post_code || ''}-${p.barcode || ''} (${p.product_name || ''})`);

                        productSearch.append(option);
                    }
                }
            });
        }

        // ---------------------------------------------------------
        // FETCH INVOICE DATA (Edit Mode)
        // ---------------------------------------------------------
        $(document).ready(function() {
            // Initialize global state from Laravel data
            globalInvoiceId = "{{ $invoice->id }}";
            globalInvoiceItems = @json($invoice->items);
            ensureProductsInSearch(globalInvoiceItems);
            alreadySettled = parseFloat("{{ $alreadySettled ?? 0 }}") || 0;

            // Pre-select Customer
            var customerId = "{{ $invoice->user_id }}";
            if (customerId) {
                $('#customerDropdown').val(customerId).trigger('change');
            }

            // Render existing items and calculate totals
            if (globalInvoiceItems && globalInvoiceItems.length > 0) {
                renderItemsTable(globalInvoiceItems);
                calculateInvoiceTotals();
            } else {
                updateAvailableProducts([]);
            }

            // Ensure button text is correct
            const saveBtn = document.querySelector('button[type="submit"]');
            if (saveBtn) saveBtn.textContent = "Update Invoice";

            // Initial GST Check
            updateGstByType();
        });

        $('#customerDropdown').on('change', function() {
            const customerId = $(this).val();
            updateGstByType();

            if (customerId) {
                fetchUnsettledEntries(customerId, "{{ $invoice->id }}");
            } else {
                $('#unsettledEntriesSection').hide();
                $('#unsettledEntriesTable tbody').empty();
            }
        });

        function updateGstByType() {
            let customerDropdown = $('#customerDropdown');
            let CustomerState = customerDropdown.find(':selected').data('state');
            console.log('CustomerState=' + CustomerState);

            let AdminState =
                "{{ optional(Auth::guard('admin')->user())->state ?? (optional(Auth::guard('web')->user())->state ?? '') }}";
            console.log('AdminState->' + AdminState);

            if (!CustomerState || !AdminState) return;

            // Auto GST Logic
            if (AdminState.trim().toLowerCase() === CustomerState.trim().toLowerCase()) {
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
            calculateInvoiceTotals();
        }

        let customerId = {{ $invoice->user_id }};
        let invoiceId = {{ $invoice->id }};
        let currentAlreadySettled = {{ $alreadySettled ?? 0 }}; // Keep a copy
        fetchUnsettledEntries(customerId, invoiceId);




        function fetchUnsettledEntries(customerId, invoiceId = null) {
            let url = "{{ route('sell.invoice.unsettled', [':customerId', ':invoiceId']) }}";
            url = url.replace(':customerId', customerId);
            url = url.replace(':invoiceId', invoiceId || '');

            $.ajax({
                url: url,
                type: 'GET',
                success: function(res) {
                    const section = $('#unsettledEntriesSection');
                    const tbody = $('#unsettledEntriesTable tbody');
                    tbody.empty();

                    if (res.success && res.data.length > 0) {
                        section.show();
                        res.data.forEach((entry) => {
                            let checked = entry.is_already_settled ? 'checked' : '';
                            let tr = `
                                <tr>
                                    <td>
                                        ${entry.transaction_date}
                                        <input type="hidden" class="settle-id" value="${entry.id}">
                                    </td>
                                    <td><span class="badge bg-secondary">${entry.transaction_type}</span></td>
                                    <td>₹${parseFloat(entry.amount).toFixed(2)}</td>
                                    <td class="remaining-amt" data-val="${entry.remaining_amount}">₹${parseFloat(entry.remaining_amount).toFixed(2)}</td>
                                    <td>
                                        <input type="checkbox" class="settle-checkbox" ${checked} style="width: 20px; height: 20px;" data-type="${entry.transaction_type}">
                                    </td>
                                </tr>
                            `;
                            tbody.append(tr);
                        });
                        // Once table is loaded, we handle everything via checkboxes.
                        // Reset the base alreadySettled so we don't double count.
                        alreadySettled = 0;
                    } else {
                        section.hide();
                    }
                    calculateInvoiceTotals();
                }
            });
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

        $(document).on('change', '.settle-checkbox', function() {
            calculateInvoiceTotals();
        });

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
                    let fullCode = (barcode).trim();
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
                        <td>${item.item_name || ''}
                            <input type="hidden" name="total_amount[]" value="${item.final_price || 0}">
                            <!-- Hidden input for calculateInvoiceTotals to read -->
                        </td>
                        <td>${item.pre_code || ''}-${item.post_code || ''}</td>
                        <td>${item.barcode || ''}</td>
                        <td>${item.net_weight || 0}</td>
                        <td>${item.final_fn_weight || 0}</td>
                        <td>${item.metal_rate || 0}</td>
                        <td>${item.wastage_amount || 0}</td>
                        <td>${item.making_final_amount || 0}</td>

                        <td>₹${packetDiamondTotal.toFixed(2)}</td>
                        <td>₹${packetStoneTotal.toFixed(2)}</td>
                        <td>₹${parseFloat(item.final_price || 0).toFixed(2)}</td>
                        <td>
                            <button type="button" class="btn btn-warning btn-sm" onclick="editItem(${item.id})"><i class="fa fa-pencil"></i></button>
                            <button type="button" class="btn btn-danger btn-sm removeItem" data-id="${item.id}"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                `;
                tbody.append(tr);
            });
            updateAvailableProducts(items);
        }

        // ---------------------------------------------------------
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
                    wanted_amt: row.find('input[name="exchange_wanted_amt[]"]').val(),
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
                invoice_no: document.querySelector('input[name="invoice_no"]').value || '',
                customer_id: document.querySelector('#customerDropdown').value,
                invoice_date: document.querySelector('input[name="invoice_date"]').value || '',
                due_date: document.querySelector('input[name="due_date"]').value || '',
                taxable_amount: document.getElementById('taxableAmountInput').value,

                total_exchange_amount: document.getElementById('totalExchangeAmountInput').value,
                exchange_items: exchange_items,
                exchange_diamonds: exchange_diamonds,

                discount_percent: document.getElementById('discountPercent').value || 0,
                cgst_percent: document.getElementById('cgstPercent').value || 0,
                sgst_percent: document.getElementById('sgstPercent').value || 0,
                igst_percent: document.getElementById('igstPercent').value || 0,

                // New Discount Fields
                total_making_charge: document.getElementById('totalMakingAmountInput').value || 0,
                making_discount_percent: document.getElementById('makingDiscountPercent').value || 0,
                making_discount_amount: document.getElementById('makingDiscountAmount').innerText.replace('₹', '')
                    .replace(',', ''),
                total_wastage_charge: document.getElementById('totalWastageAmountInput').value || 0,
                wastage_discount_percent: document.getElementById('wastageDiscountPercent').value || 0,
                wastage_discount_amount: document.getElementById('wastageDiscountAmount').innerText.replace('₹', '')
                    .replace(',', ''),
                total_diamond_stone_packet: document.getElementById('totalDiamondStonePacketAmountInput').value || 0,
                diamond_discount_percent: document.getElementById('diamondDiscountPercent').value || 0,
                diamond_discount_amount: document.getElementById('diamondDiscountAmount').innerText.replace('₹', '')
                    .replace(',', ''),
                diamond_total_amount: (parseFloat(document.getElementById('totalDiamondStonePacketAmountInput').value ||
                    0) - parseFloat(document.getElementById('diamondDiscountAmount').innerText.replace('₹', '')
                    .replace(',', '') || 0)).toFixed(2),

                cash_received: document.getElementById('cashReceived').value || 0,
                bank_received: document.getElementById('bankReceived').value || 0,
                online_received: document.getElementById('onlineReceived').value || 0,
                card_received: document.getElementById('cardReceived').value || 0,
                round_off: document.getElementById('roundOffInput').value || 0,
                payments: typeof PaymentBreakdownManager !== 'undefined' ? PaymentBreakdownManager.getPaymentsData() : [],
                settled_transactions: collectSettledTransactions(),
            };

            fetch('{{ route('sell.invoice.update') }}', {
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
                            window.location.reload();
                        } else {
                            alert('Failed to remove item');
                        }
                    });
            }
        });

        // --- EXCHANGE ROW LOGIC ---
        const defaultGoldRate24k = {{ \App\Models\MetalRate::where('admin_id', Auth::guard('admin')->id())->where('metal_type', 'Gold')->where('karat', '24')->value('price_per_gram') ?? 0 }};
        const defaultSilverRate = {{ \App\Models\MetalRate::where('admin_id', Auth::guard('admin')->id())->where('metal_type', 'Silver')->value('price_per_gram') ?? 0 }};

        $(document).on('click', '#addExchangeItem', function() {
            const tr = `
                <tr class="exchange-row">
                    <td><input type="text" name="exchange_description[]" class="form-control" placeholder="Description"></td>
                    <td>
                        <select name="exchange_metal[]" class="form-control exchange-metal">
                            <option value="Gold">Gold</option>
                            <option value="Silver">Silver</option>
                        </select>
                    </td>
                    <td><input type="number" step="0.001" name="exchange_gross[]" class="form-control exchange-gross" placeholder="Gross"></td>
                    <td><input type="number" step="0.001" name="exchange_less[]" class="form-control exchange-less" placeholder="Less"></td>
                    <td><input type="number" step="0.001" name="exchange_net[]" class="form-control exchange-net" readonly style="background-color: #e9ecef;"></td>
                    <td><input type="number" step="0.01" name="exchange_purity[]" class="form-control exchange-purity" placeholder="Purity"></td>
                    <td><input type="number" step="0.001" name="exchange_fine[]" class="form-control exchange-fine" readonly style="background-color: #e9ecef;"></td>
                    <td><input type="number" step="0.01" name="exchange_rate[]" class="form-control exchange-rate" placeholder="Rate" value="${defaultGoldRate24k}"></td>
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

        $(document).on('click', '#addExchangeDiamond', function() {
            const tr = `
                <tr class="exchange-diamond-row">
                    <td><input type="text" name="exchange_dia_description[]" class="form-control" placeholder="Description"></td>
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
                    <td><input type="number" name="exchange_dia_pieces[]" class="form-control exchange-dia-pieces" placeholder="Pieces" value="0"></td>
                    <td><input type="number" step="0.001" name="exchange_dia_weight[]" class="form-control exchange-dia-weight" placeholder="Weight" value="0"></td>
                    <td><input type="number" step="0.01" name="exchange_dia_rate[]" class="form-control exchange-dia-rate" placeholder="Rate" value="0"></td>
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



        // $(document).on('input', '.exchange-row input', function() {
        //     const row = $(this).closest('.exchange-row');
        //     const purity = parseFloat(row.find('.exchange-purity').val()) || 0;
        //     const gross = parseFloat(row.find('.exchange-gross').val()) || 0;
        //     const less = parseFloat(row.find('.exchange-less').val()) || 0;
        //     const net = gross - less;
        //     row.find('.exchange-net').val(net.toFixed(3));

        //     const fine = (net * purity) / 100;
        //     row.find('.exchange-fine').val(fine.toFixed(3));

        //     const wanted = parseFloat(row.find('.exchange-wanted-amt').val()) || 0;
        //     const rate = parseFloat(row.find('.exchange-rate').val()) || 0;
        //     const amount = fine * (rate / 10) + wanted;
        //     // console.log('amount='+amount);
        //     row.find('.exchange-amount').val(amount.toFixed(2));

        //     calculateInvoiceTotals();
        // });

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
                'diamondDiscountPercent','wastageDiscountPercent',
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
            const amountAfterFinalDiscount = taxableAmount - finalDiscountAmount - diamondDiscountAmount -
                makingDiscountAmount - wastageDiscountAmount;

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

            const cgstAmount = (amountAfterFinalDiscount * cgstPercent) / 100;
            const sgstAmount = (amountAfterFinalDiscount * sgstPercent) / 100;
            const igstAmount = (amountAfterFinalDiscount * igstPercent) / 100;

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

            const totalInvoiceAmount = (amountAfterFinalDiscount + cgstAmount + sgstAmount + igstAmount) - totalExchange;

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
            if (typeof PaymentBreakdownManager !== 'undefined' && typeof PaymentBreakdownManager.getPaymentsData === 'function') {
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
            //  console.log('totalInvoiceAmount='+totalInvoiceAmount);
            //  console.log('totalPaid='+totalPaid);
            //  console.log('totalSettled='+totalSettled);
            let remaining = Math.abs(
                parseFloat((roundedTotal - (totalPaid + totalSettled)).toFixed(2))
            );

            setBoxText('remainingAmount', remaining.toFixed(2));
            // console.log('remaining-'+totalInvoiceAmount+'-'+totalPaid+'+'totalSettled);
            // if (remaining < 0) remaining = 0;

            setBoxText('remainingAmount', remaining);
            setBoxText('remainingAmountFooter', roundedTotal - totalSettled);
        }

        /**
         * Helper to update text content with Currency formatting
         */
        function setBoxText(elementId, amount) {
            const el = document.getElementById(elementId);
            if (el) {
                // Output format: ₹123.00
                el.textContent = '₹' + parseFloat(amount).toFixed(2);
            }
        }
    </script>
    <script>
        window.ledgerAccounts = @json($accounts);
        window.initialPayments = @json($invoice->payments ?? []);

        const PaymentBreakdownManager = {
            accounts: [],

            init(accounts, initialPayments) {
                this.accounts = accounts || [];
                this.bindEvents();

                if (initialPayments && initialPayments.length > 0) {
                    initialPayments.forEach(p => {
                        this.addPaymentRow(p.payment_method, p);
                    });
                } else {
                    // Fallback to legacy fields
                    const cash = parseFloat("{{ $invoice->cash_received ?? 0 }}") || 0;
                    const bank = parseFloat("{{ $invoice->bank_received ?? 0 }}") || 0;
                    const online = parseFloat("{{ $invoice->online_received ?? 0 }}") || 0;
                    const card = parseFloat("{{ $invoice->card_received ?? 0 }}") || 0;

                    if (cash > 0) this.addPaymentRow('cash', { amount: cash });
                    if (bank > 0) this.addPaymentRow('cheque', { amount: bank });
                    if (online > 0) this.addPaymentRow('upi', { amount: online });
                    if (card > 0) this.addPaymentRow('card', { amount: card });

                    if (cash === 0 && bank === 0 && online === 0 && card === 0) {
                        this.addPaymentRow('cash');
                    }
                }
            },

            bindEvents() {
                // alert('hii');
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
                        const isExcluded = name === 'stock' || name.includes('debtor') || name === 'old metal received';
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
                    const isSel = (selectedAccountId !== null)
                        ? (acc.id == selectedAccountId)
                        : f.isDefault;
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
                    <div class="payment-row-item mb-2" data-method="${method}">
                        <!-- First line: Account Select, Amount, and Remove Button -->
                        <div class="d-flex align-items-center gap-2">
                            <div class="flex-grow-1">
                                ${selectHtml}
                            </div>
                            <div style="width: 100px; flex-shrink: 0;">
                                <input type="number" class="form-control form-control-sm payment-amount-input text-end" placeholder="Amount" style="font-size: 12px; width: 100px;" value="${data && data.amount ? data.amount : '0'}" min="0" step="0.01">
                            </div>
                            <div style="width: 25px; flex-shrink: 0; text-align: center;">
                                <button type="button" class="btn btn-sm btn-outline-danger remove-payment-row-btn p-0 m-0" style="width: 25px; height: 25px; line-height: 1;"><i class="fa fa-trash"></i></button>
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
                                <input type="date" class="form-control form-control-sm payment-date-input" style="font-size: 12px;" value="${data && data.transaction_date ? data.transaction_date : ''}">
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
                                <input type="date" class="form-control form-control-sm payment-date-input" style="font-size: 12px;" value="${data && data.transaction_date ? data.transaction_date : ''}">
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
                                <input type="date" class="form-control form-control-sm payment-date-input" style="font-size: 12px;" value="${data && data.transaction_date ? data.transaction_date : ''}">
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
            PaymentBreakdownManager.init(window.ledgerAccounts, window.initialPayments);
        });

        console.log("Bootstrap:", typeof bootstrap);
console.log("Modal:", document.getElementById("directSellModal"));
    </script>

    <!-- Direct Sell Modal -->
    <div class="modal fade" id="directSellModal" tabindex="-1" aria-labelledby="directSellModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content shadow-lg border-0" style="border-radius: 15px;">
                <div class="modal-header text-white" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-top-left-radius: 15px; border-top-right-radius: 15px;">
                    <h6 class="modal-title text-white" id="directSellModalLabel">Add Direct Sell Product</h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 bg-light" style="max-height: 80vh; overflow-y: auto;">
                    <form id="directSellForm">
                        <!-- PRODUCT INFO CARD -->
                        <div class=" mb-4" style="border-radius: 10px;">
                            <div class="row g-3">
                                <div class="col-xl-2 col-lg-2 col-md-3 position-relative">
                                    <label class="form-label font-weight-bold">Pre Code <span class="text-danger">*</span></label>
                                    <input type="text" id="direct_pre_code" class="form-control text-uppercase" placeholder="e.g. RING" required>
                                    <div id="directPreCodeSuggestions" class="dropdown-menu shadow-lg w-100" style="display: none; position: absolute; top: 100%; left: 0; z-index: 1050; max-height: 250px; overflow-y: auto;"></div>
                                </div>
                                <div class="col-xl-2 col-lg-2 col-md-3">
                                    <label class="form-label">Post Code <span class="text-danger">*</span></label>
                                    <input type="number" id="direct_post_code" class="form-control" placeholder="e.g. 1001" required>
                                </div>
                                <div class="col-xl-2 col-lg-2 col-md-3">
                                    <label class="form-label">Barcode (Pre + Post)</label>
                                    <input type="text" id="direct_barcode" class="form-control bg-light" readonly>
                                </div>
                                <div class="col-xl-2 col-lg-2 col-md-3">
                                    <label class="form-label">Product Name <span class="text-danger">*</span></label>
                                    <input type="text" id="direct_product_name" class="form-control" placeholder="Product Name" required>
                                </div>

                                <div class=" col-xl-2 col-lg-2col-md-3">
                                    <label class="form-label">Category <span class="text-danger">*</span></label>
                                    <select id="direct_category_id" class="form-select" required>
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xl-2 col-lg-2 col-md-3">
                                    <label class="form-label">Subcategory <span class="text-danger">*</span></label>
                                    <select id="direct_subcategory_id" class="form-select" required>
                                        <option value="">Select Subcategory</option>
                                    </select>
                                </div>

                                <div class="col-xl-2 col-lg-2 col-md-3">
                                    <label class="form-label">Metal Rate/Purity <span class="text-danger">*</span></label>
                                    <select id="direct_metal_rate" class="form-select" required>
                                        <option value="" data-price="0">Select Metal Rate</option>
                                        @foreach($metalRates as $rate)
                                            <option value="{{ $rate->id }}" data-metal="{{ strtolower($rate->metal_type) }}" data-price="{{ $rate->price_per_gram }}">
                                                {{ $rate->metal_type }} - ₹{{ $rate->price_per_gram }}/gm ({{ $rate->karat }}{{ $rate->purity_type === 'karat' ? 'KT' : '%' }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xl-2 col-lg-2 col-md-3">
                                    <label class="form-label">Gold Color</label>
                                    <select id="direct_gold_color" class="form-select">
                                        <option value="Yellow">Yellow</option>
                                        <option value="White">White</option>
                                        <option value="Rose">Rose</option>
                                        <option value="Two-Tone">Two-Tone</option>
                                    </select>
                                </div>
                                <div class="col-xl-2 col-lg-2 col-md-3">
                                    <label class="form-label">Size</label>
                                    <input type="text" id="direct_size" class="form-control" placeholder="Size">
                                </div>
                                <div class="col-xl-2 col-lg-2 col-md-3">
                                    <label class="form-label">Quantity</label>
                                    <input type="number" id="direct_quantity" class="form-control" value="1" min="1">
                                </div>
                                <div class="col-xl-2 col-lg-2 col-md-3">
                                    <label class="form-label">HSN Code</label>
                                    <input type="text" id="direct_hsn_code" class="form-control" placeholder="HSN Code">
                                </div>
                                <div class="col-xl-2 col-lg-2 col-md-3">
                                    <label class="form-label">Gross Wt (Gram) <span class="text-danger">*</span></label>
                                    <input type="number" step="0.001" id="direct_gross_weight" class="form-control" required>
                                </div>
                                <div class="col-xl-2 col-lg-2 col-md-3">
                                    <label class="form-label">Net Wt (Gram)</label>
                                    <input type="number" step="0.001" id="direct_net_weight" class="form-control bg-light" readonly>
                                </div>
                                <div class="col-xl-2 col-lg-2 col-md-3">
                                    <label class="form-label">Fine Wt (Gram)</label>
                                    <input type="number" step="0.001" id="direct_final_fn_weight" class="form-control bg-light" readonly>
                                </div>
                                <div class="col-xl-2 col-lg-2 col-md-3">
                                    <label class="form-label">Wastage %</label>
                                    <input type="number" step="0.01" id="direct_wastage_percent" class="form-control" value="0">
                                </div>

                                <div class="col-xl-2 col-lg-2 col-md-3">
                                    <label class="form-label">Wastage Amt (₹)</label>
                                    <input type="number" step="0.01" id="direct_wastage_amount" class="form-control bg-light" readonly>
                                </div>
                                <div class="col-xl-2 col-lg-2 col-md-3">
                                    <label class="form-label">Making Price</label>
                                    <input type="number" step="0.01" id="direct_making_price" class="form-control" value="0">
                                </div>
                                <div class="col-xl-2 col-lg-2 col-md-3">
                                    <label class="form-label">Making Type</label>
                                    <select id="direct_making_type" class="form-select">
                                        <option value="val">Fixed</option>
                                        <option value="per_gld_val">% of Gold Value</option>
                                        <option value="per_pcs">Per Piece</option>
                                        <option value="per_gm_nw">Per Gram (NW)</option>
                                        <option value="per_gm_gw">Per Gram (GW)</option>
                                        <option value="per_gm_fine_wt">Per Gram (Fine Wt)</option>
                                    </select>
                                </div>
                                <div class="col-xl-2 col-lg-2 col-md-3">
                                    <label class="form-label">Making Final Amt (₹)</label>
                                    <input type="number" step="0.01" id="direct_making_final_amount" class="form-control bg-light" readonly>
                                </div>

                                <div class="col-xl-2 col-lg-2 col-md-3">
                                    <label class="form-label">Gold Price (₹)</label>
                                    <input type="number" step="0.01" id="direct_gold_price" class="form-control bg-light" readonly>
                                </div>
                                {{-- <div class="col-xl-2 col-lg-2 col-md-3">
                                    <label class="form-label">GST %</label>
                                    <input type="number" step="0.01" id="direct_gst_percent" class="form-control" value="3">
                                </div>
                                <div class="col-xl-2 col-lg-2 col-md-3">
                                    <label class="form-label">GST Amt (₹)</label>
                                    <input type="number" step="0.01" id="direct_gst_amount" class="form-control bg-light" readonly>
                                </div> --}}
                                <div class="col-xl-2 col-lg-2 col-md-3">
                                    <label class="form-label text-success font-weight-bold">Final Product Price (₹)</label>
                                    <input type="number" step="0.01" id="direct_final_price" class="form-control border-success text-success bg-light" readonly>
                                </div>
                                <div class="col-lg-12">
                                <button type="button" id="directAddPacketBtn" class="btn btn-sm btn-outline-warning mb-2">+ Add Packet</button>
                                    <div id="directPacketWrapper"></div>  
                                </div>
                                <div class="col-lg-12">
<div class="modal-footer bg-light gap-2" style="border-bottom-left-radius: 15px; border-bottom-right-radius: 15px;">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="submitDirectSellBtn" class="btn btn-success">Save Direct Sell</button>
                </div>
                                </div>
                            </div>
                        </div>

                       


                    </form>
                </div>
                
            </div>
        </div>
    </div>

    <!-- Direct Sell Form JS -->
    <script>
        $(document).ready(function() {
            // Category on change
            $('#direct_category_id').on('change', function() {
                let categoryId = $(this).val();
                let subSelect = $('#direct_subcategory_id');
                subSelect.html('<option value="">Select Subcategory</option>');
                if (categoryId) {
                    $.ajax({
                        url: '{{ url('get-subcategories') }}/' + categoryId,
                        type: 'GET',
                        success: function(data) {
                            if (data.length > 0) {
                                $.each(data, function(key, subcategory) {
                                    subSelect.append(
                                        '<option value="' + subcategory.subcategory_id + '">' +
                                        subcategory.subcategory_name +
                                        '</option>'
                                    );
                                });
                            }
                        }
                    });
                }
            });

            // Autocomplete Pre Code
            let directPreTimeout = null;

            function fetchDirectPreCodeSuggestions(term) {
                clearTimeout(directPreTimeout);
                directPreTimeout = setTimeout(function() {
                    $.ajax({
                        url: "{{ route('products.searchPreCode') }}",
                        type: "GET",
                        data: { term: term },
                        success: function(data) {
                            let $box = $('#directPreCodeSuggestions');
                            $box.empty();
                            if (data && data.length > 0) {
                                $.each(data, function(i, item) {
                                    let html = '<a href="javascript:void(0)" class="dropdown-item direct-pre-code-suggestion-item py-2 px-3 border-bottom" ' +
                                        'data-pre_code="' + (item.pre_code || '') + '" ' +
                                        'data-product_name="' + (item.product_name || '') + '" ' +
                                        'data-category_id="' + (item.category_id || '') + '" ' +
                                        'data-subcategory_id="' + (item.subcategory_id || '') + '">' +
                                        '<div><strong>' + (item.pre_code || '') + '</strong> - ' + (item.product_name || 'Unnamed Product') + '</div>' +
                                        '</a>';
                                    $box.append(html);
                                });
                                $box.show();
                            } else {
                                $box.hide();
                            }
                        }
                    });
                }, 150);
            }

            function fetchNextDirectPostCode(preCodeVal) {
                if (!preCodeVal) {
                    $('#direct_post_code').val('0001');
                    updateDirectBarcode();
                    return;
                }
                $.ajax({
                    url: "{{ route('products.getNextPostCode') }}",
                    type: "GET",
                    data: {
                        pre_code: preCodeVal
                    },
                    success: function(response) {
                        if ($('#direct_post_code').val() !== response.post_code) {
                            $('#direct_post_code').val(response.post_code);
                        }
                        updateDirectBarcode();
                    }
                });
            }

            let directPreCodeTimeout = null;
            $('#direct_pre_code').on('input change', function(e) {
                clearTimeout(directPreCodeTimeout);
                let currentVal = $(this).val().trim();
                let delay = (e.type === 'change') ? 0 : 250;

                directPreCodeTimeout = setTimeout(function() {
                    if (currentVal === '') {
                        $('#direct_post_code').val('0001');
                        updateDirectBarcode();
                        return;
                    }
                    fetchNextDirectPostCode(currentVal);
                }, delay);
            });

            $('#direct_pre_code').on('focus', function() {
                let val = $(this).val().trim();
                fetchDirectPreCodeSuggestions(val);
            });

            $(document).on('click', '.direct-pre-code-suggestion-item', function() {
                let preCode = $(this).data('pre_code');
                let name = $(this).data('product_name');
                let catId = $(this).data('category_id');
                let subId = $(this).data('subcategory_id');

                $('#direct_pre_code').val(preCode);
                $('#direct_product_name').val(name);
                $('#direct_category_id').val(catId).trigger('change');

                setTimeout(function() {
                    $('#direct_subcategory_id').val(subId);
                }, 400);

                $('#directPreCodeSuggestions').hide();
                fetchNextDirectPostCode(preCode);
            });

            $(document).on('click', function(e) {
                if (!$(e.target).closest('#direct_pre_code, #directPreCodeSuggestions').length) {
                    $('#directPreCodeSuggestions').hide();
                }
            });

            function updateDirectBarcode() {
                let pre = $('#direct_pre_code').val().trim().toUpperCase();
                let post = $('#direct_post_code').val().trim();
                $('#direct_barcode').val(pre + post);
            }

            $('#direct_post_code').on('input', updateDirectBarcode);

            // Add/Remove items

            $('#directAddPacketBtn').on('click', function() {
                let uniqueId = Date.now();
                let html = `
                <div class="card p-3 mb-2 bg-white border packet-item" style="border-radius: 8px;">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="text-dark font-weight-bold">Packet Details</h6>
                        <button type="button" class="btn btn-sm btn-link text-danger remove-packet-btn p-0"><i class="feather-trash-2"></i> Remove</button>
                    </div>
                    <input type="hidden" class="packet-master-id">
                    <div class="row g-3">
                        <div class="col-xl-2 col-lg-2 col-md-3">
                            <label class="form-label small">Packet No *</label>
                            <select class="form-control packet-select" required></select>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-3">
                            <label class="form-label small">Packet Type</label>
                            <select class="form-select packet-type-select">
                                @foreach ($packet_types as $pt)
                                    <option value="{{ $pt->name }}">{{ $pt->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-3">
                            <label class="form-label small">Stone</label>
                            <select class="form-select packet-stone-select">
                                <option value="">Select Stone</option>
                                @foreach($stones as $st)
                                    <option value="{{ $st->id }}">{{ $st->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-3">
                            <label class="form-label small">Shape</label>
                            <select class="form-select packet-shape-select">
                                <option value="">Select Shape</option>
                                @foreach($shapes as $sh)
                                    <option value="{{ $sh->id }}">{{ $sh->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-3">
                            <label class="form-label small">Clarity</label>
                            <select class="form-select packet-clarity-select">
                                <option value="">Select Clarity</option>
                                @foreach($clarities as $cl)
                                    <option value="{{ $cl->id }}">{{ $cl->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-3">
                            <label class="form-label small">Color</label>
                            <select class="form-select packet-color-select">
                                <option value="">Select Color</option>
                                @foreach($colors as $co)
                                    <option value="{{ $co->id }}">{{ $co->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-3">
                            <label class="form-label small">Cut</label>
                            <select class="form-select packet-cut-select">
                                <option value="">Select Cut</option>
                                @foreach($cuts as $cu)
                                    <option value="{{ $cu->id }}">{{ $cu->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-3">
                            <label class="form-label small">MM</label>
                            <select class="form-select packet-mm-select">
                                <option value="">Select MM</option>
                                @foreach($mms as $mm)
                                    <option value="{{ $mm->id }}">{{ $mm->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2">
                            <label class="form-label small">Pcs</label>
                            <input type="number" class="form-control packet-pcs" value="0">
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2">
                            <label class="form-label small">Carat (Wt)</label>
                            <input type="number" step="0.001" class="form-control packet-weight" value="0">
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2">
                            <label class="form-label small">Wt (Gram)</label>
                            <input type="number" step="0.001" class="form-control packet-gram" value="0">
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2">
                            <label class="form-label small">Rate</label>
                            <input type="number" step="0.01" class="form-control packet-rate" value="0">
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2"> 
                            <label class="form-label small">UOM</label>
                            <select class="form-select packet-uom">
                                <option value="PCS">PCS</option>
                                <option value="CT" selected>CT</option>
                                <option value="WT">WT</option>
                            </select>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2">
                            <label class="form-label small">Amount</label>
                            <input type="number" step="0.01" class="form-control packet-amount" value="0" readonly>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-3">
                            <label class="form-label small">Certificate No</label>
                            <input type="text" class="form-control packet-cert" readonly>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-3 d-flex align-items-center mt-4">
                            <div class="form-check">
                                <input class="form-check-input packet-solitaire" type="checkbox" id="packet_solitaire_check_${uniqueId}">
                                <label class="form-check-label small" for="packet_solitaire_check_${uniqueId}">Solitaire</label>
                            </div>
                        </div>
                    </div>
                </div>`;
                let $row = $(html);
                $('#directPacketWrapper').append($row);
                initDirectPacketSelect2($row.find('.packet-select'));
            });

            $(document).on('click', '.remove-packet-btn', function() {
                $(this).closest('.packet-item').remove();
                calculateDirectSellForm();
            });

            function initDirectPacketSelect2(element) {
                element.select2({
                    placeholder: 'Search packet...',
                    dropdownParent: $('#directSellModal'),
                    allowClear: true,
                    width: '100%',
                    ajax: {
                        url: "{{ route('products.searchPacket') }}",
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            return { term: params.term };
                        },
                        processResults: function(data) {
                            return {
                                results: $.map(data, function(item) {
                                    return {
                                        id: item.label,
                                        text: item.label,
                                        real_id: item.id,
                                        details: item.details
                                    }
                                })
                            };
                        },
                        cache: true
                    }
                }).on('select2:select', function(e) {
                    var data = e.params.data;
                    var details = data.details;
                    var wrapper = $(this).closest('.packet-item');

                    wrapper.find('.packet-master-id').val(data.real_id);
                    wrapper.find('.packet-stone-select').val(details.stone_id).trigger('change');
                    wrapper.find('.packet-shape-select').val(details.shape_id).trigger('change');
                    wrapper.find('.packet-color-select').val(details.color_id).trigger('change');
                    wrapper.find('.packet-clarity-select').val(details.clarity_id).trigger('change');
                    wrapper.find('.packet-cut-select').val(details.cut_id).trigger('change');
                    wrapper.find('.packet-mm-select').val(details.mm_id).trigger('change');
                    wrapper.find('.packet-rate').val(details.rate);
                    wrapper.find('.packet-cert').val(details.certificate_no);

                    if (details.packet_type) {
                        wrapper.find('.packet-type-select').val(details.packet_type).trigger('change');
                    }
                    calculateDirectSellForm();
                });
            }

            // Calculations
            function calculateDirectSellForm() {
                let grossWeight = parseFloat($('#direct_gross_weight').val()) || 0;
                let metalRate = parseFloat($('#direct_metal_rate option:selected').data('price')) || 0;
                let wastagePerc = parseFloat($('#direct_wastage_percent').val()) || 0;
                let makingInput = parseFloat($('#direct_making_price').val()) || 0;
                let makingType = $('#direct_making_type').val();
                let gstPerc = parseFloat($('#direct_gst_percent').val()) || 0;
                let quantity = parseFloat($('#direct_quantity').val()) || 1;

                // Packets calculations
                let totalPacketGram = 0;
                let packetTotal = 0;
                $('#directPacketWrapper .packet-item').each(function() {
                    let wrapper = $(this);
                    let uom = wrapper.find('.packet-uom').val();
                    let pcs = parseFloat(wrapper.find('.packet-pcs').val()) || 0;
                    let ct = parseFloat(wrapper.find('.packet-weight').val()) || 0;
                    let gm = parseFloat(wrapper.find('.packet-gram').val()) || 0;
                    let rate = parseFloat(wrapper.find('.packet-rate').val()) || 0;
                    let amount = 0;

                    if (uom === 'CT') {
                        gm = ct / 5;
                        wrapper.find('.packet-gram').val(gm.toFixed(3));
                        amount = ct * rate;
                    } else if (uom === 'WT') {
                        ct = gm * 5;
                        wrapper.find('.packet-weight').val(ct.toFixed(3));
                        amount = gm * rate;
                    } else if (uom === 'PCS') {
                        amount = pcs * rate;
                    }

                    wrapper.find('.packet-amount').val(amount.toFixed(2));
                    totalPacketGram += gm;
                    packetTotal += amount;
                });

                let netWeight = grossWeight - totalPacketGram;
                if (netWeight < 0) netWeight = 0;

                let wastageWeight = (netWeight * wastagePerc) / 100;
                let fineWeight = netWeight + wastageWeight;

                $('#direct_net_weight').val(netWeight.toFixed(3));
                $('#direct_final_fn_weight').val(fineWeight.toFixed(3));

                let goldValue = metalRate * netWeight;
                let wastageAmount = wastageWeight * metalRate;
                $('#direct_wastage_amount').val(wastageAmount.toFixed(2));

                let makingFinal = 0;
                switch (makingType) {
                    case 'val':
                        makingFinal = makingInput;
                        break;
                    case 'per_gld_val':
                        makingFinal = (goldValue * makingInput) / 100;
                        break;
                    case 'per_pcs':
                        makingFinal = makingInput * quantity;
                        break;
                    case 'per_gm_nw':
                        makingFinal = makingInput * netWeight;
                        break;
                    case 'per_gm_gw':
                        makingFinal = makingInput * grossWeight;
                        break;
                    case 'per_gm_fine_wt':
                        makingFinal = makingInput * fineWeight;
                        break;
                }

                $('#direct_making_final_amount').val(makingFinal.toFixed(2));
                $('#direct_gold_price').val(goldValue.toFixed(2));

                let subTotal = goldValue + wastageAmount + makingFinal + packetTotal;
                let gstAmountFinal = (subTotal * gstPerc) / 100;
                let finalPrice = subTotal; // In stock / invoices, final_price is subtotal before tax (tax is at invoice level)

                $('#direct_gst_amount').val(gstAmountFinal.toFixed(2));
                $('#direct_final_price').val(finalPrice.toFixed(2));
            }

            $(document).on('input change', `
                #direct_gross_weight,
                #direct_metal_rate,
                #direct_wastage_percent,
                #direct_making_price,
                #direct_making_type,
                #direct_quantity,
                #directPacketWrapper input,
                #directPacketWrapper select
            `, function() {
                calculateDirectSellForm();
            });

            // Submit direct sell
            $('#submitDirectSellBtn').on('click', function(e) {
                e.preventDefault();

                let customerId = $('#customerDropdown').val();
                if (!customerId) {
                    alert('Please select a customer first');
                    return;
                }

                let preCode = $('#direct_pre_code').val().trim();
                let postCode = $('#direct_post_code').val().trim();
                let name = $('#direct_product_name').val().trim();
                let category = $('#direct_category_id').val();
                let subcategory = $('#direct_subcategory_id').val();
                let metalRateId = $('#direct_metal_rate').val();
                let grossWeight = $('#direct_gross_weight').val();

                if (!preCode || !postCode || !name || !category || !subcategory || !metalRateId || !grossWeight) {
                    alert('Please fill in all required fields marked with *');
                    return;
                }



                let packets = [];
                $('#directPacketWrapper .packet-item').each(function() {
                    let packet_no = $(this).find('.packet-select').val();
                    let master_id = $(this).find('.packet-master-id').val();
                    let type = $(this).find('.packet-type-select').val();
                    let stone_id = $(this).find('.packet-stone-select').val();
                    let shape_id = $(this).find('.packet-shape-select').val();
                    let clarity_id = $(this).find('.packet-clarity-select').val();
                    let color_id = $(this).find('.packet-color-select').val();
                    let cut_id = $(this).find('.packet-cut-select').val();
                    let mm_id = $(this).find('.packet-mm-select').val();
                    let pcs = parseInt($(this).find('.packet-pcs').val()) || 0;
                    let weight = parseFloat($(this).find('.packet-weight').val()) || 0;
                    let wt_in_gram = parseFloat($(this).find('.packet-gram').val()) || 0;
                    let rate = parseFloat($(this).find('.packet-rate').val()) || 0;
                    let amount = parseFloat($(this).find('.packet-amount').val()) || 0;
                    let certificate_no = $(this).find('.packet-cert').val();
                    let solitaire = $(this).find('.packet-solitaire').is(':checked') ? 1 : 0;

                    packets.push({
                        packet_no,
                        packet_master_id: master_id,
                        packet_type: type,
                        stone_id,
                        shape_id,
                        clarity_id,
                        color_id,
                        cut_id,
                        mm_id,
                        pcs,
                        weight,
                        wt_in_gram,
                        rate,
                        amount,
                        certificate_no,
                        solitaire,
                        uom: $(this).find('.packet-uom').val()
                    });
                });

                let payload = {
                    _token: '{{ csrf_token() }}',
                    sell_invoice_id: typeof globalInvoiceId !== 'undefined' ? globalInvoiceId : null,
                    customer_id: customerId,
                    invoice_no: $('input[name="invoice_no"]').val(),
                    invoice_date: $('input[name="invoice_date"]').val(),
                    due_date: $('input[name="due_date"]').val(),

                    pre_code: preCode,
                    post_code: postCode,
                    barcode: $('#direct_barcode').val(),
                    product_name: name,
                    category_id: category,
                    subcategory_id: subcategory,
                    purity_id: null,
                    metal_rate_id: metalRateId,
                    gold_color: $('#direct_gold_color').val(),
                    size: $('#direct_size').val(),
                    quantity: $('#direct_quantity').val(),
                    hsn_code: $('#direct_hsn_code').val(),

                    gross_weight: grossWeight,
                    net_weight: $('#direct_net_weight').val(),
                    final_fn_weight: $('#direct_final_fn_weight').val(),
                    wastage_percent: $('#direct_wastage_percent').val(),
                    wastage_amount: $('#direct_wastage_amount').val(),
                    making_price: $('#direct_making_price').val(),
                    making_type: $('#direct_making_type').val(),
                    making_final_amount: $('#direct_making_final_amount').val(),
                    gold_price: $('#direct_gold_price').val(),
                    gst_percent: $('#direct_gst_percent').val(),
                    gst_amount: $('#direct_gst_amount').val(),
                    total_amount: parseFloat($('#direct_gold_price').val()) + parseFloat($('#direct_wastage_amount').val()) + parseFloat($('#direct_making_final_amount').val()),
                    final_price: $('#direct_final_price').val(),

                    metal_rate: $('#direct_metal_rate option:selected').data('price') || 0,

                    diamonds: [],
                    stones: [],
                    packets: packets
                };

                $.ajax({
                    url: "{{ route('sell.invoice.addDirectSell') }}",
                    type: "POST",
                    data: JSON.stringify(payload),
                    contentType: "application/json",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(res) {
                        if (res.success) {
                            $('#directSellModal').modal('hide');
                            $('#directSellForm')[0].reset();
                            $('#directPacketWrapper').empty();

                            fetchPendingInvoice(customerId);
                        } else {
                            alert(res.message || 'Error saving direct sell');
                        }
                    },
                    error: function(xhr) {
                        let msg = xhr.responseJSON ? xhr.responseJSON.message : 'Error saving direct sell';
                        alert(msg);
                    }
                });
            });
        });
    </script>
@endsection
