<?php $page = 'categories'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            @component('components.page-header')
                @slot('title')
                    Categories
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
                    <div class=" card-table">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-stripped table-hover datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Category Name</th>
                                            <th>Date</th>
                                            <th>Added By</th>
                                            <th>Status</th>
                                            <th class="no-sort">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $json = file_get_contents(public_path('../public/assets/json/categories.json'));
                                            $categories = json_decode($json, true);
                                        @endphp
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td>{{ $category['Id'] }}</td>
                                                <td>
                                                    <h2>
                                                        <img class="avatar-img rounded me-2" width="30" height="30"
                                                            src="{{ URL::asset('/assets/img/category/' . $category['Image']) }}"
                                                            alt="User Image">
                                                    </h2>{{ $category['CategoryName'] }}
                                                </td>
                                                <td>{{ $category['Date'] }}</td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="{{ url('profile') }}" class="avatar avatar-sm me-2"><img
                                                                class="avatar-img rounded-circle"
                                                                src="{{ URL::asset('/assets/img/profiles/' . $category['AdminImage']) }}"
                                                                alt="User Image"></a>
                                                        <a href="{{ url('profile') }}">{{ $category['AddedBy'] }}</a>
                                                    </h2>
                                                </td>
                                                <td>
                                                    <div class="status-toggle">
                                                        <input id="{{ $category['StatusId'] }}" class="check"
                                                            type="checkbox" checked="">
                                                        <label for="{{ $category['StatusFor'] }}"
                                                            class="checktoggle checkbox-bg">{{ $category['Status'] }}</label>
                                                    </div>
                                                </td>
                                                <td class="d-flex align-items-center">
                                                    <a class=" btn-action-icon me-2" href="javascript:void(0);"
                                                        download=""><i class="fe fe-edit"></i></a>
                                                    <a class=" btn-action-icon" href="javascript:void(0);" download=""><i
                                                            class="fe fe-trash-2"></i></a>
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
