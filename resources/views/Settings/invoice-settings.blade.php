<?php $page = 'invoice-settings'; ?>
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
                    <div class="card">
                        <div class="card-body w-100">
                            <div class="content-page-header">
                                <h5>Invoice Settings</h5>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <div class="input-block mb-3">
                                        <label>Invoice Prefix</label>
                                        <input type="text" class="form-control" placeholder="Enter Invoice Prefix">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="input-block mb-3">
                                        <label>Digital Signature Name</label>
                                        <input type="text" class="form-control"
                                            placeholder="Enter Digital Signature Name">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                    <div class="input-block mb-3">
                                        <label>Invoice Logo</label>
                                        <div class="input-block service-upload logo-upload mb-0">
                                            <span><img src="{{ URL::asset('/public/assets/img/icons/img-drop.svg') }}"
                                                    alt="upload"></span>
                                            <div class="drag-drop">
                                                <h6 class="drop-browse align-center">
                                                    <span class="text-info me-1">Click to Replace </span> or Drag and Drop
                                                </h6>
                                                <p class="text-muted">SVG, PNG, JPG </p>
                                                <input type="file" multiple="" id="image_sign">
                                                <div id="frames"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                    <div class="input-block mb-3">
                                        <label>Digital Signature Image</label>
                                        <div class="input-block service-upload logo-upload mb-0">
                                            <span><img src="{{ URL::asset('/public/assets/img/icons/img-drop.svg') }}"
                                                    alt="upload"></span>
                                            <div class="drag-drop">
                                                <h6 class="drop-browse align-center">
                                                    <span class="text-info me-1">Click to Replace </span> or Drag and Drop
                                                </h6>
                                                <p class="text-muted">SVG, PNG, JPG </p>
                                                <input type="file" multiple="" id="image_sign2">
                                                <div id="frames2"></div>
                                            </div>
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
