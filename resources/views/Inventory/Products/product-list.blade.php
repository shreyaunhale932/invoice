<?php $page = 'product-list'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            @component('components.page-header')
                @slot('title')
                    Products / Services
                @endslot
            @endcomponent
            <!-- /Page Header -->

            <!-- Search Filter -->
            @component('components.search-filter')
            @endcomponent
            <!-- /Search Filter -->

            <!-- All Invoice -->
            @component('components.products-header')
            @endcomponent
            <!-- /All Invoice -->

            <!-- Table -->
            <div class="row">
                <div class="col-sm-12">
                    <div class=" card-table">
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="companies-table">
                                    <table class="table table-center table-hover datatable">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Item</th>
                                                <th>Code</th>
                                                <th>Category</th>
                                                <th>Units</th>
                                                <th>Quantity</th>
                                                <th>Selling Price</th>
                                                <th>Purchase Price</th>
                                                <th class="no-sort">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $json = file_get_contents(public_path('../public/assets/json/product-list.json'));
                                                $products = json_decode($json, true);
                                            @endphp
                                            @foreach ($products as $product)
                                                <tr>
                                                    <td>{{ $product['Id'] }}</td>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <a href="{{ url('profile') }}"
                                                                class="avatar avatar-md me-2 companies">
                                                                <img class="avatar-img sales-rep"
                                                                    src="{{ URL::asset('/assets/img/' . $product['Image']) }}"
                                                                    alt="User Image"></a>
                                                            <a href="{{ url('profile') }}">{{ $product['Item'] }}</a>
                                                        </h2>
                                                    </td>
                                                    <td>{{ $product['Code'] }}</td>
                                                    <td>{{ $product['Category'] }}</td>
                                                    <td>{{ $product['Units'] }}</td>
                                                    <td>{{ $product['Quantity'] }}</td>
                                                    <td>{{ $product['SellingPrice'] }}</td>
                                                    <td>{{ $product['PurchasePrice'] }}</td>
                                                    <td class="d-flex align-items-center">
                                                        <div class="dropdown dropdown-action">
                                                            <a href="#" class=" btn-action-icon "
                                                                data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                    class="fas fa-ellipsis-v"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <ul>
                                                                    <li>
                                                                        <a class="dropdown-item"
                                                                            href="{{ url('edit-products') }}"><i
                                                                                class="far fa-edit me-2"></i>Edit</a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item" href="#"
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
            </div>
            <!-- /Table -->

        </div>
    </div>
    <!-- /Page Wrapper -->
@endsection
