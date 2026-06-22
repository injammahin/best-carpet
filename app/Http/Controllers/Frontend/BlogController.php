<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(): View
    {
        $posts = BlogPost::published()
            ->orderByDesc('is_featured')
            ->orderByDesc('published_at')
            ->paginate(9);

        return view('frontend.blog.index', compact('posts'));
    }

    public function show(string $slug): View
    {
        $post = BlogPost::published()
            ->where('slug', $slug)
            ->firstOrFail();

        $relatedPosts = BlogPost::published()
            ->where('id', '!=', $post->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('frontend.blog.show', compact('post', 'relatedPosts'));
    }
}