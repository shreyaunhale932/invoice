<?php $page = 'profit-loss-list'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            @component('components.page-header')
                @slot('title')
                    Profit & Loss
                @endslot
            @endcomponent
            <!-- /Page Header -->

            <div class="profit-menu">
                <div class="row">
                    <div class="col-lg-2 col-md-6 col-sm-12">
                        <div class="input-block mb-3">
                            <label>Period</label>
                            <ul class="form-group">
                                <li>
                                    <select class="select ">
                                        <option>This Year</option>
                                    </select>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-12">
                        <div class="input-block mb-3">
                            <label>From</label>
                            <div class="cal-icon cal-icon-info">
                                <input type="text" class="datetimepicker form-control" placeholder="01 Jan 2023">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-12">
                        <div class="input-block mb-3">
                            <label>To</label>
                            <div class="cal-icon cal-icon-info">
                                <input type="text" class="datetimepicker form-control" placeholder="31 Mar 2023">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-12 ">
                        <div class="input-block mb-3">
                            <label>Display Columns by</label>
                            <ul class="form-group">
                                <li>
                                    <select class="select ">
                                        <option>Month</option>
                                    </select>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-12">
                        <div class="input-block mb-3">
                            <label>Accounting Method</label>
                            <ul class="form-group">
                                <li>
                                    <select class="select ">
                                        <option>Accrual</option>
                                    </select>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-12">
                        <a class="btn btn-primary loss" href="#">
                            Run</a>
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
                                @livewire('profit-loss-list')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Wrapper -->
@endsection
