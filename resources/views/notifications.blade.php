<?php $page = 'notifications'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper notifications">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="content-page-header">
                    <h5>Notifications</h5>
                </div>
                <div class="noti-action-btns d-flex align-items-center justify-content-sm-end">
                    <a href="#" class="btn btn-white btn-mark-read"><i class="fa-solid fa-check me-1"></i>Mark as
                        read</a>
                    <a href="#" class="btn btn-white btn-delete-all" data-bs-toggle="modal"
                        data-bs-target="#notification-delete"><i class="fe fe-trash-2 me-1"></i>Delete all</a>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <div class="card user-list-item">
                        <div>
                            <div class="avatar avatar-online">
                                <a href="{{ url('settings') }}"><img
                                        src="{{ URL::asset('/public/assets/img/profiles/avatar-02.jpg') }}" class="rounded-circle"
                                        alt="image"></a>
                            </div>
                        </div>
                        <div class="users-list-body">
                            <div class="name-list-user">
                                <h6>Lex Murphy <span>requested access to </span>UNIX directory tree hierarchy</h6>
                                <div class="follow-btn">
                                    <a href="javascript:;" class="btn btn-primary">Accept</a>
                                    <a href="javascript:;" class="btn btn-outline-primary">Reject</a>
                                </div>
                                <span class="time">Today at 9:42 AM</span>
                            </div>
                            <div class="chat-user-time">
                                <span class="chats-delete">
                                    <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#notification-delete"><i
                                            class="fe fe-trash"></i></a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card user-list-item">
                        <div>
                            <div class="avatar avatar-online">
                                <a href="{{ url('settings') }}"><img
                                        src="{{ URL::asset('/public/assets/img/profiles/avatar-10.jpg') }}" class="rounded-circle"
                                        alt="image"></a>
                            </div>
                        </div>
                        <div class="users-list-body">
                            <div class="name-list-user">
                                <h6>Ray Arnold <span>left 6 comments on </span>Isla Nublar SOC2 compliance report</h6>
                                <span class="time">Yesterday at 11:42 PM</span>
                            </div>
                            <div class="chat-user-time">
                                <span class="chats-delete">
                                    <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#notification-delete"><i
                                            class="fe fe-trash"></i></a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card user-list-item">
                        <div>
                            <div class="avatar avatar-online">
                                <a href="{{ url('settings') }}"><img
                                        src="{{ URL::asset('/public/assets/img/profiles/avatar-13.jpg') }}" class="rounded-circle"
                                        alt="image"></a>
                            </div>
                        </div>
                        <div class="users-list-body">
                            <div class="name-list-user">
                                <h6>Dennis Nedry <span>commented on </span>Isla Nublar SOC2 compliance report</h6>
                                <blockquote>"Oh, I finished de-bugging the phones, but the system's compiling for eighteen
                                    minutes, or twenty. So, some minor systems may go on.</blockquote>
                                <span class="time">Yesterday at 5:42 PM</span>
                            </div>
                            <div class="chat-user-time">
                                <span class="chats-delete">
                                    <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#notification-delete"><i
                                            class="fe fe-trash"></i></a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card user-list-item">
                        <div>
                            <div class="avatar avatar-online">
                                <a href="{{ url('settings') }}"><img
                                        src="{{ URL::asset('/public/assets/img/profiles/avatar-05.jpg') }}" class="rounded-circle"
                                        alt="image"></a>
                            </div>
                        </div>
                        <div class="users-list-body">
                            <div class="name-list-user">
                                <h6>John Hammond <span>created</span> Isla Nublar SOC2 compliance report</h6>
                                <span class="time">Last Wednesday at 11:15 AM</span>
                            </div>
                            <div class="chat-user-time">
                                <span class="chats-delete">
                                    <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#notification-delete"><i
                                            class="fe fe-trash"></i></a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Wrapper -->
@endsection
