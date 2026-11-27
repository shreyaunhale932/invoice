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
                    Offers with control
                </div>

                <h1 class="jewel-billing-title">
                    Run compelling offers without losing pricing discipline. </h1>

                <p class="jewel-billing-description">
                    Set clear discount permissions, promotional rules and customer jewellery schemes while keeping margins and approvals visible.</p> <!-- Buttons -->
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
                        Jewellery-specific workflows
                    </span>

                    <span>
                        <i class="bi bi-check2"></i>
                        Live connected data
                    </span>

                </div>

            </div>

            <!-- Right Side Dashboard Image -->
            <div class="col-12 col-lg-6 jewel-billing-right">

                <!-- Floating Label -->
                <div class="jewel-billing-floating-label">
                    <i class="bi bi-receipt-cutoff"></i>
                    <span>Discount & Scheme Management</span>
                </div>

                <div class="jewel-billing-image-wrap">

                    <img
                        src="{{ asset('front_assets/img/solutions/discount.jpg') }}"
                        alt="Jewellery billing and invoice management dashboard"
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
                BUSINESS CHALLENGES
            </span>

            <h1>
                Replace uncertainty with control in discount
               
                &amp; scheme management.
            </h1>

            <p>
                JewelERP brings the critical information and actions for this workflow into one connected system.
            </p>

        </div>


        <!-- CHALLENGES -->
        <div class="jc-challenges-grid">


            <!-- CARD 01 -->
            <div class="jc-challenge-card reveal">

                <span class="jc-number">
                    01
                </span>

                <div class="jc-card-content">

                    <h4>
                        Inconsistent discounting
                    </h4>

                    <p>
                        Counter-level decisions can create uneven
                        pricing and margin leakage.
                    </p>

                </div>

            </div>


            <!-- CARD 02 -->
            <div class="jc-challenge-card reveal">

                <span class="jc-number">
                    02
                </span>

                <div class="jc-card-content">

                    <h4>
                        Manual scheme tracking
                    </h4>

                    <p>
                        Installments, maturity and redemption are
                        difficult to manage in spreadsheets.
                    </p>

                </div>

            </div>


            <!-- CARD 03 -->
            <div class="jc-challenge-card reveal">

                <span class="jc-number">
                    03
                </span>

                <div class="jc-card-content">

                    <h4>
                        Limited promotion insight
                    </h4>

                    <p>
                        Teams cannot easily see which offers drive
                        profitable sales.
                    </p>

                </div>

            </div>


        </div>

    </div>

</section>





<section class="jn-key-features-section">

    <div class="jn-key-features-container">

        <!-- HEADING -->
        <div class="jn-key-features-heading jn-reveal">

            <span class="jn-key-features-eyebrow">
                KEY FEATURES
            </span>

            <h1>
                Everything your team needs for discount &amp;
               
                scheme management.
            </h1>

        </div>


        <!-- FEATURES -->
        <div class="jn-features-box">


            <!-- FEATURE 01 -->
            <div class="jn-feature-card jn-reveal">

                <div class="jn-feature-icon">

                    <svg viewBox="0 0 24 24" fill="none">

                        <circle
                            cx="12"
                            cy="12"
                            r="8.5"
                            stroke="currentColor"
                            stroke-width="1.7" />

                        <path
                            d="M8.5 9H15.5"
                            stroke="currentColor"
                            stroke-width="1.7"
                            stroke-linecap="round" />

                        <path
                            d="M8.5 15H15.5"
                            stroke="currentColor"
                            stroke-width="1.7"
                            stroke-linecap="round" />

                        <path
                            d="M10 7.5L14 16.5"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round" />

                    </svg>

                </div>

                <div class="jn-feature-content">

                    <h4>
                        Rule-based offers
                    </h4>

                    <p>
                        Configure offers by product, period,
                        customer or value.
                    </p>

                </div>

            </div>


            <!-- FEATURE 02 -->
            <div class="jn-feature-card jn-reveal">

                <div class="jn-feature-icon">

                    <svg viewBox="0 0 24 24" fill="none">

                        <path
                            d="M12 3L19 6V11.5C19 15.8 16.1 19.2 12 21C7.9 19.2 5 15.8 5 11.5V6L12 3Z"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linejoin="round" />

                        <path
                            d="M9 12L11 14L15.5 9.5"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round" />

                    </svg>

                </div>

                <div class="jn-feature-content">

                    <h4>
                        Approval limits
                    </h4>

                    <p>
                        Define discount authority by role and
                        transaction.
                    </p>

                </div>

            </div>


            <!-- FEATURE 03 -->
            <div class="jn-feature-card jn-reveal">

                <div class="jn-feature-icon">

                    <svg viewBox="0 0 24 24" fill="none">

                        <circle
                            cx="9"
                            cy="8"
                            r="3"
                            stroke="currentColor"
                            stroke-width="1.7" />

                        <path
                            d="M3.5 19C3.5 15.7 5.8 13.5 9 13.5C12.2 13.5 14.5 15.7 14.5 19"
                            stroke="currentColor"
                            stroke-width="1.7"
                            stroke-linecap="round" />

                        <path
                            d="M15 5.5C16.7 5.8 18 7.1 18 8.8C18 10.5 16.7 11.8 15 12"
                            stroke="currentColor"
                            stroke-width="1.6"
                            stroke-linecap="round" />

                        <path
                            d="M16 14C18.8 14.4 20.5 16.3 20.5 19"
                            stroke="currentColor"
                            stroke-width="1.6"
                            stroke-linecap="round" />

                    </svg>

                </div>

                <div class="jn-feature-content">

                    <h4>
                        Jewellery schemes
                    </h4>

                    <p>
                        Manage enrollment, installments,
                        maturity and redemption.
                    </p>

                </div>

            </div>


            <!-- FEATURE 04 -->
            <div class="jn-feature-card jn-reveal">

                <div class="jn-feature-icon">

                    <svg viewBox="0 0 24 24" fill="none">

                        <path
                            d="M5 19V10"
                            stroke="currentColor"
                            stroke-width="1.7"
                            stroke-linecap="round" />

                        <path
                            d="M10 19V5"
                            stroke="currentColor"
                            stroke-width="1.7"
                            stroke-linecap="round" />

                        <path
                            d="M15 19V13"
                            stroke="currentColor"
                            stroke-width="1.7"
                            stroke-linecap="round" />

                        <path
                            d="M20 19V8"
                            stroke="currentColor"
                            stroke-width="1.7"
                            stroke-linecap="round" />

                        <path
                            d="M4 19H21"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round" />

                    </svg>

                </div>

                <div class="jn-feature-content">

                    <h4>
                        Offer performance
                    </h4>

                    <p>
                        Review usage, sales contribution and
                        discount value.
                    </p>

                </div>

            </div>


        </div>

    </div>

</section>



<section id="how-it-works" class="jn-how-section ">
    <div class="jn-how-container">
        <div class="jn-how-left jn-reveal-up">
            <span class="jn-how-eyebrow">HOW IT WORKS</span>
            <h1 class="jn-how-title">A clear workflow from start to finish.</h1>
            <p class="jn-how-description">Keep your team aligned with a structured process that updates connected records along the way.</p>
        </div>

        <div class="jn-how-timeline" aria-label="Discount and scheme management workflow">

            <article class="jn-how-step jn-reveal-up">

                <div class="jn-how-number">1</div>

                <div>
                    <h3 class="jn-how-step-title">
                        Define rules
                    </h3>

                    <p class="jn-how-step-description">
                        Choose eligibility, duration and benefit.
                    </p>
                </div>

            </article>


            <article class="jn-how-step jn-reveal-up">

                <div class="jn-how-number">2</div>

                <div>
                    <h3 class="jn-how-step-title">
                        Publish
                    </h3>

                    <p class="jn-how-step-description">
                        Make the offer available at selected branches.
                    </p>
                </div>

            </article>


            <article class="jn-how-step jn-reveal-up">

                <div class="jn-how-number">3</div>

                <div>
                    <h3 class="jn-how-step-title">
                        Apply
                    </h3>

                    <p class="jn-how-step-description">
                        JewelERP validates the rule during billing.
                    </p>
                </div>

            </article>


            <article class="jn-how-step jn-reveal-up">

                <div class="jn-how-number">4</div>

                <div>
                    <h3 class="jn-how-step-title">
                        Measure
                    </h3>

                    <p class="jn-how-step-description">
                        Track redemptions and business impact.
                    </p>
                </div>

            </article>

        </div>

    </div>
</section>





<section class="business-benefits-section">

    <div class="container">

        <div class="row align-items-center">

            <!-- Left Content -->
            <div class="col-lg-7 col-12 business-benefits-content">

                <span class="business-benefits-label">
                    BUSINESS BENEFITS
                </span>

                <h1 class="business-benefits-title">
                    Less manual effort. More<br class="d-none d-xl-block">
                    confident decisions.
                </h1>

                <p class="business-benefits-description">
                    Improve the accuracy and pace of everyday work while keeping
                    management in control.
                </p>


                <!-- Benefits List -->
                <div class="row business-benefits-list">

                    <!-- Column 01 -->
                    <div class="col-md-6 col-12">

                        <div class="business-benefit-item">
                            <i class="bi bi-check2"></i>
                            <span>Protected margins</span>
                        </div>

                        <div class="business-benefit-item">
                            <i class="bi bi-check2"></i>
                            <span>Simpler scheme servicing</span>
                        </div>

                    </div>


                    <!-- Column 02 -->
                    <div class="col-md-6 col-12">

                        <div class="business-benefit-item">
                            <i class="bi bi-check2"></i>
                            <span>Consistent promotions</span>
                        </div>

                        <div class="business-benefit-item">
                            <i class="bi bi-check2"></i>
                            <span>Clear offer performance</span>
                        </div>

                    </div>

                </div>

            </div>


            <!-- Right Information Card -->
            <div class="col-lg-5 col-12 business-benefits-card-column">

                <div class="business-benefits-card">

                    <i class="bi bi-exclamation-circle business-benefits-icon"></i>

                    <h5>
                        Built around jewellery operations
                    </h5>

                    <p>
                        JewelERP connects transaction detail with the weight,
                        purity, value, item and customer context your business
                        depends on.
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
            <h6 class="small-heading">Product interface</h6>
            <h1>The right information, ready when your team needs it.</h1>
            <p>
                A focused campaign manager workspace keeps transactions, exceptions and results easy to understand.

            </p>
        </div>

        <!-- Dashboard Image -->
        <div class="dashboard-image-wrapper">
            <img
                src="{{ asset('front_assets/img/solutions/discount.jpg') }}"
                alt="JewelERP business management dashboard"
                class="dashboard-image">
        </div>

    </div>
</section>



<section class="jewel-related-section">

    <div class="container-fluid">

        <!-- Section Heading -->
        <div class="jewel-related-header">

            <span class="jewel-related-label">
                CONNECTED WORKFLOWS
            </span>

            <h1>
                Explore related JewelERP solutions
            </h1>

            <p>
                Each module works together so your team can move from one workflow
                to the next without losing<br class="d-none d-md-block">
                context.
            </p>

        </div>


        <!-- Related Solutions -->
        <div class="jewel-related-list">


            <!-- Item 1 -->
            <a href="{{ url('/invoice-and-solution') }}"
                class="jewel-related-card">

                <div class="jewel-related-icon">
                    <i class="bi bi-receipt"></i>
                </div>

                <div class="jewel-related-content">

                    <h3>
                        Invoice &amp; Sell Management
                    </h3>

                    <p>
                        Create jewellery-specific invoices with making charges,
                        stone values, GST and fast POS billing.
                    </p>

                </div>

                <div class="jewel-related-arrow">
                    <i class="bi bi-arrow-right"></i>
                </div>

            </a>


            <!-- Item 2 -->
            <a href="{{ url('/invoice-and-solution') }}"
                class="jewel-related-card">

                <div class="jewel-related-icon">
                    <i class="bi bi-bar-chart-line"></i>
                </div>

                <div class="jewel-related-content">

                    <h3>
                        Real-Time MIS Reports
                    </h3>

                    <p>
                        Access live sales, inventory, profitability and business
                        performance reports at any time.
                    </p>

                </div>

                <div class="jewel-related-arrow">
                    <i class="bi bi-arrow-right"></i>
                </div>

            </a>


            <!-- Item 3 -->
            <a href="{{ url('/invoice-and-solution') }}"
                class="jewel-related-card">

                <div class="jewel-related-icon">
                    <i class="bi bi-diagram-3"></i>
                </div>

                <div class="jewel-related-content">

                    <h3>
                        Multi-Branch Management
                    </h3>

                    <p>
                        Run multiple store locations from one dashboard with
                        centralized inventory and reporting.
                    </p>

                </div>

                <div class="jewel-related-arrow">
                    <i class="bi bi-arrow-right"></i>
                </div>

            </a>


        </div>

    </div>

</section>



<section class="jewel-faq-section" data-reveal>
    <div class="container-fluid jewel-faq-container">

        <!-- Heading -->
        <h1 class="jewel-faq-title" data-reveal>
            Frequently
            asked questions (FAQ)
        </h1>

        <div class="row g-4 align-items-start">

            <!-- FAQ Accordion -->
            <div class="col-12 col-lg-12">
                <div class="accordion jewel-faq-accordion" id="jewelFaqAccordion">

                    <div class="accordion-item jewel-faq-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button" type="button"
                                data-bs-toggle="collapse" data-bs-target="#faq1">

                                What is JEWELERP?
                            </button>
                        </h3>
                        <div id="faq1" class="accordion-collapse collapse show"
                            data-bs-parent="#jewelFaqAccordion">
                            <div class="accordion-body">
                                JEWELERP is a specialised enterprise resource planning software designed specifically for the jewellery industry. It helps jewellers, wholesalers, manufacturers, multi-branch businesses, and money lenders streamline their operations, manage inventory, billing, customer relationships, and compliance efficiently.
                            </div>
                        </div>
                    </div>


                    <!-- FAQ 01 -->
                    <div class="accordion-item jewel-faq-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#faq2">

                                Can JewelERP track purchase returns?

                            </button>
                        </h3>

                        <div id="faq2"
                            class="accordion-collapse collapse"
                            data-bs-parent="#jewelFaqAccordion">

                            <div class="accordion-body">
                                Yes. JewelERP can track purchase returns along with
                                the related item, quantity, weight, vendor and
                                transaction details.
                            </div>

                        </div>
                    </div>


                    <!-- FAQ 02 -->
                    <div class="accordion-item jewel-faq-item">

                        <h3 class="accordion-header">

                            <button class="accordion-button collapsed"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#faq3">

                                How are weight differences handled?

                            </button>

                        </h3>

                        <div id="faq3"
                            class="accordion-collapse collapse"
                            data-bs-parent="#jewelFaqAccordion">

                            <div class="accordion-body">
                                Weight differences can be recorded and verified
                                against the purchase details before the transaction
                                is approved.
                            </div>

                        </div>

                    </div>


                    <!-- FAQ 03 -->
                    <div class="accordion-item jewel-faq-item">

                        <h3 class="accordion-header">

                            <button class="accordion-button collapsed"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#faq4">

                                Can purchase costs flow into item valuation?

                            </button>

                        </h3>

                        <div id="faq4"
                            class="accordion-collapse collapse"
                            data-bs-parent="#jewelFaqAccordion">

                            <div class="accordion-body">
                                Yes. Purchase-related costs can be included in item
                                valuation to help maintain accurate landed costs and
                                inventory values.
                            </div>

                        </div>

                    </div>

                </div>

                <!-- Read More Link -->
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
                        Ready to Simplify Your Jewellery
                        Business?
                    </h1>

                    <p>
                        See how JewelERP can connect your people,
                        processes and business data.
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