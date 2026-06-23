@extends('layouts.frontend')

@section('title', 'Care & Maintenance | Mega Carpets')
@section('meta_description', 'Simple floor care and maintenance tips for carpet, hybrid, laminate, timber and vinyl flooring from Mega Carpets.')

@section('content')

    <style>
        .care-hero {
            position: relative;
            overflow: hidden;
            background:
                linear-gradient(90deg, rgba(7, 7, 7, 0.86), rgba(7, 7, 7, 0.58), rgba(7, 7, 7, 0.16)),
                url('https://images.unsplash.com/photo-1618220179428-22790b461013?auto=format&fit=crop&w=1800&q=85');
            background-size: cover;
            background-position: center;
        }

        .care-hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            border: 1px solid rgba(255, 255, 255, 0.18);
            background: rgba(255, 255, 255, 0.10);
            color: #ffffff;
            border-radius: 999px;
            padding: 10px 16px;
            font-size: 12px;
            font-weight: 900;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            backdrop-filter: blur(14px);
        }

        .care-card {
            height: 100%;
            border: 1px solid #eadfd6;
            background: #ffffff;
            border-radius: 7px;
            padding: 28px;
            box-shadow: 0 20px 60px rgba(7, 7, 7, 0.05);
            transition: 220ms ease;
        }

        .care-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 26px 70px rgba(7, 7, 7, 0.08);
        }

        .care-icon {
            display: grid;
            width: 58px;
            height: 58px;
            place-items: center;
            border-radius: 7px;
            background: #fff3ec;
            color: #ff5a00;
        }

        .care-icon svg {
            width: 28px;
            height: 28px;
            stroke-width: 1.9;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .care-list {
            margin-top: 22px;
            display: grid;
            gap: 12px;
        }

        .care-list li {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            color: #625c67;
            font-size: 15px;
            font-weight: 700;
            line-height: 1.7;
        }

        .care-list li span {
            display: grid;
            width: 24px;
            height: 24px;
            flex: 0 0 auto;
            place-items: center;
            border-radius: 999px;
            background: #fff3ec;
            color: #ff5a00;
            font-size: 12px;
            font-weight: 950;
        }

        .why-simple-card {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            border: 1px solid #eadfd6;
            background: #ffffff;
            border-radius: 7px;
            padding: 20px;
            box-shadow: 0 18px 44px rgba(7, 7, 7, 0.04);
        }

        .why-simple-card span {
            display: grid;
            width: 28px;
            height: 28px;
            flex: 0 0 auto;
            place-items: center;
            border-radius: 999px;
            background: #ff5a00;
            color: #ffffff;
            font-size: 13px;
            font-weight: 950;
        }

        .why-simple-card p {
            color: #070707;
            font-size: 16px;
            font-weight: 850;
            line-height: 1.55;
        }

        .care-note {
            border: 1px solid rgba(255, 90, 0, 0.24);
            background: #fff7f1;
            border-radius: 7px;
            padding: 24px;
        }
    </style>

    <section class="care-hero py-20 md:py-28">
        <div class="site-container">
            <div class="max-w-4xl">
                <div class="care-hero-badge">
                    <span>✦</span>
                    Care & Maintenance
                </div>

                <h1 class="mt-6 max-w-3xl text-3xl font-black leading-[1]  text-white md:text-5xl">
                    Caring for your new floors.
                </h1>

                <p class="mt-6 max-w-2xl text-lg font-semibold leading-8 text-white">
                    Proper maintenance helps keep your flooring looking its best. Follow these simple care tips to protect
                    your floors and enjoy them for years to come.
                </p>

                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="{{ route('frontend.quote') }}" class="btn-primary">
                        Book a free measure & quote
                        <span>→</span>
                    </a>

                    <a href="{{ route('frontend.products') }}" class="btn-light bg-white">
                        Browse products
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-mega-cream py-14 md:py-20">
        <div class="site-container">
            <div class="mx-auto mb-12 max-w-4xl text-center">
                <p class="section-kicker">
                    Floor care guide
                </p>

                <h2 class="section-title-premium">
                    Simple care tips by flooring type.
                </h2>

                <p class="mx-auto section-lead">
                    Every floor needs the right care. These general recommendations help protect your carpet, hybrid,
                    laminate, timber and vinyl flooring.
                </p>
            </div>

            <div class="grid gap-6 lg:grid-cols-3">
                <article class="care-card">
                    <div class="care-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M4 18c4-4 12-4 16 0" />
                            <path d="M6 14c3-3 9-3 12 0" />
                            <path d="M8 10c2-2 6-2 8 0" />
                            <path d="M12 6v12" />
                        </svg>
                    </div>

                    <h3 class="mt-6 text-3xl font-black leading-tight tracking-[-0.05em] text-mega-black">
                        Carpet
                    </h3>

                    <p class="mt-3 text-sm font-semibold leading-7 text-mega-muted">
                        Keep your carpet fresh, clean and comfortable with regular maintenance.
                    </p>

                    <ul class="care-list">
                        <li>
                            <span>✓</span>
                            Vacuum regularly
                        </li>

                        <li>
                            <span>✓</span>
                            Attend to spills immediately
                        </li>

                        <li>
                            <span>✓</span>
                            Professionally clean periodically
                        </li>
                    </ul>
                </article>

                <article class="care-card">
                    <div class="care-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M4 6h16" />
                            <path d="M4 12h16" />
                            <path d="M4 18h16" />
                            <path d="M8 6v12" />
                            <path d="M16 6v12" />
                        </svg>
                    </div>

                    <h3 class="mt-6 text-3xl font-black leading-tight tracking-[-0.05em] text-mega-black">
                        Hybrid, Laminate & Timber
                    </h3>

                    <p class="mt-3 text-sm font-semibold leading-7 text-mega-muted">
                        Protect hard flooring from scratches, moisture and daily wear.
                    </p>

                    <ul class="care-list">
                        <li>
                            <span>✓</span>
                            Use felt furniture protectors
                        </li>

                        <li>
                            <span>✓</span>
                            Sweep and vacuum regularly
                        </li>

                        <li>
                            <span>✓</span>
                            Avoid excessive moisture
                        </li>

                        <li>
                            <span>✓</span>
                            Use manufacturer-approved cleaning products
                        </li>
                    </ul>
                </article>

                <article class="care-card">
                    <div class="care-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M5 5h14v14H5z" />
                            <path d="M9 5v14" />
                            <path d="M15 5v14" />
                            <path d="M5 11h14" />
                        </svg>
                    </div>

                    <h3 class="mt-6 text-3xl font-black leading-tight tracking-[-0.05em] text-mega-black">
                        Vinyl
                    </h3>

                    <p class="mt-3 text-sm font-semibold leading-7 text-mega-muted">
                        Vinyl is practical and easy to maintain when cleaned correctly.
                    </p>

                    <ul class="care-list">
                        <li>
                            <span>✓</span>
                            Sweep regularly
                        </li>

                        <li>
                            <span>✓</span>
                            Wipe spills promptly
                        </li>

                        <li>
                            <span>✓</span>
                            Avoid harsh chemicals
                        </li>
                    </ul>
                </article>
            </div>

            <div class="care-note mt-8">
                <div class="grid gap-5 md:grid-cols-[auto_1fr_auto] md:items-center">
                    <div class="care-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M12 3l8 4v6c0 4.5-3.2 7.2-8 8-4.8-.8-8-3.5-8-8V7l8-4z" />
                            <path d="M9 12l2 2 4-5" />
                        </svg>
                    </div>

                    <div>
                        <h3 class="text-2xl font-black tracking-[-0.04em] text-mega-black">
                            Product-specific care recommendations
                        </h3>

                        <p class="mt-2 text-sm font-semibold leading-7 text-mega-muted">
                            Our team will provide product-specific care recommendations upon installation, based on the
                            flooring product you choose.
                        </p>
                    </div>

                    <a href="{{ route('frontend.quote') }}" class="btn-primary w-fit">
                        Ask our team
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white py-14 md:py-20">
        <div class="site-container">
            <div class="grid gap-10 lg:grid-cols-[0.85fr_1.15fr] lg:items-start">
                <div>
                    <p class="section-kicker">
                        Why choose Mega Carpets?
                    </p>

                    <h2 class="section-title-premium">
                        Flooring support from selection to aftercare.
                    </h2>

                    <p class="section-lead">
                        Mega Carpets makes the flooring process simple with helpful advice, professional installation and
                        ongoing support.
                    </p>

                    <div class="mt-8 flex flex-wrap gap-3">
                        <a href="{{ route('frontend.quote') }}" class="btn-primary">
                            Book free measure & quote
                            <span>→</span>
                        </a>

                        <a href="tel:1300131196" class="btn-light">
                            Call 1300 131 196
                        </a>
                    </div>
                </div>

                <div class="grid gap-4 md:grid-cols-2">
                    <div class="why-simple-card">
                        <span>✓</span>
                        <p>FREE Measure & Quote</p>
                    </div>

                    <div class="why-simple-card">
                        <span>✓</span>
                        <p>Mobile Showroom Available</p>
                    </div>

                    <div class="why-simple-card">
                        <span>✓</span>
                        <p>Experienced Flooring Consultants</p>
                    </div>

                    <div class="why-simple-card">
                        <span>✓</span>
                        <p>Professional Installers</p>
                    </div>

                    <div class="why-simple-card">
                        <span>✓</span>
                        <p>Quality Products from Leading Manufacturers</p>
                    </div>

                    <div class="why-simple-card">
                        <span>✓</span>
                        <p>Competitive Pricing</p>
                    </div>

                    <div class="why-simple-card md:col-span-2">
                        <span>✓</span>
                        <p>Ongoing Customer Support</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection