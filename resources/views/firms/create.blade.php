@extends('layout.mainlayout')
@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="content-page-header">
                <h5>Create New Firm</h5>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm border-0" style="border-radius: 15px;">
                    <div class="card-body">
                        <form action="{{ route('firms.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label fw-bold">Firm Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control" placeholder="Enter Firm Name" required style="border-radius: 8px;">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label fw-bold">Email Address</label>
                                        <input type="email" name="email" class="form-control" placeholder="Enter Email" style="border-radius: 8px;">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label fw-bold">Phone Number</label>
                                        <input type="text" name="phone" class="form-control" placeholder="Enter Phone Number" style="border-radius: 8px;">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label fw-bold">GSTIN</label>
                                        <input type="text" name="gstin" class="form-control" placeholder="Enter GSTIN" style="border-radius: 8px;">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label fw-bold">Address</label>
                                        <textarea name="address" class="form-control" placeholder="Enter Address" rows="3" style="border-radius: 8px;"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label fw-bold">City</label>
                                        <input type="text" name="city" class="form-control" placeholder="Enter City" style="border-radius: 8px;">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label fw-bold">State</label>
                                        <input type="text" name="state" class="form-control" placeholder="Enter State" style="border-radius: 8px;">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label fw-bold">Postal Code</label>
                                        <input type="text" name="postalcode" class="form-control" placeholder="Enter Postal Code" style="border-radius: 8px;">
                                    </div>
                                </div>
                            </div>
                            <div class="text-end mt-4">
                                <button type="reset" class="btn btn-secondary me-2 shadow-sm" style="border-radius: 8px;">Reset</button>
                                <button type="submit" class="btn btn-primary shadow-sm" style="border-radius: 8px;">Create Firm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
