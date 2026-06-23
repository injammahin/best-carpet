@extends('layouts.frontend')

@section('title', 'Warranty Information | Mega Carpets')
@section('meta_description', 'Learn about Mega Carpets installation warranties, product warranties, manufacturer coverage and our ongoing customer support.')

@section('content')

    <style>
        .warranty-hero {
            position: relative;
            overflow: hidden;
            background:
                linear-gradient(90deg, rgba(7, 7, 7, 0.88), rgba(7, 7, 7, 0.56), rgba(7, 7, 7, 0.18)),
                url('https://images.unsplash.com/photo-1618220179428-22790b461013?auto=format&fit=crop&w=1800&q=85');
            background-position: center;
            background-size: cover;
        }

        .warranty-hero-card {
            border: 1px solid rgba(255, 255, 255, 0.16);
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(18px);
            border-radius: 7px;
        }

        .warranty-card {
            position: relative;
            overflow: hidden;
            border: 1px solid #eadfd6;
            background: #ffffff;
            border-radius: 7px;
            box-shadow: 0 24px 70px rgba(7, 7, 7, 0.06);
        }

        .warranty-card::before {
            content: "";
            position: absolute;
            inset: 0 auto 0 0;
            width: 5px;
            background: #ff5a00;
        }

        .warranty-icon {
            display: grid;
            width: 58px;
            height: 58px;
            place-items: center;
            border-radius: 7px;
            background: #fff3ec;
            color: #ff5a00;
        }

        .warranty-icon svg {
            width: 28px;
            height: 28px;
            stroke-width: 1.9;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .warranty-check {
            display: flex;
            gap: 12px;
            color: #5f5964;
            font-size: 15px;
            font-weight: 700;
            line-height: 1.7;
        }

        .warranty-check span {
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

        .warranty-mini-card {
            border: 1px solid #eadfd6;
            background: #faf7f3;
            border-radius: 7px;
            padding: 22px;
        }

        .warranty-mini-card h3 {
            color: #070707;
            font-size: 18px;
            font-weight: 950;
            letter-spacing: -0.03em;
        }

        .warranty-mini-card p {
            margin-top: 8px;
            color: #6f6873;
            font-size: 14px;
            font-weight: 650;
            line-height: 1.7;
        }

        .warranty-commitment-card {
            border-radius: 7px;
            background:
                linear-gradient(135deg, rgba(7, 7, 7, 0.9), rgba(7, 7, 7, 0.72)),
                url('https://images.unsplash.com/photo-1600566752355-35792bedcfea?auto=format&fit=crop&w=1600&q=85');
            background-position: center;
            background-size: cover;
            color: #ffffff;
            overflow: hidden;
        }

        .warranty-support-card {
            border-radius: 7px;
            background:
                linear-gradient(135deg, rgba(255, 90, 0, 0.96), rgba(232, 79, 0, 0.96)),
                url('https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?auto=format&fit=crop&w=1400&q=85');
            background-position: center;
            background-size: cover;
            color: #ffffff;
        }

        @media (max-width: 640px) {
            .warranty-card::before {
                width: 4px;
            }
        }
    </style>

    <section class="warranty-hero py-20 md:py-28">
        <div class="site-container">
            <div class="max-w-4xl">
                <p class="section-kicker text-white/80">
                    Warranty information
                </p>

                <h1 class="mt-5 max-w-3xl text-3xl font-black leading-[1]  text-white md:text-5xl">
                    Quality flooring solutions and workmanship you can trust.
                </h1>

                <p class="mt-6 max-w-2xl text-lg font-semibold leading-8 text-white">
                    At Mega Carpets, we take pride in delivering reliable flooring products, professional installation and
                    ongoing support long after your new floor has been installed.
                </p>

                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="{{ route('frontend.quote') }}" class="btn-primary">
                        Book a free measure & quote
                        <span>→</span>
                    </a>

                    <a href="{{ route('frontend.contact') }}" class="btn-light bg-white">
                        Contact our team
                    </a>
                </div>
            </div>

            <div class="mt-12 grid gap-4 md:grid-cols-3">
                <div class="warranty-hero-card p-5">
                    <p class="text-3xl font-black text-white">Install</p>
                    <p class="mt-2 text-xs font-black uppercase tracking-[0.18em] text-white/65">
                        Workmanship support
                    </p>
                </div>

                <div class="warranty-hero-card p-5">
                    <p class="text-3xl font-black text-white">Product</p>
                    <p class="mt-2 text-xs font-black uppercase tracking-[0.18em] text-white/65">
                        Manufacturer warranties
                    </p>
                </div>

                <div class="warranty-hero-card p-5">
                    <p class="text-3xl font-black text-white">Care</p>
                    <p class="mt-2 text-xs font-black uppercase tracking-[0.18em] text-white/65">
                        Ongoing customer support
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-mega-cream py-14 md:py-20">
        <div class="site-container">
            <div class="mx-auto mb-12 max-w-4xl text-center">
                <p class="section-kicker">
                    Warranty support
                </p>

                <h2 class="section-title-premium">
                    Clear warranty information for your flooring.
                </h2>

                <p class="mx-auto section-lead">
                    Warranty coverage can vary depending on the product, brand, range and installation requirements. Our
                    team will help you understand what applies to your selected flooring.
                </p>
            </div>

            <div class="grid gap-6">
                <article class="warranty-card p-6 md:p-8">
                    <div class="grid gap-6 md:grid-cols-[80px_1fr]">
                        <div class="warranty-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path d="M12 3l7 3v5c0 5-3 8-7 10-4-2-7-5-7-10V6l7-3z" />
                                <path d="M9 12l2 2 4-5" />
                            </svg>
                        </div>

                        <div>
                            <p class="section-kicker">
                                Installation warranty
                            </p>

                            <h3 class="mt-2 text-3xl font-black leading-tight tracking-[-0.05em] text-mega-black">
                                Professional installation backed by workmanship support.
                            </h3>

                            <p class="mt-4 text-base font-semibold leading-8 text-mega-muted">
                                All installations completed through Mega Carpets are carried out by experienced,
                                professional installers. Our installation partners stand behind their workmanship and
                                provide installation warranties in accordance with Australian Consumer Law and industry
                                standards.
                            </p>

                            <p class="mt-4 text-base font-semibold leading-8 text-mega-muted">
                                Should an installation-related issue arise, our team will work with you and the installer to
                                assess the matter and ensure it is resolved promptly and professionally.
                            </p>

                            <div class="mt-6 grid gap-3 md:grid-cols-2">
                                <div class="warranty-check">
                                    <span>✓</span>
                                    Professional installation support
                                </div>

                                <div class="warranty-check">
                                    <span>✓</span>
                                    Workmanship assessment if required
                                </div>

                                <div class="warranty-check">
                                    <span>✓</span>
                                    Support in line with Australian Consumer Law
                                </div>

                                <div class="warranty-check">
                                    <span>✓</span>
                                    Prompt and professional issue handling
                                </div>
                            </div>
                        </div>
                    </div>
                </article>

                <article class="warranty-card p-6 md:p-8">
                    <div class="grid gap-6 md:grid-cols-[80px_1fr]">
                        <div class="warranty-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path d="M4 7l8-4 8 4-8 4-8-4z" />
                                <path d="M4 7v10l8 4 8-4V7" />
                                <path d="M12 11v10" />
                            </svg>
                        </div>

                        <div>
                            <p class="section-kicker">
                                Product warranties
                            </p>

                            <h3 class="mt-2 text-3xl font-black leading-tight tracking-[-0.05em] text-mega-black">
                                Manufacturer warranties vary by product, brand and range.
                            </h3>

                            <p class="mt-4 text-base font-semibold leading-8 text-mega-muted">
                                Each flooring manufacturer provides its own product-specific warranty. Coverage varies
                                depending on the product type, brand and range selected.
                            </p>

                            <p class="mt-4 text-base font-semibold leading-8 text-mega-muted">
                                Warranty periods and coverage conditions differ between products and manufacturers. Full
                                warranty details for your selected flooring are available upon request and will be provided
                                at the time of purchase.
                            </p>

                            <div class="mt-6 grid gap-4 md:grid-cols-3">
                                <div class="warranty-mini-card">
                                    <h3>Wear resistance</h3>
                                    <p>Coverage may apply to product wear under the manufacturer conditions.</p>
                                </div>

                                <div class="warranty-mini-card">
                                    <h3>Structural integrity</h3>
                                    <p>Some products include support for structural performance.</p>
                                </div>

                                <div class="warranty-mini-card">
                                    <h3>Stain resistance</h3>
                                    <p>Certain carpet and flooring ranges may include stain-related coverage.</p>
                                </div>

                                <div class="warranty-mini-card">
                                    <h3>Fade resistance</h3>
                                    <p>Selected ranges may include fade resistance warranty conditions.</p>
                                </div>

                                <div class="warranty-mini-card">
                                    <h3>Water resistance</h3>
                                    <p>Hybrid, vinyl or selected products may include water resistance coverage.</p>
                                </div>

                                <div class="warranty-mini-card">
                                    <h3>Manufacturing defects</h3>
                                    <p>Manufacturer warranties may cover eligible defects in the product.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>

                <article class="warranty-commitment-card p-8 md:p-12">
                    <div class="max-w-3xl">
                        <p class="text-xs font-black uppercase tracking-[0.24em] text-white/75">
                            Our commitment
                        </p>

                        <h3 class="mt-4 text-4xl font-black leading-tight tracking-[-0.06em] text-white md:text-5xl">
                            Trusted products, trusted installers and ongoing support.
                        </h3>

                        <p class="mt-5 text-lg font-semibold leading-8 text-white/82">
                            At Mega Carpets, we only partner with reputable manufacturers and trusted installers to ensure
                            our customers receive quality products, expert installation and ongoing support long after their
                            new flooring has been installed.
                        </p>

                        <div class="mt-8 grid gap-4 md:grid-cols-3">
                            <div class="rounded-[7px] border border-white/15 bg-white/10 p-5 backdrop-blur">
                                <p class="text-2xl font-black text-white">Quality</p>
                                <p class="mt-2 text-sm font-bold leading-6 text-white/70">
                                    Carefully selected flooring products.
                                </p>
                            </div>

                            <div class="rounded-[7px] border border-white/15 bg-white/10 p-5 backdrop-blur">
                                <p class="text-2xl font-black text-white">Installers</p>
                                <p class="mt-2 text-sm font-bold leading-6 text-white/70">
                                    Professional installation partners.
                                </p>
                            </div>

                            <div class="rounded-[7px] border border-white/15 bg-white/10 p-5 backdrop-blur">
                                <p class="text-2xl font-black text-white">Support</p>
                                <p class="mt-2 text-sm font-bold leading-6 text-white/70">
                                    Helpful guidance after installation.
                                </p>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <section class="bg-white py-14 md:py-20">
        <div class="site-container">
            <div class="warranty-support-card p-8 md:p-12">
                <div class="max-w-3xl">
                    <p class="text-xs font-black uppercase tracking-[0.24em] text-white/75">
                        Have a warranty question?
                    </p>

                    <h2 class="mt-4 text-4xl font-black leading-tight tracking-[-0.06em] text-white md:text-6xl">
                        Our team is always here to help.
                    </h2>

                    <p class="mt-5 text-lg font-semibold leading-8 text-white/82">
                        If you have any questions regarding your installation warranty or product warranty, contact Mega
                        Carpets and we will help you understand the next step.
                    </p>

                    <div class="mt-8 flex flex-wrap gap-3">
                        <a href="{{ route('frontend.contact') }}"
                            class="inline-flex items-center justify-center gap-2 rounded-[7px] bg-white px-6 py-4 text-sm font-black text-mega-orange transition hover:bg-mega-black hover:text-white">
                            Contact Mega Carpets
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