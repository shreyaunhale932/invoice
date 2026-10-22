@extends('layout.mainlayout')

@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="container-fluid p-0">

            <style>
                .form-control:focus, .form-select:focus {
                    box-shadow: none !important;
                    border-color: #764ba2 !important;
                }
                .form-label, label, .entry-label {
                    display: block;
                    font-size: 12px;
                    font-weight: 600;
                    color: #4a5568;
                    margin-bottom: 4px;
                }
                .form-select, .form-control {
                    font-size: 12px;
                    color: #1a202c;
                    border-radius: 6px;
                    padding: 6px 10px;
                    background-color: #f8fafc;
                    border: 1px solid #cbd5e1;
                }
                .form-control:focus, .form-select:focus {
                    background-color: #ffffff;
                }
                .glass-card {
                    background: rgba(255, 255, 255, 0.9);
                    backdrop-filter: blur(10px);
                    -webkit-backdrop-filter: blur(10px);
                    border: 1px solid rgba(255, 255, 255, 0.3);
                    box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.08);
                    border-radius: 12px;
                    transition: all 0.3s ease;
                }
                .section-header {
                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                    font-weight: 600;
                    font-size: 13px;
                    display: block;
                    color: #fff;
                    padding: 7px 12px;
                    margin-bottom: 14px;
                    border-radius: 6px;
                }
                /* 6-Column Grid Layout matching photo */
                .entry-grid-container {
                    display: flex;
                    flex-wrap: wrap;
                    gap: 14px;
                    background: rgba(248, 250, 252, 0.8);
                    padding: 18px;
                    border-radius: 10px;
                    border: 1px solid #e2e8f0;
                }
                .entry-grid-col {
                    flex: 1 1 calc(16.666% - 14px);
                    min-width: 130px;
                }
                @media (max-width: 1200px) {
                    .entry-grid-col { flex: 1 1 calc(33.333% - 14px); }
                }
                @media (max-width: 768px) {
                    .entry-grid-col { flex: 1 1 calc(50% - 14px); }
                }
                @media (max-width: 480px) {
                    .entry-grid-col { flex: 1 1 100%; }
                }
                .glass-card th {
                    background: rgba(118, 75, 162, 0.1) !important;
                    color: #4a5568 !important;
                    font-weight: 600 !important;
                    font-size: 11px !important;
                    text-transform: uppercase;
                    border-color: rgba(0, 0, 0, 0.08) !important;
                    padding: 8px 10px;
                }
                .glass-card td {
                    border-color: rgba(0, 0, 0, 0.08) !important;
                    padding: 8px 10px;
                    vertical-align: middle;
                    font-size: 12px;
                }
                .pre-code-suggestions {
                    position: absolute;
                    top: 100%;
                    left: 0;
                    right: 0;
                    z-index: 1050;
                    max-height: 200px;
                    overflow-y: auto;
                    background: #fff;
                    border: 1px solid #cbd5e1;
                    border-radius: 6px;
                    box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
                }
                .pre-code-item {
                    cursor: pointer;
                    transition: background 0.15s;
                }
                .pre-code-item:hover {
                    background: #f1f5f9;
                }
                .custom-btn-primary {
                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                    border: none;
                    color: #fff;
                    font-weight: 500;
                }
                .custom-btn-primary:hover {
                    background: linear-gradient(135deg, #5a67d8 0%, #6b46af 100%);
                    color: #fff;
                }
            </style>

            <!-- Page Header -->
            <div class="page-header mb-4">
                <div class="row align-items-center">
                    <div class="col">
                        <h4 class="fw-bold text-dark mb-0">Add  Purchase</h4>
                        <ul class="breadcrumb small text-muted mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('purchases.index') }}">Wholesale Purchases</a></li>
                            <li class="breadcrumb-item active">New Purchase</li>
                        </ul>
                    </div>
                    <div class="col-auto">
                        <a href="{{ route('purchases.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fa fa-arrow-left me-1"></i> Back to List
                        </a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                    <strong>Please fix the errors below:</strong>
                    <ul class="mb-0 mt-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('purchases.store') }}" method="POST" id="purchaseForm">
                @csrf

                <!-- BASIC DETAILS (SUPPLIER & PURCHASE INFO) -->
                <div class="card glass-card mb-4 p-4">
                    <span class="section-header"><i class="fa fa-user me-2"></i>Supplier & Purchase Information</span>
                    <div class="row g-3">
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <label>Purchase Invoice No <span class="text-danger">*</span></label>
                            <input type="text" name="purchase_no" class="form-control fw-bold text-primary" value="{{ old('purchase_no', $purchaseNo) }}" placeholder="e.g. IP001" required>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <label>Select Supplier / Vendor <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <select name="supplier_id" class="form-select select" required>
                                    <option value="">-- Choose Supplier --</option>
                                    @foreach($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                            {{ $supplier->name }} {{ $supplier->shop_name ? '('.$supplier->shop_name.')' : '' }}
                                        </option>
                                    @endforeach
                                </select>
                                <a href="{{ route('suppliers.create') }}" target="_blank" class="btn custom-btn-primary btn-sm" title="Add Supplier"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-12">
                            <label>Purchase Date <span class="text-danger">*</span></label>
                            <input type="date" name="purchase_date" class="form-control" value="{{ old('purchase_date', date('Y-m-d')) }}" required>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-12">
                            <label>Supplier Bill / Ref No</label>
                            <input type="text" name="reference_no" class="form-control" placeholder="Supplier Bill / Ref No" value="{{ old('reference_no') }}">
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-12">
                            <label>Payment Status</label>
                            <select name="status" class="form-select">
                                <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed / Received</option>
                                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- 18-FIELD ITEM ENTRY FORM (MATCHING USER PHOTO) -->
                <div class="card glass-card mb-4 p-4">
                    <span class="section-header"><i class="fa fa-box-open me-2"></i>Product Entry Form</span>

                    <div class="entry-grid-container">
                        <!-- ROW 1 -->
                        <div class="entry-grid-col">
                            <label class="entry-label">Category <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <select id="entry_category_id" class="form-select">
                                    <option value="">-- Select Category --</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->category_id ?? $cat->id }}">{{ $cat->category_name }}</option>
                                    @endforeach
                                </select>
                                <button type="button" class="btn custom-btn-primary text-white btn-sm px-2" data-bs-toggle="modal" data-bs-target="#addCategoryModal" title="Add Category">+</button>
                            </div>
                        </div>
                        <div class="entry-grid-col">
                            <label class="entry-label">SubCategory <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <select id="entry_subcategory_id" class="form-select">
                                    <option value="">-- Select Subcategory --</option>
                                </select>
                                <button type="button" class="btn custom-btn-primary text-white btn-sm px-2" data-bs-toggle="modal" data-bs-target="#addSubcategoryModal" title="Add Subcategory">+</button>
                            </div>
                        </div>
                        <div class="entry-grid-col position-relative">
                            <label class="entry-label">Item Code</label>
                            <input type="text" id="entry_pre_code" class="form-control text-uppercase fw-bold text-primary" placeholder="e.g. DEF" autocomplete="off">
                            <div class="dropdown-menu pre-code-suggestions shadow-sm border-0 p-0" id="entryPreCodeSuggestions"></div>
                        </div>
                        <div class="entry-grid-col">
                            <label class="entry-label">Product Name <span class="text-danger">*</span></label>
                            <input type="text" id="entry_item_name" class="form-control fw-bold" placeholder="Product Name">
                        </div>
                        <div class="entry-grid-col">
                            <label class="entry-label">Purity / Metal Rate</label>
                            <select id="entry_metal_rate_id" class="form-select">
                                <option value="">Select Purity/Metal Rate</option>
                                @foreach ($metalRates as $rate)
                                    <option value="{{ $rate->id }}"
                                        data-price="{{ $rate->price_per_gram }}"
                                        data-metal="{{ strtolower($rate->metal_type) }}"
                                        data-karat="{{ (float) $rate->karat }}"
                                        data-purity-type="{{ $rate->purity_type }}">
                                        {{ $rate->metal_type }} - ₹{{ $rate->price_per_gram }}/gm - {{ $rate->karat }}{{ $rate->purity_type === 'karat' ? 'KT' : '%' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="entry-grid-col">
                            <label class="entry-label">Rate (₹/g)</label>
                            <input type="number" id="entry_metal_rate" class="form-control text-end fw-bold" placeholder="0.00" step="any" min="0">
                        </div>

                        <!-- ROW 2 -->
                        <div class="entry-grid-col">
                            <label class="entry-label">Qty</label>
                            <input type="number" id="entry_quantity" class="form-control text-center fw-bold" value="1" step="any" min="0.01">
                        </div>
                        <div class="entry-grid-col">
                            <label class="entry-label">GS Wt (g)</label>
                            <input type="number" id="entry_gross_weight" class="form-control text-end" placeholder="0.000" step="any" min="0">
                        </div>
                        <div class="entry-grid-col">
                            <label class="entry-label">Net Wt (g)</label>
                            <input type="number" id="entry_net_weight" class="form-control text-end fw-bold text-success" value="0.000" step="any" readonly>
                        </div>
                        <div class="entry-grid-col">
                            <label class="entry-label">Fn Wt (g)</label>
                            <input type="number" id="entry_final_fn_weight" class="form-control text-end" value="0.000" step="any" readonly>
                        </div>
                        <div class="entry-grid-col">
                            <label class="entry-label">Size</label>
                            <input type="text" id="entry_size" class="form-control" placeholder="Size / Dimension">
                        </div>
                        <div class="entry-grid-col">
                            <label class="entry-label">Wastage %</label>
                            <input type="number" id="entry_wastage_percent" class="form-control text-end" value="0.00" step="any" min="0">
                        </div>

                        <!-- ROW 3 -->
                        <div class="entry-grid-col">
                            <label class="entry-label">Wastage Amt</label>
                            <input type="number" id="entry_wastage_amount" class="form-control text-end" value="0.00" step="any" readonly>
                        </div>
                        <div class="entry-grid-col">
                            <label class="entry-label">Mkg (₹)</label>
                            <input type="number" id="entry_making_price" class="form-control text-end" value="0.00" step="any" min="0">
                        </div>
                        <div class="entry-grid-col">
                            <label class="entry-label">Mkg Type</label>
                            <select id="entry_making_type" class="form-select">
                                <option value="per_gram">/g (Per Gram)</option>
                                <option value="fixed">Fix (Fixed)</option>
                            </select>
                        </div>
                        <div class="entry-grid-col">
                            <label class="entry-label">Mkg Amt (₹)</label>
                            <input type="number" id="entry_making_final_amount" class="form-control text-end" value="0.00" step="any" readonly>
                        </div>
                        <div class="entry-grid-col">
                            <label class="entry-label">Gold Price (₹)</label>
                            <input type="number" id="entry_gold_price" class="form-control text-end" value="0.00" step="any" readonly>
                        </div>
                        <div class="entry-grid-col">
                            <label class="entry-label">Final price (₹)</label>
                            <input type="number" id="entry_final_price" class="form-control text-end fw-bold text-primary fs-6" value="0.00" step="any" readonly>
                        </div>
                    </div>

                    <!-- ENTRY ACTIONS & PACKET BUTTON -->
                    <div class="d-flex justify-content-between align-items-center mt-3 pt-2">
                        <div>
                            <button type="button" class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#entryPacketModal">
                                <i class="fa fa-layer-group me-1"></i> Diamonds / Stones (<span id="entryPacketBadge">0</span> Packets)
                            </button>
                        </div>
                        <div>
                            <button type="button" class="btn custom-btn-primary px-4 font-weight-bold" id="addEntryToListBtn">
                                <i class="fa fa-plus-circle me-1"></i> Add Product To Wholesale Stock List
                            </button>
                        </div>
                    </div>
                </div>

                <!-- PURCHASE WHOLESALE STOCK LIST TABLE -->
                <div class="card glass-card mb-4 p-4">
                    <span class="section-header mb-3"><i class="fa fa-list me-2"></i>Purchase Wholesale Stock List</span>

                    <div class="table-responsive">
                        <table class="table table-bordered mb-0 align-middle" id="wholesaleStockTable">
                            <thead>
                                <tr>
                                    <th style="width: 40px;" class="text-center">#</th>
                                    <th style="min-width: 180px;">Product Name & Code</th>
                                    <th style="min-width: 150px;">Category / SubCategory</th>
                                    <th style="width: 60px;" class="text-center">Qty</th>
                                    <th style="min-width: 140px;">Weights (Gross / Net / Fn)</th>
                                    <th style="min-width: 120px;">Wastage (% / Amt)</th>
                                    <th style="min-width: 140px;">Rate & Making</th>
                                    <th style="min-width: 110px;" class="text-end">Gold Price</th>
                                    <th style="min-width: 120px;" class="text-end">Final Price</th>
                                    <th style="width: 80px;" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody id="wholesaleStockListBody">
                                <tr id="emptyStockRow">
                                    <td colspan="10" class="text-center py-4 text-muted">
                                        <i class="fa fa-info-circle me-1"></i> No items in Purchase Wholesale Stock List yet. Fill the entry form above and click "Add Product To Wholesale Stock List".
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- PACKETS ENTRY MODAL -->
                <div class="modal fade" id="entryPacketModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-light py-2">
                                <h5 class="modal-title font-weight-bold text-dark fs-6"><i class="fa fa-layer-group me-2 text-primary"></i>Diamonds & Stones Setup for Product Entry</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body p-3">
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0 packet-table" id="entryPacketTable">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>Packet No</th>
                                                <th>Type</th>
                                                <th>Pcs</th>
                                                <th>Weight (g/ct)</th>
                                                <th>Rate (₹)</th>
                                                <th>Amount (₹)</th>
                                                <th>Stone</th>
                                                <th>Clarity</th>
                                                <th>Color</th>
                                                <th>Cut</th>
                                                <th>Shape</th>
                                                <th>Cert No</th>
                                                <th class="text-center"><i class="fa fa-trash"></i></th>
                                            </tr>
                                        </thead>
                                        <tbody id="entryPacketTbody">
                                            <!-- Packet rows appended via JS -->
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-2 text-end">
                                    <button type="button" class="btn btn-sm custom-btn-primary" id="addEntryPacketRowBtn">
                                        <i class="fa fa-plus me-1"></i> Add Packet Row
                                    </button>
                                </div>
                            </div>
                            <div class="modal-footer bg-light py-2">
                                <button type="button" class="btn custom-btn-primary btn-sm" data-bs-dismiss="modal" id="entryPacketDoneBtn">Done & Update Entry</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SUMMARY & PAYMENT BREAKDOWN -->
                <div class="row g-4 mb-4">
                    <!-- LEFT: PURCHASE SUMMARY & NOTES -->
                    <div class="col-lg-5 col-md-12">
                        <div class="card glass-card p-4 h-100">
                            <span class="section-header mb-3"><i class="fa fa-calculator me-2"></i>Purchase Summary</span>
                            
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Subtotal (Items Total):</span>
                                <span class="fw-bold fs-6" id="subtotalSpan">₹0.00</span>
                            </div>
                            
                            <div class="row align-items-center mb-2">
                                <div class="col-5 text-muted">Discount:</div>
                                <div class="col-7 d-flex gap-1">
                                    <input type="number" name="discount_percent" id="discountPercent" class="form-control form-control-sm" placeholder="%" step="any" min="0">
                                    <input type="number" name="discount_amount" id="discountAmount" class="form-control form-control-sm" placeholder="Amount" step="any" min="0">
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between mb-2 pb-2 border-bottom">
                                <span class="text-muted">Taxable Amount:</span>
                                <span class="fw-bold" id="taxableSpan">₹0.00</span>
                            </div>

                            <!-- Taxes -->
                            <div class="row g-2 mb-2">
                                <div class="col-4">
                                    <label class="small text-muted mb-0">CGST %</label>
                                    <input type="number" name="cgst_percent" id="cgstPercent" class="form-control form-control-sm" value="1.5" step="any" min="0">
                                </div>
                                <div class="col-4">
                                    <label class="small text-muted mb-0">SGST %</label>
                                    <input type="number" name="sgst_percent" id="sgstPercent" class="form-control form-control-sm" value="1.5" step="any" min="0">
                                </div>
                                <div class="col-4">
                                    <label class="small text-muted mb-0">IGST %</label>
                                    <input type="number" name="igst_percent" id="igstPercent" class="form-control form-control-sm" value="0" step="any" min="0">
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Total Tax:</span>
                                <span class="fw-bold text-dark" id="taxTotalSpan">₹0.00</span>
                            </div>

                            <div class="row align-items-center mb-2">
                                <div class="col-6 text-muted">Other Charges:</div>
                                <div class="col-6">
                                    <input type="number" name="other_charges" id="otherCharges" class="form-control form-control-sm" value="0.00" step="any" min="0">
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Round Off:</span>
                                <span id="roundOffSpan">₹0.00</span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center py-2 px-3 rounded bg-light border my-2">
                                <h5 class="mb-0 font-weight-bold text-dark">Grand Total:</h5>
                                <h3 class="mb-0 text-primary font-weight-bold" id="grandTotalSpan">₹0.00</h3>
                            </div>

                            <div class="mt-3 pt-3 border-top">
                                <label class="form-label font-weight-bold"><i class="fa fa-sticky-note-o me-1 text-muted"></i>Purchase Notes / Batch Info</label>
                                <textarea name="notes" class="form-control" rows="3" placeholder="Enter purchase remarks, vendor invoice notes, lot info...">{{ old('notes') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- RIGHT: PAYMENT BREAKDOWN -->
                    <div class="col-lg-7 col-md-12">
                        <div class="card glass-card p-4 h-100">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="section-header mb-0 flex-grow-1 me-2"><i class="fa fa-credit-card me-2"></i>Payment Breakdown</span>
                                <span class="badge bg-primary fs-12 text-white py-2 px-3" id="totalPaymentsBadge">Total Paid: ₹0.00</span>
                            </div>

                            <!-- Gold / Metal Payment (Gold to Gold & Gold + Amount) -->
                            <div class="payment-method-section mb-3 p-3 rounded border" style="background: rgba(255, 243, 205, 0.6); border-color: #ffeba7 !important;">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="fw-bold text-dark"><i class="fa fa-coins text-warning me-1"></i> Gold / Metal Payment (Gold to Gold & Gold + Amount)</span>
                                    <span class="badge bg-warning text-dark font-weight-bold" id="goldPaymentStatusBadge">Gold to Gold / Metal Mode</span>
                                </div>
                                <div class="row g-2 align-items-end">
                                    <div class="col-md-3 col-6">
                                        <label class="small text-muted mb-1">Metal Given (g)</label>
                                        <input type="number" name="gold_payment_grams" id="goldPaymentGrams" class="form-control form-control-sm" placeholder="0.000" step="any" min="0" value="{{ old('gold_payment_grams', '0.000') }}">
                                    </div>
                                    <div class="col-md-2 col-6">
                                        <label class="small text-muted mb-1">Purity %</label>
                                        <input type="number" name="gold_payment_purity" id="goldPaymentPurity" class="form-control form-control-sm" placeholder="100" step="any" min="0" max="100" value="{{ old('gold_payment_purity', '100') }}">
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <label class="small text-muted mb-1">Fine Wt (g)</label>
                                        <input type="number" name="gold_payment_fine_wt" id="goldPaymentFineWt" class="form-control form-control-sm bg-light" readonly placeholder="0.000" step="any" value="{{ old('gold_payment_fine_wt', '0.000') }}">
                                    </div>
                                    <div class="col-md-4 col-6">
                                        <label class="small text-muted mb-1">Metal Rate (₹/g)</label>
                                        <input type="number" name="gold_payment_rate" id="goldPaymentRate" class="form-control form-control-sm" placeholder="₹0.00" step="any" min="0" value="{{ old('gold_payment_rate', '0.00') }}">
                                    </div>
                                </div>

                                <div class="row g-2 mt-2 pt-2 border-top align-items-center">
                                    <div class="col-md-6 col-12">
                                        <span class="small text-muted">Gold Equivalent Value:</span>
                                        <span class="fw-bold text-success ms-1" id="goldPaymentValueSpan">₹0.00</span>
                                        <input type="hidden" name="gold_payment_amount" id="goldPaymentAmount" value="{{ old('gold_payment_amount', '0.00') }}">
                                    </div>
                                    <div class="col-md-6 col-12 text-md-end">
                                        <span class="small text-muted">Remaining Metal Wt:</span>
                                        <span class="fw-bold text-danger ms-1" id="remainingMetalWtSpan">0.000 g</span>
                                        <input type="hidden" name="remaining_metal_wt" id="remainingMetalWt" value="{{ old('remaining_metal_wt', '0.000') }}">
                                        <input type="hidden" name="remaining_metal_amount" id="remainingMetalAmount" value="{{ old('remaining_metal_amount', '0.00') }}">
                                    </div>
                                </div>
                            </div>

                            <!-- Cash Payments -->
                            <div class="payment-method-section mb-3 p-2 bg-light rounded border">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="fw-bold text-dark"><i class="fa fa-money me-1 text-success"></i> Cash Payments</span>
                                    <button type="button" class="btn btn-sm btn-success add-payment-row-btn" data-method="cash">
                                        <i class="fa fa-plus me-1"></i> + Cash Row
                                    </button>
                                </div>
                                <div class="payment-rows-container" id="cashPaymentsContainer"></div>
                            </div>

                            <!-- Card Payments -->
                            <div class="payment-method-section mb-3 p-2 bg-light rounded border">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="fw-bold text-dark"><i class="fa fa-credit-card me-1 text-primary"></i> Card Payments</span>
                                    <button type="button" class="btn btn-sm btn-success add-payment-row-btn" data-method="card">
                                        <i class="fa fa-plus me-1"></i> + Card Row
                                    </button>
                                </div>
                                <div class="payment-rows-container" id="cardPaymentsContainer"></div>
                            </div>

                            <!-- Cheque Payments -->
                            <div class="payment-method-section mb-3 p-2 bg-light rounded border">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="fw-bold text-dark"><i class="fa fa-pencil-square-o me-1 text-warning"></i> Cheque Payments</span>
                                    <button type="button" class="btn btn-sm btn-success add-payment-row-btn" data-method="cheque">
                                        <i class="fa fa-plus me-1"></i> + Cheque Row
                                    </button>
                                </div>
                                <div class="payment-rows-container" id="chequePaymentsContainer"></div>
                            </div>

                            <!-- UPI Payments -->
                            <div class="payment-method-section mb-3 p-2 bg-light rounded border">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="fw-bold text-dark"><i class="fa fa-qrcode me-1 text-info"></i> UPI Payments</span>
                                    <button type="button" class="btn btn-sm btn-success add-payment-row-btn" data-method="upi">
                                        <i class="fa fa-plus me-1"></i> + UPI Row
                                    </button>
                                </div>
                                <div class="payment-rows-container" id="upiPaymentsContainer"></div>
                            </div>

                            <hr>

                            <!-- Remaining Amount Summary -->
                            <div class="d-flex justify-content-between align-items-center p-3 rounded bg-light border">
                                <span class="fw-bold text-dark fs-6"><i class="fa fa-balance-scale me-2 text-danger"></i>Remaining Balance:</span>
                                <h5 class="text-danger fw-bold mb-0 fs-5" id="remainingAmountText">₹0.00</h5>
                                <input type="hidden" name="paid_amount" id="paidAmountInput" value="0.00">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SUBMIT ACTION -->
                <div class="card glass-card mb-4 p-3">
                    <div class="text-end">
                        <a href="{{ route('purchases.index') }}" class="btn btn-light border me-2">Cancel</a>
                        <button type="submit" class="btn custom-btn-primary px-4"><i class="fa fa-save me-1"></i> Save Wholesale Purchase & Update Stock</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
$(document).ready(function() {
    let listIndex = 0;
    let entryPackets = [];
    let editingRow = null;

    function renderEntryPacketRows() {
        let tbody = $('#entryPacketTbody');
        tbody.empty();
        entryPackets.forEach((pkt, idx) => {
            let tr = document.createElement('tr');
            tr.innerHTML = `
                <td><select class="form-select form-select-sm pkt-no-select">${buildPacketNoOptionsHtml(pkt.packet_no || '')}</select></td>
                <td><select class="form-select form-select-sm pkt-type">${buildOptionsHtml(packetTypes, pkt.packet_type || 'Diamond')}</select></td>
                <td><input type="number" class="form-control form-control-sm pkt-pcs" value="${pkt.pcs || 1}"></td>
                <td><input type="number" class="form-control form-control-sm pkt-wt" value="${pkt.wt_in_gram || 0}" step="any"></td>
                <td><input type="number" class="form-control form-control-sm pkt-rate" value="${pkt.rate || 0}" step="any"></td>
                <td><input type="number" class="form-control form-control-sm pkt-amt" value="${pkt.amount || 0}" step="any"></td>
                <td><select class="form-select form-select-sm pkt-stone">${buildOptionsHtml(stones, pkt.stone)}</select></td>
                <td><select class="form-select form-select-sm pkt-clarity">${buildOptionsHtml(clarities, pkt.clarity)}</select></td>
                <td><select class="form-select form-select-sm pkt-color">${buildOptionsHtml(colors, pkt.color)}</select></td>
                <td><select class="form-select form-select-sm pkt-cut">${buildOptionsHtml(cuts, pkt.cut)}</select></td>
                <td><select class="form-select form-select-sm pkt-shape">${buildOptionsHtml(shapes, pkt.shape)}</select></td>
                <td><input type="text" class="form-control form-control-sm pkt-cert" value="${pkt.certificate_no || ''}" placeholder="Cert #"></td>
                <td class="text-center"><button type="button" class="btn btn-sm btn-outline-danger remove-entry-pkt-btn"><i class="fa fa-times"></i></button></td>
            `;
            tbody.append(tr);
        });
    }

    // EDIT ROW FROM WHOLESALE STOCK LIST TABLE
    $(document).on('click', '.edit-list-row-btn', function() {
        let tr = $(this).closest('tr');
        editingRow = tr;

        let itemName    = tr.find('input[name*="[item_name]"]').val() || '';
        let catId       = tr.find('input[name*="[category_id]"]').val() || '';
        let subcatId    = tr.find('input[name*="[subcategory_id]"]').val() || '';
        let preCode     = tr.find('input[name*="[pre_code]"]').val() || '';
        let qty         = tr.find('input[name*="[quantity]"]').val() || '1';
        let grossWt     = tr.find('input[name*="[gross_weight]"]').val() || '';
        let netWt       = tr.find('input[name*="[net_weight]"]').val() || '';
        let fineWt      = tr.find('input[name*="[final_fn_weight]"]').val() || '';
        let size        = tr.find('input[name*="[size]"]').val() || '';
        let wastagePerc = tr.find('input[name*="[wastage_percent]"]').val() || '0.00';
        let purchaseRate= tr.find('input[name*="[purchase_rate]"]').val() || '0.00';
        let makingPrice = tr.find('input[name*="[making_price]"]').val() || '0.00';
        let makingType  = tr.find('input[name*="[making_type]"]').val() || 'per_gram';

        $('#entry_item_name').val(itemName);
        $('#entry_pre_code').val(preCode);
        $('#entry_quantity').val(qty);
        $('#entry_gross_weight').val(grossWt);
        $('#entry_net_weight').val(netWt);
        $('#entry_final_fn_weight').val(fineWt);
        $('#entry_size').val(size);
        $('#entry_wastage_percent').val(wastagePerc);
        $('#entry_metal_rate').val(purchaseRate);
        $('#entry_making_price').val(makingPrice);
        $('#entry_making_type').val(makingType);

        let matchedRate = false;
        $('#entry_metal_rate_id option').each(function() {
            if (parseFloat($(this).data('price')) === parseFloat(purchaseRate)) {
                $('#entry_metal_rate_id').val($(this).val());
                matchedRate = true;
                return false;
            }
        });
        if (!matchedRate) {
            $('#entry_metal_rate_id').val('');
        }

        if (catId) {
            $('#entry_category_id').val(catId).trigger('change', [subcatId]);
        } else {
            $('#entry_category_id').val('').trigger('change');
        }

        // Reconstruct entryPackets for editing
        entryPackets = [];
        let packetMap = {};
        tr.find('input[name*="[packets]"]').each(function() {
            let name = $(this).attr('name');
            let match = name.match(/\[packets\]\[(\d+)\]\[(\w+)\]/);
            if (match) {
                let pIdx = match[1];
                let field = match[2];
                if (!packetMap[pIdx]) packetMap[pIdx] = {};
                let val = $(this).val();
                if (field === 'pcs' || field === 'wt_in_gram' || field === 'rate' || field === 'amount') {
                    val = parseFloat(val) || 0;
                }
                packetMap[pIdx][field] = val;
            }
        });
        Object.keys(packetMap).forEach(k => {
            entryPackets.push(packetMap[k]);
        });

        $('#entryPacketBadge').text(entryPackets.length);
        renderEntryPacketRows();

        recalculateEntryForm();

        $('#addEntryToListBtn')
            .html('<i class="fa fa-sync-alt me-1"></i> Update Product in Wholesale Stock List')
            .removeClass('custom-btn-primary').addClass('btn-warning text-dark');

        $('html, body').animate({
            scrollTop: $('#entry_item_name').closest('.card').offset().top - 80
        }, 300);
    });

    // ADD / UPDATE ITEM FROM ENTRY FORM TO PURCHASE WHOLESALE STOCK LIST TABLE
    $('#addEntryToListBtn').on('click', function() {
        let itemName = $('#entry_item_name').val().trim();
        let metalRate = parseFloat($('#entry_metal_rate').val()) || 0;

        if (!itemName) {
            alert('Please enter a Product Name before adding to list.');
            $('#entry_item_name').focus();
            return;
        }

        let catId = $('#entry_category_id').val();
        let catName = $('#entry_category_id option:selected').text();
        if (!catId) catName = '-';

        let subcatId = $('#entry_subcategory_id').val();
        let subcatName = $('#entry_subcategory_id option:selected').text();
        if (!subcatId) subcatName = '-';

        let preCode = $('#entry_pre_code').val().trim();
        let purityId = $('#entry_purity_id').val() || '';

        let qty = parseFloat($('#entry_quantity').val()) || 1;
        let grossWt = parseFloat($('#entry_gross_weight').val()) || 0;
        let netWt = parseFloat($('#entry_net_weight').val()) || 0;
        let fineWt = parseFloat($('#entry_final_fn_weight').val()) || 0;
        let size = $('#entry_size').val().trim();
        let wastagePerc = parseFloat($('#entry_wastage_percent').val()) || 0;
        let wastageAmt = parseFloat($('#entry_wastage_amount').val()) || 0;
        let mkg = parseFloat($('#entry_making_price').val()) || 0;
        let mkgType = $('#entry_making_type').val() || 'per_gram';
        let mkgAmt = parseFloat($('#entry_making_final_amount').val()) || 0;
        let goldPrice = parseFloat($('#entry_gold_price').val()) || 0;
        let finalPrice = parseFloat($('#entry_final_price').val()) || 0;

        let targetIdx = listIndex;
        if (editingRow) {
            let existingNameAttr = editingRow.find('input[name*="[item_name]"]').attr('name');
            let matchIndex = existingNameAttr ? existingNameAttr.match(/items\[(\d+)\]/) : null;
            if (matchIndex) {
                targetIdx = matchIndex[1];
            }
        }

        // Construct hidden packet inputs
        let packetsHiddenHtml = '';
        let packetWtSum = 0;
        let packetAmtSum = 0;

        entryPackets.forEach((pkt, pIdx) => {
            packetWtSum += pkt.wt_in_gram;
            packetAmtSum += pkt.amount;
            packetsHiddenHtml += `
                <input type="hidden" name="items[${targetIdx}][packets][${pIdx}][packet_no]" value="${pkt.packet_no}">
                <input type="hidden" name="items[${targetIdx}][packets][${pIdx}][packet_type]" value="${pkt.packet_type}">
                <input type="hidden" name="items[${targetIdx}][packets][${pIdx}][pcs]" value="${pkt.pcs}">
                <input type="hidden" name="items[${targetIdx}][packets][${pIdx}][wt_in_gram]" value="${pkt.wt_in_gram}">
                <input type="hidden" name="items[${targetIdx}][packets][${pIdx}][rate]" value="${pkt.rate}">
                <input type="hidden" name="items[${targetIdx}][packets][${pIdx}][amount]" value="${pkt.amount}">
                <input type="hidden" name="items[${targetIdx}][packets][${pIdx}][stone]" value="${pkt.stone}">
                <input type="hidden" name="items[${targetIdx}][packets][${pIdx}][clarity]" value="${pkt.clarity}">
                <input type="hidden" name="items[${targetIdx}][packets][${pIdx}][color]" value="${pkt.color}">
                <input type="hidden" name="items[${targetIdx}][packets][${pIdx}][cut]" value="${pkt.cut}">
                <input type="hidden" name="items[${targetIdx}][packets][${pIdx}][shape]" value="${pkt.shape}">
                <input type="hidden" name="items[${targetIdx}][packets][${pIdx}][certificate_no]" value="${pkt.certificate_no}">
            `;
        });

        $('#emptyStockRow').remove();

        let rowInnerHtml = `
            <td class="text-center fw-bold row-number"></td>
            <td>
                <div class="fw-bold text-dark">${itemName}</div>
                <div class="small text-muted">${preCode ? 'Code: ' + preCode : ''}</div>
                ${entryPackets.length > 0 ? `<div class="badge bg-info text-dark mt-1">${entryPackets.length} Packets (${packetWtSum.toFixed(3)}g)</div>` : ''}
                ${packetsHiddenHtml}
                <input type="hidden" name="items[${targetIdx}][item_name]" value="${itemName}">
                <input type="hidden" name="items[${targetIdx}][category_id]" value="${catId}">
                <input type="hidden" name="items[${targetIdx}][subcategory_id]" value="${subcatId}">
                <input type="hidden" name="items[${targetIdx}][purity_id]" value="${purityId}">
                <input type="hidden" name="items[${targetIdx}][pre_code]" value="${preCode}">
                <input type="hidden" name="items[${targetIdx}][quantity]" value="${qty}">
                <input type="hidden" name="items[${targetIdx}][gross_weight]" value="${grossWt}">
                <input type="hidden" name="items[${targetIdx}][net_weight]" value="${netWt}">
                <input type="hidden" name="items[${targetIdx}][final_fn_weight]" value="${fineWt}">
                <input type="hidden" name="items[${targetIdx}][size]" value="${size}">
                <input type="hidden" name="items[${targetIdx}][wastage_percent]" value="${wastagePerc}">
                <input type="hidden" name="items[${targetIdx}][purchase_rate]" value="${metalRate}">
                <input type="hidden" name="items[${targetIdx}][making_price]" value="${mkg}">
                <input type="hidden" name="items[${targetIdx}][making_type]" value="${mkgType}">
                <input type="hidden" name="items[${targetIdx}][making_final_amount]" value="${mkgAmt}">
                <input type="hidden" name="items[${targetIdx}][packet_weight]" value="${packetWtSum}">
                <input type="hidden" name="items[${targetIdx}][packet_amount]" value="${packetAmtSum}">
                <input type="hidden" name="items[${targetIdx}][total_amount]" class="line-total-input" value="${finalPrice}">
            </td>
            <td>${catName} / ${subcatName}</td>
            <td class="text-center fw-bold">${qty}</td>
            <td>
                <div>GS: ${grossWt.toFixed(3)}g</div>
                <div>Net: <strong class="text-success">${netWt.toFixed(3)}g</strong></div>
                <div>Fn: ${fineWt.toFixed(3)}g</div>
            </td>
            <td>
                <div>${wastagePerc}%</div>
                <div class="small text-muted">₹${wastageAmt.toFixed(2)}</div>
            </td>
            <td>
                <div>Rate: ₹${metalRate.toFixed(2)}</div>
                <div>Mkg: ₹${mkgAmt.toFixed(2)}</div>
            </td>
            <td class="text-end fw-bold text-dark">₹${goldPrice.toFixed(2)}</td>
            <td class="text-end fw-bold text-primary fs-6">₹${finalPrice.toFixed(2)}</td>
            <td class="text-center">
                <button type="button" class="btn btn-sm btn-outline-primary me-1 edit-list-row-btn" title="Edit Product"><i class="fa fa-edit"></i></button>
                <button type="button" class="btn btn-sm btn-outline-danger remove-list-row-btn" title="Remove Product"><i class="fa fa-times"></i></button>
            </td>
        `;

        if (editingRow) {
            editingRow.html(rowInnerHtml);
            editingRow = null;
        } else {
            let tr = document.createElement('tr');
            tr.className = 'list-item-row';
            tr.innerHTML = rowInnerHtml;
            $('#wholesaleStockListBody').append(tr);
            listIndex++;
        }

        updateRowNumbers();
        recalculateTotals();
        resetEntryForm();
    });

    // Remove row from Purchase Wholesale Stock List
    $(document).on('click', '.remove-list-row-btn', function() {
        let row = $(this).closest('tr');
        if (editingRow && editingRow[0] === row[0]) {
            resetEntryForm();
        }
        row.remove();
        if ($('#wholesaleStockListBody tr.list-item-row').length === 0) {
            $('#wholesaleStockListBody').html(`
                <tr id="emptyStockRow">
                    <td colspan="10" class="text-center py-4 text-muted">
                        <i class="fa fa-info-circle me-1"></i> No items in Purchase Wholesale Stock List yet. Fill the entry form above and click "Add Product To Wholesale Stock List".
                    </td>
                </tr>
            `);
        }
        updateRowNumbers();
        recalculateTotals();
    });

    function updateRowNumbers() {
        $('#wholesaleStockListBody tr.list-item-row').each(function(idx) {
            $(this).find('.row-number').text(idx + 1);
        });
    }

    // RESET ENTRY FORM FUNCTION
    function resetEntryForm() {
        $('#entry_category_id').val('').trigger('change');
        $('#entry_subcategory_id').html('<option value="">-- Select Subcategory --</option>');
        $('#entry_item_name').val('');
        $('#entry_pre_code').val('');
        $('#entry_purity_id').val('');
        $('#entry_metal_rate_id').val('');
        $('#entry_metal_rate').val('');
        $('#entry_quantity').val('1');
        $('#entry_gross_weight').val('');
        $('#entry_net_weight').val('0.000');
        $('#entry_final_fn_weight').val('0.000');
        $('#entry_size').val('');
        $('#entry_wastage_percent').val('0.00');
        $('#entry_wastage_amount').val('0.00');
        $('#entry_making_price').val('0.00');
        $('#entry_making_type').val('per_gram');
        $('#entry_making_final_amount').val('0.00');
        $('#entry_gold_price').val('0.00');
        $('#entry_final_price').val('0.00');
        entryPackets = [];
        $('#entryPacketBadge').text('0');
        $('#entryPacketTbody').empty();

        editingRow = null;
        $('#addEntryToListBtn')
            .html('<i class="fa fa-plus-circle me-1"></i> Add Product To Wholesale Stock List')
            .removeClass('btn-warning text-dark').addClass('custom-btn-primary');
    }

    const categoriesList = @json($categories);
    const puritiesList   = @json($purities);

    // Master Dropdown Options for Packets
    const packetMasters = @json($packetMasters);
    const packetTypes = @json($packetTypes->pluck('name'));
    const stones = @json($stones->pluck('stone_name'));
    const clarities = @json($clarities->pluck('clarity_name'));
    const colors = @json($colors->pluck('color_name'));
    const cuts = @json($cuts->pluck('cut_name'));
    const shapes = @json($shapes->pluck('shape_name'));

    function buildPacketNoOptionsHtml(selectedVal = '') {
        let html = '<option value="">-- Select PKT --</option>';
        let matchFound = false;
        if (Array.isArray(packetMasters)) {
            packetMasters.forEach(pm => {
                let sel = (pm.packet_no == selectedVal) ? 'selected' : '';
                if (sel) matchFound = true;
                html += `<option value="${pm.packet_no}" ${sel}>${pm.packet_no}</option>`;
            });
        }
        if (selectedVal && !matchFound) {
            html += `<option value="${selectedVal}" selected>${selectedVal}</option>`;
        }
        html += '<option value="__custom__">+ Enter Custom PKT No</option>';
        return html;
    }

    function buildOptionsHtml(arr, defaultVal = '') {
        let html = '<option value="">-- Select --</option>';
        if (Array.isArray(arr)) {
            arr.forEach(val => {
                let sel = (val == defaultVal) ? 'selected' : '';
                html += `<option value="${val}" ${sel}>${val}</option>`;
            });
        }
        return html;
    }

    // Auto-generate Pre Code from Item Name if empty
    function generatePreCode(name) {
        if (!name) return '';
        let words = name.trim().split(/\s+/);
        let initials = '';
        if (words.length === 1) {
            initials = words[0].substring(0, 3).toUpperCase();
        } else {
            words.forEach(w => { if (w.length > 0) initials += w[0].toUpperCase(); });
        }
        return initials.substring(0, 4);
    }

    $('#entry_item_name').on('input', function() {
        let preInput = $('#entry_pre_code');
        if (!preInput.val().trim()) {
            preInput.val(generatePreCode($(this).val()));
        }
    });

    // Auto-fetch Pre Code Details (Category, Subcategory, Product Name)
    let preCodeCheckTimeout = null;
    function checkAndApplyPreCode(preCode) {
        clearTimeout(preCodeCheckTimeout);
        preCodeCheckTimeout = setTimeout(function() {
            preCode = (preCode || '').trim();
            if (!preCode) return;

            $.get("{{ route('products.getPreCodeDetails') }}", { pre_code: preCode }, function(details) {
                if (details && details.pre_code) {
                    if (details.product_name) $('#entry_item_name').val(details.product_name);
                    if (details.category_id) {
                        $('#entry_category_id').val(details.category_id).trigger('change', [details.subcategory_id]);
                    }
                }
            });
        }, 200);
    }

    $('#entry_pre_code').on('change blur', function() {
        checkAndApplyPreCode($(this).val());
    });

    // Pre Code Suggestion Search
    let preCodeSuggestTimeout = null;
    $('#entry_item_name, #entry_pre_code').on('focus input', function() {
        let suggestBox = $('#entryPreCodeSuggestions');
        let term = $('#entry_pre_code').val().trim() || $('#entry_item_name').val().trim();

        clearTimeout(preCodeSuggestTimeout);
        preCodeSuggestTimeout = setTimeout(function() {
            if (!term) {
                suggestBox.hide();
                return;
            }

            $.get("{{ route('products.searchPreCode') }}", { term: term }, function(data) {
                suggestBox.empty();
                if (data && data.length > 0) {
                    data.forEach(item => {
                        let catSub = (item.category_name || '') + (item.subcategory_name ? ' > ' + item.subcategory_name : '');
                        let html = `<a href="javascript:void(0)" class="dropdown-item pre-code-item py-1 px-2 border-bottom small"
                            data-pre_code="${item.pre_code || ''}"
                            data-product_name="${item.product_name || ''}"
                            data-category_id="${item.category_id || ''}"
                            data-subcategory_id="${item.subcategory_id || ''}"
                            data-purity_id="${item.purity_id || ''}">
                            <div class="fw-bold text-primary">${item.pre_code || ''} - ${item.product_name || ''}</div>
                            ${catSub ? `<small class="text-muted">${catSub}</small>` : ''}
                        </a>`;
                        suggestBox.append(html);
                    });
                    suggestBox.show();
                } else {
                    suggestBox.hide();
                }
            });
        }, 150);
    });

    // Click Pre Code Suggestion
    $(document).on('click', '.pre-code-item', function(e) {
        e.preventDefault();
        let preCode = $(this).data('pre_code');
        let prodName = $(this).data('product_name');
        let catId = $(this).data('category_id');
        let subCatId = $(this).data('subcategory_id');
        let purityId = $(this).data('purity_id');

        if (preCode) $('#entry_pre_code').val(preCode);
        if (prodName) $('#entry_item_name').val(prodName);
        if (catId) $('#entry_category_id').val(catId).trigger('change', [subCatId]);
        if (purityId) $('#entry_purity_id').val(purityId);
        $('#entryPreCodeSuggestions').hide();
    });

    $(document).on('click', function(e) {
        if (!$(e.target).closest('#entry_item_name, #entry_pre_code, #entryPreCodeSuggestions').length) {
            $('#entryPreCodeSuggestions').hide();
        }
    });

    // Dynamic Subcategory Loading
    $('#entry_category_id').on('change', function(e, preselectSubcatId = null) {
        let catId = $(this).val();
        let subSelect = $('#entry_subcategory_id');
        subSelect.html('<option value="">Loading...</option>');

        if (!catId) {
            subSelect.html('<option value="">-- Select Subcategory --</option>');
            return;
        }

        $.get('{{ url("get-subcategories") }}/' + catId, function(data) {
            let options = '<option value="">-- Select Subcategory --</option>';
            if (data && data.length > 0) {
                data.forEach(sub => {
                    let sel = (preselectSubcatId && sub.subcategory_id == preselectSubcatId) ? 'selected' : '';
                    options += `<option value="${sub.subcategory_id}" ${sel}>${sub.subcategory_name}</option>`;
                });
            }
            subSelect.html(options);
        });
    });

    // Purity / Metal Rate Dropdown Change -> Auto Fill Rate Input
    $('#entry_metal_rate_id').on('change', function() {
        let selected = $(this).find('option:selected');
        let price = selected.data('price');
        if (price !== undefined && price !== '') {
            $('#entry_metal_rate').val(price);
            recalculateEntryForm();
        }
    });

    // ENTRY FORM LIVE CALCULATIONS
    $('#entry_metal_rate, #entry_quantity, #entry_gross_weight, #entry_wastage_percent, #entry_making_price, #entry_making_type').on('input change', function() {
        recalculateEntryForm();
    });

    function recalculateEntryForm() {
        let metalRate = parseFloat($('#entry_metal_rate').val()) || 0;
        let qty = parseFloat($('#entry_quantity').val()) || 1;
        let grossWt = parseFloat($('#entry_gross_weight').val()) || 0;

        let packetWt = 0;
        let packetAmt = 0;
        entryPackets.forEach(p => {
            packetWt += parseFloat(p.wt_in_gram) || 0;
            packetAmt += parseFloat(p.amount) || 0;
        });
        console.log(entryPackets);

        let netWt = grossWt > 0 ? Math.max(0, grossWt - packetWt) : 0;
        $('#entry_net_weight').val(netWt.toFixed(3));

        let wastagePerc = parseFloat($('#entry_wastage_percent').val()) || 0;
        let fineWt = netWt + ((netWt * wastagePerc) / 100);
        $('#entry_final_fn_weight').val(fineWt.toFixed(3));

        let wastageAmt = (netWt * wastagePerc / 100) * metalRate;
        $('#entry_wastage_amount').val(wastageAmt.toFixed(2));

        let goldPrice = (netWt > 0 ? netWt : qty) * metalRate;
        $('#entry_gold_price').val(goldPrice.toFixed(2));

        let mkg = parseFloat($('#entry_making_price').val()) || 0;
        let mkgType = $('#entry_making_type').val() || 'per_gram';
        let mkgAmt = (mkgType === 'fixed') ? mkg : (mkg * (netWt > 0 ? netWt : qty));
        $('#entry_making_final_amount').val(mkgAmt.toFixed(2));

        let finalPrice = goldPrice + mkgAmt + wastageAmt + packetAmt;

          console.log('goldPrice='+goldPrice);
         console.log('mkgAmt='+mkgAmt);
          console.log('wastageAmt='+wastageAmt);
          console.log('packetAmt='+packetAmt);
          console.log('finalPrice='+finalPrice);

        $('#entry_final_price').val(finalPrice.toFixed(2));
    }

    // PACKETS SETUP FOR ENTRY FORM
    $('#addEntryPacketRowBtn').on('click', function() {
        let tbody = $('#entryPacketTbody');
        let tr = document.createElement('tr');
        tr.innerHTML = `
            <td><select class="form-select form-select-sm pkt-no-select">${buildPacketNoOptionsHtml()}</select></td>
            <td><select class="form-select form-select-sm pkt-type">${buildOptionsHtml(packetTypes, 'Diamond')}</select></td>
            <td><input type="number" class="form-control form-control-sm pkt-pcs" value="1"></td>
            <td><input type="number" class="form-control form-control-sm pkt-wt" value="0.000" step="any"></td>
            <td><input type="number" class="form-control form-control-sm pkt-rate" value="0.00" step="any"></td>
            <td><input type="number" class="form-control form-control-sm pkt-amt" value="0.00" step="any"></td>
            <td><select class="form-select form-select-sm pkt-stone">${buildOptionsHtml(stones)}</select></td>
            <td><select class="form-select form-select-sm pkt-clarity">${buildOptionsHtml(clarities)}</select></td>
            <td><select class="form-select form-select-sm pkt-color">${buildOptionsHtml(colors)}</select></td>
            <td><select class="form-select form-select-sm pkt-cut">${buildOptionsHtml(cuts)}</select></td>
            <td><select class="form-select form-select-sm pkt-shape">${buildOptionsHtml(shapes)}</select></td>
            <td><input type="text" class="form-control form-control-sm pkt-cert" placeholder="Cert #"></td>
            <td class="text-center"><button type="button" class="btn btn-sm btn-outline-danger remove-entry-pkt-btn"><i class="fa fa-times"></i></button></td>
        `;
        tbody.append(tr);
    });

    $(document).on('change', '.pkt-no-select', function() {
        let select = $(this);
        let tr = select.closest('tr');
        let val = select.val();

        if (val === '__custom__') {
            let customPkt = prompt('Enter custom Packet No:');
            if (customPkt && customPkt.trim()) {
                customPkt = customPkt.trim();
                select.append(`<option value="${customPkt}" selected>${customPkt}</option>`);
                select.val(customPkt);
            } else {
                select.val('');
                return;
            }
        }

        let selectedPacketNo = select.val();
        if (!selectedPacketNo) return;

        if (Array.isArray(packetMasters)) {
            let pm = packetMasters.find(p => p.packet_no == selectedPacketNo);
            if (pm) {
                if (pm.packet_type) tr.find('.pkt-type').val(pm.packet_type);
                if (pm.average_pcs) tr.find('.pkt-pcs').val(pm.average_pcs);
                if (pm.average_wt) tr.find('.pkt-wt').val(pm.average_wt);

                let rate = parseFloat(pm.rate_retail) || parseFloat(pm.rate_wholesale) || parseFloat(pm.cost) || 0;
                tr.find('.pkt-rate').val(rate);

                let wt = parseFloat(tr.find('.pkt-wt').val()) || 0;
                tr.find('.pkt-amt').val((wt * rate).toFixed(2));

                let stoneName = pm.stone ? (pm.stone.stone_name || pm.stone.name || '') : '';
                if (stoneName) tr.find('.pkt-stone').val(stoneName);

                let clarityName = pm.clarity ? (pm.clarity.clarity_name || pm.clarity.name || '') : '';
                if (clarityName) tr.find('.pkt-clarity').val(clarityName);

                let colorName = pm.color ? (pm.color.color_name || pm.color.name || '') : '';
                if (colorName) tr.find('.pkt-color').val(colorName);

                let cutName = pm.cut ? (pm.cut.cut_name || pm.cut.name || '') : '';
                if (cutName) tr.find('.pkt-cut').val(cutName);

                let shapeName = pm.shape ? (pm.shape.shape_name || pm.shape.name || '') : '';
                if (shapeName) tr.find('.pkt-shape').val(shapeName);

                if (pm.certificate_no) tr.find('.pkt-cert').val(pm.certificate_no);
            }
        }
    });

    $(document).on('click', '.remove-entry-pkt-btn', function() {
        $(this).closest('tr').remove();
    });

    $(document).on('input', '.pkt-wt, .pkt-rate', function() {
        let tr = $(this).closest('tr');
        let wt = parseFloat(tr.find('.pkt-wt').val()) || 0;
        let rate = parseFloat(tr.find('.pkt-rate').val()) || 0;
        tr.find('.pkt-amt').val((wt * rate).toFixed(2));
    });

    $('#entryPacketDoneBtn').on('click', function() {
        entryPackets = [];
        $('#entryPacketTbody tr').each(function() {
            let tr = $(this);
            let pktNo = tr.find('.pkt-no-select').val() || tr.find('.pkt-no').val() || '';
            if (pktNo === '__custom__') pktNo = '';
            entryPackets.push({
                packet_no: pktNo,
                packet_type: tr.find('.pkt-type').val() || 'Diamond',
                pcs: parseFloat(tr.find('.pkt-pcs').val()) || 1,
                wt_in_gram: parseFloat(tr.find('.pkt-wt').val()) || 0,
                rate: parseFloat(tr.find('.pkt-rate').val()) || 0,
                amount: parseFloat(tr.find('.pkt-amt').val()) || 0,
                stone: tr.find('.pkt-stone').val() || '',
                clarity: tr.find('.pkt-clarity').val() || '',
                color: tr.find('.pkt-color').val() || '',
                cut: tr.find('.pkt-cut').val() || '',
                shape: tr.find('.pkt-shape').val() || '',
                certificate_no: tr.find('.pkt-cert').val() || ''
            });
        });
        $('#entryPacketBadge').text(entryPackets.length);
        recalculateEntryForm();
    });



    function recalculateTotals() {
        let subtotal = 0;
        $('.line-total-input').each(function() {
            subtotal += parseFloat($(this).val()) || 0;
        });

        $('#subtotalSpan').text('₹' + subtotal.toFixed(2));

        let discPercentInput = $('#discountPercent');
        let discAmountInput = $('#discountAmount');
        let discAmount = parseFloat(discAmountInput.val()) || 0;

        if (document.activeElement === discPercentInput[0]) {
            let discPerc = parseFloat(discPercentInput.val()) || 0;
            discAmount = (subtotal * discPerc) / 100;
            discAmountInput.val(discAmount.toFixed(2));
        }

        let taxable = Math.max(0, subtotal - discAmount);
        $('#taxableSpan').text('₹' + taxable.toFixed(2));

        let cgstP = parseFloat($('#cgstPercent').val()) || 0;
        let sgstP = parseFloat($('#sgstPercent').val()) || 0;
        let igstP = parseFloat($('#igstPercent').val()) || 0;

        let cgstA = (taxable * cgstP) / 100;
        let sgstA = (taxable * sgstP) / 100;
        let igstA = (taxable * igstP) / 100;
        let totalTax = cgstA + sgstA + igstA;

        $('#taxTotalSpan').text('₹' + totalTax.toFixed(2));

        let other = parseFloat($('#otherCharges').val()) || 0;
        let rawGrand = taxable + totalTax + other;

        let grand = Math.round(rawGrand);
        let roundOff = grand - rawGrand;

        $('#roundOffSpan').text('₹' + roundOff.toFixed(2));
        $('#grandTotalSpan').text('₹' + grand.toFixed(2));

        if (typeof PaymentBreakdownManager !== 'undefined' && typeof PaymentBreakdownManager.recalculateTotals === 'function') {
            PaymentBreakdownManager.recalculateTotals();
        }
    }

    $('#discountPercent, #discountAmount, #cgstPercent, #sgstPercent, #igstPercent, #otherCharges').on('input', recalculateTotals);

    window.ledgerAccounts = @json($accounts);

    const PaymentBreakdownManager = {
        accounts: [],

        init(accounts, existingPayments = []) {
            this.accounts = accounts || [];
            this.bindEvents();

            if (Array.isArray(existingPayments) && existingPayments.length > 0) {
                existingPayments.forEach(p => {
                    this.addPaymentRow(p.payment_method || 'cash', p);
                });
            } else {
                if ($('.payment-row-item').length === 0) {
                    this.addPaymentRow('cash');
                }
            }
        },

        bindEvents() {
            const self = this;
            $(document).on('click', '.add-payment-row-btn', function(e) {
                e.preventDefault();
                const method = $(this).data('method');
                self.addPaymentRow(method);
            });

            $(document).on('click', '.remove-payment-row-btn', function(e) {
                e.preventDefault();
                $(this).closest('.payment-row-item').remove();
                self.recalculateTotals();
            });

            $(document).on('input change', '.payment-amount-input, .payment-account-select', function() {
                self.recalculateTotals();
            });
        },

        getFilteredAccounts(method, selectedAccountId = null) {
            let defaultAccountId = null;
            let filtered = [];

            this.accounts.forEach(acc => {
                const name = (acc.name || '').toLowerCase();
                const subType = (acc.sub_type || '').toLowerCase();

                let matches = false;
                let isDefault = false;

                if (method === 'cash') {
                    const isAsset = acc.group && acc.group.type === 'Asset';
                    const isNormal = subType === 'normal';
                    const isExcluded = name === 'stock' || name.includes('debtor') || name === 'old metal received';
                    if ((isAsset && isNormal && !isExcluded) || name.includes('cash')) {
                        matches = true;
                    }
                    if (name === 'cash in hand') {
                        isDefault = true;
                        matches = true;
                    }
                } else if (method === 'card') {
                    if (subType === 'card' || subType === 'bank') {
                        matches = true;
                    }
                    if (name === 'card receivable') {
                        isDefault = true;
                        matches = true;
                    }
                } else if (method === 'cheque') {
                    if (subType === 'bank') {
                        matches = true;
                    }
                    if (name === 'bank') {
                        isDefault = true;
                        matches = true;
                    }
                } else if (method === 'upi') {
                    if (subType === 'upi' || subType === 'bank') {
                        matches = true;
                    }
                    if (name === 'upi clearing') {
                        isDefault = true;
                        matches = true;
                    }
                }

                if (acc.id == selectedAccountId) {
                    matches = true;
                }

                if (matches) {
                    filtered.push({
                        account: acc,
                        isDefault: isDefault
                    });
                }
            });

            if (filtered.length > 0) {
                const hasDefault = filtered.some(f => f.isDefault);
                if (!hasDefault) {
                    filtered[0].isDefault = true;
                }
            }

            if (filtered.length === 0) {
                this.accounts.forEach(acc => {
                    filtered.push({
                        account: acc,
                        isDefault: false
                    });
                });
            }

            filtered.forEach(f => {
                if (f.isDefault) {
                    defaultAccountId = f.account.id;
                }
            });

            let optionsHtml = '';
            filtered.forEach(f => {
                const acc = f.account;
                const isSel = (selectedAccountId !== null) ? (acc.id == selectedAccountId) : f.isDefault;
                optionsHtml += `<option value="${acc.id}" ${isSel ? 'selected' : ''}>${acc.name}</option>`;
            });

            return {
                optionsHtml,
                defaultAccountId: selectedAccountId || defaultAccountId
            };
        },

        addPaymentRow(method, data = null) {
            const containerId = `#${method}PaymentsContainer`;
            const container = $(containerId);
            const today = new Date().toISOString().split('T')[0];
            if (!container.length) return;

            let selectedAccountId = data && data.account_id ? data.account_id : null;
            let rowIndex = $('.payment-row-item').length;

            const { optionsHtml } = this.getFilteredAccounts(method, selectedAccountId);

            let selectHtml = `<select name="payments[${rowIndex}][account_id]" class="form-select form-select-sm payment-account-select" style="width: 100%; font-size: 12px;">
                ${optionsHtml}
            </select>`;

            let rowHtml = `
                <div class="payment-row-item mb-2" data-method="${method}">
                    <input type="hidden" name="payments[${rowIndex}][payment_method]" value="${method}">
                    <div class="d-flex align-items-center gap-2">
                        <div class="flex-grow-1">
                            ${selectHtml}
                        </div>
                        <div style="width: 110px; flex-shrink: 0;">
                            <input type="number" name="payments[${rowIndex}][amount]" class="form-control form-control-sm payment-amount-input text-end" placeholder="0.00" style="font-size: 12px;" value="${data && data.amount ? data.amount : '0'}" min="0" step="0.01">
                        </div>
                        <div style="width: 28px; flex-shrink: 0; text-align: center;">
                            <button type="button" class="btn btn-outline-danger btn-sm remove-payment-row-btn p-0 m-0" style="width: 25px; height: 25px; line-height: 1;" title="Remove Row"><i class="fa fa-trash"></i></button>
                        </div>
                    </div>
            `;

            if (method === 'card') {
                rowHtml += `
                    <div class="d-flex align-items-center gap-2 mt-1">
                        <div style="width: 120px; flex-shrink: 0;">
                            <input type="text" name="payments[${rowIndex}][reference_no]" class="form-control form-control-sm payment-ref-input" placeholder="Card No." style="font-size: 12px;" value="${data && data.reference_no ? data.reference_no : ''}">
                        </div>
                        <div class="flex-grow-1">
                            <input type="text" name="payments[${rowIndex}][payment_details]" class="form-control form-control-sm payment-details-input" placeholder="Bank Name" style="font-size: 12px;" value="${data && data.payment_details ? data.payment_details : ''}">
                        </div>
                        <div style="width: 130px; flex-shrink: 0;">
                            <input type="date" name="payments[${rowIndex}][transaction_date]" class="form-control form-control-sm payment-date-input" style="font-size: 12px;" value="${data && data.transaction_date ? data.transaction_date : today}">
                        </div>
                    </div>
                `;
            } else if (method === 'cheque') {
                rowHtml += `
                    <div class="d-flex align-items-center gap-2 mt-1">
                        <div style="width: 120px; flex-shrink: 0;">
                            <input type="text" name="payments[${rowIndex}][reference_no]" class="form-control form-control-sm payment-ref-input" placeholder="Cheque No." style="font-size: 12px;" value="${data && data.reference_no ? data.reference_no : ''}">
                        </div>
                        <div class="flex-grow-1">
                            <input type="text" name="payments[${rowIndex}][payment_details]" class="form-control form-control-sm payment-details-input" placeholder="Bank Name" style="font-size: 12px;" value="${data && data.payment_details ? data.payment_details : ''}">
                        </div>
                        <div style="width: 130px; flex-shrink: 0;">
                            <input type="date" name="payments[${rowIndex}][transaction_date]" class="form-control form-control-sm payment-date-input" style="font-size: 12px;" value="${data && data.transaction_date ? data.transaction_date : today}">
                        </div>
                    </div>
                `;
            } else if (method === 'upi') {
                rowHtml += `
                    <div class="d-flex align-items-center gap-2 mt-1">
                        <div class="flex-grow-1">
                            <input type="text" name="payments[${rowIndex}][reference_no]" class="form-control form-control-sm payment-ref-input" placeholder="UPI Txn ID / Ref No." style="font-size: 12px;" value="${data && data.reference_no ? data.reference_no : ''}">
                        </div>
                        <div style="width: 130px; flex-shrink: 0;">
                            <input type="date" name="payments[${rowIndex}][transaction_date]" class="form-control form-control-sm payment-date-input" style="font-size: 12px;" value="${data && data.transaction_date ? data.transaction_date : today}">
                        </div>
                    </div>
                `;
            }

            rowHtml += `</div>`;
            container.append(rowHtml);
            this.recalculateTotals();
        },

        recalculateTotals() {
            let totalPurchaseFineWt = 0;
            $('#wholesaleStockListBody tr.list-item-row').each(function() {
                let fineWt = parseFloat($(this).find('input[name*="[final_fn_weight]"]').val()) || 0;
                if (fineWt <= 0) {
                    fineWt = parseFloat($(this).find('input[name*="[net_weight]"]').val()) || 0;
                }
                totalPurchaseFineWt += fineWt;
            });

            let goldGrams = parseFloat($('#goldPaymentGrams').val()) || 0;
            let purityPerc = parseFloat($('#goldPaymentPurity').val()) || 100;
            let goldRate = parseFloat($('#goldPaymentRate').val()) || 0;

            if (goldRate <= 0) {
                let firstRate = parseFloat($('#wholesaleStockListBody tr.list-item-row').first().find('input[name*="[purchase_rate]"]').val()) || 0;
                if (firstRate <= 0) {
                    firstRate = parseFloat($('#entry_metal_rate').val()) || 0;
                }
                if (firstRate > 0) {
                    goldRate = firstRate;
                    $('#goldPaymentRate').val(goldRate);
                }
            }

            let goldFineWt = goldGrams * (purityPerc / 100);
            let goldValue = goldFineWt * goldRate;

            $('#goldPaymentFineWt').val(goldFineWt.toFixed(3));
            $('#goldPaymentAmount').val(goldValue.toFixed(2));
            $('#goldPaymentValueSpan').text('₹' + goldValue.toLocaleString('en-IN', {minimumFractionDigits: 2, maximumFractionDigits: 2}));

            let remainingMetalWt = Math.max(0, totalPurchaseFineWt - goldFineWt);
            let remainingMetalAmt = remainingMetalWt * goldRate;

            $('#remainingMetalWt').val(remainingMetalWt.toFixed(3));
            $('#remainingMetalAmount').val(remainingMetalAmt.toFixed(2));
            $('#remainingMetalWtSpan').text(remainingMetalWt.toFixed(3) + ' g');

            let badge = $('#goldPaymentStatusBadge');
            if (goldFineWt > 0) {
                if (goldFineWt >= totalPurchaseFineWt && totalPurchaseFineWt > 0) {
                    badge.removeClass('bg-warning bg-secondary text-dark').addClass('bg-success text-white').text('Gold to Gold (Full Metal Settled)');
                } else {
                    badge.removeClass('bg-success bg-secondary text-white').addClass('bg-warning text-dark').text('Gold + Amount (Partial Metal + Currency)');
                }
            } else {
                badge.removeClass('bg-success bg-warning text-dark').addClass('bg-secondary text-white').text('Currency / Amount Mode');
            }

            let cashPaid = 0;
            $('.payment-row-item').each(function() {
                const amount = parseFloat($(this).find('.payment-amount-input').val()) || 0;
                cashPaid += amount;
            });

            let totalPaid = cashPaid + goldValue;

            $('#totalPaymentsBadge').text(`Total Paid: ₹${totalPaid.toLocaleString('en-IN', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`);
            $('#paidAmountInput').val(totalPaid.toFixed(2));

            let grandTotalStr = $('#grandTotalSpan').text().replace(/[^\d.-]/g, '');
            let grandTotal = parseFloat(grandTotalStr) || 0;
            let remaining = grandTotal - totalPaid;

            $('#remainingAmountText').text(`₹${remaining.toLocaleString('en-IN', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`);
        }
    };

    PaymentBreakdownManager.init(window.ledgerAccounts);

    $(document).on('input change', '#goldPaymentGrams, #goldPaymentPurity, #goldPaymentRate', function() {
        PaymentBreakdownManager.recalculateTotals();
    });

    // --- AJAX Add Category ---
    $('#ajaxAddCategoryForm').on('submit', function(e) {
        e.preventDefault();
        let form = $(this);
        let categoryName = $('#modal_category_name').val().trim();

        if (!categoryName) return;

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            success: function(response) {
                if (response.success && response.category) {
                    let cat = response.category;
                    let catId = cat.category_id || cat.id;
                    let newOption = new Option(cat.category_name, catId, true, true);
                    $('#entry_category_id').append(newOption).val(catId).trigger('change');
                    $('#modal_subcat_category_id').append(new Option(cat.category_name, catId));

                    form[0].reset();
                    let modalEl = document.getElementById('addCategoryModal');
                    let modalObj = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
                    modalObj.hide();
                }
            },
            error: function(xhr) {
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    alert(Object.values(xhr.responseJSON.errors).flat().join('\n'));
                } else {
                    alert('Failed to add category');
                }
            }
        });
    });

    // --- AJAX Add Subcategory ---
    $('#addSubcategoryModal').on('show.bs.modal', function() {
        let currentCatId = $('#entry_category_id').val();
        if (currentCatId) {
            $('#modal_subcat_category_id').val(currentCatId);
        }
    });

    $('#ajaxAddSubcategoryForm').on('submit', function(e) {
        e.preventDefault();
        let form = $(this);
        let subcatName = $('#modal_subcategory_name').val().trim();
        let catId = $('#modal_subcat_category_id').val();

        if (!subcatName || !catId) return;

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            success: function(response) {
                if (response.success && response.subcategory) {
                    let sub = response.subcategory;
                    let subId = sub.subcategory_id || sub.id;
                    let selectedCatId = $('#entry_category_id').val();

                    if (selectedCatId == sub.category_id) {
                        let newOption = new Option(sub.subcategory_name, subId, true, true);
                        $('#entry_subcategory_id').append(newOption).val(subId);
                    }

                    form[0].reset();
                    let modalEl = document.getElementById('addSubcategoryModal');
                    let modalObj = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
                    modalObj.hide();
                }
            },
            error: function(xhr) {
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    alert(Object.values(xhr.responseJSON.errors).flat().join('\n'));
                } else {
                    alert('Failed to add subcategory');
                }
            }
        });
    });
});
</script>

<!-- Add Category Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content glass-card border-0">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-dark fs-6" id="addCategoryModalLabel">Add Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="ajaxAddCategoryForm" action="{{ route('category') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="modal_category_name" class="form-label">Category Name *</label>
                        <input type="text" class="form-control" id="modal_category_name" name="category_name" placeholder="Enter Category Name" required>
                    </div>
                </div>
                <div class="modal-footer gap-2">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn custom-btn-primary btn-sm text-white">Save Category</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Subcategory Modal -->
<div class="modal fade" id="addSubcategoryModal" tabindex="-1" aria-labelledby="addSubcategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content glass-card border-0">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-dark fs-6" id="addSubcategoryModalLabel">Add Subcategory</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="ajaxAddSubcategoryForm" action="{{ route('subcategory') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="modal_subcat_category_id" class="form-label">Category *</label>
                        <select class="form-select" id="modal_subcat_category_id" name="category_id" required>
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->category_id ?? $category->id }}">
                                {{ $category->category_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="modal_subcategory_name" class="form-label">Subcategory Name *</label>
                        <input type="text" class="form-control" id="modal_subcategory_name" name="subcategory_name" placeholder="Enter Subcategory Name" required>
                    </div>
                </div>
                <div class="modal-footer gap-2">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn custom-btn-primary btn-sm text-white">Save Subcategory</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
