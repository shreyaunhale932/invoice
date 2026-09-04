@include('invoice_front.includes.header')
@include('invoice_front.includes.menu')
<section class="contact-hero">
    <div class="contact-content contact-reveal">
        <h1 class="contact-title">
            Get in Touch with
            <span>Our Team</span>
        </h1>

        <p class="contact-desc">
            Have questions? We're here to help. Reach out to our support team and
            we'll get back to you as soon as possible.
        </p>
    </div>
</section>
<section class="contact-section">
    <div class="contact-wrapper">
        <!-- LEFT -->

        <div class="contact-left contact-left-reveal">
            <h2>
                Let's Start a<br />
                Conversation
            </h2>

            <p>
                Fill out the form and our team will get back to you within 24
                hours. We're excited to learn about your business!
            </p>

            <!-- OFFICE -->

            <div class="office-box">
                <div class="office-icon">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0L6.343 16.657a8 8 0 1111.314 0z" />

                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>

                <!-- <div class="office-info">
                    <h4>Mumbai Office</h4>

                    <span> 123 Zaveri Bazaar, Fort, Mumbai - 400001 </span>
                </div> -->
            </div>

            <!-- WHY BOX -->

            <div class="why-box">
                <h3>Why Choose Us?</h3>

                <div class="why-list">
                    <div class="why-item">
                        <div class="dot"></div>
                        <span>Dedicated support team available 6 days a week</span>
                    </div>

                    <div class="why-item">
                        <div class="dot"></div>
                        <span>Free personalized demo for your business</span>
                    </div>

                    <div class="why-item">
                        <div class="dot"></div>
                        <span>7-day free trial with no credit card required</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- RIGHT -->

        <div class="contact-card contact-card-reveal">
            <h3>Send us a Message</h3>

            <form action="{{ route('contact.store') }}" method="POST">
                @csrf
                <!-- NAME -->

                <div class="form-group">
                    <label>Full Name *</label>

                    <div class="input-box">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M15.8327 17.5V15.8333C15.8327 14.9493 15.4815 14.1014 14.8564 13.4763C14.2312 12.8512 13.3834 12.5 12.4993 12.5H7.49935C6.61529 12.5 5.76745 12.8512 5.14233 13.4763C4.5172 14.1014 4.16602 14.9493 4.16602 15.8333V17.5"
                                stroke="#99A1AF" stroke-width="1.66667" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path
                                d="M9.99935 9.16667C11.8403 9.16667 13.3327 7.67428 13.3327 5.83333C13.3327 3.99238 11.8403 2.5 9.99935 2.5C8.1584 2.5 6.66602 3.99238 6.66602 5.83333C6.66602 7.67428 8.1584 9.16667 9.99935 9.16667Z"
                                stroke="#99A1AF" stroke-width="1.66667" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>

                        <input type="text" name="full_name" class="form-control" required>
                    </div>
                </div>

                <!-- EMAIL -->

                <div class="form-group">
                    <label>Email Address *</label>

                    <div class="input-box">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8m-18 9h18V7H3v10z" />
                        </svg>

                        <input type="email" name="email" class="form-control" required>
                    </div>
                </div>

                <!-- PHONE -->

                <div class="form-group">
                    <label>Phone Number *</label>

                    <div class="input-box">
                        <svg width="19" height="19" viewBox="0 0 19 19" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M17.4074 13.2654V15.7654C17.4084 15.9975 17.3608 16.2273 17.2678 16.4399C17.1749 16.6525 17.0385 16.8434 16.8675 17.0003C16.6965 17.1572 16.4946 17.2767 16.2747 17.351C16.0549 17.4254 15.8219 17.453 15.5907 17.4321C13.0264 17.1535 10.5632 16.2772 8.39908 14.8738C6.3856 13.5943 4.67853 11.8873 3.39908 9.87378C1.99073 7.69978 1.11428 5.22461 0.840748 2.64878C0.819924 2.41833 0.847311 2.18608 0.921165 1.9668C0.99502 1.74752 1.11372 1.54602 1.26972 1.37513C1.42572 1.20424 1.61559 1.0677 1.82724 0.974214C2.0389 0.880724 2.2677 0.83233 2.49908 0.832112H4.99908C5.4035 0.828132 5.79557 0.971344 6.10222 1.23506C6.40886 1.49877 6.60915 1.86498 6.66575 2.26545C6.77127 3.0655 6.96696 3.85105 7.24908 4.60711C7.3612 4.90538 7.38547 5.22954 7.319 5.54118C7.25254 5.85282 7.09813 6.13887 6.87408 6.36545L5.81575 7.42378C7.00204 9.51007 8.72946 11.2375 10.8157 12.4238L11.8741 11.3654C12.1007 11.1414 12.3867 10.987 12.6983 10.9205C13.01 10.8541 13.3341 10.8783 13.6324 10.9904C14.3885 11.2726 15.174 11.4683 15.9741 11.5738C16.3789 11.6309 16.7486 11.8348 17.0129 12.1467C17.2771 12.4586 17.4176 12.8568 17.4074 13.2654Z"
                                stroke="#99A1AF" stroke-width="1.66667" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>

                        <input type="text" name="phone" class="form-control" required>
                    </div>
                </div>

                <!-- BUSINESS -->

                <div class="form-group">
                    <label>Business Name</label>

                    <div class="input-box">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M15.0007 1.66797H5.00065C4.08018 1.66797 3.33398 2.41416 3.33398 3.33464V16.668C3.33398 17.5884 4.08018 18.3346 5.00065 18.3346H15.0007C15.9211 18.3346 16.6673 17.5884 16.6673 16.668V3.33464C16.6673 2.41416 15.9211 1.66797 15.0007 1.66797Z"
                                stroke="#99A1AF" stroke-width="1.66667" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M7.5 18.3333V15H12.5V18.3333" stroke="#99A1AF" stroke-width="1.66667"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M6.66602 5H6.67435" stroke="#99A1AF" stroke-width="1.66667" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M13.334 5H13.3423" stroke="#99A1AF" stroke-width="1.66667" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M10 5H10.0083" stroke="#99A1AF" stroke-width="1.66667" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M10 8.33203H10.0083" stroke="#99A1AF" stroke-width="1.66667" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M10 11.668H10.0083" stroke="#99A1AF" stroke-width="1.66667"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M13.334 8.33203H13.3423" stroke="#99A1AF" stroke-width="1.66667"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M13.334 11.668H13.3423" stroke="#99A1AF" stroke-width="1.66667"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M6.66602 8.33203H6.67435" stroke="#99A1AF" stroke-width="1.66667"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M6.66602 11.668H6.67435" stroke="#99A1AF" stroke-width="1.66667"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>

                        <input type="text" class="form-control" name="business_name" placeholder="Kumar Jewellers" />
                    </div>
                </div>

                <!-- MESSAGE -->

                <div class="form-group">
                    <label>Message *</label>

                    <div class="input-box">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="2" style="top: 24px; transform: none">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8 10h8m-8 4h5m7 5l-3.586-3.586A2 2 0 0115.586 14H6a2 2 0 01-2-2V6a2 2 0 012-2h12a2 2 0 012 2v12z" />
                        </svg>

                        <textarea name="message" class="form-control" required></textarea>
                    </div>
                </div>

                <!-- BUTTON -->

                <button type="submit" class="submit-btn">
                    Send Message

                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_920_956)">
                            <path
                                d="M12.1125 18.0711C12.1442 18.15 12.1992 18.2174 12.2702 18.2641C12.3413 18.3108 12.4249 18.3347 12.5099 18.3325C12.5949 18.3303 12.6772 18.3022 12.7457 18.2519C12.8143 18.2016 12.8658 18.1316 12.8934 18.0511L18.31 2.21781C18.3367 2.14397 18.3418 2.06406 18.3247 1.98744C18.3076 1.91081 18.2691 1.84064 18.2135 1.78513C18.158 1.72961 18.0879 1.69106 18.0112 1.67397C17.9346 1.65688 17.8547 1.66197 17.7809 1.68864L1.94752 7.10531C1.8671 7.13289 1.79704 7.18441 1.74675 7.25295C1.69645 7.3215 1.66833 7.40379 1.66615 7.48878C1.66398 7.57377 1.68785 7.65739 1.73457 7.72842C1.78129 7.79945 1.84862 7.85448 1.92752 7.88614L8.53585 10.5361C8.74476 10.6198 8.93456 10.7449 9.09382 10.9038C9.25309 11.0628 9.3785 11.2524 9.46252 11.4611L12.1125 18.0711Z"
                                stroke="white" stroke-width="1.66667" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M18.2124 1.78906L9.0957 10.9049" stroke="white" stroke-width="1.66667"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </g>
                        <defs>
                            <clipPath id="clip0_920_956">
                                <rect width="20" height="20" fill="white" />
                            </clipPath>
                        </defs>
                    </svg>
                </button>

                <div class="reply-note">
                    We typically respond within 24 hours
                </div>
            </form>
        </div>
    </div>
</section>

@include('invoice_front.includes.footer')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Success!',
    text: '{{ session("success") }}',
    confirmButtonColor: '#3085d6'
});
</script>
@endif
