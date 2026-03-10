<?php $page = 'invoice-three'; ?>
@extends('layout.mainlayout')

@section('content')
<div class="container">
    <div class="invoice-wrapper download_section">
        <div class="inv-content">

            {{-- ================= HEADER ================= --}}
            <div class="invoice-header">
                <div class="inv-header-left">
                    <div class="invoice-title tax-invoice">INVOICE</div>

                    <div class="company-details">
                        <span class="company-name invoice-title">
                            {{ $business->business_name ?? '' }}
                        </span>

                        <div class="gst-details">
                            GST IN : <span>{{ $business->gst_no ?? '' }}</span>
                        </div>

                        <div class="gst-details">
                            Address :
                            <span>{{ $business->address ?? '' }}</span>
                        </div>

                        <div class="gst-details mb-0">
                            Mobile :
                            <span>{{ $business->mobile ?? '' }}</span>
                        </div>
                    </div>
                </div>

                <div class="inv-header-right">
                    <img class="logo-lightmode" src="{{ asset('/public/assets/img/logo2.png') }}">
                    <img class="logo-darkmode" src="{{ asset('/public/assets/img/logo2-white.png') }}">
                </div>
            </div>

            {{-- ================= ADDRESS ================= --}}
            <div class="invoice-address">
                <div class="invoice-address-details">
                    <div class="invoice-to">
                        <span>Billing Address:</span>
                        <div class="inv-to-address">
                            {{ $invoice->customer->name }}<br>
                            {{ $invoice->customer->address ?? '' }}<br>
                            {{ $invoice->customer->email ?? '' }}<br>
                            {{ $invoice->customer->phone ?? '' }}
                        </div>
                    </div>

                    <div class="invoice-to">
                        <span>Shipping Address:</span>
                        <div class="inv-to-address">
                            {{ $invoice->customer->shipping_address ?? $invoice->customer->address ?? '' }}
                        </div>
                    </div>
                </div>

                <div class="invoice-details-content">
                    <div class="invoice-status-details">
                        <span>Invoice No:</span>
                        <span>#{{ $invoice->invoice_no }}</span>
                    </div>

                    <div class="invoice-status-details">
                        <span>Invoice Date:</span>
                        <span>{{ date('d/m/Y', strtotime($invoice->invoice_date)) }}</span>
                    </div>

                    <div class="invoice-status-details">
                        <span>Payment Status:</span>
                        <span>
                            {{ $invoice->amount_left > 0 ? 'PARTIALLY PAID' : 'PAID' }}
                        </span>
                    </div>

                    <div class="invoice-status-details">
                        <span>Due Date :</span>
                        <span>{{ date('d/m/Y', strtotime($invoice->invoice_due_date)) }}</span>
                    </div>
                </div>
            </div>

            {{-- ================= ITEMS ================= --}}
            <div class="invoice-table">
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr class="ecommercetable">
                                <th>#</th>
                                <th>Item</th>
                                <th>Qty</th>
                                <th>Rate</th>
                                <th>Description</th>
                                <th class="text-end">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($invoice->items as $i => $item)
                            <tr>
                                <td>{{ $i+1 }}</td>
                                <td>{{ $item->product->name ?? 'Custom Item' }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>₹{{ number_format($item->rate,2) }}</td>
                                <td>
                                    Size: {{ $item->size }}<br>
                                    @foreach($item->diamonds as $d)
                                        💎 {{ $d->weight }}ct {{ $d->clarity }} {{ $d->color }}
                                        – ₹{{ number_format($d->amount,2) }}<br>
                                    @endforeach
                                    @foreach($item->stones as $s)
                                        🔹 {{ $s->stone->name ?? '' }} {{ $s->weight }}ct
                                        – ₹{{ number_format($s->amount,2) }}<br>
                                    @endforeach
                                </td>
                                <td class="text-end">
                                    ₹{{ number_format($item->final_price,2) }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- ================= TOTAL + PAYMENT ================= --}}
            <div class="invoice-table-footer mt-4">
                <div class="text-end table-footer-right">
                    <table>
                        <tbody>
                            <tr>
                                <td>Taxable Amount</td>
                                <td>₹{{ number_format($invoice->total_amount_non_tax,2) }}</td>
                            </tr>

                            <tr>
                                <td>CGST ({{ $invoice->cgst_percent }}%)</td>
                                <td>₹{{ number_format($invoice->cgst_amount,2) }}</td>
                            </tr>

                            <tr>
                                <td>SGST ({{ $invoice->sgst_percent }}%)</td>
                                <td>₹{{ number_format($invoice->sgst_amount,2) }}</td>
                            </tr>

                            <tr>
                                <td>Discount</td>
                                <td>- ₹{{ number_format($invoice->discount_amount,2) }}</td>
                            </tr>

                            <tr class="invoice-title">
                                <td>Amount Payable</td>
                                <td>₹{{ number_format($invoice->final_amount,2) }}</td>
                            </tr>

                            {{-- PAYMENT DETAILS UNDER TOTAL --}}
                            <tr>
                                <td colspan="2"><strong>Payment Details</strong></td>
                            </tr>

                            <tr>
                                <td>Cash Paid</td>
                                <td>₹{{ number_format($invoice->cash_received,2) }}</td>
                            </tr>

                            <tr>
                                <td>Online Paid</td>
                                <td>₹{{ number_format($invoice->online_received,2) }}</td>
                            </tr>

                            <tr>
                                <td>Bank Paid</td>
                                <td>₹{{ number_format($invoice->bank_received,2) }}</td>
                            </tr>

                            <tr>
                                <td><strong>Total Received</strong></td>
                                <td><strong>₹{{ number_format($invoice->total_received,2) }}</strong></td>
                            </tr>

                            <tr>
                                <td><strong>Balance Amount</strong></td>
                                <td>
                                    <strong class="{{ $invoice->amount_left > 0 ? 'text-danger' : 'text-success' }}">
                                        ₹{{ number_format($invoice->amount_left,2) }}
                                    </strong>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>

            {{-- ================= BANK ================= --}}
            <div class="bank-details">
                <div class="account-info">
                    <div>
                        <span class="bank-title">Bank Details</span>
                        <div class="account-details">Bank : <span>{{ $bank->bank_name ?? '' }}</span></div>
                        <div class="account-details">Account # : <span>{{ $bank->account_no ?? '' }}</span></div>
                        <div class="account-details">IFSC : <span>{{ $bank->ifsc_code ?? '' }}</span></div>
                        <div class="account-details">Branch : <span>{{ $bank->branch ?? '' }}</span></div>
                    </div>
                </div>
            </div>

            <div class="thanks-msg text-start">
                Thanks for your Business
            </div>

        </div>
    </div>

    <div class="file-link">
        <button class="download_btn download-link">
            <i class="feather-download-cloud me-1"></i> Download
        </button>
        <a href="javascript:window.print()" class="print-link">
            <i class="feather-printer"></i> Print
        </a>
    </div>
</div>
@endsection
