@extends('layout.mainlayout')

@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <script src="{{ url('/assets/js/calculation.js') }}"></script>
        <script src="{{ url('/assets/js/functions.js') }}"></script>

        <style>
            .select2-container--default .select2-selection--single .select2-selection__rendered {
                font-size: 12px !important;
                line-height: 30px;
                padding-right: 0px;
                padding-left: 4px;
            }
            .select2-container .select2-selection--single {
                height: 33px;
                border: 1px solid #ced4da;
                border-radius: 8px;
            }
            .select2-container--default .select2-selection--single .select2-selection__arrow {
                height: 31px;
                right: 1px;
                width: 16px;
                padding: 7px;
                border-radius: 10px;
                background-color: #fff;
            }
            .form-label {
                margin-bottom: 2px;
                font-size: 12px;
                font-weight: 500;
                color: #4a5568;
            }
            .readonly-field {
                pointer-events: none;
                background-color: #e9ecef;
                cursor: not-allowed;
            }
            .glass-card {
                background: rgba(255, 255, 255, 0.85);
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
                border: 1px solid rgba(220, 226, 235, 0.7);
                box-shadow: 0 8px 30px 0 rgba(31, 38, 135, 0.07);
                border-radius: 14px;
                transition: all 0.3s ease;
            }
            .glass-card:hover {
                box-shadow: 0 12px 36px 0 rgba(31, 38, 135, 0.12);
            }
            .section-header {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                font-weight: 600;
                font-size: 13px;
                display: block;
                color: #fff;
                padding: 8px 12px;
                border-radius: 8px;
                margin-bottom: 12px;
            }
            .form-control, .form-select {
                border-radius: 8px;
                border: 1px solid #ced4da;
                padding: 6px 10px;
                transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
                color: #495057;
                font-size: 12px;
            }
            .form-control:focus, .form-select:focus {
                border-color: #764ba2;
                box-shadow: 0 0 0 0.2rem rgba(118, 75, 162, 0.15);
            }
            .custom-btn-primary {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                border: none;
                border-radius: 8px;
                padding: 8px 20px;
                font-weight: 600;
                color: #fff;
                transition: all 0.3s ease;
            }
            .custom-btn-primary:hover {
                transform: translateY(-1px);
                box-shadow: 0 4px 15px rgba(118, 75, 162, 0.35);
                color: #fff;
            }
            .lot-banner {
                background: linear-gradient(135deg, #f0f4ff 0%, #fdf2f8 100%);
                border: 1px solid #dbeafe;
                border-left: 5px solid #667eea;
                border-radius: 10px;
                padding: 14px 18px;
            }
            .nav-pills .nav-link {
                border-radius: 10px;
                padding: 9px 18px;
                font-weight: 600;
                font-size: 13px;
                color: #64748b;
                transition: all 0.2s ease;
            }
            .nav-pills .nav-link.active {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: #fff;
                box-shadow: 0 4px 12px rgba(102, 126, 234, 0.35);
            }
        </style>

        <!-- Page Header -->
        <div class="page-header mb-3">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title font-weight-bold" style="color: #2d3748;">
                        <i class="fa fa-tags me-2 text-primary"></i>Lot to Tag
                    </h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('inventory') }}">Inventory</a></li>
                        <li class="breadcrumb-item active">Lot to Tag (Wholesale to Retail)</li>
                    </ul>
                </div>
                <div class="col-auto d-flex align-items-center gap-2">
                    <a href="{{ route('purchases.create') }}" class="btn btn-outline-primary btn-sm">
                        <i class="fa fa-plus-circle me-1"></i> Add  Purchase
                    </a>
                    <a href="{{ route('purchases.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fa fa-list me-1"></i> Purchases List
                    </a>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                <i class="fa fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                <i class="fa fa-exclamation-triangle me-2"></i>{{ $errors->first() }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Summary Cards -->
        <div class="row mb-3">
            <div class="col-xl-3 col-sm-6 col-12 mb-2">
                <div class="card bg-white shadow-sm border-0 h-100">
                    <div class="card-body py-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="text-muted mb-1 small font-weight-medium">Available Wholesale Lots</p>
                                <h4 class="mb-0 text-primary font-weight-bold">{{ $availableStocks->count() }} Lots</h4>
                            </div>
                            <div class="avatar avatar-md bg-light-primary rounded-circle">
                                <i class="fa fa-boxes text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 mb-2">
                <div class="card bg-white shadow-sm border-0 h-100">
                    <div class="card-body py-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="text-muted mb-1 small font-weight-medium">Available Quantity</p>
                                <h4 class="mb-0 text-info font-weight-bold">{{ number_format($availableStocks->sum('available_quantity'), 0) }} Pcs</h4>
                            </div>
                            <div class="avatar avatar-md bg-light-info rounded-circle">
                                <i class="fa fa-cubes text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 mb-2">
                <div class="card bg-white shadow-sm border-0 h-100">
                    <div class="card-body py-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="text-muted mb-1 small font-weight-medium">Available Net Weight</p>
                                <h4 class="mb-0 text-success font-weight-bold">{{ number_format($availableStocks->sum('available_net_weight'), 3) }} g</h4>
                            </div>
                            <div class="avatar avatar-md bg-light-success rounded-circle">
                                <i class="fa fa-balance-scale text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 mb-2">
                <div class="card bg-white shadow-sm border-0 h-100">
                    <div class="card-body py-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="text-muted mb-1 small font-weight-medium">Available Gross Weight</p>
                                <h4 class="mb-0 text-warning font-weight-bold">{{ number_format($availableStocks->sum('available_gross_weight'), 3) }} g</h4>
                            </div>
                            <div class="avatar avatar-md bg-light-warning rounded-circle">
                                <i class="fa fa-weight-hanging text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Tabs: Lot to Tag Form vs Wholesale Lots Table -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <ul class="nav nav-pills gap-2" id="lotTagTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="tab-convert-btn" data-bs-toggle="pill" data-bs-target="#tab-convert-pane" type="button" role="tab">
                        <i class="fa fa-tag me-1"></i> Convert Lot to Tag (Add Product Form)
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tab-lots-btn" data-bs-toggle="pill" data-bs-target="#tab-lots-pane" type="button" role="tab">
                        <i class="fa fa-list me-1"></i> Wholesale Lots Stock List ({{ $wholesaleStocks->total() }})
                    </button>
                </li>
            </ul>
        </div>

        <div class="tab-content" id="lotTagTabContent">

            <!-- ========================================== -->
            <!-- TAB 1: CONVERT LOT TO TAG (ADD PRODUCT FORM) -->
            <!-- ========================================== -->
            <div class="tab-pane fade show active" id="tab-convert-pane" role="tabpanel">

                <form method="POST" action="{{ route('wholesale-stock.convert-tag') }}" enctype="multipart/form-data" id="lotToTagForm">
                    @csrf

                    <!-- 1. LOT SELECTION CARD -->
                    <div class="card glass-card mb-3 p-3">
                        <span class="section-header">
                            <i class="fa fa-boxes me-2"></i> 1. Select Wholesale Stock Lot to Convert
                        </span>

                        <div class="row g-3 align-items-end">
                            <div class="col-lg-6 col-md-8">
                                <label class="form-label font-weight-bold">Select Wholesale Stock Lot <span class="text-danger">*</span></label>
                                <select name="wholesale_stock_id" id="wholesale_stock_id" class="form-control select2-lot" required>
                                    <option value="">-- Choose Wholesale Lot to Tag --</option>
                                    @foreach($availableStocks as $stock)
                                        <option value="{{ $stock->id }}"
                                            data-item-name="{{ $stock->item_name }}"
                                            data-pre-code="{{ $stock->pre_code }}"
                                            data-category-id="{{ $stock->category_id }}"
                                            data-subcategory-id="{{ $stock->subcategory_id }}"
                                            data-purity-id="{{ $stock->purity_id }}"
                                            data-purity-name="{{ optional($stock->purity)->purity_name ?? '' }}"
                                            data-purity-value="{{ optional($stock->purity)->purity_value ?? '' }}"
                                            data-purity-type="{{ optional($stock->purity)->purity_type ?? '' }}"
                                            data-avail-qty="{{ $stock->available_quantity }}"
                                            data-avail-net="{{ $stock->available_net_weight }}"
                                            data-avail-gross="{{ $stock->available_gross_weight }}"
                                            data-avail-fine="{{ $stock->available_fine_weight }}"
                                            {{ (old('wholesale_stock_id', $selectedStockId) == $stock->id) ? 'selected' : '' }}>
                                            {{ $stock->item_name }} ({{ $stock->pre_code }}) - {{ optional($stock->purity)->purity_name ?? '' }} | Avail: {{ number_format($stock->available_quantity, 0) }} Pcs (Gross: {{ number_format($stock->available_gross_weight, 3) }}g | Net: {{ number_format($stock->available_net_weight, 3) }}g)
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-lg-4 col-md-4">
                                <label class="form-label font-weight-bold">Supplier Origin Batch (Optional)</label>
                                <select name="batch_id" id="batch_id" class="form-control">
                                    <option value="">Auto (FIFO - First Purchased First Converted)</option>
                                </select>
                            </div>

                            <div class="col-lg-2 col-md-12 text-end">
                                <button type="button" class="btn btn-outline-secondary btn-sm w-100" id="btnRefreshLotData">
                                    <i class="fa fa-sync-alt me-1"></i> Refresh Lot
                                </button>
                            </div>
                        </div>

                        <!-- LIVE LOT BALANCE INFO BANNER -->
                        <div id="lotInfoBanner" class="lot-banner mt-3 d-none">
                            <div class="row align-items-center">
                                <div class="col-md-7">
                                    <div class="d-flex align-items-center gap-2 mb-1">
                                        <h5 class="mb-0 font-weight-bold text-dark" id="bannerLotName">Gold Rings</h5>
                                        <span class="badge bg-primary" id="bannerPreCode">GR</span>
                                        <span class="badge bg-secondary" id="bannerPurity">22K</span>
                                    </div>
                                    <div class="small text-muted" id="bannerCatSub">Category: Gold Jewellery &gt; Rings</div>
                                </div>
                                <div class="col-md-5 text-md-end mt-2 mt-md-0">
                                    <span class="small text-muted d-block font-weight-bold">Available Wholesale Balance</span>
                                    <span class="fs-5 font-weight-bold text-primary" id="bannerAvailQty">0 Pcs</span> |
                                    <span class="fs-5 font-weight-bold text-success" id="bannerAvailNet">0.000 g Net</span>
                                    <div class="small text-muted" id="bannerAvailGross">Gross: 0.000 g</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 2. RETAIL PRODUCT DETAILS (EXACT ADD PRODUCT FORM STRUCTURE) -->
                    <div class="card glass-card mb-4 p-4">
                        <div class="form-group-item">
                            <span class="section-header">
                                <i class="fa fa-gem me-2"></i> 2. Retail Tag & Product Details
                            </span>

                            <div class="row">

                                <!-- Item Code (pre_code) -->
                                <div class="col-lg-2 mt-2" style="position: relative;">
                                    <label class="form-label">Item Code <span class="text-danger">*</span></label>
                                    <div style="position: relative;">
                                        <input type="text" class="form-control"
                                            name="pre_code" id="pre_code"
                                            value="{{ old('pre_code') }}"
                                            placeholder="Item Code"
                                            autocomplete="off" required>
                                        <div id="preCodeSuggestions" class="dropdown-menu shadow-lg w-100" style="display: none; position: absolute; top: 100%; left: 0; z-index: 1050; max-height: 250px; overflow-y: auto;">
                                        </div>
                                    </div>
                                    @error('pre_code')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Post Code -->
                                <div class="col-lg-2 mt-2">
                                    <label class="form-label">Post Code <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="post_code"
                                        id="post_code" value="{{ old('post_code', '0001') }}" required>
                                    @error('post_code')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Product Name -->
                                <div class="col-lg-2 mt-2">
                                    <label class="form-label">Product Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="product_name" id="product_name"
                                        value="{{ old('product_name') }}" required>
                                    @error('product_name')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Barcode -->
                                <div class="col-lg-2 mt-2">
                                    <label class="form-label">Barcode</label>
                                    <input type="text" class="form-control" name="barcode" id="barcode"
                                        value="{{ old('barcode', $newBarcode) }}">
                                    @error('barcode')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Category -->
                                <div class="col-lg-2 mt-2">
                                    <label class="form-label">Category <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <select name="category_id" id="category_id" class="form-control" required>
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->category_id }}"
                                                    data-metal="{{ strtolower($category->category_name) }}"
                                                    {{ old('category_id') == $category->category_id ? 'selected' : '' }}>
                                                    {{ $category->category_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button type="button" class="btn custom-btn-primary text-white" data-bs-toggle="modal" data-bs-target="#addCategoryModal" title="Add Category">
                                            +
                                        </button>
                                    </div>
                                </div>

                                <!-- Subcategory -->
                                <div class="col-lg-2 mt-2">
                                    <label class="form-label">Subcategory <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <select name="subcategory_id" id="subcategory_id" class="form-control" required>
                                            <option value="">Select Subcategory</option>
                                            @foreach ($subcategories as $subcategory)
                                                <option value="{{ $subcategory->subcategory_id }}"
                                                    {{ old('subcategory_id') == $subcategory->subcategory_id ? 'selected' : '' }}>
                                                    {{ $subcategory->subcategory_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button type="button" class="btn custom-btn-primary text-white" data-bs-toggle="modal" data-bs-target="#addSubcategoryModal" title="Add Subcategory">
                                            +
                                        </button>
                                    </div>
                                </div>

                                <!-- Hidden Purity ID -->
                                <input type="hidden" name="purity_id" id="purity_id" value="{{ old('purity_id') }}">

                                <!-- Hallmark (HUID) -->
                                <div class="col-lg-2 col-md-6 mt-3">
                                    <label class="form-label">Hallmark (HUID)</label>
                                    <input type="text" class="form-control" name="hallmarking" id="hallmarking"
                                        value="{{ old('hallmarking') }}" placeholder="Enter HUID">
                                </div>

                                <!-- Purity / Metal Rate -->
                                <div class="col-lg-2 col-md-6 mt-3">
                                    <label class="form-label">Purity / Metal Rate <span class="text-danger">*</span></label>
                                    <select name="metal_rate_id" id="metal_rate" class="form-control" required>
                                        <option value="">Select Metal Rate</option>
                                        @foreach ($metalRates as $rate)
                                            <option value="{{ $rate->id }}"
                                                data-metal="{{ strtolower($rate->metal_type) }}"
                                                data-price="{{ $rate->price_per_gram }}"
                                                data-karat="{{ (float) $rate->karat }}"
                                                data-purity-type="{{ $rate->purity_type }}"
                                                {{ old('metal_rate_id') == $rate->id ? 'selected' : '' }}>
                                                {{ $rate->metal_type }} - ₹{{ $rate->price_per_gram }}/gm -
                                                {{ $rate->karat }}{{ $rate->purity_type === 'karat' ? 'KT' : '%' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Gold Color -->
                                <div class="col-lg-2 col-md-6 mt-3">
                                    <label class="form-label">Gold Color</label>
                                    <select class="form-control" name="gold_color" id="gold_color">
                                        <option value="">Select Gold Color</option>
                                        <option value="Yellow Gold" {{ old('gold_color') == 'Yellow Gold' ? 'selected' : '' }}>Yellow Gold</option>
                                        <option value="Rose Gold" {{ old('gold_color') == 'Rose Gold' ? 'selected' : '' }}>Rose Gold</option>
                                        <option value="White Gold" {{ old('gold_color') == 'White Gold' ? 'selected' : '' }}>White Gold</option>
                                    </select>
                                </div>

                                <!-- Size -->
                                <div class="col-lg-2 col-md-4 mt-3">
                                    <label class="form-label">Size</label>
                                    <input type="text" class="form-control" name="size" id="size"
                                        value="{{ old('size') }}" placeholder="e.g. 14, Free Size">
                                </div>

                                <!-- Quantity -->
                                <div class="col-lg-2 col-md-6 mt-3">
                                    <label class="form-label">Tag Quantity (Pcs) <span class="text-danger">*</span></label>
                                    <input type="number" min="1" step="1" class="form-control" name="quantity" id="quantity"
                                        value="{{ old('quantity', 1) }}" required>
                                    <div class="form-text small text-muted" id="qtyLimitHint">Max: -</div>
                                </div>

                                <!-- HSN Code -->
                                <div class="col-lg-2 col-md-6 mt-3">
                                    <label class="form-label">HSN Code</label>
                                    <input type="text" class="form-control" name="hsn_code" id="hsn_code"
                                        value="{{ old('hsn_code', '711319') }}">
                                </div>

                                <!-- Gross Weight -->
                                <div class="col-lg-2 col-md-4 mt-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <label class="form-label mb-0">Gross Wt (g) <span class="text-danger">*</span></label>
                                        <button type="button" class="btn btn-link p-0 text-primary" id="btnFillLotWeight" title="Auto-fill available weight from selected lot or batch" style="font-size: 11px; text-decoration: none; font-weight: 600;">
                                            <i class="fa fa-magic me-1"></i>Fill Lot Wt
                                        </button>
                                    </div>
                                    <input type="number" step="0.001" min="0.001" class="form-control mt-1" name="gross_weight" id="gross_weight"
                                        value="{{ old('gross_weight') }}" placeholder="0.000" required>
                                    <div class="form-text small text-muted" id="grossLimitHint">Max: -</div>
                                </div>

                                <!-- Net Weight -->
                                <div class="col-lg-2 col-md-4 mt-3">
                                    <label class="form-label">Net Weight (g) <span class="text-danger">*</span></label>
                                    <input type="number" step="0.001" min="0.001" class="form-control" name="net_weight" id="net_weight"
                                        value="{{ old('net_weight') }}" placeholder="0.000" required>
                                    <div class="form-text small text-muted" id="netLimitHint">Max: -</div>
                                </div>

                                <!-- Wastage % -->
                                <div class="col-lg-2 col-md-6 mt-3">
                                    <label class="form-label">Wastage %</label>
                                    <input type="number" step="0.01" class="form-control" name="wastage_percent" id="wastage_percent"
                                        value="{{ old('wastage_percent', 0) }}" placeholder="0.00">
                                </div>

                                <!-- Wastage Amount -->
                                <div class="col-lg-2 col-md-6 mt-3">
                                    <label class="form-label">Wastage Amount (₹)</label>
                                    <input type="text" class="form-control" name="wastage_amount" id="wastage_amount"
                                        value="{{ old('wastage_amount') }}" readonly>
                                </div>

                                <!-- Net Wt With Wastage (final_fn_weight) -->
                                <div class="col-lg-2 col-md-4 mt-3">
                                    <label class="form-label">Net Wt With Wastage</label>
                                    <input type="text" step="0.001" class="form-control" name="final_fn_weight" id="final_fn_weight"
                                        value="{{ old('final_fn_weight') }}" required>
                                </div>

                                <!-- Making Charge -->
                                <div class="col-lg-2 col-md-6 mt-3">
                                    <label class="form-label">Making</label>
                                    <input type="number" step="0.01" class="form-control" name="making_price" id="making_price"
                                        value="{{ old('making_price', 0) }}" placeholder="0.00">
                                </div>

                                <!-- Making Type -->
                                <div class="col-lg-2 col-md-6 mt-3">
                                    <label class="form-label">Making Type</label>
                                    <select class="form-control" name="making_type" id="making_type">
                                        <option value="val" {{ old('making_type') == 'val' ? 'selected' : '' }}>Value (Fixed)</option>
                                        <option value="per_gld_val" {{ old('making_type') == 'per_gld_val' ? 'selected' : '' }}>% of Gold Value</option>
                                        <option value="per_pcs" {{ old('making_type') == 'per_pcs' ? 'selected' : '' }}>Per Pcs</option>
                                        <option value="per_gm_nw" {{ old('making_type', 'per_gm_nw') == 'per_gm_nw' ? 'selected' : '' }}>Rate/Gm of Nw</option>
                                        <option value="per_gm_gw" {{ old('making_type') == 'per_gm_gw' ? 'selected' : '' }}>Rate/Gm of Gw</option>
                                        <option value="per_gm_fine_wt" {{ old('making_type') == 'per_gm_fine_wt' ? 'selected' : '' }}>Rate/Gm of Fine Wt</option>
                                    </select>
                                </div>

                                <!-- Making Amount -->
                                <div class="col-lg-2 col-md-6 mt-3">
                                    <label class="form-label">Making Amount (₹)</label>
                                    <input type="text" class="form-control" name="making_final_amount" id="making_final_amount"
                                        value="{{ old('making_final_amount') }}">
                                </div>

                                <!-- Gold Price -->
                                <div class="col-lg-2 col-md-6 mt-3">
                                    <label class="form-label">Gold Price (₹) <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="gold_price" id="gold_price"
                                        value="{{ old('gold_price') }}" required>
                                </div>

                                <!-- Final Price -->
                                <div class="col-lg-2 col-md-6 mt-3">
                                    <label class="form-label font-weight-bold text-success">Final Price (₹)</label>
                                    <input type="text" class="form-control font-weight-bold" name="final_price" id="final_price"
                                        value="{{ old('final_price') }}">
                                </div>

                            </div>
                        </div>

                        <!-- 3. PACKETS (DIAMONDS & STONES) -->
                        <div class="mt-4 pt-3 border-top">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h6 class="font-weight-bold text-dark mb-0">
                                    <i class="fa fa-gem text-primary me-1"></i> Diamond &amp; Stone Packets (Optional)
                                </h6>
                                <button type="button" id="addPacketBtn" class="btn btn-warning btn-sm">
                                    <i class="fa fa-plus me-1"></i> Add Packet
                                </button>
                            </div>

                            <div id="packetWrapper">
                                <!-- Dynamic packet items will be appended here -->
                            </div>

                            <!-- Packet Row Template -->
                            <script type="text/template" id="packetTemplate">
                                <div class="card p-3 mt-2 packet-item shadow-sm border">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="badge bg-light text-dark font-weight-bold"><i class="fa fa-box me-1"></i> Packet Detail</span>
                                        <button type="button" class="btn btn-sm text-danger removePacket" title="Remove Packet">✖</button>
                                    </div>
                                    <input type="hidden" name="packet[packet_master_id][]" class="packet-master-id">
                                    <div class="row g-2">
                                        <div class="col-lg-2 col-md-6">
                                            <label class="form-label">Packet No *</label>
                                            <select name="packet[packet_no][]" class="form-control packet-select" required></select>
                                        </div>
                                        <div class="col-lg-2 col-md-6">
                                            <label class="form-label">Packet Type</label>
                                            <select name="packet[packet_type][]" class="form-control packet-type-select">
                                                @foreach ($packet_types as $item)
                                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-2 col-md-6">
                                            <label class="form-label">Stone</label>
                                            <select name="packet[stone_id][]" class="form-control packet-stone-select">
                                                <option value="">Select Stone</option>
                                                @foreach($stones as $stone)
                                                    <option value="{{ $stone->id }}">{{ $stone->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-2 col-md-6">
                                            <label class="form-label">Shape</label>
                                            <select name="packet[shape_id][]" class="form-control packet-shape-select">
                                                <option value="">Select Shape</option>
                                                @foreach($shapes as $shape)
                                                    <option value="{{ $shape->id }}">{{ $shape->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-2 col-md-6">
                                            <label class="form-label">Clarity</label>
                                            <select name="packet[clarity_id][]" class="form-control packet-clarity-select">
                                                <option value="">Select Clarity</option>
                                                @foreach($clarities as $clarity)
                                                    <option value="{{ $clarity->id }}">{{ $clarity->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-2 col-md-6">
                                            <label class="form-label">Color</label>
                                            <select name="packet[color_id][]" class="form-control packet-color-select">
                                                <option value="">Select Color</option>
                                                @foreach($colors as $color)
                                                    <option value="{{ $color->id }}">{{ $color->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-2 col-md-6">
                                            <label class="form-label">Cut</label>
                                            <select name="packet[cut_id][]" class="form-control packet-cut-select">
                                                <option value="">Select Cut</option>
                                                @foreach($cuts as $cut)
                                                    <option value="{{ $cut->id }}">{{ $cut->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-2 col-md-6">
                                            <label class="form-label">MM</label>
                                            <select name="packet[mm_id][]" class="form-control packet-mm-select">
                                                <option value="">Select MM</option>
                                                @foreach($mms as $mm)
                                                    <option value="{{ $mm->id }}">{{ $mm->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-1 col-md-4">
                                            <label class="form-label">Pcs</label>
                                            <input type="text" name="packet[pcs][]" class="form-control packet-pcs">
                                        </div>
                                        <div class="col-lg-1 col-md-4">
                                            <label class="form-label">Carat (Wt)</label>
                                            <input type="text" name="packet[weight][]" class="form-control packet-weight">
                                        </div>
                                        <div class="col-lg-2 col-md-4">
                                            <label class="form-label">Wt (Gram)</label>
                                            <input type="text" step="0.001" name="packet[wt_in_gram][]" class="form-control packet-gram">
                                        </div>
                                        <div class="col-lg-2 col-md-4">
                                            <label class="form-label">Rate</label>
                                            <input type="text" name="packet[rate][]" class="form-control packet-rate">
                                        </div>
                                        <div class="col-lg-2 col-md-4">
                                            <label class="form-label">Certificate No</label>
                                            <input type="text" name="packet[certificate_no][]" class="form-control packet-cert">
                                        </div>
                                        <div class="col-lg-1 col-md-4">
                                            <label class="form-label">UOM</label>
                                            <select name="packet[uom][]" class="form-select packet-uom">
                                                <option value="CT" selected>CT</option>
                                                <option value="PCS">PCS</option>
                                                <option value="WT">WT</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-2 col-md-4">
                                            <label class="form-label">Amount</label>
                                            <input type="text" step="0.01" name="packet[amount][]" class="form-control packet-amount" readonly>
                                        </div>
                                        <div class="col-lg-1 col-md-4 d-flex align-items-center">
                                            <div class="form-check mt-3">
                                                <input class="form-check-input packet-solitaire" type="checkbox" name="packet[solitaire][]" value="1">
                                                <label class="form-check-label small">Solitaire</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </script>
                        </div>

                        <!-- 4. PRODUCT IMAGE UPLOAD -->
                        <div class="mt-4 pt-3 border-top">
                            <span class="section-header">
                                <i class="fa fa-camera me-2"></i> Product Image (Optional)
                            </span>
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <input type="file" name="image" id="product_image" class="form-control" accept="image/*">
                                    <small class="text-muted">Upload an image of the tagged product for quick visual recognition.</small>
                                </div>
                            </div>
                        </div>

                        <!-- 5. ACTION BUTTONS -->
                        <div class="mt-4 pt-3 border-top d-flex justify-content-between align-items-center">
                            <button type="reset" class="btn btn-secondary px-4">
                                <i class="fa fa-redo me-1"></i> Reset Form
                            </button>
                            <button type="submit" id="btnSubmitConvert" class="btn custom-btn-primary px-4 py-2 font-weight-bold">
                                <i class="fa fa-check-circle me-1"></i> Convert Wholesale Stock &amp; Generate Retail Tag
                            </button>
                        </div>
                    </div>
                </form>

            </div>
            <!-- /TAB 1 -->

            <!-- ========================================== -->
            <!-- TAB 2: WHOLESALE LOTS STOCK LIST TABLE -->
            <!-- ========================================== -->
            <div class="tab-pane fade" id="tab-lots-pane" role="tabpanel">

                <!-- Filter Card -->
                <div class="card bg-white shadow-sm border-0 mb-3">
                    <div class="card-body py-3">
                        <form method="GET" action="{{ route('wholesale-stock.index') }}">
                            <div class="row g-2 align-items-center">
                                <div class="col-md-3">
                                    <input type="text" name="search" class="form-control" placeholder="Search Item Name or Pre Code..." value="{{ request('search') }}">
                                </div>
                                <div class="col-md-2">
                                    <select name="category_id" class="form-select">
                                        <option value="">All Categories</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->category_id }}" {{ request('category_id') == $category->category_id ? 'selected' : '' }}>
                                                {{ $category->category_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select name="subcategory_id" class="form-select">
                                        <option value="">All Subcategories</option>
                                        @foreach($subcategories as $subcategory)
                                            <option value="{{ $subcategory->subcategory_id }}" {{ request('subcategory_id') == $subcategory->subcategory_id ? 'selected' : '' }}>
                                                {{ $subcategory->subcategory_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select name="purity_id" class="form-select">
                                        <option value="">All Purities</option>
                                        @foreach($purities as $purity)
                                            <option value="{{ $purity->id }}" {{ request('purity_id') == $purity->id ? 'selected' : '' }}>
                                                {{ $purity->purity_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 d-flex gap-2">
                                    <button type="submit" class="btn btn-primary btn-sm flex-fill">
                                        <i class="fa fa-filter me-1"></i> Filter
                                    </button>
                                    <a href="{{ route('wholesale-stock.index') }}" class="btn btn-outline-secondary btn-sm">
                                        <i class="fa fa-redo me-1"></i> Reset
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Stock List Table -->
                <div class="card bg-white shadow-sm border-0">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped mb-0 align-middle">
                                <thead class="bg-light">
                                    <tr>
                                        <th style="width: 50px;">#</th>
                                        <th>Lot / Item Details</th>
                                        <th>Category / Sub</th>
                                        <th>Purity</th>
                                        <th class="text-end">Available Qty</th>
                                        <th class="text-end">Available Gross Wt</th>
                                        <th class="text-end">Available Net Wt</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($wholesaleStocks as $index => $stock)
                                        <tr>
                                            <td>{{ $wholesaleStocks->firstItem() + $index }}</td>
                                            <td>
                                                <div class="font-weight-bold text-dark">{{ $stock->item_name }}</div>
                                                <span class="badge bg-light text-primary border">{{ $stock->pre_code }}</span>
                                                <span class="small text-muted ms-1">Lot #{{ $stock->id }}</span>
                                            </td>
                                            <td>
                                                <div>{{ optional($stock->category)->category_name ?? '-' }}</div>
                                                <small class="text-muted">{{ optional($stock->subcategory)->subcategory_name ?? '-' }}</small>
                                            </td>
                                            <td>
                                                <span class="badge bg-secondary">{{ optional($stock->purity)->purity_name ?? '-' }}</span>
                                            </td>
                                            <td class="text-end font-weight-bold">
                                                <span class="{{ $stock->available_quantity > 0 ? 'text-primary' : 'text-danger' }}">
                                                    {{ number_format($stock->available_quantity, 0) }} Pcs
                                                </span>
                                            </td>
                                            <td class="text-end font-weight-bold">
                                                {{ number_format($stock->available_gross_weight, 3) }} g
                                            </td>
                                            <td class="text-end font-weight-bold text-success">
                                                {{ number_format($stock->available_net_weight, 3) }} g
                                            </td>
                                            <td class="text-center">
                                                @if ($stock->available_quantity > 0 || $stock->available_net_weight > 0)
                                                    <button type="button" class="btn btn-sm btn-primary me-1" onclick="selectLotForTagging({{ $stock->id }})">
                                                        <i class="fa fa-tag me-1"></i> Convert to Tag
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-outline-info open-tag-modal"
                                                        data-stock-id="{{ $stock->id }}"
                                                        data-stock-name="{{ $stock->item_name }}"
                                                        data-stock-precode="{{ $stock->pre_code }}"
                                                        data-stock-purity="{{ optional($stock->purity)->purity_name ?? '' }}"
                                                        data-stock-avail-qty="{{ $stock->available_quantity }}"
                                                        data-stock-avail-net="{{ $stock->available_net_weight }}">
                                                        <i class="fa fa-layer-group me-1"></i> Bulk Pieces
                                                    </button>
                                                @else
                                                    <span class="badge bg-light text-muted">Out of Stock</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center py-4 text-muted">
                                                <i class="fa fa-info-circle me-1"></i> No wholesale stock lots found.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if($wholesaleStocks->hasPages())
                        <div class="card-footer bg-white border-0 py-3">
                            {{ $wholesaleStocks->links() }}
                        </div>
                    @endif
                </div>

            </div>
            <!-- /TAB 2 -->

        </div>

    </div>
</div>

<!-- ========================================== -->
<!-- BULK PIECES TAGGING MODAL (PRESERVED) -->
<!-- ========================================== -->
<div class="modal fade" id="taggingModal" tabindex="-1" aria-labelledby="taggingModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-primary text-white py-3">
                <h5 class="modal-title font-weight-bold text-white" id="taggingModalLabel">
                    <i class="fa fa-tags me-2"></i> Bulk Tag Wholesale Stock → Convert to Retail Pieces
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="taggingForm" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="alert alert-info border-0 shadow-sm d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h5 class="mb-1 font-weight-bold text-dark" id="modalStockItemName">Gold Ring</h5>
                            <span class="badge bg-primary me-2" id="modalStockPreCode">GR</span>
                            <span class="badge bg-secondary" id="modalStockPurity">22K</span>
                        </div>
                        <div class="text-end">
                            <span class="d-block small text-muted font-weight-bold">Available Wholesale Balance</span>
                            <span class="fs-5 font-weight-bold text-primary" id="modalStockAvailQty">0 Pcs</span> |
                            <span class="fs-5 font-weight-bold text-success" id="modalStockAvailNetWt">0.000 g</span>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold">Select Supplier Batch (Origin)</label>
                            <select name="batch_id" id="modalBatchSelect" class="form-select">
                                <option value="">Auto (FIFO - First Purchased First Tagged)</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label font-weight-bold">Number of Pieces / Tags <span class="text-danger">*</span></label>
                            <input type="number" id="modalTagQuantity" name="tag_quantity" class="form-control" min="1" max="100" value="1" required>
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="button" id="btnGeneratePieceRows" class="btn btn-outline-primary w-100">
                                <i class="fa fa-sync me-1"></i> Generate Piece Rows
                            </button>
                        </div>
                    </div>

                    <div class="table-responsive mb-3">
                        <table class="table table-bordered align-middle table-sm" id="pieceDetailsTable">
                            <thead class="bg-light text-dark small font-weight-bold">
                                <tr>
                                    <th style="width: 40px;" class="text-center">#</th>
                                    <th>Gross Wt (g) <span class="text-danger">*</span></th>
                                    <th>Net Wt (g) <span class="text-danger">*</span></th>
                                    <th>Wastage %</th>
                                    <th>Fine Wt (g)</th>
                                    <th>Size</th>
                                    <th>Making Charge (₹)</th>
                                    <th>Retail Sale Price (₹)</th>
                                    <th>Barcode (Optional)</th>
                                </tr>
                            </thead>
                            <tbody id="pieceRowsTbody"></tbody>
                            <tfoot class="bg-light font-weight-bold small">
                                <tr>
                                    <td class="text-center">Total</td>
                                    <td id="footTotalGross">0.000 g</td>
                                    <td id="footTotalNet" class="text-success font-weight-bold">0.000 g</td>
                                    <td>—</td>
                                    <td id="footTotalFine">0.000 g</td>
                                    <td colspan="4"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div id="modalValidationError" class="alert alert-danger d-none mb-0">
                        <i class="fa fa-exclamation-circle me-1"></i> <span id="modalValidationMsg"></span>
                    </div>
                </div>
                <div class="modal-footer bg-light py-3">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" id="btnSubmitTagging" class="btn btn-success px-4">
                        <i class="fa fa-check-circle me-1"></i> Confirm &amp; Generate Retail Tags
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ========================================== -->
<!-- LABEL PRINT MODAL -->
<!-- ========================================== -->
<div class="modal fade" id="printLabelModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">Print Product Label Tag</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0" style="height: 500px;">
                <iframe id="printLabelIframe" src="" style="width: 100%; height: 100%; border: none;"></iframe>
            </div>
        </div>
    </div>
</div>

<!-- ========================================== -->
<!-- ADD CATEGORY MODAL -->
<!-- ========================================== -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content glass-card border-0">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="addCategoryModalLabel">Add Category</h5>
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

<!-- ========================================== -->
<!-- ADD SUBCATEGORY MODAL -->
<!-- ========================================== -->
<div class="modal fade" id="addSubcategoryModal" tabindex="-1" aria-labelledby="addSubcategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content glass-card border-0">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="addSubcategoryModalLabel">Add Subcategory</h5>
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
                                <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
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

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {

    // --- Select2 for Lot Selection ---
    if ($.fn.select2) {
        $('#wholesale_stock_id').select2({
            placeholder: '-- Choose Wholesale Lot to Tag --',
            allowClear: true,
            width: '100%'
        });
    }

    // --- Lot Selection Handler ---
    $('#wholesale_stock_id').on('change', function() {
        let stockId = $(this).val();
        if (!stockId) {
            $('#lotInfoBanner').addClass('d-none');
            $('#batch_id').html('<option value="">Auto (FIFO)</option>');
            $('#qtyLimitHint').text('Max: -');
            $('#grossLimitHint').text('Max: -');
            $('#netLimitHint').text('Max: -');
            return;
        }

        let selectedOption = $(this).find('option:selected');
        let itemName = selectedOption.data('item-name');
        let preCode = selectedOption.data('pre-code');
        let catId = selectedOption.data('category-id');
        let subcatId = selectedOption.data('subcategory-id');
        let purityId = selectedOption.data('purity-id');
        let purityName = selectedOption.data('purity-name');
        let availQty = parseFloat(selectedOption.data('avail-qty')) || 0;
        let availNet = parseFloat(selectedOption.data('avail-net')) || 0;
        let availGross = parseFloat(selectedOption.data('avail-gross')) || 0;

        // Update Info Banner
        $('#bannerLotName').text(itemName);
        $('#bannerPreCode').text(preCode);
        $('#bannerPurity').text(purityName || 'Purity');
        $('#bannerAvailQty').text(availQty + ' Pcs');
        $('#bannerAvailNet').text(availNet.toFixed(3) + ' g Net');
        $('#bannerAvailGross').text('Gross: ' + availGross.toFixed(3) + ' g');
        $('#lotInfoBanner').removeClass('d-none');

        // Set input limits
        $('#quantity').attr('max', availQty);
        $('#gross_weight').attr('max', availGross);
        $('#net_weight').attr('max', availNet);
        $('#qtyLimitHint').text('Max Lot Balance: ' + availQty + ' Pcs');
        $('#grossLimitHint').text('Max Lot Balance: ' + availGross.toFixed(3) + ' g');
        $('#netLimitHint').text('Max Lot Balance: ' + availNet.toFixed(3) + ' g');

        // Pre-fill Product Form Fields
        $('#product_name').val(itemName);
        $('#pre_code').val(preCode).trigger('change');
        $('#purity_id').val(purityId);

        if (catId) {
            $('#category_id').val(catId).trigger('change');
            loadSubcategories(catId, subcatId);
        }

        // Auto-match Metal Rate based on purity
        matchMetalRateForPurity(purityId, purityName);

        // Fetch supplier batches
        loadBatchesForStock(stockId);
    });

    function loadSubcategories(categoryId, selectedSubcatId = null) {
        if (!categoryId) return;
        $('#subcategory_id').html('<option value="">Loading...</option>');
        $.ajax({
            url: '{{ url("get-subcategories") }}/' + categoryId,
            type: 'GET',
            success: function(data) {
                $('#subcategory_id').html('<option value="">Select Subcategory</option>');
                if (data && data.length > 0) {
                    $.each(data, function(key, subcategory) {
                        let isSel = (subcategory.subcategory_id == selectedSubcatId) ? 'selected' : '';
                        $('#subcategory_id').append('<option value="' + subcategory.subcategory_id + '" ' + isSel + '>' + subcategory.subcategory_name + '</option>');
                    });
                }
            }
        });
    }

    function matchMetalRateForPurity(purityId, purityName) {
        if (!purityName) return;
        let cleanName = purityName.toLowerCase().replace(/[^a-z0-9]/g, '');
        let matchedVal = '';

        $('#metal_rate option').each(function() {
            let optText = $(this).text().toLowerCase().replace(/[^a-z0-9]/g, '');
            let optKarat = String($(this).data('karat') || '').toLowerCase();
            if (optText.includes(cleanName) || (optKarat && cleanName.includes(optKarat))) {
                matchedVal = $(this).val();
                return false;
            }
        });

        if (matchedVal) {
            $('#metal_rate').val(matchedVal).trigger('change');
        }
    }

    function loadBatchesForStock(stockId) {
        $('#batch_id').html('<option value="">Loading Batches...</option>');
        $.get('/wholesale-stock/' + stockId + '/batches', function(res) {
            let batches = res.batches || [];
            let options = '<option value="">Auto (FIFO - First Purchased First Converted)</option>';
            if (batches.length > 0) {
                batches.forEach(function(b) {
                    let grossStr = parseFloat(b.remaining_gross_weight || 0).toFixed(3);
                    let netStr = parseFloat(b.remaining_net_weight || 0).toFixed(3);
                    options += '<option value="' + b.id + '" data-wastage="' + b.wastage_percent + '" data-making="' + b.making_price + '" data-making-type="' + b.making_type + '" data-rem-qty="' + b.remaining_quantity + '" data-rem-gross="' + b.remaining_gross_weight + '" data-rem-net="' + b.remaining_net_weight + '">' +
                        b.supplier_name + ' (Purch #' + b.purchase_no + ') - Rem: ' + b.remaining_quantity + ' Pcs (Gross: ' + grossStr + 'g | Net: ' + netStr + 'g)' +
                        '</option>';
                });
            }
            $('#batch_id').html(options);
        });
    }

    $('#batch_id').on('change', function() {
        let opt = $(this).find('option:selected');
        let batchWastage = opt.data('wastage');
        let batchMaking = opt.data('making');
        let batchMakingType = opt.data('making-type');
        let batchRemQty = opt.data('rem-qty');
        let batchRemGross = parseFloat(opt.data('rem-gross'));
        let batchRemNet = parseFloat(opt.data('rem-net'));

        if (batchWastage !== undefined && batchWastage !== '') {
            $('#wastage_percent').val(batchWastage);
        }
        if (batchMaking !== undefined && batchMaking !== '') {
            $('#making_price').val(batchMaking);
        }
        if (batchMakingType) {
            $('#making_type').val(batchMakingType);
        }

        // Update banner and limits when specific batch is chosen
        if (batchRemQty !== undefined && !isNaN(batchRemQty) && opt.val() !== '') {
            $('#bannerAvailQty').text(batchRemQty + ' Pcs (Batch)');
            $('#bannerAvailNet').text(batchRemNet.toFixed(3) + ' g Net (Batch)');
            $('#bannerAvailGross').text('Gross: ' + batchRemGross.toFixed(3) + ' g (Batch)');
            $('#qtyLimitHint').text('Max Batch Balance: ' + batchRemQty + ' Pcs');
            $('#grossLimitHint').text('Max Batch Balance: ' + batchRemGross.toFixed(3) + ' g');
            $('#netLimitHint').text('Max Batch Balance: ' + batchRemNet.toFixed(3) + ' g');
            $('#quantity').attr('max', batchRemQty);
            $('#gross_weight').attr('max', batchRemGross);
            $('#net_weight').attr('max', batchRemNet);
        } else {
            // Restore Lot totals
            let lotOpt = $('#wholesale_stock_id option:selected');
            let availQty = parseFloat(lotOpt.data('avail-qty')) || 0;
            let availNet = parseFloat(lotOpt.data('avail-net')) || 0;
            let availGross = parseFloat(lotOpt.data('avail-gross')) || 0;
            $('#bannerAvailQty').text(availQty + ' Pcs');
            $('#bannerAvailNet').text(availNet.toFixed(3) + ' g Net');
            $('#bannerAvailGross').text('Gross: ' + availGross.toFixed(3) + ' g');
            $('#qtyLimitHint').text('Max Lot Balance: ' + availQty + ' Pcs');
            $('#grossLimitHint').text('Max Lot Balance: ' + availGross.toFixed(3) + ' g');
            $('#netLimitHint').text('Max Lot Balance: ' + availNet.toFixed(3) + ' g');
            $('#quantity').attr('max', availQty);
            $('#gross_weight').attr('max', availGross);
            $('#net_weight').attr('max', availNet);
        }

        calculatePrice();
    });

    // Auto-fill available weight from batch or lot
    $(document).on('click', '#btnFillLotWeight', function() {
        let batchOpt = $('#batch_id option:selected');
        let batchRemGross = parseFloat(batchOpt.data('rem-gross'));
        let batchRemNet = parseFloat(batchOpt.data('rem-net'));

        let lotOpt = $('#wholesale_stock_id option:selected');
        let availGross = parseFloat(lotOpt.data('avail-gross')) || 0;
        let availNet = parseFloat(lotOpt.data('avail-net')) || 0;

        let targetGross = (!isNaN(batchRemGross) && batchRemGross > 0 && batchOpt.val() !== '') ? batchRemGross : availGross;
        let targetNet   = (!isNaN(batchRemNet) && batchRemNet > 0 && batchOpt.val() !== '') ? batchRemNet : availNet;

        if (targetGross > 0) {
            $('#gross_weight').val(targetGross.toFixed(3));
        }
        if (targetNet > 0) {
            $('#net_weight').val(targetNet.toFixed(3));
        }
        calculatePrice();
    });

    $('#btnRefreshLotData').on('click', function() {
        $('#wholesale_stock_id').trigger('change');
    });

    // Auto-select lot if stock_id is present
    @if (!empty($selectedStockId))
        setTimeout(function() {
            $('#wholesale_stock_id').val('{{ $selectedStockId }}').trigger('change');
        }, 150);
    @endif

    // Global Lot Selector from table click
    window.selectLotForTagging = function(stockId) {
        // Switch to Convert tab
        let tabBtn = document.getElementById('tab-convert-btn');
        let tab = new bootstrap.Tab(tabBtn);
        tab.show();

        // Select lot
        $('#wholesale_stock_id').val(stockId).trigger('change');

        // Scroll to form
        $('html, body').animate({
            scrollTop: $('#lotToTagForm').offset().top - 80
        }, 300);
    };

    // Category change subcategory loading
    $('#category_id').on('change', function() {
        let catId = $(this).val();
        loadSubcategories(catId);
    });

    // Pre-code change triggers Next Post-Code
    let preCodeTimeout = null;
    $('#pre_code').on('input change', function(e) {
        clearTimeout(preCodeTimeout);
        let val = $(this).val().trim().toUpperCase();
        $(this).val(val);

        preCodeTimeout = setTimeout(function() {
            if (!val) {
                $('#post_code').val('0001');
                updateBarcode();
                return;
            }
            $.ajax({
                url: "{{ route('products.getNextPostCode') }}",
                type: "GET",
                data: { pre_code: val },
                success: function(response) {
                    if (response && response.post_code) {
                        $('#post_code').val(response.post_code);
                    }
                    updateBarcode();
                }
            });
        }, 200);
    });

    $('#post_code').on('input change', function() {
        updateBarcode();
    });

    function updateBarcode() {
        let pre = $('#pre_code').val().trim();
        let post = $('#post_code').val().trim();
        if (pre && post) {
            $('#barcode').val(pre + post);
        }
    }

    // Dynamic Price Calculation triggers
    $('#gross_weight, #wastage_percent, #making_price, #making_type, #metal_rate, #quantity').on('keyup change input', function() {
        calculatePrice();
    });

    // --- Packet Management ---
    function initPacketSelect2(element) {
        element.select2({
            placeholder: 'Type to search packet...',
            allowClear: true,
            width: '100%',
            ajax: {
                url: "{{ route('products.searchPacket') }}",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return { term: params.term };
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                id: item.label,
                                text: item.label,
                                real_id: item.id,
                                details: item.details
                            };
                        })
                    };
                },
                cache: true
            }
        }).on('select2:select', function(e) {
            var data = e.params.data;
            var details = data.details || {};
            var wrapper = $(this).closest('.packet-item');

            wrapper.find('.packet-master-id').val(data.real_id);
            if (details.stone_id) wrapper.find('.packet-stone-select').val(details.stone_id);
            if (details.shape_id) wrapper.find('.packet-shape-select').val(details.shape_id);
            if (details.color_id) wrapper.find('.packet-color-select').val(details.color_id);
            if (details.clarity_id) wrapper.find('.packet-clarity-select').val(details.clarity_id);
            if (details.cut_id) wrapper.find('.packet-cut-select').val(details.cut_id);
            if (details.mm_id) wrapper.find('.packet-mm-select').val(details.mm_id);
            if (details.rate) wrapper.find('.packet-rate').val(details.rate);
            if (details.certificate_no) wrapper.find('.packet-cert').val(details.certificate_no);
            if (details.packet_type) wrapper.find('.packet-type-select').val(details.packet_type);
            wrapper.find('.packet-solitaire').prop('checked', details.solitaire == 1);
        });
    }

    $('#addPacketBtn').on('click', function() {
        var template = $('#packetTemplate').html();
        var newRow = $(template);
        $('#packetWrapper').append(newRow);
        initPacketSelect2(newRow.find('.packet-select'));
    });

    $(document).on('click', '.removePacket', function() {
        $(this).closest('.packet-item').remove();
        calculatePrice();
    });

    // Packet weight & amount recalculation
    $(document).on('change keyup input', '.packet-uom, .packet-pcs, .packet-gram, .packet-weight, .packet-rate', function(e) {
        var wrapper = $(this).closest('.packet-item');
        var uom = wrapper.find('.packet-uom').val();
        var pcsInput = wrapper.find('.packet-pcs');
        var gramInput = wrapper.find('.packet-gram');
        var caratInput = wrapper.find('.packet-weight');
        var rateInput = wrapper.find('.packet-rate');
        var amountInput = wrapper.find('.packet-amount');

        var pcs = parseFloat(pcsInput.val()) || 0;
        var gram = parseFloat(gramInput.val()) || 0;
        var carat = parseFloat(caratInput.val()) || 0;
        var rate = parseFloat(rateInput.val()) || 0;
        var amount = 0;

        if ($(e.target).hasClass('packet-weight')) {
            gram = carat * 0.2;
            gramInput.val(gram.toFixed(3));
        } else if ($(e.target).hasClass('packet-gram')) {
            carat = gram * 5;
            caratInput.val(carat.toFixed(2));
        }

        gram = parseFloat(gramInput.val()) || 0;
        carat = parseFloat(caratInput.val()) || 0;

        if (uom === 'PCS') {
            amount = rate * pcs;
        } else if (uom === 'CT') {
            amount = rate * carat;
        } else if (uom === 'WT') {
            amount = rate * gram;
        }

        amountInput.val(amount.toFixed(2));
        calculatePrice();
    });

    // Form submit validation against selected lot balance
    $('#lotToTagForm').on('submit', function(e) {
        let stockId = $('#wholesale_stock_id').val();
        if (!stockId) {
            e.preventDefault();
            Swal.fire('Please Select Wholesale Lot', 'Select a wholesale stock lot at the top before generating retail tag.', 'warning');
            return false;
        }

        let batchOpt = $('#batch_id option:selected');
        let batchRemQty = parseFloat(batchOpt.data('rem-qty'));
        let batchRemNet = parseFloat(batchOpt.data('rem-net'));

        let isBatchSelected = (!isNaN(batchRemQty) && batchOpt.val() !== '');
        let maxQty = isBatchSelected ? batchRemQty : (parseFloat($('#wholesale_stock_id option:selected').data('avail-qty')) || 0);
        let maxNet = isBatchSelected ? batchRemNet : (parseFloat($('#wholesale_stock_id option:selected').data('avail-net')) || 0);
        let balanceLabel = isBatchSelected ? 'Batch' : 'Lot';

        if (enteredQty > maxQty) {
            e.preventDefault();
            Swal.fire('Quantity Exceeds Balance', 'Requested quantity (' + enteredQty + ') exceeds available ' + balanceLabel + ' balance (' + maxQty + ' Pcs).', 'error');
            return false;
        }

        if (enteredNet > (maxNet + 0.005)) {
            e.preventDefault();
            Swal.fire('Net Weight Exceeds Balance', 'Requested net weight (' + enteredNet.toFixed(3) + 'g) exceeds available ' + balanceLabel + ' net weight (' + maxNet.toFixed(3) + 'g).', 'error');
            return false;
        }

        $('#btnSubmitConvert').prop('disabled', true).html('<i class="fa fa-spinner fa-spin me-1"></i> Converting & Generating Tag...');
    });

    // AJAX Add Category
    $('#ajaxAddCategoryForm').on('submit', function(e) {
        e.preventDefault();
        let form = $(this);
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            success: function(response) {
                if (response.success && response.category) {
                    let cat = response.category;
                    let opt = new Option(cat.category_name, cat.category_id, true, true);
                    $('#category_id').append(opt).trigger('change');
                    $('#modal_subcat_category_id').append(new Option(cat.category_name, cat.category_id));
                    form[0].reset();
                    bootstrap.Modal.getInstance(document.getElementById('addCategoryModal')).hide();
                }
            }
        });
    });

    // AJAX Add Subcategory
    $('#ajaxAddSubcategoryForm').on('submit', function(e) {
        e.preventDefault();
        let form = $(this);
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            success: function(response) {
                if (response.success && response.subcategory) {
                    let sub = response.subcategory;
                    let opt = new Option(sub.subcategory_name, sub.subcategory_id, true, true);
                    $('#subcategory_id').append(opt).val(sub.subcategory_id);
                    form[0].reset();
                    bootstrap.Modal.getInstance(document.getElementById('addSubcategoryModal')).hide();
                }
            }
        });
    });

    // --- Bulk Pieces Modal Handling (Preserved) ---
    $(document).on('click', '.open-tag-modal', function() {
        let stockId = $(this).data('stock-id');
        let stockName = $(this).data('stock-name');
        let stockPreCode = $(this).data('stock-precode');
        let stockPurity = $(this).data('stock-purity');
        let availQty = $(this).data('stock-avail-qty');
        let availNet = $(this).data('stock-avail-net');

        $('#modalStockItemName').text(stockName);
        $('#modalStockPreCode').text(stockPreCode);
        $('#modalStockPurity').text(stockPurity);
        $('#modalStockAvailQty').text(availQty + ' Pcs');
        $('#modalStockAvailNetWt').text(parseFloat(availNet).toFixed(3) + ' g');
        $('#taggingForm').attr('action', '/wholesale-stock/' + stockId + '/tag');

        $('#modalBatchSelect').html('<option value="">Auto (FIFO)</option>');
        $.get('/wholesale-stock/' + stockId + '/batches', function(res) {
            let batches = res.batches || [];
            batches.forEach(function(b) {
                $('#modalBatchSelect').append('<option value="' + b.id + '">' + b.supplier_name + ' (Purch #' + b.purchase_no + ') - Rem: ' + b.remaining_quantity + ' Pcs</option>');
            });
        });

        $('#modalTagQuantity').val(1);
        generateBulkPieceRows(1);
        $('#taggingModal').modal('show');
    });

    function generateBulkPieceRows(count) {
        let tbody = $('#pieceRowsTbody').empty();
        for (let i = 1; i <= count; i++) {
            tbody.append(`
                <tr>
                    <td class="text-center font-weight-bold">${i}</td>
                    <td><input type="number" step="0.001" min="0.001" name="piece_details[${i-1}][gross_weight]" class="form-control form-control-sm bulk-gw" required></td>
                    <td><input type="number" step="0.001" min="0.001" name="piece_details[${i-1}][net_weight]" class="form-control form-control-sm bulk-nw" required></td>
                    <td><input type="number" step="0.01" name="piece_details[${i-1}][wastage_percent]" class="form-control form-control-sm bulk-wp" value="0"></td>
                    <td><input type="text" name="piece_details[${i-1}][final_fn_weight]" class="form-control form-control-sm bulk-fw" readonly></td>
                    <td><input type="text" name="piece_details[${i-1}][size]" class="form-control form-control-sm"></td>
                    <td><input type="number" step="0.01" name="piece_details[${i-1}][making_price]" class="form-control form-control-sm" value="0"></td>
                    <td><input type="number" step="0.01" name="piece_details[${i-1}][sale_price]" class="form-control form-control-sm" value="0"></td>
                    <td><input type="text" name="piece_details[${i-1}][barcode]" class="form-control form-control-sm" placeholder="Auto"></td>
                </tr>
            `);
        }
    }

    $('#btnGeneratePieceRows').on('click', function() {
        let q = parseInt($('#modalTagQuantity').val()) || 1;
        generateBulkPieceRows(q);
    });

    $(document).on('input', '.bulk-gw, .bulk-nw, .bulk-wp', function() {
        let row = $(this).closest('tr');
        let nw = parseFloat(row.find('.bulk-nw').val()) || 0;
        let wp = parseFloat(row.find('.bulk-wp').val()) || 0;
        let fw = nw + ((nw * wp) / 100);
        row.find('.bulk-fw').val(fw.toFixed(3));

        let totGw = 0, totNw = 0, totFw = 0;
        $('.bulk-gw').each(function() { totGw += parseFloat($(this).val()) || 0; });
        $('.bulk-nw').each(function() { totNw += parseFloat($(this).val()) || 0; });
        $('.bulk-fw').each(function() { totFw += parseFloat($(this).val()) || 0; });
        $('#footTotalGross').text(totGw.toFixed(3) + ' g');
        $('#footTotalNet').text(totNw.toFixed(3) + ' g');
        $('#footTotalFine').text(totFw.toFixed(3) + ' g');
    });

});
</script>

@if (session('print_template_id') && session('print_product_id'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var printTemplateId = "{{ session('print_template_id') }}";
        var printProductId = "{{ session('print_product_id') }}";
        var printUrl = "/labels/print/preview/" + printTemplateId + "/" + printProductId;

        var iframe = document.getElementById('printLabelIframe');
        iframe.src = printUrl;

        var printModal = new bootstrap.Modal(document.getElementById('printLabelModal'));
        printModal.show();

        iframe.onload = function() {
            setTimeout(function() {
                iframe.contentWindow.print();
            }, 500);
        };
    });
</script>
@endif
@endsection
