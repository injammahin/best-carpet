<form method="POST" action="{{ $action }}" enctype="multipart/form-data" class="max-w-6xl">
    @csrf

    @if($method === 'PUT')
        @method('PUT')
    @endif

    @if($errors->any())
        <div class="mb-6 rounded-[14px] border border-red-200 bg-red-50 px-4 py-3 text-sm font-medium text-red-700">
            Please check the form fields and try again.
        </div>
    @endif

    <div class="grid gap-6 xl:grid-cols-[1fr_360px]">
        <div class="space-y-6">
            <div class="clean-card bg-white p-6">
                <p class="section-label mb-2">Article content</p>
                <h1 class="text-3xl text-mega-black">
                    {{ $post->exists ? 'Edit Blog Article' : 'Add Blog Article' }}
                </h1>

                <div class="mt-6 grid gap-5">
                    <div>
                        <label class="mb-2 block text-sm font-medium text-mega-text">Title *</label>
                        <input type="text" name="title" value="{{ old('title', $post->title) }}" class="input-clean"
                            required>
                        @error('title') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-medium text-mega-text">Slug</label>
                        <input type="text" name="slug" value="{{ old('slug', $post->slug) }}" class="input-clean"
                            placeholder="leave empty to generate automatically">
                        @error('slug') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-medium text-mega-text">Excerpt</label>
                        <textarea name="excerpt" rows="3" class="input-clean"
                            placeholder="Short summary shown on blog cards">{{ old('excerpt', $post->excerpt) }}</textarea>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-medium text-mega-text">Article Body *</label>
                        <textarea name="content" rows="18" class="input-clean leading-7"
                            required>{{ old('content', $post->content) }}</textarea>
                        <p class="mt-2 text-xs text-mega-muted">
                            Use short paragraphs. Each line break will be shown cleanly on the public article page.
                        </p>
                        @error('content') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <div class="clean-card bg-white p-6">
                <p class="section-label mb-2">SEO settings</p>

                <div class="grid gap-5">
                    <div>
                        <label class="mb-2 block text-sm font-medium text-mega-text">Meta Title</label>
                        <input type="text" name="meta_title" value="{{ old('meta_title', $post->meta_title) }}"
                            class="input-clean">
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-medium text-mega-text">Meta Description</label>
                        <textarea name="meta_description" rows="3"
                            class="input-clean">{{ old('meta_description', $post->meta_description) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <aside class="space-y-6">
            <div class="clean-card bg-white p-6">
                <p class="section-label mb-2">Publish</p>

                <div class="grid gap-5">
                    <div>
                        <label class="mb-2 block text-sm font-medium text-mega-text">Status *</label>
                        <select name="status" class="input-clean" required>
                            <option value="draft" @selected(old('status', $post->status ?: 'draft') === 'draft')>Draft
                            </option>
                            <option value="published" @selected(old('status', $post->status) === 'published')>Published
                            </option>
                        </select>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-medium text-mega-text">Published At</label>
                        <input type="datetime-local" name="published_at"
                            value="{{ old('published_at', $post->published_at ? $post->published_at->format('Y-m-d\TH:i') : '') }}"
                            class="input-clean">
                    </div>

                    <label class="flex items-center gap-3">
                        <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $post->is_featured))>
                        <span class="text-sm font-semibold text-mega-black">Feature this article</span>
                    </label>
                </div>
            </div>

            <div class="clean-card bg-white p-6">
                <p class="section-label mb-2">Image</p>

                <label class="mb-2 block text-sm font-medium text-mega-text">Featured Image</label>
                <input type="file" name="featured_image_file" class="input-clean">

                <p class="mt-2 text-xs text-mega-muted">
                    Recommended size: 1200 x 750px.
                </p>

                @if($post->exists && $post->featured_image)
                    <img src="{{ $post->imageUrl() }}" alt="{{ $post->title }}"
                        class="mt-4 h-48 w-full rounded-[7px] object-cover">
                @endif
            </div>

            <div class="flex gap-3">
                <button type="submit" class="btn-primary">
                    Save Article
                </button>

                <a href="{{ route('admin.blog-posts.index') }}" class="btn-light">
                    Cancel
                </a>
            </div>
        </aside>
    </div>
</form>