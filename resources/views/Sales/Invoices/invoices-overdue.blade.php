<?php $page = 'invoices-overdue'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            @component('components.page-header')
                @slot('title')
                    Invoices Overdue
                @endslot
            @endcomponent
            <!-- /Page Header -->

            <!-- Search Filter -->
            @component('components.search-filter')
            @endcomponent
            <!-- /Search Filter -->

            <!-- Inovices card -->
            @component('components.invoices-card', ['cards' => $cards])
@endcomponent
            <!-- /Inovices card -->

            <!-- All Invoice -->
            @component('components.invoices-tab')
            @endcomponent
            <!-- /All Invoice -->

            <!-- Table -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-table">
                        <div class="card-body">
                            <div class="table-responsive no-pagination">
                                <table class="table table-stripped table-hover datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>
                                                <label class="custom_check">
                                                    <input type="checkbox" name="invoice">
                                                    <span class="checkmark"></span>
                                                </label>Invoice ID
                                            </th>
                                            {{-- <th>Category</th> --}}
                                            <th>Created On</th>
                                            <th>Invoice To</th>
                                            <th>Total</th>
                                            <th>Paid</th>
                                            {{-- <th>Payment Mode</th> --}}
                                            <th>Balance</th>
                                            <th>Due Date</th>
                                            <th>Status</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($invoices as $invoice)
                                            <tr>
                                                <td>
                                                    <label class="custom_check">
                                                        <input type="checkbox">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                    <a href="{{ route('sell.invoice.view', $invoice->id) }}"
                                                        class="invoice-link" target="_blank">
                                                        {{ $invoice->invoice_no }}
                                                    </a>
                                                </td>

                                                {{-- <td>{{ $invoice->category ?? '-' }}</td> --}}

                                                <td>{{ date('d-m-Y', strtotime($invoice->created_at)) }}</td>

                                                <td>
                                                    <h2 class="table-avatar">

                                                        <a href="#">
                                                            {{ $invoice->customer->name ?? '-' }}
                                                            <span>{{ $invoice->customer->phone ?? '' }}</span>
                                                        </a>
                                                    </h2>
                                                </td>

                                                <td>₹ {{ number_format($invoice->final_amount, 2) }}</td>
                                                <td>₹ {{ number_format($invoice->total_received ?? 0, 2) }}</td>
                                                <!-- <td>{{ $invoice->payment_mode ?? '-' }}</td> -->
                                                <td>₹ {{ number_format($invoice->amount_left ?? 0, 2) }}</td>
                                                <td>{{ $invoice->invoice_due_date }}</td>

                                                <td>
                                                    <span class="badge bg-danger">
                                                        Overdue
                                                    </span>
                                                </td>

                                                <td class="text-end">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class="btn-action-icon" data-bs-toggle="dropdown">
                                                            <i class="fas fa-ellipsis-v"></i>
                                                        </a>
                                                       <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item"
                                                                href="{{ route('sell.invoice.edit', $invoice->id) }}">
                                                                <i class="far fa-edit me-2"></i>Edit
                                                            </a>
                                                            <a class="dropdown-item"
                                                                href="{{ route('sell.invoice.view', $invoice->id) }}" target="_blank">
                                                                <i class="far fa-eye me-2"></i>View
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="11" class="text-center text-muted">
                                                    No overdue invoices found
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
            <!-- /Table -->

        </div>
    </div>
    <!-- /Page Wrapper -->
@endsection
