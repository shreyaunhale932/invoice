@extends('invoice_front.includes.app')

@section('content')
    <section class="jewel-blog-banner">
        <div class="jewel-banner-pattern"></div>
        <div class="jewel-banner-shape shape-one"></div>
        <div class="jewel-banner-shape shape-two"></div>
        <div class="jewel-banner-icon icon-one"><i class="bi bi-gem"></i></div>
        <div class="jewel-banner-icon icon-two"><i class="bi bi-box-seam"></i></div>
        <div class="jewel-banner-icon icon-three"><i class="bi bi-graph-up-arrow"></i></div>
        <div class="jewel-banner-icon icon-four"><i class="bi bi-stars"></i></div>

        <div class="container position-relative">
            <div class="jewel-banner-content text-center">
                <span class="jewel-banner-label">
                    <i class="bi bi-gem"></i>
                    JEWELERP INSIGHTS
                </span>
                <h1>
                    Insights &amp; Innovations for the
                    <span>Modern Jewellery Business</span>
                </h1>
                <div class="jewel-banner-line"></div>
                <p>
                    Discover expert tips, industry trends and smart solutions
                    to simplify jewellery management and grow your business.
                </p>
            </div>
        </div>
    </section>

    <section class="jewel-blog-section">
        <div class="container">
            @if ($blogs->isNotEmpty())
                <div class="row g-4 align-items-start">
                    <div class="col-lg-7 col-md-12">
                        @foreach ($blogs as $blog)
                            <article class="jewel-blog-featured mb-4">
                                <a href="{{ route('blogdetails.show', $blog) }}" class="jewel-blog-image-link">
                                    <img src="{{ asset($blog->image) }}"
                                        alt="{{ $blog->heading }}"
                                        class="jewel-blog-featured-img">
                                </a>
                                <div class="jewel-blog-content">
                                    <h2 class="jewel-blog-title">{{ $blog->heading }}</h2>
                                    <div class="jewel-blog-meta">
                                        <span>
                                            <i class="bi bi-calendar-check-fill"></i>
                                            {{ $blog->date->format('d M Y') }}
                                        </span>
                                        <span>
                                            <i class="bi bi-person-fill"></i>
                                            {{ $blog->admin }}
                                        </span>
                                    </div>
                                    <div class="jewel-blog-description">
                                        {{ \Illuminate\Support\Str::limit(trim(strip_tags($blog->content1)), 100) }}
                                    </div>
                                    <a href="{{ route('blogdetails.show', $blog) }}" class="jewel-blog-readmore">
                                        Continue Reading
                                        <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <div class="col-lg-5 col-md-12">
                        @include('invoice_front.includes.blog-latest')
                    </div>
                </div>
            @else
                <p class="text-center text-muted">No blog posts have been published yet.</p>
            @endif
        </div>
    </section>

    @include('invoice_front.includes.ai-tools')
@endsection
