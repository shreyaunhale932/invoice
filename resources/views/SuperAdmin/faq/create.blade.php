<?php $page = 'cms'; ?>
@extends('layout.mainlayout')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="content-page-header">
                    <h5>Add FAQ</h5>
                </div>
            </div>

            <div class="card bg-white">
                <div class="card-body">
                    <form action="{{ route('superadmin.cms.faq.store') }}" method="POST">
                        @csrf
                        @include('SuperAdmin.faq.form', ['faq' => null, 'submitLabel' => 'Create FAQ'])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
