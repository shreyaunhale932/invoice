<div class="col-12 col-md-6">
    <div class="input-block mb-3">
        <label class="form-label" for="{{ $errorKey }}">{{ \Illuminate\Support\Str::headline($label) }}</label>
        @if ($multiline)
            <textarea id="{{ $errorKey }}" name="{{ $inputName }}" rows="3"
                class="form-control @error($errorKey) is-invalid @enderror"
                maxlength="2000">{{ old($errorKey, $value) }}</textarea>
        @else
            <input id="{{ $errorKey }}" name="{{ $inputName }}" type="text"
                class="form-control @error($errorKey) is-invalid @enderror"
                value="{{ old($errorKey, $value) }}" maxlength="2000">
        @endif
        @error($errorKey)
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
