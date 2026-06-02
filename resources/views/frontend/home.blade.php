@extends('layouts.frontend')

@section('title', 'Mega Carpets | Premium Carpet, Vinyl, Timber & Rugs')
@section('meta_description', 'Premium flooring showroom for carpet, hybrid, timber, laminate, vinyl and rugs with free measure and quote.')

@section('content')

@php
    $heroSlides = [
        [
            'title' => 'Premium living room flooring',
            'image' => 'https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?auto=format&fit=crop&w=1900&q=90',
        ],
        [
            'title' => 'Modern timber and hybrid flooring',
            'image' => 'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?auto=format&fit=crop&w=1900&q=90',
        ],
        [
            'title' => 'Soft rugs for finished interiors',
            'image' => 'https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?auto=format&fit=crop&w=1900&q=90',
        ],
    ];

    $products = [
        [
            'name' => 'Terra Verde',
            'category' => 'Carpet',
            'category_slug' => 'carpet',
            'image' => 'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?auto=format&fit=crop&w=1200&q=85',
            'short' => 'Soft textured carpet for warm bedrooms and quiet family spaces.',
            'badge' => 'Soft comfort',
            'colours' => [
                ['name' => 'Mist', 'swatch' => '#c8c2b7'],
                ['name' => 'Sand', 'swatch' => '#b9ad9d'],
                ['name' => 'Stone', 'swatch' => '#9c968d'],
                ['name' => 'Taupe', 'swatch' => '#8d8074'],
                ['name' => 'Clay', 'swatch' => '#a6917c'],
                ['name' => 'Graphite', 'swatch' => '#655f58'],
            ],
            'sizes' => [
                ['label' => 'Small room', 'price' => 390.00, 'regular' => 520.00],
                ['label' => 'Bedroom', 'price' => 680.00, 'regular' => 890.00],
                ['label' => 'Living room', 'price' => 1180.00, 'regular' => 1490.00],
                ['label' => 'Whole home', 'price' => 2890.00, 'regular' => 3490.00],
            ],
        ],
        [
            'name' => 'Bali',
            'category' => 'Rugs',
            'category_slug' => 'rugs',
            'image' => 'https://images.unsplash.com/photo-1600121848594-d8644e57abab?auto=format&fit=crop&w=1200&q=85',
            'short' => 'A calm premium rug range for modern living rooms.',
            'badge' => 'Designer rug',
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
        ],
        [
            'name' => 'Rogue',
            'category' => 'Rugs',
            'category_slug' => 'rugs',
            'image' => 'https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?auto=format&fit=crop&w=1200&q=85',
            'short' => 'A refined patterned rug with soft neutral colourways.',
            'badge' => 'Featured',
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
            ],
        ],
        [
            'name' => 'Homescapes LVP',
            'category' => 'Vinyl',
            'category_slug' => 'vinyl',
            'image' => 'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?auto=format&fit=crop&w=1200&q=85',
            'short' => 'Practical timber-look vinyl plank flooring for homes.',
            'badge' => 'Low maintenance',
            'colours' => [
                ['name' => 'Natural Oak', 'swatch' => '#c7ad85'],
                ['name' => 'Warm Oak', 'swatch' => '#b99162'],
                ['name' => 'Beige', 'swatch' => '#d2bd9f'],
                ['name' => 'Weathered', 'swatch' => '#9c8d79'],
                ['name' => 'Honey', 'swatch' => '#b98754'],
                ['name' => 'Walnut', 'swatch' => '#7d5b3e'],
            ],
            'sizes' => [
                ['label' => 'Small room', 'price' => 720.00, 'regular' => 920.00],
                ['label' => 'Bedroom', 'price' => 980.00, 'regular' => 1290.00],
                ['label' => 'Living room', 'price' => 1580.00, 'regular' => 1990.00],
                ['label' => 'Whole home', 'price' => 3890.00, 'regular' => 4690.00],
            ],
        ],
        [
            'name' => 'Nordic Oak',
            'category' => 'Hybrid',
            'category_slug' => 'hybrid-flooring',
            'image' => 'https://images.unsplash.com/photo-1600607688969-a5bfcd646154?auto=format&fit=crop&w=1200&q=85',
            'short' => 'Durable hybrid flooring with a soft timber look.',
            'badge' => 'Family ready',
            'colours' => [
                ['name' => 'Snow Oak', 'swatch' => '#ddd1bf'],
                ['name' => 'Scandi', 'swatch' => '#cbb59b'],
                ['name' => 'Natural', 'swatch' => '#b3916f'],
                ['name' => 'Pebble', 'swatch' => '#998a7b'],
            ],
            'sizes' => [
                ['label' => 'Small room', 'price' => 790.00, 'regular' => 1020.00],
                ['label' => 'Bedroom', 'price' => 1090.00, 'regular' => 1390.00],
                ['label' => 'Living room', 'price' => 1690.00, 'regular' => 2190.00],
                ['label' => 'Whole home', 'price' => 4190.00, 'regular' => 4990.00],
            ],
        ],
        [
            'name' => 'Urban Mist',
            'category' => 'Carpet',
            'category_slug' => 'carpet',
            'image' => 'https://images.unsplash.com/photo-1600210492493-0946911123ea?auto=format&fit=crop&w=1200&q=85',
            'short' => 'Modern carpet range with balanced neutral tones.',
            'badge' => 'Modern tone',
            'colours' => [
                ['name' => 'Cloud', 'swatch' => '#d4d0cb'],
                ['name' => 'Silver', 'swatch' => '#b6b1ab'],
                ['name' => 'Smoke', 'swatch' => '#8d8781'],
                ['name' => 'Charcoal', 'swatch' => '#5f5b58'],
            ],
            'sizes' => [
                ['label' => 'Small room', 'price' => 420.00, 'regular' => 560.00],
                ['label' => 'Bedroom', 'price' => 710.00, 'regular' => 920.00],
                ['label' => 'Living room', 'price' => 1210.00, 'regular' => 1540.00],
                ['label' => 'Whole home', 'price' => 2960.00, 'regular' => 3580.00],
            ],
        ],
        [
            'name' => 'Coastal Timber',
            'category' => 'Timber',
            'category_slug' => 'timber',
            'image' => 'https://images.unsplash.com/photo-1600566753086-00f18fb6b3ea?auto=format&fit=crop&w=1200&q=85',
            'short' => 'Premium timber finish with warmth and natural character.',
            'badge' => 'Premium timber',
            'colours' => [
                ['name' => 'Light Oak', 'swatch' => '#d0b28d'],
                ['name' => 'Natural', 'swatch' => '#b78e61'],
                ['name' => 'Sand Drift', 'swatch' => '#cab08e'],
                ['name' => 'Smoked Oak', 'swatch' => '#8a6b4f'],
            ],
            'sizes' => [
                ['label' => 'Small room', 'price' => 990.00, 'regular' => 1290.00],
                ['label' => 'Bedroom', 'price' => 1490.00, 'regular' => 1890.00],
                ['label' => 'Living room', 'price' => 2290.00, 'regular' => 2790.00],
                ['label' => 'Whole home', 'price' => 5290.00, 'regular' => 6290.00],
            ],
        ],
        [
            'name' => 'Sierra Laminate',
            'category' => 'Laminate',
            'category_slug' => 'laminate',
            'image' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1200&q=85',
            'short' => 'Affordable laminate flooring with a crisp timber style.',
            'badge' => 'Budget smart',
            'colours' => [
                ['name' => 'Ash Wood', 'swatch' => '#c8b7a0'],
                ['name' => 'Walnut', 'swatch' => '#b6916a'],
                ['name' => 'Beige', 'swatch' => '#d2c2a8'],
                ['name' => 'Smoke', 'swatch' => '#8e7358'],
            ],
            'sizes' => [
                ['label' => 'Small room', 'price' => 650.00, 'regular' => 820.00],
                ['label' => 'Bedroom', 'price' => 920.00, 'regular' => 1190.00],
                ['label' => 'Living room', 'price' => 1490.00, 'regular' => 1850.00],
                ['label' => 'Whole home', 'price' => 3650.00, 'regular' => 4290.00],
            ],
        ],
    ];

    $services = [
        [
            'title' => 'Supply & Install',
            'text' => 'A complete flooring process from product choice to installation support.',
        ],
        [
            'title' => 'Mobile Showroom',
            'text' => 'Bring flooring samples to the customer so they can compare colours at home.',
        ],
        [
            'title' => 'Commercial Flooring',
            'text' => 'Practical flooring advice for shops, offices, rental spaces and commercial fit-outs.',
        ],
        [
            'title' => 'Rental Property Flooring',
            'text' => 'Durable flooring options for property managers and landlords.',
        ],
    ];

    $ideas = [
        [
            'title' => 'Living room flooring ideas',
            'text' => 'Choose flooring that feels warm, practical and visually calm.',
            'image' => 'https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?auto=format&fit=crop&w=900&q=80',
        ],
        [
            'title' => 'Bedroom carpet guide',
            'text' => 'Soft textures and neutral colours for a quieter sleeping space.',
            'image' => 'https://images.unsplash.com/photo-1616594039964-ae9021a400a0?auto=format&fit=crop&w=900&q=80',
        ],
        [
            'title' => 'Colour guide for modern homes',
            'text' => 'How to match flooring tones with walls, furniture and light.',
            'image' => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?auto=format&fit=crop&w=900&q=80',
        ],
    ];
@endphp

{{-- Full Background Hero Slider --}}
<section
    x-data="{
        activeSlide: 0,
        slides: @js($heroSlides),
        interval: null,
        start() {
            this.interval = setInterval(() => {
                this.next();
            }, 5000);
        },
        stop() {
            clearInterval(this.interval);
        },
        next() {
            this.activeSlide = (this.activeSlide + 1) % this.slides.length;
        },
        previous() {
            this.activeSlide = this.activeSlide === 0 ? this.slides.length - 1 : this.activeSlide - 1;
        },
        goTo(index) {
            this.activeSlide = index;
        }
    }"
    x-init="start()"
    @mouseenter="stop()"
    @mouseleave="start()"
    class="relative min-h-[calc(100vh-118px)] overflow-hidden bg-mega-black lg:min-h-[calc(100vh-180px)]"
>
    <div class="absolute inset-0">
        <template x-for="(slide, index) in slides" :key="index">
            <div
                x-show="activeSlide === index"
                x-transition.opacity.duration.700ms
                class="absolute inset-0"
            >
                <img
                    :src="slide.image"
                    :alt="slide.title"
                    class="h-full w-full object-cover"
                >
            </div>
        </template>
    </div>

    <div class="absolute inset-0 bg-gradient-to-r from-black/50 via-black/18 to-transparent"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent"></div>

    <div class="site-container relative z-10">
        <div class="flex min-h-[calc(100vh-118px)] items-center py-16 lg:min-h-[calc(100vh-180px)]">
            <div class="max-w-3xl">
                <div class="inline-flex items-center gap-2 border border-white/25 bg-white/15 px-4 py-2 text-xs font-medium uppercase tracking-[0.22em] text-white backdrop-blur-md radius-7">
                    <svg class="h-4 w-4 text-mega-orange" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M12 2l2.1 6.4H21l-5.5 4 2.1 6.6-5.6-4.1L6.4 19l2.1-6.6L3 8.4h6.9L12 2z" />
                    </svg>
                    Premium flooring showroom
                </div>

                <h1 class="mt-6 max-w-3xl text-[42px] leading-[1.03] tracking-[-0.04em] text-white drop-shadow-sm sm:text-6xl lg:text-[78px]">
                    Flooring that makes every room feel finished.
                </h1>

                <p class="mt-6 max-w-2xl text-base leading-8 text-white/88 drop-shadow-sm md:text-lg">
                    Browse carpet, hybrid, timber, laminate, vinyl and rugs. Then book a free measure and quote with real samples, clear advice and installation support.
                </p>

                <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                    <a href="#quote" class="btn-primary">
                        Book a free consultation
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M5 12h14" />
                            <path d="M13 6l6 6-6 6" />
                        </svg>
                    </a>

                    <a href="{{ route('frontend.products') }}" class="inline-flex items-center justify-center gap-2 border border-white/35 bg-white/18 px-5 py-3 text-sm font-medium text-white backdrop-blur-md transition hover:bg-white hover:text-mega-black radius-7">
                        Explore products
                    </a>
                </div>
            </div>
        </div>
    </div>

    <button
        type="button"
        @click="previous()"
        class="absolute left-4 top-1/2 z-20 hidden h-11 w-11 -translate-y-1/2 items-center justify-center border border-white/45 bg-white/20 text-white backdrop-blur-md transition hover:bg-white hover:text-mega-black radius-7 md:flex"
        aria-label="Previous slide"
    >
        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
            <path d="M15 18l-6-6 6-6" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    </button>

    <button
        type="button"
        @click="next()"
        class="absolute right-4 top-1/2 z-20 hidden h-11 w-11 -translate-y-1/2 items-center justify-center border border-white/45 bg-white/20 text-white backdrop-blur-md transition hover:bg-white hover:text-mega-black radius-7 md:flex"
        aria-label="Next slide"
    >
        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
            <path d="M9 18l6-6-6-6" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    </button>

    <div class="absolute bottom-7 left-1/2 z-20 flex -translate-x-1/2 items-center gap-2 rounded-full border border-white/25 bg-white/20 px-3 py-2 backdrop-blur-md">
        <template x-for="(slide, index) in slides" :key="index">
            <button
                type="button"
                @click="goTo(index)"
                class="h-2.5 rounded-full transition-all"
                :class="activeSlide === index ? 'w-8 bg-mega-orange' : 'w-2.5 bg-white/75 hover:bg-white'"
                aria-label="Go to slide"
            ></button>
        </template>
    </div>
</section>

{{-- Compact Product Section --}}
<section id="products" class="bg-white py-16 md:py-24">
    <div class="site-container">
        <div class="mb-10 flex flex-col justify-between gap-5 md:flex-row md:items-end">
            <div>
                <div class="section-label">Featured products</div>
                <h2 class="section-title">Choose colour, size and estimate instantly.</h2>
                <p class="section-text">
                    Smaller premium product cards for fast browsing. Customers can choose a colour, select a size and view an estimated price.
                </p>
            </div>

            <a href="{{ route('frontend.products') }}" class="btn-light w-fit">
                View all products
            </a>
        </div>

        <div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-4">
            @foreach($products as $product)
                <article
                    x-data="{
                        selectedColour: null,
                        selectedSize: '',
                        sizes: @js($product['sizes']),
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
                        }
                    }"
                    class="group flex min-h-full flex-col overflow-hidden border border-mega-line bg-white shadow-[0_12px_35px_rgba(7,7,7,0.06)] transition duration-300 hover:-translate-y-1 hover:shadow-[0_22px_60px_rgba(7,7,7,0.10)] radius-7"
                >
                    <div class="relative h-52 overflow-hidden bg-mega-soft">
                        <img
                            src="{{ $product['image'] }}"
                            alt="{{ $product['name'] }}"
                            class="h-full w-full object-cover transition duration-700 group-hover:scale-105"
                        >

                        <div class="absolute left-4 top-4 bg-white/95 px-3 py-2 text-[10px] font-medium uppercase tracking-[0.22em] text-mega-orange shadow-sm radius-7">
                            {{ $product['badge'] }}
                        </div>

                        <div class="absolute bottom-4 left-4 bg-mega-black/88 px-3 py-2 text-[11px] font-medium text-white radius-7">
                            {{ $product['category'] }}
                        </div>
                    </div>

                    <div class="flex flex-1 flex-col p-4">
                        <div class="flex items-start justify-between gap-3">
                            <div class="min-w-0">
                                <p class="mb-2 text-[10px] font-medium uppercase tracking-[0.22em] text-mega-orange">
                                    Mega Carpets
                                </p>

                                <h3 class="text-[23px] leading-[1.05] tracking-tight text-mega-black">
                                    {{ $product['name'] }}
                                </h3>
                            </div>

                            <div class="flex shrink-0 items-center gap-2">
                                <button type="button" class="flex h-9 w-9 items-center justify-center border border-mega-line text-mega-text transition hover:border-mega-orange hover:text-mega-orange radius-7">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                                        <path d="M7 7h10M7 7l3-3M7 7l3 3" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M17 17H7M17 17l-3-3M17 17l-3 3" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>

                                <button type="button" class="flex h-9 w-9 items-center justify-center border border-mega-line text-mega-text transition hover:border-mega-orange hover:text-mega-orange radius-7">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                                        <path d="M20.8 5.6c-1.6-1.8-4.2-1.9-5.9-.2L12 8.3 9.1 5.4C7.4 3.7 4.8 3.8 3.2 5.6c-1.7 2-1.5 5 .4 6.9L12 21l8.4-8.5c1.9-1.9 2.1-4.9.4-6.9z" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <p class="mt-3 text-sm leading-6 text-mega-muted">
                            {{ $product['short'] }}
                        </p>

                        <div class="mt-4">
                            <p class="mb-2 text-sm font-medium text-mega-muted">
                                <span x-text="selectedColour ? 'Colour ' + selectedColour.name : 'Colour'"></span>
                            </p>

                            <div class="flex flex-wrap gap-2">
                                @foreach($product['colours'] as $colour)
                                    <button
                                        type="button"
                                        @click="chooseColour(@js($colour))"
                                        :class="selectedColour && selectedColour.name === '{{ $colour['name'] }}'
                                            ? 'border-mega-orange ring-4 ring-orange-500/15'
                                            : 'border-mega-line hover:border-mega-orange'"
                                        class="h-9 w-9 border bg-white p-1 transition radius-7"
                                        title="{{ $colour['name'] }}"
                                    >
                                        <span class="block h-full w-full radius-7" style="background: {{ $colour['swatch'] }};"></span>
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        <div class="mt-4">
                            <label class="mb-2 block text-sm font-medium text-mega-muted">
                                {{ $product['category'] === 'Rugs' ? 'Size' : 'Room Size' }}
                            </label>

                            <div class="relative">
                                <select
                                    x-model="selectedSize"
                                    :disabled="!selectedColour"
                                    class="w-full appearance-none border border-mega-line bg-mega-soft px-4 py-3 pr-10 text-sm font-medium text-mega-black outline-none transition focus:border-mega-orange focus:bg-white focus:ring-4 focus:ring-orange-500/10 disabled:cursor-not-allowed disabled:text-mega-muted/35 radius-7"
                                >
                                    <option value="">Choose an option...</option>
                                    @foreach($product['sizes'] as $size)
                                        <option value="{{ $size['label'] }}">
                                            {{ $size['label'] }}
                                        </option>
                                    @endforeach
                                </select>

                                <svg class="pointer-events-none absolute right-3 top-1/2 h-4 w-4 -translate-y-1/2 text-mega-text" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                                    <path d="M6 9l6 6 6-6" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>

                            <p x-show="!selectedColour" x-cloak class="mt-2 text-xs text-red-500">
                                Select a colour first.
                            </p>
                        </div>

                        <div x-show="selectedSizeItem" x-transition x-cloak class="mt-4 border border-mega-line bg-mega-cream p-3 radius-7">
                            <div class="flex items-end justify-between gap-3">
                                <div>
                                    <p class="text-xs font-medium uppercase tracking-[0.12em] text-mega-muted">Special Price</p>
                                    <p class="mt-1 text-2xl font-medium text-red-500" x-text="money(selectedSizeItem?.price)"></p>
                                </div>

                                <div class="text-right">
                                    <p class="text-xs font-medium uppercase tracking-[0.12em] text-mega-muted">Regular</p>
                                    <p class="mt-1 text-lg font-medium text-mega-text line-through" x-text="money(selectedSizeItem?.regular)"></p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-auto pt-5">
                            <div class="flex items-center justify-between gap-3">
                                <a href="{{ route('frontend.product.show', $product['category_slug']) }}" class="inline-flex items-center gap-2 text-sm font-medium text-mega-black transition hover:text-mega-orange">
                                    Product details
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                        <path d="M5 12h14" />
                                        <path d="M13 6l6 6-6 6" />
                                    </svg>
                                </a>

                                <a
                                    href="{{ route('frontend.quote') }}"
                                    :class="selectedColour && selectedSize ? 'bg-mega-orange text-white hover:bg-mega-orangeDark' : 'bg-mega-soft text-mega-muted pointer-events-none'"
                                    class="inline-flex items-center justify-center gap-2 px-3 py-2.5 text-xs font-medium transition radius-7"
                                >
                                    Estimate
                                </a>
                            </div>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section id="services" class="bg-mega-cream py-16 md:py-24">
    <div class="site-container">
        <div class="grid gap-10 lg:grid-cols-[0.8fr_1.2fr] lg:items-start">
            <div>
                <div class="section-label">Services</div>
                <h2 class="section-title">Not just flooring. A complete buying journey.</h2>
                <p class="section-text">
                    The website should guide visitors from product discovery to quote request. This is why service blocks are important for trust and conversion.
                </p>
            </div>

            <div class="grid gap-5 sm:grid-cols-2">
                @foreach($services as $service)
                    <div class="clean-card p-6">
                        <div class="mb-5 flex h-11 w-11 items-center justify-center border border-mega-line text-mega-orange radius-7">
                            <svg class="thin-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path d="M4 7h16M4 12h16M4 17h10" />
                            </svg>
                        </div>

                        <h3 class="text-2xl">{{ $service['title'] }}</h3>
                        <p class="mt-3 text-sm leading-6">
                            {{ $service['text'] }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<section id="mobile-showroom" class="bg-white py-16 md:py-24">
    <div class="site-container">
        <div class="grid gap-10 lg:grid-cols-2 lg:items-center">
            <div class="grid grid-cols-2 gap-4">
                <img
                    src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=900&q=80"
                    alt="Home flooring consultation"
                    class="h-[420px] w-full object-cover radius-7"
                >

                <div class="space-y-4">
                    <img
                        src="https://images.unsplash.com/photo-1600566752355-35792bedcfea?auto=format&fit=crop&w=900&q=80"
                        alt="Flooring interior"
                        class="h-[202px] w-full object-cover radius-7"
                    >

                    <div class="bg-mega-black p-6 text-white radius-7">
                        <p class="text-xs uppercase tracking-[0.2em] text-mega-orange">At home</p>
                        <h3 class="mt-3 text-2xl leading-tight text-white">
                            See samples in your real light.
                        </h3>
                    </div>
                </div>
            </div>

            <div>
                <div class="section-label">Mobile showroom</div>
                <h2 class="section-title">Bring the showroom experience to the customer.</h2>
                <p class="section-text">
                    Customers can request a mobile showroom visit, compare samples at home, discuss installation and receive a practical quote.
                </p>

                <div class="mt-8 grid gap-4">
                    @foreach([
                        ['step' => '1', 'title' => 'Choose your product interest', 'text' => 'Carpet, timber, hybrid, vinyl, laminate or rugs.'],
                        ['step' => '2', 'title' => 'Book a free measure', 'text' => 'The customer submits their location and basic project details.'],
                        ['step' => '3', 'title' => 'Receive advice and quote', 'text' => 'Mega Carpets follows up with product advice and installation support.'],
                    ] as $step)
                        <div class="flex gap-4">
                            <div class="flex h-9 w-9 shrink-0 items-center justify-center border border-mega-line text-mega-orange radius-7">
                                {{ $step['step'] }}
                            </div>

                            <div>
                                <h4 class="text-lg font-medium">{{ $step['title'] }}</h4>
                                <p class="mt-1 text-sm leading-6">{{ $step['text'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <a href="#quote" class="btn-primary mt-8">
                    Request mobile showroom visit
                </a>
            </div>
        </div>
    </div>
</section>

<section id="inspiration" class="bg-mega-soft py-16 md:py-24">
    <div class="site-container">
        <div class="flex flex-col justify-between gap-6 lg:flex-row lg:items-end">
            <div>
                <div class="section-label">Inspiration</div>
                <h2 class="section-title">Ideas that help customers decide faster.</h2>
                <p class="section-text">
                    Inspiration content makes the site feel more premium and helps future SEO pages target room-based searches.
                </p>
            </div>

            <a href="{{ route('frontend.inspiration') }}" class="btn-light w-fit">
                View all ideas
            </a>
        </div>

        <div class="mt-10 grid gap-5 lg:grid-cols-3">
            @foreach($ideas as $idea)
                <article class="clean-card clean-card-hover overflow-hidden">
                    <img
                        src="{{ $idea['image'] }}"
                        alt="{{ $idea['title'] }}"
                        class="h-64 w-full object-cover"
                    >

                    <div class="p-5">
                        <h3 class="text-2xl leading-tight">{{ $idea['title'] }}</h3>
                        <p class="mt-3 text-sm leading-6">{{ $idea['text'] }}</p>

                        <a href="{{ route('frontend.inspiration') }}" class="mt-5 inline-flex items-center gap-2 text-sm font-medium text-mega-orange">
                            Read guide
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

<section id="store" class="bg-white py-16 md:py-24">
    <div class="site-container">
        <div class="clean-card overflow-hidden">
            <div class="grid lg:grid-cols-[0.9fr_1.1fr]">
                <div class="bg-mega-black p-8 text-white md:p-12">
                    <div class="section-label text-white/70">Local store</div>
                    <h2 class="text-3xl leading-tight text-white md:text-4xl">
                        Built for Melbourne-focused local enquiries.
                    </h2>

                    <p class="mt-5 max-w-xl text-base leading-7 text-white/65">
                        Later you can create location pages such as Carpet Melbourne, Carpet Essendon, Carpet Niddrie and Hybrid Flooring Melbourne.
                    </p>

                    <div class="mt-8 grid gap-3 text-sm text-white/75">
                        <div class="flex items-center gap-3">
                            <svg class="thin-icon text-mega-orange" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path d="M12 21s7-5.2 7-12a7 7 0 1 0-14 0c0 6.8 7 12 7 12z" />
                                <circle cx="12" cy="9" r="2.5" />
                            </svg>
                            Search by suburb or postcode
                        </div>

                        <div class="flex items-center gap-3">
                            <svg class="thin-icon text-mega-orange" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path d="M4 4h16v16H4z" />
                                <path d="M8 10h8M8 14h5" />
                            </svg>
                            View local showroom services
                        </div>

                        <div class="flex items-center gap-3">
                            <svg class="thin-icon text-mega-orange" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path d="M5 12h14" />
                                <path d="M13 6l6 6-6 6" />
                            </svg>
                            Book measure and quote
                        </div>
                    </div>
                </div>

                <div class="bg-mega-cream p-8 md:p-12">
                    <form class="grid gap-4">
                        <div>
                            <label class="mb-2 block text-sm font-medium text-mega-text">
                                Search suburb or postcode
                            </label>
                            <input type="text" class="input-clean" placeholder="Example: Melbourne, Essendon, Niddrie">
                        </div>

                        <button type="button" class="btn-primary w-fit">
                            Find local service area
                        </button>
                    </form>

                    <div class="mt-8 grid gap-4 sm:grid-cols-2">
                        <div class="bg-white p-5 radius-7">
                            <p class="text-xs uppercase tracking-[0.2em] text-mega-orange">Service area</p>
                            <h3 class="mt-2 text-xl">Melbourne</h3>
                            <p class="mt-2 text-sm leading-6">Carpet, vinyl, timber and quote support.</p>
                        </div>

                        <div class="bg-white p-5 radius-7">
                            <p class="text-xs uppercase tracking-[0.2em] text-mega-orange">Popular page</p>
                            <h3 class="mt-2 text-xl">Carpet Essendon</h3>
                            <p class="mt-2 text-sm leading-6">Local landing page structure for SEO.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="reviews" class="bg-mega-cream py-16 md:py-24">
    <div class="site-container">
        <div class="mx-auto max-w-3xl text-center">
            <div class="section-label justify-center">Customer trust</div>
            <h2 class="section-title">A calmer showroom experience for serious flooring buyers.</h2>
            <p class="section-text mx-auto">
                Reviews, guarantees, product advice and installation support help make the website feel reliable.
            </p>
        </div>

        <div class="mt-10 grid gap-5 lg:grid-cols-3">
            @foreach([
                ['name' => 'Sarah M.', 'text' => 'The mobile showroom made it easy to compare carpet colours at home before choosing.'],
                ['name' => 'Daniel K.', 'text' => 'Clear advice, simple quote process and a much better experience than guessing online.'],
                ['name' => 'Emma R.', 'text' => 'The team explained the difference between hybrid, vinyl and timber in a practical way.'],
            ] as $review)
                <div class="clean-card p-6">
                    <div class="mb-5 flex gap-1 text-mega-orange">
                        @for($i = 0; $i < 5; $i++)
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2l2.7 6.8L22 9.3l-5.6 4.7 1.8 7L12 17.2 5.8 21l1.8-7L2 9.3l7.3-.5L12 2z" />
                            </svg>
                        @endfor
                    </div>

                    <p class="text-sm leading-7">“{{ $review['text'] }}”</p>
                    <h4 class="mt-5 text-base font-medium text-mega-black">{{ $review['name'] }}</h4>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section id="quote" class="bg-white py-16 md:py-24">
    <div class="site-container">
        <div class="grid gap-10 lg:grid-cols-[0.85fr_1.15fr]">
            <div>
                <div class="section-label">Free measure & quote</div>
                <h2 class="section-title">Turn website visitors into real enquiries.</h2>
                <p class="section-text">
                    This form is frontend-only for now. Later we will connect it with Laravel validation, database storage, email notification and admin quote management.
                </p>

                <div class="mt-8 space-y-4">
                    @foreach([
                        'Free local measure and quote request',
                        'Upload existing quote option can be added later',
                        'Admin panel can track new, contacted and completed leads',
                    ] as $point)
                        <div class="flex gap-3">
                            <svg class="thin-icon mt-1 text-mega-orange" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path d="M20 6L9 17l-5-5" />
                            </svg>
                            <p class="text-sm leading-6">{{ $point }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <form class="clean-card p-6 md:p-8">
                <div class="grid gap-5 md:grid-cols-2">
                    <div>
                        <label class="mb-2 block text-sm font-medium text-mega-text">Full name</label>
                        <input type="text" class="input-clean" placeholder="Your name">
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-medium text-mega-text">Phone number</label>
                        <input type="text" class="input-clean" placeholder="Phone number">
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-medium text-mega-text">Email address</label>
                        <input type="email" class="input-clean" placeholder="Email address">
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-medium text-mega-text">Location</label>
                        <input type="text" class="input-clean" placeholder="Suburb or postcode">
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-medium text-mega-text">Product interest</label>
                        <select class="input-clean">
                            <option>Carpet</option>
                            <option>Hybrid Flooring</option>
                            <option>Timber</option>
                            <option>Laminate</option>
                            <option>Vinyl</option>
                            <option>Rugs</option>
                            <option>Not sure yet</option>
                        </select>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-medium text-mega-text">Preferred service</label>
                        <select class="input-clean">
                            <option>Free measure & quote</option>
                            <option>Mobile showroom visit</option>
                            <option>Product advice</option>
                            <option>Commercial flooring</option>
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label class="mb-2 block text-sm font-medium text-mega-text">Project details</label>
                        <textarea rows="5" class="input-clean" placeholder="Tell us about your room, property type, size or preferred flooring style"></textarea>
                    </div>
                </div>

                <button type="button" class="btn-primary mt-6">
                    Submit quote request
                </button>
            </form>
        </div>
    </div>
</section>

@endsection