<?php $page = 'transactions'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            @component('components.page-header')
                @slot('title')
                    Transactions
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
                                            <th>Type</th>
                                            <th>Amount</th>
                                            <th>Date </th>
                                            <th>Payment Type</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $json = file_get_contents(public_path('../public/assets/json/transactions.json'));
                                            $transcations = json_decode($json, true);
                                        @endphp
                                        @foreach ($transcations as $transcation)
                                            <tr>
                                                <td>{{ $transcation['Id'] }}</td>
                                                <td>{{ $transcation['Type'] }}</td>
                                                <td class="{{ $transcation['ClassAmount'] }}">{{ $transcation['Amount'] }}
                                                </td>
                                                <td>{{ $transcation['Date'] }}</td>
                                                <td>{{ $transcation['PaymentType'] }}</td>
                                                <td><span
                                                        class="{{ $transcation['Class'] }}">{{ $transcation['Status'] }}</span>
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
