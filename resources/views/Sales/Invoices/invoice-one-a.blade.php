<?php $page = 'invoice-one-a'; ?>
@extends('layout.mainlayout')
@section('content')
@php
    use App\Helpers\NumberHelper;
@endphp
<style>
/* =========================
   PRINT FIX – ADD ONLY
   ========================= */
   .container,
    .container-fluid {
        max-width: none !important;
        width: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
    }
    .invoice-wrapper{
        max-width: none !important;
        width: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
    }
@media print {
     .company-details {
    background: var(--color-gradient, linear-gradient(320deg, #DBECFF 0%, #DDCEFF 100%)) !important;
    border-radius: 14px 77px 14px 14px !important;
}
  
}
/* =====================================================
   PRINT CSS – ULTRA COMPACT (ALL INVOICES)
   ===================================================== */
@media print {

    /* -----------------------------
       PAGE RESET
       ----------------------------- */
    html, body {
        margin: 0 !important;
        padding: 0 !important;
        width: 100% !important;
        height: 100% !important;
        font-size: 9.5px !important;
        line-height: 1.2 !important;
        font-family: Arial, Helvetica, sans-serif !important;
    }

    /* Hide everything except invoice */
    body * {
        visibility: hidden !important;
    }

    .download_section,
    .download_section * {
        visibility: visible !important;
    }

    /* -----------------------------
       CONTAINER / WRAPPER
       ----------------------------- */
    .container,
    .container-fluid,
    .invoice-one,
    .invoice-wrapper {
        max-width: 100% !important;
        width: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
    }

    .download_section {
        position: absolute;
        top: 0;
        left: 0;
        width: 210mm !important;
        min-height: 297mm;
        padding: 6mm !important;
        background: #fff !important;
    }

    /* -----------------------------
       HEADINGS
       ----------------------------- */
       .add-details{
        font-size: 9.5px !important;
       }
       .invoice-table-footer{
        padding: 0px !important;
       }
    h4 {
        font-size: 15px !important;
        margin: 0 0 3px !important;
    }

    h5 {
        font-size: 11px !important;
        margin: 0 0 4px !important;
    }

    h6 {
        font-size: 9.5px !important;
        margin: 0 0 2px !important;
    }
    span{
        font-size: 9.5px !important;
    }

    p {
        margin: 0 0 3px !important;
        font-size: 9px !important;
    }

    /* -----------------------------
       HEADER COMPRESSION
       ----------------------------- */
    .invoice-header {
        margin-bottom: 6px !important;
        padding-bottom: 4px !important;
    }

    .invoice-one .inv-content .invoice-header .inv-header-left {
        width: 60% !important;
    }

    .company-details {
        padding: 6px !important;
        border-radius: 10px 55px 10px 10px !important;
    }

    .gst-details {
        padding: 8px 12px !important;
        margin: 0 !important;
        color: #fff !important;
    }

    /* LOGO – MUCH SMALLER */
    .invoice-one .inv-header-right a img {
        max-width: 140px !important;
        margin-bottom: 4px !important;
    }

    /* -----------------------------
       CUSTOMER INFO
       ----------------------------- */
    .patient-infos {
        margin-bottom: 6px !important;
    }

    .patient-detailed {
        padding: 4px !important;
    }

    .bill-add {
        font-size: 9px !important;
        margin-bottom: 1px !important;
    }

    .customer-name,
    .payment-status {
        font-size: 9px !important;
    }

    /* -----------------------------
       TABLE COMPRESSION
       ----------------------------- */
    table {
        width: 100% !important;
        table-layout: fixed !important;
        border-collapse: collapse !important;
    }

    thead {
        display: table-header-group;
    }

    th {
        font-size: 10px !important;
        padding: 3px !important;
    }

    td {
        font-size: 10px !important;
        padding: 3px !important;
        word-break: break-word;
    }

    tr {
        page-break-inside: avoid;
    }

    /* -----------------------------
       TOTALS / PAYMENT BLOCKS
       ----------------------------- */
    .invoice-table-footer {
        margin-top: 4px !important;
        padding-top: 4px !important;
        page-break-inside: avoid;
    }

    .invoice-table-footer table td {
        font-size: 10px !important;
        padding: 2px 3px !important;
    }

    .totalamount-footer td {
        font-size: 10px !important;
    }

    /* -----------------------------
       QR + TERMS
       ----------------------------- */
    .qr img {
        max-width: 70px !important;
    }

    .scan-details {
        font-size: 8.5px !important;
        margin-top: 2px !important;
    }

    .terms-condition ol {
        padding-left: 12px !important;
        margin: 0 !important;
    }

    .terms-condition li {
        font-size: 8.5px !important;
        line-height: 1.2 !important;
    }

    /* -----------------------------
       FINAL MESSAGE
       ----------------------------- */
    .thanks-msg {
        font-size: 9px !important;
        margin-top: 6px !important;
        text-align: center;
    }

    /* -----------------------------
       HIDE ACTION BUTTONS
       ----------------------------- */
    .file-link {
        display: none !important;
    }

    /* -----------------------------
       PRESERVE COLORS
       ----------------------------- */
    * {
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }
        .invoice-table-footer .notes img {
        max-width: 70px !important;
    }

    /* -----------------------------
       PAGE SETUP
       ----------------------------- */
    @page {
        size: A4;
        margin: 0;
    }
}

</style>


    <div class="container">
        <div class="invoice-wrapper download_section">
            <div class="inv-content">
                <span class="line"></span>
                <div class="invoice-header">
                    <div class="inv-header-left">
                        <h4>Invoice</h4>
                        <div class="company-details">
                            <div class="gst-details">
                                <h6>Dreamguys Technologies Pvt Ltd</h6>
                                <span>Address:15 Hodges Mews,<br> High Wycombe HP12 3JL, United Kingdom.</span>
                            </div>
                            <div class="address-bg"></div>
                        </div>
                    </div>
                    <div class="inv-header-right">
                        <a href="#">
                            <img class="logo-lightmode" src="{{ URL::asset('/public/assets/img/logo2.png') }}" alt="Logo">
                            <img class="logo-darkmode" src="{{ URL::asset('/public/assets/img/logo2-white.png') }}" alt="Logo">

                        </a>
                        <h6>Invoice No : <span> #{{ $invoice->invoice_no}}</span></h6>
                        <h6>Invoice Date :<span> {{ date('d-m-Y', strtotime($invoice->invoice_date)) }}</span></h6>
                        <p> <span>Due Date :{{ date('d-m-Y', strtotime($invoice->invoice_due_date )) }}</span></p>

                    </div>

                </div>
                <span class="line"></span>
                <h5>Customer Information</h5>
                <div class="patient-infos">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class=" patient-detailed">
                                <div class="bill-add">
                                    Customer Details :
                                </div>
                                <div class="customer-name">
                                   {{ $customer->name }}
                                    <p><span>GSTIN : {{ $customer->gstin }}</span> </p>
                                </div>
                                <div class="payment-status">
                                    Payment Status <p><span> {{ $invoice->payment_status }}</span> </p>
                                </div>

                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class=" patient-detailed">
                                <div class="bill-add">
                                    Billing Address :
                                </div>
                                <div class="add-details">
                                    {{ $customer->address1 }}
                                </div>


                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class=" patient-detailed">
                                <div class="bill-add">
                                    Shipping Address :
                                </div>
                                <div class="add-details">
                                    @if($invoice->shipping_address)
                                    {{ $invoice->shipping_address }}
                                    @else
                                    {{ $customer->address1 }}
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="invoice-table">
                    <div class="table-responsive">
                        <table>
    <thead>
        <tr class="ecommercetable">
            <th>#</th>
            <th class="text-start">Category</th>
            <th class="text-start">Item</th>
            <th class="text-start">Qty</th>
            <th class="text-start">Metal Rate</th>
            <th class="text-start">Gross Wt</th>
            <th class="text-start">Net Wt</th>
            <th class="text-start">Making</th>
            <th class="text-start">Other Charges</th>
            <th class="text-end">Amount</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($invoice->items as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>

                <td>{{ $item->category }}</td>

                <td>
                    {{ $item->item_name }}
                    @if($item->purity)
                        <small>({{ $item->purity }})</small>
                    @endif
                </td>

                <td>{{ $item->quantity }}</td>

                <td>{{ number_format($item->metal_rate, 2) }}</td>

                <td>{{ number_format($item->gross_weight, 3) }}</td>

                <td>{{ number_format($item->net_weight, 3) }}</td>

                <td>{{ number_format($item->making_charges, 2) }}</td>

                <td>{{ number_format($item->other_charges, 2) }}</td>

                <td class="text-end">
                    {{ number_format($item->total_amount, 2) }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

                    </div>
                </div>
                @php
    /* ===============================
     | BASIC AMOUNTS
     =============================== */
    $taxableAmount = $invoice->total_amount_non_tax ?? 0;

    $cgstPercent = $invoice->cgst_percent ?? 0;
    $sgstPercent = $invoice->sgst_percent ?? 0;

    $cgstAmount = $invoice->cgst_amount ?? 0;
    $sgstAmount = $invoice->sgst_amount ?? 0;
    $igstAmount = $invoice->igst_amount ?? 0;

    $discountPercent = $invoice->discount_percent ?? 0;
    $discountAmount  = $invoice->discount_amount ?? 0;

    /* ===============================
     | TOTAL CALCULATION
     =============================== */
    $grossTotal = $taxableAmount
                + $cgstAmount
                + $sgstAmount
                + $igstAmount
                - $discountAmount;

    $finalAmount = round($grossTotal);
    $roundOff = $finalAmount - $grossTotal;

    /* ===============================
     | PAYMENT DETAILS
     =============================== */
    $cash   = $invoice->cash_received ?? 0;
    $online = $invoice->online_received ?? 0;
    $bank   = $invoice->bank_received ?? 0;

    $totalReceived = $cash + $online + $bank;
    $balanceAmount = $finalAmount - $totalReceived;

    /* ===============================
     | INVOICE STATUS
     =============================== */
    if ($balanceAmount <= 0) {
        $status = 'paid';
    } elseif ($totalReceived > 0) {
        $status = 'partial';
    } else {
        $status = 'pending';
    }
@endphp

{{-- ===============================
 | TAX / GST / DISCOUNT
 =============================== --}}
<div class="invoice-table-footer">
    <div class="table-footer-left notes">
        @if($status === 'paid')
            <img src="{{ asset('/public/assets/img/paid.svg') }}" alt="Paid">
        @elseif($status === 'partial')
            <span class="badge bg-warning">Partially Paid</span>
        @else
            <span class="badge bg-danger">Unpaid</span>
        @endif
    </div>

    <div class="table-footer-right text-end">
        <table>
            <tbody>
                <tr>
                    <td>Taxable Amount</td>
                    <td>₹{{ number_format($taxableAmount, 2) }}</td>
                </tr>

                @if($igstAmount > 0)
                    <tr>
                        <td>IGST {{ $cgstPercent + $sgstPercent }}%</td>
                        <td>₹{{ number_format($igstAmount, 2) }}</td>
                    </tr>
                @else
                    <tr>
                        <td>CGST {{ $cgstPercent }}%</td>
                        <td>₹{{ number_format($cgstAmount, 2) }}</td>
                    </tr>
                    <tr>
                        <td>SGST {{ $sgstPercent }}%</td>
                        <td>₹{{ number_format($sgstAmount, 2) }}</td>
                    </tr>
                @endif

                @if($discountAmount > 0)
                    <tr>
                        <td>Discount ({{ $discountPercent }}%)</td>
                        <td>-₹{{ number_format($discountAmount, 2) }}</td>
                    </tr>
                @endif

                <tr>
                    <td>Round Off</td>
                    <td>{{ $roundOff >= 0 ? '+' : '' }}₹{{ number_format($roundOff, 2) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

{{-- ===============================
 | TOTAL AMOUNT
 =============================== --}}
<div class="invoice-table-footer totalamount-footer">
    <div class="table-footer-right">
        <table class="totalamt-table">
            <tbody>
                <tr>
                    <td><strong>Total Amount</strong></td>
                    <td><strong>₹{{ number_format($finalAmount, 2) }}</strong></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

{{-- ===============================
 | AMOUNT RECEIVED
 =============================== --}}
<div class="invoice-table-footer payment-footer">
    <div class="table-footer-right">
        <table class="totalamt-table">
            <tbody>

                @if($cash > 0)
                <tr>
                    <td>Cash Received</td>
                    <td>₹{{ number_format($cash, 2) }}</td>
                </tr>
                @endif

                @if($online > 0)
                <tr>
                    <td>Online Received</td>
                    <td>₹{{ number_format($online, 2) }}</td>
                </tr>
                @endif

                @if($bank > 0)
                <tr>
                    <td>Bank Received</td>
                    <td>₹{{ number_format($bank, 2) }}</td>
                </tr>
                @endif

                <tr>
                    <td><strong>Total Received</strong></td>
                    <td><strong>₹{{ number_format($totalReceived, 2) }}</strong></td>
                </tr>

                <tr>
                    <td>
                        <strong>
                            {{ $balanceAmount > 0 ? 'Balance Due' : 'Change Return' }}
                        </strong>
                    </td>
                    <td>
                        <strong>₹{{ number_format(abs($balanceAmount), 2) }}</strong>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</div>

                <div class="total-amountdetails">
                    <p>Total amount ( in words): <span> {{ NumberHelper::convertToWords(abs($finalAmount)) }}.</span></p>
                </div>
                <div class="bank-details">
                    <div class="row">
                        <div class="col md-6">
                            <div class="payment-info">
                                <div class="qr">
                                    <img src="{{ URL::asset('/public/assets/img/qr-code.svg') }}" alt="qr">
                                    <h6 class="scan-details">Scan to View Receipt</h6>
                                </div>
                                <div class="pay-details">
                                    <span class="payment-title">Payment Info:</span>
                                    <div><span>Debit Card :</span> 465 *************645</div>
                                    <div class="mb-0"><span>Amount :</span> $1,815</div>
                                </div>

                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="terms-condition">
                                <span>Terms & Conditions:</span>
                                <ol>
                                    <li> Goods Once sold cannot be taken back or exchanged</li>
                                    <li> We are not the manufactures, company will stand for warrenty as per their terms and
                                        conditions.</li>
                                </ol>
                            </div>
                        </div>


                    </div>


                </div>


                <div class="thanks-msg text-center">
                    Thanks for your Business
                </div>
            </div>
        </div>
        <div class="file-link">
            <button class="download_btn download-link">
                <i class="feather-download-cloud me-1"></i> <span>Download</span>
            </button>
            <a href="javascript:void(0)" onclick="printInvoiceSection()" class="print-link">
    <i class="feather-printer"></i> <span>Print</span>
</a>

        </div>

    </div>
    <script>
    function printInvoiceSection() {
        // const printContents = document.querySelector('.print-section').innerHTML;
        // const originalContents = document.body.innerHTML;

        // document.body.innerHTML = printContents;

        window.print();

        // document.body.innerHTML = originalContents;
        // window.location.reload(); // ensure JS & layout restored properly
    }
</script>

@endsection
