<?php $page = 'add-invoice'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <!-- Select2 CSS -->

    <script src="{{ URL::asset('/public/assets/js/sellcalculation.js') }}"></script>
    <!-- <script src="{{ URL::asset('/public/assets/js/sellcalculation.js') }}"></script> -->
    <!-- Summernote CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/css/intlTelInput.css" />
    <!-- Intl-Tel-Input CSS -->
    <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet"> -->

    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="card mb-0">
                <div class="card-body">
                    <div class="page-header">
                        <div class="content-page-header">
                            <h5>Edit Invoice</h5>
                        </div>
                    </div>

                    <form action="{{ route('sell.invoice.update') }}" method="POST"> <!-- AJAX handles it -->
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12">
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
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <label>Due Date</label>
                                                <div class="cal-icon cal-icon-info">
                                                    <input type="text" name='due_date'
                                                        class="datetimepicker form-control" placeholder="Select Date"
                                                        value="{{ isset($invoice) && $invoice->invoice_due_date ? \Carbon\Carbon::parse($invoice->invoice_due_date)->format('d-m-Y') : '' }}">
                                                </div>
                                            </div>
                                        </div>
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
                                <div class="row mb-3">
                                    <div class="col-lg-6 col-md-8 col-sm-12">
                                        <label>Search Product Code</label>
                                        <select id="productSearch" class="form-control select">
                                            <option value="">Search by Product Code</option>

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
                                                                'pcs' => $p->pcs,
                                                                'certificate_no' => $p->certificate_no,
                                                                'stone' => optional($p->stone)->name,
                                                                'clarity' => optional($p->clarity)->name,
                                                                'color' => optional($p->color)->name,
                                                                'cut' => optional($p->cut)->name,
                                                                'shape' => optional($p->shape)->name,
                                                                'chalni' => optional($p->chalni)->name,
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
                                                    {{ $product->pre_code }}-{{ $product->post_code }}-{{ $product->product_name }}
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
                                                <th>Sub Category</th>
                                                <th>Product Name</th>
                                                <th>Pre Code</th>
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

                                                <td><input type="text" name="category[]" class="form-control"
                                                        style="pointer-events: none; background-color: #e9ecef;"></td>
                                                <td><input type="text" name="subcategory[]" class="form-control"
                                                        style="pointer-events: none; background-color: #e9ecef;"></td>
                                                <td><input type="text" name="product_name[]" class="form-control"
                                                        style="pointer-events: none; background-color: #e9ecef;"></td>
                                                <td><input type="text" name="pre_code[]" class="form-control"
                                                        style="pointer-events: none; background-color: #e9ecef;"></td>
                                                <td><input type="text" name="post_code[]" class="form-control"
                                                        style="pointer-events: none; background-color: #e9ecef;"></td>
                                                <input type="hidden" name="barcode[]"
                                                    class="form-control"style="pointer-events: none; background-color: #e9ecef;">

                                                <input type="hidden" name="hsn_code[]" class="form-control"
                                                    style="pointer-events: none; background-color: #e9ecef;">
                                                <td><input type="number" step="0.01" name="metal_rate[]"
                                                        class="form-control"></td>
                                                <td><input type="number" name="quantity[]" class="form-control"
                                                        value="1"
                                                        style="pointer-events: none; background-color: #e9ecef;"></td>
                                                <td><input type="number" step="0.001" name="gross_weight[]"
                                                        class="form-control"
                                                        style="pointer-events: none; background-color: #e9ecef;"></td>
                                                <td><input type="number" step="0.001" name="net_weight[]"
                                                        class="form-control"
                                                        style="pointer-events: none; background-color: #e9ecef;"></td>
                                                <td><input type="number" step="0.001" name="final_fn_weight[]"
                                                        class="form-control"
                                                        style="pointer-events: none; background-color: #e9ecef;"></td>
                                                <td><input type="text" name="size[]" class="form-control"
                                                        style="pointer-events: none; background-color: #e9ecef;"></td>
                                                <td><input type="number" step="0.01" name="wastage_percent[]"
                                                        class="form-control"
                                                        style="pointer-events: none; background-color: #e9ecef;"></td>
                                                <td><input type="number" step="0.01" name="making_price[]"
                                                        class="form-control"></td>
                                                <td>
                                                    <select name="making_type[]" class="form-control">
                                                        <option value="val">Value</option>
                                                        <option value="per_gld_val">% of Gold Value</option>
                                                        <option value="per_pcs">Per Pcs</option>
                                                        <option value="per_gm_nw" selected>Rate/Gm of Nw</option>
                                                        <option value="per_gm_gw">Rate/Gm of Gw</option>
                                                        <option value="per_gm_fine_wt">Rate/Gm of Fine Wt</option>
                                                    </select>
                                                </td>
                                                <td><input type="number" step="0.01" name="making_final_amount[]"
                                                        class="form-control"></td>
                                                <input type="hidden" step="0.01" name="gst_percent[]"
                                                    class="form-control"
                                                    style="pointer-events: none; background-color: #e9ecef;">
                                                <input type="hidden" step="0.01" name="gst_amount[]"
                                                    class="form-control"
                                                    style="pointer-events: none; background-color: #e9ecef;">
                                                <td>
                                                    <input type="number" step="0.01" name="total_amount[]"
                                                        class="form-control"
                                                        style="pointer-events: none; background-color: #e9ecef;">
                                                </td>
                                                <td>
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
                                                    <th>Pieces</th>
                                                    <th>Cert. No</th>
                                                    <th>Stone</th>
                                                    <th>Clarity</th>
                                                    <th>Color</th>
                                                    <th>Cut</th>
                                                    <th>Shape</th>
                                                    <th>Chalni</th>
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
                                            <th>Code</th>
                                            <th>Barcode</th>
                                            <th>Net Wt</th>
                                            <th>Fn Wt</th>
                                            <th>Metal Rate</th>
                                            <th>Making</th>
                                            {{-- <th>GST</th> --}}
                                            <th>Diamond Amt</th> <!-- NEW -->
                                            <th>Stone Amt</th>
                                            <th>Pkt Amt</th>
                                            <th>Final Amt</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($invoice->items as $item)
                                            <tr>
                                                <td>{{ $item->product->product_name }}</td>
                                                <td>{{ $item->pre_code }}-{{ $item->post_code }}</td>
                                                <td>{{ $item->barcode }}</td>
                                                <td>{{ $item->net_weight }}</td>
                                                <td>{{ $item->final_fn_weight }}</td>
                                                <td>{{ $item->metal_rate }}</td>
                                                <td>{{ $item->making_final_amount }}</td>
                                                {{-- <td>{{ $item->gst }}</td> --}}
                                                <td>₹{{ number_format($item->diamond_amount, 2) }}</td>
                                                <td>₹{{ number_format($item->stone_amount, 2) }}</td>
                                                <td>₹{{ number_format($item->packet_amount, 2) }}</td>
                                                <td>₹{{ number_format($item->final_price, 2) }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-warning btn-sm" onclick="editItem({{ $item->id }})">Edit</button>
                                                    <button type="button" class="btn btn-danger btn-sm removeItem" data-id="{{ $item->id }}">X</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <!-- Exchange / Old Gold Section -->
                                <div class="card mt-4">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0">Exchange/Old Gold</h5>
                                        <button type="button" class="btn btn-warning btn-sm" id="addExchangeItem">
                                            + Add Item
                                        </button>
                                    </div>
                                    <div class="card-body p-0">
                                        <table class="table table-bordered mb-0" id="exchangeTable">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th>Description</th>
                                                    <th>Metal</th>
                                                    <th>Purity</th>
                                                    <th>Gross</th>
                                                    <th>Less</th>
                                                    <th>Net</th>
                                                    <th>Fine</th>
                                                    <th>Wanted Amt</th>
                                                    <th>Rate</th>
                                                    <th>Amount</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($invoice->exchangeItems as $ex)
                                                <tr class="exchange-row">
                                                    <td><input type="text" name="exchange_description[]" class="form-control" value="{{ $ex->description }}"></td>
                                                    <td>
                                                        <select name="exchange_metal[]" class="form-control">
                                                            <option value="Gold" {{ $ex->metal == 'Gold' ? 'selected' : '' }}>Gold</option>
                                                            <option value="Silver" {{ $ex->metal == 'Silver' ? 'selected' : '' }}>Silver</option>
                                                        </select>
                                                    </td>
                                                    <td><input type="number" step="0.01" name="exchange_purity[]" class="form-control exchange-purity" value="{{ $ex->purity }}"></td>
                                                    <td><input type="number" step="0.001" name="exchange_gross[]" class="form-control exchange-gross" value="{{ $ex->gross_weight }}"></td>
                                                    <td><input type="number" step="0.001" name="exchange_less[]" class="form-control exchange-less" value="{{ $ex->less_weight }}"></td>
                                                    <td><input type="number" step="0.001" name="exchange_net[]" class="form-control exchange-net" readonly style="background-color: #e9ecef;" value="{{ $ex->net_weight }}"></td>
                                                    <td><input type="number" step="0.001" name="exchange_fine[]" class="form-control exchange-fine" readonly style="background-color: #e9ecef;" value="{{ $ex->fine_weight }}"></td>
                                                    <td><input type="number" step="0.01" name="exchange_wanted_amt[]" class="form-control exchange-wanted-amt" value="{{ $ex->wanted_amt }}"></td>
                                                    <td><input type="number" step="0.01" name="exchange_rate[]" class="form-control exchange-rate" value="{{ $ex->rate }}"></td>
                                                    <td><input type="number" step="0.01" name="exchange_amount[]" class="form-control exchange-amount" readonly style="background-color: #e9ecef;" value="{{ $ex->amount }}"></td>
                                                    <td><button type="button" class="btn btn-danger btn-sm remove-exchange-row">X</button></td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                </table>








                                <!-- <h4 class="mt-3">Grand Total: ₹<span id="grandTotal">0.00</span></h4> -->
                                {{-- <button class="btn btn-outline-secondary" id="showTermsBtn">+ Add Terms & Conditions</button>

                            <button class="btn btn-outline-danger" id="addNoteBtn">+ Add Note</button>

                            <button class="btn btn-outline-success" id="addDocBtn">+ Add Attachments</button>

                            <button class="btn btn-outline-secondary" id="addContactBtn">+ Add Contact</button>

                            <button class="btn btn-outline-primary" id="addInfoBtn">+ Add Additional Info</button> --}}
                                <div class="form-group-item border-0 p-0">
                                    <div class="row">



                                        <div class="col-xl-6 col-lg-12">
                                            <div class="form-group-bank">

                                                <!-- hidden states -->
                                                <input type="hidden" id="businessState" value="{{ $business->state }}">
                                                <input type="hidden" id="customerState" value="">

                                                <div class="invoice-total-box">
                                                    <div class="invoice-total-inner">

                                                        <!-- Making Charge Section -->
                                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                                            <label>Total Making Charge</label>
                                                            <span id="totalMakingAmount">₹{{ number_format($invoice->total_making_charge ?? 0, 2) }}</span>
                                                            <input type="hidden" id="totalMakingAmountInput" value="{{ $invoice->total_making_charge ?? 0 }}">
                                                        </div>

                                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                                            <label>Making Discount %</label>
                                                            <input type="number" id="makingDiscountPercent" class="form-control w-25" value="{{ $invoice->making_discount_percent ?? 0 }}">
                                                            <span id="makingDiscountAmount">₹{{ number_format($invoice->making_discount_amount ?? 0, 2) }}</span>
                                                        </div>

                                                        <hr>

                                                        <!-- Diamond/Stone/Packet Section -->
                                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                                            <label>Total Diamond/Stone/Pkt</label>
                                                            <span id="totalDiamondStonePacketAmount">₹{{ number_format($invoice->total_diamond_stone_packet ?? 0, 2) }}</span>
                                                            <input type="hidden" id="totalDiamondStonePacketAmountInput" value="{{ $invoice->total_diamond_stone_packet ?? 0 }}">
                                                        </div>

                                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                                            <label>Diamond Discount %</label>
                                                            <input type="number" id="diamondDiscountPercent" class="form-control w-25" value="{{ $invoice->diamond_discount_percent ?? 0 }}">
                                                            <span id="diamondDiscountAmount">₹{{ number_format($invoice->diamond_discount_amount ?? 0, 2) }}</span>
                                                        </div>

                                                        <hr>

                                                        <p>
                                                            Taxable Amount
                                                            <span id="taxableAmount">₹{{ number_format($invoice->taxable_amount ?? 0, 2) }}</span>
                                                            <input type="hidden" id="taxableAmountInput" value="{{ $invoice->taxable_amount ?? 0 }}">
                                                        </p>

                                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                                            <label>Total Exchange</label>
                                                            <span id="totalExchangeAmount">₹{{ number_format($invoice->total_exchange_amount ?? 0, 2) }}</span>
                                                            <input type="hidden" id="totalExchangeAmountInput" value="{{ $invoice->total_exchange_amount ?? 0 }}">
                                                        </div>
                                                             <div class="d-flex justify-content-between align-items-center">
                                                            <label>Final Discount %</label>
                                                            <input type="number" id="discountPercent"
                                                                class="form-control w-25"
                                                                value="{{ $invoice->discount_percent ?? 0 }}">
                                                            <span id="discountAmount">₹{{ number_format($invoice->discount_amount ?? 0, 2) }}</span>
                                                        </div>
                                                        <hr>

                                                        <!-- CGST -->
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <label>CGST %</label>
                                                            <input type="number" id="cgstPercent"
                                                                class="form-control w-25"
                                                                value="{{ $invoice->cgst_percent ?? 0 }}">
                                                            <span id="cgstAmount">₹{{ number_format($invoice->cgst_amount ?? 0, 2) }}</span>
                                                        </div>

                                                        <!-- SGST -->
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <label>SGST %</label>
                                                            <input type="number" id="sgstPercent"
                                                                class="form-control w-25"
                                                                value="{{ $invoice->sgst_percent ?? 0 }}">
                                                            <span id="sgstAmount">₹{{ number_format($invoice->sgst_amount ?? 0, 2) }}</span>
                                                        </div>

                                                        <!-- IGST -->
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <label>IGST %</label>
                                                            <input type="number" id="igstPercent"
                                                                class="form-control w-25"
                                                                value="{{ $invoice->igst_percent ?? 0 }}">
                                                            <span id="igstAmount">₹{{ number_format($invoice->igst_amount ?? 0, 2) }}</span>
                                                        </div>

                                                        <!-- Final Discount -->


                                                        <hr>
                                                        <h4>
                                                            Total Amount
                                                            <span id="totalInvoiceAmount">₹{{ number_format($invoice->final_amount ?? 0, 2) }}</span>
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-12">
                                            <div class="form-group-bank">

                                                <!-- hidden states -->
                                                <input type="hidden" id="businessState" value="{{ $business->state }}">
                                                <input type="hidden" id="customerState" value="">

                                                <div class="invoice-total-box">
                                                    <div class="invoice-total-inner">
                                                        <!-- Payments -->
                                                        <div class="d-flex justify-content-between">
                                                            <label>Cash Received</label>
                                                            <input type="number" id="cashReceived"
                                                                class="form-control w-50"
                                                                value="{{ $invoice->cash_received ?? 0 }}">
                                                        </div>

                                                        <div class="d-flex justify-content-between">
                                                            <label>Bank Received</label>
                                                            <input type="number" id="bankReceived"
                                                                class="form-control w-50"
                                                                value="{{ $invoice->bank_received ?? 0 }}">
                                                        </div>

                                                        <div class="d-flex justify-content-between">
                                                            <label>Online Received</label>
                                                            <input type="number" id="onlineReceived"
                                                                class="form-control w-50"
                                                                value="{{ $invoice->online_received ?? 0 }}">
                                                        </div>

                                                        <div class="d-flex justify-content-between">
                                                            <label>Card Received</label>
                                                            <input type="number" id="cardReceived"
                                                                class="form-control w-50"
                                                                value="{{ $invoice->card_received ?? 0 }}">
                                                        </div>

                                                    </div>
                                                    <hr>

                                                    <!-- Footer -->
                                                    <div class="invoice-total-footer">

                                                        <h5 class="text-danger">
                                                            Remaining Amount
                                                            <span id="remainingAmount">₹0.00</span>
                                                            <input type="hidden" id="remainingamountInput"
                                                                value="0">
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <button type="reset" class="btn btn-primary cancel me-2">Cancel</button>
                                <button type="reset" class="btn btn-primary cancel me-2">Save</button>
                                <button type="submit" class="btn btn-primary">Save & Continue</button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
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
                    tbody.append(`<tr><td colspan="12" class="text-center">No Packets</td></tr>`);
                    return;
                }

                packets.forEach((p, index) => {
                    tbody.append(`
        <tr>
            <td>
                <input type="text" class="form-control"
                    name="packets[${index}][packet_no]"
                    value="${p.packet_no ?? ''}"
                    style="pointer-events: none; background-color: #e9ecef;">
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
                <input type="text" class="form-control"
                    name="packets[${index}][stone]"
                    value="${p.stone ?? ''}">
            </td>

            <td>
                <input type="text" class="form-control"
                    name="packets[${index}][clarity]"
                    value="${p.clarity ?? ''}">
            </td>

            <td>
                <input type="text" class="form-control"
                    name="packets[${index}][color]"
                    value="${p.color ?? ''}">
            </td>

            <td>
                <input type="text" class="form-control"
                    name="packets[${index}][cut]"
                    value="${p.cut ?? ''}">
            </td>

            <td>
                <input type="text" class="form-control"
                    name="packets[${index}][shape]"
                    value="${p.shape ?? ''}">
            </td>

            <td>
                <input type="text" class="form-control"
                    name="packets[${index}][chalni]"
                    value="${p.chalni ?? ''}">
            </td>

            <td>
                <input type="text" class="form-control"
                    name="packets[${index}][mm]"
                    value="${p.mm ?? ''}">
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
            // Hijack Save buttons
            document.querySelector('button[type="submit"]').addEventListener('click', function(e) {
                e.preventDefault();
                finalizeInvoice();
            });
            // Also handle "Save" button if it exists separately
            document.querySelectorAll('.cancel.me-2').forEach(btn => {
                if (btn.textContent.trim() === 'Save') {
                    btn.addEventListener('click', function(e) {
                        e.preventDefault();
                        finalizeInvoice();
                    });
                }
            });
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

            if (isEmpty(dueDate)) {
                return showError('Due date is required');
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
            $('#productSearch').val('').trigger('change.select2'); // Reset product search dropdown

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
        // FETCH INVOICE DATA (Edit Mode)
        // ---------------------------------------------------------
        $(document).ready(function() {
            // Initialize global state from Laravel data
            globalInvoiceId = "{{ $invoice->id }}";
            globalInvoiceItems = @json($invoice->items);

            // Pre-select Customer
            var customerId = "{{ $invoice->user_id }}";
            if (customerId) {
                $('#customerDropdown').val(customerId).trigger('change');
            }

            // Render existing items and calculate totals
            if (globalInvoiceItems && globalInvoiceItems.length > 0) {
                renderItemsTable(globalInvoiceItems);
                calculateInvoiceTotals();
            }

            // Ensure button text is correct
            const saveBtn = document.querySelector('button[type="submit"]');
            if (saveBtn) saveBtn.textContent = "Update Invoice";
        });

        $('#customerDropdown').on('change', function() {
            // In Edit Mode, we don't automatically load "Pending" invoices
            // to avoid overwriting the current invoice data with another pending one.
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

                let packetTotal = 0;
                if (Array.isArray(item.packets)) {
                    item.packets.forEach(p => {
                        packetTotal += parseFloat(p.amount || 0);
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
                        <td>${item.making_final_amount || 0}</td>
                        <td>₹${diamondTotal.toFixed(2)}</td>
                <td>₹${stoneTotal.toFixed(2)}</td>
                  <td>₹${packetTotal.toFixed(2)}</td>
                         <td>₹${parseFloat(item.final_price || 0).toFixed(2)}</td>
                        <td>
                            <button type="button" class="btn btn-warning btn-sm" onclick="editItem(${item.id})">Edit</button>
                            <button type="button" class="btn btn-danger btn-sm removeItem" data-id="${item.id}">X</button>
                        </td>
                    </tr>
                `;
                tbody.append(tr);
            });
        }

        // ---------------------------------------------------------
        // FINALIZE INVOICE
        // ---------------------------------------------------------
        function finalizeInvoice() {
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

                discount_percent: document.getElementById('discountPercent').value || 0,
                cgst_percent: document.getElementById('cgstPercent').value || 0,
                sgst_percent: document.getElementById('sgstPercent').value || 0,
                igst_percent: document.getElementById('igstPercent').value || 0,

                // New Discount Fields
                total_making_charge: document.getElementById('totalMakingAmountInput').value || 0,
                making_discount_percent: document.getElementById('makingDiscountPercent').value || 0,
                making_discount_amount: document.getElementById('makingDiscountAmount').innerText.replace('₹', '').replace(',', ''),
                total_diamond_stone_packet: document.getElementById('totalDiamondStonePacketAmountInput').value || 0,
                diamond_discount_percent: document.getElementById('diamondDiscountPercent').value || 0,
                diamond_discount_amount: document.getElementById('diamondDiscountAmount').innerText.replace('₹', '').replace(',', ''),
                diamond_total_amount: (parseFloat(document.getElementById('totalDiamondStonePacketAmountInput').value || 0) - parseFloat(document.getElementById('diamondDiscountAmount').innerText.replace('₹', '').replace(',', '') || 0)).toFixed(2),

                cash_received: document.getElementById('cashReceived').value || 0,
                bank_received: document.getElementById('bankReceived').value || 0,
                online_received: document.getElementById('onlineReceived').value || 0,
                card_received: document.getElementById('cardReceived').value || 0,
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
                        alert('Invoice Saved Successfully!');
                        window.location.href = res.redirect_url;
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

        function renderPackets(packets) {
            const tbody = $('#packetTable tbody');
            tbody.empty();

            if (!Array.isArray(packets) || packets.length === 0) {
                tbody.append(`<tr><td colspan="14" class="text-center">No Packets</td></tr>`);
                return;
            }

            packets.forEach((p, index) => {
                tbody.append(`
            <tr data-index="${index}">
                <td><input type="text" class="form-control" name="packets[${index}][packet_no]" value="${p.packet_no ?? ''}"></td>
                <td><input type="number" class="form-control" name="packets[${index}][pcs]" value="${p.pcs ?? 0}"></td>
                <td><input type="text" class="form-control" name="packets[${index}][certificate_no]" value="${p.certificate_no ?? 0}"></td>
                <td><input type="text" class="form-control" name="packets[${index}][stone]" value="${p.stone ?? ''}"></td>
                <td><input type="text" class="form-control" name="packets[${index}][clarity]" value="${p.clarity ?? ''}"></td>
                <td><input type="text" class="form-control" name="packets[${index}][color]" value="${p.color ?? ''}"></td>
                <td><input type="text" class="form-control" name="packets[${index}][cut]" value="${p.cut ?? ''}"></td>
                <td><input type="text" class="form-control" name="packets[${index}][shape]" value="${p.shape ?? ''}"></td>
                <td><input type="text" class="form-control" name="packets[${index}][chalni]" value="${p.chalni ?? ''}"></td>
                <td><input type="text" class="form-control" name="packets[${index}][mm]" value="${p.mm ?? ''}"></td>
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
                    pcs: row.querySelector('[name*="[pcs]"]')?.value,
                    certificate_no: row.querySelector('[name*="[certificate_no]"]')?.value,
                    stone: row.querySelector('[name*="[stone]"]')?.value,
                    clarity: row.querySelector('[name*="[clarity]"]')?.value,
                    color: row.querySelector('[name*="[color]"]')?.value,
                    cut: row.querySelector('[name*="[cut]"]')?.value,
                    shape: row.querySelector('[name*="[shape]"]')?.value,
                    chalni: row.querySelector('[name*="[chalni]"]')?.value,
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
        $(document).on('click', '#addExchangeItem', function() {
            const tr = `
                <tr class="exchange-row">
                    <td><input type="text" name="exchange_description[]" class="form-control" placeholder="Description"></td>
                    <td>
                        <select name="exchange_metal[]" class="form-control">
                            <option value="Gold">Gold</option>
                            <option value="Silver">Silver</option>
                        </select>
                    </td>
                    <td><input type="number" step="0.01" name="exchange_purity[]" class="form-control exchange-purity" placeholder="Purity"></td>
                    <td><input type="number" step="0.001" name="exchange_gross[]" class="form-control exchange-gross" placeholder="Gross"></td>
                    <td><input type="number" step="0.001" name="exchange_less[]" class="form-control exchange-less" placeholder="Less"></td>
                    <td><input type="number" step="0.001" name="exchange_net[]" class="form-control exchange-net" readonly style="background-color: #e9ecef;"></td>
                    <td><input type="number" step="0.001" name="exchange_fine[]" class="form-control exchange-fine" readonly style="background-color: #e9ecef;"></td>
                    <td><input type="number" step="0.01" name="exchange_wanted_amt[]" class="form-control exchange-wanted-amt" placeholder="Wanted"></td>
                    <td><input type="number" step="0.01" name="exchange_rate[]" class="form-control exchange-rate" placeholder="Rate"></td>
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

        $(document).on('input', '.exchange-row input', function() {
            const row = $(this).closest('.exchange-row');
            const purity = parseFloat(row.find('.exchange-purity').val()) || 0;
            const gross = parseFloat(row.find('.exchange-gross').val()) || 0;
            const less = parseFloat(row.find('.exchange-less').val()) || 0;
            const net = gross - less;
            row.find('.exchange-net').val(net.toFixed(3));

            const fine = (net * purity) / 100;
            row.find('.exchange-fine').val(fine.toFixed(3));

            const wanted = parseFloat(row.find('.exchange-wanted-amt').val()) || 0;
            const rate = parseFloat(row.find('.exchange-rate').val()) || 0;
            const amount = fine * (rate / 10) + wanted;
            row.find('.exchange-amount').val(amount.toFixed(2));

            calculateInvoiceTotals();
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
                'diamondDiscountPercent',
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
    let totalMaking = 0;
    let totalDiaStonePkt = 0;

    globalInvoiceItems.forEach(item => {

        let goldenPrice = parseFloat(item.total_amount) || 0;

        totalGold += goldenPrice;
        totalMaking += parseFloat(item.making_final_amount) || 0;

        if (Array.isArray(item.diamonds)) {
            item.diamonds.forEach(d => {
                totalDiaStonePkt += parseFloat(d.diamond_final_price || 0);
            });
        }

        if (Array.isArray(item.stones)) {
            item.stones.forEach(s => {
                totalDiaStonePkt += parseFloat(s.stone_final_price || 0);
            });
        }

        if (Array.isArray(item.packets)) {
            item.packets.forEach(p => {
                totalDiaStonePkt += parseFloat(p.amount || 0);
            });
        }
    });

    // -------------------------
    // 1️⃣ Discounts (Only Calculate, Don't Affect Taxable)
    // -------------------------
    const makingDiscountPercent = parseFloat(document.getElementById('makingDiscountPercent')?.value) || 0;
    const makingDiscountAmount = (totalMaking * makingDiscountPercent) / 100;

    const diamondDiscountPercent = parseFloat(document.getElementById('diamondDiscountPercent')?.value) || 0;
    const diamondDiscountAmount = (totalDiaStonePkt * diamondDiscountPercent) / 100;

    setBoxText('totalMakingAmount', totalMaking);
    document.getElementById('totalMakingAmountInput').value = totalMaking.toFixed(2);
    setBoxText('makingDiscountAmount', makingDiscountAmount);

    setBoxText('totalDiamondStonePacketAmount', totalDiaStonePkt);
    document.getElementById('totalDiamondStonePacketAmountInput').value = totalDiaStonePkt.toFixed(2);
    setBoxText('diamondDiscountAmount', diamondDiscountAmount);

    // -------------------------
    // 2️⃣ FIXED TAXABLE AMOUNT (NO DISCOUNT MINUS)
    // -------------------------
    const taxableAmount = totalGold  + totalDiaStonePkt;

    setBoxText('taxableAmount', taxableAmount);
    document.getElementById('taxableAmountInput').value = taxableAmount.toFixed(2);

    // -------------------------
    // 3️⃣ Final Discount (Same Logic As Before)
    // -------------------------
    const finalDiscountPercent = parseFloat(document.getElementById('discountPercent')?.value) || 0;
    const finalDiscountAmount = (taxableAmount * finalDiscountPercent) / 100;
    const amountAfterFinalDiscount = taxableAmount - finalDiscountAmount-diamondDiscountAmount-makingDiscountAmount;

    setBoxText('discountAmount', finalDiscountAmount);

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

    // -------------------------
    // 6️⃣ Payment + Remaining
    // -------------------------
    const cash = parseFloat(document.getElementById('cashReceived')?.value) || 0;
    const bank = parseFloat(document.getElementById('bankReceived')?.value) || 0;
    const online = parseFloat(document.getElementById('onlineReceived')?.value) || 0;
    const card = parseFloat(document.getElementById('cardReceived')?.value) || 0;

    const totalPaid = cash + bank + online + card;

    let remaining = totalInvoiceAmount - totalPaid;
    if (remaining < 0) remaining = 0;

    setBoxText('remainingAmount', remaining);
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
@endsection
