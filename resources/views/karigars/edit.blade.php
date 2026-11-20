<?php $page = 'edit-karigar'; ?>
@extends('layout.mainlayout')

@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Edit Karigar: {{ $karigar->name }}</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('karigars.index') }}">Karigars</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ul>
                </div>
                <div class="col-auto">
                    <a href="{{ route('karigars.show', $karigar->id) }}" class="btn btn-outline-info me-2">
                        <i class="fa fa-eye me-1"></i> View Profile
                    </a>
                    <a href="{{ route('karigars.index') }}" class="btn btn-outline-secondary">
                        <i class="fa fa-arrow-left me-1"></i> Back to List
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

        <form action="{{ route('karigars.update', $karigar->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Section 1: Basic Information -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white border-bottom">
                    <h5 class="card-title mb-0 text-primary">
                        <i class="fa fa-user me-2"></i>Basic Details
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-bold">Karigar Code</label>
                            <input type="text" class="form-control" name="code" value="{{ old('code', $karigar->code) }}" placeholder="e.g. KG-0001">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Karigar Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" value="{{ old('name', $karigar->name) }}" required>
                        </div>
                        <div class="col-md-5 mb-3">
                            <label class="form-label fw-bold">Shop / Workshop Name</label>
                            <input type="text" class="form-control" name="shop_name" value="{{ old('shop_name', $karigar->shop_name) }}">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Primary Phone No.</label>
                            <input type="text" class="form-control" name="phone" value="{{ old('phone', $karigar->phone) }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Email Address</label>
                            <input type="email" class="form-control" name="email" value="{{ old('email', $karigar->email) }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Speciality / Craft Skill</label>
                            <select name="speciality" class="form-select">
                                <option value="">Select Speciality</option>
                                <option value="Plain Gold" {{ old('speciality', $karigar->speciality) == 'Plain Gold' ? 'selected' : '' }}>Plain Gold</option>
                                <option value="Diamond Setting" {{ old('speciality', $karigar->speciality) == 'Diamond Setting' ? 'selected' : '' }}>Diamond Setting</option>
                                <option value="Stone Studded" {{ old('speciality', $karigar->speciality) == 'Stone Studded' ? 'selected' : '' }}>Stone Studded</option>
                                <option value="Casting" {{ old('speciality', $karigar->speciality) == 'Casting' ? 'selected' : '' }}>Casting</option>
                                <option value="Polishing & Meena" {{ old('speciality', $karigar->speciality) == 'Polishing & Meena' ? 'selected' : '' }}>Polishing & Meena</option>
                                <option value="Jadau / Kundan" {{ old('speciality', $karigar->speciality) == 'Jadau / Kundan' ? 'selected' : '' }}>Jadau / Kundan</option>
                                <option value="Silver Art" {{ old('speciality', $karigar->speciality) == 'Silver Art' ? 'selected' : '' }}>Silver Art</option>
                                <option value="Repairing" {{ old('speciality', $karigar->speciality) == 'Repairing' ? 'selected' : '' }}>Repairing</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 2: Address Information -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white border-bottom">
                    <h5 class="card-title mb-0 text-primary">
                        <i class="fa fa-map-marker-alt me-2"></i>Workshop & Residential Address
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Workshop / Street Address</label>
                            <textarea class="form-control" name="address" rows="2">{{ old('address', $karigar->address) }}</textarea>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold">City</label>
                                    <input type="text" class="form-control" name="city" value="{{ old('city', $karigar->city) }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold">State</label>
                                    <input type="text" class="form-control" name="state" value="{{ old('state', $karigar->state) }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold">Pincode</label>
                                    <input type="text" class="form-control" name="pincode" value="{{ old('pincode', $karigar->pincode) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 3: Identity & Bank Details -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white border-bottom">
                    <h5 class="card-title mb-0 text-primary">
                        <i class="fa fa-university me-2"></i>Identification & Bank Details
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-bold">Aadhar Card No.</label>
                            <input type="text" class="form-control" name="adhar_card" value="{{ old('adhar_card', $karigar->adhar_card) }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-bold">PAN Card No.</label>
                            <input type="text" class="form-control text-uppercase" name="pan_card" value="{{ old('pan_card', $karigar->pan_card) }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-bold">Bank Name</label>
                            <input type="text" class="form-control" name="bank_name" value="{{ old('bank_name', $karigar->bank_name) }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-bold">Branch</label>
                            <input type="text" class="form-control" name="branch" value="{{ old('branch', $karigar->branch) }}">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Account Number</label>
                            <input type="text" class="form-control" name="account_number" value="{{ old('account_number', $karigar->account_number) }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">IFSC Code</label>
                            <input type="text" class="form-control text-uppercase" name="ifsc_code" value="{{ old('ifsc_code', $karigar->ifsc_code) }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Status</label>
                            <select name="status" class="form-select">
                                <option value="active" {{ old('status', $karigar->status) == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status', $karigar->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 4: Initial Balances & Remarks -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white border-bottom">
                    <h5 class="card-title mb-0 text-primary">
                        <i class="fa fa-balance-scale me-2"></i>Opening Balances & Current Status
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Opening Metal Balance (Grams)</label>
                            <div class="input-group">
                                <input type="number" step="0.001" class="form-control" name="opening_metal_balance" value="{{ old('opening_metal_balance', $karigar->opening_metal_balance) }}">
                                <span class="input-group-text">grams</span>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Opening Cash Balance (₹)</label>
                            <div class="input-group">
                                <span class="input-group-text">₹</span>
                                <input type="number" step="0.01" class="form-control" name="opening_amount_balance" value="{{ old('opening_amount_balance', $karigar->opening_amount_balance) }}">
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Current Metal in Hand</label>
                            <div class="form-control bg-light fw-bold text-danger">
                                {{ number_format($karigar->current_metal_balance, 3) }} grams
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-bold">Notes</label>
                            <textarea class="form-control" name="notes" rows="2">{{ old('notes', $karigar->notes) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mb-5">
                <a href="{{ route('karigars.index') }}" class="btn btn-outline-secondary px-4">Cancel</a>
                <button type="submit" class="btn btn-primary px-5">
                    <i class="fa fa-save me-1"></i> Update Karigar
                </button>
            </div>
        </form>

    </div>
</div>
@endsection
