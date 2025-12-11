<?php $page = 'domain'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            @component('components.page-header')
                @slot('title')
                    Domain List
                @endslot
            @endcomponent
            <!-- /Page Header -->

            <!-- Search Filter -->
            @component('components.search-filter')
            @endcomponent
            <!-- /Search Filter -->

            <!-- Table -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-table">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-stripped table-hover datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="no-sort ">#</th>
                                            <th>Name</th>
                                            <th>Domain URL</th>
                                            <th>Plan</th>
                                            <th>Registered On</th>
                                            <th>Status</th>
                                            <th class="no-sort">Action</th>
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
                                            <td>hru.example.com</td>
                                            <td>Advanced <span class="plane-type">(Monthly)</span></td>
                                            <td>19 Jan 2024</td>
                                            <td><span class="badge bg-success-light d-inline-flex align-items-center"><i
                                                        class="fe fe-check me-1"></i>Approved</span></td>
                                            <td class="d-flex align-items-center">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown"
                                                        aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <ul class="dropdown-ul">
                                                            <li>
                                                                <a class="dropdown-item" href="javascript:void(0);"
                                                                    data-bs-toggle="modal" data-bs-target="#view_doamin"><i
                                                                        class="fe fe-eye me-2"></i>Domain Detail</a>
                                                            </li>
                                                            <li class="delete-alt">
                                                                <div>
                                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#delete_modal"><i
                                                                            class="fe fe-trash-2 me-2"></i>Delete</a>
                                                                </div>
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
                                            <td>sk.example.com</td>
                                            <td>Basic <span class="plane-type"> (Yearly)</span></td>
                                            <td>19 Jan 2024</td>
                                            <td><span class="badge bg-orange-light d-inline-flex align-items-center"><i
                                                        class="fe fe-clock me-1"></i>Pending</span></td>
                                            <td class="d-flex align-items-center">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown"
                                                        aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <ul class="dropdown-ul">
                                                            <li>
                                                                <a class="dropdown-item" href="javascript:void(0);"
                                                                    data-bs-toggle="modal" data-bs-target="#view_doamin"><i
                                                                        class="fe fe-eye me-2"></i>Domain Detail</a>
                                                            </li>
                                                            <li class="delete-alt">
                                                                <div>
                                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#delete_modal"><i
                                                                            class="fe fe-trash-2 me-2"></i>Delete</a>
                                                                </div>
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
                                            <td>kerluke.example.com</td>
                                            <td>Basic <span class="plane-type"> (Yearly)</span></td>
                                            <td>19 Jan 2024</td>
                                            <td><span class="badge bg-danger-light d-inline-flex align-items-center"><i
                                                        class="fe fe-x me-1"></i>Rejected</span></td>
                                            <td class="d-flex align-items-center">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown"
                                                        aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <ul class="dropdown-ul">
                                                            <li>
                                                                <a class="dropdown-item" href="javascript:void(0);"
                                                                    data-bs-toggle="modal" data-bs-target="#view_doamin"><i
                                                                        class="fe fe-eye me-2"></i>Domain Detail</a>
                                                            </li>
                                                            <li class="delete-alt">
                                                                <div>
                                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#delete_modal"><i
                                                                            class="fe fe-trash-2 me-2"></i>Delete</a>
                                                                </div>
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
                                            <td>schowalter.example.com</td>
                                            <td>Advanced <span class="plane-type">(Monthly)</span></td>
                                            <td>19 Jan 2024</td>
                                            <td><span class="badge bg-orange-light d-inline-flex align-items-center"><i
                                                        class="fe fe-clock me-1"></i>Pending</span></td>
                                            <td class="d-flex align-items-center">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown"
                                                        aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <ul class="dropdown-ul">
                                                            <li>
                                                                <a class="dropdown-item" href="javascript:void(0);"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#view_doamin"><i
                                                                        class="fe fe-eye me-2"></i>Domain Detail</a>
                                                            </li>
                                                            <li class="delete-alt">
                                                                <div>
                                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#delete_modal"><i
                                                                            class="fe fe-trash-2 me-2"></i>Delete</a>
                                                                </div>
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
                                            <td>accentric.example.com</td>
                                            <td>Basic <span class="plane-type"> (Yearly)</span></td>
                                            <td>19 Jan 2024</td>
                                            <td><span class="badge bg-orange-light d-inline-flex align-items-center"><i
                                                        class="fe fe-clock me-1"></i>Pending</span></td>
                                            <td class="d-flex align-items-center">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown"
                                                        aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <ul class="dropdown-ul">
                                                            <li>
                                                                <a class="dropdown-item" href="javascript:void(0);"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#view_doamin"><i
                                                                        class="fe fe-eye me-2"></i>Domain Detail</a>
                                                            </li>
                                                            <li class="delete-alt">
                                                                <div>
                                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#delete_modal"><i
                                                                            class="fe fe-trash-2 me-2"></i>Delete</a>
                                                                </div>
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
                                            <td>dexter.example.com</td>
                                            <td>Advanced <span class="plane-type">(Monthly)</span></td>
                                            <td>19 Jan 2024</td>
                                            <td><span class="badge bg-orange-light d-inline-flex align-items-center"><i
                                                        class="fe fe-clock me-1"></i>Pending</span></td>
                                            <td class="d-flex align-items-center">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown"
                                                        aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <ul class="dropdown-ul">
                                                            <li>
                                                                <a class="dropdown-item" href="javascript:void(0);"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#view_doamin"><i
                                                                        class="fe fe-eye me-2"></i>Domain Detail</a>
                                                            </li>
                                                            <li class="delete-alt">
                                                                <div>
                                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#delete_modal"><i
                                                                            class="fe fe-trash-2 me-2"></i>Delete</a>
                                                                </div>
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
                                            <td>emporis.example.com</td>
                                            <td>Basic <span class="plane-type"> (Yearly)</span></td>
                                            <td>19 Jan 2024</td>
                                            <td><span class="badge bg-orange-light d-inline-flex align-items-center"><i
                                                        class="fe fe-clock me-1"></i>Pending</span></td>
                                            <td class="d-flex align-items-center">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown"
                                                        aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <ul class="dropdown-ul">
                                                            <li>
                                                                <a class="dropdown-item" href="javascript:void(0);"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#view_doamin"><i
                                                                        class="fe fe-eye me-2"></i>Domain Detail</a>
                                                            </li>
                                                            <li class="delete-alt">
                                                                <div>
                                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#delete_modal"><i
                                                                            class="fe fe-trash-2 me-2"></i>Delete</a>
                                                                </div>
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
                                            <td>beacon.example.com</td>
                                            <td>Advanced <span class="plane-type">(Monthly)</span></td>
                                            <td>19 Jan 2024</td>
                                            <td><span class="badge bg-orange-light d-inline-flex align-items-center"><i
                                                        class="fe fe-clock me-1"></i>Pending</span></td>
                                            <td class="d-flex align-items-center">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown"
                                                        aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <ul class="dropdown-ul">
                                                            <li>
                                                                <a class="dropdown-item" href="javascript:void(0);"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#view_doamin"><i
                                                                        class="fe fe-eye me-2"></i>Domain Detail</a>
                                                            </li>
                                                            <li class="delete-alt">
                                                                <div>
                                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#delete_modal"><i
                                                                            class="fe fe-trash-2 me-2"></i>Delete</a>
                                                                </div>
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
                                            <td>global.example.com</td>
                                            <td>Basic <span class="plane-type"> (Yearly)</span></td>
                                            <td>19 Jan 2024</td>
                                            <td><span class="badge bg-orange-light d-inline-flex align-items-center"><i
                                                        class="fe fe-clock me-1"></i>Pending</span></td>
                                            <td class="d-flex align-items-center">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown"
                                                        aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <ul class="dropdown-ul">
                                                            <li>
                                                                <a class="dropdown-item" href="javascript:void(0);"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#view_doamin"><i
                                                                        class="fe fe-eye me-2"></i>Domain Detail</a>
                                                            </li>
                                                            <li class="delete-alt">
                                                                <div>
                                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#delete_modal"><i
                                                                            class="fe fe-trash-2 me-2"></i>Delete</a>
                                                                </div>
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
                                            <td>high.example.com</td>
                                            <td>Basic <span class="plane-type"> (Yearly)</span></td>
                                            <td>19 Jan 2024</td>
                                            <td><span class="badge bg-orange-light d-inline-flex align-items-center"><i
                                                        class="fe fe-clock me-1"></i>Pending</span></td>
                                            <td class="d-flex align-items-center">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown"
                                                        aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <ul class="dropdown-ul">
                                                            <li>
                                                                <a class="dropdown-item" href="javascript:void(0);"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#view_doamin"><i
                                                                        class="fe fe-eye me-2"></i>Domain Detail</a>
                                                            </li>
                                                            <li class="delete-alt">
                                                                <div>
                                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#delete_modal"><i
                                                                            class="fe fe-trash-2 me-2"></i>Delete</a>
                                                                </div>
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
            <!-- /Table -->

        </div>
    </div>
    <!-- /Page Wrapper -->
@endsection
