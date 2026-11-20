<?php $page = 'orders'; ?>
@extends('layout.mainlayout')

@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Order {{ $order->order_no }}</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Orders</a></li>
                        <li class="breadcrumb-item active">{{ $order->order_no }}</li>
                    </ul>
                </div>
                <div class="col-auto d-flex gap-2">
                    <a href="{{ route('orders.print', $order->id) }}" target="_blank" class="btn btn-outline-primary">
                        <i class="fa fa-print me-1"></i> Print Order Sheet
                    </a>
                    @if($order->status != 'delivered')
                        <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-outline-secondary">
                            <i class="fa fa-edit me-1"></i> Edit
                        </a>
                    @endif
                    <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary">
                        <i class="fa fa-arrow-left me-1"></i> Back to Orders
                    </a>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fa fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Visual Workflow Progress Bar -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
                    <div>
                        <span class="text-muted small fw-bold text-uppercase">Current Workflow Stage:</span>
                        <h4 class="mb-0 mt-1">
                            {!! $order->status_badge !!}
                            <span class="ms-2">{!! $order->priority_badge !!}</span>
                        </h4>
                    </div>
                    <div>
                        <!-- Primary Workflow Action Buttons -->
                        @if($order->status == 'pending')
                            <a href="{{ route('orders.assign.create', $order->id) }}" class="btn btn-primary px-4 shadow-sm">
                                <i class="fa fa-user-plus me-2"></i> Assign to Karigar Now
                            </a>
                        @elseif(in_array($order->status, ['assigned', 'in_progress']))
                            <a href="{{ route('orders.receive.create', $order->id) }}" class="btn btn-success px-4 shadow-sm">
                                <i class="fa fa-inbox me-2"></i> Receive Finished Jewellery
                            </a>
                        @elseif($order->status == 'received')
                            <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Mark this order as Delivered to the customer?');">
                                @csrf
                                <input type="hidden" name="status" value="delivered">
                                <button type="submit" class="btn btn-dark px-4 shadow-sm">
                                    <i class="fa fa-gift me-2"></i> Mark as Delivered to Customer
                                </button>
                            </form>
                        @endif
                    </div>
                </div>

                <!-- Step Tracker -->
                <style>
                    .step-tracker {
                        display: flex;
                        position: relative;
                        justify-content: space-between;
                    }
                    .step-tracker::before {
                        content: '';
                        position: absolute;
                        top: 20px;
                        left: 20px;
                        right: 20px;
                        height: 4px;
                        background: #e9ecef;
                        z-index: 1;
                    }
                    .step-item {
                        position: relative;
                        z-index: 2;
                        text-align: center;
                        flex: 1;
                    }
                    .step-icon {
                        width: 44px;
                        height: 44px;
                        border-radius: 50%;
                        background: #f8f9fa;
                        border: 3px solid #dee2e6;
                        color: #6c757d;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        margin: 0 auto 10px;
                        font-size: 16px;
                        transition: all 0.3s;
                    }
                    .step-item.completed .step-icon {
                        background: #198754;
                        border-color: #198754;
                        color: #fff;
                    }
                    .step-item.active .step-icon {
                        background: #0d6efd;
                        border-color: #0d6efd;
                        color: #fff;
                        box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.2);
                    }
                    .step-title {
                        font-weight: 600;
                        font-size: 14px;
                        margin-bottom: 2px;
                    }
                    .step-desc {
                        font-size: 12px;
                        color: #6c757d;
                    }
                </style>

                @php
                    $isBooked = true;
                    $isAssigned = in_array($order->status, ['assigned', 'in_progress', 'received', 'delivered']);
                    $isReceived = in_array($order->status, ['received', 'delivered']);
                    $isDelivered = ($order->status == 'delivered');
                @endphp

                <div class="step-tracker">
                    <!-- Step 1 -->
                    <div class="step-item {{ $isBooked ? 'completed' : '' }}">
                        <div class="step-icon"><i class="fa fa-file-invoice"></i></div>
                        <div class="step-title">1. Order Created</div>
                        <div class="step-desc">{{ $order->order_date ? $order->order_date->format('d M Y') : '-' }}</div>
                    </div>

                    <!-- Step 2 -->
                    <div class="step-item {{ $isAssigned ? ($isReceived ? 'completed' : 'active') : '' }}">
                        <div class="step-icon"><i class="fa fa-user-cog"></i></div>
                        <div class="step-title">2. Assigned to Karigar</div>
                        <div class="step-desc">
                            @if($order->karigar)
                                {{ $order->karigar->name }}
                                @if($order->latestAssignment)
                                    ({{ number_format($order->latestAssignment->metal_issued_weight, 3) }}g)
                                @endif
                            @else
                                Ready to assign
                            @endif
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="step-item {{ $isReceived ? ($isDelivered ? 'completed' : 'active') : '' }}">
                        <div class="step-icon"><i class="fa fa-check-circle"></i></div>
                        <div class="step-title">3. Received from Karigar</div>
                        <div class="step-desc">
                            @if($activeReceipt)
                                Net: {{ number_format($activeReceipt->finished_net_weight, 3) }}g
                            @else
                                Awaiting workshop
                            @endif
                        </div>
                    </div>

                    <!-- Step 4 -->
                    <div class="step-item {{ $isDelivered ? 'completed' : '' }}">
                        <div class="step-icon"><i class="fa fa-gift"></i></div>
                        <div class="step-title">4. Delivered to Customer</div>
                        <div class="step-desc">
                            {{ $isDelivered ? 'Delivered' : 'Promised ' . ($order->due_date ? $order->due_date->format('d M') : 'TBD') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Left Column: Jewellery & Specifications -->
            <div class="col-lg-7">
                <!-- Item Card -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0 text-primary">
                            <i class="fa fa-gem me-2"></i>Jewellery Item & Specifications
                        </h5>
                        @if($order->design_code)
                            <span class="badge bg-light text-dark border">Ref: {{ $order->design_code }}</span>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center mb-4">
                            @if($order->image)
                                <div class="col-sm-4 text-center mb-3 mb-sm-0">
                                    <a href="{{ asset($order->image) }}" target="_blank">
                                        <img src="{{ asset($order->image) }}" class="img-fluid rounded border shadow-sm" style="max-height: 180px; width: 100%; object-fit: contain;" alt="Design Photo">
                                    </a>
                                    <small class="text-muted d-block mt-1">Click to view full image</small>
                                </div>
                            @endif
                            <div class="{{ $order->image ? 'col-sm-8' : 'col-12' }}">
                                <h4 class="text-dark fw-bold mb-1">{{ $order->item_name }}</h4>
                                <div class="text-muted mb-3">
                                    @if($order->category)
                                        <span class="badge bg-light text-primary border me-1">{{ $order->category->category_name }}</span>
                                    @endif
                                    @if($order->subcategory)
                                        <span class="badge bg-light text-secondary border me-1">{{ $order->subcategory->subcategory_name }}</span>
                                    @endif
                                    <span class="badge bg-light text-dark border">{{ $order->metal_type }} {{ $order->purity }}</span>
                                </div>

                                <div class="row g-2">
                                    <div class="col-6">
                                        <div class="bg-light p-2 rounded">
                                            <span class="text-muted small d-block">Expected Net Weight:</span>
                                            <span class="fs-5 fw-bold text-dark">{{ number_format($order->expected_net_weight, 3) }} g</span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="bg-light p-2 rounded">
                                            <span class="text-muted small d-block">Expected Gross Weight:</span>
                                            <span class="fs-5 fw-bold text-dark">{{ number_format($order->expected_gross_weight, 3) }} g</span>
                                        </div>
                                    </div>
                                    @if($order->size)
                                        <div class="col-12">
                                            <div class="bg-light p-2 rounded">
                                                <span class="text-muted small d-block">Size / Dimensions:</span>
                                                <span class="fw-bold text-dark">{{ $order->size }}</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        @if($order->specifications)
                            <div class="alert alert-light border mb-0">
                                <h6 class="fw-bold text-primary mb-1"><i class="fa fa-info-circle me-1"></i>Special Customization Instructions:</h6>
                                <p class="mb-0 text-dark" style="white-space: pre-line;">{{ $order->specifications }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Karigar Material Issue / Assignment Card -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0 text-primary">
                            <i class="fa fa-user-cog me-2"></i>Karigar Assignment & Material Issued
                        </h5>
                        @if($activeAssignment)
                            <a href="{{ route('orders.assignments.print', $activeAssignment->id) }}" target="_blank" class="btn btn-sm btn-outline-secondary">
                                <i class="fa fa-print me-1"></i> Job Card
                            </a>
                        @endif
                    </div>
                    <div class="card-body">
                        @if($activeAssignment)
                            <div class="row align-items-center mb-3">
                                <div class="col-sm-6">
                                    <span class="text-muted small d-block">Assigned Karigar:</span>
                                    <h5 class="fw-bold text-dark mb-0">
                                        <a href="{{ route('karigars.show', $activeAssignment->karigar_id) }}" class="text-decoration-none text-primary">
                                            {{ $activeAssignment->karigar ? $activeAssignment->karigar->name : 'Karigar' }}
                                        </a>
                                    </h5>
                                    <small class="text-muted">
                                        {{ $activeAssignment->karigar && $activeAssignment->karigar->shop_name ? $activeAssignment->karigar->shop_name . ' | ' : '' }}
                                        {{ $activeAssignment->karigar ? $activeAssignment->karigar->phone : '' }}
                                    </small>
                                </div>
                                <div class="col-sm-6 text-sm-end mt-2 mt-sm-0">
                                    <span class="badge bg-info text-white p-2">{{ $activeAssignment->assignment_no }}</span>
                                    <div class="small text-muted mt-1">
                                        Assigned on: {{ $activeAssignment->assigned_date ? $activeAssignment->assigned_date->format('d M Y') : '-' }}
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Raw Material Issued</th>
                                            <th class="text-end">Issued Wt</th>
                                            <th class="text-end">Allowed Wastage</th>
                                            <th class="text-end">Karigar Making Rate</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <strong>{{ $activeAssignment->metal_issued_type }}</strong>
                                                @if($activeAssignment->metal_issued_purity)
                                                    <span class="text-muted">({{ $activeAssignment->metal_issued_purity }})</span>
                                                @endif
                                                @if($activeAssignment->stones_issued_weight > 0)
                                                    <div class="small text-muted">
                                                        + Stones: {{ number_format($activeAssignment->stones_issued_weight, 3) }}g ({{ $activeAssignment->stones_issued_pieces }} pcs)
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="text-end fw-bold text-danger">{{ number_format($activeAssignment->metal_issued_weight, 3) }} g</td>
                                            <td class="text-end text-muted">
                                                {{ number_format($activeAssignment->allowed_wastage_weight, 3) }} g ({{ $activeAssignment->allowed_wastage_percent }}%)
                                            </td>
                                            <td class="text-end fw-bold">
                                                ₹{{ number_format($activeAssignment->making_charge_rate, 2) }}
                                                <small class="text-muted">{{ $activeAssignment->making_charge_type == 'per_gram' ? '/g' : 'flat' }}</small>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            @if($activeAssignment->instructions)
                                <div class="mt-3 small text-muted">
                                    <strong>Karigar Instructions:</strong> {{ $activeAssignment->instructions }}
                                </div>
                            @endif

                            @if($order->status == 'assigned')
                                <div class="mt-3 text-end">
                                    <a href="{{ route('orders.receive.create', $order->id) }}" class="btn btn-success">
                                        <i class="fa fa-inbox me-1"></i> Receive Finished Jewellery From Karigar
                                    </a>
                                </div>
                            @endif
                        @else
                            <div class="text-center py-4 text-muted">
                                <i class="fa fa-user-plus fa-2x mb-2 text-secondary opacity-50"></i>
                                <p class="mb-2">This order has not been assigned to a Karigar yet.</p>
                                <a href="{{ route('orders.assign.create', $order->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-user-plus me-1"></i> Assign to Karigar Now
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Finished Jewellery Receipt Card (if received) -->
                @if($activeReceipt)
                    <div class="card shadow-sm border-0 mb-4 border-start border-success border-4">
                        <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0 text-success">
                                <i class="fa fa-check-double me-2"></i>Karigar Finished Jewellery Receipt
                            </h5>
                            <a href="{{ route('orders.receipts.print', $activeReceipt->id) }}" target="_blank" class="btn btn-sm btn-outline-secondary">
                                <i class="fa fa-print me-1"></i> Receipt Slip
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <span class="text-muted small d-block">Received From:</span>
                                    <h6 class="fw-bold text-dark">{{ $activeReceipt->karigar ? $activeReceipt->karigar->name : '-' }}</h6>
                                    <small class="text-muted">Received Date: {{ $activeReceipt->received_date ? $activeReceipt->received_date->format('d M Y') : '-' }}</small>
                                </div>
                                <div class="col-sm-6 text-sm-end">
                                    <span class="badge bg-success p-2">{{ $activeReceipt->receipt_no }}</span>
                                    @if($activeReceipt->huid)
                                        <div class="small mt-1"><strong>HUID / Hallmark:</strong> {{ $activeReceipt->huid }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-end">Finished Net Wt</th>
                                            <th class="text-end">Finished Gross Wt</th>
                                            <th class="text-end">Scrap Returned</th>
                                            <th class="text-end">Actual Wastage</th>
                                            <th class="text-end">Wastage Variance</th>
                                            <th class="text-end">Total Making Charges</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-end fw-bold text-success fs-6">{{ number_format($activeReceipt->finished_net_weight, 3) }} g</td>
                                            <td class="text-end">{{ number_format($activeReceipt->finished_gross_weight, 3) }} g</td>
                                            <td class="text-end text-info">{{ number_format($activeReceipt->scrap_metal_returned, 3) }} g</td>
                                            <td class="text-end text-warning">{{ number_format($activeReceipt->actual_wastage, 3) }} g</td>
                                            <td class="text-end">
                                                @if($activeReceipt->wastage_difference > 0)
                                                    <span class="badge bg-danger">+{{ number_format($activeReceipt->wastage_difference, 3) }} g (Loss)</span>
                                                @else
                                                    <span class="badge bg-success">{{ number_format($activeReceipt->wastage_difference, 3) }} g (OK)</span>
                                                @endif
                                            </td>
                                            <td class="text-end fw-bold fs-6">₹{{ number_format($activeReceipt->total_making_charges, 2) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            @if($activeReceipt->remarks)
                                <div class="mt-2 small text-muted">
                                    <strong>QC / Remarks:</strong> {{ $activeReceipt->remarks }} (QC: <span class="badge bg-light text-dark border">{{ ucfirst($activeReceipt->qc_status) }}</span>)
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            </div>

            <!-- Right Column: Customer Info & Financials -->
            <div class="col-lg-5">
                <!-- Customer Profile Card -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="card-title mb-0 text-primary">
                            <i class="fa fa-user me-2"></i>Customer Information
                        </h5>
                    </div>
                    <div class="card-body">
                        @if($order->customer)
                            <div class="d-flex align-items-center mb-3">
                                <div class="avatar avatar-md bg-light-primary text-primary rounded-circle me-3 d-flex align-items-center justify-content-center fw-bold fs-5">
                                    {{ strtoupper(substr($order->customer->name, 0, 1)) }}
                                </div>
                                <div>
                                    <h5 class="mb-0 text-dark">{{ $order->customer->name }}</h5>
                                    <div class="text-muted small">{{ $order->customer->phone ?: 'No phone' }}</div>
                                </div>
                            </div>
                            <div class="small">
                                <div class="mb-1"><strong>Email:</strong> {{ $order->customer->email ?: '-' }}</div>
                                <div class="mb-1"><strong>Address:</strong> {{ $order->customer->address ?: '-' }} {{ $order->customer->city ? ', ' . $order->customer->city : '' }}</div>
                                @if($order->customer->gst_no)
                                    <div class="mb-1"><strong>GST:</strong> {{ $order->customer->gst_no }}</div>
                                @endif
                            </div>
                        @else
                            <p class="text-muted mb-0">Walk-in Customer</p>
                        @endif
                    </div>
                </div>

                <!-- Financial Estimation Card -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="card-title mb-0 text-primary">
                            <i class="fa fa-coins me-2"></i>Order Financials & Advance
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                            <span class="text-muted">Estimated Metal Rate:</span>
                            <span class="fw-bold">₹{{ number_format($order->estimated_rate, 2) }} /g</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                            <span class="text-muted">Estimated Making Charges:</span>
                            <span class="fw-bold">₹{{ number_format($order->estimated_making_charges, 2) }}</span>
                        </div>
                        @if($order->estimated_other_charges > 0)
                            <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                <span class="text-muted">Other / Stone Charges:</span>
                                <span class="fw-bold">₹{{ number_format($order->estimated_other_charges, 2) }}</span>
                            </div>
                        @endif
                        <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                            <span class="fw-bold text-dark fs-6">Estimated Total Amount:</span>
                            <span class="fw-bold text-primary fs-5">₹{{ number_format($order->estimated_total_amount, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                            <div>
                                <span class="text-success fw-bold">Advance Paid:</span>
                                @if($order->advance_payment_mode)
                                    <span class="badge bg-light text-muted border ms-1">{{ $order->advance_payment_mode }}</span>
                                @endif
                            </div>
                            <span class="fw-bold text-success fs-6">- ₹{{ number_format($order->advance_amount, 2) }}</span>
                        </div>
                        @if($order->advance_metal_weight > 0)
                            <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                <span class="text-muted">Old Metal Advance Deposited:</span>
                                <span class="fw-bold text-info">{{ number_format($order->advance_metal_weight, 3) }} g</span>
                            </div>
                        @endif
                        <div class="d-flex justify-content-between align-items-center pt-3">
                            <span class="fw-bold text-dark fs-6">Estimated Balance Due:</span>
                            <span class="fw-bold text-danger fs-4">₹{{ number_format($order->balance_amount, 2) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Delivery Schedule Card -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="card-title mb-0 text-primary">
                            <i class="fa fa-calendar-alt me-2"></i>Schedule & Important Dates
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <span class="text-muted small d-block">Order Placed Date:</span>
                            <span class="fw-bold">{{ $order->order_date ? $order->order_date->format('l, d F Y') : '-' }}</span>
                        </div>
                        <div class="mb-3">
                            <span class="text-muted small d-block">Promised Customer Delivery Date:</span>
                            <span class="fw-bold fs-6 {{ $order->due_date && $order->due_date->isPast() && !in_array($order->status, ['delivered', 'cancelled']) ? 'text-danger' : 'text-dark' }}">
                                {{ $order->due_date ? $order->due_date->format('l, d F Y') : 'Not specified' }}
                            </span>
                            @if($order->due_date && $order->due_date->isPast() && !in_array($order->status, ['delivered', 'cancelled']))
                                <div class="badge bg-danger mt-1">Delivery is Overdue</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
