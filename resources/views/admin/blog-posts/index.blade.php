@extends('layouts.admin')

@section('title', 'Blog Posts | Mega Carpets Admin')
@section('page_title', 'Blog Posts')

@section('content')

    <div class="mb-6 flex flex-col justify-between gap-4 md:flex-row md:items-center">
        <div>
            <p class="section-label mb-2">SEO content</p>
            <h1 class="text-3xl text-mega-black">Blog Articles</h1>
            <p class="mt-2 text-sm text-mega-muted">
                Write helpful flooring articles to support SEO and customer education.
            </p>
        </div>

        <a href="{{ route('admin.blog-posts.create') }}" class="btn-primary w-fit">
            Add Blog Article
        </a>
    </div>

    @if(session('success'))
        <div class="mb-5 rounded-[14px] border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="clean-card overflow-hidden bg-white">
        <div class="border-b border-mega-line p-6">
            <form method="GET" class="grid gap-3 md:grid-cols-[1fr_180px_auto]">
                <input type="text" name="search" value="{{ request('search') }}" class="input-clean"
                    placeholder="Search articles...">

                <select name="status" class="input-clean">
                    <option value="">All Status</option>
                    <option value="published" @selected(request('status') === 'published')>Published</option>
                    <option value="draft" @selected(request('status') === 'draft')>Draft</option>
                </select>

                <button type="submit" class="btn-primary justify-center">
                    Filter
                </button>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-left">
                <thead class="border-b border-mega-line bg-mega-soft text-xs uppercase tracking-[0.16em] text-mega-muted">
                    <tr>
                        <th class="px-6 py-4">Article</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Published</th>
                        <th class="px-6 py-4 text-right">Action</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-mega-line">
                    @forelse($posts as $post)
                        <tr>
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-4">
                                    <img src="{{ $post->imageUrl() }}" alt="{{ $post->title }}"
                                        class="h-16 w-20 rounded-[7px] object-cover">

                                    <div>
                                        <p class="font-semibold text-mega-black">{{ $post->title }}</p>
                                        <p class="mt-1 text-xs text-mega-muted">{{ $post->slug }}</p>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-5">
                                <span
                                    class="rounded-full px-3 py-1 text-xs font-semibold {{ $post->status === 'published' ? 'bg-green-50 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                                    {{ ucfirst($post->status) }}
                                </span>

                                @if($post->is_featured)
                                    <span class="ml-2 rounded-full bg-orange-50 px-3 py-1 text-xs font-semibold text-mega-orange">
                                        Featured
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-5 text-sm text-mega-muted">
                                {{ $post->published_at ? $post->published_at->format('d M Y') : 'Not published' }}
                            </td>

                            <td class="px-6 py-5 text-right">
                                <div class="inline-flex gap-2">
                                    @if($post->status === 'published')
                                        <a href="{{ route('frontend.blog.show', $post->slug) }}" target="_blank"
                                            class="rounded-[7px] bg-mega-soft px-4 py-2 text-sm font-semibold text-mega-black">
                                            View
                                        </a>
                                    @endif

                                    <a href="{{ route('admin.blog-posts.edit', $post) }}"
                                        class="rounded-[7px] bg-mega-orange px-4 py-2 text-sm font-semibold text-white">
                                        Edit
                                    </a>

                                    <form method="POST" action="{{ route('admin.blog-posts.destroy', $post) }}"
                                        onsubmit="return confirm('Delete this blog article?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="rounded-[7px] bg-red-50 px-4 py-2 text-sm font-semibold text-red-700">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-16 text-center">
                                <p class="text-lg font-semibold text-mega-black">No blog articles found.</p>
                                <a href="{{ route('admin.blog-posts.create') }}" class="btn-primary mt-5">
                                    Add first article
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($posts->hasPages())
            <div class="border-t border-mega-line p-6">
                {{ $posts->links() }}
            </div>
        @endif
    </div>

@endsection