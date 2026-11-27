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
                <h1>{{ $blog->heading }}</h1>
                <div class="jewel-banner-line"></div>
            </div>
        </div>
    </section>

    <section class="jewel-blog-section">
        <div class="container">
            <div class="row g-4 align-items-start">
                <div class="{{ $latestBlogs->isNotEmpty() ? 'col-lg-7' : 'col-lg-9 mx-auto' }} col-md-12">
                    <article class="jewel-blog-featured">
                        <img src="{{ asset($blog->image) }}" alt="{{ $blog->heading }}"
                            class="jewel-blog-featured-img">

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

                            <div class="jewel-blog-description">{!! $blog->content1 !!}</div>

                            @if (filled($blog->content2))
                                <div class="jewel-blog-description">{!! $blog->content2 !!}</div>
                            @endif

                            @if (filled($blog->conclusion))
                                <h3>Conclusion</h3>
                                <div class="jewel-blog-description">{!! $blog->conclusion !!}</div>
                            @endif

                            <a href="{{ route('blog') }}" class="jewel-blog-readmore">
                                <i class="bi bi-arrow-left"></i>
                                Back to Blog
                            </a>
                        </div>
                    </article>
                </div>

                @if ($latestBlogs->isNotEmpty())
                    <div class="col-lg-5 col-md-12">
                        @include('invoice_front.includes.blog-latest')
                    </div>
                @endif
            </div>
        </div>
    </section>

    @include('invoice_front.includes.ai-tools')
@endsection
