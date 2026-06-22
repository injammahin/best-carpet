@extends('layouts.frontend')

@section('title', 'Blog | Mega Carpets')
@section('meta_description', 'Read flooring tips, carpet guides, renovation ideas and product advice from Mega Carpets.')

@section('content')

    @php
        $featuredPost = $posts->firstWhere('is_featured', true) ?: $posts->first();
    @endphp

    <section class="bg-mega-cream py-12 md:py-16">
        <div class="site-container">
            <div class="mx-auto max-w-4xl text-center">
                <p class="section-kicker">Flooring blog</p>

                <h1 class="section-title-premium">
                    Helpful flooring articles for smarter decisions.
                </h1>

                <p class="mx-auto section-lead">
                    Carpet, timber, hybrid, laminate, vinyl and rug advice written to help customers choose with confidence.
                </p>
            </div>
        </div>
    </section>

    @if($featuredPost)
        <section class="bg-white py-12">
            <div class="site-container">
                <a href="{{ route('frontend.blog.show', $featuredPost->slug) }}"
                    class="group grid overflow-hidden border border-mega-line bg-white shadow-premium transition hover:-translate-y-1 radius-7 lg:grid-cols-[1.1fr_0.9fr]">
                    <div class="relative min-h-[360px] overflow-hidden">
                        <img src="{{ $featuredPost->imageUrl() }}" alt="{{ $featuredPost->title }}"
                            class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                    </div>

                    <div class="flex flex-col justify-center p-7 md:p-10">
                        <p class="section-kicker">Featured article</p>

                        <h2 class="mt-3 text-4xl font-black leading-tight tracking-[-0.06em] text-mega-black md:text-5xl">
                            {{ $featuredPost->title }}
                        </h2>

                        <p class="mt-5 text-lg leading-8 text-mega-muted">
                            {{ $featuredPost->excerptText() }}
                        </p>

                        <div class="mt-7 inline-flex font-black text-mega-orange">
                            Read article →
                        </div>
                    </div>
                </a>
            </div>
        </section>
    @endif

    <section class="bg-white py-12 md:py-16">
        <div class="site-container">
            <div class="mb-8 flex flex-col justify-between gap-4 md:flex-row md:items-end">
                <div>
                    <p class="section-kicker">Latest posts</p>
                    <h2 class="section-title-premium">Flooring guides and ideas.</h2>
                </div>
            </div>

            @if($posts->count())
                <div class="grid items-stretch gap-6 md:grid-cols-2 xl:grid-cols-3">
                    @foreach($posts as $post)
                        <article
                            class="flex h-full flex-col overflow-hidden border border-mega-line bg-white shadow-soft transition hover:-translate-y-1 hover:shadow-premium radius-7">
                            <a href="{{ route('frontend.blog.show', $post->slug) }}" class="block overflow-hidden">
                                <img src="{{ $post->imageUrl() }}" alt="{{ $post->title }}"
                                    class="h-64 w-full object-cover transition duration-500 hover:scale-105">
                            </a>

                            <div class="flex flex-1 flex-col p-6">
                                <div class="mb-3 flex items-center justify-between gap-3">
                                    <span
                                        class="rounded-full bg-mega-orange/10 px-3 py-1 text-xs font-black uppercase tracking-[0.14em] text-mega-orange">
                                        Blog
                                    </span>

                                    <span class="text-xs font-semibold text-mega-muted">
                                        {{ $post->published_at ? $post->published_at->format('d M Y') : $post->created_at->format('d M Y') }}
                                    </span>
                                </div>

                                <h3 class="min-h-[72px] text-2xl font-black leading-tight tracking-[-0.04em] text-mega-black">
                                    <a href="{{ route('frontend.blog.show', $post->slug) }}" class="hover:text-mega-orange">
                                        {{ $post->title }}
                                    </a>
                                </h3>

                                <p class="mt-3 min-h-[78px] text-sm font-semibold leading-6 text-mega-muted">
                                    {{ \Illuminate\Support\Str::limit($post->excerptText(), 150) }}
                                </p>

                                <a href="{{ route('frontend.blog.show', $post->slug) }}"
                                    class="mt-auto inline-flex pt-6 font-black text-mega-orange">
                                    Read more →
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>

                @if($posts->hasPages())
                    <div class="mt-10">
                        {{ $posts->links() }}
                    </div>
                @endif
            @else
                <div class="rounded-[7px] border border-mega-line bg-mega-soft p-12 text-center">
                    <h2 class="text-3xl font-black text-mega-black">No blog articles yet.</h2>
                    <p class="mt-2 text-mega-muted">Please check back soon for flooring guides and ideas.</p>
                </div>
            @endif
        </div>
    </section>

@endsection