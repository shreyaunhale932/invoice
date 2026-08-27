@extends('layout.mainlayout')
@section('content')
<style>
.input-group .btn {
    padding: 0px 6px;
}
</style>
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h5 class="page-title fw-bold">Create Packet</h5>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('packet-masters.index') }}">Packet Masters</a></li>
                            <li class="breadcrumb-item active">Create Packet</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('packet-masters.store') }}" method="POST">
                                @csrf
                                <div class="row g-4">
                                    <div class="col-xl-2 col-lg-2 col-md-4">
                                        <div class="form-group">
                                            <label>Packet No <span class="text-danger">*</span></label>
                                            <input type="text" name="packet_no" class="form-control" required>
                                            @error('packet_no')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-4">
                                        <div class="form-group">
                                            <label>Packet Type</label>
                                            <div class="input-group attribute-group">
                                                <div class="flex-grow-1">
                                                    <select name="packet_type" id="packet_type"
                                                        class="form-control select2"
                                                        data-placeholder="Select Packet Type">
                                                        <option value=""></option>
                                                        @foreach ($packet_types as $item)
                                                            <option value="{{ $item->name }}" {{ old('packet_type', 'Diamond') == $item->name ? 'selected' : '' }}>
                                                                {{ $item->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <button type="button" class="btn btn-attribute-add btn custom-btn-primary"
                                                    onclick="openAddModal('packet_types')">
                                                    +
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    

                                    <!-- Helper function for Dropdown with Add Button -->
                                    @foreach (['stone', 'clarity', 'color', 'cut', 'shape', 'mm'] as $attr)
                                        <div class="col-xl-2 col-lg-2 col-md-4">
                                            <div class="form-group">
                                                <label>{{ ucfirst($attr) }}</label>

                                                <div class="input-group attribute-group">

                                                    <div class="flex-grow-1">
                                                        <select name="{{ $attr }}_id" id="{{ $attr }}_id"
                                                            class="form-control select2"
                                                            data-placeholder="Select {{ ucfirst($attr) }}">
                                                            <option value=""></option>

                                                            @foreach (${\Illuminate\Support\Str::plural($attr)} as $item)
                                                                <option value="{{ $item->id }}">{{ $item->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <button type="button" class="btn btn-attribute-add btn custom-btn-primary"
                                                        onclick="openAddModal('{{ \Illuminate\Support\Str::plural($attr) }}')">
                                                        +
                                                    </button>

                                                </div>

                                            </div>
                                        </div>
                                    @endforeach


                                    <div class="col-xl-2 col-lg-2 col-md-4">
                                        <div class="form-group">
                                            <label>Certificate No</label>
                                            <input type="text" name="certificate_no" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-4">
                                        <div class="form-group">
                                            <label>Rate Retail</label>
                                            <input type="number" step="0.01" name="rate_retail" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-4">
                                        <div class="form-group">
                                            <label>Rate Wholesale</label>
                                            <input type="number" step="0.01" name="rate_wholesale" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-4">
                                        <div class="form-group">
                                            <label>Cost</label>
                                            <input type="number" step="0.01" name="cost" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-4">
                                        <div class="form-group">
                                            <label>Average Pcs</label>
                                            <input type="number" step="0.01" name="average_pcs" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-4">
                                        <div class="form-group">
                                            <label>Average Wt</label>
                                            <input type="number" step="0.001" name="average_wt" class="form-control">
                                        </div>
                                    </div>
                                    
                                    <div class="col-xl-6 col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label>Remarks</label>
                                            <textarea name="remarks" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-4">
                                        <div class="form-group">
                                            <label>Solitaire</label>
                                            <div class="status-toggle">
                                                <input type="checkbox" id="solitaire" name="solitaire" class="check"
                                                    value="1">
                                                <label for="solitaire" class="checktoggle">checkbox</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end mt-4">
                                    <button type="submit" class="btn btn-primary">Save Packet</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Attribute Modal -->
    <div class="modal custom-modal fade" id="add_attribute_modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_title">Add Attribute</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="add_attribute_form">
                        @csrf
                        <input type="hidden" id="attribute_type" name="type">
                        <div class="form-group mb-3">
                            <label>Name <span class="text-danger">*</span></label>
                            <input type="text" id="new_attribute_name" name="name" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>Short Code</label>
                            <input type="text" id="new_attribute_code" name="short_code" class="form-control">
                        </div>
                        <div class="submit-section text-end">
                            <button type="submit" class="btn btn-primary submit-btn">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentAttributeType = '';

        function openAddModal(type) {
            currentAttributeType = type;
            let titleText = type.charAt(0).toUpperCase() + type.slice(1, -1);
            titleText = titleText.replace('_', ' ');
            document.getElementById('modal_title').innerText = 'Add ' + titleText;
            document.getElementById('attribute_type').value = type;
            document.getElementById('new_attribute_name').value = '';
            document.getElementById('new_attribute_code').value = '';

            const modal = new bootstrap.Modal(document.getElementById('add_attribute_modal'));
            modal.show();
        }

        document.getElementById('add_attribute_form').addEventListener('submit', function(e) {
            e.preventDefault();

            const name = document.getElementById('new_attribute_name').value;
            const short_code = document.getElementById('new_attribute_code').value;
            const type = currentAttributeType;

            // Use the correct route structure
            let url = "{{ route('packet-attributes.store', ['type' => ':type']) }}";
            url = url.replace(':type', type);

            fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json', // VERY IMPORTANT
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },

                    body: JSON.stringify({
                        name: name,
                        short_code: short_code
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {

                        const modalEl = document.getElementById('add_attribute_modal');
                        const modal = bootstrap.Modal.getInstance(modalEl);
                        modal.hide();

                        let selectId;
                        let optionValue;

                        if (type === 'packet_types') {
                            selectId = 'packet_type';
                            optionValue = data.name;
                        } else {
                            let singular;
                            if (type.endsWith('ies')) {
                                singular = type.slice(0, -3) + 'y';
                            } else {
                                singular = type.slice(0, -1);
                            }
                            selectId = singular + '_id';
                            optionValue = data.id;
                        }

                        const select = document.getElementById(selectId);

                        const option = new Option(data.name, optionValue, true, true);
                        select.add(option);
                        $(select).trigger('change');

                        alert(data.message);
                    }
                })

                .catch(error => console.error('Error:', error));
        });

        $(document).ready(function() {
            $('.select2').select2({
                width: '100%',
                placeholder: function() {
                    return $(this).data('placeholder');
                }
            });
        });
    </script>
@endsection
