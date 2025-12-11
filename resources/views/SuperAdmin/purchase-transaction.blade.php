<?php $page = 'purchase-transcation'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            @component('components.page-header')
                @slot('title')
                    Purchase Transaction
                @endslot
            @endcomponent
            <!-- /Page Header -->

            <!-- Table -->
            <div class="row">
                <div class="col-sm-12">
                    <div class=" card-table">
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="purchase-table">
                                    <table class="table table-center table-hover datatable">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Bill #</th>
                                                <th>Customer</th>
                                                <th>Created On</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th>Mode</th>
                                                <th class="no-sort">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $json = file_get_contents(
                                                    public_path('../public/assets/json/purchase-transcation.json'),
                                                );
                                                $transcations = json_decode($json, true);
                                            @endphp
                                            @foreach ($transcations as $transcation)
                                                <tr>
                                                    <td>{{ $transcation['Id'] }}</td>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <a href="{{ url('profile') }}">{{ $transcation['Customer'] }}
                                                                <span>{{ $transcation['Email'] }}</span></a>
                                                        </h2>
                                                    </td>
                                                    <td>{{ $transcation['CreatedOn'] }}</td>
                                                    <td>{{ $transcation['Amount'] }}</td>
                                                    <td><span
                                                            class="{{ $transcation['Class'] }}">{{ $transcation['Status'] }}</span>
                                                    </td>
                                                    <td>{{ $transcation['Mode'] }}</td>
                                                    <td class="d-flex align-items-center">
                                                        <div class="dropdown dropdown-action">
                                                            <a href="#" class=" btn-action-icon "
                                                                data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                    class="fas fa-ellipsis-v"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <ul class="dropdown-ul">
                                                                    <li>
                                                                        <a class="dropdown-item"
                                                                            href="javascript:void(0);"><i
                                                                                class="fa-solid fa-eye me-2"></i>View</a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item"
                                                                            href="javascript:void(0);"><i
                                                                                class="fa-solid fa-xmark me-2"></i>Cancel</a>
                                                                    </li>
                                                                    <li class="delete-alt">
                                                                        <div>
                                                                            <a class="dropdown-item"
                                                                                href="javascript:void(0);"><i
                                                                                    class="fa-solid fa-edit me-2"></i>Subscription</a>
                                                                        </div>
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
            <!-- /Table -->

        </div>
    </div>
    <!-- /Page Wrapper -->


    <div class="toggle-sidebar">
        <div class="sidebar-layout-filter">
            <div class="sidebar-header">
                <h5>Filter</h5>
                <a href="#" class="sidebar-closes"><i class="fa-regular fa-circle-xmark"></i></a>
            </div>
            <div class="sidebar-body">
                <form action="#" autocomplete="off">
                    <!-- Product -->
                    <div class="accordion" id="accordionMain1">
                        <div class="card-header-new" id="headingOne">
                            <h6 class="filter-title">
                                <a href="javascript:void(0);" class="w-100" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Customer
                                    <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                                </a>
                            </h6>
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                            data-bs-parent="#accordionExample1">
                            <div class="card-body-chat">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="checkBoxes1">
                                            <div class="selectBox-cont">
                                                <label class="custom_check w-100">
                                                    <input type="checkbox" name="username">
                                                    <span class="checkmark"></span> Orn LLC
                                                </label>
                                                <label class="custom_check w-100">
                                                    <input type="checkbox" name="username">
                                                    <span class="checkmark"></span> Accent Technology
                                                </label>
                                                <label class="custom_check w-100">
                                                    <input type="checkbox" name="username">
                                                    <span class="checkmark"></span> Express Advertising
                                                </label>
                                                <label class="custom_check w-100">
                                                    <input type="checkbox" name="username">
                                                    <span class="checkmark"></span> Sumo Soft Limited
                                                </label>
                                                <!-- View All -->
                                                <div class="view-content">
                                                    <div class="viewall-One">
                                                        <label class="custom_check w-100">
                                                            <input type="checkbox" name="username">
                                                            <span class="checkmark"></span> Repair Group Co
                                                        </label>
                                                        <label class="custom_check w-100">
                                                            <input type="checkbox" name="username">
                                                            <span class="checkmark"></span> Lexicon Technologies
                                                        </label>
                                                    </div>
                                                    <div class="view-all">
                                                        <a href="javascript:void(0);" class="viewall-button-One"><span
                                                                class="me-2">View
                                                                All</span><span><i
                                                                    class="fa fa-circle-chevron-down"></i></span></a>
                                                    </div>
                                                </div>
                                                <!-- /View All -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Product -->

                    <!-- Product Code -->
                    <div class="accordion" id="accordionMain4">
                        <div class="card-header-new" id="headingFour">
                            <h6 class="filter-title">
                                <a href="javascript:void(0);" class="w-100 collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                    Mode
                                    <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                                </a>
                            </h6>
                        </div>

                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour"
                            data-bs-parent="#accordionExample4">
                            <div class="card-body-chat">
                                <div id="checkBoxes3">
                                    <div class="selectBox-cont">
                                        <label class="custom_check w-100">
                                            <input type="checkbox" name="category">
                                            <span class="checkmark"></span> Cash
                                        </label>
                                        <label class="custom_check w-100">
                                            <input type="checkbox" name="category">
                                            <span class="checkmark"></span> UPI
                                        </label>
                                        <label class="custom_check w-100">
                                            <input type="checkbox" name="category">
                                            <span class="checkmark"></span> Cheque
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Product Code -->

                    <!-- Unts -->
                    <div class="accordion accordion-last" id="accordionMain3">
                        <div class="card-header-new" id="headingThree">
                            <h6 class="filter-title">
                                <a href="javascript:void(0);" class="w-100 collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                    Status
                                    <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                                </a>
                            </h6>
                        </div>

                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                            data-bs-parent="#accordionExample3">
                            <div class="card-body-chat">
                                <div id="checkBoxes2">
                                    <div class="selectBox-cont">
                                        <label class="custom_check w-100">
                                            <input type="checkbox" name="bystatus">
                                            <span class="checkmark"></span> Paid
                                        </label>
                                        <label class="custom_check w-100">
                                            <input type="checkbox" name="bystatus">
                                            <span class="checkmark"></span> Pending
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Units -->

                    <div class="filter-buttons">
                        <button type="submit"
                            class="d-inline-flex align-items-center justify-content-center btn w-100 btn-primary">
                            Apply
                        </button>
                        <button type="submit"
                            class="d-inline-flex align-items-center justify-content-center btn w-100 btn-secondary">
                            Reset
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
