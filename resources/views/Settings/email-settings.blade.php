<?php $page = 'email-settings'; ?>
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
                                <h5>Email Settings</h5>
                            </div>
                            <div class="row">
                                <h5 class="mail-title">mail Provider</h5>
                                <div class="col-lg-6 col-12">
                                    <div class="input-block mb-3">
                                        <div class="mail-provider">
                                            <h4>PHP Mail</h4>
                                            <div class="mail-setting">
                                                <a href="" data-bs-toggle="modal" data-bs-target="#bank_details"><i
                                                        class="fe fe-settings"></i></a>
                                                <div class="status-toggle">
                                                    <input id="rating_1" class="check" type="checkbox" checked="">
                                                    <label for="rating_1" class="checktoggle checkbox-bg">checkbox</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="input-block mb-3">
                                        <div class="mail-provider">
                                            <h4>SMTP</h4>
                                            <div class="mail-setting">
                                                <a href=""><i class="fe fe-settings"></i></a>
                                                <div class="status-toggle">
                                                    <input id="rating_2" class="check" type="checkbox" checked="">
                                                    <label for="rating_2" class="checktoggle checkbox-bg">checkbox</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="input-block mb-3">
                                        <label>Email From Name</label>
                                        <input type="text" class="form-control" placeholder="Enter Email From Name">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="input-block mb-3">
                                        <label>Email From Address</label>
                                        <input type="text" class="form-control" placeholder="Enter Email From Address">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="input-block mb-3">
                                        <label>Email Global Footer</label>
                                        <input type="text" class="form-control" placeholder="Enter Email Global Footer">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="input-block mb-3">
                                        <label>Send Test Email</label>
                                        <input type="text" class="form-control" placeholder="Enter Email Address">
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
