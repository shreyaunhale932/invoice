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
                                            src="{{ URL::asset('/public/assets/img/profiles/avatar-14.jpg') }}" alt="profile-img">
                                    </span>
                                    <div class="customer-details-cont">
                                        <h6>John Smith1</h6>
                                        <p>Cl-12345</p>
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
                                        <p>john@example.com</p>
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
                                        <p>585-785-4840</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                            <div class="customer-details">
                                <div class="d-flex align-items-center">
                                    <span class="customer-widget-icon d-inline-flex">
                                        <i class="fe fe-airplay"></i>
                                    </span>
                                    <div class="customer-details-cont">
                                        <h6>Company Name</h6>
                                        <p>Kanakku Corporation</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                            <div class="customer-details">
                                <div class="d-flex align-items-center">
                                    <span class="customer-widget-icon d-inline-flex">
                                        <i class="fe fe-globe"></i>
                                    </span>
                                    <div class="customer-details-cont">
                                        <h6>Website</h6>
                                        <p class="customer-mail">www.example.com</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                            <div class="customer-details">
                                <div class="d-flex align-items-center">
                                    <span class="customer-widget-icon d-inline-flex">
                                        <i class="fe fe-briefcase"></i>
                                    </span>
                                    <div class="customer-details-cont">
                                        <h6>Company Address</h6>
                                        <p>4712 Cherry Ridge Drive Rochester, NY 14620.</p>
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

            <!-- Inovices card -->
            @component('components.invoices-card')
            @endcomponent
            <!-- /Inovices card -->

            <!-- Table -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-table">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-stripped table-hover datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>
                                                <label class="custom_check">
                                                    <input type="checkbox" name="invoice">
                                                    <span class="checkmark"></span>
                                                </label>Invoice No
                                            </th>
                                            <th>Category</th>
                                            <th>Created On</th>
                                            <th>Total Amount</th>
                                            <th>Paid Amount</th>
                                            <th>Payment Mode</th>
                                            <th>Balance</th>
                                            <th>Due Date</th>
                                            <th>Status</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $json = file_get_contents(public_path('../public/assets/json/customer-details.json'));
                                            $customers = json_decode($json, true);
                                        @endphp
                                        @foreach ($customers as $customer)
                                            <tr>
                                                <td>
                                                    <label class="custom_check">
                                                        <input type="checkbox" name="invoice">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                    <a href="{{ url('invoice-details') }}"
                                                        class="invoice-link">{{ $customer['InvoiceNo'] }}</a>
                                                </td>
                                                <td>{{ $customer['Category'] }}</td>
                                                <td>{{ $customer['CreatedOn'] }}</td>
                                                <td>{{ $customer['TotalAmount'] }}</td>
                                                <td>{{ $customer['PaidAmount'] }}</td>
                                                <td>{{ $customer['PaymentMode'] }}</td>
                                                <td>{{ $customer['Balance'] }}</td>
                                                <td>{{ $customer['DueDate'] }}</td>
                                                <td><span
                                                        class="{{ $customer['Class'] }}">{{ $customer['Status'] }}</span>
                                                </td>
                                                <td>
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class=" btn-action-icon "
                                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                class="fas fa-ellipsis-v"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-end customer-dropdown">
                                                            <ul>
                                                                <li>
                                                                    <a class="dropdown-item"
                                                                        href="{{ url('edit-customer') }}"><i
                                                                            class="far fa-edit me-2"></i>Edit</a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#delete_modal"><i
                                                                            class="far fa-trash-alt me-2"></i>Delete</a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item"
                                                                        href="{{ url('customer-details') }}"><i
                                                                            class="far fa-eye me-2"></i>View</a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href=""><i
                                                                            class="fe fe-send me-2"></i>Send</a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href=""><i
                                                                            class="fe fe-download me-2"></i>Download</a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item"
                                                                        href="{{ url('add-credit-notes') }}"><i
                                                                            class="fe fe-file-text me-2"></i>Convert to
                                                                        Sales Return</a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href=""><i
                                                                            class="fe fe-copy me-2"></i>Clone as
                                                                        Invoice</a>
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
@endsection
