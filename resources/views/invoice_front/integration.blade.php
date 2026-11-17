@extends('invoice_front.includes.app')
@section('content')
<div class="container-fluid">
    <div class="ratio ratio-16x9">
        <video autoplay loop playsinline preload="auto" controls class="w-100">
            <source src="{{ asset('front_assets/img/integration-video.mp4') }}" type="video/mp4">
            Your browser does not support video.
        </video>
    </div>
</div>

@endsection