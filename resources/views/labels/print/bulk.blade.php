@extends('layout.mainlayout')

@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Bulk Label Printing</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Bulk Label Print</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('labels.print.processBulk') }}" method="POST" target="_blank">
                            @csrf
                            <div class="row form-group">
                                <div class="col-md-4">
                                    <label>Select Label Template <span class="text-danger">*</span></label>
                                    <select name="template_id" class="form-select" required>
                                        <option value="">-- Select Template --</option>
                                        @foreach($templates as $template)
                                        <option value="{{ $template->id }}">{{ $template->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <h5 class="mt-4 mb-3">Select Products to Print</h5>
                            <div class="table-responsive">
                                <table class="table table-center table-hover datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>
                                                <input type="checkbox" id="selectAll">
                                            </th>
                                            <th>Product Name</th>
                                            <th>SKU/Code</th>
                                            <th>Barcode</th>
                                            <th>Gross Weight</th>
                                            <th>Selling Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($products as $product)
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="product_ids[]" value="{{ $product->id }}" class="product-cb">
                                            </td>
                                            <td>{{ $product->product_name }}</td>
                                            <td>{{ $product->pre_code }}{{ $product->post_code }}</td>
                                            <td>{{ $product->barcode }}</td>
                                            <td>{{ $product->gross_weight }}</td>
                                            <td>{{ number_format($product->sale_price, 2) }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="text-end mt-4">
                                <button type="submit" class="btn btn-primary" id="btnBulkPrint" disabled>
                                    <i class="fas fa-print"></i> Generate Bulk Print
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectAll = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('.product-cb');
    const btnBulkPrint = document.getElementById('btnBulkPrint');

    function checkBtnState() {
        btnBulkPrint.disabled = !document.querySelector('.product-cb:checked');
    }

    selectAll.addEventListener('change', function() {
        checkboxes.forEach(cb => cb.checked = selectAll.checked);
        checkBtnState();
    });

    checkboxes.forEach(cb => {
        cb.addEventListener('change', function() {
            if (!this.checked) selectAll.checked = false;
            checkBtnState();
        });
    });
});
</script>
@endsection
