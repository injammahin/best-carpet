@extends('layouts.frontend')

@section('title', 'Specials | Mega Carpets')
@section('meta_description', 'View current Mega Carpets flooring specials and promotional offers.')

@section('content')

    <section class="bg-mega-cream py-10 md:py-14">
        <div class="site-container">
            @if($promos->count())
                <div class="specials-slider" data-specials-slider>
                    <div class="specials-track">
                        @foreach($promos as $index => $promo)
                            <article class="specials-slide {{ $index === 0 ? 'is-active' : '' }}" data-special-slide="{{ $index }}">

                                <div class="specials-slide-shell">
                                    <div class="specials-backdrop">
                                        <img src="{{ $promo->imageUrl() }}" alt="{{ $promo->title }}">
                                    </div>

                                    <div class="specials-grid">
                                        <div class="specials-copy">
                                            <div class="specials-copy-card">
                                                <p class="specials-kicker">
                                                    Mega Carpets Special
                                                </p>

                                                <h1 class="specials-title">
                                                    {{ $promo->title }}
                                                </h1>

                                                @if($promo->subtitle)
                                                    <p class="specials-text">
                                                        {{ $promo->subtitle }}
                                                    </p>
                                                @endif

                                                <div class="specials-actions">
                                                    @if($promo->button_text && $promo->button_url)
                                                        <a href="{{ $promo->button_url }}" class="btn-primary">
                                                            {{ $promo->button_text }}
                                                            <span>→</span>
                                                        </a>
                                                    @else
                                                        <a href="{{ route('frontend.quote') }}" class="btn-primary">
                                                            Book a free Measure & Quote
                                                            <span>→</span>
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="specials-visual">
                                            <div class="specials-image-card">
                                                <img src="{{ $promo->imageUrl() }}" alt="{{ $promo->title }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    @if($promos->count() > 1)
                        <div class="specials-controls">
                            <button type="button" data-special-prev aria-label="Previous special">‹</button>

                            <div class="specials-dots">
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
                <div class="rounded-[7px] border border-mega-line bg-white p-12 text-center shadow-sm">
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
            padding-bottom: 78px;
            /* background: linear-gradient(135deg, #f6f1ea 0%, #fdfaf7 100%);
                                    border: 1px solid #ebe2d8;
                                    box-shadow: 0 24px 80px rgba(15, 15, 15, 0.10); */
        }

        .specials-track {
            position: relative;
            min-height: 620px;
        }

        .specials-slide {
            position: absolute;
            inset: 0;
            opacity: 0;
            pointer-events: none;
            transition: opacity 600ms ease;
        }

        .specials-slide.is-active {
            opacity: 1;
            pointer-events: auto;
        }

        .specials-slide-shell {
            position: relative;
            min-height: 620px;
            overflow: hidden;
        }

        .specials-backdrop {
            position: absolute;
            inset: 0;
            overflow: hidden;
        }

        .specials-backdrop img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: blur(24px);
            transform: scale(1.08);
            opacity: 0.18;
        }

        .specials-slide-shell::before {
            content: '';
            position: absolute;
            inset: 0;
            background: #f3eee7;
            z-index: 1;
        }

        .specials-grid {
            position: relative;
            z-index: 2;
            display: grid;
            grid-template-columns: 1fr 1.1fr;
            gap: 34px;
            align-items: center;
            min-height: 620px;
            padding: 46px;
        }

        .specials-copy {
            display: flex;
            align-items: center;
        }

        .specials-copy-card {
            width: 100%;
            max-width: 520px;
            border-radius: 7px;
            border: 1px solid rgba(255, 90, 0, 0.14);
            background: rgba(255, 255, 255, 0.88);
            box-shadow: 0 18px 50px rgba(0, 0, 0, 0.08);
            padding: 34px 32px;
            backdrop-filter: blur(10px);
        }

        .specials-kicker {
            display: inline-block;
            margin-bottom: 14px;
            color: #ff5a00;
            font-size: 13px;
            font-weight: 800;
            letter-spacing: 0.28em;
            text-transform: uppercase;
        }

        .specials-title {
            color: #111111;
            font-size: clamp(32px, 4vw, 58px);
            font-weight: 900;
            line-height: 0.95;
            letter-spacing: -0.06em;
            margin: 0;
        }

        .specials-text {
            margin-top: 18px;
            color: #6f6b76;
            font-size: 17px;
            line-height: 1.8;
            font-weight: 500;
        }

        .specials-actions {
            margin-top: 26px;
        }

        .specials-visual {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .specials-image-card {
            width: 100%;
            max-width: 760px;
            aspect-ratio: 1 / 1;
            border-radius: 7px;
            overflow: hidden;
            /* background: linear-gradient(180deg, #ffffff 0%, #f5efe8 100%);
                        border: 1px solid #eadfd3;
                        box-shadow: 0 24px 60px rgba(0, 0, 0, 0.12); */
            padding: 18px;
        }

        .specials-image-card img {
            width: 100%;
            height: 85%;
            object-fit: fill;
            object-position: center;
            border-radius: 7px;
            display: block;
            background: #fff;
        }

        .specials-controls {
            position: absolute;
            left: 50%;
            bottom: 18px;
            z-index: 5;
            transform: translateX(-50%);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 14px;
        }

        .specials-controls>button {
            display: grid;
            height: 48px;
            width: 48px;
            place-items: center;
            border-radius: 999px;
            border: 1px solid rgba(255, 255, 255, 0.35);
            background: rgba(17, 17, 17, 0.72);
            color: #fff;
            font-size: 30px;
            line-height: 1;
            transition: all 200ms ease;
        }

        .specials-controls>button:hover {
            background: #ff5a00;
            border-color: #ff5a00;
        }

        .specials-dots {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .special-dot {
            width: 10px;
            height: 10px;
            border-radius: 999px;
            background: rgba(17, 17, 17, 0.22);
            transition: all 200ms ease;
        }

        .special-dot.is-active {
            width: 44px;
            background: #ff5a00;
        }

        @media (max-width: 1100px) {
            .specials-grid {
                grid-template-columns: 1fr;
                gap: 26px;
                padding: 26px;
            }

            .specials-copy {
                order: 2;
            }

            .specials-visual {
                order: 1;
            }

            .specials-copy-card {
                max-width: 100%;
            }

            .specials-track,
            .specials-slide-shell {
                min-height: 760px;
            }

            .specials-image-card {
                max-width: 640px;
                margin: 0 auto;
            }
        }

        @media (max-width: 768px) {
            .specials-slider {
                padding-bottom: 70px;
            }

            .specials-track,
            .specials-slide-shell {
                min-height: 700px;
            }

            .specials-grid {
                padding: 18px;
                gap: 18px;
            }

            .specials-copy-card {
                padding: 24px 20px;
            }

            .specials-title {
                font-size: 34px;
                line-height: 1.02;
            }

            .specials-text {
                font-size: 15px;
                line-height: 1.7;
            }

            .specials-image-card {
                aspect-ratio: 1 / 1;
                padding: 12px;
            }

            .specials-controls {
                bottom: 16px;
            }

            .specials-controls>button {
                height: 42px;
                width: 42px;
                font-size: 26px;
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

            let currentIndex = 0;
            let interval = null;

            function showSlide(newIndex) {
                currentIndex = (newIndex + slides.length) % slides.length;

                slides.forEach(function (slide, index) {
                    slide.classList.toggle('is-active', index === currentIndex);
                });

                dots.forEach(function (dot, index) {
                    dot.classList.toggle('is-active', index === currentIndex);
                });
            }

            function startSlider() {
                stopSlider();

                interval = setInterval(function () {
                    showSlide(currentIndex + 1);
                }, 5000);
            }

            function stopSlider() {
                if (interval) {
                    clearInterval(interval);
                    interval = null;
                }
            }

            if (prev) {
                prev.addEventListener('click', function () {
                    showSlide(currentIndex - 1);
                    startSlider();
                });
            }

            if (next) {
                next.addEventListener('click', function () {
                    showSlide(currentIndex + 1);
                    startSlider();
                });
            }

            dots.forEach(function (dot, index) {
                dot.addEventListener('click', function () {
                    showSlide(index);
                    startSlider();
                });
            });

            slider.addEventListener('mouseenter', stopSlider);
            slider.addEventListener('mouseleave', startSlider);

            showSlide(0);
            startSlider();
        });
    </script>

@endsection