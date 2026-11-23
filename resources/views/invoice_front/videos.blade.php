@extends('invoice_front.includes.app')

@section('content')

<section class="jxv-section">

    <div class="jxv-container">

        <!-- =================================================
             EYEBROW
        ================================================== -->

        <div class="jxv-eyebrow">
            Video Library
        </div>


        <!-- =================================================
             HEADING
        ================================================== -->

        <h1 class="jxv-heading">
            See Jewelerp
            <span>In Action</span>
        </h1>


        <!-- =================================================
             DESCRIPTION
        ================================================== -->

        <p class="jxv-description">
            Explore real product walkthroughs, workflows and
            tutorials from the jewelerp platform.
            See how everything works in real-world scenarios.
        </p>

        @php
            $displayVideos = $videos->isNotEmpty()
                ? $videos
                : collect([
                    (object) [
                        'category' => 'software',
                        'video_id' => 'M7lc1UVf-VE',
                        'title' => 'How To Create New Customers Bill In jewelerp Software',
                        't2_label' => 'Tutorial',
                    ],
                    (object) [
                        'category' => 'software',
                        'video_id' => 'aqz-KE-bpKQ',
                        'title' => 'How Sales Person Dashboard Works In jewelerp Cloud-Based Software',
                        't2_label' => 'Dashboard',
                    ],
                    (object) [
                        'category' => 'manufacturing',
                        'video_id' => 'ScMzIvxBSi4',
                        'title' => 'How To Add Products In jewelerp jewelerp ERP Software',
                        't2_label' => 'ERP',
                    ],
                    (object) [
                        'category' => 'pos',
                        'video_id' => 'ysz5S6PUM-U',
                        'title' => 'How To Create A Sales Invoice From jewelerp Mobile App',
                        't2_label' => 'Mobile',
                    ],
                    (object) [
                        'category' => 'pos',
                        'video_id' => 'jNQXAC9IVRw',
                        'title' => 'How To Create A Sales Invoice From jewelerp iOS App',
                        't2_label' => 'iOS',
                    ],
                    (object) [
                        'category' => 'rfid',
                        'video_id' => 'dQw4w9WgXcQ',
                        'title' => 'jewelerp RFID & Hardware Complete Walkthrough',
                        't2_label' => 'Hardware',
                    ],
                ]);
        @endphp

        <!-- =================================================
             CATEGORY TABS
        ================================================== -->

        <div class="jxv-tabs">
            @foreach ($categories as $category => $label)
                <button
                    type="button"
                    class="jxv-tab @if ($loop->first) jxv-active @endif"
                    data-category="{{ $category }}">
                    {{ $label }}
                </button>
            @endforeach
        </div>


        <!-- =================================================
             VIDEO GRID
        ================================================== -->

        <div class="jxv-grid">
            @forelse ($displayVideos as $video)
                <article
                    class="jxv-card"
                    data-category="{{ $video->category }}"
                    data-video="{{ $video->video_id }}">
                    <div class="jxv-thumbnail">
                        <img
                            src="https://img.youtube.com/vi/{{ $video->video_id }}/maxresdefault.jpg"
                            onerror="this.onerror=null;this.src='https://img.youtube.com/vi/{{ $video->video_id }}/hqdefault.jpg';"
                            alt="{{ $video->title }}">
                        <span class="jxv-number">VIDEO {{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        <span class="jxv-play"></span>
                    </div>
                    <div class="jxv-content">
                        <h3 class="jxv-title">{{ $video->title }}</h3>
                        <div class="jxv-meta">
                            {{ $categories[$video->category] }}
                            <span class="jxv-meta-dot"></span>
                            {{ $video->t2_label }}
                        </div>
                    </div>
                </article>
            @empty
                <p class="jxv-empty">No videos have been added yet.</p>
            @endforelse
        </div>

    </div>

</section>


<!-- =========================================================
     YOUTUBE MODAL
========================================================= -->

<div
    class="jxv-modal"
    id="jxvModal">

    <div class="jxv-modal-box">

        <button
            type="button"
            class="jxv-close"
            id="jxvClose"
            aria-label="Close video">

            &times;

        </button>

        <div class="jxv-frame">

            <iframe
                id="jxvYoutube"
                src=""
                title="jewelerp Video"
                allow="autoplay; encrypted-media; picture-in-picture; fullscreen"
                allowfullscreen>
            </iframe>

        </div>

    </div>

</div>


@include('invoice_front.includes.ai-tools')

@endsection