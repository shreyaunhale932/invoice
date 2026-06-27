@extends('layout.mainlayout')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/label-designer.css') }}">

<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header mb-2">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Label Designer</h3>
                </div>
                <div class="col-auto d-flex align-items-center gap-2">
                    @if(isset($template))
                    <form action="{{ route('labels.templates.destroy', $template->id) }}" method="POST" class="m-0" onsubmit="return confirm('Are you sure you want to delete this template?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger" title="Delete Template">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </form>
                    @endif
                    <button class="btn btn-outline-secondary" id="btnPreview" title="Print Preview">
                        <i class="fas fa-print"></i> Preview
                    </button>
                    <button class="btn btn-primary" id="btnSaveTemplate">
                        <i class="fas fa-save"></i> Save Template
                    </button>
                </div>
            </div>
        </div>

        <div class="designer-container">
            <!-- Left Toolbar: Elements -->
            <div class="designer-toolbar">
                <h6 class="toolbar-title">Elements</h6>
                <div class="element-grid">
                    <button class="btn-element" data-type="text" title="Text"><i class="fas fa-font"></i> Text</button>
                    <button class="btn-element" data-type="barcode" title="Barcode"><i class="fas fa-barcode"></i> Barcode</button>
                    <button class="btn-element" data-type="qrcode" title="QR Code"><i class="fas fa-qrcode"></i> QR Code</button>
                    <button class="btn-element" data-type="image" title="Image"><i class="fas fa-image"></i> Image</button>
                    <button class="btn-element" data-type="line" title="Line"><i class="fas fa-minus"></i> Line</button>
                    <button class="btn-element" data-type="rect" title="Rectangle"><i class="far fa-square"></i> Rectangle</button>
                </div>

                <h6 class="toolbar-title mt-3">Dynamic Fields</h6>
                <div class="field-list">
                    @if(isset($dynamicFields))
                        @foreach($dynamicFields as $field_key => $field_name)
                            <button class="btn-field" data-field="<?php echo '{{ ' . $field_key . ' }}'; ?>">+ {{ $field_name }}</button>
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- Center: Canvas Area -->
            <div class="designer-workspace">
                <div class="workspace-header">
                    <div class="d-flex align-items-center gap-2">
                        <div class="d-flex align-items-center gap-1">
                            W: <input type="number" id="canvasW" class="form-control form-control-sm" style="width: 60px;" value="{{ $template->canvas_width ?? '50' }}"> mm
                        </div>
                        <div class="d-flex align-items-center gap-1">
                            H: <input type="number" id="canvasH" class="form-control form-control-sm" style="width: 60px;" value="{{ $template->canvas_height ?? '25' }}"> mm
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-sm btn-outline-secondary" id="btnUndo" title="Undo"><i class="fas fa-undo"></i></button>
                        <button class="btn btn-sm btn-outline-secondary" id="btnRedo" title="Redo"><i class="fas fa-redo"></i></button>
                        <button class="btn btn-sm btn-outline-danger" id="btnDeleteElement" title="Delete Selected"><i class="fas fa-trash"></i></button>
                    </div>
                </div>

                <div class="workspace-canvas-wrapper">
                    <!-- The actual canvas (mm mapped to px based on scale) -->
                    <div id="designerCanvas" class="designer-canvas">
                        <!-- Elements will be injected here -->
                    </div>
                </div>
            </div>

            <!-- Right Toolbar: Properties -->
            <div class="designer-properties">
                <h6 class="toolbar-title">Template Details</h6>
                <div class="mb-3">
                    <label class="form-label small">Template Name</label>
                    <input type="text" id="templateName" class="form-control form-control-sm" value="{{ $template->name ?? 'New Template' }}">
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="isDefault" {{ isset($template) && $template->is_default ? 'checked' : '' }}>
                    <label class="form-check-label small" for="isDefault">Set as Default Template</label>
                </div>
                
                <h6 class="toolbar-title mt-3">Properties</h6>
                <div id="noElementSelected" class="text-muted small p-2">Select an element to edit properties.</div>
                
                <div id="elementProperties" style="display: none;">
                    <div class="mb-2">
                        <label class="form-label small">X (mm)</label>
                        <input type="number" id="propX" class="form-control form-control-sm prop-input">
                    </div>
                    <div class="mb-2">
                        <label class="form-label small">Y (mm)</label>
                        <input type="number" id="propY" class="form-control form-control-sm prop-input">
                    </div>
                    
                    <!-- Text Properties -->
                    <div class="props-text" style="display: none;">
                        <div class="mb-2">
                            <label class="form-label small">Prefix</label>
                            <input type="text" id="propPrefix" class="form-control form-control-sm prop-input" placeholder="e.g. GW:">
                        </div>
                        <div class="mb-2">
                            <label class="form-label small">Text Value</label>
                            <input type="text" id="propTextValue" class="form-control form-control-sm prop-input">
                        </div>
                        <div class="mb-2">
                            <label class="form-label small">Postfix</label>
                            <input type="text" id="propPostfix" class="form-control form-control-sm prop-input" placeholder="e.g. g">
                        </div>
                        <div class="mb-2">
                            <label class="form-label small">Font Size (px)</label>
                            <input type="number" id="propFontSize" class="form-control form-control-sm prop-input">
                        </div>
                        <div class="mb-2">
                            <label class="form-label small">Font Weight</label>
                            <select id="propFontWeight" class="form-select form-select-sm prop-input">
                                <option value="normal">Normal</option>
                                <option value="bold">Bold</option>
                            </select>
                        </div>
                    </div>

                    <!-- Barcode Properties -->
                    <div class="props-barcode" style="display: none;">
                        <div class="mb-2">
                            <label class="form-label small">Data Field</label>
                            <input type="text" id="propBarcodeValue" class="form-control form-control-sm prop-input" placeholder="&#123;&#123; barcode &#125;&#125;">
                        </div>
                        <div class="mb-2">
                            <label class="form-label small">Format</label>
                            <select id="propBarcodeFormat" class="form-select form-select-sm prop-input">
                                <option value="CODE128">CODE128</option>
                                <option value="CODE39">CODE39</option>
                                <option value="EAN13">EAN13</option>
                                <option value="UPC">UPC</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label class="form-label small">Show Text</label>
                            <select id="propBarcodeText" class="form-select form-select-sm prop-input">
                                <option value="true">Yes</option>
                                <option value="false">No</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label class="form-label small">Height (px)</label>
                            <input type="number" id="propBarcodeHeight" class="form-control form-control-sm prop-input">
                        </div>
                    </div>

                    <!-- QR Code Properties -->
                    <div class="props-qrcode" style="display: none;">
                        <div class="mb-2">
                            <label class="form-label small">Data Field</label>
                            <input type="text" id="propQrcodeValue" class="form-control form-control-sm prop-input" placeholder="&#123;&#123; barcode &#125;&#125;">
                        </div>
                    </div>
                    
                    <div class="mt-3">
                        <button class="btn btn-sm btn-outline-danger w-100" id="btnDeleteSelected">Remove Element</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add required libraries -->
<script src="https://cdn.jsdelivr.net/npm/interactjs/dist/interact.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/davidshimjs/qrcodejs/qrcode.min.js"></script>

<!-- Load saved template data if editing -->
<script>
    window.SavedTemplate = {!! isset($template) ? json_encode($template) : 'null' !!};
    window.SaveTemplateUrl = "{{ isset($template) ? route('labels.designer.update', $template->id) : route('labels.designer.store') }}";
    window.CsrfToken = "{{ csrf_token() }}";
    window.IsUpdate = {{ isset($template) ? 'true' : 'false' }};
</script>
<script src="{{ asset('assets/js/label-designer.js') }}"></script>
@endsection
