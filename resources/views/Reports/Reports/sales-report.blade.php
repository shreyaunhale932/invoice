<?php $page = 'sales-report'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            @component('components.page-header')
                @slot('title')
                    Sales Report
                @endslot
            @endcomponent
            <!-- /Page Header -->

            <!-- Search Filter -->
            @component('components.search-filter')
            @endcomponent
            <!-- /Search Filter -->

            <div class="row">
                <div class="col-sm-12">
                    <div class=" card-table">
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="companies-table">
                                    <table class="table table-center table-hover datatable">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Product</th>
                                                <th>SKU</th>
                                                <th>Category</th>
                                                <th>Sold Amount</th>
                                                <th>Sold Qty</th>
                                                <th>Instock Qty</th>
                                                <th>Due Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $json = file_get_contents(public_path('../public/assets/json/sales-report.json'));
                                                $salesreports = json_decode($json, true);
                                            @endphp
                                            @foreach ($salesreports as $salesreport)
                                                <tr>
                                                    <td>{{ $salesreport['Id'] }}</td>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <a href="{{ url('profile') }}"
                                                                class="avatar avatar-md me-2 companies">
                                                                <img class="avatar-img sales-rep"
                                                                    src="{{ URL::asset('assets/img/' . $salesreport['Image']) }}"
                                                                    alt="User Image"></a>
                                                            <a href="{{ url('profile') }}">{{ $salesreport['Product'] }}</a>
                                                        </h2>
                                                    </td>
                                                    <td>{{ $salesreport['SKU'] }}</td>
                                                    <td>{{ $salesreport['Category'] }}</td>
                                                    <td>{{ $salesreport['SoldAmount'] }}</td>
                                                    <td>{{ $salesreport['SoldQty'] }}</td>
                                                    <td>{{ $salesreport['InstockQty'] }}</td>
                                                    <td>{{ $salesreport['DueDate'] }}</td>
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
        </div>
    </div>
    <!-- /Page Wrapper -->
@endsection
