<?php $page = 'income-report'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            @component('components.page-header')
                @slot('title')
                    Income Report
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
                                            <th>Company</th>
                                            <th>Date</th>
                                            <th>Income Amount </th>
                                            <th>Payment Method </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $json = file_get_contents(public_path('../public/assets/json/income-report.json'));
                                            $incomereports = json_decode($json, true);
                                        @endphp
                                        @foreach ($incomereports as $incomereport)
                                            <tr>
                                                <td>{{ $incomereport['Id'] }}</td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="{{ url('profile') }}" class="avatar avatar-md me-2"><img
                                                                class="avatar-img rounded-circle"
                                                                src="{{ URL::asset('assets/img/profiles/' . $incomereport['Image']) }}"
                                                                alt="User Image"></a>
                                                        <a href="{{ url('profile') }}">{{ $incomereport['Company'] }}
                                                            <span>{{ $incomereport['Email'] }}</span></a>
                                                    </h2>
                                                </td>
                                                <td>{{ $incomereport['Date'] }}</td>
                                                <td>{{ $incomereport['IncomeAmount'] }}</td>
                                                <td>{{ $incomereport['PaymentMethod'] }}</td>
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
