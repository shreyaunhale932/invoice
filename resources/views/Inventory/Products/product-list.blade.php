<?php $page = 'product-list'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            @component('components.page-header')
                @slot('title')
                    Products
                @endslot
            @endcomponent
            <!-- /Page Header -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
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

                                                <th>Selling Price</th>
                                                <th>Purchase Price</th>
                                                <th class="no-sort">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($products as $product)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <h2 class="table-avatar">

                                                            <a
                                                                href="{{ url('profile') }}">{{ $product['product_name'] }}</a>
                                                        </h2>
                                                    </td>
                                                    <td>{{ $product['pre_code'] . '-' . $product['post_code']}}</td>
                                                    <td>
                                                        {{ $product->category->category_name ?? '-' }}
                                                    </td>


                                                    <td>{{ $product['sale_price'] }}</td>
                                                    <td>{{ $product['gold_price'] }}</td>
                                                    <td class="d-flex align-items-center">
                                                        <div class="dropdown dropdown-action">
                                                            <a href="#" class=" btn-action-icon "
                                                                data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                    class="fas fa-ellipsis-v"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <ul>
                                                                    <li>
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('products.edit', $product->id) }}">
                                                                            <i class="far fa-edit me-2"></i>Edit
                                                                        </a>

                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item text-danger" href="#"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#delete_modal"
                                                                            data-url="{{ route('products.destroy', $product->id) }}">
                                                                            <i class="far fa-trash-alt me-2"></i>Delete
                                                                        </a>


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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteModal = document.getElementById('delete_modal');

            deleteModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const url = button.getAttribute('data-url');

                document.getElementById('deleteProductForm').action = url;
            });
        });
    </script>
@endsection
