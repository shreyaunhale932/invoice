<?php $page = 'register'; ?>
@extends('layout.mainlayout')
@section('content')
  <!-- Sign In -->
  <div class="row gx-0">
        
    <!-- Banner Content -->
    <div class="col-lg-6">
        <div class="authentication-wrapper">
            <div class="authentication-content">
                <h1>Take control of your invoicing process. Sign up for a account today.</h1>
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
                <form action="{{url('saas-login')}}">
                    <div class="login-userset">
                        <div class="login-logo">
                           <img src="{{URL::asset('/public/assets/img/saas-login-logo.svg')}}" alt="img">
                       </div>
                       <div class="login-card">
                           <div class="login-heading">
                               <h3>Create an Account</h3>
                               <p>Sign Up Instantly to get free trail for 14 days!!!</p>
                           </div>
                           <div class="input-block mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" placeholder="Enter Your Name">                                    
                            </div>
                            <div class="input-block mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" placeholder="Enter Email Address">                                    
                           </div>
                           <div class="input-block mb-3">
                                <label class="form-label">Domain Name  </label> 
                                <div class="url-text-box">
                                    <input type="text" class="form-control" placeholder="Enter Domain Name">
                                    <span class="url-text">kanakku.com</span>
                                </div>                        
                            </div>
                            <div class="input-block mb-3">
                                <label class="form-label">Company Name</label>
                                <input type="text" class="form-control" placeholder="Enter Company name">                                    
                            </div>
                            <div class="d-flex saas-pass-box">
                                <div class="input-block mb-3">
                                    <label class="form-control-label">Password</label>
                                    <div class="pass-group">
                                        <input type="password" class="form-control pass-input" placeholder="Password">
                                        <span class="fas fa-eye-slash toggle-password"></span>
                                    </div>
                                </div>
                                <div class="input-block mb-3">
                                    <label class="form-control-label">Confirm Password</label>
                                    <div class="pass-group">
                                        <input type="password" class="form-control pass-input-two" placeholder="Confirm Password">
                                        <span class="fas fa-eye-slash toggle-password-two"></span>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="input-block mb-3">
                                <div class="form-check custom-checkbox mb-0">
                                    <input type="checkbox" class="form-check-input" id="cb1">
                                    <label class="custom-control-label mb-0" for="cb1">I agree to Terms of Service and Privacy Policy.</label>
                                </div>                                 
                            </div>
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                        <div class="acc-in">                                 
                            <p>Already have an account? <a href="{{url('saas-login')}}"> Sign IN</a></p>
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