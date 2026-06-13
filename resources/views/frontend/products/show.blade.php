@extends('layouts.frontend')

@section('title', $product['name'] . ' | Mega Carpets')@section('meta_description', $product['short'])@section('content')
    <section class="bg-white py-12 md:py-16">
        <div class="site-container">
            <div class="mb-8 flex flex-col justify-between gap-4 md:flex-row md:items-end">
                <div>
                    <p class="section-kicker">{{ $product['category'] }} details</p>

                    <h1 class="section-title-premium max-w-4xl">
                        {{ $product['name'] }}
                    </h1>

                    <p class="section-lead">
                        {{ $product['description'] }}
                    </p>
                </div>

                <a href="{{ route('frontend.product.show', $product['category_slug']) }}" class="btn-light w-fit">
                    Back to {{ $product['category'] }}
                </a>
            </div>

            <div class="grid gap-8 lg:grid-cols-[1.08fr_0.92fr]">
                <div>
                    <div class="product-gallery-main" data-zoom-wrap>
                        <img src="{{ $product['gallery'][0] }}" alt="{{ $product['name'] }}" data-main-image>

                        <div class="product-gallery-badge">
                            Hover image to zoom
                        </div>
                    </div>

                    <div class="mt-4 grid grid-cols-4 gap-3">
                        @foreach($product['gallery'] as $image)
                            <button type="button" class="product-thumb-btn" data-gallery-thumb data-image="{{ $image }}">
                                <img src="{{ $image }}" alt="{{ $product['name'] }} thumbnail">
                            </button>
                        @endforeach
                    </div>
                </div>

                <aside class="product-detail-card" data-product-card data-product='@json($product)'>
                    <div class="mb-5 flex items-start justify-between gap-4">
                        <div>
                            <p class="text-xs font-extrabold uppercase tracking-[0.24em] text-mega-orange">
                                {{ $product['category'] }}
                            </p>

                            <h2 class="mt-3 text-2xl font-bold leading-tight tracking-[-0.05em] text-mega-black">
                                {{ $product['name'] }}
                            </h2>

                            <p class="mt-3 text-sm font-semibold leading-6 text-mega-muted">
                                {{ $product['short'] }}
                            </p>
                        </div>

                        <button type="button" class="wishlist-float static" data-product-wishlist aria-label="Save product">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path
                                    d="M20.8 5.6c-1.6-1.8-4.2-1.9-5.9-.2L12 8.3 9.1 5.4C7.4 3.7 4.8 3.8 3.2 5.6c-1.7 2-1.5 5 .4 6.9L12 21l8.4-8.5c1.9-1.9 2.1-4.9.4-6.9z" />
                            </svg>
                        </button>
                    </div>

                    <div class="rounded-[7px] bg-mega-cream p-4">
                        <div class="flex items-end justify-between gap-4">
                            <div>
                                <p class="text-xs font-extrabold uppercase tracking-[0.22em] text-mega-muted">
                                    From
                                </p>

                                <p class="mt-1 text-2xl font-light text-mega-black">
                                    ${{ number_format($product['price_from'], 0) }}<span
                                        class="text-base">/{{ $product['unit'] }}</span>
                                </p>
                            </div>

                            <div class="text-right">
                                <p class="text-xs font-extrabold uppercase tracking-[0.22em] text-mega-muted">
                                    Rating
                                </p>

                                <p class="mt-1 text-xl font-extrabold text-mega-orange">
                                    ★ {{ $product['rating'] }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <div class="mb-3 flex items-center justify-between">
                            <p class="text-base font-extrabold text-mega-black">
                                Colour
                            </p>

                            <p class="text-sm font-bold text-mega-muted" data-selected-colour-text>
                                Select colour
                            </p>
                        </div>

                        <div class="flex flex-wrap gap-3">
                            @foreach($product['colours'] as $colour)
                                <button type="button" class="product-colour-btn size-large" data-colour-button
                                    data-colour-name="{{ $colour['name'] }}" title="{{ $colour['name'] }}">
                                    <span style="background: {{ $colour['swatch'] }}"></span>
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <div class="mt-6">
                        <label class="mb-2 block text-base font-extrabold text-mega-black">
                            {{ $product['category_slug'] === 'rugs' ? 'Rug size' : 'Area size' }}
                        </label>

                        <select class="product-size-select" data-size-select disabled>
                            <option value="">Choose colour first...</option>
                            @foreach($product['sizes'] as $index => $size)
                                <option value="{{ $index }}">
                                    {{ $size['label'] }} · {{ $size['sqm'] }}m²
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="product-price-panel hidden" data-price-panel>
                        <div>
                            <p>Estimated price</p>
                            <strong data-price-text>$0.00</strong>
                        </div>

                        <div>
                            <p>Regular</p>
                            <del data-regular-text>$0.00</del>
                        </div>
                    </div>

                    <div class="mt-6 grid gap-3 sm:grid-cols-2">
                        <button type="button" class="product-quote-btn" data-add-quote disabled>
                            Add to quote
                        </button>

                        <a href="{{ route('frontend.quote') }}" class="btn-light justify-center py-4">
                            Book free measure
                        </a>
                    </div>

                    <div class="mt-6 grid gap-3 sm:grid-cols-2">
                        @foreach($product['features'] as $feature)
                            <div
                                class="rounded-[7px] border border-mega-line bg-mega-soft p-4 text-sm font-bold text-mega-text">
                                {{ $feature }}
                            </div>
                        @endforeach
                    </div>
                </aside>
            </div>
        </div>
    </section>

    @if(count($relatedProducts))
        <section class="bg-mega-cream py-12 md:py-16">
            <div class="site-container">
                <div class="mb-8 flex flex-col justify-between gap-4 md:flex-row md:items-end">
                    <div>
                        <p class="section-kicker">Similar products</p>
                        <h2 class="section-title-premium">More from {{ $product['category'] }}</h2>
                    </div>

                    <a href="{{ route('frontend.product.show', $product['category_slug']) }}" class="btn-light w-fit">
                        View all {{ $product['category'] }}
                    </a>
                </div>

                <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-4">
                    @foreach($relatedProducts as $related)
                        <article class="premium-product-card">
                            <a href="{{ route('frontend.product.show', $related['slug']) }}">
                                <img src="{{ $related['image'] }}" alt="{{ $related['name'] }}" class="h-56 w-full object-cover">
                            </a>

                            <div class="p-5">
                                <p class="text-xs font-extrabold uppercase tracking-[0.24em] text-mega-orange">
                                    {{ $related['badge'] }}
                                </p>

                                <h3 class="mt-3 text-2xl font-extrabold leading-tight text-mega-black">
                                    {{ $related['name'] }}
                                </h3>

                                <p class="mt-2 text-sm font-semibold leading-6 text-mega-muted">
                                    {{ $related['short'] }}
                                </p>

                                <a href="{{ route('frontend.product.show', $related['slug']) }}"
                                    class="mt-4 inline-flex font-extrabold text-mega-orange">
                                    Product details →
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

@endsection