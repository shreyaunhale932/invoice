<?php $page = 'expense-report'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            @component('components.page-header')
                @slot('title')
                    Expense Report
                @endslot
            @endcomponent
            <!-- /Page Header -->

            <!-- Search Filter -->
            @component('components.search-filter')
            @endcomponent
            <!-- /Search Filter -->

            <div class="row">
                <div class="col-sm-12">
                    <div class=" card-table">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-center table-hover datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Company Name</th>
                                            <th>Amount</th>
                                            <th>Payment Status</th>
                                            <th>Category</th>
                                            <th>Created By</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $json = file_get_contents(public_path('../public/assets/json/expense-report.json'));
                                            $expensereports = json_decode($json, true);
                                        @endphp
                                        @foreach ($expensereports as $expensereport)
                                            <tr>
                                                <td>{{ $expensereport['Id'] }}</td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="{{ url('contact-details') }}"
                                                            class="avatar avatar-sm me-2 subscription-img"><img
                                                                class="avatar-img rounded-circle subscription-circle"
                                                                src="{{ URL::asset('assets/img/profiles/' . $expensereport['Image']) }}"
                                                                alt="User Image"></a>
                                                        <a href="{{ url('profile') }}">{{ $expensereport['CompanyName'] }}
                                                            <span>{{ $expensereport['Email'] }}</span></a>
                                                    </h2>
                                                </td>
                                                <td>{{ $expensereport['Amount'] }}</td>
                                                <td><span
                                                        class="{{ $expensereport['Class'] }}">{{ $expensereport['PaymentStatus'] }}</span>
                                                </td>
                                                <td>{{ $expensereport['Category'] }}</td>
                                                <td>{{ $expensereport['CreatedBy'] }}</td>
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
