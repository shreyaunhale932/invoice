<?php $page = 'cms'; ?>
@extends('layout.mainlayout')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header d-flex align-items-center justify-content-between">
                <div class="content-page-header">
                    <h5>Frequently Asked Questions</h5>
                </div>
                <a href="{{ route('superadmin.cms.faq.create') }}" class="btn btn-primary">
                    <i class="fe fe-plus me-1"></i>Add FAQ
                </a>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card bg-white">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-center w-100" style="table-layout: fixed;">
                            <colgroup>
                                <col style="width: 8%;">
                                <col style="width: 35%;">
                                <col style="width: 42%;">
                                <col style="width: 15%;">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Question</th>
                                    <th>Answer</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($faqs as $faq)
                                    <tr>
                                        <td>{{ $faqs->firstItem() + $loop->index }}</td>
                                        <td class="align-top text-break text-wrap" style="overflow-wrap: anywhere;">{{ $faq->question }}</td>
                                        <td class="align-top">
                                            <p class="mb-0 text-break" style="white-space: pre-line; overflow-wrap: anywhere;">{{ $faq->answer }}</p>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-end flex-wrap gap-2">
                                                <a href="{{ route('superadmin.cms.faq.edit', $faq) }}"
                                                    class="btn btn-sm btn-outline-primary">Edit</a>
                                                <form action="{{ route('superadmin.cms.faq.destroy', $faq) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Delete this FAQ?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">No FAQs have been added.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if ($faqs->hasPages())
                        <div class="d-flex justify-content-center mt-3">
                            {{ $faqs->links('pagination::bootstrap-5') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
