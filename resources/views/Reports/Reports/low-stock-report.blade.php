<?php $page = 'low-stock-report'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            @component('components.page-header')
                @slot('title')
                    Low Stock Report
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
                                <table class="table table-center table-hover datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Product</th>
                                            <th>SKU</th>
                                            <th>Category </th>
                                            <th>Opening Qty </th>
                                            <th>Closing Qty </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $json = file_get_contents(public_path('../public/assets/json/low-stock-report.json'));
                                            $lowstockreports = json_decode($json, true);
                                        @endphp
                                        @foreach ($lowstockreports as $lowstockreport)
                                            <tr>
                                                <td>{{ $lowstockreport['Id'] }}</td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="{{ url('product-list') }}"
                                                            class="product-list-item-bg"><img class=""
                                                                src="{{ URL::asset('assets/img/products/' . $lowstockreport['Image']) }}"
                                                                alt="Product Image"></a>
                                                        <a
                                                            href="{{ url('product-list') }}">{{ $lowstockreport['Product'] }}</a>
                                                    </h2>
                                                </td>
                                                <td>{{ $lowstockreport['SKU'] }}</td>
                                                <td>{{ $lowstockreport['Category'] }}</td>
                                                <td>{{ $lowstockreport['OpeningQty'] }}</td>
                                                <td>{{ $lowstockreport['ClosingQty'] }}</td>
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
    <!-- /Page Wrapper -->
@endsection
