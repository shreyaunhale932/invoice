<?php $page = 'cms'; ?>
@extends('layout.mainlayout')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="content-page-header">
                    <h5>Edit Solution</h5>
                </div>
                <div class="page-btn">
                    <a href="{{ route('superadmin.cms.solutions.index') }}" class="btn btn-outline-secondary">
                        <i class="fe fe-arrow-left me-1"></i>Back
                    </a>
                </div>
            </div>
            @include('SuperAdmin.cms.solutions.form', [
                'action' => route('superadmin.cms.solutions.update', $solution),
                'method' => 'PUT',
                'solution' => $solution,
            ])
        </div>
    </div>
@endsection
