@extends('invoice_front.includes.app')
@section('content')
<section class="jewel-checkout-page">
    <div class="container-fluid jewel-checkout-container">

        <!-- Page Heading -->
        <div class="jewel-checkout-heading">
            <h1>Complete your purchase</h1>
            <p>Review your selected plan and billing information before proceeding.</p>
        </div>

        <div class="row g-5 align-items-start">

            <!-- LEFT: Plan and Billing -->
            <div class="col-12 col-lg-7">

                <!-- Selected Plan Card -->
                <div class="jewel-checkout-card jewel-plan-card">

                    <div class="jewel-step-heading">
                        <span class="jewel-step-number">01</span>
                        <div>
                            <h2>Selected plan</h2>
                            <p>Your package and billing cycle</p>
                        </div>
                    </div>

                    <div class="jewel-plan-details">
                        <div class="d-flex justify-content-between align-items-start gap-2">
                            <div>
                                <h3>JewelERP Professional Plan</h3>
                                <p>Complete jewelry business management solution.</p>
                            </div>

                            <a href="{{ url('pricing#plans') }}" class="jewel-change-plan">
                                Change Plan
                            </a>
                        </div>

                        <div class="jewel-plan-tags">
                            <span>Annual billing</span>
                            <span>10 users included</span>
                        </div>

                        <div class="row g-2 jewel-plan-features">
                            <div class="col-12 col-sm-4">
                                <span>◉ &nbsp; Karigar & job work</span>
                            </div>
                            <div class="col-12 col-sm-4">
                                <span>◉ &nbsp; Old-gold exchange</span>
                            </div>
                            <div class="col-12 col-sm-4">
                                <span>◉ &nbsp; Advanced MIS &amp; CRM </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Billing Details Card -->
                <div class="jewel-checkout-card jewel-billing-card">

                    <div class="jewel-step-heading">
                        <span class="jewel-step-number">02</span>
                        <div>
                            <h2>Billing details</h2>
                            <p>Used for your invoice and account</p>
                        </div>
                    </div>

                    <form action="#" method="POST" id="jewelBillingForm">
                        @csrf

                        <div class="row g-3">

                            <div class="col-12 col-md-6">
                                <label for="company_name" class="jewel-form-label">
                                    Business / company name *
                                </label>
                                <input type="text" id="company_name"
                                       name="company_name"
                                       class="form-control jewel-form-control"
                                       placeholder="e.g. Mehta Jewellers" required>
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="contact_person" class="jewel-form-label">
                                    Contact person *
                                </label>
                                <input type="text" id="contact_person"
                                       name="contact_person"
                                       class="form-control jewel-form-control"
                                       placeholder="Full name" required>
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="email" class="jewel-form-label">
                                    Email address *
                                </label>
                                <input type="email" id="email" name="email"
                                       class="form-control jewel-form-control"
                                       placeholder="you@business.com" required>
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="mobile" class="jewel-form-label">
                                    Mobile number *
                                </label>
                                <input type="tel" id="mobile" name="mobile"
                                       class="form-control jewel-form-control"
                                       placeholder="+91 98765 43210"
                                       pattern="[0-9+\s()-]{7,20}" required>
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="gstin" class="jewel-form-label">
                                    GSTIN (optional)
                                </label>
                                <input type="text" id="gstin" name="gstin"
                                       class="form-control jewel-form-control"
                                       placeholder="15-character GSTIN"
                                       maxlength="15">
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="country" class="jewel-form-label">
                                    Country *
                                </label>
                                <select id="country" name="country"
                                        class="form-select jewel-form-control" required>
                                    <option value="India" selected>India</option>
                                    <option value="United States">United States</option>
                                    <option value="United Kingdom">United Kingdom</option>
                                    <option value="United Arab Emirates">United Arab Emirates</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <label for="address" class="jewel-form-label">
                                    Billing address *
                                </label>
                                <textarea id="address" name="address"
                                          class="form-control jewel-form-control"
                                          rows="2"
                                          placeholder="Street address, building, area"
                                          required></textarea>
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="city" class="jewel-form-label">
                                    City *
                                </label>
                                <input type="text" id="city" name="city"
                                       class="form-control jewel-form-control"
                                       placeholder="Enter city" required>
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="state" class="jewel-form-label">
                                    State / region *
                                </label>
                                <select id="state" name="state"
                                        class="form-select jewel-form-control" required>
                                    <option value="">Select state</option>
                                    <option>Andhra Pradesh</option>
                                    <option>Delhi</option>
                                    <option>Gujarat</option>
                                    <option>Karnataka</option>
                                    <option>Kerala</option>
                                    <option>Maharashtra</option>
                                    <option>Rajasthan</option>
                                    <option>Tamil Nadu</option>
                                    <option>Telangana</option>
                                    <option>Uttar Pradesh</option>
                                    <option>West Bengal</option>
                                    <option>Other</option>
                                </select>
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="pincode" class="jewel-form-label">
                                    PIN code *
                                </label>
                                <input type="text" id="pincode" name="pincode"
                                       class="form-control jewel-form-control"
                                       placeholder="Enter PIN code"
                                       inputmode="numeric" required>
                            </div>

                            <div class="col-12">
                                <label class="jewel-billing-checkbox">
                                    <input type="checkbox" name="same_address"
                                           value="1" checked>
                                    <span>My billing address is the same as my business address.</span>
                                </label>
                            </div>

                        </div>
                    </form>
                </div>
            </div>

            <!-- RIGHT: Order Summary -->
            <div class="col-12 col-lg-5">
                <aside class="jewel-checkout-card jewel-order-card">

                    <div class="jewel-order-heading">
                        <h2>Order summary</h2>
                        <span class="jewel-secure-label">◉ Secure</span>
                    </div>

                    <div class="jewel-order-plan">
                        <span>JewelERP Professional</span>
                        <span class="jewel-order-plan-term">Annual</span>
                    </div>

                    <div class="jewel-order-row">
                        <span>Plan price (12 months)</span>
                        <strong>35,988</strong>
                    </div>

                    <div class="jewel-order-row">
                        <span>Annual discount</span>
                        <strong class="jewel-discount">-₹5,989</strong>
                    </div>

                    <div class="jewel-order-row">
                        <span>Subtotal</span>
                        <strong>29,999</strong>
                    </div>

                    <div class="jewel-order-row">
                        <span>GST (18%)</span>
                        <strong>₹5,399.82</strong>
                    </div>

                    <div class="jewel-order-total">
                        <div>
                            <h3>Total due</h3>
                            <p>Incl. applicable GST</p>
                        </div>
                        <strong>₹6000</strong>
                    </div>

                    <button type="submit" form="jewelBillingForm"
                            class="btn jewel-checkout-button">
                        Proceed to Checkout
                    </button>

                    <div class="jewel-order-security">
                        <span><i class="fa-solid fa-lock" aria-hidden="true"></i> Secure payment processing</span>
                        <span><i class="fa-solid fa-shield-halved" aria-hidden="true"></i>Your business information is secure.</span>
                    </div>

                    <p class="jewel-order-terms">
                      By continuing, you acknowledge JewelERP’s
                        <a href="{{ url('/terms') }}">Terms &amp; Conditions</a>
                        and <a href="{{ url('/privacy') }}">Privacy Policy</a>.
                    </p>

                    <p class="jewel-order-footer">
                       Plan pricing shown for review. Payment is not yet connected.
                    </p>

                </aside>
            </div>

        </div>
    </div>
</section>

@endsection