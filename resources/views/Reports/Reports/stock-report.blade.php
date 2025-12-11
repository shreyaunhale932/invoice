<?php $page = 'stock-report'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            @component('components.page-header')
                @slot('title')
                    Stock Report
                @endslot
            @endcomponent
            <!-- /Page Header -->

            <!-- Search Filter -->
            @component('components.search-filter')
            @endcomponent
            <!-- /Search Filter -->

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
                                                <th>Product</th>
                                                <th>SKU</th>
                                                <th>Category</th>
                                                <th>Opening Qty</th>
                                                <th>Qty In</th>
                                                <th>Qty Out</th>
                                                <th>Closing Qty</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $json = file_get_contents(public_path('../public/assets/json/stock-report.json'));
                                                $stockreports = json_decode($json, true);
                                            @endphp
                                            @foreach ($stockreports as $stockreport)
                                                <tr>
                                                    <td>{{ $stockreport['Id'] }}</td>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <a href="{{ url('profile') }}"
                                                                class="avatar avatar-md me-2 companies">
                                                                <img class="avatar-img sales-rep"
                                                                    src="{{ URL::asset('assets/img/' . $stockreport['Image']) }}"
                                                                    alt="User Image"></a>
                                                            <a href="{{ url('profile') }}">{{ $stockreport['Product'] }}</a>
                                                        </h2>
                                                    </td>
                                                    <td>{{ $stockreport['SKU'] }}</td>
                                                    <td>{{ $stockreport['Category'] }}</td>
                                                    <td>{{ $stockreport['OpeningQty'] }}</td>
                                                    <td>{{ $stockreport['QtyIn'] }}</td>
                                                    <td>{{ $stockreport['QtyOut'] }}</td>
                                                    <td>{{ $stockreport['ClosingQty'] }}</td>
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
