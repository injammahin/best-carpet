<footer class="border-t border-mega-line bg-white text-mega-text">
    <div class="site-container py-16">
        <div class="grid gap-10 lg:grid-cols-[1.2fr_0.8fr_0.8fr_0.9fr]">
            <div>
                <a href="{{ url('/') }}"
                    class="flex h-14 w-[120px] items-center justify-center bg-white shadow-sm radius-7">
                    <img src="{{ asset('images/logo/mega_logo_3-removebg-preview.webp') }}" alt="Mega Carpets"
                        class="h-full w-full object-contain">
                </a>

                <p class="mt-5 max-w-sm text-base font-medium leading-8 text-mega-muted">
                    Mega Carpets helps customers explore carpets, timber, hybrid flooring, laminate, vinyl and rugs with
                    a simple quote-first showroom experience.
                </p>

                {{-- <div class="mt-6 flex gap-3">
                    <a href="https://www.facebook.com/" target="_blank" rel="noopener noreferrer" aria-label="Facebook"
                        class="grid h-11 w-11 place-items-center bg-mega-soft text-sm font-extrabold text-mega-black transition hover:bg-mega-orange hover:text-white radius-7">
                        F
                    </a>

                    <a href="https://www.instagram.com/" target="_blank" rel="noopener noreferrer"
                        aria-label="Instagram"
                        class="grid h-11 w-11 place-items-center bg-mega-soft text-sm font-extrabold text-mega-black transition hover:bg-mega-orange hover:text-white radius-7">
                        IG
                    </a>

                    <a href="https://www.pinterest.com/" target="_blank" rel="noopener noreferrer"
                        aria-label="Pinterest"
                        class="grid h-11 w-11 place-items-center bg-mega-soft text-sm font-extrabold text-mega-black transition hover:bg-mega-orange hover:text-white radius-7">
                        P
                    </a>

                    <a href="https://www.youtube.com/" target="_blank" rel="noopener noreferrer" aria-label="YouTube"
                        class="grid h-11 w-11 place-items-center bg-mega-soft text-sm font-extrabold text-mega-black transition hover:bg-mega-orange hover:text-white radius-7">
                        YT
                    </a>
                </div> --}}
            </div>

            <div>
                <h4 class="text-xl font-extrabold text-mega-orange">
                    Help Centre
                </h4>

                <div class="mt-5 grid gap-3 text-base font-medium text-mega-muted">
                    <a href="{{ url('/#faq') }}" class="transition hover:text-mega-orange">
                        FAQ
                    </a>

                    <a href="{{ url('/warranty-information') }}" class="transition hover:text-mega-orange">
                        Warranty Information
                    </a>

                    <a href="{{ url('/product-advice') }}" class="transition hover:text-mega-orange">
                        Product Advice
                    </a>

                    <a href="{{ url('/installation-guide') }}" class="transition hover:text-mega-orange">
                        Installation Guide
                    </a>

                    <a href="{{ url('/care-and-maintenance') }}" class="transition hover:text-mega-orange">
                        Care & Maintenance
                    </a>
                </div>
            </div>

            <div>
                <h4 class="text-xl font-extrabold text-mega-orange">
                    Our Company
                </h4>

                <div class="mt-5 grid gap-3 text-base font-medium text-mega-muted">
                    <a href="{{ url('/about-us') }}" class="transition hover:text-mega-orange">
                        About Us
                    </a>

                    <a href="{{ url('/terms-and-conditions') }}" class="transition hover:text-mega-orange">
                        Terms and Conditions
                    </a>

                    <a href="{{ url('/privacy-policy') }}" class="transition hover:text-mega-orange">
                        Privacy Policy
                    </a>

                    <a href="{{ url('/specials') }}" class="transition hover:text-mega-orange">
                        Specials
                    </a>

                    <a href="{{ url('/blog') }}" class="transition hover:text-mega-orange">
                        Blog
                    </a>
                </div>
            </div>

            <div>
                <h4 class="text-xl font-extrabold text-mega-orange">
                    Get In Touch
                </h4>

                <div class="mt-5 grid gap-3 text-base font-medium text-mega-muted">
                    <a href="{{ url('/free-measure-quote') }}" class="transition hover:text-mega-orange">
                        Book a Consultation
                    </a>

                    <a href="tel:1300131196" class="transition hover:text-mega-orange">
                        1300 131 196
                    </a>

                    <a href="mailto:sales@megacarpet.com.au" class="transition hover:text-mega-orange">
                        sales@megacarpet.com.au
                    </a>
                </div>
            </div>
        </div>

        <div
            class="mt-14 flex flex-col justify-between gap-4 border-t border-mega-line pt-6 text-sm font-medium text-mega-muted md:flex-row">
            <p>
                © {{ date('Y') }} Mega Carpets. All rights reserved.
            </p>

            <p>
                Developed by
                <a href="https://nexolioit.com" target="_blank" rel="noopener noreferrer"
                    class="font-bold text-mega-muted transition hover:text-mega-orange">
                    NexolioIT
                </a>
            </p>
        </div>
    </div>
</footer>