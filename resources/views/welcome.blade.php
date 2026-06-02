@extends('layouts.app')

@section('title', 'Premium Carpet Portfolio Website')
@section('meta_description', 'Explore premium carpets, flooring collections, and elegant interior surfaces.')

@section('content')

    <section class="relative overflow-hidden">
        <div class="container-premium py-20 md:py-28">
            <div class="grid items-center gap-12 lg:grid-cols-2">
                <div>
                    <p class="mb-5 inline-flex rounded-full bg-white px-4 py-2 text-sm font-semibold text-premiumBrown shadow-sm">
                        Premium Carpet & Flooring Portfolio
                    </p>

                    <h1 class="text-5xl font-bold tracking-tight md:text-7xl">
                        Elegant flooring for modern interiors.
                    </h1>

                    <p class="mt-6 max-w-xl text-lg leading-8 text-premiumGray">
                        Discover premium carpet collections, refined textures, natural tones, and flooring solutions designed for beautiful homes and commercial spaces.
                    </p>

                    <div class="mt-8 flex flex-wrap gap-4">
                        <a href="#" class="btn-primary">Explore Collections</a>
                        <a href="#" class="btn-outline">Request a Quote</a>
                    </div>
                </div>

                <div class="premium-card overflow-hidden p-3">
                    <div class="aspect-[4/3] rounded-[1rem] bg-gradient-to-br from-premiumBrown via-premiumGold to-premiumDark"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white py-20">
        <div class="container-premium">
            <div class="max-w-3xl">
                <h2 class="section-title">Featured Collections</h2>
                <p class="section-subtitle">
                    A clean starting structure for your product portfolio. Later we will connect this with database-driven carpet products.
                </p>
            </div>

            <div class="mt-12 grid gap-6 md:grid-cols-3">
                <div class="premium-card p-6">
                    <div class="h-52 rounded-2xl bg-premiumCream"></div>
                    <h3 class="mt-6 text-xl font-bold">Luxury Wool Carpet</h3>
                    <p class="mt-3 text-sm leading-6 text-premiumGray">
                        Soft, durable, and ideal for premium residential interiors.
                    </p>
                </div>

                <div class="premium-card p-6">
                    <div class="h-52 rounded-2xl bg-premiumCream"></div>
                    <h3 class="mt-6 text-xl font-bold">Modern Textured Flooring</h3>
                    <p class="mt-3 text-sm leading-6 text-premiumGray">
                        Stylish surface options for contemporary home and office spaces.
                    </p>
                </div>

                <div class="premium-card p-6">
                    <div class="h-52 rounded-2xl bg-premiumCream"></div>
                    <h3 class="mt-6 text-xl font-bold">Commercial Carpet Tiles</h3>
                    <p class="mt-3 text-sm leading-6 text-premiumGray">
                        Practical, elegant, and suitable for high-traffic business areas.
                    </p>
                </div>
            </div>
        </div>
    </section>

@endsection