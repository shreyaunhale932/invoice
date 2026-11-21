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
.jewel-pricing-savings {
    display: inline-block !important;
    margin: 8px 0 4px !important;
    padding: 4px 10px !important;
    background: #e8f7ee !important;
    color: #0f7b3e !important;
    border: 1px solid #c3e6cb !important;
    border-radius: 6px !important;
    font-size: 13px !important;
    font-weight: 700 !important;
    line-height: 1.3 !important;
}
.jewel-pricing-discount {
    visibility: visible !important;
    display: inline-block !important;
}
</style>

<section id="plans" class="jewel-pricing-section">

    <div class="container jewel-pricing-container">

        <!-- Heading -->
        <div class="jewel-pricing-heading">
            <h1>
                The right plan to grow your
                <span>jewellery business</span>
            </h1>

            <p>
                Everything you need to bill faster, manage inventory, and make smarter decisions.
                <br>
                Start free—no credit card required.
            </p>

            <!-- Monthly / Yearly Toggle -->
            <div class="jewel-pricing-toggle-wrap">
               <div class="jewel-pricing-toggle" role="group"
     aria-label="Billing period">

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
        <small>Save up to 41%</small>
    </button>

</div>
            </div>
        </div>

        <!-- Pricing Cards -->
        <div class="row jewel-pricing-cards g-3">

            <!-- BASIC PLAN -->
            <div class="col-12 col-md-4 jewel-pricing-column">

                <article class="jewel-pricing-card">

                    <div class="jewel-pricing-card-header">
                        <div>
                            <span class="jewel-pricing-plan-label">
                             For small jewellery shops
                            </span>
                            <h3>Basic</h3>
                        </div>

                        <span class="jewel-pricing-discount" data-monthly="16% OFF" data-yearly="41% OFF">16% OFF</span>
                    </div>

                    <div class="jewel-pricing-price-area">
                        <div class="jewel-pricing-old-price">
                            <del data-monthly="₹3,000" data-yearly="₹50,000">₹3,000</del>
                        </div>

                        <div class="jewel-pricing-price">
                            <span class="jewel-pricing-currency">₹</span><span
                                data-monthly="2,520"
                                data-yearly="29,500"
                                class="jewel-pricing-price-value">2,520</span>

                            <span class="jewel-pricing-period" data-monthly="/ month" data-yearly="/ year">/ month</span>
                        </div>

                        <p class="jewel-pricing-savings" data-monthly="You Save ₹480 " data-yearly="You Save ₹20,500/- ">You Save ₹480 </p>

                        <p class="jewel-pricing-billing" data-monthly="Billed monthly" data-yearly="Billed annually">
                            Billed monthly
                        </p>
                    </div>

                    <p class="jewel-pricing-description">
                        Essential billing and inventory tools to run your
                        jewellery store with confidence.
                    </p>

                    <a href="#jewelSignupModal"
                       class="jewel-pricing-cta jewel-pricing-cta-outline"data-bs-toggle="modal"
                   data-bs-target="#jewelSignupModal">
                        Start free trial
                        <i class="bi bi-arrow-right"></i>
                    </a>

                    <p class="jewel-pricing-trial-note">
                        30 days free · Cancel anytime
                    </p>

                    <div class="jewel-pricing-divider"></div>

                    <h6>What's included</h6>

                    <ul class="jewel-pricing-features">
                        <li><i class="bi bi-check-lg"></i> Inventory & tag management</li>
                        <li><i class="bi bi-check-lg"></i> GST billing</li>
                        <li><i class="bi bi-check-lg"></i> Barcode printing</li>
                        
                    </ul>

                </article>
            </div>

            <!-- PRO PLAN -->
            <div class="col-12 col-md-4 jewel-pricing-column">

                <article class="jewel-pricing-card jewel-pricing-card-featured">

                    <div class="jewel-pricing-popular">
                        MOST POPULAR
                    </div>

                    <div class="jewel-pricing-card-header">
                        <div>
                            <span class="jewel-pricing-plan-label">
                                FOR GROWING BUSINESSES
                            </span>
                            <h3>Pro</h3>
                        </div>

                        <span class="jewel-pricing-discount" data-monthly="16% OFF" data-yearly="29% OFF">16% OFF</span>
                    </div>

                    <div class="jewel-pricing-price-area">
                        <div class="jewel-pricing-old-price">
                            <del data-monthly="₹5,000" data-yearly="₹70,000">₹5,000</del>
                        </div>

                        <div class="jewel-pricing-price">
                            <span class="jewel-pricing-currency">₹</span><span
                                data-monthly="4,200"
                                data-yearly="49,700"
                                class="jewel-pricing-price-value">4,200</span>

                            <span class="jewel-pricing-period" data-monthly="/ month" data-yearly="/ year">/ month</span>
                        </div>

                        <p class="jewel-pricing-savings" data-monthly="You Save ₹800/-" data-yearly="You Save ₹20,300/-">You Save ₹800/- with 16% Off</p>

                        <p class="jewel-pricing-billing" data-monthly="Billed monthly" data-yearly="Billed annually">
                            Billed monthly
                        </p>
                    </div>

                    <p class="jewel-pricing-description">
                        Faster billing, smart automation, and better controls
                        as your business grows.
                    </p>

                    <a href="#jewelSignupModal"
                       class="jewel-pricing-cta jewel-pricing-cta-primary" data-bs-toggle="modal"
                   data-bs-target="#jewelSignupModal">
                        Start 30-day free trial
                        <i class="bi bi-arrow-right"></i>
                    </a>

                    <p class="jewel-pricing-trial-note">
                        30 days free · Cancel anytime
                    </p>

                    <div class="jewel-pricing-divider"></div>

                    <h6>What's included</h6>

                    <ul class="jewel-pricing-features">
                        <li><i class="bi bi-check-lg"></i> Karigar & old-gold workflows</li>
                        <li><i class="bi bi-check-lg"></i>  CRM, schemes & loyalty</li>
                        <li><i class="bi bi-check-lg"></i> Advanced MIS reports</li>
                       
                    </ul>

                </article>
            </div>

            <!-- PREMIUM PLAN -->
            <div class="col-12 col-md-4 jewel-pricing-column">

                <article class="jewel-pricing-card">

                    <div class="jewel-pricing-card-header">
                        <div>
                            <span class="jewel-pricing-plan-label">
                                FOR ESTABLISHED TEAMS
                            </span>
                            <h3>Premium</h3>
                        </div>

                        <span class="jewel-pricing-discount" data-monthly="11% OFF" data-yearly="23% OFF">11% OFF</span>
                    </div>

                    <div class="jewel-pricing-price-area">
                        <div class="jewel-pricing-old-price">
                            <del data-monthly="₹7,000" data-yearly="₹90,000">₹7,000</del>
                        </div>

                        <div class="jewel-pricing-price">
                            <span class="jewel-pricing-currency">₹</span><span
                                data-monthly="6,230"
                                data-yearly="69,300"
                                class="jewel-pricing-price-value">6,230</span>

                            <span class="jewel-pricing-period" data-monthly="/ month" data-yearly="/ year">/ month</span>
                        </div>

                        <p class="jewel-pricing-savings" data-monthly="You Save ₹770/-" data-yearly="You Save ₹20,700/-">You Save ₹770/-</p>

                        <p class="jewel-pricing-billing" data-monthly="Billed monthly" data-yearly="Billed annually">
                            Billed monthly
                        </p>
                    </div>

                    <p class="jewel-pricing-description">
                        Complete operational control with powerful reporting
                        and priority assistance.
                    </p>

                    <a href="#jewelSignupModal"
                       class="jewel-pricing-cta jewel-pricing-cta-outline" data-bs-toggle="modal"
                   data-bs-target="#jewelSignupModal">
                        Choose Premium
                        <i class="bi bi-arrow-right"></i>
                    </a>

                    <p class="jewel-pricing-trial-note">
                        30 days free · Cancel anytime
                    </p>

                    <div class="jewel-pricing-divider"></div>

                    <h6>What's included</h6>

                    <ul class="jewel-pricing-features">
                        <li><i class="bi bi-check-lg"></i> Centralized multi-branch control</li>
                        <li><i class="bi bi-check-lg"></i>Manufacturing & integrations</li>
                        <li><i class="bi bi-check-lg"></i> Dedicated account manager</li>
                       
                    </ul>

                </article>
            </div>

        </div>

        <!-- Bottom Benefits -->
        <div class="jewel-pricing-benefits">
            <div><i class="bi bi-check-lg"></i> No setup fee</div>
            <div><i class="bi bi-check-lg"></i> Free data migration</div>
            <div><i class="bi bi-check-lg"></i> Friendly onboarding support</div>
        </div>

    </div>

    <!-- Floating Help Button -->
    <!-- <a href="{{ url('/contact') }}" class="jewel-pricing-help">
        <i class="bi bi-question-circle"></i>
        <span>Need help choosing?</span>
    </a> -->

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
                        A LITTLE ROOM TO EXPLORE
                    </span>

                    <h2 class="jewel-trial-title" data-reveal>
                        Meet JewelERP for 30 days.
                    </h2>

                    <p class="jewel-trial-description" data-reveal>
                        Try Professional with sample data—no credit card required.
                    </p>
                </div>
            </div>

            <!-- Features -->
            <div class="col-auto jewel-trial-features-col">
                <ul class="jewel-trial-features">
                    <li>
                        <i class="bi bi-check-lg"></i>
                        <span>Full Professional features</span>
                    </li>
                    <li>
                        <i class="bi bi-check-lg"></i>
                        <span>1 branch · 3 users</span>
                    </li>
                    <li>
                        <i class="bi bi-check-lg"></i>
                        <span>Up to 500 products</span>
                    </li>
                    <li>
                        <i class="bi bi-check-lg"></i>
                        <span>Onboarding assistance</span>
                    </li>
                </ul>
            </div>

            <!-- CTA Button -->
            <div class="col-auto jewel-trial-button-col">
                <a href="#plans" class="jewel-trial-button">
                    <span>Find Your Plan</span>
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>

        </div>
    </div>
</section>





<section class="jewel-compare-section" data-reveal>

    <div class="container jewel-compare-container">

        <!-- Section Heading -->
        <div class="jewel-compare-heading">
            <span class="jewel-compare-eyebrow">COMPARE PLANS</span>

            <h1 data-reveal>Find your perfect fit</h1>

            <p>
                All plans cover the essentials. Choose based on your team and reporting needs.
            </p>
        </div>

        <!-- Comparison Table -->
        <div class="jewel-compare-table-wrapper">

            <table class="table jewel-compare-table mb-0">

                <thead>
                    <tr>
                        <th scope="col" class="jewel-compare-feature-heading">
                            Feature
                        </th>
                        <th scope="col">Basic</th>
                        <th scope="col">Pro</th>
                        <th scope="col">Premium</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <th scope="row">Invoices per month</th>
                        <td>Unlimited</td>
                        <td>Unlimited</td>
                        <td>Unlimited</td>
                    </tr>

                    <tr>
                        <th scope="row">Team members</th>
                        <td>1</td>
                        <td>3</td>
                        <td>Up to 10</td>
                    </tr>

                    <tr>
                        <th scope="row">Inventory alerts</th>
                        <td>—</td>
                        <td>Included</td>
                        <td>Included</td>
                    </tr>

                    <tr>
                        <th scope="row">Advanced reports</th>
                        <td>—</td>
                        <td>Included</td>
                        <td>Included</td>
                    </tr>

                    <tr>
                        <th scope="row">Multi-branch overview</th>
                        <td>—</td>
                        <td>—</td>
                        <td>Included</td>
                    </tr>

                    <tr>
                        <th scope="row">Support</th>
                        <td>Standard</td>
                        <td>Priority</td>
                        <td>Dedicated</td>
                    </tr>
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