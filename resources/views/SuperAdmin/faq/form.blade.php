<div class="input-block mb-3">
    <label class="form-label" for="question">Question</label>
    <input id="question" name="question" type="text" class="form-control"
        value="{{ old('question', $faq?->question) }}" required maxlength="1000">
    @error('question')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="input-block mb-3">
    <label class="form-label" for="answer">Answer</label>
    <textarea id="answer" name="answer" class="form-control" rows="6" required>{{ old('answer', $faq?->answer) }}</textarea>
    @error('answer')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<button type="submit" class="btn btn-primary">{{ $submitLabel }}</button>
<a href="{{ route('superadmin.cms.faq.index') }}" class="btn btn-light ms-2">Cancel</a>
