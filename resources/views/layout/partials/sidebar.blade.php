<!-- Sidebar -->

@if (Auth::check() && Auth::user()->role === 'superadmin')
    <div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
            <div id="sidebar-menu" class="sidebar-menu">

                <ul class="sidebar-vertical">
                    <!-- Main -->
                    <li class="menu-title"><span>superadmin</span></li>


                    <!-- /Main -->

                    <li class="submenu">
                        <a href="#"><i class="fe fe-user"></i> <span> Super Admin</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ url('dashboard') }}"
                                    class="{{ Request::is('dashboard') ? 'active' : '' }}">Dashboard</a></li>
                            <li><a href="{{ url('companies') }}"
                                    class="{{ Request::is('companies') ? 'active' : '' }}">Companies</a></li>
                            <li><a href="{{ url('subscription') }}"
                                    class="{{ Request::is('subscription') ? 'active' : '' }}">Subscription</a></li>
                            <li><a href="{{ url('packages') }}"
                                    class="{{ Request::is('packages', 'plans-list') ? 'active' : '' }}">Packages</a>
                            </li>
                            <li><a href="{{ url('domain') }}"
                                    class="{{ Request::is('domain') ? 'active' : '' }}">Domain</a></li>
                            <li><a href="{{ url('purchase-transaction') }}"
                                    class="{{ Request::is('purchase-transaction') ? 'active' : '' }}">Purchase
                                    Transaction</a></li>
                        </ul>
                    </li>



                    <!-- User Management -->
                    <li class="menu-title"><span>User Management</span></li>
                    <li>
                        <a class="{{ Request::is('createAdmin') ? 'active' : '' }}" href="{{ url('createAdmin') }}"><i
                                class="fe fe-user"></i> <span>Users</span></a>
                    </li>
                    <li>
                        <a class="{{ Request::is('roles-permission', 'permission') ? 'active' : '' }}"
                            href="{{ url('roles-permission') }}"><i class="fe fe-clipboard"></i> <span>Roles &
                                Permission</span></a>
                    </li>
                    <li>
                        <a class="{{ Request::is('delete-account-request') ? 'active' : '' }}"
                            href="{{ url('delete-account-request') }}"><i class="fe fe-trash-2"></i> <span>Delete
                                Account
                                Request</span></a>
                    </li>
                    <!-- /User Management -->

                    <!-- Membership) -->
                    <li class="menu-title"><span>Membership</span></li>
                    <li class="submenu">
                        <a href="#"><i class="fe fe-book"></i> <span> Membership</span> <span
                                class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a class="{{ Request::is('membership-plans') ? 'active' : '' }}"
                                    href="{{ url('membership-plans') }}">Membership Plans</a></li>
                            <li><a class="{{ Request::is('membership-addons') ? 'active' : '' }}"
                                    href="{{ url('membership-addons') }}">Membership Addons</a></li>
                            <li><a class="{{ Request::is('subscribers') ? 'active' : '' }}"
                                    href="{{ url('subscribers') }}">Subscribers</a></li>
                            <li><a class="{{ Request::is('transactions') ? 'active' : '' }}"
                                    href="{{ url('transactions') }}">Transactions</a></li>
                        </ul>
                    </li>
                    <!-- /Membership) -->




                    <!-- Settings -->
                    <li class="menu-title"><span>Settings</span></li>
                    <li>
                        <a class="{{ Request::is('settings', 'company-settings', 'invoice-settings', 'template-invoice', 'payment-settings', 'bank-account', 'tax-rates', 'plan-billing', 'two-factor', 'custom-filed', 'email-settings', 'preferences', 'saas-settings', 'seo-settings', 'email-template') ? 'active' : '' }}"
                            href="{{ url('settings') }}"><i class="fe fe-settings"></i> <span>Settings</span></a>
                    </li>
                    <li>
                        <a class="{{ Request::is('login') ? 'active' : '' }}" href="{{ url('login') }}"><i
                                class="fe fe-power"></i> <span>Logout</span></a>
                    </li>


                </ul>
            </div>
        </div>
    </div>
    <!-- /Sidebar -->
@endif

@if (Auth::check() && Auth::user()->role === 'admin')
    <div class="sidebar sidebar-two" id="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo">
                <a href="{{ url('index') }}">
                    <img src="{{ URL::asset('/assets/img/logo-white.png') }}" class="img-fluid logo" alt="Logo">
                </a>
                <a href="{{ url('index') }}">
                    <img src="{{ URL::asset('/assets/img/logo-small.png') }}" class="img-fluid logo-small"
                        alt="Logo">
                </a>
            </div>
        </div>
        <div class="sidebar-inner slimscroll">
            <div id="sidebar-menu" class="sidebar-menu sidebar-menu-two">
                <!-- Main -->
                <ul>
                    <li class="menu-title"><span>Main</span></li>
                    <li class="submenu">
                        <a href="#"><i class="fe fe-home"></i> <span> Dashboard</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li><a class="{{ Request::is('/', 'index') ? 'active' : '' }}"
                                    href="{{ url('/') }}">Admin Dashboard</a></li>
                        </ul>
                    </li>

                </ul>
                <!-- /Main -->

                <!-- Customers -->
                <ul>
                    <li class="menu-title"><span>Customers</span></li>
                    <li>
                        <a class="{{ Request::is('customers', 'add-customer', 'edit-customer', 'active-customers', 'deactive-customers') ? 'active' : '' }}"
                            href="{{ url('customers') }}"><i class="fe fe-users"></i> <span>Customers</span></a>
                    </li>
                    <!-- <li>
                        <a class="{{ Request::is('customer-details') ? 'active' : '' }}"
                            href="{{ url('customer-details') }}"><i class="fe fe-file"></i> <span>Customer
                                Details</span></a>
                    </li>
                    <li>
                        <a class="{{ Request::is('vendors', 'ledger', 'customers-ledger') ? 'active' : '' }}"
                            href="{{ url('vendors') }}"><i class="fe fe-user"></i> <span>Vendors</span></a>
                    </li> -->
                </ul>
                <!-- /Customers -->

                <!-- Inventory -->
                <ul>
                    <li class="menu-title"><span>Inventory</span></li>
                    <li class="submenu">
                        <a href="#"><i class="fe fe-package"></i> <span> Products</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li><a class="{{ Request::is('product-list', 'add-products', 'edit-products') ? 'active' : '' }}"
                                    href="{{ url('product-list') }}">Product List</a></li>
                            <li><a class="{{ Request::is('category') ? 'active' : '' }}"
                                    href="{{ url('category') }}">Category</a></li>
                            <li><a class="{{ Request::is('subcategory') ? 'active' : '' }}"
                                    href="{{ url('subcategory') }}">Subcategory</a></li>
                              <li><a class="{{ Request::is('metalrates') ? 'active' : '' }}"
                                    href="{{ url('metal-rates') }}">Metal Rates</a></li>
                                    <li><a class="{{ Request::is('purity') ? 'active' : '' }}"
                                    href="{{ url('purity') }}">Purity</a></li>


                            {{-- <li><a class="{{ Request::is('units') ? 'active' : '' }}"
                                    href="{{ url('units') }}">Units</a></li> --}}
                        </ul>
                    </li>
                    <li>
                        <a class="{{ Request::is('inventory', 'inventory-history') ? 'active' : '' }}"
                            href="{{ url('inventory') }}"><i class="fe fe-user"></i> <span>Inventory</span></a>
                    </li>
                </ul>
                <!-- /Inventory -->

                <!-- Signature -->
                <!-- <ul>
                    <li class="menu-title"><span>Signature</span></li>
                    <li>
                        <a class="{{ Request::is('signature-list') ? 'active' : '' }}"
                            href="{{ url('signature-list') }}"><i class="fe fe-clipboard"></i> <span>List of
                                Signature</span></a>
                        <a class="{{ Request::is('signature-invoice') ? 'active' : '' }}"
                            href="{{ url('signature-invoice') }}"><i class="fe fe-box"></i> <span>Signature
                                Invoice</span></a>
                    </li>
                </ul> -->
                <!-- /Signature -->

                <!-- Sales -->
                <ul>
                    <li class="menu-title"><span>Sales</span></li>
                    <li class="submenu">
                        <a class="{{ Request::is('invoices') ? 'active' : '' }}" href="{{ url('invoices') }}"><i
                                class="fe fe-file"></i> <span>Invoices</span></a>
                        <ul>
                            <li><a class="{{ Request::is('invoices', 'invoices-paid', 'invoices-overdue', 'invoices-cancelled', 'invoices-recurring', 'invoices-unpaid', 'invoices-refunded', 'invoices-draft') ? 'active' : '' }}"
                                    href="{{ url('invoices') }}">Invoices List</a></li>
                            <li><a class="{{ Request::is('invoice-details-admin') ? 'active' : '' }}"
                                    href="{{ url('invoice-details-admin') }}">Invoice Details (Admin)</a></li>
                            <li><a class="{{ Request::is('invoice-details') ? 'active' : '' }}"
                                    href="{{ url('invoice-details') }}">Invoice Details (Customer)</a></li>
                            <li><a class="{{ Request::is('invoice-template') ? 'active' : '' }}"
                                    href="{{ url('invoice-template') }}">Invoice Templates</a></li>
                        </ul>
                    </li>
                    <!-- <li>
                        <a class="{{ Request::is('recurring-invoices') ? 'active' : '' }}"
                            href="{{ url('recurring-invoices') }}"><i class="fe fe-clipboard"></i> <span>Recurring
                                Invoices</span></a>
                    </li>
                    <li>
                        <a class="{{ Request::is('credit-notes', 'add-credit-notes', 'edit-credit-notes') ? 'active' : '' }}"
                            href="{{ url('credit-notes') }}"><i class="fe fe-edit"></i> <span>Credit
                                Notes</span></a>
                    </li> -->
                </ul>
                <!-- /Sales -->


                <!-- Settings -->
                <ul>
                    <li class="menu-title"><span>Settings</span></li>
                    <li>
                        <a class="{{ Request::is('settings', 'company-settings', 'invoice-settings', 'template-invoice', 'payment-settings', 'bank-account', 'tax-rates', 'plan-billing', 'two-factor', 'custom-filed', 'email-settings', 'preferences', 'saas-settings', 'seo-settings', 'email-template') ? 'active' : '' }}"
                            href="{{ url('settings') }}"><i class="fe fe-settings"></i> <span>Settings</span></a>
                    </li>
                    <li>
                        <a class="{{ Request::is('login') ? 'active' : '' }}" href="{{ url('login') }}"><i
                                class="fe fe-power"></i> <span>Logout</span></a>
                    </li>
                </ul>
                <!-- /Settings -->

            </div>
        </div>
    </div>
@endif
