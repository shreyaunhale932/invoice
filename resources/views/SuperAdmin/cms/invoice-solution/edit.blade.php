<?php $page = 'cms'; ?>
@extends('layout.mainlayout')

@section('content')
    @php
        $editorContent = $content;
        unset($editorContent['hero']['image'], $editorContent['dashboard']['image']);

        $sectionTitles = [
            'hero' => 'Hero',
            'challenges' => 'Business Challenges',
            'features' => 'Key Features',
            'workflow' => 'How It Works',
            'benefits' => 'Business Benefits',
            'dashboard' => 'Dashboard',
        ];
    @endphp

    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="content-page-header">
                    <h5>Edit Invoice &amp; Solution Page</h5>
                    <!-- <p class="text-muted mb-0">Edit page text and images. Related headings, FAQ and call-to-action text, buttons, and icons are fixed; related cards are managed in Our Solutions.</p> -->
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form method="POST" action="{{ route('superadmin.cms.invoice-solution.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="card bg-white mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Page Images</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-4">
                            @foreach (['hero' => 'Hero Image', 'dashboard' => 'Dashboard Image'] as $imageSection => $imageLabel)
                                @php
                                    $imageField = $imageSection . '_image';
                                @endphp
                                <div class="col-12 col-xl-6">
                                    <div class="border rounded p-3 h-100">
                                        <label class="form-label fw-semibold" for="{{ $imageField }}">{{ $imageLabel }}</label>
                                        <input id="{{ $imageField }}" name="{{ $imageField }}" type="file"
                                            class="form-control @error($imageField) is-invalid @enderror"
                                            accept="image/jpeg,image/png,image/webp">
                                        @error($imageField)
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        @if ($content[$imageSection]['image'])
                                            <div class="bg-light rounded mt-3 p-2 text-center">
                                                <img src="{{ asset($content[$imageSection]['image']) }}"
                                                    alt="Current {{ strtolower($imageLabel) }}"
                                                    class="img-fluid rounded"
                                                    style="width: 100%; height: 280px; object-fit: contain">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                @foreach ($editorContent as $sectionKey => $section)
                    <div class="card bg-white mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">{{ $sectionTitles[$sectionKey] ?? \Illuminate\Support\Str::headline($sectionKey) }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                @foreach ($section as $fieldKey => $value)
                                    @if (is_array($value))
                                        @if (count($value) && is_array(reset($value)))
                                            @foreach ($value as $itemIndex => $item)
                                                <div class="col-12">
                                                    <div class="border rounded p-3">
                                                        <h6>{{ \Illuminate\Support\Str::headline($fieldKey) }} {{ $loop->iteration }}</h6>
                                                        <div class="row g-3">
                                                            @foreach ($item as $itemField => $itemValue)
                                                                @include('SuperAdmin.cms.invoice-solution.field', [
                                                                    'inputName' => "content[{$sectionKey}][{$fieldKey}][{$itemIndex}][{$itemField}]",
                                                                    'errorKey' => "content.{$sectionKey}.{$fieldKey}.{$itemIndex}.{$itemField}",
                                                                    'label' => $itemField,
                                                                    'value' => $itemValue,
                                                                    'multiline' => $itemField === 'description',
                                                                ])
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            @foreach ($value as $itemIndex => $itemValue)
                                                @include('SuperAdmin.cms.invoice-solution.field', [
                                                    'inputName' => "content[{$sectionKey}][{$fieldKey}][{$itemIndex}]",
                                                    'errorKey' => "content.{$sectionKey}.{$fieldKey}.{$itemIndex}",
                                                    'label' => \Illuminate\Support\Str::headline($fieldKey) . ' ' . ($itemIndex + 1),
                                                    'value' => $itemValue,
                                                    'multiline' => false,
                                                ])
                                            @endforeach
                                        @endif
                                    @else
                                        @include('SuperAdmin.cms.invoice-solution.field', [
                                            'inputName' => "content[{$sectionKey}][{$fieldKey}]",
                                            'errorKey' => "content.{$sectionKey}.{$fieldKey}",
                                            'label' => $fieldKey,
                                            'value' => $value,
                                            'multiline' => str_contains($fieldKey, 'description') || $fieldKey === 'title' || $fieldKey === 'card_title',
                                        ])
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach

                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="{{ route('superadmin.cms') }}" class="btn btn-light ms-2">Cancel</a>
            </form>
        </div>
    </div>
@endsection
