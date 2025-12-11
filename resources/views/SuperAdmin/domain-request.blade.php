<?php $page = 'domain-request'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            @component('components.page-header')
                @slot('title')
                    Domain Request
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
                                            <th>Customer</th>
                                            <th>Domain</th>
                                            <th>No of Employees </th>
                                            <th>Package</th>
                                            <th>Created On</th>
                                            <th>Status</th>
                                            <th class="no-sort">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $json = file_get_contents(
                                                public_path('../public/assets/json/domain-request.json'),
                                            );
                                            $domains = json_decode($json, true);
                                        @endphp
                                        @foreach ($domains as $domain)
                                            <tr>
                                                <td>{{ $domain['Id'] }}</td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="{{ url('profile') }}">{{ $domain['Customer'] }}
                                                            <span>{{ $domain['Email'] }}</span></a>
                                                    </h2>
                                                </td>
                                                <td>{{ $domain['Domain'] }}</td>
                                                <td>{{ $domain['NoofEmployees'] }}</td>
                                                <td>
                                                    {{ $domain['Package'] }}
                                                    <p>{{ $domain['Pack'] }}</p>
                                                </td>
                                                <td>{{ $domain['CreatedOn'] }}</td>
                                                <td><span class="{{ $domain['Class'] }}">{{ $domain['Status'] }}</span>
                                                </td>
                                                <td class="d-flex align-items-center">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class=" btn-action-icon "
                                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                class="fas fa-ellipsis-v"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <ul>
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);"><i
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
