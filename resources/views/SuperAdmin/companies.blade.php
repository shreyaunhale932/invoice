<?php $page = 'companies'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            @component('components.page-header')
                @slot('title')
                    Companies
                @endslot
            @endcomponent
            <!-- /Page Header -->
            <div class="super-admin-list-head">
                <div class="row">
                    <div class="col-xl-3 col-md-6 d-flex">
                        <div class="card w-100">
                            <div class="card-body">
                                <div class="grid-info-item total-items">
                                    <div class="grid-info">
                                        <span>Total Companies</span>
                                        <h4>987</h4>
                                    </div>
                                    <div class="grid-head-icon">
                                        <i class="fe fe-life-buoy"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 d-flex">
                        <div class="card w-100">
                            <div class="card-body">
                                <div class="grid-info-item active-items">
                                    <div class="grid-info">
                                        <span>Active Companies</span>
                                        <h4>154</h4>
                                    </div>
                                    <div class="grid-head-icon">
                                        <i class="fe fe-check-square"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 d-flex">
                        <div class="card w-100">
                            <div class="card-body">
                                <div class="grid-info-item inactive-items">
                                    <div class="grid-info">
                                        <span>Inactive Company</span>
                                        <h4>2</h4>
                                    </div>
                                    <div class="grid-head-icon">
                                        <i class="fe fe-x-circle"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 d-flex">
                        <div class="card w-100">
                            <div class="card-body">
                                <div class="grid-info-item location-info">
                                    <div class="grid-info">
                                        <span>Company Locations</span>
                                        <h4>200</h4>
                                    </div>
                                    <div class="grid-head-icon">
                                        <i class="fe fe-map-pin"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search Filter -->
            @component('components.search-filter')
            @endcomponent
            <!-- /Search Filter -->

            <div class="row">
                <div class="col-sm-12">
                    <div class="card-table">
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="companies-table">
                                    <table class="table table-center table-hover datatable">
                                        <thead class="thead-light">
                                            <tr>
                                                <th Class="no-sort">#</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Account URL</th>
                                                <th>Plan</th>
                                                <th>Change Plan</th>
                                                <th>Created Date</th>
                                                <th>Status</th>
                                                <th Class="no-sort">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="{{ url('profile') }}"
                                                            class="company-avatar avatar-md me-2 companies company-icon">
                                                            <img class="avatar-img rounded-circle company"
                                                                src="{{ URL::asset('/public/assets/img/companies/company-01.svg') }}"
                                                                alt="Company Image"></a>
                                                        <a href="#">Hermann Groups</a>
                                                    </h2>
                                                </td>
                                                <td>info@example.com</td>
                                                <td>hru.example.com</td>
                                                <td>Advanced (Monthly)</td>
                                                <td><a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#change_pane"><span
                                                            class="badge bg-purple">Change</span></a></td>
                                                <td>19 Jan 2024</td>
                                                <td><span class="badge bg-success-light d-inline-flex align-items-center"><i
                                                            class="fe fe-check me-1"></i>Active</span></td>
                                                <td class="d-flex align-items-center">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class=" btn-action-icon "
                                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                class="fas fa-ellipsis-v"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul class="dropdown-ul">
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#view_companies"><i
                                                                            class="far fa-eye me-2"></i>View Company</a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#edit_companies"><i
                                                                            class="fe fe-edit me-2"></i>Edit</a>
                                                                </li>
                                                                <li class="delete-alt">
                                                                    <div>
                                                                        <a class="dropdown-item" href="javascript:void(0);"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#delete_modal"><i
                                                                                class="fe fe-trash-2 me-2"></i>Delete</a>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);"><i
                                                                            class="fe fe-user-x me-2"></i>Cancel
                                                                        Plan</a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);"><i
                                                                            class="fe fe-shuffle me-2"></i>Subscription
                                                                        Log</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="{{ url('profile') }}"
                                                            class="company-avatar avatar-md me-2 companies company-icon">
                                                            <img class="avatar-img rounded-circle company"
                                                                src="{{ URL::asset('/public/assets/img/companies/company-02.svg') }}"
                                                                alt="Company Image"></a>
                                                        <a href="#">Skiles LLC</a>
                                                    </h2>
                                                </td>
                                                <td>sales@example.com</td>
                                                <td>sk.example.com</td>
                                                <td>Basic (Yearly)</td>
                                                <td><a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#change_pane"><span
                                                            class="badge bg-purple">Change</span></a></td>
                                                <td>15 Jan 2024</td>
                                                <td><span class="badge bg-success-light d-inline-flex align-items-center"><i
                                                            class="fe fe-check me-1"></i>Active</span></td>
                                                <td class="d-flex align-items-center">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class=" btn-action-icon "
                                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                class="fas fa-ellipsis-v"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul class="dropdown-ul">
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#view_companies"><i
                                                                            class="far fa-eye me-2"></i>View Company</a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#edit_companies"><i
                                                                            class="fe fe-edit me-2"></i>Edit</a>
                                                                </li>
                                                                <li class="delete-alt">
                                                                    <div>
                                                                        <a class="dropdown-item"
                                                                            href="javascript:void(0);"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#delete_modal"><i
                                                                                class="fe fe-trash-2 me-2"></i>Delete</a>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);"><i
                                                                            class="fe fe-user-x me-2"></i>Cancel
                                                                        Plan</a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);"><i
                                                                            class="fe fe-shuffle me-2"></i>Subscription
                                                                        Log</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="{{ url('profile') }}"
                                                            class="company-avatar avatar-md me-2 companies company-icon">
                                                            <img class="avatar-img rounded-circle company"
                                                                src="{{ URL::asset('/public/assets/img/companies/company-03.svg') }}"
                                                                alt="Company Image"></a>
                                                        <a href="#">Kerluke Group</a>
                                                    </h2>
                                                </td>
                                                <td>info@example.com</td>
                                                <td>kerluke.example.com</td>
                                                <td>Enterprise (Monthly)</td>
                                                <td><a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#change_pane"><span
                                                            class="badge bg-purple">Change</span></a></td>
                                                <td>04 Jan 2024</td>
                                                <td><span
                                                        class="badge bg-success-light d-inline-flex align-items-center"><i
                                                            class="fe fe-check me-1"></i>Active</span></td>
                                                <td class="d-flex align-items-center">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class=" btn-action-icon "
                                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                class="fas fa-ellipsis-v"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul class="dropdown-ul">
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#view_companies"><i
                                                                            class="far fa-eye me-2"></i>View Company</a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#edit_companies"><i
                                                                            class="fe fe-edit me-2"></i>Edit</a>
                                                                </li>
                                                                <li class="delete-alt">
                                                                    <div>
                                                                        <a class="dropdown-item"
                                                                            href="javascript:void(0);"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#delete_modal"><i
                                                                                class="fe fe-trash-2 me-2"></i>Delete</a>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);"><i
                                                                            class="fe fe-user-x me-2"></i>Cancel
                                                                        Plan</a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);"><i
                                                                            class="fe fe-shuffle me-2"></i>Subscription
                                                                        Log</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="{{ url('profile') }}"
                                                            class="company-avatar avatar-md me-2 companies company-icon">
                                                            <img class="avatar-img rounded-circle company"
                                                                src="{{ URL::asset('/public/assets/img/companies/company-04.svg') }}"
                                                                alt="Company Image"></a>
                                                        <a href="#">Schowalter Group</a>
                                                    </h2>
                                                </td>
                                                <td>user233@example.com</td>
                                                <td>schowalter.example.com</td>
                                                <td>Advanced (Monthly)</td>
                                                <td><a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#change_pane"><span
                                                            class="badge bg-purple">Change</span></a></td>
                                                <td>28 Feb 2024</td>
                                                <td><span
                                                        class="badge bg-success-light d-inline-flex align-items-center"><i
                                                            class="fe fe-check me-1"></i>Active</span></td>
                                                <td class="d-flex align-items-center">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class=" btn-action-icon "
                                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                class="fas fa-ellipsis-v"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul class="dropdown-ul">
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#view_companies"><i
                                                                            class="far fa-eye me-2"></i>View Company</a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#edit_companies"><i
                                                                            class="fe fe-edit me-2"></i>Edit</a>
                                                                </li>
                                                                <li class="delete-alt">
                                                                    <div>
                                                                        <a class="dropdown-item"
                                                                            href="javascript:void(0);"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#delete_modal"><i
                                                                                class="fe fe-trash-2 me-2"></i>Delete</a>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);"><i
                                                                            class="fe fe-user-x me-2"></i>Cancel
                                                                        Plan</a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);"><i
                                                                            class="fe fe-shuffle me-2"></i>Subscription
                                                                        Log</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="{{ url('profile') }}"
                                                            class="company-avatar avatar-md me-2 companies company-icon">
                                                            <img class="avatar-img rounded-circle company"
                                                                src="{{ URL::asset('/public/assets/img/companies/company-05.svg') }}"
                                                                alt="Company Image"></a>
                                                        <a href="#">Accentric Global</a>
                                                    </h2>
                                                </td>
                                                <td>accounts@example.com</td>
                                                <td>accentric.example.com</td>
                                                <td>Advanced (Monthly)</td>
                                                <td><a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#change_pane"><span
                                                            class="badge bg-purple">Change</span></a></td>
                                                <td>20 Feb 2024</td>
                                                <td><span
                                                        class="badge bg-success-light d-inline-flex align-items-center"><i
                                                            class="fe fe-check me-1"></i>Active</span></td>
                                                <td class="d-flex align-items-center">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class=" btn-action-icon "
                                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                class="fas fa-ellipsis-v"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul class="dropdown-ul">
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#view_companies"><i
                                                                            class="far fa-eye me-2"></i>View Company</a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#edit_companies"><i
                                                                            class="fe fe-edit me-2"></i>Edit</a>
                                                                </li>
                                                                <li class="delete-alt">
                                                                    <div>
                                                                        <a class="dropdown-item"
                                                                            href="javascript:void(0);"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#delete_modal"><i
                                                                                class="fe fe-trash-2 me-2"></i>Delete</a>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);"><i
                                                                            class="fe fe-user-x me-2"></i>Cancel
                                                                        Plan</a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);"><i
                                                                            class="fe fe-shuffle me-2"></i>Subscription
                                                                        Log</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>6</td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="{{ url('profile') }}"
                                                            class="company-avatar avatar-md me-2 companies company-icon">
                                                            <img class="avatar-img rounded-circle company"
                                                                src="{{ URL::asset('/public/assets/img/companies/company-06.svg') }}"
                                                                alt="Company Image"></a>
                                                        <a href="#">Dexter Matrix</a>
                                                    </h2>
                                                </td>
                                                <td>sales@example.com</td>
                                                <td>dexter.example.com</td>
                                                <td>Premium (Yearly)</td>
                                                <td><a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#change_pane"><span
                                                            class="badge bg-purple">Change</span></a></td>
                                                <td>15 Feb 2024</td>
                                                <td><span
                                                        class="badge bg-success-light d-inline-flex align-items-center"><i
                                                            class="fe fe-check me-1"></i>Active</span></td>
                                                <td class="d-flex align-items-center">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class=" btn-action-icon "
                                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                class="fas fa-ellipsis-v"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul class="dropdown-ul">
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#view_companies"><i
                                                                            class="far fa-eye me-2"></i>View Company</a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#edit_companies"><i
                                                                            class="fe fe-edit me-2"></i>Edit</a>
                                                                </li>
                                                                <li class="delete-alt">
                                                                    <div>
                                                                        <a class="dropdown-item"
                                                                            href="javascript:void(0);"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#delete_modal"><i
                                                                                class="fe fe-trash-2 me-2"></i>Delete</a>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);"><i
                                                                            class="fe fe-user-x me-2"></i>Cancel
                                                                        Plan</a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);"><i
                                                                            class="fe fe-shuffle me-2"></i>Subscription
                                                                        Log</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>7</td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="{{ url('profile') }}"
                                                            class="company-avatar avatar-md me-2 companies company-icon">
                                                            <img class="avatar-img rounded-circle company"
                                                                src="{{ URL::asset('/public/assets/img/companies/company-07.svg') }}"
                                                                alt="Company Image"></a>
                                                        <a href="#">Emporis Technologies</a>
                                                    </h2>
                                                </td>
                                                <td>info@example.com</td>
                                                <td>emporis.example.com</td>
                                                <td>Free (Monthly)</td>
                                                <td><a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#change_pane"><span
                                                            class="badge bg-purple">Change</span></a></td>
                                                <td>15 Feb 2024</td>
                                                <td><span
                                                        class="badge bg-success-light d-inline-flex align-items-center"><i
                                                            class="fe fe-check me-1"></i>Active</span></td>
                                                <td class="d-flex align-items-center">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class=" btn-action-icon "
                                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                class="fas fa-ellipsis-v"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul class="dropdown-ul">
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#view_companies"><i
                                                                            class="far fa-eye me-2"></i>View Company</a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#edit_companies"><i
                                                                            class="fe fe-edit me-2"></i>Edit</a>
                                                                </li>
                                                                <li class="delete-alt">
                                                                    <div>
                                                                        <a class="dropdown-item"
                                                                            href="javascript:void(0);"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#delete_modal"><i
                                                                                class="fe fe-trash-2 me-2"></i>Delete</a>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);"><i
                                                                            class="fe fe-user-x me-2"></i>Cancel
                                                                        Plan</a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);"><i
                                                                            class="fe fe-shuffle me-2"></i>Subscription
                                                                        Log</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>8</td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="{{ url('profile') }}"
                                                            class="company-avatar avatar-md me-2 companies company-icon">
                                                            <img class="avatar-img rounded-circle company"
                                                                src="{{ URL::asset('/public/assets/img/companies/company-08.svg') }}"
                                                                alt="Company Image"></a>
                                                        <a href="#">Beacon Softwares</a>
                                                    </h2>
                                                </td>
                                                <td>business@example.com</td>
                                                <td>beacon.example.com</td>
                                                <td>Enterprise (Monthly)</td>
                                                <td><a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#change_pane"><span
                                                            class="badge bg-purple">Change</span></a></td>
                                                <td>15 Feb 2024</td>
                                                <td><span
                                                        class="badge bg-success-light d-inline-flex align-items-center"><i
                                                            class="fe fe-check me-1"></i>Active</span></td>
                                                <td class="d-flex align-items-center">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class=" btn-action-icon "
                                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                class="fas fa-ellipsis-v"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul class="dropdown-ul">
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#view_companies"><i
                                                                            class="far fa-eye me-2"></i>View Company</a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#edit_companies"><i
                                                                            class="fe fe-edit me-2"></i>Edit</a>
                                                                </li>
                                                                <li class="delete-alt">
                                                                    <div>
                                                                        <a class="dropdown-item"
                                                                            href="javascript:void(0);"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#delete_modal"><i
                                                                                class="fe fe-trash-2 me-2"></i>Delete</a>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);"><i
                                                                            class="fe fe-user-x me-2"></i>Cancel
                                                                        Plan</a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);"><i
                                                                            class="fe fe-shuffle me-2"></i>Subscription
                                                                        Log</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>9</td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="{{ url('profile') }}"
                                                            class="company-avatar avatar-md me-2 companies company-icon">
                                                            <img class="avatar-img rounded-circle company"
                                                                src="{{ URL::asset('/public/assets/img/companies/company-09.svg') }}"
                                                                alt="Company Image"></a>
                                                        <a href="#">Global tech</a>
                                                    </h2>
                                                </td>
                                                <td>user234@example.com</td>
                                                <td>global.example.com</td>
                                                <td>Free (Monthly)</td>
                                                <td><a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#change_pane"><span
                                                            class="badge bg-purple">Change</span></a></td>
                                                <td>15 Feb 2024</td>
                                                <td><span
                                                        class="badge bg-success-light d-inline-flex align-items-center"><i
                                                            class="fe fe-check me-1"></i>Active</span></td>
                                                <td class="d-flex align-items-center">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class=" btn-action-icon "
                                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                class="fas fa-ellipsis-v"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul class="dropdown-ul">
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#view_companies"><i
                                                                            class="far fa-eye me-2"></i>View Company</a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#edit_companies"><i
                                                                            class="fe fe-edit me-2"></i>Edit</a>
                                                                </li>
                                                                <li class="delete-alt">
                                                                    <div>
                                                                        <a class="dropdown-item"
                                                                            href="javascript:void(0);"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#delete_modal"><i
                                                                                class="fe fe-trash-2 me-2"></i>Delete</a>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);"><i
                                                                            class="fe fe-user-x me-2"></i>Cancel
                                                                        Plan</a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);"><i
                                                                            class="fe fe-shuffle me-2"></i>Subscription
                                                                        Log</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>10</td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="{{ url('profile') }}"
                                                            class="company-avatar avatar-md me-2 companies company-icon">
                                                            <img class="avatar-img rounded-circle company"
                                                                src="{{ URL::asset('/public/assets/img/companies/company-10.svg') }}"
                                                                alt="Company Image"></a>
                                                        <a href="#">High Tech Lead</a>
                                                    </h2>
                                                </td>
                                                <td>accounts@example.com</td>
                                                <td>high.example.com</td>
                                                <td>Enterprise (Monthly)</td>
                                                <td><a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#change_pane"><span
                                                            class="badge bg-purple">Change</span></a></td>
                                                <td>15 Feb 2024</td>
                                                <td><span class="badge bg-danger-light d-inline-flex align-items-center"><i
                                                            class="fe fe-x me-1"></i>Inactive</span></td>
                                                <td class="d-flex align-items-center">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class=" btn-action-icon "
                                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                class="fas fa-ellipsis-v"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul class="dropdown-ul">
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#view_companies"><i
                                                                            class="far fa-eye me-2"></i>View Company</a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#edit_companies"><i
                                                                            class="fe fe-edit me-2"></i>Edit</a>
                                                                </li>
                                                                <li class="delete-alt">
                                                                    <div>
                                                                        <a class="dropdown-item"
                                                                            href="javascript:void(0);"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#delete_modal"><i
                                                                                class="fe fe-trash-2 me-2"></i>Delete</a>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);"><i
                                                                            class="fe fe-user-x me-2"></i>Cancel
                                                                        Plan</a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);"><i
                                                                            class="fe fe-shuffle me-2"></i>Subscription
                                                                        Log</a>
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
