@extends('layouts.frontend')

@section('title', 'Mega Carpets | Premium Carpet, Vinyl, Timber & Rugs')
@section('meta_description', 'Premium flooring showroom for carpet, vinyl, timber, laminate and rugs with free measure and quote.')

@section('content')

    @php
        $heroSlides = [
            [
                'eyebrow' => 'Premium flooring showroom',
                'title' => 'Choose a floor. Book a consultation. Get a clear quote.',
                'text' => 'Browse carpet, vinyl, timber and laminate ranges, save your favourites, then request a free measure and quote.',
                'image' => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?auto=format&fit=crop&w=1900&q=90',
            ],
            [
                'eyebrow' => 'Quote-first product journey',
                'title' => 'A showroom experience with stronger visual impact.',
                'text' => 'Clean product cards, premium category blocks, room inspiration and quote-ready product selection.',
                'image' => 'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?auto=format&fit=crop&w=1900&q=90',
            ],
            [
                'eyebrow' => 'Built for flooring enquiries',
                'title' => 'Browse ranges, compare options and save products.',
                'text' => 'Customers select colour, type and price indication before adding products to their quote list.',
                'image' => 'https://images.unsplash.com/photo-1600210491892-03d54c0aaf87?auto=format&fit=crop&w=1900&q=90',
            ],
        ];
        $brandVan = asset('images/Mega small van wrap idea.png');

        $mascotImage = file_exists(public_path('images/mega-mascot.png'))
            ? asset('images/mega-mascot.png')
            : asset('images/mega man logo.png');

        $categories = [
            [
                'name' => 'Carpet',
                'slug' => 'carpet',
                'text' => 'Soft, warm and quiet comfort for bedrooms, lounges and family spaces.',
                'image' => 'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?auto=format&fit=crop&w=1200&q=80',
            ],
            [
                'name' => 'Vinyl',
                'slug' => 'vinyl',
                'text' => 'Water-resistant planks for kitchens, laundries and busy family zones.',
                'image' => 'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?auto=format&fit=crop&w=1200&q=80',
            ],
            [
                'name' => 'Timber',
                'slug' => 'timber',
                'text' => 'Natural character, long-term value and a strong premium interior feel.',
                'image' => 'https://images.unsplash.com/photo-1600210491369-e753d80a41f3?auto=format&fit=crop&w=1200&q=80',
            ],
            [
                'name' => 'Laminate',
                'slug' => 'laminate',
                'text' => 'Practical hard flooring with a clean look and excellent everyday value.',
                'image' => 'https://images.unsplash.com/photo-1616047006789-b7af5afb8c20?auto=format&fit=crop&w=1200&q=80',
            ],
        ];

        $products = [
            [
                'id' => 1,
                'name' => 'First Avenue Plush Carpet',
                'slug' => 'carpet',
                'category' => 'Carpet',
                'room' => 'Bedroom',
                'tag' => 'Best for bedrooms',
                'rating' => 4.9,
                'image' => 'https://images.unsplash.com/photo-1513694203232-719a280e022f?auto=format&fit=crop&w=900&q=80',
                'variants' => [
                    [
                        'name' => 'Warm Beige',
                        'swatch' => '#d8cfc0',
                        'types' => [
                            ['label' => 'Bedroom Supply', 'price' => 42],
                            ['label' => 'Bedroom Supply + Install', 'price' => 68],
                            ['label' => 'Premium Underlay Package', 'price' => 82],
                        ],
                    ],
                    [
                        'name' => 'Soft Taupe',
                        'swatch' => '#b7a896',
                        'types' => [
                            ['label' => 'Bedroom Supply', 'price' => 45],
                            ['label' => 'Bedroom Supply + Install', 'price' => 72],
                            ['label' => 'Premium Underlay Package', 'price' => 86],
                        ],
                    ],
                    [
                        'name' => 'Deep Stone',
                        'swatch' => '#5f544a',
                        'types' => [
                            ['label' => 'Bedroom Supply', 'price' => 48],
                            ['label' => 'Bedroom Supply + Install', 'price' => 75],
                            ['label' => 'Premium Underlay Package', 'price' => 89],
                        ],
                    ],
                ],
            ],
            [
                'id' => 2,
                'name' => 'Avenue Oak Hybrid Vinyl',
                'slug' => 'vinyl',
                'category' => 'Vinyl',
                'room' => 'Kitchen',
                'tag' => 'Water resistant',
                'rating' => 4.8,
                'image' => 'https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?auto=format&fit=crop&w=900&q=80',
                'variants' => [
                    [
                        'name' => 'Honey Oak',
                        'swatch' => '#d9b47f',
                        'types' => [
                            ['label' => 'Kitchen Supply', 'price' => 54],
                            ['label' => 'Kitchen Supply + Install', 'price' => 79],
                            ['label' => 'Waterproof Package', 'price' => 92],
                        ],
                    ],
                    [
                        'name' => 'Natural Oak',
                        'swatch' => '#c3955d',
                        'types' => [
                            ['label' => 'Kitchen Supply', 'price' => 57],
                            ['label' => 'Kitchen Supply + Install', 'price' => 82],
                            ['label' => 'Waterproof Package', 'price' => 95],
                        ],
                    ],
                    [
                        'name' => 'Walnut Oak',
                        'swatch' => '#7e5638',
                        'types' => [
                            ['label' => 'Kitchen Supply', 'price' => 59],
                            ['label' => 'Kitchen Supply + Install', 'price' => 84],
                            ['label' => 'Waterproof Package', 'price' => 98],
                        ],
                    ],
                ],
            ],
            [
                'id' => 3,
                'name' => 'Heritage Blackbutt Timber',
                'slug' => 'timber',
                'category' => 'Timber',
                'room' => 'Living Room',
                'tag' => 'Premium timber',
                'rating' => 4.9,
                'image' => 'https://images.unsplash.com/photo-1600585154526-990dced4db0d?auto=format&fit=crop&w=900&q=80',
                'variants' => [
                    [
                        'name' => 'Blackbutt',
                        'swatch' => '#e0c28e',
                        'types' => [
                            ['label' => 'Living Room Supply', 'price' => 88],
                            ['label' => 'Living Room Supply + Install', 'price' => 118],
                            ['label' => 'Premium Timber Package', 'price' => 135],
                        ],
                    ],
                    [
                        'name' => 'Golden Oak',
                        'swatch' => '#caa46e',
                        'types' => [
                            ['label' => 'Living Room Supply', 'price' => 91],
                            ['label' => 'Living Room Supply + Install', 'price' => 122],
                            ['label' => 'Premium Timber Package', 'price' => 139],
                        ],
                    ],
                    [
                        'name' => 'Warm Walnut',
                        'swatch' => '#755131',
                        'types' => [
                            ['label' => 'Living Room Supply', 'price' => 96],
                            ['label' => 'Living Room Supply + Install', 'price' => 128],
                            ['label' => 'Premium Timber Package', 'price' => 146],
                        ],
                    ],
                ],
            ],
            [
                'id' => 4,
                'name' => 'Metro Stone Laminate',
                'slug' => 'laminate',
                'category' => 'Laminate',
                'room' => 'Hallway',
                'tag' => 'Scratch resistant',
                'rating' => 4.7,
                'image' => 'https://images.unsplash.com/photo-1616137422495-1e9e46e2aa77?auto=format&fit=crop&w=900&q=80',
                'variants' => [
                    [
                        'name' => 'Cool Grey',
                        'swatch' => '#c9c5bb',
                        'types' => [
                            ['label' => 'Hallway Supply', 'price' => 39],
                            ['label' => 'Hallway Supply + Install', 'price' => 61],
                            ['label' => 'Scratch Resistant Package', 'price' => 72],
                        ],
                    ],
                    [
                        'name' => 'Ash Grey',
                        'swatch' => '#9e978e',
                        'types' => [
                            ['label' => 'Hallway Supply', 'price' => 42],
                            ['label' => 'Hallway Supply + Install', 'price' => 64],
                            ['label' => 'Scratch Resistant Package', 'price' => 76],
                        ],
                    ],
                    [
                        'name' => 'Charcoal',
                        'swatch' => '#68615a',
                        'types' => [
                            ['label' => 'Hallway Supply', 'price' => 45],
                            ['label' => 'Hallway Supply + Install', 'price' => 68],
                            ['label' => 'Scratch Resistant Package', 'price' => 81],
                        ],
                    ],
                ],
            ],
            [
                'id' => 5,
                'name' => 'Alpine Wool Blend Carpet',
                'slug' => 'carpet',
                'category' => 'Carpet',
                'room' => 'Living Room',
                'tag' => 'Quiet comfort',
                'rating' => 5.0,
                'image' => 'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?auto=format&fit=crop&w=900&q=80',
                'variants' => [
                    [
                        'name' => 'Soft Cream',
                        'swatch' => '#eee8dd',
                        'types' => [
                            ['label' => 'Living Room Supply', 'price' => 67],
                            ['label' => 'Living Room Supply + Install', 'price' => 94],
                            ['label' => 'Wool Blend Package', 'price' => 108],
                        ],
                    ],
                    [
                        'name' => 'Warm Taupe',
                        'swatch' => '#9d8c78',
                        'types' => [
                            ['label' => 'Living Room Supply', 'price' => 69],
                            ['label' => 'Living Room Supply + Install', 'price' => 98],
                            ['label' => 'Wool Blend Package', 'price' => 112],
                        ],
                    ],
                ],
            ],
            [
                'id' => 6,
                'name' => 'Coastal Oak Laminate',
                'slug' => 'laminate',
                'category' => 'Laminate',
                'room' => 'Dining',
                'tag' => 'Family friendly',
                'rating' => 4.8,
                'image' => 'https://images.unsplash.com/photo-1600210491369-e753d80a41f3?auto=format&fit=crop&w=900&q=80',
                'variants' => [
                    [
                        'name' => 'Coastal Oak',
                        'swatch' => '#f0d5a2',
                        'types' => [
                            ['label' => 'Dining Supply', 'price' => 45],
                            ['label' => 'Dining Supply + Install', 'price' => 69],
                            ['label' => 'Family Package', 'price' => 80],
                        ],
                    ],
                    [
                        'name' => 'Honey Oak',
                        'swatch' => '#b98545',
                        'types' => [
                            ['label' => 'Dining Supply', 'price' => 47],
                            ['label' => 'Dining Supply + Install', 'price' => 72],
                            ['label' => 'Family Package', 'price' => 84],
                        ],
                    ],
                ],
            ],
            [
                'id' => 7,
                'name' => 'Urban Charcoal Vinyl Plank',
                'slug' => 'vinyl',
                'category' => 'Vinyl',
                'room' => 'Bathroom',
                'tag' => 'Wet area choice',
                'rating' => 4.8,
                'image' => 'https://images.unsplash.com/photo-1600573472591-ee6b68d14c68?auto=format&fit=crop&w=900&q=80',
                'variants' => [
                    [
                        'name' => 'Charcoal',
                        'swatch' => '#2b2b2b',
                        'types' => [
                            ['label' => 'Bathroom Supply', 'price' => 52],
                            ['label' => 'Bathroom Supply + Install', 'price' => 77],
                            ['label' => 'Wet Area Package', 'price' => 90],
                        ],
                    ],
                    [
                        'name' => 'Slate Grey',
                        'swatch' => '#595959',
                        'types' => [
                            ['label' => 'Bathroom Supply', 'price' => 55],
                            ['label' => 'Bathroom Supply + Install', 'price' => 81],
                            ['label' => 'Wet Area Package', 'price' => 94],
                        ],
                    ],
                ],
            ],
            [
                'id' => 8,
                'name' => 'Executive Loop Commercial Carpet',
                'slug' => 'carpet',
                'category' => 'Carpet',
                'room' => 'Commercial',
                'tag' => 'Commercial fitout',
                'rating' => 4.7,
                'image' => 'https://images.unsplash.com/photo-1497366754035-f200968a6e72?auto=format&fit=crop&w=900&q=80',
                'variants' => [
                    [
                        'name' => 'Graphite',
                        'swatch' => '#565650',
                        'types' => [
                            ['label' => 'Commercial Supply', 'price' => 49],
                            ['label' => 'Commercial Supply + Install', 'price' => 74],
                            ['label' => 'Heavy Traffic Package', 'price' => 89],
                        ],
                    ],
                    [
                        'name' => 'Charcoal Black',
                        'swatch' => '#292925',
                        'types' => [
                            ['label' => 'Commercial Supply', 'price' => 53],
                            ['label' => 'Commercial Supply + Install', 'price' => 78],
                            ['label' => 'Heavy Traffic Package', 'price' => 93],
                        ],
                    ],
                ],
            ],
        ];

        $services = [
            ['title' => 'Free Measure & Quote', 'text' => 'Customers submit room details and the team follows up with accurate quote support.'],
            ['title' => 'Design Consultation', 'text' => 'Guide buyers by room, colour, material, durability, budget and style direction.'],
            ['title' => 'Supply & Installation', 'text' => 'Position Mega Carpets as a complete flooring partner from selection to installation.'],
            ['title' => 'Commercial Flooring', 'text' => 'Business-ready carpet, vinyl and laminate options for offices, shops and rentals.'],
        ];

        $projects = [
            ['title' => 'Family lounge refresh', 'type' => 'Soft carpet installation', 'location' => 'Residential home', 'image' => 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?auto=format&fit=crop&w=1000&q=80'],
            ['title' => 'Modern apartment upgrade', 'type' => 'Hybrid vinyl planks', 'location' => 'Apartment living', 'image' => 'https://images.unsplash.com/photo-1600607688969-a5bfcd646154?auto=format&fit=crop&w=1000&q=80'],
            ['title' => 'Retail showroom finish', 'type' => 'Laminate and entrance carpet', 'location' => 'Commercial fitout', 'image' => 'https://images.unsplash.com/photo-1600566752355-35792bedcfea?auto=format&fit=crop&w=1000&q=80'],
        ];

        $styles = [
            ['title' => 'Retreat Home', 'text' => 'A calm, layered room direction built around warm flooring, soft rugs and quiet neutral colours.', 'image' => 'https://images.unsplash.com/photo-1600121848594-d8644e57abab?auto=format&fit=crop&w=1200&q=80'],
            ['title' => 'Pick Your Perfect Pile', 'text' => 'A practical guide for customers choosing between plush, loop, twist and wool blend carpets.', 'image' => 'https://images.unsplash.com/photo-1618220179428-22790b461013?auto=format&fit=crop&w=1200&q=80'],
            ['title' => 'Hard Flooring Fit for Purpose', 'text' => 'Help customers compare timber, vinyl and laminate by traffic, moisture, pets and maintenance.', 'image' => 'https://images.unsplash.com/photo-1600607688969-a5bfcd646154?auto=format&fit=crop&w=1200&q=80'],
        ];

        $roomItems = [
            ['type' => 'Curtains/Sheers', 'name' => 'Bali Driftwood', 'color' => '#dcd8cd'],
            ['type' => 'Rugs', 'name' => 'Retreat Weave', 'color' => '#bcae96'],
            ['type' => 'Timber', 'name' => 'Parky Summit', 'color' => '#c9a77b'],
            ['type' => 'Carpet', 'name' => 'Aston Soft Pile', 'color' => '#9e9284'],
        ];

        $faqs = [
            ['question' => 'Can customers buy online?', 'answer' => 'This demo is designed for quote and booking, not direct checkout. Customers save products and request a consultation.'],
            ['question' => 'Can this become a full e-commerce website later?', 'answer' => 'Yes. Cart, payment, delivery and order management can be added later without changing the premium catalogue structure.'],
            ['question' => 'Can the product data come from an admin panel?', 'answer' => 'Yes. Products, rooms, colours, prices and images can later come from Laravel admin.'],
            ['question' => 'Can you add store locations?', 'answer' => 'Yes. The current design includes location CTAs and can be connected to a store locator or Google Maps.'],
        ];

        $brandVan = asset('images/Mega small van wrap idea.png');
    @endphp

    <section id="top" class="relative overflow-hidden bg-mega-black px-3 pb-4 sm:px-5">
        <div class="relative mx-auto max-w-[1500px] overflow-hidden bg-mega-black shadow-premium radius-7">
            <div class="absolute inset-0">
                @foreach($heroSlides as $index => $slide)
                    <img src="{{ $slide['image'] }}" alt="{{ $slide['title'] }}"
                        class="hero-slide absolute inset-0 h-full w-full object-cover {{ $index === 0 ? 'is-active' : '' }}">
                @endforeach

                <div class="absolute inset-0 bg-gradient-to-r from-black via-black/72 to-black/18"></div>
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_20%,rgba(255,90,0,.26),transparent_32%)]">
                </div>
            </div>

            <div
                class="relative grid min-h-[680px] items-center gap-10 px-5 py-16 sm:px-10 lg:grid-cols-[1.02fr_.98fr] lg:px-16">
                <div class="max-w-3xl">
                    @foreach($heroSlides as $index => $slide)
                        <div class="hero-slide-content {{ $index === 0 ? '' : 'hidden' }}" data-slide-content="{{ $index }}">
                            <div
                                class="mb-5 inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/10 px-4 py-2 text-xs font-medium uppercase tracking-[0.22em] text-white/85 backdrop-blur">
                                <svg class="h-4 w-4 text-mega-orange" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.5">
                                    <path d="M12 2l2.1 6.4H21l-5.5 4 2.1 6.6-5.6-4.1L6.4 19l2.1-6.6L3 8.4h6.9L12 2z" />
                                </svg>
                                {{ $slide['eyebrow'] }}
                            </div>

                            <h1
                                class="max-w-4xl text-[36px] font-semibold leading-[1.02] tracking-[-0.055em] text-white sm:text-5xl lg:text-6xl">
                                {{ $slide['title'] }}
                            </h1>

                            <p class="mt-6 max-w-2xl text-lg font-normal leading-8 text-white">
                                {{ $slide['text'] }}
                            </p>
                        </div>
                    @endforeach

                    <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                        <a href="#quote" class="btn-primary">
                            Book a free consultation
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                                <path d="M5 12h14" />
                                <path d="M13 6l6 6-6 6" />
                            </svg>
                        </a>

                        <a href="#products"
                            class="inline-flex items-center justify-center gap-2 border border-white/20 bg-white/10 px-6 py-4 text-sm font-medium text-white backdrop-blur transition hover:bg-white hover:text-mega-black radius-7">
                            Explore flooring ranges
                        </a>
                    </div>

                    <div class="mt-9 grid max-w-2xl grid-cols-3 gap-3">
                        <div class="border border-white/10 bg-white/10 p-4 backdrop-blur radius-7">
                            <strong class="block text-3xl font-semibold text-white">4</strong>
                            <span class="mt-1 block text-xs font-medium uppercase tracking-[0.14em] text-white/55">Core
                                flooring categories</span>
                        </div>

                        <div class="border border-white/10 bg-white/10 p-4 backdrop-blur radius-7">
                            <strong class="block text-3xl font-semibold text-white">24h</strong>
                            <span class="mt-1 block text-xs font-medium uppercase tracking-[0.14em] text-white/55">Quote
                                follow-up</span>
                        </div>

                        <div class="border border-white/10 bg-white/10 p-4 backdrop-blur radius-7">
                            <strong class="block text-3xl font-semibold text-white">0</strong>
                            <span class="mt-1 block text-xs font-medium uppercase tracking-[0.14em] text-white/55">Checkout
                                confusion</span>
                        </div>
                    </div>
                </div>

                <div class="relative hidden min-h-[520px] lg:block">
                    <div
                        class="absolute right-0 top-4 w-[86%] rounded-[7px] border border-white/10 bg-white/10 p-3 shadow-[0_30px_80px_rgba(0,0,0,.35)] backdrop-blur-md">
                        <img src="/images/Mega small van wrap idea.png" alt="Mega Carpets van"
                            class="h-[300px] w-full rounded-[7px] object-cover object-center">
                        <div class="mt-3 grid grid-cols-3 gap-2 text-center">
                            <div
                                class="rounded-[7px] bg-white px-3 py-3 text-xs font-black uppercase tracking-[0.12em] text-brand-black">
                                Mega range</div>
                            <div
                                class="rounded-[7px] bg-white px-3 py-3 text-xs font-black uppercase tracking-[0.12em] text-brand-black">
                                Mega service</div>
                            <div
                                class="rounded-[7px] bg-white px-3 py-3 text-xs font-black uppercase tracking-[0.12em] text-brand-black">
                                Mega value</div>
                        </div>
                    </div><img src="/images/mega man logo.png" alt="Mega Carpets mascot"
                        class="absolute -bottom-4 -left-6 h-[370px] w-auto drop-shadow-[0_30px_35px_rgba(0,0,0,.45)]">
                    <div
                        class="absolute bottom-10 right-4 max-w-xs rounded-[7px] border border-white/10 bg-white p-5 shadow-[0_24px_60px_rgba(0,0,0,.24)]">
                        <p class="text-xs font-black uppercase tracking-[0.18em] section-kicker">Premium demo ready</p>
                        <p class="mt-2 text-lg font-black leading-tight text-zinc-950">A quote-first showroom experience for
                            serious flooring buyers.</p>
                    </div>
                </div>
            </div>

            <div class="absolute bottom-6 left-1/2 flex -translate-x-1/2 items-center gap-3">
                <button type="button" data-hero-prev
                    class="grid h-10 w-10 place-items-center rounded-full border border-white/20 bg-white/10 text-white backdrop-blur hover:bg-white hover:text-mega-black"
                    aria-label="Previous slide">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M15 18l-6-6 6-6" />
                    </svg>
                </button>

                <div class="flex items-center gap-2">
                    @foreach($heroSlides as $index => $slide)
                        <button type="button"
                            class="hero-dot h-2.5 w-2.5 rounded-full bg-white/35 transition-all {{ $index === 0 ? 'is-active' : '' }}"
                            aria-label="Go to slide"></button>
                    @endforeach
                </div>

                <button type="button" data-hero-next
                    class="grid h-10 w-10 place-items-center rounded-full border border-white/20 bg-white/10 text-white backdrop-blur hover:bg-white hover:text-mega-black"
                    aria-label="Next slide">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M9 18l6-6-6-6" />
                    </svg>
                </button>
            </div>
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

            <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-4">
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
                <p class="section-kicker">Room visualiser concept</p>
                <h2 class="section-title-premium max-w-xl">Let customers imagine the floor before they book.</h2>
                <p class="section-lead">
                    Customers can compare colour direction, save favourites and move toward quote request.
                </p>

                <div class="mt-8 grid gap-3 sm:grid-cols-2">
                    @foreach(['Upload room idea', 'Compare colours', 'Save favourites', 'Request a quote'] as $item)
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
                <img src="https://images.unsplash.com/photo-1600121848594-d8644e57abab?auto=format&fit=crop&w=1500&q=85"
                    alt="Room visualiser" class="h-[520px] w-full object-cover radius-7">

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

    <section id="products" class="bg-white py-20">
        <div class="site-container">
            <div class="mb-9 grid gap-6 lg:grid-cols-[1fr_620px] lg:items-end">
                <div class="max-w-3xl">
                    <p class="section-kicker">Featured products</p>
                    <h2 class="section-title-premium">Select colour, choose type and see the price.</h2>
                    <p class="section-lead">
                        Product cards are functional with colour selection, type selection, dynamic indicative price,
                        wishlist and quote basket.
                    </p>
                </div>

                <div class="border border-mega-line bg-white p-4 shadow-soft radius-7">
                    <div class="grid gap-3 sm:grid-cols-[1fr_160px_160px]">
                        <div class="relative">
                            <svg class="pointer-events-none absolute left-4 top-1/2 h-4 w-4 -translate-y-1/2 text-mega-muted thin-home-icon"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <circle cx="11" cy="11" r="7" />
                                <path d="M20 20l-3.5-3.5" />
                            </svg>

                            <input data-product-search type="search" placeholder="Search products..."
                                class="input-clean pl-11">
                        </div>

                        <select data-category-filter class="input-clean">
                            <option>All</option>
                            <option>Carpet</option>
                            <option>Vinyl</option>
                            <option>Timber</option>
                            <option>Laminate</option>
                        </select>

                        <select data-room-filter class="input-clean">
                            <option>All</option>
                            <option>Bedroom</option>
                            <option>Living Room</option>
                            <option>Kitchen</option>
                            <option>Bathroom</option>
                            <option>Dining</option>
                            <option>Hallway</option>
                            <option>Commercial</option>
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
                    <span data-product-count>{{ count($products) }} products showing</span>
                </div>

                <a href="#quote" class="hidden text-sm font-medium text-mega-orange md:inline-flex">
                    Need help choosing? Book consultation →
                </a>
            </div>

            <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-4">
                @foreach($products as $product)
                    @php
                        $quoteData = [
                            'id' => $product['id'],
                            'name' => $product['name'],
                            'category' => $product['category'],
                            'slug' => $product['slug'],
                            'image' => $product['image'],
                        ];
                    @endphp

                    <article data-product-card data-product-id="{{ $product['id'] }}" data-category="{{ $product['category'] }}"
                        data-room="{{ $product['room'] }}"
                        data-search="{{ strtolower($product['name'] . ' ' . $product['category'] . ' ' . $product['room'] . ' ' . $product['tag']) }}"
                        data-product='@json($quoteData, JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_SLASHES)'
                        data-variants='@json($product['variants'], JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_SLASHES)'
                        class="premium-card flooring-product-card group overflow-hidden">

                        <div class="relative h-60 overflow-hidden bg-mega-soft">
                            <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}"
                                class="h-full w-full object-cover transition duration-500 group-hover:scale-105">

                            <div
                                class="absolute left-3 top-3 flex items-center gap-2 bg-white/92 px-3 py-2 text-xs font-medium text-mega-black shadow-sm backdrop-blur radius-7">
                                <svg class="h-3.5 w-3.5 fill-mega-orange text-mega-orange" viewBox="0 0 24 24"
                                    fill="currentColor">
                                    <path d="M12 2l2.7 6.8L22 9.3l-5.6 4.7 1.8 7L12 17.2 5.8 21l1.8-7L2 9.3l7.3-.5L12 2z" />
                                </svg>
                                <span>{{ $product['rating'] }}</span>
                            </div>

                            <button type="button"
                                class="wishlist-toggle absolute right-3 top-3 grid h-10 w-10 place-items-center bg-white/92 text-mega-black shadow-sm backdrop-blur transition hover:text-mega-orange radius-7"
                                data-wishlist-button data-product-id="{{ $product['id'] }}" aria-label="Save favourite">
                                <svg class="h-5 w-5 thin-home-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path
                                        d="M20.8 5.6c-1.6-1.8-4.2-1.9-5.9-.2L12 8.3 9.1 5.4C7.4 3.7 4.8 3.8 3.2 5.6c-1.7 2-1.5 5 .4 6.9L12 21l8.4-8.5c1.9-1.9 2.1-4.9.4-6.9z" />
                                </svg>
                            </button>
                        </div>

                        <div class="p-5">
                            <div class="mb-3 flex items-center justify-between gap-3">
                                <span class="rounded-full bg-mega-orange/10 px-3 py-1 text-xs font-medium text-mega-orange">
                                    {{ $product['tag'] }}
                                </span>
                                <span class="text-xs font-medium uppercase tracking-[0.18em] text-mega-muted">
                                    {{ $product['category'] }}
                                </span>
                            </div>

                            <h3
                                class="min-h-[60px] text-2xl font-semibold uppercase leading-tight tracking-[-0.04em] text-mega-black">
                                {{ $product['name'] }}
                            </h3>

                            <div class="mt-4">
                                <p class="mb-2 text-sm font-medium text-mega-text">Colour</p>

                                <div class="flex flex-wrap gap-2" data-colour-list>
                                    @foreach($product['variants'] as $index => $variant)
                                        <button type="button" data-colour-index="{{ $index }}"
                                            data-colour-name="{{ $variant['name'] }}"
                                            class="colour-choice h-9 w-9 border border-mega-line shadow-inner radius-7"
                                            style="background-color: {{ $variant['swatch'] }}" aria-label="{{ $variant['name'] }}">
                                        </button>
                                    @endforeach
                                </div>

                                <p class="mt-2 min-h-[20px] text-xs font-medium text-mega-muted" data-selected-colour>
                                    Select a colour first.
                                </p>
                            </div>

                            <div class="mt-4">
                                <p class="mb-2 text-sm font-medium text-mega-text">Type</p>
                                <div class="grid gap-2" data-type-list>
                                    <button type="button"
                                        class="type-placeholder input-clean cursor-not-allowed text-left opacity-60" disabled>
                                        Choose colour first
                                    </button>
                                </div>
                            </div>

                            <div class="mt-5 bg-[#f7f3ed] p-4 radius-7">
                                <div class="flex items-end justify-between gap-3">
                                    <div>
                                        <p class="text-xs font-medium uppercase tracking-[0.16em] text-mega-muted">Indicative
                                            price</p>
                                        <p class="text-2xl font-semibold text-mega-black" data-price-output>
                                            Select options
                                        </p>
                                    </div>

                                    <span class="bg-white px-3 py-2 text-xs font-medium text-mega-text radius-7">
                                        {{ $product['room'] }}
                                    </span>
                                </div>
                            </div>

                            <div class="mt-5 grid grid-cols-[1fr_auto] gap-3">
                                <button type="button" data-add-quote class="btn-primary w-full justify-center opacity-60"
                                    disabled>
                                    Add to quote
                                </button>

                                <a href="{{ route('frontend.product.show', $product['slug']) }}"
                                    class="inline-flex h-12 w-12 items-center justify-center border border-mega-line text-mega-black transition hover:border-mega-orange hover:text-mega-orange radius-7"
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
            </div>
        </div>
    </section>

    <section id="shop-room" class="bg-[#f7f3ed] py-20">
        <div class="site-container grid gap-10 lg:grid-cols-[.95fr_1.05fr] lg:items-center">
            <div>
                <p class="section-kicker">Shop the room</p>
                <h2 class="section-title-premium max-w-2xl">A premium inspiration block like a real showroom catalogue.</h2>
                <p class="section-lead">
                    Connect product discovery with full-room ideas so the website feels more useful and premium.
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
                <img src="https://images.unsplash.com/photo-1600121848594-d8644e57abab?auto=format&fit=crop&w=1400&q=85"
                    alt="Shop the room" class="h-[650px] w-full object-cover">

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

    <section id="inspiration" class="bg-[#f7f3ed] py-20">
        <div class="site-container">
            <div class="mx-auto mb-10 max-w-4xl text-center">
                <p class="section-kicker">Trending styles</p>
                <h2 class="section-title-premium">Interior content that keeps the site from feeling empty.</h2>
                <p class="mx-auto section-lead">
                    These editorial cards are useful for SEO, inspiration and social sharing later.
                </p>
            </div>

            <div class="grid gap-5 lg:grid-cols-3">
                @foreach($styles as $style)
                    <article class="overflow-hidden bg-white shadow-soft radius-7">
                        <img src="{{ $style['image'] }}" alt="{{ $style['title'] }}" class="h-64 w-full object-cover">

                        <div class="p-6">
                            <h3 class="text-2xl font-semibold uppercase tracking-[-0.03em] text-mega-black">
                                {{ $style['title'] }}
                            </h3>
                            <p class="mt-3 min-h-20 text-base font-normal leading-7 text-mega-muted">{{ $style['text'] }}</p>

                            <a href="#quote"
                                class="mt-5 inline-flex items-center gap-2 text-sm font-medium text-mega-black hover:text-mega-orange">
                                Read article →
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section id="quote" class="bg-white py-20">
        <div class="site-container grid gap-10 lg:grid-cols-[.9fr_1.1fr] lg:items-start">
            <div class="hidden lg:block">
                <div class="overflow-hidden bg-mega-black text-white shadow-premium radius-7">
                    <img src="{{ $brandVan }}"
                        onerror="this.src='https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?auto=format&fit=crop&w=1200&q=85'"
                        alt="Mega Carpets van" class="h-[420px] w-full object-cover">

                    <div class="p-7">
                        <span
                            class="inline-flex rounded-full bg-white/10 px-4 py-2 text-xs font-medium uppercase tracking-[0.18em] text-white">
                            Call us today
                        </span>
                        <h2 class="mt-4 text-4xl font-semibold tracking-[-0.05em]">1300 131 196</h2>
                        <p class="mt-3 text-white/65">
                            Use this form to collect qualified quote requests. Later it can connect with email, CRM, Laravel
                            admin or SMS notification.
                        </p>
                    </div>
                </div>
            </div>

            <form class="border border-mega-line bg-white p-6 shadow-soft sm:p-8 radius-7">
                <p class="section-kicker">Book a free consultation</p>
                <h2 class="section-title-premium max-w-3xl">Request a measure, quote or product advice.</h2>
                <p class="section-lead">
                    This demo form shows the client the exact enquiry flow instead of a normal checkout button.
                </p>

                <div class="mt-8 grid gap-4 md:grid-cols-2">
                    <input class="input-clean" placeholder="Full name">
                    <input class="input-clean" placeholder="Phone number">
                    <input class="input-clean" type="email" placeholder="Email address">

                    <select class="input-clean">
                        <option>Carpet</option>
                        <option>Vinyl</option>
                        <option>Timber</option>
                        <option>Laminate</option>
                        <option>Commercial Flooring</option>
                    </select>

                    <select class="input-clean">
                        <option>Bedroom</option>
                        <option>Living Room</option>
                        <option>Kitchen</option>
                        <option>Bathroom</option>
                        <option>Commercial Space</option>
                    </select>

                    <input class="input-clean" placeholder="Approx room size, e.g. 4m x 5m">

                    <textarea class="input-clean md:col-span-2" rows="5"
                        placeholder="Tell us about the project, preferred colour, budget, address area or installation timeline..."></textarea>
                </div>

                <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <p class="text-sm font-normal text-mega-muted">Demo only. No real submission is connected yet.</p>
                    <button type="button" class="btn-primary">Send quote request <span>→</span></button>
                </div>
            </form>
        </div>
    </section>

    <section id="faq" class="bg-[#f7f3ed] py-20">
        <div class="site-container grid gap-10 lg:grid-cols-[.8fr_1.2fr]">
            <div>
                <p class="section-kicker">FAQ</p>
                <h2 class="section-title-premium">Clear answers for the demo presentation.</h2>
                <p class="section-lead">
                    Use these points to explain why the website is quote-based rather than checkout-based.
                </p>
            </div>

            <div class="space-y-3">
                @foreach($faqs as $faq)
                    <details class="bg-white shadow-sm radius-7" {{ $loop->first ? 'open' : '' }}>
                        <summary
                            class="flex cursor-pointer list-none items-center justify-between gap-4 p-5 text-left text-lg font-medium text-mega-black">
                            {{ $faq['question'] }}
                            <span class="text-2xl text-mega-orange">+</span>
                        </summary>

                        <p class="px-5 pb-5 text-base font-normal leading-7 text-mega-muted">
                            {{ $faq['answer'] }}
                        </p>
                    </details>
                @endforeach
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