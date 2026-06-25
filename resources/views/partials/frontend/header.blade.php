@php
    use App\Models\ProductCategory;
    use App\Models\SiteSetting;

    try {
        $settings = SiteSetting::frontend();
    } catch (\Throwable $e) {
        $settings = SiteSetting::defaults();
    }

    $homeUrl = route('frontend.home');

    $siteLogo = SiteSetting::imageUrl(
        $settings['site_logo'] ?? '/images/logo/mega_logo_3-removebg-preview.webp',
        '/images/logo/mega_logo_3-removebg-preview.webp'
    );

    $siteName = $settings['site_name'] ?? 'Mega Carpets';
    $siteTagline = $settings['site_tagline'] ?? 'Showroom';

    $phoneNumber = $settings['phone_number'] ?? '1300 131 196';
    $phoneLink = $settings['phone_link'] ?? '1300131196';

    $showAdminLogin = ($settings['show_header_admin_login'] ?? '1') === '1';
    $showWishlistButton = ($settings['show_wishlist_button'] ?? '1') === '1';
    $showQuoteButton = ($settings['show_quote_button'] ?? '1') === '1';

    $topbarLeft = $settings['topbar_left'] ?? 'Free local measure & quote';
    $topbarMiddle = $settings['topbar_middle'] ?? 'Carpet · Timber · Hybrid · Laminate · Vinyl · Rugs';
    $topbarRight = $settings['topbar_right'] ?? 'Premium flooring showroom';

    $consultationButtonText = $settings['consultation_button_text'] ?? 'Book a free Measure & Quote';

    $carpetCategory = ProductCategory::active()
        ->where('slug', 'carpet')
        ->first();

    $carpetUrl = $carpetCategory
        ? route('frontend.product.show', $carpetCategory->slug)
        : route('frontend.products');

    $carpetTypes = collect();

    if ($carpetCategory) {
        $carpetTypes = ProductCategory::active()
            ->where('parent_id', $carpetCategory->id)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get()
            ->map(function ($type) use ($carpetUrl) {
                return [
                    'label' => $type->name,
                    'url' => $carpetUrl . '?type[]=' . urlencode($type->name),
                    'text' => $type->short_description ?: 'Premium carpet option for modern homes and commercial rooms.',
                    'image' => $type->image_url ?: 'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?auto=format&fit=crop&w=500&q=80',
                    'slug' => $type->slug,
                ];
            })
            ->values();
    }

    $topCategories = ProductCategory::active()
        ->whereNull('parent_id')
        ->where('slug', '!=', 'carpet')
        ->orderBy('sort_order')
        ->orderBy('name')
        ->get();

    $productNavLinks = $topCategories
        ->map(fn($category) => [
            'label' => $category->name,
            'url' => route('frontend.product.show', $category->slug),
            'slug' => $category->slug,
        ])
        ->concat([
            [
                'label' => 'Specials',
                'url' => route('frontend.specials'),
                'slug' => 'specials',
            ],
            [
                'label' => 'Blog',
                'url' => route('frontend.blog.index'),
                'slug' => 'blog',
            ],
        ])
        ->values()
        ->all();

    $searchCategories = ProductCategory::active()
        ->whereNull('parent_id')
        ->orderBy('sort_order')
        ->orderBy('name')
        ->get();

    $searchChips = $carpetTypes
        ->take(2)
        ->map(fn($type) => [
            'label' => $type['label'],
            'url' => $type['url'],
        ])
        ->merge(
            $topCategories->take(5)->map(fn($category) => [
                'label' => $category->name,
                'url' => route('frontend.product.show', $category->slug),
            ])
        )
        ->values()
        ->all();
@endphp
@php
    $adminUrl = auth()->check() && auth()->user()?->is_admin
        ? route('admin.dashboard')
        : route('admin.login');
@endphp
<header data-mega-header class="mega-header">
    @if($topbarLeft || $topbarMiddle || $topbarRight)
        <div class="mega-topbar desktop-only">
            <div class="site-container">
                <div
                    class="flex h-10 items-center justify-between gap-4 text-[12px] font-semibold uppercase tracking-[0.24em]">
                    <span>{{ $topbarLeft }}</span>
                    <span>{{ $topbarMiddle }}</span>
                    <span>{{ $topbarRight }}</span>
                </div>
            </div>
        </div>
    @endif

    <div class="mega-mainbar">
        <div class="site-container">
            <div class="flex h-[82px] items-center justify-between gap-4">
                <a href="{{ route('frontend.home') }}" class="flex shrink-0 items-center gap-4">
                    <div class="mega-logo-card">
                        <img src="{{ $siteLogo }}" alt="{{ $siteName }}" class="h-full w-full object-contain">
                    </div>

                    <span class="hidden text-xs font-semibold uppercase tracking-[0.35em] text-mega-orange sm:inline">
                        {{ $siteTagline }}
                    </span>
                </a>

                <div class="hidden items-center gap-3 lg:flex">
                    <a href="{{ route('frontend.quote') }}" class="mega-consult-btn">
                        <img src="/images/image__1_-removebg-preview.png" class="h-6 w-6 text-white brightness-1 invert
                    " alt="icon">

                        {{ $consultationButtonText }}
                    </a>

                    @if($phoneNumber)
                        <a href="tel:{{ $phoneLink }}" class="mega-phone-link">
                            <span class="premium-mini-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path
                                        d="M22 16.92v3a2 2 0 0 1-2.18 2A19.8 19.8 0 0 1 3.11 5.18 2 2 0 0 1 5.1 3h3a2 2 0 0 1 2 1.72c.13.95.35 1.88.66 2.76a2 2 0 0 1-.45 2.11L9.03 10.87a16 16 0 0 0 4.1 4.1l1.28-1.28a2 2 0 0 1 2.11-.45c.88.31 1.81.53 2.76.66A2 2 0 0 1 22 16.92z" />
                                </svg>
                            </span>
                            {{ $phoneNumber }}
                        </a>
                    @endif

                    <div class="header-action-pod">
                        <button type="button" data-search-toggle class="premium-icon-button"
                            aria-label="Search products">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <circle cx="11" cy="11" r="7.2" />
                                <path d="M16.2 16.2L21 21" />
                            </svg>
                        </button>

                        @if($showAdminLogin)
                            <a href="{{ $adminUrl }}" class="premium-icon-button" aria-label="Admin login">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <circle cx="12" cy="8" r="4" />
                                    <path d="M4.5 21a7.5 7.5 0 0 1 15 0" />
                                </svg>
                            </a>
                        @endif

                        @if($showWishlistButton)
                            <button type="button" data-open-wishlist class="premium-icon-button relative"
                                aria-label="Wishlist">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path
                                        d="M20.8 5.6c-1.6-1.8-4.2-1.9-5.9-.2L12 8.3 9.1 5.4C7.4 3.7 4.8 3.8 3.2 5.6c-1.7 2-1.5 5 .4 6.9L12 21l8.4-8.5c1.9-1.9 2.1-4.9.4-6.9z" />
                                </svg>
                                <span data-wishlist-count class="hidden premium-count-badge">0</span>
                            </button>
                        @endif

                        @if($showQuoteButton)
                            <button type="button" data-open-quote class="premium-icon-button relative"
                                aria-label="Quote basket">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path d="M6.2 6.4h15l-1.9 8.2H8.1L6.2 6.4z" />
                                    <path d="M6.2 6.4L5.2 3H2.6" />
                                    <circle cx="9.2" cy="20" r="1.5" />
                                    <circle cx="18.2" cy="20" r="1.5" />
                                </svg>
                                <span data-quote-count class="hidden premium-count-badge">0</span>
                            </button>
                        @endif
                    </div>
                </div>

                <div class="mobile-only hidden items-center gap-2">
                    <button type="button" data-search-toggle class="premium-icon-button" aria-label="Search products">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <circle cx="11" cy="11" r="7.2" />
                            <path d="M16.2 16.2L21 21" />
                        </svg>
                    </button>

                    @if($showQuoteButton)
                        <button type="button" data-open-quote class="premium-icon-button relative"
                            aria-label="Quote basket">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path d="M6.2 6.4h15l-1.9 8.2H8.1L6.2 6.4z" />
                                <path d="M6.2 6.4L5.2 3H2.6" />
                                <circle cx="9.2" cy="20" r="1.5" />
                                <circle cx="18.2" cy="20" r="1.5" />
                            </svg>
                            <span data-quote-count class="hidden premium-count-badge">0</span>
                        </button>
                    @endif

                    <button type="button" data-mobile-menu-button class="premium-icon-button"
                        aria-label="Toggle mobile menu" aria-expanded="false">
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
            <form action="{{ route('frontend.products') }}" method="GET" class="header-search-box"
                data-header-search-form>
                <div>
                    <p class="section-kicker mb-2">Search flooring</p>

                    <h3 class="text-2xl font-extrabold tracking-tight text-mega-black">
                        Find carpet, timber, hybrid, laminate, vinyl and rugs.
                    </h3>
                </div>

                <div class="grid gap-3 lg:grid-cols-[1fr_220px_auto]">
                    <div class="relative">
                        <input type="search" name="q" value="{{ request('q') }}" class="input-clean pr-12"
                            placeholder="Search by product, colour or room" autocomplete="off" data-search-input
                            data-suggestion-url="{{ route('frontend.search.suggestions') }}">

                        <button type="button" data-search-input-clear
                            class="absolute right-4 top-1/2 hidden -translate-y-1/2 text-xl font-black text-mega-muted hover:text-mega-orange"
                            aria-label="Clear search">
                            ×
                        </button>

                        <div data-search-suggestions
                            class="absolute left-0 right-0 top-[calc(100%+10px)] z-[120] hidden max-h-[420px] overflow-y-auto overscroll-contain border border-mega-line bg-white shadow-premium radius-7"
                            style="scrollbar-width: thin;">
                        </div>
                    </div>

                    <select name="category" class="input-clean" data-search-category>
                        <option value="">All categories</option>

                        @foreach($searchCategories as $category)
                            <option value="{{ $category->slug }}" @selected(request('category') === $category->slug)>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>

                    <button type="submit" class="btn-primary">
                        Search
                    </button>
                </div>

                <div class="flex flex-wrap gap-2">
                    @foreach($searchChips as $chip)
                        <a href="{{ $chip['url'] }}" class="header-search-chip">
                            {{ $chip['label'] }}
                        </a>
                    @endforeach
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
                <nav class="mega-product-nav">
                    <div class="carpet-dropdown-group">
                        <a href="{{ $carpetUrl }}" class="mega-product-link">
                            Carpet
                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.7">
                                <path d="M6 9l6 6 6-6" />
                            </svg>
                        </a>

                        <div class="carpet-dropdown-panel">
                            <div class="carpet-dropdown-inner">
                                <div class="carpet-dropdown-heading">
                                    <p class="section-kicker mb-2">Shop carpet</p>
                                    <h3>Choose carpet by fibre type</h3>
                                    <p>
                                        Premium carpet options for bedrooms, family spaces, rental homes and commercial
                                        rooms.
                                    </p>
                                </div>

                                <div class="carpet-type-grid">
                                    @forelse($carpetTypes as $type)
                                        <a href="{{ $type['url'] }}" class="carpet-type-card">
                                            <img src="{{ $type['image'] }}" alt="{{ $type['label'] }}">

                                            <span>
                                                <strong>{{ $type['label'] }}</strong>
                                                <small>{{ $type['text'] }}</small>
                                            </span>

                                            <em>→</em>
                                        </a>
                                    @empty
                                        <a href="{{ $carpetUrl }}" class="carpet-type-card">
                                            <img src="https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?auto=format&fit=crop&w=500&q=80"
                                                alt="Carpet">

                                            <span>
                                                <strong>All Carpet</strong>
                                                <small>Browse all available carpet ranges.</small>
                                            </span>

                                            <em>→</em>
                                        </a>
                                    @endforelse
                                </div>

                                <div class="carpet-dropdown-promo">
                                    <p class="section-kicker mb-2">Free measure & quote</p>
                                    <h4>Compare carpet samples at home before choosing.</h4>
                                    <p>
                                        Customers can browse carpet types, save favourites and request a quote without
                                        checkout pressure.
                                    </p>

                                    <div class="mt-4 grid gap-2">
                                        <a href="{{ route('frontend.quote') }}" class="btn-primary justify-center">
                                            Book quote
                                        </a>

                                        <a href="{{ route('frontend.products') }}" class="btn-light justify-center">
                                            View all products
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @foreach($productNavLinks as $link)
                        <a href="{{ $link['url'] }}" class="mega-product-link">
                            {{ $link['label'] }}
                        </a>
                    @endforeach
                </nav>

                {{-- <div class="mega-product-right">
                    <a href="{{ route('frontend.contact') }}" class="mega-side-link">
                        <span class="premium-mini-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path d="M12 21s7-5.2 7-12a7 7 0 1 0-14 0c0 6.8 7 12 7 12z" />
                                <circle cx="12" cy="9" r="2.5" />
                            </svg>
                        </span>
                        Find local store
                    </a>

                    <a href="{{ route('frontend.quote') }}" class="mega-side-link">
                        <span class="premium-mini-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path d="M4 5h16v14H4z" />
                                <path d="M8 9h8M8 13h5" />
                            </svg>
                        </span>
                        Measure & quote
                    </a>
                </div> --}}
            </div>
        </div>
    </div>

    <div data-mobile-menu class="mobile-menu mega-mobile-menu lg:hidden">
        <div class="site-container py-5">
            <nav class="grid gap-2 text-sm font-semibold text-mega-text">
                <a href="{{ route('frontend.home') }}" class="mobile-menu-link">Home</a>

                <details class="mobile-submenu" open>
                    <summary>
                        Carpet
                        <span>⌄</span>
                    </summary>

                    <div class="grid gap-2 p-3">
                        <a href="{{ $carpetUrl }}" class="mobile-menu-link">All Carpet</a>

                        @foreach($carpetTypes as $type)
                            <a href="{{ $type['url'] }}" class="mobile-menu-link">
                                {{ $type['label'] }}
                            </a>
                        @endforeach
                    </div>
                </details>

                @foreach($topCategories as $category)
                    <a href="{{ route('frontend.product.show', $category->slug) }}" class="mobile-menu-link">
                        {{ $category->name }}
                    </a>
                @endforeach

                <a href="{{ route('frontend.specials') }}" class="mobile-menu-link">
                    Specials
                </a>

                <a href="{{ route('frontend.blog.index') }}" class="mobile-menu-link">
                    Blog
                </a>
                @if($showAdminLogin)
                    <a href="{{ url('/admin/login') }}" class="mobile-menu-link">Admin Login</a>
                @endif
            </nav>

            <div class="mt-4 grid gap-2"
                style="grid-template-columns: repeat({{ $showWishlistButton && $showQuoteButton ? 3 : 2 }}, minmax(0, 1fr));">
                @if($showWishlistButton)
                    <button type="button" data-open-wishlist class="btn-light justify-center">Wishlist</button>
                @endif

                @if($showQuoteButton)
                    <button type="button" data-open-quote class="btn-light justify-center">Quote</button>
                @endif

                @if($phoneNumber)
                    <a href="tel:{{ $phoneLink }}" class="btn-primary justify-center">Call</a>
                @endif
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('[data-header-search-form]').forEach(function (form) {
                const input = form.querySelector('[data-search-input]');
                const category = form.querySelector('[data-search-category]');
                const suggestionsBox = form.querySelector('[data-search-suggestions]');
                const clearButton = form.querySelector('[data-search-input-clear]');

                let timer = null;
                let controller = null;

                if (!input || !suggestionsBox) {
                    return;
                }

                function hideSuggestions() {
                    suggestionsBox.classList.add('hidden');
                    suggestionsBox.innerHTML = '';
                }

                function showLoading() {
                    suggestionsBox.innerHTML = `
                    <div class="p-4 text-sm font-semibold text-mega-muted">
                        Searching products...
                    </div>
                `;

                    suggestionsBox.scrollTop = 0;
                    suggestionsBox.classList.remove('hidden');
                }

                function createSuggestionItem(item) {
                    const link = document.createElement('a');

                    link.href = item.url || '#';
                    link.className = 'flex items-center gap-3 border-b border-mega-line px-4 py-3 transition hover:bg-mega-soft';

                    const imageWrap = document.createElement('div');
                    imageWrap.className = 'grid h-12 w-12 shrink-0 place-items-center overflow-hidden bg-mega-soft text-xs font-black text-mega-orange radius-7';

                    if (item.image) {
                        const image = document.createElement('img');
                        image.src = item.image;
                        image.alt = item.title || 'Search result';
                        image.className = 'h-full w-full object-cover';
                        imageWrap.appendChild(image);
                    } else {
                        imageWrap.textContent = item.type === 'category' ? 'CAT' : 'PRO';
                    }

                    const textWrap = document.createElement('div');
                    textWrap.className = 'min-w-0 flex-1';

                    const title = document.createElement('p');
                    title.className = 'truncate text-sm font-black text-mega-black';
                    title.textContent = item.title || '';

                    const subtitle = document.createElement('p');
                    subtitle.className = 'mt-1 truncate text-xs font-semibold text-mega-muted';
                    subtitle.textContent = item.subtitle || '';

                    textWrap.appendChild(title);
                    textWrap.appendChild(subtitle);

                    const badge = document.createElement('span');
                    badge.className = 'shrink-0 rounded-full bg-mega-orange/10 px-3 py-1 text-[11px] font-black uppercase tracking-[0.12em] text-mega-orange';
                    badge.textContent = item.badge || 'Result';

                    link.appendChild(imageWrap);
                    link.appendChild(textWrap);
                    link.appendChild(badge);

                    return link;
                }

                function renderSuggestions(data) {
                    suggestionsBox.innerHTML = '';

                    const query = data.query || input.value.trim();
                    const allResultsUrl = data.all_results_url || form.action;

                    const viewAll = document.createElement('a');
                    viewAll.href = allResultsUrl;
                    viewAll.className = 'sticky top-0 z-10 flex items-center justify-between gap-4 border-b border-mega-line bg-mega-cream px-4 py-4 transition hover:bg-mega-orange hover:text-white';

                    const viewAllText = document.createElement('div');

                    const viewAllTitle = document.createElement('p');
                    viewAllTitle.className = 'text-sm font-black';
                    viewAllTitle.textContent = 'View all results';

                    const viewAllSubtitle = document.createElement('p');
                    viewAllSubtitle.className = 'mt-1 text-xs font-semibold opacity-75';
                    viewAllSubtitle.textContent = query ? 'Search for "' + query + '"' : 'Open product results';

                    viewAllText.appendChild(viewAllTitle);
                    viewAllText.appendChild(viewAllSubtitle);

                    const arrow = document.createElement('span');
                    arrow.className = 'text-xl font-black';
                    arrow.textContent = '→';

                    viewAll.appendChild(viewAllText);
                    viewAll.appendChild(arrow);

                    suggestionsBox.appendChild(viewAll);

                    if (data.suggestions && data.suggestions.length) {
                        data.suggestions.forEach(function (item) {
                            suggestionsBox.appendChild(createSuggestionItem(item));
                        });
                    } else {
                        const empty = document.createElement('div');
                        empty.className = 'px-4 py-5 text-sm font-semibold text-mega-muted';
                        empty.textContent = 'No exact suggestion found. Press Search or click View all results.';
                        suggestionsBox.appendChild(empty);
                    }

                    suggestionsBox.scrollTop = 0;
                    suggestionsBox.classList.remove('hidden');
                }

                async function fetchSuggestions() {
                    const query = input.value.trim();

                    clearButton?.classList.toggle('hidden', query.length === 0);

                    if (query.length < 2) {
                        hideSuggestions();
                        return;
                    }

                    if (controller) {
                        controller.abort();
                    }

                    controller = new AbortController();

                    const params = new URLSearchParams();
                    params.set('q', query);

                    if (category && category.value) {
                        params.set('category', category.value);
                    }

                    showLoading();

                    try {
                        const response = await fetch(input.dataset.suggestionUrl + '?' + params.toString(), {
                            headers: {
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            signal: controller.signal
                        });

                        if (!response.ok) {
                            hideSuggestions();
                            return;
                        }

                        const data = await response.json();

                        renderSuggestions(data);
                    } catch (error) {
                        if (error.name !== 'AbortError') {
                            hideSuggestions();
                        }
                    }
                }

                input.addEventListener('input', function () {
                    clearTimeout(timer);

                    timer = setTimeout(fetchSuggestions, 250);
                });

                input.addEventListener('focus', function () {
                    if (input.value.trim().length >= 2) {
                        fetchSuggestions();
                    }
                });

                category?.addEventListener('change', function () {
                    if (input.value.trim().length >= 2) {
                        fetchSuggestions();
                    }
                });

                clearButton?.addEventListener('click', function () {
                    input.value = '';
                    hideSuggestions();
                    clearButton.classList.add('hidden');
                    input.focus();
                });

                document.addEventListener('click', function (event) {
                    if (!form.contains(event.target)) {
                        hideSuggestions();
                    }
                });

                form.addEventListener('submit', function () {
                    hideSuggestions();
                });
            });
        });
    </script>
</header>