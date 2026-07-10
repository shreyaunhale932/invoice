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
                                                <th>Barcode</th>
                                                <th>Code</th>
                                                <th>Category</th>
                                                <th>SubCategory</th>
                                                <th>Gs Wt</th>
                                                <th>Net Wt</th>
                                                {{-- <th>final Wt</th> --}}
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

            {{-- <h5>Diamonds</h5>

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
@endif --}}


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
                                                    <td>{{ $product->barcode }}</td>
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

                                                    {{-- <td>

                                                        {{ $product->final_fn_weight ?? '-' }}
                                                    </td> --}}




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
                                                                        <a class="dropdown-item btn-print-tag" href="#"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#print_tag_modal"
                                                                            data-product-id="{{ $product->id }}"
                                                                            data-product-name="{{ $product->product_name }}">
                                                                            <i class="fas fa-print me-2"></i>Print Tag
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
            <!-- Print Tag Modal -->
            <div class="modal fade" id="print_tag_modal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Print Product Tag</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Product Name</label>
                                <input type="text" id="modal_product_name" class="form-control" readonly>
                                <input type="hidden" id="modal_product_id">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Select Template</label>
                                <select class="form-select" id="modal_template_id">
                                    @if(count($templates ?? []) > 0)
                                        @foreach($templates as $template)
                                            <option value="{{ $template->id }}" {{ $template->is_default ? 'selected' : '' }}>
                                                {{ $template->name }} ({{ $template->canvas_width }}x{{ $template->canvas_height }}mm)
                                            </option>
                                        @endforeach
                                    @else
                                        <option value="">-- No Templates Available --</option>
                                    @endif
                                </select>
                                @if(count($templates ?? []) == 0)
                                    <div class="form-text text-danger mt-1">
                                        Please create a print template in the <a href="{{ route('labels.designer.create') }}">Label Designer</a> first.
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary" id="btnConfirmPrint" {{ count($templates ?? []) == 0 ? 'disabled' : '' }}>
                                <i class="fas fa-print me-2"></i>Print Tag
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Print Tag Modal -->

        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteModal = document.getElementById('delete_modal');

            if (deleteModal) {
                deleteModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;
                    const url = button.getAttribute('data-url');

                    document.getElementById('deleteProductForm').action = url;
                });
            }

            // Print Tag Modal Handler
            const printTagModal = document.getElementById('print_tag_modal');
            if (printTagModal) {
                printTagModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;
                    const productId = button.getAttribute('data-product-id');
                    const productName = button.getAttribute('data-product-name');

                    document.getElementById('modal_product_id').value = productId;
                    document.getElementById('modal_product_name').value = productName;
                });
            }

            document.getElementById('btnConfirmPrint')?.addEventListener('click', function() {
                const templateId = document.getElementById('modal_template_id').value;
                const productId = document.getElementById('modal_product_id').value;

                if (!templateId) {
                    alert('Please select a template first.');
                    return;
                }

                // Open print preview in a new window/tab
                const url = `{{ url('/labels/print/preview') }}/${templateId}/${productId}`;
                window.open(url, '_blank');

                // Hide modal using bootstrap
                const modalInstance = bootstrap.Modal.getInstance(printTagModal);
                if (modalInstance) {
                    modalInstance.hide();
                } else {
                    $('#print_tag_modal').modal('hide');
                }
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
