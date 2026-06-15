@php
    use App\Models\QuoteRequest;

    $unreadQuoteCount = class_exists(QuoteRequest::class)
        ? QuoteRequest::whereNull('read_at')->count()
        : 0;

    $navItems = [
        [
            'label' => 'Dashboard',
            'url' => route('admin.dashboard'),
            'active' => request()->routeIs('admin.dashboard'),
            'icon' => 'dashboard',
            'badge' => null,
        ],
        [
            'label' => 'Home Settings',
            'url' => route('admin.home-settings.edit'),
            'active' => request()->routeIs('admin.home-settings.*'),
            'icon' => 'settings',
            'badge' => null,
        ],

        [
            'label' => 'Products',
            'url' => route('admin.products.index'),
            'active' => request()->routeIs('admin.products.*'),
            'icon' => 'box',
            'badge' => null,
        ],
        [
            'label' => 'Categories',
            'url' => route('admin.product-categories.index'),
            'active' => request()->routeIs('admin.product-categories.*'),
            'icon' => 'grid',
            'badge' => null,
        ],
        [
            'label' => 'Area Sizes',
            'url' => route('admin.product-sizes.index'),
            'active' => request()->routeIs('admin.product-sizes.*'),
            'icon' => 'quote',
            'badge' => null,
        ],
        [
            'label' => 'Quote Requests',
            'url' => route('admin.quote-requests.index'),
            'active' => request()->routeIs('admin.quote-requests.*'),
            'icon' => 'quote',
            'badge' => $unreadQuoteCount,
        ],

        [
            'label' => 'Reviews',
            'url' => route('admin.reviews.index'),
            'active' => request()->routeIs('admin.reviews.*'),
            'icon' => 'star',
            'badge' => null,
        ],
        [
            'label' => 'FAQs',
            'url' => route('admin.faqs.index'),
            'active' => request()->routeIs('admin.faqs.*'),
            'icon' => 'article',
            'badge' => null,
        ],
        [
            'label' => 'Settings',
            'url' => route('admin.settings.edit'),
            'active' => request()->routeIs('admin.settings.*'),
            'icon' => 'settings',
            'badge' => null,
        ],
    ];
@endphp

<aside
    class="fixed inset-y-0 left-0 z-50 w-72 -translate-x-full overflow-hidden bg-mega-black text-white shadow-[24px_0_80px_rgba(0,0,0,0.22)] transition-all duration-300 lg:translate-x-0"
    :class="[
        sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0',
        sidebarCollapsed ? 'lg:!w-[92px]' : 'lg:!w-72'
    ]">
    <div class="pointer-events-none absolute inset-0">
        <div class="absolute -top-28 left-10 h-56 w-56 rounded-full bg-mega-orange/20 blur-3xl"></div>
        <div class="absolute bottom-20 right-0 h-44 w-44 rounded-full bg-white/5 blur-3xl"></div>
        <div
            class="absolute inset-0 bg-[linear-gradient(180deg,rgba(255,90,10,0.08),transparent_28%,rgba(255,255,255,0.03))]">
        </div>
    </div>

    <div class="relative flex h-full flex-col">
        <div class="flex h-24 items-center justify-between border-b border-white/10 px-5">
            <a href="{{ route('admin.dashboard') }}" class="flex min-w-0 items-center gap-3">
                <div class="flex h-12 w-[92px] shrink-0 items-center justify-center bg-white radius-7">
                    <img src="/images/logo/mega_logo_3-removebg-preview.webp" alt="Mega Carpets Logo"
                        class="max-h-10 w-auto object-contain">
                </div>

                <div x-show="!sidebarCollapsed || !isDesktop" x-transition.opacity class="min-w-0">
                    <p class="truncate text-sm font-medium text-white">
                        Admin Panel
                    </p>
                    <p class="mt-1 truncate text-[11px] uppercase tracking-[0.22em] text-mega-orange">
                        Showroom
                    </p>
                </div>
            </a>

            <button type="button"
                class="flex h-10 w-10 shrink-0 items-center justify-center border border-white/10 bg-white/5 text-white/80 transition hover:border-mega-orange hover:text-mega-orange radius-7 lg:hidden"
                @click="sidebarOpen = false" aria-label="Close sidebar">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M6 6l12 12M18 6L6 18" stroke-linecap="round" />
                </svg>
            </button>
        </div>

        <div class="hidden px-5 pt-5 lg:block">
            <button type="button"
                class="flex w-full items-center gap-3 border border-white/10 bg-white/5 px-3 py-3 text-sm font-medium text-white/70 transition hover:border-mega-orange hover:bg-mega-orange/10 hover:text-white radius-7"
                :class="sidebarCollapsed ? 'justify-center' : 'justify-start'" @click="toggleSidebar()">
                <svg class="h-5 w-5 shrink-0 transition" :class="sidebarCollapsed ? 'rotate-180' : ''"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M15 18l-6-6 6-6" stroke-linecap="round" stroke-linejoin="round" />
                </svg>

                <span x-show="!sidebarCollapsed" x-transition.opacity>
                    Collapse sidebar
                </span>
            </button>
        </div>

        <nav class="flex-1 space-y-1 overflow-y-auto px-4 py-5">
            @foreach($navItems as $item)
                <a href="{{ $item['url'] }}" @click="closeMobileSidebar()"
                    class="group relative flex items-center gap-3 px-4 py-3 text-sm font-medium transition radius-7
                                                        {{ $item['active'] ? 'bg-mega-orange text-white shadow-[0_16px_34px_rgba(255,90,10,0.24)]' : 'text-white/62 hover:bg-white/[0.08] hover:text-white' }}"
                    :class="sidebarCollapsed && isDesktop ? 'justify-center px-3' : 'justify-start'">
                    <span class="flex h-5 w-5 shrink-0 items-center justify-center">
                        @if($item['icon'] === 'dashboard')
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M4 13h7V4H4v9zM13 20h7V4h-7v16zM4 20h7v-5H4v5z" />
                            </svg>
                        @elseif($item['icon'] === 'box')
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M21 8l-9-5-9 5 9 5 9-5z" />
                                <path d="M3 8v8l9 5 9-5V8" />
                                <path d="M12 13v8" />
                            </svg>
                        @elseif($item['icon'] === 'grid')
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M4 4h7v7H4zM13 4h7v7h-7zM4 13h7v7H4zM13 13h7v7h-7z" />
                            </svg>
                        @elseif($item['icon'] === 'quote')
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M5 4h14v16H5z" />
                                <path d="M8 8h8M8 12h8M8 16h5" />
                            </svg>
                        @elseif($item['icon'] === 'van')
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M3 7h11v9H3z" />
                                <path d="M14 10h4l3 3v3h-7z" />
                                <circle cx="7" cy="18" r="2" />
                                <circle cx="18" cy="18" r="2" />
                            </svg>
                        @elseif($item['icon'] === 'article')
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M5 4h14v16H5z" />
                                <path d="M8 8h8M8 12h8M8 16h4" />
                            </svg>
                        @elseif($item['icon'] === 'star')
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M12 3l2.7 5.5 6 .9-4.3 4.2 1 6-5.4-2.8-5.4 2.8 1-6-4.3-4.2 6-.9L12 3z" />
                            </svg>
                        @else
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <circle cx="12" cy="12" r="3" />
                                <path
                                    d="M19 12a7 7 0 0 0-.1-1l2-1.5-2-3.4-2.4 1a7 7 0 0 0-1.8-1L14.4 3h-4.8l-.3 3.1a7 7 0 0 0-1.8 1l-2.4-1-2 3.4 2 1.5A7 7 0 0 0 5 12a7 7 0 0 0 .1 1l-2 1.5 2 3.4 2.4-1a7 7 0 0 0 1.8 1l.3 3.1h4.8l.3-3.1a7 7 0 0 0 1.8-1l2.4 1 2-3.4-2-1.5A7 7 0 0 0 19 12z" />
                            </svg>
                        @endif
                    </span>

                    <span x-show="!sidebarCollapsed || !isDesktop" x-transition.opacity class="truncate">
                        {{ $item['label'] }}
                    </span>

                    @if(!empty($item['badge']) && $item['badge'] > 0)
                        <span x-show="!sidebarCollapsed || !isDesktop"
                            class="ml-auto flex h-5 min-w-5 items-center justify-center rounded-full bg-white px-1 text-[10px] font-bold text-mega-orange">
                            {{ $item['badge'] > 99 ? '99+' : $item['badge'] }}
                        </span>
                    @endif

                    @if($item['active'])
                        <span x-show="!sidebarCollapsed || !isDesktop" class="ml-1 h-2 w-2 rounded-full bg-white"></span>
                    @endif
                </a>
            @endforeach
        </nav>

        <div class="border-t border-white/10 p-4">
            <div class="border border-white/10 bg-white/5 p-4 radius-7"
                :class="sidebarCollapsed && isDesktop ? 'px-3' : ''">
                <div class="flex items-center gap-3" :class="sidebarCollapsed && isDesktop ? 'justify-center' : ''">
                    <div
                        class="flex h-11 w-11 shrink-0 items-center justify-center bg-mega-orange text-sm font-medium text-white radius-7">
                        {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                    </div>

                    <div x-show="!sidebarCollapsed || !isDesktop" x-transition.opacity class="min-w-0">
                        <p class="truncate text-sm font-medium text-white">
                            {{ Auth::user()->name ?? 'Admin User' }}
                        </p>
                        <p class="truncate text-xs text-white/45">
                            {{ Auth::user()->email ?? 'admin@megacarpets.com' }}
                        </p>
                    </div>
                </div>

                <form action="{{ route('admin.logout') }}" method="POST" class="mt-4"
                    x-show="!sidebarCollapsed || !isDesktop" x-transition.opacity>
                    @csrf

                    <button type="submit"
                        class="flex w-full items-center justify-center gap-2 border border-white/10 bg-white/5 px-4 py-3 text-sm font-medium text-white/70 transition hover:border-mega-orange hover:bg-mega-orange hover:text-white radius-7">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M10 17l5-5-5-5" />
                            <path d="M15 12H3" />
                            <path d="M21 3v18" />
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</aside>

<div x-show="sidebarOpen" x-transition.opacity x-cloak class="fixed inset-0 z-40 bg-black/55 backdrop-blur-sm lg:hidden"
    @click="sidebarOpen = false"></div>