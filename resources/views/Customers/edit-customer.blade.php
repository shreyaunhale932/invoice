<?php $page = 'edit-customer'; ?>
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
                            <h5>Edit Customer</h5>
                        </div>
                    </div>
                    <!-- /Page Header -->
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('customers.update', $customer->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group-item">
                                    <h5 class="form-title">Basic Details</h5>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <label>Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" placeholder="Enter Name" name="name" value="{{ $customer->name }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <label>Email </label>
                                                <input type="email" class="form-control"
                                                    placeholder="Enter Email Address" name="email" value="{{ $customer->email }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <label>Phone <span class="text-danger">*</span></label>
                                                <input type="text" id="mobile_code" class="form-control"
                                                    placeholder="Phone Number" name="phone" value="{{ $customer->phone }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <label>Date of Birth</label>
                                                <input type="date" class="form-control" name="dob" value="{{ $customer->dob }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <label>Anniversary Date</label>
                                                <input type="date" class="form-control" name="anniversary_date" value="{{ $customer->anniversary_date }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group-item">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="billing-btn mb-2">
                                                <h5 class="form-title">Billing Address</h5>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 col-md-12">
                                                    <div class="input-block mb-3">
                                                        <label>Address(Area)</label>
                                                        <input type="text" class="form-control" placeholder="Enter Address(Area)" name="address" value="{{ $customer->address }}">
                                                    </div>
                                                    <div class="input-block mb-3">
                                                        <label>Country</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter Country" name="country" value="{{ $customer->country ?? 'INDIA' }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-12">
                                                    <div class="input-block mb-3">
                                                        <label>State</label>
                                                        <select class="form-control" name="state">
                                                            <option value="">Select State</option>
                                                            <option value="Andhra Pradesh" {{ $customer->state == 'Andhra Pradesh' ? 'selected' : '' }}>Andhra Pradesh</option>
                                                            <option value="Arunachal Pradesh" {{ $customer->state == 'Arunachal Pradesh' ? 'selected' : '' }}>Arunachal Pradesh</option>
                                                            <option value="Assam" {{ $customer->state == 'Assam' ? 'selected' : '' }}>Assam</option>
                                                            <option value="Bihar" {{ $customer->state == 'Bihar' ? 'selected' : '' }}>Bihar</option>
                                                            <option value="Chhattisgarh" {{ $customer->state == 'Chhattisgarh' ? 'selected' : '' }}>Chhattisgarh</option>
                                                            <option value="Goa" {{ $customer->state == 'Goa' ? 'selected' : '' }}>Goa</option>
                                                            <option value="Gujarat" {{ $customer->state == 'Gujarat' ? 'selected' : '' }}>Gujarat</option>
                                                            <option value="Haryana" {{ $customer->state == 'Haryana' ? 'selected' : '' }}>Haryana</option>
                                                            <option value="Himachal Pradesh" {{ $customer->state == 'Himachal Pradesh' ? 'selected' : '' }}>Himachal Pradesh</option>
                                                            <option value="Jharkhand" {{ $customer->state == 'Jharkhand' ? 'selected' : '' }}>Jharkhand</option>
                                                            <option value="Karnataka" {{ $customer->state == 'Karnataka' ? 'selected' : '' }}>Karnataka</option>
                                                            <option value="Kerala" {{ $customer->state == 'Kerala' ? 'selected' : '' }}>Kerala</option>
                                                            <option value="Madhya Pradesh" {{ $customer->state == 'Madhya Pradesh' ? 'selected' : '' }}>Madhya Pradesh</option>
                                                            <option value="Maharashtra" {{ $customer->state == 'Maharashtra' ? 'selected' : '' }}>Maharashtra</option>
                                                            <option value="Manipur" {{ $customer->state == 'Manipur' ? 'selected' : '' }}>Manipur</option>
                                                            <option value="Meghalaya" {{ $customer->state == 'Meghalaya' ? 'selected' : '' }}>Meghalaya</option>
                                                            <option value="Mizoram" {{ $customer->state == 'Mizoram' ? 'selected' : '' }}>Mizoram</option>
                                                            <option value="Nagaland" {{ $customer->state == 'Nagaland' ? 'selected' : '' }}>Nagaland</option>
                                                            <option value="Odisha" {{ $customer->state == 'Odisha' ? 'selected' : '' }}>Odisha</option>
                                                            <option value="Punjab" {{ $customer->state == 'Punjab' ? 'selected' : '' }}>Punjab</option>
                                                            <option value="Rajasthan" {{ $customer->state == 'Rajasthan' ? 'selected' : '' }}>Rajasthan</option>
                                                            <option value="Sikkim" {{ $customer->state == 'Sikkim' ? 'selected' : '' }}>Sikkim</option>
                                                            <option value="Tamil Nadu" {{ $customer->state == 'Tamil Nadu' ? 'selected' : '' }}>Tamil Nadu</option>
                                                            <option value="Telangana" {{ $customer->state == 'Telangana' ? 'selected' : '' }}>Telangana</option>
                                                            <option value="Tripura" {{ $customer->state == 'Tripura' ? 'selected' : '' }}>Tripura</option>
                                                            <option value="Uttar Pradesh" {{ $customer->state == 'Uttar Pradesh' ? 'selected' : '' }}>Uttar Pradesh</option>
                                                            <option value="Uttarakhand" {{ $customer->state == 'Uttarakhand' ? 'selected' : '' }}>Uttarakhand</option>
                                                            <option value="West Bengal" {{ $customer->state == 'West Bengal' ? 'selected' : '' }}>West Bengal</option>
                                                            <option value="Andaman and Nicobar Islands" {{ $customer->state == 'Andaman and Nicobar Islands' ? 'selected' : '' }}>Andaman and Nicobar Islands</option>
                                                            <option value="Chandigarh" {{ $customer->state == 'Chandigarh' ? 'selected' : '' }}>Chandigarh</option>
                                                            <option value="Dadra and Nagar Haveli and Daman and Diu" {{ $customer->state == 'Dadra and Nagar Haveli and Daman and Diu' ? 'selected' : '' }}>Dadra and Nagar Haveli and Daman and Diu</option>
                                                            <option value="Delhi" {{ $customer->state == 'Delhi' ? 'selected' : '' }}>Delhi</option>
                                                            <option value="Jammu and Kashmir" {{ $customer->state == 'Jammu and Kashmir' ? 'selected' : '' }}>Jammu and Kashmir</option>
                                                            <option value="Ladakh" {{ $customer->state == 'Ladakh' ? 'selected' : '' }}>Ladakh</option>
                                                            <option value="Lakshadweep" {{ $customer->state == 'Lakshadweep' ? 'selected' : '' }}>Lakshadweep</option>
                                                            <option value="Puducherry" {{ $customer->state == 'Puducherry' ? 'selected' : '' }}>Puducherry</option>
                                                        </select>
                                                    </div>
                                                    <div class="input-block mb-3">
                                                        <label>City</label>
                                                        <input type="text" class="form-control" placeholder="Enter City" name="city" value="{{ $customer->city }}">
                                                    </div>
                                                    <div class="input-block mb-3">
                                                        <label>Pincode</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter Pincode" name="pincode" value="{{ $customer->pincode }}">
                                                    </div>
                                                </div>
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
                                                    placeholder="Enter GST Number" value="{{ $customer->gst_no }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <label>Aadhaar No.</label>
                                                <input type="text" class="form-control" name="adhaar_no"
                                                    placeholder="Enter Aadhaar Number" value="{{ $customer->adhaar_no }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <label>PAN No.</label>
                                                <input type="text" class="form-control" name="pan_no"
                                                    placeholder="Enter PAN Number" value="{{ $customer->pan_no }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <label>TAN</label>
                                                <input type="text" class="form-control" name="tan"
                                                    placeholder="Enter TAN" value="{{ $customer->tan }}">
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
