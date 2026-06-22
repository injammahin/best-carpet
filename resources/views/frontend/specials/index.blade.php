@extends('layouts.frontend')

@section('title', 'Specials | Mega Carpets')
@section('meta_description', 'View current Mega Carpets flooring specials and promotional offers.')

@section('content')

    <section class="bg-mega-cream py-12 md:py-16">
        <div class="site-container">
            <div class="mx-auto max-w-4xl text-center">
                <p class="section-kicker">Current promotions</p>

                <h1 class="section-title-premium">
                    Specials and flooring offers.
                </h1>

                <p class="mx-auto section-lead">
                    Browse current Mega Carpets specials. Promotions may change, so request a free quote to confirm
                    availability.
                </p>
            </div>
        </div>
    </section>

    <section class="bg-white py-12 md:py-16">
        <div class="site-container">
            @if($promos->count())
                <div class="specials-slider" data-specials-slider>
                    <div class="specials-track">
                        @foreach($promos as $index => $promo)
                            <article class="specials-slide {{ $index === 0 ? 'is-active' : '' }}" data-special-slide="{{ $index }}">
                                <img src="{{ $promo->imageUrl() }}" alt="{{ $promo->title }}">

                                <div class="specials-overlay"></div>

                                <div class="specials-content">
                                    <p class="section-kicker text-white/80">Mega Carpets special</p>

                                    <h2>
                                        {{ $promo->title }}
                                    </h2>

                                    @if($promo->subtitle)
                                        <p>
                                            {{ $promo->subtitle }}
                                        </p>
                                    @endif

                                    @if($promo->button_text && $promo->button_url)
                                        <a href="{{ $promo->button_url }}" class="btn-primary mt-6">
                                            {{ $promo->button_text }}
                                            <span>→</span>
                                        </a>
                                    @endif
                                </div>
                            </article>
                        @endforeach
                    </div>

                    @if($promos->count() > 1)
                        <div class="specials-controls">
                            <button type="button" data-special-prev aria-label="Previous special">‹</button>

                            <div>
                                @foreach($promos as $index => $promo)
                                    <button type="button" class="special-dot {{ $index === 0 ? 'is-active' : '' }}"
                                        data-special-dot="{{ $index }}" aria-label="Go to special {{ $index + 1 }}"></button>
                                @endforeach
                            </div>

                            <button type="button" data-special-next aria-label="Next special">›</button>
                        </div>
                    @endif
                </div>
            @else
                <div class="rounded-[7px] border border-mega-line bg-mega-soft p-12 text-center">
                    <h2 class="text-3xl font-black text-mega-black">No specials available right now.</h2>
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
        .specials-slider {
            position: relative;
            overflow: hidden;
            border-radius: 7px;
            background: #070707;
            box-shadow: 0 30px 90px rgba(7, 7, 7, 0.16);
        }

        .specials-track {
            position: relative;
            height: min(70vh, 720px);
            min-height: 480px;
        }

        .specials-slide {
            position: absolute;
            inset: 0;
            opacity: 0;
            pointer-events: none;
            transition: opacity 700ms ease;
        }

        .specials-slide.is-active {
            opacity: 1;
            pointer-events: auto;
        }

        .specials-slide img {
            height: 100%;
            width: 100%;
            object-fit: cover;
        }

        .specials-overlay {
            position: absolute;
            inset: 0;
            background:
                linear-gradient(90deg, rgba(7, 7, 7, 0.88), rgba(7, 7, 7, 0.35), rgba(7, 7, 7, 0.12)),
                linear-gradient(0deg, rgba(7, 7, 7, 0.42), transparent);
        }

        .specials-content {
            position: absolute;
            left: 7%;
            top: 50%;
            max-width: 680px;
            transform: translateY(-50%);
            color: white;
        }

        .specials-content h2 {
            margin-top: 14px;
            color: white;
            font-size: clamp(42px, 6vw, 84px);
            font-weight: 900;
            line-height: 0.98;
            letter-spacing: -0.07em;
        }

        .specials-content p {
            margin-top: 18px;
            max-width: 560px;
            color: rgba(255, 255, 255, .78);
            font-size: 18px;
            line-height: 1.7;
        }

        .specials-controls {
            position: absolute;
            bottom: 24px;
            left: 50%;
            z-index: 5;
            display: flex;
            align-items: center;
            gap: 14px;
            transform: translateX(-50%);
        }

        .specials-controls>button {
            display: grid;
            height: 44px;
            width: 44px;
            place-items: center;
            border-radius: 999px;
            background: rgba(255, 255, 255, .14);
            color: white;
            font-size: 30px;
            backdrop-filter: blur(14px);
        }

        .specials-controls>div {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .special-dot {
            height: 10px;
            width: 10px;
            border-radius: 999px;
            background: rgba(255, 255, 255, .45);
            transition: 200ms ease;
        }

        .special-dot.is-active {
            width: 44px;
            background: #ff5a00;
        }

        @media (max-width: 640px) {
            .specials-track {
                min-height: 520px;
            }

            .specials-content {
                left: 24px;
                right: 24px;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const slider = document.querySelector('[data-specials-slider]');

            if (!slider) {
                return;
            }

            const slides = Array.from(slider.querySelectorAll('[data-special-slide]'));
            const dots = Array.from(slider.querySelectorAll('[data-special-dot]'));
            const prev = slider.querySelector('[data-special-prev]');
            const next = slider.querySelector('[data-special-next]');

            if (!slides.length) {
                return;
            }

            let index = 0;
            let timer = null;

            function showSlide(nextIndex) {
                index = (nextIndex + slides.length) % slides.length;

                slides.forEach(function (slide, slideIndex) {
                    slide.classList.toggle('is-active', slideIndex === index);
                });

                dots.forEach(function (dot, dotIndex) {
                    dot.classList.toggle('is-active', dotIndex === index);
                });
            }

            function start() {
                stop();

                timer = setInterval(function () {
                    showSlide(index + 1);
                }, 5500);
            }

            function stop() {
                if (timer) {
                    clearInterval(timer);
                    timer = null;
                }
            }

            prev?.addEventListener('click', function () {
                showSlide(index - 1);
                start();
            });

            next?.addEventListener('click', function () {
                showSlide(index + 1);
                start();
            });

            dots.forEach(function (dot, dotIndex) {
                dot.addEventListener('click', function () {
                    showSlide(dotIndex);
                    start();
                });
            });

            slider.addEventListener('mouseenter', stop);
            slider.addEventListener('mouseleave', start);

            showSlide(0);
            start();
        });
    </script>

@endsection