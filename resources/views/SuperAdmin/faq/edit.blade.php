<?php $page = 'cms'; ?>
@extends('layout.mainlayout')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="content-page-header">
                    <h5>Edit FAQ</h5>
                </div>
            </div>

            <div class="card bg-white">
                <div class="card-body">
                    <form action="{{ route('superadmin.cms.faq.update', $faq) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @include('SuperAdmin.faq.form', ['faq' => $faq, 'submitLabel' => 'Save Changes'])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
