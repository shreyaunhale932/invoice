@extends('layout.mainlayout')

@section('content')
<div class="page-wrapper">
<div class="content container-fluid">

<div class="card mb-0">
<div class="card-body">

    <div class="page-header">
        <h5>Add Product (Jewellery)</h5>
    </div>

<form id="productForm" enctype="multipart/form-data">

    <!-- BASIC DETAILS -->
    <div class="form-group-item">
        <h5 class="form-title">Basic Details</h5>

        <div class="row">

            <!-- Product Name -->
            <div class="col-lg-4">
                <label>Product Name *</label>
                <input type="text" class="form-control" name="product_name" required>
            </div>

            <!-- Product Code -->
            <div class="col-lg-4">
                <label>Product Code (SKU)</label>
                <input type="text" class="form-control" name="product_code">
            </div>

            <!-- Barcode -->
            <div class="col-lg-4">
                <label>Barcode</label>
                <input type="text" class="form-control" name="barcode">
            </div>

            <!-- Category -->
            <div class="col-lg-4 mt-3">
                <label>Category *</label>
                <select class="form-control" name="category_id" required>
                    <option value="">Select Category</option>
                </select>
            </div>

            <!-- Subcategory -->
            <div class="col-lg-4 mt-3">
                <label>Subcategory</label>
                <select class="form-control" name="subcategory_id">
                    <option value="">Select Subcategory</option>
                </select>
            </div>

            <!-- Purity -->
            <div class="col-lg-4 mt-3">
                <label>Purity</label>
                <select class="form-control" name="purity_id">
                    <option value="">Select Purity</option>
                </select>
            </div>

        </div>
    </div>

    <!-- METAL DETAILS -->
    <div class="form-group-item mt-4">
        <h5 class="form-title">Metal Details</h5>

        <div class="row">

            <div class="col-lg-4">
                <label>Metal Rate</label>
                <input type="text" class="form-control" name="metal_rate">
            </div>

            <div class="col-lg-4">
                <label>Gold Purity</label>
                <input type="text" class="form-control" name="gold_purity">
            </div>

            <div class="col-lg-4">
                <label>HSN Code</label>
                <input type="text" class="form-control" name="hsn_code">
            </div>

            <div class="col-lg-4 mt-3">
                <label>Gross Weight</label>
                <input type="text" class="form-control" name="gross_weight">
            </div>

            <div class="col-lg-4 mt-3">
                <label>Net Weight</label>
                <input type="text" class="form-control" name="net_weight">
            </div>

        </div>
    </div>

    <!-- DIAMOND & STONES -->
    <div class="form-group-item mt-4">
        <h5 class="form-title">Diamonds & Stones</h5>

        <button type="button" id="openDiamondForm" class="btn btn-success">
    + Add Diamond
</button>

<button type="button" id="openStoneForm" class="btn btn-info ms-2">
    + Add Stone
</button>


       <div id="diamondForm" class="card p-3 mt-3" style="display:none;">
    <h6>Add Diamond</h6>

    <div class="row">
        <div class="col-lg-3">
            <label>Clarity</label>
            <input type="text" class="form-control" id="d_clarity">
        </div>

        <div class="col-lg-3">
            <label>Cut</label>
            <input type="text" class="form-control" id="d_cut">
        </div>

        <div class="col-lg-3">
            <label>Color</label>
            <input type="text" class="form-control" id="d_color">
        </div>

        <div class="col-lg-3">
            <label>Pieces</label>
            <input type="number" class="form-control" id="d_pieces">
        </div>

        <div class="col-lg-3 mt-3">
            <label>Price Per Carat</label>
            <input type="text" class="form-control" id="d_price">
        </div>
    </div>

    <button class="btn btn-primary mt-3" id="saveDiamondBtn">Add Diamond</button>
</div>

<div id="stoneForm" class="card p-3 mt-3" style="display:none;">
    <h6>Add Stone</h6>

    <div class="row">
        <div class="col-lg-3">
            <label>Stone Name</label>
            <input type="text" class="form-control" id="s_name">
        </div>

        <div class="col-lg-3">
            <label>Stone Weight</label>
            <input type="text" class="form-control" id="s_weight">
        </div>

        <div class="col-lg-3">
            <label>Stone Price</label>
            <input type="text" class="form-control" id="s_price">
        </div>

        <div class="col-lg-3">
            <label>Discount Price</label>
            <input type="text" class="form-control" id="s_discount">
        </div>
    </div>

    <button class="btn btn-primary mt-3" id="saveStoneBtn">Add Stone</button>
</div>

<div id="diamondList" class="mt-3"></div>
<div id="stoneList" class="mt-3"></div>

    </div>

    <!-- PRICING -->
    <div class="form-group-item mt-4">
        <h5 class="form-title">Pricing</h5>

        <div class="row">
            <div class="col-lg-4">
                <label>Wastage %</label>
                <input type="text" class="form-control" name="wastage_percent">
            </div>

            <div class="col-lg-4">
                <label>Making Price</label>
                <input type="text" class="form-control" name="making_price">
            </div>

            <div class="col-lg-4">
                <label>Gold Price</label>
                <input type="text" class="form-control" name="gold_price">
            </div>

            <div class="col-lg-4 mt-3">
                <label>GST %</label>
                <input type="text" class="form-control" name="gst_percent">
            </div>

            <div class="col-lg-4 mt-3">
                <label>GST Amount</label>
                <input type="text" class="form-control" name="gst_amount">
            </div>

            <div class="col-lg-4 mt-3">
                <label>MRP Price</label>
                <input type="text" class="form-control" name="mrp_price">
            </div>
        </div>
    </div>

    <!-- PRODUCT IMAGES -->
    <div class="form-group-item mt-4">
        <h5 class="form-title">Product Images</h5>
        <input type="file" name="images[]" class="form-control" multiple>
    </div>

    <!-- BUTTONS -->
    <div class="text-end mt-4">
        <button type="reset" class="btn btn-secondary">Cancel</button>
        <button type="submit" class="btn btn-primary">Save Product</button>
    </div>

</form>


</div>
</div>

</div>
</div>
<!-- Inline Diamond Form -->
<div id="diamondForm" class="card p-3 mt-3" style="display:none;">

    <h6>Add Diamond</h6>

    <div class="row">
        <div class="col-lg-3">
            <label>Clarity</label>
            <input type="text" class="form-control" id="d_clarity">
        </div>

        <div class="col-lg-3">
            <label>Cut</label>
            <input type="text" class="form-control" id="d_cut">
        </div>

        <div class="col-lg-3">
            <label>Color</label>
            <input type="text" class="form-control" id="d_color">
        </div>

        <div class="col-lg-3">
            <label>Pieces</label>
            <input type="number" class="form-control" id="d_pieces">
        </div>

        <div class="col-lg-3 mt-3">
            <label>Price Per Carat</label>
            <input type="text" class="form-control" id="d_price">
        </div>
    </div>

    <button class="btn btn-primary mt-3" id="saveDiamondBtn">Add Diamond</button>
</div>


<!-- Inline Stone Form -->
<div id="stoneForm" class="card p-3 mt-3" style="display:none;">
    <h6>Add Stone</h6>

    <div class="row">
        <div class="col-lg-3">
            <label>Stone Name</label>
            <input type="text" class="form-control" id="s_name">
        </div>

        <div class="col-lg-3">
            <label>Stone Weight</label>
            <input type="text" class="form-control" id="s_weight">
        </div>

        <div class="col-lg-3">
            <label>Stone Price</label>
            <input type="text" class="form-control" id="s_price">
        </div>

        <div class="col-lg-3">
            <label>Discount Price</label>
            <input type="text" class="form-control" id="s_discount">
        </div>
    </div>

    <button class="btn btn-primary mt-3" id="saveStoneBtn">Add Stone</button>
</div>

<script>

// SHOW Diamond form
document.getElementById("openDiamondForm").onclick = function () {
    document.getElementById("diamondForm").style.display = "block";
    document.getElementById("stoneForm").style.display = "none"; // hide stone form if open
};

// SHOW Stone form
document.getElementById("openStoneForm").onclick = function () {
    document.getElementById("stoneForm").style.display = "block";
    document.getElementById("diamondForm").style.display = "none"; // hide diamond form if open
};


// SAVE DIAMOND
document.getElementById("saveDiamondBtn").onclick = function () {

    let clarity = document.getElementById("d_clarity").value;
    let cut = document.getElementById("d_cut").value;
    let color = document.getElementById("d_color").value;
    let pieces = document.getElementById("d_pieces").value;
    let price = document.getElementById("d_price").value;

    let html = `
        <div class="alert alert-secondary p-2">
            Diamond: ${clarity}, ${cut}, ${color}, Pieces: ${pieces}, Price: ${price}
        </div>
    `;
    document.getElementById("diamondList").innerHTML += html;

    document.getElementById("diamondForm").style.display = "none";
};


// SAVE STONE
document.getElementById("saveStoneBtn").onclick = function () {

    let name = document.getElementById("s_name").value;
    let weight = document.getElementById("s_weight").value;
    let price = document.getElementById("s_price").value;
    let discount = document.getElementById("s_discount").value;

    let html = `
        <div class="alert alert-info p-2">
            Stone: ${name}, Weight: ${weight}, Price: ${price}, Discount: ${discount}
        </div>
    `;
    document.getElementById("stoneList").innerHTML += html;

    document.getElementById("stoneForm").style.display = "none";
};

</script>


@endsection
