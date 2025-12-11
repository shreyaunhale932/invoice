<?php $page = 'tax-sales'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">

            @component('components.page-header')
                @slot('title')
                    Tax Report
                @endslot
            @endcomponent

            <ul class="mb-3 d-flex align-items-center">
                <li>
                    <a href="{{ url('tax-purchase') }}" class="btn btn-primary tax">Purchase Tax Report</a>
                </li>
                <li>
                    <a href="{{ url('tax-sales') }}" class="btn btn-primary tax active">SalesTax Report</a>
                </li>
            </ul>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card-table">
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="companies-table">
                                    <table class="table table-center table-hover datatable">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Customer</th>
                                                <th>Date</th>
                                                <th>Invoice No</th>
                                                <th>Total Amount</th>
                                                <th>Payment Method</th>
                                                <th>Discount</th>
                                                <th>Tax Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $json = file_get_contents(public_path('../public/assets/json/tax-sales.json'));
                                                $taxsales = json_decode($json, true);
                                            @endphp
                                            @foreach ($taxsales as $taxsale)
                                                <tr>
                                                    <td>{{ $taxsale['Id'] }}</td>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <a href="{{ url('profile') }}"
                                                                class="avatar avatar-md me-2 companies">
                                                                <img class="avatar-img rounded-circle"
                                                                    src="{{ URL::asset('assets/img/profiles/' . $taxsale['Image']) }}"
                                                                    alt="User Image"></a>
                                                            <a href="{{ url('profile') }}">{{ $taxsale['Customer'] }}</a>
                                                        </h2>
                                                    </td>
                                                    <td>{{ $taxsale['Date'] }}</td>
                                                    <td>{{ $taxsale['InvoiceNo'] }}</td>
                                                    <td>{{ $taxsale['TotalAmount'] }}</td>
                                                    <td>{{ $taxsale['PaymentMethod'] }}</td>
                                                    <td>{{ $taxsale['Discount'] }}</td>
                                                    <td>{{ $taxsale['TaxAmount'] }}</td>
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
            <!-- /Page Header -->

            <!-- Search Filter -->
            @component('components.search-filter')
            @endcomponent
            <!-- /Search Filter -->

        </div>
    </div>
    <!-- /Page Wrapper -->
@endsection
