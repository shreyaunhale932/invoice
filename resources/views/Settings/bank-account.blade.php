<?php $page = 'bank-account'; ?>
@extends('layout.mainlayout')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
        <!-- Page Header -->
        <!-- /Page Header -->
        <div class="row">
            <div class="col-xl-3 col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="page-header">
                            <div class="content-page-header">
                                <h5>Settings</h5>
                            </div>
                        </div>
                        <!-- Settings Menu -->
                        @component('components.settings-menu')
                        @endcomponent
                        <!-- /Settings Menu -->
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-md-8">
                <div class="card">
                    <div class="card-body w-100">
                        <div class="content-page-header p-0">
                            <h5>Bank Accounts</h5>
                            <div class="list-btn">
                                <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#bank_details"><i class="fa fa-plus-circle me-2"
                                        aria-hidden="true"></i>Add Bank</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-table">
                                    <div class="card-body">
                                        <div class="table-responsive no-pagination">
                                            <table class="table table-center table-hover datatable">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Name</th>
                                                        <th>Bank Name</th>
                                                        <th>Branch </th>
                                                        <th>Account Number </th>
                                                        <th>IFSC Code</th>
                                                        <th class="no-sort">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($user as $account)
                                                    <tr>
                                                        <td>{{ $account->id }}</td>
                                                        <td>
                                                            <h2 class="table-avatar">
                                                                <a href="{{ url('profile') }}">{{ $account->holdername }}</a>
                                                            </h2>
                                                        </td>
                                                        <td>{{ $account->bankname }}</td>
                                                        <td>{{ $account->branch }}</td> {{-- Ensure lowercase 'branch' --}}
                                                        <td>{{ $account->accno }}</td>
                                                        <td>{{ $account->ifsc }}</td>
                                                        <td class="d-flex align-items-center">
                                                            <div class="dropdown dropdown-action">
                                                                <a href="#" class="btn-action-icon" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="fas fa-ellipsis-v"></i>
                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <ul>
                                                                        <li>
                                                                            <a class="dropdown-item" href="">
                                                                                <i class="far fa-edit me-2"></i>Edit
                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <form action="" method="POST" onsubmit="return confirm('Are you sure?');">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="submit" class="dropdown-item">
                                                                                    <i class="far fa-trash-alt me-2"></i>Delete
                                                                                </button>
                                                                            </form>
                                                                        </li>
                                                                        <li>
                                                                            <a class="dropdown-item" href="">
                                                                                <i class="far fa-eye me-2"></i>View
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
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Page Wrapper -->
@endsection