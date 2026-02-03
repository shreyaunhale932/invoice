<?php $page = 'stock-report'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            @component('components.page-header')
                @slot('title')
                    Sold Stock
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
                                                <th>Product Name</th>
                                                <th>SKU</th>
                                                <th>Category</th>
                                                <th>Gross weight</th>
                                                <th>Net weight</th>
                                                <th>Final Fn weight</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($products as $key => $product)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>

                                                    <td>
                                                        <h2 class="table-avatar">

                                                            <a href="javascript:void(0)">
                                                                {{ $product->product_name }}
                                                            </a>
                                                        </h2>
                                                    </td>

                                                    <td>{{ $product->pre_code }}{{ $product->post_code }}</td>
                                                    <td>
                                                        {{ $product->category->category_name ?? '-' }}
                                                    </td>

                                                    <td>{{ $product->gross_weight }}</td>
                                                    <td>{{ $product->net_weight }}</td>
                                                    <td>{{ $product->final_fn_weight }}</td>

                                                    <td>
                                                        <span class="badge bg-danger">
                                                            {{ ucfirst($product->availability) }}
                                                        </span>
                                                    </td>
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
