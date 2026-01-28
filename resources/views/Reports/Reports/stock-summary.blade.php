<?php $page = 'stock-summary'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            @component('components.page-header')
                @slot('title')
                    Stock Summary
                @endslot
            @endcomponent
            <!-- /Page Header -->

            <!-- Search Filter -->
            <div class="card">
                <div class="card-body">
                    <form action="{{ url('stock-summary') }}" method="GET">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>From Date</label>
                                    <input type="date" name="from_date" class="form-control" value="{{ $from_date }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>To Date</label>
                                    <input type="date" name="to_date" class="form-control" value="{{ $to_date }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
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
                                                <th rowspan="2">#</th>
                                                <th rowspan="2">Product Name</th>
                                                <th colspan="3" class="text-center">Opening Stock</th>
                                                <th colspan="3" class="text-center">Inward Stock</th>
                                                <th colspan="3" class="text-center">Outward Stock</th>
                                                <th colspan="3" class="text-center">Closing Stock</th>
                                            </tr>
                                            <tr>
                                                <th>Qty</th>
                                                <th>GW</th>
                                                <th>NW</th>
                                                <th>Qty</th>
                                                <th>GW</th>
                                                <th>NW</th>
                                                <th>Qty</th>
                                                <th>GW</th>
                                                <th>NW</th>
                                                <th>Qty</th>
                                                <th>GW</th>
                                                <th>NW</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($products as $key => $product)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>
                                                        <a href="{{ route('inventory.history', $product->id) }}">
                                                            {{ $product->product_name }}
                                                        </a>
                                                    </td>
                                                    <!-- Opening -->
                                                    <td>{{ number_format($product->opening_qty, 2) }}</td>
                                                    <td>{{ number_format($product->opening_gross, 3) }}</td>
                                                    <td>{{ number_format($product->opening_net, 3) }}</td>
                                                    <!-- Inward -->
                                                    <td class="text-success">{{ number_format($product->inward_qty, 2) }}</td>
                                                    <td class="text-success">{{ number_format($product->inward_gross, 3) }}</td>
                                                    <td class="text-success">{{ number_format($product->inward_net, 3) }}</td>
                                                    <!-- Outward -->
                                                    <td class="text-danger">{{ number_format($product->outward_qty, 2) }}</td>
                                                    <td class="text-danger">{{ number_format($product->outward_gross, 3) }}</td>
                                                    <td class="text-danger">{{ number_format($product->outward_net, 3) }}</td>
                                                    <!-- Closing -->
                                                    <td class="fw-bold">{{ number_format($product->closing_qty, 2) }}</td>
                                                    <td class="fw-bold">{{ number_format($product->closing_gross, 3) }}</td>
                                                    <td class="fw-bold">{{ number_format($product->closing_net, 3) }}</td>
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
