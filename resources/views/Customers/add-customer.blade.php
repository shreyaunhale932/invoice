<?php $page = 'add-customer'; ?>
@extends('layout.mainlayout')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="card mb-0">
            <div class="card-body">
                <!-- Page Header -->
                <div class="page-header">
                    <div class="content-page-header">
                        <h5>Add Customer</h5>
                    </div>
                </div>
                <!-- /Page Header -->
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('customers.store') }}" method="POST">
                            @csrf
                            <div class="form-group-item">
                                <h5 class="form-title">Basic Details</h5>
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="input-block mb-3">
                                            <label>Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="name" placeholder="Enter Name" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="input-block mb-3">
                                            <label>Email <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control" name="email" placeholder="Enter Email Address" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="input-block mb-3">
                                            <label>Phone <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="phone" placeholder="Phone Number" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group-item">
                                <h5 class="form-title">Billing Address</h5>
                                <div class="row">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="input-block mb-3">
                                            <label>Address Line 1</label>
                                            <input type="text" class="form-control" name="address1" placeholder="Enter Address 1">
                                        </div>
                                        <div class="input-block mb-3">
                                            <label>Address Line 2</label>
                                            <input type="text" class="form-control" name="address2" placeholder="Enter Address 2">
                                        </div>
                                        <div class="input-block mb-3">
                                            <label>Country</label>
                                            <input type="text" class="form-control" name="country" placeholder="Enter Country">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="input-block mb-3">
                                            <label>State</label>
                                            <input type="text" class="form-control" name="state" placeholder="Enter State">
                                        </div>
                                        <div class="input-block mb-3">
                                            <label>City</label>
                                            <input type="text" class="form-control" name="city" placeholder="Enter City">
                                        </div>
                                        <div class="input-block mb-3">
                                            <label>Pincode</label>
                                            <input type="text" class="form-control" name="pincode" placeholder="Enter Pincode">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group-customer customer-additional-form">
                                <h5 class="form-title">Bank Details</h5>
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="input-block mb-3">
                                            <label>Bank Name</label>
                                            <input type="text" class="form-control" name="bank_name" placeholder="Enter Bank Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="input-block mb-3">
                                            <label>Branch</label>
                                            <input type="text" class="form-control" name="branch" placeholder="Enter Branch Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                        <div class="input-block mb-3">
                                            <label>Account Holder Name</label>
                                            <input type="text" class="form-control" name="account_holder_name" placeholder="Enter Account Holder Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                        <div class="input-block mb-3">
                                            <label>Account Number</label>
                                            <input type="text" class="form-control" name="account_number" placeholder="Enter Account Number">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                        <div class="input-block mb-3">
                                            <label>IFSC</label>
                                            <input type="text" class="form-control" name="ifsc" placeholder="Enter IFSC Code">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="add-customer-btns text-end">
                                <a href="{{ url('customers') }}" class="btn customer-btn-cancel">Cancel</a>
                                <button type="submit" class="btn customer-btn-save">Save Changes</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Page Wrapper -->
@endsection