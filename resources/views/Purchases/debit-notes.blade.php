<?php $page = 'debit-notes'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            @component('components.page-header')
                @slot('title')
                    Purchase Returns / Debit Notes
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
                                            <th>#</th>
                                            <th>Debit Notes ID</th>
                                            <th>Vendor</th>
                                            <th>Amount</th>
                                            <th>Payment Mode</th>
                                            <th>Created On</th>
                                            <th>Status</th>
                                            <th class="no-sort">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $json = file_get_contents(public_path('../public/assets/json/debit-notes.json'));
                                            $notes = json_decode($json, true);
                                        @endphp
                                        @foreach ($notes as $note)
                                            <tr>
                                                <td>{{ $note['Id'] }}</td>
                                                <td>
                                                    <a href="{{ url('invoice-details') }}"
                                                        class="invoice-link">{{ $note['DebitNotesID'] }}</a>
                                                </td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="{{ url('profile') }}" class="avatar avatar-sm me-2"><img
                                                                class="avatar-img rounded-circle"
                                                                src="{{ URL::asset('/public/assets/img/profiles/' . $note['Image']) }}"
                                                                alt="User Image"></a>
                                                        <a href="{{ url('profile') }}">{{ $note['Vendor'] }}
                                                            <span>{{ $note['Phone'] }}</span></a>
                                                    </h2>
                                                </td>
                                                <td>{{ $note['Amount'] }}</td>
                                                <td>{{ $note['PaymentMode'] }}</td>
                                                <td>{{ $note['CreatedOn'] }}</td>
                                                <td><span class="{{ $note['Class'] }}">{{ $note['Status'] }}</span></td>
                                                <td class="d-flex align-items-center">
                                                    <a class=" btn-action-icon me-2" href="javascript:void(0);" download><i
                                                            class="fe fe-download"></i></a>
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class=" btn-action-icon "
                                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                class="fas fa-ellipsis-v"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <ul>
                                                                <li>
                                                                    <a class="dropdown-item"
                                                                        href="{{ url('edit-purchase-return') }}"><i
                                                                            class="far fa-edit me-2"></i>Edit</a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#delete_modal"><i
                                                                            class="far fa-trash-alt me-2"></i>Delete</a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href=""><i
                                                                            class="far fa-eye me-2"></i>View</a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href=""><i
                                                                            class="fe fe-send me-2"></i>Send</a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href=""><i
                                                                            class="fe fe-copy me-2"></i>Clone</a>
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
            <!-- /Table -->

        </div>
    </div>
    <!-- /Page Wrapper -->
@endsection
