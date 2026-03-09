<?php $page = 'old-metal-received'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            @component('components.page-header')
                @slot('title')
                    Old Metal Received Report
                @endslot
            @endcomponent
            <!-- /Page Header -->

            <!-- Search Filter -->
            <div class="card">
                <div class="card-body">
                    <form action="{{ url('old-metal-received') }}" method="GET">
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
                                                <th>Metal</th>
                                                <th>Purity</th>
                                                <th>Gross Wt</th>
                                                <th>Less Wt</th>
                                                <th>Net Wt</th>
                                                <th>Rate</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($exchange_items as $key => $item)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                                    <td>{{ $item->invoice->customer->name ?? 'N/A' }}</td>
                                                    <td>
                                                        <a href="{{ route('sell.invoice.view', $item->sell_invoice_id) }}">
                                                            #{{ $item->invoice->invoice_number ?? $item->sell_invoice_id }}
                                                        </a>
                                                    </td>
                                                    <td>{{ $item->description }}</td>
                                                    <td>{{ $item->metal }}</td>
                                                    <td>{{ $item->purity }}</td>
                                                    <td>{{ number_format($item->gross_weight, 3) }}</td>
                                                    <td>{{ number_format($item->less_weight, 3) }}</td>
                                                    <td>{{ number_format($item->net_weight, 3) }}</td>
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
