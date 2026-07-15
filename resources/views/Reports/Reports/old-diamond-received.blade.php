<?php $page = 'old-diamond-received'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            @component('components.page-header')
                @slot('title')
                    Old Diamond Received Report
                @endslot
            @endcomponent
            <!-- /Page Header -->

            <!-- Search Filter -->
            <div class="card">
                <div class="card-body">
                    <form action="{{ url('old-diamond-received') }}" method="GET">
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
                                                <th>#</th>
                                                <th>Date</th>
                                                <th>Customer</th>
                                                <th>Invoice No</th>
                                                <th>Description</th>
                                                <th>Clarity</th>
                                                <th>Cut</th>
                                                <th>Color</th>
                                                <th>Pieces</th>
                                                <th>Weight (carat)</th>
                                                <th>Rate</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($exchange_diamonds as $key => $item)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                                    <td>{{ $item->invoice->customer->name ?? 'N/A' }}</td>
                                                    <td>
                                                        <a href="{{ route('sell.invoice.view', $item->sell_invoice_id) }}" target="_blank">
                                                            #{{ $item->invoice->invoice_no ?? $item->sell_invoice_id }}
                                                        </a>
                                                    </td>
                                                    <td>{{ $item->description }}</td>
                                                    <td>{{ $item->clarity }}</td>
                                                    <td>{{ $item->cut }}</td>
                                                    <td>{{ $item->color }}</td>
                                                    <td>{{ $item->pieces }}</td>
                                                    <td>{{ number_format($item->weight, 3) }}</td>
                                                    <td>{{ number_format($item->rate, 2) }}</td>
                                                    <td>{{ number_format($item->amount, 2) }}</td>
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
