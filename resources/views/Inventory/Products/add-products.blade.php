@extends('layout.mainlayout')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <script src="{{ url('/public/assets/js/calculation.js') }}"></script>
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
                                    <label>Product Code (SKU)</label>
                                    <input type="text" class="form-control" name="product_code" id="product_code"
                                        value="{{ old('product_code', $product->product_code ?? '') }}">

                                    <small id="productCodeMsg"></small>
                                    @error('product_code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>

                                <!-- Barcode -->
                                <div class="col-lg-4">
                                    <label>Barcode</label>
                                    <input type="text" class="form-control" name="barcode"
                                        value="{{ old('barcode', $product->barcode ?? '') }}">
                                </div>

                                <!-- Category -->
                                <div class="col-lg-4 mt-3">
                                    <label>Category *</label>
                                    <select name="category_id" class="form-control">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->category_id }}"
                                                {{ old('category_id', $product->category_id ?? '') == $category->category_id ? 'selected' : '' }}>
                                                {{ $category->category_name }}
                                            </option>
                                        @endforeach
                                    </select>


                                </div>

                                <!-- Subcategory -->
                                <div class="col-lg-4 mt-3">
                                    <label>Subcategory</label>
                                    {{-- @dd($subcategories, $product->subcategory_id) --}}

                                    <select name="subcategory_id" class="form-control" required>
                                        <option value="">Select Subcategory</option>

                                        @foreach ($subcategories as $subcategory)
                                            <option value="{{ $subcategory->subcategory_id }}"
                                                {{ old('subcategory_id', $product->subcategory_id ?? '') == $subcategory->subcategory_id ? 'selected' : '' }}>
                                                {{ $subcategory->subcategory_name }}
                                            </option>
                                        @endforeach
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

                            </div>
                        </div>

                        <!-- METAL DETAILS -->
                        <div class="form-group-item mt-4">
                            <h5 class="form-title">Metal Details</h5>

                            <div class="row">

    <!-- Metal Rate -->
    <div class="col-lg-3 col-md-6">
        <label>Metal Rate</label>
        <select name="metal_rate_id" id="metal_rate" class="form-control select" required>
            <option value="">Select Metal Rate</option>
            @foreach ($metalRates as $rate)
                <option value="{{ $rate->id }}" data-price="{{ $rate->price_per_gram }}"
                    {{ old('metal_rate', $product->metal_rate ?? '') == $rate->id ? 'selected' : '' }}>
                    {{ $rate->metal_type }} - ₹{{ $rate->price_per_gram }}/gm - {{ $rate->karat }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Gold Color -->
    <div class="col-lg-3 col-md-6">
        <label>Gold Color</label>
        <select class="form-control" name="gold_color">
            <option value="">Select Gold Color</option>
            <option value="Rose Gold" {{ old('gold_color', $product->gold_color ?? '') == 'Rose Gold' ? 'selected' : '' }}>Rose Gold</option>
            <option value="Yellow Gold" {{ old('gold_color', $product->gold_color ?? '') == 'Yellow Gold' ? 'selected' : '' }}>Yellow Gold</option>
            <option value="White Gold" {{ old('gold_color', $product->gold_color ?? '') == 'White Gold' ? 'selected' : '' }}>White Gold</option>
        </select>
    </div>

    <!-- Quantity -->
    <div class="col-lg-3 col-md-6">
        <label>Quantity</label>
        <input type="number" min="1" class="form-control"
            name="quantity"
            value="{{ old('quantity', $product->quantity ?? 1) }}">
    </div>

    <!-- HSN Code -->
    <div class="col-lg-3 col-md-6">
        <label>HSN Code</label>
        <input type="text" class="form-control"
            name="hsn_code"
            value="{{ old('hsn_code', $product->hsn_code ?? '') }}">
    </div>

</div>

<!-- ================= WEIGHT ROW ================= -->

<div class="row mt-3">

    <!-- Gross Weight (GS WT) -->
    <div class="col-lg-4 col-md-4">
        <label>Gross Weight (GS WT)</label>
        <div class="input-group">
            <input type="number" step="0.001" class="form-control"
                name="gross_weight"
                value="{{ old('gross_weight', $product->gross_weight ?? '') }}">

            <select class="form-control"
                name="gross_weight_unit"
                style="max-width: 90px; pointer-events:none; background:#e9ecef;">
                <option value="GM" {{ old('gross_weight_unit', $product->gross_weight_unit ?? '') == 'GM' ? 'selected' : '' }}>GM</option>
                <option value="MG" {{ old('gross_weight_unit', $product->gross_weight_unit ?? '') == 'MG' ? 'selected' : '' }}>MG</option>
                <option value="KG" {{ old('gross_weight_unit', $product->gross_weight_unit ?? '') == 'KG' ? 'selected' : '' }}>KG</option>
            </select>
        </div>
    </div>

    <!-- Net Weight -->
    <div class="col-lg-4 col-md-4">
        <label>Net Weight</label>
        <div class="input-group">
            <input type="number" step="0.001" class="form-control"
                name="net_weight"
                value="{{ old('net_weight', $product->net_weight ?? '') }}">

            <select class="form-control"
                name="net_weight_unit"
                style="max-width: 90px; pointer-events:none; background:#e9ecef;">
                <option value="GM" {{ old('net_weight_unit', $product->net_weight_unit ?? '') == 'GM' ? 'selected' : '' }}>GM</option>
                <option value="MG" {{ old('net_weight_unit', $product->net_weight_unit ?? '') == 'MG' ? 'selected' : '' }}>MG</option>
                <option value="KG" {{ old('net_weight_unit', $product->net_weight_unit ?? '') == 'KG' ? 'selected' : '' }}>KG</option>
            </select>
        </div>
    </div>

    <!-- Final Fine Weight -->
    <div class="col-lg-4 col-md-4">
        <label>Final Fine Weight</label>
        <input type="number" step="0.001" class="form-control"
            name="final_fn_weight"
            value="{{ old('final_fn_weight', $product->final_fn_weight ?? '') }}">
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
                                                        class="form-control" value="{{ $diamond->diamond_weight }}">
                                                </div>

                                                <div class="col-lg-3 mt-3">
                                                    <label>Price Per Carat</label>
                                                    <input type="text" name="diamond[price_per_carat][]"
                                                        class="form-control" value="{{ $diamond->price_per_carat }}">
                                                </div>

                                                <div class="col-lg-3 mt-3">
                                                    <label>Final Price</label>
                                                    <input type="text" name="diamond[diamond_final_price][]"
                                                        class="form-control" value="{{ $diamond->diamond_final_price }}">
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
                                                        value="{{ $stone->stone_name }}">
                                                </div>

                                                <div class="col-lg-3">
                                                    <label>Stone Weight</label>
                                                    <input type="text" name="stone[stone_weight][]"
                                                        class="form-control" value="{{ $stone->stone_weight }}">
                                                </div>

                                                <div class="col-lg-3">
                                                    <label>Stone Price</label>
                                                    <input type="text" name="stone[stone_price][]"
                                                        class="form-control" value="{{ $stone->stone_price }}">
                                                </div>

                                                <div class="col-lg-3">
                                                    <label>Final Price</label>
                                                    <input type="text" name="stone[stone_final_price][]"
                                                        class="form-control" value="{{ $stone->stone_final_price }}">
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

                        <!-- PRICING -->
                        <div class="form-group-item mt-4">
                            <h5 class="form-title">Pricing</h5>

                            <div class="row">

                                <!-- Row 1 -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <label>Wastage %</label>
                                    <input type="text" class="form-control" name="wastage_percent"
                                        value="{{ old('wastage_percent', $product->wastage_percent ?? '') }}">

                                </div>

                                <div class="col-lg-4 col-md-6 mb-3">
                                    <label>Making Price</label>
                                    <input type="text" class="form-control" name="making_price"
                                        value="{{ old('making_price', $product->making_price ?? '') }}">

                                </div>

                                <div class="col-lg-4 col-md-6 mb-3">
                                    <label>Gold Price</label>
                                    <input type="text" class="form-control" name="gold_price"
                                        value="{{ old('gold_price', $product->gold_price ?? '') }}">

                                </div>

                                <!-- Row 2 -->
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

                                <div class="col-lg-4 col-md-6 mb-3">
                                    <label>GST Amount</label>
                                    <input type="text" class="form-control" name="gst_amount"
                                        value="{{ old('gst_amount', $product->gst_amount ?? '') }}">

                                </div>

                                <!-- Row 3 -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <label>MRP Price</label>
                                    <input type="text" class="form-control" name="mrp_price"
                                        value="{{ old('mrp_price', $product->mrp_price ?? '') }}">

                                </div>

                            </div>

                        </div>

                        <!-- PRODUCT IMAGES -->
                        <div class="form-group-item mt-4">
                            <h5 class="form-title">Product Image</h5>
                            <input type="file" name="image" class="form-control">
                            @if (isset($product) && $product->image)
                                <img src="{{ asset('public/' . $product->image) }}" width="120">
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

    <script>
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
    </script>


@endsection
