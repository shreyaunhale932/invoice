<?php $page = 'tax-purchase'; ?>
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
                    <a href="{{ url('tax-purchase') }}" class="btn btn-primary tax active">Purchase Tax Report</a>
                </li>
                <li>
                    <a href="{{ url('tax-sales') }}" class="btn btn-primary tax">SalesTax Report</a>
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
                                                <th>Supplier</th>
                                                <th>Date</th>
                                                <th>Ref No</th>
                                                <th>Total Amount</th>
                                                <th>Payment Method</th>
                                                <th>Discount</th>
                                                <th>Tax Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $json = file_get_contents(public_path('../public/assets/json/tax-purchase.json'));
                                                $taxpurchases = json_decode($json, true);
                                            @endphp
                                            @foreach ($taxpurchases as $taxpurchase)
                                                <tr>
                                                    <td>{{ $taxpurchase['Id'] }}</td>
                                                    <td>{{ $taxpurchase['Supplier'] }}</td>
                                                    <td>{{ $taxpurchase['Date'] }}</td>
                                                    <td>{{ $taxpurchase['RefNo'] }}</td>
                                                    <td>{{ $taxpurchase['TotalAmount'] }}</td>
                                                    <td>{{ $taxpurchase['PaymentMethod'] }}</td>
                                                    <td>{{ $taxpurchase['Discount'] }}</td>
                                                    <td>{{ $taxpurchase['TaxAmount'] }}</td>
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
