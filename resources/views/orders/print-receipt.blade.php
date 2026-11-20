<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Karigar Receipt Settlement - {{ $receipt->receipt_no }}</title>
    <link rel="stylesheet" href="{{ asset('/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/plugins/fontawesome/css/all.min.css') }}">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #fff;
            color: #212529;
            font-size: 13px;
        }
        .receipt-container {
            max-width: 800px;
            margin: 20px auto;
            padding: 30px;
            border: 1px solid #dee2e6;
            border-radius: 8px;
        }
        .header-title {
            font-size: 24px;
            font-weight: 700;
            color: #198754;
        }
        .section-header {
            background-color: #f8f9fa;
            font-weight: 600;
            padding: 6px 12px;
            border-left: 4px solid #198754;
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
            .receipt-container {
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
            <i class="fa fa-print me-1"></i> Print Receipt Voucher
        </button>
        <button onclick="window.close()" class="btn btn-secondary btn-sm ms-2">
            Close
        </button>
    </div>

    <div class="receipt-container">
        <!-- Header -->
        <div class="row align-items-center mb-4 pb-3 border-bottom">
            <div class="col-8">
                <h3 class="header-title mb-1">{{ $firm ? $firm->name : config('app.name', 'JewelERP') }}</h3>
                <div class="text-muted small">
                    Karigar Finished Jewellery Receipt & Settlement Voucher
                </div>
            </div>
            <div class="col-4 text-end">
                <span class="badge bg-success text-white p-2 fs-6">KARIGAR RECEIPT SLIP</span>
                <div class="fw-bold text-dark mt-2 fs-5">{{ $receipt->receipt_no }}</div>
                <div class="text-muted small">Date: {{ $receipt->received_date ? $receipt->received_date->format('d M Y') : '-' }}</div>
            </div>
        </div>

        <!-- Karigar & Order Info -->
        <div class="row mb-4">
            <div class="col-6">
                <div class="section-header">Artisan / Karigar Information</div>
                <h5 class="fw-bold text-dark mb-1">{{ $receipt->karigar ? $receipt->karigar->name : '-' }}</h5>
                <div class="text-muted small">
                    <div><strong>Code:</strong> {{ $receipt->karigar ? ($receipt->karigar->code ?: 'KG-' . $receipt->karigar->id) : '-' }}</div>
                    <div><strong>Workshop:</strong> {{ $receipt->karigar ? $receipt->karigar->shop_name : '-' }}</div>
                    <div><strong>Phone:</strong> {{ $receipt->karigar ? $receipt->karigar->phone : '-' }}</div>
                </div>
            </div>
            <div class="col-6">
                <div class="section-header">Work & Issue Reference</div>
                <div class="small">
                    <div><strong>Order No:</strong> <span class="fw-bold">{{ $receipt->order ? $receipt->order->order_no : '-' }}</span></div>
                    <div><strong>Item:</strong> {{ $receipt->order ? $receipt->order->item_name : '-' }}</div>
                    <div><strong>Assignment Voucher:</strong> {{ $receipt->assignment ? $receipt->assignment->assignment_no : '-' }}</div>
                    @if($receipt->huid)
                        <div><strong>Hallmark / HUID:</strong> <span class="badge bg-light text-dark border">{{ $receipt->huid }}</span></div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Metal Weight & Wastage Settlement Analysis -->
        <div class="section-header">Metal Balance & Wastage Settlement Analysis</div>
        <table class="table table-bordered table-custom small mb-4">
            <thead>
                <tr>
                    <th>Issued Weight</th>
                    <th class="text-end">Finished Net Wt</th>
                    <th class="text-end">Finished Gross Wt</th>
                    <th class="text-end">Scrap Returned</th>
                    <th class="text-end">Actual Wastage</th>
                    <th class="text-end">Allowed Wastage</th>
                    <th class="text-end">Variance (Diff)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="fw-bold text-danger">
                        {{ $receipt->assignment ? number_format($receipt->assignment->metal_issued_weight, 3) : '0.000' }} g
                    </td>
                    <td class="text-end fw-bold text-success fs-6">{{ number_format($receipt->finished_net_weight, 3) }} g</td>
                    <td class="text-end">{{ number_format($receipt->finished_gross_weight, 3) }} g</td>
                    <td class="text-end text-info fw-bold">{{ number_format($receipt->scrap_metal_returned, 3) }} g</td>
                    <td class="text-end text-warning fw-bold">{{ number_format($receipt->actual_wastage, 3) }} g</td>
                    <td class="text-end text-muted">
                        {{ $receipt->assignment ? number_format($receipt->assignment->allowed_wastage_weight, 3) : '0.000' }} g
                    </td>
                    <td class="text-end">
                        @if($receipt->wastage_difference > 0)
                            <span class="badge bg-danger">+{{ number_format($receipt->wastage_difference, 3) }} g (Loss)</span>
                        @else
                            <span class="badge bg-success">{{ number_format($receipt->wastage_difference, 3) }} g (OK)</span>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Making Charges & Settlement -->
        <div class="row mb-4">
            <div class="col-6">
                <div class="p-3 bg-light rounded border h-100 small">
                    <strong>Quality Check & Notes:</strong>
                    <div class="mt-2"><strong>QC Status:</strong> <span class="badge bg-success">{{ ucfirst($receipt->qc_status) }}</span></div>
                    @if($receipt->remarks)
                        <div class="mt-2"><strong>Remarks:</strong> {{ $receipt->remarks }}</div>
                    @endif
                </div>
            </div>
            <div class="col-6">
                <table class="table table-bordered table-custom small mb-0">
                    <tr>
                        <th class="text-muted">Finished Net Weight:</th>
                        <td class="text-end">{{ number_format($receipt->finished_net_weight, 3) }} g</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Making Charges Payable:</th>
                        <td class="text-end">₹{{ number_format($receipt->final_making_charges, 2) }}</td>
                    </tr>
                    @if($receipt->other_charges > 0)
                        <tr>
                            <th class="text-muted">Other / Polish Charges:</th>
                            <td class="text-end">₹{{ number_format($receipt->other_charges, 2) }}</td>
                        </tr>
                    @endif
                    <tr class="table-light">
                        <th class="fw-bold fs-6 text-dark">Total Payable to Karigar:</th>
                        <td class="text-end fw-bold fs-6 text-primary">₹{{ number_format($receipt->total_making_charges, 2) }}</td>
                    </tr>
                    <tr>
                        <th>Payment Status:</th>
                        <td class="text-end">
                            <span class="badge bg-{{ $receipt->payment_status == 'paid' ? 'success' : 'warning text-dark' }}">
                                {{ ucfirst($receipt->payment_status) }}
                            </span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Signatures -->
        <div class="border-top pt-5 mt-5">
            <div class="row">
                <div class="col-6">
                    <div class="border-top pt-2 text-center text-muted small" style="width: 220px;">
                        Received & Checked By (Store Manager)
                    </div>
                </div>
                <div class="col-6 text-end">
                    <div class="border-top pt-2 text-center text-muted small ms-auto" style="width: 220px;">
                        Handed Over By (Karigar Signature)
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
