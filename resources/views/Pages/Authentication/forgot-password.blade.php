<?php $page = 'forgot-password'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="login-wrapper">
        <div class="container">
            <img class="img-fluid logo-dark mb-2" src="{{ URL::asset('/public/assets/img/logo2.png') }}" alt="Logo">
            <img class="img-fluid logo-light mb-2" src="{{ URL::asset('/public/assets/img/logo2-white.png') }}" alt="Logo">
            <div class="loginbox">
                <div class="login-right">
                    <div class="login-right-wrap">
                        <h1>Forgot Password?</h1>
                        <p class="account-subtitle">Enter your email to get a password reset link</p>

                        <!-- Form -->
                        <form action="{{ url('login') }}">
                            <div class="input-block mb-3">
                                <label class="form-control-label">Email Address</label>
                                <input class="form-control" type="text">
                            </div>
                            <div class="input-block mb-0">
                                <button class="btn btn-lg btn-primary w-100" type="submit">Reset Password</button>
                            </div>
                        </form>
                        <!-- /Form -->

                        <div class="text-center dont-have">Remember your password? <a href="{{ url('login') }}">Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
