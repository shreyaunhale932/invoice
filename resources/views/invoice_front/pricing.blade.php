@extends('invoice_front.includes.app')
@section('content')

<section class="jewel-erp-hero"
    data-desktop="{{ asset('front_assets/img/p-banner.jpg') }}"
    data-mobile="{{ asset('front_assets/img/p-banner2.jpg') }}">

    <div class="container-fluid jewel-erp-hero-container">
        <div class="row align-items-center">
            <div class="col-12 col-lg-9 col-xl-8">

                <div class="jewel-erp-hero-content">

                    <h1 class="jewel-erp-hero-title">
                        How Jewellery ERP Software
                        Can Transform Your Business
                        Operations
                    </h1>

                    <p class="jewel-erp-hero-description">
                        One considered system for your stock, billing,
                        customers and the craft behind every piece.
                    </p>

                    <a href="#plans" class="btn jewel-erp-hero-btn">
                        <span>Explore Plan</span>
                        <span class="jewel-erp-hero-arrow">&rarr;</span>
                    </a>

                </div>

            </div>
        </div>
    </div>

</section>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const hero = document.querySelector(".jewel-erp-hero");

    if (!hero) return;

    function updateHeroBackground() {
        const image = window.innerWidth <= 767
            ? hero.dataset.mobile
            : hero.dataset.desktop;

        hero.style.backgroundImage = `
            linear-gradient(
                90deg,
                rgba(0, 18, 38, 0.38),
                rgba(0, 25, 48, 0.11)
            ),
            url("${image}")
        `;
    }

    updateHeroBackground();
    window.addEventListener("resize", updateHeroBackground);
});
</script>




<style>
/* 4 Plans in Single Line on Desktop (No Scrolling) */
.jewel-pricing-section {
    overflow-x: hidden !important;
    padding: 60px 0 !important;
}

.jewel-pricing-section .jewel-pricing-container {
    max-width: 1460px !important;
    width: 96% !important;
    padding-left: 12px !important;
    padding-right: 12px !important;
    margin: 0 auto !important;
}

.jewel-pricing-cards {
    max-width: 100% !important;
    margin-left: -8px !important;
    margin-right: -8px !important;
    display: flex !important;
    flex-wrap: wrap !important;
    justify-content: center !important;
    align-items: stretch !important;
}

.jewel-pricing-cards > .jewel-pricing-column {
    padding-left: 8px !important;
    padding-right: 8px !important;
    display: flex !important;
    justify-content: center !important;
}

/* Desktop layout (>= 992px) */
@media (min-width: 992px) {
    /* 4 Plans in single line */
    .jewel-pricing-cards.plans-count-4 > .jewel-pricing-column,
    .jewel-pricing-cards:not([class*="plans-count-"]) > .jewel-pricing-column {
        flex: 0 0 25% !important;
        max-width: 25% !important;
        width: 25% !important;
        margin-bottom: 0 !important;
    }

    /* 3 Plans: Centered in single line */
    .jewel-pricing-cards.plans-count-3 > .jewel-pricing-column {
        flex: 0 0 33.333% !important;
        max-width: 380px !important;
        width: 100% !important;
        margin-bottom: 0 !important;
    }

    /* 2 Plans: Centered side-by-side */
    .jewel-pricing-cards.plans-count-2 > .jewel-pricing-column {
        flex: 0 0 50% !important;
        max-width: 395px !important;
        width: 100% !important;
        margin-bottom: 0 !important;
    }

    /* 1 Plan: Centered single card */
    .jewel-pricing-cards.plans-count-1 > .jewel-pricing-column {
        flex: 0 0 100% !important;
        max-width: 425px !important;
        width: 100% !important;
        margin-bottom: 0 !important;
    }
}

/* Tablet (576px - 991.98px) */
@media (min-width: 576px) and (max-width: 991.98px) {
    .jewel-pricing-cards > .jewel-pricing-column {
        flex: 0 0 50% !important;
        max-width: 380px !important;
        width: 50% !important;
        margin-bottom: 24px !important;
    }

    .jewel-pricing-cards.plans-count-1 > .jewel-pricing-column {
        flex: 0 0 100% !important;
        max-width: 425px !important;
        width: 100% !important;
    }
}

/* Mobile (< 576px) */
@media (max-width: 575.98px) {
    .jewel-pricing-cards > .jewel-pricing-column {
        flex: 0 0 100% !important;
        max-width: 400px !important;
        width: 100% !important;
        margin-bottom: 24px !important;
    }
}

/* Card Styling for Balanced 4 Columns */
.jewel-pricing-card {
    position: relative !important;
    width: 100% !important;
    height: 100% !important;
    padding: 32px 20px !important;
    border-radius: 18px !important;
    display: flex !important;
    flex-direction: column !important;
    justify-content: flex-start !important;
    background: #ffffff !important;
    border: 1px solid #dfe3ea !important;
    box-shadow: 0 10px 24px rgba(0, 0, 0, 0.06), 0 2px 6px rgba(0, 0, 0, 0.04) !important;
    transition: transform 0.3s cubic-bezier(0.165, 0.84, 0.44, 1), box-shadow 0.3s cubic-bezier(0.165, 0.84, 0.44, 1) !important;
}

.jewel-pricing-card:hover {
    transform: translateY(-8px) !important;
    box-shadow: 0 18px 36px rgba(21, 43, 83, 0.12) !important;
}

.jewel-pricing-card-featured {
    border: 2.5px solid var(--jewel-price-blue, #073ba7) !important;
    box-shadow: 0 12px 28px rgba(7, 59, 167, 0.12) !important;
}

.jewel-pricing-popular {
    position: absolute !important;
    top: -12px !important;
    left: 50% !important;
    transform: translateX(-50%) !important;
    padding: 4px 14px !important;
    color: #ffffff !important;
    background: var(--jewel-price-blue, #073ba7) !important;
    border-radius: 20px !important;
    font-size: 11px !important;
    font-weight: 700 !important;
    letter-spacing: 0.5px !important;
    white-space: nowrap !important;
    box-shadow: 0 4px 10px rgba(7, 59, 167, 0.25) !important;
}

.jewel-pricing-card-header {
    display: flex !important;
    justify-content: space-between !important;
    align-items: flex-start !important;
    gap: 8px !important;
    min-height: 54px !important;
    margin-bottom: 12px !important;
}

.jewel-pricing-plan-label {
    display: block !important;
    font-size: 10.5px !important;
    font-weight: 700 !important;
    letter-spacing: 0.5px !important;
    margin-bottom: 4px !important;
    color: #7c8aa4 !important;
    line-height: 1.2 !important;
    text-transform: uppercase !important;
}

.jewel-pricing-card-header h3 {
    font-size: 20px !important;
    font-weight: 700 !important;
    margin: 0 !important;
    color: #0c2043 !important;
    line-height: 1.2 !important;
}

.jewel-pricing-discount {
    flex-shrink: 0 !important;
    padding: 4px 8px !important;
    color: var(--jewel-price-blue, #073ba7) !important;
    background: #f0f5ff !important;
    border: 1px solid #d9e4ff !important;
    border-radius: 12px !important;
    font-size: 10.5px !important;
    font-weight: 700 !important;
    white-space: nowrap !important;
    display: inline-block !important;
    line-height: 1.2 !important;
}

.jewel-pricing-price-area {
    margin-bottom: 14px !important;
}

.jewel-pricing-old-price {
    min-height: 20px !important;
    margin-bottom: 2px !important;
    font-size: 14px !important;
    color: #8c9cb1 !important;
}

.jewel-pricing-old-price del {
    text-decoration: line-through !important;
    font-weight: 500 !important;
}

.jewel-pricing-price {
    display: flex !important;
    align-items: baseline !important;
    flex-wrap: nowrap !important;
    white-space: nowrap !important;
    line-height: 1.1 !important;
    color: #0b2048 !important;
}

.jewel-pricing-currency {
    font-size: 20px !important;
    font-weight: 700 !important;
    margin-right: 2px !important;
}

.jewel-pricing-price-value {
    font-size: 28px !important;
    font-weight: 800 !important;
    letter-spacing: -0.5px !important;
}

.jewel-pricing-period {
    font-size: 13px !important;
    margin-left: 4px !important;
    color: #6c7d97 !important;
    font-weight: 500 !important;
}

.jewel-pricing-savings {
    display: inline-block !important;
    margin: 6px 0 2px !important;
    padding: 3px 8px !important;
    background: #e8f7ee !important;
    color: #0f7b3e !important;
    border: 1px solid #c3e6cb !important;
    border-radius: 6px !important;
    font-size: 11.5px !important;
    font-weight: 700 !important;
    line-height: 1.3 !important;
}

.jewel-pricing-billing {
    font-size: 12px !important;
    color: #8391a8 !important;
    margin: 4px 0 0 !important;
    line-height: 1.4 !important;
}

.jewel-pricing-description {
    font-size: 13px !important;
    line-height: 1.45 !important;
    min-height: 52px !important;
    margin: 0 0 16px !important;
    color: #64748b !important;
}

.jewel-pricing-cta {
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    padding: 10px 14px !important;
    font-size: 13.5px !important;
    font-weight: 600 !important;
    border-radius: 10px !important;
    text-align: center !important;
    text-decoration: none !important;
    transition: all 0.25s ease !important;
}

.jewel-pricing-cta i {
    margin-left: 6px !important;
    font-size: 14px !important;
}

.jewel-pricing-trial-note {
    font-size: 11.5px !important;
    color: #718096 !important;
    margin-top: 6px !important;
    text-align: center !important;
    min-height: 18px !important;
}

.jewel-pricing-divider {
    margin: 14px 0 !important;
    border-top: 1px solid #eef2f6 !important;
}

.jewel-pricing-card h6 {
    font-size: 12.5px !important;
    font-weight: 700 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
    margin-bottom: 10px !important;
    color: #475569 !important;
}

.jewel-pricing-features {
    list-style: none !important;
    padding-left: 0 !important;
    margin-bottom: 0 !important;
    flex-grow: 1 !important;
}

.jewel-pricing-features li {
    font-size: 12.5px !important;
    line-height: 1.4 !important;
    padding: 5px 0 !important;
    color: #334155 !important;
    display: flex !important;
    align-items: flex-start !important;
    gap: 8px !important;
}

.jewel-pricing-features li i {
    color: #10b981 !important;
    font-size: 14px !important;
    flex-shrink: 0 !important;
    margin-top: 1px !important;
}
</style>

@php
    $staticPlans = [
        [
            'id' => 1,
            'name' => 'Basic',
            'plan_label' => 'FOR STARTERS',
            'is_featured' => false,
            'popular_badge_text' => null,
            'description' => 'Essential tools to create invoices, track basic inventory, and manage daily sales.',
            'monthly_price' => 999,
            'monthly_discount' => 20,
            'monthly_cut_price' => 1249,
            'monthly_savings' => 250,
            'monthly_billing_text' => 'Billed monthly',
            'yearly_price' => 8999,
            'yearly_discount' => 40,
            'yearly_cut_price' => 14999,
            'yearly_savings' => 6000,
            'yearly_billing_text' => 'Billed annually',
            'currency_symbol' => '₹',
            'button_text' => 'Start free trial',
            'button_link' => '#jewelSignupModal',
            'trial_note' => '30 days free · Cancel anytime',
            'features' => [
                'Unlimited invoices & estimates',
                'Basic inventory tracking',
                'Single branch & 1 staff account',
                'Email support & daily backups',
            ],
            'sort_order' => 1,
            'is_active' => true,
        ],
        [
            'id' => 2,
            'name' => 'Pro',
            'plan_label' => 'FOR GROWING JEWELLERS',
            'is_featured' => true,
            'popular_badge_text' => 'MOST POPULAR',
            'description' => 'Advanced inventory, barcode printing, and customer ledger for busy retail stores.',
            'monthly_price' => 2499,
            'monthly_discount' => 17,
            'monthly_cut_price' => 2999,
            'monthly_savings' => 500,
            'monthly_billing_text' => 'Billed monthly',
            'yearly_price' => 21999,
            'yearly_discount' => 39,
            'yearly_cut_price' => 35999,
            'yearly_savings' => 14000,
            'yearly_billing_text' => 'Billed annually',
            'currency_symbol' => '₹',
            'button_text' => 'Start free trial',
            'button_link' => '#jewelSignupModal',
            'trial_note' => '30 days free · Cancel anytime',
            'features' => [
                'Everything in Basic, plus:',
                'Barcode & RFID tag printing',
                'Customer ledger & reminders',
                'Metal rate auto-update',
                'Up to 3 branches & 5 staff',
                'Priority WhatsApp & phone support',
            ],
            'sort_order' => 2,
            'is_active' => true,
        ],
        [
            'id' => 3,
            'name' => 'Premium',
            'plan_label' => 'FOR MULTI-BRANCH SHOWROOMS',
            'is_featured' => false,
            'popular_badge_text' => null,
            'description' => 'Full-scale ERP with multi-store sync, worker loss calculation, and custom reports.',
            'monthly_price' => 4999,
            'monthly_discount' => 17,
            'monthly_cut_price' => 5999,
            'monthly_savings' => 1000,
            'monthly_billing_text' => 'Billed monthly',
            'yearly_price' => 44999,
            'yearly_discount' => 38,
            'yearly_cut_price' => 71999,
            'yearly_savings' => 27000,
            'yearly_billing_text' => 'Billed annually',
            'currency_symbol' => '₹',
            'button_text' => 'Start free trial',
            'button_link' => '#jewelSignupModal',
            'trial_note' => '30 days free · Cancel anytime',
            'features' => [
                'Everything in Pro, plus:',
                'Multi-branch live inventory sync',
                'Karigar job work & wastage',
                'Advanced GST & audit reports',
                'Up to 10 branches & unlimited staff',
                'Dedicated onboarding specialist',
            ],
            'sort_order' => 3,
            'is_active' => true,
        ],
        [
            'id' => 4,
            'name' => 'Enterprise',
            'plan_label' => 'FOR LARGE CHAINS',
            'is_featured' => false,
            'popular_badge_text' => null,
            'description' => 'Complete enterprise ERP solution with unlimited branches, custom integrations & 24/7 SLA.',
            'monthly_price' => 9999,
            'monthly_discount' => 17,
            'monthly_cut_price' => 12000,
            'monthly_savings' => 2001,
            'monthly_billing_text' => 'Billed monthly',
            'yearly_price' => 89999,
            'yearly_discount' => 25,
            'yearly_cut_price' => 120000,
            'yearly_savings' => 30001,
            'yearly_billing_text' => 'Billed annually',
            'currency_symbol' => '₹',
            'button_text' => 'Contact Sales',
            'button_link' => '#jewelSignupModal',
            'trial_note' => '30 days free · Dedicated setup',
            'features' => [
                'Everything in Premium, plus:',
                'Unlimited branches & users',
                'Custom ERP & API integrations',
                'Dedicated cloud server & 99.9% SLA',
                '24/7 dedicated account manager',
            ],
            'sort_order' => 4,
            'is_active' => true,
        ],
    ];

    $hasBackendPlans = isset($pricingPlans) && count($pricingPlans) > 0;
    $displayPlans = $hasBackendPlans ? $pricingPlans : json_decode(json_encode($staticPlans));
@endphp

<section id="plans" class="jewel-pricing-section">

    <div class="container jewel-pricing-container">

        <!-- Heading -->
        <div class="jewel-pricing-heading">
            <h1>
                {{ $pricingSettings->main_heading ?? 'The right plan to grow your' }}
                <span>{{ $pricingSettings->main_heading_highlight ?? 'jewellery business' }}</span>
            </h1>

            <p>
                {!! nl2br(e($pricingSettings->subheading ?? "Everything you need to bill faster, manage inventory, and make smarter decisions.\nStart free—no credit card required.")) !!}
            </p>

            <!-- Monthly / Yearly Toggle -->
            <div class="jewel-pricing-toggle-wrap">
                <div class="jewel-pricing-toggle" role="group" aria-label="Billing period">
                    <button type="button"
                            class="jewel-pricing-toggle-btn active"
                            data-period="monthly"
                            aria-pressed="true">
                        Monthly
                    </button>

                    <button type="button"
                            class="jewel-pricing-toggle-btn"
                            data-period="yearly"
                            aria-pressed="false">
                        Yearly
                        <small>{{ $pricingSettings->yearly_discount_badge ?? 'Save up to 41%' }}</small>
                    </button>
                </div>
            </div>
        </div>

        <!-- Pricing Cards -->
        <div class="row jewel-pricing-cards g-3">
            @foreach($displayPlans as $plan)
                <div class="col-12 col-sm-6 col-lg-3 jewel-pricing-column">
                    <article class="jewel-pricing-card {{ !empty($plan->is_featured) ? 'jewel-pricing-card-featured' : '' }}">

                        @if(!empty($plan->is_featured))
                            <div class="jewel-pricing-popular">
                                {{ !empty($plan->popular_badge_text) ? $plan->popular_badge_text : 'MOST POPULAR' }}
                            </div>
                        @endif

                        <div class="jewel-pricing-card-header">
                            <div>
                                @if(!empty($plan->plan_label))
                                    <span class="jewel-pricing-plan-label">
                                        {{ $plan->plan_label }}
                                    </span>
                                @endif
                                <h3>{{ $plan->name }}</h3>
                            </div>

                            @php
                                $mDisc = (int) ($plan->monthly_discount ?? 0);
                                $yDisc = (int) ($plan->yearly_discount ?? 0);
                                $mDiscText = $mDisc > 0 ? "{$mDisc}% OFF" : '';
                                $yDiscText = $yDisc > 0 ? "{$yDisc}% OFF" : '';
                            @endphp
                            <span class="jewel-pricing-discount"
                                  data-monthly="{{ $mDiscText }}"
                                  data-yearly="{{ $yDiscText }}"
                                  style="{{ empty($mDiscText) ? 'display:none;' : '' }}">
                                {{ $mDiscText }}
                            </span>
                        </div>

                        <div class="jewel-pricing-price-area">
                            @php
                                $sym = $plan->currency_symbol ?: '₹';
                                $mCutFormatted = ($plan->monthly_cut_price ?? 0) > ($plan->monthly_price ?? 0) ? $sym . number_format($plan->monthly_cut_price) : '';
                                $yCutFormatted = ($plan->yearly_cut_price ?? 0) > ($plan->yearly_price ?? 0) ? $sym . number_format($plan->yearly_cut_price) : '';
                                $mPriceFormatted = number_format($plan->monthly_price ?? 0);
                                $yPriceFormatted = number_format($plan->yearly_price ?? 0);
                                $mSaveFormatted = ($plan->monthly_savings ?? 0) > 0 ? 'You Save ' . $sym . number_format($plan->monthly_savings) : '';
                                $ySaveFormatted = ($plan->yearly_savings ?? 0) > 0 ? 'You Save ' . $sym . number_format($plan->yearly_savings) . '/-' : '';
                            @endphp

                            <div class="jewel-pricing-old-price" style="{{ empty($mCutFormatted) ? 'visibility:hidden;' : '' }}">
                                <del data-monthly="{{ $mCutFormatted }}" data-yearly="{{ $yCutFormatted }}">{{ $mCutFormatted }}</del>
                            </div>

                            <div class="jewel-pricing-price">
                                <span class="jewel-pricing-currency">{{ $sym }}</span><span
                                    data-monthly="{{ $mPriceFormatted }}"
                                    data-yearly="{{ $yPriceFormatted }}"
                                    class="jewel-pricing-price-value">{{ $mPriceFormatted }}</span>

                                <span class="jewel-pricing-period" data-monthly="/ month" data-yearly="/ year">/ month</span>
                            </div>

                            <p class="jewel-pricing-savings"
                               data-monthly="{{ $mSaveFormatted }}"
                               data-yearly="{{ $ySaveFormatted }}"
                               style="{{ empty($mSaveFormatted) ? 'display:none;' : '' }}">
                                {{ $mSaveFormatted }}
                            </p>

                            <p class="jewel-pricing-billing"
                               data-monthly="{{ $plan->monthly_billing_text ?: 'Billed monthly' }}"
                               data-yearly="{{ $plan->yearly_billing_text ?: 'Billed annually' }}">
                                {{ $plan->monthly_billing_text ?: 'Billed monthly' }}
                            </p>
                        </div>

                        @if(!empty($plan->description))
                            <p class="jewel-pricing-description">
                                {{ $plan->description }}
                            </p>
                        @endif

                        @php
                            $btnLink = $plan->button_link ?: '#jewelSignupModal';
                            $isModal = str_starts_with($btnLink, '#');
                        @endphp
                        <a href="{{ $btnLink }}"
                           class="jewel-pricing-cta {{ !empty($plan->is_featured) ? 'jewel-pricing-cta-primary' : 'jewel-pricing-cta-outline' }}"
                           @if($isModal) data-bs-toggle="modal" data-bs-target="{{ $btnLink }}" @endif>
                            <span>{{ $plan->button_text ?: 'Start free trial' }}</span>
                            <i class="bi bi-arrow-right"></i>
                        </a>

                        @if(!empty($plan->trial_note))
                            <p class="jewel-pricing-trial-note">
                                {{ $plan->trial_note }}
                            </p>
                        @endif

                        <div class="jewel-pricing-divider"></div>

                        <h6>What's included</h6>

                        <ul class="jewel-pricing-features">
                            @if(isset($plan->features) && (is_array($plan->features) || is_iterable($plan->features)))
                                @foreach($plan->features as $feature)
                                    <li><i class="bi bi-check-lg"></i> <span>{{ $feature }}</span></li>
                                @endforeach
                            @endif
                        </ul>

                    </article>
                </div>
            @endforeach
        </div>

        <!-- Bottom Benefits -->
        <div class="jewel-pricing-benefits">
            @if(isset($pricingSettings) && is_array($pricingSettings->bottom_benefits) && count($pricingSettings->bottom_benefits) > 0)
                @foreach($pricingSettings->bottom_benefits as $benefit)
                    <div><i class="bi bi-check-lg"></i> {{ $benefit }}</div>
                @endforeach
            @else
                <div><i class="bi bi-check-lg"></i> No setup fee</div>
                <div><i class="bi bi-check-lg"></i> Free data migration</div>
                <div><i class="bi bi-check-lg"></i> Friendly onboarding support</div>
            @endif
        </div>

    </div>

    <!-- Floating Help Button -->
    <a href="{{ url('/help') }}" class="jewel-pricing-help">
        <i class="bi bi-question-circle"></i>
        <span>Need help choosing?</span>
    </a>

</section>

<section class="pricing" data-reveal>
    <div class="container-fluid jewel-trial-container jewel-trial-banner">
        <div class="row align-items-center jewel-trial-row">

            <!-- Star Icon -->
            <div class="col-auto jewel-trial-icon-col">
                <div class="jewel-trial-icon" data-reveal>
                    <i class="bi bi-star-fill"></i>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col jewel-trial-content-col">
                <div class="jewel-trial-content">
                    <span class="jewel-trial-eyebrow" data-reveal>
                        {{ $pricingSettings->trial_eyebrow ?? 'A LITTLE ROOM TO EXPLORE' }}
                    </span>

                    <h2 class="jewel-trial-title" data-reveal>
                        {{ $pricingSettings->trial_title ?? 'Meet JewelERP for 30 days.' }}
                    </h2>

                    <p class="jewel-trial-description" data-reveal>
                        {{ $pricingSettings->trial_description ?? 'Try Professional with sample data—no credit card required.' }}
                    </p>
                </div>
            </div>

            <!-- Features -->
            <div class="col-auto jewel-trial-features-col">
                <ul class="jewel-trial-features">
                    @php
                        $trialFeatures = $pricingSettings->trial_features ?? [
                            'Full Professional features',
                            '1 branch · 3 users',
                            'Up to 500 products',
                            'Onboarding assistance',
                        ];
                    @endphp
                    @if(is_array($trialFeatures) && count($trialFeatures) > 0)
                        @foreach($trialFeatures as $tf)
                            <li>
                                <i class="bi bi-check-lg"></i>
                                <span>{{ $tf }}</span>
                            </li>
                        @endforeach
                    @else
                        <li><i class="bi bi-check-lg"></i><span>Full Professional features</span></li>
                        <li><i class="bi bi-check-lg"></i><span>1 branch · 3 users</span></li>
                        <li><i class="bi bi-check-lg"></i><span>Up to 500 products</span></li>
                        <li><i class="bi bi-check-lg"></i><span>Onboarding assistance</span></li>
                    @endif
                </ul>
            </div>

        </div>
    </div>
</section>





<section class="jewel-compare-section" data-reveal>

    <div class="container jewel-compare-container">

        <!-- Section Heading -->
        <div class="jewel-compare-heading">
            <span class="jewel-compare-eyebrow">{{ $pricingComparison->eyebrow ?? 'COMPARE PLANS' }}</span>

            <h1 data-reveal>{{ $pricingComparison->title ?? 'Find your perfect fit' }}</h1>

            <p>
                {{ $pricingComparison->description ?? 'All plans cover the essentials. Choose based on your team and reporting needs.' }}
            </p>
        </div>

        <!-- Comparison Table -->
        <div class="jewel-compare-table-wrapper">

            <table class="table jewel-compare-table mb-0">

                <thead>
                    <tr>
                        <th scope="col" class="jewel-compare-feature-heading">
                            {{ $pricingComparison->feature_heading ?? 'Feature' }}
                        </th>
                        @foreach($pricingPlans as $plan)
                            <th scope="col">{{ $plan->name }}</th>
                        @endforeach
                    </tr>
                </thead>

                <tbody>
                    @foreach(($pricingComparison->features ?? []) as $feature)
                        <tr>
                            <th scope="row">{{ $feature['label'] ?? '' }}</th>
                            @foreach($pricingPlans as $plan)
                                <td>{{ $feature['values'][$plan->id] ?? $feature['values'][Str::slug($plan->name)] ?? '—' }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>

            </table>

        </div>

    </div>

</section>


<section class="jewel-support-banner">
    <div class="container jewel-support-container">
        <div class="row jewel-support-row">

            <!-- Support Icon -->
            <div class="col-auto jewel-support-icon-wrap">
                <div class="jewel-support-icon">
                    <i class="bi bi-envelope"></i>
                </div>
            </div>

            <!-- Support Content -->
            <div class="col jewel-support-content">
                <span class="jewel-support-label">PERSONAL SUPPORT</span>

                <h2>Need Help? Our Support Team Is Here for You</h2>

                <p>
                    Have a question about JewelERP or need help finding the
                    right information? Let's talk.
                </p>

                <a href="{{ url('/contact') }}" class="jewel-support-btn">
                    <span>Contact Support</span>
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>

        </div>
    </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const toggleBtns = document.querySelectorAll(".jewel-pricing-toggle-btn");
    if (!toggleBtns.length) return;

    function setBillingPeriod(period) {
        toggleBtns.forEach(btn => {
            const isMatch = btn.getAttribute("data-period") === period;
            btn.classList.toggle("active", isMatch);
            btn.setAttribute("aria-pressed", isMatch ? "true" : "false");
        });

        const cards = document.querySelectorAll(".jewel-pricing-card");
        cards.forEach(card => {
            const dynamicEls = card.querySelectorAll("[data-monthly][data-yearly]");
            dynamicEls.forEach(el => {
                const targetValue = el.getAttribute("data-" + period);
                if (targetValue !== null) {
                    el.textContent = targetValue;

                    if (el.classList.contains("jewel-pricing-discount")) {
                        el.style.display = targetValue.trim() === "" ? "none" : "inline-block";
                    }
                    if (el.tagName.toLowerCase() === "del") {
                        const oldPriceWrap = el.closest(".jewel-pricing-old-price");
                        if (oldPriceWrap) {
                            oldPriceWrap.style.visibility = targetValue.trim() === "" ? "hidden" : "visible";
                        }
                    }
                    if (el.classList.contains("jewel-pricing-savings")) {
                        el.style.display = targetValue.trim() === "" ? "none" : "inline-block";
                    }
                }
            });
        });
    }

    toggleBtns.forEach(btn => {
        btn.addEventListener("click", function (e) {
            e.preventDefault();
            const period = this.getAttribute("data-period");
            if (period) {
                setBillingPeriod(period);
            }
        });
    });

    // Ensure default active state applies correctly on load
    const activeBtn = document.querySelector(".jewel-pricing-toggle-btn.active");
    setBillingPeriod(activeBtn ? activeBtn.getAttribute("data-period") : "monthly");
});
</script>

@include('invoice_front.includes.ai-tools')
@endsection