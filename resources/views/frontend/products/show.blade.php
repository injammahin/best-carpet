@extends('layouts.frontend')

@section('title', $product['name'] . ' | Mega Carpets')
@section('meta_description', $product['short'] ?? $product['name'])

@section('content')

    @php
        $gallery = $product['gallery'] ?? [];

        if (!count($gallery)) {
            $gallery = [
                $product['image'] ?? 'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?auto=format&fit=crop&w=1200&q=85',
            ];
        }

        $categoryBackUrl = route('frontend.product.show', $product['category_slug']);

        $onlyLabelMap = [
            'carpet' => 'Carpet Only',
            'timber' => 'Timber Only',
            'hybrid-flooring' => 'Hybrid Flooring Only',
            'laminate' => 'Laminate Only',
            'vinyl' => 'Vinyl Only',
            'rugs' => 'Rug Only',
        ];

        $onlyLabel = $onlyLabelMap[$product['category_slug'] ?? ''] ?? (($product['category'] ?? 'Product') . ' Only');

        $quoteData = [
            'id' => $product['id'] ?? $product['slug'],
            'name' => $product['name'],
            'category' => $product['category'],
            'slug' => $product['slug'],
            'image' => $product['image'],
            'sizes' => $product['sizes'] ?? [],
        ];
    @endphp

    <style>
        .product-detail-main-section {
            padding-top: 48px;
            padding-bottom: 26px;
        }

        .detail-gallery-main {
            height: 560px;
        }

        .detail-gallery-main img {
            height: 100%;
            width: 100%;
            object-fit: cover;
        }

        .detail-price-card {
            border-radius: 7px;
            background: #f4eee7;
            padding: 18px;
        }

        .detail-price-row {
            display: flex;
            flex-wrap: wrap;
            align-items: end;
            gap: 12px;
        }

        .detail-main-price {
            color: #070707;
            font-size: 38px;
            font-weight: 900;
            line-height: 1;
            letter-spacing: -0.06em;
        }

        .detail-main-price span {
            font-size: 20px;
            font-weight: 900;
            letter-spacing: -0.03em;
        }

        .dynamic-only-badge {
            display: inline-flex;
            align-items: center;
            border: 1px solid #eadfd6;
            border-radius: 999px;
            background: #ffffff;
            padding: 9px 13px;
            color: #ff5a00;
            font-size: 12px;
            font-weight: 900;
            letter-spacing: 0.12em;
            line-height: 1;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .detail-price-panel strong {
            color: #070707;
            font-size: 28px;
            font-weight: 900;
            letter-spacing: -0.04em;
        }

        .related-products-section {
            padding-top: 26px;
            padding-bottom: 56px;
        }

        .related-product-card {
            height: 100%;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .related-product-card-image {
            height: 224px;
            width: 100%;
            object-fit: cover;
        }

        .related-product-card-body {
            flex: 1;
            display: flex;
            flex-direction: column;
            padding: 20px;
        }

        .related-product-title {
            min-height: 68px;
        }

        .related-product-description {
            min-height: 52px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .related-product-link {
            margin-top: auto;
            padding-top: 18px;
        }

        @media (max-width: 1023px) {
            .detail-gallery-main {
                height: 440px;
            }
        }

        @media (max-width: 640px) {
            .product-detail-main-section {
                padding-top: 34px;
                padding-bottom: 18px;
            }

            .detail-gallery-main {
                height: 360px;
            }

            .detail-main-price {
                font-size: 32px;
            }
        }
    </style>

    <section class="bg-white product-detail-main-section">
        <div class="site-container">
            <div class="mb-8 flex flex-col justify-between gap-5 md:flex-row md:items-end">
                <div class="max-w-4xl">
                    <p class="section-kicker">
                        {{ $product['category'] }} details
                    </p>

                    <h1 class="section-title-premium max-w-4xl">
                        {{ $product['name'] }}
                    </h1>
                </div>

                <a href="{{ $categoryBackUrl }}" class="btn-light w-fit">
                    Back to {{ $product['category'] }}
                </a>
            </div>

            <div class="grid gap-8 lg:grid-cols-[1.08fr_0.92fr] lg:items-start">
                <div>
                    <div class="product-gallery-main detail-gallery-main !rounded-[7px]" data-zoom-wrap>
                        <img src="{{ $gallery[0] }}" alt="{{ $product['name'] }}" data-main-image>

                        <div class="product-gallery-badge">
                            Hover image to zoom
                        </div>
                    </div>

                    @if(count($gallery) > 1)
                        <div class="mt-4 grid grid-cols-4 gap-3">
                            @foreach($gallery as $image)
                                <button type="button" class="product-thumb-btn" data-gallery-thumb data-image="{{ $image }}">
                                    <img src="{{ $image }}" alt="{{ $product['name'] }} thumbnail">
                                </button>
                            @endforeach
                        </div>
                    @endif
                </div>

                <aside class="product-detail-card" data-product-card
                    data-product='@json($quoteData, JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_SLASHES)'>
                    <div class="mb-5 flex items-start justify-between gap-4">
                        <div>
                            <p class="text-xs font-extrabold uppercase tracking-[0.24em] text-mega-orange">
                                {{ $product['category'] }}
                            </p>

                            <h2 class="mt-3 text-2xl font-bold leading-tight tracking-[-0.05em] text-mega-black">
                                {{ $product['name'] }}
                            </h2>
                        </div>

                        <button type="button" class="wishlist-float static" data-product-wishlist aria-label="Save product">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path
                                    d="M20.8 5.6c-1.6-1.8-4.2-1.9-5.9-.2L12 8.3 9.1 5.4C7.4 3.7 4.8 3.8 3.2 5.6c-1.7 2-1.5 5 .4 6.9L12 21l8.4-8.5c1.9-1.9 2.1-4.9.4-6.9z" />
                            </svg>
                        </button>
                    </div>

                    <div class="detail-price-card">
                        <p class="text-xs font-extrabold uppercase tracking-[0.22em] text-mega-muted">
                            From
                        </p>

                        <div class="detail-price-row mt-2">
                            <p class="detail-main-price">
                                ${{ number_format((float) ($product['price_from'] ?? 0), 0) }}
                                <span>/{{ $product['unit'] ?? 'm²' }}</span>
                            </p>

                            <span class="dynamic-only-badge">
                                {{ $onlyLabel }}
                            </span>
                        </div>
                    </div>

                    <div class="mt-6">
                        <label class="mb-2 block text-base font-extrabold text-mega-black">
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

                    <div class="product-price-panel detail-price-panel hidden" data-price-panel>
                        <div>
                            <p>Rough estimate</p>
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
                </aside>
            </div>
        </div>
    </section>

    @if(count($relatedProducts))
        <section class="bg-white related-products-section">
            <div class="site-container">
                <div class="mb-8 flex flex-col justify-between gap-4 md:flex-row md:items-end">
                    <div>
                        <p class="section-kicker">
                            Similar products
                        </p>

                        <h2 class="section-title-premium">
                            More from {{ $product['category'] }}
                        </h2>
                    </div>

                    <a href="{{ $categoryBackUrl }}" class="btn-light w-fit">
                        View all {{ $product['category'] }}
                    </a>
                </div>

                <div class="grid items-stretch gap-6 md:grid-cols-2 xl:grid-cols-4">
                    @foreach($relatedProducts as $related)
                        <article class="premium-product-card related-product-card">
                            <a href="{{ route('frontend.product.show', $related['slug']) }}">
                                <img src="{{ $related['image'] }}" alt="{{ $related['name'] }}" class="related-product-card-image">
                            </a>

                            <div class="related-product-card-body">
                                <p class="text-xs font-extrabold uppercase tracking-[0.24em] text-mega-orange">
                                    {{ $related['badge'] }}
                                </p>

                                <h3 class="related-product-title mt-3 text-2xl font-extrabold leading-tight text-mega-black">
                                    {{ $related['name'] }}
                                </h3>

                                <p class="related-product-description mt-2 text-sm font-semibold leading-6 text-mega-muted">
                                    {{ $related['short'] }}
                                </p>

                                <a href="{{ route('frontend.product.show', $related['slug']) }}"
                                    class="related-product-link inline-flex font-extrabold text-mega-orange">
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