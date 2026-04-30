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
@if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
            <!-- Template Editor Link -->
            <div class="row mb-3">
                <div class="col-12">
                    <a href="{{ route('invoice.template.index') }}" class="btn btn-outline-primary">
                        <i class="fe fe-settings me-2"></i>Edit Invoice Template
                    </a>
                </div>
            </div>
            <!-- /Template Editor Link -->

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
                            <div id="tableSearch" class="mb-3"></div>
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
                                            <!-- <th>Payment Mode</th> -->
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
                                                    <a href="{{ route('sell.invoice.view', $invoice->id) }}"
                                                        class="invoice-link" target="_blank">
                                                        {{ $invoice->invoice_no }}
                                                    </a>
                                                </td>

                                                <td>{{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d-m-Y') }}
                                                </td>

                                                <td>
                                                    <h2 class="table-avatar">

                                                        <a href="#">
                                                            {{ $invoice->customer->name ?? 'N/A' }}
                                                            <span>{{ $invoice->customer->phone ?? 'N/A' }}</span>
                                                        </a>
                                                    </h2>
                                                </td>

                                                <td>₹ {{ number_format($invoice->final_amount, 2) }}</td>
                                                <td>₹ {{ number_format($invoice->total_received ?? 0, 2) }}</td>
                                                <!-- <td>{{ $invoice->payment_mode ?? '-' }}</td> -->
                                                <td>₹ {{ number_format($invoice->amount_left ?? 0, 2) }}</td>
                                                <td>{{ $invoice->invoice_due_date }}</td>

                                                <td>
                                                    <span
                                                        class="badge
                                                    @if ($invoice->status === 'paid') bg-success
                                                    @elseif($invoice->status === 'pending') bg-warning
                                                    @else bg-danger @endif">
                                                        {{ ucfirst($invoice->status) }}
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
                                                                href="{{ route('sell.invoice.view', $invoice->id) }}"
                                                                target="_blank">
                                                                <i class="far fa-eye me-2"></i>View
                                                            </a>
                                                            {{-- <a class="dropdown-item"
                                                                href="{{ route('sell.invoice.sendMail', $invoice->id) }}">
                                                                <i class="far fa-envelope me-2"></i>Send on Mail
                                                            </a> --}}
                                                            <a class="dropdown-item text-danger" href="#"
                                                                onclick="if(confirm('Are you sure?')) {
                                                                    event.preventDefault();
                                                                    fetch('{{ route('sell.invoice.destroy', $invoice->id) }}', {
                                                                        method: 'DELETE',
                                                                        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
                                                                    }).then(res => {window.location.reload()});
                                                               }">
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
