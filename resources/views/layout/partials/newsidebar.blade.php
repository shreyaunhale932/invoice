<!-- Redesigned V2 Sidebar -->
<div class="sidebar-new" id="sidebar">
    <!-- Sidebar Logo Header -->
    <div class="sidebar-new-logo">
        <a
            href="{{ Auth::check() && Auth::user()->role === 'superadmin' ? url('dashboard') : route('admin.dashboard') }}">
            <img src="{{ asset('/assets/img/logo.png') }}" class="img-fluid logo-main-new" alt="Logo"
                style="max-height: 40px;">
            <img src="{{ asset('/assets/img/logo-small.png') }}" class="img-fluid logo-small-new" alt="Logo"
                style="display: none; max-height: 35px;">
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
        <ul class="sidebar-new-menu">
            <li class="{{ Request::is('visitor*') ? 'active' : '' }}">
                <a href="{{ route('visitor') }}">
                    <i class="fe fe-globe"></i>
                    <span>Visitors</span>
                </a>
            </li>
        </ul>
        <ul class="sidebar-new-menu">
            <li class="{{ Request::is('cms/pricing*') ? 'active' : '' }}">
                <a href="{{ route('superadmin.cms.pricing.index') }}">
                    <i class="fe fe-dollar-sign"></i>
                    <span>Pricing Plans</span>
                </a>
            </li>
        </ul>

        <ul class="sidebar-new-menu">
            <li class="{{ Request::is('contact-messages*') ? 'active' : '' }}">
                <a href="{{ route('contact-messages') }}">
                    <i class="fe fe-mail"></i>
                    <span>Contact Enquiries</span>
                </a>
            </li>
        </ul>
        <ul class="sidebar-new-menu">
            <li class="{{ Request::is('demo-requests*') ? 'active' : '' }}">
                <a href="{{ route('superadmin.demo-requests') }}">
                    <i class="fe fe-monitor"></i>
                    <span>Demo Requests</span>
                </a>
            </li>
        </ul>
        <!-- CMS Section -->
        <ul class="sidebar-new-menu">
            <li class="submenu-trigger-new {{ Request::is('cms*') ? 'active' : '' }}">
                <a href="javascript:void(0);">
                    <i class="fe fe-edit"></i>
                    <span>CMS</span>
                    <i class="fas fa-chevron-right menu-arrow-new"></i>
                </a>

                <ul class="submenu-new">
                    <li class="submenu-trigger-new {{ Request::is('cms') || Request::is('cms/home*') || Request::is('cms/dashboard*') ? 'active' : '' }}">
                        <a href="#">
                            <i class="fe fe-circle"></i>
                            <span>Home</span>
                            <i class="fas fa-chevron-right menu-arrow-new"></i>
                        </a>
                        <ul class="submenu-new">
                            <li class="{{ Request::is('cms') || Request::is('cms/home*') ? 'active' : '' }}">
                                <a href="{{ route('superadmin.cms.home.edit') }}">
                                    <i class="fe fe-image"></i>
                                    <span>Home Banner</span>
                                </a>
                            </li>
                            <li class="{{ Request::is('cms/home/benefits*') ? 'active' : '' }}">
                                <a href="{{ route('superadmin.cms.home.benefits.edit') }}">
                                    <i class="fe fe-award"></i>
                                    <span>Home Benefits</span>
                                </a>
                            </li>
                            <li class="{{ Request::is('cms/dashboard*') ? 'active' : '' }}">
                                <a href="{{ route('superadmin.cms.dashboard.edit') }}">
                                    <i class="fe fe-monitor"></i>
                                    <span>Dashboard Image</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="{{ Request::is('cms/solutions*') ? 'active' : '' }}">
                        <a href="{{ route('superadmin.cms.solutions.index') }}">
                            <i class="fe fe-layers"></i>
                            <span>Our Solutions</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('cms/invoice-solution*') ? 'active' : '' }}">
                        <a href="{{ route('superadmin.cms.invoice-solution.edit') }}">
                            <i class="fe fe-file-text"></i>
                            <span>Invoice &amp; Solution Page</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('cms/ai-tools*') ? 'active' : '' }}">
                        <a href="{{ route('superadmin.cms.ai-tools.edit') }}">
                            <i class="fe fe-zap"></i>
                            <span>AI Tools</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('cms/seo*') ? 'active' : '' }}">
                        <a href="{{ route('superadmin.cms.seo.index') }}">
                            <i class="fe fe-search"></i>
                            <span>SEO Settings</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('cms/faq*') ? 'active' : '' }}">
                        <a href="{{ route('superadmin.cms.faq.index') }}">
                            <i class="fe fe-help-circle"></i>
                            <span>FAQ</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('cms/testimonials*') ? 'active' : '' }}">
                        <a href="{{ route('superadmin.cms.testimonials.index') }}">
                            <i class="fe fe-message-square"></i>
                            <span>Testimonials</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('cms/videos*') ? 'active' : '' }}">
                        <a href="{{ route('superadmin.cms.videos.index') }}">
                            <i class="fe fe-video"></i>
                            <span>Videos</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('cms/blogs*') ? 'active' : '' }}">
                        <a href="{{ route('superadmin.cms.blogs.index') }}">
                            <i class="fe fe-edit"></i>
                            <span>Blog</span>
                        </a>
                    </li>




                    <!-- <li class="submenu-trigger-new {{ Request::is('cms/pricing*') || Request::is('cms/pricing*') || Request::is('cms/pricing*') ? 'active' : '' }}">
                        <a href="#">
                             <i class="fe fe-dollar-sign"></i>
                            <span>Pricing Plans</span>
                            <i class="fas fa-chevron-right menu-arrow-new"></i>
                        </a>
                        <ul class="submenu-new">
                            <li class="{{ Request::is('cms') || Request::is('cms/home*') ? 'active' : '' }}">
                                <a href="{{ route('superadmin.cms.pricing.index') }}">
                                    <i class="fe fe-circle"></i>
                                    <span>pricing</span>
                                </a>
                            </li>
                            
                           
                        </ul>
                    </li> -->
                </ul>
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
                    <li class="{{ Request::is('wholesale-stock*', 'lot-to-tag*') ? 'active' : '' }}">
                        <a href="{{ route('wholesale-stock.index') }}">Lot to Tag</a>
                    </li>
                    <li class="{{ Request::is('product-list', 'add-products', 'edit-products') ? 'active' : '' }}">
                        <a href="{{ url('product-list') }}">Retail Product List</a>
                    </li>
                    <li class="{{ Request::is('direct-sell-products') ? 'active' : '' }}">
                        <a href="{{ url('direct-sell-products') }}">Direct Sell Products</a>
                    </li>
                    <li class="{{ Request::is('add-products') ? 'active' : '' }}">
                        <a href="{{ url('add-products') }}">Add Product</a>
                    </li>
                    <li class="{{ Request::is('category') ? 'active' : '' }}">
                        <a href="{{ url('category') }}">Category</a>
                    </li>
                    <li class="{{ Request::is('subcategory') ? 'active' : '' }}">
                        <a href="{{ url('subcategory') }}">SubCategory</a>
                    </li>
                    {{-- <li class="{{ Request::is('purity') ? 'active' : '' }}">
                    <a href="{{ url('purity') }}">Purity</a>
            </li> --}}

            <li class="{{ Request::is('labels/templates*') ? 'active' : '' }}">
                <a href="{{ route('labels.templates.index') }}">Tag Design</a>
            </li>
            <li class="{{ Request::is('labels/print/bulk') ? 'active' : '' }}">
                <a href="{{ route('labels.print.bulk') }}">Bulk Print Tag</a>
            </li>
        </ul>
        </li>

        <!-- Old Metal Stock Submenu -->
        {{-- <li class="submenu-trigger-new">
                <a href="javascript:void(0);">
                    <i class="fe fe-database"></i>
                    <span>Purity/Metal Rates & Old Metal</span>
                    <i class="fas fa-chevron-right menu-arrow-new"></i>
                </a>
                <ul class="submenu-new">
                    <li class="{{ Request::is('metal-rates') ? 'active' : '' }}">
        <a href="{{ url('metal-rates') }}">Purity/Metal Rates</a>
        </li>
        <li class="{{ Request::is('old-metal-received') ? 'active' : '' }}">
            <a href="{{ url('old-metal-received') }}">Old Metal Received</a>
        </li>
        </ul>
        </li> --}}

        <ul class="sidebar-new-menu">
            <li class="{{ Request::is('metal-rates') ? 'active' : '' }}">
                <a href="{{ url('metal-rates') }}">
                    <i class="fe fe-database"></i>
                    <span>Purity/Metal Rates </span>
                </a>
            </li>

        </ul>



        <!-- Packet Stock Submenu -->
        <li class="submenu-trigger-new">
            <a href="javascript:void(0);">
                <i class="fe fe-layers"></i>
                <span>Diamond Setup</span>
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
                <li>
                    <a href="{{ route('packet-attributes.index', 'packet_types') }}">Packet Types Master</a>
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



            <li class="{{ Request::is('old-metal-received') ? 'active' : '' }}">
                <a href="{{ url('old-metal-received') }}">
                    <i class="fe fe-repeat"></i>
                    <span>Old Metal Received</span>
                </a>
            </li>
            <li class="{{ Request::is('old-diamond-received') ? 'active' : '' }}">
                <a href="{{ url('old-diamond-received') }}">
                    <i class="fe fe-repeat"></i>
                    <span>Old Diamond Received</span>
                </a>
            </li>



        </ul>


        <!-- Orders & Karigar Section -->
        <div class="menu-section-title">Orders & Karigar</div>
        <ul class="sidebar-new-menu">
            <li class="submenu-trigger-new {{ Request::is('orders*') ? 'active' : '' }}">
                <a href="javascript:void(0);">
                    <i class="fe fe-clipboard"></i>
                    <span>Customer Orders</span>
                    <i class="fas fa-chevron-right menu-arrow-new"></i>
                </a>
                <ul class="submenu-new">
                    <li class="{{ Request::is('orders') ? 'active' : '' }}">
                        <a href="{{ route('orders.index') }}">Orders List</a>
                    </li>
                    <li class="{{ Request::is('orders/create') ? 'active' : '' }}">
                        <a href="{{ route('orders.create') }}">Create Order</a>
                    </li>
                </ul>
            </li>
            <li class="submenu-trigger-new {{ Request::is('karigars*') ? 'active' : '' }}">
                <a href="javascript:void(0);">
                    <i class="fe fe-tool"></i>
                    <span>Karigar Management</span>
                    <i class="fas fa-chevron-right menu-arrow-new"></i>
                </a>
                <ul class="submenu-new">
                    <li class="{{ Request::is('karigars') ? 'active' : '' }}">
                        <a href="{{ route('karigars.index') }}">Karigars List</a>
                    </li>
                    <li class="{{ Request::is('karigars/create') ? 'active' : '' }}">
                        <a href="{{ route('karigars.create') }}">Add Karigar</a>
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

        <!-- Suppliers Section -->
        <div class="menu-section-title">Suppliers & Purchase</div>
        <ul class="sidebar-new-menu">
            <li class="{{ Request::is('suppliers') ? 'active' : '' }}">
                <a href="{{ route('suppliers.index') }}">
                    <i class="fe fe-truck"></i>
                    <span>Suppliers List</span>
                </a>
            </li>
            <li class="{{ Request::is('suppliers/create') ? 'active' : '' }}">
                <a href="{{ route('suppliers.create') }}">
                    <i class="fe fe-user-plus"></i>
                    <span>Add Supplier</span>
                </a>
            </li>
            <li class="{{ Request::is('purchases') ? 'active' : '' }}">
                <a href="{{ route('purchases.index') }}">
                    <i class="fe fe-shopping-bag"></i>
                    <span> Purchases Invoice</span>
                </a>
            </li>
            <li class="{{ Request::is('purchases/create') ? 'active' : '' }}">
                <a href="{{ route('purchases.create') }}">
                    <i class="fe fe-plus-square"></i>
                    <span>Add Purchase</span>
                </a>
            </li>
            <li class="{{ Request::is('wholesale-stock*', 'lot-to-tag*') ? 'active' : '' }}">
                <a href="{{ route('wholesale-stock.index') }}">
                    <i class="fe fe-layers"></i>
                    <span>Lot to Tag</span>
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

                if (submenu.style.display === "block" || getComputedStyle(submenu).display ===
                    "block") {
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

        // Auto-expand all parent menus for active routes
        var activeSubmenuItems = document.querySelectorAll(".submenu-new li.active");
        activeSubmenuItems.forEach(function(item) {
            var parentLi = item.closest(".submenu-trigger-new");
            while (parentLi) {
                parentLi.classList.add("active");
                var sub = parentLi.querySelector(".submenu-new");
                if (sub) sub.style.display = "block";
                var arr = parentLi.querySelector(".menu-arrow-new");
                if (arr) arr.className = "fas fa-chevron-down menu-arrow-new";
                parentLi = parentLi.parentElement.closest(".submenu-trigger-new");
            }
        });
    });
</script>