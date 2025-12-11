<?php $page = 'subscription'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="subscription-plane-head">
                <ul>
                    <li>
                        <a href="{{ url('packages') }}">Subscription Plans</a>
                    </li>
                    <li>
                        <a href="{{ url('subscription') }}" class="active">Subscribers List</a>
                    </li>
                </ul>
            </div>
            <!-- Page Header -->
            @component('components.page-header')
                @slot('title')
                    Subscriber List
                @endslot
            @endcomponent
            <!-- /Page Header -->
            <div class="super-admin-list-head">
                <div class="row">
                    <div class="col-xl-3 col-md-6 d-flex">
                        <div class="card w-100">
                            <div class="card-body">
                                <div class="grid-info-item subscription-list total-transaction">
                                    <div class="grid-head-icon">
                                        <i class="fe fe-shield"></i>
                                    </div>
                                    <div class="grid-info">
                                        <span>Total Transaction</span>
                                        <h4>$6,565,60</h4>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 d-flex">
                        <div class="card w-100">
                            <div class="card-body">
                                <div class="grid-info-item subscription-list total-subscriber">
                                    <div class="grid-head-icon">
                                        <i class="fe fe-users"></i>
                                    </div>
                                    <div class="grid-info">
                                        <span>Total Subscribers</span>
                                        <h4>945</h4>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 d-flex">
                        <div class="card w-100">
                            <div class="card-body">
                                <div class="grid-info-item subscription-list active-subscriber">
                                    <div class="grid-head-icon">
                                        <i class="fe fe-user-check"></i>
                                    </div>
                                    <div class="grid-info">
                                        <span>Active Subscriber</span>
                                        <h4>944</h4>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 d-flex">
                        <div class="card w-100">
                            <div class="card-body">
                                <div class="grid-info-item subscription-list expired-subscriber">
                                    <div class="grid-head-icon">
                                        <i class="fe fe-user-x"></i>
                                    </div>
                                    <div class="grid-info">
                                        <span>Expired</span>
                                        <h4>1</h4>
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
                            <div class="table-responsive">
                                <div class="companies-table">
                                    <table class="table table-center table-hover datatable">
                                        <thead class="thead-light">
                                            <tr>
                                                <th Class="no-sort">#</th>
                                                <th>Subscriber</th>
                                                <th>Plan</th>
                                                <th>Billing Cycle</th>
                                                <th>Payment Gateway</th>
                                                <th>Amount</th>
                                                <th>Registered On</th>
                                                <th>Expiring On</th>
                                                <th>Status</th>
                                                <th>Invoice </th>
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
                                                <td>Advanced (Monthly)</td>
                                                <td>30 Days</td>
                                                <td>Paypal</td>
                                                <td>$19.99</td>
                                                <td>15 Jan 2024</td>
                                                <td>15 Feb 2024</td>
                                                <td><span class="badge bg-success-light d-inline-flex align-items-center"><i
                                                            class="fe fe-check me-1"></i>Paid</span></td>
                                                <td><a href="{{ url('invoice-subscription') }}" class="invoice-detail"><i
                                                            class="fe fe-file-text"></i></a></td>
                                                <td class="d-flex align-items-center">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class=" btn-action-icon "
                                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                class="fas fa-ellipsis-v"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul class="dropdown-ul">
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);"><i
                                                                            class="fe fe-download me-2"></i>Download</a>
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
                                                <td>Basic (Monthly)</td>
                                                <td>30 Days</td>
                                                <td>Credit Card</td>
                                                <td>$499.99</td>
                                                <td>02 Feb 2024 </td>
                                                <td>02 Mar 2024</td>
                                                <td><span class="badge bg-success-light d-inline-flex align-items-center"><i
                                                            class="fe fe-check me-1"></i>Paid</span></td>
                                                <td><a href="{{ url('invoice-subscription') }}" class="invoice-detail"><i
                                                            class="fe fe-file-text"></i></a></td>
                                                <td class="d-flex align-items-center">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class=" btn-action-icon "
                                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                class="fas fa-ellipsis-v"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul class="dropdown-ul">
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);"><i
                                                                            class="fe fe-download me-2"></i>Download</a>
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
                                                <td>Basic (Monthly)</td>
                                                <td>30 Days</td>
                                                <td>Paypal</td>
                                                <td>$19.99</td>
                                                <td>18 Mar 2024 </td>
                                                <td>18 Mar 2024</td>
                                                <td><span
                                                        class="badge bg-success-light d-inline-flex align-items-center"><i
                                                            class="fe fe-check me-1"></i>Paid</span></td>
                                                <td><a href="{{ url('invoice-subscription') }}" class="invoice-detail"><i
                                                            class="fe fe-file-text"></i></a></td>
                                                <td class="d-flex align-items-center">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class=" btn-action-icon "
                                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                class="fas fa-ellipsis-v"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul class="dropdown-ul">
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);"><i
                                                                            class="fe fe-download me-2"></i>Download</a>
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
                                                <td>Premium (Yearly)</td>
                                                <td>30 Days</td>
                                                <td>Credit Card</td>
                                                <td>$6549.99</td>
                                                <td>20 Apr 2024 </td>
                                                <td>20 Apr 2024</td>
                                                <td><span
                                                        class="badge bg-success-light d-inline-flex align-items-center"><i
                                                            class="fe fe-check me-1"></i>Paid</span></td>
                                                <td><a href="{{ url('invoice-subscription') }}" class="invoice-detail"><i
                                                            class="fe fe-file-text"></i></a></td>
                                                <td class="d-flex align-items-center">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class=" btn-action-icon "
                                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                class="fas fa-ellipsis-v"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul class="dropdown-ul">
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);"><i
                                                                            class="fe fe-download me-2"></i>Download</a>
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
                                                <td>Advanced (Monthly)</td>
                                                <td>30 Days</td>
                                                <td>Debit Card</td>
                                                <td>$499.99</td>
                                                <td>12 May 2024 </td>
                                                <td>12 May 2024</td>
                                                <td><span
                                                        class="badge bg-success-light d-inline-flex align-items-center"><i
                                                            class="fe fe-check me-1"></i>Paid</span></td>
                                                <td><a href="{{ url('invoice-subscription') }}" class="invoice-detail"><i
                                                            class="fe fe-file-text"></i></a></td>
                                                <td class="d-flex align-items-center">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class=" btn-action-icon "
                                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                class="fas fa-ellipsis-v"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul class="dropdown-ul">
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);"><i
                                                                            class="fe fe-download me-2"></i>Download</a>
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
                                                <td>Enterprise (Monthly)</td>
                                                <td>30 Days</td>
                                                <td>Paypal</td>
                                                <td>$499.99</td>
                                                <td>02 Feb 2024 </td>
                                                <td><span class="text-danger">Expired</span></td>
                                                <td><span class="badge bg-danger-light d-inline-flex align-items-center"><i
                                                            class="fe fe-x me-1"></i>Unpaid</span></td>
                                                <td><a href="{{ url('invoice-subscription') }}" class="invoice-detail"><i
                                                            class="fe fe-file-text"></i></a></td>
                                                <td class="d-flex align-items-center">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class=" btn-action-icon "
                                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                class="fas fa-ellipsis-v"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul class="dropdown-ul">
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);"><i
                                                                            class="fe fe-download me-2"></i>Download</a>
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
                                                <td>Basic (Monthly)</td>
                                                <td>30 Days</td>
                                                <td>Credit Card</td>
                                                <td>$499.99</td>
                                                <td>02 Feb 2024 </td>
                                                <td>02 Mar 2024</td>
                                                <td><span
                                                        class="badge bg-success-light d-inline-flex align-items-center"><i
                                                            class="fe fe-check me-1"></i>Paid</span></td>
                                                <td><a href="{{ url('invoice-subscription') }}" class="invoice-detail"><i
                                                            class="fe fe-file-text"></i></a></td>
                                                <td class="d-flex align-items-center">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class=" btn-action-icon "
                                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                class="fas fa-ellipsis-v"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul class="dropdown-ul">
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);"><i
                                                                            class="fe fe-download me-2"></i>Download</a>
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
                                                <td>Basic (Monthly)</td>
                                                <td>30 Days</td>
                                                <td>Credit Card</td>
                                                <td>$499.99</td>
                                                <td>02 Feb 2024 </td>
                                                <td>02 Mar 2024</td>
                                                <td><span
                                                        class="badge bg-success-light d-inline-flex align-items-center"><i
                                                            class="fe fe-check me-1"></i>Paid</span></td>
                                                <td><a href="{{ url('invoice-subscription') }}" class="invoice-detail"><i
                                                            class="fe fe-file-text"></i></a></td>
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
                                                                            class="fe fe-download me-2"></i>Download</a>
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
                                                <td>Basic (Monthly)</td>
                                                <td>30 Days</td>
                                                <td>Credit Card</td>
                                                <td>$499.99</td>
                                                <td>02 Feb 2024 </td>
                                                <td>02 Mar 2024</td>
                                                <td><span
                                                        class="badge bg-success-light d-inline-flex align-items-center"><i
                                                            class="fe fe-check me-1"></i>Paid</span></td>
                                                <td><a href="{{ url('invoice-subscription') }}" class="invoice-detail"><i
                                                            class="fe fe-file-text"></i></a></td>
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
                                                                            class="fe fe-download me-2"></i>Download</a>
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
                                                <td>Basic (Monthly)</td>
                                                <td>30 Days</td>
                                                <td>Credit Card</td>
                                                <td>$499.99</td>
                                                <td>02 Feb 2024 </td>
                                                <td>02 Mar 2024</td>
                                                <td><span
                                                        class="badge bg-success-light d-inline-flex align-items-center"><i
                                                            class="fe fe-check me-1"></i>Paid</span></td>
                                                <td><a href="{{ url('invoice-subscription') }}" class="invoice-detail"><i
                                                            class="fe fe-file-text"></i></a></td>
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
                                                                            class="fe fe-download me-2"></i>Download</a>
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
