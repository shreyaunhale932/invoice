@extends('layout.mainlayout')

@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Label Templates</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Label Templates</li>
                    </ul>
                </div>
                <div class="col-auto">
                    <a href="{{ route('labels.designer.create') }}" class="btn btn-primary me-1">
                        <i class="fas fa-magic"></i> New Template
                    </a>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            @forelse($templates as $template)
            <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
                <div class="profile-widget">
                    <div class="profile-img bg-light d-flex align-items-center justify-content-center" style="height: 150px; border: 1px solid #ddd; border-radius: 5px;">
                        <i class="fas fa-tags fa-3x text-secondary"></i>
                    </div>
                    <div class="profile-action">
                        <div class="dropdown">
                            <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="{{ route('labels.designer.edit', $template->id) }}" class="dropdown-item"><i class="fas fa-edit m-r-5"></i> Edit Designer</a>
                                <form action="{{ route('labels.templates.destroy', $template->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Delete this template?')"><i class="fas fa-trash-alt m-r-5"></i> Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="{{ route('labels.designer.edit', $template->id) }}">{{ $template->name }}</a></h4>
                    <div class="small text-muted">{{ $template->category ?? 'General' }}</div>
                    <div class="small text-muted mt-2">
                        Printer: {{ $template->printerProfile ? $template->printerProfile->name : 'Custom Size' }}<br>
                        Size: {{ $template->canvas_width ?? ($template->printerProfile ? $template->printerProfile->label_width : '') }}mm x {{ $template->canvas_height ?? ($template->printerProfile ? $template->printerProfile->label_height : '') }}mm
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-info">
                    No label templates found. <a href="{{ route('labels.designer.create') }}">Create one now!</a>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
