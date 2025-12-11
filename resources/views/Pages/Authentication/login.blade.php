<?php $page = 'login'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="login-wrapper">
        <div class="container">
             <div class="text-center">
             <img class="img-fluid logo-dark mb-2 logo-color" src="{{ URL::asset('/public/assets/img/logo2.png') }}" alt="Logo">
             <img class="img-fluid logo-light mb-2" src="{{ URL::asset('/public/assets/img/logo2-white.png') }}" alt="Logo">
             </div>
            
            <div class="loginbox">

                <div class="login-right">
                    <div class="login-right-wrap">
                        <h1>Login</h1>
                        <p class="account-subtitle">Access to our dashboard</p>

                        <form method="post" action="{{ route('admin.authenticate') }}">
                            @csrf
                            <div class="input-block mb-3">
                                <label class="form-control-label">Email Address</label>
                                <input type="text" class="form-control" id="username" name="username"
                                    value="">
                                <div class="text-danger pt-2">
                                    @error('0')
                                        {{ $message }}
                                    @enderror
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="input-block mb-3">
                                <label class="form-control-label">Password</label>
                                <div class="pass-group">
                                    <input type="password" class="form-control pass-input" id="password" name="password"
                                        value="">
                                    <span class="fa-solid fa-eye-slash toggle-password"></span>
                                    <div class="text-danger pt-2">
                                        @error('0')
                                            {{ $message }}
                                        @enderror
                                        @error('password')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="input-block mb-3">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-check custom-checkbox">
                                            <input type="checkbox" class="form-check-input" id="cb1">
                                            <label class="custom-control-label" for="cb1">Remember me</label>
                                        </div>
                                    </div>
                                    <div class="col-6 text-end">
                                        <a class="forgot-link" href="{{ url('forgot-password') }}">Forgot Password ?</a>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-lg  btn-primary w-100" type="submit">Login</button>
                            <div class="login-or">
                                <span class="or-line"></span>
                                <span class="span-or">or</span>
                            </div>
                            <!-- Social Login -->
                            <div class="social-login mb-3">
                                <span>Login with</span>
                                <a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a><a href="#"
                                    class="google"><i class="fab fa-google"></i></a>
                            </div>
                            <!-- /Social Login -->
                            <div class="text-center dont-have">Don't have an account yet? <a
                                    href="{{ url('register') }}">Register</a></div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
