@extends('layouts.admin')

@section('title', 'Dashboard | Mega Carpets Admin')
@section('page_title', 'Dashboard')

@section('content')

<div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-4">
    <div class="clean-card relative overflow-hidden bg-white p-6">
        <div class="absolute right-0 top-0 h-24 w-24 translate-x-8 -translate-y-8 rounded-full bg-mega-orange/10"></div>

        <div class="relative">
            <div class="mb-5 flex h-12 w-12 items-center justify-center bg-mega-orange/10 text-mega-orange radius-7">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M21 8l-9-5-9 5 9 5 9-5z" />
                    <path d="M3 8v8l9 5 9-5V8" />
                    <path d="M12 13v8" />
                </svg>
            </div>

            <p class="text-sm text-mega-muted">Total Products</p>
            <h2 class="mt-3 text-4xl text-mega-black">0</h2>
            <p class="mt-3 text-sm text-mega-muted">Products module will be connected later.</p>
        </div>
    </div>

    <div class="clean-card relative overflow-hidden bg-white p-6">
        <div class="absolute right-0 top-0 h-24 w-24 translate-x-8 -translate-y-8 rounded-full bg-mega-orange/10"></div>

        <div class="relative">
            <div class="mb-5 flex h-12 w-12 items-center justify-center bg-mega-orange/10 text-mega-orange radius-7">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M4 4h7v7H4zM13 4h7v7h-7zM4 13h7v7H4zM13 13h7v7h-7z" />
                </svg>
            </div>

            <p class="text-sm text-mega-muted">Categories</p>
            <h2 class="mt-3 text-4xl text-mega-black">6</h2>
            <p class="mt-3 text-sm text-mega-muted">Carpet, Hybrid, Timber, Laminate, Vinyl, Rugs.</p>
        </div>
    </div>

    <div class="clean-card relative overflow-hidden bg-white p-6">
        <div class="absolute right-0 top-0 h-24 w-24 translate-x-8 -translate-y-8 rounded-full bg-mega-orange/10"></div>

        <div class="relative">
            <div class="mb-5 flex h-12 w-12 items-center justify-center bg-mega-orange/10 text-mega-orange radius-7">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M5 4h14v16H5z" />
                    <path d="M8 8h8M8 12h8M8 16h5" />
                </svg>
            </div>

            <p class="text-sm text-mega-muted">Quote Requests</p>
            <h2 class="mt-3 text-4xl text-mega-black">0</h2>
            <p class="mt-3 text-sm text-mega-muted">Quote form database will be added next.</p>
        </div>
    </div>

    <div class="clean-card relative overflow-hidden bg-mega-black p-6 text-white">
        <div class="absolute right-0 top-0 h-28 w-28 translate-x-8 -translate-y-8 rounded-full bg-mega-orange/25"></div>

        <div class="relative">
            <div class="mb-5 flex h-12 w-12 items-center justify-center bg-white/10 text-mega-orange radius-7">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M3 7h11v9H3z" />
                    <path d="M14 10h4l3 3v3h-7z" />
                    <circle cx="7" cy="18" r="2" />
                    <circle cx="18" cy="18" r="2" />
                </svg>
            </div>

            <p class="text-sm text-white/55">Mobile Showroom</p>
            <h2 class="mt-3 text-4xl text-white">0</h2>
            <p class="mt-3 text-sm text-white/55">Mobile showroom requests will be tracked here.</p>
        </div>
    </div>
</div>

<div class="mt-8 grid gap-5 xl:grid-cols-[1.25fr_0.75fr]">
    <div class="clean-card overflow-hidden bg-white">
        <div class="border-b border-mega-line p-6">
            <div class="flex flex-col justify-between gap-4 md:flex-row md:items-center">
                <div>
                    <p class="section-label mb-2">Website management</p>
                    <h2 class="text-2xl text-mega-black">Admin Modules</h2>
                    <p class="mt-2 text-sm text-mega-muted">
                        Manage every major section of the Mega Carpets website from here.
                    </p>
                </div>

                <button type="button" class="btn-primary w-fit">
                    Add New Product
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M12 5v14M5 12h14" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="grid gap-4 p-6 sm:grid-cols-2 xl:grid-cols-3">
            @foreach([
                ['title' => 'Products', 'desc' => 'Add carpets, vinyl, timber and rugs.'],
                ['title' => 'Categories', 'desc' => 'Control product category structure.'],
                ['title' => 'Quote Requests', 'desc' => 'Track customer enquiries.'],
                ['title' => 'Mobile Showroom', 'desc' => 'Manage visit requests.'],
                ['title' => 'Inspiration Articles', 'desc' => 'Publish guides and ideas.'],
                ['title' => 'Homepage Content', 'desc' => 'Update hero and sections.'],
                ['title' => 'Reviews', 'desc' => 'Manage customer trust content.'],
                ['title' => 'SEO Pages', 'desc' => 'Prepare local landing pages.'],
                ['title' => 'Website Settings', 'desc' => 'Control contact and branding.'],
            ] as $module)
                <a href="#" class="group border border-mega-line bg-mega-soft p-5 transition hover:border-mega-orange hover:bg-white hover:shadow-soft radius-7">
                    <div class="mb-5 flex h-10 w-10 items-center justify-center border border-mega-line bg-white text-mega-orange transition group-hover:border-mega-orange radius-7">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M5 12h14" />
                            <path d="M13 6l6 6-6 6" />
                        </svg>
                    </div>

                    <h3 class="text-lg text-mega-black">
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
        <div class="clean-card overflow-hidden bg-mega-black p-6 text-white">
            <div class="relative">
                <div class="absolute -right-10 -top-10 h-28 w-28 rounded-full bg-mega-orange/25 blur-2xl"></div>

                <p class="text-xs font-medium uppercase tracking-[0.22em] text-mega-orange">
                    Logged in as admin
                </p>

                <h2 class="mt-4 text-3xl leading-tight text-white">
                    Premium control panel is ready.
                </h2>

                <p class="mt-4 text-sm leading-7 text-white/60">
                    Next step is to connect products, categories, quote requests and website settings with database CRUD.
                </p>

                <div class="mt-6 border border-white/10 bg-white/5 p-4 radius-7">
                    <p class="text-sm font-medium text-white">
                        {{ Auth::user()->name }}
                    </p>
                    <p class="mt-1 text-sm text-white/45">
                        {{ Auth::user()->email }}
                    </p>
                </div>
            </div>
        </div>

        <div class="clean-card bg-white p-6">
            <p class="section-label mb-2">Quick actions</p>

            <div class="mt-4 grid gap-3">
                <a href="#" class="flex items-center justify-between border border-mega-line bg-white px-4 py-3 text-sm font-medium text-mega-text transition hover:border-mega-orange hover:text-mega-orange radius-7">
                    Add product
                    <span>→</span>
                </a>

                <a href="#" class="flex items-center justify-between border border-mega-line bg-white px-4 py-3 text-sm font-medium text-mega-text transition hover:border-mega-orange hover:text-mega-orange radius-7">
                    View quote requests
                    <span>→</span>
                </a>

                <a href="#" class="flex items-center justify-between border border-mega-line bg-white px-4 py-3 text-sm font-medium text-mega-text transition hover:border-mega-orange hover:text-mega-orange radius-7">
                    Update homepage
                    <span>→</span>
                </a>

                <a href="{{ route('frontend.home') }}" target="_blank" class="flex items-center justify-between border border-mega-line bg-white px-4 py-3 text-sm font-medium text-mega-text transition hover:border-mega-orange hover:text-mega-orange radius-7">
                    Preview website
                    <span>→</span>
                </a>
            </div>
        </div>
    </div>
</div>

@endsection