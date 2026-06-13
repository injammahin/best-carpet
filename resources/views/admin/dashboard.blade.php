@extends('layouts.admin')

@section('title', 'Dashboard | Mega Carpets Admin')
@section('page_title', 'Dashboard')

@section('content')

    <div class="space-y-8">
        <section class="clean-card overflow-hidden bg-mega-black text-white">
            <div class="relative p-6 md:p-8">
                <div class="absolute right-0 top-0 h-44 w-44 translate-x-10 -translate-y-12 rounded-full bg-mega-orange/25 blur-2xl"></div>
                <div class="absolute bottom-0 left-0 h-36 w-36 -translate-x-12 translate-y-12 rounded-full bg-white/10 blur-2xl"></div>

                <div class="relative grid gap-8 lg:grid-cols-[1fr_360px] lg:items-center">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.24em] text-mega-orange">
                            Mega Carpets Admin
                        </p>



                        <p class="mt-5 max-w-3xl text-base leading-8 text-white/65">
                            This control panel gives you a quick overview of the whole website and helps you jump to the most important admin tasks.
                        </p>

                        <div class="mt-7 flex flex-col gap-3 sm:flex-row">
                            @if(Route::has('admin.products.create'))
                                <a href="{{ route('admin.products.create') }}" class="btn-primary justify-center">
                                    Add New Product
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path d="M12 5v14M5 12h14" />
                                    </svg>
                                </a>
                            @endif

                            @if(Route::has('admin.quote-requests.index'))
                                <a href="{{ route('admin.quote-requests.index') }}" class="inline-flex items-center justify-center gap-2 border border-white/15 bg-white/10 px-6 py-4 text-sm font-semibold text-white transition hover:bg-white hover:text-mega-black radius-7">
                                    View Quote Requests
                                </a>
                            @endif

                            @if(Route::has('frontend.home'))
                                <a href="{{ route('frontend.home') }}" target="_blank" class="inline-flex items-center justify-center gap-2 border border-white/15 bg-white/10 px-6 py-4 text-sm font-semibold text-white transition hover:bg-white hover:text-mega-black radius-7">
                                    Preview Website
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="rounded-[26px] border border-white/10 bg-white/10 p-5 backdrop-blur">
                        <p class="text-xs font-semibold uppercase tracking-[0.22em] text-mega-orange">
                            Logged in as
                        </p>

                        <div class="mt-5 flex items-center gap-4">
                            <div class="grid h-14 w-14 place-items-center rounded-full bg-mega-orange text-xl font-black text-white">
                                {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                            </div>

                            <div class="min-w-0">
                                <h2 class="truncate text-xl font-black text-white">
                                    {{ Auth::user()->name ?? 'Admin' }}
                                </h2>
                                <p class="mt-1 truncate text-sm text-white/55">
                                    {{ Auth::user()->email ?? 'admin@example.com' }}
                                </p>
                            </div>
                        </div>

                        <div class="mt-6 grid grid-cols-2 gap-3">
                            <div class="rounded-[18px] bg-white/10 p-4">
                                <p class="text-3xl font-black text-white">{{ $stats['unread_quotes'] ?? 0 }}</p>
                                <p class="mt-1 text-xs font-semibold uppercase tracking-[0.15em] text-white/45">
                                    Unread quotes
                                </p>
                            </div>

                            <div class="rounded-[18px] bg-white/10 p-4">
                                <p class="text-3xl font-black text-white">{{ $stats['active_products'] ?? 0 }}</p>
                                <p class="mt-1 text-xs font-semibold uppercase tracking-[0.15em] text-white/45">
                                    Active products
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="grid gap-5 sm:grid-cols-2 xl:grid-cols-4">
            @foreach($dashboardCards as $card)
                <a href="{{ $card['url'] ?: '#' }}"
                    class="clean-card relative overflow-hidden p-6 transition hover:-translate-y-1 hover:shadow-premium {{ $card['theme'] === 'dark' ? 'bg-mega-black text-white' : 'bg-white text-mega-black' }}">
                    <div class="absolute right-0 top-0 h-28 w-28 translate-x-8 -translate-y-8 rounded-full {{ $card['theme'] === 'dark' ? 'bg-mega-orange/25' : 'bg-mega-orange/10' }}"></div>

                    <div class="relative">
                        <div class="mb-5 flex h-12 w-12 items-center justify-center radius-7 {{ $card['theme'] === 'dark' ? 'bg-white/10 text-mega-orange' : 'bg-mega-orange/10 text-mega-orange' }}">
                            @if($card['icon'] === 'box')
                                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M21 8l-9-5-9 5 9 5 9-5z" />
                                    <path d="M3 8v8l9 5 9-5V8" />
                                    <path d="M12 13v8" />
                                </svg>
                            @elseif($card['icon'] === 'grid')
                                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M4 4h7v7H4zM13 4h7v7h-7zM4 13h7v7H4zM13 13h7v7h-7z" />
                                </svg>
                            @elseif($card['icon'] === 'quote')
                                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M5 4h14v16H5z" />
                                    <path d="M8 8h8M8 12h8M8 16h5" />
                                </svg>
                            @else
                                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M12 2l2.7 6.8 7.3.5-5.6 4.7 1.8 7L12 17.2 5.8 21l1.8-7L2 9.3l7.3-.5L12 2z" />
                                </svg>
                            @endif
                        </div>

                        <p class="{{ $card['theme'] === 'dark' ? 'text-white/55' : 'text-mega-muted' }} text-sm">
                            {{ $card['title'] }}
                        </p>

                        <h2 class="mt-3 text-4xl font-black {{ $card['theme'] === 'dark' ? 'text-white' : 'text-mega-black' }}">
                            {{ $card['value'] }}
                        </h2>

                        <p class="mt-2 text-sm font-semibold text-mega-orange">
                            {{ $card['sub_value'] }}
                        </p>

                        <p class="mt-3 text-sm leading-6 {{ $card['theme'] === 'dark' ? 'text-white/55' : 'text-mega-muted' }}">
                            {{ $card['description'] }}
                        </p>
                    </div>
                </a>
            @endforeach
        </section>

        <section class="grid gap-5 xl:grid-cols-[1.3fr_0.7fr]">
            <div class="clean-card overflow-hidden bg-white">
                <div class="border-b border-mega-line p-6">
                    <div class="flex flex-col justify-between gap-4 md:flex-row md:items-center">
                        <div>
                            <p class="section-label mb-2">Website management</p>
                            <h2 class="text-2xl font-black text-mega-black">Admin Modules</h2>
                            <p class="mt-2 text-sm text-mega-muted">
                                Manage every major section of the Mega Carpets website from here.
                            </p>
                        </div>

                        @if(Route::has('admin.products.create'))
                            <a href="{{ route('admin.products.create') }}" class="btn-primary w-fit">
                                Add New Product
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path d="M12 5v14M5 12h14" />
                                </svg>
                            </a>
                        @endif
                    </div>
                </div>

                <div class="grid gap-4 p-6 sm:grid-cols-2 xl:grid-cols-3">
                    @foreach($modules as $module)
                        <a href="{{ $module['url'] ?: '#' }}"
                            @if(!empty($module['external'])) target="_blank" @endif
                            class="group border border-mega-line bg-mega-soft p-5 transition hover:border-mega-orange hover:bg-white hover:shadow-soft radius-7">
                            <div class="mb-5 flex items-center justify-between gap-3">
                                <div class="flex h-10 w-10 items-center justify-center border border-mega-line bg-white text-mega-orange transition group-hover:border-mega-orange radius-7">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path d="M5 12h14" />
                                        <path d="M13 6l6 6-6 6" />
                                    </svg>
                                </div>

                                <span class="rounded-full bg-white px-3 py-1 text-xs font-semibold text-mega-muted">
                                    {{ $module['badge'] }}
                                </span>
                            </div>

                            <h3 class="text-lg font-black text-mega-black">
                                {{ $module['title'] }}
                            </h3>

                            <p class="mt-2 text-sm leading-6 text-mega-muted">
                                {{ $module['desc'] }}
                            </p>
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="space-y-5">
                <div class="clean-card bg-white p-6">
                    <p class="section-label mb-2">Quick actions</p>
                    <h2 class="text-2xl font-black text-mega-black">Common Tasks</h2>

                    <div class="mt-5 grid gap-3">
                        @foreach($quickActions as $action)
                            <a href="{{ $action['url'] ?: '#' }}"
                                @if(!empty($action['external'])) target="_blank" @endif
                                class="flex items-center justify-between border border-mega-line bg-white px-4 py-3 text-sm font-semibold text-mega-text transition hover:border-mega-orange hover:text-mega-orange radius-7">
                                {{ $action['label'] }}
                                <span>→</span>
                            </a>
                        @endforeach
                    </div>
                </div>

                <div class="clean-card bg-white p-6">
                    <p class="section-label mb-2">Website health</p>
                    <h2 class="text-2xl font-black text-mega-black">Quick Summary</h2>

                    <div class="mt-5 space-y-4">
                        <div>
                            <div class="mb-2 flex items-center justify-between text-sm font-semibold">
                                <span class="text-mega-muted">Products active</span>
                                <span class="text-mega-black">{{ $stats['active_products'] ?? 0 }}/{{ $stats['total_products'] ?? 0 }}</span>
                            </div>
                            <div class="h-2 overflow-hidden rounded-full bg-mega-soft">
                                <div class="h-full rounded-full bg-mega-orange" style="width: {{ ($stats['total_products'] ?? 0) > 0 ? min(100, (($stats['active_products'] ?? 0) / ($stats['total_products'] ?? 1)) * 100) : 0 }}%"></div>
                            </div>
                        </div>

                        <div>
                            <div class="mb-2 flex items-center justify-between text-sm font-semibold">
                                <span class="text-mega-muted">Reviews active</span>
                                <span class="text-mega-black">{{ $stats['active_reviews'] ?? 0 }}/{{ $stats['total_reviews'] ?? 0 }}</span>
                            </div>
                            <div class="h-2 overflow-hidden rounded-full bg-mega-soft">
                                <div class="h-full rounded-full bg-mega-orange" style="width: {{ ($stats['total_reviews'] ?? 0) > 0 ? min(100, (($stats['active_reviews'] ?? 0) / ($stats['total_reviews'] ?? 1)) * 100) : 0 }}%"></div>
                            </div>
                        </div>

                        <div>
                            <div class="mb-2 flex items-center justify-between text-sm font-semibold">
                                <span class="text-mega-muted">FAQs active</span>
                                <span class="text-mega-black">{{ $stats['active_faqs'] ?? 0 }}/{{ $stats['total_faqs'] ?? 0 }}</span>
                            </div>
                            <div class="h-2 overflow-hidden rounded-full bg-mega-soft">
                                <div class="h-full rounded-full bg-mega-orange" style="width: {{ ($stats['total_faqs'] ?? 0) > 0 ? min(100, (($stats['active_faqs'] ?? 0) / ($stats['total_faqs'] ?? 1)) * 100) : 0 }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="grid gap-5 xl:grid-cols-2">
            <div class="clean-card overflow-hidden bg-white">
                <div class="border-b border-mega-line p-6">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <p class="section-label mb-2">Latest enquiries</p>
                            <h2 class="text-2xl font-black text-mega-black">Recent Quote Requests</h2>
                        </div>

                        @if(Route::has('admin.quote-requests.index'))
                            <a href="{{ route('admin.quote-requests.index') }}" class="text-sm font-semibold text-mega-orange hover:text-mega-black">
                                View all
                            </a>
                        @endif
                    </div>
                </div>

                <div class="divide-y divide-mega-line">
                    @forelse($recentQuotes as $quote)
                        <a href="{{ Route::has('admin.quote-requests.show') ? route('admin.quote-requests.show', $quote) : '#' }}"
                            class="block p-5 transition hover:bg-mega-soft">
                            <div class="flex items-start justify-between gap-4">
                                <div class="min-w-0">
                                    <h3 class="truncate text-base font-black text-mega-black">
                                        {{ trim(($quote->first_name ?? '') . ' ' . ($quote->last_name ?? '')) ?: 'Customer' }}
                                    </h3>

                                    <p class="mt-1 text-sm text-mega-muted">
                                        {{ $quote->email ?? 'No email' }} · {{ $quote->phone ?? 'No phone' }}
                                    </p>

                                    <p class="mt-2 line-clamp-2 text-sm leading-6 text-mega-muted">
                                        {{ $quote->comments ?: 'No customer message added.' }}
                                    </p>
                                </div>

                                <div class="shrink-0 text-right">
                                    <span class="rounded-full px-3 py-1 text-xs font-semibold {{ is_null($quote->read_at) ? 'bg-mega-orange/10 text-mega-orange' : 'bg-gray-100 text-gray-500' }}">
                                        {{ is_null($quote->read_at) ? 'Unread' : 'Read' }}
                                    </span>

                                    <p class="mt-2 text-xs text-mega-muted">
                                        {{ optional($quote->created_at)->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="p-8 text-center">
                            <h3 class="text-xl font-black text-mega-black">No quote requests yet.</h3>
                            <p class="mt-2 text-sm text-mega-muted">Customer quote requests will appear here.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="clean-card overflow-hidden bg-white">
                <div class="border-b border-mega-line p-6">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <p class="section-label mb-2">Catalogue updates</p>
                            <h2 class="text-2xl font-black text-mega-black">Recently Added Products</h2>
                        </div>

                        @if(Route::has('admin.products.index'))
                            <a href="{{ route('admin.products.index') }}" class="text-sm font-semibold text-mega-orange hover:text-mega-black">
                                View all
                            </a>
                        @endif
                    </div>
                </div>

                <div class="divide-y divide-mega-line">
                    @forelse($recentProducts as $product)
                        <a href="{{ Route::has('admin.products.edit') ? route('admin.products.edit', $product) : '#' }}"
                            class="block p-5 transition hover:bg-mega-soft">
                            <div class="flex items-center justify-between gap-4">
                                <div class="min-w-0">
                                    <h3 class="truncate text-base font-black text-mega-black">
                                        {{ $product->name }}
                                    </h3>

                                    <p class="mt-1 text-sm text-mega-muted">
                                        {{ optional($product->category)->name ?: 'No category' }}
                                    </p>

                                    <p class="mt-2 text-xs text-mega-muted">
                                        Added {{ optional($product->created_at)->diffForHumans() }}
                                    </p>
                                </div>

                                <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $product->is_active ? 'bg-green-50 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                                    {{ $product->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </div>
                        </a>
                    @empty
                        <div class="p-8 text-center">
                            <h3 class="text-xl font-black text-mega-black">No products yet.</h3>
                            <p class="mt-2 text-sm text-mega-muted">Add products to build your frontend catalogue.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
    </div>

@endsection