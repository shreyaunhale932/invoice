<div class="card bg-white">
    <div class="card-body">
        <form method="POST" action="{{ $action }}">
            @csrf
            @if ($method !== 'POST')
                @method($method)
            @endif

            <div class="input-block mb-3">
                <label for="category" class="form-label">T1 Category</label>
                <select id="category" name="category" class="form-select @error('category') is-invalid @enderror" required>
                    <option value="">Select category</option>
                    @foreach ($categories as $value => $label)
                        <option value="{{ $value }}" @selected(old('category', $video?->category) === $value)>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
                @error('category')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="input-block mb-3">
                <label for="title" class="form-label">Heading</label>
                <input id="title" name="title" type="text"
                    class="form-control @error('title') is-invalid @enderror"
                    value="{{ old('title', $video?->title) }}" maxlength="255" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="input-block mb-3">
                <label for="video_url" class="form-label">YouTube video URL</label>
                <input id="video_url" name="video_url" type="url"
                    class="form-control @error('video_url') is-invalid @enderror"
                    value="{{ old('video_url', $video ? 'https://youtu.be/' . $video->video_id : '') }}"
                    placeholder="https://youtu.be/..." maxlength="2048" required>
                @error('video_url')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="input-block mb-3">
                <label for="t2_label" class="form-label">T2 Label</label>
                <input id="t2_label" name="t2_label" type="text"
                    class="form-control @error('t2_label') is-invalid @enderror"
                    value="{{ old('t2_label', $video?->t2_label) }}"
                    placeholder="Tutorial, Dashboard, ERP, Hardware" maxlength="100" required>
                @error('t2_label')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Save Video</button>
            <a href="{{ route('superadmin.cms.videos.index') }}" class="btn btn-light ms-2">Cancel</a>
        </form>
    </div>
</div>
