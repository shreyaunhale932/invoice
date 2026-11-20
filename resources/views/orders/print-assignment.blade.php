<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Karigar Issue Job Card - {{ $assignment->assignment_no }}</title>
    <link rel="stylesheet" href="{{ asset('/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/plugins/fontawesome/css/all.min.css') }}">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #fff;
            color: #212529;
            font-size: 13px;
        }
        .challan-container {
            max-width: 800px;
            margin: 20px auto;
            padding: 30px;
            border: 1px solid #dee2e6;
            border-radius: 8px;
        }
        .header-title {
            font-size: 24px;
            font-weight: 700;
            color: #d63384;
        }
        .section-header {
            background-color: #f8f9fa;
            font-weight: 600;
            padding: 6px 12px;
            border-left: 4px solid #d63384;
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
            .challan-container {
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
            <i class="fa fa-print me-1"></i> Print Job Card
        </button>
        <button onclick="window.close()" class="btn btn-secondary btn-sm ms-2">
            Close
        </button>
    </div>

    <div class="challan-container">
        <!-- Header -->
        <div class="row align-items-center mb-4 pb-3 border-bottom">
            <div class="col-8">
                <h3 class="header-title mb-1">{{ $firm ? $firm->name : config('app.name', 'JewelERP') }}</h3>
                <div class="text-muted small">
                    Workshop Manufacturing Challan & Job Card
                </div>
            </div>
            <div class="col-4 text-end">
                <span class="badge bg-danger text-white p-2 fs-6">KARIGAR ISSUE CHALLAN</span>
                <div class="fw-bold text-dark mt-2 fs-5">{{ $assignment->assignment_no }}</div>
                <div class="text-muted small">Date: {{ $assignment->assigned_date ? $assignment->assigned_date->format('d M Y') : '-' }}</div>
            </div>
        </div>

        <!-- Karigar & Order Reference Info -->
        <div class="row mb-4">
            <div class="col-6">
                <div class="section-header">Artisan / Karigar Details</div>
                <h5 class="fw-bold text-dark mb-1">{{ $assignment->karigar ? $assignment->karigar->name : 'N/A' }}</h5>
                <div class="text-muted small">
                    <div><strong>Code:</strong> {{ $assignment->karigar ? ($assignment->karigar->code ?: 'KG-' . $assignment->karigar->id) : '-' }}</div>
                    <div><strong>Workshop:</strong> {{ $assignment->karigar ? $assignment->karigar->shop_name : '-' }}</div>
                    <div><strong>Phone:</strong> {{ $assignment->karigar ? $assignment->karigar->phone : '-' }}</div>
                </div>
            </div>
            <div class="col-6">
                <div class="section-header">Work Order Reference</div>
                <div class="small">
                    <div><strong>Order No:</strong> <span class="fw-bold text-primary">{{ $assignment->order ? $assignment->order->order_no : '-' }}</span></div>
                    <div><strong>Jewellery Item:</strong> {{ $assignment->order ? $assignment->order->item_name : '-' }}</div>
                    <div><strong>Expected Delivery Date:</strong> <span class="fw-bold text-danger">{{ $assignment->expected_delivery_date ? $assignment->expected_delivery_date->format('d M Y') : 'TBD' }}</span></div>
                </div>
            </div>
        </div>

        <!-- Material Handed Over -->
        <div class="section-header">Raw Material Issued (In Hand)</div>
        <div class="table-responsive mb-4">
            <table class="table table-bordered table-custom">
                <thead>
                    <tr>
                        <th>Material Description</th>
                        <th>Purity</th>
                        <th class="text-end">Issued Weight</th>
                        <th class="text-end">Allowed Wastage</th>
                        <th class="text-end">Agreed Making Rate</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="fw-bold">{{ $assignment->metal_issued_type }}</td>
                        <td>{{ $assignment->metal_issued_purity ?: '-' }}</td>
                        <td class="text-end fw-bold text-danger fs-6">{{ number_format($assignment->metal_issued_weight, 3) }} g</td>
                        <td class="text-end text-muted">
                            {{ number_format($assignment->allowed_wastage_weight, 3) }} g ({{ $assignment->allowed_wastage_percent }}%)
                        </td>
                        <td class="text-end fw-bold">
                            ₹{{ number_format($assignment->making_charge_rate, 2) }}
                            <small class="text-muted">{{ $assignment->making_charge_type == 'per_gram' ? '/g' : 'flat' }}</small>
                        </td>
                    </tr>
                    @if($assignment->stones_issued_weight > 0 || $assignment->stones_issued_pieces > 0)
                        <tr>
                            <td colspan="2">
                                <strong>Stones Issued:</strong> {{ $assignment->stones_issued_description ?: 'Packet / CZ Stones' }}
                            </td>
                            <td class="text-end fw-bold">{{ number_format($assignment->stones_issued_weight, 3) }} g</td>
                            <td colspan="2" class="text-muted">{{ $assignment->stones_issued_pieces }} pieces</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Design Preview & Target Specs -->
        <div class="row mb-4">
            <div class="col-8">
                <div class="section-header">Target Specifications</div>
                <table class="table table-sm table-bordered small">
                    <tr>
                        <th style="width: 40%;">Target Net Weight</th>
                        <td class="fw-bold text-success">{{ $assignment->order ? number_format($assignment->order->expected_net_weight, 3) . ' g' : '-' }}</td>
                    </tr>
                    <tr>
                        <th>Size / Dimensions</th>
                        <td>{{ $assignment->order ? $assignment->order->size : '-' }}</td>
                    </tr>
                    <tr>
                        <th>Design Reference</th>
                        <td>{{ $assignment->order ? $assignment->order->design_code : '-' }}</td>
                    </tr>
                </table>

                @if($assignment->instructions)
                    <div class="p-2 bg-light rounded border mt-3 small">
                        <strong>Artisan Guidelines / Instructions:</strong>
                        <div class="mt-1">{{ $assignment->instructions }}</div>
                    </div>
                @endif
            </div>
            <div class="col-4 text-center">
                @if($assignment->order && $assignment->order->image)
                    <img src="{{ asset($assignment->order->image) }}" class="img-fluid rounded border p-1" style="max-height: 160px; object-fit: contain;" alt="Design">
                    <small class="text-muted d-block mt-1">Design Photo</small>
                @endif
            </div>
        </div>

        <!-- Signatures -->
        <div class="border-top pt-5 mt-5">
            <div class="row">
                <div class="col-6">
                    <div class="border-top pt-2 text-center text-muted small" style="width: 220px;">
                        Material Issued By (Jeweller)
                    </div>
                </div>
                <div class="col-6 text-end">
                    <div class="border-top pt-2 text-center text-muted small ms-auto" style="width: 220px;">
                        Material Received By (Karigar Signature)
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
