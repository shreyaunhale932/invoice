<!-- Redesigned V2 Sidebar -->
<div class="sidebar-new" id="sidebar">
    <!-- Sidebar Logo Header -->
    <div class="sidebar-new-logo">
        <a href="{{ Auth::check() && Auth::user()->role === 'superadmin' ? url('dashboard') : route('admin.dashboard') }}">
            <img src="{{ asset('/assets/img/logo.png') }}" class="img-fluid logo-main-new" alt="Logo" style="max-height: 40px;">
            <img src="{{ asset('/assets/img/logo-small.png') }}" class="img-fluid logo-small-new" alt="Logo" style="display: none; max-height: 35px;">
        </a>
    </div>

    <!-- Sidebar Inner Navigation -->
    <div class="sidebar-new-inner">
        @if (Auth::check() && Auth::user()->role === 'superadmin')
            <!-- Super Admin Group -->
            <ul class="sidebar-new-menu">
                <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                    <a href="{{ url('dashboard') }}">
                        <i class="fe fe-grid"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
            </ul>

            <div class="menu-section-title">User Management</div>
            <ul class="sidebar-new-menu">
                <li class="{{ Request::is('createAdmin') ? 'active' : '' }}">
                    <a href="{{ url('createAdmin') }}">
                        <i class="fe fe-users"></i>
                        <span>Users</span>
                    </a>
                </li>
            </ul>
        @endif

        @if (Auth::guard('admin')->check())
            <!-- Main Group (Admin) -->
            <ul class="sidebar-new-menu">
            <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fe fe-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>
        </ul>

        <!-- Inventory Section -->
        <div class="menu-section-title">Inventory</div>
        <ul class="sidebar-new-menu">
            <!-- Fine Stock Submenu -->
            <li class="submenu-trigger-new">
                <a href="javascript:void(0);">
                    <i class="fe fe-package"></i>
                    <span>Stock</span>
                    <i class="fas fa-chevron-right menu-arrow-new"></i>
                </a>
                <ul class="submenu-new">
                    <li class="{{ Request::is('product-list', 'add-products', 'edit-products') ? 'active' : '' }}">
                        <a href="{{ url('product-list') }}">Product List</a>
                    </li>
                    <li class="{{ Request::is('category') ? 'active' : '' }}">
                        <a href="{{ url('category') }}">Category</a>
                    </li>
                    <li class="{{ Request::is('subcategory') ? 'active' : '' }}">
                        <a href="{{ url('subcategory') }}">Subcategory</a>
                    </li>
                    <li class="{{ Request::is('purity') ? 'active' : '' }}">
                        <a href="{{ url('purity') }}">Purity</a>
                    </li>

                    {{-- <li class="{{ Request::is('labels/templates*') ? 'active' : '' }}">
                        <a href="{{ route('labels.templates.index') }}">Label Templates</a>
                    </li>
                    <li class="{{ Request::is('labels/print/bulk') ? 'active' : '' }}">
                        <a href="{{ route('labels.print.bulk') }}">Bulk Print</a>
                    </li> --}}
                </ul>
            </li>

            <!-- Old Metal Stock Submenu -->
            <li class="submenu-trigger-new">
                <a href="javascript:void(0);">
                    <i class="fe fe-database"></i>
                    <span>Metal Rates & Old Metal</span>
                    <i class="fas fa-chevron-right menu-arrow-new"></i>
                </a>
                <ul class="submenu-new">
                    <li class="{{ Request::is('metal-rates') ? 'active' : '' }}">
                        <a href="{{ url('metal-rates') }}">Metal Rates</a>
                    </li>
                    <li class="{{ Request::is('old-metal-received') ? 'active' : '' }}">
                        <a href="{{ url('old-metal-received') }}">Old Metal Received</a>
                    </li>
                </ul>
            </li>

            <!-- Packet Stock Submenu -->
            <li class="submenu-trigger-new">
                <a href="javascript:void(0);">
                    <i class="fe fe-layers"></i>
                    <span>Packet Stock</span>
                    <i class="fas fa-chevron-right menu-arrow-new"></i>
                </a>
                <ul class="submenu-new">
                    <li class="{{ Request::is('packet-masters*') ? 'active' : '' }}">
                        <a href="{{ route('packet-masters.index') }}">Packets List</a>
                    </li>
                    <li>
                        <a href="{{ route('packet-attributes.index', 'stones') }}">Stones Master</a>
                    </li>
                    <li>
                        <a href="{{ route('packet-attributes.index', 'clarities') }}">Clarities Master</a>
                    </li>
                    <li>
                        <a href="{{ route('packet-attributes.index', 'colors') }}">Colors Master</a>
                    </li>
                    <li>
                        <a href="{{ route('packet-attributes.index', 'cuts') }}">Cuts Master</a>
                    </li>
                    <li>
                        <a href="{{ route('packet-attributes.index', 'shapes') }}">Shapes Master</a>
                    </li>
                    <li>
                        <a href="{{ route('packet-attributes.index', 'mms') }}">MMs Master</a>
                    </li>
                </ul>
            </li>
        </ul>

        <!-- Sell Section -->
        <div class="menu-section-title">Sell</div>
        <ul class="sidebar-new-menu">
            <!-- Sell & Invoices Submenu -->
            <li class="submenu-trigger-new">
                <a href="javascript:void(0);">
                    <i class="fe fe-file-text"></i>
                    <span>Sell & Invoices</span>
                    <i class="fas fa-chevron-right menu-arrow-new"></i>
                </a>
                <ul class="submenu-new">
                    <li class="{{ Request::is('invoices') ? 'active' : '' }}">
                        <a href="{{ url('invoices') }}">Invoices List</a>
                    </li>
                    <li>
                        <a href="{{ route('invoices.create') }}">Create Invoice</a>
                    </li>
                    <li class="{{ Route::is('invoice.template.index') ? 'active' : '' }}">
                        <a href="{{ route('invoice.template.index') }}">Invoice Templates</a>
                    </li>
                    <li class="{{ Request::is('customer/transactions*') ? 'active' : '' }}">
                        <a href="{{ route('customer.transactions.index') }}">Transactions</a>
                    </li>
                </ul>
            </li>


        </ul>


        <!-- Customers Section -->
        <div class="menu-section-title">Customers</div>
        <ul class="sidebar-new-menu">
            <li class="{{ Request::is('customers') ? 'active' : '' }}">
                <a href="{{ url('customers') }}">
                    <i class="fe fe-users"></i>
                    <span>Customers List</span>
                </a>
            </li>
            <li class="{{ Request::is('add-customer') ? 'active' : '' }}">
                <a href="{{ route('add-customer') }}">
                    <i class="fe fe-user-plus"></i>
                    <span>Add Customer</span>
                </a>
            </li>
        </ul>

        <!-- Firm Management Section -->
        <div class="menu-section-title">Firm Management</div>
        <ul class="sidebar-new-menu">
            <li class="{{ Request::is('firms') ? 'active' : '' }}">
                <a href="{{ route('firms.index') }}">
                    <i class="fe fe-award"></i>
                    <span>Manage Firms</span>
                </a>
            </li>
            <li class="{{ Request::is('firms/select') ? 'active' : '' }}">
                <a href="{{ route('firms.select') }}">
                    <i class="fe fe-refresh-cw"></i>
                    <span>Switch Firm</span>
                </a>
            </li>
        </ul>

        <!-- Accounting & Reports Section -->
        <div class="menu-section-title">Accounting & Reports</div>
        <ul class="sidebar-new-menu">
            <!-- Accounting Submenu -->
            <li class="submenu-trigger-new">
                <a href="javascript:void(0);">
                    <i class="fe fe-bar-chart"></i>
                    <span>Accounting</span>
                    <i class="fas fa-chevron-right menu-arrow-new"></i>
                </a>
                <ul class="submenu-new">
                    <li class="{{ Request::is('accounting/trial-balance') ? 'active' : '' }}">
                        <a href="{{ route('accounting.trial-balance') }}">Trial Balance</a>
                    </li>
                    <li class="{{ Request::is('accounting/chart-of-accounts') ? 'active' : '' }}">
                        <a href="{{ route('accounting.chart-of-accounts') }}">Ledger</a>
                    </li>
                    <li class="{{ Request::is('reports/day-book') ? 'active' : '' }}">
                        <a href="{{ route('day-book.index') }}">Day Book</a>
                    </li>
                    <li class="{{ Request::is('expenses') ? 'active' : '' }}">
                        <a href="{{ url('expenses') }}">Expenses</a>
                    </li>
                    <li class="{{ Request::is('accounting/balance-sheet') ? 'active' : '' }}">
                        <a href="{{ route('accounting.balance-sheet') }}">Balance Sheet</a>
                    </li>
                    <li class="{{ Request::is('accounting/profit-loss') ? 'active' : '' }}">
                        <a href="{{ route('accounting.profit-loss') }}">Profit & Loss</a>
                    </li>
                    <li class="{{ Request::is('customer/reports/transactions') ? 'active' : '' }}">
                        <a href="{{ route('customer.reports.transactions') }}">Customer Transactions</a>
                    </li>
                </ul>
            </li>

            <!-- Item Reports Submenu -->
            <li class="submenu-trigger-new">
                <a href="javascript:void(0);">
                    <i class="fe fe-copy"></i>
                    <span>Item Reports</span>
                    <i class="fas fa-chevron-right menu-arrow-new"></i>
                </a>
                <ul class="submenu-new">
                    <li class="{{ Request::is('stock-report') ? 'active' : '' }}">
                        <a href="{{ url('stock-report') }}">Available Stock</a>
                    </li>
                    <li class="{{ Request::is('sales-report') ? 'active' : '' }}">
                        <a href="{{ url('sales-report') }}">Sold Stock</a>
                    </li>
                    <li class="{{ Request::is('stock-summary') ? 'active' : '' }}">
                        <a href="{{ url('stock-summary') }}">Stock Summary</a>
                    </li>

                </ul>
            </li>
                </ul>
            </li>
        </ul>

        <!-- Settings Section for Admin -->
        <div class="menu-section-title">Settings</div>
        <ul class="sidebar-new-menu">
            <li>
                <a href="{{ route('logout') }}">
                    <i class="fe fe-power text-danger"></i>
                    <span class="text-danger">Logout</span>
                </a>
            </li>
        </ul>
        @endif

    </div>
</div>

<!-- Sidebar Dropdown Toggling Script -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    var submenuTriggers = document.querySelectorAll(".submenu-trigger-new > a");

    submenuTriggers.forEach(function(trigger) {
        trigger.addEventListener("click", function(e) {
            e.preventDefault();
            var li = this.parentElement;
            var submenu = li.querySelector(".submenu-new");
            var arrow = this.querySelector(".menu-arrow-new");

            if (submenu.style.display === "block" || getComputedStyle(submenu).display === "block") {
                submenu.style.display = "none";
                li.classList.remove("active");
                arrow.className = "fas fa-chevron-right menu-arrow-new";
            } else {
                submenu.style.display = "block";
                li.classList.add("active");
                arrow.className = "fas fa-chevron-down menu-arrow-new";
            }
        });
    });

    // Auto-expand submenus for active routes
    var activeSubmenuItems = document.querySelectorAll(".submenu-new li.active");
    activeSubmenuItems.forEach(function(item) {
        var parentLi = item.closest(".submenu-trigger-new");
        if (parentLi) {
            parentLi.classList.add("active");
            var sub = parentLi.querySelector(".submenu-new");
            if (sub) sub.style.display = "block";
            var arr = parentLi.querySelector(".menu-arrow-new");
            if (arr) arr.className = "fas fa-chevron-down menu-arrow-new";
        }
    });
});
</script>
