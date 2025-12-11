<?php $page = 'payment-summary'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            @component('components.page-header')
                @slot('title')
                    Payment Summary
                @endslot
            @endcomponent
            <!-- /Page Header -->

            <!-- Search Filter -->
            @component('components.search-filter')
            @endcomponent
            <!-- /Search Filter -->

            <!-- Table -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-table">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-stripped table-hover datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Transaction ID</th>
                                            <th>Invoice Number</th>
                                            <th>Customer</th>
                                            <th>Amount</th>
                                            <th>Date</th>
                                            <th class="text-start">Payment Method</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $json = file_get_contents(public_path('../public/assets/json/payment-summary.json'));
                                            $payments = json_decode($json, true);
                                        @endphp
                                        @foreach ($payments as $payment)
                                            <tr>
                                                <td>{{ $payment['Id'] }}</td>
                                                <td>{{ $payment['TransactionID'] }}</td>
                                                <td><a href="{{ url('invoice-details') }}"
                                                        class="invoice-link">{{ $payment['InvoiceNumber'] }}</a>
                                                </td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="{{ url('profile') }}" class="avatar avatar-sm me-2"><img
                                                                class="avatar-img rounded-circle"
                                                                src="{{ URL::asset('assets/img/profiles/' . $payment['Image']) }}"
                                                                alt="User Image"></a>
                                                        <a href="{{ url('profile') }}">{{ $payment['Customer'] }} <span>
                                                                {{ $payment['Phone'] }}</span></a>
                                                    </h2>
                                                </td>
                                                <td>{{ $payment['Amount'] }}</td>
                                                <td>{{ $payment['Date'] }}</td>
                                                <td>{{ $payment['PaymentMethod'] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Table -->

        </div>
    </div>
    <!-- /Page Wrapper -->
@endsection
