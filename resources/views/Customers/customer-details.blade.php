<?php $page = 'customer-details'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="content-page-header">
                    <h5>Customer Details</h5>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="card customer-details-group">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                            <div class="customer-details">
                                <div class="d-flex align-items-center">
                                    <span class="customer-widget-img d-inline-flex">
                                        <img class="rounded-circle"
                                            src="{{ asset('/assets/img/profiles/avatar-14.jpg') }}" alt="profile-img">
                                    </span>
                                    <div class="customer-details-cont">
                                        <h6>{{ $customer->name }}</h6>
                                        <p>C-{{ str_pad($customer->id, 5, '0', STR_PAD_LEFT) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                            <div class="customer-details">
                                <div class="d-flex align-items-center">
                                    <span class="customer-widget-icon d-inline-flex">
                                        <i class="fe fe-mail"></i>
                                    </span>
                                    <div class="customer-details-cont">
                                        <h6>Email Address</h6>
                                        <p>{{ $customer->email ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                            <div class="customer-details">
                                <div class="d-flex align-items-center">
                                    <span class="customer-widget-icon d-inline-flex">
                                        <i class="fe fe-phone"></i>
                                    </span>
                                    <div class="customer-details-cont">
                                        <h6>Phone Number</h6>
                                        <p>{{ $customer->phone ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                            <div class="customer-details">
                                <div class="d-flex align-items-center">
                                    <span class="customer-widget-icon d-inline-flex">
                                        <i class="fe fe-file-text"></i>
                                    </span>
                                    <div class="customer-details-cont">
                                        <h6>GST Number</h6>
                                        <p>{{ $customer->gst_no ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                            <div class="customer-details">
                                <div class="d-flex align-items-center">
                                    <span class="customer-widget-icon d-inline-flex">
                                        <i class="fe fe-credit-card"></i>
                                    </span>
                                    <div class="customer-details-cont">
                                        <h6>PAN / Aadhaar</h6>
                                        <p>{{ $customer->pan_no ?? '-' }} / {{ $customer->adhaar_no ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                            <div class="customer-details">
                                <div class="d-flex align-items-center">
                                    <span class="customer-widget-icon d-inline-flex">
                                        <i class="fe fe-map-pin"></i>
                                    </span>
                                    <div class="customer-details-cont">
                                        <h6>Address</h6>
                                        <p>{{ $customer->address ? $customer->address . ', ' : '' }}{{ $customer->city ?? '' }}{{ $customer->state ? ', ' . $customer->state : '' }}{{ $customer->pincode ? ' - ' . $customer->pincode : '' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search Filter -->
            @component('components.search-filter')
            @endcomponent
            <!-- /Search Filter -->

            <!-- Invoices card -->
            @component('components.invoices-card', ['cards' => $cards])
            @endcomponent
            <!-- /Invoices card -->

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
                                            <th>Invoice No</th>
                                            <th>Type</th>
                                            <th>Created On</th>
                                            <th>Total Amount</th>
                                            <th>Paid Amount</th>
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
                                                        class="invoice-link" target="_blank">{{ $invoice->invoice_no }}</a>
                                                </td>
                                                <td>{{ $invoice->is_direct_sell ? 'Direct Sell' : 'Normal Invoice' }}</td>
                                                <td>{{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d-m-Y') }}</td>
                                                <td>₹ {{ number_format($invoice->final_amount, 2) }}</td>
                                                <td>₹ {{ number_format($invoice->total_received ?? 0, 2) }}</td>
                                                <td>₹ {{ number_format($invoice->amount_left ?? 0, 2) }}</td>
                                                <td>{{ $invoice->invoice_due_date }}</td>
                                                <td>
                                                    <span class="badge 
                                                        @if ($invoice->status === 'paid') bg-success 
                                                        @elseif($invoice->status === 'pending') bg-warning 
                                                        @else bg-danger @endif">
                                                        {{ ucfirst($invoice->status) }}
                                                    </span>
                                                </td>
                                                <td class="text-end">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class=" btn-action-icon "
                                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                class="fas fa-ellipsis-v"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-end customer-dropdown">
                                                            <ul>
                                                                <li>
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('sell.invoice.edit', $invoice->id) }}"><i
                                                                            class="far fa-edit me-2"></i>Edit</a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="{{ route('sell.invoice.view', $invoice->id) }}" target="_blank"><i
                                                                            class="far fa-eye me-2"></i>View</a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item text-danger" href="#"
                                                                        onclick="deleteInvoice(event, '{{ route('sell.invoice.destroy', $invoice->id) }}')"><i
                                                                            class="far fa-trash-alt me-2"></i>Delete</a>
                                                                </li>
                                                            </ul>
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

    <script>
        function deleteInvoice(event, url) {
            event.preventDefault();
            if (!confirm('Are you sure you want to delete this invoice?')) {
                return;
            }
            fetch(url, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        window.location.reload();
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    alert('Something went wrong.');
                    console.log(error);
                });
        }
    </script>
@endsection
