<?php $page = 'invoice-details-admin'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="card">
                <div class="card-body">
                    <div class="page-header">
                        <div class="content-invoice-header">
                            <h5>Invoice Details</h5>

                        </div>
                    </div>
                    <!-- /Page Header -->
                    <div class="row justify-content-center">
                       @livewire('invoice-details-admin')
                        <div class="col-lg-4">
                            <div class="card timeline-card">
                                <div class="card-body">
                                    <div class="input-block mb-3">
                                        <label>Status</label>
                                        <select class="select">
                                            <option>Paid</option>
                                            <option>Unpaid</option>
                                            <option>Partially paid</option>
                                            <option>Overdue</option>
                                            <option>Cancelled</option>
                                            <option>Refunded</option>
                                            <option>Draft</option>
                                        </select>
                                    </div>
                                    <div class="invoice-info invoice-info2 admin-invoice invoice-item mb-4">
                                        <strong class="customer-text-one">Payment Details<span>:</span></strong>
                                        <p class="text-start invoice-details-two invoice-details mb-2">
                                            PayPal :<strong>examplepaypal.co</strong>
                                        </p>
                                        <p class="text-start invoice-details-two invoice-details mb-2">
                                            Account :<strong>examplepaypal.co</strong>
                                        </p>
                                        <p class="text-start invoice-details-two invoice-details">
                                            Payment Term :
                                        </p>
                                        <div class="due-date">
                                            <strong>15 days</strong><span class="text-danger">Due in 8 days</span>
                                        </div>
                                    </div>
                                    <strong class="customer-text-one">Timeline<span>:</span></strong>
                                    <ul class="activity-feed">
                                        <li class="feed-item timeline-item">
                                            <span class="feed-text timeline-user"><a href="{{ url('profile') }}">John
                                                    Smith</a> Created Invoice</span>
                                            <div class="invoice-date"><span class="start-date">07 April 2023</span><span>07
                                                    April 2023</span></div>
                                        </li>
                                        <li class="feed-item timeline-item">
                                            <span class="feed-text timeline-user"><a href="{{ url('profile') }}">John
                                                    Smith</a> Created Invoice</span>
                                            <div class="invoice-date"><span class="start-date">07 April 2023</span><span>07
                                                    April 2023</span></div>
                                        </li>
                                        <li class="feed-item timeline-item">
                                            <span class="feed-text timeline-user"><a href="{{ url('profile') }}">John
                                                    Smith</a> Created Invoice</span>
                                            <div class="invoice-date"><span class="start-date">07 April 2023</span><span>07
                                                    April 2023</span></div>
                                        </li>
                                        <li class="feed-item timeline-item">
                                            <span class="feed-text timeline-user"><a href="{{ url('profile') }}">John
                                                    Smith</a> Created Invoice</span>
                                            <div class="invoice-date"><span class="start-date">07 April 2023</span><span>07
                                                    April 2023</span></div>
                                        </li>
                                        <li class="feed-item timeline-item">
                                            <span class="feed-text timeline-user"><a href="{{ url('profile') }}">John
                                                    Smith</a> Created Invoice</span>
                                            <div class="invoice-date"><span class="start-date">07 April 2023</span><span>07
                                                    April 2023</span></div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="terms-conditions">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-lg-6 col-md-6">
                                    <div class="invoice-terms align-center justify-content-start">
                                        <span class="invoice-terms-icon bg-white-smoke me-3">
                                            <i class="fe fe-file-text"></i>
                                        </span>
                                        <div class="invocie-note">
                                            <h6>Terms & Conditions</h6>
                                            <p class="mb-0">Authoritatively envisioneer business action items through
                                                parallel sources.</p>
                                        </div>
                                    </div>
                                    <div class="invoice-terms align-center justify-content-start">
                                        <span class="invoice-terms-icon bg-white-smoke me-3">
                                            <i class="fe fe-file-minus"></i>
                                        </span>
                                        <div class="invocie-note">
                                            <h6>Note</h6>
                                            <p class="mb-0">This is computer generated receipt and does not require
                                                physical signature.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="invoice-sign text-end col-lg-6">
                                    <span class="d-block">Authorised Sign</span>
                                    <img class="img-fluid d-inline-block light-color-logo"
                                        src="{{ URL::asset('/public/assets/img/signature.png') }}" alt="sign">
                                    <img class="img-fluid d-inline-block dark-white-logo"
                                        src="{{ URL::asset('/public/assets/img/signature-white.png') }}" alt="sign">
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
