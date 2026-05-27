<!-- Redesigned V2 Dashboard Content -->
@extends('layout.newlayout')

@section('content')
<div class="page-wrapper page-wrapper-new">
    <div class="dashboard-v2">

        <!-- Greeting Banner -->
        <div class="greeting-banner-new">
            <div class="greeting-text-box">
                @php
                    $hour = date('H');
                    $greeting = 'Good morning';
                    if ($hour >= 12 && $hour < 17) {
                        $greeting = 'Good afternoon';
                    } elseif ($hour >= 17) {
                        $greeting = 'Good evening';
                    }

                    $firmName = Session::get('selected_firm_name', 'Sirsonite Solutions Admin');
                @endphp
                <h2>{{ $greeting }}, {{ $firmName }}!</h2>
                <p>Here's what's happening with your business today.</p>
                <div class="greeting-info-pills">
                    <div class="info-pill-new">
                        <i class="fe fe-calendar"></i>
                        {{ date('l, d F Y') }}
                    </div>
                    <div class="info-pill-new">
    <i class="fe fe-clock"></i>
    {{ \Carbon\Carbon::now('Asia/Kolkata')->format('h:i A') }}
</div>
                </div>
            </div>
            <!-- Optional Illustration Area for the right side of the banner -->
            <div class="banner-illustration-box">
                <!-- SVG placeholder for a modern business illustration -->
                <svg width="180" height="120" viewBox="0 0 180 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="20" y="40" width="140" height="70" rx="8" fill="rgba(255,255,255,0.2)"/>
                    <rect x="40" y="60" width="100" height="10" rx="4" fill="rgba(255,255,255,0.5)"/>
                    <rect x="40" y="80" width="70" height="10" rx="4" fill="rgba(255,255,255,0.3)"/>
                    <path d="M100 20 L130 50 L110 50 L110 80 L90 80 L90 50 L70 50 Z" fill="rgba(255,255,255,0.8)"/>
                </svg>
            </div>
        </div>

        <!-- Filter Section -->
        <div style="display: flex; justify-content: flex-end; margin-bottom: 16px;">
            <form id="filterForm" method="GET" action="{{ route('admin.dashboard') }}">
                <select name="filter" onchange="document.getElementById('filterForm').submit()" style="padding: 8px 16px; border-radius: 8px; border: 1px solid var(--border-color); font-family: var(--font-family); font-size: 13px; color: var(--text-main); background: #fff; cursor: pointer; outline: none; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
                    <option value="all" {{ ($filter ?? 'all') == 'all' ? 'selected' : '' }}>All Time</option>
                    <option value="today" {{ ($filter ?? '') == 'today' ? 'selected' : '' }}>Today</option>
                    <option value="week" {{ ($filter ?? '') == 'week' ? 'selected' : '' }}>This Week</option>
                    <option value="month" {{ ($filter ?? '') == 'month' ? 'selected' : '' }}>This Month</option>
                    <option value="year" {{ ($filter ?? '') == 'year' ? 'selected' : '' }}>This Year</option>
                </select>
            </form>
        </div>

        <!-- 3-Column Stats Grid -->
        <div class="dashboard-grid-new">

            <!-- Column 1: Overview -->
            <div class="column-card-new">
                <div class="column-header-new">
                    <i class="fe fe-pie-chart"></i>
                    <h3>Overview</h3>
                </div>
                <div class="column-items-grid">
                    <div class="stat-item-new">
                        <div class="stat-icon-container bg-light-purple">
                            <i class="fas fa-file-invoice"></i>
                        </div>
                        <div class="stat-details-box">
                            <span class="stat-label-new">Total Invoices</span>
                            <span class="stat-value-new">{{ number_format($invoicesCount ?? 0) }}</span>
                        </div>
                    </div>

                    <div class="stat-item-new">
                        <div class="stat-icon-container bg-light-green">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-details-box">
                            <span class="stat-label-new">Total Customers</span>
                            <span class="stat-value-new">{{ number_format($customersCount ?? 0) }}</span>
                        </div>
                    </div>

                    <div class="stat-item-new">
                        <div class="stat-icon-container bg-light-yellow">
                            <i class="fas fa-indian-rupee-sign"></i>
                        </div>
                        <div class="stat-details-box">
                            <span class="stat-label-new">Amount Due</span>
                            <span class="stat-value-new">₹{{ number_format($amountDue ?? 0, 2) }}</span>
                        </div>
                    </div>

                    <!-- <div class="stat-item-new">
                        <div class="stat-icon-container bg-light-blue">
                            <i class="far fa-file-alt"></i>
                        </div>
                        <div class="stat-details-box">
                            <span class="stat-label-new">Quotations</span>
                            <span class="stat-value-new">{{ number_format($estimatesCount ?? 0) }}</span>
                        </div>
                    </div> -->
                </div>
            </div>

            <!-- Column 2: Sales Analytics -->
            <div class="column-card-new">
                <div class="column-header-new">
                    <i class="fe fe-trending-up"></i>
                    <h3>Sales Analytics</h3>
                </div>
                <div class="column-items-grid">
                    <div class="stat-item-new">
                        <div class="stat-icon-container bg-light-green">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="stat-details-box">
                            <span class="stat-label-new">Total Sales</span>
                            <span class="stat-value-new">₹{{ number_format($totalSales ?? 0, 2) }}</span>
                        </div>
                    </div>

                    <div class="stat-item-new">
                        <div class="stat-icon-container bg-light-yellow">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div class="stat-details-box">
                            <span class="stat-label-new">Expenses</span>
                            <span class="stat-value-new">₹{{ number_format($expenses ?? 0, 2) }}</span>
                        </div>
                    </div>

                    <div class="stat-item-new">
                        <div class="stat-icon-container bg-light-blue">
                            <i class="fas fa-hand-holding-usd"></i>
                        </div>
                        <div class="stat-details-box">
                            <span class="stat-label-new">Amount Received</span>
                            <span class="stat-value-new">₹{{ number_format($receipts ?? 0, 2) }}</span>
                        </div>
                    </div>

                    <div class="stat-item-new">
                        <div class="stat-icon-container bg-light-purple">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                        <div class="stat-details-box">
                            <span class="stat-label-new">Amount Due</span>
                            <span class="stat-value-new">₹{{ number_format($amountDue ?? 0, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Column 3: Invoice Statistics -->
            <div class="column-card-new">
                <div class="column-header-new">
                    <i class="fe fe-bar-chart-2"></i>
                    <h3>Invoice Statistics</h3>
                </div>
                <div class="column-items-grid">
                    <div class="stat-item-new">
                        <div class="stat-icon-container bg-light-purple">
                            <i class="fas fa-file-invoice-dollar"></i>
                        </div>
                        <div class="stat-details-box">
                            <span class="stat-label-new">Total Invoiced</span>
                            <span class="stat-value-new">₹{{ number_format($totalSales ?? 0, 2) }}</span>
                        </div>
                    </div>

                    <div class="stat-item-new">
                        <div class="stat-icon-container bg-light-green">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="stat-details-box">
                            <span class="stat-label-new">Amount Received</span>
                            <span class="stat-value-new">₹{{ number_format($receipts ?? 0, 2) }}</span>
                        </div>
                    </div>

                    <div class="stat-item-new">
                        <div class="stat-icon-container bg-light-yellow">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="stat-details-box">
                            <span class="stat-label-new">Outstanding</span>
                            <span class="stat-value-new">₹{{ number_format($amountDue ?? 0, 2) }}</span>
                        </div>
                    </div>

                </div>
            </div>

        </div> <!-- /dashboard-grid-new -->

        <!-- Analytics and Charts Lower Grid -->
        <div class="dashboard-lower-grid">
            <!-- Left Column: Sales Chart -->
            <div class="chart-card-new">
                <div class="column-header-new">
                    <i class="fe fe-activity"></i>
                    <h3>Revenue Over Time</h3>
                </div>
                <!-- The ApexChart will render inside this div -->
                <div id="salesChart"></div>
            </div>

            <!-- Right Column: Leaderboards -->
            <div class="leaderboard-card-new">
                <!-- Top Customers -->
                <div>
                    <div class="column-header-new" style="margin-bottom: 12px;">
                        <i class="fe fe-star"></i>
                        <h3>Top Customers</h3>
                    </div>
                    <div>
                        @forelse($topCustomers as $cust)
                            <div class="list-item-new">
                                <div class="list-item-left">
                                    <div class="list-avatar-new">{{ substr($cust->name ?? 'C', 0, 1) }}</div>
                                    <div class="list-info-new">
                                        <h4>{{ $cust->name ?? 'Unknown' }}</h4>
                                        <p>{{ $cust->phone ?? 'No phone' }}</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted" style="font-size: 13px;">No customer data available.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Fast Selling Categories/Products -->
                <div>
                    <div class="column-header-new" style="margin-bottom: 12px;">
                        <i class="fe fe-trending-up"></i>
                        <h3>Fast Selling Items</h3>
                    </div>
                    <div>
                        @forelse($fastSellingItems as $item)
                            <div class="list-item-new">
                                <div class="list-item-left">
                                    <div class="list-avatar-new" style="background: rgba(255, 184, 0, 0.1); color: #FFB800;">
                                        <i class="fe fe-box"></i>
                                    </div>
                                    <div class="list-info-new">
                                        <h4>{{ $item->product_name ?? 'Item' }}</h4>
                                        <p>Barcode: {{ $item->barcode ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted" style="font-size: 13px;">No item data available.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Invoices Table -->
        <div class="table-card-new">
            <div class="column-header-new">
                <i class="fe fe-file-text"></i>
                <h3>Recent Invoices</h3>
            </div>
            <div style="overflow-x: auto;">
                <table class="table-new">
                    <thead>
                        <tr>
                            <th>Invoice #</th>
                            <th>Customer</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentInvoices as $invoice)
                            <tr>
                                <td><strong>{{ $invoice->invoice_no ?? 'N/A' }}</strong></td>
                                <td>{{ $invoice->customer->name ?? 'Unknown Customer' }}</td>
                                <td>{{ $invoice->created_at ? $invoice->created_at->format('d M Y') : 'N/A' }}</td>
                                <td><strong style="color: #111111;">₹{{ number_format($invoice->final_amount ?? 0, 2) }}</strong></td>
                                <td>
                                    @if(($invoice->amount_left ?? 0) <= 0)
                                        <span class="status-badge status-paid">Paid</span>
                                    @else
                                        <span class="status-badge status-unpaid">Due</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="text-align: center; color: var(--text-muted);">No recent invoices found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div> <!-- /dashboard-v2 -->
</div>
@endsection

@section('scripts')
<script src="{{ asset('assets/plugins/apexchart/apexcharts.min.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var salesLabels = {!! json_encode($salesLabels ?? []) !!};
    var salesData = {!! json_encode($salesData ?? []) !!};

    var options = {
        series: [{
            name: 'Revenue',
            data: salesData
        }],
        chart: {
            height: 350,
            type: 'area',
            toolbar: {
                show: false
            },
            fontFamily: "'Inter', sans-serif"
        },
        colors: ['#5E58E3'],
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth',
            width: 3
        },
        fill: {
            type: 'gradient',
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.4,
                opacityTo: 0.05,
                stops: [0, 90, 100]
            }
        },
        xaxis: {
            categories: salesLabels,
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            }
        },
        yaxis: {
            labels: {
                formatter: function (value) {
                    return "₹" + value.toLocaleString();
                }
            }
        },
        grid: {
            borderColor: '#ECECF5',
            strokeDashArray: 4,
        }
    };

    if(document.querySelector("#salesChart")) {
        var chart = new ApexCharts(document.querySelector("#salesChart"), options);
        chart.render();
    }
});
</script>
@endsection
