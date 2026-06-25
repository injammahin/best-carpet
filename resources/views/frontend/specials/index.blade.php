@extends('layouts.frontend')

@section('title', 'Specials | Mega Carpets')
@section('meta_description', 'View current Mega Carpets flooring specials and promotional offers.')

@section('content')

    <section class="bg-mega-cream py-12 md:py-16">
        <div class="site-container">
            <div class="mx-auto max-w-4xl text-center">
                <p class="section-kicker">
                    Current promotions
                </p>

                <h1 class="section-title-premium">
                    Specials and flooring offers.
                </h1>

                <p class="mx-auto section-lead">
                    Browse current Mega Carpets promotions. Hover over any offer to see details, or click the card to continue.
                </p>
            </div>
        </div>
    </section>

    <section class="bg-white py-10 md:py-16">
        <div class="site-container">
            @if($promos->count())
                <div class="specials-card-grid">
                    @foreach($promos as $promo)
                        @php
                            $promoUrl = $promo->button_url ?: route('frontend.quote');
                            $buttonText = $promo->button_text ?: 'View offer';
                        @endphp

                        <a href="{{ $promoUrl }}" class="specials-promo-card">
                            <div class="specials-image-box">
                                <img
                                    src="{{ $promo->imageUrl() }}"
                                    alt="{{ $promo->title }}"
                                    class="specials-promo-image"
                                >
                            </div>

                            <div class="specials-promo-shade"></div>

                            <div class="specials-promo-content">
                                <p class="specials-promo-kicker">
                                    Mega Carpets Special
                                </p>

                                <h2>
                                    {{ $promo->title }}
                                </h2>

                                @if($promo->subtitle)
                                    <p class="specials-promo-subtitle">
                                        {{ $promo->subtitle }}
                                    </p>
                                @endif

                                <span class="specials-promo-button">
                                    {{ $buttonText }}
                                    <span>→</span>
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="rounded-[7px] border border-mega-line bg-mega-soft p-12 text-center">
                    <h2 class="text-3xl font-black text-mega-black">
                        No specials available right now.
                    </h2>

                    <p class="mx-auto mt-3 max-w-2xl text-mega-muted">
                        Please check back soon or contact Mega Carpets for current offers.
                    </p>

                    <a href="{{ route('frontend.quote') }}" class="btn-primary mt-6">
                        Book a free Measure & Quote
                    </a>
                </div>
            @endif
        </div>
    </section>

    <style>
        .specials-card-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 26px;
            align-items: stretch;
        }

        .specials-promo-card {
            position: relative;
            display: block;
            overflow: hidden;
            width: 100%;
            aspect-ratio: 16 / 9;
            border-radius: 7px;
            border: 1px solid #eadfd6;
            background: #f8f3ed;
            box-shadow: 0 20px 60px rgba(7, 7, 7, 0.10);
            isolation: isolate;
            transition: transform 240ms ease, box-shadow 240ms ease, border-color 240ms ease;
        }

        .specials-promo-card:hover {
            transform: translateY(-5px);
            border-color: rgba(255, 90, 0, 0.60);
            box-shadow: 0 30px 85px rgba(7, 7, 7, 0.18);
        }

        .specials-image-box {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f3ed;
        }

        .specials-promo-image {
            width: 100%;
            height: 100%;
            object-fit: contain;
            object-position: center;
            display: block;
            transition: transform 380ms ease;
        }

        .specials-promo-card:hover .specials-promo-image {
            transform: scale(1.025);
        }

        .specials-promo-shade {
            position: absolute;
            inset: 0;
            z-index: 2;
            background:
                linear-gradient(180deg, rgba(7, 7, 7, 0.02) 0%, rgba(7, 7, 7, 0.35) 46%, rgba(7, 7, 7, 0.90) 100%),
                linear-gradient(90deg, rgba(7, 7, 7, 0.42), rgba(7, 7, 7, 0.08));
            opacity: 0;
            transition: opacity 260ms ease;
        }

        .specials-promo-card:hover .specials-promo-shade {
            opacity: 1;
        }

        .specials-promo-content {
            position: absolute;
            left: 28px;
            right: 28px;
            bottom: 28px;
            z-index: 3;
            color: #ffffff;
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 260ms ease, transform 260ms ease;
        }

        .specials-promo-card:hover .specials-promo-content {
            opacity: 1;
            transform: translateY(0);
        }

        .specials-promo-kicker {
            margin-bottom: 12px;
            color: rgba(255, 255, 255, 0.78);
            font-size: 11px;
            font-weight: 950;
            letter-spacing: 0.24em;
            text-transform: uppercase;
        }

        .specials-promo-content h2 {
            color: #ffffff;
            font-size: clamp(26px, 2.5vw, 44px);
            font-weight: 950;
            line-height: 1;
            letter-spacing: -0.06em;
        }

        .specials-promo-subtitle {
            margin-top: 14px;
            max-width: 560px;
            color: rgba(255, 255, 255, 0.82);
            font-size: 15px;
            font-weight: 650;
            line-height: 1.65;
        }

        .specials-promo-button {
            margin-top: 20px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            border-radius: 7px;
            background: #ff5a00;
            color: #ffffff;
            padding: 13px 20px;
            font-size: 14px;
            font-weight: 950;
            box-shadow: 0 15px 36px rgba(255, 90, 0, 0.30);
            transition: background 200ms ease, color 200ms ease, transform 200ms ease;
        }

        .specials-promo-card:hover .specials-promo-button {
            transform: translateY(-1px);
        }

        .specials-promo-card:hover .specials-promo-button:hover {
            background: #ffffff;
            color: #ff5a00;
        }

        @media (max-width: 1024px) {
            .specials-card-grid {
                gap: 20px;
            }

            .specials-promo-card {
                aspect-ratio: 16 / 10;
            }

            .specials-promo-shade {
                opacity: 1;
            }

            .specials-promo-content {
                opacity: 1;
                transform: none;
            }
        }

        @media (max-width: 767px) {
            .specials-card-grid {
                grid-template-columns: 1fr;
                gap: 18px;
            }

            .specials-promo-card {
                aspect-ratio: 16 / 10;
            }

            .specials-promo-content {
                left: 20px;
                right: 20px;
                bottom: 20px;
            }

            .specials-promo-content h2 {
                font-size: 28px;
                line-height: 1.04;
            }

            .specials-promo-subtitle {
                font-size: 14px;
                line-height: 1.55;
            }

            .specials-promo-button {
                padding: 12px 17px;
                font-size: 13px;
            }
        }
    </style>

@endsection