<?php $page = 'lock-screen'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="login-wrapper">
        <div class="container">
            <img class="img-fluid logo-dark mb-4" src="{{ URL::asset('/public/assets/img/logo2.png') }}" alt="Logo">
            <div class="loginbox">
                <div class="login-right">
                    <div class="login-right-wrap">
                        <div class="lock-user">
                            <img class="rounded-circle" src="{{ URL::asset('/public/assets/img/profiles/avatar-02.jpg') }}"
                                alt="User Image">
                            <h4>John Doe</h4>
                        </div>

                        <!-- Form -->
                        <form action="{{ url('/') }}">
                            <div class="input-block mb-3">
                                <label class="form-control-label">Password</label>
                                <input class="form-control" type="text">
                            </div>
                            <div class="input-block mb-0">
                                <button class="btn btn-lg  btn-primary w-100" type="submit">Enter</button>
                            </div>
                        </form>
                        <!-- /Form -->

                        <div class="text-center dont-have">Sign in as a different user? <a
                                href="{{ url('login') }}">Login</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
