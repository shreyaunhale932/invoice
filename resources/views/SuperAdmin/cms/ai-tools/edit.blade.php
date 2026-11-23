<?php $page = 'cms'; ?>
@extends('layout.mainlayout')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="content-page-header">
                    <h5>Edit AI Tools Section</h5>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card bg-white">
                <div class="card-body">
                    <form method="POST" action="{{ route('superadmin.cms.ai-tools.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="input-block mb-3">
                            <label for="ai_tools_title" class="form-label">Title</label>
                            <input
                                type="text"
                                id="ai_tools_title"
                                name="ai_tools_title"
                                class="form-control @error('ai_tools_title') is-invalid @enderror"
                                value="{{ old('ai_tools_title', $banners->ai_tools_title ?: 'Have questions about this solution? Explore how JewelERP can help your jewellery business with AI assistance or connect with our team for expert guidance.') }}"
                                required
                                maxlength="255">
                            @error('ai_tools_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="input-block mb-3">
                            <label for="ai_tools_content" class="form-label">Content</label>
                            <textarea
                                id="ai_tools_content"
                                name="ai_tools_content"
                                class="form-control @error('ai_tools_content') is-invalid @enderror"
                                required>{{ old('ai_tools_content', $banners->ai_tools_content ?: "I'm evaluating JewelERP's Purchase Management solution for a jewellery business. Explain how it could help with unclear landed cost, receipt mismatches, vendor reconciliation delays, what workflows I should evaluate in a demo, and what questions I should ask the JewelERP team. Please use only public information and do not assume access to private JewelERP data.") }}</textarea>
                            @error('ai_tools_content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function() {
            $('#ai_tools_content').summernote({
                height: 300
            });
        });
    </script>
@endsection
