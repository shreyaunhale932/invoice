<div class="card bg-white">
    <div class="card-body">
        <form method="POST" action="{{ $action }}">
            @csrf
            @if ($method !== 'POST')
                @method($method)
            @endif

            <div class="input-block mb-3">
                <label for="name" class="form-label">Name</label>
                <input id="name" name="name" type="text"
                    class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name', $testimonial->name ?? '') }}" maxlength="255" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="input-block mb-3">
                <label for="short_detail" class="form-label">Short detail</label>
                <input id="short_detail" name="short_detail" type="text"
                    class="form-control @error('short_detail') is-invalid @enderror"
                    value="{{ old('short_detail', $testimonial->short_detail ?? '') }}" maxlength="255" required>
                @error('short_detail')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="input-block mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea id="content" name="content" rows="5"
                    class="form-control @error('content') is-invalid @enderror"
                    maxlength="10000" required>{{ old('content', $testimonial->content ?? '') }}</textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="input-block mb-3">
                <label for="rating" class="form-label">Rating</label>
                <select id="rating" name="rating" class="form-select @error('rating') is-invalid @enderror" required>
                    <option value="">Select rating</option>
                    @for ($rating = 1; $rating <= 5; $rating++)
                        <option value="{{ $rating }}" @selected((string) old('rating', $testimonial->rating ?? '') === (string) $rating)>
                            {{ $rating }} {{ $rating === 1 ? 'star' : 'stars' }}
                        </option>
                    @endfor
                </select>
                @error('rating')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Save Testimonial</button>
            <a href="{{ route('superadmin.cms.testimonials.index') }}" class="btn btn-light ms-2">Cancel</a>
        </form>
    </div>
</div>
