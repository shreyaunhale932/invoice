<?php $page = 'customers'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            @component('components.page-header')
                @slot('title')
                    Customers
                @endslot
            @endcomponent
            <!-- /Page Header -->

            <!-- Search Filter -->
            @component('components.search-filter')
            @endcomponent
            <!-- /Search Filter -->

            <div class="row">
                <div class="col-sm-12">
                    <div class="card-table">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-center table-hover datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Balance </th>
                                            <th>Total Invoice </th>
                                            <th>Created</th>
                                            <th>Status</th>
                                            <th class="no-sort">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       
                                        @foreach ($customers as $customer)
                                            <tr>
                                                <td>{{ $customer['id'] }}</td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        
                                                        <a href="{{ url('profile') }}">{{ $customer['name'] }}
                                                            <span>{{ $customer['email'] }}</span></a>
                                                    </h2>
                                                </td>
                                                <td>{{ $customer['phone'] }}</td>
                                                <td>{{ $customer['Balance'] }}</td>
                                                <td>{{ $customer['TotalInvoice'] }}</td>
                                                <td>{{ $customer['created_at'] }}</td>
                                                <td><span
                                                        class="{{ $customer['Class'] }}">{{ $customer['Status'] }}</span>
                                                </td>
                                                <td class="d-flex align-items-center">
                                                    <a href="{{ url('add-invoice') }}" class="btn btn-greys me-2"><i
                                                            class="fa fa-plus-circle me-1"></i> Invoice</a>
                                                    <a href="{{ url('customers-ledger') }}" class="btn btn-greys me-2"><i
                                                            class="fa-regular fa-eye me-1"></i> Ledger</a>
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class=" btn-action-icon "
                                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                class="fas fa-ellipsis-v"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
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
                                                                    <a class="dropdown-item"
                                                                        href="{{ url('active-customers') }}"><i
                                                                            class="fa-solid fa-power-off me-2"></i>Activate</a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item"
                                                                        href="{{ url('deactive-customers') }}"><i
                                                                            class="far fa-bell-slash me-2"></i>Deactivate</a>
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
        </div>
    </div>
    <!-- /Page Wrapper -->
@endsection
