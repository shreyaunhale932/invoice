<?php $page = 'dashboard'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid pb-0">

            <!-- Page Header -->
            <div class="page-header">
                <div class="content-page-header">
                    <h5>Dashboard</h5>
                </div>
            </div>
            <!-- /Page Header -->
            <div class="super-admin-dashboard">
                <div class="row">
                    <div class="col-xl-5 d-flex">
                        <div class="dash-user-card w-100">
                            <h4><i class="fe fe-sun"></i>Good Morning, John</h4>
                            <p>14 New Companies Subscribed Today</p>
                            <div class="dash-btns">
                                <a href="{{ url('companies') }}" class="btn view-company-btn">View Companies</a>
                                <a href="{{ url('packages') }}" class="btn view-package-btn">All Packages</a>
                            </div>
                            <div class="dash-img">
                                <img src="{{ URL::asset('/public/assets/img/dashboard-card-img.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-7 d-flex p-0">
                        <div class="row dash-company-row w-100 m-0">
                            <div class="col-lg-3 col-sm-6 d-flex">
                                <div class="company-detail-card w-100">
                                    <div class="company-icon">
                                        <img src="{{ URL::asset('/public/assets/img/icons/dash-card-icon-01.svg') }}"
                                            alt="">
                                    </div>
                                    <div class="dash-comapny-info">
                                        <h6>Total Companies</h6>
                                        <h5>987</h5>
                                        <p><span>14% <i class="fe fe-chevrons-up"></i></span>Last month</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 d-flex">
                                <div class="company-detail-card bg-info-light w-100">
                                    <div class="company-icon">
                                        <img src="{{ URL::asset('/public/assets/img/icons/dash-card-icon-02.svg') }}"
                                            alt="">
                                    </div>
                                    <div class="dash-comapny-info">
                                        <h6>Active Companies</h6>
                                        <h5>154</h5>
                                        <p><span>1% <i class="fe fe-chevrons-up"></i></span>Last month</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 d-flex">
                                <div class="company-detail-card bg-pink-light w-100">
                                    <div class="company-icon">
                                        <img src="{{ URL::asset('/public/assets/img/icons/dash-card-icon-03.svg') }}"
                                            alt="">
                                    </div>
                                    <div class="dash-comapny-info">
                                        <h6>Inactive Company</h6>
                                        <h5>2</h5>
                                        <p><span>2% <i class="fe fe-chevrons-up"></i></span>Last month</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 d-flex">
                                <div class="company-detail-card bg-success-light w-100">
                                    <div class="company-icon">
                                        <img src="{{ URL::asset('/public/assets/img/icons/dash-card-icon-04.svg') }}"
                                            alt="">
                                    </div>
                                    <div class="dash-comapny-info">
                                        <h6>Total Active Plans</h6>
                                        <h5>6</h5>
                                        <p><span>6% <i class="fe fe-chevrons-up"></i></span>Last month</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 d-flex">
                        <div class="card super-admin-dash-card">
                            <div class="card-header">
                                <div class="row align-center">
                                    <div class="col">
                                        <h5 class="card-title">Latest Registered Companies</h5>
                                    </div>
                                    <div class="col-auto">
                                        <a href="{{ url('companies') }}" class="btn-right btn btn-sm btn-outline-primary">
                                            View All
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-stripped table-hover">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="{{ url('profile') }}"
                                                            class="company-avatar avatar-md me-2 companies company-icon">
                                                            <img class="avatar-img rounded-circle company"
                                                                src="{{ URL::asset('/public/assets/img/companies/company-01.svg') }}"
                                                                alt="Company Image"></a>
                                                        <a href="{{ url('companies') }}">Hermann Groups <span
                                                                class="plane-type">Basic (Monthly)</span></a>

                                                    </h2>
                                                </td>
                                                <td>24 Feb 2024</td>
                                                <td class="text-end"><a href="{{ url('companies') }}"
                                                        class="view-companies btn">View</a></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="{{ url('profile') }}"
                                                            class="company-avatar avatar-md me-2 companies company-icon">
                                                            <img class="avatar-img rounded-circle company"
                                                                src="{{ URL::asset('/public/assets/img/companies/company-02.svg') }}"
                                                                alt="Company Image"></a>
                                                        <a href="{{ url('companies') }}">Skiles LLC <span
                                                                class="plane-type">Enterprise (Yearly)</span></a>

                                                    </h2>
                                                </td>
                                                <td>23 Feb 2024</td>
                                                <td class="text-end"><a href="{{ url('companies') }}"
                                                        class="view-companies btn">View</a></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="{{ url('profile') }}"
                                                            class="company-avatar avatar-md me-2 companies company-icon">
                                                            <img class="avatar-img rounded-circle company"
                                                                src="{{ URL::asset('/public/assets/img/companies/company-03.svg') }}"
                                                                alt="Company Image"></a>
                                                        <a href="{{ url('companies') }}">Kerluke Group <span
                                                                class="plane-type">Advanced (Monthly)</span></a>

                                                    </h2>
                                                </td>
                                                <td>22 Feb 2024</td>
                                                <td class="text-end"><a href="{{ url('companies') }}"
                                                        class="view-companies btn">View</a></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="{{ url('profile') }}"
                                                            class="company-avatar avatar-md me-2 companies company-icon">
                                                            <img class="avatar-img rounded-circle company"
                                                                src="{{ URL::asset('/public/assets/img/companies/company-04.svg') }}"
                                                                alt="Company Image"></a>
                                                        <a href="{{ url('companies') }}">Schowalter Group <span
                                                                class="plane-type">Basic (Yearly)</span></a>

                                                    </h2>
                                                </td>
                                                <td>21 Feb 2024</td>
                                                <td class="text-end"><a href="{{ url('companies') }}"
                                                        class="view-companies btn">View</a></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="{{ url('profile') }}"
                                                            class="company-avatar avatar-md me-2 companies company-icon">
                                                            <img class="avatar-img rounded-circle company"
                                                                src="{{ URL::asset('/public/assets/img/companies/company-05.svg') }}"
                                                                alt="Company Image"></a>
                                                        <a href="{{ url('companies') }}">Accentric Global <span
                                                                class="plane-type">Basic (Monthly)</span></a>

                                                    </h2>
                                                </td>
                                                <td>20 Feb 2024</td>
                                                <td class="text-end"><a href="{{ url('companies') }}"
                                                        class="view-companies btn">View</a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-7 d-flex">
                        <div class="card super-admin-dash-card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="card-title">Earnings </h5>
                                    <div class="d-flex align-center">
                                        <span class="earning-income-text"><i></i>Income</span>
                                        <div class="dropdown main">
                                            <button class="btn btn-white btn-sm dropdown-toggle" type="button"
                                                id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                2024
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">2023</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">2022</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">2021</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div id="earnings-chart"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 d-flex">
                        <div class="card super-admin-dash-card flex-fill">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="card-title">Most Ordered Plan</h5>

                                    <div class="dropdown main">
                                        <button class="btn btn-white btn-sm dropdown-toggle" type="button"
                                            id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                            This Month
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item">Today</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item">This Week</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item">This Year</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="dash-plane-list">
                                    <div class="plane-info">
                                        <span class="icon-plane"><img
                                                src="{{ URL::asset('/public/assets/img/icons/dashboard-plane-icon.svg') }}"
                                                alt=""></span>
                                        <div class="plane-name">Enterprise <span>(Monthly)</span>
                                            <h6>Total Order : 201</h6>
                                        </div>
                                    </div>
                                    <span class="plane-rate">$549.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 d-flex">
                        <div class="card super-admin-dash-card flex-fill">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="card-title">Top Company with Plan</h5>

                                    <div class="dropdown main">
                                        <button class="btn btn-white btn-sm dropdown-toggle" type="button"
                                            id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-expanded="false">
                                            Today
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item">This Month</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item">This Week</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item">This Year</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="dash-plane-list">
                                    <div class="plane-info">
                                        <span class="icon-company"><img
                                                src="{{ URL::asset('/public/assets/img/companies/company-01.svg') }}"
                                                alt=""></span>
                                        <span class="name-company">Hermann Groups</span>
                                    </div>
                                    <span class="plane-rate">10 Plans</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 d-flex">
                        <div class="card super-admin-dash-card flex-fill">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="card-title">Most Domains</h5>

                                    <div class="dropdown main">
                                        <button class="btn btn-white btn-sm dropdown-toggle" type="button"
                                            id="dropdownMenuButton4" data-bs-toggle="dropdown" aria-expanded="false">
                                            This Week
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton4">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item">This Month</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item">Today</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item">This Year</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="dash-plane-list">
                                    <div class="plane-info">
                                        <span class="icon-company"><img
                                                src="{{ URL::asset('/public/assets/img/companies/company-04.svg') }}"
                                                alt=""></span>
                                        <div class="plane-name"><span>Schowalter Group</span>
                                            <h6>sk.example.com</h6>
                                        </div>
                                    </div>
                                    <span class="plane-rate">150 Users</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 d-flex">
                        <div class="card super-admin-dash-card">
                            <div class="card-header">
                                <div class="row align-center">
                                    <div class="col">
                                        <h5 class="card-title">Recent Invoices</h5>
                                    </div>
                                    <div class="col-auto">
                                        <a href="{{ url('invoices') }}" class="btn-right btn btn-sm btn-outline-primary">
                                            View All
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-stripped table-hover">
                                        <tbody>
                                            <tr>
                                                <td><a href="{{ url('invoice-details') }}"
                                                        class="invoice-link dash-incoice-table">#INV12454</a><span
                                                        class="dash-incoice-date">15 Feb 2024</span></td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="{{ url('profile') }}"
                                                            class="company-avatar avatar-md me-2 companies company-icon">
                                                            <img class="avatar-img rounded-circle company"
                                                                src="{{ URL::asset('/public/assets/img/companies/company-01.svg') }}"
                                                                alt="Company Image">
                                                        </a>
                                                        <a href="{{ url('companies') }}">Hermann Groups</a>
                                                    </h2>
                                                </td>
                                                <td>Basic <br> <span class="plane-type">(Monthly)</span></td>
                                                <td><span
                                                        class="badge bg-success-light d-inline-flex align-items-center"><i
                                                            class="fe fe-check me-1"></i>Paid</span></td>
                                                <td class="text-end"><a href="{{ url('invoice-subscription') }}"
                                                        class="invoice-detail"><i class="fe fe-file-text"></i></a></td>
                                            </tr>
                                            <tr>
                                                <td><a href="{{ url('invoice-details') }}"
                                                        class="invoice-link dash-incoice-table">#INV45445</a><span
                                                        class="dash-incoice-date">14 Feb 2024</span></td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="{{ url('profile') }}"
                                                            class="company-avatar avatar-md me-2 companies company-icon">
                                                            <img class="avatar-img rounded-circle company"
                                                                src="{{ URL::asset('/public/assets/img/companies/company-02.svg') }}"
                                                                alt="Company Image">
                                                        </a>
                                                        <a href="{{ url('companies') }}">Skiles LLC</a>
                                                    </h2>
                                                </td>
                                                <td>Enterprise <br> <span class="plane-type">(Yearly)</span></td>
                                                <td><span class="badge bg-danger-light d-inline-flex align-items-center"><i
                                                            class="fe fe-x me-1"></i>Unpaid</span></td>
                                                <td class="text-end"><a href="{{ url('invoice-subscription') }}"
                                                        class="invoice-detail"><i class="fe fe-file-text"></i></a></td>
                                            </tr>
                                            <tr>
                                                <td><a href="{{ url('invoice-details') }}"
                                                        class="invoice-link dash-incoice-table">#INV78444</a><span
                                                        class="dash-incoice-date">13 Feb 2024</span></td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="{{ url('profile') }}"
                                                            class="company-avatar avatar-md me-2 companies company-icon">
                                                            <img class="avatar-img rounded-circle company"
                                                                src="{{ URL::asset('/public/assets/img/companies/company-03.svg') }}"
                                                                alt="Company Image">
                                                        </a>
                                                        <a href="{{ url('companies') }}">Kerluke Group</a>
                                                    </h2>
                                                </td>
                                                <td>Advanced <br> <span class="plane-type">(Monthly)</span></td>
                                                <td><span
                                                        class="badge bg-success-light d-inline-flex align-items-center"><i
                                                            class="fe fe-check me-1"></i>Paid</span></td>
                                                <td class="text-end"><a href="{{ url('invoice-subscription') }}"
                                                        class="invoice-detail"><i class="fe fe-file-text"></i></a></td>
                                            </tr>
                                            <tr>
                                                <td><a href="{{ url('invoice-details') }}"
                                                        class="invoice-link dash-incoice-table">#INV31454</a><span
                                                        class="dash-incoice-date">12 Feb 2024</span></td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="{{ url('profile') }}"
                                                            class="company-avatar avatar-md me-2 companies company-icon">
                                                            <img class="avatar-img rounded-circle company"
                                                                src="{{ URL::asset('/public/assets/img/companies/company-04.svg') }}"
                                                                alt="Company Image">
                                                        </a>
                                                        <a href="{{ url('companies') }}">Schowalter Group</a>
                                                    </h2>
                                                </td>
                                                <td>Basic <br> <span class="plane-type">(Yearly)</span></td>
                                                <td><span
                                                        class="badge bg-success-light d-inline-flex align-items-center"><i
                                                            class="fe fe-check me-1"></i>Paid</span></td>
                                                <td class="text-end"><a href="{{ url('invoice-subscription') }}"
                                                        class="invoice-detail"><i class="fe fe-file-text"></i></a></td>
                                            </tr>
                                            <tr>
                                                <td><a href="{{ url('invoice-details') }}"
                                                        class="invoice-link dash-incoice-table">#INV74878</a><span
                                                        class="dash-incoice-date">11 Feb 2024</span></td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="{{ url('profile') }}"
                                                            class="company-avatar avatar-md me-2 companies company-icon">
                                                            <img class="avatar-img rounded-circle company"
                                                                src="{{ URL::asset('/public/assets/img/companies/company-05.svg') }}"
                                                                alt="Company Image">
                                                        </a>
                                                        <a href="{{ url('companies') }}">Accentric Global</a>
                                                    </h2>
                                                </td>
                                                <td>Basic <br> <span class="plane-type">(Monthly)</span></td>
                                                <td><span
                                                        class="badge bg-success-light d-inline-flex align-items-center"><i
                                                            class="fe fe-check me-1"></i>Paid</span></td>
                                                <td class="text-end"><a href="{{ url('invoice-subscription') }}"
                                                        class="invoice-detail"><i class="fe fe-file-text"></i></a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 d-flex">
                        <div class="card super-admin-dash-card">
                            <div class="card-header">
                                <div class="row align-center">
                                    <div class="col">
                                        <h5 class="card-title">Top Plans</h5>
                                    </div>
                                    <div class="col-auto">
                                        <a href="{{ url('packages') }}" class="btn-right btn btn-sm btn-outline-primary">
                                            View All
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div id="plane-chart"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 d-flex">
                        <div class="card super-admin-dash-card">
                            <div class="card-header">
                                <div class="row align-center">
                                    <div class="col">
                                        <h5 class="card-title">Recent Plan Expired</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-stripped table-hover">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="{{ url('profile') }}"
                                                            class="company-avatar avatar-md me-2 companies company-icon">
                                                            <img class="avatar-img rounded-circle company"
                                                                src="{{ URL::asset('/public/assets/img/companies/company-01.svg') }}"
                                                                alt="Company Image"></a>
                                                        <a href="{{ url('companies') }}">Hermann Groups <span
                                                                class="plane-type">Basic (Monthly)</span></a>

                                                    </h2>
                                                </td>
                                                <td class="expired-date">Expired On <br>24 Feb 2024</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="{{ url('profile') }}"
                                                            class="company-avatar avatar-md me-2 companies company-icon">
                                                            <img class="avatar-img rounded-circle company"
                                                                src="{{ URL::asset('/public/assets/img/companies/company-02.svg') }}"
                                                                alt="Company Image"></a>
                                                        <a href="{{ url('companies') }}">Skiles LLC <span
                                                                class="plane-type">Enterprise (Yearly)</span></a>

                                                    </h2>
                                                </td>
                                                <td class="expired-date">Expired On <br>24 Feb 2024</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="{{ url('profile') }}"
                                                            class="company-avatar avatar-md me-2 companies company-icon">
                                                            <img class="avatar-img rounded-circle company"
                                                                src="{{ URL::asset('/public/assets/img/companies/company-03.svg') }}"
                                                                alt="Company Image"></a>
                                                        <a href="{{ url('companies') }}">Kerluke Group <span
                                                                class="plane-type">Advanced (Monthly)</span></a>

                                                    </h2>
                                                </td>
                                                <td class="expired-date">Expired On <br>24 Feb 2024</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="{{ url('profile') }}"
                                                            class="company-avatar avatar-md me-2 companies company-icon">
                                                            <img class="avatar-img rounded-circle company"
                                                                src="{{ URL::asset('/public/assets/img/companies/company-04.svg') }}"
                                                                alt="Company Image"></a>
                                                        <a href="{{ url('companies') }}">Schowalter Group <span
                                                                class="plane-type">Basic (Yearly)</span></a>

                                                    </h2>
                                                </td>
                                                <td class="expired-date">Expired On <br>24 Feb 2024</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="{{ url('profile') }}"
                                                            class="company-avatar avatar-md me-2 companies company-icon">
                                                            <img class="avatar-img rounded-circle company"
                                                                src="{{ URL::asset('/public/assets/img/companies/company-05.svg') }}"
                                                                alt="Company Image"></a>
                                                        <a href="{{ url('companies') }}">Accentric Global <span
                                                                class="plane-type">Basic (Monthly)</span></a>

                                                    </h2>
                                                </td>
                                                <td class="expired-date">Expired On <br>24 Feb 2024</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 d-flex">
                        <div class="card super-admin-dash-card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="card-title">Companies Registered </h5>

                                    <div class="dropdown main">
                                        <button class="btn btn-white btn-sm dropdown-toggle" type="button"
                                            id="dropdownMenuButton5" data-bs-toggle="dropdown" aria-expanded="false">
                                            2024
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton5">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item">2023</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item">2022</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item">2021</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div id="companies_flow"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 d-flex">
                        <div class="card super-admin-dash-card">
                            <div class="card-header">
                                <div class="row align-center">
                                    <div class="col">
                                        <h5 class="card-title">Recent Domain</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-stripped table-hover">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="{{ url('profile') }}"
                                                            class="company-avatar avatar-md me-2 companies company-icon">
                                                            <img class="avatar-img rounded-circle company"
                                                                src="{{ URL::asset('/public/assets/img/companies/company-01.svg') }}"
                                                                alt="Company Image"></a>
                                                        <a href="{{ url('companies') }}">Hermann Groups <span
                                                                class="plane-type">Basic (Monthly)</span></a>
                                                    </h2>
                                                </td>
                                                <td class="text-end">
                                                    <div class="active-inactive-btn">
                                                        <a href="#" class="active-domain"><i
                                                                class="fe fe-check"></i></a>
                                                        <a href="#" class="inactive-domain"><i
                                                                class="fe fe-x"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="{{ url('profile') }}"
                                                            class="company-avatar avatar-md me-2 companies company-icon">
                                                            <img class="avatar-img rounded-circle company"
                                                                src="{{ URL::asset('/public/assets/img/companies/company-02.svg') }}"
                                                                alt="Company Image"></a>
                                                        <a href="{{ url('companies') }}">Skiles LLC <span
                                                                class="plane-type">Enterprise (Yearly)</span></a>
                                                    </h2>
                                                </td>
                                                <td class="text-end">
                                                    <div class="active-inactive-btn">
                                                        <a href="#" class="active-domain"><i
                                                                class="fe fe-check"></i></a>
                                                        <a href="#" class="inactive-domain"><i
                                                                class="fe fe-x"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="{{ url('profile') }}"
                                                            class="company-avatar avatar-md me-2 companies company-icon">
                                                            <img class="avatar-img rounded-circle company"
                                                                src="{{ URL::asset('/public/assets/img/companies/company-03.svg') }}"
                                                                alt="Company Image"></a>
                                                        <a href="{{ url('companies') }}">Kerluke Group <span
                                                                class="plane-type">Advanced (Monthly)</span></a>
                                                    </h2>
                                                </td>
                                                <td class="text-end">
                                                    <div class="active-inactive-btn">
                                                        <a href="#" class="active-domain"><i
                                                                class="fe fe-check"></i></a>
                                                        <a href="#" class="inactive-domain"><i
                                                                class="fe fe-x"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="{{ url('profile') }}"
                                                            class="company-avatar avatar-md me-2 companies company-icon">
                                                            <img class="avatar-img rounded-circle company"
                                                                src="{{ URL::asset('/public/assets/img/companies/company-04.svg') }}"
                                                                alt="Company Image"></a>
                                                        <a href="{{ url('companies') }}">Schowalter Group <span
                                                                class="plane-type">Basic (Yearly)</span></a>
                                                    </h2>
                                                </td>
                                                <td class="text-end">
                                                    <div class="active-inactive-btn">
                                                        <a href="#" class="active-domain"><i
                                                                class="fe fe-check"></i></a>
                                                        <a href="#" class="inactive-domain"><i
                                                                class="fe fe-x"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="{{ url('profile') }}"
                                                            class="company-avatar avatar-md me-2 companies company-icon">
                                                            <img class="avatar-img rounded-circle company"
                                                                src="{{ URL::asset('/public/assets/img/companies/company-05.svg') }}"
                                                                alt="Company Image"></a>
                                                        <a href="{{ url('companies') }}">Accentric Global <span
                                                                class="plane-type">Basic (Monthly)</span></a>
                                                    </h2>
                                                </td>
                                                <td class="text-end">
                                                    <div class="active-inactive-btn">
                                                        <a href="#" class="active-domain"><i
                                                                class="fe fe-check"></i></a>
                                                        <a href="#" class="inactive-domain"><i
                                                                class="fe fe-x"></i></a>
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
