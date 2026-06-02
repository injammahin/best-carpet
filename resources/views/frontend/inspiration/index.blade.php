@extends('layouts.frontend')

@section('title', 'Inspiration | Mega Carpets')
@section('meta_description', 'Flooring ideas, room guides and colour inspiration from Mega Carpets.')

@section('content')

    <section class="bg-mega-cream py-16 md:py-24">
        <div class="site-container">
            <div class="max-w-3xl">
                <div class="section-label">Inspiration</div>
                <h1 class="section-title">Ideas that help customers choose the right flooring.</h1>
                <p class="section-text">
                    Inspiration pages make the website feel more premium and are useful for future SEO content.
                </p>
            </div>
        </div>
    </section>

    <section class="bg-white py-16 md:py-20">
        <div class="site-container">
            <div class="grid gap-5 lg:grid-cols-3">
                @foreach($articles as $article)
                    <article class="clean-card clean-card-hover overflow-hidden">
                        <img src="{{ $article['image'] }}" alt="{{ $article['title'] }}" class="h-64 w-full object-cover">

                        <div class="p-5">
                            <p class="mb-3 text-xs font-medium uppercase tracking-[0.2em] text-mega-orange">
                                Flooring guide
                            </p>

                            <h2 class="text-2xl leading-tight">{{ $article['title'] }}</h2>
                            <p class="mt-3 text-sm leading-6">{{ $article['text'] }}</p>

                            <a href="#" class="mt-5 inline-flex items-center gap-2 text-sm font-medium text-mega-orange">
                                Read article
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M5 12h14" />
                                    <path d="M13 6l6 6-6 6" />
                                </svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

@endsection