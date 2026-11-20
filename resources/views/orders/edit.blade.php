<?php $page = 'edit-order'; ?>
@extends('layout.mainlayout')

@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Edit Order: {{ $order->order_no }}</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Orders</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ul>
                </div>
                <div class="col-auto">
                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-outline-info me-2">
                        <i class="fa fa-eye me-1"></i> View Order
                    </a>
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

        <form action="{{ route('orders.update', $order->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

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
                            <label class="form-label fw-bold">Order No</label>
                            <input type="text" class="form-control bg-light" name="order_no" value="{{ $order->order_no }}" readonly>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-bold">Order Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="order_date" value="{{ old('order_date', $order->order_date ? $order->order_date->format('Y-m-d') : '') }}" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-bold">Promised Delivery Date</label>
                            <input type="date" class="form-control" name="due_date" value="{{ old('due_date', $order->due_date ? $order->due_date->format('Y-m-d') : '') }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-bold">Order Priority</label>
                            <select name="priority" class="form-select">
                                <option value="normal" {{ old('priority', $order->priority) == 'normal' ? 'selected' : '' }}>Normal</option>
                                <option value="urgent" {{ old('priority', $order->priority) == 'urgent' ? 'selected' : '' }}>Urgent</option>
                                <option value="high" {{ old('priority', $order->priority) == 'high' ? 'selected' : '' }}>High</option>
                                <option value="low" {{ old('priority', $order->priority) == 'low' ? 'selected' : '' }}>Low</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Select Customer <span class="text-danger">*</span></label>
                            <select name="customer_id" class="form-select select2" required>
                                <option value="">Select Existing Customer</option>
                                @foreach($customers as $c)
                                    <option value="{{ $c->id }}" {{ old('customer_id', $order->customer_id) == $c->id ? 'selected' : '' }}>
                                        {{ $c->name }} ({{ $c->phone ?: 'No Phone' }})
                                    </option>
                                @endforeach
                            </select>
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
                            <input type="text" class="form-control" name="item_name" value="{{ old('item_name', $order->item_name) }}" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Category</label>
                            <select name="category_id" id="category_id" class="form-select">
                                <option value="">Select Category</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->category_id }}" {{ old('category_id', $order->category_id) == $cat->category_id ? 'selected' : '' }}>
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
                                        <option value="{{ $sub->subcategory_id }}" {{ old('subcategory_id', $order->subcategory_id) == $sub->subcategory_id ? 'selected' : '' }}>
                                            {{ $cat->category_name }} &rsaquo; {{ $sub->subcategory_name }}
                                        </option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-bold">Metal Type <span class="text-danger">*</span></label>
                            <select name="metal_type" class="form-select">
                                <option value="Gold" {{ old('metal_type', $order->metal_type) == 'Gold' ? 'selected' : '' }}>Gold</option>
                                <option value="Silver" {{ old('metal_type', $order->metal_type) == 'Silver' ? 'selected' : '' }}>Silver</option>
                                <option value="Platinum" {{ old('metal_type', $order->metal_type) == 'Platinum' ? 'selected' : '' }}>Platinum</option>
                                <option value="Rose Gold" {{ old('metal_type', $order->metal_type) == 'Rose Gold' ? 'selected' : '' }}>Rose Gold</option>
                                <option value="White Gold" {{ old('metal_type', $order->metal_type) == 'White Gold' ? 'selected' : '' }}>White Gold</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-bold">Purity / Karat</label>
                            <select name="purity" class="form-select">
                                <option value="">Select Purity</option>
                                <option value="22K (916)" {{ old('purity', $order->purity) == '22K (916)' ? 'selected' : '' }}>22K (916)</option>
                                <option value="18K (750)" {{ old('purity', $order->purity) == '18K (750)' ? 'selected' : '' }}>18K (750)</option>
                                <option value="14K (585)" {{ old('purity', $order->purity) == '14K (585)' ? 'selected' : '' }}>14K (585)</option>
                                <option value="24K (999)" {{ old('purity', $order->purity) == '24K (999)' ? 'selected' : '' }}>24K (999)</option>
                                <option value="Silver 925" {{ old('purity', $order->purity) == 'Silver 925' ? 'selected' : '' }}>Silver 925</option>
                                @foreach($purities as $p)
                                    <option value="{{ $p->purity_value }} {{ $p->purity_type }}" {{ old('purity', $order->purity) == ($p->purity_value . ' ' . $p->purity_type) ? 'selected' : '' }}>
                                        {{ $p->purity_value }} {{ $p->purity_type }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-bold">Expected Net Weight (g)</label>
                            <div class="input-group">
                                <input type="number" step="0.001" class="form-control" name="expected_net_weight" id="expected_net_weight" value="{{ old('expected_net_weight', $order->expected_net_weight) }}">
                                <span class="input-group-text">g</span>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-bold">Expected Gross Weight (g)</label>
                            <div class="input-group">
                                <input type="number" step="0.001" class="form-control" name="expected_gross_weight" id="expected_gross_weight" value="{{ old('expected_gross_weight', $order->expected_gross_weight) }}">
                                <span class="input-group-text">g</span>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-bold">Size / Dimensions</label>
                            <input type="text" class="form-control" name="size" value="{{ old('size', $order->size) }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-bold">Design Code / Catalog Ref</label>
                            <input type="text" class="form-control" name="design_code" value="{{ old('design_code', $order->design_code) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Change Reference Design Photo</label>
                            <input type="file" class="form-control" name="image" id="design_image" accept="image/*">
                            @if($order->image)
                                <div class="mt-2">
                                    <img src="{{ asset($order->image) }}" class="rounded border p-1" style="max-height: 100px;" alt="current photo">
                                    <small class="text-muted d-block">Current uploaded design</small>
                                </div>
                            @endif
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-bold">Special Customization Instructions & Specifications</label>
                            <textarea class="form-control" name="specifications" rows="3">{{ old('specifications', $order->specifications) }}</textarea>
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
                                <input type="number" step="0.01" class="form-control" name="estimated_rate" id="estimated_rate" value="{{ old('estimated_rate', $order->estimated_rate) }}">
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-bold">Est. Making Charges (₹)</label>
                            <div class="input-group">
                                <span class="input-group-text">₹</span>
                                <input type="number" step="0.01" class="form-control" name="estimated_making_charges" id="estimated_making_charges" value="{{ old('estimated_making_charges', $order->estimated_making_charges) }}">
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-bold">Other / Stone Charges (₹)</label>
                            <div class="input-group">
                                <span class="input-group-text">₹</span>
                                <input type="number" step="0.01" class="form-control" name="estimated_other_charges" id="estimated_other_charges" value="{{ old('estimated_other_charges', $order->estimated_other_charges) }}">
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-bold">Total Estimated Amount (₹)</label>
                            <div class="input-group">
                                <span class="input-group-text">₹</span>
                                <input type="number" step="0.01" class="form-control fw-bold text-primary" name="estimated_total_amount" id="estimated_total_amount" value="{{ old('estimated_total_amount', $order->estimated_total_amount) }}">
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Advance Payment Received (₹)</label>
                            <div class="input-group">
                                <span class="input-group-text">₹</span>
                                <input type="number" step="0.01" class="form-control fw-bold text-success" name="advance_amount" id="advance_amount" value="{{ old('advance_amount', $order->advance_amount) }}">
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Payment Mode</label>
                            <select name="advance_payment_mode" class="form-select">
                                <option value="Cash" {{ old('advance_payment_mode', $order->advance_payment_mode) == 'Cash' ? 'selected' : '' }}>Cash</option>
                                <option value="UPI / Online" {{ old('advance_payment_mode', $order->advance_payment_mode) == 'UPI / Online' ? 'selected' : '' }}>UPI / Online / QR</option>
                                <option value="Bank Transfer" {{ old('advance_payment_mode', $order->advance_payment_mode) == 'Bank Transfer' ? 'selected' : '' }}>Bank Transfer / NEFT</option>
                                <option value="Cheque" {{ old('advance_payment_mode', $order->advance_payment_mode) == 'Cheque' ? 'selected' : '' }}>Cheque</option>
                                <option value="Card" {{ old('advance_payment_mode', $order->advance_payment_mode) == 'Card' ? 'selected' : '' }}>Debit / Credit Card</option>
                                <option value="Old Metal Only" {{ old('advance_payment_mode', $order->advance_payment_mode) == 'Old Metal Only' ? 'selected' : '' }}>Old Metal Given Only</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Old Gold / Metal Given as Advance (g)</label>
                            <div class="input-group">
                                <input type="number" step="0.001" class="form-control" name="advance_metal_weight" value="{{ old('advance_metal_weight', $order->advance_metal_weight) }}">
                                <span class="input-group-text">g</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mb-5">
                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-outline-secondary px-4">Cancel</a>
                <button type="submit" class="btn btn-primary px-5">
                    <i class="fa fa-save me-1"></i> Update Order
                </button>
            </div>
        </form>

    </div>
</div>
@endsection
