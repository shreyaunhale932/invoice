<?php $page = 'demo_requests'; ?>
@extends('layout.mainlayout')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
        <!-- Page Header -->
        @component('components.page-header')
        @slot('title')
        Demo Requests
        @endslot
        @endcomponent

        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <div class="row">
            <div class="col-sm-12">
                <div class="card-table">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-center table-hover" id="example">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Phone No.</th>
                                        <th>Business Name</th>
                                        <th>Message</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($demoRequests as $req)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="javascript:void(0);">{{ $req->full_name }}
                                                    <span>{{ $req->email }}</span>
                                                </a>
                                            </h2>
                                        </td>
                                        <td>{{ $req->email ?? 'N/A' }}</td>
                                        <td>{{ $req->phone }}</td>
                                        <td>{{ $req->business_name ?? 'N/A' }}</td>
                                        <td style="max-width: 250px; word-wrap: break-word;">{{ $req->message }}</td>
                                        <td>{{ $req->created_at ? $req->created_at->format('d M Y h:i A') : 'N/A' }}</td>
                                        <td>
                                            <form action="{{ route('superadmin.demo-requests.update-status', $req->id) }}" method="POST" class="d-inline-block">
                                                @csrf
                                                @method('PATCH')
                                                <select name="status" class="form-select form-select-sm border-0 fw-semibold {{ $req->status == 'Completed' ? 'bg-success text-white' : ($req->status == 'Contacted' ? 'bg-info text-white' : ($req->status == 'Scheduled' ? 'bg-primary text-white' : ($req->status == 'Cancelled' ? 'bg-danger text-white' : 'bg-warning text-dark'))) }}" onchange="this.form.submit()">
                                                    <option value="Pending" {{ $req->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="Contacted" {{ $req->status == 'Contacted' ? 'selected' : '' }}>Contacted</option>
                                                    <option value="Scheduled" {{ $req->status == 'Scheduled' ? 'selected' : '' }}>Scheduled</option>
                                                    <option value="Completed" {{ $req->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                                    <option value="Cancelled" {{ $req->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                                </select>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="{{ route('superadmin.demo-requests.destroy', $req->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this demo request?');" class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </form>
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
</div>
@endsection
