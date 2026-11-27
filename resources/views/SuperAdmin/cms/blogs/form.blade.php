<div class="card bg-white">
    <div class="card-body">
        <form id="blog-post-form" method="POST" action="{{ $action }}" enctype="multipart/form-data">
            @csrf
            @if ($method !== 'POST')
                @method($method)
            @endif

            <div class="input-block mb-3">
                <label for="heading" class="form-label">Heading</label>
                <input id="heading" name="heading" type="text"
                    class="form-control @error('heading') is-invalid @enderror"
                    value="{{ old('heading', $blog?->heading) }}" maxlength="255" required>
                @error('heading')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="input-block mb-3">
                <label for="image" class="form-label">Image (651 × 434)</label>
                <input id="image" name="image" type="file" accept="image/jpeg,image/png,image/webp"
                    class="form-control @error('image') is-invalid @enderror" @required(!$blog)>
                <div class="form-text">JPG, PNG, or WebP; exact dimensions 651 × 434; maximum size 5 MB.
                    @if ($blog)
                        Leave blank to keep the current image.
                    @endif
                </div>
                @if ($blog)
                    <img src="{{ asset($blog->image) }}" alt="{{ $blog->heading }}" class="mt-2"
                        width="150" height="100" style="object-fit: cover;">
                @endif
                <small id="image_error" class="text-danger d-block"></small>
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="input-block mb-3">
                <label for="date" class="form-label">Date</label>
                <input id="date" name="date" type="date"
                    class="form-control @error('date') is-invalid @enderror"
                    value="{{ old('date', $blog && $blog->date ? $blog->date->format('Y-m-d') : '') }}" required>
                @error('date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="input-block mb-3">
                <label for="admin" class="form-label">Admin / Author</label>
                <input id="admin" name="admin" type="text"
                    class="form-control @error('admin') is-invalid @enderror"
                    value="{{ old('admin', $blog?->admin) }}" maxlength="255" required>
                @error('admin')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="input-block mb-3">
                <label for="content1" class="form-label">Content 1</label>
                <textarea id="content1" name="content1" rows="8"
                    class="summernote form-control @error('content1') is-invalid @enderror"
                    maxlength="100000">{{ old('content1', $blog?->content1) }}</textarea>
                @error('content1')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="input-block mb-3">
                <label for="content2" class="form-label">Content 2 (optional)</label>
                <textarea id="content2" name="content2" rows="8"
                    class="summernote form-control @error('content2') is-invalid @enderror"
                    maxlength="100000">{{ old('content2', $blog?->content2) }}</textarea>
                @error('content2')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="input-block mb-3">
                <label for="conclusion" class="form-label">Conclusion (optional)</label>
                <textarea id="conclusion" name="conclusion" rows="6"
                    class="summernote form-control @error('conclusion') is-invalid @enderror"
                    maxlength="100000">{{ old('conclusion', $blog?->conclusion) }}</textarea>
                @error('conclusion')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <hr>
            <h5 class="mb-3">SEO Settings</h5>
            <div class="input-block mb-3">
                <label for="seo_title" class="form-label">SEO title</label>
                <input id="seo_title" name="seo_title" type="text"
                    class="form-control @error('seo_title') is-invalid @enderror"
                    value="{{ old('seo_title', $blog?->seo_title) }}" maxlength="255">
                @error('seo_title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-text">Leave blank to use the blog heading.</div>
            </div>

            <div class="input-block mb-3">
                <label for="seo_description" class="form-label">Meta description</label>
                <textarea id="seo_description" name="seo_description" rows="3"
                    class="form-control @error('seo_description') is-invalid @enderror"
                    maxlength="5000">{{ old('seo_description', $blog?->seo_description) }}</textarea>
                @error('seo_description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="input-block mb-3">
                <label for="seo_keywords" class="form-label">Meta keywords</label>
                <textarea id="seo_keywords" name="seo_keywords" rows="3"
                    class="form-control @error('seo_keywords') is-invalid @enderror"
                    maxlength="10000">{{ old('seo_keywords', $blog?->seo_keywords) }}</textarea>
                @error('seo_keywords')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="input-block mb-3">
                <label for="seo_canonical_url" class="form-label">Canonical URL</label>
                <input id="seo_canonical_url" name="seo_canonical_url" type="url"
                    class="form-control @error('seo_canonical_url') is-invalid @enderror"
                    value="{{ old('seo_canonical_url', $blog?->seo_canonical_url) }}" maxlength="255">
                @error('seo_canonical_url')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-text">Leave blank to use this blog post's public URL.</div>
            </div>

            <button type="submit" class="btn btn-primary">Save Blog</button>
            <a href="{{ route('superadmin.cms.blogs.index') }}" class="btn btn-light ms-2">Cancel</a>
        </form>
    </div>
</div>
