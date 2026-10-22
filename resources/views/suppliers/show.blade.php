<?php $page = 'supplier-details'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="content-page-header">
                    <h5>Supplier Details</h5>
                    <div class="list-btn">
                        <ul class="filter-list">
                            <li>
                                <a class="btn btn-primary" href="{{ route('suppliers.edit', $supplier->id) }}">
                                    <i class="far fa-edit me-2"></i>Edit Supplier
                                </a>
                            </li>
                            <li>
                                <a class="btn btn-light" href="{{ route('suppliers.index') }}">
                                    <i class="fas fa-arrow-left me-2"></i>Back to List
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="row">
                <!-- Basic Info Card -->
                <div class="col-xl-4 col-lg-5 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="supplier-profile text-center pb-3 border-bottom mb-3">
                                <div class="avatar avatar-xxl bg-primary-light text-primary rounded-circle mb-3 d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px; font-size: 32px;">
                                    <i class="fas fa-truck"></i>
                                </div>
                                <h4 class="mb-1">{{ $supplier->name }}</h4>
                                <p class="text-muted mb-2">{{ $supplier->shop_name ?? 'Individual Supplier' }}</p>
                                <span class="badge bg-success-light text-success">Active Supplier</span>
                            </div>
                            <div class="supplier-info">
                                <div class="d-flex align-items-center mb-3">
                                    <span class="avatar avatar-sm bg-light text-secondary rounded-circle me-3">
                                        <i class="fas fa-phone-alt"></i>
                                    </span>
                                    <div>
                                        <span class="text-muted d-block small">Phone Number</span>
                                        <span class="fw-bold text-dark">{{ $supplier->phone ?? 'N/A' }}</span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-3">
                                    <span class="avatar avatar-sm bg-light text-secondary rounded-circle me-3">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                    <div>
                                        <span class="text-muted d-block small">Email Address</span>
                                        <span class="fw-bold text-dark">{{ $supplier->email ?? 'N/A' }}</span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-3">
                                    <span class="avatar avatar-sm bg-light text-secondary rounded-circle me-3">
                                        <i class="fas fa-store"></i>
                                    </span>
                                    <div>
                                        <span class="text-muted d-block small">Shop Name</span>
                                        <span class="fw-bold text-dark">{{ $supplier->shop_name ?? 'N/A' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Detailed Info Cards -->
                <div class="col-xl-8 col-lg-7 col-md-12">
                    <!-- Address Details -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0"><i class="fas fa-map-marker-alt text-primary me-2"></i>Address Details</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <span class="text-muted d-block small">Street / Area Address</span>
                                    <span class="fw-bold text-dark">{{ $supplier->address ?? 'N/A' }}</span>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <span class="text-muted d-block small">City</span>
                                    <span class="fw-bold text-dark">{{ $supplier->city ?? 'N/A' }}</span>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <span class="text-muted d-block small">State</span>
                                    <span class="fw-bold text-dark">{{ $supplier->state ?? 'N/A' }}</span>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <span class="text-muted d-block small">Pincode</span>
                                    <span class="fw-bold text-dark">{{ $supplier->pincode ?? 'N/A' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bank Details -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0"><i class="fas fa-university text-primary me-2"></i>Banking Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <span class="text-muted d-block small">Bank Name</span>
                                    <span class="fw-bold text-dark">{{ $supplier->bank_name ?? 'N/A' }}</span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <span class="text-muted d-block small">Branch</span>
                                    <span class="fw-bold text-dark">{{ $supplier->branch ?? 'N/A' }}</span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <span class="text-muted d-block small">Account Number</span>
                                    <span class="fw-bold text-dark">{{ $supplier->account_number ?? 'N/A' }}</span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <span class="text-muted d-block small">IFSC Code</span>
                                    <span class="fw-bold text-dark">{{ $supplier->ifsc_code ?? 'N/A' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tax & Identity Cards -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0"><i class="fas fa-id-card text-primary me-2"></i>Tax & Identity Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <span class="text-muted d-block small">GST Number</span>
                                    <span class="fw-bold text-dark">{{ $supplier->gst_no ?? 'N/A' }}</span>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <span class="text-muted d-block small">Adhar Card</span>
                                    <span class="fw-bold text-dark">{{ $supplier->adhar_card ?? 'N/A' }}</span>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <span class="text-muted d-block small">PAN Card</span>
                                    <span class="fw-bold text-dark">{{ $supplier->pan_card ?? 'N/A' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
