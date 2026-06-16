@extends('layouts.frontend')

@section('title', ($activeCategory['name'] ?? 'Products') . ' | Mega Carpets')
@section('meta_description', 'Browse Mega Carpets products by category, type, room and size.')

@section('content')

    <section class="bg-mega-cream py-12 md:py-16">
        <div class="site-container">
            <div class="grid gap-8 lg:grid-cols-[0.95fr_1.05fr] lg:items-end">
                <div>
                    <p class="section-kicker">
                        {{ $activeCategory ? 'Shop ' . $activeCategory['name'] : 'Product catalogue' }}
                    </p>

                    <h1 class="section-title-premium max-w-4xl">
                        {{ $activeCategory ? $activeCategory['name'] . ' products' : 'Shop carpets, rugs and flooring.' }}
                    </h1>

                    <p class="section-lead">
                        {{ $activeCategory['short'] ?? 'Choose a size in square metres, view the rough estimate, save favourites and request a quote.' }}
                    </p>
                </div>

                <form method="GET"
                    action="{{ $activeCategorySlug ? route('frontend.product.show', $activeCategorySlug) : route('frontend.products') }}"
                    class="premium-filter-search">
                    <div class="grid gap-3 sm:grid-cols-[1fr_190px_auto]">
                        <input type="search" name="q" value="{{ $search }}" class="input-clean"
                            placeholder="Search product, room, type...">

                        <select name="category" class="input-clean"
                            onchange="if(this.value){ window.location='{{ url('/products') }}/' + this.value }">
                            <option value="">All products</option>

                            @foreach($categories as $category)
                                <option value="{{ $category['slug'] }}" @selected($activeCategorySlug === $category['slug'])>
                                    {{ $category['name'] }}
                                </option>
                            @endforeach
                        </select>

                        <button type="submit" class="btn-primary">
                            Filter
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <section class="bg-white py-12 md:py-16">
        <div class="site-container">
            <div class="grid gap-8 lg:grid-cols-[320px_1fr]">
                <aside class="premium-filter-sidebar">
                    <div class="filter-card">
                        <div class="filter-card-head">
                            <h2>Filter by</h2>

                            @if(request()->query())
                                <a
                                    href="{{ $activeCategorySlug ? route('frontend.product.show', $activeCategorySlug) : route('frontend.products') }}">
                                    Clear
                                </a>
                            @endif
                        </div>

                        <form method="GET"
                            action="{{ $activeCategorySlug ? route('frontend.product.show', $activeCategorySlug) : route('frontend.products') }}">
                            @if($search)
                                <input type="hidden" name="q" value="{{ $search }}">
                            @endif

                            <div class="filter-block">
                                <details open>
                                    <summary>
                                        {{ $activeCategorySlug === 'rugs' ? 'Rug Size' : 'Size / Area' }}
                                        <span>⌃</span>
                                    </summary>

                                    <div class="filter-options">
                                        @foreach($filterOptions['size_group'] as $option)
                                            <label class="filter-check">
                                                <input type="checkbox" name="size_group[]" value="{{ $option['label'] }}"
                                                    @checked(in_array($option['label'], $activeFilters['size_group'], true))>
                                                <span>{{ $option['label'] }}</span>
                                                <em>({{ $option['count'] }})</em>
                                            </label>
                                        @endforeach
                                    </div>
                                </details>
                            </div>

                            <div class="filter-block">
                                <details open>
                                    <summary>
                                        Type
                                        <span>⌃</span>
                                    </summary>

                                    <div class="filter-options">
                                        @foreach($filterOptions['type'] as $option)
                                            <label class="filter-check">
                                                <input type="checkbox" name="type[]" value="{{ $option['label'] }}"
                                                    @checked(in_array($option['label'], $activeFilters['type'], true))>
                                                <span>{{ $option['label'] }}</span>
                                                <em>({{ $option['count'] }})</em>
                                            </label>
                                        @endforeach
                                    </div>
                                </details>
                            </div>

                            <div class="filter-block">
                                <details>
                                    <summary>
                                        Room
                                        <span>⌃</span>
                                    </summary>

                                    <div class="filter-options">
                                        @foreach($filterOptions['room'] as $option)
                                            <label class="filter-check">
                                                <input type="checkbox" name="room[]" value="{{ $option['label'] }}"
                                                    @checked(in_array($option['label'], $activeFilters['room'], true))>
                                                <span>{{ $option['label'] }}</span>
                                                <em>({{ $option['count'] }})</em>
                                            </label>
                                        @endforeach
                                    </div>
                                </details>
                            </div>

                            <button type="submit" class="btn-primary mt-5 w-full">
                                Apply filters
                            </button>
                        </form>
                    </div>
                </aside>

                <div>
                    <div class="mb-6 flex flex-col justify-between gap-4 md:flex-row md:items-center">
                        <div
                            class="inline-flex w-fit items-center gap-3 bg-mega-cream px-4 py-3 text-sm font-extrabold text-mega-black radius-7">
                            <svg class="h-4 w-4 text-mega-orange" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.7">
                                <path d="M4 7h16M7 12h10M10 17h4" />
                            </svg>

                            {{ count($products) }} products showing
                        </div>

                        <a href="{{ route('frontend.quote') }}"
                            class="text-sm font-extrabold text-mega-orange hover:text-mega-orangeDark">
                            Need help choosing? Book consultation →
                        </a>
                    </div>

                    @if(count($products))
                        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                            @foreach($products as $product)
                                @php
                                    $quoteData = [
                                        'id' => $product['id'] ?? $product['slug'],
                                        'name' => $product['name'],
                                        'category' => $product['category'],
                                        'slug' => $product['slug'],
                                        'image' => $product['image'],
                                        'sizes' => $product['sizes'] ?? [],
                                    ];
                                @endphp

                                <article class="premium-product-card" data-product-card
                                    data-product='@json($quoteData, JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_SLASHES)'>
                                    <div class="relative h-64 overflow-hidden bg-mega-soft">
                                        <a href="{{ route('frontend.product.show', $product['slug']) }}">
                                            <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}"
                                                class="h-full w-full object-cover transition duration-500 hover:scale-105">
                                        </a>

                                        <button type="button" class="wishlist-float" data-product-wishlist
                                            aria-label="Save product">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                <path
                                                    d="M20.8 5.6c-1.6-1.8-4.2-1.9-5.9-.2L12 8.3 9.1 5.4C7.4 3.7 4.8 3.8 3.2 5.6c-1.7 2-1.5 5 .4 6.9L12 21l8.4-8.5c1.9-1.9 2.1-4.9.4-6.9z" />
                                            </svg>
                                        </button>
                                    </div>

                                    <div class="p-5">
                                        <div class="mb-4 flex items-center justify-between gap-4">
                                            <span
                                                class="rounded-full bg-orange-50 px-3 py-1.5 text-xs font-extrabold text-mega-orange">
                                                {{ $product['badge'] }}
                                            </span>

                                            <span class="text-xs font-extrabold uppercase tracking-[0.24em] text-mega-muted">
                                                {{ $product['category'] }}
                                            </span>
                                        </div>

                                        <h2
                                            class="min-h-[64px] text-2xl font-extrabold leading-tight tracking-[-0.04em] text-mega-black">
                                            <a href="{{ route('frontend.product.show', $product['slug']) }}"
                                                class="hover:text-mega-orange">
                                                {{ $product['name'] }}
                                            </a>
                                        </h2>

                                        <div class="mt-5">
                                            <label class="mb-2 block text-sm font-extrabold text-mega-black">
                                                {{ ($product['category_slug'] ?? '') === 'rugs' ? 'Rug size' : 'Area size' }}
                                            </label>

                                            <select class="product-size-select" data-size-select>
                                                <option value="">Choose a size for rough estimate...</option>

                                                @foreach(($product['sizes'] ?? []) as $index => $size)
                                                    <option value="{{ $index }}" data-label="{{ $size['label'] ?? '' }}"
                                                        data-sqm="{{ $size['sqm'] ?? '' }}" data-price="{{ $size['price'] ?? 0 }}"
                                                        data-regular-price="{{ $size['regular_price'] ?? ($size['regular'] ?? 0) }}">
                                                        {{ $size['label'] ?? 'Size' }} · {{ $size['sqm'] ?? 0 }}m²
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="product-price-panel hidden" data-price-panel>
                                            <div>
                                                <p>Rough estimate</p>
                                                <strong data-price-text>$0.00</strong>
                                            </div>

                                            <div>
                                                <p>Regular</p>
                                                <del data-regular-text>$0.00</del>
                                            </div>
                                        </div>

                                        <div class="mt-5 grid grid-cols-[1fr_52px] gap-3">
                                            <button type="button" class="product-quote-btn" data-add-quote disabled>
                                                Add to quote
                                            </button>

                                            <a href="{{ route('frontend.product.show', $product['slug']) }}"
                                                class="product-view-btn" aria-label="View product details">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                    <path d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12z" />
                                                    <circle cx="12" cy="12" r="3" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    @else
                        <div class="premium-empty-state">
                            <h2>No products found.</h2>
                            <p>Try clearing filters or browse all product ranges.</p>
                            <a href="{{ route('frontend.products') }}" class="btn-primary mt-5">
                                View all products
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

@endsection