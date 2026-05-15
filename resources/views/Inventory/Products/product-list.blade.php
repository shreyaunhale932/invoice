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
                                                <th></th>
                                                <th>#</th>
                                                <th>Item</th>
                                                <th>Image</th>
                                                <th>Code</th>
                                                <th>Category</th>
                                                <th>SubCategory</th>
                                                <th>Gs Wt</th>
                                                <th>Net Wt</th>
                                                <th>final Wt</th>


                                                <th>Selling Price</th>
                                                {{-- <th>Purchase Price</th> --}}
                                                <th>Availability</th>
                                                <th class="no-sort">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($products as $product)
                                                <tr>
                                                    <td class="details-control">
                                                        <button type="button" class="btn btn-sm btn-primary show-details"
                                                            data-details='

        <div class="p-3">

            <h5>Diamonds</h5>

            @if ($product->diamonds->count())
<table class="table table-bordered">
                    <tr>
                        <th>Clarity</th>
                        <th>Color</th>
                        <th>Cut</th>
                        <th>Weight</th>
                        <th>Price</th>
                    </tr>

                    @foreach ($product->diamonds as $diamond)
<tr>
                            <td>{{ $diamond->clarity }}</td>
                            <td>{{ $diamond->color }}</td>
                            <td>{{ $diamond->cut }}</td>
                            <td>{{ $diamond->diamond_weight }}</td>
                            <td>{{ $diamond->diamond_final_price }}</td>
                        </tr>
@endforeach
                </table>
@else
<p>No Diamonds</p>
@endif


            <h5>Stones</h5>

            @if ($product->stones->count())
<table class="table table-bordered">
                    <tr>
                        <th>Name</th>
                        <th>Weight</th>
                        <th>Amount</th>
                    </tr>

                    @foreach ($product->stones as $stone)
<tr>
                            <td>{{ $stone->stone_name }}</td>
                            <td>{{ $stone->stone_weight }}</td>
                            <td>{{ $stone->stone_final_price }}</td>
                        </tr>
@endforeach
                </table>
@else
<p>No Stones</p>
@endif


            <h5>Packets</h5>

            @if ($product->packets->count())
<table class="table table-bordered">
                    <tr>
                        <th>Packet No</th>
                        <th>Pcs</th>
                        <th>Weight</th>
                        <th>Amount</th>
                    </tr>

                    @foreach ($product->packets as $packet)
<tr>
                            <td>{{ $packet->packet_no }}</td>
                            <td>{{ $packet->pcs }}</td>
                            <td>{{ $packet->weight }}</td>
                            <td>{{ $packet->amount }}</td>
                        </tr>
@endforeach
                </table>
@else
<p>No Packets</p>
@endif

        </div>
        '>
                                                            +
                                                        </button>
                                                    </td>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <h2 class="table-avatar">

                                                            <a href="#">{{ $product['product_name'] }}</a>
                                                        </h2>
                                                    </td>
                                                    <td>
                                                        @if (isset($product) && $product->image)
                                                            <img src="{{ asset($product->image) }}" width="70">
                                                        @endif
                                                    </td>
                                                    <td>{{ $product['pre_code'] . '-' . $product['post_code'] }}</td>
                                                    <td>
                                                        {{ $product->category->category_name ?? '-' }}
                                                    </td>
                                                    <td>
                                                        {{ $product->subcategory->subcategory_name ?? '-' }}
                                                    </td>
                                                    <td>
                                                        {{ $product->gross_weight ?? '-' }}
                                                    </td>
                                                    <td>
                                                        {{ $product->net_weight ?? '-' }}
                                                    </td>

                                                    <td>

                                                        {{ $product->final_fn_weight ?? '-' }}
                                                    </td>



                                                    <td>{{ $product['sale_price'] }}</td>
                                                    {{-- <td>{{ $product['final_price'] }}</td> --}}
                                                    <td>
                                                        @if (($product->availability ?? 'available') == 'available')
                                                            <span class="badge bg-success">Available</span>
                                                        @else
                                                            <span class="badge bg-danger">Sold</span>
                                                        @endif
                                                    </td>
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
    <script>
        $(document).ready(function() {

            var table = $('.datatable').DataTable();

            $('.datatable tbody').on('click', '.show-details', function() {

                var tr = $(this).closest('tr');
                var row = table.row(tr);

                if (row.child.isShown()) {

                    row.child.hide();
                    tr.removeClass('shown');
                    $(this).text('+');

                } else {

                    var details = $(this).attr('data-details');

                    row.child(details).show();
                    tr.addClass('shown');
                    $(this).text('-');
                }

            });

        });
    </script>
@endsection
