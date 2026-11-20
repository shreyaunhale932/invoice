<?php $page = 'orders'; ?>
@extends('layout.mainlayout')

@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Customer Orders & Manufacturing</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Orders</li>
                    </ul>
                </div>
                <div class="col-auto">
                    <a href="{{ route('orders.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus-circle me-1"></i> Create New Order
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

        <!-- Summary KPI Cards -->
        <div class="row mb-4">
            <div class="col-xl col-sm-6 col-12">
                <div class="card bg-white shadow-sm border-0">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="text-muted mb-1 small fw-bold">TOTAL ORDERS</p>
                                <h4 class="mb-0 text-primary fw-bold">{{ $totalOrders }}</h4>
                            </div>
                            <div class="avatar avatar-md bg-light-primary rounded-circle">
                                <i class="fa fa-clipboard-list text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl col-sm-6 col-12">
                <div class="card bg-white shadow-sm border-0 border-start border-warning border-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="text-muted mb-1 small fw-bold">READY TO ASSIGN</p>
                                <h4 class="mb-0 text-warning fw-bold">{{ $pendingOrders }}</h4>
                            </div>
                            <div class="avatar avatar-md bg-light-warning rounded-circle">
                                <i class="fa fa-hourglass-start text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl col-sm-6 col-12">
                <div class="card bg-white shadow-sm border-0 border-start border-info border-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="text-muted mb-1 small fw-bold">WITH KARIGAR</p>
                                <h4 class="mb-0 text-info fw-bold">{{ $assignedOrders }}</h4>
                            </div>
                            <div class="avatar avatar-md bg-light-info rounded-circle">
                                <i class="fa fa-tools text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl col-sm-6 col-12">
                <div class="card bg-white shadow-sm border-0 border-start border-success border-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="text-muted mb-1 small fw-bold">RECEIVED (READY)</p>
                                <h4 class="mb-0 text-success fw-bold">{{ $receivedOrders }}</h4>
                            </div>
                            <div class="avatar avatar-md bg-light-success rounded-circle">
                                <i class="fa fa-check-double text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl col-sm-6 col-12">
                <div class="card bg-white shadow-sm border-0 border-start border-dark border-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="text-muted mb-1 small fw-bold">DELIVERED</p>
                                <h4 class="mb-0 text-dark fw-bold">{{ $deliveredOrders }}</h4>
                            </div>
                            <div class="avatar avatar-md bg-light-dark rounded-circle">
                                <i class="fa fa-gift text-dark"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Card -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('orders.index') }}">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-3">
                            <label class="form-label text-muted small fw-bold">Search Order / Customer</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fa fa-search text-muted"></i></span>
                                <input type="text" name="search" class="form-control border-start-0" placeholder="Order No, item, customer..." value="{{ request('search') }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label text-muted small fw-bold">Workflow Status</label>
                            <select name="status" class="form-select">
                                <option value="">All Statuses</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending (Unassigned)</option>
                                <option value="assigned" {{ request('status') == 'assigned' ? 'selected' : '' }}>Assigned to Karigar</option>
                                <option value="received" {{ request('status') == 'received' ? 'selected' : '' }}>Received from Karigar</option>
                                <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Delivered to Customer</option>
                                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label text-muted small fw-bold">Assigned Karigar</label>
                            <select name="karigar_id" class="form-select">
                                <option value="">All Karigars</option>
                                @foreach($karigars as $k)
                                    <option value="{{ $k->id }}" {{ request('karigar_id') == $k->id ? 'selected' : '' }}>
                                        {{ $k->name }} ({{ $k->code ?: 'KG-' . $k->id }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label text-muted small fw-bold">From Date</label>
                            <input type="date" name="from_date" class="form-control" value="{{ request('from_date') }}">
                        </div>
                        <div class="col-md-2 d-flex gap-2">
                            <button type="submit" class="btn btn-primary flex-grow-1">
                                <i class="fa fa-filter me-1"></i> Filter
                            </button>
                            <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary">
                                Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Orders Table Card -->
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-3">Order Details</th>
                                <th>Customer</th>
                                <th>Jewellery Item</th>
                                <th class="text-end">Exp. Net Wt</th>
                                <th>Karigar Status</th>
                                <th class="text-center">Workflow</th>
                                <th class="text-end">Financials</th>
                                <th>Delivery Due</th>
                                <th class="text-end pe-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                                <tr>
                                    <td class="ps-3">
                                        <div class="fw-bold text-primary">
                                            <a href="{{ route('orders.show', $order->id) }}">
                                                {{ $order->order_no }}
                                            </a>
                                        </div>
                                        <div class="small text-muted">
                                            {{ $order->order_date ? $order->order_date->format('d M Y') : '-' }}
                                            {!! $order->priority_badge !!}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="fw-bold text-dark">
                                            {{ $order->customer ? $order->customer->name : 'Walk-in Customer' }}
                                        </div>
                                        @if($order->customer && $order->customer->phone)
                                            <div class="small text-muted"><i class="fa fa-phone me-1"></i>{{ $order->customer->phone }}</div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($order->image)
                                                <img src="{{ asset($order->image) }}" class="rounded me-2 border" style="width: 40px; height: 40px; object-fit: cover;" alt="design">
                                            @else
                                                <div class="rounded me-2 bg-light border d-flex align-items-center justify-content-center text-muted" style="width: 40px; height: 40px;">
                                                    <i class="fa fa-gem"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <span class="fw-bold text-dark">{{ $order->item_name }}</span>
                                                <div class="small text-muted">
                                                    {{ $order->metal_type }} | {{ $order->purity ?: 'Standard' }}
                                                    @if($order->size)
                                                        ({{ $order->size }})
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end fw-bold">
                                        {{ number_format($order->expected_net_weight, 3) }} g
                                        @if($order->expected_gross_weight > $order->expected_net_weight)
                                            <div class="small text-muted">Gr: {{ number_format($order->expected_gross_weight, 3) }}g</div>
                                        @endif
                                    </td>
                                    <td>
                                        @if($order->karigar)
                                            <a href="{{ route('karigars.show', $order->karigar->id) }}" class="fw-bold text-dark text-decoration-none">
                                                <i class="fa fa-user-cog me-1 text-primary"></i>{{ $order->karigar->name }}
                                            </a>
                                            @if($order->latestAssignment)
                                                <div class="small text-muted">Issued: {{ number_format($order->latestAssignment->metal_issued_weight, 3) }}g</div>
                                            @endif
                                        @else
                                            <span class="badge bg-light text-muted border">Unassigned</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {!! $order->status_badge !!}
                                    </td>
                                    <td class="text-end">
                                        <div class="fw-bold text-dark">₹{{ number_format($order->estimated_total_amount, 2) }}</div>
                                        @if($order->advance_amount > 0)
                                            <div class="small text-success">Adv: ₹{{ number_format($order->advance_amount, 2) }}</div>
                                        @endif
                                        @if($order->balance_amount > 0)
                                            <div class="small text-danger">Bal: ₹{{ number_format($order->balance_amount, 2) }}</div>
                                        @endif
                                    </td>
                                    <td>
                                        @if($order->due_date)
                                            <div class="{{ $order->due_date->isPast() && !in_array($order->status, ['delivered', 'cancelled']) ? 'text-danger fw-bold' : 'text-dark' }}">
                                                {{ $order->due_date->format('d M Y') }}
                                            </div>
                                            @if($order->due_date->isPast() && !in_array($order->status, ['delivered', 'cancelled']))
                                                <small class="badge bg-danger">Overdue</small>
                                            @endif
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td class="text-end pe-3">
                                        <!-- Primary action button based on workflow -->
                                        @if($order->status == 'pending')
                                            <a href="{{ route('orders.assign.create', $order->id) }}" class="btn btn-sm btn-info text-white me-1" title="Assign to Karigar">
                                                <i class="fa fa-user-plus me-1"></i> Assign
                                            </a>
                                        @elseif(in_array($order->status, ['assigned', 'in_progress']))
                                            <a href="{{ route('orders.receive.create', $order->id) }}" class="btn btn-sm btn-success me-1" title="Receive finished jewellery from Karigar">
                                                <i class="fa fa-inbox me-1"></i> Receive
                                            </a>
                                        @elseif($order->status == 'received')
                                            <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Mark this order as Delivered to customer?');">
                                                @csrf
                                                <input type="hidden" name="status" value="delivered">
                                                <button type="submit" class="btn btn-sm btn-dark me-1" title="Deliver to Customer">
                                                    <i class="fa fa-gift me-1"></i> Deliver
                                                </button>
                                            </form>
                                        @endif

                                        <div class="dropdown dropdown-action d-inline-block">
                                            <a href="#" class="action-icon text-muted" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="{{ route('orders.show', $order->id) }}">
                                                    <i class="far fa-eye me-2 text-primary"></i> View Order
                                                </a>
                                                <a class="dropdown-item" href="{{ route('orders.print', $order->id) }}" target="_blank">
                                                    <i class="fa fa-print me-2 text-info"></i> Print Order Slip
                                                </a>
                                                @if($order->status != 'delivered')
                                                    <a class="dropdown-item" href="{{ route('orders.edit', $order->id) }}">
                                                        <i class="far fa-edit me-2 text-success"></i> Edit Details
                                                    </a>
                                                @endif
                                                @if($order->status == 'pending')
                                                    <a class="dropdown-item" href="{{ route('orders.assign.create', $order->id) }}">
                                                        <i class="fa fa-user-tag me-2 text-info"></i> Assign to Karigar
                                                    </a>
                                                @elseif(in_array($order->status, ['assigned', 'in_progress']))
                                                    <a class="dropdown-item" href="{{ route('orders.receive.create', $order->id) }}">
                                                        <i class="fa fa-inbox me-2 text-success"></i> Receive from Karigar
                                                    </a>
                                                @endif
                                                <div class="dropdown-divider"></div>
                                                <form action="{{ route('orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this order?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger">
                                                        <i class="far fa-trash-alt me-2"></i> Delete Order
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="fa fa-clipboard-list fa-3x mb-3 text-secondary opacity-50"></i>
                                            <h5>No Customer Orders Found</h5>
                                            <p class="text-muted mb-3">Create custom jewellery orders, assign raw metal to karigars, and track receipts and wastage.</p>
                                            <a href="{{ route('orders.create') }}" class="btn btn-primary btn-sm">
                                                <i class="fa fa-plus-circle me-1"></i> Create First Order
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($orders->hasPages())
                    <div class="p-3 border-top d-flex justify-content-end">
                        {{ $orders->links() }}
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>
@endsection
