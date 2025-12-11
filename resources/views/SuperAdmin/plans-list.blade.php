<?php $page = 'plans-list'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="subscription-plane-head">
                <ul>
                    <li>
                        <a href="{{ url('packages') }}" class="active">Subscription Plans</a>
                    </li>
                    <li>
                        <a href="{{ url('subscription') }}">Subscribers List</a>
                    </li>
                </ul>
            </div>

            <!-- Page Header -->
            @component('components.page-header')
                @slot('title')
                    Plans List
                @endslot
            @endcomponent
            <!-- /Page Header -->

            <div class="super-admin-list-head">
                <div class="row">
                    <div class="col-xl-3 col-md-6 d-flex">
                        <div class="card">
                            <div class="card-body">
                                <div class="grid-info-item total-plane">
                                    <div class="grid-info">
                                        <span>Total Plan</span>
                                        <h4>07</h4>
                                    </div>
                                    <div class="grid-head-icon">
                                        <i class="fe fe-package"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 d-flex">
                        <div class="card">
                            <div class="card-body">
                                <div class="grid-info-item active-plane">
                                    <div class="grid-info">
                                        <span>Active Plans</span>
                                        <h4>07</h4>
                                    </div>
                                    <div class="grid-head-icon">
                                        <i class="fe fe-list"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 d-flex">
                        <div class="card">
                            <div class="card-body">
                                <div class="grid-info-item inactive-plane">
                                    <div class="grid-info">
                                        <span>Inactive Plans</span>
                                        <h4>0</h4>
                                    </div>
                                    <div class="grid-head-icon">
                                        <i class="fe fe-pause-circle"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 d-flex">
                        <div class="card w-100">
                            <div class="card-body">
                                <div class="grid-info-item total-type">
                                    <div class="grid-info">
                                        <span>No of Plan Types</span>
                                        <h4>04</h4>
                                    </div>
                                    <div class="grid-head-icon">
                                        <i class="fe fe-pocket"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card-table">
                        <div class="card-body">
                            <div class="table-responsive no-pagination">
                                <div class="companies-table">
                                    <table class="table table-center table-hover datatable">
                                        <thead class="thead-light">
                                            <tr>
                                                <th Class="no-sort">#</th>
                                                <th>Plan Name</th>
                                                <th>Plan Type</th>
                                                <th>Price</th>
                                                <th>Users</th>
                                                <th>Suppliers</th>
                                                <th>Products</th>
                                                <th>Invoice</th>
                                                <th>Created Date</th>
                                                <th>Status</th>
                                                <th Class="no-sort">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>
                                                    Free
                                                </td>
                                                <td>Monthly</td>
                                                <td>$00.00</td>
                                                <td>2</td>
                                                <td>1</td>
                                                <td>10</td>
                                                <td>1</td>
                                                <td>19 Jan 2024</td>
                                                <td><span class="badge bg-success-light d-inline-flex align-items-center"><i
                                                            class="fe fe-check me-1"></i>Active</span></td>
                                                <td class="d-flex align-items-center">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class=" btn-action-icon" data-bs-toggle="dropdown"
                                                            aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul class="dropdown-ul">
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#edit_package"><i
                                                                            class="fe fe-edit me-2"></i>Edit</a>
                                                                </li>
                                                                <li class="delete-alt">
                                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#delete_modal"><i
                                                                            class="fe fe-trash-2 me-2"></i>Delete</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>
                                                    Basic
                                                </td>
                                                <td>Yearly</td>
                                                <td>$19.99</td>
                                                <td>5</td>
                                                <td>5</td>
                                                <td>100</td>
                                                <td>10</td>
                                                <td>16 Jan 2024</td>
                                                <td><span class="badge bg-success-light d-inline-flex align-items-center"><i
                                                            class="fe fe-check me-1"></i>Active</span></td>
                                                <td class="d-flex align-items-center">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class=" btn-action-icon" data-bs-toggle="dropdown"
                                                            aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul class="dropdown-ul">
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#edit_package"><i
                                                                            class="fe fe-edit me-2"></i>Edit</a>
                                                                </li>
                                                                <li class="delete-alt">
                                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#delete_modal"><i
                                                                            class="fe fe-trash-2 me-2"></i>Delete</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>
                                                    Premium
                                                </td>
                                                <td>Lifetime</td>
                                                <td>$6549.99</td>
                                                <td>50</td>
                                                <td>10</td>
                                                <td>1000</td>
                                                <td>1000</td>
                                                <td>12 Jan 2024</td>
                                                <td><span class="badge bg-success-light d-inline-flex align-items-center"><i
                                                            class="fe fe-check me-1"></i>Active</span></td>
                                                <td class="d-flex align-items-center">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class=" btn-action-icon" data-bs-toggle="dropdown"
                                                            aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul class="dropdown-ul">
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#edit_package"><i
                                                                            class="fe fe-edit me-2"></i>Edit</a>
                                                                </li>
                                                                <li class="delete-alt">
                                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#delete_modal"><i
                                                                            class="fe fe-trash-2 me-2"></i>Delete</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>
                                                    Enterprise
                                                </td>
                                                <td>Yearly</td>
                                                <td>$99.99</td>
                                                <td>1000</td>
                                                <td>Unlimited</td>
                                                <td>Unlimited</td>
                                                <td>Unlimited</td>
                                                <td>9 Jan 2024</td>
                                                <td><span
                                                        class="badge bg-success-light d-inline-flex align-items-center"><i
                                                            class="fe fe-check me-1"></i>Active</span></td>
                                                <td class="d-flex align-items-center">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class=" btn-action-icon"
                                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                class="fas fa-ellipsis-v"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul class="dropdown-ul">
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#edit_package"><i
                                                                            class="fe fe-edit me-2"></i>Edit</a>
                                                                </li>
                                                                <li class="delete-alt">
                                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#delete_modal"><i
                                                                            class="fe fe-trash-2 me-2"></i>Delete</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>
                                                    Advanced
                                                </td>
                                                <td>Monthly</td>
                                                <td>$499.99</td>
                                                <td>Unlimited</td>
                                                <td>Unlimited</td>
                                                <td>Unlimited</td>
                                                <td>Unlimited</td>
                                                <td>5 Jan 2024</td>
                                                <td><span
                                                        class="badge bg-success-light d-inline-flex align-items-center"><i
                                                            class="fe fe-check me-1"></i>Active</span></td>
                                                <td class="d-flex align-items-center">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class=" btn-action-icon"
                                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                class="fas fa-ellipsis-v"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul class="dropdown-ul">
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#edit_package"><i
                                                                            class="fe fe-edit me-2"></i>Edit</a>
                                                                </li>
                                                                <li class="delete-alt">
                                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#delete_modal"><i
                                                                            class="fe fe-trash-2 me-2"></i>Delete</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
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
    <!-- /Page Wrapper -->
@endsection
