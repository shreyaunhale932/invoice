<?php $page = 'quotation-report'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            @component('components.page-header')
                @slot('title')
                    Quotation Report
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
                                            <th>Serial Number</th>
                                            <th>Date</th>
                                            <th>Company Name</th>
                                            <th>Amount</th>
                                            <th>Due Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $json = file_get_contents(public_path('../public/assets/json/quotation-report.json'));
                                            $quotationreports = json_decode($json, true);
                                        @endphp
                                        @foreach ($quotationreports as $quotationreport)
                                            <tr>
                                                <td>{{ $quotationreport['Id'] }}</td>
                                                <td>{{ $quotationreport['SerialNumber'] }}</td>
                                                <td>{{ $quotationreport['Date'] }}</td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="{{ url('profile') }}" class="avatar avatar-md me-2"><img
                                                                class="avatar-img rounded-circle"
                                                                src="{{ URL::asset('assets/img/profiles/' . $quotationreport['Image']) }}"
                                                                alt="User Image"></a>
                                                        <a href="{{ url('profile') }}">{{ $quotationreport['CompanyName'] }}
                                                            <span>{{ $quotationreport['Email'] }}</span></a>
                                                    </h2>
                                                </td>
                                                <td>{{ $quotationreport['Amount'] }}</td>
                                                <td>{{ $quotationreport['DueDate'] }}</td>
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
