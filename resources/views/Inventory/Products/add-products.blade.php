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
            </style>


            <div class="card mb-0">
                <div class="card-body">

                    <div class="page-header">
                        <h5>
                            {{ isset($product) ? 'Update Product (Jewellery)' : 'Add Product (Jewellery)' }}
                        </h5>
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
                        <div class="form-group-item">
                            <h5 class="form-title">Basic Details</h5>

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
                                    <label>Pre Code</label>
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
                                    <label>Category *</label>
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
                                    <!-- Purity -->
                                    <select name="purity_id" class="form-control select" required>
                                        <option value="">Select Purity</option>
                                        @foreach ($purities as $purity)
                                            <option value="{{ $purity->id }}"
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

                        <!-- METAL DETAILS -->
                        <div class="form-group-item mt-4">
                            <h5 class="form-title">Metal Details</h5>

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
                                            {{-- {{  $rate->id }}
                                             {{ $product->metal_rate }} --}}
                                            <option value="{{ $rate->id }}"
                                                data-metal="{{ strtolower($rate->metal_type) }}"
                                                data-price="{{ $rate->price_per_gram }}"
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
                                        value="{{ old('hsn_code', $product->hsn_code ?? '') }}" required>
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



                        <!-- PRICING -->
                        <div class="form-group-item mt-4">
                            <h5 class="form-title">Pricing</h5>

                            <div class="row">

                                <!-- Row 1 (4 fields in one line) -->
                                <div class="col-lg-3 col-md-6 mb-3">
                                    <label>Wastage %</label>
                                    <input type="text" class="form-control" name="wastage_percent"
                                        value="{{ old('wastage_percent', $product->wastage_percent ?? '') }}">
                                </div>

                                <div class="col-lg-3 col-md-6 mb-3">
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

                                <div class="col-lg-4 col-md-6 mb-3">
                                    <label>Sale Price</label>
                                    <input type="text" class="form-control" name="sale_price"
                                        value="{{ old('sale_price', $product->sale_price ?? '') }}">
                                </div>

                                <div class="col-lg-4 col-md-6 mb-3">
                                    <label>GST %</label>
                                    <input type="text" class="form-control" name="gst_percent"
                                        value="{{ old('gst_percent', $product->gst_percent ?? '') }}">
                                </div>

                                <!-- Row 3 -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <label>GST Amount</label>
                                    <input type="text" class="form-control" name="gst_amount"
                                        value="{{ old('gst_amount', $product->gst_amount ?? '') }}">
                                </div>

                                <div class="col-lg-4 col-md-6 mb-3">
                                    <label>MRP Price</label>
                                    <input type="text" class="form-control" name="mrp_price"
                                        value="{{ old('mrp_price', $product->mrp_price ?? '') }}">
                                </div>

                                <div class="col-lg-4 col-md-6 mb-3">
                                    <label>Final Price</label>
                                    <input type="text" class="form-control" name="final_price"
                                        value="{{ old('final_price', $product->final_price ?? '') }}">
                                </div>

                            </div>
                        </div>

                        <!-- DIAMOND & STONES -->
                        <div class="form-group-item mt-4">
                            <h5 class="form-title">Diamonds & Stones</h5>

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

                        <!-- PACKETS -->
                        <div class="form-group-item mt-4">
                            <h5 class="form-title">Packets</h5>

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

                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <label>Packet No *</label>
                                                    <select name="packet[packet_no][]" class="form-control packet-select"
                                                        required>
                                                        <option value="{{ $packet->packet_no }}" selected>
                                                            {{ $packet->packet_no }}</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-3">
                                                    <label>Stone</label>
                                                    <input type="text" class="form-control packet-stone"
                                                        value="{{ $packet->stone ? $packet->stone->name : '' }}" readonly>
                                                    <input type="hidden" name="packet[stone_id][]"
                                                        value="{{ $packet->stone_id }}">
                                                </div>
                                                <div class="col-lg-3">
                                                    <label>Shape</label>
                                                    <input type="text" class="form-control packet-shape"
                                                        value="{{ $packet->shape ? $packet->shape->name : '' }}" readonly>
                                                    <input type="hidden" name="packet[shape_id][]"
                                                        value="{{ $packet->shape_id }}">
                                                </div>
                                                <div class="col-lg-3">
                                                    <label>Carat (Wt)</label>
                                                    <input type="text" name="packet[weight][]"
                                                        class="form-control packet-weight" value="{{ $packet->weight }}">
                                                </div>

                                                <!-- Row 2 -->
                                                <div class="col-lg-3 mt-3">
                                                    <label>Color</label>
                                                    <input type="text" class="form-control packet-color"
                                                        value="{{ $packet->color ? $packet->color->name : '' }}" readonly>
                                                    <input type="hidden" name="packet[color_id][]"
                                                        value="{{ $packet->color_id }}">
                                                </div>
                                                <div class="col-lg-3 mt-3">
                                                    <label>Clarity</label>
                                                    <input type="text" class="form-control packet-clarity"
                                                        value="{{ $packet->clarity ? $packet->clarity->name : '' }}"
                                                        readonly>
                                                    <input type="hidden" name="packet[clarity_id][]"
                                                        value="{{ $packet->clarity_id }}">
                                                </div>
                                                <div class="col-lg-3 mt-3">
                                                    <label>Cut</label>
                                                    <input type="text" class="form-control packet-cut"
                                                        value="{{ $packet->cut ? $packet->cut->name : '' }}" readonly>
                                                    <input type="hidden" name="packet[cut_id][]"
                                                        value="{{ $packet->cut_id }}">
                                                </div>
                                                <div class="col-lg-3 mt-3">
                                                    <label>Chalni</label>
                                                    <input type="text" class="form-control packet-chalni"
                                                        value="{{ $packet->chalni ? $packet->chalni->name : '' }}"
                                                        readonly>
                                                    <input type="hidden" name="packet[chalni_id][]"
                                                        value="{{ $packet->chalni_id }}">
                                                </div>

                                                <!-- Row 3 -->
                                                <div class="col-lg-3 mt-3">
                                                    <label>Rate</label>
                                                    <input type="text" name="packet[rate][]"
                                                        class="form-control packet-rate" value="{{ $packet->rate }}">
                                                </div>
                                                <div class="col-lg-3 mt-3">
                                                    <label>Certificate No</label>
                                                    <input type="text" name="packet[certificate_no][]"
                                                        class="form-control packet-cert"
                                                        value="{{ $packet->certificate_no }}" readonly>
                                                </div>
                                                <div class="col-lg-3 mt-3">
                                                    <label>Pcs</label>
                                                    <input type="number" name="packet[pcs][]"
                                                        class="form-control packet-pcs" value="{{ $packet->pcs }}">
                                                </div>
                                                <div class="col-lg-3 mt-3">
                                                    <label>Wt (Gram)</label>
                                                    <input type="number" step="0.001" name="packet[wt_in_gram][]"
                                                        class="form-control packet-gram"
                                                        value="{{ $packet->wt_in_gram }}">
                                                </div>
                                                <div class="col-lg-3 mt-3">
                                                    <label>UOM</label>
                                                    <select name="packet[uom][]" class="form-select packet-uom">
                                                        <option value="">Select UOM</option>
                                                        <option value="PCS"
                                                            {{ $packet->uom == 'PCS' ? 'selected' : '' }}>PCS</option>
                                                        <option value="CT"
                                                            {{ $packet->uom == 'CT' ? 'selected' : '' }}>CT</option>
                                                        <option value="WT"
                                                            {{ $packet->uom == 'WT' ? 'selected' : '' }}>WT</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-3 mt-3">
                                                    <label>Amount</label>
                                                    <input type="number" step="0.01" name="packet[amount][]"
                                                        class="form-control packet-amount" value="{{ $packet->amount }}"
                                                        readonly>
                                                </div>

                                                <div class="col-lg-3 mt-3">
                                                    <div class="form-check mt-4">
                                                        <input class="form-check-input packet-solitaire" type="checkbox"
                                                            name="packet[solitaire][]" value="1"
                                                            {{ $packet->solitaire ? 'checked' : '' }}
                                                            >
                                                        <label class="form-check-label">Solitaire</label>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="packet[mm_id][]"
                                                    value="{{ $packet->mm_id }}">
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

                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label>Packet No *</label>
                                            <select name="packet[packet_no][]" class="form-control packet-select" required></select>
                                        </div>
                                        <div class="col-lg-3">
                                              <label>Stone</label>
                                              <input type="text" class="form-control packet-stone" readonly>
                                              <input type="hidden" name="packet[stone_id][]" class="packet-stone-id">
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Shape</label>
                                            <input type="text" class="form-control packet-shape" readonly>
                                            <input type="hidden" name="packet[shape_id][]" class="packet-shape-id">
                                        </div>
                                         <div class="col-lg-3">
                                            <label>Carat (Wt)</label>
                                            <input type="text" name="packet[weight][]" class="form-control packet-weight" >
                                        </div>

                                        <!-- Row 2 -->
                                        <div class="col-lg-3 mt-3">
                                            <label>Color</label>
                                            <input type="text" class="form-control packet-color" readonly>
                                            <input type="hidden" name="packet[color_id][]" class="packet-color-id">
                                        </div>
                                        <div class="col-lg-3 mt-3">
                                            <label>Clarity</label>
                                            <input type="text" class="form-control packet-clarity" readonly>
                                            <input type="hidden" name="packet[clarity_id][]" class="packet-clarity-id">
                                        </div>
                                         <div class="col-lg-3 mt-3">
                                            <label>Cut</label>
                                            <input type="text" class="form-control packet-cut" readonly>
                                            <input type="hidden" name="packet[cut_id][]" class="packet-cut-id">
                                        </div>
                                        <div class="col-lg-3 mt-3">
                                            <label>Chalni</label>
                                            <input type="text" class="form-control packet-chalni" readonly>
                                            <input type="hidden" name="packet[chalni_id][]" class="packet-chalni-id">
                                        </div>

                                        <!-- Row 3 -->
                                        <div class="col-lg-3 mt-3">
                                            <label>Rate</label>
                                            <input type="text" name="packet[rate][]" class="form-control packet-rate">
                                        </div>
                                         <div class="col-lg-3 mt-3">
                                            <label>Certificate No</label>
                                            <input type="text" name="packet[certificate_no][]" class="form-control packet-cert" readonly>
                                        </div>
                                         <div class="col-lg-3 mt-3">
                                            <label>Pcs</label>
                                            <input type="number" name="packet[pcs][]" class="form-control packet-pcs" >
                                        </div>
                                         <div class="col-lg-3 mt-3">
                                            <label>Wt (Gram)</label>
                                            <input type="number" step="0.001" name="packet[wt_in_gram][]" class="form-control packet-gram" >
                                        </div>
                                        <div class="col-lg-3 mt-3">
                                            <label>UOM</label>
                                            <select name="packet[uom][]" class="form-select packet-uom">
                                                <option value="">Select UOM</option>
                                                <option value="PCS">PCS</option>
                                                <option value="CT">CT</option>
                                                <option value="WT">WT</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-3 mt-3">
                                            <label>Amount</label>
                                            <input type="number" step="0.01" name="packet[amount][]" class="form-control packet-amount" readonly>
                                        </div>

                                         <div class="col-lg-3 mt-3">
                                            <div class="form-check mt-4">
                                                <input class="form-check-input packet-solitaire" type="checkbox" name="packet[solitaire][]" value="1" >
                                                <label class="form-check-label">Solitaire</label>
                                            </div>
                                        </div>
                                         <input type="hidden" name="packet[mm_id][]" class="packet-mm-id">
                                    </div>
                                </div>
                            </script>

                        </div>
                        <!-- PRODUCT IMAGES -->
                        <div class="form-group-item mt-4">
                            <h5 class="form-title">Product Image</h5>
                            <input type="file" name="image" class="form-control">
                            @if (isset($product) && $product->image)
                                <img src="{{ asset($product->image) }}" width="120">
                            @endif


                        </div>

                        <!-- BUTTONS -->
                        <div class="text-end mt-4">
                            <button type="reset" class="btn btn-secondary">Cancel</button>
                            <button type="submit" class="btn btn-primary">
                                {{ isset($product) ? 'Update Product' : 'Add Product' }}
                            </button>

                        </div>

                    </form>


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

            // When category changes → reset metal rate
            $('#category_id').on('change', function() {
                filterMetalRates(true);
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

                    wrapper.find('.packet-stone').val(details.stone_name);
                    wrapper.find('.packet-stone-id').val(details.stone_id);

                    wrapper.find('.packet-shape').val(details.shape_name);
                    wrapper.find('.packet-shape-id').val(details.shape_id);

                    wrapper.find('.packet-color').val(details.color_name);
                    wrapper.find('.packet-color-id').val(details.color_id);

                    wrapper.find('.packet-clarity').val(details.clarity_name);
                    wrapper.find('.packet-clarity-id').val(details.clarity_id);

                    wrapper.find('.packet-cut').val(details.cut_name);
                    wrapper.find('.packet-cut-id').val(details.cut_id);

                    wrapper.find('.packet-chalni').val(details.chalni_name);
                    wrapper.find('.packet-chalni-id').val(details.chalni_id);

                    wrapper.find('.packet-mm-id').val(details.mm_id);

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


@endsection
