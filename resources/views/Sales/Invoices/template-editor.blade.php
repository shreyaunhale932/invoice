<?php $page = 'invoice-template'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="card mb-0">
                <div class="card-body">
                    <div class="page-header">
                        <div class="content-page-header">
                            <h5>Invoice Template Editor</h5>
                            <p class="text-muted">Customize labels and visibility for your invoice template</p>
                        </div>
                    </div>

                    <form id="templateForm" enctype="multipart/form-data">
                        @csrf

                        @foreach($settings as $sectionKey => $sectionSettings)
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h6 class="mb-0 text-capitalize">{{ str_replace('_', ' ', $sectionKey) }}</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width="25%">Field</th>
                                                    <th width="25%">Label</th>
                                                    <th width="30%">Value/Image</th>
                                                    <th width="10%">Visible</th>
                                                    <th width="10%">Order</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($sectionSettings->sortBy('display_order') as $setting)
                                                    <tr @if($setting->field_key === 'dummy_image') style="display: none;" @endif>
                                                        <td>
                                                            <strong>{{ str_replace('_', ' ', $setting->field_key) }}</strong>
                                                            <input type="hidden" name="settings[{{ $loop->parent->index }}_{{ $loop->index }}][section_key]" value="{{ $setting->section_key }}">
                                                            <input type="hidden" name="settings[{{ $loop->parent->index }}_{{ $loop->index }}][field_key]" value="{{ $setting->field_key }}">
                                                            <input type="hidden" name="settings[{{ $loop->parent->index }}_{{ $loop->index }}][field_type]" value="{{ $setting->field_type }}">
                                                        </td>
                                                        <td>
                                                            <input type="text"
                                                                   class="form-control"
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
                                                                             style="max-width: 100px; max-height: 50px; border: 1px solid #ddd; padding: 5px;">
                                                                    </div>
                                                                @endif
                                                                <input type="file"
                                                                       class="form-control image-upload-input"
                                                                       accept="image/*"
                                                                       data-setting-key="{{ $loop->parent->index }}_{{ $loop->index }}">
                                                                <input type="hidden"
                                                                       name="settings[{{ $loop->parent->index }}_{{ $loop->index }}][image_key]"
                                                                       value="{{ $loop->parent->index }}_{{ $loop->index }}"
                                                                       class="image-key-field">
                                                                <small class="text-muted">Upload new image to replace</small>
                                                            @elseif($setting->field_type === 'text')
                                                                <input type="text"
                                                                       class="form-control"
                                                                       name="settings[{{ $loop->parent->index }}_{{ $loop->index }}][value]"
                                                                       value="{{ $setting->value ?? $setting->default_value ?? '' }}"
                                                                       placeholder="Enter text value">
                                                            @else
                                                                <span class="text-muted">N/A</span>
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="checkbox"
                                                                   name="settings[{{ $loop->parent->index }}_{{ $loop->index }}][is_visible]"
                                                                   value="1"
                                                                   {{ $setting->is_visible ? 'checked' : '' }}>
                                                        </td>
                                                        <td>
                                                            <input type="number"
                                                                   class="form-control"
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

                        <!-- Custom Content Blocks Section -->
                        <div class="card mb-4 mt-4">
                            {{-- <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">Custom Content Blocks</h6>
                                <button type="button" class="btn btn-sm btn-success" id="addCustomBlockBtn">
                                    <i class="fe fe-plus"></i> Add Custom Block
                                </button>
                            </div> --}}
                            <div class="card-body">
                                <div id="customBlocksContainer">
                                    @if(isset($customBlocks) && $customBlocks->count() > 0)
                                        @foreach($customBlocks as $block)
                                            <div class="custom-block-item card mb-3" data-id="{{ $block->id }}">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between mb-2">
                                                        <h6>{{ $block->block_name }}</h6>
                                                        <div>
                                                            <button type="button" class="btn btn-sm btn-primary edit-block-btn" data-id="{{ $block->id }}">Edit</button>
                                                            <button type="button" class="btn btn-sm btn-danger delete-block-btn" data-id="{{ $block->id }}">Delete</button>
                                                        </div>
                                                    </div>
                                                    <p class="text-muted"><strong>Position:</strong> {{ ucfirst(str_replace('_', ' ', $block->position)) }} |
                                                        <strong>Type:</strong> {{ ucfirst($block->block_type) }} |
                                                        <strong>Visible:</strong> {{ $block->is_visible ? 'Yes' : 'No' }}</p>
                                                    @if($block->image_path)
                                                        <img src="{{ asset($block->image_path) }}" alt="Block Image" style="max-width: 100px; max-height: 80px; border: 1px solid #ddd; padding: 5px; margin: 5px 0;">
                                                    @endif
                                                    @if($block->content)
                                                        <div class="mt-2 p-2 bg-light rounded">
                                                            {!! Str::limit(strip_tags($block->content), 100) !!}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        {{-- <p class="text-muted">No custom blocks created yet. Click "Add Custom Block" to create one.</p> --}}
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- /Custom Content Blocks Section -->

                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-secondary" id="resetBtn">Reset to Defaults</button>
                            <div>
                                <button type="button" class="btn btn-primary me-2" onclick="window.location.href='{{ route('invoices') }}'">Cancel</button>
                                <button type="submit" class="btn btn-success">Save Template</button>
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
                            $(input).closest('td').find('small').before('<div class="mb-2"><img src="' + e.target.result + '" alt="Preview" style="max-width: 100px; max-height: 50px; border: 1px solid #ddd; padding: 5px;"></div>');
                        }
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            });

            $('#templateForm').on('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);
                const settings = [];
                const seen = {};
                let imageIndex = 0;

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

                            // Handle value for text fields
                            const valueInput = row.find('input[name*="[value]"]');
                            if (valueInput.length) {
                                setting.value = valueInput.val();
                            }

                            // Handle image uploads
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

                // Add settings to formData
                formData.append('settings', JSON.stringify(settings));

                $.ajax({
                    url: '{{ route("invoice.template.update") }}',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') || $('input[name="_token"]').val()
                    },
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            alert('Template updated successfully!');
                            location.reload();
                        } else {
                            alert('Error: ' + response.message);
                        }
                    },
                    error: function(xhr) {
                        alert('Error updating template. Please try again.');
                        console.error(xhr);
                    }
                });
            });

            $('#resetBtn').on('click', function() {
                if (confirm('Are you sure you want to reset all template settings to defaults? This cannot be undone.')) {
                    $.ajax({
                        url: '{{ route("invoice.template.reset") }}',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') || $('input[name="_token"]').val()
                        },
                        data: {
                            _token: $('input[name="_token"]').val()
                        },
                        success: function(response) {
                            if (response.success) {
                                alert('Template reset to defaults successfully!');
                                location.reload();
                            } else {
                                alert('Error: ' + response.message);
                            }
                        },
                        error: function(xhr) {
                            alert('Error resetting template. Please try again.');
                            console.error(xhr);
                        }
                    });
                }
            });
        });

        // Custom Blocks Management
        $('#addCustomBlockBtn').on('click', function() {
            showBlockModal();
        });

        $(document).on('click', '.edit-block-btn', function() {
            const blockId = $(this).data('id');
            // Load block data and show modal
            $.get('/invoice-template/blocks/' + blockId, function(response) {
                // Implement edit modal loading
            });
            showBlockModal(blockId);
        });

        $(document).on('click', '.delete-block-btn', function() {
            const blockId = $(this).data('id');
            if (confirm('Are you sure you want to delete this custom block?')) {
                $.ajax({
                    url: '/invoice-template/blocks/' + blockId + '/delete',
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    },
                    success: function(response) {
                        if (response.success) {
                            $('.custom-block-item[data-id="' + blockId + '"]').remove();
                            alert('Block deleted successfully');
                        }
                    }
                });
            }
        });

        function showBlockModal(blockId = null) {
            // Simple modal implementation - you can enhance with Bootstrap modal
            const html = `
                <div id="blockModal" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 9999; display: flex; align-items: center; justify-content: center;">
                    <div style="background: white; padding: 20px; border-radius: 8px; max-width: 800px; width: 90%; max-height: 90vh; overflow-y: auto;">
                        <h5>${blockId ? 'Edit' : 'Add'} Custom Block</h5>
                        <form id="blockForm">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="block_id" value="${blockId || ''}">

                            <div class="mb-3">
                                <label>Block Name</label>
                                <input type="text" name="block_name" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label>Block Type</label>
                                <select name="block_type" class="form-control">
                                    <option value="custom">Custom</option>
                                    <option value="info">Info</option>
                                    <option value="image">Image</option>
                                    <option value="mixed">Mixed (Info + Image)</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Content (HTML/Text)</label>
                                <textarea name="content" class="form-control" rows="4" placeholder="Enter content or HTML"></textarea>
                            </div>

                            <div class="mb-3">
                                <label>Image</label>
                                <input type="file" name="image" class="form-control" accept="image/*">
                            </div>

                            <div class="mb-3">
                                <label>Position</label>
                                <select name="position" class="form-control">
                                    <option value="before_footer">Before Footer</option>
                                    <option value="after_items">After Items Table</option>
                                    <option value="after_header">After Header</option>
                                    <option value="custom">Custom Position</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Display Order</label>
                                <input type="number" name="display_order" class="form-control" value="0">
                            </div>

                            <div class="mb-3">
                                <label>
                                    <input type="checkbox" name="is_visible" value="1" checked> Visible
                                </label>
                            </div>

                            <div class="mb-3">
                                <label>CSS Classes</label>
                                <input type="text" name="css_class" class="form-control" placeholder="e.g., bg-light p-3">
                            </div>

                            <div class="mb-3">
                                <label>Custom CSS</label>
                                <textarea name="custom_css" class="form-control" rows="3" placeholder="Custom CSS styles"></textarea>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-secondary me-2" onclick="$('#blockModal').remove();">Cancel</button>
                                <button type="submit" class="btn btn-success">${blockId ? 'Update' : 'Create'} Block</button>
                            </div>
                        </form>
                    </div>
                </div>
            `;
            $('body').append(html);

            $('#blockForm').on('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                const url = blockId ? `/invoice-template/blocks/${blockId}/update` : '/invoice-template/blocks/store';

                $.ajax({
                    url: url,
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    },
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            alert('Block ' + (blockId ? 'updated' : 'created') + ' successfully!');
                            location.reload();
                        }
                    },
                    error: function(xhr) {
                        alert('Error saving block');
                        console.error(xhr);
                    }
                });
            });
        }
    </script>
@endsection

