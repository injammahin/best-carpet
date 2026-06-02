@php
    $megaMenus = [
        'carpet' => [
            'label' => 'Carpet',
            'url' => route('frontend.product.show', 'carpet'),
            'columns' => [
                'Shop by need' => [
                    ['title' => 'Wool Carpet', 'url' => route('frontend.product.show', 'carpet')],
                    ['title' => 'Nylon Carpet', 'url' => route('frontend.product.show', 'carpet')],
                    ['title' => 'Polyester Carpet', 'url' => route('frontend.product.show', 'carpet')],
                    ['title' => 'Commercial Carpet', 'url' => route('frontend.product.show', 'carpet')],
                ],
                'Shop by style' => [
                    ['title' => 'Loop Pile', 'url' => route('frontend.product.show', 'carpet')],
                    ['title' => 'Twist Pile', 'url' => route('frontend.product.show', 'carpet')],
                    ['title' => 'Plush Carpet', 'url' => route('frontend.product.show', 'carpet')],
                    ['title' => 'Stairs Carpet', 'url' => route('frontend.product.show', 'carpet')],
                ],
            ],
            'products' => [
                [
                    'name' => 'Moroccan Berber',
                    'image' => 'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?auto=format&fit=crop&w=500&q=80',
                    'url' => route('frontend.product.show', 'carpet'),
                ],
                [
                    'name' => 'Essex Place',
                    'image' => 'https://images.unsplash.com/photo-1600121848594-d8644e57abab?auto=format&fit=crop&w=500&q=80',
                    'url' => route('frontend.product.show', 'carpet'),
                ],
                [
                    'name' => 'Luxe Shades',
                    'image' => 'https://images.unsplash.com/photo-1618220179428-22790b461013?auto=format&fit=crop&w=500&q=80',
                    'url' => route('frontend.product.show', 'carpet'),
                ],
            ],
            'promo' => [
                'title' => 'Soft comfort for every room',
                'text' => 'Explore carpet textures for bedrooms, lounges, stairs and family spaces.',
                'image' => 'https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?auto=format&fit=crop&w=700&q=80',
            ],
        ],

        'hybrid' => [
            'label' => 'Hybrid',
            'url' => route('frontend.product.show', 'hybrid-flooring'),
            'columns' => [
                'Shop by finish' => [
                    ['title' => 'Oak Look Hybrid', 'url' => route('frontend.product.show', 'hybrid-flooring')],
                    ['title' => 'Natural Timber Look', 'url' => route('frontend.product.show', 'hybrid-flooring')],
                    ['title' => 'Grey Hybrid Flooring', 'url' => route('frontend.product.show', 'hybrid-flooring')],
                    ['title' => 'Wide Plank Hybrid', 'url' => route('frontend.product.show', 'hybrid-flooring')],
                ],
                'Shop by use' => [
                    ['title' => 'Family Homes', 'url' => route('frontend.product.show', 'hybrid-flooring')],
                    ['title' => 'Rental Properties', 'url' => route('frontend.product.show', 'hybrid-flooring')],
                    ['title' => 'Apartments', 'url' => route('frontend.product.show', 'hybrid-flooring')],
                    ['title' => 'Open Living Areas', 'url' => route('frontend.product.show', 'hybrid-flooring')],
                ],
            ],
            'products' => [
                [
                    'name' => 'Urban Oak',
                    'image' => 'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?auto=format&fit=crop&w=500&q=80',
                    'url' => route('frontend.product.show', 'hybrid-flooring'),
                ],
                [
                    'name' => 'Coastal Grey',
                    'image' => 'https://images.unsplash.com/photo-1600210492493-0946911123ea?auto=format&fit=crop&w=500&q=80',
                    'url' => route('frontend.product.show', 'hybrid-flooring'),
                ],
                [
                    'name' => 'Classic Natural',
                    'image' => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?auto=format&fit=crop&w=500&q=80',
                    'url' => route('frontend.product.show', 'hybrid-flooring'),
                ],
            ],
            'promo' => [
                'title' => 'Timber look. Practical living.',
                'text' => 'Hybrid flooring gives modern homes a durable and clean timber-style finish.',
                'image' => 'https://images.unsplash.com/photo-1600566753086-00f18fb6b3ea?auto=format&fit=crop&w=700&q=80',
            ],
        ],

        'timber' => [
            'label' => 'Timber',
            'url' => route('frontend.product.show', 'timber'),
            'columns' => [
                'Shop by colour' => [
                    ['title' => 'Light Timber', 'url' => route('frontend.product.show', 'timber')],
                    ['title' => 'Natural Oak', 'url' => route('frontend.product.show', 'timber')],
                    ['title' => 'Warm Brown', 'url' => route('frontend.product.show', 'timber')],
                    ['title' => 'Dark Timber', 'url' => route('frontend.product.show', 'timber')],
                ],
                'Shop by space' => [
                    ['title' => 'Living Room', 'url' => route('frontend.product.show', 'timber')],
                    ['title' => 'Dining Room', 'url' => route('frontend.product.show', 'timber')],
                    ['title' => 'Premium Homes', 'url' => route('frontend.product.show', 'timber')],
                    ['title' => 'Renovations', 'url' => route('frontend.product.show', 'timber')],
                ],
            ],
            'products' => [
                [
                    'name' => 'Natural Oak',
                    'image' => 'https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?auto=format&fit=crop&w=500&q=80',
                    'url' => route('frontend.product.show', 'timber'),
                ],
                [
                    'name' => 'Warm Ash',
                    'image' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=500&q=80',
                    'url' => route('frontend.product.show', 'timber'),
                ],
                [
                    'name' => 'Classic Brown',
                    'image' => 'https://images.unsplash.com/photo-1600566752229-250ed79470f8?auto=format&fit=crop&w=500&q=80',
                    'url' => route('frontend.product.show', 'timber'),
                ],
            ],
            'promo' => [
                'title' => 'Natural warmth for premium interiors',
                'text' => 'Timber flooring adds lasting character, warmth and architectural value.',
                'image' => 'https://images.unsplash.com/photo-1600607687644-c7171b42498b?auto=format&fit=crop&w=700&q=80',
            ],
        ],

        'laminate' => [
            'label' => 'Laminate',
            'url' => route('frontend.product.show', 'laminate'),
            'columns' => [
                'Shop by finish' => [
                    ['title' => 'Oak Laminate', 'url' => route('frontend.product.show', 'laminate')],
                    ['title' => 'Light Laminate', 'url' => route('frontend.product.show', 'laminate')],
                    ['title' => 'Grey Laminate', 'url' => route('frontend.product.show', 'laminate')],
                    ['title' => 'Dark Laminate', 'url' => route('frontend.product.show', 'laminate')],
                ],
                'Shop by budget' => [
                    ['title' => 'Affordable Range', 'url' => route('frontend.product.show', 'laminate')],
                    ['title' => 'Premium Laminate', 'url' => route('frontend.product.show', 'laminate')],
                    ['title' => 'Rental Flooring', 'url' => route('frontend.product.show', 'laminate')],
                    ['title' => 'Family Flooring', 'url' => route('frontend.product.show', 'laminate')],
                ],
            ],
            'products' => [
                [
                    'name' => 'Clean Oak',
                    'image' => 'https://images.unsplash.com/photo-1600566752355-35792bedcfea?auto=format&fit=crop&w=500&q=80',
                    'url' => route('frontend.product.show', 'laminate'),
                ],
                [
                    'name' => 'Soft Natural',
                    'image' => 'https://images.unsplash.com/photo-1600566753086-00f18fb6b3ea?auto=format&fit=crop&w=500&q=80',
                    'url' => route('frontend.product.show', 'laminate'),
                ],
                [
                    'name' => 'Urban Grain',
                    'image' => 'https://images.unsplash.com/photo-1600607688969-a5bfcd646154?auto=format&fit=crop&w=500&q=80',
                    'url' => route('frontend.product.show', 'laminate'),
                ],
            ],
            'promo' => [
                'title' => 'Clean style with practical value',
                'text' => 'Laminate is a smart option for everyday spaces and controlled budgets.',
                'image' => 'https://images.unsplash.com/photo-1600566752734-5f97dd4479d1?auto=format&fit=crop&w=700&q=80',
            ],
        ],

        'vinyl' => [
            'label' => 'Vinyl',
            'url' => route('frontend.product.show', 'vinyl'),
            'columns' => [
                'Shop by style' => [
                    ['title' => 'Timber Look Vinyl', 'url' => route('frontend.product.show', 'vinyl')],
                    ['title' => 'Stone Look Vinyl', 'url' => route('frontend.product.show', 'vinyl')],
                    ['title' => 'Neutral Vinyl', 'url' => route('frontend.product.show', 'vinyl')],
                    ['title' => 'Modern Vinyl', 'url' => route('frontend.product.show', 'vinyl')],
                ],
                'Shop by use' => [
                    ['title' => 'Kitchen', 'url' => route('frontend.product.show', 'vinyl')],
                    ['title' => 'Family Areas', 'url' => route('frontend.product.show', 'vinyl')],
                    ['title' => 'Apartments', 'url' => route('frontend.product.show', 'vinyl')],
                    ['title' => 'Commercial Spaces', 'url' => route('frontend.product.show', 'vinyl')],
                ],
            ],
            'products' => [
                [
                    'name' => 'Soft Oak Vinyl',
                    'image' => 'https://images.unsplash.com/photo-1600607688969-a5bfcd646154?auto=format&fit=crop&w=500&q=80',
                    'url' => route('frontend.product.show', 'vinyl'),
                ],
                [
                    'name' => 'Warm Stone',
                    'image' => 'https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?auto=format&fit=crop&w=500&q=80',
                    'url' => route('frontend.product.show', 'vinyl'),
                ],
                [
                    'name' => 'Everyday Natural',
                    'image' => 'https://images.unsplash.com/photo-1600210492493-0946911123ea?auto=format&fit=crop&w=500&q=80',
                    'url' => route('frontend.product.show', 'vinyl'),
                ],
            ],
            'promo' => [
                'title' => 'Comfortable and easy to maintain',
                'text' => 'Vinyl flooring is practical, soft underfoot and suitable for busy homes.',
                'image' => 'https://images.unsplash.com/photo-1600607687644-c7171b42498b?auto=format&fit=crop&w=700&q=80',
            ],
        ],

        'rugs' => [
            'label' => 'Rugs',
            'url' => route('frontend.product.show', 'rugs'),
            'columns' => [
                'Shop by type' => [
                    ['title' => 'Modern Rugs', 'url' => route('frontend.product.show', 'rugs')],
                    ['title' => 'Traditional Rugs', 'url' => route('frontend.product.show', 'rugs')],
                    ['title' => 'Outdoor Rugs', 'url' => route('frontend.product.show', 'rugs')],
                    ['title' => 'Custom Rugs', 'url' => route('frontend.product.show', 'rugs')],
                ],
                'Shop by room' => [
                    ['title' => 'Living Room Rugs', 'url' => route('frontend.product.show', 'rugs')],
                    ['title' => 'Bedroom Rugs', 'url' => route('frontend.product.show', 'rugs')],
                    ['title' => 'Dining Room Rugs', 'url' => route('frontend.product.show', 'rugs')],
                    ['title' => 'Runner Rugs', 'url' => route('frontend.product.show', 'rugs')],
                ],
            ],
            'products' => [
                [
                    'name' => 'Arabella',
                    'image' => 'https://images.unsplash.com/photo-1600121848594-d8644e57abab?auto=format&fit=crop&w=500&q=80',
                    'url' => route('frontend.product.show', 'rugs'),
                ],
                [
                    'name' => 'Boucle',
                    'image' => 'https://images.unsplash.com/photo-1618220179428-22790b461013?auto=format&fit=crop&w=500&q=80',
                    'url' => route('frontend.product.show', 'rugs'),
                ],
                [
                    'name' => 'Heritage',
                    'image' => 'https://images.unsplash.com/photo-1616486701797-0f33f61038ec?auto=format&fit=crop&w=500&q=80',
                    'url' => route('frontend.product.show', 'rugs'),
                ],
            ],
            'promo' => [
                'title' => 'Complete your room with texture',
                'text' => 'Rugs add warmth, softness and visual balance to finished interiors.',
                'image' => 'https://images.unsplash.com/photo-1618221118493-9cfa1a1c00da?auto=format&fit=crop&w=700&q=80',
            ],
        ],
    ];
@endphp

<header x-data="{
        mobileMenu: false,
        activeMega: null,
        atTop: true,
        headerVisible: true,
        lastScroll: 0,

        handleScroll() {
            const currentScroll = window.scrollY;

            this.atTop = currentScroll <= 8;

            if (this.mobileMenu || this.activeMega) {
                this.headerVisible = true;
                this.lastScroll = currentScroll;
                return;
            }

            if (currentScroll <= 90) {
                this.headerVisible = true;
            } else if (currentScroll > this.lastScroll && currentScroll > 145) {
                this.headerVisible = false;
                this.activeMega = null;
            } else if (currentScroll < this.lastScroll) {
                this.headerVisible = true;
            }

            this.lastScroll = currentScroll;
        }
    }" x-init="
        lastScroll = window.scrollY;
        handleScroll();
        window.addEventListener('scroll', () => handleScroll(), { passive: true });
    " @mouseleave="activeMega = null" class="fixed left-0 right-0 top-0 z-50 pointer-events-none">
    <div class="pointer-events-auto">
        {{-- Black top bar: only at very top --}}
        <div x-show="atTop" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="-translate-y-full opacity-0" x-transition:enter-end="translate-y-0 opacity-100"
            x-transition:leave="transition ease-in duration-300" x-transition:leave-start="translate-y-0 opacity-100"
            x-transition:leave-end="-translate-y-full opacity-0" class="bg-mega-black text-white">
            <div class="site-container">
                <div
                    class="hidden h-10 items-center justify-between text-[12px] font-medium uppercase tracking-[0.24em] text-white/70 lg:flex">
                    <span>Free local measure & quote</span>
                    <span>Carpet · Hybrid · Timber · Laminate · Vinyl · Rugs</span>
                    <span>Premium flooring showroom</span>
                </div>

                <div
                    class="flex h-9 items-center justify-center text-center text-[11px] font-medium uppercase tracking-[0.2em] text-white/70 lg:hidden">
                    Free local measure & quote
                </div>
            </div>
        </div>

        {{-- White header + product nav --}}
        <div class="bg-white shadow-[0_8px_30px_rgba(0,0,0,0.06)] transition-all duration-500 ease-[cubic-bezier(0.4,0,0.2,1)]"
            :class="headerVisible ? 'translate-y-0 opacity-100' : '-translate-y-full opacity-0 pointer-events-none'">
            {{-- Main white header --}}
            <div class="border-b border-mega-line bg-white">
                <div class="site-container">
                    <div class="flex h-[82px] items-center justify-between gap-4">
                        <a href="{{ route('frontend.home') }}" class="flex items-center gap-4">
                            <div class="flex h-12 w-[92px] items-center justify-center bg-mega-black radius-7">
                                <div class="text-center leading-none">
                                    <div
                                        class="-skew-x-12 font-heading text-lg font-medium tracking-tight text-mega-orange">
                                        MEGA
                                    </div>
                                    <div class="text-[9px] font-medium uppercase tracking-[0.22em] text-white">
                                        Carpets
                                    </div>
                                </div>
                            </div>

                            <span
                                class="hidden text-xs font-medium uppercase tracking-[0.35em] text-mega-orange sm:inline">
                                Showroom
                            </span>
                        </a>

                        <nav class="hidden items-center gap-7 text-sm font-medium text-mega-text xl:flex">
                            <a href="{{ route('frontend.products') }}" class="transition hover:text-mega-orange">
                                Products
                            </a>

                            <a href="{{ route('frontend.home') }}#services" class="transition hover:text-mega-orange">
                                Services
                            </a>

                            <a href="{{ route('frontend.mobile-showroom') }}" class="transition hover:text-mega-orange">
                                Mobile Showroom
                            </a>

                            <a href="{{ route('frontend.inspiration') }}" class="transition hover:text-mega-orange">
                                Inspiration
                            </a>

                            <a href="{{ route('frontend.contact') }}" class="transition hover:text-mega-orange">
                                Contact
                            </a>
                        </nav>

                        <div class="hidden items-center gap-3 lg:flex">
                            <a href="tel:1300131196"
                                class="flex items-center gap-2 text-sm font-medium text-mega-text transition hover:text-mega-orange">
                                <svg class="thin-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path
                                        d="M22 16.92v3a2 2 0 0 1-2.18 2A19.8 19.8 0 0 1 3.11 5.18 2 2 0 0 1 5.1 3h3a2 2 0 0 1 2 1.72c.13.95.35 1.88.66 2.76a2 2 0 0 1-.45 2.11L9.03 10.87a16 16 0 0 0 4.1 4.1l1.28-1.28a2 2 0 0 1 2.11-.45c.88.31 1.81.53 2.76.66A2 2 0 0 1 22 16.92z" />
                                </svg>
                                1300 131 196
                            </a>

                            <a href="{{ route('frontend.quote') }}" class="btn-primary">
                                Book free quote
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.5">
                                    <path d="M5 12h14" />
                                    <path d="M13 6l6 6-6 6" />
                                </svg>
                            </a>
                        </div>

                        <button type="button"
                            class="flex h-11 w-11 items-center justify-center border border-mega-line text-mega-black transition hover:border-mega-orange hover:text-mega-orange radius-7 xl:hidden"
                            @click="mobileMenu = !mobileMenu" aria-label="Toggle menu">
                            <svg x-show="!mobileMenu" class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1.5">
                                <path d="M4 7h16M4 12h16M4 17h16" stroke-linecap="round" />
                            </svg>

                            <svg x-show="mobileMenu" x-cloak class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1.5">
                                <path d="M6 6l12 12M18 6L6 18" stroke-linecap="round" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Product nav --}}
            <div class="hidden border-b border-mega-line bg-mega-soft lg:block">
                <div class="site-container">
                    <div class="flex min-h-[58px] items-center justify-between gap-6">
                        <nav class="flex items-center gap-1 text-sm font-medium text-mega-text">
                            @foreach($megaMenus as $key => $menu)
                                <a href="{{ $menu['url'] }}" @mouseenter="activeMega = '{{ $key }}'"
                                    @focus="activeMega = '{{ $key }}'"
                                    class="group flex items-center gap-2 px-4 py-5 transition hover:text-mega-orange"
                                    :class="activeMega === '{{ $key }}' ? 'text-mega-orange' : ''">
                                    {{ $menu['label'] }}

                                    <svg class="h-3.5 w-3.5 transition group-hover:rotate-180" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path d="M6 9l6 6 6-6" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a>
                            @endforeach
                        </nav>

                        <div class="flex items-center gap-6 text-sm font-medium">
                            <a href="{{ route('frontend.contact') }}"
                                class="flex items-center gap-2 transition hover:text-mega-orange">
                                <svg class="thin-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path d="M12 21s7-5.2 7-12a7 7 0 1 0-14 0c0 6.8 7 12 7 12z" />
                                    <circle cx="12" cy="9" r="2.5" />
                                </svg>
                                Find local store
                            </a>

                            <a href="{{ route('frontend.quote') }}"
                                class="flex items-center gap-2 transition hover:text-mega-orange">
                                <svg class="thin-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path d="M4 4h16v16H4z" />
                                    <path d="M9 9h6M9 13h6M9 17h3" />
                                </svg>
                                Measure & quote
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Mobile menu --}}
            <div x-show="mobileMenu" x-transition x-cloak class="border-b border-mega-line bg-white xl:hidden">
                <div class="site-container py-5">
                    <nav class="grid gap-2 text-sm font-medium text-mega-text">
                        <a href="{{ route('frontend.home') }}" @click="mobileMenu = false"
                            class="bg-mega-soft px-4 py-3 transition hover:bg-mega-orange hover:text-white radius-7">Home</a>
                        <a href="{{ route('frontend.products') }}" @click="mobileMenu = false"
                            class="bg-mega-soft px-4 py-3 transition hover:bg-mega-orange hover:text-white radius-7">All
                            Products</a>

                        @foreach($megaMenus as $menu)
                            <a href="{{ $menu['url'] }}" @click="mobileMenu = false"
                                class="bg-mega-soft px-4 py-3 transition hover:bg-mega-orange hover:text-white radius-7">
                                {{ $menu['label'] }}
                            </a>
                        @endforeach

                        <a href="{{ route('frontend.mobile-showroom') }}" @click="mobileMenu = false"
                            class="bg-mega-soft px-4 py-3 transition hover:bg-mega-orange hover:text-white radius-7">Mobile
                            Showroom</a>
                        <a href="{{ route('frontend.inspiration') }}" @click="mobileMenu = false"
                            class="bg-mega-soft px-4 py-3 transition hover:bg-mega-orange hover:text-white radius-7">Inspiration</a>
                        <a href="{{ route('frontend.contact') }}" @click="mobileMenu = false"
                            class="bg-mega-soft px-4 py-3 transition hover:bg-mega-orange hover:text-white radius-7">Contact</a>
                        <a href="{{ route('frontend.quote') }}" @click="mobileMenu = false"
                            class="bg-mega-orange px-4 py-3 text-white transition hover:bg-mega-orangeDark radius-7">Book
                            free quote</a>
                    </nav>

                    <div class="mt-4 grid gap-3 sm:grid-cols-2">
                        <a href="tel:1300131196" class="btn-dark w-full">Call 1300 131 196</a>
                        <a href="{{ route('frontend.quote') }}" class="btn-primary w-full">Measure & quote</a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Mega menu --}}
        <div x-show="activeMega && headerVisible" x-transition.opacity.duration.150ms x-cloak class="hidden lg:block">
            <div class="site-container">
                <div
                    class="overflow-hidden border border-mega-line bg-white shadow-[0_26px_80px_rgba(0,0,0,0.14)] radius-7">
                    <div class="h-[3px] bg-mega-orange"></div>

                    @foreach($megaMenus as $key => $menu)
                        <div x-show="activeMega === '{{ $key }}'" x-transition.opacity.duration.150ms
                            class="grid gap-8 p-8 xl:grid-cols-[0.95fr_0.95fr_1.05fr]">
                            <div class="grid grid-cols-2 gap-8">
                                @foreach($menu['columns'] as $columnTitle => $links)
                                    <div>
                                        <p class="mb-5 text-xs font-medium uppercase tracking-[0.22em] text-mega-orange">
                                            {{ $columnTitle }}
                                        </p>

                                        <div class="grid gap-3">
                                            @foreach($links as $link)
                                                <a href="{{ $link['url'] }}"
                                                    class="group flex items-center justify-between border-b border-mega-line/70 pb-3 text-[15px] font-medium text-mega-text transition hover:border-mega-orange hover:text-mega-orange">
                                                    {{ $link['title'] }}

                                                    <svg class="h-4 w-4 opacity-0 transition group-hover:translate-x-1 group-hover:opacity-100"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                                        <path d="M5 12h14" />
                                                        <path d="M13 6l6 6-6 6" />
                                                    </svg>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div>
                                <div class="mb-5 flex items-center justify-between">
                                    <p class="text-xs font-medium uppercase tracking-[0.22em] text-mega-orange">
                                        Featured products
                                    </p>

                                    <a href="{{ $menu['url'] }}"
                                        class="text-sm font-medium text-mega-text transition hover:text-mega-orange">
                                        View all
                                    </a>
                                </div>

                                <div class="grid gap-3">
                                    @foreach($menu['products'] as $product)
                                        <a href="{{ $product['url'] }}"
                                            class="group grid grid-cols-[92px_1fr] overflow-hidden border border-mega-line bg-white transition hover:border-mega-orange/50 hover:shadow-soft radius-7">
                                            <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}"
                                                class="h-[82px] w-full object-cover">

                                            <div class="flex items-center justify-between gap-4 px-4">
                                                <div>
                                                    <h4 class="text-[16px] font-medium leading-tight text-mega-black">
                                                        {{ $product['name'] }}
                                                    </h4>
                                                    <p class="mt-1 text-sm text-mega-muted">
                                                        Product details
                                                    </p>
                                                </div>

                                                <svg class="h-5 w-5 shrink-0 text-mega-orange transition group-hover:translate-x-1"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                                    <path d="M5 12h14" />
                                                    <path d="M13 6l6 6-6 6" />
                                                </svg>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>

                            <div>
                                <p class="mb-5 text-xs font-medium uppercase tracking-[0.22em] text-mega-orange">
                                    Learn more
                                </p>

                                <div class="overflow-hidden border border-mega-line bg-mega-cream shadow-soft radius-7">
                                    <div class="relative h-[205px] overflow-hidden">
                                        <img src="{{ $menu['promo']['image'] }}" alt="{{ $menu['promo']['title'] }}"
                                            class="h-full w-full object-cover transition duration-500 hover:scale-105">

                                        <div
                                            class="absolute inset-0 bg-gradient-to-t from-mega-black/60 via-transparent to-transparent">
                                        </div>

                                        <div class="absolute bottom-4 left-4 right-4">
                                            <span
                                                class="inline-flex bg-white/90 px-3 py-1 text-xs font-medium uppercase tracking-[0.18em] text-mega-orange backdrop-blur radius-7">
                                                Mega guide
                                            </span>
                                        </div>
                                    </div>

                                    <div class="p-5 text-center">
                                        <h3 class="text-2xl leading-tight text-mega-black">
                                            {{ $menu['promo']['title'] }}
                                        </h3>

                                        <p class="mx-auto mt-3 max-w-sm text-sm leading-6 text-mega-muted">
                                            {{ $menu['promo']['text'] }}
                                        </p>

                                        <a href="{{ $menu['url'] }}" class="btn-light mt-5">
                                            Explore {{ $menu['label'] }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</header>