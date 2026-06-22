<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class BlogPostController extends Controller
{
    public function index(Request $request): View
    {
        $query = BlogPost::query()->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = trim($request->search);

            $query->where(function ($subQuery) use ($search) {
                $subQuery
                    ->where('title', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $posts = $query->paginate(15)->withQueryString();

        return view('admin.blog-posts.index', compact('posts'));
    }

    public function create(): View
    {
        $post = new BlogPost();

        return view('admin.blog-posts.create', compact('post'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validatePost($request);

        $validated['slug'] = $this->uniqueSlug($validated['slug'] ?: $validated['title']);
        $validated['is_featured'] = $request->boolean('is_featured');

        if ($validated['status'] === 'published' && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        if ($request->hasFile('featured_image_file')) {
            $validated['featured_image'] = $request->file('featured_image_file')->store('blog', 'public');
        }

        BlogPost::create($validated);

        return redirect()
            ->route('admin.blog-posts.index')
            ->with('success', 'Blog post created successfully.');
    }

    public function edit(BlogPost $blogPost): View
    {
        $post = $blogPost;

        return view('admin.blog-posts.edit', compact('post'));
    }

    public function update(Request $request, BlogPost $blogPost): RedirectResponse
    {
        $validated = $this->validatePost($request, $blogPost);

        $slugSource = $validated['slug'] ?: $validated['title'];

        if ($blogPost->slug !== Str::slug($slugSource)) {
            $validated['slug'] = $this->uniqueSlug($slugSource, $blogPost->id);
        } else {
            $validated['slug'] = $blogPost->slug;
        }

        $validated['is_featured'] = $request->boolean('is_featured');

        if ($validated['status'] === 'published' && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        if ($request->hasFile('featured_image_file')) {
            $this->deleteStoredFile($blogPost->featured_image);
            $validated['featured_image'] = $request->file('featured_image_file')->store('blog', 'public');
        } else {
            $validated['featured_image'] = $blogPost->featured_image;
        }

        $blogPost->update($validated);

        return redirect()
            ->route('admin.blog-posts.index')
            ->with('success', 'Blog post updated successfully.');
    }

    public function destroy(BlogPost $blogPost): RedirectResponse
    {
        $this->deleteStoredFile($blogPost->featured_image);

        $blogPost->delete();

        return back()->with('success', 'Blog post deleted successfully.');
    }

    private function validatePost(Request $request, ?BlogPost $post = null): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:190'],
            'slug' => [
                'nullable',
                'string',
                'max:190',
                Rule::unique('blog_posts', 'slug')->ignore($post?->id),
            ],
            'excerpt' => ['nullable', 'string', 'max:700'],
            'content' => ['required', 'string'],
            'featured_image_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'meta_title' => ['nullable', 'string', 'max:190'],
            'meta_description' => ['nullable', 'string', 'max:500'],
            'status' => ['required', Rule::in(['draft', 'published'])],
            'published_at' => ['nullable', 'date'],
            'is_featured' => ['nullable', 'boolean'],
        ]);
    }

    private function uniqueSlug(string $value, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($value);
        $slug = $baseSlug ?: Str::random(10);
        $count = 1;

        while (
            BlogPost::where('slug', $slug)
                ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }

    private function deleteStoredFile(?string $path): void
    {
        if (!$path) {
            return;
        }

        if (Str::startsWith($path, ['http://', 'https://', '/storage/', 'storage/', '/images/', 'images/'])) {
            return;
        }

        Storage::disk('public')->delete($path);
    }
}