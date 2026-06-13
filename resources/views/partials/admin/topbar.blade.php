@php
    $adminUnreadQuoteCount = \App\Models\QuoteRequest::whereNull('read_at')->count();
@endphp

<header class="sticky top-0 z-30 border-b border-mega-line bg-white/85 backdrop-blur-xl">
    <div class="flex h-20 items-center justify-between gap-4 px-4 sm:px-6 lg:px-8">
        <div class="flex min-w-0 items-center gap-4">
            <button type="button"
                class="flex h-11 w-11 shrink-0 items-center justify-center border border-mega-line bg-white text-mega-black shadow-sm transition hover:border-mega-orange hover:text-mega-orange radius-7"
                @click="toggleSidebar()" aria-label="Toggle sidebar">
                <svg class="h-5 w-5 lg:hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M4 7h16M4 12h16M4 17h16" stroke-linecap="round" />
                </svg>

                <svg class="hidden h-5 w-5 lg:block" :class="sidebarCollapsed ? 'rotate-180' : ''" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M15 18l-6-6 6-6" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>

            <div class="min-w-0">
                <div class="flex items-center gap-2">
                    <h1 class="truncate text-2xl leading-tight text-mega-black">
                        @yield('page_title', 'Dashboard')
                    </h1>

                    <span
                        class="hidden bg-mega-orange/10 px-2.5 py-1 text-xs font-medium uppercase tracking-[0.16em] text-mega-orange radius-7 sm:inline-flex">
                        Admin
                    </span>
                </div>

            </div>
        </div>

        <div class="flex items-center gap-3">
            {{-- <div class="hidden xl:block">
                <div class="relative">
                    <svg class="absolute left-4 top-1/2 h-4 w-4 -translate-y-1/2 text-mega-muted" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="1.5">
                        <circle cx="11" cy="11" r="7" />
                        <path d="M20 20l-3.5-3.5" />
                    </svg>

                    <input type="text"
                        class="w-80 border border-mega-line bg-white py-3 pl-11 pr-4 text-sm outline-none transition placeholder:text-mega-muted/70 focus:border-mega-orange focus:ring-4 focus:ring-orange-500/10 radius-7"
                        placeholder="Search products, quotes...">
                </div>
            </div> --}}

            <a href="{{ route('frontend.home') }}" target="_blank"
                class="hidden items-center gap-2 border border-mega-line bg-white px-4 py-3 text-sm font-medium text-mega-text shadow-sm transition hover:border-mega-orange hover:text-mega-orange radius-7 md:inline-flex">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M14 3h7v7" />
                    <path d="M21 3l-9 9" />
                    <path d="M5 7v14h14v-7" />
                </svg>
                View Website
            </a>


            <a href="{{ route('admin.quote-requests.index', ['status' => 'unread']) }}"
                class="relative flex h-11 w-11 items-center justify-center border border-mega-line bg-white text-mega-black shadow-sm transition hover:border-mega-orange hover:text-mega-orange radius-7"
                title="Unread quote requests">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9z" />
                    <path d="M10 21h4" />
                </svg>

                @if($adminUnreadQuoteCount > 0)
                    <span
                        class="absolute -right-1 -top-1 flex h-5 min-w-5 items-center justify-center rounded-full bg-mega-orange px-1 text-[10px] font-bold text-white">
                        {{ $adminUnreadQuoteCount > 99 ? '99+' : $adminUnreadQuoteCount }}
                    </span>
                @endif
            </a>

            <div
                class="hidden items-center gap-3 border border-mega-line bg-white px-3 py-2 shadow-sm radius-7 sm:flex">
                <div
                    class="flex h-10 w-10 items-center justify-center bg-mega-orange text-sm font-medium text-white radius-7">
                    {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                </div>

                <div class="hidden text-sm md:block">
                    <p class="max-w-[140px] truncate font-medium text-mega-black">
                        {{ Auth::user()->name ?? 'Admin User' }}
                    </p>
                    <p class="max-w-[160px] truncate text-xs text-mega-muted">
                        {{ Auth::user()->email ?? 'admin@megacarpets.com' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</header>