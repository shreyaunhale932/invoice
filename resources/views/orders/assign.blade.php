<?php $page = 'orders'; ?>
@extends('layout.mainlayout')

@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Assign Order to Karigar</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Orders</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('orders.show', $order->id) }}">{{ $order->order_no }}</a></li>
                        <li class="breadcrumb-item active">Assign to Karigar</li>
                    </ul>
                </div>
                <div class="col-auto">
                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-outline-secondary">
                        <i class="fa fa-arrow-left me-1"></i> Back to Order
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

        <!-- Order Summary Card -->
        <div class="card shadow-sm border-0 mb-4 bg-light">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-2 text-center mb-3 mb-md-0">
                        @if($order->image)
                            <img src="{{ asset($order->image) }}" class="img-fluid rounded border shadow-sm" style="max-height: 90px; object-fit: contain;" alt="Design">
                        @else
                            <div class="bg-white rounded border p-3 text-muted">
                                <i class="fa fa-gem fa-2x"></i>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-10">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-1">
                            <h4 class="mb-0 text-dark fw-bold">{{ $order->item_name }}</h4>
                            <span class="badge bg-primary fs-6">{{ $order->order_no }}</span>
                        </div>
                        <div class="text-muted small mb-2">
                            <strong>Customer:</strong> {{ $order->customer ? $order->customer->name : 'Walk-in Customer' }} |
                            <strong>Metal:</strong> {{ $order->metal_type }} {{ $order->purity }} |
                            <strong>Size:</strong> {{ $order->size ?: 'Standard' }} |
                            <strong>Order Date:</strong> {{ $order->order_date ? $order->order_date->format('d M Y') : '-' }} |
                            <strong>Delivery Due:</strong> {{ $order->due_date ? $order->due_date->format('d M Y') : 'Not set' }}
                        </div>
                        <div class="d-flex gap-3">
                            <span class="badge bg-white text-dark border p-2">Expected Net Wt: <strong>{{ number_format($order->expected_net_weight, 3) }} g</strong></span>
                            <span class="badge bg-white text-dark border p-2">Expected Gross Wt: <strong>{{ number_format($order->expected_gross_weight, 3) }} g</strong></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Assignment Form -->
        <form action="{{ route('orders.assign.store', $order->id) }}" method="POST">
            @csrf

            <!-- Section 1: Karigar Selection & Assignment Meta -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white border-bottom">
                    <h5 class="card-title mb-0 text-primary">
                        <i class="fa fa-user-cog me-2"></i>Karigar Selection & Work Dates
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-bold">Assignment Voucher No <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="assignment_no" value="{{ old('assignment_no', $suggestedAsgNo) }}" required>
                        </div>
                        <div class="col-md-5 mb-3">
                            <label class="form-label fw-bold">Select Karigar (Artisan / Goldsmith) <span class="text-danger">*</span></label>
                            <select name="karigar_id" id="karigar_id" class="form-select select2" required>
                                <option value="">-- Choose Artisan --</option>
                                @foreach($karigars as $karigar)
                                    <option value="{{ $karigar->id }}" data-metal="{{ $karigar->current_metal_balance }}" {{ old('karigar_id', $order->karigar_id) == $karigar->id ? 'selected' : '' }}>
                                        {{ $karigar->name }} ({{ $karigar->code ?: 'KG-' . $karigar->id }}) - {{ $karigar->speciality ?: 'Goldsmith' }} [Balance: {{ number_format($karigar->current_metal_balance, 3) }}g]
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-muted">Need a new karigar? <a href="{{ route('karigars.create') }}" target="_blank">Add new karigar</a></small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label class="form-label fw-bold">Assigned Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="assigned_date" value="{{ old('assigned_date', date('Y-m-d')) }}" required>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label class="form-label fw-bold">Karigar Target Date</label>
                            <input type="date" class="form-control" name="expected_delivery_date" value="{{ old('expected_delivery_date', $order->due_date ? $order->due_date->format('Y-m-d') : date('Y-m-d', strtotime('+5 days'))) }}">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 2: Metal Issued to Karigar -->
            <div class="card shadow-sm border-0 mb-4 border-start border-danger border-4">
                <div class="card-header bg-white border-bottom">
                    <h5 class="card-title mb-0 text-danger">
                        <i class="fa fa-balance-scale me-2"></i>Raw Metal Issued into Karigar's Custody
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Metal Description / Type <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="metal_issued_type" value="{{ old('metal_issued_type', $order->metal_type . ' ' . $order->purity) }}" placeholder="e.g. Gold 22K, 24K Pure Gold Bar, Scrap Gold" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Gross Metal Weight Issued (g) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" step="0.001" class="form-control fs-5 fw-bold text-danger" name="metal_issued_weight" id="metal_issued_weight" value="{{ old('metal_issued_weight', $order->expected_net_weight > 0 ? $order->expected_net_weight : '') }}" placeholder="0.000" required>
                                <span class="input-group-text fw-bold">grams</span>
                            </div>
                            <small class="text-muted">Exact raw gold/metal weight handed over to the artisan</small>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Metal Purity / Karat</label>
                            <input type="text" class="form-control" name="metal_issued_purity" value="{{ old('metal_issued_purity', $order->purity) }}" placeholder="e.g. 91.6% (22K) or 99.9% (24K)">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Stones / Diamonds Issued (Weight)</label>
                            <div class="input-group">
                                <input type="number" step="0.001" class="form-control" name="stones_issued_weight" value="{{ old('stones_issued_weight', '0.000') }}">
                                <span class="input-group-text">cts / g</span>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-bold">Stones / Diamonds Pieces</label>
                            <input type="number" class="form-control" name="stones_issued_pieces" value="{{ old('stones_issued_pieces', '0') }}">
                        </div>
                        <div class="col-md-5 mb-3">
                            <label class="form-label fw-bold">Stones / Diamonds Packet Description</label>
                            <input type="text" class="form-control" name="stones_issued_description" value="{{ old('stones_issued_description') }}" placeholder="e.g. CZ stones, Solitaire 0.50 ct, Emeralds">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 3: Wastage & Making Charges Agreement -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white border-bottom">
                    <h5 class="card-title mb-0 text-primary">
                        <i class="fa fa-percentage me-2"></i>Allowed Wastage & Making Charges Agreement
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-bold">Allowed Wastage %</label>
                            <div class="input-group">
                                <input type="number" step="0.01" class="form-control" name="allowed_wastage_percent" id="allowed_wastage_percent" value="{{ old('allowed_wastage_percent', '1.50') }}">
                                <span class="input-group-text">%</span>
                            </div>
                            <small class="text-muted">Standard acceptable loss percentage</small>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-bold">Calculated Allowed Wastage (g)</label>
                            <div class="form-control bg-light fw-bold text-muted" id="allowed_wastage_display">
                                0.000 g
                            </div>
                            <small class="text-muted">Maximum allowable loss upon return</small>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-bold">Making Charge Type</label>
                            <select name="making_charge_type" id="making_charge_type" class="form-select">
                                <option value="per_gram" {{ old('making_charge_type', 'per_gram') == 'per_gram' ? 'selected' : '' }}>Per Gram (Net Wt)</option>
                                <option value="flat" {{ old('making_charge_type') == 'flat' ? 'selected' : '' }}>Flat / Fixed Amount</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-bold">Making Charge Rate (₹)</label>
                            <div class="input-group">
                                <span class="input-group-text">₹</span>
                                <input type="number" step="0.01" class="form-control" name="making_charge_rate" id="making_charge_rate" value="{{ old('making_charge_rate', '450.00') }}">
                            </div>
                            <small class="text-muted">Karigar making charges payable upon completion</small>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-bold">Special Instructions for Karigar</label>
                            <textarea class="form-control" name="instructions" rows="3" placeholder="Provide precise guidelines, hallmark requirements, rhodium polish, finish type, size tolerances, etc.">{{ old('instructions', $order->specifications) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mb-5">
                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-outline-secondary px-4">Cancel</a>
                <button type="submit" class="btn btn-primary px-5 shadow-sm">
                    <i class="fa fa-check me-1"></i> Confirm & Issue Metal to Karigar
                </button>
            </div>
        </form>

    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const metalInput = document.getElementById('metal_issued_weight');
    const wastageInput = document.getElementById('allowed_wastage_percent');
    const wastageDisplay = document.getElementById('allowed_wastage_display');

    function updateWastage() {
        const metal = parseFloat(metalInput.value) || 0;
        const percent = parseFloat(wastageInput.value) || 0;
        const allowedWeight = metal * (percent / 100);
        wastageDisplay.innerText = allowedWeight.toFixed(3) + ' g';
    }

    if (metalInput && wastageInput) {
        metalInput.addEventListener('input', updateWastage);
        wastageInput.addEventListener('input', updateWastage);
        updateWastage();
    }
});
</script>
@endsection
