<?php $page = 'inventory-history'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            @component('components.page-header')
                @slot('title')
                    Inventory History
                @endslot
            @endcomponent
            <!-- /Page Header -->

            <!-- Table -->
           <div class="row">
    <div class="col-sm-12">
        <div class="card-table">
            <div class="card-body">
                <div class="table-responsive">
                    <div class="inventory-table">

                        <table class="table table-center table-hover datatable">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Item</th>
                                    <th>Code</th>
                                    <th>Type</th>
                                    <th>Quantity</th>
                                    <th>Gross Wt</th>
                                    <th>Net Wt</th>
                                    {{-- <th>Final Fine Wt</th> --}}
                                    <th>Date</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($transactions as $key => $txn)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>

                                        <td>{{ $txn->product->product_name }}</td>

                                        <td>{{ $txn->product->product_code }}</td>

                                        <td>
                                            @if ($txn->type === 'IN')
                                                <span class="badge bg-success">Stock IN</span>
                                            @else
                                                <span class="badge bg-danger">Stock OUT</span>
                                            @endif
                                        </td>

                                        <td>{{ $txn->quantity }}</td>
                                        <td>{{ $txn->gross_weight }}</td>
                                        <td>{{ $txn->net_weight }}</td>
                                        {{-- <td>{{ $txn->final_fn_weight }}</td> --}}

                                        <td>{{ $txn->created_at->format('d-m-Y H:i') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">
                                            No inventory history found
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
>
            <!-- /Table -->

        </div>
    </div>
    <!-- /Page Wrapper -->
@endsection
