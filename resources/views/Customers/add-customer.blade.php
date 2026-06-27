<?php $page = 'add-customer'; ?>
@extends('layout.mainlayout')
@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
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
                                                <input type="text" class="form-control" name="name"
                                                    placeholder="Enter Name" required>
                                                    @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <label>Email </label>
                                                <input type="email" class="form-control" name="email"
                                                    placeholder="Enter Email Address" >
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <label>Phone <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="phone"
                                                    placeholder="Phone Number" required>
                                                    @error('phone')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <label>Date of Birth</label>
                                                <input type="date" class="form-control" name="dob">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <label>Anniversary Date</label>
                                                <input type="date" class="form-control" name="anniversary_date">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group-item">
                                    <h5 class="form-title">Billing Address</h5>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-12">
                                            <div class="input-block mb-3">
                                                <label>Address(Area)</label>
                                                <input type="text" class="form-control" name="address"
                                                    placeholder="Enter Address(Area)">
                                            </div>
                                            <div class="input-block mb-3">
                                                <label>Country</label>
                                                <input type="text" class="form-control" name="country"
                                                    value="INDIA" placeholder="Enter Country">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="input-block mb-3">
                                                <label>State</label>
                                                <select class="form-control" name="state" required>
                                                    <option value="">Select State</option>
                                                    <option value="Andhra Pradesh">Andhra Pradesh</option>
                                                    <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                                    <option value="Assam">Assam</option>
                                                    <option value="Bihar">Bihar</option>
                                                    <option value="Chhattisgarh">Chhattisgarh</option>
                                                    <option value="Goa">Goa</option>
                                                    <option value="Gujarat">Gujarat</option>
                                                    <option value="Haryana">Haryana</option>
                                                    <option value="Himachal Pradesh">Himachal Pradesh</option>
                                                    <option value="Jharkhand">Jharkhand</option>
                                                    <option value="Karnataka">Karnataka</option>
                                                    <option value="Kerala">Kerala</option>
                                                    <option value="Madhya Pradesh">Madhya Pradesh</option>
                                                    <option value="Maharashtra">Maharashtra</option>
                                                    <option value="Manipur">Manipur</option>
                                                    <option value="Meghalaya">Meghalaya</option>
                                                    <option value="Mizoram">Mizoram</option>
                                                    <option value="Nagaland">Nagaland</option>
                                                    <option value="Odisha">Odisha</option>
                                                    <option value="Punjab">Punjab</option>
                                                    <option value="Rajasthan">Rajasthan</option>
                                                    <option value="Sikkim">Sikkim</option>
                                                    <option value="Tamil Nadu">Tamil Nadu</option>
                                                    <option value="Telangana">Telangana</option>
                                                    <option value="Tripura">Tripura</option>
                                                    <option value="Uttar Pradesh">Uttar Pradesh</option>
                                                    <option value="Uttarakhand">Uttarakhand</option>
                                                    <option value="West Bengal">West Bengal</option>
                                                    <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                                                    <option value="Chandigarh">Chandigarh</option>
                                                    <option value="Dadra and Nagar Haveli and Daman and Diu">Dadra and Nagar Haveli and Daman and Diu</option>
                                                    <option value="Delhi">Delhi</option>
                                                    <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                                                    <option value="Ladakh">Ladakh</option>
                                                    <option value="Lakshadweep">Lakshadweep</option>
                                                    <option value="Puducherry">Puducherry</option>
                                                </select>
                                                @error('state')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="input-block mb-3">
                                                <label>City</label>
                                                <input type="text" class="form-control" name="city"
                                                    placeholder="Enter City">
                                            </div>
                                            <div class="input-block mb-3">
                                                <label>Pincode</label>
                                                <input type="text" class="form-control" name="pincode"
                                                    placeholder="Enter Pincode">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group-item">
                                    <h5 class="form-title">Tax & Identity Details</h5>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <label>GST No.</label>
                                                <input type="text" class="form-control" name="gst_no"
                                                    placeholder="Enter GST Number">
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <label>Aadhaar No.</label>
                                                <input type="text" class="form-control" name="adhaar_no"
                                                    placeholder="Enter Aadhaar Number">
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <label>PAN No.</label>
                                                <input type="text" class="form-control" name="pan_no"
                                                    placeholder="Enter PAN Number">
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <label>TAN</label>
                                                <input type="text" class="form-control" name="tan"
                                                    placeholder="Enter TAN">
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
