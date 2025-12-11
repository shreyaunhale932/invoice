<?php $page = 'index-four'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper-three">
        <div class="content container-fluid">
            @livewire('index-cards')
            @livewire('index-sales')
            <div class="row">
                @livewire('index-invoices')
                @livewire('index-estimates')
            </div>
        </div>
    </div>
    <!-- /Page Wrapper -->
@endsection
