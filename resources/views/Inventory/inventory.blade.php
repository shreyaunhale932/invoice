<?php $page = 'inventory'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            @component('components.page-header')
                @slot('title')
                    Inventory
                @endslot
            @endcomponent
            <!-- /Page Header -->

            <!-- Table -->
            <div class="row">
                <div class="col-sm-12">
                    <div class=" card-table">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-center table-hover datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Item</th>
                                            <th>Code</th>
                                            <th>Units</th>
                                            <th>Quantity</th>
                                            <th>Selling Price</th>
                                            <th>Purchase Price</th>
                                            <th class="no-sort">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $json = file_get_contents(public_path('../public/assets/json/inventory.json'));
                                            $inventories = json_decode($json, true);
                                        @endphp
                                        @foreach ($inventories as $inventory)
                                            <tr>
                                                <td>{{ $inventory['Id'] }}</td>
                                                <td>{{ $inventory['Item'] }}</td>
                                                <td>{{ $inventory['Code'] }}</td>
                                                <td>{{ $inventory['Units'] }}</td>
                                                <td>{{ $inventory['Quantity'] }}</td>
                                                <td>{{ $inventory['SellingPrice'] }}</td>
                                                <td>{{ $inventory['PurchasePrice'] }}</td>
                                                <td class="d-flex align-items-center">
                                                    <a href="{{ url('inventory-history') }}"
                                                        class="btn btn-greys bg-history-light me-2">
                                                        <i class="far fa-eye me-1"></i> History
                                                    </a>
                                                    <a href="#" class="btn btn-greys bg-success-light me-2"
                                                        data-bs-toggle="modal" data-bs-target="#stock_in">
                                                        <i class="fa fa-plus-circle me-1"></i> Stock in
                                                    </a>
                                                    <a href="#" class="btn btn-greys bg-danger-light me-2"
                                                        data-bs-toggle="modal" data-bs-target="#stock_out">
                                                        <i class="fa fa-plus-circle me-1"></i> Stock out
                                                    </a>
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class=" btn-action-icon "
                                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                class="fas fa-ellipsis-v"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <ul>
                                                                <li>
                                                                    <a class="dropdown-item" href="#"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#edit_inventory"><i
                                                                            class="far fa-edit me-2"></i>Edit</a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="#"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#delete_stock"><i
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
