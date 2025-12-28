<?php $page = 'inventory'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            @component('components.page-header')
                @slot('title')
                    Inventory
                @endslot
            @endcomponent
            <!-- /Page Header -->

            <!-- Table -->
            <div class="row">
                <div class="col-sm-12">
                    <div class=" card-table">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-center table-hover datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Item</th>
                                            <th>Code</th>
                                            <th>Qty</th>
                                            <th>Gs Wt</th>
                                            <th>Nt Wt</th>
                                            <th>Selling Price</th>
                                            <th>Purchase Price</th>
                                            <th class="no-sort">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                            @php
                                                $availableGsWt = ($product->stock_in ?? 0) - ($product->stock_out ?? 0);
                                            @endphp
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $product->product_name }}</td>
                                                <td>{{ $product->product_code }}</td>
                                                <td>
                                                    {{ ($product->in_qty ?? 0) - ($product->out_qty ?? 0) }}
                                                </td>

                                                <td>
                                                    {{ number_format(($product->in_gross ?? 0) - ($product->out_gross ?? 0), 3) }}
                                                    GM
                                                </td>

                                                <td>
                                                    {{ number_format(($product->in_net ?? 0) - ($product->out_net ?? 0), 3) }}
                                                    GM
                                                </td>
                                                <td>{{ $product->sale_price }}</td>
                                                <td>{{ $product->gold_price }}</td>
                                                <td class="d-flex align-items-center">

                                                    <a href="{{ route('inventory.history', $product->id) }}"
                                                        class="btn btn-greys bg-history-light me-2">
                                                        <i class="far fa-eye me-1"></i> History
                                                    </a>

                                                    <a href="#" class="btn btn-greys bg-success-light me-2 stockInBtn"
                                                        data-bs-toggle="modal" data-bs-target="#stock_in"
                                                        data-product-id="{{ $product->id }}"
                                                        data-product-name="{{ $product->product_name }}">
                                                        <i class="fa fa-plus-circle me-1"></i> Stock In
                                                    </a>


                                                    <a href="#" class="btn btn-greys bg-danger-light me-2 stockOutBtn"
                                                        data-bs-toggle="modal" data-bs-target="#stock_out"
                                                        data-product-id=""
                                                        data-item-product-data-id="{{ $product->id }}"
                                                        data-product-name="{{ $product->product_name }}">
                                                        <i class="fa fa-minus-circle me-1"></i> Stock Out
                                                    </a>

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
            <!-- /Table -->

        </div>
    </div>
    <!-- /Page Wrapper -->
@endsection
