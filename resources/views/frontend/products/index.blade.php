@extends('layouts.frontend')

@section('title', 'Products | Mega Carpets')
@section('meta_description', 'Explore carpet, hybrid flooring, timber, laminate, vinyl and rugs from Mega Carpets.')

@section('content')

    @php
        $products = [
            [
                'name' => 'Terra Verde',
                'category' => 'Carpet',
                'category_slug' => 'carpet',
                'image' => 'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?auto=format&fit=crop&w=1200&q=85',
                'short' => 'Soft textured carpet designed for warm bedrooms and quiet family spaces.',
                'badge' => 'Soft comfort',
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
            ],
            [
                'name' => 'Bali',
                'category' => 'Rugs',
                'category_slug' => 'rugs',
                'image' => 'https://images.unsplash.com/photo-1600121848594-d8644e57abab?auto=format&fit=crop&w=1200&q=85',
                'short' => 'A calm premium rug range for modern living rooms and relaxed interiors.',
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
                'short' => 'A refined patterned rug with soft neutral colourways for finished rooms.',
                'badge' => 'Featured range',
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
            ],
            [
                'name' => 'Homescapes Native LVP',
                'category' => 'Vinyl',
                'category_slug' => 'vinyl',
                'image' => 'https://images.unsplash.com/photo-1600607688969-a5bfcd646154?auto=format&fit=crop&w=1200&q=85',
                'short' => 'Practical timber-look vinyl plank flooring for modern homes and rentals.',
                'badge' => 'Low maintenance',
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
            ],
            [
                'name' => 'Oakhaven Hybrid',
                'category' => 'Hybrid Flooring',
                'category_slug' => 'hybrid-flooring',
                'image' => 'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?auto=format&fit=crop&w=1200&q=85',
                'short' => 'Durable hybrid flooring with a clean timber appearance for busy homes.',
                'badge' => 'Family ready',
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
            ],
            [
                'name' => 'Softline Laminate',
                'category' => 'Laminate',
                'category_slug' => 'laminate',
                'image' => 'https://images.unsplash.com/photo-1600566753086-00f18fb6b3ea?auto=format&fit=crop&w=1200&q=85',
                'short' => 'Clean and affordable laminate flooring for practical everyday interiors.',
                'badge' => 'Budget smart',
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
            ],
        ];
    @endphp

    <section class="relative overflow-hidden bg-mega-cream py-16 md:py-24">
        <div class="absolute inset-x-0 top-0 h-40 bg-white"></div>

        <div class="site-container relative">
            <div class="mx-auto max-w-4xl text-center">
                <div class="section-label justify-center">Product ranges</div>

                <h1 class="section-title">
                    Shop carpets, rugs and flooring with live estimate pricing.
                </h1>

                <p class="section-text mx-auto">
                    Choose a colour first, then select a size or room estimate to see the estimated special price. This is a frontend demo and can later connect to database stock, pricing and quote requests.
                </p>
            </div>

            <div class="mt-10 flex flex-wrap justify-center gap-3">
                @foreach(['Carpet', 'Hybrid', 'Timber', 'Laminate', 'Vinyl', 'Rugs'] as $filter)
                    <a href="#featured-products" class="border border-mega-line bg-white px-4 py-2 text-sm font-medium text-mega-text shadow-sm transition hover:border-mega-orange hover:text-mega-orange radius-7">
                        {{ $filter }}
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section id="featured-products" class="bg-white py-16 md:py-20">
        <div class="site-container">
            <div class="mb-10 flex flex-col justify-between gap-5 md:flex-row md:items-end">
                <div>
                    <div class="section-label">Featured products</div>
                    <h2 class="section-title">Select colour, choose size, view estimate.</h2>
                </div>

                <a href="{{ route('frontend.quote') }}" class="btn-primary w-fit">
                    Book free consultation
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M5 12h14" />
                        <path d="M13 6l6 6-6 6" />
                    </svg>
                </a>
            </div>

            <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4">
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
                        class="group flex min-h-full flex-col overflow-hidden border border-mega-line bg-white shadow-[0_20px_55px_rgba(7,7,7,0.08)] transition duration-300 hover:-translate-y-1 hover:shadow-[0_30px_80px_rgba(7,7,7,0.12)] radius-7"
                    >
                        <div class="relative h-72 overflow-hidden bg-mega-soft">
                            <img
                                src="{{ $product['image'] }}"
                                alt="{{ $product['name'] }}"
                                class="h-full w-full object-cover transition duration-700 group-hover:scale-105"
                            >

                            <div class="absolute left-4 top-4 bg-white/95 px-3 py-2 text-[11px] font-medium uppercase tracking-[0.18em] text-mega-orange backdrop-blur radius-7">
                                {{ $product['badge'] }}
                            </div>

                            <div class="absolute bottom-4 left-4 bg-mega-black/85 px-3 py-2 text-xs font-medium text-white backdrop-blur radius-7">
                                {{ $product['category'] }}
                            </div>
                        </div>

                        <div class="flex flex-1 flex-col p-5">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <p class="mb-2 text-[11px] font-medium uppercase tracking-[0.22em] text-mega-orange">
                                        Mega Carpets
                                    </p>

                                    <h3 class="text-3xl leading-[1.05] tracking-tight text-mega-black">
                                        {{ $product['name'] }}
                                    </h3>
                                </div>

                                <div class="flex shrink-0 items-center gap-2">
                                    <button type="button" class="flex h-10 w-10 items-center justify-center border border-mega-line text-mega-text transition hover:border-mega-orange hover:text-mega-orange radius-7">
                                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                                            <path d="M7 7h10M7 7l3-3M7 7l3 3" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M17 17H7M17 17l-3-3M17 17l-3 3" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </button>

                                    <button type="button" class="flex h-10 w-10 items-center justify-center border border-mega-line text-mega-text transition hover:border-mega-orange hover:text-mega-orange radius-7">
                                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                                            <path d="M20.8 5.6c-1.6-1.8-4.2-1.9-5.9-.2L12 8.3 9.1 5.4C7.4 3.7 4.8 3.8 3.2 5.6c-1.7 2-1.5 5 .4 6.9L12 21l8.4-8.5c1.9-1.9 2.1-4.9.4-6.9z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <p class="mt-4 text-sm leading-6 text-mega-muted">
                                {{ $product['short'] }}
                            </p>

                            <div class="mt-5">
                                <div class="mb-3 flex items-center justify-between gap-3">
                                    <p class="text-sm font-medium text-mega-muted">
                                        <span x-text="selectedColour ? 'Colour ' + selectedColour.name : 'Colour'"></span>
                                    </p>

                                    <span x-show="selectedColour" x-cloak class="bg-mega-orange/10 px-2.5 py-1 text-xs font-medium text-mega-orange radius-7">
                                        Selected
                                    </span>
                                </div>

                                <div class="flex flex-wrap gap-2">
                                    @foreach($product['colours'] as $colour)
                                        <button
                                            type="button"
                                            @click='chooseColour(@js($colour))'
                                            :class="selectedColour && selectedColour.name === '{{ $colour['name'] }}'
                                                ? 'border-mega-orange ring-4 ring-orange-500/15'
                                                : 'border-mega-line hover:border-mega-orange'"
                                            class="h-11 w-11 border bg-white p-1 transition radius-7"
                                            title="{{ $colour['name'] }}"
                                        >
                                            <span class="block h-full w-full radius-7" style="background: {{ $colour['swatch'] }};"></span>
                                        </button>
                                    @endforeach
                                </div>
                            </div>

                            <div class="mt-6">
                                <label class="mb-2 block text-sm font-medium text-mega-muted">
                                    {{ $product['category'] === 'Rugs' ? 'Size' : 'Room Size' }}
                                </label>

                                <div class="relative">
                                    <select
                                        x-model="selectedSize"
                                        :disabled="!selectedColour"
                                        class="w-full appearance-none border border-mega-line bg-mega-soft px-4 py-4 pr-11 text-base font-medium text-mega-black outline-none transition focus:border-mega-orange focus:bg-white focus:ring-4 focus:ring-orange-500/10 disabled:cursor-not-allowed disabled:text-mega-muted/35 radius-7"
                                    >
                                        <option value="">Choose an option...</option>
                                        @foreach($product['sizes'] as $size)
                                            <option value="{{ $size['label'] }}">
                                                {{ $size['label'] }}
                                            </option>
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

                            <div x-show="selectedSizeItem" x-transition x-cloak class="mt-6 border border-mega-line bg-mega-cream p-4 radius-7">
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm font-medium text-mega-muted">Special Price</p>
                                        <p class="mt-1 text-3xl font-medium text-red-500" x-text="money(selectedSizeItem?.price)"></p>
                                    </div>

                                    <div class="text-right">
                                        <p class="text-sm font-medium text-mega-muted">Regular Price</p>
                                        <p class="mt-1 text-2xl font-medium text-mega-text line-through" x-text="money(selectedSizeItem?.regular)"></p>
                                    </div>
                                </div>

                                <div class="mt-4 flex items-center overflow-hidden border border-mega-line bg-white radius-7">
                                    <div class="flex h-14 w-20 items-center justify-center bg-red-600 text-white">
                                        <svg class="h-8 w-8" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M3 4h18L9.5 20l1.2-7.2L3 4z" />
                                        </svg>
                                    </div>

                                    <div class="px-4 text-sm font-medium text-mega-black">
                                        Estimate updates after colour and size selection.
                                    </div>
                                </div>
                            </div>

                            <div class="mt-auto pt-6">
                                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                                    <a href="{{ route('frontend.product.show', $product['category_slug']) }}" class="inline-flex items-center gap-2 text-base font-medium text-mega-black transition hover:text-mega-orange">
                                        Product details
                                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                            <path d="M5 12h14" />
                                            <path d="M13 6l6 6-6 6" />
                                        </svg>
                                    </a>

                                    <a
                                        href="{{ route('frontend.quote') }}"
                                        :class="selectedColour && selectedSize ? 'bg-mega-orange text-white hover:bg-mega-orangeDark' : 'bg-mega-soft text-mega-muted pointer-events-none'"
                                        class="inline-flex items-center justify-center gap-2 px-4 py-3 text-sm font-medium transition radius-7"
                                    >
                                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                            <path d="M6 6h15l-2 8H8L6 6z" />
                                            <path d="M6 6L5 3H2" />
                                            <circle cx="9" cy="20" r="1.5" />
                                            <circle cx="18" cy="20" r="1.5" />
                                        </svg>
                                        Add to estimate
                                    </a>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="relative overflow-hidden bg-mega-black py-16 text-white md:py-20">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_80%_20%,rgba(255,90,10,0.25),transparent_30%)]"></div>

        <div class="site-container relative">
            <div class="grid gap-8 lg:grid-cols-[1fr_0.7fr] lg:items-center">
                <div>
                    <p class="text-xs font-medium uppercase tracking-[0.22em] text-mega-orange">
                        Need help choosing?
                    </p>

                    <h2 class="mt-4 text-3xl leading-tight text-white md:text-4xl">
                        Let Mega Carpets help you compare samples before buying.
                    </h2>

                    <p class="mt-4 max-w-2xl text-base leading-7 text-white/60">
                        Customers can request a free measure and quote, then compare carpet, hybrid, vinyl, timber, laminate or rug options with support.
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