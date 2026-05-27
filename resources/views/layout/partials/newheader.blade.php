<!-- Redesigned V2 Header -->
@php
    $adminUser = Auth::guard('admin')->user();
    $adminInitials = 'AD';
    if ($adminUser && !empty($adminUser->name)) {
        $nameParts = explode(' ', trim($adminUser->name));
        if (count($nameParts) >= 2) {
            $adminInitials = strtoupper(substr($nameParts[0], 0, 1) . substr($nameParts[1], 0, 1));
        } else {
            $adminInitials = strtoupper(substr($adminUser->name, 0, 2));
        }
    }
@endphp

<header class="header-new">
    <!-- Row 1: Main Top Header Content -->
    <div class="header-row-one">
        <!-- Left Actions & Search Bar -->
        <div style="display: flex; align-items: center; gap: 16px;">
            <a href="javascript:void(0);" id="toggle_btn_new" style="color: var(--text-main); font-size: 20px; transition: color 0.2s;">
                <i class="fas fa-bars"></i>
            </a>
            <div class="search-bar-new">
                <i class="fe fe-search search-icon-new"></i>
                <input type="text" placeholder="Search Customer, Invoice, Supplier...">
            </div>
        </div>

        <!-- Central/Right Action Pills -->
        <div class="header-pills-container">

            <!-- Firm/Company Switcher Pill -->
            @if(Auth::guard('admin')->check())
                <div class="dropdown">
                    <button class="pill-button-new pill-purple dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-building pill-icon-left"></i>
                        <span>{{ Session::get('selected_firm_name', 'Select Firm') }}</span>
                        <i class="fas fa-chevron-down pill-icon-right"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end shadow border-0">
                        <div class="dropdown-header font-weight-bold text-uppercase" style="font-size: 11px; letter-spacing: 0.5px; color: var(--text-muted);">Switch Firm</div>
                        @php $firms = \App\Models\Firm::all(); @endphp
                        @foreach($firms as $firm)
                            <form action="{{ route('firms.switch') }}" method="POST" id="switch-firm-new-{{ $firm->id }}">
                                @csrf
                                <input type="hidden" name="firm_id" value="{{ $firm->id }}">
                                <a href="javascript:void(0);" class="dropdown-item @if(Session::get('selected_firm_id') == $firm->id) active @endif" onclick="document.getElementById('switch-firm-new-{{ $firm->id }}').submit();">
                                    <i class="fas fa-building me-2 small"></i> {{ $firm->name }}
                                </a>
                            </form>
                        @endforeach
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('firms.index') }}">
                            <i class="fas fa-cog me-2 small"></i> Manage Firms
                        </a>
                    </div>
                </div>
            @endif

            <!-- Language Selector Pill -->
            <!-- <div class="dropdown">
                <button class="pill-button-new pill-gray dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fe fe-globe pill-icon-left"></i>
                    <span>English</span>
                    <i class="fas fa-chevron-down pill-icon-right"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end border-0 shadow">
                    <a class="dropdown-item active" href="javascript:void(0);">English</a>
                    <a class="dropdown-item" href="javascript:void(0);">Hindi</a>
                </div>
            </div> -->

            <!-- Quick Add Dropdown -->
            <div class="dropdown">
                <button class="pill-button-new pill-quick-add dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fe fe-plus pill-icon-left" style="color: var(--primary-color);"></i>
                    <span style="font-weight: 700;">Quick Add</span>
                    <i class="fas fa-chevron-down pill-icon-right"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end border-0 shadow" style="min-width: 180px;">
                    <a class="dropdown-item" href="{{ url('add-products') }}">
                        <i class="fe fe-package me-2" style="color: #7D56D9;"></i> Add Retail Stock
                    </a>
                    <a class="dropdown-item" href="{{ route('add-customer') }}">
                        <i class="fe fe-user-plus me-2" style="color: #2DCA73;"></i> Add Customer
                    </a>
                    <a class="dropdown-item" href="{{ route('invoices.create') }}">
                        <i class="fe fe-file-text me-2" style="color: #FFB800;"></i> Create New Invoice
                    </a>
                    <!-- <a class="dropdown-item" href="{{ route('metal-rates') }}">
                        <i class="fe fe-database me-2" style="color: #FA5252;"></i> Add Raw Metal
                    </a> -->
                </div>
            </div>

            <!-- Modules Dropdown Pill -->
            <div class="dropdown">
                <button class="pill-button-new pill-purple dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fe fe-grid pill-icon-left"></i>
                    <span>Modules</span>
                    <i class="fas fa-chevron-down pill-icon-right"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end border-0 shadow">
                    <a class="dropdown-item" href="{{ url('product-list') }}">Inventory</a>
                    <a class="dropdown-item" href="{{ url('invoices') }}">Sales & Bills</a>
                    <a class="dropdown-item" href="{{ route('day-book.index') }}">Accounting</a>
                </div>
            </div>

        </div>

        <!-- Right Hand Actions: Moon Toggle & Profile Initials Avatar -->
        <div class="header-actions-new">
            <a href="javascript:void(0);" class="action-icon-btn toggle-switch" id="theme_toggle_btn">
                <i class="fe fe-moon" id="theme_icon"></i>
            </a>

            <div class="dropdown">
                <div class="avatar-circle-new dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ $adminInitials }}
                    <span class="avatar-dot-active"></span>
                </div>
                <div class="dropdown-menu dropdown-menu-end border-0 shadow" style="width: 200px;">
                    <div class="dropdown-header d-flex flex-column align-items-start p-3" style="border-bottom: 1px solid var(--border-color);">
                        <span class="font-weight-bold text-dark" style="font-size: 14px;">{{ $adminUser->name ?? 'Admin User' }}</span>
                        <span class="text-muted" style="font-size: 11px;">{{ $adminUser->email ?? 'admin@gmail.com' }}</span>
                    </div>
                    {{-- <a class="dropdown-item mt-2" href="{{ url('app/settings') }}"><i class="fe fe-settings me-2"></i> Settings</a> --}}
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"><i class="fe fe-power me-2"></i> Log Out</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Row 2: Scrolling Metal Rates Banner -->
    <div class="header-row-two marquee-container" style="padding-top: 6px; padding-bottom: 6px; border-bottom: 1px solid var(--border-color);">
        <div class="marquee-content">
            @php
                $metalRates = \App\Models\MetalRate::where('admin_id', Auth::guard('admin')->id())
                    ->orderBy('id', 'desc')
                    ->take(15)
                    ->get();
            @endphp

            @if($metalRates->count() > 0)
                @foreach($metalRates as $index => $rate)
                    <span class="rate-item-new" style="display: inline-block; margin-right: 32px; font-size: 13px;">
                        <i class="fas fa-coins" style="color: #FFB800; margin-right: 4px;"></i>
                        <span style="font-weight: 600; color: var(--text-main);">{{ $rate->metal_type }} ({{ $rate->karat ?? ($rate->purity_type == 'percent' ? $rate->percent.'%' : 'Fine') }}):</span>
                        <span class="rate-value" style="font-weight: 800; color: var(--primary-color); margin-left: 4px;">₹{{ number_format($rate->price_per_gram, 2) }} /Gm</span>
                    </span>
                    @if(!$loop->last)
                        <span class="rate-divider-new" style="margin-right: 32px; color: var(--border-color); font-weight: bold;">|</span>
                    @endif
                @endforeach
            @else
                <!-- Fallback placeholder rates if none is configured -->
                <span class="rate-item-new" style="display: inline-block; margin-right: 32px; font-size: 13px;">
                    <i class="fas fa-coins" style="color: #FFB800; margin-right: 4px;"></i>
                    <span style="font-weight: 600; color: var(--text-main);">Gold (58.33):</span>
                    <span class="rate-value" style="font-weight: 800; color: var(--primary-color); margin-left: 4px;">₹9,566.00 /Gm</span>
                </span>
                <span class="rate-divider-new" style="margin-right: 32px; color: var(--border-color); font-weight: bold;">|</span>
                <span class="rate-item-new" style="display: inline-block; margin-right: 32px; font-size: 13px;">
                    <i class="fas fa-coins" style="color: #FFB800; margin-right: 4px;"></i>
                    <span style="font-weight: 600; color: var(--text-main);">Gold (24K):</span>
                    <span class="rate-value" style="font-weight: 800; color: var(--primary-color); margin-left: 4px;">₹16,400.00 /Gm</span>
                </span>
                <span class="rate-divider-new" style="margin-right: 32px; color: var(--border-color); font-weight: bold;">|</span>
                <span class="rate-item-new" style="display: inline-block; margin-right: 32px; font-size: 13px;">
                    <i class="fas fa-coins" style="color: #FFB800; margin-right: 4px;"></i>
                    <span style="font-weight: 600; color: var(--text-main);">Gold (14K):</span>
                    <span class="rate-value" style="font-weight: 800; color: var(--primary-color); margin-left: 4px;">₹9,566.00 /Gm</span>
                </span>
                <span class="rate-divider-new" style="margin-right: 32px; color: var(--border-color); font-weight: bold;">|</span>
                <span class="rate-item-new" style="display: inline-block; margin-right: 32px; font-size: 13px;">
                    <i class="fas fa-coins" style="color: #FFB800; margin-right: 4px;"></i>
                    <span style="font-weight: 600; color: var(--text-main);">Silver (Fine):</span>
                    <span class="rate-value" style="font-weight: 800; color: var(--primary-color); margin-left: 4px;">₹295.00 /Gm</span>
                </span>
            @endif
        </div>
    </div>
</header>
