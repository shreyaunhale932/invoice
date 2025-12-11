<?php $page = 'preferences'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="row">
                <div class="col-xl-3 col-md-4">
                    <div class="card">
                        <div class="card-body">

                            <!-- Page Header -->
                            <div class="page-header">
                                <div class="content-page-header">
                                    <h5>Settings</h5>
                                </div>
                            </div>
                            <!-- /Page Header -->

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
                                <h5>Preference Settings</h5>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <div class="input-block mb-3">
                                        <label>Currency</label>
                                        <select class="select">
                                            <option>Select Currency</option>
                                            <option>USD - US Dollar</option>
                                            <option>GBP - British Pound</option>
                                            <option>EUR - Euro</option>
                                            <option>INR - Indian Rupee</option>
                                            <option>AUD - Australian Dollar</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="input-block mb-3">
                                        <label>Language</label>
                                        <select class="select">
                                            <option>Select Language</option>
                                            <option>English</option>
                                            <option>French</option>
                                            <option>German</option>
                                            <option>Italian</option>
                                            <option>Spanish</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                    <div class="input-block mb-3">
                                        <label>Time Zone</label>
                                        <select class="select">
                                            <option>Select Time Zone</option>
                                            <option>(UTC+09:00) Tokyo</option>
                                            <option>(UTC+11:00) INR</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                    <div class="input-block mb-3">
                                        <label>Date Format</label>
                                        <select class="select">
                                            <option>Select Date Format</option>
                                            <option>2023 Nov 09</option>
                                            <option>09 Nov 2023</option>
                                            <option>09/11/2023</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                    <div class="input-block mb-3">
                                        <label>Time Format</label>
                                        <select class="select">
                                            <option>Select Time Format</option>
                                            <option>12:00 AM - 12:00 PM</option>
                                            <option>12:00 AM - 02:00 PM</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                    <div class="input-block mb-3">
                                        <label>Financial Year </label>
                                        <select class="select">
                                            <option>Select Financial Year </option>
                                            <option>January-December</option>
                                            <option>February-January</option>
                                            <option>March-February</option>
                                        </select>
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
