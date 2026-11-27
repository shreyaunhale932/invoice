@extends('invoice_front.includes.app')

@section('content')


<section class="jewel-billing-hero">
    <div class="container-fluid jewel-billing-container">
        <div class="row align-items-center">

            <!-- Left Content -->
            <div class="col-12 col-lg-6 jewel-billing-left">

                <a href="{{ route('invoice-front') }}#solutions" class="jewel-billing-back">
                    <i class="bi bi-chevron-left"></i>
                    <span>All solutions</span>
                </a>

                <div class="jewel-billing-eyebrow">
                    {{ $pageContent['hero']['eyebrow'] }}
                </div>

                <h1 class="jewel-billing-title">
                    {{ $pageContent['hero']['title'] }}
                </h1>

                <p class="jewel-billing-description">
                    {{ $pageContent['hero']['description'] }}
                </p>

                <!-- Buttons -->
                <div class="jewel-billing-actions">

                    <a href="contact" class="jewel-billing-primary-btn">
                        Book a Demo
                        <i class="bi bi-arrow-right"></i>
                    </a>

                    <a href="#how-it-works" class="jewel-billing-secondary-btn">
                        See how it works
                        <i class="bi bi-arrow-right"></i>
                    </a>

                </div>

                <!-- Benefits -->
                <div class="jewel-billing-benefits">

                    <span>
                        <i class="bi bi-check2"></i>
                        {{ $pageContent['hero']['benefits'][0] }}
                    </span>

                    <span>
                        <i class="bi bi-check2"></i>
                        {{ $pageContent['hero']['benefits'][1] }}
                    </span>

                </div>

            </div>

            <!-- Right Side Dashboard Image -->
            <div class="col-12 col-lg-6 jewel-billing-right">

                <!-- Floating Label -->
                <div class="jewel-billing-floating-label">
                    <i class="bi bi-receipt-cutoff"></i>
                    <span>{{ $pageContent['hero']['floating_label'] }}</span>
                </div>

                <div class="jewel-billing-image-wrap">

                    <img
                        src="{{ asset($pageContent['hero']['image']) }}"
                        alt="{{ $pageContent['hero']['image_alt'] }}"
                        class="jewel-billing-image"
                        loading="eager">

                </div>

            </div>

        </div>
    </div>
</section>


<section class="jc-business-challenges">

    <div class="jc-challenges-container">

        <!-- HEADING -->
        <div class="jc-challenges-heading reveal">

            <span class="jc-eyebrow">
                {{ $pageContent['challenges']['eyebrow'] }}
            </span>

            <h1>
                {{ $pageContent['challenges']['title'] }}
            </h1>

            <p>
                {{ $pageContent['challenges']['description'] }}
            </p>

        </div>


        <!-- CHALLENGES -->
        <div class="jc-challenges-grid">


            <!-- CARD 01 -->
            @foreach ($pageContent['challenges']['items'] as $challenge)
                <div class="jc-challenge-card reveal">

                    <span class="jc-number">{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>

                    <div class="jc-card-content">

                        <h4>{{ $challenge['title'] }}</h4>

                        <p>{{ $challenge['description'] }}</p>

                    </div>
                </div>
            @endforeach


        </div>

    </div>

</section>

<section class="jn-key-features-section">


    <div class="jn-key-features-container">


        <!-- =================================================
                 HEADING
            ================================================== -->

        <div
            class="jn-key-features-heading jn-reveal">

            <span
                class="jn-key-features-eyebrow">
                {{ $pageContent['features']['eyebrow'] }}
            </span>


            <h1>
                {{ $pageContent['features']['title'] }}
            </h1>

        </div>


        <!-- =================================================
                 FEATURES
            ================================================== -->

        <div class="jn-features-box">


            <!-- =================================================
                     FEATURE 01
                ================================================== -->

            <div
                class="jn-feature-card jn-reveal">

                <div
                    class="jn-feature-icon">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none">

                        <rect
                            x="6"
                            y="3"
                            width="12"
                            height="18"
                            rx="1.5"
                            stroke="currentColor"
                            stroke-width="1.8" />

                        <rect
                            x="9"
                            y="6"
                            width="6"
                            height="3"
                            rx="0.5"
                            stroke="currentColor"
                            stroke-width="1.5" />

                        <circle
                            cx="9"
                            cy="13"
                            r="0.8"
                            fill="currentColor" />

                        <circle
                            cx="12"
                            cy="13"
                            r="0.8"
                            fill="currentColor" />

                        <circle
                            cx="15"
                            cy="13"
                            r="0.8"
                            fill="currentColor" />

                        <circle
                            cx="9"
                            cy="16.5"
                            r="0.8"
                            fill="currentColor" />

                        <circle
                            cx="12"
                            cy="16.5"
                            r="0.8"
                            fill="currentColor" />

                        <circle
                            cx="15"
                            cy="16.5"
                            r="0.8"
                            fill="currentColor" />

                    </svg>

                </div>


                <div
                    class="jn-feature-content">

                    <h4>
                        {{ $pageContent['features']['items'][0]['title'] }}
                    </h4>

                    <p>
                        {{ $pageContent['features']['items'][0]['description'] }}
                    </p>

                </div>

            </div>


            <!-- =================================================
                     FEATURE 02
                ================================================== -->

            <div
                class="jn-feature-card jn-reveal">

                <div
                    class="jn-feature-icon">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none">

                        <path
                            d="M5 19V5"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round" />

                        <path
                            d="M5 19H20"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round" />

                        <path
                            d="M9 15V11"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round" />

                        <path
                            d="M13 15V8"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round" />

                        <path
                            d="M17 15V5"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round" />

                    </svg>

                </div>


                <div
                    class="jn-feature-content">

                    <h4>
                        {{ $pageContent['features']['items'][1]['title'] }}
                    </h4>

                    <p>
                        {{ $pageContent['features']['items'][1]['description'] }}
                    </p>

                </div>

            </div>


            <!-- =================================================
                     FEATURE 03
                ================================================== -->

            <div
                class="jn-feature-card jn-reveal">

                <div
                    class="jn-feature-icon">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none">

                        <path
                            d="M7 3.5H17V20.5L15 19L13 20.5L11 19L9 20.5L7 19V3.5Z"
                            stroke="currentColor"
                            stroke-width="1.7"
                            stroke-linejoin="round" />

                        <path
                            d="M9.5 8H14.5"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round" />

                        <path
                            d="M9.5 11H14.5"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round" />

                        <path
                            d="M9.5 14H13"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round" />

                    </svg>

                </div>


                <div
                    class="jn-feature-content">

                    <h4>
                        {{ $pageContent['features']['items'][2]['title'] }}
                    </h4>

                    <p>
                        {{ $pageContent['features']['items'][2]['description'] }}
                    </p>

                </div>

            </div>


            <!-- =================================================
                     FEATURE 04
                ================================================== -->

            <div
                class="jn-feature-card jn-reveal">

                <div
                    class="jn-feature-icon">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none">

                        <circle
                            cx="10"
                            cy="8"
                            r="4"
                            stroke="currentColor"
                            stroke-width="1.8" />

                        <path
                            d="M3.5 20C3.5 16.5 6.4 14 10 14C13.6 14 16.5 16.5 16.5 20"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round" />

                        <path
                            d="M16 4.5C18.7 4.7 20.5 6.3 20.5 8.5C20.5 10.3 19.3 11.8 17.5 12.3"
                            stroke="currentColor"
                            stroke-width="1.7"
                            stroke-linecap="round" />

                        <path
                            d="M17.5 14C20 14.6 21.5 16.5 21.5 19"
                            stroke="currentColor"
                            stroke-width="1.7"
                            stroke-linecap="round" />

                    </svg>

                </div>


                <div
                    class="jn-feature-content">

                    <h4>
                        {{ $pageContent['features']['items'][3]['title'] }}
                    </h4>

                    <p>
                        {{ $pageContent['features']['items'][3]['description'] }}
                    </p>

                </div>

            </div>


        </div>

    </div>

</section>
<section id="how-it-works" class="jn-how-section ">
    <div class="jn-how-container">
        <div class="jn-how-left jn-reveal-up">
            <span class="jn-how-eyebrow">{{ $pageContent['workflow']['eyebrow'] }}</span>
            <h1 class="jn-how-title">{{ $pageContent['workflow']['title'] }}</h1>
            <p class="jn-how-description">{{ $pageContent['workflow']['description'] }}</p>
        </div>
        <div class="jn-how-timeline" aria-label="{{ $pageContent['workflow']['title'] }}">
            @foreach ($pageContent['workflow']['items'] as $step)
                <article class="jn-how-step jn-reveal-up">
                    <div class="jn-how-number">{{ $loop->iteration }}</div>
                    <div>
                        <h3 class="jn-how-step-title">{{ $step['title'] }}</h3>
                        <p class="jn-how-step-description">{{ $step['description'] }}</p>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="business-benefits-section">
    <div class="container">
        <div class="row align-items-center">

            <!-- Left Content -->
            <div class="col-lg-7 col-12 business-benefits-content">

                <span class="business-benefits-label">
                    {{ $pageContent['benefits']['eyebrow'] }}
                </span>

                <h1 class="business-benefits-title">
                    {{ $pageContent['benefits']['title'] }}
                </h1>

                <p class="business-benefits-description">
                    {{ $pageContent['benefits']['description'] }}
                </p>

                <!-- Benefits List -->
                <div class="row business-benefits-list">

                    @foreach (array_chunk($pageContent['benefits']['items'], 2) as $benefitColumn)
                        <div class="col-md-6 col-12">
                            @foreach ($benefitColumn as $benefit)
                                <div class="business-benefit-item">
                                    <i class="bi bi-check2"></i>
                                    <span>{{ $benefit }}</span>
                                </div>
                            @endforeach
                        </div>
                    @endforeach

                </div>
            </div>

            <!-- Right Information Card -->
            <div class="col-lg-5 col-12 business-benefits-card-column">
                <div class="business-benefits-card">

                    <i class="bi bi-exclamation-circle business-benefits-icon"></i>

                    <h5>{{ $pageContent['benefits']['card_title'] }}</h5>

                    <p>
                        {{ $pageContent['benefits']['card_description'] }}
                    </p>

                </div>
            </div>

        </div>
    </div>
</section>

<section class="dashboard-section" data-reveal>
    <div class="container-fluid px-3 px-md-4">

        <!-- Section Heading -->
        <div class="dashboard-heading text-center">
            <h6 class="small-heading">{{ $pageContent['dashboard']['eyebrow'] }}</h6>
            <h1>{{ $pageContent['dashboard']['title'] }}</h1>
            <p>
                {{ $pageContent['dashboard']['description'] }}
            </p>
        </div>

        <!-- Dashboard Image -->
        <div class="dashboard-image-wrapper">
            <img
                src="{{ asset($pageContent['dashboard']['image']) }}"
                alt="{{ $pageContent['dashboard']['image_alt'] }}"
                class="dashboard-image">
        </div>

    </div>
</section>


<section class="jewel-related-section">
    <div class="container-fluid">

        <!-- Section Heading -->
        <div class="jewel-related-header">
            <span class="jewel-related-label">CONNECTED WORKFLOWS</span>

            <h1>Explore related JewelERP solutions</h1>

            <p>
                Each module works together so your team can move from one workflow
                to the next without losing<br class="d-none d-md-block">
                context.
            </p>
        </div>

        <!-- Related Solutions -->
        <div class="jewel-related-list">
            @foreach ($relatedSolutions as $relatedSolution)
                <a href="{{ url($relatedSolution->page_url) }}" class="jewel-related-card">
                    <div class="jewel-related-icon">
                        <i class="{{ $relatedSolution->page_icon }}"></i>
                    </div>
                    <div class="jewel-related-content">
                        <h3>{{ $relatedSolution->title }}</h3>
                        <p>{{ $relatedSolution->description }}</p>
                    </div>
                    <div class="jewel-related-arrow">
                        <i class="bi bi-arrow-right"></i>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>


@if ($faqs->isNotEmpty())
    <section class="jewel-faq-section" data-reveal>
        <div class="container-fluid jewel-faq-container">
            <h1 class="jewel-faq-title" data-reveal>
                Frequently asked questions (FAQ)
            </h1>

            <div class="row g-4 align-items-start">
                <div class="col-12 col-lg-12">
                    <div class="accordion jewel-faq-accordion" id="jewelFaqAccordion">
                        @foreach ($faqs as $faq)
                            @php($faqCollapseId = 'jewelFaq' . $faq->id)
                            <div class="accordion-item jewel-faq-item">
                                <h3 class="accordion-header">
                                    <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#{{ $faqCollapseId }}"
                                        aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                                        aria-controls="{{ $faqCollapseId }}">
                                        {{ $faq->question }}
                                    </button>
                                </h3>
                                <div id="{{ $faqCollapseId }}"
                                    class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                                    data-bs-parent="#jewelFaqAccordion">
                                    <div class="accordion-body">{{ $faq->answer }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="jewel-faq-read-more">
                        <a href="{{ url('/FAQS') }}" class="jewel-faq-read-more-link">
                            Read More FAQs
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif

<section class="jewel-cta-section">
    <div class="container">
        <div class="row align-items-center">

            <!-- Left Content -->
            <div class="col-lg-8 col-md-12">
                <div class="jewel-cta-content">

                    <span class="jewel-cta-subtitle">
                        MOVE FORWARD WITH CONFIDENCE
                    </span>

                    <h1>
                        Ready to Simplify Your Jewellery Business?
                    </h1>

                    <p>
                        See how JewelERP can connect your people, processes and business data.
                    </p>

                </div>
            </div>

            <!-- Right Buttons -->
            <div class="col-lg-4 col-md-12">
                <div class="jewel-cta-buttons">

                    <a href="{{ url('/contact') }}"
                        class="jewel-cta-btn jewel-cta-primary">
                        Book a Demo
                        <i class="bi bi-arrow-right"></i>
                    </a>



                </div>
            </div>

        </div>
    </div>
</section>


@include('invoice_front.includes.ai-tools')



@endsection