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
                                    <button class="btn btn-primary form-plus-btn" type="button" id="add-custom-field">Add Custom Field</button>

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



                                </div>
                            </div>

                            <button type="button" id="addItemBtn" class="btn btn-primary">+ Add Item</button>
                            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#gstConfigModal">
                                Configure GST
                            </button>

                           

                            <table class="table" id="invoiceTable">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>HSN</th>
                                        <th>Quantity</th>
                                        <th>Rate</th>
                                        <th>Discount</th>
                                        <th>Tax %</th>
                                        <th>Amount</th>
                                        <th>CGST</th>
                                        <th>SGST</th>
                                        <th>IGST</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                       
                                       

                                    </tr>
                                </thead>

                                <tbody></tbody>
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
                                                <select id="discountType">
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
    $(document).ready(function() {
        const table = $("#invoiceTable").DataTable({
            paging: false,
            info: false,
            searching: false,
            ordering: false,
            language: {
                emptyTable: ""
            }
        });

        // Add new product row
        $('#addItemBtn').on('click', function() {
            const rowIndex = table.rows().count();


            const newRow = [
                // 1: Product select
                `<select class="form-control item-select" name="products[${rowIndex}][name]"></select>
     <input type="hidden" name="products[${rowIndex}][name]" class="productNameInput">`,
                `<input type="text" class="form-control hsn" name="products[${rowIndex}][hsn]">`,
                // 2: Quantity
                `<input type="number" class="form-control qty" name="products[${rowIndex}][quantity]" value="1">`,

                // 3: Rate
                `<input type="number" class="form-control rate" name="products[${rowIndex}][price]" value="0">`,

                // 4: Discount
                // `<input type="number" class="form-control discount" name="products[${rowIndex}][discount]" value="">`,
                `<div class = "input-group discount-group">
                <input type = "number"
                class = "form-control discount"
                name = "products[${rowIndex}][discount]"
                value = "" >
                <select class = "form-select discount-type"
                name = "products[${rowIndex}][discount_type]"
                style = "width:auto;" >
                <option value = "percent"> % </option>
                 <option value = "fixed"> ₹ </option> </select> </div>`,

                // 5: Tax %
                `<input type="number" class="form-control gst" name="products[${rowIndex}][gst]" value="">`,

                // 6: Amount (Taxable)
                `<span class="amount">₹0.00</span>
     <input type="hidden" class="amountInput" name="products[${rowIndex}][amount]" value="0">`,

                // 7: CGST
                `<span class="cgst">₹0.00</span>
     <input type="hidden" class="cgstInput" name="products[${rowIndex}][cgst]" value="0">`,

                // 8: SGST
                `<span class="sgst">₹0.00</span>
     <input type="hidden" class="sgstInput" name="products[${rowIndex}][sgst]" value="0">`,

                // 9: IGST
                `<span class="igst">₹0.00</span>
     <input type="hidden" class="igstInput" name="products[${rowIndex}][igst]" value="0">`,

                // 10: Final total
                `<span class="total">₹0.00</span>
     <input type="hidden" class="totalInput" name="products[${rowIndex}][total]" value="0">`,

                // 11: Action
                `<a href="#" class="btn-action-icon removeRow"><i class="fe fe-trash-2"></i></a>`
            ];



            table.row.add(newRow).draw(false);

            // Get the last added select
            const $newSelect = $(".item-select").last();
            console.log("Master options:", $("#productMaster option").length);

            // Clone options from #productMaster and append to new select
            const options = $("#productMaster option").clone();
            $newSelect.empty().append(options);

            console.log($newSelect.html());

            // Initialize select2
            setTimeout(() => {
                $newSelect.select2({
                    placeholder: "Select or type a product",
                    width: '100%',
                    allowClear: true,
                    tags: true
                });
            }, 0);

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
            const qty = parseFloat(row.find(".qty").val()) || 1;
            const rate = parseFloat(row.find(".rate").val()) || 0;
            // const discount = parseFloat(row.find(".discount").val()) || 0;
            const gst = parseFloat(row.find(".gst").val()) || 0;
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
            table.row($(this).closest("tr")).remove().draw(false);
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

            const final = Math.max(original - totalReduction, 0);
            $('#totalInvoiceAmount').text(`₹${final.toFixed(2)}`);
        }

        // Apply Round-Off
        //  if ($("#roundOffToggle").prop("checked")) {
        //         roundOff = Math.round(final) - final;
        //         totalAmount = Math.round(final);
        //     } else {
        //         roundOff = 0;
        //         totalAmount = final;
        //     }



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