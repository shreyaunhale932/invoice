@include('invoice_front.includes.header')
@include('invoice_front.includes.menu')
<section class="hero">

    <!-- <div class="leftOverlay"></div> -->

    <div class="heroWrap">

        <!-- LEFT -->
        <div class="heroLeft">
            <div class="heroBadge">
                <span class="heroBadgeDot"></span>
                Trusted by 500+ Jewellery Businesses
            </div>

           <h1 class="heroTitle">
    The Future of<br>

    <span class="gradientLine ">Jewellery</span><br>

    <span class="gradientLine underline">Business</span><br>

    Management
</h1>

            <p>
                Revolutionary software that transforms how you manage billing, inventory, and customers. Built exclusively for modern jewellery businesses.
            </p>

            <div class="btns">
                <a href="{{ route('pricing') }}#plans" class="btn btnPrimary" href="javascript:void(0)" class="login" >
                  Start Free Trial
                  <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M4.16602 10H15.8327" stroke="#101828" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M10 4.16797L15.8333 10.0013L10 15.8346" stroke="#101828" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
</a>
                <a href="#" class="btn btnSecondary">▶ Watch Demo</a>
            </div>

            <div class="heroStats">
                <div><strong>500+</strong><br><small>Active Users</small></div>
                <div><strong>50K+</strong><br><small>Transactions Processed</small></div>
                <div><strong>99.9%</strong><br><small>Uptime</small></div>
            </div>

        </div>

        <!-- HERO RIGHT DASHBOARD (No Image Required) -->
        <div class="heroRight">

            <!-- Floating Paid Badge -->
            <div class="paidBadge">
                <span class="paidIcon">✓</span>
                Invoice #1250 Paid
            </div>

            <!-- Main Dashboard Card -->
            <div class="dashboardCard">

                <!-- Top Stats -->
                <div class="statsGrid">

                    <div class="statBox sales">
                        <div class="statLabel"><img src="{{ asset('front_assets/img/icons/i1.svg') }}"> Total Sales</div>
                        <h3>₹12.5L</h3>
                        <p>+23% this month</p>
                    </div>

                    <div class="statBox stock">
                        <div class="statLabel"><img src="{{  asset('front_assets/img/icons/i2.svg') }}"> Gold Stock</div>
                        <h3>2.4kg</h3>
                        <p>Available</p>
                    </div>

                    <div class="statBox invoices">
                        <div class="statLabel"><img src="{{ asset('front_assets/img/icons/i3.svg') }}"> Invoices</div>
                        <h3>1,249</h3>
                        <p>This year</p>
                    </div>

                </div>

                <!-- Recent Invoices -->
                <h4 class="invoiceTitle">Recent Invoices</h4>

                <div class="invoiceList">

                    <div class="invoiceItem">
                        <div class="invoiceLeft">
                            <div class="invoiceIcon"><img src="{{ asset('front_assets/img/icons/file.svg') }}"></div>
                            <div>
                                <h5>INV-1247</h5>
                                <span>Rajesh Kumar</span>
                            </div>
                        </div>
                        <div class="invoiceRight">
                            <strong>₹45,670</strong>
                            <span class="paid">paid</span>
                        </div>
                    </div>

                    <div class="invoiceItem">
                        <div class="invoiceLeft">
                            <div class="invoiceIcon"><img src="{{ asset('front_assets/img/icons/file.svg') }}"></div>
                            <div>
                                <h5>INV-1248</h5>
                                <span>Priya Sharma</span>
                            </div>
                        </div>
                        <div class="invoiceRight">
                            <strong>₹89,240</strong>
                            <span class="pending">pending</span>
                        </div>
                    </div>

                    <div class="invoiceItem">
                        <div class="invoiceLeft">
                            <div class="invoiceIcon"><img src="{{ asset('front_assets/img/icons/file.svg') }}"></div>
                            <div>
                                <h5>INV-1249</h5>
                                <span>Amit Patel</span>
                            </div>
                        </div>
                        <div class="invoiceRight">
                            <strong>₹1,23,500</strong>
                            <span class="paid">paid</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

</section>

<section class="aboutSectionExact">
    <div class="aboutContainer">

        <!-- LEFT SIDE -->
        <div class="aboutLeftExact">

            <!-- Main Illustration Card -->
            <div class="aboutImageCardExact">
                <img src="{{ asset('front_assets/img/aboutimg.png') }}" alt="Jewellery Business">
            </div>

            <!-- Floating Testimonial Card -->
            <div class="aboutQuoteCardExact">
                <div class="quoteMark"><img src="{{ asset('front_assets/img/icons/quama.svg') }}"></div>

                <p class="quoteText">
                    "This software transformed how we manage our
                    inventory. We save 10+ hours every week!"
                </p>

                <div class="quoteUserExact">
                    <div class="quoteAvatarExact">MK</div>
                    <div>
                        <h5>Manoj Kumar</h5>
                        <span>Gold House, Mumbai</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- RIGHT SIDE -->
        <div class="aboutRightExact">

            <!-- Top Badge -->
            <div class="aboutBadgeExact">
                <span class="badgeStar"><img src="{{ asset('front_assets/img/icons/heart.svg') }}"></span>
                Built with Care for Jewellers
            </div>

            <!-- Main Heading -->
            <h2 class="aboutTitleExact">
                We Understand<br>
                Your Business
            </h2>

            <!-- Description -->
            <p class="aboutTextExact">
                Running a jewellery business comes with unique challenges –
                from tracking precious metals and gemstones to managing
                complex invoicing with making charges and purity
                calculations. We've built a solution that understands these
                intricacies and makes your daily operations seamless.
            </p>

            <!-- Feature Card 1 -->
            <div class="featureCardExact featureBlue">
                <div class="featureIconExact iconBlue"><img src="{{ asset('front_assets/img/icons/a1.svg') }}"></div>
                <div>
                    <h4>Purpose-Built Technology</h4>
                    <p>
                        Designed exclusively for jewellery businesses with
                        features like karat calculations, stone tracking,
                        and hallmarking compliance.
                    </p>
                </div>
            </div>

            <!-- Feature Card 2 -->
            <div class="featureCardExact featureGold">
                <div class="featureIconExact iconGold"><img src="{{ asset('front_assets/img/icons/a2.svg') }}"></div>
                <div>
                    <h4>Trusted & Secure</h4>
                    <p>
                        Bank-grade encryption and daily backups ensure
                        your valuable business data is always protected
                        and accessible.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-------------3rd section------------------------->
<!-- ================= PREMIUM FEATURES SECTION ================= -->
<section class="featureSectionPremium">

    <!-- Section Header -->
    <div class="featureHeader">
        <h2 class="featureTitlePremium">
            Everything You Need to<br>
            <span>Manage Your Business</span>
        </h2>

        <p class="featureSubtitlePremium">
            Powerful features designed specifically for the unique needs of jewellery businesses
        </p>
    </div>

    <!-- Features Grid -->
    <div class="featureGridPremium">

        <!-- Card 1 -->
        <div class="featureCardPremium">
            <div class="featureIconPremium">
                           <img src="{{ asset('front_assets/img/icons/img1.png') }}" alt="Data Security">
   </div>
            <h3>Smart Invoice Management</h3>
            <p>
                Create professional invoices with automatic calculations
                for making charges, GST, and customizations.
            </p>
            <ul>
                <li>Auto GST calculations</li>
                <li>Custom templates</li>
                <li>Digital signatures</li>
            </ul>
        </div>

        <!-- Card 2 -->
        <div class="featureCardPremium">
            <div class="featureIconPremium">
                <img src="{{ asset('front_assets/img/icons/img2.png') }}" alt="Real-Time Inventory Tracking">
            </div>
            <h3>Real-Time Inventory Tracking</h3>
            <p>
                Monitor stock levels and get instant updates with
                precision weight tracking.
            </p>
            <ul>
                <li>22K and 24K tracking</li>
                <li>Low stock alerts</li>
                <li>Multi-branch sync</li>
            </ul>
        </div>

        <!-- Card 3 -->
        <div class="featureCardPremium">
            <div class="featureIconPremium">
                <img src="{{ asset('front_assets/img/icons/img3.png') }}" alt="Customer Management">
            </div>
            <h3>Customer Management</h3>
            <p>
                Build detailed customer profiles and maintain
                complete purchase history.
            </p>
            <ul>
                <li>Customer database</li>
                <li>Purchase history</li>
                <li>Loyalty tracking</li>
            </ul>
        </div>

        <!-- Card 4 -->
        <div class="featureCardPremium">
            <div class="featureIconPremium">
                <img src="{{ asset('front_assets/img/icons/img4.png') }}" alt="Business Analytics">
            </div>
            <h3>Business Analytics</h3>
            <p>
                Detailed dashboards and reports for better
                business decisions.
            </p>
            <ul>
                <li>Sales reports</li>
                <li>Profit analysis</li>
                <li>Custom report builder</li>
            </ul>
        </div>

        <!-- Card 5 -->
        <div class="featureCardPremium">
            <div class="featureIconPremium">
                <img src="{{ asset('front_assets/img/icons/img5.png') }}" alt="Smart Notifications">
            </div>
            <h3>Smart Notifications</h3>
            <p>
                Receive important alerts and reminders
                for critical business events.
            </p>
            <ul>
                <li>Low stock alerts</li>
                <li>Payment reminders</li>
                <li>Custom notifications</li>
            </ul>
        </div>

        <!-- Card 6 -->
        <div class="featureCardPremium">
            <div class="featureIconPremium">
                <img src="{{ asset('front_assets/img/icons/img6.png') }}" alt="Data Security">
            </div>
            <h3>Data Security</h3>
            <p>
                Enterprise-grade protection with encrypted storage
                and secure backups.
            </p>
            <ul>
                <li>Encrypted storage</li>
                <li>Daily backups</li>
                <li>Role-based access</li>
            </ul>
        </div>

    </div>
</section>
<!-- ================================4rth section======================== -->

<section class="day-life-section">
  <div class="container">
    <!-- Heading -->
    <div class="section-header">
      <h2>A Day in the Life with Jewelerp</h2>
      <p>See how Kumar Jewellers transformed their operations with our platform</p>
    </div>

    <!-- Main Content -->
    <div class="day-life-wrapper">

      <!-- Left Image Card -->
      <div class="image-card">
        <span class="time-badge">🕘 9:00 AM - 8:00 PM</span>

        <img src="{{ asset('front_assets/img/index-day.png') }}" alt="Jewellery Shop">

        <div class="image-stats">
          <div class="stat">
            <h4>2min</h4>
            <span>Per Invoice</span>
          </div>
          <div class="stat">
            <h4>100%</h4>
            <span>Accurate</span>
          </div>
          <div class="stat">
            <h4>5hrs</h4>
            <span>Saved/Week</span>
          </div>
        </div>
      </div>

      <!-- Right Timeline -->
      <div class="timeline">

        <!-- Timeline Item 1 -->
        <div class="timeline-item">
          <div class="timeline-number">1</div>
          <div class="timeline-card">
            <span class="timeline-label"><img src="{{ asset('front_assets/img/icons/morning.svg') }}" alt="Morning"> MORNING</span>
            <h3>Review Inventory</h3>
            <p>
              Start your day by checking gold and silver stock levels,
              reviewing pending orders, and receiving instant low-stock
              alerts. Stay ahead with real-time inventory updates.
            </p>
          </div>
        </div>

        <!-- Timeline Item 2 -->
        <div class="timeline-item">
          <div class="timeline-number">2</div>
          <div class="timeline-card">
            <span class="timeline-label"><img src="{{ asset('front_assets/img/icons/afternoone.svg') }}" alt="Afternoon"> AFTERNOON</span>
            <h3>Customer Rush</h3>
            <p>
              Create professional invoices in seconds with automatic
              calculations for making charges, stone costs, and GST.
              Error-free billing that impresses customers every time.
            </p>
          </div>
        </div>

        <!-- Timeline Item 3 -->
        <div class="timeline-item">
          <div class="timeline-number">3</div>
          <div class="timeline-card">
            <span class="timeline-label"><img src="{{ asset('front_assets/img/icons/evening.svg') }}" alt="Evening"> EVENING</span>
            <h3>End-of-Day Reports</h3>
            <p>
              Review comprehensive daily sales reports, track stock
              changes, and analyze profit margins. Complete visibility
              into your business performance at a glance.
            </p>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>
<!-- ========================5th section=============================== -->

<section class="dashboard-showcase">
  <div class="container">

    <!-- Section Heading -->
    <div class="dashboard-header">
      <h2>
        Powerful Dashboard,
        <span>Simple Interface</span>
      </h2>
      <p>Every feature you need, designed for clarity and speed</p>
    </div>

    <!-- Feature Tabs -->
    <div class="dashboard-tabs">
      <button class="dashboard-tab active">
        <i class="fas fa-file-invoice"></i>
        Invoice Management
      </button>

      <button class="dashboard-tab">
        <i class="fas fa-cube"></i>
        Inventory Dashboard
      </button>

      <button class="dashboard-tab">
        <i class="fas fa-chart-bar"></i>
        Business Analytics
      </button>
    </div>

    <!-- Browser Mockup -->
    <div class="dashboard-browser">

      <!-- Browser Top Bar -->
      <div class="browser-top">
        <div class="browser-dots">
          <span class="dot red"></span>
          <span class="dot yellow"></span>
          <span class="dot green"></span>
        </div>

        <div class="browser-address">
          jeweltrack.com/dashboard
        </div>
      </div>

      <!-- Browser Content -->
      <div class="browser-content">
        <!-- Header -->
        <div class="content-header">
          <div>
            <h3>Invoice Management</h3>
            <p>Manage all your customer invoices</p>
          </div>

          <a href="#" class="new-invoice-btn">
            <i class="fas fa-file-alt"></i>
            New Invoice
          </a>
        </div>

        <!-- Table -->
        <div class="invoice-table">
          <table>
            <thead>
              <tr>
                <th>Invoice ID</th>
                <th>Customer</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Status</th>
              </tr>
            </thead>

            <tbody>
              <tr>
                <td class="invoice-id">INV-1247</td>
                <td>Rajesh Kumar</td>
                <td class="amount">₹45,670</td>
                <td>Today, 2:30 PM</td>
                <td><span class="status paid">Paid</span></td>
              </tr>

              <tr>
                <td class="invoice-id">INV-1248</td>
                <td>Priya Sharma</td>
                <td class="amount">₹89,240</td>
                <td>Today, 1:15 PM</td>
                <td><span class="status pending">Pending</span></td>
              </tr>

              <tr>
                <td class="invoice-id">INV-1249</td>
                <td>Amit Patel</td>
                <td class="amount">₹1,23,500</td>
                <td>Today, 11:45 AM</td>
                <td><span class="status paid">Paid</span></td>
              </tr>

              <tr>
                <td class="invoice-id">INV-1250</td>
                <td>Neha Singh</td>
                <td class="amount">₹67,890</td>
                <td>Today, 10:20 AM</td>
                <td><span class="status paid">Paid</span></td>
              </tr>

              <tr>
                <td class="invoice-id">INV-1251</td>
                <td>Vikram Malhotra</td>
                <td class="amount">₹2,14,300</td>
                <td>Yesterday, 6:45 PM</td>
                <td><span class="status paid">Paid</span></td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Bottom Note -->
        <p class="dashboard-note">
          Create professional, GST-compliant invoices with automatic calculations
        </p>
      </div>

      <!-- Navigation Arrows -->
      <button class="slider-arrow left">
        <i class="fas fa-chevron-left"></i>
      </button>

      <button class="slider-arrow right">
        <i class="fas fa-chevron-right"></i>
      </button>
    </div>
  </div>
</section>


<section class="benefits-section">
  <div class="container">

    <div class="benefits-header">
      <h2>Real Benefits, Real Results</h2>
      <p>See the impact on your business from day one</p>
    </div>

    <div class="benefits-grid">

      <div class="benefit-card">
        <div class="benefit-icon">
          <img src="{{ asset('front_assets/img/icons/clock.svg') }}" alt="Save Time">
        </div>
        <h3>Save Time</h3>
        <span class="benefit-line"></span>
        <p>
          Automate repetitive tasks and reduce invoice creation time
          from 10 minutes to just 2 minutes. Focus on growing your
          business, not paperwork.
        </p>
      </div>

      <!-- Card 2 -->
      <div class="benefit-card">
        <div class="benefit-icon">
          <img src="{{ asset('front_assets/img/icons/check-circle.svg') }}" alt="Reduce Manual Errors">
        </div>
        <h3>Reduce Manual Errors</h3>
        <span class="benefit-line"></span>
        <p>
          Eliminate calculation mistakes with automated GST, making
          charges, and stone cost calculations. 100% accuracy
          guaranteed.
        </p>
      </div>

      <!-- Card 3 -->
      <div class="benefit-card">
        <div class="benefit-icon">
          <img src="{{ asset('front_assets/img/icons/trending-up.svg') }}" alt="Stay Organized">
        </div>
        <h3>Stay Organized</h3>
        <span class="benefit-line"></span>
        <p>
          Keep all your invoices, inventory records, and customer data
          in one secure, searchable place. Never lose track of
          important information.
        </p>
      </div>

      <!-- Card 4 -->
      <div class="benefit-card">
        <div class="benefit-icon">
          <img src="{{ asset('front_assets/img/icons/folder.svg') }}" alt="Improve Daily Operations">
        </div>
        <h3>Improve Daily Operations</h3>
        <span class="benefit-line"></span>
        <p>
          Get real-time insights into sales, stock levels, and
          profitability. Make data-driven decisions to grow your
          jewellery business.
        </p>
      </div>

    </div>

    <!-- Bottom Stats Card -->
    <div class="benefits-stats">
      <div class="stat-box">
        <h4>5 hours</h4>
        <p>Saved per week</p>
      </div>

      <div class="stat-box">
        <h4>100%</h4>
        <p>Calculation accuracy</p>
      </div>

      <div class="stat-box">
        <h4>24/7</h4>
        <p>Access anywhere</p>
      </div>
    </div>

  </div>
</section>

<section class="tmx-testimonial-section">
  <div class="tmx-container">

    <!-- Top Badge -->
    <div class="tmx-badge">
      ⭐ Trusted by 500+ Jewellery Businesses
    </div>

    <!-- Testimonial Grid -->
    <div class="tmx-testimonial-grid">

      <!-- Testimonial Card 1 -->
      <div class="tmx-testimonial-card">
        <div class="tmx-quote-icon">
          <img src="{{ asset('front_assets/img/icons/t1.svg') }}" alt="Quote">
        </div>

        <p class="tmx-testimonial-text">
          "JewelTrack has completely transformed how we manage our business. The automated invoice system saves us hours every day, and the inventory tracking is incredibly accurate. Our customers love the professional invoices!"
        </p>

        <div class="tmx-testimonial-stars">
           <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
        </div>

        <div class="tmx-testimonial-user">
          <div class="tmx-user-avatar">RK</div>
          <div class="tmx-user-info">
            <h4>Rajesh Kumar</h4>
            <p>Kumar Jewellers, Mumbai</p>
          </div>
        </div>
      </div>

      <div class="tmx-testimonial-card">
        <div class="tmx-quote-icon">
          <img src="{{ asset('front_assets/img/icons/t1.svg') }}" alt="Quote">
        </div>

        <p class="tmx-testimonial-text">
         "We were skeptical at first, but after using JewelTrack for just a month, we can't imagine going back. The real-time stock alerts have prevented stockouts, and the analytics help us make better purchasing decisions."
        </p>

        <div class="tmx-testimonial-stars">
          <i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i>
        </div>

        <div class="tmx-testimonial-user">
          <div class="tmx-user-avatar">PS</div>
          <div class="tmx-user-info">
            <h4>Pooja Shah</h4>
            <p>Shah & Sons, Delhi</p>
          </div>
        </div>
      </div>

    </div>

    <div class="tmx-stats-grid">

      <div class="tmx-stat-card">
        <div class="tmx-stat-icon">
          <img src="{{ asset('front_assets/img/icons/t2.svg') }}" alt="Users">
        </div>
        <h3>500+</h3>
        <p>Happy Customers</p>
      </div>

      <div class="tmx-stat-card">
        <div class="tmx-stat-icon">
          <img src="{{ asset('front_assets/img/icons/t3.svg') }}" alt="Invoices">
        </div>
        <h3>50K+</h3>
        <p>Invoices Generated</p>
      </div>

      <div class="tmx-stat-card">
        <div class="tmx-stat-icon">
          <img src="{{ asset('front_assets/img/icons/t5.svg') }}" alt="Rating">
        </div>
        <h3>4.9/5</h3>
        <p>Customer Rating</p>
      </div>

      <div class="tmx-stat-card">
        <div class="tmx-stat-icon">
          <img src="{{ asset('front_assets/img/icons/t4.svg') }}" alt="Support">
        </div>
        <h3>24/7</h3>
        <p>Support Available</p>
      </div>

    </div>
  </div>
</section>

@include('invoice_front.includes.footer')
