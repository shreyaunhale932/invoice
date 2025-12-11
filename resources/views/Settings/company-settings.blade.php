<?php $page = 'company-settings'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->

            <!-- /Page Header -->

            <div class="row">
                <div class="col-xl-3 col-md-4">

                    <div class="card">
                        <div class="card-body">
                            <div class="page-header">
                                <div class="content-page-header">
                                    <h5>Settings</h5>
                                </div>
                            </div>
                            <!-- Settings Menu -->
                            @component('components.settings-menu')
                            @endcomponent
                            <!-- /Settings Menu -->
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-md-8">
                    <div class="card company-settings-new">
                        <div class="card-body w-100">
                            <div class="content-page-header">
                                <h5>Company Settings</h5>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <div class="input-block mb-3">
                                        <label>Company Name</label>
                                        <input type="text" class="form-control" placeholder="Enter Company Name">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="input-block mb-3">
                                        <label>Company Address</label>
                                        <input type="text" class="form-control" placeholder="Enter Company Address">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="input-block mb-3">
                                        <label>Phone Number</label>
                                        <input type="text" class="form-control" placeholder="Enter Phone Number">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="input-block mb-3">
                                        <label>Company Email</label>
                                        <input type="text" class="form-control" placeholder="Enter Company Email">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="input-block mb-3">
                                        <label>Address Line 1</label>
                                        <input type="text" class="form-control" placeholder="Enter Address Line 1">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="input-block mb-3">
                                        <label>Address Line 2</label>
                                        <input type="text" class="form-control" placeholder="Enter Address Line 2">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="input-block mb-3">
                                        <label>Country</label>
                                        <input type="text" class="form-control" placeholder="Enter Country">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="input-block mb-3">
                                        <label>State</label>
                                        <input type="text" class="form-control" placeholder="Enter State">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="input-block mb-3">
                                        <label>City</label>
                                        <input type="text" class="form-control" placeholder="Enter City">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="input-block mb-3">
                                        <label>Pincode</label>
                                        <input type="text" class="form-control" placeholder="Enter Pincode">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-12">
                                    <div class="input-block mb-3">
                                        <label>Site Logo</label>
                                        <div class="input-block service-upload logo-upload mb-0">
                                            <div class="drag-drop">
                                                <h6 class="drop-browse align-center">
                                                    <span class="text-info me-1">Click To Replace</span> or Drag and Drop
                                                </h6>
                                                <p class="text-muted">SVG, PNG, JPG (Max 800*400px)</p>
                                                <input type="file" multiple="">
                                            </div>
                                            <span class="sites-logo"><img
                                                    src="{{ URL::asset('/public/assets/img/settings-logo1png') }}"
                                                    alt="upload"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-12">
                                    <div class="input-block mb-4">
                                        <label>Favicon</label>
                                        <div class="input-block service-upload logo-upload mb-0">
                                            <div class="drag-drop">
                                                <h6 class="drop-browse align-center">
                                                    <span class="text-info me-1">Click To Replace </span> or Drag and Drop
                                                </h6>
                                                <p class="text-muted">SVG, PNG, JPG (Max 35*35px)</p>
                                                <input type="file" multiple="">
                                            </div>
                                            <span class="sites-logo"><img
                                                    src="{{ URL::asset('/public/assets/img/settings-logopng') }}" alt="upload">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-12">
                                    <div class="input-block mb-4">
                                        <label>Company icon</label>
                                        <div class="input-block service-upload logo-upload mb-0">
                                            <div class="drag-drop">
                                                <h6 class="drop-browse align-center">
                                                    <span class="text-info me-1">Click To Replace </span> or Drag and Drop
                                                </h6>
                                                <p class="text-muted">SVG, PNG, JPG (Max 800*400px)</p>
                                                <input type="file" multiple="">
                                            </div>
                                            <span class="sites-logo"><img
                                                    src="{{ URL::asset('/public/assets/img/settings-logopng') }}"
                                                    alt="upload"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="btn-path text-end">
                                        <a href="javascript:void(0);"
                                            class="btn btn-cancel bg-primary-light me-3">Cancel</a>
                                        <a href="javascript:void(0);" class="btn btn-primary">Save Changes</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Wrapper -->
@endsection
