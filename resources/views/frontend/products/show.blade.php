@extends('layouts.frontend')

@section('title', $category['name'] . ' | Mega Carpets')
@section('meta_description', $category['short'])

@section('content')

    @php
        $currentSlug = $category['slug'] ?? \Illuminate\Support\Str::slug($category['name']);

        $allProducts = [
            [
                'name' => 'Terra Verde',
                'category' => 'Carpet',
                'category_slug' => 'carpet',
                'badge' => 'Soft comfort',
                'short' => 'Soft textured carpet designed for warm bedrooms and quiet family spaces.',
                'description' => 'Terra Verde is a soft textured carpet range made for comfortable rooms, quieter interiors and warm family spaces.',
                'images' => [
                    'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?auto=format&fit=crop&w=1400&q=85',
                    'https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?auto=format&fit=crop&w=1400&q=85',
                    'https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?auto=format&fit=crop&w=1400&q=85',
                    'https://images.unsplash.com/photo-1618219908412-a29a1bb7b86e?auto=format&fit=crop&w=1400&q=85',
                ],
                'colours' => [
                    ['name' => 'Mist', 'swatch' => '#c8c2b7'],
                    ['name' => 'Sand', 'swatch' => '#b9ad9d'],
                    ['name' => 'Stone', 'swatch' => '#9c968d'],
                    ['name' => 'Warm Taupe', 'swatch' => '#8d8074'],
                    ['name' => 'Clay', 'swatch' => '#a6917c'],
                    ['name' => 'Graphite', 'swatch' => '#655f58'],
                ],
                'sizes' => [
                    ['label' => 'Small room estimate', 'price' => 390.00, 'regular' => 520.00],
                    ['label' => 'Bedroom estimate', 'price' => 680.00, 'regular' => 890.00],
                    ['label' => 'Living room estimate', 'price' => 1180.00, 'regular' => 1490.00],
                    ['label' => 'Whole home estimate', 'price' => 2890.00, 'regular' => 3490.00],
                ],
                'features' => ['Soft underfoot', 'Warm room feel', 'Noise reduction', 'Family friendly'],
            ],
            [
                'name' => 'Bali',
                'category' => 'Rugs',
                'category_slug' => 'rugs',
                'badge' => 'Designer rug',
                'short' => 'A calm premium rug range for modern living rooms and relaxed interiors.',
                'description' => 'Bali is a calm premium rug collection made for relaxed living rooms, clean interiors and soft neutral styling.',
                'images' => [
                    'https://images.unsplash.com/photo-1600121848594-d8644e57abab?auto=format&fit=crop&w=1400&q=85',
                    'https://images.unsplash.com/photo-1618221118493-9cfa1a1c00da?auto=format&fit=crop&w=1400&q=85',
                    'https://images.unsplash.com/photo-1616486701797-0f33f61038ec?auto=format&fit=crop&w=1400&q=85',
                    'https://images.unsplash.com/photo-1616594039964-ae9021a400a0?auto=format&fit=crop&w=1400&q=85',
                ],
                'colours' => [
                    ['name' => 'Ivory', 'swatch' => '#e6e0d4'],
                    ['name' => 'Fog', 'swatch' => '#cfd2cf'],
                    ['name' => 'Silver', 'swatch' => '#bfc2bf'],
                    ['name' => 'Linen', 'swatch' => '#d8d2c5'],
                    ['name' => 'Oat', 'swatch' => '#c0b8a8'],
                    ['name' => 'Smoke', 'swatch' => '#a5a3a0'],
                ],
                'sizes' => [
                    ['label' => '230x160', 'price' => 449.00, 'regular' => 699.00],
                    ['label' => '290x200', 'price' => 649.00, 'regular' => 899.00],
                    ['label' => '310x240', 'price' => 799.00, 'regular' => 1099.00],
                    ['label' => '400x300', 'price' => 1199.00, 'regular' => 1699.00],
                    ['label' => '300x80 Runner', 'price' => 269.00, 'regular' => 399.00],
                ],
                'features' => ['Premium texture', 'Neutral colours', 'Multiple sizes', 'Room defining'],
            ],
            [
                'name' => 'Rogue',
                'category' => 'Rugs',
                'category_slug' => 'rugs',
                'badge' => 'Featured range',
                'short' => 'A refined patterned rug with soft neutral colourways for finished rooms.',
                'description' => 'Rogue is a refined rug range with patterned texture, calm colours and a premium finished-room feel.',
                'images' => [
                    'https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?auto=format&fit=crop&w=1400&q=85',
                    'https://images.unsplash.com/photo-1600121848594-d8644e57abab?auto=format&fit=crop&w=1400&q=85',
                    'https://images.unsplash.com/photo-1618220179428-22790b461013?auto=format&fit=crop&w=1400&q=85',
                    'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?auto=format&fit=crop&w=1400&q=85',
                ],
                'colours' => [
                    ['name' => 'Blue', 'swatch' => '#aeb7b3'],
                    ['name' => 'Linen', 'swatch' => '#d9d2c3'],
                    ['name' => 'Ash', 'swatch' => '#b7b3aa'],
                ],
                'sizes' => [
                    ['label' => '230x160', 'price' => 399.00, 'regular' => 649.00],
                    ['label' => '290x200', 'price' => 539.00, 'regular' => 899.00],
                    ['label' => '310x240', 'price' => 689.00, 'regular' => 1099.00],
                    ['label' => '400x300', 'price' => 999.00, 'regular' => 1499.00],
                    ['label' => '300x80 Runner', 'price' => 249.00, 'regular' => 389.00],
                    ['label' => '400x80 Runner', 'price' => 329.00, 'regular' => 499.00],
                ],
                'features' => ['Pattern detail', 'Soft colourways', 'Runner option', 'Premium styling'],
            ],
            [
                'name' => 'Homescapes Native LVP',
                'category' => 'Vinyl',
                'category_slug' => 'vinyl',
                'badge' => 'Low maintenance',
                'short' => 'Practical timber-look vinyl plank flooring for modern homes and rentals.',
                'description' => 'Homescapes Native LVP is a practical timber-look vinyl plank option for low-maintenance homes and rental properties.',
                'images' => [
                    'https://images.unsplash.com/photo-1600607688969-a5bfcd646154?auto=format&fit=crop&w=1400&q=85',
                    'https://images.unsplash.com/photo-1600566753086-00f18fb6b3ea?auto=format&fit=crop&w=1400&q=85',
                    'https://images.unsplash.com/photo-1600210492493-0946911123ea?auto=format&fit=crop&w=1400&q=85',
                    'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?auto=format&fit=crop&w=1400&q=85',
                ],
                'colours' => [
                    ['name' => 'Natural Oak', 'swatch' => '#c7ad85'],
                    ['name' => 'Warm Oak', 'swatch' => '#b99162'],
                    ['name' => 'Soft Beige', 'swatch' => '#d2bd9f'],
                    ['name' => 'Weathered', 'swatch' => '#9c8d79'],
                    ['name' => 'Honey', 'swatch' => '#b98754'],
                    ['name' => 'Walnut', 'swatch' => '#7d5b3e'],
                ],
                'sizes' => [
                    ['label' => 'Small room estimate', 'price' => 720.00, 'regular' => 920.00],
                    ['label' => 'Bedroom estimate', 'price' => 980.00, 'regular' => 1290.00],
                    ['label' => 'Living room estimate', 'price' => 1580.00, 'regular' => 1990.00],
                    ['label' => 'Whole home estimate', 'price' => 3890.00, 'regular' => 4690.00],
                ],
                'features' => ['Timber-look finish', 'Easy cleaning', 'Rental friendly', 'Modern colours'],
            ],
            [
                'name' => 'Oakhaven Hybrid',
                'category' => 'Hybrid Flooring',
                'category_slug' => 'hybrid-flooring',
                'badge' => 'Family ready',
                'short' => 'Durable hybrid flooring with a clean timber appearance for busy homes.',
                'description' => 'Oakhaven Hybrid gives busy homes a clean timber appearance with strong everyday practicality.',
                'images' => [
                    'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?auto=format&fit=crop&w=1400&q=85',
                    'https://images.unsplash.com/photo-1600566753086-00f18fb6b3ea?auto=format&fit=crop&w=1400&q=85',
                    'https://images.unsplash.com/photo-1600210492493-0946911123ea?auto=format&fit=crop&w=1400&q=85',
                    'https://images.unsplash.com/photo-1600607687644-c7171b42498b?auto=format&fit=crop&w=1400&q=85',
                ],
                'colours' => [
                    ['name' => 'Coastal Oak', 'swatch' => '#d6c3a5'],
                    ['name' => 'Natural', 'swatch' => '#bd9b72'],
                    ['name' => 'Grey Oak', 'swatch' => '#9c9a92'],
                    ['name' => 'Smoked Oak', 'swatch' => '#776653'],
                ],
                'sizes' => [
                    ['label' => 'Small room estimate', 'price' => 850.00, 'regular' => 1090.00],
                    ['label' => 'Bedroom estimate', 'price' => 1250.00, 'regular' => 1590.00],
                    ['label' => 'Living room estimate', 'price' => 1890.00, 'regular' => 2390.00],
                    ['label' => 'Whole home estimate', 'price' => 4690.00, 'regular' => 5590.00],
                ],
                'features' => ['Durable surface', 'Timber-look design', 'Family ready', 'Easy maintenance'],
            ],
            [
                'name' => 'Softline Laminate',
                'category' => 'Laminate',
                'category_slug' => 'laminate',
                'badge' => 'Budget smart',
                'short' => 'Clean and affordable laminate flooring for practical everyday interiors.',
                'description' => 'Softline Laminate is a clean, affordable and practical flooring option for everyday homes.',
                'images' => [
                    'https://images.unsplash.com/photo-1600566753086-00f18fb6b3ea?auto=format&fit=crop&w=1400&q=85',
                    'https://images.unsplash.com/photo-1600566752355-35792bedcfea?auto=format&fit=crop&w=1400&q=85',
                    'https://images.unsplash.com/photo-1600607688969-a5bfcd646154?auto=format&fit=crop&w=1400&q=85',
                    'https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?auto=format&fit=crop&w=1400&q=85',
                ],
                'colours' => [
                    ['name' => 'Light Oak', 'swatch' => '#d6c1a0'],
                    ['name' => 'Natural Oak', 'swatch' => '#b88f5c'],
                    ['name' => 'Pale Grey', 'swatch' => '#b8b8b2'],
                    ['name' => 'Coffee Oak', 'swatch' => '#7c634f'],
                ],
                'sizes' => [
                    ['label' => 'Small room estimate', 'price' => 590.00, 'regular' => 790.00],
                    ['label' => 'Bedroom estimate', 'price' => 860.00, 'regular' => 1120.00],
                    ['label' => 'Living room estimate', 'price' => 1320.00, 'regular' => 1690.00],
                    ['label' => 'Whole home estimate', 'price' => 3290.00, 'regular' => 3990.00],
                ],
                'features' => ['Cost effective', 'Clean finish', 'Easy care', 'Good colour choice'],
            ],
        ];

        $categoryProducts = collect($allProducts)->where('category_slug', $currentSlug)->values();

        if ($categoryProducts->isEmpty()) {
            $categoryProducts = collect($allProducts)->take(2)->values();
        }

        $mainProduct = $categoryProducts->first();
    @endphp

    <section
        x-data="{
            mainImage: @js($mainProduct['images'][0]),
            selectedColour: null,
            selectedSize: '',
            zooming: false,
            zoomX: 50,
            zoomY: 50,
            sizes: @js($mainProduct['sizes']),
            get selectedSizeItem() {
                return this.sizes.find((item) => item.label === this.selectedSize) || null;
            },
            money(amount) {
                if (!amount && amount !== 0) return '$0.00';

                return '$' + Number(amount).toLocaleString('en-US', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
            },
            chooseColour(colour) {
                this.selectedColour = colour;
                this.selectedSize = '';
            },
            changeMainImage(image) {
                this.mainImage = image;
                this.zooming = false;
            },
            zoomMove(event) {
                const rect = event.currentTarget.getBoundingClientRect();
                this.zoomX = ((event.clientX - rect.left) / rect.width) * 100;
                this.zoomY = ((event.clientY - rect.top) / rect.height) * 100;
            }
        }"
        class="bg-white py-16 md:py-20"
    >
        <div class="site-container">
            <div class="mb-8 flex flex-col justify-between gap-4 md:flex-row md:items-end">
                <div>
                    <div class="section-label">Product details</div>
                    <h1 class="section-title">{{ $mainProduct['name'] }}</h1>
                    <p class="section-text">
                        {{ $mainProduct['description'] }}
                    </p>
                </div>

                <a href="{{ route('frontend.products') }}" class="btn-light w-fit">
                    Back to products
                </a>
            </div>

            <div class="grid gap-8 lg:grid-cols-[1.08fr_0.92fr]">
                <div>
                    <div
                        class="group relative overflow-hidden border border-mega-line bg-mega-soft shadow-[0_28px_90px_rgba(7,7,7,0.10)] radius-7"
                        @mouseenter="zooming = true"
                        @mouseleave="zooming = false"
                        @mousemove="zoomMove($event)"
                    >
                        <img
                            :src="mainImage"
                            alt="{{ $mainProduct['name'] }}"
                            class="h-[420px] w-full object-cover transition-transform duration-300 md:h-[620px]"
                            :style="{
                                transform: zooming ? 'scale(1.9)' : 'scale(1)',
                                transformOrigin: zoomX + '% ' + zoomY + '%'
                            }"
                        >

                        <div class="pointer-events-none absolute left-4 top-4 bg-white/95 px-3 py-2 text-xs font-medium uppercase tracking-[0.18em] text-mega-orange backdrop-blur radius-7">
                            Hover to zoom
                        </div>

                        <div class="pointer-events-none absolute bottom-4 left-4 right-4 hidden border border-white/30 bg-mega-black/75 p-4 text-white backdrop-blur radius-7 md:block">
                            <p class="text-sm text-white/70">
                                Move your mouse over the image to zoom exactly where you hover.
                            </p>
                        </div>
                    </div>

                    <div class="mt-4 grid grid-cols-4 gap-3">
                        @foreach($mainProduct['images'] as $image)
                            <button
                                type="button"
                                @click="changeMainImage('{{ $image }}')"
                                class="overflow-hidden border border-mega-line bg-white p-1 transition hover:border-mega-orange radius-7"
                                :class="mainImage === '{{ $image }}' ? 'border-mega-orange ring-4 ring-orange-500/10' : ''"
                            >
                                <img
                                    src="{{ $image }}"
                                    alt="{{ $mainProduct['name'] }} thumbnail"
                                    class="h-24 w-full object-cover radius-7"
                                >
                            </button>
                        @endforeach
                    </div>
                </div>

                <div class="lg:sticky lg:top-8 lg:self-start">
                    <div class="clean-card bg-white p-6 md:p-8">
                        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-start">
                            <div>
                                <p class="text-xs font-medium uppercase tracking-[0.22em] text-mega-orange">
                                    {{ $mainProduct['category'] }}
                                </p>

                                <h2 class="mt-3 text-4xl leading-tight text-mega-black">
                                    {{ $mainProduct['name'] }}
                                </h2>

                                <p class="mt-4 text-sm leading-6 text-mega-muted">
                                    {{ $mainProduct['short'] }}
                                </p>
                            </div>

                            <div class="flex gap-2">
                                <button type="button" class="flex h-11 w-11 items-center justify-center border border-mega-line text-mega-text transition hover:border-mega-orange hover:text-mega-orange radius-7">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                                        <path d="M7 7h10M7 7l3-3M7 7l3 3" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M17 17H7M17 17l-3-3M17 17l-3 3" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>

                                <button type="button" class="flex h-11 w-11 items-center justify-center border border-mega-line text-mega-text transition hover:border-mega-orange hover:text-mega-orange radius-7">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                                        <path d="M20.8 5.6c-1.6-1.8-4.2-1.9-5.9-.2L12 8.3 9.1 5.4C7.4 3.7 4.8 3.8 3.2 5.6c-1.7 2-1.5 5 .4 6.9L12 21l8.4-8.5c1.9-1.9 2.1-4.9.4-6.9z" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="mt-7">
                            <div class="mb-3 flex items-center justify-between">
                                <p class="text-base font-medium text-mega-muted">
                                    <span x-text="selectedColour ? 'Colour ' + selectedColour.name : 'Colour'"></span>
                                </p>

                                <span x-show="selectedColour" x-cloak class="bg-mega-orange/10 px-2.5 py-1 text-xs font-medium text-mega-orange radius-7">
                                    Selected
                                </span>
                            </div>

                            <div class="flex flex-wrap gap-3">
                                @foreach($mainProduct['colours'] as $colour)
                                    <button
                                        type="button"
                                        @click='chooseColour(@json($colour))'
                                        :class="selectedColour && selectedColour.name === '{{ $colour['name'] }}'
                                            ? 'border-mega-orange ring-4 ring-orange-500/15'
                                            : 'border-mega-line hover:border-mega-orange'"
                                        class="h-14 w-14 border bg-white p-1.5 transition radius-7"
                                        title="{{ $colour['name'] }}"
                                    >
                                        <span class="block h-full w-full radius-7" style="background: {{ $colour['swatch'] }};"></span>
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        <div class="mt-7">
                            <label class="mb-2 block text-base font-medium text-mega-muted">
                                {{ $mainProduct['category'] === 'Rugs' ? 'Size' : 'Room Size' }}
                            </label>

                            <div class="relative">
                                <select
                                    x-model="selectedSize"
                                    :disabled="!selectedColour"
                                    class="w-full appearance-none border border-mega-line bg-mega-soft px-4 py-4 pr-11 text-base font-medium text-mega-black outline-none transition focus:border-mega-orange focus:bg-white focus:ring-4 focus:ring-orange-500/10 disabled:cursor-not-allowed disabled:text-mega-muted/35 radius-7"
                                >
                                    <option value="">Choose an option...</option>
                                    @foreach($mainProduct['sizes'] as $size)
                                        <option value="{{ $size['label'] }}">{{ $size['label'] }}</option>
                                    @endforeach
                                </select>

                                <svg class="pointer-events-none absolute right-4 top-1/2 h-5 w-5 -translate-y-1/2 text-mega-text" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                                    <path d="M6 9l6 6 6-6" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>

                            <p x-show="!selectedColour" x-cloak class="mt-3 text-sm text-red-500">
                                Select a colour first.
                            </p>
                        </div>

                        <div x-show="selectedSizeItem" x-transition x-cloak class="mt-7 border border-mega-line bg-mega-cream p-5 radius-7">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm font-medium text-mega-muted">Special Price</p>
                                    <p class="mt-1 text-4xl font-medium text-red-500" x-text="money(selectedSizeItem?.price)"></p>
                                </div>

                                <div class="text-right">
                                    <p class="text-sm font-medium text-mega-muted">Regular Price</p>
                                    <p class="mt-1 text-2xl font-medium text-mega-text line-through" x-text="money(selectedSizeItem?.regular)"></p>
                                </div>
                            </div>

                            <div class="mt-5 flex items-center overflow-hidden border border-mega-line bg-white radius-7">
                                <div class="flex h-16 w-24 items-center justify-center bg-red-600 text-white">
                                    <svg class="h-9 w-9" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M3 4h18L9.5 20l1.2-7.2L3 4z" />
                                    </svg>
                                </div>

                                <div class="px-4">
                                    <p class="text-sm font-medium text-mega-black">
                                        Estimate generated from selected colour and size.
                                    </p>
                                    <p class="mt-1 text-xs text-mega-muted">
                                        Final quote depends on measurement and installation details.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-7 grid gap-3 sm:grid-cols-2">
                            <a
                                href="{{ route('frontend.quote') }}"
                                :class="selectedColour && selectedSize ? 'bg-mega-orange text-white hover:bg-mega-orangeDark' : 'bg-mega-soft text-mega-muted pointer-events-none'"
                                class="inline-flex items-center justify-center gap-2 px-5 py-4 text-sm font-medium transition radius-7"
                            >
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                    <path d="M6 6h15l-2 8H8L6 6z" />
                                    <path d="M6 6L5 3H2" />
                                    <circle cx="9" cy="20" r="1.5" />
                                    <circle cx="18" cy="20" r="1.5" />
                                </svg>
                                Add to estimate
                            </a>

                            <a href="{{ route('frontend.quote') }}" class="btn-light justify-center py-4">
                                Book free measure
                            </a>
                        </div>

                        <div class="mt-7 grid gap-3 sm:grid-cols-2">
                            @foreach($mainProduct['features'] as $feature)
                                <div class="border border-mega-line bg-mega-soft p-4 text-sm font-medium text-mega-text radius-7">
                                    {{ $feature }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-mega-cream py-16 md:py-20">
        <div class="site-container">
            <div class="grid gap-10 lg:grid-cols-[0.9fr_1.1fr]">
                <div>
                    <div class="section-label">Best for</div>
                    <h2 class="section-title">Where {{ strtolower($category['name']) }} works best.</h2>
                    <p class="section-text">
                        This section helps customers understand whether this flooring type is suitable for their space before they enquire.
                    </p>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    @foreach($category['best_for'] as $item)
                        <div class="clean-card p-5">
                            <div class="mb-4 flex h-10 w-10 items-center justify-center border border-mega-line text-mega-orange radius-7">
                                <svg class="thin-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path d="M20 6L9 17l-5-5" />
                                </svg>
                            </div>

                            <h3 class="text-xl">{{ $item }}</h3>
                            <p class="mt-2 text-sm leading-6">
                                Suitable for customers who need a practical and comfortable flooring solution.
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white py-16 md:py-20">
        <div class="site-container">
            <div class="mb-10 flex flex-col justify-between gap-6 lg:flex-row lg:items-end">
                <div>
                    <div class="section-label">More from {{ $category['name'] }}</div>
                    <h2 class="section-title">Compare similar products.</h2>
                </div>

                <a href="{{ route('frontend.products') }}" class="btn-light w-fit">View all products</a>
            </div>

            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($categoryProducts as $product)
                    <article class="clean-card clean-card-hover overflow-hidden">
                        <img src="{{ $product['images'][0] }}" alt="{{ $product['name'] }}" class="h-64 w-full object-cover">

                        <div class="p-5">
                            <p class="mb-3 text-xs font-medium uppercase tracking-[0.2em] text-mega-orange">
                                {{ $product['badge'] }}
                            </p>

                            <h3 class="text-2xl">{{ $product['name'] }}</h3>
                            <p class="mt-3 text-sm leading-6">{{ $product['short'] }}</p>

                            <a href="{{ route('frontend.product.show', $product['category_slug']) }}" class="mt-5 inline-flex items-center gap-2 text-sm font-medium text-mega-orange">
                                View details
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

    <section class="bg-mega-black py-16 text-white md:py-20">
        <div class="site-container">
            <div class="grid gap-8 lg:grid-cols-[1fr_0.7fr] lg:items-center">
                <div>
                    <p class="text-xs font-medium uppercase tracking-[0.22em] text-mega-orange">
                        Need exact pricing?
                    </p>

                    <h2 class="mt-4 text-3xl leading-tight text-white md:text-4xl">
                        Book a measure and quote for final pricing.
                    </h2>

                    <p class="mt-4 max-w-2xl text-base leading-7 text-white/60">
                        The estimate is helpful for browsing. Final pricing depends on room size, product choice, installation and site condition.
                    </p>
                </div>

                <div class="flex flex-col gap-3 sm:flex-row lg:justify-end">
                    <a href="{{ route('frontend.quote') }}" class="btn-primary">
                        Book free quote
                    </a>

                    <a href="{{ route('frontend.mobile-showroom') }}" class="btn-light border-white/20 bg-white/10 text-white hover:bg-white hover:text-mega-black">
                        Mobile showroom
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection