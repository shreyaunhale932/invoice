@extends('layout.mainlayout')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <script src="{{ url('/assets/js/calculation.js') }}"></script>
            <script src="{{ url('/assets/js/functions.js') }}"></script>

            <style>
                .readonly-field {
                    pointer-events: none;
                    background-color: #e9ecef;
                    cursor: not-allowed;
                }

                .glass-card {
                    background: rgba(255, 255, 255, 0.7);
                    backdrop-filter: blur(10px);
                    -webkit-backdrop-filter: blur(10px);
                    border: 1px solid rgba(255, 255, 255, 0.3);
                    box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.1);
                    border-radius: 15px;
                    transition: all 0.3s ease;
                }

                .dark .glass-card {
                    background: rgba(30, 30, 30, 0.6);
                    border: 1px solid rgba(255, 255, 255, 0.1);
                    box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3);
                }

                .glass-card:hover {
                    transform: translateY(-5px);
                    box-shadow: 0 12px 40px 0 rgba(31, 38, 135, 0.15);
                }

                .form-group-item {
                    background: transparent !important;
                    border: none !important;
                    padding: 0 !important;
                }

                .section-header {
                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                    -webkit-background-clip: text;
                    -webkit-text-fill-color: transparent;
                    font-weight: 700;
                    margin-bottom: 20px;
                    border-bottom: 2px solid rgba(118, 75, 162, 0.2);
                    padding-bottom: 10px;
                    display: inline-block;
                }

                .dark .section-header {
                    background: linear-gradient(135deg, #a18cd1 0%, #fbc2eb 100%);
                    -webkit-background-clip: text;
                    -webkit-text-fill-color: transparent;
                    border-bottom: 2px solid rgba(251, 194, 235, 0.2);
                }

                .form-control,
                .form-select,
                .select {
                    border-radius: 8px;
                    border: 1px solid #ced4da;
                    padding: 10px 15px;
                    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
                }

                .form-control:focus,
                .form-select:focus {
                    border-color: #764ba2;
                    box-shadow: 0 0 0 0.25rem rgba(118, 75, 162, 0.25);
                }

                .dark .form-control,
                .dark .form-select,
                .dark .select {
                    background-color: #2b2b2b;
                    border-color: #444;
                    color: #fff;
                }

                .dark .form-control:focus,
                .dark .form-select:focus {
                    border-color: #a18cd1;
                    box-shadow: 0 0 0 0.25rem rgba(161, 140, 209, 0.25);
                }

                label {
                    font-weight: 600;
                    color: #4a5568;
                    margin-bottom: 8px;
                }

                .dark label {
                    color: #e2e8f0;
                }

                .custom-btn-primary {
                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                    border: none;
                    border-radius: 8px;
                    padding: 10px 25px;
                    font-weight: 600;
                    transition: all 0.3s ease;
                }

                .custom-btn-primary:hover {
                    transform: translateY(-2px);
                    box-shadow: 0 4px 15px rgba(118, 75, 162, 0.4);
                }
            </style>



            <div class="container-fluid p-0">

                <div class="page-header">
                    <h5>
                        {{ isset($product) ? 'Update Product' : 'Add Product' }}
                        </h4>
                </div>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form method="POST"
                    action="{{ isset($product) ? route('products.update', $product->id) : route('products.store') }}"
                    enctype="multipart/form-data">

                    @csrf
                    @if (isset($product))
                        @method('PUT')
                    @endif


                    <!-- BASIC DETAILS -->
                    <div class="card glass-card mb-4 p-4">
                        <div class="form-group-item">
                            <h4 class="section-header">Basic Details</h4>

                            <div class="row">

                                <!-- Product Name -->
                                <div class="col-lg-4">
                                    <label>Product Name *</label>
                                    <input type="text" class="form-control" name="product_name"
                                        value="{{ old('product_name', $product->product_name ?? '') }}" required>

                                    @error('product_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Product Code -->
                                <div class="col-lg-4">
                                    <label>Item Code</label>
                                    <input type="text" class="form-control {{ isset($product) ? 'readonly-field' : '' }}"
                                        name="pre_code" id="pre_code"
                                        value="{{ old('pre_code', $product->pre_code ?? '') }}"
                                        {{ isset($product) ? 'readonly' : '' }}>


                                    <small id="productCodeMsg"></small>
                                    @error('pre_code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="col-lg-4">
                                    <label>Post Code</label>
                                    <input type="number"
                                        class="form-control {{ isset($product) ? 'readonly-field' : '' }}" name="post_code"
                                        id="post_code" value="{{ old('post_code', $product->post_code ?? 1) }}"
                                        {{ isset($product) ? 'readonly' : '' }}>

                                    @error('post_code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>



                                <!-- Barcode -->
                                <div class="col-lg-4">
                                    <label>Barcode</label>
                                    <input type="text"
                                        class="form-control {{ isset($product) ? 'readonly-field' : '' }}" name="barcode"
                                        value="{{ old('barcode', $product->barcode ?? ($newBarcode ?? '')) }}"
                                        {{ isset($product) ? 'readonly' : '' }}>
                                    @error('barcode')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Category -->
                                <div class="col-lg-4 mt-3">
                                    <label>Category*</label>
                                    <select name="category_id" id="category_id"
                                        class="form-control {{ isset($product) ? 'readonly-field' : '' }}" required>
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->category_id }}"
                                                data-metal="{{ strtolower($category->category_name) }}"
                                                {{ old('category_id', $product->category_id ?? '') == $category->category_id ? 'selected' : '' }}>
                                                {{ $category->category_name }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>


                                <!-- Subcategory -->
                                <div class="col-lg-4 mt-3">
                                    <label>Subcategory *</label>
                                    <select name="subcategory_id" id="subcategory_id"
                                        class="form-control {{ isset($product) ? 'readonly-field' : '' }}" required>
                                        <option value="">Select Subcategory</option>
                                        @foreach ($subcategories as $subcategory)
                                            <option value="{{ $subcategory->subcategory_id }}"
                                                {{ old('subcategory_id', $product->subcategory_id ?? '') == $subcategory->subcategory_id ? 'selected' : '' }}>
                                                {{ $subcategory->subcategory_name }}
                                            </option>
                                        @endforeach>
                                    </select>
                                </div>


                                <!-- Purity -->
                                <div class="col-lg-4 mt-3">
                                    <label>Purity</label>
                                    <select name="purity_id" id="purity_id" class="form-control select" required>
                                        <option value="">Select Purity</option>
                                        @foreach ($purities as $purity)
                                            <option value="{{ $purity->id }}"
                                                data-purity-value="{{ (float) $purity->purity_value }}"
                                                data-purity-type="{{ $purity->purity_type }}"
                                                {{ old('purity_id', $product->purity_id ?? '') == $purity->id ? 'selected' : '' }}>
                                                {{ $purity->purity_value }}{{ $purity->purity_type == 'karat' ? 'K' : '%' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <label>Hallmark(HUID)</label>
                                    <input type="text" class="form-control" name="hallmarking"
                                        value="{{ old('hallmarking', $product->hallmarking ?? '') }}">
                                </div>

                            </div>
                        </div>

                    </div>
                    <!-- METAL DETAILS -->
                    <div class="card glass-card mb-4 p-4">
                        <div class="form-group-item mt-4">
                            <h4 class="section-header">Metal Details</h4>

                            <div class="row">

                                <!-- Metal Rate -->
                                <div class="col-lg-3 col-md-6">
                                    <label>Metal Rate</label>
                                    {{-- <select name="metal_rate_id" id="metal_rate" class="form-control select" required>
                                        <option value="">Select Metal Rate</option>
                                        @foreach ($metalRates as $rate)
                                            <option value="{{ $rate->id }}" data-price="{{ $rate->price_per_gram }}"  data-metal="{{ strtolower($rate->metal_type) }}"
                                                {{ old('metal_rate', $product->metal_rate ?? '') == $rate->id ? 'selected' : '' }}>
                                                {{ $rate->metal_type }} - ₹{{ $rate->price_per_gram }}/gm -
                                                {{ $rate->karat }}
                                            </option>
                                        @endforeach
                                    </select> --}}
                                    <select name="metal_rate_id" id="metal_rate" class="form-control" required>
                                        <option value="">Select Metal Rate</option>
                                        @foreach ($metalRates as $rate)
                                            <option value="{{ $rate->id }}"
                                                data-metal="{{ strtolower($rate->metal_type) }}"
                                                data-price="{{ $rate->price_per_gram }}"
                                                data-karat="{{ (float) $rate->karat }}"
                                                data-purity-type="{{ $rate->purity_type }}"
                                                {{ old('metal_rate', $product->metal_rate ?? '') == $rate->id ? 'selected' : '' }}>
                                                {{ $rate->metal_type }} - ₹{{ $rate->price_per_gram }}/gm -
                                                {{ $rate->karat }}{{ $rate->purity_type === 'karat' ? 'K' : '%' }}
                                            </option>
                                        @endforeach
                                    </select>


                                </div>

                                <!-- Gold Color -->
                                <div class="col-lg-3 col-md-6">
                                    <label>Gold Color</label>
                                    <select class="form-control" name="gold_color">
                                        <option value="">Select Gold Color</option>
                                        <option value="Rose Gold"
                                            {{ old('gold_color', $product->gold_color ?? '') == 'Rose Gold' ? 'selected' : '' }}>
                                            Rose Gold</option>
                                        <option value="Yellow Gold"
                                            {{ old('gold_color', $product->gold_color ?? '') == 'Yellow Gold' ? 'selected' : '' }}>
                                            Yellow Gold</option>
                                        <option value="White Gold"
                                            {{ old('gold_color', $product->gold_color ?? '') == 'White Gold' ? 'selected' : '' }}>
                                            White Gold</option>
                                    </select>
                                </div>

                                <!-- Quantity -->
                                <div class="col-lg-3 col-md-6">
                                    <label>Quantity</label>
                                    <input type="number" min="1" class="form-control" name="quantity"
                                        value="{{ old('quantity', $product->quantity ?? 1) }}">
                                </div>

                                <!-- HSN Code -->
                                <div class="col-lg-3 col-md-6">
                                    <label>HSN Code</label>
                                    <input type="text" class="form-control" name="hsn_code"
                                        value="{{ old('hsn_code', $product->hsn_code ?? '') }}" >
                                </div>

                            </div>

                            <!-- ================= WEIGHT ROW ================= -->

                            <div class="row mt-3">

                                <!-- Gross Weight (GS WT) -->
                                <div class="col-lg-4 col-md-4">
                                    <label>Gross Weight (GS WT)</label>
                                    <div class="input-group">
                                        <input type="number" step="0.001" class="form-control" name="gross_weight"
                                            value="{{ old('gross_weight', $product->gross_weight ?? '') }}" required>

                                        <select class="form-control" name="gross_weight_unit"
                                            style="max-width: 90px; pointer-events:none; background:#e9ecef;">
                                            <option value="GM"
                                                {{ old('gross_weight_unit', $product->gross_weight_unit ?? '') == 'GM' ? 'selected' : '' }}>
                                                GM</option>
                                            <option value="MG"
                                                {{ old('gross_weight_unit', $product->gross_weight_unit ?? '') == 'MG' ? 'selected' : '' }}>
                                                MG</option>
                                            <option value="KG"
                                                {{ old('gross_weight_unit', $product->gross_weight_unit ?? '') == 'KG' ? 'selected' : '' }}>
                                                KG</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Net Weight -->
                                <div class="col-lg-4 col-md-4">
                                    <label>Net Weight</label>
                                    <div class="input-group">
                                        <input type="number" step="0.001" class="form-control" name="net_weight"
                                            value="{{ old('net_weight', $product->net_weight ?? '') }}" required>

                                        <select class="form-control" name="net_weight_unit"
                                            style="max-width: 90px; pointer-events:none; background:#e9ecef;">
                                            <option value="GM"
                                                {{ old('net_weight_unit', $product->net_weight_unit ?? '') == 'GM' ? 'selected' : '' }}>
                                                GM</option>
                                            <option value="MG"
                                                {{ old('net_weight_unit', $product->net_weight_unit ?? '') == 'MG' ? 'selected' : '' }}>
                                                MG</option>
                                            <option value="KG"
                                                {{ old('net_weight_unit', $product->net_weight_unit ?? '') == 'KG' ? 'selected' : '' }}>
                                                KG</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <label>Net Wt With Wastage</label>
                                    <div class="input-group">
                                        <input type="number" step="0.001" class="form-control" name="final_fn_weight"
                                            value="{{ old('final_fn_weight', $product->final_fn_weight ?? '') }}"
                                            required>

                                        <select class="form-control" name="final_fn_weight_unit"
                                            style="max-width: 90px; pointer-events:none; background:#e9ecef;">
                                            <option value="GM"
                                                {{ old('final_fn_weight_unit', $product->final_fn_weight_unit ?? '') == 'GM' ? 'selected' : '' }}>
                                                GM</option>
                                            <option value="MG"
                                                {{ old('final_fn_weight_unit', $product->final_fn_weight_unit ?? '') == 'MG' ? 'selected' : '' }}>
                                                MG</option>
                                            <option value="KG"
                                                {{ old('final_fn_weight_unit', $product->final_fn_weight_unit ?? '') == 'KG' ? 'selected' : '' }}>
                                                KG</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Final Fine Weight -->
                                <div class="col-lg-4 col-md-4">
                                    <label>Size</label>
                                    <input type="text" step="" class="form-control" name="size"
                                        value="{{ old('size', $product->size ?? '') }}">
                                </div>

                            </div>



                        </div>



                    </div>
                    <!-- PRICING -->
                    <div class="card glass-card mb-4 p-4">
                        <div class="form-group-item mt-4">
                            <h4 class="section-header">Pricing</h4>

                            <div class="row">

                                <!-- Row 1 (5 fields in one line) -->
                                <div class="col-lg-2 col-md-6 mb-3">
                                    <label>Wastage %</label>
                                    <input type="text" class="form-control" name="wastage_percent"
                                        value="{{ old('wastage_percent', $product->wastage_percent ?? '') }}">
                                </div>

                                <div class="col-lg-2 col-md-6 mb-3">
                                    <label>Wastage Amount</label>
                                    <input type="text" class="form-control" name="wastage_amount"
                                        value="{{ old('wastage_amount', $product->wastage_amount ?? '') }}" readonly>
                                </div>

                                <div class="col-lg-2 col-md-6 mb-3">
                                    <label>Making</label>
                                    <input type="text" class="form-control" name="making_price"
                                        value="{{ old('making_price', $product->making_price ?? '') }}">
                                </div>

                                <div class="col-lg-3 col-md-6 mb-3">
                                    <label>Making Type</label>
                                    <select class="form-control" name="making_type" id="making_type">
                                        <option value="val"
                                            {{ old('making_type', $product->making_type ?? '') == 'val' ? 'selected' : '' }}>
                                            Value</option>
                                        <option value="per_gld_val"
                                            {{ old('making_type', $product->making_type ?? '') == 'per_gld_val' ? 'selected' : '' }}>
                                            % of Gold Value</option>
                                        <option value="per_pcs"
                                            {{ old('making_type', $product->making_type ?? '') == 'per_pcs' ? 'selected' : '' }}>
                                            Per Pcs</option>
                                        <option value="per_gm_nw"
                                            {{ old('making_type', $product->making_type ?? '') == 'per_gm_nw' ? 'selected' : '' }}>
                                            Rate/Gm of Nw</option>
                                        <option value="per_gm_gw"
                                            {{ old('making_type', $product->making_type ?? '') == 'per_gm_gw' ? 'selected' : '' }}>
                                            Rate/Gm of Gw</option>
                                        <option value="per_gm_fine_wt"
                                            {{ old('making_type', $product->making_type ?? '') == 'per_gm_fine_wt' ? 'selected' : '' }}>
                                            Rate/Gm of Fine Wt</option>
                                    </select>

                                </div>

                                <div class="col-lg-3 col-md-6 mb-3">
                                    <label>Making Amount</label>
                                    <input type="text" class="form-control" name="making_final_amount"
                                        value="{{ old('making_final_amount', $product->making_final_amount ?? '') }}">
                                </div>

                                <!-- Row 2 -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <label>Gold Price</label>
                                    <input type="text" class="form-control" name="gold_price"
                                        value="{{ old('gold_price', $product->gold_price ?? '') }}" required>
                                </div>

                                {{-- <div class="col-lg-4 col-md-6 mb-3">
                                    <label>Sale Price</label>
                                    <input type="text" class="form-control" name="sale_price"
                                        value="{{ old('sale_price', $product->sale_price ?? '') }}">
                                </div> --}}

                                {{-- <div class="col-lg-4 col-md-6 mb-3">
                                    <label>GST %</label>
                                    <input type="text" class="form-control" name="gst_percent"
                                        value="{{ old('gst_percent', $product->gst_percent ?? '') }}">
                                </div> --}}

                                <!-- Row 3 -->
                                {{-- <div class="col-lg-4 col-md-6 mb-3">
                                    <label>GST Amount</label>
                                    <input type="text" class="form-control" name="gst_amount"
                                        value="{{ old('gst_amount', $product->gst_amount ?? '') }}">
                                </div>

                                <div class="col-lg-4 col-md-6 mb-3">
                                    <label>MRP Price</label>
                                    <input type="text" class="form-control" name="mrp_price"
                                        value="{{ old('mrp_price', $product->mrp_price ?? '') }}">
                                </div> --}}

                                <div class="col-lg-4 col-md-6 mb-3">
                                    <label>Final Price</label>
                                    <input type="text" class="form-control" name="final_price"
                                        value="{{ old('final_price', $product->final_price ?? '') }}">
                                </div>

                            </div>
                        </div>

                    </div>
                    <!-- DIAMOND & STONES -->
                    <div class="card glass-card mb-4 p-4">
                        <div class="form-group-item mt-4">
                            <h4 class="section-header">Diamonds & Stones</h4>

                            <button type="button" id="addDiamondBtn" class="btn btn-success mb-4">
                                + Add Diamond
                            </button>

                            <div id="diamondWrapper">

                                @if (isset($product) && $product->diamonds->count())
                                    @foreach ($product->diamonds as $diamond)
                                        <div class="card p-3 mt-3 diamond-item">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h6>Diamond</h6>
                                                <button type="button" class="btn btn-sm  removeDiamond">✖</button>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <label>Clarity</label>
                                                    <input type="text" name="diamond[clarity][]" class="form-control"
                                                        value="{{ $diamond->clarity }}">
                                                </div>

                                                <div class="col-lg-3">
                                                    <label>Cut</label>
                                                    <input type="text" name="diamond[cut][]" class="form-control"
                                                        value="{{ $diamond->cut }}">
                                                </div>

                                                <div class="col-lg-3">
                                                    <label>Color</label>
                                                    <input type="text" name="diamond[color][]" class="form-control"
                                                        value="{{ $diamond->color }}">
                                                </div>

                                                <div class="col-lg-3">
                                                    <label>Pieces</label>
                                                    <input type="number" name="diamond[pieces][]" class="form-control"
                                                        value="{{ $diamond->pieces }}">
                                                </div>

                                                <div class="col-lg-3 mt-3">
                                                    <label>Diamond Weight (carat)</label>
                                                    <input type="text" name="diamond[diamond_weight][]"
                                                        class="form-control" value="{{ $diamond->diamond_weight }}"
                                                        required>
                                                </div>

                                                <div class="col-lg-3 mt-3">
                                                    <label>Price Per Carat</label>
                                                    <input type="text" name="diamond[price_per_carat][]"
                                                        class="form-control" value="{{ $diamond->price_per_carat }}"
                                                        required>
                                                </div>

                                                <div class="col-lg-3 mt-3">
                                                    <label>Final Price</label>
                                                    <input type="text" name="diamond[diamond_final_price][]"
                                                        class="form-control" value="{{ $diamond->diamond_final_price }}"
                                                        required>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif

                            </div>




                            <button type="button" id="addStoneBtn" class="btn btn-info ms-2">
                                + Add Stone
                            </button>

                            <div id="stoneWrapper" class="mt-3">

                                @if (isset($product) && $product->stones->count())
                                    @foreach ($product->stones as $stone)
                                        <div class="card p-3 mt-3 stone-item">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h6>Stone</h6>
                                                <button type="button" class="btn btn-sm  removeStone">✖</button>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <label>Stone Name</label>
                                                    <input type="text" name="stone[stone_name][]" class="form-control"
                                                        value="{{ $stone->stone_name }}" required>
                                                </div>

                                                <div class="col-lg-3">
                                                    <label>Stone Weight</label>
                                                    <input type="text" name="stone[stone_weight][]"
                                                        class="form-control" value="{{ $stone->stone_weight }}" required>
                                                </div>

                                                <div class="col-lg-3">
                                                    <label>Stone Price</label>
                                                    <input type="text" name="stone[stone_price][]"
                                                        class="form-control" value="{{ $stone->stone_price }}" required>
                                                </div>

                                                <div class="col-lg-3">
                                                    <label>Final Price</label>
                                                    <input type="text" name="stone[stone_final_price][]"
                                                        class="form-control" value="{{ $stone->stone_final_price }}"
                                                        required>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif

                            </div>




                            <script type="text/template" id="diamondTemplate">
                                <div class="card p-3 mt-3 diamond-item">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h6>Add Diamond</h6>
                                        <button type="button" class="btn btn-sm  removeDiamond">✖</button>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label>Clarity</label>
                                            <input type="text" name="diamond[clarity][]" class="form-control">
                                        </div>

                                        <div class="col-lg-3">
                                            <label>Cut</label>
                                            <input type="text" name="diamond[cut][]" class="form-control">
                                        </div>

                                        <div class="col-lg-3">
                                            <label>Color</label>
                                            <input type="text" name="diamond[color][]" class="form-control">
                                        </div>

                                        <div class="col-lg-3">
                                            <label>Pieces</label>
                                            <input type="number" name="diamond[pieces][]" class="form-control">
                                        </div>

                                        <div class="col-lg-3 mt-3">
                                            <label>Diamond Weight (carat)</label>
                                            <input type="text" name="diamond[diamond_weight][]" class="form-control">
                                        </div>

                                        <div class="col-lg-3 mt-3">
                                            <label>Price Per Carat</label>
                                            <input type="text" name="diamond[price_per_carat][]" class="form-control">
                                        </div>

                                        <div class="col-lg-3 mt-3">
                                            <label>Final Price</label>
                                            <input type="text" name="diamond[diamond_final_price][]" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </script>

                            <script type="text/template" id="stoneTemplate">
                                <div class="card p-3 mt-3 stone-item">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h6>Add Stone</h6>
                                        <button type="button" class="btn btn-sm  removeStone">✖</button>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label>Stone Name</label>
                                            <input type="text" name="stone[stone_name][]" class="form-control">
                                        </div>

                                        <div class="col-lg-3">
                                            <label>Stone Weight</label>
                                            <input type="text" name="stone[stone_weight][]" class="form-control">
                                        </div>

                                        <div class="col-lg-3">
                                            <label>Stone Price</label>
                                            <input type="text" name="stone[stone_price][]" class="form-control">
                                        </div>

                                        <div class="col-lg-3">
                                            <label>Final Price</label>
                                            <input type="text" name="stone[stone_final_price][]" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </script>


                            <div id="diamondList" class="mt-3"></div>
                            <div id="stoneList" class="mt-3"></div>

                        </div>

                    </div>
                    <!-- PACKETS -->
                    <div class="card glass-card mb-4 p-4">
                        <div class="form-group-item mt-4">
                            <h4 class="section-header">Packets</h4>

                            <button type="button" id="addPacketBtn" class="btn btn-warning mb-4">
                                + Add Packet
                            </button>

                            <div id="packetWrapper">
                                @if (isset($product) && $product->packets->count())
                                    @foreach ($product->packets as $packet)
                                        <div class="card p-3 mt-3 packet-item">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h6>Packet Ref: {{ $packet->packet_no }}</h6>
                                                <button type="button" class="btn btn-sm removePacket">✖</button>
                                            </div>
                                            <input type="hidden" name="packet[packet_master_id][]"
                                                value="{{ $packet->packet_master_id }}">

                                            <div class="row g-3">

                                                <div class="col-lg-3 col-md-6">
                                                    <label class="form-label">Packet No *</label>
                                                    <select name="packet[packet_no][]" class="form-control packet-select"
                                                        required>
                                                        <option value="{{ $packet->packet_no }}" selected>
                                                            {{ $packet->packet_no }}
                                                        </option>
                                                    </select>
                                                </div>

                                                <div class="col-lg-3 col-md-6">
                                                     <label class="form-label">Stone</label>
                                                     <select name="packet[stone_id][]" class="form-control packet-stone-select">
                                                         <option value="">Select Stone</option>
                                                         @foreach($stones as $stone)
                                                             <option value="{{ $stone->id }}" {{ $packet->stone_id == $stone->id ? 'selected' : '' }}>{{ $stone->name }}</option>
                                                         @endforeach
                                                     </select>
                                                 </div>

                                                 <div class="col-lg-3 col-md-6">
                                                     <label class="form-label">Shape</label>
                                                     <select name="packet[shape_id][]" class="form-control packet-shape-select">
                                                         <option value="">Select Shape</option>
                                                         @foreach($shapes as $shape)
                                                             <option value="{{ $shape->id }}" {{ $packet->shape_id == $shape->id ? 'selected' : '' }}>{{ $shape->name }}</option>
                                                         @endforeach
                                                     </select>
                                                 </div>

                                                 <div class="col-lg-3 col-md-6">
                                                     <label class="form-label">Clarity</label>
                                                     <select name="packet[clarity_id][]" class="form-control packet-clarity-select">
                                                         <option value="">Select Clarity</option>
                                                         @foreach($clarities as $clarity)
                                                             <option value="{{ $clarity->id }}" {{ $packet->clarity_id == $clarity->id ? 'selected' : '' }}>{{ $clarity->name }}</option>
                                                         @endforeach
                                                     </select>
                                                 </div>

                                                 <div class="col-lg-3 col-md-6">
                                                     <label class="form-label">Color</label>
                                                     <select name="packet[color_id][]" class="form-control packet-color-select">
                                                         <option value="">Select Color</option>
                                                         @foreach($colors as $color)
                                                             <option value="{{ $color->id }}" {{ $packet->color_id == $color->id ? 'selected' : '' }}>{{ $color->name }}</option>
                                                         @endforeach
                                                     </select>
                                                 </div>

                                                 <div class="col-lg-3 col-md-6">
                                                     <label class="form-label">Cut</label>
                                                     <select name="packet[cut_id][]" class="form-control packet-cut-select">
                                                         <option value="">Select Cut</option>
                                                         @foreach($cuts as $cut)
                                                             <option value="{{ $cut->id }}" {{ $packet->cut_id == $cut->id ? 'selected' : '' }}>{{ $cut->name }}</option>
                                                         @endforeach
                                                     </select>
                                                 </div>

                                                 <div class="col-lg-3 col-md-6">
                                                     <label class="form-label">MM</label>
                                                     <select name="packet[mm_id][]" class="form-control packet-mm-select">
                                                         <option value="">Select MM</option>
                                                         @foreach($mms as $mm)
                                                             <option value="{{ $mm->id }}" {{ $packet->mm_id == $mm->id ? 'selected' : '' }}>{{ $mm->name }}</option>
                                                         @endforeach
                                                     </select>
                                                 </div>

                                                <div class="col-lg-3 col-md-6">
                                                    <label class="form-label">Pcs</label>
                                                    <input type="number" name="packet[pcs][]"
                                                        class="form-control packet-pcs" value="{{ $packet->pcs }}">
                                                </div>

                                                <div class="col-lg-3 col-md-6">
                                                    <label class="form-label">Carat (Wt)</label>
                                                    <input type="text" name="packet[weight][]"
                                                        class="form-control packet-weight"
                                                        value="{{ $packet->weight }}">
                                                </div>

                                                <div class="col-lg-3 col-md-6">
                                                    <label class="form-label">Wt (Gram)</label>
                                                    <input type="number" step="0.001" name="packet[wt_in_gram][]"
                                                        class="form-control packet-gram"
                                                        value="{{ $packet->wt_in_gram }}">
                                                </div>

                                                <div class="col-lg-3 col-md-6">
                                                    <label class="form-label">Rate</label>
                                                    <input type="text" name="packet[rate][]"
                                                        class="form-control packet-rate" value="{{ $packet->rate }}">
                                                </div>

                                                <div class="col-lg-3 col-md-6">
                                                    <label class="form-label">Certificate No</label>
                                                    <input type="text" name="packet[certificate_no][]"
                                                        class="form-control packet-cert"
                                                        value="{{ $packet->certificate_no }}" readonly>
                                                </div>

                                                <div class="col-lg-3 col-md-6">
                                                    <label class="form-label">UOM</label>
                                                    <select name="packet[uom][]" class="form-select packet-uom">
                                                        <option value="">Select UOM</option>
                                                        <option value="PCS"
                                                            {{ $packet->uom == 'PCS' ? 'selected' : '' }}>
                                                            PCS
                                                        </option>
                                                        <option value="CT"
                                                            {{ $packet->uom == 'CT' ? 'selected' : '' }}>
                                                            CT
                                                        </option>
                                                        <option value="WT"
                                                            {{ $packet->uom == 'WT' ? 'selected' : '' }}>
                                                            WT
                                                        </option>
                                                    </select>
                                                </div>

                                                <div class="col-lg-3 col-md-6">
                                                    <label class="form-label">Amount</label>
                                                    <input type="number" step="0.01" name="packet[amount][]"
                                                        class="form-control packet-amount" value="{{ $packet->amount }}"
                                                        readonly>
                                                </div>

                                                <div class="col-lg-3 col-md-6 d-flex align-items-center">
                                                    <div class="form-check mt-4">
                                                        <input class="form-check-input packet-solitaire" type="checkbox"
                                                            name="packet[solitaire][]" value="1"
                                                            {{ $packet->solitaire ? 'checked' : '' }}>
                                                        <label class="form-check-label">Solitaire</label>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <script type="text/template" id="packetTemplate">
                                <div class="card p-3 mt-3 packet-item">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h6>Add Packet</h6>
                                        <button type="button" class="btn btn-sm removePacket">✖</button>
                                    </div>
                                    <input type="hidden" name="packet[packet_master_id][]" class="packet-master-id">
<div class="row g-3">

    <div class="col-lg-3 col-md-6">
        <label class="form-label">Packet No *</label>
        <select name="packet[packet_no][]" class="form-control packet-select" required></select>
    </div>

    <div class="col-lg-3 col-md-6">
        <label class="form-label">Stone</label>
        <select name="packet[stone_id][]" class="form-control packet-stone-select">
            <option value="">Select Stone</option>
            @foreach($stones as $stone)
                <option value="{{ $stone->id }}">{{ $stone->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-lg-3 col-md-6">
        <label class="form-label">Shape</label>
        <select name="packet[shape_id][]" class="form-control packet-shape-select">
            <option value="">Select Shape</option>
            @foreach($shapes as $shape)
                <option value="{{ $shape->id }}">{{ $shape->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-lg-3 col-md-6">
        <label class="form-label">Clarity</label>
        <select name="packet[clarity_id][]" class="form-control packet-clarity-select">
            <option value="">Select Clarity</option>
            @foreach($clarities as $clarity)
                <option value="{{ $clarity->id }}">{{ $clarity->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-lg-3 col-md-6">
        <label class="form-label">Color</label>
        <select name="packet[color_id][]" class="form-control packet-color-select">
            <option value="">Select Color</option>
            @foreach($colors as $color)
                <option value="{{ $color->id }}">{{ $color->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-lg-3 col-md-6">
        <label class="form-label">Cut</label>
        <select name="packet[cut_id][]" class="form-control packet-cut-select">
            <option value="">Select Cut</option>
            @foreach($cuts as $cut)
                <option value="{{ $cut->id }}">{{ $cut->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-lg-3 col-md-6">
        <label class="form-label">MM</label>
        <select name="packet[mm_id][]" class="form-control packet-mm-select">
            <option value="">Select MM</option>
            @foreach($mms as $mm)
                <option value="{{ $mm->id }}">{{ $mm->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-lg-3 col-md-6">
        <label class="form-label">Pcs</label>
        <input type="number" name="packet[pcs][]" class="form-control packet-pcs">
    </div>

    <div class="col-lg-3 col-md-6">
        <label class="form-label">Carat (Wt)</label>
        <input type="text" name="packet[weight][]" class="form-control packet-weight">
    </div>

    <div class="col-lg-3 col-md-6">
        <label class="form-label">Wt (Gram)</label>
        <input type="number" step="0.001" name="packet[wt_in_gram][]" class="form-control packet-gram">
    </div>

    <div class="col-lg-3 col-md-6">
        <label class="form-label">Rate</label>
        <input type="text" name="packet[rate][]" class="form-control packet-rate">
    </div>

    <div class="col-lg-3 col-md-6">
        <label class="form-label">Certificate No</label>
        <input type="text" name="packet[certificate_no][]" class="form-control packet-cert" >
    </div>

<div class="col-lg-3 col-md-6">
    <label class="form-label">UOM</label>
    <select name="packet[uom][]" class="form-select packet-uom">
        <option value="">Select UOM</option>
        <option value="PCS">PCS</option>
        <option value="CT" selected>CT</option>
        <option value="WT">WT</option>
    </select>
</div>

    <div class="col-lg-3 col-md-6">
        <label class="form-label">Amount</label>
        <input type="number" step="0.01" name="packet[amount][]" class="form-control packet-amount" readonly>
    </div>

    <div class="col-lg-3 col-md-6 d-flex align-items-center">
        <div class="form-check mt-4">
            <input class="form-check-input packet-solitaire" type="checkbox"
                name="packet[solitaire][]" value="1">
            <label class="form-check-label">Solitaire</label>
        </div>
    </div>

</div>
                                </div>
                            </script>

                        </div>
                    </div>
                    <!-- PRODUCT IMAGES -->
                    <div class="card glass-card mb-4 p-4">
                        <div class="form-group-item mt-4">
                            <h4 class="section-header">Product Image</h4>
                            <input type="file" name="image" class="form-control">
                            @if (isset($product) && $product->image)
                                <img src="{{ asset($product->image) }}" width="120">
                            @endif


                        </div>

                    </div>
                    <!-- BUTTONS -->
                    <div class="card glass-card mb-4 p-4">
                        <div class="text-end">
                            <button type="reset" class="btn btn-secondary">Cancel</button>
                            <button type="submit" class="btn custom-btn-primary text-white">
                                {{ isset($product) ? 'Update Product' : 'Add Product' }}
                            </button>

                        </div>

                </form>
            </div>

        </div>
    </div>

    </div>
    </div>

    <script>
        // SHOW Diamond form
        document.getElementById("openDiamondForm").onclick = function() {
            document.getElementById("diamondForm").style.display = "block";
            document.getElementById("stoneForm").style.display = "none"; // hide stone form if open
        };

        // SHOW Stone form
        document.getElementById("openStoneForm").onclick = function() {
            document.getElementById("stoneForm").style.display = "block";
            document.getElementById("diamondForm").style.display = "none"; // hide diamond form if open
        };
    </script>
    <script>
        // ADD Diamond
        document.addEventListener('click', function(e) {

            if (e.target.id === 'addDiamondBtn') {
                document.getElementById('diamondWrapper')
                    .insertAdjacentHTML('beforeend', document.getElementById('diamondTemplate').innerHTML);
            }

            if (e.target.classList.contains('removeDiamond')) {
                e.target.closest('.diamond-item').remove();
            }

            if (e.target.id === 'addStoneBtn') {
                document.getElementById('stoneWrapper')
                    .insertAdjacentHTML('beforeend', document.getElementById('stoneTemplate').innerHTML);
            }

            if (e.target.classList.contains('removeStone')) {
                e.target.closest('.stone-item').remove();
            }
        });
    </script>

    {{-- <script>
        $('#product_code').on('keyup blur', function() {
            let productCode = $(this).val();

            if (productCode.length === 0) {
                $('#productCodeMsg').text('');
                return;
            }

            $.ajax({
                url: "{{ route('check.product.code') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    product_code: productCode
                },
                success: function(response) {
                    if (response.exists) {
                        $('#productCodeMsg')
                            .text('Product code already exists')
                            .removeClass('text-success')
                            .addClass('text-danger');
                        $('#product_code').val('').focus();
                    } else {
                        $('#productCodeMsg')
                            .text('Product code available')
                            .removeClass('text-danger')
                            .addClass('text-success');
                    }
                }
            });
        });
    </script> --}}
    <script>
        $(document).ready(function() {

            $('#category_id').on('change', function() {
                let categoryId = $(this).val();

                $('#subcategory_id').html('<option value="">Loading...</option>');

                if (categoryId) {
                    $.ajax({
                        url: '{{ url('get-subcategories') }}/' + categoryId,

                        type: 'GET',
                        success: function(data) {
                            $('#subcategory_id').html(
                                '<option value="">Select Subcategory</option>');

                            if (data.length > 0) {
                                $.each(data, function(key, subcategory) {
                                    $('#subcategory_id').append(
                                        '<option value="' + subcategory
                                        .subcategory_id + '">' +
                                        subcategory.subcategory_name +
                                        '</option>'
                                    );
                                });
                            }
                        }
                    });
                } else {
                    $('#subcategory_id').html('<option value="">Select Subcategory</option>');
                }
            });

        });
    </script>
    <script>
        $(document).ready(function() {

            function filterMetalRates(reset = true) {
                let selectedMetal = $('#category_id option:selected').data('metal');

                $('#metal_rate option').each(function() {
                    let metal = $(this).data('metal');

                    if (!metal) {
                        $(this).show();
                        return;
                    }

                    if (metal === selectedMetal) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });

                // Only reset on category change (NOT on page load edit)
                if (reset) {
                    $('#metal_rate').val('');
                }
            }

            // When category changes → reset metal rate and trigger purity check
            $('#category_id').on('change', function() {
                filterMetalRates(true);
                $('#purity_id').trigger('change');
            });

            // Auto-select metal rate on purity change
            $('#purity_id').on('change', function() {
                let selectedOption = $(this).find('option:selected');
                let selectedPurityValue = parseFloat(selectedOption.data('purity-value'));
                let selectedPurityType = selectedOption.data('purity-type');
                let selectedMetal = $('#category_id option:selected').data('metal');

                if (!isNaN(selectedPurityValue) && selectedMetal) {
                    let strictExactMatch = '';
                    let convertedExactMatch = '';
                    let closeMatch = '';
                    let minDiff = Infinity;

                    // Function to convert karat to percent for comparison
                    function getPercentValue(val, type) {
                        return type === 'karat' ? (val / 24) * 100 : val;
                    }

                    let selectedPercent = getPercentValue(selectedPurityValue, selectedPurityType);

                    // Iterate to find the matching metal rate
                    $('#metal_rate option').each(function() {
                        let optionMetal = $(this).data('metal');
                        let optionKarat = parseFloat($(this).data('karat'));
                        let optionPurityType = $(this).data('purity-type');

                        if (optionMetal === selectedMetal && !isNaN(optionKarat)) {
                            // 1. Strict Exact Match (Same type, exactly same value)
                            if (optionPurityType === selectedPurityType && Math.abs(optionKarat -
                                    selectedPurityValue) === 0) {
                                strictExactMatch = $(this).val();
                            }
                            // Otherwise check percent conversion
                            else {
                                let optionPercent = getPercentValue(optionKarat, optionPurityType);
                                let diff = Math.abs(optionPercent - selectedPercent);

                                if (diff < 0.1) {
                                    convertedExactMatch = $(this).val();
                                } else if (diff <= 1.5) { // 1.5% / 1.5 unit tolerance
                                    if (diff < minDiff) {
                                        minDiff = diff;
                                        closeMatch = $(this).val();
                                    } else if (diff === minDiff) {
                                        closeMatch = $(this).val(); // latest close match
                                    }
                                }
                            }
                        }
                    });

                    let matchingOption = strictExactMatch || convertedExactMatch || closeMatch;

                    if (matchingOption) {
                        $('#metal_rate').val(matchingOption).trigger('change');
                    } else {
                        $('#metal_rate').val('').trigger('change');
                    }
                } else {
                    $('#metal_rate').val('').trigger('change');
                }
            });

            // On PAGE LOAD (edit) → do NOT reset
            filterMetalRates(false);

            // Force select correct value (important for select plugins)
            $('#metal_rate')
                .val('{{ old('metal_rate_id', $product->metal_rate ?? '') }}')
                .trigger('change');
        });
    </script>


    <script>
        $(document).ready(function() {

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
                            return {
                                term: params.term // search term
                            };
                        },
                        processResults: function(data) {
                            return {
                                results: $.map(data, function(item) {
                                    return {
                                        id: item
                                            .label, // Use label (packet_no) as ID to match controller expectation
                                        text: item.label,
                                        real_id: item.id, // Store real ID for hidden field
                                        details: item.details
                                    }
                                })
                            };
                        },
                        cache: true
                    }
                }).on('select2:select', function(e) {
                    var data = e.params.data;
                    var details = data.details;
                    var wrapper = $(this).closest('.packet-item');

                    // Populate fields
                    wrapper.find('.packet-master-id').val(data.real_id);

                    wrapper.find('.packet-stone-select').val(details.stone_id).trigger('change');
                    wrapper.find('.packet-shape-select').val(details.shape_id).trigger('change');
                    wrapper.find('.packet-color-select').val(details.color_id).trigger('change');
                    wrapper.find('.packet-clarity-select').val(details.clarity_id).trigger('change');
                    wrapper.find('.packet-cut-select').val(details.cut_id).trigger('change');
                    wrapper.find('.packet-mm-select').val(details.mm_id).trigger('change');

                    // wrapper.find('.packet-weight').val(details.weight).trigger(
                    //     'change'); // Trigger for weight conversion
                    wrapper.find('.packet-rate').val(details.rate);
                    wrapper.find('.packet-cert').val(details.certificate_no);

                    if (details.solitaire == 1) {
                        wrapper.find('.packet-solitaire').prop('checked', true);
                    } else {
                        wrapper.find('.packet-solitaire').prop('checked', false);
                    }
                });
            }

            // Initialize on page load for existing items
            $('.packet-select').each(function() {
                initPacketSelect2($(this));
            });

            // Add Packet Row
            $('#addPacketBtn').on('click', function() {
                var template = $('#packetTemplate').html();
                var newRow = $(template);
                $('#packetWrapper').append(newRow);
                initPacketSelect2(newRow.find('.packet-select'));
            });

            // Remove Packet Row

            $(document).on('click', '.removePacket', function() {
                $(this).closest('.packet-item').remove();
                // updateTotalProductPrice();
            });



            // --- Packet Calculations & Weight Conversion ---
            $(document).on('change keyup', '.packet-uom, .packet-pcs, .packet-gram, .packet-weight, .packet-rate',
                function(e) {
                    var wrapper = $(this).closest('.packet-item');
                    var uom = wrapper.find('.packet-uom').val();

                    // Inputs
                    var pcsInput = wrapper.find('.packet-pcs');
                    var gramInput = wrapper.find('.packet-gram');
                    var caratInput = wrapper.find('.packet-weight');
                    var rateInput = wrapper.find('.packet-rate');
                    var amountInput = wrapper.find('.packet-amount');

                    // Values
                    var pcs = parseFloat(pcsInput.val()) || 0;
                    var gram = parseFloat(gramInput.val()) || 0;
                    var carat = parseFloat(caratInput.val()) || 0;
                    var rate = parseFloat(rateInput.val()) || 0;
                    var amount = 0;

                    // Weight Conversion Logic
                    // 1 Carat = 0.2 Grams
                    // 1 Gram = 5 Carats
                    if ($(e.target).hasClass('packet-weight')) {
                        // Carat Changed -> Update Gram
                        gram = carat * 0.2;
                        gramInput.val(gram.toFixed(3));
                    } else if ($(e.target).hasClass('packet-gram')) {
                        // Gram Changed -> Update Carat
                        carat = gram * 5;
                        caratInput.val(carat.toFixed(2));
                    } else {
                        // If neither changed (e.g. rate/uom changed), ensure values are consistent?
                        // Or primarily rely on what's there.
                        // Let's strictly convert only when specific field is edited to avoid fighting.
                    }

                    // Re-read values in case they were updated above
                    gram = parseFloat(gramInput.val()) || 0;
                    carat = parseFloat(caratInput.val()) || 0;

                    // Recalculate Amount
                    if (uom === 'PCS') {
                        amount = rate * pcs;
                    } else if (uom === 'CT') {
                        amount = rate * carat;
                    } else if (uom === 'WT') {
                        amount = rate * gram;
                    }

                    amountInput.val(amount.toFixed(2));
                    calculatePrice();
                    // updateTotalProductPrice();
                });

            // function updateTotalProductPrice() {
            // This function should be implemented based on how the total price is calculated.
            // It usually involves summing up Diamond Price + Stone Price + Gold Price + Making Charges + Packet Amounts + GST, etc.
            // For now, I'll valid existing logic and ensure packet amount is added if logic exists.
            // Assuming there's a main total calculation function I should hook into or create one.

            // Let's trigger the existing calculation logic if possible, or simple add packet totals to final price?
            // The current file might rely on backend calculation or specific frontend logic.
            // Given the file content I've seen, there are fields like 'final_price'.

            //     calculateFinalPrice();
            // }

            // Reuse existing calculation logic if available or create a simple one
            // function calculateFinalPrice() {
            //     let goldPrice = parseFloat($('input[name="gold_price"]').val()) || 0;
            //     let makingPrice = parseFloat($('input[name="making_price"]').val()) || 0;
            //     let gstPercent = parseFloat($('input[name="gst_percent"]').val()) || 0;

            //     let diamondTotal = 0; // Need to sum diamond totals
            //     let stoneTotal = 0; // Need to sum stone totals
            //     let packetTotal = 0;

            //     // Sum Diamonds
            //     $('.diamond-item').each(function() {
            //         diamondTotal += parseFloat($(this).find('[name="diamond[diamond_final_price][]"]')
            //             .val()) || 0;
            //     });

            //     // Sum Stones
            //     $('.stone-item').each(function() {
            //         stoneTotal += parseFloat($(this).find('[name="stone[stone_final_price][]"]').val()) ||
            //             0;
            //     });

            //     // Sum Packets
            //     $('.packet-amount').each(function() {
            //         packetTotal += parseFloat($(this).val()) || 0;
            //     });

            //     let gstPercent = parseFloat($('#gst_percent').val()) || 0;

            //     let subTotal = goldPrice + makingPrice + diamondTotal + stoneTotal + packetTotal;

            //     let gstAmount = (subTotal * gstPercent) / 100;

            //     let finalPrice = subTotal + gstAmount;

            //     // Update fields if they exist (assuming standard ID names based on variable names)
            //     // Note: The view might used different IDs, checking controller...
            //     // Controller uses 'final_price', 'gst_amount'. View IDs usually match.

            //     $('input[name="gst_amount"]').val(gstAmount.toFixed(2));
            //     $('input[name="final_price"]').val(finalPrice.toFixed(2));

            //     // Also update sale_price / mrp if needed? logic varies.
            // }

            // Attach calculateFinalPrice to other inputs as well
            // $('#gold_price, #making_price, #gst_percent').on('keyup change', calculateFinalPrice);
            // $(document).on('keyup change', '.diamond-item input, .stone-item input', calculateFinalPrice);

        });
    </script>

    <!-- Label Print Modal -->
    <div class="modal fade" id="printLabelModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Print Label</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0" style="height: 500px;">
                    <iframe id="printLabelIframe" src=""
                        style="width: 100%; height: 100%; border: none;"></iframe>
                </div>
            </div>
        </div>
    </div>

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
<script>
$(document).on('keydown', 'input, select, textarea', function(e) {
    if (e.key === 'Enter') {
        e.preventDefault();

        let formElements = $(this)
            .closest('form')
            .find('input, select, textarea, button')
            .filter(':visible:not([readonly]):not([disabled])');

        let index = formElements.index(this);

        if (index > -1 && index < formElements.length - 1) {
            formElements.eq(index + 1).focus();
        }
    }
});
</script>
@endsection
