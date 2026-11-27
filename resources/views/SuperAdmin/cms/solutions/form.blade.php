<div class="card bg-white">
    <div class="card-body">
        <form method="POST" action="{{ $action }}">
            @csrf
            @if ($method !== 'POST')
                @method($method)
            @endif

            <div class="input-block mb-3">
                <label for="title" class="form-label">Menu short title</label>
                <input id="title" name="title" type="text"
                    class="form-control @error('title') is-invalid @enderror"
                    value="{{ old('title', $solution->title ?? '') }}" maxlength="255" required readonly>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="input-block mb-3">
                <label for="description" class="form-label">Menu description</label>
                <textarea id="description" name="description" rows="3"
                    class="form-control @error('description') is-invalid @enderror"
                    maxlength="1000" required>{{ old('description', $solution->description ?? '') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="input-block mb-3">
                <label for="home_description" class="form-label">Home description line</label>
                <textarea id="home_description" name="home_description" rows="3"
                    class="form-control @error('home_description') is-invalid @enderror"
                    maxlength="1000" required>{{ old('home_description', $solution->home_description ?? '') }}</textarea>
                @error('home_description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="input-block mb-3">
                <label for="tagline" class="form-label">Home tag line</label>
                <input id="tagline" name="tagline" type="text"
                    class="form-control @error('tagline') is-invalid @enderror"
                    value="{{ old('tagline', $solution->tagline ?? '') }}"
                    maxlength="255">
                @error('tagline')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="input-block mb-3">
                <label for="url" class="form-label">Destination URL</label>
                <input id="url" name="url" type="text"
                    class="form-control @error('url') is-invalid @enderror"
                    value="{{ old('url', $solution->url ?? '/invoice-and-solution') }}"
                    placeholder="/invoice-and-solution or https://example.com" maxlength="2048" required>
                @error('url')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="input-block mb-3">
                <label for="sort_order" class="form-label">Display order</label>
                <input id="sort_order" name="sort_order" type="number" min="0" max="9999"
                    class="form-control @error('sort_order') is-invalid @enderror"
                    value="{{ old('sort_order', $solution->sort_order ?? 0) }}" required>
                @error('sort_order')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-check mb-3">
                <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1"
                    @checked(old('is_active', $solution->is_active ?? true))>
                <label class="form-check-label" for="is_active">Show in public navigation</label>
            </div>

            <button type="submit" class="btn btn-primary">Save Solution</button>
            <a href="{{ route('superadmin.cms.solutions.index') }}" class="btn btn-light ms-2">Cancel</a>
        </form>
    </div>
</div>
