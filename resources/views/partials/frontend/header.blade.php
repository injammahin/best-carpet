@php
    $homeUrl = route('frontend.home');

    $mainLinks = [
        ['label' => 'Products', 'url' => route('frontend.products')],
        ['label' => 'Services', 'url' => $homeUrl . '#services'],
        ['label' => 'Room Visualiser', 'url' => $homeUrl . '#visualizer'],
        ['label' => 'Inspiration', 'url' => route('frontend.inspiration')],
        ['label' => 'Contact', 'url' => route('frontend.contact')],
    ];

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
                'Shop by room' => [
                    ['title' => 'Bedroom Carpet', 'url' => route('frontend.product.show', 'carpet')],
                    ['title' => 'Living Room Carpet', 'url' => route('frontend.product.show', 'carpet')],
                    ['title' => 'Stairs Carpet', 'url' => route('frontend.product.show', 'carpet')],
                    ['title' => 'Rental Property Carpet', 'url' => route('frontend.product.show', 'carpet')],
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

        'flooring' => [
            'label' => 'Flooring',
            'url' => route('frontend.products'),
            'columns' => [
                'Hard flooring' => [
                    ['title' => 'Hybrid Flooring', 'url' => route('frontend.product.show', 'hybrid-flooring')],
                    ['title' => 'Timber Flooring', 'url' => route('frontend.product.show', 'timber')],
                    ['title' => 'Laminate Flooring', 'url' => route('frontend.product.show', 'laminate')],
                    ['title' => 'Vinyl Flooring', 'url' => route('frontend.product.show', 'vinyl')],
                ],
                'Shop by use' => [
                    ['title' => 'Family Homes', 'url' => route('frontend.products')],
                    ['title' => 'Rental Properties', 'url' => route('frontend.products')],
                    ['title' => 'Commercial Spaces', 'url' => route('frontend.products')],
                    ['title' => 'Pet Friendly Flooring', 'url' => route('frontend.products')],
                ],
            ],
            'products' => [
                [
                    'name' => 'Parky Pro Enhanced',
                    'image' => 'https://images.unsplash.com/photo-1600210491369-e753d80a41f3?auto=format&fit=crop&w=500&q=80',
                    'url' => route('frontend.products'),
                ],
                [
                    'name' => 'Coastal Oak',
                    'image' => 'https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?auto=format&fit=crop&w=500&q=80',
                    'url' => route('frontend.products'),
                ],
                [
                    'name' => 'Nordic Laminate',
                    'image' => 'https://images.unsplash.com/photo-1600566752355-35792bedcfea?auto=format&fit=crop&w=500&q=80',
                    'url' => route('frontend.products'),
                ],
            ],
            'promo' => [
                'title' => 'Timber look. Practical living.',
                'text' => 'Hard flooring options for modern homes, active families and refined interiors.',
                'image' => 'https://images.unsplash.com/photo-1600566753086-00f18fb6b3ea?auto=format&fit=crop&w=700&q=80',
            ],
        ],

        'rugs' => [
            'label' => 'Rugs',
            'url' => route('frontend.product.show', 'rugs'),
            'columns' => [
                'Shop by type' => [
                    ['title' => 'Modern Rugs', 'url' => route('frontend.product.show', 'rugs')],
                    ['title' => 'Natural Rugs', 'url' => route('frontend.product.show', 'rugs')],
                    ['title' => 'Hallway Runners', 'url' => route('frontend.product.show', 'rugs')],
                    ['title' => 'Outdoor Rugs', 'url' => route('frontend.product.show', 'rugs')],
                ],
                'Shop by room' => [
                    ['title' => 'Living Room Rugs', 'url' => route('frontend.product.show', 'rugs')],
                    ['title' => 'Bedroom Rugs', 'url' => route('frontend.product.show', 'rugs')],
                    ['title' => 'Dining Room Rugs', 'url' => route('frontend.product.show', 'rugs')],
                    ['title' => 'Custom Rugs', 'url' => route('frontend.product.show', 'rugs')],
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

        'vinyl' => [
            'label' => 'Vinyl',
            'url' => route('frontend.product.show', 'vinyl'),
            'columns' => [
                'Shop vinyl' => [
                    ['title' => 'Luxury Vinyl Plank', 'url' => route('frontend.product.show', 'vinyl')],
                    ['title' => 'Sheet Vinyl', 'url' => route('frontend.product.show', 'vinyl')],
                    ['title' => 'Waterproof Vinyl', 'url' => route('frontend.product.show', 'vinyl')],
                    ['title' => 'Commercial Vinyl', 'url' => route('frontend.product.show', 'vinyl')],
                ],
                'Best for' => [
                    ['title' => 'Kitchens', 'url' => route('frontend.product.show', 'vinyl')],
                    ['title' => 'Bathrooms', 'url' => route('frontend.product.show', 'vinyl')],
                    ['title' => 'Rental Homes', 'url' => route('frontend.product.show', 'vinyl')],
                    ['title' => 'Busy Family Areas', 'url' => route('frontend.product.show', 'vinyl')],
                ],
            ],
            'products' => [
                [
                    'name' => 'Avenue Oak Vinyl',
                    'image' => 'https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?auto=format&fit=crop&w=500&q=80',
                    'url' => route('frontend.product.show', 'vinyl'),
                ],
                [
                    'name' => 'Urban Charcoal Plank',
                    'image' => 'https://images.unsplash.com/photo-1600573472591-ee6b68d14c68?auto=format&fit=crop&w=500&q=80',
                    'url' => route('frontend.product.show', 'vinyl'),
                ],
                [
                    'name' => 'Homescapes Native LVP',
                    'image' => 'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?auto=format&fit=crop&w=500&q=80',
                    'url' => route('frontend.product.show', 'vinyl'),
                ],
            ],
            'promo' => [
                'title' => 'Low-maintenance floors for real homes',
                'text' => 'Vinyl is practical, durable and suitable for kitchens, rentals and everyday living.',
                'image' => 'https://images.unsplash.com/photo-1600607688969-a5bfcd646154?auto=format&fit=crop&w=700&q=80',
            ],
        ],

        'timber' => [
            'label' => 'Timber',
            'url' => route('frontend.product.show', 'timber'),
            'columns' => [
                'Shop timber' => [
                    ['title' => 'Engineered Timber', 'url' => route('frontend.product.show', 'timber')],
                    ['title' => 'Oak Flooring', 'url' => route('frontend.product.show', 'timber')],
                    ['title' => 'Blackbutt Timber', 'url' => route('frontend.product.show', 'timber')],
                    ['title' => 'Spotted Gum', 'url' => route('frontend.product.show', 'timber')],
                ],
                'Finish' => [
                    ['title' => 'Matte Finish', 'url' => route('frontend.product.show', 'timber')],
                    ['title' => 'Natural Finish', 'url' => route('frontend.product.show', 'timber')],
                    ['title' => 'Light Timber', 'url' => route('frontend.product.show', 'timber')],
                    ['title' => 'Warm Timber', 'url' => route('frontend.product.show', 'timber')],
                ],
            ],
            'products' => [
                [
                    'name' => 'Heritage Blackbutt',
                    'image' => 'https://images.unsplash.com/photo-1600210491369-e753d80a41f3?auto=format&fit=crop&w=500&q=80',
                    'url' => route('frontend.product.show', 'timber'),
                ],
                [
                    'name' => 'Parky Summit Timber',
                    'image' => 'https://images.unsplash.com/photo-1600585154526-990dced4db0d?auto=format&fit=crop&w=500&q=80',
                    'url' => route('frontend.product.show', 'timber'),
                ],
                [
                    'name' => 'Natural Oak Finish',
                    'image' => 'https://images.unsplash.com/photo-1600210491892-03d54c0aaf87?auto=format&fit=crop&w=500&q=80',
                    'url' => route('frontend.product.show', 'timber'),
                ],
            ],
            'promo' => [
                'title' => 'Natural warmth with premium character',
                'text' => 'Timber flooring gives the showroom a refined, long-term interior direction.',
                'image' => 'https://images.unsplash.com/photo-1600210492493-0946911123ea?auto=format&fit=crop&w=700&q=80',
            ],
        ],
    ];

    $normalLinks = [
        ['label' => 'Projects', 'url' => $homeUrl . '#projects'],
        ['label' => 'Book Quote', 'url' => route('frontend.quote')],
    ];
@endphp

<header data-mega-header class="mega-header">
    <div class="mega-topbar desktop-only">
        <div class="site-container">
            <div class="flex h-10 items-center justify-between text-[12px] font-semibold uppercase tracking-[0.24em]">
                <span>Free local measure & quote</span>
                <span>Carpet · Vinyl · Timber · Laminate · Rugs</span>
                <span>Premium flooring demo</span>
            </div>
        </div>
    </div>

    <div class="mega-mainbar">
        <div class="site-container">
            <div class="flex h-[82px] items-center justify-between gap-4">
                <a href="{{ route('frontend.home') }}" class="flex items-center gap-4">
                    <div class="mega-logo-card">
                        <div class="text-center leading-none">
                            <div class="-skew-x-12 font-heading text-2xl font-extrabold tracking-tight text-mega-orange">
                                MEGA
                            </div>
                            <div class="text-[10px] font-semibold uppercase tracking-[0.26em] text-mega-black">
                                Carpets
                            </div>
                        </div>
                    </div>

                    <span class="hidden text-xs font-semibold uppercase tracking-[0.35em] text-mega-orange sm:inline">
                        Showroom
                    </span>
                </a>

                <nav class="desktop-only hidden items-center gap-8 text-sm font-extrabold text-mega-text lg:flex">
                    @foreach($mainLinks as $link)
                        <a href="{{ $link['url'] }}" class="mega-nav-link">
                            {{ $link['label'] }}
                        </a>
                    @endforeach
                </nav>

                <div class="hidden items-center gap-3 lg:flex">
                    <a href="{{ route('frontend.quote') }}" class="mega-consult-btn">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M4 20l7-16 3 7 7 3-17 6z" />
                        </svg>
                        Book free consultation
                    </a>

                    <a href="tel:1300131196" class="mega-phone-link">
                        <span class="premium-mini-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2A19.8 19.8 0 0 1 3.11 5.18 2 2 0 0 1 5.1 3h3a2 2 0 0 1 2 1.72c.13.95.35 1.88.66 2.76a2 2 0 0 1-.45 2.11L9.03 10.87a16 16 0 0 0 4.1 4.1l1.28-1.28a2 2 0 0 1 2.11-.45c.88.31 1.81.53 2.76.66A2 2 0 0 1 22 16.92z" />
                            </svg>
                        </span>
                        1300 131 196
                    </a>

                    <div class="header-action-pod">
                        <button type="button" data-search-toggle class="premium-icon-button" aria-label="Search products">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <circle cx="11" cy="11" r="7.2" />
                                <path d="M16.2 16.2L21 21" />
                            </svg>
                        </button>

                        <a href="{{ url('/admin/login') }}" class="premium-icon-button" aria-label="Admin login">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <circle cx="12" cy="8" r="4" />
                                <path d="M4.5 21a7.5 7.5 0 0 1 15 0" />
                            </svg>
                        </a>

                        <button type="button" data-open-wishlist class="premium-icon-button relative" aria-label="Wishlist">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path d="M20.8 5.6c-1.6-1.8-4.2-1.9-5.9-.2L12 8.3 9.1 5.4C7.4 3.7 4.8 3.8 3.2 5.6c-1.7 2-1.5 5 .4 6.9L12 21l8.4-8.5c1.9-1.9 2.1-4.9.4-6.9z" />
                            </svg>

                            <span data-wishlist-count class="hidden premium-count-badge">0</span>
                        </button>

                        <button type="button" data-open-quote class="premium-icon-button relative" aria-label="Quote basket">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path d="M6.2 6.4h15l-1.9 8.2H8.1L6.2 6.4z" />
                                <path d="M6.2 6.4L5.2 3H2.6" />
                                <circle cx="9.2" cy="20" r="1.5" />
                                <circle cx="18.2" cy="20" r="1.5" />
                            </svg>

                            <span data-quote-count class="hidden premium-count-badge">0</span>
                        </button>
                    </div>
                </div>

                <div class="mobile-only hidden items-center gap-2">
                    <button type="button" data-search-toggle class="premium-icon-button" aria-label="Search products">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <circle cx="11" cy="11" r="7.2" />
                            <path d="M16.2 16.2L21 21" />
                        </svg>
                    </button>

                    <button type="button" data-open-quote class="premium-icon-button relative" aria-label="Quote basket">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M6.2 6.4h15l-1.9 8.2H8.1L6.2 6.4z" />
                            <path d="M6.2 6.4L5.2 3H2.6" />
                            <circle cx="9.2" cy="20" r="1.5" />
                            <circle cx="18.2" cy="20" r="1.5" />
                        </svg>

                        <span data-quote-count class="hidden premium-count-badge">0</span>
                    </button>

                    <button type="button" data-mobile-menu-button class="premium-icon-button" aria-label="Toggle menu">
                        <svg data-menu-open-icon viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M4 7h16M4 12h16M4 17h16" stroke-linecap="round" />
                        </svg>

                        <svg data-menu-close-icon class="hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M6 6l12 12M18 6L6 18" stroke-linecap="round" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div data-header-search class="header-search-panel">
        <div class="site-container">
            <form action="{{ route('frontend.products') }}" method="GET" class="header-search-box">
                <div>
                    <p class="section-kicker mb-2">Search flooring</p>
                    <h3 class="text-2xl font-extrabold tracking-tight text-mega-black">
                        Find carpet, vinyl, timber, rugs and quote-ready products.
                    </h3>
                </div>

                <div class="grid gap-3 lg:grid-cols-[1fr_180px_180px_auto]">
                    <input type="search" name="q" class="input-clean" placeholder="Search by product, colour or room">

                    <select name="category" class="input-clean">
                        <option value="">All categories</option>
                        <option value="carpet">Carpet</option>
                        <option value="flooring">Flooring</option>
                        <option value="rugs">Rugs</option>
                        <option value="vinyl">Vinyl</option>
                        <option value="timber">Timber</option>
                    </select>

                    <select name="room" class="input-clean">
                        <option value="">All rooms</option>
                        <option value="bedroom">Bedroom</option>
                        <option value="living-room">Living Room</option>
                        <option value="kitchen">Kitchen</option>
                        <option value="commercial">Commercial</option>
                    </select>

                    <button type="submit" class="btn-primary">
                        Search
                    </button>
                </div>

                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('frontend.product.show', 'carpet') }}" class="header-search-chip">Bedroom carpet</a>
                    <a href="{{ route('frontend.product.show', 'vinyl') }}" class="header-search-chip">Waterproof vinyl</a>
                    <a href="{{ route('frontend.product.show', 'timber') }}" class="header-search-chip">Premium timber</a>
                    <a href="{{ route('frontend.product.show', 'rugs') }}" class="header-search-chip">Living room rugs</a>
                </div>

                <button type="button" data-search-close class="header-search-close" aria-label="Close search">
                    ×
                </button>
            </form>
        </div>
    </div>

    <div class="mega-productbar hidden lg:block">
        <div class="site-container">
            <div class="flex min-h-[58px] items-center justify-between gap-6">
                <nav class="flex items-center gap-1 text-sm font-bold text-mega-text">
                    @foreach($megaMenus as $key => $menu)
                        <div class="mega-menu-group relative">
                            <a href="{{ $menu['url'] }}" class="mega-product-link">
                                {{ $menu['label'] }}

                                <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.5">
                                    <path d="M6 9l6 6 6-6" />
                                </svg>
                            </a>

                            <div class="mega-menu-card mega-menu-card-wide z-[90] border border-mega-line bg-white p-7 shadow-premium radius-7">
                                <div class="grid gap-7 lg:grid-cols-[1.05fr_1.05fr_1.15fr_1.15fr]">
                                    <div class="grid grid-cols-2 gap-8">
                                        @foreach($menu['columns'] as $columnTitle => $links)
                                            <div>
                                                <p class="section-kicker">{{ $columnTitle }}</p>

                                                <div class="grid gap-4 text-[15px] font-extrabold text-mega-text">
                                                    @foreach($links as $link)
                                                        <a href="{{ $link['url'] }}" class="mega-menu-text-link">
                                                            {{ $link['title'] }}
                                                        </a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div>
                                        <p class="section-kicker">Featured Products</p>

                                        <div class="grid gap-3">
                                            @foreach($menu['products'] as $product)
                                                <a href="{{ $product['url'] }}"
                                                    class="group grid grid-cols-[88px_1fr_auto] overflow-hidden border border-mega-line bg-white transition hover:border-mega-orange/50 hover:shadow-soft radius-7">
                                                    <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}"
                                                        class="h-[86px] w-full object-cover">

                                                    <div class="flex flex-col justify-center px-4">
                                                        <h4 class="text-base font-extrabold leading-tight text-mega-black">
                                                            {{ $product['name'] }}
                                                        </h4>
                                                        <p class="mt-1 text-sm font-semibold text-mega-muted">
                                                            Product details
                                                        </p>
                                                    </div>

                                                    <span class="flex items-center pr-4 text-xl text-mega-orange transition group-hover:translate-x-1">
                                                        →
                                                    </span>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="overflow-hidden bg-mega-soft radius-7">
                                        <img src="{{ $menu['promo']['image'] }}" alt="{{ $menu['promo']['title'] }}"
                                            class="h-52 w-full object-cover">

                                        <div class="p-5">
                                            <h3 class="text-2xl font-extrabold leading-tight text-mega-black">
                                                {{ $menu['promo']['title'] }}
                                            </h3>
                                            <p class="mt-3 text-sm font-semibold leading-7 text-mega-muted">
                                                {{ $menu['promo']['text'] }}
                                            </p>

                                            <a href="{{ $menu['url'] }}"
                                                class="mt-5 inline-flex items-center gap-2 text-sm font-extrabold text-mega-orange">
                                                Explore {{ $menu['label'] }} →
                                            </a>
                                        </div>
                                    </div>

                                    <div class="bg-mega-black p-5 text-white radius-7">
                                        <p class="section-kicker">Free measure & quote</p>

                                        <h3 class="text-2xl font-extrabold leading-tight text-white">
                                            Compare samples at home before choosing.
                                        </h3>

                                        <p class="mt-3 text-sm font-medium leading-7 text-white/65">
                                            Customers can browse products, save favourites and request a quote instead of checking out online.
                                        </p>

                                        <div class="mt-5 grid gap-2">
                                            <a href="{{ route('frontend.quote') }}" class="btn-primary justify-center">
                                                Book quote
                                            </a>

                                            <a href="{{ route('frontend.products') }}" class="btn-light justify-center border-white/15 bg-white/10 text-white hover:bg-white hover:text-mega-black">
                                                View all products
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    @foreach($normalLinks as $link)
                        <a href="{{ $link['url'] }}" class="mega-product-link">
                            {{ $link['label'] }}
                        </a>
                    @endforeach
                </nav>

                <div class="flex items-center gap-7 text-sm font-extrabold text-mega-text">
                    <a href="{{ route('frontend.contact') }}" class="mega-side-link">
                        <span class="premium-mini-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path d="M12 21s7-5.2 7-12a7 7 0 1 0-14 0c0 6.8 7 12 7 12z" />
                                <circle cx="12" cy="9" r="2.5" />
                            </svg>
                        </span>
                        Find your local store
                    </a>

                    <a href="{{ route('frontend.home') }}#visualizer" class="mega-side-link">
                        <span class="premium-mini-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path d="M15 3h6v6M9 21H3v-6M21 3l-7 7M3 21l7-7" />
                            </svg>
                        </span>
                        Room Visualiser
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div data-mobile-menu class="mobile-menu border-b border-mega-line bg-white lg:hidden">
        <div class="site-container py-5">
            <nav class="grid gap-2 text-sm font-semibold text-mega-text">
                <a href="{{ route('frontend.home') }}" class="mobile-menu-link">Home</a>
                <a href="{{ route('frontend.products') }}" class="mobile-menu-link">All Products</a>

                @foreach($megaMenus as $menu)
                    <a href="{{ $menu['url'] }}" class="mobile-menu-link">
                        {{ $menu['label'] }}
                    </a>
                @endforeach

                <a href="{{ route('frontend.home') }}#projects" class="mobile-menu-link">Projects</a>
                <a href="{{ route('frontend.home') }}#services" class="mobile-menu-link">Services</a>
                <a href="{{ route('frontend.home') }}#visualizer" class="mobile-menu-link">Room Visualiser</a>
                <a href="{{ route('frontend.inspiration') }}" class="mobile-menu-link">Inspiration</a>
                <a href="{{ route('frontend.contact') }}" class="mobile-menu-link">Contact</a>
                <a href="{{ url('/admin/login') }}" class="mobile-menu-link">Admin Login</a>
                <a href="{{ route('frontend.quote') }}" class="mobile-menu-link is-cta">Book free quote</a>
            </nav>

            <div class="mt-4 grid grid-cols-3 gap-2">
                <button type="button" data-open-wishlist class="btn-light justify-center">Wishlist</button>
                <button type="button" data-open-quote class="btn-light justify-center">Quote</button>
                <a href="tel:1300131196" class="btn-primary justify-center">Call</a>
            </div>
        </div>
    </div>
</header>

<div class="mega-header-spacer"></div>