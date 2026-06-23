@extends('layouts.frontend')

@section('title', 'Installation Guide | Mega Carpets')
@section('meta_description', 'From selection to installation, Mega Carpets guides you through every step of your flooring journey with free measure and quote support.')

@section('content')

    <style>
        .install-hero {
            position: relative;
            overflow: hidden;
            background:
                linear-gradient(90deg, rgba(7, 7, 7, 0.88), rgba(7, 7, 7, 0.58), rgba(7, 7, 7, 0.18)),
                url('https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?auto=format&fit=crop&w=1800&q=85');
            background-position: center;
            background-size: cover;
        }

        .install-hero-card {
            border: 1px solid rgba(255, 255, 255, 0.16);
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(18px);
            border-radius: 7px;
        }

        .install-step-card {
            position: relative;
            border: 1px solid #eadfd6;
            background: #ffffff;
            border-radius: 7px;
            box-shadow: 0 24px 70px rgba(7, 7, 7, 0.06);
            overflow: hidden;
        }

        .install-step-card::before {
            content: "";
            position: absolute;
            inset: 0 auto 0 0;
            width: 5px;
            background: #ff5a00;
        }

        .install-step-number {
            display: grid;
            width: 54px;
            height: 54px;
            place-items: center;
            border-radius: 7px;
            background: #ff5a00;
            color: #ffffff;
            font-size: 18px;
            font-weight: 950;
            box-shadow: 0 16px 34px rgba(255, 90, 0, 0.24);
        }

        .install-check {
            display: flex;
            gap: 12px;
            color: #5f5964;
            font-size: 15px;
            font-weight: 700;
            line-height: 1.7;
        }

        .install-check span {
            display: grid;
            width: 24px;
            height: 24px;
            flex: 0 0 auto;
            place-items: center;
            border-radius: 999px;
            background: #fff3ec;
            color: #ff5a00;
            font-size: 13px;
            font-weight: 950;
        }

        .prep-card {
            border: 1px solid #eadfd6;
            background: #faf7f3;
            border-radius: 7px;
            padding: 22px;
        }

        .prep-card h3 {
            color: #070707;
            font-size: 18px;
            font-weight: 950;
            letter-spacing: -0.03em;
        }

        .prep-card p {
            margin-top: 8px;
            color: #6f6873;
            font-size: 14px;
            font-weight: 650;
            line-height: 1.7;
        }

        .install-final-card {
            border-radius: 7px;
            background:
                linear-gradient(135deg, rgba(255, 90, 0, 0.96), rgba(232, 79, 0, 0.96)),
                url('https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?auto=format&fit=crop&w=1400&q=85');
            background-position: center;
            background-size: cover;
            color: #ffffff;
            overflow: hidden;
        }

        @media (max-width: 640px) {
            .install-step-card::before {
                width: 4px;
            }
        }
    </style>

    <section class="install-hero py-20 md:py-28">
        <div class="site-container">
            <div class="max-w-4xl">
                <p class="section-kicker text-white/80">
                    Installation guide
                </p>

                <h1 class="mt-5 max-w-3xl text-3xl font-black leading-[1]  text-white md:text-5xl">
                    From selection to installation, we've got you covered.
                </h1>

                <p class="mt-6 max-w-2xl text-lg font-semibold leading-8 text-white">
                    At Mega Carpets, we make the flooring process simple and stress-free. From your first consultation
                    through to professional installation, our experienced team guides you every step of the way.
                </p>

                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="{{ route('frontend.quote') }}" class="btn-primary">
                        Book your free measure & quote
                        <span>→</span>
                    </a>

                    <a href="{{ route('frontend.products') }}" class="btn-light bg-white">
                        Explore flooring ranges
                    </a>
                </div>
            </div>

            <div class="mt-12 grid gap-4 md:grid-cols-3">
                <div class="install-hero-card p-5">
                    <p class="text-3xl font-black text-white">6</p>
                    <p class="mt-2 text-xs font-black uppercase tracking-[0.18em] text-white/65">
                        Simple steps
                    </p>
                </div>

                <div class="install-hero-card p-5">
                    <p class="text-3xl font-black text-white">Free</p>
                    <p class="mt-2 text-xs font-black uppercase tracking-[0.18em] text-white/65">
                        Measure & quote
                    </p>
                </div>

                <div class="install-hero-card p-5">
                    <p class="text-3xl font-black text-white">Pro</p>
                    <p class="mt-2 text-xs font-black uppercase tracking-[0.18em] text-white/65">
                        Installation team
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-mega-cream py-14 md:py-20">
        <div class="site-container">
            <div class="mx-auto mb-12 max-w-4xl text-center">
                <p class="section-kicker">
                    Our flooring process
                </p>

                <h2 class="section-title-premium">
                    A clear process from start to finish.
                </h2>

                <p class="mx-auto section-lead">
                    We help you choose the right flooring, confirm the details, prepare your home and complete the
                    installation with care.
                </p>
            </div>

            <div class="grid gap-6">
                <article class="install-step-card p-6 md:p-8">
                    <div class="grid gap-6 md:grid-cols-[80px_1fr]">
                        <div class="install-step-number">01</div>

                        <div>
                            <p class="section-kicker">
                                Step 1
                            </p>

                            <h3 class="mt-2 text-3xl font-black leading-tight tracking-[-0.05em] text-mega-black">
                                Book your free measure & quote
                            </h3>

                            <p class="mt-4 text-base font-semibold leading-8 text-mega-muted">
                                Getting started is easy. Contact our team to arrange a free measure and quote. We can
                                welcome you into our showroom or bring our Mobile Showroom directly to your home.
                            </p>

                            <div class="mt-6 grid gap-3 md:grid-cols-2">
                                <div class="install-check"><span>✓</span>Measure your areas accurately</div>
                                <div class="install-check"><span>✓</span>Discuss your lifestyle and needs</div>
                                <div class="install-check"><span>✓</span>Show product samples and colours</div>
                                <div class="install-check"><span>✓</span>Recommend suitable flooring options</div>
                                <div class="install-check md:col-span-2"><span>✓</span>Provide expert advice and pricing
                                </div>
                            </div>
                        </div>
                    </div>
                </article>

                <article class="install-step-card p-6 md:p-8">
                    <div class="grid gap-6 md:grid-cols-[80px_1fr]">
                        <div class="install-step-number">02</div>

                        <div>
                            <p class="section-kicker">
                                Step 2
                            </p>

                            <h3 class="mt-2 text-3xl font-black leading-tight tracking-[-0.05em] text-mega-black">
                                Select your flooring
                            </h3>

                            <p class="mt-4 text-base font-semibold leading-8 text-mega-muted">
                                Once measurements are complete, we help you choose the perfect flooring for your home and
                                budget. Our goal is to make sure your new flooring looks amazing and performs beautifully
                                for years to come.
                            </p>

                            <div class="mt-6 flex flex-wrap gap-3">
                                <a href="{{ route('frontend.product.show', 'carpet') }}"
                                    class="rounded-full bg-white px-4 py-2 text-sm font-black text-mega-black shadow-sm hover:text-mega-orange">Carpet</a>
                                <a href="{{ route('frontend.product.show', 'hybrid-flooring') }}"
                                    class="rounded-full bg-white px-4 py-2 text-sm font-black text-mega-black shadow-sm hover:text-mega-orange">Hybrid
                                    Flooring</a>
                                <a href="{{ route('frontend.product.show', 'timber') }}"
                                    class="rounded-full bg-white px-4 py-2 text-sm font-black text-mega-black shadow-sm hover:text-mega-orange">Timber
                                    Flooring</a>
                                <a href="{{ route('frontend.product.show', 'laminate') }}"
                                    class="rounded-full bg-white px-4 py-2 text-sm font-black text-mega-black shadow-sm hover:text-mega-orange">Laminate
                                    Flooring</a>
                                <a href="{{ route('frontend.product.show', 'vinyl') }}"
                                    class="rounded-full bg-white px-4 py-2 text-sm font-black text-mega-black shadow-sm hover:text-mega-orange">Vinyl
                                    Flooring</a>
                                <a href="{{ route('frontend.product.show', 'rugs') }}"
                                    class="rounded-full bg-white px-4 py-2 text-sm font-black text-mega-black shadow-sm hover:text-mega-orange">Rugs
                                    and Accessories</a>
                            </div>
                        </div>
                    </div>
                </article>

                <article class="install-step-card p-6 md:p-8">
                    <div class="grid gap-6 md:grid-cols-[80px_1fr]">
                        <div class="install-step-number">03</div>

                        <div>
                            <p class="section-kicker">
                                Step 3
                            </p>

                            <h3 class="mt-2 text-3xl font-black leading-tight tracking-[-0.05em] text-mega-black">
                                Confirm your order
                            </h3>

                            <p class="mt-4 text-base font-semibold leading-8 text-mega-muted">
                                After you've selected your flooring, we confirm the details and prepare everything needed to
                                move your project forward smoothly.
                            </p>

                            <div class="mt-6 grid gap-3 md:grid-cols-2">
                                <div class="install-check"><span>✓</span>Confirm measurements</div>
                                <div class="install-check"><span>✓</span>Finalise product selections</div>
                                <div class="install-check"><span>✓</span>Prepare your quotation</div>
                                <div class="install-check"><span>✓</span>Arrange materials and installation dates</div>
                                <div class="install-check md:col-span-2"><span>✓</span>Keep you informed throughout the
                                    process</div>
                            </div>
                        </div>
                    </div>
                </article>

                <article class="install-step-card p-6 md:p-8">
                    <div class="grid gap-6 md:grid-cols-[80px_1fr]">
                        <div class="install-step-number">04</div>

                        <div>
                            <p class="section-kicker">
                                Step 4
                            </p>

                            <h3 class="mt-2 text-3xl font-black leading-tight tracking-[-0.05em] text-mega-black">
                                Prepare for installation
                            </h3>

                            <p class="mt-4 text-base font-semibold leading-8 text-mega-muted">
                                To help ensure a smooth installation, our team explains all preparation requirements before
                                installation begins.
                            </p>

                            <div class="mt-6 grid gap-4 md:grid-cols-2">
                                <div class="prep-card">
                                    <h3>Furniture</h3>
                                    <p>Please remove small items, decorations, valuables and breakables before installation
                                        day.</p>
                                </div>

                                <div class="prep-card">
                                    <h3>Access</h3>
                                    <p>Ensure our installers have clear and safe access to the areas being installed.</p>
                                </div>

                                <div class="prep-card">
                                    <h3>Appliances</h3>
                                    <p>Disconnect appliances and electronic equipment if necessary.</p>
                                </div>

                                <div class="prep-card">
                                    <h3>Existing flooring</h3>
                                    <p>Existing floor coverings may need to be uplifted and removed. Our team will discuss
                                        this during quoting.</p>
                                </div>

                                <div class="prep-card md:col-span-2">
                                    <h3>Doors and trims</h3>
                                    <p>Depending on your selected flooring, doors, trims or skirting boards may require
                                        adjustment.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>

                <article class="install-step-card p-6 md:p-8">
                    <div class="grid gap-6 md:grid-cols-[80px_1fr]">
                        <div class="install-step-number">05</div>

                        <div>
                            <p class="section-kicker">
                                Step 5
                            </p>

                            <h3 class="mt-2 text-3xl font-black leading-tight tracking-[-0.05em] text-mega-black">
                                Professional installation
                            </h3>

                            <p class="mt-4 text-base font-semibold leading-8 text-mega-muted">
                                Your flooring will be installed by experienced, professional installers who take pride in
                                quality workmanship and attention to detail.
                            </p>

                            <div class="mt-6 grid gap-3 md:grid-cols-2">
                                <div class="install-check"><span>✓</span>Uplifting existing floor coverings</div>
                                <div class="install-check"><span>✓</span>Subfloor preparation</div>
                                <div class="install-check"><span>✓</span>Installation of underlay where required</div>
                                <div class="install-check"><span>✓</span>Professional fitting and finishing</div>
                                <div class="install-check md:col-span-2"><span>✓</span>Final inspection and clean-up</div>
                            </div>
                        </div>
                    </div>
                </article>

                <article class="install-step-card p-6 md:p-8">
                    <div class="grid gap-6 md:grid-cols-[80px_1fr]">
                        <div class="install-step-number">06</div>

                        <div>
                            <p class="section-kicker">
                                Step 6
                            </p>

                            <h3 class="mt-2 text-3xl font-black leading-tight tracking-[-0.05em] text-mega-black">
                                Final inspection
                            </h3>

                            <p class="mt-4 text-base font-semibold leading-8 text-mega-muted">
                                Once installation is complete, we check the finished work, answer your questions and make
                                sure the result meets our quality standards.
                            </p>

                            <div class="mt-6 grid gap-3 md:grid-cols-2">
                                <div class="install-check"><span>✓</span>Ensure all work meets our quality standards</div>
                                <div class="install-check"><span>✓</span>Answer any questions you may have</div>
                            </div>

                            <p class="mt-6 rounded-[7px] bg-mega-cream px-5 py-4 text-base font-black text-mega-black">
                                Your satisfaction is our priority.
                            </p>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <section class="bg-white py-14 md:py-20">
        <div class="site-container">
            <div class="install-final-card p-8 md:p-12">
                <div class="max-w-3xl">
                    <p class="text-xs font-black uppercase tracking-[0.24em] text-white/75">
                        Ready to get started?
                    </p>

                    <h2 class="mt-4 text-4xl font-black leading-tight tracking-[-0.06em] text-white md:text-6xl">
                        Book your free measure and quote today.
                    </h2>

                    <p class="mt-5 text-lg font-semibold leading-8 text-white/82">
                        Our team can help you compare products, review colours, confirm measurements and plan your
                        installation with confidence.
                    </p>

                    <div class="mt-8 flex flex-wrap gap-3">
                        <a href="{{ route('frontend.quote') }}"
                            class="inline-flex items-center justify-center gap-2 rounded-[7px] bg-white px-6 py-4 text-sm font-black text-mega-orange transition hover:bg-mega-black hover:text-white">
                            Book free measure & quote
                            <span>→</span>
                        </a>

                        <a href="tel:1300131196"
                            class="inline-flex items-center justify-center gap-2 rounded-[7px] border border-white/30 px-6 py-4 text-sm font-black text-white transition hover:bg-white hover:text-mega-orange">
                            Call 1300 131 196
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection