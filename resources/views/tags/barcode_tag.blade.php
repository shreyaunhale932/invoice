<!DOCTYPE html>
<html>
<head>
    <title>Barcode Tag</title>

    <script>
        window.onload = function () {
            window.print();
        }
    </script>
</head>
<body>

<div style="width:250px;border:1px solid #000;padding:10px;">

    <h3>{{ $product->product_name }}</h3>

    <p>Barcode: {{ $product->barcode }}</p>

    <p>Weight: {{ $product->net_weight }} GM</p>

    <p>Price: ₹{{ $product->final_price }}</p>

    <img src="data:image/png;base64,
    {{ DNS1D::getBarcodePNG($product->barcode, 'C128') }}">

</div>

</body>
</html>
