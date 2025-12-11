<?php $page = 'users'; ?>
@extends('layout.mainlayout')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
        <!-- Page Header -->
        @component('components.page-header')
        @slot('title')
        Usersr
        @endslot
        @endcomponent
        <!-- /Page Header -->
        @if (Route::is(['createAdmin']))
        <div class="row">
            <div class="col-sm-12">
                <div class="card-table">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-center table-hover " id="example">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>User admin 1Name</th>
                                        <th>Mobile Number</th>
                                        <th>Role </th>

                                        <th>Created on</th>
                                        <th>Status</th>
                                        <th Class="no-sort">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>
                                            <h2 class="table-avatar">
                                               
                                                <a href="{{ url('profile') }}">{{ $user->name }}
                                                    <span>{{ $user->email }}</span>
                                                </a>
                                            </h2>
                                        </td>
                                        <td>{{ $user->phone ?? 'N/A' }}</td>
                                        <td>{{ $user->role }}</td>
                                        <td>{{ $user->created_at ? $user->created_at->format('Y-m-d') : 'N/A' }}</td>
                                        <td>
                                            <span class="{{ $user->status == 'active' ? 'text-success' : 'text-danger' }}">
                                                {{ ucfirst($user->status) }}
                                            </span>
                                        </td>
                                        <td class="d-flex align-items-center">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="btn-action-icon" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <ul>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"
                                                                data-bs-target="#edit_user">
                                                                <i class="far fa-edit me-2"></i>Edit
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"
                                                                data-bs-target="#delete_modal">
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
        @endif

    </div>
</div>
<!-- jQuery (Load First) -->




<script>
    $(document).ready(function () {
        console.log("DataTables Loaded:", typeof $.fn.DataTable);
        console.log("Buttons Loaded:", $.fn.DataTable.Buttons ? "Yes" : "No");

        var table = $("#example").DataTable({
            responsive: true,
            lengthChange: false,
            autoWidth: false,
            dom: 'Bfrtip',  // Important for Buttons
            buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
        });

        if ($.fn.DataTable.Buttons) {
            console.log("Appending Buttons...");
            table.buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');
        } else {
            console.error("Buttons extension is missing!");
        }
    });
</script>



<!-- /Page Wrapper -->
@endsection