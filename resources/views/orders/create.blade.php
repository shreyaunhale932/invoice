<?php $page = 'add-order'; ?>
@extends('layout.mainlayout')

@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Create Customer Order</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Orders</a></li>
                        <li class="breadcrumb-item active">New Order</li>
                    </ul>
                </div>
                <div class="col-auto">
                    <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary">
                        <i class="fa fa-arrow-left me-1"></i> Back to Orders
                    </a>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fa fa-exclamation-circle me-2"></i><strong>Please correct the following errors:</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form action="{{ route('orders.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Section 1: Customer & Order Meta -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white border-bottom">
                    <h5 class="card-title mb-0 text-primary">
                        <i class="fa fa-file-invoice me-2"></i>Order & Customer Details
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-bold">Order No <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="order_no" value="{{ old('order_no', $suggestedOrderNo) }}" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-bold">Order Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="order_date" value="{{ old('order_date', date('Y-m-d')) }}" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-bold">Promised Delivery Date</label>
                            <input type="date" class="form-control" name="due_date" value="{{ old('due_date', date('Y-m-d', strtotime('+7 days'))) }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-bold">Order Priority</label>
                            <select name="priority" class="form-select">
                                <option value="normal" {{ old('priority', 'normal') == 'normal' ? 'selected' : '' }}>Normal</option>
                                <option value="urgent" {{ old('priority') == 'urgent' ? 'selected' : '' }}>Urgent</option>
                                <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
                                <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Select Customer <span class="text-danger">*</span></label>
                            <select name="customer_id" class="form-select select2" required>
                                <option value="">Select Existing Customer</option>
                                @foreach($customers as $c)
                                    <option value="{{ $c->id }}" {{ old('customer_id') == $c->id ? 'selected' : '' }}>
                                        {{ $c->name }} ({{ $c->phone ?: 'No Phone' }}) {{ $c->city ? ' - ' . $c->city : '' }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-muted">Need a new customer? <a href="{{ route('add-customer') }}" target="_blank">Add Customer in new tab</a></small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 2: Jewellery Item Specification -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white border-bottom">
                    <h5 class="card-title mb-0 text-primary">
                        <i class="fa fa-gem me-2"></i>Jewellery Item Specification
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Jewellery Item Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="item_name" value="{{ old('item_name') }}" placeholder="e.g. Bridal Choker Necklace, Diamond Solitaire Ring" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Category</label>
                            <select name="category_id" id="category_id" class="form-select">
                                <option value="">Select Category</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->category_id }}" {{ old('category_id') == $cat->category_id ? 'selected' : '' }}>
                                        {{ $cat->category_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Subcategory</label>
                            <select name="subcategory_id" id="subcategory_id" class="form-select">
                                <option value="">Select Subcategory</option>
                                @foreach($categories as $cat)
                                    @foreach($cat->subcategories as $sub)
                                        <option value="{{ $sub->subcategory_id }}" data-cat="{{ $cat->category_id }}" {{ old('subcategory_id') == $sub->subcategory_id ? 'selected' : '' }}>
                                            {{ $cat->category_name }} &rsaquo; {{ $sub->subcategory_name }}
                                        </option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-bold">Metal Type <span class="text-danger">*</span></label>
                            <select name="metal_type" class="form-select">
                                <option value="Gold" {{ old('metal_type', 'Gold') == 'Gold' ? 'selected' : '' }}>Gold</option>
                                <option value="Silver" {{ old('metal_type') == 'Silver' ? 'selected' : '' }}>Silver</option>
                                <option value="Platinum" {{ old('metal_type') == 'Platinum' ? 'selected' : '' }}>Platinum</option>
                                <option value="Rose Gold" {{ old('metal_type') == 'Rose Gold' ? 'selected' : '' }}>Rose Gold</option>
                                <option value="White Gold" {{ old('metal_type') == 'White Gold' ? 'selected' : '' }}>White Gold</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-bold">Purity / Karat</label>
                            <select name="purity" class="form-select">
                                <option value="">Select Purity</option>
                                <option value="22K (916)" {{ old('purity', '22K (916)') == '22K (916)' ? 'selected' : '' }}>22K (916)</option>
                                <option value="18K (750)" {{ old('purity') == '18K (750)' ? 'selected' : '' }}>18K (750)</option>
                                <option value="14K (585)" {{ old('purity') == '14K (585)' ? 'selected' : '' }}>14K (585)</option>
                                <option value="24K (999)" {{ old('purity') == '24K (999)' ? 'selected' : '' }}>24K (999)</option>
                                <option value="Silver 925" {{ old('purity') == 'Silver 925' ? 'selected' : '' }}>Silver 925</option>
                                @foreach($purities as $p)
                                    <option value="{{ $p->purity_value }} {{ $p->purity_type }}">{{ $p->purity_value }} {{ $p->purity_type }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-bold">Expected Net Weight (g)</label>
                            <div class="input-group">
                                <input type="number" step="0.001" class="form-control" name="expected_net_weight" id="expected_net_weight" value="{{ old('expected_net_weight', '0.000') }}" placeholder="0.000">
                                <span class="input-group-text">g</span>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-bold">Expected Gross Weight (g)</label>
                            <div class="input-group">
                                <input type="number" step="0.001" class="form-control" name="expected_gross_weight" id="expected_gross_weight" value="{{ old('expected_gross_weight', '0.000') }}" placeholder="0.000">
                                <span class="input-group-text">g</span>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-bold">Size / Dimensions</label>
                            <input type="text" class="form-control" name="size" value="{{ old('size') }}" placeholder="e.g. Ring Size 14 / Length 18 inch">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-bold">Design Code / Catalog Ref</label>
                            <input type="text" class="form-control" name="design_code" value="{{ old('design_code') }}" placeholder="e.g. DSN-502">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Reference Design Photo / Sketch</label>
                            <input type="file" class="form-control" name="image" id="design_image" accept="image/*">
                            <small class="text-muted">JPG, PNG, WEBP (Max 5MB)</small>
                            <div id="image_preview_box" class="mt-2" style="display: none;">
                                <img id="preview_img" src="#" alt="Preview" class="rounded border p-1" style="max-height: 120px; object-fit: contain;">
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-bold">Special Customization Instructions & Specifications</label>
                            <textarea class="form-control" name="specifications" rows="3" placeholder="Specify stone details, rhodium/antique polish, engraving name/date, clasp type, etc.">{{ old('specifications') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 3: Financial Estimation & Advance Payment -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white border-bottom">
                    <h5 class="card-title mb-0 text-primary">
                        <i class="fa fa-coins me-2"></i>Estimated Pricing & Customer Advance
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-bold">Est. Metal Rate per gram (₹)</label>
                            <div class="input-group">
                                <span class="input-group-text">₹</span>
                                <input type="number" step="0.01" class="form-control calc-trigger" name="estimated_rate" id="estimated_rate" value="{{ old('estimated_rate', '0.00') }}">
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-bold">Est. Making Charges (₹)</label>
                            <div class="input-group">
                                <span class="input-group-text">₹</span>
                                <input type="number" step="0.01" class="form-control calc-trigger" name="estimated_making_charges" id="estimated_making_charges" value="{{ old('estimated_making_charges', '0.00') }}">
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-bold">Other / Stone Charges (₹)</label>
                            <div class="input-group">
                                <span class="input-group-text">₹</span>
                                <input type="number" step="0.01" class="form-control calc-trigger" name="estimated_other_charges" id="estimated_other_charges" value="{{ old('estimated_other_charges', '0.00') }}">
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-bold">Total Estimated Amount (₹)</label>
                            <div class="input-group">
                                <span class="input-group-text">₹</span>
                                <input type="number" step="0.01" class="form-control fw-bold text-primary bg-light" name="estimated_total_amount" id="estimated_total_amount" value="{{ old('estimated_total_amount', '0.00') }}">
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Advance Payment Received (₹)</label>
                            <div class="input-group">
                                <span class="input-group-text">₹</span>
                                <input type="number" step="0.01" class="form-control calc-trigger fw-bold text-success" name="advance_amount" id="advance_amount" value="{{ old('advance_amount', '0.00') }}">
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Payment Mode</label>
                            <select name="advance_payment_mode" class="form-select">
                                <option value="Cash">Cash</option>
                                <option value="UPI / Online">UPI / Online / QR</option>
                                <option value="Bank Transfer">Bank Transfer / NEFT</option>
                                <option value="Cheque">Cheque</option>
                                <option value="Card">Debit / Credit Card</option>
                                <option value="Old Metal Only">Old Metal Given Only</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Old Gold / Metal Given as Advance (g)</label>
                            <div class="input-group">
                                <input type="number" step="0.001" class="form-control" name="advance_metal_weight" value="{{ old('advance_metal_weight', '0.000') }}">
                                <span class="input-group-text">g</span>
                            </div>
                            <small class="text-muted">If customer deposited old jewellery towards this order</small>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="alert alert-light border d-flex justify-content-between align-items-center mb-0">
                                <span class="fw-bold text-muted">Estimated Balance Due on Delivery:</span>
                                <span class="fs-5 fw-bold text-danger" id="balance_display">₹0.00</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Workflow Quick Option -->
            <div class="card shadow-sm border-0 mb-4 bg-light">
                <div class="card-body">
                    <div class="form-check form-switch fs-6">
                        <input class="form-check-input" type="checkbox" name="assign_immediately" value="1" id="assign_immediately" checked>
                        <label class="form-check-label fw-bold text-dark ms-2" for="assign_immediately">
                            <i class="fa fa-user-plus text-primary me-1"></i> Proceed to Assign to Karigar immediately after creating order
                        </label>
                        <div class="small text-muted ms-4">You will be taken directly to the raw gold issue and Karigar job card screen.</div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mb-5">
                <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary px-4">Cancel</a>
                <button type="submit" class="btn btn-primary px-5">
                    <i class="fa fa-check me-1"></i> Save Order
                </button>
            </div>
        </form>

    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Image preview
    const imageInput = document.getElementById('design_image');
    const previewBox = document.getElementById('image_preview_box');
    const previewImg = document.getElementById('preview_img');

    if (imageInput) {
        imageInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    previewBox.style.display = 'block';
                }
                reader.readAsDataURL(file);
            } else {
                previewBox.style.display = 'none';
            }
        });
    }

    // Auto-calculate Total Estimated Amount and Balance Due
    function calculateFinancials() {
        const netWt = parseFloat(document.getElementById('expected_net_weight').value) || 0;
        const rate = parseFloat(document.getElementById('estimated_rate').value) || 0;
        const making = parseFloat(document.getElementById('estimated_making_charges').value) || 0;
        const other = parseFloat(document.getElementById('estimated_other_charges').value) || 0;
        const advance = parseFloat(document.getElementById('advance_amount').value) || 0;

        let total = (netWt * rate) + making + other;
        if (total === 0 && (parseFloat(document.getElementById('estimated_total_amount').value) || 0) > 0) {
            total = parseFloat(document.getElementById('estimated_total_amount').value) || 0;
        } else {
            document.getElementById('estimated_total_amount').value = total.toFixed(2);
        }

        const balance = Math.max(0, total - advance);
        document.getElementById('balance_display').innerText = '₹' + balance.toLocaleString('en-IN', {minimumFractionDigits: 2, maximumFractionDigits: 2});
    }

    document.querySelectorAll('.calc-trigger').forEach(input => {
        input.addEventListener('input', calculateFinancials);
    });
    const netInput = document.getElementById('expected_net_weight');
    if (netInput) netInput.addEventListener('input', calculateFinancials);

    calculateFinancials();
});
</script>
@endsection
