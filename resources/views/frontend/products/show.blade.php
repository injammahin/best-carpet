@extends('layouts.frontend')

@section('title', $product['name'] . ' | Mega Carpets')
@section('meta_description', $product['short'] ?? $product['name'])

@section('content')

    @php
        $fullDescription = trim((string) ($product['description'] ?? ''));
        $shortDescription = trim((string) ($product['short'] ?? ''));

        if ($shortDescription === '') {
            $shortDescription = \Illuminate\Support\Str::limit($fullDescription, 190);
        }

        $descriptionPreview = \Illuminate\Support\Str::limit($fullDescription, 520);

        $gallery = $product['gallery'] ?? [];

        if (!count($gallery)) {
            $gallery = [
                $product['image'] ?? 'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?auto=format&fit=crop&w=1200&q=85',
            ];
        }

        $categoryBackUrl = route('frontend.product.show', $product['category_slug']);
    @endphp

    <section class="bg-white py-12 md:py-16">
        <div class="site-container">
            <div class="mb-8 flex flex-col justify-between gap-5 md:flex-row md:items-end">
                <div class="max-w-4xl">
                    <p class="section-kicker">
                        {{ $product['category'] }} details
                    </p>

                    <h1 class="section-title-premium max-w-4xl">
                        {{ $product['name'] }}
                    </h1>

                    <p class="section-lead max-w-3xl">
                        {{ $shortDescription }}
                    </p>

                    @if($fullDescription)
                        <button type="button" data-open-product-description
                            class="mt-5 inline-flex items-center gap-2 text-sm font-extrabold uppercase tracking-[0.16em] text-mega-orange transition hover:text-mega-black">
                            Read full product details
                            <span>→</span>
                        </button>
                    @endif
                </div>

                <a href="{{ $categoryBackUrl }}" class="btn-light w-fit">
                    Back to {{ $product['category'] }}
                </a>
            </div>

            <div class="grid gap-8 lg:grid-cols-[1.08fr_0.92fr]">
                <div>
                    <div class="product-gallery-main !rounded-[7px]" data-zoom-wrap>
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
                                {{ $shortDescription }}
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
                                    ${{ number_format((float) ($product['price_from'] ?? 0), 0) }}
                                    <span class="text-base">/{{ $product['unit'] ?? 'm²' }}</span>
                                </p>
                            </div>

                            <div class="text-right">
                                <p class="text-xs font-extrabold uppercase tracking-[0.22em] text-mega-muted">
                                    Rating
                                </p>

                                <p class="mt-1 text-xl font-extrabold text-mega-orange">
                                    ★ {{ $product['rating'] ?? '4.8' }}
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
                            @foreach(($product['colours'] ?? []) as $colour)
                                <button type="button" class="product-colour-btn size-large" data-colour-button
                                    data-colour-name="{{ $colour['name'] }}" title="{{ $colour['name'] }}">
                                    <span style="background: {{ $colour['swatch'] }}"></span>
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <div class="mt-6">
                        <label class="mb-2 block text-base font-extrabold text-mega-black">
                            {{ ($product['category_slug'] ?? '') === 'rugs' ? 'Rug size' : 'Area size' }}
                        </label>

                        <select class="product-size-select" data-size-select disabled>
                            <option value="">Choose colour first...</option>

                            @foreach(($product['sizes'] ?? []) as $index => $size)
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

                    @if(!empty($product['features']))
                        <div class="mt-6 grid gap-3 sm:grid-cols-2">
                            @foreach($product['features'] as $feature)
                                <div
                                    class="rounded-[7px] border border-mega-line bg-mega-soft p-4 text-sm font-bold text-mega-text">
                                    {{ $feature }}
                                </div>
                            @endforeach
                        </div>
                    @endif
                </aside>
            </div>
        </div>
    </section>

    @if($fullDescription)
        <section class="bg-mega-cream py-12 md:py-16">
            <div class="site-container">
                <div class="grid gap-8 lg:grid-cols-[0.8fr_1.2fr] lg:items-start">
                    <div>
                        <p class="section-kicker">
                            Product information
                        </p>

                        <h2 class="section-title-premium max-w-xl">
                            Details, texture, care and material notes.
                        </h2>

                        <p class="section-lead">
                            We moved the long description here so the top of the product page stays clean and premium.
                        </p>

                        <button type="button" data-open-product-description class="btn-primary mt-6">
                            Read full details
                            <span>→</span>
                        </button>
                    </div>

                    <div class="clean-card relative overflow-hidden bg-white p-7 md:p-8 !rounded-[7px]">
                        <div
                            class="absolute right-0 top-0 h-32 w-32 translate-x-10 -translate-y-10 rounded-full bg-mega-orange/10">
                        </div>

                        <div class="relative">
                            <div class="mb-5 flex items-center gap-3">
                                <div
                                    class="flex h-12 w-12 items-center justify-center bg-mega-orange/10 text-mega-orange radius-7">
                                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="1.6">
                                        <path d="M5 4h14v16H5z" />
                                        <path d="M8 8h8M8 12h8M8 16h5" />
                                    </svg>
                                </div>

                                <div>
                                    <p class="text-xs font-extrabold uppercase tracking-[0.22em] text-mega-orange">
                                        Full description preview
                                    </p>

                                    <h3 class="mt-1 text-2xl font-black text-mega-black">
                                        {{ $product['name'] }}
                                    </h3>
                                </div>
                            </div>

                            <p class="text-lg font-medium leading-9 text-mega-muted">
                                {{ $descriptionPreview }}
                            </p>

                            @if(strlen($fullDescription) > 520)
                                <div
                                    class="mt-6 flex flex-col gap-3 border-t border-mega-line pt-5 sm:flex-row sm:items-center sm:justify-between">
                                    <p class="text-sm font-semibold text-mega-muted">
                                        Full text available in a clean reading modal.
                                    </p>

                                    <button type="button" data-open-product-description
                                        class="font-extrabold text-mega-orange hover:text-mega-black">
                                        Continue reading →
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div data-product-description-modal class="fixed inset-0 z-[120] hidden">
            <div data-close-product-description class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>

            <div
                class="absolute left-1/2 top-1/2 flex max-h-[88vh] w-[calc(100vw-32px)] max-w-4xl -translate-x-1/2 -translate-y-1/2 flex-col overflow-hidden border border-mega-line bg-white shadow-2xl radius-7">
                <div class="shrink-0 border-b border-mega-line bg-mega-cream p-5 md:p-6">
                    <div class="flex items-start justify-between gap-5">
                        <div class="min-w-0">
                            <p class="section-kicker">
                                Product details
                            </p>

                            <h2 class="mt-2 text-3xl font-black leading-tight text-mega-black md:text-4xl">
                                {{ $product['name'] }}
                            </h2>

                            <p class="mt-3 max-w-2xl text-base font-semibold leading-7 text-mega-muted">
                                {{ $shortDescription }}
                            </p>
                        </div>

                        <button type="button" data-close-product-description
                            class="grid h-11 w-11 shrink-0 place-items-center bg-white text-2xl text-mega-black shadow-sm transition hover:bg-mega-orange hover:text-white radius-7">
                            ×
                        </button>
                    </div>
                </div>

                <div class="min-h-0 flex-1 overflow-y-auto bg-white p-5 md:p-6">
                    <div class="max-w-none">
                        @foreach(preg_split('/\r\n|\r|\n/', $fullDescription) as $paragraph)
                            @if(trim($paragraph) !== '')
                                <p class="mb-5 text-lg font-medium leading-9 text-mega-muted">
                                    {{ trim($paragraph) }}
                                </p>
                            @endif
                        @endforeach
                    </div>
                </div>

                <div class="shrink-0 border-t border-mega-line bg-white p-5">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <p class="text-sm font-semibold text-mega-muted">
                            Need help choosing this product?
                        </p>

                        <div class="flex flex-col gap-3 sm:flex-row">
                            <a href="{{ route('frontend.quote') }}" class="btn-primary justify-center">
                                Book free measure
                            </a>

                            <button type="button" data-close-product-description class="btn-light justify-center">
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if(count($relatedProducts))
        <section class="bg-white py-12 md:py-16">
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.querySelector('[data-product-description-modal]');
            const openButtons = document.querySelectorAll('[data-open-product-description]');
            const closeButtons = document.querySelectorAll('[data-close-product-description]');

            openButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    if (!modal) {
                        return;
                    }

                    modal.classList.remove('hidden');
                    document.body.classList.add('overflow-hidden');
                });
            });

            closeButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    if (!modal) {
                        return;
                    }

                    modal.classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                });
            });

            document.addEventListener('keydown', function (event) {
                if (event.key === 'Escape' && modal && !modal.classList.contains('hidden')) {
                    modal.classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                }
            });
        });
    </script>

@endsection