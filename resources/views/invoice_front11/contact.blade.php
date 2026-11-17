@extends('invoice_front.includes.app')
@section('content')

<section class="team-contact-section">
    <picture class="team-contact-background" aria-hidden="true">
        <source
            media="(max-width: 575.98px)"
            srcset="{{ asset('front_assets/img/contact-banner.jpg') }}">
        <img
            src="{{ asset('front_assets/img/contact-banner.png') }}"
            alt="">
    </picture>

    <div class="container-fluid team-contact-container">
        <div class="row">
            <div class="col-12">
                <div class="team-contact-content">

                    <h1 class="team-contact-title" data-reveal>
                        Get in Touch with Our Team
                    </h1>

                    <p class="team-contact-description" data-reveal>
                        Have questions? We're here to help. Reach out to our support team
                        and we'll get back to you<br class="team-contact-desktop-break">
                        as soon as possible.
                    </p>

                </div>
            </div>
        </div>
    </div>

</section>
<section class="jewel-contact-section ">
    <!-- Decorative shapes -->
    <div class="jewel-contact-decoration jewel-contact-decoration-top">
        <img src="{{ asset('front_assets/img/icons/4.svg') }}" alt="" aria-hidden="true">
    </div>
    <div class="jewel-contact-decoration jewel-contact-decoration-bottom">
        <img src="{{ asset('front_assets/img/icons/4.svg') }}" alt="" aria-hidden="true">
    </div>

    <div class="container-fluid jewel-contact-container">

        <!-- Section heading -->
        <div class="jewel-contact-heading" data-reveal>
            <h1>Let’s Start a Conversation</h1>

            <p data-reveal>
                Fill out the form and our team will get back to you within 24 hours.
                We're<br class="jewel-contact-desktop-break">
                excited to learn about your business!
            </p>
        </div>

        <div class="row g-4 jewel-contact-row">

            <!-- Why Choose Us -->
            <div class="col-12 col-md-6">
                <div class="jewel-contact-benefits">
                    <h4 data-reveal>Why Choose Us?</h4>

                    <ul data-reveal>
                        <li>Dedicated support team available 6 days a week</li>
                        <li>Free personalised demo for your business</li>
                        <li>7-day free trial with no credit card required</li>
                    </ul>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="col-12 col-md-6">
                <div class="jewel-contact-form-card">

                    <h4 data-reveal> Send us a Message</h4>

                    <form >
                        @csrf

                        <div class="jewel-contact-field">
                            <label for="contact_name">Full Name *</label>
                            <input type="text"
                                   id="contact_name"
                                   name="name"
                                   class="form-control"
                                   value="{{ old('name') }}"
                                   required>
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="jewel-contact-field">
                            <label for="contact_email">Email Address *</label>
                            <input type="email"
                                   id="contact_email"
                                   name="email"
                                   class="form-control"
                                   value="{{ old('email') }}"
                                   required>
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="jewel-contact-field">
                            <label for="contact_phone">Phone Number *</label>
                            <input type="tel"
                                   id="contact_phone"
                                   name="phone"
                                   class="form-control"
                                   value="{{ old('phone') }}"
                                   required>
                            @error('phone')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="jewel-contact-field">
                            <label for="contact_business">Business Name *</label>
                            <input type="text"
                                   id="contact_business"
                                   name="business"
                                   class="form-control"
                                   value="{{ old('business') }}"
                                   required>
                            @error('business')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="jewel-contact-field jewel-contact-message">
                            <label for="contact_message">Message *</label>
                            <textarea id="contact_message"
                                      name="message"
                                      class="form-control"
                                      rows="3"
                                      required>{{ old('message') }}</textarea>
                            @error('message')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <button type="submit"
                                class="btn jewel-contact-submit">
                            Send Message <span aria-hidden="true">➤</span>
                        </button>

                        <p class="jewel-contact-response-note">
                            We typically respond within 24 hours.
                        </p>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>
@include('invoice_front.includes.ai-tools')
@endsection 