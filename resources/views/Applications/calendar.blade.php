<?php $page = 'calendar'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            @component('components.page-header')
                @slot('title')
                    Calendar
                @endslot
            @endcomponent
            <!-- /Page Header -->

            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-2">Drag & Drop Event</h5>
                            <div id="calendar-events" class="mb-3">
                                <div class="calendar-events" data-class="bg-info"><i class="fas fa-circle text-info"></i> My
                                    Event One</div>
                                <div class="calendar-events" data-class="bg-success"><i
                                        class="fas fa-circle text-success"></i> My Event Two</div>
                                <div class="calendar-events" data-class="bg-danger"><i
                                        class="fas fa-circle text-danger"></i> My Event Three</div>
                                <div class="calendar-events" data-class="bg-warning"><i
                                        class="fas fa-circle text-warning"></i> My Event Four</div>
                            </div>
                            <div class="checkbox  mb-3">
                                <input id="drop-remove" type="checkbox">
                                <label for="drop-remove">
                                    Remove after drop
                                </label>
                            </div>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#add_new_event"
                                class="btn mb-0 btn-primary  w-100">
                                <i class="fas fa-plus me-1"></i> Add zzCategory
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="card bg-white">
                        <div class="card-body">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Wrapper -->
@endsection
