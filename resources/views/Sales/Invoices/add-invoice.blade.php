<?php $page = 'add-invoice'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <!-- Select2 CSS -->

    <script src="{{ url('/public/assets/js/sellcalculation.js') }}"></script>
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
                            <h5>Add Invoice</h5>
                        </div>
                    </div>

                    <form action="{{ route('invoices.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group-item border-0 mb-0">
                                    <div class="row align-items-center">
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <label>Invoice Number</label>
                                                <input type="text" class="form-control"
                                                    placeholder="Enter Invoice Number" name="invoice_no">
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
                                                        placeholder="Select Date" name="invoice_date">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <label>Due Date</label>
                                                <div class="cal-icon cal-icon-info">
                                                    <input type="text" name='due_date'
                                                        class="datetimepicker form-control" placeholder="Select Date">
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
                                                <option value="{{ $product->id }}" data-name="{{ $product->product_name }}"
                                                    data-barcode="{{ $product->barcode }}" {{-- data-rate="{{ $product->metal_rate }}" --}}
                                                    data-hsn="{{ $product->hsn_code }}"
                                                    data-gross_weight="{{ $product->gross_weight }}"
                                                    data-net_weight="{{ $product->net_weight }}"
                                                    data-size="{{ $product->size }}"
                                                    data-wastage_percent="{{ $product->wastage_percent }}"
                                                    data-making_price="{{ $product->making_price }}" {{-- CATEGORY --}}
                                                    data-category-id="{{ $product->category_id }}"
                                                    data-category-name="{{ optional($product->category)->category_name }}"
                                                    {{-- SUBCATEGORY --}}
                                                    data-subcategory-id="{{ $product->subcategory_id }}"
                                                    data-subcategory-name="{{ optional($product->subcategory)->subcategory_name }}"
                                                    data-gst_percent="{{ $product->gst_percent }}"
                                                    data-gst_amount="{{ $product->gst_amount }}"
                                                    data-metal_rate="{{ optional($product->metalRate)->price_per_gram }}"
                                                    data-gold_price="{{ $product->gold_price }}"
                                                    data-pre_code="{{ $product->pre_code }}"
                                                    data-post_code="{{ $product->post_code }}"
                                                    data-final_price="{{ $product->final_price }}" {{-- ✅ ADD THESE --}}
                                                    data-diamonds='@json($product->diamonds)'
                                                    data-stones='@json($product->stones)'>

                                                    {{ $product->pre_code }}-{{ $product->post_code }}-
                                                    {{ $product->product_name }}
                                                </option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>




                                <table class="table table-bordered" id="entryTable">
                                    <thead>
                                        <tr>
                                            <th>Category</th>
                                            <th>Sub Category</th>
                                            <th>Product Name</th>
                                            <th>Pre Code</th>
                                            <th>Post Code</th>
                                            <th>Barcode</th>
                                            <th>HSN Code</th>
                                            <th>Metal Rate</th>
                                            <th>Qty</th>
                                            <th>GS Wt</th>
                                            <th>Net Wt</th>
                                            <th>Size</th>
                                            <th>Wastage %</th>
                                            <th>Making Amount</th>
                                            <th>GST %</th>
                                            <th>GST Amount</th>
                                            <th>Gold Price</th>
                                            <th>Final price</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
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
                                            <td><input type="text" name="barcode[]"
                                                    class="form-control"style="pointer-events: none; background-color: #e9ecef;">
                                            </td>
                                            <td><input type="text" name="hsn_code[]" class="form-control"
                                                    style="pointer-events: none; background-color: #e9ecef;"></td>
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
                                            <td><input type="text" name="size[]" class="form-control"
                                                    style="pointer-events: none; background-color: #e9ecef;"></td>
                                            <td><input type="number" step="0.01" name="wastage_percent[]"
                                                    class="form-control"
                                                    style="pointer-events: none; background-color: #e9ecef;"></td>
                                            <td><input type="number" step="0.01" name="making_price[]"
                                                    class="form-control"></td>
                                            <td><input type="number" step="0.01" name="gst_percent[]"
                                                    class="form-control"
                                                    style="pointer-events: none; background-color: #e9ecef;"></td>
                                            <td><input type="number" step="0.01" name="gst_amount[]"
                                                    class="form-control"
                                                    style="pointer-events: none; background-color: #e9ecef;"></td>
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



                                <button type="button" id="addItemBtn" class="btn btn-success mt-2">
                                    + Add Item
                                </button>
                                <h5 class="mt-4">Added Items</h5>

                                <table class="table table-bordered" id="itemsTable">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Code</th>
                                            <th>Barcode</th>
                                            <th>Net Wt</th>
                                            <th>Metal Rate</th>
                                            <th>Making</th>
                                            <th>GST</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
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
                                                <div class="row align-items-center">
                                                    <div class="col-md-8">
                                                        <div class="input-block mb-3">
                                                            <label>Select Bank</label>

                                                            <select class="select">
                                                                <option value="">Select Bank</option>
                                                                @foreach ($banks as $bank)
                                                                    <option value="{{ $bank->bankname }}">
                                                                        {{ $bank->bankname }}
                                                                    </option>
                                                                @endforeach
                                                            </select>


                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-groups">
                                                            <a class="btn btn-primary" href="#"
                                                                data-bs-toggle="modal" data-bs-target="#bank_details">Add
                                                                Bank</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Terms and conditions section-->
                                                <div class="input-block mb-3">
                                                    <div id="termsDiv" style="display: none;">
                                                        <h4>Terms & Conditions</h4>

                                                        <!-- Terms List -->
                                                        <div id="termsList"></div>

                                                        <!-- Add Term Button -->
                                                        <button id="addTermBtn">Add Term</button>
                                                        <!-- Close Div Button -->
                                                        <button id="closeTermsBtn">Close</button>
                                                    </div>
                                                </div>
                                                <!-- Attachments section-->

                                                <div id="attachmentSection" style="display: none;margin-top: 10px">
                                                    <h4>Attachments</h4>
                                                    <p class="helper-text">
                                                        Attachments will not appear as separate documents; instead, they
                                                        will be available as clickable links within the proforma invoice.
                                                    </p>
                                                    <p class="helper-text">The maximum file size is 10 MB.</p>

                                                    <!-- Wrapper div to hold file inputs -->
                                                    <div id="fileInputs">
                                                        <div class="file-input-row">
                                                            <input type="file" name="attachments[]">
                                                            <button type="button" id="addMoreBtn">+</button>
                                                            <span class="error-msg"
                                                                style="color:red;font-size:12px;"></span>

                                                        </div>


                                                        <br>

                                                    </div>

                                                    <br><br>
                                                    <button id="closeBtn">Close</button>
                                                </div>

                                                <!-- Contact Details Section -->
                                                <div id="contactSection" style="display: none;">
                                                    <h4>Your Contact Details</h4>
                                                    <p>For any enquiry, reach out via:</p>

                                                    <div class="input-group">
                                                        <label for="contactEmail">Email (optional)</label>
                                                        <input type="email" name="email" id="contactEmail"
                                                            placeholder="your@email.com">
                                                        <span id="emailError" class="error-msg"></span>
                                                    </div>

                                                    <div class="input-group">
                                                        <label for="contactPhone">Phone Number</label>
                                                        <input type="tel" name="phone" id="contactPhone">
                                                        <span id="phoneError" class="error-msg"></span>
                                                    </div>


                                                    <button id="closeContactBtn" type="button">Close</button>
                                                </div>
                                                <br><br>
                                                <!-- Notes section-->

                                                <!-- Summernote Editor -->
                                                <div class="input-block mb-3">

                                                    <div id="noteEditor" style="display: none;">
                                                        <h4>Additional Notes</h4>
                                                        <textarea id="summernote" name="notes"></textarea>
                                                        <button id="closeNoteBtn">Close</button>
                                                    </div>
                                                </div>

                                                <!-- Add Info Section -->
                                                <div id="infoSection" class="info-section" style="display: none;">
                                                    <h4>Additional Info</h4>
                                                    <div id="fieldsContainer">
                                                        <!-- Key-Value Field Template -->
                                                        <div class="key-value-row">
                                                            <input type="text" name="info_key[]"
                                                                placeholder="Field Name">
                                                            <input type="text" name="info_value[]"
                                                                placeholder="Value">
                                                            <button class="removeFieldBtn">Remove</button>
                                                        </div>
                                                    </div>

                                                    <!-- Buttons -->
                                                    <button id="addMoreInfo">Add More Fields</button>
                                                    <button id="closeSectionBtn">Close</button>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-xl-6 col-lg-12">
                                            <div class="form-group-bank">
                                                <input type="hidden" id="businessState" value="{{ $business->state }}">
                                                <input type="hidden" id="customerState" value="">

                                                <div class="invoice-total-box">
                                                    <div class="invoice-total-inner">
                                                        <p>Taxable Amount <span id="taxableAmount">₹0.00</span></p>

                                                        <p>CGST <span id="cgstAmount">₹0.00</span></p>
                                                        <p>SGST <span id="sgstAmount">₹0.00</span></p>
                                                        <p>IGST <span id="igstAmount">₹0.00</span></p>

                                                        <div class="status-toggle justify-content-between">
                                                            <div class="d-flex align-center">
                                                                <p>Round Off</p>
                                                                <input id="roundOffToggle" class="check"
                                                                    type="checkbox">
                                                                <label for="roundOffToggle"
                                                                    class="checktoggle checkbox-bg">checkbox</label>
                                                            </div>
                                                            <span id="roundOffAmount">₹0.00</span>
                                                        </div>
                                                    </div>
                                                    <div class="invoice-total-footer">
                                                        <h4>Total Amount <span id="totalInvoiceAmount">₹0.00</span></h4>
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <label class="btn btn-link">Give Item wise Discount:</label>
                                                    <select id="discountType" class="discount-type">
                                                        <option value="none">None</option>
                                                        <option value="fixed">Fixed</option>
                                                        <option value="percent">Percent</option>
                                                    </select>
                                                    <input type="number" id="discountValue"
                                                        placeholder="e.g. 100 or 10%">
                                                    <select id="distributionType" style="display:none;">
                                                        <option value="equal">Equal</option>
                                                        <option value="weighted">Weighted</option>
                                                    </select>
                                                </div>
                                                <button id="addTotalDiscountBtn" class="btn btn-link">Give Discount on
                                                    Total</button>
                                                <div id="totalDiscountContainer1" class="mt-2"></div>
                                                <div class="input-block mb-3">
                                                    <label>Signature Name</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter Signature Name">
                                                </div>
                                                <!-- <pre>{{ json_encode($allColumns, JSON_PRETTY_PRINT) }}</pre> -->
                                                <div class="input-block mb-0">
                                                    <label>Signature Image</label>
                                                    <div class="input-block mb-3 service-upload service-upload-info mb-0">
                                                        <span><i class="fe fe-upload-cloud me-1"></i>Upload
                                                            Signature</span>
                                                        <input type="file" multiple="" id="image_sign">
                                                        <div id="frames"></div>
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
                            <tbody>
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
                            </tbody>
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
        // const invoiceColumns = @json($allColumns);
        // console.log("invoiceColumns:", invoiceColumns);
        // const productOptions = <?= json_encode($products) ?>;

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
                if (!option.val()) return;

                // Existing product fill (keep this)
                let row = $('#entryTable tbody tr').first();

                // BASIC DATA
                row.find('input[name="pre_code[]"]').val(option.data('pre_code'));
                row.find('input[name="post_code[]"]').val(option.data('post_code'));
                row.find('input[name="product_name[]"]').val(option.data('name'));
                row.find('input[name="barcode[]"]').val(option.data('barcode'));
                row.find('input[name="hsn_code[]"]').val(option.data('hsn'));
                row.find('input[name="metal_rate[]"]').val(option.data('metal_rate'));
                row.find('input[name="gross_weight[]"]').val(option.data('gross_weight'));
                row.find('input[name="net_weight[]"]').val(option.data('net_weight'));
                row.find('input[name="size[]"]').val(option.data('size'));
                row.find('input[name="wastage_percent[]"]').val(option.data('wastage_percent'));
                row.find('input[name="making_price[]"]').val(option.data('making_price'));
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

                renderDiamonds(diamonds);
                renderStones(stones);
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


        });
    </script>
    <script>
        document.getElementById('addItemBtn').addEventListener('click', function(e) {
            e.preventDefault(); //VERY IMPORTANT

            console.log('Add Item clicked');

            let entryRow = document.querySelector('#entryTable tbody tr');

            let payload = {
                _token: '{{ csrf_token() }}',

                invoice_no: document.querySelector('input[name="invoice_no"]').value,
                customer_id: document.querySelector('#customerDropdown').value,
                invoice_date: document.querySelector('input[name="invoice_date"]').value,
                due_date: document.querySelector('input[name="due_date"]').value,

                product_name: entryRow.querySelector('input[name="product_name[]"]').value,
                pre_code: entryRow.querySelector('input[name="pre_code[]"]').value,
                post_code: entryRow.querySelector('input[name="post_code[]"]').value,
                barcode: entryRow.querySelector('input[name="barcode[]"]').value,
                net_weight: entryRow.querySelector('input[name="net_weight[]"]').value,
                metal_rate: entryRow.querySelector('input[name="metal_rate[]"]').value,
                making_price: entryRow.querySelector('input[name="making_price[]"]').value,
                gst_amount: entryRow.querySelector('input[name="gst_amount[]"]').value,
                total_amount: entryRow.querySelector('input[name="total_amount[]"]').value,
                final_price: entryRow.querySelector('input[name="final_price[]"]').value,
                diamonds: collectDiamonds(),
                stones: collectStones(),
            };

            fetch('{{ route('sell.invoice.addItem') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(payload)
                })
                .then(res => res.json())
                .then(res => {
                    console.log(res);
                    alert('Item stored successfully');
                })
                .catch(err => {
                    console.error(err);
                    alert('Error saving item');
                });
        });
    </script>
    <script>
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
    </script>
    <script>
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
    </script>
    <script>
        document.getElementById('addItemBtn').addEventListener('click', function() {

            let entryRow = document.querySelector('#entryTable tbody tr');
            let inputs = entryRow.querySelectorAll('input');

            // Validation (minimum)
            if (!inputs[2].value) {
                alert('Please select a product');
                return;
            }

            let tableBody = document.querySelector('#itemsTable tbody');
            let tr = document.createElement('tr');

            tr.innerHTML = `
        <td>
            ${inputs[2].value}
            <input type="hidden" name="product_name[]" value="${inputs[2].value}">
        </td>
        <td>
            ${inputs[3].value}-${inputs[4].value}
            <input type="hidden" name="pre_code[]" value="${inputs[3].value}">
            <input type="hidden" name="post_code[]" value="${inputs[4].value}">
        </td>
        <td>
            ${inputs[5].value}
            <input type="hidden" name="barcode[]" value="${inputs[5].value}">
        </td>
        <td>
            ${inputs[10].value}
            <input type="hidden" name="net_weight[]" value="${inputs[10].value}">
        </td>
        <td>
            ${inputs[7].value}
            <input type="hidden" name="metal_rate[]" value="${inputs[7].value}">
        </td>
        <td>
            ${inputs[13].value}
            <input type="hidden" name="making_price[]" value="${inputs[13].value}">
        </td>
        <td>
            ${inputs[15].value}
            <input type="hidden" name="gst_amount[]" value="${inputs[15].value}">
        </td>
        <td>
            ${inputs[16].value}
            <input type="hidden" name="total_amount[]" value="${inputs[16].value}">
        </td>
        <td>
            <button type="button" class="btn btn-danger btn-sm removeItem">X</button>
        </td>
    `;

            tableBody.appendChild(tr);

            // CLEAR ENTRY ROW FOR NEXT ITEM
            inputs.forEach(input => {
                if (!input.hasAttribute('readonly')) {
                    input.value = '';
                }
            });
            document.querySelector('#diamondTable tbody').innerHTML = '';
            document.querySelector('#stoneTable tbody').innerHTML = '';

        });
    </script>
    <script>
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('removeItem')) {
                e.target.closest('tr').remove();
            }
        });
    </script>
@endsection
