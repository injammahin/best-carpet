@extends('layouts.frontend')

@section('title', ($post->meta_title ?: $post->title) . ' | Mega Carpets')
@section('meta_description', $post->meta_description ?: $post->excerptText())

@section('content')

    <article class="bg-white">
        <section class="bg-mega-cream py-12 md:py-16">
            <div class="site-container">
                <div class="mx-auto max-w-5xl text-center">
                    <p class="section-kicker">
                        Flooring blog
                    </p>

                    <h1 class="section-title-premium">
                        {{ $post->title }}
                    </h1>

                    <p class="mx-auto mt-5 max-w-3xl text-base font-semibold text-mega-muted">
                        {{ $post->published_at ? $post->published_at->format('d M Y') : $post->created_at->format('d M Y') }}
                    </p>
                </div>
            </div>
        </section>

        <section class="bg-white py-10 md:py-14">
            <div class="site-container">
                <div class="mx-auto max-w-5xl overflow-hidden rounded-[7px] shadow-premium">
                    <img src="{{ $post->imageUrl() }}" alt="{{ $post->title }}" class="h-[520px] w-full object-cover">
                </div>

                <div class="mx-auto mt-12 max-w-3xl">
                    @if($post->excerpt)
                        <p class="mb-8 border-l-4 border-mega-orange pl-5 text-xl font-bold leading-9 text-mega-black">
                            {{ $post->excerpt }}
                        </p>
                    @endif

                    <div class="blog-article-content text-lg leading-9 text-mega-muted">
                        {!! nl2br(e($post->content)) !!}
                    </div>
                </div>
            </div>
        </section>
    </article>

    @if($relatedPosts->count())
        <section class="bg-mega-cream py-12 md:py-16">
            <div class="site-container">
                <div class="mb-8 flex flex-col justify-between gap-4 md:flex-row md:items-end">
                    <div>
                        <p class="section-kicker">Related articles</p>
                        <h2 class="section-title-premium">More flooring advice.</h2>
                    </div>

                    <a href="{{ route('frontend.blog.index') }}" class="btn-light w-fit">
                        View all blog posts
                    </a>
                </div>

                <div class="grid gap-6 md:grid-cols-3">
                    @foreach($relatedPosts as $related)
                        <article class="flex h-full flex-col overflow-hidden bg-white shadow-soft radius-7">
                            <a href="{{ route('frontend.blog.show', $related->slug) }}">
                                <img src="{{ $related->imageUrl() }}" alt="{{ $related->title }}" class="h-56 w-full object-cover">
                            </a>

                            <div class="flex flex-1 flex-col p-5">
                                <h3 class="min-h-[64px] text-xl font-black leading-tight text-mega-black">
                                    {{ $related->title }}
                                </h3>

                                <p class="mt-3 min-h-[72px] text-sm font-semibold leading-6 text-mega-muted">
                                    {{ \Illuminate\Support\Str::limit($related->excerptText(), 130) }}
                                </p>

                                <a href="{{ route('frontend.blog.show', $related->slug) }}"
                                    class="mt-auto pt-5 font-black text-mega-orange">
                                    Read article →
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <style>
        .blog-article-content p {
            margin-bottom: 1.5rem;
        }

        .blog-article-content strong {
            color: #070707;
            font-weight: 900;
        }
    </style>

@endsection