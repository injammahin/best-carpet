@extends('layouts.frontend')

@section('title', 'Mega Carpets | Premium Carpet, Vinyl, Timber & Rugs')
@section('meta_description', 'Premium flooring showroom for carpet, vinyl, timber, laminate and rugs with free measure and quote.')

@section('content')

    @php
        $services = $services ?? [
            [
                'title' => 'Free Measure & Quote',
                'text' => 'Customers submit room details and the team follows up with accurate quote support.',
            ],
            [
                'title' => 'Design Consultation',
                'text' => 'Guide buyers by room, colour, material, durability, budget and style direction.',
            ],
            [
                'title' => 'Supply & Installation',
                'text' => 'Position Mega Carpets as a complete flooring partner from selection to installation.',
            ],
            [
                'title' => 'Commercial Flooring',
                'text' => 'Business-ready carpet, vinyl and laminate options for offices, shops and rentals.',
            ],
        ];
        $homeSetting = $homeSetting ?? \App\Models\HomePageSetting::query()->firstOrCreate([], \App\Models\HomePageSetting::defaultData());

        $heroSlides = $homeSetting->heroSlidesForView();

        $heroSideImageOne = $homeSetting->imageUrl(
            $homeSetting->hero_side_image_one,
            '/images/Mega small van wrap idea.png'
        );

        $heroSideImageTwo = $homeSetting->imageUrl(
            $homeSetting->hero_side_image_two,
            '/images/mega man logo.png'
        );

        $heroCardKicker = $homeSetting->hero_card_kicker ?: 'Premium demo ready';
        $heroCardText = $homeSetting->hero_card_text ?: 'A quote-first showroom experience for serious flooring buyers.';

        $visualizerImage = $homeSetting->imageUrl(
            $homeSetting->visualizer_image,
            'https://images.unsplash.com/photo-1600121848594-d8644e57abab?auto=format&fit=crop&w=1500&q=85'
        );

        $visualizerKicker = $homeSetting->visualizer_kicker ?: 'Room visualiser concept';
        $visualizerTitle = $homeSetting->visualizer_title ?: 'Let customers imagine the floor before they book.';
        $visualizerText = $homeSetting->visualizer_text ?: 'Customers can compare colour direction, save favourites and move toward quote request.';
        $visualizerFeatures = $homeSetting->visualizerFeaturesForView();

        $shopRoomImage = $homeSetting->imageUrl(
            $homeSetting->shop_room_image,
            '/images/Timber Flooring Pic -2 .webp'
        );

        $shopRoomKicker = $homeSetting->shop_room_kicker ?: 'Shop the room';
        $shopRoomTitle = $homeSetting->shop_room_title ?: 'A premium inspiration block like a real showroom catalogue.';
        $shopRoomText = $homeSetting->shop_room_text ?: 'Connect product discovery with full-room ideas so the website feels more useful and premium.';
        $roomItems = $homeSetting->shopRoomItemsForView();

        $projects = $homeSetting->recentWorkForView();

        $quoteImage = $homeSetting->imageUrl(
            $homeSetting->quote_image,
            '/images/Mega small van wrap idea.png'
        );

        $quoteKicker = $homeSetting->quote_kicker ?: 'Book a free consultation';
        $quoteTitle = $homeSetting->quote_title ?: 'Request a measure, quote or product advice.';
        $quoteText = $homeSetting->quote_text ?: 'Submit your flooring details and our team will follow up with quote support.';
        $quotePhone = $homeSetting->quote_phone ?: '1300 131 196';

        $categories = $categories ?? [];
        $products = $products ?? [];
        $reviews = $reviews ?? collect();
        $faqs = $faqs ?? collect();

        $brandVan = $quoteImage;
    @endphp

    <section id="top" data-hero-slider class="premium-hero">
        <div class="premium-hero-bg-layer">
            @foreach($heroSlides as $index => $slide)
                <img src="{{ $slide['image'] }}" alt="{{ $slide['title'] }}"
                    class="premium-hero-bg {{ $index === 0 ? 'is-active' : '' }}" data-hero-image="{{ $index }}">
            @endforeach

            <div class="premium-hero-overlay"></div>
            <div class="premium-hero-warm-glow"></div>
        </div>

        <div class="premium-hero-content">
            <div class="premium-hero-copy">
                @foreach($heroSlides as $index => $slide)
                    <div class="premium-hero-text {{ $index === 0 ? 'is-active' : '' }}" data-slide-content="{{ $index }}">
                        <div class="premium-hero-badge">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path d="M12 2l2.1 6.4H21l-5.5 4 2.1 6.6-5.6-4.1L6.4 19l2.1-6.6L3 8.4h6.9L12 2z" />
                            </svg>

                            {{ $slide['eyebrow'] }}
                        </div>

                        <h1>
                            {{ $slide['title'] }}
                        </h1>

                        <p>
                            {{ $slide['text'] }}
                        </p>
                    </div>
                @endforeach

                <div class="premium-hero-actions">
                    <a href="#quote" class="btn-primary">
                        Book a free consultation
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                            <path d="M5 12h14" />
                            <path d="M13 6l6 6-6 6" />
                        </svg>
                    </a>

                    <a href="#products" class="premium-hero-secondary-btn">
                        Explore flooring ranges
                    </a>
                </div>

                <div class="premium-hero-stats">
                    <div>
                        <strong>4</strong>
                        <span>Core flooring categories</span>
                    </div>

                    <div>
                        <strong>24h</strong>
                        <span>Quote follow-up</span>
                    </div>

                    <div>
                        <strong>0</strong>
                        <span>Checkout confusion</span>
                    </div>
                </div>
            </div>

            <div class="premium-hero-visual">
                <div class="premium-hero-van-card">
                    <img src="{{ $heroSideImageOne }}" alt="Mega Carpets mobile showroom">

                    <div class="premium-hero-tabs">
                        <span>Mega Range</span>
                        <span>Mega Service</span>
                        <span>Mega Value</span>
                    </div>
                </div>

                {{-- <div class="premium-hero-mascot-card">
                    <img src="{{ $heroSideImageTwo }}" alt="Mega Carpets flooring specialist">
                </div>

                <div class="premium-hero-message-card">
                    <p>{{ $heroCardKicker }}</p>
                    <h3>{{ $heroCardText }}</h3>
                </div> --}}
            </div>
        </div>

        <div class="premium-hero-controls">
            <button type="button" data-hero-prev aria-label="Previous slide">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path d="M15 18l-6-6 6-6" />
                </svg>
            </button>

            <div>
                @foreach($heroSlides as $index => $slide)
                    <button type="button" class="premium-hero-dot {{ $index === 0 ? 'is-active' : '' }}"
                        data-hero-dot="{{ $index }}" aria-label="Go to slide {{ $index + 1 }}"></button>
                @endforeach
            </div>

            <button type="button" data-hero-next aria-label="Next slide">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path d="M9 18l6-6-6-6" />
                </svg>
            </button>
        </div>
    </section>

    <section id="collections" class="bg-white py-20">
        <div class="site-container">
            <div class="mx-auto mb-10 max-w-3xl text-center">
                <p class="section-kicker">Shop by category</p>
                <h2 class="section-title-premium">A clean flooring catalogue for serious buyers.</h2>
                <p class="mx-auto section-lead">Each category sends visitors to the proper product page instead of keeping
                    them on the homepage.</p>
            </div>

            <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">
                @foreach($categories as $category)
                    <a href="{{ route('frontend.product.show', $category['slug']) }}"
                        class="group overflow-hidden bg-white shadow-soft transition hover:-translate-y-1 hover:shadow-premium radius-7">
                        <div class="relative h-56 overflow-hidden">
                            <img src="{{ $category['image'] }}" alt="{{ $category['name'] }}"
                                class="h-full w-full object-cover transition duration-500 group-hover:scale-105">

                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>

                            <div
                                class="absolute bottom-4 left-4 grid h-12 w-12 place-items-center bg-mega-orange text-white shadow-lg radius-7">
                                <svg class="h-6 w-6 thin-home-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path d="M5 7h14" />
                                    <path d="M5 12h14" />
                                    <path d="M5 17h14" />
                                </svg>
                            </div>
                        </div>

                        <div class="p-5">
                            <h3 class="text-2xl font-semibold uppercase tracking-[0.08em] text-mega-black">
                                {{ $category['name'] }}
                            </h3>

                            <p class="mt-2 min-h-16 text-sm font-normal leading-6 text-mega-muted">
                                {{ $category['text'] }}
                            </p>

                            <span class="mt-5 inline-flex items-center gap-2 text-sm font-semibold text-mega-orange">
                                View products <span>→</span>
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section id="visualizer" class="bg-[#f7f3ed] py-20">
        <div class="site-container grid items-center gap-10 lg:grid-cols-[.85fr_1.15fr]">
            <div>
                <p class="section-kicker">{{ $visualizerKicker }}</p>
                <h2 class="section-title-premium max-w-xl">{{ $visualizerTitle }}</h2>
                <p class="section-lead">
                    {{ $visualizerText }}
                </p>

                <div class="mt-8 grid gap-3 sm:grid-cols-2">
                    @foreach($visualizerFeatures as $item)
                        <div class="flex items-center gap-3 bg-white p-4 shadow-sm radius-7">
                            <span class="text-mega-orange">✓</span>
                            <span class="font-medium text-mega-black">{{ $item }}</span>
                        </div>
                    @endforeach
                </div>

                <a href="#quote" class="btn-primary mt-7">
                    Start with a free quote <span>→</span>
                </a>
            </div>

            <div class="relative overflow-hidden bg-white p-3 shadow-premium radius-7">
                <img src="{{ $visualizerImage }}" alt="Room visualiser" class="h-[520px] w-full object-cover radius-7">

                <button
                    class="absolute right-[18%] top-[16%] grid h-12 w-12 place-items-center rounded-full border-[10px] border-white bg-mega-orange shadow-soft"
                    aria-label="Visualizer hotspot">
                    <span class="h-2.5 w-2.5 rounded-full bg-white"></span>
                </button>

                <button
                    class="absolute right-[28%] top-[52%] grid h-12 w-12 place-items-center rounded-full border-[10px] border-white bg-mega-orange shadow-soft"
                    aria-label="Visualizer hotspot">
                    <span class="h-2.5 w-2.5 rounded-full bg-white"></span>
                </button>

                <div class="absolute bottom-7 left-7 max-w-sm bg-white/75 p-5 shadow-xl backdrop-blur-md radius-7">
                    <p class="text-xs font-medium uppercase tracking-[0.2em] text-mega-orange">Featured room</p>
                    <h3 class="mt-2 text-2xl font-semibold tracking-tight text-mega-black">Retreat Home Look</h3>
                    <p class="mt-2 text-sm font-normal leading-6 text-mega-muted">
                        Warm timber, soft rug texture and neutral curtains for a calm premium space.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section id="products" class="bg-white py-16" data-home-products>
        @php
            $defaultHomeCategorySlug = $defaultHomeCategorySlug ?? (($homeFilterCategories[0]['slug'] ?? null));
            $defaultHomeCategoryName = $defaultHomeCategoryName ?? (($homeFilterCategories[0]['name'] ?? 'Products'));

            $homeProductSets = [];

            foreach (($categoryProductGroups ?? []) as $categorySlug => $categoryProducts) {
                $homeProductSets[$categorySlug] = $categoryProducts;
            }

            $homeRoomOptions = collect($homeProductSets)
                ->flatMap(fn($items) => $items)
                ->pluck('room')
                ->filter()
                ->unique()
                ->sort()
                ->values();

            $totalInitialProducts = count($homeProductSets[$defaultHomeCategorySlug] ?? []);
        @endphp

        <div class="site-container">
            <div class="mb-8 grid gap-6 lg:grid-cols-[1fr_620px] lg:items-end">
                <div class="max-w-3xl">
                    <p class="section-kicker">Featured products</p>

                    <h2 class="section-title-premium">
                        Select colour, choose type and see the price.
                    </h2>

                    <p class="section-lead">
                        Browse selected {{ $defaultHomeCategoryName }} ranges, compare colours, check indicative pricing and
                        save your favourites before booking a free measure and quote.
                    </p>
                </div>

                <div class="border border-mega-line bg-white p-4 shadow-soft radius-7">
                    <div class="grid gap-3 sm:grid-cols-[1fr_180px_160px]">
                        <div class="relative">
                            <svg class="pointer-events-none absolute left-4 top-1/2 h-4 w-4 -translate-y-1/2 text-mega-muted thin-home-icon"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <circle cx="11" cy="11" r="7" />
                                <path d="M20 20l-3.5-3.5" />
                            </svg>

                            <input data-home-product-search type="search" placeholder="Search products..."
                                class="input-clean pl-11">
                        </div>

                        <select data-home-category-filter class="input-clean">
                            @foreach(($homeFilterCategories ?? []) as $category)
                                <option value="{{ $category['slug'] }}" @selected($category['slug'] === $defaultHomeCategorySlug)>
                                    {{ $category['name'] }}
                                </option>
                            @endforeach
                        </select>

                        <select data-home-room-filter class="input-clean">
                            <option value="all">All Rooms</option>

                            @foreach($homeRoomOptions as $roomName)
                                <option value="{{ $roomName }}">
                                    {{ $roomName }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="mb-6 flex items-center justify-between gap-4">
                <div
                    class="inline-flex items-center gap-2 bg-[#f7f3ed] px-4 py-2 text-sm font-medium text-mega-text radius-7">
                    <svg class="h-4 w-4 text-mega-orange thin-home-icon" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor">
                        <path d="M4 7h16" />
                        <path d="M7 12h10" />
                        <path d="M10 17h4" />
                    </svg>

                    <span data-home-product-count>
                        {{ $totalInitialProducts }} products showing
                    </span>
                </div>

                <a href="{{ route('frontend.quote') }}" class="hidden text-sm font-medium text-mega-orange md:inline-flex">
                    Need help choosing? Book consultation →
                </a>
            </div>

            <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-4">
                @foreach($homeProductSets as $setKey => $setProducts)
                    @foreach($setProducts as $product)
                        @php
                            $quoteData = [
                                'id' => $product['id'],
                                'name' => $product['name'],
                                'category' => $product['category'],
                                'slug' => $product['slug'],
                                'image' => $product['image'],
                            ];
                        @endphp

                        <article data-product-card data-home-product-card data-home-set="{{ $setKey }}"
                            data-product-id="{{ $product['id'] }}" data-category="{{ $product['category'] }}"
                            data-category-slug="{{ $product['category_slug'] ?? '' }}" data-room="{{ $product['room'] }}"
                            data-search="{{ strtolower($product['name'] . ' ' . $product['category'] . ' ' . $product['room'] . ' ' . $product['tag']) }}"
                            data-product='@json($quoteData, JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_SLASHES)'
                            data-variants='@json($product['variants'], JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_SLASHES)'
                            class="premium-card flooring-product-card group overflow-hidden"
                            style="{{ $setKey !== $defaultHomeCategorySlug ? 'display:none;' : '' }}">
                            <div class="relative h-44 overflow-hidden bg-mega-soft">
                                <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}"
                                    class="h-full w-full object-cover transition duration-500 group-hover:scale-105">

                                <div
                                    class="absolute left-3 top-3 flex items-center gap-2 bg-white/92 px-3 py-1.5 text-xs font-medium text-mega-black shadow-sm backdrop-blur radius-7">
                                    <svg class="h-3.5 w-3.5 fill-mega-orange text-mega-orange" viewBox="0 0 24 24"
                                        fill="currentColor">
                                        <path d="M12 2l2.7 6.8L22 9.3l-5.6 4.7 1.8 7L12 17.2 5.8 21l1.8-7L2 9.3l7.3-.5L12 2z" />
                                    </svg>

                                    <span>{{ $product['rating'] }}</span>
                                </div>

                                <button type="button"
                                    class="wishlist-toggle absolute right-3 top-3 grid h-9 w-9 place-items-center bg-white/92 text-mega-black shadow-sm backdrop-blur transition hover:text-mega-orange radius-7"
                                    data-wishlist-button data-product-id="{{ $product['id'] }}" aria-label="Save favourite">
                                    <svg class="h-5 w-5 thin-home-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path
                                            d="M20.8 5.6c-1.6-1.8-4.2-1.9-5.9-.2L12 8.3 9.1 5.4C7.4 3.7 4.8 3.8 3.2 5.6c-1.7 2-1.5 5 .4 6.9L12 21l8.4-8.5c1.9-1.9 2.1-4.9.4-6.9z" />
                                    </svg>
                                </button>
                            </div>

                            <div class="p-4">
                                <div class="mb-3 flex items-center justify-between gap-3">
                                    <span
                                        class="max-w-[150px] truncate rounded-full bg-mega-orange/10 px-3 py-1 text-xs font-medium text-mega-orange">
                                        {{ $product['tag'] }}
                                    </span>

                                    <span class="text-xs font-medium uppercase tracking-[0.18em] text-mega-muted">
                                        {{ $product['category'] }}
                                    </span>
                                </div>

                                <h3
                                    class="min-h-[48px] text-xl font-semibold uppercase leading-tight tracking-[-0.04em] text-mega-black">
                                    {{ $product['name'] }}
                                </h3>

                                <div class="mt-3">
                                    <div class="mb-2 flex items-center justify-between">
                                        <p class="text-sm font-medium text-mega-text">
                                            Colour
                                        </p>

                                        <p class="text-xs font-medium text-mega-muted" data-selected-colour>
                                            Select colour
                                        </p>
                                    </div>

                                    <div class="flex flex-wrap gap-2" data-colour-list>
                                        @foreach($product['variants'] as $index => $variant)
                                            <button type="button" data-colour-index="{{ $index }}"
                                                data-colour-name="{{ $variant['name'] }}"
                                                class="colour-choice h-8 w-8 border border-mega-line shadow-inner radius-7"
                                                style="background-color: {{ $variant['swatch'] }}"
                                                aria-label="{{ $variant['name'] }}"></button>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <p class="mb-2 text-sm font-medium text-mega-text">
                                        Type
                                    </p>

                                    <div class="grid gap-2" data-type-list>
                                        <button type="button"
                                            class="type-placeholder input-clean cursor-not-allowed py-3 text-left text-sm opacity-60"
                                            disabled>
                                            Choose colour first
                                        </button>
                                    </div>
                                </div>

                                <div class="mt-4 bg-[#f7f3ed] p-3 radius-7">
                                    <div class="flex items-center justify-between gap-3">
                                        <div>
                                            <p class="text-[10px] font-medium uppercase tracking-[0.16em] text-mega-muted">
                                                Indicative price
                                            </p>

                                            <p class="text-xl font-semibold leading-tight text-mega-black" data-price-output>
                                                Select options
                                            </p>
                                        </div>

                                        <span
                                            class="max-w-[110px] truncate bg-white px-3 py-2 text-xs font-medium text-mega-text radius-7">
                                            {{ $product['room'] }}
                                        </span>
                                    </div>
                                </div>

                                <div class="mt-4 grid grid-cols-[1fr_auto] gap-3">
                                    <button type="button" data-add-quote
                                        class="btn-primary w-full justify-center py-3 text-sm opacity-60" disabled>
                                        Add to quote
                                    </button>

                                    <a href="{{ route('frontend.product.show', $product['slug']) }}"
                                        class="inline-flex h-11 w-11 items-center justify-center border border-mega-line text-mega-black transition hover:border-mega-orange hover:text-mega-orange radius-7"
                                        aria-label="View product">
                                        <svg class="h-5 w-5 thin-home-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                            <circle cx="12" cy="12" r="3" />
                                            <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                @endforeach

                <div data-home-empty-products style="display:none;"
                    class="col-span-full rounded-[7px] border border-mega-line bg-mega-soft p-10 text-center">
                    <h3 class="text-2xl font-semibold text-mega-black">
                        No products found.
                    </h3>

                    <p class="mt-2 text-mega-muted">
                        Try another category, room, or search keyword.
                    </p>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const section = document.querySelector('[data-home-products]');

                if (!section) {
                    return;
                }

                const categoryFilter = section.querySelector('[data-home-category-filter]');
                const roomFilter = section.querySelector('[data-home-room-filter]');
                const searchInput = section.querySelector('[data-home-product-search]');
                const countText = section.querySelector('[data-home-product-count]');
                const emptyState = section.querySelector('[data-home-empty-products]');
                const cards = Array.from(section.querySelectorAll('[data-home-product-card]'));

                function applyHomeProductFilters() {
                    const selectedSet = categoryFilter?.value || '';
                    const selectedRoom = roomFilter?.value || 'all';
                    const searchTerm = (searchInput?.value || '').trim().toLowerCase();

                    let visibleCount = 0;

                    cards.forEach(function (card) {
                        const setMatches = card.dataset.homeSet === selectedSet;
                        const roomMatches = selectedRoom === 'all' || card.dataset.room === selectedRoom;
                        const searchMatches = !searchTerm || (card.dataset.search || '').includes(searchTerm);

                        const shouldShow = setMatches && roomMatches && searchMatches;

                        card.style.display = shouldShow ? '' : 'none';

                        if (shouldShow) {
                            visibleCount++;
                        }
                    });

                    if (countText) {
                        countText.textContent = visibleCount + (visibleCount === 1 ? ' product showing' : ' products showing');
                    }

                    if (emptyState) {
                        emptyState.style.display = visibleCount === 0 ? '' : 'none';
                    }
                }

                categoryFilter?.addEventListener('change', function () {
                    if (searchInput) {
                        searchInput.value = '';
                    }

                    if (roomFilter) {
                        roomFilter.value = 'all';
                    }

                    setTimeout(applyHomeProductFilters, 0);
                });

                roomFilter?.addEventListener('change', function () {
                    setTimeout(applyHomeProductFilters, 0);
                });

                searchInput?.addEventListener('input', function () {
                    setTimeout(applyHomeProductFilters, 0);
                });

                cards.forEach(function (card) {
                    card.style.display = card.dataset.homeSet === (categoryFilter?.value || '') ? '' : 'none';
                });

                applyHomeProductFilters();
            });
        </script>
    </section>

    <section id="shop-room" class="bg-[#f7f3ed] py-20">
        <div class="site-container grid gap-10 lg:grid-cols-[.95fr_1.05fr] lg:items-center">
            <div>
                <p class="section-kicker">{{ $shopRoomKicker }}</p>
                <h2 class="section-title-premium max-w-2xl">{{ $shopRoomTitle }}</h2>
                <p class="section-lead">
                    {{ $shopRoomText }}
                </p>

                <div class="mt-8 space-y-3">
                    @foreach($roomItems as $item)
                        <div class="grid grid-cols-[96px_1fr_auto] items-center overflow-hidden bg-white shadow-sm radius-7">
                            <div class="h-24" style="background-color: {{ $item['color'] }}"></div>

                            <div class="px-5">
                                <p class="text-sm font-medium text-mega-orange">{{ $item['type'] }}</p>
                                <h3 class="mt-1 text-xl font-semibold uppercase tracking-tight text-mega-black">
                                    {{ $item['name'] }}
                                </h3>
                                <p class="text-sm font-normal text-mega-muted">Colour curated for retreat-style interiors</p>
                            </div>

                            <button type="button"
                                class="mr-4 grid h-10 w-10 place-items-center hover:bg-mega-cream hover:text-mega-orange radius-7"
                                aria-label="Save room product">
                                <svg class="h-5 w-5 thin-home-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path
                                        d="M20.8 5.6c-1.6-1.8-4.2-1.9-5.9-.2L12 8.3 9.1 5.4C7.4 3.7 4.8 3.8 3.2 5.6c-1.7 2-1.5 5 .4 6.9L12 21l8.4-8.5c1.9-1.9 2.1-4.9.4-6.9z" />
                                </svg>
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="relative overflow-hidden bg-white shadow-premium radius-7">
                <img src="{{ $shopRoomImage }}" alt="Shop the room" class="h-[650px] w-full object-cover">

                <div class="absolute inset-0 bg-gradient-to-t from-black/45 to-transparent"></div>

                <div class="absolute bottom-6 left-6 right-6 bg-white/78 p-5 backdrop-blur-md radius-7">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <p class="text-xs font-medium uppercase tracking-[0.22em] text-mega-orange">Retreat Home</p>
                            <h3 class="mt-2 text-2xl font-semibold tracking-tight text-mega-black">
                                Soft rug, warm timber and relaxed curtains.
                            </h3>
                        </div>

                        <a href="#products" class="btn-light">View room</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="services" class="bg-mega-black py-20 text-white">
        <div class="site-container">
            <div class="mx-auto mb-10 max-w-4xl text-center">
                <p class="section-kicker">Services</p>
                <h2 class="text-4xl font-semibold tracking-[-0.055em] text-white md:text-5xl">
                    Built for real flooring enquiries, not only pretty browsing.
                </h2>
                <p class="mx-auto mt-4 max-w-3xl text-lg font-normal leading-8 text-white/60">
                    Every section is designed to move a customer toward consultation, measurement and a practical quote.
                </p>
            </div>

            <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-4">
                @foreach($services as $service)
                    <div
                        class="border border-white/10 bg-white/[0.06] p-6 transition hover:-translate-y-1 hover:bg-white/[0.09] radius-7">
                        <div class="grid h-[52px] w-[52px] place-items-center bg-mega-orange text-white shadow-soft radius-7">
                            <svg class="h-6 w-6 thin-home-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path d="M4 7h16" />
                                <path d="M4 12h16" />
                                <path d="M4 17h10" />
                            </svg>
                        </div>

                        <h3 class="mt-6 text-xl font-semibold tracking-tight text-white">{{ $service['title'] }}</h3>
                        <p class="mt-3 text-sm font-normal leading-6 text-white/65">{{ $service['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="projects" class="bg-white py-20">
        <div class="site-container">
            <div class="mx-auto mb-10 max-w-4xl text-center">
                <p class="section-kicker">Recent work concept</p>
                <h2 class="section-title-premium">Project cards that make the business feel established.</h2>
                <p class="mx-auto section-lead">
                    Even for a demo, project-style sections help the client understand what a future real portfolio can look
                    like.
                </p>
            </div>

            <div class="grid gap-5 lg:grid-cols-3">
                @foreach($projects as $project)
                    <article class="group relative h-72 overflow-hidden shadow-soft radius-7">
                        <img src="{{ $project['image'] }}" alt="{{ $project['title'] }}"
                            class="h-full w-full object-cover transition duration-500 group-hover:scale-105">

                        <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-black/15 to-transparent"></div>

                        <div class="absolute bottom-5 left-5 right-5 text-white">
                            <p class="text-xs font-medium uppercase tracking-[0.2em] text-mega-orange">
                                {{ $project['location'] }}
                            </p>
                            <h3 class="mt-2 text-2xl font-semibold tracking-tight">{{ $project['title'] }}</h3>
                            <p class="mt-1 text-sm font-normal text-white/75">{{ $project['type'] }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section id="reviews" class="bg-[#f7f3ed] py-20">
        <div class="site-container">
            <div class="mb-10 flex flex-col justify-between gap-5 md:flex-row md:items-end">
                <div class="max-w-3xl">
                    <p class="section-kicker">Customer reviews</p>
                    <h2 class="section-title-premium">Real feedback that builds trust.</h2>
                    <p class="section-lead">
                        Simple, premium review cards from the admin panel. Long reviews open in a clean modal.
                    </p>
                </div>

                <div class="flex gap-2">
                    <button type="button" data-review-prev
                        class="grid h-12 w-12 place-items-center border border-mega-line bg-white text-mega-black hover:border-mega-orange hover:text-mega-orange radius-7">
                        ←
                    </button>
                    <button type="button" data-review-next
                        class="grid h-12 w-12 place-items-center border border-mega-line bg-white text-mega-black hover:border-mega-orange hover:text-mega-orange radius-7">
                        →
                    </button>
                </div>
            </div>

            <div data-review-slider class="flex snap-x gap-5 overflow-x-auto scroll-smooth pb-4">
                @forelse($reviews as $review)
                    @php
                        $reviewText = trim($review->review_text);
                        $shortReview = \Illuminate\Support\Str::limit($reviewText, 190);
                        $needsMore = strlen($reviewText) > 190;
                        $avatar = $review->imageUrl();
                    @endphp

                    <article
                        class="review-card min-w-[320px] snap-start rounded-[28px] border border-mega-line bg-white p-6 shadow-soft md:min-w-[420px]">
                        <div class="flex items-start gap-4">
                            <div
                                class="flex h-14 w-14 shrink-0 items-center justify-center overflow-hidden rounded-full bg-mega-orange text-lg font-black text-white">
                                @if($avatar)
                                    <img src="{{ $avatar }}" alt="{{ $review->customer_name }}" class="h-full w-full object-cover">
                                @else
                                    {{ strtoupper(substr($review->customer_name, 0, 1)) }}
                                @endif
                            </div>

                            <div class="min-w-0">
                                <h3 class="truncate text-xl font-semibold text-mega-black">
                                    {{ $review->customer_name }}
                                </h3>

                                <p class="mt-1 text-sm text-mega-muted">
                                    {{ $review->customer_title ?: 'Mega Carpets Customer' }}
                                    @if($review->location)
                                        · {{ $review->location }}
                                    @endif
                                </p>
                            </div>
                        </div>

                        <div class="mt-5 flex gap-1 text-mega-orange">
                            @for($i = 1; $i <= 5; $i++)
                                <span>{{ $i <= $review->rating ? '★' : '☆' }}</span>
                            @endfor
                        </div>

                        <p class="mt-5 min-h-[120px] text-base leading-8 text-mega-muted">
                            “{{ $shortReview }}”
                        </p>

                        <div class="mt-6 flex items-center justify-between gap-4">
                            <span class="rounded-full bg-mega-orange/10 px-3 py-1 text-xs font-semibold text-mega-orange">
                                {{ optional($review->productRange)->name ?: 'Flooring service' }}
                            </span>

                            @if($needsMore)
                                <button type="button" data-review-open data-name="{{ $review->customer_name }}"
                                    data-title="{{ $review->customer_title ?: 'Mega Carpets Customer' }}"
                                    data-location="{{ $review->location }}" data-rating="{{ $review->rating }}"
                                    data-review="{{ e($reviewText) }}"
                                    class="text-sm font-semibold text-mega-orange hover:text-mega-black">
                                    Read more
                                </button>
                            @endif
                        </div>
                    </article>
                @empty
                    <div class="w-full rounded-[28px] border border-mega-line bg-white p-10 text-center shadow-soft">
                        <h3 class="text-2xl font-semibold text-mega-black">No reviews yet.</h3>
                        <p class="mt-2 text-mega-muted">Add reviews from Admin → Reviews.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <div data-review-modal class="fixed inset-0 z-[100] hidden">
        <div data-review-close class="absolute inset-0 bg-black/55 backdrop-blur-sm"></div>

        <div
            class="absolute left-1/2 top-1/2 w-[calc(100vw-32px)] max-w-2xl -translate-x-1/2 -translate-y-1/2 rounded-[28px] bg-white p-6 shadow-2xl">
            <div class="flex items-start justify-between gap-5">
                <div>
                    <p class="section-kicker">Full review</p>
                    <h3 data-review-modal-name class="mt-2 text-3xl font-semibold text-mega-black"></h3>
                    <p data-review-modal-meta class="mt-1 text-sm text-mega-muted"></p>
                </div>

                <button type="button" data-review-close
                    class="grid h-10 w-10 place-items-center rounded-full bg-mega-soft text-xl text-mega-black hover:bg-mega-orange hover:text-white">
                    ×
                </button>
            </div>

            <div data-review-modal-rating class="mt-5 flex gap-1 text-mega-orange"></div>

            <p data-review-modal-text class="mt-5 max-h-[55vh] overflow-y-auto text-lg leading-9 text-mega-muted"></p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const slider = document.querySelector('[data-review-slider]');
            const prev = document.querySelector('[data-review-prev]');
            const next = document.querySelector('[data-review-next]');

            prev?.addEventListener('click', function () {
                slider?.scrollBy({ left: -420, behavior: 'smooth' });
            });

            next?.addEventListener('click', function () {
                slider?.scrollBy({ left: 420, behavior: 'smooth' });
            });

            const modal = document.querySelector('[data-review-modal]');
            const modalName = document.querySelector('[data-review-modal-name]');
            const modalMeta = document.querySelector('[data-review-modal-meta]');
            const modalRating = document.querySelector('[data-review-modal-rating]');
            const modalText = document.querySelector('[data-review-modal-text]');

            document.querySelectorAll('[data-review-open]').forEach(function (button) {
                button.addEventListener('click', function () {
                    const name = button.dataset.name || '';
                    const title = button.dataset.title || '';
                    const location = button.dataset.location || '';
                    const rating = parseInt(button.dataset.rating || '5', 10);
                    const review = button.dataset.review || '';

                    modalName.textContent = name;
                    modalMeta.textContent = [title, location].filter(Boolean).join(' · ');
                    modalRating.innerHTML = '';

                    for (let i = 1; i <= 5; i++) {
                        const star = document.createElement('span');
                        star.textContent = i <= rating ? '★' : '☆';
                        modalRating.appendChild(star);
                    }

                    modalText.textContent = '“' + review + '”';
                    modal.classList.remove('hidden');
                    document.body.classList.add('overflow-hidden');
                });
            });

            document.querySelectorAll('[data-review-close]').forEach(function (button) {
                button.addEventListener('click', function () {
                    modal.classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                });
            });
        });
    </script>

    <section id="quote" class="bg-white py-20">
        <div class="site-container grid gap-10 lg:grid-cols-[.9fr_1.1fr] lg:items-start">
            <div class="hidden lg:block">
                <div class="overflow-hidden bg-mega-black text-white shadow-premium radius-7">
                    <img src="{{ $quoteImage }}"
                        onerror="this.src='https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?auto=format&fit=crop&w=1200&q=85'"
                        alt="Mega Carpets van" class="h-[420px] w-full object-cover">

                    <div class="p-7">
                        <span
                            class="inline-flex rounded-full bg-white/10 px-4 py-2 text-xs font-medium uppercase tracking-[0.18em] text-white">
                            Call us today
                        </span>
                        <h2 class="mt-4 text-4xl font-semibold tracking-[-0.05em]">{{ $quotePhone }}</h2>
                        <p class="mt-3 text-white/65">
                            Use this form to collect qualified quote requests. Later it can connect with email, CRM, Laravel
                            admin or SMS notification.
                        </p>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('frontend.quick-quote.store') }}"
                class="border border-mega-line bg-white p-6 shadow-soft sm:p-8 radius-7">
                @csrf

                <p class="section-kicker">{{ $quoteKicker }}</p>
                <h2 class="section-title-premium max-w-3xl">{{ $quoteTitle }}</h2>
                <p class="section-lead">
                    {{ $quoteText }}
                </p>

                @if(session('quick_quote_success'))
                    <div
                        class="mt-6 rounded-[16px] border border-green-200 bg-green-50 px-5 py-4 text-sm font-semibold text-green-800">
                        {{ session('quick_quote_success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div
                        class="mt-6 rounded-[16px] border border-red-200 bg-red-50 px-5 py-4 text-sm font-semibold text-red-700">
                        Please check the form fields and try again.
                    </div>
                @endif

                <div class="mt-8 grid gap-4 md:grid-cols-2">
                    <input name="full_name" value="{{ old('full_name') }}" class="input-clean" placeholder="Full name"
                        required>
                    <input name="phone" value="{{ old('phone') }}" class="input-clean" placeholder="Phone number" required>
                    <input name="email" value="{{ old('email') }}" class="input-clean" type="email"
                        placeholder="Email address" required>

                    <select name="product_category" class="input-clean" required>
                        <option value="Carpet" @selected(old('product_category') === 'Carpet')>Carpet</option>
                        <option value="Vinyl" @selected(old('product_category') === 'Vinyl')>Vinyl</option>
                        <option value="Timber" @selected(old('product_category') === 'Timber')>Timber</option>
                        <option value="Laminate" @selected(old('product_category') === 'Laminate')>Laminate</option>
                        <option value="Hybrid Flooring" @selected(old('product_category') === 'Hybrid Flooring')>Hybrid
                            Flooring</option>
                        <option value="Rugs" @selected(old('product_category') === 'Rugs')>Rugs</option>
                        <option value="Commercial Flooring" @selected(old('product_category') === 'Commercial Flooring')>
                            Commercial Flooring</option>
                    </select>

                    <select name="room" class="input-clean" required>
                        <option value="Bedroom" @selected(old('room') === 'Bedroom')>Bedroom</option>
                        <option value="Living Room" @selected(old('room') === 'Living Room')>Living Room</option>
                        <option value="Kitchen" @selected(old('room') === 'Kitchen')>Kitchen</option>
                        <option value="Bathroom" @selected(old('room') === 'Bathroom')>Bathroom</option>
                        <option value="Hallway" @selected(old('room') === 'Hallway')>Hallway</option>
                        <option value="Commercial Space" @selected(old('room') === 'Commercial Space')>Commercial Space
                        </option>
                    </select>

                    <input name="approximate_size" value="{{ old('approximate_size') }}" class="input-clean"
                        placeholder="Approx room size, e.g. 4m x 5m">

                    <textarea name="message" class="input-clean md:col-span-2" rows="5"
                        placeholder="Tell us about the project, preferred colour, budget, address area or installation timeline...">{{ old('message') }}</textarea>
                </div>

                <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <p class="text-sm font-normal text-mega-muted">
                        Your request will be saved in the admin quote requests panel.
                    </p>

                    <button type="submit" class="btn-primary">
                        Send quote request <span>→</span>
                    </button>
                </div>
            </form>
        </div>
    </section>

    <section id="faq" class="bg-[#f7f3ed] py-20">
        <div class="site-container grid gap-10 lg:grid-cols-[.8fr_1.2fr]">
            <div>
                <p class="section-kicker">FAQ</p>
                <h2 class="section-title-premium">Clear answers for customers.</h2>
                <p class="section-lead">
                    Manage these questions from the admin panel.
                </p>
            </div>

            <div class="space-y-3">
                @forelse($faqs as $faq)
                    <details class="bg-white shadow-sm radius-7" {{ $loop->first ? 'open' : '' }}>
                        <summary
                            class="flex cursor-pointer list-none items-center justify-between gap-4 p-5 text-left text-lg font-medium text-mega-black">
                            {{ $faq->question }}
                            <span class="text-2xl text-mega-orange">+</span>
                        </summary>

                        <p class="px-5 pb-5 text-base font-normal leading-7 text-mega-muted">
                            {{ $faq->answer }}
                        </p>
                    </details>
                @empty
                    <div class="rounded-[24px] border border-mega-line bg-white p-8 shadow-sm">
                        <h3 class="text-2xl font-semibold text-mega-black">No FAQs added yet.</h3>
                        <p class="mt-2 text-mega-muted">Add FAQs from Admin → FAQs.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>


    <div data-ai-panel
        class="ai-panel fixed bottom-36 right-5 z-50 w-[calc(100vw-40px)] max-w-sm overflow-hidden border border-mega-line bg-white shadow-2xl radius-7">
        <div class="bg-mega-black p-5 text-white">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-xs font-medium uppercase tracking-[0.2em] text-mega-orange">AI flooring assistant</p>
                    <h3 class="mt-2 text-xl font-semibold">Help customers choose faster.</h3>
                    <p class="mt-2 text-sm leading-6 text-white/65">
                        Demo assistant for flooring questions, room ideas and quote guidance.
                    </p>
                </div>

                <button type="button" data-close-ai class="text-xl text-white/70 hover:text-white">×</button>
            </div>
        </div>

        <div class="space-y-3 p-4">
            <button type="button"
                class="w-full bg-mega-soft p-3 text-left text-sm font-medium text-mega-black hover:bg-mega-orange hover:text-white radius-7">
                Which floor is best for bedrooms?
            </button>

            <button type="button"
                class="w-full bg-mega-soft p-3 text-left text-sm font-medium text-mega-black hover:bg-mega-orange hover:text-white radius-7">
                Compare vinyl, laminate and timber.
            </button>

            <button type="button"
                class="w-full bg-mega-soft p-3 text-left text-sm font-medium text-mega-black hover:bg-mega-orange hover:text-white radius-7">
                Help me prepare a quote request.
            </button>

            <a href="#quote" class="btn-primary w-full justify-center">
                Book consultation
            </a>
        </div>
    </div>

    <div data-quote-drawer class="drawer fixed inset-0 z-[80]">
        <div data-close-drawer class="absolute inset-0 bg-black/55 backdrop-blur-sm"></div>

        <aside class="drawer-panel absolute right-0 top-0 h-full w-full max-w-md bg-white shadow-2xl">
            <div class="flex h-full flex-col">
                <div class="flex items-center justify-between border-b border-mega-line p-5">
                    <div>
                        <p class="text-xs font-medium uppercase tracking-[0.2em] text-mega-orange">Quote basket</p>
                        <h2 class="mt-1 text-2xl font-semibold tracking-tight text-mega-black">Saved products</h2>
                    </div>

                    <button type="button" data-close-drawer
                        class="grid h-10 w-10 place-items-center hover:bg-mega-soft radius-7"
                        aria-label="Close quote basket">
                        ×
                    </button>
                </div>

                <div class="flex-1 overflow-y-auto p-5">
                    <div data-quote-empty class="grid h-full place-items-center text-center">
                        <div>
                            <h3 class="text-xl font-semibold text-mega-black">No products saved yet</h3>
                            <p class="mt-2 text-sm font-normal text-mega-muted">
                                Select colour and type, then add products to your quote.
                            </p>
                        </div>
                    </div>

                    <div data-quote-list class="space-y-4"></div>
                </div>

                <div class="border-t border-mega-line p-5">
                    <div class="mb-4 bg-[#f7f3ed] p-4 radius-7">
                        <div class="flex items-center justify-between text-sm font-medium text-mega-muted">
                            <span>Indicative product total</span>
                            <span data-quote-total class="text-xl text-mega-black">$0</span>
                        </div>

                        <p class="mt-2 text-xs font-normal leading-5 text-mega-muted">
                            Final quote depends on measurements, preparation, underlay, install requirements and product
                            availability.
                        </p>
                    </div>

                    <a href="#quote" data-close-drawer class="btn-primary w-full justify-center">
                        Continue to quote form
                    </a>
                </div>
            </div>
        </aside>
    </div>

    <div data-wishlist-drawer class="drawer fixed inset-0 z-[80]">
        <div data-close-drawer class="absolute inset-0 bg-black/55 backdrop-blur-sm"></div>

        <aside class="drawer-panel absolute right-0 top-0 h-full w-full max-w-md bg-white shadow-2xl">
            <div class="flex h-full flex-col">
                <div class="flex items-center justify-between border-b border-mega-line p-5">
                    <div>
                        <p class="text-xs font-medium uppercase tracking-[0.2em] text-mega-orange">Wishlist</p>
                        <h2 class="mt-1 text-2xl font-semibold tracking-tight text-mega-black">Favourite products</h2>
                    </div>

                    <button type="button" data-close-drawer
                        class="grid h-10 w-10 place-items-center hover:bg-mega-soft radius-7" aria-label="Close wishlist">
                        ×
                    </button>
                </div>

                <div class="flex-1 overflow-y-auto p-5">
                    <div data-wishlist-empty class="grid h-full place-items-center text-center">
                        <div>
                            <h3 class="text-xl font-semibold text-mega-black">No wishlist products yet</h3>
                            <p class="mt-2 text-sm font-normal text-mega-muted">
                                Click the heart icon on any product card to save it here.
                            </p>
                        </div>
                    </div>

                    <div data-wishlist-list class="space-y-4"></div>
                </div>
            </div>
        </aside>
    </div>

@endsection