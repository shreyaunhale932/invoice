<?php $page = 'inbox'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="content-page-header">
                    <h5>Inbox</h5>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="compose-btn">
                                <a href="javascript:void(0);" class="btn btn-primary w-100">
                                    Compose
                                </a>
                            </div>
                            <ul class="inbox-menu">
                                <li class="active">
                                    <a href="#"><i class="fas fa-download"></i> Inbox <span
                                            class="mail-count">(5)</span></a>
                                </li>
                                <li>
                                    <a href="#"><i class="far fa-star"></i> Important</a>
                                </li>
                                <li>
                                    <a href="#"><i class="far fa-paper-plane"></i> Sent Mail</a>
                                </li>
                                <li>
                                    <a href="#"><i class="far fa-file-alt"></i> Drafts <span
                                            class="mail-count">(13)</span></a>
                                </li>
                                <li>
                                    <a href="#" class="pb-0 mb-0"><i class="far fa-trash-alt"></i> Trash</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                @livewire('inbox-component')
            </div>

        </div>
    </div>
    <!-- /Page Wrapper -->
@endsection
