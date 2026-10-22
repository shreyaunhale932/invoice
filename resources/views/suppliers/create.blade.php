<?php $page = 'add-supplier'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="card mb-0">
                <div class="card-body">
                    <!-- Page Header -->
                    <div class="page-header">
                        <div class="content-page-header">
                            <h5>Add Supplier</h5>
                        </div>
                    </div>
                    <!-- /Page Header -->

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible
                        fade show" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('suppliers.store') }}" method="POST">
                        @csrf

                        <!-- Basic Information -->
                        <div class="form-group-item">
                            {{-- <h5 class="form-title">Basic Details</h5> --}}

                            <div class="row">

                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label>Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ old('name') }}" placeholder="Enter Supplier Name" required>
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label>Shop Name</label>
                                        <input type="text" class="form-control" name="shop_name"
                                            value="{{ old('shop_name') }}" placeholder="Enter Shop / Business Name">
                                        @error('shop_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label>Phone No.</label>
                                        <input type="text" class="form-control" name="phone"
                                            value="{{ old('phone') }}" placeholder="Enter Phone Number">
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email"
                                            value="{{ old('email') }}" placeholder="Enter Email Address">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="input-block mb-3">
                                        <label>Address</label>
                                        <textarea class="form-control" name="address" rows="2" placeholder="Enter Full Address">{{ old('address') }}</textarea>
                                        @error('address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="input-block mb-3">
                                                <label>City</label>
                                                <input type="text" class="form-control" name="city"
                                                    value="{{ old('city') }}" placeholder="Enter City">
                                                @error('city')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-block mb-3">
                                                <label>State</label>
                                                <input type="text" class="form-control" name="state"
                                                    value="{{ old('state') }}" placeholder="Enter State">
                                                @error('state')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-block mb-3">
                                                <label>Pincode</label>
                                                <input type="text" class="form-control" name="pincode"
                                                    value="{{ old('pincode') }}" placeholder="Enter Pincode">
                                                @error('pincode')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <div class="row">
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label>Bank Name</label>
                                        <input type="text" class="form-control" name="bank_name"
                                            value="{{ old('bank_name') }}" placeholder="Enter Bank Name">
                                        @error('bank_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label>Branch</label>
                                        <input type="text" class="form-control" name="branch"
                                            value="{{ old('branch') }}" placeholder="Enter Branch Name">
                                        @error('branch')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label>Account Number</label>
                                        <input type="text" class="form-control" name="account_number"
                                            value="{{ old('account_number') }}" placeholder="Enter Account Number">
                                        @error('account_number')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label>IFSC Code</label>
                                        <input type="text" class="form-control" name="ifsc_code"
                                            value="{{ old('ifsc_code') }}" placeholder="Enter IFSC Code">
                                        @error('ifsc_code')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                              <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label>GST No.</label>
                                        <input type="text" class="form-control" name="gst_no"
                                            value="{{ old('gst_no') }}" placeholder="Enter GST Number">
                                        @error('gst_no')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label>Adhar Card</label>
                                        <input type="text" class="form-control" name="adhar_card"
                                            value="{{ old('adhar_card') }}" placeholder="Enter Adhar Card Number">
                                        @error('adhar_card')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label>PAN Card</label>
                                        <input type="text" class="form-control" name="pan_card"
                                            value="{{ old('pan_card') }}" placeholder="Enter PAN Card Number">
                                        @error('pan_card')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Address Details -->


                        <div class="add-customer-btns text-end mt-4">
                            <a href="{{ route('suppliers.index') }}" class="btn btn-primary cancel-btn me-2">Cancel</a>
                            <button type="submit" class="btn btn-primary add-button">Save Supplier</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
