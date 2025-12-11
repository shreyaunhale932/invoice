<?php $page = 'add-invoice'; ?>
@extends('layout.mainlayout')
@section('content')
<!-- Page Wrapper -->
<!-- Select2 CSS -->


<!-- Summernote CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/css/intlTelInput.css" />
<!-- Intl-Tel-Input CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">

<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="card mb-0">
            <div class="card-body">
                <div class="page-header">
                    <div class="content-page-header">
                        <h5>Add Invoice1</h5>
                    </div>
                </div>
                <form action="{{ route('invoices.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group-item border-0 mb-0">
                                <div class="row align-item-center">
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="input-block mb-3">
                                            <label>Invoice Number</label>
                                            <input type="text" class="form-control" placeholder="Enter Invoice Number">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="input-block mb-3">
                                            <label>Customer Name</label>
                                            <ul class="form-group-plus css-equal-heights">
                                                <li>
                                                    <select class="select" name="customer_id" id="customerDropdown" required>
                                                        <option value="">Choose Customer</option>
                                                        @foreach($customers as $customer)
                                                        <option value="{{ $customer->id }}" data-state="{{ $customer->state }}">{{ $customer->name }}</option>
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
                                                <input type="text" name='due_date' class="datetimepicker form-control"
                                                    placeholder="Select Date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
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
                                    </div>
                                    <div id="custom-fields-container">
                                        @foreach ($customFields as $field)
                                        <label>{{ $field->field_label }}</label>
                                        <input type="text" name="custom_fields_existing[{{ $field->id }}]" />
                                        @endforeach


                                    </div>
                                    <div id="custom-fields-container">
                                        <div class="custom-field">
                                            <input type="text" name="custom_fields_new[0][label]" placeholder="Field Label" />
                                            <input type="text" name="custom_fields_new[0][value]" placeholder="Field Value" />
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-outline-primary" type="button" id="add-custom-field">Add Custom Field</button>
                            </div>

                            <button type="button" id="addItemBtn" class="btn btn-outline-primary">+ Add Item</button>
                            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#gstConfigModal">
                                Configure GST
                            </button>
                            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editColumnsModal">
                                Customize Columns
                            </button>

                            <select id="productMaster" class="d-none">
                                @foreach($products as $product)
                                <option
                                    value="{{ $product->product_name }}"
                                    data-rate="{{ $product->rate }}"
                                    data-hsn="{{ $product->hsn }}">
                                    {{ $product->product_name }}
                                </option>
                                @endforeach
                            </select>

                            <table id="invoiceTable" class="table">
                                <thead>
                                    <tr>
                                        <!-- No hardcoded extra <th> here -->
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>




                            <!-- <h4 class="mt-3">Grand Total: ₹<span id="grandTotal">0.00</span></h4> -->
                            <button class="btn btn-outline-secondary" id="showTermsBtn">+ Add Terms & Conditions</button>

                            <button class="btn btn-outline-danger" id="addNoteBtn">+ Add Note</button>

                            <button class="btn btn-outline-success" id="addDocBtn">+ Add Attachments</button>

                            <button class="btn btn-outline-secondary" id="addContactBtn">+ Add Contact</button>

                            <button class="btn btn-outline-primary" id="addInfoBtn">+ Add Additional Info</button>
                            <div class="form-group-item border-0 p-0">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-12">
                                        <div class="form-group-bank">
                                            <div class="row align-items-center">
                                                <div class="col-md-8">
                                                    <div class="input-block mb-3">
                                                        <label>Select Bank</label>

                                                        <select class="select form-control">
                                                            <option value="">Select Bank</option>
                                                            @foreach($banks as $bank)
                                                            <option value="{{ $bank->bankname }}">
                                                                {{ $bank->bankname }}
                                                            </option>
                                                            @endforeach
                                                        </select>


                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-groups">
                                                        <a class="btn btn-primary" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#bank_details">Add Bank</a>
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
                                                    Attachments will not appear as separate documents; instead, they will be available as clickable links within the proforma invoice.
                                                </p>
                                                <p class="helper-text">The maximum file size is 10 MB.</p>

                                                <!-- Wrapper div to hold file inputs -->
                                                <div id="fileInputs">
                                                    <div class="file-input-row">
                                                        <input type="file" name="attachments[]">
                                                        <button type="button" id="addMoreBtn">+</button>
                                                        <span class="error-msg" style="color:red;font-size:12px;"></span>

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
                                                    <input type="email" name="email" id="contactEmail" placeholder="your@email.com">
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
                                                        <input type="text" name="info_key[]" placeholder="Field Name">
                                                        <input type="text" name="info_value[]" placeholder="Value">
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
                                                            <input id="roundOffToggle" class="check" type="checkbox">
                                                            <label for="roundOffToggle" class="checktoggle checkbox-bg">checkbox</label>
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
                                                <input type="number" id="discountValue" placeholder="e.g. 100 or 10%">
                                                <select id="distributionType" style="display:none;">
                                                    <option value="equal">Equal</option>
                                                    <option value="weighted">Weighted</option>
                                                </select>
                                            </div>
                                            <button id="addTotalDiscountBtn" class="btn btn-link">Give Discount on Total</button>
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
                                                    <span><i class="fe fe-upload-cloud me-1"></i>Upload Signature</span>
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
                            @foreach($visibleColumns as $column)
                            <tr data-id="{{ $column['key'] }}" data-is-custom="{{ $column['is_custom'] }}">

                                <td>

                                    <input type="hidden" name="columns[{{ $column['key'] }}][key]" value="{{ $column['key'] }}">
                                    <input type="hidden" name="columns[{{ $column['key'] }}][type]" value="{{ $column['type'] }}">
                                    <input type="text" name="columns[{{ $column['key'] }}][name]" value="{{ $column['name'] }}">

                                </td>

                                <td>
                                    @if($column['is_custom'])
                                    <select class="form-select column-type-select" name="columns[{{ $column['key'] }}][type]">
                                        <option value="text" {{ $column['type'] == 'text' ? 'selected' : '' }}>Text</option>
                                        <option value="number" {{ $column['type'] == 'number' ? 'selected' : '' }}>Number</option>
                                        <!-- <option value="formula" {{ $column['type'] == 'formula' ? 'selected' : '' }}>Formula</option> -->
                                    </select>
                                    @else
                                    <input type="hidden" name="columns[{{ $column['key'] }}][type]" value="{{ $column['type'] }}">
                                    <span class="text-muted">{{ ucfirst($column['type']) }}</span>
                                    @endif
                                </td>
                                <td class="formula-field-td" style="{{ $column['type'] === 'formula' ? '' : 'display:none;' }}">
                                    <input
                                        type="text"
                                        class="form-control formula-input"
                                        name="columns[{{ $column['key'] }}][formula]"
                                        placeholder="e.g., qty * rate - discount"
                                        value="{{ $column['formula'] ?? '' }}">
                                </td>
                                <td class="text-center">

                                    <input type="checkbox" name="columns[{{ $column['key'] }}][is_visible]"
                                        {{ $column['is_visible'] ? 'checked' : '' }}>

                                </td>


                                <td class="text-center">
                                    @if($column['is_custom'])
                                    <button type="button" class="btn btn-danger btn-sm remove-column">Delete</button>
                                    @else
                                    <span class="badge bg-secondary">System</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <button type="button" class="btn btn-success btn-sm mt-2" id="add-column-btn">+ Add Column</button>
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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css">



<script>
    // const invoiceColumns = @json($allColumns);
    // console.log("invoiceColumns:", invoiceColumns);
    // const productOptions = <?= json_encode($products); ?>;

    const productOptions = @json($products);
</script>

<script>
    let invoiceColumns = [];
    let invoiceTable;
    $(document).ready(function() {

        fetchColumns(); // initial load
        // initInvoiceTable();
        function fetchColumns() {
            $.ajax({
                url: '{{ route("invoice-columns.index") }}',
                type: 'GET',
                success: function(response) {
                    invoiceColumns = response.columns;
                    initInvoiceTable();
                }
            });
        }

        function initInvoiceTable() {
            // alert('called init');
            if ($.fn.DataTable.isDataTable('#invoiceTable')) {
                $('#invoiceTable').DataTable().destroy();
                $('#invoiceTable').empty();
            }

            const columnDefs = invoiceColumns.map(col => ({
                title: col.name,
                data: null,
                orderable: false,
                render: function(data, type, row, meta) {
                    return row[meta.col];
                }
            }));

            // Add action column
            columnDefs.push({
                title: 'Action',
                data: null,
                orderable: false,
                render: function(data, type, row, meta) {
                    return row[meta.col];
                }
            });

            invoiceTable = $('#invoiceTable').DataTable({
                paging: false,
                searching: false,
                ordering: false,
                info: false,
                data: [],
                columns: columnDefs
            });



            console.log("Invoice column count:", invoiceTable.columns().count());
        }

        /// this adds rows to invoice table
        $('#addItemBtn').on('click', function() {
            const rowIndex = invoiceTable.rows().count();

            let newRow = [];

            invoiceColumns.forEach((col) => {
                let cellContent = '';
                switch (col.key) {
                    case "item":
                        cellContent = `
                <select class="form-control item-select" name="products[${rowIndex}][name]"></select>
                <input type="hidden" name="products[${rowIndex}][name]" class="productNameInput">`;
                        break;

                    case "hsn":
                        cellContent = `<input type="text" class="form-control hsn" name="products[${rowIndex}][hsn]">`;
                        break;

                    case "quantity":
                        cellContent = `<input type="number" class="form-control qty" name="products[${rowIndex}][quantity]" value="1">`;
                        break;

                    case "rate":
                        cellContent = `<input type="number" class="form-control rate" name="products[${rowIndex}][price]">`;
                        break;

                        // case "discount":
                        //     cellContent = `<input type="number" class="form-control discount" name="products[${rowIndex}][discount]">`;
                        //     break;
                    case "discount":
                        cellContent = `
                        <div class="d-flex gap-1">
                            <input type="number" class="form-control discount" name="products[${rowIndex}][discount]" placeholder="0">
                            <select class="form-control discount-type" name="products[${rowIndex}][discount_type]">
                                <option value="percent">%</option>
                                <option value="fixed">₹</option>
                            </select>
                        </div>
                    `;
                        break;

                    case "gst":
                        cellContent = `<input type="number" class="form-control gst" name="products[${rowIndex}][gst]">`;
                        break;

                    case "amount":
                        cellContent = `<span class="amount">₹0.00</span><input type="hidden" name="products[${rowIndex}][amount]" class="amountInput" value="0">`;
                        break;

                    case "cgst":
                        cellContent = `<span class="cgst">₹0.00</span><input type="hidden" name="products[${rowIndex}][cgst]" class="cgstInput" value="0">`;
                        break;

                    case "sgst":
                        cellContent = `<span class="sgst">₹0.00</span><input type="hidden" name="products[${rowIndex}][sgst]" class="sgstInput" value="0">`;
                        break;

                    case "igst":
                        cellContent = `<span class="igst">₹0.00</span><input type="hidden" name="products[${rowIndex}][igst]" class="igstInput" value="0">`;
                        break;

                    case "total":
                        cellContent = `<span class="total">₹0.00</span><input type="hidden" name="products[${rowIndex}][total]" class="totalInput" value="0">`;
                        break;

                    default:
                        cellContent = col.type === 'number' ?
                            `<input type="number" class="form-control" name="products[${rowIndex}][${col.key}]">` :
                            `<input type="text" class="form-control" name="products[${rowIndex}][${col.key}]">`;
                        break;
                }

                newRow.push(cellContent); // Append cell to the row
            });


            newRow.push(`<a href="#" class="btn-action-icon removeRow"><i class="fe fe-trash-2"></i></a>`); // Action column
            // console.log("Table body HTML after add:", $('#invoiceTable tbody').html());

            /// console.log("New row:", newRow);
            // console.log("Expected columns:", invoiceColumns.length + 1);
            // console.log("Row cells:", newRow.length);

            invoiceTable.row.add(newRow).draw(false); // Properly add the row


            // Clone and assign options
            const $newSelect = $(".item-select").last();
            const options = $("#productMaster option").clone();
            $newSelect.empty().append(options);
            // console.log($newSelect.html());
            $newSelect.select2({
                placeholder: "Select or type a product",
                width: '100%',
                allowClear: true,
                tags: true
            });

            applyTotalDiscount();
        });

        $("#discountType").change(function() {
            const type = $(this).val();
            if (type === "fixed" || type === "percent") {
                $("#distributionType").show();
            } else {
                $("#distributionType").hide();
                $("#discountValue").val("");
            }
            applyTotalDiscount(); // optional to trigger recalculation
        });

        $("#discountValue, #distributionType").on("input change", applyTotalDiscount);

        function applyTotalDiscount() {
            const type = $("#discountType").val();
            const value = parseFloat($("#discountValue").val()) || 0;
            const distribution = $("#distributionType").val();

            const rows = $("#invoiceTable tbody tr");
            const rowCount = rows.length;

            if (type === "none" || value === 0 || rowCount === 0) return;

            let totalTaxable = 0;
            rows.each(function() {
                const qty = parseFloat($(this).find(".qty").val()) || 1;
                const rate = parseFloat($(this).find(".rate").val()) || 0;
                totalTaxable += qty * rate;
            });

            rows.each(function() {
                const $row = $(this);
                const qty = parseFloat($row.find(".qty").val()) || 1;
                const rate = parseFloat($row.find(".rate").val()) || 0;
                const baseAmount = qty * rate;

                let rowDiscount = 0;
                // alert(type);
                // alert(distribution);
                if (type === "fixed") {
                    if (distribution === "equal") {
                        rowDiscount = value / rowCount;
                        // rowDiscount = (baseAmount / totalTaxable) * value;
                    } else if (distribution === "weighted") {
                        // rowDiscount = value / rowCount;
                        rowDiscount = (baseAmount / totalTaxable) * value;
                    }
                } else if (type === "percent") {
                    rowDiscount = (baseAmount * value) / 100;
                }




                // const discountPercent = (rowDiscount / baseAmount) * 100;
                $row.find(".discount").val(rowDiscount.toFixed(2));

                updateRowAmount($row);
            });

            calculateTotal();
        }


        // When a product is selected
        $(document).on("change", ".item-select", function() {
            const row = $(this).closest("tr");
            const selectedVal = $(this).val();
            const selectedOption = $(this).find(`option[value="${selectedVal}"]`);
            // alert(selectedOption);
            const rate = parseFloat(selectedOption.data("rate")) || 0;
            const hsn = selectedOption.data("hsn_code_id") || "";
            // alert(hsn);
            row.find(".rate").val(rate);
            row.find(".hsn").val(hsn);
            row.find(".productNameInput").val(selectedVal);



            updateRowAmount(row);
            calculateTotal();
        });



        // Trigger when any of these fields change: qty, rate, gst, discount value
        $(document).on("input", ".qty, .rate, .gst, .discount", function() {
            console.log("Triggered on:", $(this).attr("class"));
            const row = $(this).closest("tr");
            updateRowAmount(row);
            applyTotalDiscount();
            calculateTotal();
            applyTotalReductions();
        });

        // Trigger when the discount type dropdown (% or ₹) is changed
        $(document).on("change", ".discount-type", function() {
            const row = $(this).closest("tr");
            updateRowAmount(row);
            applyTotalDiscount();
            calculateTotal();
            applyTotalReductions();
        });


        let selectedGstType = null; // 'cgst_sgst' or 'igst'

        $("#applyGstConfig").on("click", function() {
            selectedGstType = $("#gstTypeSelect").val();

            $("#gstConfigModal").modal("hide");

            // Recalculate tax based on selected GST type
            $("#invoiceTable tbody tr").each(function() {
                updateRowAmount($(this));
            });
            calculateTotal();
        });

        function updateRowAmount(row) {
            // alert("update row")
            const qty = parseFloat(row.find(".qty").val()) || 1;
            const rate = parseFloat(row.find(".rate").val()) || 0;
            // const discount = parseFloat(row.find(".discount").val()) || 0;
            const gst = parseFloat(row.find(".gst").val()) || 0;
            // alert(gst);
            const discount = parseFloat(row.find(".discount").val()) || 0;
            const discountType = row.find(".discount-type").val(); // add this select to your HTML

            let discountAmt = 0;
            if (discountType === 'percent') {
                discountAmt = (qty * rate * discount) / 100;
            } else {
                discountAmt = discount;
            }

            const total = qty * rate;
            // const discountAmt = (total * discount) / 100;
            const taxable = total - discountAmt;
            const gstAmt = (taxable * gst) / 100;

            const businessState = $("#businessState").val().toLowerCase();
            const customerState = $("#customerState").val().toLowerCase();
            let cgst = 0,
                sgst = 0,
                igst = 0;

            // if (businessState === customerState) {
            //     cgst = gstAmt / 2;
            //     sgst = gstAmt / 2;
            // } else {
            //     igst = gstAmt;
            // }
            // alert(selectedGstType);
            if (selectedGstType === 'cgst_sgst') {
                cgst = gstAmt / 2;
                sgst = gstAmt / 2;
                igst = 0;
            } else if (selectedGstType === 'igst') {
                igst = gstAmt;
                cgst = 0;
                sgst = 0;
            } else {
                // Default fallback to business vs customer state logic
                if (businessState === customerState) {
                    cgst = gstAmt / 2;
                    sgst = gstAmt / 2;
                } else {
                    igst = gstAmt;
                }
            }

            // alert(cgst);
            const final = taxable + gstAmt;

            row.find(".amount").text(`₹${taxable.toFixed(2)}`);
            row.find(".cgst").text(`₹${cgst.toFixed(2)}`);
            row.find(".sgst").text(`₹${sgst.toFixed(2)}`);
            row.find(".igst").text(`₹${igst.toFixed(2)}`);
            row.find(".total").text(`₹${final.toFixed(2)}`);

            row.find(".amountInput").val(taxable.toFixed(2));
            row.find(".cgstInput").val(cgst.toFixed(2));
            row.find(".sgstInput").val(sgst.toFixed(2));
            row.find(".igstInput").val(igst.toFixed(2));
            row.find(".totalInput").val(final.toFixed(2));
        }

        function calculateTotal() {
            let taxable = 0,
                gst = 0,
                cgst = 0,
                sgst = 0,
                igst = 0;

            $("#invoiceTable tbody tr").each(function() {
                const qty = parseFloat($(this).find(".qty").val()) || 1;
                const rate = parseFloat($(this).find(".rate").val()) || 0;
                const discount = parseFloat($(this).find(".discount").val()) || 0;
                const gstRate = parseFloat($(this).find(".gst").val()) || 0;

                const total = qty * rate;
                const discountAmt = (total * discount) / 100;
                const taxableAmt = total - discountAmt;
                const gstAmt = (taxableAmt * gstRate) / 100;

                const businessState = $("#businessState").val().toLowerCase();
                const customerState = $("#customerState").val().toLowerCase();

                taxable += taxableAmt;
                gst += gstAmt;


                if (selectedGstType === 'cgst_sgst') {
                    cgst += gstAmt / 2;
                    sgst += gstAmt / 2;
                } else if (selectedGstType === 'igst') {
                    igst += gstAmt;
                } else {
                    if (businessState === customerState) {
                        cgst += gstAmt / 2;
                        sgst += gstAmt / 2;
                    } else {
                        igst += gstAmt;
                    }
                }


            });

            const grandTotal = taxable + gst;

            $("#taxableAmount").text(`₹${taxable.toFixed(2)}`);
            $("#cgstAmount").text(`₹${cgst.toFixed(2)}`);
            $("#sgstAmount").text(`₹${sgst.toFixed(2)}`);
            $("#igstAmount").text(`₹${igst.toFixed(2)}`);
            // $("#totalInvoiceAmount").text(`₹${grandTotal.toFixed(2)}`);
            $("#totalInvoiceAmount")
                .text(`₹${grandTotal.toFixed(2)}`)
                .attr("data-original", grandTotal.toFixed(2));

        }

        // Remove row
        $(document).on("click", ".removeRow", function(e) {
            e.preventDefault();
            invoiceTable.row($(this).closest("tr")).remove().draw(false); // use invoiceTable
            calculateTotal();
        });


        // Customer state change
        $("#customerDropdown").change(function() {
            const state = $(this).find(":selected").data("state") || "";
            $("#customerState").val(state);
            $("#invoiceTable tbody tr").each(function() {
                updateRowAmount($(this));
            });
            calculateTotal();
            applyTotalDiscount();

        });

        let discountIndex = 0;

        $('#addTotalDiscountBtn').on('click', function() {
            const discountField = `
        <div class="reduction-field mb-2 d-flex align-items-center gap-2">
            <label>Reduction</label>
            <select name="reductions[${discountIndex}][type]" class="form-control reduction-type" style="width:auto;">
                <option value="percent">%</option>
                <option value="fixed">₹</option>
            </select>
            <input type="number" name="reductions[${discountIndex}][value]" class="form-control reduction-value" style="width:120px;" placeholder="0">
            <button type="button" class="btn btn-sm btn-danger remove-reduction">×</button>
        </div>
       `;
            $('#totalDiscountContainer1').append(discountField);
            discountIndex++;
            applyTotalReductions(); // Optional: apply immediately
        });

        $(document).on('click', '.remove-reduction', function() {
            $(this).closest('.reduction-field').remove();
            applyTotalReductions();
        });

        $(document).on('input change', '.reduction-type, .reduction-value', function() {
            applyTotalReductions();
        });





        function applyTotalReductions() {
            const original = parseFloat($('#totalInvoiceAmount').attr('data-original')) || 0;
            let totalReduction = 0;

            $('.reduction-field').each(function() {
                const type = $(this).find('.reduction-type').val();
                const value = parseFloat($(this).find('.reduction-value').val()) || 0;

                if (type === 'percent') {
                    totalReduction += (original * value) / 100;
                } else {
                    totalReduction += value;
                }
            });

            const finalAmount = original - totalReduction;
            $('#totalInvoiceAmount').text(`₹${finalAmount.toFixed(2)}`);
            $('#finalInvoiceAmount').val(finalAmount.toFixed(2)); // if you need to submit this value in a form
        }

        // Apply Round-Off
        //  if ($("#roundOffToggle").prop("checked")) {
        //         roundOff = Math.round(final) - final;
        //         totalAmount = Math.round(final);
        //     } else {
        //         roundOff = 0;
        //         totalAmount = final;
        //     }





        let columnCount = 1000; // Starting index for new columns


        ///this add new column in modal of edit column
        $('#add-column-btn').on('click', function() {
            const newKey = `custom_${columnCount++}`;
            $('#columns-edit-table tbody').append(`
        <tr data-id="${newKey}" data-is-custom="1">
            <td>
                <input type="text" class="form-control" name="columns[${newKey}][name]" value="New Column">
                <input type="hidden" name="columns[${newKey}][key]" value="${newKey}">
            </td>
            <td>
                <select class="form-select" name="columns[${newKey}][type]">
                    <option value="text">Text</option>
                    <option value="number">Number</option>
                   
                </select>
            </td>
            <td class="text-center">
                <input type="checkbox" name="columns[${newKey}][is_visible]" checked>
            </td>
            <td class="text-center">
                <button type="button" class="btn btn-danger btn-sm remove-column">Delete</button>
            </td>
        </tr>
    `);
        });

        $('#columns-edit-table').on('click', '.remove-column', function() {
            $(this).closest('tr').remove();
        });
        $('#updateColumnsBtn').on('click', function(e) {
            // alert('called');
            e.preventDefault();

            $.ajax({
                url: '{{ route("invoice-columns.update") }}',
                type: 'POST', // this POST with _method spoofing
                data: $('#edit-columns-form').serialize() + '&_method=PUT', // append _method manually
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert('Columns updated');

                    // Update global column config
                    invoiceColumns = response.columns;


                    // Now re-initialize the table with new column definitions
                    initInvoiceTable();

                },
                error: function(xhr) {
                    alert('Failed to update columns.');
                    console.error(xhr.responseText);
                }
            });;
        });


    });
</script>
<script>
    $('#columns-edit-table').on('change', '.column-type-select', function() {

        const selectedType = $(this).val();
        const row = $(this).closest('tr');
        const formulaField = row.find('.formula-field-td');

        if (selectedType === 'formula') {
            formulaField.show();
        } else {
            formulaField.hide();
            formulaField.find('input.formula-input').val('');
        }
    });
</script>
<!-- <script>
    let notesArray = [];
    let termsArray = [];

    $('#note_select').on('change', function() {
        var content = $(this).val();
        if (content && !notesArray.includes(content)) {
            notesArray.push(content);
            updateNotes();
        }
    });

    $('#term_select').on('change', function() {
        var content = $(this).val();
        if (content && !termsArray.includes(content)) {
            termsArray.push(content);
            updateTerms();
        }
    });

    function updateNotes() {
        let data = '';
        notesArray.forEach((note, index) => {
            data += (index + 1) + ". " + note + "\n";
        });
        $('#notes').val(data);
    }

    function updateTerms() {
        let data = '';
        termsArray.forEach((term, index) => {
            data += (index + 1) + ". " + term + "\n";
        });
        $('#terms').val(data);
    }
</script> -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

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
        const div = document.createElement('div');
        div.classList.add('custom-field');
        div.innerHTML = `
                                            <input type="text" name="custom_fields_new[${fieldIndex}][label]" placeholder="Field Label" />
                                            <input type="text" name="custom_fields_new[${fieldIndex}][value]" placeholder="Field Value" />
                                        `;
        container.appendChild(div);
        fieldIndex++;
    });
</script>
@endsection