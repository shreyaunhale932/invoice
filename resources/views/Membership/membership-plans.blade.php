<?php $page = 'membership-plans'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            @component('components.page-header')
                @slot('title')
                    Membership Plans
                @endslot
            @endcomponent
            <!-- /Page Header -->

            <!-- Price Table -->
            <div class="price-table-main">
                <div class="plan-selected">
                    <h4>Monthly</h4>
                    <div class="status-toggle me-2 ms-2">
                        <input id="rating_1" class="px-4 check" type="checkbox" checked>
                        <label for="rating_1" class="px-4 checktoggle checkbox-bg">checkbox</label>
                    </div>
                    <h4>Annually</h4>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-12 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="plan-header">
                                    <span class="plan-widget-icon">
                                        <img src="{{ URL::asset('/public/assets/img/icons/plan-price-01.svg') }}" alt="plan-price">
                                    </span>
                                    <div class="plan-title">
                                        <h6>For individuals</h6>
                                        <h4 class="plan-name">Basic</h4>
                                    </div>
                                </div>
                                <div class="description-content">
                                    <p>Lorem ipsum dolor sit amet doloroli sitiol conse ctetur adipiscing elit. </p>
                                </div>
                                <div class="price-dollar">
                                    <h1 class="d-flex align-items-center">$99<span class="ms-1">/monthly</span></h1>
                                </div>
                                <div class="plan-description">
                                    <h6>What’s included</h6>
                                    <ul>
                                        <li>
                                            <span class="rounded-circle me-2"><i class="fe fe-check"></i></span>
                                            All analytics features
                                        </li>
                                        <li>
                                            <span class="rounded-circle me-2"><i class="fe fe-check"></i></span>
                                            Up to 250,000 tracked visits
                                        </li>
                                        <li>
                                            <span class="rounded-circle me-2"><i class="fe fe-check"></i></span>
                                            Normal support
                                        </li>
                                        <li>
                                            <span class="rounded-circle me-2"><i class="fe fe-check"></i></span>
                                            Up to 3 team members
                                        </li>
                                    </ul>
                                </div>
                                <div class="plan-button">
                                    <a class="btn btn-primary d-flex align-items-center justify-content-center"
                                        href="#">Get Started<span class="ms-2"><i
                                                class="fe fe-arrow-right"></i></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="card price-selected">
                            <div class="card-body plan-header-selected">
                                <div class="d-flex">
                                    <div class="plan-header">
                                        <span class="plan-widget-icon">
                                            <img src="{{ URL::asset('/public/assets/img/icons/plan-price-02.svg') }}"
                                                alt="plan-price">
                                        </span>
                                        <div class="plan-title">
                                            <h6 class="text-white">For Startups</h6>
                                            <h4 class="plan-name text-white">Pro</h4>
                                        </div>
                                    </div>
                                    <span class="price-popular">Popular</span>
                                </div>
                                <div class="description-content">
                                    <p>Lorem ipsum dolor sit amet doloroli sitiol conse ctetur adipiscing elit. </p>
                                </div>
                                <div class="price-dollar">
                                    <h1 class="d-flex align-items-center text-white">$199<span
                                            class="text-white ms-1">/monthly</span></h1>
                                </div>
                                <div class="plan-description">
                                    <h6 class="text-white">What’s included</h6>
                                    <ul>
                                        <li>
                                            <span class="rounded-circle bg-white me-2"><i
                                                    class="text-primary fe fe-check"></i></span>
                                            All analytics features
                                        </li>
                                        <li>
                                            <span class="rounded-circle bg-white me-2"><i
                                                    class="text-primary fe fe-check"></i></span>
                                            Up to 1,000,000 tracked visits
                                        </li>
                                        <li>
                                            <span class="rounded-circle bg-white me-2"><i
                                                    class="text-primary fe fe-check"></i></span>
                                            Premium support
                                        </li>
                                        <li>
                                            <span class="rounded-circle bg-white me-2"><i
                                                    class="text-primary fe fe-check"></i></span>
                                            Up to 10 team members
                                        </li>
                                    </ul>
                                </div>
                                <div class="plan-button">
                                    <a class="btn btn-white d-flex align-items-center justify-content-center"
                                        href="#">Get Started<span class="ms-2"><i
                                                class="fe fe-arrow-right"></i></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="plan-header">
                                    <span class="plan-widget-icon">
                                        <img src="{{ URL::asset('/public/assets/img/icons/plan-price-03.svg') }}" alt="plan-price">
                                    </span>
                                    <div class="plan-title">
                                        <h6>For individuals</h6>
                                        <h4 class="plan-name">Basic</h4>
                                    </div>
                                </div>
                                <div class="description-content">
                                    <p>Lorem ipsum dolor sit amet doloroli sitiol conse ctetur adipiscing elit. </p>
                                </div>
                                <div class="price-dollar">
                                    <h1 class="d-flex align-items-center">$399<span class="ms-1">/monthly</span></h1>
                                </div>
                                <div class="plan-description">
                                    <h6>What’s included</h6>
                                    <ul>
                                        <li>
                                            <span class="rounded-circle me-2"><i class="fe fe-check"></i></span>
                                            All analytics features
                                        </li>
                                        <li>
                                            <span class="rounded-circle me-2"><i class="fe fe-check"></i></span>
                                            Up to 5,000,000 tracked visits
                                        </li>
                                        <li>
                                            <span class="rounded-circle me-2"><i class="fe fe-check"></i></span>
                                            Dedicated support
                                        </li>
                                        <li>
                                            <span class="rounded-circle me-2"><i class="fe fe-check"></i></span>
                                            Up to 50 team members
                                        </li>
                                    </ul>
                                </div>
                                <div class="plan-button">
                                    <a class="btn btn-primary d-flex align-items-center justify-content-center"
                                        href="#">Get Started<span class="ms-2"><i
                                                class="fe fe-arrow-right"></i></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Price Table -->
        </div>
    </div>
    <!-- /Page Wrapper -->
@endsection
