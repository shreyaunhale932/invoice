<?php $page = 'purchases-orders'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            @component('components.page-header')
                @slot('title')
                    Purchase Orders
                @endslot
            @endcomponent
            <!-- /Page Header -->

            <!-- Search Filter -->
            @component('components.search-filter')
            @endcomponent
            <!-- /Search Filter -->

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
                                            <th>Purchase ID</th>
                                            <th>Vendor</th>
                                            <th>Amount</th>
                                            <th>Payment Mode</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th class="no-sort">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $json = file_get_contents(public_path('../public/assets/json/purchase-orders.json'));
                                            $orders = json_decode($json, true);
                                        @endphp
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>{{ $order['Id'] }}</td>
                                                <td>{{ $order['PurchaseID'] }}</td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="{{ url('profile') }}" class="avatar avatar-sm me-2"><img
                                                                class="avatar-img rounded-circle"
                                                                src="{{ URL::asset('/public/assets/img/profiles/' . $order['Image']) }}"
                                                                alt="User Image"></a>
                                                        <a href="{{ url('profile') }}">{{ $order['Vendor'] }}
                                                            <span>{{ $order['Phone'] }}</span></a>
                                                    </h2>
                                                </td>
                                                <td>{{ $order['Amount'] }}</td>
                                                <td>{{ $order['PaymentMode'] }}</td>
                                                <td>{{ $order['Date'] }}</td>
                                                <td><span class="{{ $order['Class'] }}">{{ $order['Status'] }}</span>
                                                </td>
                                                <td class="d-flex align-items-center">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class=" btn-action-icon "
                                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                class="fas fa-ellipsis-v"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-right credit-note-dropdown">
                                                            <ul>
                                                                <li>
                                                                    <a class="dropdown-item"
                                                                        href="{{ url('edit-purchases-order') }}"><i
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
                                                                        href="{{ url('purchases-details') }}"><i
                                                                            class="far fa-eye me-2"></i>View</a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item"
                                                                        href="{{ url('add-purchase-return') }}"><i
                                                                            class="fe fe-repeat me-2"></i>Convert To
                                                                        Purchase</a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href=""><i
                                                                            class="fe fe-send me-2"></i>Send</a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href=""><i
                                                                            class="fe fe-copy me-2"></i>Clone</a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href=""><i
                                                                            class="fe fe-download me-2"></i>Download</a>
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
