<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class BlogPostController extends Controller
{
    private const IMAGE_DIRECTORY = 'front_assets/img/blogs';

    public function index(Request $request)
    {
        $validated = $request->validate([
            'search' => ['nullable', 'string', 'max:255'],
        ]);
        $search = trim($validated['search'] ?? '');

        $query = BlogPost::query();
        if ($search !== '') {
            $term = '%' . $search . '%';
            $query->where(function ($query) use ($term) {
                $query->where('heading', 'like', $term)
                    ->orWhere('admin', 'like', $term)
                    ->orWhere('content1', 'like', $term)
                    ->orWhere('content2', 'like', $term)
                    ->orWhere('conclusion', 'like', $term);
            });
        }

        $blogPosts = $query->orderByDesc('date')
            ->orderByDesc('id')
            ->paginate(15)
            ->withQueryString();

        return view('SuperAdmin.cms.blogs.index', compact('blogPosts', 'search'));
    }

    public function create()
    {
        return view('SuperAdmin.cms.blogs.create');
    }

    public function store(Request $request)
    {
        BlogPost::create($this->validatedData($request));

        return redirect()->route('superadmin.cms.blogs.index')
            ->with('success', 'Blog post created successfully.');
    }

    public function edit(BlogPost $blog)
    {
        return view('SuperAdmin.cms.blogs.edit', compact('blog'));
    }

    public function update(Request $request, BlogPost $blog)
    {
        $data = $this->validatedData($request, true);
        $oldImage = $blog->image;

        $blog->update($data);

        if (isset($data['image'])) {
            $this->deleteImage($oldImage);
        }

        return redirect()->route('superadmin.cms.blogs.index')
            ->with('success', 'Blog post updated successfully.');
    }

    public function destroy(BlogPost $blog)
    {
        $image = $blog->image;
        $blog->delete();
        $this->deleteImage($image);

        return redirect()->route('superadmin.cms.blogs.index')
            ->with('success', 'Blog post deleted successfully.');
    }

    private function validatedData(Request $request, bool $isUpdate = false): array
    {
        $data = $request->validate([
            'heading' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date'],
            'admin' => ['required', 'string', 'max:255'],
            'content1' => ['required', 'string', 'max:100000'],
            'content2' => ['nullable', 'string', 'max:100000'],
            'conclusion' => ['nullable', 'string', 'max:100000'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string', 'max:5000'],
            'seo_keywords' => ['nullable', 'string', 'max:10000'],
            'seo_canonical_url' => ['nullable', 'url', 'max:255'],
            'image' => [
                $isUpdate ? 'nullable' : 'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
                'dimensions:width=651,height=434',
            ],
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $this->storeImage($request->file('image'));
        } elseif ($isUpdate) {
            unset($data['image']);
        }

        return $data;
    }

    private function storeImage(UploadedFile $image): string
    {
        $directory = public_path(self::IMAGE_DIRECTORY);
        File::ensureDirectoryExists($directory);

        $filename = Str::uuid() . '.' . $image->extension();
        $image->move($directory, $filename);

        return self::IMAGE_DIRECTORY . '/' . $filename;
    }

    private function deleteImage(?string $image): void
    {
        if ($image !== null && dirname($image) === self::IMAGE_DIRECTORY) {
            File::delete(public_path(self::IMAGE_DIRECTORY . '/' . basename($image)));
        }
    }
}
