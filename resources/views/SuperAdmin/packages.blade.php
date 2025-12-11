<?php $page = 'packages'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid pb-0">

            <div class="subscription-plane-head">
                <ul>
                    <li>
                        <a href="{{ url('packages') }}" class="active">Subscription Plans</a>
                    </li>
                    <li>
                        <a href="{{ url('subscription') }}">Subscribers List</a>
                    </li>
                </ul>
            </div>
            <!-- Page Header -->
            @component('components.page-header')
                @slot('title')
                    Packages
                @endslot
            @endcomponent
            <!-- /Page Header -->

            <div class="super-admin-list-head">
                <div class="row">
                    <div class="col-xl-3 col-md-6 d-flex">
                        <div class="card w-100">
                            <div class="card-body">
                                <div class="grid-info-item total-plane">
                                    <div class="grid-info">
                                        <span>Total Plan</span>
                                        <h4>07</h4>
                                    </div>
                                    <div class="grid-head-icon">
                                        <i class="fe fe-package"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 d-flex">
                        <div class="card w-100">
                            <div class="card-body">
                                <div class="grid-info-item active-plane">
                                    <div class="grid-info">
                                        <span>Active Plans</span>
                                        <h4>07</h4>
                                    </div>
                                    <div class="grid-head-icon">
                                        <i class="fe fe-list"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 d-flex">
                        <div class="card w-100">
                            <div class="card-body">
                                <div class="grid-info-item inactive-plane">
                                    <div class="grid-info">
                                        <span>Inactive Plans</span>
                                        <h4>0</h4>
                                    </div>
                                    <div class="grid-head-icon">
                                        <i class="fe fe-pause-circle"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 d-flex">
                        <div class="card w-100">
                            <div class="card-body">
                                <div class="grid-info-item total-type">
                                    <div class="grid-info">
                                        <span>No of Plan Types</span>
                                        <h4>04</h4>
                                    </div>
                                    <div class="grid-head-icon">
                                        <i class="fe fe-pocket"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row d-flex align-items-center justify-content-center">
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                    <div class="packages card">
                        <div class="package-header d-flex justify-content-between">
                            <div class="d-flex justify-content-between w-100">
                                <div class="">
                                    <h6>Monthly</h6>
                                    <h4>Free</h4>
                                </div>
                                <span class="icon-frame d-flex align-items-center justify-content-center"><img
                                        src="{{ URL::asset('/public/assets/img/icons/price-01.svg') }}" alt="img"></span>
                            </div>

                        </div>
                        <p>Lorem ipsum dolor sit amet doloroli sitiol conse ctetur </p>
                        <h2>$0.00</h2>
                        <h6>What’s included</h6>
                        <ul>
                            <li><i class="fa-solid fa-circle-check"></i>2 Users</li>
                            <li><i class="fa-solid fa-circle-check"></i>1 Suppliers</li>
                            <li><i class="fa-solid fa-circle-check"></i>10 Products</li>
                            <li><i class="fa-solid fa-circle-check"></i>1 Invoice</li>
                        </ul>
                        <div class="d-flex justify-content-center package-edit">
                            <a class="btn-action-icon me-2" href="javascript:void(0);" data-bs-toggle="modal"
                                data-bs-target="#edit_package"><i class="fe fe-edit"></i></a>
                            <a class="btn-action-icon" href="javascript:void(0);" data-bs-toggle="modal"
                                data-bs-target="#delete_modal"><i class="fe fe-trash-2"></i></a>
                        </div>

                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                    <div class="packages card">
                        <div class="package-header d-flex justify-content-between">
                            <div class="d-flex justify-content-between w-100">
                                <div class="">
                                    <h6>Yearly</h6>
                                    <h4>Basic</h4>
                                </div>
                                <span class="icon-frame d-flex align-items-center justify-content-center"><img
                                        src="{{ URL::asset('/public/assets/img/icons/price-02.svg') }}" alt="img"></span>
                            </div>

                        </div>
                        <p>Lorem ipsum dolor sit amet doloroli sitiol conse ctetur </p>
                        <h2>$19.99</h2>
                        <h6>What’s included</h6>
                        <ul>
                            <li><i class="fa-solid fa-circle-check"></i>5 Users</li>
                            <li><i class="fa-solid fa-circle-check"></i>5 Suppliers</li>
                            <li><i class="fa-solid fa-circle-check"></i>100 Products</li>
                            <li><i class="fa-solid fa-circle-check"></i>10 Invoice</li>
                        </ul>
                        <div class="d-flex justify-content-center package-edit">
                            <a class="btn-action-icon me-2" href="javascript:void(0);" data-bs-toggle="modal"
                                data-bs-target="#edit_package"><i class="fe fe-edit"></i></a>
                            <a class="btn-action-icon" href="javascript:void(0);" data-bs-toggle="modal"
                                data-bs-target="#delete_modal"><i class="fe fe-trash-2"></i></a>
                        </div>

                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                    <div class="packages card">
                        <div class="package-header d-flex justify-content-between">
                            <div class="d-flex justify-content-between w-100">
                                <div class="">
                                    <h6>Lifetime</h6>
                                    <h4>Premium</h4>
                                </div>
                                <span class="icon-frame d-flex align-items-center justify-content-center"><img
                                        src="{{ URL::asset('/public/assets/img/icons/price-03.svg') }}" alt="img"></span>
                            </div>
                        </div>
                        <span class="recommend-text">Recommended</span>
                        <p>Lorem ipsum dolor sit amet doloroli sitiol conse ctetur </p>
                        <h2>$6549.99</h2>
                        <h6>What’s included</h6>
                        <ul>
                            <li><i class="fa-solid fa-circle-check"></i>50 Users</li>
                            <li><i class="fa-solid fa-circle-check"></i>10 Suppliers</li>
                            <li><i class="fa-solid fa-circle-check"></i>1000 Products</li>
                            <li><i class="fa-solid fa-circle-check"></i>1000 Invoice</li>
                        </ul>
                        <div class="d-flex justify-content-center package-edit">
                            <a class="btn-action-icon me-2" href="javascript:void(0);" data-bs-toggle="modal"
                                data-bs-target="#edit_package"><i class="fe fe-edit"></i></a>
                            <a class="btn-action-icon" href="javascript:void(0);" data-bs-toggle="modal"
                                data-bs-target="#delete_modal"><i class="fe fe-trash-2"></i></a>
                        </div>

                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                    <div class="packages card">
                        <div class="package-header d-flex justify-content-between">
                            <div class="d-flex justify-content-between w-100">
                                <div class="">
                                    <h6>Yearly</h6>
                                    <h4>Enterprise</h4>
                                </div>
                                <span class="icon-frame d-flex align-items-center justify-content-center"><img
                                        src="{{ URL::asset('/public/assets/img/icons/price-04.svg') }}" alt="img"></span>
                            </div>

                        </div>
                        <p>Lorem ipsum dolor sit amet doloroli sitiol conse ctetur </p>
                        <h2>$99.99</h2>
                        <h6>What’s included</h6>
                        <ul>
                            <li><i class="fa-solid fa-circle-check"></i>1000 Users</li>
                            <li><i class="fa-solid fa-circle-check"></i>Unlimited Suppliers</li>
                            <li><i class="fa-solid fa-circle-check"></i>Unlimited Products</li>
                            <li><i class="fa-solid fa-circle-check"></i>Unlimited Invoice</li>
                        </ul>
                        <div class="d-flex justify-content-center package-edit">
                            <a class="btn-action-icon me-2" href="javascript:void(0);" data-bs-toggle="modal"
                                data-bs-target="#edit_package"><i class="fe fe-edit"></i></a>
                            <a class="btn-action-icon" href="javascript:void(0);" data-bs-toggle="modal"
                                data-bs-target="#delete_modal"><i class="fe fe-trash-2"></i></a>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- /Page Wrapper -->
@endsection
