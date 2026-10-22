@extends('layout.mainlayout')

@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Wholesale Purchases</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Wholesale Purchases</li>
                    </ul>
                </div>
                <div class="col-auto">
                    <a href="{{ route('purchases.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus-circle me-1"></i> Add  Purchase
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

        <!-- Summary Cards -->
        <div class="row mb-4">
            <div class="col-xl-3 col-sm-6 col-12">
                <div class="card bg-white shadow-sm border-0">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="text-muted mb-1 font-weight-medium">Total Purchase Amount</p>
                                <h4 class="mb-0 text-primary font-weight-bold">₹{{ number_format($totalPurchaseAmount, 2) }}</h4>
                            </div>
                            <div class="avatar avatar-md bg-light-primary rounded-circle">
                                <i class="fa fa-shopping-cart text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
                <div class="card bg-white shadow-sm border-0">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="text-muted mb-1 font-weight-medium">Total Paid Amount</p>
                                <h4 class="mb-0 text-success font-weight-bold">₹{{ number_format($totalPaidAmount, 2) }}</h4>
                            </div>
                            <div class="avatar avatar-md bg-light-success rounded-circle">
                                <i class="fa fa-check-circle text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
                <div class="card bg-white shadow-sm border-0">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="text-muted mb-1 font-weight-medium">Total Outstanding</p>
                                <h4 class="mb-0 text-danger font-weight-bold">₹{{ number_format($totalUnpaidAmount, 2) }}</h4>
                            </div>
                            <div class="avatar avatar-md bg-light-danger rounded-circle">
                                <i class="fa fa-exclamation-triangle text-danger"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
                <div class="card bg-white shadow-sm border-0">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="text-muted mb-1 font-weight-medium">Total Weight Purchased</p>
                                <h4 class="mb-0 text-warning font-weight-bold">{{ number_format($totalNetWeight ?? 0, 3) }} <small class="fs-6">g</small></h4>
                            </div>
                            <div class="avatar avatar-md bg-light-warning rounded-circle">
                                <i class="fa fa-balance-scale text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search & Filter Card -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-3">
                <form method="GET" action="{{ route('purchases.index') }}">
                    <div class="row g-2 align-items-center">
                        <div class="col-md-3">
                            <input type="text" name="search" class="form-control form-control-sm" placeholder="Search Purchase #, Ref #, Supplier..." value="{{ request('search') }}">
                        </div>
                        <div class="col-md-3">
                            <select name="supplier_id" class="form-select form-select-sm select">
                                <option value="">-- All Suppliers --</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}" {{ request('supplier_id') == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }} ({{ $supplier->shop_name ?? 'N/A' }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <input type="date" name="from_date" class="form-control form-control-sm" value="{{ request('from_date') }}" placeholder="From Date">
                        </div>
                        <div class="col-md-2">
                            <input type="date" name="to_date" class="form-control form-control-sm" value="{{ request('to_date') }}" placeholder="To Date">
                        </div>
                        <div class="col-md-2 d-flex gap-1">
                            <button type="submit" class="btn btn-sm btn-primary w-100"><i class="fa fa-filter me-1"></i>Filter</button>
                            <a href="{{ route('purchases.index') }}" class="btn btn-sm btn-light border w-100">Reset</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Purchases Table -->
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th>#</th>
                                <th>Purchase No</th>
                                <th>Supplier</th>
                                <th>Date</th>
                                <th>Products & Weight (g)</th>
                                <th>Grand Total</th>
                                <th>Paid Amount</th>
                                <th>Payment Status</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($purchases as $index => $purchase)
                                <tr>
                                    <td>{{ $purchases->firstItem() + $index }}</td>
                                    <td>
                                        <a href="{{ route('purchases.show', $purchase->id) }}" class="fw-bold text-primary">
                                            {{ $purchase->purchase_no }}
                                        </a>
                                        @if($purchase->reference_no)
                                            <br><small class="text-muted">Ref: {{ $purchase->reference_no }}</small>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="fw-semibold">{{ $purchase->supplier->name ?? 'Direct Supplier / Cash' }}</span>
                                        @if(optional($purchase->supplier)->shop_name)
                                            <br><small class="text-muted">{{ $purchase->supplier->shop_name }}</small>
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($purchase->purchase_date)->format('d M Y') }}</td>
                                    <td>
                                        <div class="d-flex flex-column gap-1">
                                            @foreach($purchase->items as $item)
                                                <div class="small fw-semibold text-dark">
                                                    <i class="fa fa-cube text-primary me-1"></i>{{ $item->item_name }}
                                                    <span class="text-success ms-1 font-weight-bold">({{ number_format($item->net_weight, 3) }} g)</span>
                                                </div>
                                            @endforeach
                                            @if($purchase->items->count() > 0)
                                                <div class="border-top pt-1 mt-1 text-muted fs-12 font-weight-bold">
                                                    Total Net: <span class="text-dark">{{ number_format($purchase->items->sum('net_weight'), 3) }} g</span>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="fw-bold text-dark">₹{{ number_format($purchase->grand_total, 2) }}</td>
                                    <td class="text-success">₹{{ number_format($purchase->paid_amount, 2) }}</td>
                                    <td>
                                        @if($purchase->payment_status === 'paid')
                                            <span class="badge bg-success-light text-success"><i class="fa fa-check-circle me-1"></i>Paid</span>
                                        @elseif($purchase->payment_status === 'partial')
                                            <span class="badge bg-warning-light text-warning"><i class="fa fa-clock-o me-1"></i>Partial</span>
                                        @else
                                            <span class="badge bg-danger-light text-danger"><i class="fa fa-times-circle me-1"></i>Unpaid</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="{{ route('purchases.show', $purchase->id) }}"><i class="far fa-eye me-2 text-info"></i> View Details</a>
                                                <a class="dropdown-item" href="{{ route('purchases.edit', $purchase->id) }}"><i class="far fa-edit me-2 text-primary"></i> Edit Purchase</a>
                                                <form action="{{ route('purchases.destroy', $purchase->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this purchase? Stock impact will be automatically reversed.');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger"><i class="far fa-trash-alt me-2"></i> Delete & Reverse Stock</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center py-5 text-muted">
                                        <i class="fa fa-shopping-cart fa-3x mb-3 text-secondary opacity-50"></i>
                                        <p class="mb-1">No Wholesale Purchases found.</p>
                                        <a href="{{ route('purchases.create') }}" class="btn btn-sm btn-primary mt-2">
                                            <i class="fa fa-plus-circle me-1"></i> Create First Wholesale Purchase
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($purchases->hasPages())
                    <div class="p-3 border-top">
                        {{ $purchases->links() }}
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>
@endsection
