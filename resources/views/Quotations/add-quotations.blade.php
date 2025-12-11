<?php $page = 'add-quotations'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="card mb-0">
                <div class="card-body">
                    <div class="page-header">
                        <div class="content-page-header">
                            <h5>Create Quotations</h5>
                        </div>
                    </div>
                    @livewire('add-quotations')
                </div>
            </div>

        </div>
    </div>
    <!-- /Page Wrapper -->
@endsection
