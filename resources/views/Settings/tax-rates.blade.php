<?php $page = 'tax-rates'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->

            <!-- /Page Header -->

            <div class="row">
                <div class="col-xl-3 col-md-4">

                    <div class="card">
                        <div class="card-body">
                            <div class="page-header">
                                <div class="content-page-header">
                                    <h5>Settings</h5>
                                </div>
                            </div>
                            <!-- Settings Menu -->
                            @component('components.settings-menu')
                            @endcomponent
                            <!-- /Settings Menu -->
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-md-8">
                    <div class="card">
                        <div class="card-body w-100">
                            <div class="content-page-header p-0">
                                <h5>Tax Rates</h5>
                                <div class="list-btn">
                                    <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#add_discount"><i class="fa fa-plus-circle me-2"
                                            aria-hidden="true"></i>Add Tax</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-table">
                                        <div class="card-body">
                                            <div class="table-responsive no-pagination">
                                                <table class="table table-center table-hover datatable">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Name</th>
                                                            <th>Tax Rate</th>
                                                            <th>Status </th>
                                                            <th class="no-sort">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $json = file_get_contents(public_path('../public/assets/json/tax-rates.json'));
                                                            $taxes = json_decode($json, true);
                                                        @endphp
                                                        @foreach ($taxes as $tax)
                                                            <tr>
                                                                <td>{{ $tax['Id'] }}</td>
                                                                <td>
                                                                    <h2 class="tax-name">{{ $tax['Name'] }}</h2>
                                                                </td>
                                                                <td>{{ $tax['TaxRate'] }}</td>
                                                                <td>
                                                                    <div class="status-toggle">
                                                                        <input id="{{ $tax['StatusId'] }}" class="check"
                                                                            type="checkbox" checked="">
                                                                        <label for="{{ $tax['StatusFor'] }}"
                                                                            class="checktoggle checkbox-bg">{{ $tax['Status'] }}</label>
                                                                    </div>
                                                                </td>
                                                                <td class="d-flex align-items-center">
                                                                    <div class="dropdown dropdown-action">
                                                                        <a href="#" class=" btn-action-icon "
                                                                            data-bs-toggle="dropdown"
                                                                            aria-expanded="false"><i
                                                                                class="fas fa-ellipsis-v"></i></a>
                                                                        <div class="dropdown-menu dropdown-menu-end">
                                                                            <ul>
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                        href="javascript:void(0);"><i
                                                                                            class="far fa-edit me-2"></i>Edit</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                        href="javascript:void(0);"
                                                                                        data-bs-toggle="modal"
                                                                                        data-bs-target="#delete_modal"><i
                                                                                            class="far fa-trash-alt me-2"></i>Delete</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                        href="javascript:void(0);"><i
                                                                                            class="far fa-eye me-2"></i>View</a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                <div class="col-lg-12">
                                                    <div class="btn-path text-end">
                                                        <a href="javascript:void(0);"
                                                            class="btn btn-cancel bg-primary-light me-3">Cancel</a>
                                                        <a href="javascript:void(0);" class="btn btn-primary">Save
                                                            Changes</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Wrapper -->
@endsection
