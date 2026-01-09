<?php $page = 'invoices'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            @component('components.page-header')
                @slot('title')
                    Invoices
                @endslot
            @endcomponent
            <!-- /Page Header -->

            <!-- Search Filter -->
            @component('components.search-filter')
            @endcomponent
            <!-- /Search Filter -->

            <!-- Inovices card -->
            @component('components.invoices-card')
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
                            <div class="table-responsive">
                                <table class="table table-stripped table-hover datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Invoice ID</th>

                                            <th>Created On</th>
                                            <th>Invoice To</th>
                                            <th>Total</th>
                                            <th>Paid</th>
                                            <th>Payment Mode</th>
                                            <th>Balance</th>
                                            <th>Due Date</th>
                                            <th>Status</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($invoices as $invoice)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>

                                                <td>
                                                    <a href="" class="invoice-link">
                                                        {{ $invoice->invoice_no }}
                                                    </a>
                                                </td>

                                                <td>{{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d-m-Y') }}
                                                </td>

                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="{{ url('profile') }}" class="avatar avatar-sm me-2">
                                                            <img class="avatar-img rounded-circle"
                                                                src="{{ asset('public/assets/img/profiles/default.jpg') }}">
                                                        </a>
                                                        <a href="#">
                                                            {{ $invoice->customer->name ?? 'N/A' }}
                                                            <span>{{ $invoice->customer->phone ?? 'N/A' }}</span>
                                                        </a>
                                                    </h2>
                                                </td>

                                                <td>₹ {{ number_format($invoice->final_amount, 2) }}</td>
                                                <td>₹ {{ number_format($invoice->paid_amount ?? 0, 2) }}</td>
                                                <td>{{ $invoice->payment_mode ?? '-' }}</td>
                                                <td>₹ {{ number_format($invoice->balance_amount ?? 0, 2) }}</td>
                                                <td>{{ $invoice->invoice_due_date }}</td>

                                                <td>
                                                    <span
                                                        class="badge bg-{{ $invoice->status == 'Paid' ? 'success' : 'warning' }}">
                                                        {{ ucfirst($invoice->status) }}
                                                    </span>
                                                </td>

                                                <td class="text-end">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class="btn-action-icon" data-bs-toggle="dropdown">
                                                            <i class="fas fa-ellipsis-v"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item" href="">
                                                                <i class="far fa-edit me-2"></i>Edit
                                                            </a>
                                                            <a class="dropdown-item" href="">
                                                                <i class="far fa-eye me-2"></i>View
                                                            </a>
                                                            <a class="dropdown-item text-danger" href="#"
                                                                data-bs-toggle="modal" data-bs-target="#delete_modal">
                                                                <i class="far fa-trash-alt me-2"></i>Delete
                                                            </a>
                                                        </div>
                                                    </div>
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
