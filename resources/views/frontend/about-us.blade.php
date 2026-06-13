@extends('layouts.frontend')

@section('title', 'About Us | Mega Carpets')
@section('meta_description', 'Learn about Mega Carpets, a premium flooring showroom offering carpets, timber, hybrid, laminate, vinyl, rugs and free measure and quote services.')

@section('content')

    <section class="relative overflow-hidden bg-mega-cream">
        <div
            class="absolute left-0 top-0 h-[420px] w-[420px] -translate-x-1/2 -translate-y-1/3 rounded-full bg-mega-orange/10 blur-3xl">
        </div>
        <div
            class="absolute bottom-0 right-0 h-[520px] w-[520px] translate-x-1/3 translate-y-1/3 rounded-full bg-mega-black/5 blur-3xl">
        </div>

        <div class="site-container relative py-16 md:py-24">
            <div class="grid items-center gap-12 lg:grid-cols-[1fr_0.95fr]">
                <div>
                    <p class="section-label mb-4">About Mega Carpets</p>

                    <h1 class="max-w-4xl text-5xl font-black leading-[1.04] tracking-tight text-mega-black md:text-7xl">
                        Flooring guidance made simple, premium and personal.
                    </h1>

                    <p class="mt-6 max-w-2xl text-lg font-medium leading-8 text-mega-muted">
                        Mega Carpets is built around one clear idea: choosing flooring should feel easy, confident and
                        enjoyable. We help homeowners, builders and business owners compare carpet, timber, hybrid,
                        laminate, vinyl and rugs with a quote-first consultation experience.
                    </p>

                    <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                        <a href="{{ route('frontend.quote') }}" class="btn-primary justify-center">
                            Book Free Measure & Quote
                        </a>

                        <a href="{{ route('frontend.products') }}" class="btn-light justify-center">
                            Explore Products
                        </a>
                    </div>

                    <div class="mt-10 grid gap-4 sm:grid-cols-3">
                        <div class="clean-card bg-white p-5">
                            <p class="text-3xl font-black text-mega-orange">6+</p>
                            <p class="mt-2 text-sm font-semibold text-mega-muted">Flooring categories</p>
                        </div>

                        <div class="clean-card bg-white p-5">
                            <p class="text-3xl font-black text-mega-orange">Free</p>
                            <p class="mt-2 text-sm font-semibold text-mega-muted">Measure and quote</p>
                        </div>

                        <div class="clean-card bg-white p-5">
                            <p class="text-3xl font-black text-mega-orange">1:1</p>
                            <p class="mt-2 text-sm font-semibold text-mega-muted">Showroom support</p>
                        </div>
                    </div>
                </div>

                <div class="relative">
                    <div class="absolute -left-6 -top-6 hidden h-32 w-32 rounded-[28px] bg-mega-orange/15 md:block"></div>
                    <div class="absolute -bottom-6 -right-6 hidden h-40 w-40 rounded-[32px] bg-mega-black/10 md:block">
                    </div>

                    <div class="relative overflow-hidden rounded-[34px] bg-white p-3 shadow-[0_30px_90px_rgba(0,0,0,0.14)]">
                        <img src="https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?auto=format&fit=crop&w=1400&q=85"
                            alt="Premium flooring showroom interior"
                            class="h-[420px] w-full rounded-[26px] object-cover md:h-[580px]">

                        <div
                            class="absolute bottom-8 left-8 right-8 rounded-[24px] border border-white/20 bg-white/90 p-5 shadow-xl backdrop-blur">
                            <p class="text-xs font-bold uppercase tracking-[0.22em] text-mega-orange">
                                Premium showroom experience
                            </p>
                            <p class="mt-2 text-xl font-black text-mega-black">
                                See colours, compare textures and choose with confidence.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white py-16 md:py-24">
        <div class="site-container">
            <div class="mx-auto max-w-3xl text-center">
                <p class="section-label mb-4">Who we are</p>
                <h2 class="text-4xl font-black tracking-tight text-mega-black md:text-5xl">
                    We are not just selling flooring. We are helping you finish your space properly.
                </h2>
                <p class="mt-5 text-lg leading-8 text-mega-muted">
                    From soft bedroom carpets to practical vinyl, elegant timber, modern hybrid flooring and designer rugs,
                    our focus is to guide every customer through the right options for their lifestyle, budget and design
                    vision.
                </p>
            </div>

            <div class="mt-14 grid gap-6 md:grid-cols-3">
                <div class="clean-card bg-mega-soft p-7">
                    <div class="mb-6 flex h-14 w-14 items-center justify-center bg-white text-mega-orange radius-7">
                        <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                            <path d="M4 20V8l8-4 8 4v12" />
                            <path d="M8 20v-8h8v8" />
                        </svg>
                    </div>

                    <h3 class="text-2xl font-black text-mega-black">Home focused</h3>
                    <p class="mt-4 leading-7 text-mega-muted">
                        We help customers choose flooring that fits real living spaces, from bedrooms and lounges to stairs,
                        hallways and open-plan areas.
                    </p>
                </div>

                <div class="clean-card bg-mega-soft p-7">
                    <div class="mb-6 flex h-14 w-14 items-center justify-center bg-white text-mega-orange radius-7">
                        <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                            <path d="M12 3l8 4v6c0 5-3.5 8-8 8s-8-3-8-8V7l8-4z" />
                            <path d="M9 12l2 2 4-5" />
                        </svg>
                    </div>

                    <h3 class="text-2xl font-black text-mega-black">Quality guided</h3>
                    <p class="mt-4 leading-7 text-mega-muted">
                        We explain the differences between materials, fibres, finishes and room suitability so customers can
                        make better decisions.
                    </p>
                </div>

                <div class="clean-card bg-mega-soft p-7">
                    <div class="mb-6 flex h-14 w-14 items-center justify-center bg-white text-mega-orange radius-7">
                        <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                            <path d="M4 5h16v14H4z" />
                            <path d="M8 9h8M8 13h5" />
                        </svg>
                    </div>

                    <h3 class="text-2xl font-black text-mega-black">Quote first</h3>
                    <p class="mt-4 leading-7 text-mega-muted">
                        Our free measure and quote process helps customers understand the project before committing to
                        product selection or installation.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-mega-cream py-16 md:py-24">
        <div class="site-container">
            <div class="grid items-center gap-12 lg:grid-cols-[0.95fr_1.05fr]">
                <div class="grid gap-5 sm:grid-cols-2">
                    <div class="overflow-hidden rounded-[28px] bg-white p-3 shadow-soft">
                        <img src="https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?auto=format&fit=crop&w=900&q=85"
                            alt="Soft carpet flooring" class="h-72 w-full rounded-[22px] object-cover">
                    </div>

                    <div class="mt-10 overflow-hidden rounded-[28px] bg-white p-3 shadow-soft">
                        <img src="https://images.unsplash.com/photo-1600210492493-0946911123ea?auto=format&fit=crop&w=900&q=85"
                            alt="Premium timber flooring" class="h-72 w-full rounded-[22px] object-cover">
                    </div>

                    <div class="overflow-hidden rounded-[28px] bg-white p-3 shadow-soft sm:col-span-2">
                        <img src="https://images.unsplash.com/photo-1600121848594-d8644e57abab?auto=format&fit=crop&w=1200&q=85"
                            alt="Designer rug in modern living room" class="h-80 w-full rounded-[22px] object-cover">
                    </div>
                </div>

                <div>
                    <p class="section-label mb-4">Our approach</p>
                    <h2 class="text-4xl font-black tracking-tight text-mega-black md:text-5xl">
                        We make the flooring journey clear from the first conversation.
                    </h2>

                    <div class="mt-8 space-y-5">
                        <div class="clean-card bg-white p-6">
                            <div class="flex gap-4">
                                <span
                                    class="flex h-10 w-10 shrink-0 items-center justify-center bg-mega-orange text-sm font-black text-white radius-7">
                                    01
                                </span>

                                <div>
                                    <h3 class="text-xl font-black text-mega-black">Understand the space</h3>
                                    <p class="mt-2 leading-7 text-mega-muted">
                                        We start by understanding the room, lifestyle, traffic level, colour direction and
                                        project goal.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="clean-card bg-white p-6">
                            <div class="flex gap-4">
                                <span
                                    class="flex h-10 w-10 shrink-0 items-center justify-center bg-mega-orange text-sm font-black text-white radius-7">
                                    02
                                </span>

                                <div>
                                    <h3 class="text-xl font-black text-mega-black">Compare suitable ranges</h3>
                                    <p class="mt-2 leading-7 text-mega-muted">
                                        Customers can compare colour options, area sizes, product ranges and budget before
                                        requesting a quote.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="clean-card bg-white p-6">
                            <div class="flex gap-4">
                                <span
                                    class="flex h-10 w-10 shrink-0 items-center justify-center bg-mega-orange text-sm font-black text-white radius-7">
                                    03
                                </span>

                                <div>
                                    <h3 class="text-xl font-black text-mega-black">Measure and quote</h3>
                                    <p class="mt-2 leading-7 text-mega-muted">
                                        The measure and quote step gives customers project clarity before final product
                                        confirmation.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="clean-card bg-white p-6">
                            <div class="flex gap-4">
                                <span
                                    class="flex h-10 w-10 shrink-0 items-center justify-center bg-mega-orange text-sm font-black text-white radius-7">
                                    04
                                </span>

                                <div>
                                    <h3 class="text-xl font-black text-mega-black">Support until completion</h3>
                                    <p class="mt-2 leading-7 text-mega-muted">
                                        From product choice to installation planning, the goal is a smooth and confident
                                        flooring experience.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('frontend.quote') }}" class="btn-primary mt-8 w-fit">
                        Start Your Quote
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white py-16 md:py-24">
        <div class="site-container">
            <div class="grid gap-10 lg:grid-cols-[0.9fr_1.1fr]">
                <div>
                    <p class="section-label mb-4">What we offer</p>
                    <h2 class="text-4xl font-black tracking-tight text-mega-black md:text-5xl">
                        Flooring solutions for every room and every style.
                    </h2>

                    <p class="mt-5 text-lg leading-8 text-mega-muted">
                        Mega Carpets brings key flooring categories together in one clean showroom experience, helping
                        customers browse, compare and request guidance from one place.
                    </p>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    @foreach([
                            ['title' => 'Carpet', 'text' => 'Soft, warm and comfortable flooring for bedrooms, stairs and family areas.'],
                            ['title' => 'Timber', 'text' => 'Natural flooring with premium character, warmth and long-term appeal.'],
                            ['title' => 'Hybrid', 'text' => 'Durable timber-look flooring for practical modern family homes.'],
                            ['title' => 'Laminate', 'text' => 'Clean, affordable and easy-care flooring for everyday spaces.'],
                            ['title' => 'Vinyl', 'text' => 'Low-maintenance flooring for kitchens, rentals and busy rooms.'],
                            ['title' => 'Rugs', 'text' => 'Designer rugs and runners to complete finished interiors.'],
                        ] as $item)
                            <div class="rounded-[24px] border border-mega-line bg-mega-soft p-6 transition hover:border-mega-orange hover:bg-white hover:shadow-soft">
                                <h3 class="text-xl font-black text-mega-black">{{ $item['title'] }}</h3>
                                <p class="mt-3 leading-7 text-mega-muted">{{ $item['text'] }}</p>
                            </div>

                       @endforeach

                    </div>

                </div>
        </div>
    </section>

    <section class="relative overflow-hidden bg-mega-black py-16 text-white md:py-24">
        <div class="absolute right-0 top-0 h-80 w-80 translate-x-1/3 -translate-y-1/3 rounded-full bg-mega-orange/30 blur-3xl"></div>
        <div class="absolute bottom-0 left-0 h-72 w-72 -translate-x-1/3 translate-y-1/3 rounded-full bg-white/10 blur-3xl"></div>

        <div class="site-container relative">
            <div class="grid items-center gap-10 lg:grid-cols-[1fr_0.8fr]">
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.24em] text-mega-orange">
                        Ready to compare options?
                    </p>


                    <h2 class="mt-4 max-w-3xl text-4xl font-black leading-tight text-white md:text-5xl">
                        Book a free measure and quote before you choose your final flooring.
                    </h2>

                    <p class="mt-5 max-w-2xl text-lg leading-8 text-white/65">
                        Tell us about your rooms, preferred products and suitable days. Our team will help you plan the next step.
                    </p>
                </div>

                <div class="clean-card border-white/10 bg-white/10 p-7 text-white backdrop-blur">
                    <h3 class="text-2xl font-black text-white">Free quote request</h3>
                    <p class="mt-3 leading-7 text-white/65">
                        No pressure, no checkout, no complicated process. Just a clean way to begin your flooring project.
                    </p>

                    <div class="mt-6 grid gap-3">
                        <a href="{{ route('frontend.quote') }}" class="btn-primary justify-center">
                            Book Free Quote
                        </a>

                        <a href="{{ route('frontend.contact') }}" class="btn-light justify-center">
                            Contact Showroom
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection