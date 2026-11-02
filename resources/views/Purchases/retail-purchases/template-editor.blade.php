<?php $page = 'purchase-template'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="card mb-0">
                <div class="card-body">
                    <div class="page-header">
                        <div class="content-page-header">
                            <h5>Purchase Invoice Template Editor</h5>
                            <p class="text-muted">Customize labels, table columns, and visibility for your Wholesale Purchase invoices</p>
                        </div>
                    </div>

                    <form id="templateForm" enctype="multipart/form-data">
                        @csrf

                        @php
                            $sectionTitles = [
                                'purchase_header' => '1. Header & Company Information',
                                'purchase_meta' => '2. Purchase Meta Details',
                                'supplier_info' => '3. Supplier / Vendor Information',
                                'purchase_item_table' => '4. Purchase Items Table Columns',
                                'metal_payment' => '5. Gold / Metal Payment Summary',
                                'purchase_footer' => '6. Summary & Totals Labels',
                                'terms_and_notes' => '7. Notes, Terms & Conditions',
                                'visual_elements' => '8. Visual Elements & Signatures',
                            ];
                        @endphp

                        @foreach($settings as $sectionKey => $sectionSettings)
                            <div class="card mb-4 border">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0 text-capitalize font-weight-bold">
                                        {{ $sectionTitles[$sectionKey] ?? ucwords(str_replace('_', ' ', $sectionKey)) }}
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover">
                                            <thead class="table-light">
                                                <tr>
                                                    <th width="25%">Field / Column</th>
                                                    <th width="25%">Display Label</th>
                                                    <th width="30%">Value / Content / Image</th>
                                                    <th width="10%" class="text-center">Visible</th>
                                                    <th width="10%">Order</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($sectionSettings->sortBy('display_order') as $setting)
                                                    <tr>
                                                        <td>
                                                            <strong>{{ ucwords(str_replace(['column_', '_'], ['', ' '], $setting->field_key)) }}</strong>
                                                            <br><small class="text-muted">{{ $setting->field_key }} ({{ $setting->field_type }})</small>
                                                            <input type="hidden" name="settings[{{ $loop->parent->index }}_{{ $loop->index }}][section_key]" value="{{ $setting->section_key }}">
                                                            <input type="hidden" name="settings[{{ $loop->parent->index }}_{{ $loop->index }}][field_key]" value="{{ $setting->field_key }}">
                                                            <input type="hidden" name="settings[{{ $loop->parent->index }}_{{ $loop->index }}][field_type]" value="{{ $setting->field_type }}">
                                                        </td>
                                                        <td>
                                                            <input type="text"
                                                                   class="form-control form-control-sm"
                                                                   name="settings[{{ $loop->parent->index }}_{{ $loop->index }}][label]"
                                                                   value="{{ $setting->label }}"
                                                                   required>
                                                        </td>
                                                        <td>
                                                            @if($setting->field_type === 'image')
                                                                @if($setting->value || $setting->default_value)
                                                                    <div class="mb-2">
                                                                        <img src="{{ asset($setting->value ?? $setting->default_value) }}"
                                                                             alt="Preview"
                                                                             style="max-width: 120px; max-height: 50px; border: 1px solid #ddd; padding: 4px; border-radius: 4px; background: #fafafa;">
                                                                    </div>
                                                                @endif
                                                                <input type="file"
                                                                       class="form-control form-control-sm image-upload-input"
                                                                       accept="image/*"
                                                                       data-setting-key="{{ $loop->parent->index }}_{{ $loop->index }}">
                                                                <input type="hidden"
                                                                       name="settings[{{ $loop->parent->index }}_{{ $loop->index }}][image_key]"
                                                                       value="{{ $loop->parent->index }}_{{ $loop->index }}"
                                                                       class="image-key-field">
                                                                <small class="text-muted d-block mt-1">Upload to replace image</small>
                                                            @elseif($setting->field_type === 'textarea')
                                                                <textarea class="form-control form-control-sm"
                                                                          name="settings[{{ $loop->parent->index }}_{{ $loop->index }}][value]"
                                                                          rows="3"
                                                                          placeholder="Enter text value">{{ $setting->value ?? $setting->default_value ?? '' }}</textarea>
                                                            @elseif(in_array($setting->field_type, ['text', 'section']))
                                                                <input type="text"
                                                                       class="form-control form-control-sm"
                                                                       name="settings[{{ $loop->parent->index }}_{{ $loop->index }}][value]"
                                                                       value="{{ $setting->value ?? $setting->default_value ?? '' }}"
                                                                       placeholder="Enter text value">
                                                            @else
                                                                <span class="text-muted small">Standard Column / Label</span>
                                                            @endif
                                                        </td>
                                                        <td class="text-center align-middle">
                                                            <div class="form-check form-switch d-inline-block">
                                                                <input class="form-check-input"
                                                                       type="checkbox"
                                                                       name="settings[{{ $loop->parent->index }}_{{ $loop->index }}][is_visible]"
                                                                       value="1"
                                                                       {{ $setting->is_visible ? 'checked' : '' }}>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="number"
                                                                   class="form-control form-control-sm"
                                                                   name="settings[{{ $loop->parent->index }}_{{ $loop->index }}][display_order]"
                                                                   value="{{ $setting->display_order }}"
                                                                   min="0">
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <!-- Bottom Action Buttons -->
                        <div class="d-flex justify-content-between align-items-center mt-4 p-3 bg-light rounded">
                            <button type="button" class="btn btn-outline-danger" id="resetBtn">
                                <i class="fa fa-undo me-1"></i> Reset to Defaults
                            </button>
                            <div>
                                <a href="{{ route('purchases.index') }}" class="btn btn-secondary me-2">
                                    <i class="fa fa-times me-1"></i> Cancel
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-check me-1"></i> Save Template Settings
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Handle image preview
            $(document).on('change', '.image-upload-input', function() {
                const input = this;
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = $(input).closest('td').find('img');
                        if (img.length) {
                            img.attr('src', e.target.result);
                        } else {
                            $(input).closest('td').find('small').before('<div class="mb-2"><img src="' + e.target.result + '" alt="Preview" style="max-width: 120px; max-height: 50px; border: 1px solid #ddd; padding: 4px; border-radius: 4px; background: #fafafa;"></div>');
                        }
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            });

            // Handle form submission
            $('#templateForm').on('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);
                const settings = [];
                const seen = {};

                // Convert form data to array format
                $('tr').each(function() {
                    const row = $(this);
                    const hiddenInputs = row.find('input[type="hidden"]');

                    if (hiddenInputs.length >= 3) {
                        const sectionKey = row.find('input[name*="[section_key]"]').val();
                        const fieldKey = row.find('input[name*="[field_key]"]').val();
                        const fieldType = row.find('input[name*="[field_type]"]').val();
                        const key = sectionKey + '_' + fieldKey;

                        if (!seen[key]) {
                            const setting = {
                                section_key: sectionKey,
                                field_key: fieldKey,
                                field_type: fieldType,
                                label: row.find('input[name*="[label]"]').val(),
                                is_visible: row.find('input[name*="[is_visible]"]').is(':checked') ? 1 : 0,
                                display_order: parseInt(row.find('input[name*="[display_order]"]').val()) || 0
                            };

                            const valueInput = row.find('input[name*="[value]"], textarea[name*="[value]"]');
                            if (valueInput.length) {
                                setting.value = valueInput.val();
                            }

                            const imageInput = row.find('.image-upload-input');
                            if (imageInput.length && imageInput[0].files && imageInput[0].files[0]) {
                                const imageKey = row.find('.image-key-field').val();
                                formData.append('images[' + imageKey + ']', imageInput[0].files[0]);
                                setting.image_key = imageKey;
                            }

                            settings.push(setting);
                            seen[key] = true;
                        }
                    }
                });

                formData.append('settings', JSON.stringify(settings));

                const submitBtn = $(this).find('button[type="submit"]');
                submitBtn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin me-1"></i> Saving...');

                $.ajax({
                    url: '{{ route("purchase.template.update") }}',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') || $('input[name="_token"]').val()
                    },
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        submitBtn.prop('disabled', false).html('<i class="fa fa-check me-1"></i> Save Template Settings');
                        if (response.success) {
                            alert('Purchase template updated successfully!');
                            location.reload();
                        } else {
                            alert('Error: ' + response.message);
                        }
                    },
                    error: function(xhr) {
                        submitBtn.prop('disabled', false).html('<i class="fa fa-check me-1"></i> Save Template Settings');
                        alert('Error updating template: ' + (xhr.responseJSON?.message || 'Server error'));
                    }
                });
            });

            // Handle reset button
            $('#resetBtn').on('click', function() {
                if (confirm('Are you sure you want to reset all purchase template settings to defaults? Any custom labels or order will be reverted.')) {
                    const resetBtn = $(this);
                    resetBtn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin me-1"></i> Resetting...');

                    $.ajax({
                        url: '{{ route("purchase.template.reset") }}',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') || $('input[name="_token"]').val()
                        },
                        success: function(response) {
                            if (response.success) {
                                alert('Purchase template reset to defaults successfully!');
                                location.reload();
                            } else {
                                alert('Error: ' + response.message);
                                resetBtn.prop('disabled', false).html('<i class="fa fa-undo me-1"></i> Reset to Defaults');
                            }
                        },
                        error: function(xhr) {
                            alert('Error resetting template: ' + (xhr.responseJSON?.message || 'Server error'));
                            resetBtn.prop('disabled', false).html('<i class="fa fa-undo me-1"></i> Reset to Defaults');
                        }
                    });
                }
            });
        });
    </script>
@endsection
