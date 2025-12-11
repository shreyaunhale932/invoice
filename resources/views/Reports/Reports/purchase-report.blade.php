<?php $page = 'purchase-report'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            @component('components.page-header')
                @slot('title')
                    Purchase Report
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
                                                <th>Purchase Amount</th>
                                                <th>Purchase Qty</th>
                                                <th>Instock Qty</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $json = file_get_contents(public_path('../public/assets/json/purchase-report.json'));
                                                $purchasereports = json_decode($json, true);
                                            @endphp
                                            @foreach ($purchasereports as $purchasereport)
                                                <tr>
                                                    <td>{{ $purchasereport['Id'] }}</td>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <a href="{{ url('profile') }}"
                                                                class="avatar avatar-md me-2 companies">
                                                                <img class="avatar-img sales-rep"
                                                                    src="{{ URL::asset('assets/img/' . $purchasereport['Image']) }}"
                                                                    alt="User Image"></a>
                                                            <a
                                                                href="{{ url('profile') }}">{{ $purchasereport['Product'] }}</a>
                                                        </h2>
                                                    </td>
                                                    <td>{{ $purchasereport['PurchaseAmount'] }}</td>
                                                    <td>{{ $purchasereport['PurchaseQty'] }}</td>
                                                    <td>{{ $purchasereport['InstockQty'] }}</td>
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
