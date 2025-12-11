<?php $page = 'saas-login'; ?>
@extends('layout.mainlayout')
@section('content')

 <!-- Sign In -->
 <div class="row gx-0">
        
    <!-- Banner Content -->
    <div class="col-lg-6">
        <div class="authentication-wrapper">
            <div class="authentication-content">
                <h1>Access to our dashboard, Please login to continue your session!</h1>
                <p>Effortless Invoice Management for Your Business</p>
            </div>
            <div class="authen-img">
                <img src="{{URL::asset('/public/assets/img/saas-login-img.png')}}" alt="">
            </div>
            <div class="login-bg-img">
                <img src="{{URL::asset('/public/assets/img/saas-login-bg-01.png')}}" class="img-fluid vector-bg-one" alt="Img">
                <img src="{{URL::asset('/public/assets/img/saas-login-bg-02.png')}}" class="img-fluid vector-bg-two" alt="Img">
                <img src="{{URL::asset('/public/assets/img/saas-login-bg-03.png')}}" class="img-fluid vector-bg-three" alt="Img">
                <img src="{{URL::asset('/public/assets/img/saas-login-bg-04.png')}}" class="img-fluid vector-bg-four" alt="Img">
           </div>
        </div>
    </div>
    <!-- /Banner Content -->
    
    <!-- login Content -->
    <div class="col-lg-6">
        <div class="saas-login-wrapper p-0">
            <div class="login-content">
                <form action="{{url('/')}}">
                    <div class="login-userset">
                        <div class="login-logo">
                           <img src="{{URL::asset('/public/assets/img/saas-login-logo.svg')}}" alt="img">
                       </div>
                       <div class="login-card">
                           <div class="login-heading">
                               <h3>Sign in to your account</h3>
                               <p>Welcome back, user</p>
                           </div>
                            <div class="input-block mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" placeholder="Enter Email Address">                                    
                           </div>
                           <div class="input-block mb-3">
                                <label class="form-control-label">Password</label>
                                <div class="pass-group">
                                    <input type="password" class="form-control pass-input" placeholder="Password">
                                    <span class="fas fa-eye-slash toggle-password"></span>
                                </div>
                            </div>
                            <div class="input-block mb-0">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-check custom-checkbox mb-3">
                                            <input type="checkbox" class="form-check-input" id="cb1">
                                            <label class="custom-control-label mb-0" for="cb1">Remember me</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 text-sm-end mb-3">
                                        <a class="forgot-link" href="{{url('forgot-password')}}">Forgot Your Password?</a>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                        <div class="acc-in">                                 
                            <p>Don’t have an account? <a href="{{url('saas-register')}}">Sign Up</a></p>
                        </div>
                   </div>
                </form>
            </div>
        </div>      
    </div>  
    <!-- /Login Content -->
    
</div>      
<!-- /Sign In -->   
@endsection