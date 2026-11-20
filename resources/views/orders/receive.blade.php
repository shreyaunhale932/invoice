<?php $page = 'orders'; ?>
@extends('layout.mainlayout')

@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Receive Finished Jewellery from Karigar</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Orders</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('orders.show', $order->id) }}">{{ $order->order_no }}</a></li>
                        <li class="breadcrumb-item active">Receive from Karigar</li>
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

        <!-- Assignment Summary Banner -->
        <div class="card shadow-sm border-0 mb-4 bg-light border-start border-primary border-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-7">
                        <span class="badge bg-primary mb-1">Voucher: {{ $assignment->assignment_no }}</span>
                        <h4 class="text-dark fw-bold mb-1">{{ $order->item_name }} ({{ $order->order_no }})</h4>
                        <div class="text-muted small">
                            <strong>Karigar:</strong> {{ $assignment->karigar ? $assignment->karigar->name : 'N/A' }} ({{ $assignment->karigar ? ($assignment->karigar->code ?: 'KG-' . $assignment->karigar->id) : '' }}) |
                            <strong>Assigned Date:</strong> {{ $assignment->assigned_date ? $assignment->assigned_date->format('d M Y') : '-' }} |
                            <strong>Customer:</strong> {{ $order->customer ? $order->customer->name : 'Walk-in Customer' }}
                        </div>
                    </div>
                    <div class="col-md-5 text-md-end mt-3 mt-md-0">
                        <div class="d-inline-block bg-white p-2 rounded border text-start me-2">
                            <span class="text-muted small d-block">Metal Issued:</span>
                            <span class="fs-5 fw-bold text-danger" id="base_issued_wt">{{ number_format($assignment->metal_issued_weight, 3) }}</span> <span class="small">g</span>
                        </div>
                        <div class="d-inline-block bg-white p-2 rounded border text-start">
                            <span class="text-muted small d-block">Allowed Wastage ({{ $assignment->allowed_wastage_percent }}%):</span>
                            <span class="fs-5 fw-bold text-muted" id="base_allowed_wastage">{{ number_format($assignment->allowed_wastage_weight, 3) }}</span> <span class="small">g</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{ route('orders.receive.store', $order->id) }}" method="POST">
            @csrf
            <input type="hidden" name="karigar_assignment_id" value="{{ $assignment->id }}">

            <div class="row">
                <!-- Left: Form Inputs -->
                <div class="col-lg-7">
                    <!-- Section 1: Receipt Meta -->
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-white border-bottom">
                            <h5 class="card-title mb-0 text-primary">
                                <i class="fa fa-receipt me-2"></i>Receipt Details
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Receipt Voucher No <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="receipt_no" value="{{ old('receipt_no', $suggestedRecNo) }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Received Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="received_date" value="{{ old('received_date', date('Y-m-d')) }}" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 2: Finished Jewellery Weights & Scrap Returned -->
                    <div class="card shadow-sm border-0 mb-4 border-start border-success border-4">
                        <div class="card-header bg-white border-bottom">
                            <h5 class="card-title mb-0 text-success">
                                <i class="fa fa-balance-scale me-2"></i>Weights Received from Karigar
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Finished Gross Weight (g) <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="number" step="0.001" class="form-control calc-in fs-5 fw-bold" name="finished_gross_weight" id="finished_gross_weight" value="{{ old('finished_gross_weight', $order->expected_gross_weight > 0 ? $order->expected_gross_weight : '') }}" placeholder="0.000" required>
                                        <span class="input-group-text">g</span>
                                    </div>
                                    <small class="text-muted">Total weight of finished item including stones/enamel</small>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Finished Net Weight (Metal) <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="number" step="0.001" class="form-control calc-in fs-5 fw-bold text-success" name="finished_net_weight" id="finished_net_weight" value="{{ old('finished_net_weight', $order->expected_net_weight > 0 ? $order->expected_net_weight : '') }}" placeholder="0.000" required>
                                        <span class="input-group-text fw-bold">g</span>
                                    </div>
                                    <small class="text-muted">Pure metal weight in the finished ornament</small>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold">Embedded Stones / CZ Weight (g)</label>
                                    <div class="input-group">
                                        <input type="number" step="0.001" class="form-control calc-in" name="stones_weight" id="stones_weight" value="{{ old('stones_weight', '0.000') }}">
                                        <span class="input-group-text">g</span>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold">Stones / Diamonds Pieces</label>
                                    <input type="number" class="form-control" name="stones_pieces" value="{{ old('stones_pieces', $assignment->stones_issued_pieces ?: 0) }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold">Scrap Metal Returned (g)</label>
                                    <div class="input-group">
                                        <input type="number" step="0.001" class="form-control calc-in fs-5 fw-bold text-info" name="scrap_metal_returned" id="scrap_metal_returned" value="{{ old('scrap_metal_returned', '0.000') }}" placeholder="0.000">
                                        <span class="input-group-text">g</span>
                                    </div>
                                    <small class="text-muted">Unused gold/scrap brought back</small>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Scrap Purity / Remarks</label>
                                    <input type="text" class="form-control" name="scrap_purity" value="{{ old('scrap_purity', $assignment->metal_issued_purity) }}" placeholder="e.g. 22K Scrap, Dust/Filings">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Hallmark / HUID Code</label>
                                    <input type="text" class="form-control" name="huid" value="{{ old('huid') }}" placeholder="e.g. ABC123">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 3: Making Charges & Quality Check -->
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-white border-bottom">
                            <h5 class="card-title mb-0 text-primary">
                                <i class="fa fa-coins me-2"></i>Karigar Making Charges & QC
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold">Making Charge Type</label>
                                    <select name="making_charge_type" id="making_charge_type" class="form-select calc-in">
                                        <option value="per_gram" {{ old('making_charge_type', $assignment->making_charge_type) == 'per_gram' ? 'selected' : '' }}>Per Gram (Net Wt)</option>
                                        <option value="flat" {{ old('making_charge_type', $assignment->making_charge_type) == 'flat' ? 'selected' : '' }}>Flat Amount</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold">Making Rate (₹)</label>
                                    <div class="input-group">
                                        <span class="input-group-text">₹</span>
                                        <input type="number" step="0.01" class="form-control calc-in" name="making_charge_rate" id="making_charge_rate" value="{{ old('making_charge_rate', $assignment->making_charge_rate) }}">
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold">Other / Polish Charges (₹)</label>
                                    <div class="input-group">
                                        <span class="input-group-text">₹</span>
                                        <input type="number" step="0.01" class="form-control calc-in" name="other_charges" id="other_charges" value="{{ old('other_charges', '0.00') }}">
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold">Quality Check (QC)</label>
                                    <select name="qc_status" class="form-select">
                                        <option value="passed">Passed (Perfect Finish)</option>
                                        <option value="rework">Needs Minor Polish / Rework</option>
                                        <option value="failed">Failed QC</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold">Karigar Payment Status</label>
                                    <select name="payment_status" class="form-select">
                                        <option value="unpaid">Unpaid (Pay Later)</option>
                                        <option value="paid">Paid Now</option>
                                        <option value="adjusted">Adjusted in Ledger</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold">Payment Mode</label>
                                    <select name="payment_mode" class="form-select">
                                        <option value="Cash">Cash</option>
                                        <option value="UPI">UPI / Bank</option>
                                        <option value="Ledger Adjustment">Ledger Adjustment</option>
                                    </select>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label fw-bold">QC Notes / Remarks</label>
                                    <textarea class="form-control" name="remarks" rows="2" placeholder="Quality inspection remarks, finish quality, stone security check, etc.">{{ old('remarks') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Live Automated Settlement & Wastage Analysis Card -->
                <div class="col-lg-5">
                    <div class="card shadow-sm border-0 sticky-top" style="top: 20px;">
                        <div class="card-header bg-dark text-white">
                            <h5 class="card-title mb-0 text-white">
                                <i class="fa fa-calculator me-2"></i>Live Metal & Wastage Analysis
                            </h5>
                        </div>
                        <div class="card-body">
                            <!-- Metal Accounting Breakdown -->
                            <h6 class="text-muted text-uppercase small fw-bold mb-3">Metal Accounting</h6>

                            <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                <span class="text-muted">1. Metal Issued to Karigar:</span>
                                <span class="fw-bold text-danger fs-6">{{ number_format($assignment->metal_issued_weight, 3) }} g</span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                <span class="text-muted">2. Finished Net Weight (Ornament):</span>
                                <span class="fw-bold text-success fs-6" id="disp_net_wt">0.000 g</span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                <span class="text-muted">3. Scrap Metal Returned:</span>
                                <span class="fw-bold text-info fs-6" id="disp_scrap_wt">0.000 g</span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center py-2 border-bottom bg-light px-2 rounded">
                                <span class="fw-bold text-dark">Total Accounted Metal (2 + 3):</span>
                                <span class="fw-bold text-dark fs-6" id="disp_total_accounted">0.000 g</span>
                            </div>

                            <!-- Wastage Analysis -->
                            <h6 class="text-muted text-uppercase small fw-bold mt-4 mb-2">Wastage & Loss Verification</h6>

                            <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                <span class="text-muted">Actual Wastage (Issued - Accounted):</span>
                                <span class="fw-bold text-warning fs-6" id="disp_actual_wastage">0.000 g</span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                <span class="text-muted">Allowed Wastage ({{ $assignment->allowed_wastage_percent }}%):</span>
                                <span class="text-muted fs-6">{{ number_format($assignment->allowed_wastage_weight, 3) }} g</span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center py-3 border-bottom px-2 rounded" id="variance_box">
                                <span class="fw-bold text-dark">Wastage Difference:</span>
                                <span class="fw-bold fs-5" id="disp_wastage_diff">0.000 g</span>
                            </div>
                            <small class="text-muted d-block mt-1 mb-3" id="variance_explanation">
                                Calculated difference between actual workshop loss and permitted wastage.
                            </small>

                            <!-- Making Charges -->
                            <h6 class="text-muted text-uppercase small fw-bold mt-4 mb-2">Karigar Making Charges Payable</h6>

                            <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                <span class="text-muted">Base Making Charges:</span>
                                <span class="fw-bold text-dark" id="disp_base_making">₹0.00</span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                <span class="text-muted">Other / Polish Charges:</span>
                                <span class="fw-bold text-dark" id="disp_other_charges">₹0.00</span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center pt-3">
                                <span class="fw-bold text-dark fs-6">Total Payable to Karigar:</span>
                                <span class="fw-bold text-primary fs-4" id="disp_total_payable">₹0.00</span>
                            </div>

                            <div class="mt-4 pt-2">
                                <button type="submit" class="btn btn-success w-100 py-3 fs-6 fw-bold shadow-sm">
                                    <i class="fa fa-check-circle me-2"></i> Confirm & Accept from Karigar
                                </button>
                                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-outline-secondary w-100 mt-2">
                                    Cancel
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const issuedWeight = {{ (float)$assignment->metal_issued_weight }};
    const allowedWastage = {{ (float)$assignment->allowed_wastage_weight }};

    const netInput = document.getElementById('finished_net_weight');
    const grossInput = document.getElementById('finished_gross_weight');
    const stonesInput = document.getElementById('stones_weight');
    const scrapInput = document.getElementById('scrap_metal_returned');
    const makingTypeSelect = document.getElementById('making_charge_type');
    const makingRateInput = document.getElementById('making_charge_rate');
    const otherChargesInput = document.getElementById('other_charges');

    // Automatically calculate Net = Gross - Stones if stones entered
    if (grossInput && stonesInput && netInput) {
        stonesInput.addEventListener('input', function() {
            const gross = parseFloat(grossInput.value) || 0;
            const stones = parseFloat(stonesInput.value) || 0;
            if (gross > 0 && stones > 0) {
                netInput.value = Math.max(0, gross - stones).toFixed(3);
                recalculate();
            }
        });
    }

    function recalculate() {
        const net = parseFloat(netInput.value) || 0;
        const scrap = parseFloat(scrapInput.value) || 0;
        const totalAccounted = net + scrap;
        const actualWastage = Math.max(0, issuedWeight - totalAccounted);
        const wastageDiff = actualWastage - allowedWastage;

        // Making charges
        const makingType = makingTypeSelect.value;
        const makingRate = parseFloat(makingRateInput.value) || 0;
        const otherCharges = parseFloat(otherChargesInput.value) || 0;

        let baseMaking = 0;
        if (makingType === 'per_gram') {
            baseMaking = net * makingRate;
        } else {
            baseMaking = makingRate;
        }
        const totalPayable = baseMaking + otherCharges;

        // Update displays
        document.getElementById('disp_net_wt').innerText = net.toFixed(3) + ' g';
        document.getElementById('disp_scrap_wt').innerText = scrap.toFixed(3) + ' g';
        document.getElementById('disp_total_accounted').innerText = totalAccounted.toFixed(3) + ' g';
        document.getElementById('disp_actual_wastage').innerText = actualWastage.toFixed(3) + ' g';

        const diffElem = document.getElementById('disp_wastage_diff');
        const varianceBox = document.getElementById('variance_box');
        const explanation = document.getElementById('variance_explanation');

        if (wastageDiff > 0.001) {
            diffElem.innerText = '+' + wastageDiff.toFixed(3) + ' g (Loss)';
            diffElem.className = 'fw-bold fs-5 text-danger';
            varianceBox.style.background = '#ffe5e5';
            explanation.innerText = '⚠️ Excess wastage by ' + wastageDiff.toFixed(3) + 'g above the agreed ' + allowedWastage.toFixed(3) + 'g limit.';
        } else {
            diffElem.innerText = wastageDiff.toFixed(3) + ' g (Within Limit)';
            diffElem.className = 'fw-bold fs-5 text-success';
            varianceBox.style.background = '#e8f7ee';
            explanation.innerText = '✅ Metal wastage is strictly within the allowed limit of ' + allowedWastage.toFixed(3) + 'g.';
        }

        document.getElementById('disp_base_making').innerText = '₹' + baseMaking.toLocaleString('en-IN', {minimumFractionDigits: 2, maximumFractionDigits: 2});
        document.getElementById('disp_other_charges').innerText = '₹' + otherCharges.toLocaleString('en-IN', {minimumFractionDigits: 2, maximumFractionDigits: 2});
        document.getElementById('disp_total_payable').innerText = '₹' + totalPayable.toLocaleString('en-IN', {minimumFractionDigits: 2, maximumFractionDigits: 2});
    }

    document.querySelectorAll('.calc-in').forEach(elem => {
        elem.addEventListener('input', recalculate);
        elem.addEventListener('change', recalculate);
    });

    recalculate();
});
</script>
@endsection
