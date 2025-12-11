<?php $page = 'invoice-template'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="content-page-header">
                    <h5>Invoice Templates</h5>
                </div>
            </div>
            <!-- /Page Header -->
            <div class="card mb-0">
                <div class="card-body pb-0">
                    <div class="invoice-card-title">
                        <h6>General Invoice</h6>
                    </div>
                    <div class="row">
                        <!-- Invoice List -->
                        <div class="col-md-6 col-xl-3 col-sm-12 d-md-flex d-sm-block">
                            <div class="blog grid-blog flex-fill  d-flex flex-wrap align-content-betweens ">
                                <div class="blog-image">
                                    <a href="{{ url('invoice-one-a') }}"><img class="img-fluid"
                                            src="{{ URL::asset('/public/assets/img/invoice-one.svg') }}" alt="Post Image">
                                    </a>
                                </div>
                                <div class="{{ url('invoice-content-title') }}">
                                    <a href="{{ url('invoice-one-a') }}">
                                        General Invoice 1</a>
                                </div>
                            </div>
                        </div>
                        <!-- /Invoice List -->
                        <!-- Invoice List -->
                        <div class="col-md-6 col-xl-3 col-sm-12 d-md-flex d-sm-block">
                            <div class="blog grid-blog flex-fill  d-flex flex-wrap align-content-between">

                                <div class="blog-image">
                                    <a href="{{ url('invoice-two') }}"><img class="img-fluid"
                                            src="{{ URL::asset('/public/assets/img/invoice-two.jpg') }}" alt="Post Image">
                                    </a>
                                </div>
                                <div class="invoice-content-title">
                                    <a href="{{ url('invoice-two') }}">
                                        General Invoice 2
                                    </a>
                                </div>

                            </div>
                        </div>
                        <!-- /Invoice List -->
                        <!-- Invoice List -->
                        <div class="col-md-6 col-xl-3 col-sm-12 d-md-flex d-sm-block">
                            <div class="blog grid-blog flex-fill  d-flex flex-wrap align-content-between ">
                                <div class="blog-image">
                                    <a href="{{ url('invoice-three') }}"><img class="img-fluid"
                                            src="{{ URL::asset('/public/assets/img/invoice - three.svg') }}" alt="Post Image">
                                    </a>
                                </div>
                                <div class="invoice-content-title">
                                    <a href="{{ url('invoice-three') }}">
                                        General Invoice 3
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- /Invoice List -->
                        <!-- Invoice List -->
                        <div class="col-md-6 col-xl-3 col-sm-12 d-md-flex d-sm-block">
                            <div class="blog grid-blog flex-fill  d-flex flex-wrap align-content-between">
                                <div class="blog-image">
                                    <a href="{{ url('invoice-four-a') }}"><img class="img-fluid"
                                            src="{{ URL::asset('/public/assets/img/invoice-four.svg') }}" alt="Post Image">
                                    </a>
                                </div>
                                <div class="invoice-content-title">
                                    <a href="{{ url('invoice-four-a') }}">
                                        General Invoice 4
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- Invoice List -->
                        <div class="col-md-6 col-xl-3 col-sm-12 d-md-flex d-sm-block">
                            <div class="blog grid-blog flex-fill  d-flex flex-wrap align-content-between">
                                <div class="blog-image">
                                    <a href="{{ url('invoice-five') }}"><img class="img-fluid"
                                            src="{{ URL::asset('/public/assets/img/invoice - five.svg') }}" alt="Post Image">
                                    </a>
                                </div>
                                <div class="invoice-content-title">
                                    <a href="i{{ url('nvoice-five') }}">
                                        General Invoice 5
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- /Invoice List -->
                        <!-- /Invoice List -->
                    </div>
                    <div class="row">
                        <!-- /Invoice List -->
                        <div class="row">
                            <div class="invoice-card-title">
                                <h6>Receipt Invoice</h6>
                            </div>
                            <!-- Invoice List -->
                            <div class="col-md-6 col-xl-3 col-sm-12 d-md-flex d-sm-block">
                                <div class="blog grid-blog flex-fill  d-flex flex-wrap align-content-between">
                                    <div class="blog-image">
                                        <a href="{{ url('cashreceipt-1') }}"><img class="img-fluid"
                                                src="{{ URL::asset('/public/assets/img/cash-receipt-1.svg') }}" alt="Post Image">
                                        </a>
                                    </div>
                                    <div class="invoice-content-title">
                                        <a href="{{ url('cashreceipt-1') }}">
                                            Cash Receipt 1
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- /Invoice List -->
                            <!-- Invoice List -->
                            <div class="col-md-6 col-xl-3 col-sm-12 d-md-flex d-sm-block">
                                <div class="blog grid-blog flex-fill  d-flex flex-wrap align-content-between ">
                                    <div class="blog-image">
                                        <a href="{{ url('cashreceipt-2') }}"><img class="img-fluid"
                                                src="{{ URL::asset('/public/assets/img/cash-receipt-2.svg') }}" alt="Post Image">
                                        </a>
                                    </div>
                                    <div class="invoice-content-title">
                                        <a href="{{ url('cashreceipt-2') }}">
                                            Cash Receipt 2
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- /Invoice List -->
                            <!-- Invoice List -->
                            <div class="col-md-6 col-xl-3 col-sm-12 d-md-flex d-sm-block">
                                <div class="blog grid-blog flex-fill  d-flex flex-wrap align-content-between ">
                                    <div class="blog-image">
                                        <a href="{{ url('cashreceipt-3') }}"><img class="img-fluid"
                                                src="{{ URL::asset('/public/assets/img/cash-receipt-3.svg') }}" alt="Post Image">
                                        </a>
                                    </div>
                                    <div class="invoice-content-title">
                                        <a href="{{ url('cashreceipt-3') }}">
                                            Cash Receipt 3
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- /Invoice List -->
                            <!-- Invoice List -->
                            <div class="col-md-6 col-xl-3 col-sm-12 d-md-flex d-sm-block">
                                <div class="blog grid-blog flex-fill  d-flex flex-wrap align-content-between ">
                                    <div class="blog-image">
                                        <a href="{{ url('cashreceipt-4') }}"><img class="img-fluid"
                                                src="{{ URL::asset('/public/assets/img/cash-receipt-4.svg') }}" alt="Post Image">
                                        </a>
                                    </div>
                                    <div class="invoice-content-title">
                                        <a href="{{ url('cashreceipt-4') }}">
                                            Cash Receipt 4
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- /Invoice List -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Wrapper -->
@endsection
