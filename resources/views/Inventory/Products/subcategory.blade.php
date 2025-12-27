<?php $page = 'category'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            @component('components.page-header')
                @slot('title')
                    Sub Category
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
                                <table class="table table-center table-hover datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Category Name</th>
                                            <th>Subcategory Name</th>
                                            <th class="no-sort">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            @foreach ($category->subcategories as $sub)
                                                <tr>
                                                    <td>{{ $loop->parent->iteration }}</td>
                                                    <td>{{ $category->category_name }}</td>
                                                    <td>{{ $sub->subcategory_name }}</td>

                                                    <td class="d-flex align-items-center">
                                                        <!-- EDIT -->
                                                        <a href="javascript:void(0);"
                                                            class="btn-action-icon me-2 editsubCategoryBtn"
                                                            data-bs-toggle="modal" data-bs-target="#edit_subcategory"
                                                            data-id="{{ $sub->subcategory_id }}"
                                                            data-name="{{ $sub->subcategory_name }}"
                                                            data-category="{{ $sub->category_id }}">
                                                            <i class="fe fe-edit"></i>
                                                        </a>

                                                        <!-- DELETE -->
                                                        <a class="btn-action-icon" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#delete_modal"
                                                            data-id="{{ $sub->subcategory_id }}">
                                                            <i class="fe fe-trash-2"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
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
    <script>
        $(document).on('click', '.editsubCategoryBtn', function() {

            let id = $(this).data('id');

            $('#edit_subcategory_id').val(id);
            $('#edit_subcategory_name').val($(this).data('name'));
            $('#edit_category_id').val($(this).data('category'));

            // 👇 THIS IS THE KEY FIX
            let url = "{{ route('subcategory.update', ':id') }}";
            url = url.replace(':id', id);

            $('#editSubcategoryForm').attr('action', url);
        });
    </script>
    <script>
        $(document).on("click", "[data-bs-target='#delete_modal']", function() {
            let id = $(this).data("id");

            let url = "{{ route('subcategory.destroy', ':id') }}";
            url = url.replace(':id', id);

            $("#deletesubCategoryForm").attr("action", url);
        });
    </script>
@endsection
