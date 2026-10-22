<?php $page = 'purchase-report'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Wholesale Purchase Report</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('purchases.index') }}">Purchases</a></li>
                            <li class="breadcrumb-item active">Purchase Report</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Search & Filter Card -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title mb-0 text-primary font-weight-bold">
                        <i class="fa fa-filter me-2"></i>Filter Purchase Report
                    </h5>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('purchase-report') }}">
                        <div class="row g-3 align-items-end">
                            <div class="col-md-3">
                                <label class="form-label font-weight-medium text-muted">From Date</label>
                                <input type="date" name="from_date" class="form-control" value="{{ request('from_date') }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label font-weight-medium text-muted">To Date</label>
                                <input type="date" name="to_date" class="form-control" value="{{ request('to_date') }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label font-weight-medium text-muted">Supplier</label>
                                <select name="supplier_id" class="form-select select">
                                    <option value="">-- All Suppliers --</option>
                                    @foreach($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}" {{ request('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                            {{ $supplier->name }} {{ $supplier->shop_name ? '('.$supplier->shop_name.')' : '' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label font-weight-medium text-muted">Search Product / Purchase #</label>
                                <input type="text" name="search" class="form-control" placeholder="Search by product name..." value="{{ request('search') }}">
                            </div>
                            <div class="col-md-12 d-flex justify-content-end gap-2 mt-3">
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="fa fa-search me-1"></i> Apply Filter
                                </button>
                                <a href="{{ route('purchase-report') }}" class="btn btn-light border px-4">
                                    <i class="fa fa-refresh me-1"></i> Reset
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /Search Filter -->

            <!-- Summary KPI Cards -->
            <div class="row mb-4">
                <div class="col-xl-3 col-md-6 col-sm-12 mb-3">
                    <div class="card border-0 shadow-sm h-100 bg-white">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <span class="text-muted font-weight-medium d-block mb-1">Total Net Weight</span>
                                    <h3 class="mb-0 font-weight-bold text-success">{{ number_format($totalNetWeight, 3) }} <small class="fs-6">g</small></h3>
                                </div>
                                <div class="avatar avatar-md bg-light-success text-success rounded-circle">
                                    <i class="fa fa-balance-scale fs-5"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-sm-12 mb-3">
                    <div class="card border-0 shadow-sm h-100 bg-white">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <span class="text-muted font-weight-medium d-block mb-1">Total Gross Weight</span>
                                    <h3 class="mb-0 font-weight-bold text-info">{{ number_format($totalGrossWeight, 3) }} <small class="fs-6">g</small></h3>
                                </div>
                                <div class="avatar avatar-md bg-light-info text-info rounded-circle">
                                    <i class="fa fa-cutlery fs-5"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-sm-12 mb-3">
                    <div class="card border-0 shadow-sm h-100 bg-white">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <span class="text-muted font-weight-medium d-block mb-1">Total Fine Weight</span>
                                    <h3 class="mb-0 font-weight-bold text-warning">{{ number_format($totalFineWeight, 3) }} <small class="fs-6">g</small></h3>
                                </div>
                                <div class="avatar avatar-md bg-light-warning text-warning rounded-circle">
                                    <i class="fa fa-diamond fs-5"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-sm-12 mb-3">
                    <div class="card border-0 shadow-sm h-100 bg-white">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <span class="text-muted font-weight-medium d-block mb-1">Total Purchase Value</span>
                                    <h3 class="mb-0 font-weight-bold text-primary">₹{{ number_format($totalAmount, 2) }}</h3>
                                </div>
                                <div class="avatar avatar-md bg-light-primary text-primary rounded-circle">
                                    <i class="fa fa-shopping-cart fs-5"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product-Wise Weight Summary Card -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0 text-dark font-weight-bold">
                        <i class="fa fa-tags text-warning me-2"></i>Product-Wise Weight Summary (Purchased Grams)
                    </h5>
                    <span class="badge bg-soft-info text-info rounded-pill px-3 py-1">
                        {{ count($productSummary) }} Unique Products
                    </span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th>#</th>
                                    <th>Product Name</th>
                                    <th class="text-center">Total Purchased Qty</th>
                                    <th class="text-end">Gross Weight (g)</th>
                                    <th class="text-end">Net Weight (g)</th>
                                    <th class="text-end">Fine Weight (g)</th>
                                    <th class="text-end">Total Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($productSummary as $index => $summary)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td class="fw-bold text-dark">
                                            <i class="fa fa-cube text-primary me-2"></i>{{ $summary['product_name'] }}
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-light text-dark border">{{ $summary['total_qty'] }}</span>
                                        </td>
                                        <td class="text-end fw-semibold text-secondary">{{ number_format($summary['total_gross_weight'], 3) }} g</td>
                                        <td class="text-end font-weight-bold text-success fs-14">{{ number_format($summary['total_net_weight'], 3) }} g</td>
                                        <td class="text-end fw-semibold text-warning">{{ number_format($summary['total_fine_weight'], 3) }} g</td>
                                        <td class="text-end fw-bold text-dark">₹{{ number_format($summary['total_amount'], 2) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">No product purchases recorded yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            @if(count($productSummary) > 0)
                                <tfoot class="bg-light-secondary font-weight-bold">
                                    <tr>
                                        <td colspan="2" class="text-end">Total:</td>
                                        <td class="text-center">{{ $totalQuantity }}</td>
                                        <td class="text-end">{{ number_format($totalGrossWeight, 3) }} g</td>
                                        <td class="text-end text-success fs-14">{{ number_format($totalNetWeight, 3) }} g</td>
                                        <td class="text-end text-warning">{{ number_format($totalFineWeight, 3) }} g</td>
                                        <td class="text-end text-primary">₹{{ number_format($totalAmount, 2) }}</td>
                                    </tr>
                                </tfoot>
                            @endif
                        </table>
                    </div>
                </div>
            </div>

            <!-- Detailed Wholesale Purchase Items Table -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0 text-dark font-weight-bold">
                        <i class="fa fa-list-alt text-primary me-2"></i>Detailed Wholesale Purchase Items Log
                    </h5>
                    <span class="badge bg-light text-secondary border">
                        {{ count($items) }} Records
                    </span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0 datatable">
                            <thead class="bg-light">
                                <tr>
                                    <th>#</th>
                                    <th>Purchase No</th>
                                    <th>Supplier</th>
                                    <th>Product Name</th>
                                    <th>Purity</th>
                                    <th class="text-end">Gross Wt (g)</th>
                                    <th class="text-end">Net Wt (g)</th>
                                    <th class="text-end">Fine Wt (g)</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-end">Purchase Rate</th>
                                    <th class="text-end">Total Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($items as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            @if($item->purchase)
                                                <a href="{{ route('purchases.show', $item->purchase->id) }}" class="fw-bold text-primary">
                                                    {{ $item->purchase->purchase_no }}
                                                </a>
                                                <br><small class="text-muted">{{ \Carbon\Carbon::parse($item->purchase->purchase_date)->format('d M Y') }}</small>
                                            @else
                                                <span class="text-muted">N/A</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="fw-semibold">{{ $item->purchase->supplier->name ?? 'N/A' }}</span>
                                            @if(optional($item->purchase->supplier)->shop_name)
                                                <br><small class="text-muted">{{ $item->purchase->supplier->shop_name }}</small>
                                            @endif
                                        </td>
                                        <td class="fw-bold text-dark">
                                            {{ $item->item_name }}
                                        </td>
                                        <td>
                                            @if($item->purity)
                                                <span class="badge bg-soft-secondary text-dark">{{ $item->purity->name ?? $item->purity->purity }}</span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td class="text-end">{{ number_format($item->gross_weight, 3) }} g</td>
                                        <td class="text-end fw-bold text-success">{{ number_format($item->net_weight, 3) }} g</td>
                                        <td class="text-end text-warning">{{ number_format($item->final_fn_weight, 3) }} g</td>
                                        <td class="text-center">{{ $item->quantity }}</td>
                                        <td class="text-end">₹{{ number_format($item->purchase_rate, 2) }}</td>
                                        <td class="text-end fw-bold">₹{{ number_format($item->total_amount, 2) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="11" class="text-center text-muted py-5">No purchase item records found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- /Page Wrapper -->
@endsection
