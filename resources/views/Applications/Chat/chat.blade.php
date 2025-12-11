<?php $page = 'chat'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="chat-window">
                        @include('Applications.Chat.chat-left')
                        @include('Applications.Chat.chat-right')
                    </div>
                </div>
            </div>
            <!-- /Row -->
        </div>
    </div>
    <!-- /Page Wrapper -->
@endsection
