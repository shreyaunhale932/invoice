<?php $page = 'expenses'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            @component('components.page-header')
                @slot('title')
                    Expenses
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
                                            <th>Expense ID</th>
                                            <th>Reference</th>
                                            <th>Amount</th>
                                            <th>Attachment</th>
                                            <th>Payment Mode</th>
                                            <th>Notes</th>
                                            <th>Status</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $json = file_get_contents(public_path('../public/assets/json/expenses.json'));
                                            $expenses = json_decode($json, true);
                                        @endphp
                                        @foreach ($expenses as $expense)
                                            <tr>
                                                <td>{{ $expense['Id'] }}</td>
                                                <td>
                                                    <a href="{{ url('invoice-details') }}"
                                                        class="invoice-link">{{ $expense['ExpenseID'] }}</a>
                                                </td>
                                                <td>{{ $expense['Reference'] }}</td>
                                                <td>{{ $expense['Amount'] }}</td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <img class="avatar-img rounded" width="30" height="30"
                                                            src="{{ URL::asset('assets/img/category/' . $expense['Image']) }}"
                                                            alt="User Image">
                                                    </h2>
                                                </td>
                                                <td>{{ $expense['PaymentMode'] }}</td>
                                                <td>{{ $expense['Notes'] }} </td>
                                                <td><span class="{{ $expense['Class'] }}">{{ $expense['Status'] }}</span>
                                                </td>
                                                <td class="d-flex align-items-center">
                                                    <a class=" btn-action-icon me-2" href="javascript:void(0);" download><i
                                                            class="fe fe-download"></i></a>
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class=" btn-action-icon "
                                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                class="fas fa-ellipsis-v"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <ul>
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#edit_expenses"><i
                                                                            class="far fa-edit me-2"></i>Edit</a>
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
