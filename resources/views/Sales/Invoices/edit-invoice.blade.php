<?php $page = 'edit-invoice'; ?>
@extends('layout.mainlayout')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="card mb-0">
            <div class="card-body">
                <div class="page-header">
                    <div class="content-page-header">
                        <h5>Edit Invoice1</h5>
                    </div>
                </div>
                <form action="{{ route('invoices.update') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group-item border-0 mb-0">
                            <div class="row align-item-center">
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label>Invoice Number</label>
                                        <input type="text" value="{{ $invoice->invoice_number }}" class="form-control" placeholder="Enter Invoice Number">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label>Customer Name</label>
                                        <ul class="form-group-plus css-equal-heights">
                                            <li>
                                                <select class="select" name="customer_id">

                                                    @foreach($customers as $customer)
                                                    <option value="{{ $customer->id }}">
                                                        {{ $invoice->customer_id == $customer->id ? 'To' : '' }}
                                                        {{ $customer->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </li>
                                            <li></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label>Invoice Date</label>
                                        <div class="cal-icon cal-icon-info">
                                            <input type="text" class="datetimepicker form-control"
                                                name="invoice_date"
                                                value="{{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d-m-Y') }}"
                                                placeholder="Select Date">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label>Due Date</label>
                                        <div class="cal-icon cal-icon-info">
                                            <input type="text" class="datetimepicker form-control"
                                                name="due_date"
                                                value="{{ \Carbon\Carbon::parse($invoice->due_date)->format('d-m-Y') }}"
                                                placeholder="Select Date">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label>Status</label>
                                        <select class="select" name="status">

                                            <option value="Unpaid" {{ $invoice->status == 'Unpaid' ? 'selected' : '' }}>Unpaid</option>
                                            <option value="Partially paid" {{ $invoice->status == 'Partially paid' ? 'selected' : '' }}>Partially paid</option>
                                            <option value="Paid" {{ $invoice->status == 'Paid' ? 'selected' : '' }}>Paid</option>
                                            <option value="Overdue" {{ $invoice->status == 'Overdue' ? 'selected' : '' }}>Overdue</option>
                                            <option value="Cancelled" {{ $invoice->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                            <option value="Refunded" {{ $invoice->status == 'Refunded' ? 'selected' : '' }}>Refunded</option>
                                            <option value="Draft" {{ $invoice->status == 'pending' ? 'selected' : '' }}>Draft</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label>Reference Number</label>
                                        <input type="text" class="form-control" placeholder="Enter Reference Number">
                                    </div>
                                </div> -->
                                <!-- <div class="col-lg-4">
                                    <div class="d-flex justify-content-between flex-wrap">
                                        <div class="input-block mb-3 recurring-tab">
                                            <label>Recurring</label>
                                            <ul class="nav nav-pills d-flex" id="pills-tab" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link active yes" id="pills-home-tab"
                                                        data-bs-toggle="pill" data-bs-target="#pills-home"
                                                        type="button" role="tab" aria-controls="pills-home"
                                                        aria-selected="true">Yes</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link no" id="pills-profile-tab"
                                                        data-bs-toggle="pill" data-bs-target="#pills-profile"
                                                        type="button" role="tab" aria-controls="pills-profile"
                                                        aria-selected="false">No</button>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="tab-content pt-0" id="pills-tabContent">
                                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                                aria-labelledby="pills-home-tab">
                                                <div class="input-block mb-3">
                                                    <label>Recurring cycle</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter Month">
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                                aria-labelledby="pills-profile-tab"></div>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="col-lg-8">
                                    <div class="input-block mb-3">
                                        <label>Products</label>
                                        <select id="productDropdown1" class="form-select">
                                                <option value="">Select Product</option>
                                                @foreach ($products as $product)
                                                <option value="{{ $product->product_name }}"
                                                    data-rate="{{ $product->rate }}"
                                                    data-hsn="{{ $product->hsn_code ?? 'N/A' }}">
                                                    {{ $product->product_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        <ul class="form-group-plus css-equal-heights">
                                            <li>
                                               
                                            </li>
                                            <li>
                                             
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group-item">
                            <div class="card-table">
                                <div class="card-body">
                                    <div class="table-responsive no-pagination">
                                        <table id="invoiceTable" class="table table-center table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Product</th>
                                                    <th>HSN</th>
                                                    <th>Quantity</th>
                                                    <th>Rateggggg</th>
                                                    <th>Discountttt</th>
                                                    <th>GSTtttttt</th>
                                                    <!-- <th>Amount</th> -->
                                                    <th>CGST</th>
                                                    <th>SGST</th>
                                                    <th>IGST</th>
                                                    <th>Total</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Dynamically populated rows from JavaScript -->
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-lg-7">
                                        <div class="input-block mb-3">
                                            <label>Discount Type</label>
                                            <select class="select">
                                                <option>Percentage(%)</option>
                                                <option>Fixed</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="input-block mb-3">
                                            <label>Discount(%)</label>
                                            <input type="text" class="form-control" placeholder="10">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-block mb-3">
                                    <label>Tax</label>
                                    <select class="select">
                                        <option>No Tax</option>
                                        <option>IVA - (21%)</option>
                                        <option>IRPF - (-15%)</option>
                                        <option>PDV - (20%)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4"></div>
                        </div> -->
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
                            <button type="submit" class="btn btn-primary">Save & Send</button>
                        
                    </div>
                </div>
                </form>
            </div>
        </div>

    </div>
</div>
<script>
    // Pass the invoice items to JavaScript
    let invoiceItems = @json($invoice -> items);


    // alert(invoiceItems[0].rate);  

    $(document).ready(function() {
        // Assuming you have a DataTable initialized
         // Initialize Select2 for Product Dropdown
         $("#productDropdown1").select2({
            tags: true,
            placeholder: "Select or type to add a product",
            allowClear: true
        });
        let table = $('#invoiceTable').DataTable();

        // Iterate through all items and add them to the table
        invoiceItems.forEach(function(item, index) {
            table.row.add([
                `<input type="text" class="form-control" name="products[${index}][name]" value="${item.product_name}">`,
                `<input type="text" class="form-control" name="products[${index}][hsn]" value="${item.hsn_code || ''}">`,
                `<input type="number" class="form-control qty" name="products[${index}][quantity]" value="${item.quantity}">`,
                `<input type="number" class="form-control rate" name="products[${index}][rate]" value="${item.rate}">`,
                `<input type="number" class="form-control discount" name="products[${index}][discount]" value="${item.discount}">`,
                `<input type="number" class="form-control gst" name="products[${index}][tax]" value="${item.tax}">`,
                // `<span class="amount">₹${(item.amount || 0).toFixed(2)}</span>`,
                `<span class="cgst">₹${(item.cgst || 0)}</span>`,
                `<span class="sgst">₹${(item.sgst || 0)}</span>`,
                `<span class="igst">₹${(item.igst || 0)}</span>`,
                `<span class="total">₹${(item.total || 0)}</span>`,
                `<a href="#" class="btn-action-icon removeRow"><i class="fe fe-trash-2"></i></a>`
            ]).draw(false); //// Add row without resetting the table
        });


        $("#productDropdown1").on("select2:select", function(e) {
            alert('ok');
            let productName = e.params.data.text.trim();
            let existingOption = $("#productDropdown1 option[value='" + productName + "']");
            let rate = existingOption.length > 0 ? parseFloat(existingOption.data("rate")) || 0 : 0;

            let hsnCode = existingOption.length > 0 ? existingOption.data("hsn") || "N/A" : "N/A"; // Fetch HSN Code
            if (productName) {

                let rowCount = table.rows().count(); // get row index for array

           
                let newRow = [
                    productName + `<input type="hidden" name="products[${rowCount}][name]" value="${productName}">`,
                    `<input type="text" class="form-control" name="products[${rowCount}][hsn]" value="${hsnCode}">`,
                    `<input type="number" class="form-control qty" name="products[${rowCount}][quantity]" value="1">`,
                    `<input type="number" class="form-control rate" name="products[${rowCount}][price]" value="${rate}">`,
                    `<input type="number" class="form-control discount" name="products[${rowCount}][discount]" value="">`,
                    `<input type="number" class="form-control gst" name="products[${rowCount}][gst]" value="">`,
                    // `<span class="amount">₹0.00</span><input type="hidden" name="products[${rowCount}][amount]" class="amountInput" value="0">`,
                    `<span class="cgst">₹0.00</span><input type="hidden" name="products[${rowCount}][cgst]" class="cgstInput" value="0">`,
                    `<span class="sgst">₹0.00</span><input type="hidden" name="products[${rowCount}][sgst]" class="sgstInput" value="0">`,
                    `<span class="igst">₹0.00</span><input type="hidden" name="products[${rowCount}][igst]" class="igstInput" value="0">`,
                    `<span class="total">₹0.00</span><input type="hidden" name="products[${rowCount}][total]" class="totalInput" value="0">`,
                    `<a href="#" class="btn-action-icon removeRow"><i class="fe fe-trash-2"></i></a>`
                ];

                table.row.add(newRow).draw(false);
                $("#productDropdown1").val(null).trigger("change");
            }
            calculateTotal();
        });

        // Trigger calculations (optional if needed after adding rows)
        // calculateTotal();
        
        function calculateTotal() {
            let taxableAmount = 0,
                totalGST = 0,
                totalAmount = 0,
                cgst = 0,
                sgst = 0,
                igst = 0,
                roundOff = 0;

            // Loop through each row and calculate totals
            $("#invoiceTable tbody tr").each(function() {
                let qty = parseFloat($(this).find(".qty").val()) || 1;
                let rate = parseFloat($(this).find(".rate").val()) || 0;
                let discount = parseFloat($(this).find(".discount").val()) || 0;
                let gstRate = parseFloat($(this).find(".gst").val()) || 0;

                let total = qty * rate;
                let discountAmount = (total * discount) / 100;
                let taxable = total - discountAmount;
                let taxAmount = (taxable * gstRate) / 100;

                taxableAmount += taxable;
                totalGST += taxAmount;

                // Check if states match for CGST/SGST vs IGST
                let businessState = $("#businessState").val();
                let customerState = $("#customerState").val();

                if ($.trim(businessState).toLowerCase() === $.trim(customerState).toLowerCase()) {
                    cgst += taxAmount / 2;
                    sgst += taxAmount / 2;
                } else {
                    igst += taxAmount;
                }
            });

            let grandTotal = taxableAmount + totalGST;

            // Apply Round-Off if necessary
            if ($("#roundOffToggle").prop("checked")) {
                roundOff = Math.round(grandTotal) - grandTotal;
                totalAmount = Math.round(grandTotal);
            } else {
                roundOff = 0;
                totalAmount = grandTotal;
            }

            // Update UI with calculated values
            $("#taxableAmount").text(`₹${taxableAmount.toFixed(2)}`);
            $("#cgstAmount").text(`₹${cgst.toFixed(2)}`);
            $("#sgstAmount").text(`₹${sgst.toFixed(2)}`);
            $("#igstAmount").text(`₹${igst.toFixed(2)}`);
            $("#roundOffAmount").text(`₹${roundOff.toFixed(2)}`);
            $("#totalInvoiceAmount").text(`₹${totalAmount.toFixed(2)}`);
        }
        // Update row calculations on change
        $(document).on("input", ".qty, .rate, .discount, .gst", function() {
            // alert('called');
            updateRowAmount($(this).closest("tr"));
            calculateTotal();
        });

        function updateRowAmount(row) {
            let qty = parseFloat(row.find(".qty").val()) || 1;
            let rate = parseFloat(row.find(".rate").val()) || 0;
            let discount = parseFloat(row.find(".discount").val()) || 0;
            let gstRate = parseFloat(row.find(".gst").val()) || 0;

            let total = qty * rate;
            let discountAmount = (total * discount) / 100;
            let taxable = total - discountAmount;
            let gstAmount = (taxable * gstRate) / 100;

            let businessState = $("#businessState").val();
            let customerState = $("#customerState").val();
            let cgst = 0,
                sgst = 0,
                igst = 0;

            if ($.trim(businessState).toLowerCase() === $.trim(customerState).toLowerCase()) {
                cgst = gstAmount / 2;
                sgst = gstAmount / 2;
            } else {
                igst = gstAmount;
            }

            let finalAmount = taxable + gstAmount;

            row.find(".amount").text(`₹${taxable.toFixed(2)}`);
            row.find(".cgst").text(`₹${cgst.toFixed(2)}`);
            row.find(".sgst").text(`₹${sgst.toFixed(2)}`);
            row.find(".igst").text(`₹${igst.toFixed(2)}`);
            row.find(".total").text(`₹${finalAmount.toFixed(2)}`);
        }
    });
</script>



<!-- /Page Wrapper -->
@endsection