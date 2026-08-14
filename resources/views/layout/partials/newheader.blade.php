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
            <!-- <div class="search-bar-new">
                <i class="fe fe-search search-icon-new"></i>
                <input type="text" placeholder="Search Customer, Invoice, Supplier...">
            </div> -->
        </div>

        <!-- Central/Right Action Pills -->
        <div class="header-pills-container">

            <!-- Firm/Company Switcher Pill -->
            @if(Auth::guard('admin')->check())
                <div class="dropdown">
                    <button class="pill-button-new pill-purple dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-building pill-icon-left"></i>
                        <span>{{ Session::get('selected_firm_name', 'Select Firm') }}</span>
                        <!-- <i class="fas fa-chevron-down pill-icon-right"></i> -->
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
                    <!-- <i class="fas fa-chevron-down pill-icon-right"></i> -->
                </button>
                <div class="dropdown-menu dropdown-menu-end border-0 shadow" style="min-width: 180px;">
                    <a class="dropdown-item" href="{{ url('add-products') }}">
                        <i class="fe fe-package me-2" style="color: #7D56D9;"></i> Add Stock
                    </a>
                    {{-- <a class="dropdown-item" href="{{ route('add-customer') }}">
                        <i class="fe fe-user-plus me-2" style="color: #2DCA73;"></i> Add Customer
                    </a> --}}
                    <a class="dropdown-item" href="{{ route('invoices.create') }}">
                        <i class="fe fe-file-text me-2" style="color: #FFB800;"></i> Add Sell
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
                    <!-- <i class="fas fa-chevron-down pill-icon-right"></i> -->
                </button>
                <div class="dropdown-menu dropdown-menu-end border-0 shadow">
                    <a class="dropdown-item" href="{{ url('product-list') }}">Inventory</a>
                    <a class="dropdown-item" href="{{ url('invoices') }}">Sales & Bills</a>
                    <a class="dropdown-item" href="{{ route('day-book.index') }}">Accounting</a>
                </div>
            </div>

            <!-- Update Rate Pill -->
            <button class="pill-button-new" style="background: rgba(255, 184, 0, 0.12); color: #B37D00; border: none; font-weight: 700; transition: all 0.2s ease;" type="button" data-bs-toggle="modal" data-bs-target="#updateRateModal" onmouseover="this.style.background='rgba(255, 184, 0, 0.2)'" onmouseout="this.style.background='rgba(255, 184, 0, 0.12)'">
                <i class="fas fa-edit" style="margin-right: 6px;"></i>
                <span>Update Rate</span>
            </button>

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

</header>

<!-- Update Rate Modal -->
<div class="modal fade" id="updateRateModal" tabindex="-1" aria-labelledby="updateRateModalLabel" aria-hidden="true" style="z-index: 10050;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg border-0" style="border-radius: 16px; background: #FFFFFF;">
            <form action="{{ route('metal-rates.bulk-update') }}" method="POST">
                @csrf
                <div class="modal-header" style="border-bottom: 1px solid var(--border-color); padding: 20px 24px;">
                    <h5 class="modal-title" id="updateRateModalLabel" style="font-weight: 800; color: var(--text-main) !important; display: flex; align-items: center; gap: 8px;">
                        <i class="fas fa-coins" style="color: #FFB800;"></i> Update Metal Rates
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding: 24px; max-height: 70vh; overflow-y: auto;">
                    <div class="mb-3">
                        <label for="rate_24k" class="form-label" style="font-weight: 700; color: var(--text-main) !important; display: block; margin-bottom: 8px;">Gold 24K Rate per Gram (₹)</label>
                        <input type="number" step="0.01" class="form-control" id="rate_24k" name="rate_24k" placeholder="e.g. 7200" required style="border-radius: 8px; padding: 12px 14px; border: 2px solid var(--primary-color); font-size: 16px; font-weight: 700; color: var(--primary-color);">
                        <div class="form-text text-muted" style="font-size: 11px; margin-top: 6px;">Entering Gold 24K rate will automatically calculate rates for other karats (22K, 20K, 18K, 14K, 9K).</div>
                    </div>

                    <!-- Real-time Karat Calculations Table -->
                    <div class="mb-4">
                        <h6 style="font-weight: 700; color: var(--text-main) !important; margin-bottom: 12px; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">Calculated Karat Rates</h6>
                        <div class="table-responsive" style="border-radius: 10px; border: 1px solid var(--border-color); overflow: hidden;">
                            <table class="table table-sm table-borderless mb-0" style="font-size: 13px;">
                                <thead style="background: #F9FAFB; border-bottom: 1px solid var(--border-color);">
                                    <tr>
                                        <th style="padding: 8px 12px; font-weight: 600; color: var(--text-muted);">Karat</th>
                                        <th style="padding: 8px 12px; font-weight: 600; color: var(--text-muted); text-align: right;">Rate / Gm</th>
                                    </tr>
                                </thead>
                                <tbody id="karat_preview_body">
                                    @foreach([24, 22, 20, 18, 14, 9] as $k)
                                        <tr style="border-bottom: 1px solid #F3F4F6;">
                                            <td style="padding: 8px 12px; font-weight: 600; color: var(--text-main) !important;">Gold ({{ $k }}K)</td>
                                            <td style="padding: 8px 12px; font-weight: 700; text-align: right; color: var(--primary-color);" id="preview_rate_{{ $k }}">₹0.00</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="silver_rate" class="form-label" style="font-weight: 600; color: var(--text-main) !important; display: block; margin-bottom: 8px;">Silver Rate per Gram (₹) <span class="text-muted" style="font-size: 11px; font-weight: normal;">(Optional)</span></label>
                        <input type="number" step="0.01" class="form-control" id="silver_rate" name="silver_rate" placeholder="e.g. 95" style="border-radius: 8px; padding: 10px 14px; border: 1px solid var(--border-color);">
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 1px solid var(--border-color); padding: 16px 24px;">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 8px;">Cancel</button>
                    <button type="submit" class="btn btn-primary" style="background: var(--primary-color); border-color: var(--primary-color); border-radius: 8px; font-weight: 600;">Update Rates</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
 document.addEventListener('DOMContentLoaded', function () {

    const rateInput = document.getElementById('rate_24k');

    const purities = {
        24: 100,
        22: 91.6,
        20: 83.3,
        18: 75,
        14: 58.5,
        9: 37.5
    };

    rateInput.addEventListener('input', function () {

        const val = parseFloat(this.value) || 0;

        Object.keys(purities).forEach(function (karat) {

            const percent = purities[karat];

            const price = Math.round((val * percent) / 100);

            const el = document.getElementById('preview_rate_' + karat);

            if (el) {
                el.textContent = '₹' + price;
            }

        });

    });

});
</script>
