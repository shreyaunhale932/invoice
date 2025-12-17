<?php $page = 'purity'; ?>
@extends('layout.mainlayout')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            @component('components.page-header')
                @slot('title')
                    Purity
                @endslot
            @endcomponent
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            <!-- Search Filter -->
            @component('components.search-filter')
            @endcomponent

            <!-- Header (Add Button etc.) -->
            @component('components.products-header')
            @endcomponent

            <!-- Table -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-table">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-center table-hover datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Purity</th>
                                            <th>Purity Type</th>
                                            <th class="no-sort">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($purities as $purity)
                                            <tr>
                                                <td>{{ $purity->id }}</td>

                                                <td>
                                                    @if ($purity->purity_type === 'karat')
                                                        {{ $purity->purity_value }}K
                                                    @elseif ($purity->purity_type === 'percent')
                                                        {{ $purity->purity_value }}%
                                                    @else
                                                        {{ $purity->purity_value }}
                                                    @endif
                                                </td>


                                                <td>
                                                    {{ $purity->purity_type }}
                                                </td>

                                                <td class="d-flex align-items-center">

                                                    <!-- Edit -->
                                                    <a href="javascript:void(0)" class="btn-action-icon me-2 editPurityBtn"
                                                        data-bs-toggle="modal" data-bs-target="#edit_purity"
                                                        data-id="{{ $purity->id }}">
                                                        <i class="fe fe-edit"></i>
                                                    </a>


                                                    <!-- Delete -->
                                                    <a class="btn-action-icon" href="javascript:void(0);"
                                                        data-bs-toggle="modal" data-bs-target="#delete_modal"
                                                        data-id="{{ $purity->id }}">
                                                        <i class="fe fe-trash-2"></i>
                                                    </a>

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
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            $('.editPurityBtn').on('click', function() {
                let id = $(this).data('id');

                $.get("purity/" + id + "/edit", function(data) {
                    $('#edit_id').val(data.id);
                    $('#edit_purity_value').val(data.purity_value);
                    $('#edit_purity_type').val(data.purity_type).trigger("change");

                    $('#editPurityForm').attr('action', 'purity/' + id);
                    $('#editPurityModal').modal('show');
                });
            });

        });
    </script>
    <script>
        $(document).on("click", "[data-bs-target='#delete_modal']", function() {
            let id = $(this).data("id");

            let url = "{{ route('purity.destroy', ':id') }}";
            url = url.replace(':id', id);

            $("#deletePurityForm").attr("action", url);
        });
    </script>
@endsection
