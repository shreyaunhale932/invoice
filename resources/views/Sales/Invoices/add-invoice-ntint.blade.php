<?php $page = 'add-invoice'; ?>
@extends('layout.mainlayout')
@section('content')
<!-- Page Wrapper -->
<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">

<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="card mb-0">
            <div class="card-body">
                <div class="page-header">
                    <div class="content-page-header">
                        <h5>Add Invoice</h5>
                    </div>
                </div>
                <form action="" method="POST">
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
                                    <button class="btn btn-outline-secondary" type="button" id="add-custom-field">Add Custom Field</button>

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





                                </div>
                            </div>

                            <button type="button" id="addItemBtn" class="btn btn-primary">+ Add Item</button>
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




                            <h4 class="mt-3">Grand Total: ₹<span id="grandTotal">0.00</span></h4>

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

                                            <div class="input-block mb-3">
                                                <label>Notes</label>
                                                <select class="form-control" id="note_select">
                                                    <option value="">Select Note</option>
                                                    @foreach($notes as $note)
                                                    <option value="{{ $note->content }}">{{ $note->content }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="input-block mb-3">
                                                <textarea class="form-control" name="notes" id="notes" placeholder="Selected Notes will appear here..." rows="5"></textarea>
                                            </div>


                                            <div class="input-block mb-3">
                                                <label>Terms & Conditions</label>
                                                <select class="form-control" id="term_select">
                                                    <option value="">Select Term</option>
                                                    @foreach($terms as $term)
                                                    <option value="{{ $term->content }}">{{ $term->content }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="input-block mb-3">
                                                <textarea class="form-control" name="terms" id="terms" placeholder="Selected Terms will appear here..." rows="5"></textarea>
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
<!-- Edit Columns Modal -->
<!-- Edit Columns Modal -->
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
                                <!-- <td>
                  <input type="text" class="form-control" name="columns[{{ $column['key'] }}][name]" value="{{ $column['name'] }}" {{ $column['is_custom'] ? '' : 'readonly' }}>
                  <input type="hidden" name="columns[{{ $column['key'] }}][key]" value="{{ $column['key'] }}">
                </td> -->
                                <td>
                                    <!-- <input type="text" class="form-control" name="columns[{{ $column['key'] }}][name]" 
                                         value="{{ $column['name'] }}">
                                    <input type="hidden" name="columns[{{ $column['key'] }}][key]" value="{{ $column['key'] }}"> -->
                                    <input type="hidden" name="columns[{{ $column['key'] }}][key]" value="{{ $column['key'] }}">
                                    <input type="hidden" name="columns[{{ $column['key'] }}][type]" value="{{ $column['type'] }}">
                                    <input type="text" name="columns[{{ $column['key'] }}][name]" value="{{ $column['name'] }}">

                                </td>

                                <td>
                                    @if($column['is_custom'])
                                    <select class="form-select" name="columns[{{ $column['key'] }}][type]">
                                        <option value="text" {{ $column['type'] == 'text' ? 'selected' : '' }}>Text</option>
                                        <option value="number" {{ $column['type'] == 'number' ? 'selected' : '' }}>Number</option>
                                        <option value="formula" {{ $column['type'] == 'formula' ? 'selected' : '' }}>Formula</option>
                                    </select>
                                    @else
                                    <input type="hidden" name="columns[{{ $column['key'] }}][type]" value="{{ $column['type'] }}">
                                    <span class="text-muted">{{ ucfirst($column['type']) }}</span>
                                    @endif
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
            alert('called init');
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

                    case "discount":
                        cellContent = `<input type="number" class="form-control discount" name="products[${rowIndex}][discount]">`;
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
            console.log("Table body HTML after add:", $('#invoiceTable tbody').html());

            console.log("New row:", newRow);
            console.log("Expected columns:", invoiceColumns.length + 1);
            console.log("Row cells:", newRow.length);

            invoiceTable.row.add(newRow).draw(false); // Properly add the row


            // Clone and assign options
            const $newSelect = $(".item-select").last();
            const options = $("#productMaster option").clone();
            $newSelect.empty().append(options);
            console.log($newSelect.html());
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
            alert('here');
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
            alert("update row")
            const qty = parseFloat(row.find(".qty").val()) || 1;
            const rate = parseFloat(row.find(".rate").val()) || 0;
            // const discount = parseFloat(row.find(".discount").val()) || 0;
            const gst = parseFloat(row.find(".gst").val()) || 0;
            alert(gst);
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
                    <option value="formula">Formula</option>
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
</script>

@endsection