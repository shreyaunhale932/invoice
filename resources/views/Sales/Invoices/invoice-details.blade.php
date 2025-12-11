<?php $page = 'invoice-details'; ?>
@extends('layout.mainlayout')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper ">
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="card">
            <div class="card-body">
                <div class="page-header">
                    <div class="content-invoice-header">
                        <h5>Invoice Detailsf</h5>
                        <div class="list-btn">
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="invoice-card">
                            <div class="card-bod">
                                <div class="card-table">
                                    <div class="card-bod">
                                        <!-- Invoice Logo -->
                                        <div class="invoice-item invoice-item-one">
                                            <div class="row align-items-center">
                                                <div class="col-md-6">
                                                    <div class="invoice-logo">
                                                        <img class="light-color-logo"
                                                            src="{{ URL::asset('/public/assets/img/logo.png') }}"
                                                            alt="logo">
                                                        <img src="{{ URL::asset('/public/assets/img/logo-full-white.png') }}"
                                                            class="dark-white-logo" alt="logo">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="invoice-info">
                                                        <h1 class="text-warning"></h1>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Invoice Logo -->

                                        <!-- Invoice Date -->
                                        <div class="invoice-item invoice-item-date">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <p class="text-start invoice-details">
                                                        Issue Date<span>: </span><strong>{{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d M Y') }}</strong>
                                                    </p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="text-start invoice-details">
                                                        Due Date<span>: </span><strong>{{ \Carbon\Carbon::parse($invoice->due_date)->format('d M Y') }}</strong>
                                                        @php
                                                        $dueInDays = \Carbon\Carbon::parse($invoice->due_date)->startOfDay()->diffInDays(now()->startOfDay(), false);
                                                        @endphp
                                                        @if ($dueInDays < 0)
                                                            <span class="text-danger">Due in {{ abs($dueInDays) }} days</span>
                                                            @elseif ($dueInDays === 0)
                                                            <span class="text-warning">Due Today</span>
                                                            @else
                                                            <span class="text-success">Overdue by {{ $dueInDays }} days</span>
                                                            @endif

                                                    </p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="invoice-details">
                                                        Invoice No<span>: </span><strong>{{ $invoice->invoice_number ?? 'N/A' }}</strong>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Invoice Date -->


                                        <!-- Invoice To -->
                                        <div class="invoice-item invoice-item-two">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="invoice-info mb-3">
                                                        <strong class="customer-text-one">Invoiced
                                                            To<span>:</span></strong>
                                                        <p class="invoice-details-two">
                                                            {{ $invoice->customer->name ?? 'N/A' }}<br>
                                                            {{ $invoice->customer->address1 ?? 'N/A' }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="invoice-info invoice-info2 mb-3">
                                                        <strong class="customer-text-one">Pay To<span>:</span></strong>
                                                        <p class="invoice-details-two">
                                                            {{ $invoice->customer->address1 ?? 'N/A' }}
                                                            299 Star Trek Drive, Panama City,<br>
                                                            Florida, 32405,<br>
                                                            USA
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="invoice-info invoice-info2 mb-3">
                                                        <strong class="customer-text-one">Payment
                                                            Details<span>:</span></strong>
                                                        <p class="text-start invoice-details-two invoice-details mb-1">
                                                            {{ $invoice->bank->bankname }}<span>:{{ $invoice->users->email }} </span><strong> </strong>
                                                        </p>
                                                        <p class="text-start invoice-details-two invoice-details mb-1">
                                                            Account<span>: </span><strong>{{ $invoice->bank->accno}}</strong>
                                                        </p>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- -/Invoice To -->

                                        <!-- Invoice Item -->
                                        <!-- @livewire('invoice-details') -->
                                        <!-- Invoice Item Table -->
                                        <div class="invoice-item invoice-table-wrap">
                                            <div class="invoice-table-head">
                                                <h6>Items:</h6>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="table-responsive">
                                                        <table class="table table-center table-hover mb-0">
                                                            <thead class="thead-light">
                                                                <tr>
                                                                    <th>Product / Service</th>
                                                                    <th>Quantity</th>
                                                                    <th>Rate</th>
                                                                    <th>Discount (%)</th>
                                                                    <th>Tax (%)</th>
                                                                    <th>Amount</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @php
                                                                $taxable = 0;
                                                                $totalDiscount = 0;
                                                                $totalAmount = 0;
                                                                @endphp

                                                                @foreach ($invoice->items as $item)
                                                                @php
                                                                $qty = $item->quantity;
                                                                $rate = $item->rate;
                                                                $discountPercent = $item->discount ?? 0;
                                                                $taxPercent = $item->tax ?? 0;

                                                                $lineTotal = $qty * $rate;
                                                                $discountAmount = ($lineTotal * $discountPercent) / 100;
                                                                $taxableAmount = $lineTotal - $discountAmount;
                                                                $taxAmount = ($taxableAmount * $taxPercent) / 100;
                                                                $finalAmount = $taxableAmount + $taxAmount;

                                                                $taxable += $taxableAmount;
                                                                $totalDiscount += $discountAmount;
                                                                $totalAmount += $finalAmount;
                                                                @endphp
                                                                <tr>
                                                                    <td>{{ $item->product_name }}</td>
                                                                    <td>{{ $item->quantity }}</td>
                                                                    <td>{{ number_format($item->rate, 2) }}</td>
                                                                    <td>{{ $item->discount }}%</td>
                                                                    <td>{{ $item->tax }}%</td>
                                                                    <td>{{ number_format($finalAmount, 2) }}</td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Terms & Conditions -->
                                        <div class="terms-conditions">
                                            <div class="row align-items-center justify-content-between">
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="invoice-terms align-center">
                                                        <span class="invoice-terms-icon bg-white-smoke me-3">
                                                            <i class="fe fe-file-text"></i>
                                                        </span>
                                                        <div class="invocie-note">
                                                            <h6>Terms & Conditions</h6>
                                                            <p class="mb-0">{{ $invoice->terms }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="invoice-terms align-center">
                                                        <span class="invoice-terms-icon bg-white-smoke me-3">
                                                            <i class="fe fe-file-minus"></i>
                                                        </span>
                                                        <div class="invocie-note">
                                                            <h6>Note</h6>
                                                            <p class="mb-0">{{ $invoice->notes }}</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Summary -->
                                                <div class="col-lg-5 col-md-6">
                                                    <div class="invoice-total-card">
                                                        <div class="invoice-total-box">
                                                            <div class="invoice-total-inner">
                                                                <p>Taxable <span>₹{{ number_format($taxable, 2) }}</span></p>
                                                                <p>Discount <span>₹{{ number_format($totalDiscount, 2) }}</span></p>
                                                            </div>
                                                            <div class="invoice-total-footer">
                                                                <h4>Total Amount <span>₹{{ number_format($totalAmount, 2) }}</span></h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="invoice-sign text-end">
                                            <span class="d-block">Authorised Sign</span>
                                            <img class="img-fluid d-inline-block light-color-logo"
                                                src="{{ URL::asset('/public/assets/img/signature.png') }}" alt="sign">
                                            <img class="img-fluid d-inline-block dark-white-logo"
                                                src="{{ URL::asset('/public/assets/img/signature-white.png') }}"
                                                alt="sign">
                                        </div>
                                        <!-- /Terms & Conditions -->
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