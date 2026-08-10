@include('invoice_front.includes.auth-popup')
<header class="navbar">

<!-- LOGO -->
{{-- <a href="/" class="logo">
    <img src="{{ asset('front_assets/img/fabicon.png') }}" class="">
</a> --}}
<a href="/" class="logo">
    <img src="{{ asset('front_assets/img/logo.png') }}" class="logoImg">
</a>

<!-- MENU -->
<nav class="navLinks" id="menu">
    <a href="{{ route('invoice-front') }}">Home</a>
    <a href="{{ route('pricing') }}">Pricing</a>
    <a href="{{ route('contact') }}">Contact</a>
</nav>

<!-- RIGHT -->
<div class="navRight" id="navRight">
    <a href="javascript:void(0)" class="login" onclick="openAuthPopup()">Login</a>
    <a href="{{ route('pricing') }}#plans" class="btn" >Start Free Trial</a>
</div>


<div class="toggle" onclick="toggleMenu()">☰</div>

</header>
