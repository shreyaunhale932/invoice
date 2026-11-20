<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Order Voucher - {{ $order->order_no }}</title>
    <link rel="stylesheet" href="{{ asset('/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/plugins/fontawesome/css/all.min.css') }}">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #fff;
            color: #212529;
            font-size: 13px;
        }
        .order-container {
            max-width: 800px;
            margin: 20px auto;
            padding: 30px;
            border: 1px solid #dee2e6;
            border-radius: 8px;
        }
        .header-title {
            font-size: 24px;
            font-weight: 700;
            color: #0d6efd;
        }
        .section-header {
            background-color: #f8f9fa;
            font-weight: 600;
            padding: 6px 12px;
            border-left: 4px solid #0d6efd;
            margin-bottom: 12px;
        }
        .table-custom th {
            background-color: #f8f9fa;
            font-weight: 600;
        }
        @media print {
            .no-print {
                display: none !important;
            }
            .order-container {
                border: none;
                padding: 0;
                margin: 0;
            }
        }
    </style>
</head>
<body>

<div class="container py-3">
    <div class="text-end mb-3 no-print">
        <button onclick="window.print()" class="btn btn-primary btn-sm">
            <i class="fa fa-print me-1"></i> Print Order Sheet
        </button>
        <button onclick="window.close()" class="btn btn-secondary btn-sm ms-2">
            Close
        </button>
    </div>

    <div class="order-container">
        <!-- Firm Header -->
        <div class="row align-items-center mb-4 pb-3 border-bottom">
            <div class="col-8">
                <h3 class="header-title mb-1">{{ $firm ? $firm->name : config('app.name', 'JewelERP') }}</h3>
                <div class="text-muted small">
                    @if($firm && $firm->address) {{ $firm->address }}, @endif
                    @if($firm && $firm->city) {{ $firm->city }} - {{ $firm->pincode }} @endif
                </div>
                @if($firm && $firm->phone)
                    <div class="text-muted small"><strong>Phone:</strong> {{ $firm->phone }} | <strong>GST:</strong> {{ $firm->gst_no ?: 'N/A' }}</div>
                @endif
            </div>
            <div class="col-4 text-end">
                <span class="badge bg-light text-dark border p-2 fs-6">CUSTOMER ORDER</span>
                <div class="fw-bold text-primary mt-2 fs-5">{{ $order->order_no }}</div>
                <div class="text-muted small">Date: {{ $order->order_date ? $order->order_date->format('d M Y') : '-' }}</div>
            </div>
        </div>

        <!-- Customer & Due Date Box -->
        <div class="row mb-4">
            <div class="col-6">
                <div class="section-header">Customer Details</div>
                <h6 class="fw-bold mb-1">{{ $order->customer ? $order->customer->name : 'Walk-in Customer' }}</h6>
                <div class="text-muted small">
                    @if($order->customer && $order->customer->phone)
                        <div><strong>Phone:</strong> {{ $order->customer->phone }}</div>
                    @endif
                    @if($order->customer && $order->customer->address)
                        <div><strong>Address:</strong> {{ $order->customer->address }}, {{ $order->customer->city }}</div>
                    @endif
                </div>
            </div>
            <div class="col-6">
                <div class="section-header">Order Milestones</div>
                <table class="table table-sm table-borderless mb-0 small">
                    <tr>
                        <td class="text-muted" style="width: 45%;">Order Placed:</td>
                        <td class="fw-bold">{{ $order->order_date ? $order->order_date->format('d M Y') : '-' }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Promised Delivery:</td>
                        <td class="fw-bold text-danger">{{ $order->due_date ? $order->due_date->format('d M Y') : 'TBD' }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Priority:</td>
                        <td><span class="badge bg-light text-dark border">{{ ucfirst($order->priority) }}</span></td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Jewellery Item Details -->
        <div class="section-header">Jewellery Specifications</div>
        <div class="row mb-4">
            <div class="col-8">
                <table class="table table-bordered table-custom small">
                    <tr>
                        <th style="width: 35%;">Item Name</th>
                        <td class="fw-bold">{{ $order->item_name }}</td>
                    </tr>
                    <tr>
                        <th>Metal & Purity</th>
                        <td>{{ $order->metal_type }} ({{ $order->purity ?: 'Standard' }})</td>
                    </tr>
                    <tr>
                        <th>Category / Subcategory</th>
                        <td>{{ $order->category ? $order->category->category_name : '-' }} / {{ $order->subcategory ? $order->subcategory->subcategory_name : '-' }}</td>
                    </tr>
                    <tr>
                        <th>Expected Net Weight</th>
                        <td class="fw-bold text-primary">{{ number_format($order->expected_net_weight, 3) }} g</td>
                    </tr>
                    <tr>
                        <th>Expected Gross Weight</th>
                        <td>{{ number_format($order->expected_gross_weight, 3) }} g</td>
                    </tr>
                    @if($order->size)
                        <tr>
                            <th>Size / Dimensions</th>
                            <td>{{ $order->size }}</td>
                        </tr>
                    @endif
                    @if($order->design_code)
                        <tr>
                            <th>Design / Catalog Code</th>
                            <td>{{ $order->design_code }}</td>
                        </tr>
                    @endif
                </table>
            </div>
            <div class="col-4 text-center">
                @if($order->image)
                    <img src="{{ asset($order->image) }}" class="img-fluid rounded border p-1" style="max-height: 170px; object-fit: contain;" alt="Design">
                    <small class="text-muted d-block mt-1">Design Reference</small>
                @else
                    <div class="border rounded p-4 text-muted bg-light h-100 d-flex align-items-center justify-content-center">
                        <div>
                            <i class="fa fa-gem fa-2x mb-1"></i>
                            <div class="small">No Photo Attached</div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        @if($order->specifications)
            <div class="p-3 bg-light rounded border mb-4">
                <strong class="d-block mb-1 text-primary">Customization Instructions:</strong>
                <p class="mb-0 small" style="white-space: pre-line;">{{ $order->specifications }}</p>
            </div>
        @endif

        <!-- Financial Summary -->
        <div class="section-header">Financials & Advance Receipt</div>
        <div class="row mb-4">
            <div class="col-6">
                <div class="p-3 bg-light rounded border h-100 small">
                    <strong>Advance Payment Details:</strong>
                    <div class="mt-2">Amount Paid: <span class="fw-bold text-success">₹{{ number_format($order->advance_amount, 2) }}</span> ({{ $order->advance_payment_mode ?: 'Cash' }})</div>
                    @if($order->advance_metal_weight > 0)
                        <div>Old Gold Deposited: <span class="fw-bold text-info">{{ number_format($order->advance_metal_weight, 3) }} g</span></div>
                    @endif
                </div>
            </div>
            <div class="col-6">
                <table class="table table-bordered table-custom small mb-0">
                    <tr>
                        <th class="text-muted">Estimated Metal Rate:</th>
                        <td class="text-end">₹{{ number_format($order->estimated_rate, 2) }}/g</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Estimated Making Charges:</th>
                        <td class="text-end">₹{{ number_format($order->estimated_making_charges, 2) }}</td>
                    </tr>
                    <tr>
                        <th class="fw-bold text-dark">Estimated Total Amount:</th>
                        <td class="text-end fw-bold text-primary">₹{{ number_format($order->estimated_total_amount, 2) }}</td>
                    </tr>
                    <tr>
                        <th class="text-success">Advance Paid:</th>
                        <td class="text-end text-success fw-bold">- ₹{{ number_format($order->advance_amount, 2) }}</td>
                    </tr>
                    <tr class="table-light">
                        <th class="text-danger fw-bold fs-6">Estimated Balance Due:</th>
                        <td class="text-end text-danger fw-bold fs-6">₹{{ number_format($order->balance_amount, 2) }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Terms & Signatures -->
        <div class="border-top pt-4 mt-5">
            <div class="row align-items-end">
                <div class="col-6">
                    <div class="text-muted small">
                        * Note: Final billing amount will be adjusted based on the exact finished gold weight and ruling gold rate on delivery.
                    </div>
                </div>
                <div class="col-3 text-center">
                    <div class="border-top pt-1 small text-muted">Customer Signature</div>
                </div>
                <div class="col-3 text-center">
                    <div class="border-top pt-1 small text-muted">Authorised Signatory</div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
