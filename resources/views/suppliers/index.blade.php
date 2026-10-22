<?php $page = 'suppliers'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            @component('components.page-header')
                @slot('title')
                    Suppliers
                @endslot
            @endcomponent
            <!-- /Page Header -->

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="row">
                <div class="col-sm-12">
                    <div class="card-table card p-3">
                        <div class="card-body">
                            <style>
                                #tableSearch {
                                    justify-content: space-between !important;
                                    align-items: center;
                                    flex-wrap: wrap;
                                    gap: 15px !important;
                                }
                                .suppliers-date-filter {
                                    display: flex;
                                    align-items: center;
                                    gap: 15px;
                                    flex-wrap: wrap;
                                }
                                @media (max-width: 767.98px) {
                                    .suppliers-date-filter {
                                        flex-direction: column;
                                        align-items: stretch;
                                        width: 100%;
                                        gap: 10px;
                                    }
                                }
                            </style>
                            {{-- <form method="GET" action="{{ route('suppliers.index') }}" class="mb-3">
                                <div id="tableSearch">
                                    <div class="suppliers-date-filter">
                                        <div class="d-flex align-items-center">
                                            <span class="text-muted me-2" style="font-size: 13px; font-weight: 500; white-space: nowrap;">Search:</span>
                                            <input type="text" name="search" class="form-control form-control-sm" style="width: 200px; height: 38px; border-radius: 5px;" placeholder="Name, phone, shop..." value="{{ request('search') }}">
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="text-muted me-2" style="font-size: 13px; font-weight: 500; white-space: nowrap;">From:</span>
                                            <input type="date" name="from_date" class="form-control form-control-sm" style="width: 140px; height: 38px; border-radius: 5px;" value="{{ request('from_date') }}">
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="text-muted me-2" style="font-size: 13px; font-weight: 500; white-space: nowrap;">To:</span>
                                            <input type="date" name="to_date" class="form-control form-control-sm" style="width: 140px; height: 38px; border-radius: 5px;" value="{{ request('to_date') }}">
                                        </div>
                                        <button type="submit" class="btn btn-primary d-flex align-items-center justify-content-center" style="height: 38px; border-radius: 5px; padding: 0 15px; font-size: 13px;">
                                            Filter
                                        </button>
                                        <a href="{{ route('suppliers.index') }}" class="btn btn-light d-flex align-items-center justify-content-center" style="height: 38px; border-radius: 5px; padding: 0 15px; background-color: #f3f3f9; border-color: #f3f3f9; color: #333; font-size: 13px; font-weight: 500;">
                                            Clear
                                        </a>
                                    </div>
                                </div>
                            </form> --}}

                            <div class="table-responsive">
                                <table class="table table-center table-hover datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Supplier Name</th>
                                            <th>Shop Name</th>
                                            <th>Phone</th>
                                            <th>GST No.</th>
                                            <th>City</th>
                                            <th>Created</th>
                                            <th class="text-end no-sort">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($suppliers as $supplier)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="{{ route('suppliers.show', $supplier->id) }}" class="fw-bold text-dark">
                                                            {{ $supplier->name }}
                                                        </a>
                                                    </h2>
                                                </td>
                                                <td>{{ $supplier->shop_name ?? '-' }}</td>
                                                <td>{{ $supplier->phone ?? '-' }}</td>
                                                <td>{{ $supplier->gst_no ?? '-' }}</td>
                                                <td>{{ $supplier->city ?? '-' }}</td>
                                                <td>{{ $supplier->created_at ? $supplier->created_at->format('d M Y') : '-' }}</td>
                                                <td class="text-end">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fas fa-ellipsis-v"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-menu-item dropdown-item" href="{{ route('suppliers.show', $supplier->id) }}">
                                                                <i class="far fa-eye me-2"></i>View Details
                                                            </a>
                                                            <a class="dropdown-menu-item dropdown-item" href="{{ route('suppliers.edit', $supplier->id) }}">
                                                                <i class="far fa-edit me-2"></i>Edit
                                                            </a>
                                                            <a class="dropdown-menu-item dropdown-item text-danger" href="#" data-bs-toggle="modal" data-bs-target="#delete_supplier_{{ $supplier->id }}">
                                                                <i class="far fa-trash-alt me-2"></i>Delete
                                                            </a>
                                                        </div>
                                                    </div>

                                                    <!-- Delete Modal -->
                                                    <div class="modal custom-modal fade" id="delete_supplier_{{ $supplier->id }}" role="dialog">
                                                        <div class="modal-dialog modal-dialog-centered modal-md">
                                                            <div class="modal-content">
                                                                <div class="modal-body">
                                                                    <div class="form-header text-center">
                                                                        <h3>Delete Supplier</h3>
                                                                        <p>Are you sure you want to delete supplier <strong>{{ $supplier->name }}</strong>?</p>
                                                                    </div>
                                                                    <div class="modal-btn delete-action">
                                                                        <div class="row">
                                                                            <div class="col-6">
                                                                                <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST">
                                                                                    @csrf
                                                                                    @method('DELETE')
                                                                                    <button type="submit" class="btn btn-primary paid-continue-btn w-100">Delete</button>
                                                                                </form>
                                                                            </div>
                                                                            <div class="col-6">
                                                                                <button type="button" data-bs-dismiss="modal" class="btn btn-primary paid-cancel-btn w-100">Cancel</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /Delete Modal -->
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center py-4 text-muted">
                                                    No suppliers found. <a href="{{ route('suppliers.create') }}">Add a new supplier</a>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Wrapper -->
@endsection
