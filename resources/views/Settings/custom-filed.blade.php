<?php $page = 'custom-filed'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
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
                    @component('components.page-header')
                        @slot('title')
                            Custom Fields
                        @endslot
                    @endcomponent
                    <!-- /Page Header -->

                    <!-- Table -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-table">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <div class="companies-table filed">
                                            <table class="table table-center table-hover datatable">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Modules</th>
                                                        <th>Label</th>
                                                        <th>Type</th>
                                                        <th>Default Value</th>
                                                        <th>Required</th>
                                                        <th class="no-sort">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $json = file_get_contents(public_path('../public/assets/json/custom-filed.json'));
                                                        $customs = json_decode($json, true);
                                                    @endphp
                                                    @foreach ($customs as $custom)
                                                        <tr>
                                                            <td>{{ $custom['Id'] }}</td>
                                                            <td>{{ $custom['Modules'] }}</td>
                                                            <td>{{ $custom['Label'] }}</td>
                                                            <td>{{ $custom['Type'] }}</td>
                                                            <td>{{ $custom['DefaultValue'] }}</td>
                                                            <td>{{ $custom['Required'] }}</td>
                                                            <td class="d-flex align-items-center">
                                                                <a class=" btn-action-icon me-2" href="javascript:void(0);"
                                                                    data-bs-toggle="modal" data-bs-target="#edit"><i
                                                                        class="fe fe-edit"></i></a>
                                                                <a class=" btn-action-icon" href="javascript:void(0);"
                                                                    data-bs-toggle="modal" data-bs-target="#delete_modal"><i
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
                    </div>
                    <!-- /Table -->
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Wrapper -->
@endsection
