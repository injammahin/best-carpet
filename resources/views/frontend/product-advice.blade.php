@extends('layouts.frontend')

@section('title', 'Product Advice | Mega Carpets')
@section('meta_description', 'Get expert product advice from Mega Carpets and learn how to choose the right carpet, hybrid, timber, laminate or vinyl flooring for your home.')

@section('content')

    <style>
        .advice-hero {
            position: relative;
            overflow: hidden;
            background:
                linear-gradient(90deg, rgba(7, 7, 7, 0.88), rgba(7, 7, 7, 0.56), rgba(7, 7, 7, 0.14)),
                url('https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?auto=format&fit=crop&w=1800&q=85');
            background-size: cover;
            background-position: center;
        }

        .advice-hero-badge {
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

        .advice-intro-card {
            border: 1px solid #eadfd6;
            background: #ffffff;
            border-radius: 7px;
            box-shadow: 0 24px 70px rgba(7, 7, 7, 0.06);
            overflow: hidden;
        }

        .advice-product-card {
            height: 100%;
            border: 1px solid #eadfd6;
            background: #ffffff;
            border-radius: 7px;
            padding: 26px;
            box-shadow: 0 20px 60px rgba(7, 7, 7, 0.05);
            transition: 220ms ease;
        }

        .advice-product-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 26px 70px rgba(7, 7, 7, 0.08);
        }

        .advice-icon {
            display: grid;
            width: 58px;
            height: 58px;
            place-items: center;
            border-radius: 7px;
            background: #fff3ec;
            color: #ff5a00;
        }

        .advice-icon svg {
            width: 28px;
            height: 28px;
            stroke-width: 1.9;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .advice-benefits {
            margin-top: 20px;
            display: grid;
            gap: 10px;
        }

        .advice-benefits li {
            display: flex;
            gap: 10px;
            color: #625c67;
            font-size: 14px;
            font-weight: 700;
            line-height: 1.7;
        }

        .advice-benefits li span {
            display: grid;
            width: 22px;
            height: 22px;
            flex: 0 0 auto;
            place-items: center;
            border-radius: 999px;
            background: #fff3ec;
            color: #ff5a00;
            font-size: 12px;
            font-weight: 950;
        }

        .recommended-box {
            margin-top: 22px;
            border: 1px solid rgba(255, 90, 0, 0.22);
            background: #fff7f1;
            border-radius: 7px;
            padding: 16px;
        }

        .recommended-box small {
            display: block;
            color: #ff5a00;
            font-size: 11px;
            font-weight: 950;
            letter-spacing: 0.18em;
            text-transform: uppercase;
        }

        .recommended-box p {
            margin-top: 6px;
            color: #070707;
            font-size: 14px;
            font-weight: 800;
            line-height: 1.7;
        }

        .lifestyle-card {
            display: flex;
            gap: 16px;
            border: 1px solid #eadfd6;
            background: #ffffff;
            border-radius: 7px;
            padding: 22px;
            box-shadow: 0 18px 44px rgba(7, 7, 7, 0.04);
        }

        .lifestyle-card span {
            display: grid;
            width: 42px;
            height: 42px;
            flex: 0 0 auto;
            place-items: center;
            border-radius: 7px;
            background: #ff5a00;
            color: #ffffff;
            font-size: 16px;
            font-weight: 950;
        }

        .lifestyle-card h3 {
            color: #070707;
            font-size: 19px;
            font-weight: 950;
            letter-spacing: -0.03em;
        }

        .lifestyle-card p {
            margin-top: 6px;
            color: #6f6873;
            font-size: 14px;
            font-weight: 700;
            line-height: 1.7;
        }

        .advice-cta {
            border-radius: 7px;
            background:
                linear-gradient(135deg, rgba(255, 90, 0, 0.96), rgba(232, 79, 0, 0.96)),
                url('https://images.unsplash.com/photo-1600566752355-35792bedcfea?auto=format&fit=crop&w=1600&q=85');
            background-size: cover;
            background-position: center;
            color: #ffffff;
            overflow: hidden;
        }
    </style>

    <section class="advice-hero py-20 md:py-28">
        <div class="site-container">
            <div class="max-w-4xl">
                <div class="advice-hero-badge">
                    <span>✦</span>
                    Product Advice
                </div>

                <h1 class="mt-6 max-w-3xl text-3xl font-black leading-[1.2]  text-white md:text-5xl">
                    Choosing the right flooring for your home.
                </h1>

                <p class="mt-6 max-w-2xl text-lg font-semibold leading-8 text-white">
                    Selecting the right flooring is about more than colour and style. Your lifestyle, budget, household
                    needs and the purpose of each room all play an important role.
                </p>

                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="{{ route('frontend.quote') }}" class="btn-primary">
                        Get expert advice
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
            <div class="advice-intro-card grid gap-0 lg:grid-cols-[0.9fr_1.1fr]">
                <div class="p-8 md:p-10">
                    <p class="section-kicker">
                        Expert flooring guidance
                    </p>

                    <h2 class="mt-4 text-4xl font-black leading-tight tracking-[-0.06em] text-mega-black md:text-5xl">
                        Flooring advice that matches your lifestyle.
                    </h2>

                    <p class="mt-5 text-base font-semibold leading-8 text-mega-muted">
                        At Mega Carpets, our experienced team helps you compare every option and choose flooring that looks
                        great, fits your budget and performs beautifully for years to come.
                    </p>
                </div>

                <div class="min-h-[340px]">
                    <img src="https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?auto=format&fit=crop&w=1400&q=85"
                        alt="Modern home flooring advice" class="h-full w-full object-cover">
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white py-14 md:py-20">
        <div class="site-container">
            <div class="mx-auto mb-12 max-w-4xl text-center">
                <p class="section-kicker">
                    Flooring options
                </p>

                <h2 class="section-title-premium">
                    Find the right product for every room.
                </h2>

                <p class="mx-auto section-lead">
                    Compare carpet, hybrid flooring, timber, laminate and vinyl to understand which option suits your home
                    best.
                </p>
            </div>

            <div class="grid gap-6 lg:grid-cols-2">
                <article class="advice-product-card">
                    <div class="advice-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M4 18c4-4 12-4 16 0" />
                            <path d="M6 14c3-3 9-3 12 0" />
                            <path d="M8 10c2-2 6-2 8 0" />
                            <path d="M12 6v12" />
                        </svg>
                    </div>

                    <h3 class="mt-6 text-3xl font-black tracking-[-0.05em] text-mega-black">
                        Carpet
                    </h3>

                    <p class="mt-2 text-sm font-black uppercase tracking-[0.16em] text-mega-orange">
                        Best for bedrooms, living areas, family rooms and home theatres.
                    </p>

                    <p class="mt-4 text-base font-semibold leading-8 text-mega-muted">
                        Carpet offers warmth, comfort and excellent sound absorption, making it one of the most popular
                        choices for family homes.
                    </p>

                    <ul class="advice-benefits">
                        <li><span>✓</span> Soft and comfortable underfoot</li>
                        <li><span>✓</span> Excellent insulation and noise reduction</li>
                        <li><span>✓</span> Wide range of colours and textures</li>
                        <li><span>✓</span> Ideal for bedrooms and living areas</li>
                        <li><span>✓</span> Great value for money</li>
                    </ul>

                    <div class="recommended-box">
                        <small>Recommended if</small>
                        <p>You want comfort, warmth and a cosy feel throughout your home.</p>
                    </div>
                </article>

                <article class="advice-product-card">
                    <div class="advice-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M4 6h16" />
                            <path d="M4 12h16" />
                            <path d="M4 18h16" />
                            <path d="M8 6v12" />
                            <path d="M16 6v12" />
                        </svg>
                    </div>

                    <h3 class="mt-6 text-3xl font-black tracking-[-0.05em] text-mega-black">
                        Hybrid Flooring
                    </h3>

                    <p class="mt-2 text-sm font-black uppercase tracking-[0.16em] text-mega-orange">
                        Best for kitchens, living areas, hallways and busy family homes.
                    </p>

                    <p class="mt-4 text-base font-semibold leading-8 text-mega-muted">
                        Hybrid flooring combines the natural look of timber with outstanding durability and water
                        resistance.
                    </p>

                    <ul class="advice-benefits">
                        <li><span>✓</span> 100% waterproof options available</li>
                        <li><span>✓</span> Highly durable and scratch resistant</li>
                        <li><span>✓</span> Suitable for high-traffic areas</li>
                        <li><span>✓</span> Easy to clean and maintain</li>
                        <li><span>✓</span> Realistic timber appearance</li>
                    </ul>

                    <div class="recommended-box">
                        <small>Recommended if</small>
                        <p>You have children, pets or want a stylish timber look with minimal maintenance.</p>
                    </div>
                </article>

                <article class="advice-product-card">
                    <div class="advice-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M3 18l9-12 9 12" />
                            <path d="M7 18l5-7 5 7" />
                        </svg>
                    </div>

                    <h3 class="mt-6 text-3xl font-black tracking-[-0.05em] text-mega-black">
                        Timber Flooring
                    </h3>

                    <p class="mt-2 text-sm font-black uppercase tracking-[0.16em] text-mega-orange">
                        Best for living areas, dining rooms and premium homes.
                    </p>

                    <p class="mt-4 text-base font-semibold leading-8 text-mega-muted">
                        Timber flooring offers timeless beauty and adds warmth, character and value to any home.
                    </p>

                    <ul class="advice-benefits">
                        <li><span>✓</span> Premium natural appearance</li>
                        <li><span>✓</span> Long-lasting and durable</li>
                        <li><span>✓</span> Adds value to your property</li>
                        <li><span>✓</span> Can be refinished over time</li>
                        <li><span>✓</span> Unique grain patterns</li>
                    </ul>

                    <div class="recommended-box">
                        <small>Recommended if</small>
                        <p>You want a luxurious, high-end finish that will never go out of style.</p>
                    </div>
                </article>

                <article class="advice-product-card">
                    <div class="advice-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M5 5h14v14H5z" />
                            <path d="M9 5v14" />
                            <path d="M15 5v14" />
                            <path d="M5 11h14" />
                        </svg>
                    </div>

                    <h3 class="mt-6 text-3xl font-black tracking-[-0.05em] text-mega-black">
                        Laminate Flooring
                    </h3>

                    <p class="mt-2 text-sm font-black uppercase tracking-[0.16em] text-mega-orange">
                        Best for living areas, bedrooms and investment properties.
                    </p>

                    <p class="mt-4 text-base font-semibold leading-8 text-mega-muted">
                        Laminate flooring delivers a realistic timber appearance at an affordable price.
                    </p>

                    <ul class="advice-benefits">
                        <li><span>✓</span> Budget-friendly option</li>
                        <li><span>✓</span> Scratch resistant</li>
                        <li><span>✓</span> Easy to maintain</li>
                        <li><span>✓</span> Modern timber designs</li>
                        <li><span>✓</span> Suitable for busy households</li>
                    </ul>

                    <div class="recommended-box">
                        <small>Recommended if</small>
                        <p>You want the look of timber while keeping within budget.</p>
                    </div>
                </article>

                <article class="advice-product-card lg:col-span-2">
                    <div class="grid gap-8 lg:grid-cols-[0.42fr_0.58fr] lg:items-center">
                        <div>
                            <div class="advice-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path d="M4 5h16v14H4z" />
                                    <path d="M4 9h16" />
                                    <path d="M8 9v10" />
                                    <path d="M16 9v10" />
                                </svg>
                            </div>

                            <h3 class="mt-6 text-3xl font-black tracking-[-0.05em] text-mega-black">
                                Vinyl Flooring
                            </h3>

                            <p class="mt-2 text-sm font-black uppercase tracking-[0.16em] text-mega-orange">
                                Best for kitchens, laundries, apartments and commercial areas.
                            </p>

                            <p class="mt-4 text-base font-semibold leading-8 text-mega-muted">
                                Vinyl flooring is practical, durable and highly versatile.
                            </p>
                        </div>

                        <div>
                            <ul class="advice-benefits">
                                <li><span>✓</span> Water resistant</li>
                                <li><span>✓</span> Comfortable underfoot</li>
                                <li><span>✓</span> Low maintenance</li>
                                <li><span>✓</span> Durable and practical</li>
                                <li><span>✓</span> Available in timber and stone looks</li>
                            </ul>

                            <div class="recommended-box">
                                <small>Recommended if</small>
                                <p>You need an affordable and hard-wearing flooring solution.</p>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <section class="bg-mega-cream py-14 md:py-20">
        <div class="site-container">
            <div class="grid gap-10 lg:grid-cols-[0.85fr_1.15fr] lg:items-start">
                <div>
                    <p class="section-kicker">
                        Flooring for every lifestyle
                    </p>

                    <h2 class="section-title-premium">
                        Match your flooring to how you live.
                    </h2>

                    <p class="section-lead">
                        Different homes need different flooring. Use these quick recommendations as a starting point before
                        speaking with our team.
                    </p>
                </div>

                <div class="grid gap-4">
                    <div class="lifestyle-card">
                        <span>01</span>
                        <div>
                            <h3>Families with Children</h3>
                            <p>Recommended: Hybrid Flooring or Solution Dyed Nylon Carpet</p>
                        </div>
                    </div>

                    <div class="lifestyle-card">
                        <span>02</span>
                        <div>
                            <h3>Pet Owners</h3>
                            <p>Recommended: Hybrid Flooring or Pet-Friendly Carpet Ranges</p>
                        </div>
                    </div>

                    <div class="lifestyle-card">
                        <span>03</span>
                        <div>
                            <h3>Investment Properties</h3>
                            <p>Recommended: Laminate Flooring or Vinyl Flooring</p>
                        </div>
                    </div>

                    <div class="lifestyle-card">
                        <span>04</span>
                        <div>
                            <h3>Luxury Homes</h3>
                            <p>Recommended: Premium Carpet or Timber Flooring</p>
                        </div>
                    </div>

                    <div class="lifestyle-card">
                        <span>05</span>
                        <div>
                            <h3>High-Traffic Areas</h3>
                            <p>Recommended: Hybrid Flooring or Commercial Grade Carpet</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white py-14 md:py-20">
        <div class="site-container">
            <div class="advice-cta p-8 md:p-12">
                <div class="max-w-3xl">
                    <p class="text-xs font-black uppercase tracking-[0.24em] text-white/75">
                        Need advice?
                    </p>

                    <h2 class="mt-4 text-4xl font-black leading-tight tracking-[-0.06em] text-white md:text-6xl">
                        Choosing flooring can feel overwhelming, but it does not have to be.
                    </h2>

                    <p class="mt-5 text-lg font-semibold leading-8 text-white/82">
                        Our experienced team can help you compare products, colours, textures and performance options to
                        find the perfect flooring solution for your home and budget.
                    </p>

                    <div class="mt-8 grid gap-4 md:grid-cols-3">
                        <div class="rounded-[7px] border border-white/20 bg-white/10 p-5 backdrop-blur">
                            <p class="text-2xl font-black text-white">Free</p>
                            <p class="mt-2 text-sm font-bold leading-6 text-white/72">
                                Measure & Quote
                            </p>
                        </div>

                        <div class="rounded-[7px] border border-white/20 bg-white/10 p-5 backdrop-blur">
                            <p class="text-2xl font-black text-white">Mobile</p>
                            <p class="mt-2 text-sm font-bold leading-6 text-white/72">
                                Showroom Available
                            </p>
                        </div>

                        <div class="rounded-[7px] border border-white/20 bg-white/10 p-5 backdrop-blur">
                            <p class="text-2xl font-black text-white">Expert</p>
                            <p class="mt-2 text-sm font-bold leading-6 text-white/72">
                                Advice You Can Trust
                            </p>
                        </div>
                    </div>

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