<?php $page = 'plan-billing'; ?>
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
                                <h5 class="setting-menu">Plan & Billing</h5>
                            </div>
                            <div class="owl-carousel" id="plan-billing-slider">
                                <div class="owl-carousel-item">
                                    <div class="packages card active">
                                        <div class="package-header d-sm-flex justify-content-between">
                                            <div class="d-sm-flex">
                                                <span
                                                    class="icon-frame d-flex align-items-center justify-content-center"><img
                                                        src="{{ URL::asset('/public/assets/img/icons/basic.svg') }}"
                                                        alt="img"></span>
                                                <div class="">
                                                    <h5><a href="javascript:void(0);">Basic</a></h5>
                                                    <p>36 days remaining</p>
                                                    <a href="javascript:void(0);" class="cancel-subscription">Cancel
                                                        Subscription</a>
                                                </div>
                                            </div>
                                            <div>
                                                <h5>$49.99</h5>
                                                <p>Monthly</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="owl-carousel-item">
                                    <div class="packages card">
                                        <div class="package-header d-md-flex justify-content-between">
                                            <div class="d-md-flex">
                                                <span
                                                    class="icon-frame d-flex align-items-center justify-content-center"><img
                                                        src="{{ URL::asset('/public/assets/img/icons/enterprise.svg') }}"
                                                        alt="img"></span>
                                                <div class="">
                                                    <h5><a href="javascript:void(0);">ENTERPRISES</a></h5>
                                                    <p>365 days remaining</p>
                                                    <a href="javascript:void(0);">Upgrade</a>
                                                </div>
                                            </div>
                                            <div>
                                                <h5>$199.99</h5>
                                                <p>Yearly</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="owl-carousel-item">
                                    <div class="packages card">
                                        <div class="package-header d-md-flex justify-content-between">
                                            <div class="d-md-flex">
                                                <span
                                                    class="icon-frame d-flex align-items-center justify-content-center"><img
                                                        src="{{ URL::asset('/public/assets/img/icons/basic.svg') }}"
                                                        alt="img"></span>
                                                <div class="">
                                                    <h5><a href="javascript:void(0);">Basic</a></h5>
                                                    <p>36 days remaining</p>
                                                    <a href="javascript:void(0);" class="cancel-subscription">Cancel
                                                        Subscription</a>
                                                </div>
                                            </div>
                                            <div>
                                                <h5>$49.99</h5>
                                                <p>Monthly</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="owl-carousel-item">
                                    <div class="packages card">
                                        <div class="package-header d-md-flex justify-content-between">
                                            <div class="d-md-flex">
                                                <span
                                                    class="icon-frame d-flex align-items-center justify-content-center"><img
                                                        src="{{ URL::asset('/public/assets/img/icons/enterprise.svg') }}"
                                                        alt="img"></span>
                                                <div class="">
                                                    <h5><a href="javascript:void(0);">ENTERPRISES</a></h5>
                                                    <p>365 days remaining</p>
                                                    <a href="javascript:void(0);">Upgrade</a>
                                                </div>
                                            </div>
                                            <div>
                                                <h5>$199.99</h5>
                                                <p>Yearly</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- Search Filter -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class=" card-table">
                                        <div class="card-body">
                                            <div class="table-responsive table-plan-billing">
                                                <table class="table table-center table-hover datatable">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Date</th>
                                                            <th>Details</th>
                                                            <th>Status</th>
                                                            <th>Download</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $json = file_get_contents(public_path('../public/public/assets/json/plan-billing.json'));
                                                            $plans = json_decode($json, true);
                                                        @endphp
                                                        @foreach ($plans as $plan)
                                                            <tr>
                                                                <td>{{ $plan['Id'] }}</td>
                                                                <td>{{ $plan['Date'] }}</td>
                                                                <td>
                                                                    {{ $plan['Details'] }}
                                                                    <p>{{ $plan['Period'] }}</p>
                                                                </td>
                                                                <td>{{ $plan['Status'] }}</td>
                                                                <td><a class=" btn-action-icon me-2"
                                                                        href="javascript:void(0);" download><i
                                                                            class="fe fe-download"></i></a></td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
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
