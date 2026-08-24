@extends('layout.mainlayout')
@section('content')
<style>
    .form-label{
        margin-bottom: 0px;
            color: #4a5568;
            font-weight: 500;
            font-size: 12px;
    }
    </style>
<div class="page-wrapper">
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="content-page-header">
                <h5>Edit Firm: {{ $firm->name }}</h5>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm border-0" style="border-radius: 15px;">
                    <div class="card-body">
                        <form action="{{ route('firms.update', $firm->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label ">Firm Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control" value="{{ $firm->name }}" required style="border-radius: 8px;">
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label ">Email Address</label>
                                        <input type="email" name="email" class="form-control" value="{{ $firm->email }}" style="border-radius: 8px;">
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label ">Phone Number</label>
                                        <input type="text" name="phone" class="form-control" value="{{ $firm->phone }}" style="border-radius: 8px;">
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label ">GSTIN</label>
                                        <input type="text" name="gstin" class="form-control" value="{{ $firm->gstin }}" style="border-radius: 8px;">
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label ">Address</label>
                                        <textarea name="address" class="form-control" rows="3" style="border-radius: 8px;">{{ $firm->address }}</textarea>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label ">City</label>
                                        <input type="text" name="city" class="form-control" value="{{ $firm->city }}" style="border-radius: 8px;">
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label ">State</label>
                                        <input type="text" name="state" class="form-control" value="{{ $firm->state }}" style="border-radius: 8px;">
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label ">Postal Code</label>
                                        <input type="text" name="postalcode" class="form-control" value="{{ $firm->postalcode }}" style="border-radius: 8px;">
                                    </div>
                                </div>
                            </div>
                            <div class="text-end mt-4">
                                <a href="{{ route('firms.index') }}" class="btn btn-secondary me-2 shadow-sm" style="border-radius: 8px;">Cancel</a>
                                <button type="submit" class="btn btn-primary shadow-sm" style="border-radius: 8px;">Update Firm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
