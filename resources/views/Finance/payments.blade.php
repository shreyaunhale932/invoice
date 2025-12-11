<?php $page = 'payments'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            @component('components.page-header')
                @slot('title')
                Payments
                @endslot
            @endcomponent
            <!-- /Page Header -->

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
                                            <th>Customer</th>
                                            <th>Payment ID</th>
                                            <th>Amount</th>
                                            <th>Date</th>
                                            <th>Payment Method</th>
                                            <th>Status</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $json = file_get_contents(public_path('../public/assets/json/payments.json'));
                                            $payments = json_decode($json, true);
                                        @endphp
                                        @foreach ($payments as $payment)
                                            <tr>
                                                <td>{{ $payment['Id'] }}</td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="{{ url('profile') }}" class="avatar avatar-sm me-2"><img
                                                                class="avatar-img rounded-circle"
                                                                src="{{ URL::asset('assets/img/profiles/' . $payment['Image']) }}"
                                                                alt="User Image"></a>
                                                        <a href="{{ url('profile') }}">{{ $payment['Customer'] }}
                                                            <span>{{ $payment['Email'] }}</span></a>
                                                    </h2>
                                                </td>
                                                <td>{{ $payment['PaymentID'] }}</td>
                                                <td>{{ $payment['Amount'] }}</td>
                                                <td>{{ $payment['Date'] }}</td>
                                                <td>{{ $payment['PaymentMethod'] }}</td>
                                                <td><span class="{{ $payment['Class'] }}">{{ $payment['Status'] }}</span>
                                                </td>
                                                <td class="d-flex align-items-center">
                                                    <a class=" btn-action-icon me-2" href="javascript:void(0);" download><i
                                                            class="fe fe-download"></i></a>
                                                    <a class=" btn-action-icon me-2" href="javascript:void(0);" download><i
                                                            class="fe fe-eye"></i></a>
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class=" btn-action-icon "
                                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                class="fas fa-ellipsis-v"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <ul>
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);"><i
                                                                            class="fe fe-edit me-3"></i>Edit</a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#delete_modal"><i
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
@endsection
