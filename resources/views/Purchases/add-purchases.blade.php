<?php $page = 'add-purchases'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="card mb-0">
                <div class="card-body">
                    <div class="content-page-header">
                        <h5>Add Purchases</h5>
                    </div>
                    @livewire('add-purchases')
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Wrapper -->
@endsection
