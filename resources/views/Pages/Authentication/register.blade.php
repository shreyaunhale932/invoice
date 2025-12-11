<?php $page = 'register'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="login-wrapper">
        <div class="container">
            <img class="img-fluid logo-dark mb-2" src="{{ URL::asset('/public/assets/img/logo2.png') }}" alt="Logo">
            <img class="img-fluid logo-light mb-2" src="{{ URL::asset('/public/assets/img/logo2-white.png') }}" alt="Logo">

            <div class="loginbox">
                <div class="login-right">
                    <div class="login-right-wrap">
                        <h1>Register</h1>
                        <p class="account-subtitle">Access to our dashboard</p>

                        <!-- Form -->
                        <form action="{{ route('register.custom') }}" method="POST">
                            @csrf
                            <div class="input-block mb-3">
                                <label class="form-control-label">Name</label>
                                <input class="form-control" type="text" id="name" name="name">
                                <div class="text-danger pt-2">
                                    @error('0')
                                        {{ $message }}
                                    @enderror
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="input-block mb-3">
                                <label class="form-control-label">Email Address</label>
                                <input class="form-control" type="text" id="email" name="email">
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
                                    <input class="form-control pass-input" type="password" id="password" name="password">
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
                                <label class="form-control-label">Confirm Password</label>
                                <div class="pass-group">
                                    <input class="form-control pass-new-input" type="password" name="confirm_password"
                                        id="confirm_password">
                                    <span class="fa-solid fa-eye-slash toggle-password1"></span>
                                    <div class="text-danger pt-2">
                                        @error('0')
                                            {{ $message }}
                                        @enderror
                                        @error('confirm_password')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="input-block mb-0">
                                <button class="btn btn-lg  btn-primary w-100" type="submit">Register</button>
                            </div>
                        </form>
                        <!-- /Form -->

                        <div class="login-or">
                            <span class="or-line"></span>
                            <span class="span-or">or</span>
                        </div>
                        <!-- Social Login -->
                        <div class="social-login">
                            <span>Register with</span>
                            <a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a><a href="#"
                                class="google"><i class="fab fa-google"></i></a>
                        </div>
                        <!-- /Social Login -->
                        <div class="text-center dont-have">Already have an account? <a href="{{ url('login') }}">Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
