<?php $page = 'karigars'; ?>
@extends('layout.mainlayout')

@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">{{ $karigar->name }}</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('karigars.index') }}">Karigars</a></li>
                        <li class="breadcrumb-item active">{{ $karigar->code ?: 'KG-' . $karigar->id }}</li>
                    </ul>
                </div>
                <div class="col-auto">
                    <a href="{{ route('karigars.ledger', $karigar->id) }}" class="btn btn-outline-info me-2">
                        <i class="fas fa-book me-1"></i> Metal Ledger
                    </a>
                    <a href="{{ route('karigars.edit', $karigar->id) }}" class="btn btn-primary me-2">
                        <i class="fa fa-edit me-1"></i> Edit Karigar
                    </a>
                    <a href="{{ route('karigars.index') }}" class="btn btn-outline-secondary">
                        <i class="fa fa-arrow-left me-1"></i> Back
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

        <!-- Profile Top Banner & Stat Cards -->
        <div class="row mb-4">
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="avatar avatar-xl bg-light-primary text-primary rounded-circle me-3 d-flex align-items-center justify-content-center fs-3 fw-bold">
                                {{ strtoupper(substr($karigar->name, 0, 1)) }}
                            </div>
                            <div>
                                <h4 class="mb-1 text-dark">{{ $karigar->name }}</h4>
                                <span class="badge bg-primary me-1">{{ $karigar->code ?: 'KG-' . $karigar->id }}</span>
                                @if($karigar->status == 'active')
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                                @if($karigar->speciality)
                                    <div class="text-muted mt-1 small"><i class="fa fa-gem me-1 text-warning"></i>{{ $karigar->speciality }}</div>
                                @endif
                            </div>
                        </div>

                        <hr class="text-muted opacity-25">

                        <div class="mb-2">
                            <span class="text-muted small d-block">Shop / Workshop:</span>
                            <span class="fw-bold">{{ $karigar->shop_name ?: 'Individual Artisan' }}</span>
                        </div>
                        <div class="mb-2">
                            <span class="text-muted small d-block">Phone:</span>
                            <span class="fw-bold">{{ $karigar->phone ?: '-' }}</span>
                        </div>
                        <div class="mb-2">
                            <span class="text-muted small d-block">Email:</span>
                            <span>{{ $karigar->email ?: '-' }}</span>
                        </div>
                        <div class="mb-2">
                            <span class="text-muted small d-block">Address:</span>
                            <span>{{ $karigar->address ?: '-' }} {{ $karigar->city ? ', ' . $karigar->city : '' }} {{ $karigar->state ? ', ' . $karigar->state : '' }}</span>
                        </div>

                        @if($karigar->bank_name || $karigar->account_number)
                            <hr class="text-muted opacity-25">
                            <h6 class="text-muted text-uppercase fs-7 fw-bold mb-2">Bank Details</h6>
                            <div class="small">
                                <div><strong>Bank:</strong> {{ $karigar->bank_name ?: '-' }} ({{ $karigar->branch ?: '-' }})</div>
                                <div><strong>A/C No:</strong> {{ $karigar->account_number ?: '-' }}</div>
                                <div><strong>IFSC:</strong> {{ $karigar->ifsc_code ?: '-' }}</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Metal Balance & Performance Summary -->
            <div class="col-xl-8 col-lg-7">
                <div class="row g-3 mb-3">
                    <div class="col-sm-6">
                        <div class="card bg-white shadow-sm border-0 border-start border-danger border-4">
                            <div class="card-body">
                                <span class="text-muted small fw-bold text-uppercase">Current Metal in Hand</span>
                                <h3 class="mb-0 text-danger mt-1 fw-bold">
                                    {{ number_format($karigar->current_metal_balance, 3) }} <span class="fs-6 font-weight-normal text-muted">g</span>
                                </h3>
                                <small class="text-muted">Total gold/metal currently in artisan's possession</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card bg-white shadow-sm border-0 border-start border-primary border-4">
                            <div class="card-body">
                                <span class="text-muted small fw-bold text-uppercase">Total Metal Issued</span>
                                <h3 class="mb-0 text-primary mt-1 fw-bold">
                                    {{ number_format($totalIssuedWeight, 3) }} <span class="fs-6 font-weight-normal text-muted">g</span>
                                </h3>
                                <small class="text-muted">All-time material allocated across all jobs</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card bg-white shadow-sm border-0">
                            <div class="card-body">
                                <span class="text-muted small fw-bold">Finished Wt Received</span>
                                <h4 class="mb-0 text-success mt-1 fw-bold">
                                    {{ number_format($totalReceivedWeight, 3) }} g
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card bg-white shadow-sm border-0">
                            <div class="card-body">
                                <span class="text-muted small fw-bold">Scrap Metal Returned</span>
                                <h4 class="mb-0 text-info mt-1 fw-bold">
                                    {{ number_format($totalScrapReturned, 3) }} g
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card bg-white shadow-sm border-0">
                            <div class="card-body">
                                <span class="text-muted small fw-bold">Actual Wastage</span>
                                <h4 class="mb-0 text-warning mt-1 fw-bold">
                                    {{ number_format($totalWastage, 3) }} g
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>

                @if($karigar->notes)
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-body py-2">
                            <small class="text-muted fw-bold">Notes:</small>
                            <p class="mb-0 text-muted">{{ $karigar->notes }}</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Ongoing Works & History Tabs -->
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-bottom">
                <ul class="nav nav-tabs card-header-tabs" id="karigarTabs" role="tablist">
                    <li class="nav-item">
                        <button class="nav-link active" id="active-jobs-tab" data-bs-toggle="tab" data-bs-target="#active-jobs" type="button" role="tab">
                            <i class="fa fa-spinner me-1 text-warning"></i> Active Works ({{ $karigar->activeAssignments->count() }})
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" id="completed-jobs-tab" data-bs-toggle="tab" data-bs-target="#completed-jobs" type="button" role="tab">
                            <i class="fa fa-check-circle me-1 text-success"></i> Received & Completed ({{ $karigar->receipts->count() }})
                        </button>
                    </li>
                </ul>
            </div>
            <div class="card-body p-0">
                <div class="tab-content" id="karigarTabsContent">
                    <!-- Tab 1: Active Works -->
                    <div class="tab-pane fade show active" id="active-jobs" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-3">Assignment No</th>
                                        <th>Order No</th>
                                        <th>Customer</th>
                                        <th>Jewellery Item</th>
                                        <th>Assigned Date</th>
                                        <th>Target Date</th>
                                        <th class="text-end">Issued Wt</th>
                                        <th class="text-end">Allowed Wastage</th>
                                        <th class="text-end pe-3">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($karigar->activeAssignments as $asg)
                                        <tr>
                                            <td class="ps-3 fw-bold text-primary">{{ $asg->assignment_no }}</td>
                                            <td>
                                                <a href="{{ route('orders.show', $asg->customer_order_id) }}" class="fw-bold text-dark">
                                                    {{ $asg->order ? $asg->order->order_no : 'N/A' }}
                                                </a>
                                            </td>
                                            <td>{{ $asg->order && $asg->order->customer ? $asg->order->customer->name : '-' }}</td>
                                            <td>{{ $asg->order ? $asg->order->item_name : '-' }}</td>
                                            <td>{{ $asg->assigned_date ? $asg->assigned_date->format('d M Y') : '-' }}</td>
                                            <td>
                                                @if($asg->expected_delivery_date)
                                                    <span class="{{ $asg->expected_delivery_date->isPast() ? 'text-danger fw-bold' : '' }}">
                                                        {{ $asg->expected_delivery_date->format('d M Y') }}
                                                    </span>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="text-end fw-bold text-danger">{{ number_format($asg->metal_issued_weight, 3) }} g</td>
                                            <td class="text-end text-muted">{{ number_format($asg->allowed_wastage_weight, 3) }} g ({{ $asg->allowed_wastage_percent }}%)</td>
                                            <td class="text-end pe-3">
                                                <a href="{{ route('orders.receive.create', $asg->customer_order_id) }}" class="btn btn-sm btn-success">
                                                    <i class="fa fa-inbox me-1"></i> Receive
                                                </a>
                                                <a href="{{ route('orders.assignments.print', $asg->id) }}" target="_blank" class="btn btn-sm btn-outline-secondary" title="Print Job Card">
                                                    <i class="fa fa-print"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center py-4 text-muted">
                                                No ongoing work assigned to this Karigar right now.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Tab 2: Received & Completed -->
                    <div class="tab-pane fade" id="completed-jobs" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-3">Receipt No</th>
                                        <th>Order No</th>
                                        <th>Received Date</th>
                                        <th class="text-end">Finished Net Wt</th>
                                        <th class="text-end">Scrap Returned</th>
                                        <th class="text-end">Actual Wastage</th>
                                        <th class="text-end">Wastage Diff</th>
                                        <th class="text-end">Making Charges</th>
                                        <th class="text-end pe-3">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($karigar->receipts as $rec)
                                        <tr>
                                            <td class="ps-3 fw-bold text-primary">{{ $rec->receipt_no }}</td>
                                            <td>
                                                <a href="{{ route('orders.show', $rec->customer_order_id) }}" class="fw-bold text-dark">
                                                    {{ $rec->order ? $rec->order->order_no : 'N/A' }}
                                                </a>
                                            </td>
                                            <td>{{ $rec->received_date ? $rec->received_date->format('d M Y') : '-' }}</td>
                                            <td class="text-end fw-bold text-success">{{ number_format($rec->finished_net_weight, 3) }} g</td>
                                            <td class="text-end text-info">{{ number_format($rec->scrap_metal_returned, 3) }} g</td>
                                            <td class="text-end text-warning">{{ number_format($rec->actual_wastage, 3) }} g</td>
                                            <td class="text-end">
                                                @if($rec->wastage_difference > 0)
                                                    <span class="badge bg-danger">+{{ number_format($rec->wastage_difference, 3) }} g</span>
                                                @else
                                                    <span class="badge bg-success">{{ number_format($rec->wastage_difference, 3) }} g</span>
                                                @endif
                                            </td>
                                            <td class="text-end fw-bold">₹{{ number_format($rec->total_making_charges, 2) }}</td>
                                            <td class="text-end pe-3">
                                                <a href="{{ route('orders.receipts.print', $rec->id) }}" target="_blank" class="btn btn-sm btn-outline-secondary">
                                                    <i class="fa fa-print me-1"></i> Slip
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center py-4 text-muted">
                                                No completed receipts recorded yet.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
