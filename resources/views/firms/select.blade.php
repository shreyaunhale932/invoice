@extends('layout.mainlayout')
@section('content')
<div class="page-wrapper" style="margin-left: 0; padding-top: 50px;">
    <div class="content container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg border-0" style="border-radius: 20px; background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px);">
                    <div class="card-body p-5">
                        <div class="text-center mb-5">
                            <h2 class="fw-bold text-primary">Choose Your Firm</h2>
                            <p class="text-muted">Select an active firm to manage your business</p>
                        </div>

                        @if(session('info'))
                            <div class="alert alert-info alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="border-radius: 12px;">
                                <i class="fas fa-info-circle me-2"></i> {{ session('info') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="border-radius: 12px;">
                                <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="row g-4">
                            @foreach($firms as $firm)
                                <div class="col-12">
                                    <form action="{{ route('firms.switch') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="firm_id" value="{{ $firm->id }}">
                                        <button type="submit" class="btn btn-outline-primary w-100 p-4 text-start d-flex align-items-center justify-content-between shadow-sm hover-elevate" style="border-radius: 15px; border: 2px solid #eef2f7; transition: all 0.3s ease;">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-primary-light rounded-circle p-3 me-3">
                                                    <i class="fas fa-building text-primary fa-lg"></i>
                                                </div>
                                                <div>
                                                    <h5 class="mb-0 fw-bold">{{ $firm->name }}</h5>
                                                    <small class="text-muted">{{ $firm->city ?? 'Main Branch' }}</small>
                                                </div>
                                            </div>
                                            <i class="fas fa-chevron-right text-muted"></i>
                                        </button>
                                    </form>
                                </div>
                            @endforeach

                            <div class="col-12 mt-4 text-center">
                                <a href="{{ route('firms.create') }}" class="btn btn-link text-decoration-none">
                                    <i class="fas fa-plus-circle me-1"></i> Create a new firm
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .hover-elevate:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
        border-color: #3d5ee1 !important;
        background-color: #f8fbff !important;
    }
    .bg-primary-light {
        background-color: rgba(61, 94, 225, 0.1);
    }
</style>
@endsection
