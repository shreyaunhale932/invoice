<?php $page = 'template-invoice'; ?>
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
                    <div class="w-100 pt-0">
                        <div class="content-page-header">
                            <h5>Invoice Templates</h5>
                        </div>
                        <!-- All Invoice -->
                        <div class="card invoices-tabs-card">
                            <div class="invoice-template-tab invoices-main-tabs">
                                <div class="row align-items-center">
                                    <div class="col-lg-12">
                                        <div class="invoices-tabs">
                                            <ul class="nav nav-tabs">
                                                <li class="nav-item">
                                                    <a id="invoice-tab" data-bs-toggle="tab" data-bs-target="#invoice_tab"
                                                        type="button" role="tab" aria-controls="invoice_tab"
                                                        aria-selected="true" href="javascript:void(0);"
                                                        class="active">Invoice</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a id="purchases-tab" data-bs-toggle="tab"
                                                        data-bs-target="#purchases_tab" type="button" role="tab"
                                                        aria-controls="purchases_tab" aria-selected="true"
                                                        href="javascript:void(0);">Purchases
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a id="receipt-tab" data-bs-toggle="tab" data-bs-target="#receipt_tab"
                                                        type="button" role="tab" aria-controls="receipt_tab"
                                                        aria-selected="true" href="javascript:void(0);">Receipt
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content">
                            @livewire('template-invoice')
                            <div class="tab-pane" id="purchases_tab" role="tabpanel" aria-labelledby="purchases-tab"
                                tabindex="0">
                                <div class="card template-invoice-card">
                                    <div class="card-body pb-0">
                                        <div class="invoice-card-title">
                                            <h6>Purchases</h6>
                                        </div>
                                        <div class="row">
                                            <!-- Invoice List -->
                                            <div class="col-md-6 col-xl-3 col-sm-12 d-md-flex d-sm-block">
                                                <div
                                                    class="blog grid-blog invoice-blog flex-fill  d-flex flex-wrap align-content-betweens active ">
                                                    <div class="blog-image">
                                                        <a href="javascript:;" class="img-general"><img class="img-fluid"
                                                                src="{{ URL::asset('/public/assets/img/invoice-one.svg') }}"
                                                                alt="Post Image">
                                                        </a>
                                                        <a href="{{ URL::asset('/public/assets/img/invoice-one.jpg') }}"
                                                            class="preview-invoice image-popup"><i
                                                                class="fa-regular fa-eye"></i></a>
                                                    </div>
                                                    <div class="invoice-content-title">
                                                        <a href="javascript:;">General Invoice 1</a>
                                                        <span class="invoice-star" data-bs-toggle="tooltip"
                                                            data-bs-placement="left" title=""
                                                            data-bs-original-title="Make as default"><i
                                                                class="fa-regular fa-star"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /Invoice List -->
                                            <!-- Invoice List -->
                                            <div class="col-md-6 col-xl-3 col-sm-12 d-md-flex d-sm-block">
                                                <div
                                                    class="blog grid-blog invoice-blog flex-fill  d-flex flex-wrap align-content-betweens  ">
                                                    <div class="blog-image">
                                                        <a href="javascript:;" class="img-general"><img class="img-fluid"
                                                                src="{{ URL::asset('/public/assets/img/invoice - two.svg') }}"
                                                                alt="Post Image">
                                                        </a>
                                                        <a href="{{ URL::asset('/public/assets/img/invoice-two.jpg') }}"
                                                            class="preview-invoice image-popup"><i
                                                                class="fa-regular fa-eye"></i></a>
                                                    </div>
                                                    <div class="invoice-content-title">
                                                        <a href="javascript:;">General Invoice 2</a>
                                                        <span class="invoice-star" data-bs-toggle="tooltip"
                                                            data-bs-placement="left" title=""
                                                            data-bs-original-title="Make as default"><i
                                                                class="fa-regular fa-star"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /Invoice List -->
                                            <!-- Invoice List -->
                                            <div class="col-md-6 col-xl-3 col-sm-12 d-md-flex d-sm-block">
                                                <div
                                                    class="blog grid-blog invoice-blog flex-fill  d-flex flex-wrap align-content-betweens  ">
                                                    <div class="blog-image">
                                                        <a href="javascript:;" class="img-general"><img class="img-fluid"
                                                                src="{{ URL::asset('/public/assets/img/invoice - three.svg') }}"
                                                                alt="Post Image">
                                                        </a>
                                                        <a href="{{ URL::asset('/public/assets/img/invoice-three.jpg') }}"
                                                            class="preview-invoice image-popup"><i
                                                                class="fa-regular fa-eye"></i></a>
                                                    </div>
                                                    <div class="invoice-content-title">
                                                        <a href="javascript:;">General Invoice 3</a>
                                                        <span class="invoice-star" data-bs-toggle="tooltip"
                                                            data-bs-placement="left" title=""
                                                            data-bs-original-title="Make as default"><i
                                                                class="fa-regular fa-star"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /Invoice List -->
                                            <!-- Invoice List -->
                                            <div class="col-md-6 col-xl-3 col-sm-12 d-md-flex d-sm-block">
                                                <div
                                                    class="blog grid-blog invoice-blog flex-fill  d-flex flex-wrap align-content-betweens  ">
                                                    <div class="blog-image">
                                                        <a href="javascript:;" class="img-general"><img class="img-fluid"
                                                                src="{{ URL::asset('/public/assets/img/invoice-four.svg') }}"
                                                                alt="Post Image">
                                                        </a>
                                                        <a href="{{ URL::asset('/public/assets/img/invoice-four.jpg') }}"
                                                            class="preview-invoice image-popup"><i
                                                                class="fa-regular fa-eye"></i></a>
                                                    </div>
                                                    <div class="invoice-content-title">
                                                        <a href="javascript:;">General Invoice 4</a>
                                                        <span class="invoice-star" data-bs-toggle="tooltip"
                                                            data-bs-placement="left" title=""
                                                            data-bs-original-title="Make as default"><i
                                                                class="fa-regular fa-star"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /Invoice List -->
                                            <!-- Invoice List -->
                                            <div class="col-md-6 col-xl-3 col-sm-12 d-md-flex d-sm-block">
                                                <div
                                                    class="blog grid-blog invoice-blog flex-fill  d-flex flex-wrap align-content-betweens ">
                                                    <div class="blog-image">
                                                        <a href="javascript:;" class="img-general"><img class="img-fluid"
                                                                src="{{ URL::asset('/public/assets/img/invoice - five.svg') }}"
                                                                alt="Post Image">
                                                        </a>
                                                        <a href="{{ URL::asset('/public/assets/img/invoice - five.svg') }}"
                                                            class="preview-invoice image-popup"><i
                                                                class="fa-regular fa-eye"></i></a>
                                                    </div>
                                                    <div class="invoice-content-title">
                                                        <a href="javascript:;">General Invoice 5</a>
                                                        <span class="invoice-star" data-bs-toggle="tooltip"
                                                            data-bs-placement="left" title=""
                                                            data-bs-original-title="Make as default"><i
                                                                class="fa-regular fa-star"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /Invoice List -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="receipt_tab" role="tabpanel" aria-labelledby="receipt-tab"
                                tabindex="0">
                                <div class="card template-invoice-card mb-0">
                                    <div class="card-body pb-0">
                                        <div class="invoice-card-title">
                                            <h6>Receipt</h6>
                                        </div>
                                        <div class="row">
                                            <!-- Invoice List -->
                                            <div class="col-md-6 col-xl-3 col-sm-12 d-md-flex d-sm-block">
                                                <div
                                                    class="blog grid-blog invoice-blog flex-fill  d-flex flex-wrap align-content-betweens active">
                                                    <div class="blog-image">
                                                        <a href="javascript:;" class="img-general"><img class="img-fluid"
                                                                src="{{ URL::asset('/public/assets/img/cash-receipt-1.svg') }}"
                                                                alt="Post Image">
                                                        </a>
                                                        <a href="{{ URL::asset('/public/assets/img/invoices/recepit-one.jpg') }}"
                                                            class="preview-invoice image-popup"><i
                                                                class="fa-regular fa-eye"></i></a>
                                                    </div>
                                                    <div class="invoice-content-title">
                                                        <a href="javascript:;">Receipt Invoice 1</a>
                                                        <span class="invoice-star" data-bs-toggle="tooltip"
                                                            data-bs-placement="left" title=""
                                                            data-bs-original-title="Make as default"><i
                                                                class="fa-regular fa-star"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /Invoice List -->
                                            <!-- Invoice List -->
                                            <div class="col-md-6 col-xl-3 col-sm-12 d-md-flex d-sm-block">
                                                <div
                                                    class="blog grid-blog invoice-blog flex-fill  d-flex flex-wrap align-content-betweens  ">
                                                    <div class="blog-image">
                                                        <a href="javascript:;" class="img-general"><img class="img-fluid"
                                                                src="{{ URL::asset('/public/assets/img/cash-receipt-2.svg') }}"
                                                                alt="Post Image">
                                                        </a>
                                                        <a href="{{ URL::asset('/public/assets/img/invoices/recepit-two.jpg') }}"
                                                            class="preview-invoice image-popup"><i
                                                                class="fa-regular fa-eye"></i></a>
                                                    </div>
                                                    <div class="invoice-content-title">
                                                        <a href="javascript:;">Receipt Invoice 2</a>
                                                        <span class="invoice-star" data-bs-toggle="tooltip"
                                                            data-bs-placement="left" title=""
                                                            data-bs-original-title="Make as default"><i
                                                                class="fa-regular fa-star"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /Invoice List -->
                                            <!-- Invoice List -->
                                            <div class="col-md-6 col-xl-3 col-sm-12 d-md-flex d-sm-block">
                                                <div
                                                    class="blog grid-blog invoice-blog flex-fill  d-flex flex-wrap align-content-betweens  ">
                                                    <div class="blog-image">
                                                        <a href="javascript:;" class="img-general"><img class="img-fluid"
                                                                src="{{ URL::asset('/public/assets/img/cash-receipt-3.svg') }}"
                                                                alt="Post Image">
                                                        </a>
                                                        <a href="{{ URL::asset('/public/assets/img/invoices/recepit-three.jpg') }}"
                                                            class="preview-invoice image-popup"><i
                                                                class="fa-regular fa-eye"></i></a>
                                                    </div>
                                                    <div class="invoice-content-title">
                                                        <a href="javascript:;">Receipt Invoice 3</a>
                                                        <span class="invoice-star" data-bs-toggle="tooltip"
                                                            data-bs-placement="left" title=""
                                                            data-bs-original-title="Make as default"><i
                                                                class="fa-regular fa-star"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /Invoice List -->
                                            <!-- Invoice List -->
                                            <div class="col-md-6 col-xl-3 col-sm-12 d-md-flex d-sm-block">
                                                <div
                                                    class="blog grid-blog invoice-blog flex-fill  d-flex flex-wrap align-content-betweens  ">
                                                    <div class="blog-image">
                                                        <a href="javascript:;" class="img-general"><img class="img-fluid"
                                                                src="{{ URL::asset('/public/assets/img/cash-receipt-4.svg') }}"
                                                                alt="Post Image">
                                                        </a>
                                                        <a href="{{ URL::asset('/public/assets/img/invoices/recepit-four.jpg') }}"
                                                            class="preview-invoice image-popup"><i
                                                                class="fa-regular fa-eye"></i></a>
                                                    </div>
                                                    <div class="invoice-content-title">
                                                        <a href="javascript:;">Receipt Invoice 4</a>
                                                        <span class="invoice-star" data-bs-toggle="tooltip"
                                                            data-bs-placement="left" title=""
                                                            data-bs-original-title="Make as default"><i
                                                                class="fa-regular fa-star"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /Invoice List -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /All Invoice -->


                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Wrapper -->
@endsection
