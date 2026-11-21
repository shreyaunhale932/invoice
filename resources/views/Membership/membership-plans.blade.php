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
                        <input id="rating_1" class="px-4 check" type="checkbox">
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
                                        <img src="{{ asset('/assets/img/icons/plan-price-01.svg') }}" alt="plan-price">
                                    </span>
                                    <div class="plan-title">
                                        <h6>For individuals</h6>
                                        <h4 class="plan-name">Basic</h4>
                                    </div>
                                </div>
                                <div class="description-content">
                                    <p>Essential billing and inventory tools to run your jewellery store with confidence.</p>
                                </div>
                                <div class="price-dollar">
                                    <h1 class="d-flex align-items-center">₹<span class="plan-price-val" data-monthly="2,520" data-yearly="29,500">2,520</span><span class="ms-1 plan-period" data-monthly="/monthly" data-yearly="/annually">/monthly</span></h1>
                                    <div class="d-flex align-items-center gap-2 mt-1">
                                        <del class="text-muted plan-original" data-monthly="₹3,000" data-yearly="₹50,000">₹3,000</del>
                                        <span class="badge bg-success-light plan-discount" data-monthly="16% Off" data-yearly="41% Off">16% Off</span>
                                    </div>
                                    <small class="text-success d-block mt-1 plan-savings" data-monthly="You Save ₹480" data-yearly="You Save ₹20,500">You Save ₹480</small>
                                </div>
                                <div class="plan-description">
                                    <h6>What’s included</h6>
                                    <ul>
                                        <li>
                                            <span class="rounded-circle me-2"><i class="fe fe-check"></i></span>
                                            Inventory & tag management
                                        </li>
                                        <li>
                                            <span class="rounded-circle me-2"><i class="fe fe-check"></i></span>
                                            GST billing
                                        </li>
                                        <li>
                                            <span class="rounded-circle me-2"><i class="fe fe-check"></i></span>
                                            Barcode printing
                                        </li>
                                        <li>
                                            <span class="rounded-circle me-2"><i class="fe fe-check"></i></span>
                                            Normal support
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
                                            <img src="{{ asset('/assets/img/icons/plan-price-02.svg') }}"
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
                                    <p>Faster billing, smart automation, and better controls as your business grows.</p>
                                </div>
                                <div class="price-dollar">
                                    <h1 class="d-flex align-items-center text-white">₹<span class="plan-price-val" data-monthly="4,200" data-yearly="49,700">4,200</span><span
                                            class="text-white ms-1 plan-period" data-monthly="/monthly" data-yearly="/annually">/monthly</span></h1>
                                    <div class="d-flex align-items-center gap-2 mt-1">
                                        <del class="text-white-50 plan-original" data-monthly="₹5,000" data-yearly="₹70,000">₹5,000</del>
                                        <span class="badge bg-white text-primary plan-discount" data-monthly="16% Off" data-yearly="29% Off">16% Off</span>
                                    </div>
                                    <small class="text-white d-block mt-1 plan-savings" data-monthly="You Save ₹800" data-yearly="You Save ₹20,300">You Save ₹800</small>
                                </div>
                                <div class="plan-description">
                                    <h6 class="text-white">What’s included</h6>
                                    <ul>
                                        <li>
                                            <span class="rounded-circle bg-white me-2"><i
                                                     class="text-primary fe fe-check"></i></span>
                                            Karigar & old-gold workflows
                                        </li>
                                        <li>
                                            <span class="rounded-circle bg-white me-2"><i
                                                    class="text-primary fe fe-check"></i></span>
                                            CRM, schemes & loyalty
                                        </li>
                                        <li>
                                            <span class="rounded-circle bg-white me-2"><i
                                                    class="text-primary fe fe-check"></i></span>
                                            Advanced MIS reports
                                        </li>
                                        <li>
                                            <span class="rounded-circle bg-white me-2"><i
                                                    class="text-primary fe fe-check"></i></span>
                                            Premium support
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
                                        <img src="{{ asset('/assets/img/icons/plan-price-03.svg') }}" alt="plan-price">
                                    </span>
                                    <div class="plan-title">
                                        <h6>For Established Teams</h6>
                                        <h4 class="plan-name">Premium</h4>
                                    </div>
                                </div>
                                <div class="description-content">
                                    <p>Complete operational control with powerful reporting and priority assistance.</p>
                                </div>
                                <div class="price-dollar">
                                    <h1 class="d-flex align-items-center">₹<span class="plan-price-val" data-monthly="6,230" data-yearly="69,300">6,230</span><span class="ms-1 plan-period" data-monthly="/monthly" data-yearly="/annually">/monthly</span></h1>
                                    <div class="d-flex align-items-center gap-2 mt-1">
                                        <del class="text-muted plan-original" data-monthly="₹7,000" data-yearly="₹90,000">₹7,000</del>
                                        <span class="badge bg-success-light plan-discount" data-monthly="11% Off" data-yearly="23% Off">11% Off</span>
                                    </div>
                                    <small class="text-success d-block mt-1 plan-savings" data-monthly="You Save ₹770" data-yearly="You Save ₹20,700">You Save ₹770</small>
                                </div>
                                <div class="plan-description">
                                    <h6>What’s included</h6>
                                    <ul>
                                        <li>
                                            <span class="rounded-circle me-2"><i class="fe fe-check"></i></span>
                                            Centralized multi-branch control
                                        </li>
                                        <li>
                                            <span class="rounded-circle me-2"><i class="fe fe-check"></i></span>
                                            Manufacturing & integrations
                                        </li>
                                        <li>
                                            <span class="rounded-circle me-2"><i class="fe fe-check"></i></span>
                                            Dedicated account manager
                                        </li>
                                        <li>
                                            <span class="rounded-circle me-2"><i class="fe fe-check"></i></span>
                                            Priority 24/7 support
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

<script>
document.addEventListener("DOMContentLoaded", function () {
    const toggleInput = document.getElementById("rating_1");
    if (!toggleInput) return;

    function updateMembershipPlans() {
        const period = toggleInput.checked ? "yearly" : "monthly";
        document.querySelectorAll(".plan-price-val").forEach(el => {
            el.textContent = el.getAttribute("data-" + period);
        });
        document.querySelectorAll(".plan-period").forEach(el => {
            el.textContent = el.getAttribute("data-" + period);
        });
        document.querySelectorAll(".plan-original").forEach(el => {
            el.textContent = el.getAttribute("data-" + period);
        });
        document.querySelectorAll(".plan-discount").forEach(el => {
            el.textContent = el.getAttribute("data-" + period);
        });
        document.querySelectorAll(".plan-savings").forEach(el => {
            el.textContent = el.getAttribute("data-" + period);
        });
    }

    toggleInput.addEventListener("change", updateMembershipPlans);
    updateMembershipPlans();
});
</script>
        </div>
    </div>
    <!-- /Page Wrapper -->
@endsection
