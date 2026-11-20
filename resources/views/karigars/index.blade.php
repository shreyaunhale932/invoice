<?php $page = 'karigars'; ?>
@extends('layout.mainlayout')

@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Karigar Management</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Karigars</li>
                    </ul>
                </div>
                <div class="col-auto">
                    <a href="{{ route('karigars.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus-circle me-1"></i> Add Karigar
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
            <div class="col-xl-3 col-sm-6 col-12">
                <div class="card bg-white shadow-sm border-0">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="text-muted mb-1 font-weight-medium">Total Karigars</p>
                                <h4 class="mb-0 text-primary font-weight-bold">{{ $totalKarigars }}</h4>
                            </div>
                            <div class="avatar avatar-md bg-light-primary rounded-circle">
                                <i class="fa fa-users text-primary"></i>
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
                                <p class="text-muted mb-1 font-weight-medium">Active Karigars</p>
                                <h4 class="mb-0 text-success font-weight-bold">{{ $activeKarigars }}</h4>
                            </div>
                            <div class="avatar avatar-md bg-light-success rounded-circle">
                                <i class="fa fa-user-check text-success"></i>
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
                                <p class="text-muted mb-1 font-weight-medium">Active Assigned Orders</p>
                                <h4 class="mb-0 text-warning font-weight-bold">{{ $activeAssignments }}</h4>
                            </div>
                            <div class="avatar avatar-md bg-light-warning rounded-circle">
                                <i class="fa fa-tasks text-warning"></i>
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
                                <p class="text-muted mb-1 font-weight-medium">Metal in Hand (Karigars)</p>
                                <h4 class="mb-0 text-danger font-weight-bold">{{ number_format($totalMetalHeld, 3) }} <span class="fs-6 font-weight-normal text-muted">g</span></h4>
                            </div>
                            <div class="avatar avatar-md bg-light-danger rounded-circle">
                                <i class="fa fa-balance-scale text-danger"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Card -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('karigars.index') }}">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-4">
                            <label class="form-label text-muted small fw-bold">Search Karigar</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fa fa-search text-muted"></i></span>
                                <input type="text" name="search" class="form-control border-start-0" placeholder="Name, code, shop, phone, city..." value="{{ request('search') }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label text-muted small fw-bold">Speciality</label>
                            <select name="speciality" class="form-select">
                                <option value="">All Specialities</option>
                                <option value="Plain Gold" {{ request('speciality') == 'Plain Gold' ? 'selected' : '' }}>Plain Gold</option>
                                <option value="Diamond Setting" {{ request('speciality') == 'Diamond Setting' ? 'selected' : '' }}>Diamond Setting</option>
                                <option value="Stone Studded" {{ request('speciality') == 'Stone Studded' ? 'selected' : '' }}>Stone Studded</option>
                                <option value="Casting" {{ request('speciality') == 'Casting' ? 'selected' : '' }}>Casting</option>
                                <option value="Polishing & Meena" {{ request('speciality') == 'Polishing & Meena' ? 'selected' : '' }}>Polishing & Meena</option>
                                <option value="Repairing" {{ request('speciality') == 'Repairing' ? 'selected' : '' }}>Repairing</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label text-muted small fw-bold">Status</label>
                            <select name="status" class="form-select">
                                <option value="">All Status</option>
                                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-3 d-flex gap-2">
                            <button type="submit" class="btn btn-primary flex-grow-1">
                                <i class="fa fa-filter me-1"></i> Filter
                            </button>
                            <a href="{{ route('karigars.index') }}" class="btn btn-outline-secondary">
                                Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Karigars Table Card -->
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-3">Code</th>
                                <th>Karigar Name</th>
                                <th>Shop / Workshop</th>
                                <th>Speciality</th>
                                <th>Phone</th>
                                <th>City</th>
                                <th class="text-center">Active Jobs</th>
                                <th class="text-end">Metal in Hand</th>
                                <th class="text-center">Status</th>
                                <th class="text-end pe-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($karigars as $karigar)
                                <tr>
                                    <td class="ps-3 fw-bold text-primary">
                                        <a href="{{ route('karigars.show', $karigar->id) }}">
                                            {{ $karigar->code ?: 'KG-' . str_pad($karigar->id, 4, '0', STR_PAD_LEFT) }}
                                        </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-sm bg-light-primary text-primary rounded-circle me-2 d-flex align-items-center justify-content-center fw-bold">
                                                {{ strtoupper(substr($karigar->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <a href="{{ route('karigars.show', $karigar->id) }}" class="fw-bold text-dark text-decoration-none">
                                                    {{ $karigar->name }}
                                                </a>
                                                @if($karigar->email)
                                                    <div class="small text-muted">{{ $karigar->email }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $karigar->shop_name ?: '-' }}</td>
                                    <td>
                                        @if($karigar->speciality)
                                            <span class="badge bg-light text-primary border">{{ $karigar->speciality }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>{{ $karigar->phone ?: '-' }}</td>
                                    <td>{{ $karigar->city ?: '-' }}</td>
                                    <td class="text-center">
                                        @if($karigar->active_assignments_count > 0)
                                            <span class="badge bg-warning text-dark">{{ $karigar->active_assignments_count }} active</span>
                                        @else
                                            <span class="badge bg-light text-muted border">0</span>
                                        @endif
                                    </td>
                                    <td class="text-end font-weight-bold {{ $karigar->current_metal_balance > 0 ? 'text-danger' : 'text-success' }}">
                                        {{ number_format($karigar->current_metal_balance, 3) }} g
                                    </td>
                                    <td class="text-center">
                                        @if ($karigar->status == 'active')
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="text-end pe-3">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon text-muted" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="{{ route('karigars.show', $karigar->id) }}">
                                                    <i class="far fa-eye me-2 text-primary"></i> View Profile
                                                </a>
                                                <a class="dropdown-item" href="{{ route('karigars.ledger', $karigar->id) }}">
                                                    <i class="fas fa-book me-2 text-info"></i> Metal Ledger
                                                </a>
                                                <a class="dropdown-item" href="{{ route('karigars.edit', $karigar->id) }}">
                                                    <i class="far fa-edit me-2 text-success"></i> Edit Details
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <form action="{{ route('karigars.destroy', $karigar->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this Karigar?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger">
                                                        <i class="far fa-trash-alt me-2"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="fa fa-users fa-3x mb-3 text-secondary opacity-50"></i>
                                            <h5>No Karigars Found</h5>
                                            <p class="text-muted mb-3">Add skilled artisans and goldsmiths to manage custom jewellery manufacture and track issued metal.</p>
                                            <a href="{{ route('karigars.create') }}" class="btn btn-primary btn-sm">
                                                <i class="fa fa-plus-circle me-1"></i> Add First Karigar
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($karigars->hasPages())
                    <div class="p-3 border-top d-flex justify-content-end">
                        {{ $karigars->links() }}
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>
@endsection
