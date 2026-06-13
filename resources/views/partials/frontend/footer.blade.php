@php
    use App\Models\SiteSetting;

    try {
        $settings = SiteSetting::frontend();
    } catch (\Throwable $e) {
        $settings = SiteSetting::defaults();
    }

    $footerLogo = SiteSetting::imageUrl(
        $settings['footer_logo'] ?: $settings['site_logo'],
        '/images/logo/mega_logo_3-removebg-preview.webp'
    );

    $helpLinks = SiteSetting::links($settings['footer_help_links'] ?? '');
    $companyLinks = SiteSetting::links($settings['footer_company_links'] ?? '');
    $touchLinks = SiteSetting::links($settings['footer_touch_links'] ?? '');

    $socials = [
        [
            'label' => 'F',
            'url' => $settings['facebook_url'] ?? '#',
            'aria' => 'Facebook',
        ],
        [
            'label' => 'IG',
            'url' => $settings['instagram_url'] ?? '#',
            'aria' => 'Instagram',
        ],
        [
            'label' => 'P',
            'url' => $settings['pinterest_url'] ?? '#',
            'aria' => 'Pinterest',
        ],
        [
            'label' => 'YT',
            'url' => $settings['youtube_url'] ?? '#',
            'aria' => 'YouTube',
        ],
    ];

    $copyright = str_replace(
        '{year}',
        date('Y'),
        $settings['footer_copyright'] ?? '© {year} Mega Carpets. All rights reserved.'
    );

    function megaFooterTarget($url)
    {
        return str_starts_with($url, 'http') ? '_blank' : '_self';
    }
@endphp

<footer class="border-t border-mega-line bg-white text-mega-text">
    <div class="site-container py-16">
        <div class="grid gap-10 lg:grid-cols-[1.2fr_0.8fr_0.8fr_0.9fr]">
            <div>
                <a href="{{ route('frontend.home') }}"
                    class="flex h-14 w-[120px] items-center justify-center bg-white shadow-sm radius-7">
                    @if($footerLogo)
                        <img src="{{ $footerLogo }}" alt="{{ $settings['site_name'] ?? 'Mega Carpets' }}"
                            class="h-full w-full object-contain">
                    @else
                        <div class="text-center leading-none">
                            <div class="-skew-x-12 font-heading text-2xl font-extrabold tracking-tight text-mega-orange">
                                MEGA
                            </div>
                            <div class="text-[10px] font-semibold uppercase tracking-[0.26em] text-mega-black">
                                Carpets
                            </div>
                        </div>
                    @endif
                </a>

                <p class="mt-5 max-w-sm text-base font-medium leading-8 text-mega-muted">
                    {{ $settings['footer_description'] ?? 'A premium flooring website for carpets, vinyl, timber, laminate, rugs and quote-first consultation booking.' }}
                </p>

                @if(($settings['show_footer_socials'] ?? '1') === '1')
                    <div class="mt-6 flex gap-3">
                        @foreach($socials as $social)
                            @if(!empty($social['url']))
                                <a href="{{ $social['url'] }}" target="{{ megaFooterTarget($social['url']) }}"
                                    rel="{{ str_starts_with($social['url'], 'http') ? 'noopener noreferrer' : '' }}"
                                    aria-label="{{ $social['aria'] }}"
                                    class="grid h-11 w-11 place-items-center bg-mega-soft text-sm font-extrabold text-mega-black transition hover:bg-mega-orange hover:text-white radius-7">
                                    {{ $social['label'] }}
                                </a>
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>

            <div>
                <h4 class="text-xl font-extrabold text-mega-orange">
                    {{ $settings['footer_help_title'] ?? 'Help Centre' }}
                </h4>

                <div class="mt-5 grid gap-3 text-base font-medium text-mega-muted">
                    @forelse($helpLinks as $link)
                        <a href="{{ $link['url'] }}" target="{{ megaFooterTarget($link['url']) }}"
                            rel="{{ str_starts_with($link['url'], 'http') ? 'noopener noreferrer' : '' }}"
                            class="transition hover:text-mega-orange">
                            {{ $link['label'] }}
                        </a>
                    @empty
                        <a href="#faq" class="transition hover:text-mega-orange">FAQs</a>
                        <a href="#services" class="transition hover:text-mega-orange">Warranty Information</a>
                        <a href="#products" class="transition hover:text-mega-orange">Product Advice</a>
                        <a href="#services" class="transition hover:text-mega-orange">Installation Guide</a>
                        <a href="#inspiration" class="transition hover:text-mega-orange">Care & Maintenance</a>
                    @endforelse
                </div>
            </div>

            <div>
                <h4 class="text-xl font-extrabold text-mega-orange">
                    {{ $settings['footer_company_title'] ?? 'Our Company' }}
                </h4>

                <div class="mt-5 grid gap-3 text-base font-medium text-mega-muted">
                    @forelse($companyLinks as $link)
                        <a href="{{ $link['url'] }}" target="{{ megaFooterTarget($link['url']) }}"
                            rel="{{ str_starts_with($link['url'], 'http') ? 'noopener noreferrer' : '' }}"
                            class="transition hover:text-mega-orange">
                            {{ $link['label'] }}
                        </a>
                    @empty
                        <a href="#top" class="transition hover:text-mega-orange">About Us</a>
                        <a href="#collections" class="transition hover:text-mega-orange">Mega Range</a>
                        <a href="#services" class="transition hover:text-mega-orange">Mega Service</a>
                        <a href="#projects" class="transition hover:text-mega-orange">Mega Value</a>
                        <a href="#quote" class="transition hover:text-mega-orange">Careers</a>
                    @endforelse
                </div>
            </div>

            <div>
                <h4 class="text-xl font-extrabold text-mega-orange">
                    {{ $settings['footer_touch_title'] ?? 'Get In Touch' }}
                </h4>

                <div class="mt-5 grid gap-3 text-base font-medium text-mega-muted">
                    @forelse($touchLinks as $link)
                        <a href="{{ $link['url'] }}" target="{{ megaFooterTarget($link['url']) }}"
                            rel="{{ str_starts_with($link['url'], 'http') ? 'noopener noreferrer' : '' }}"
                            class="transition hover:text-mega-orange">
                            {{ $link['label'] }}
                        </a>
                    @empty
                        <a href="{{ route('frontend.quote') }}" class="transition hover:text-mega-orange">Book a
                            Consultation</a>
                        <a href="#visualizer" class="transition hover:text-mega-orange">Room Visualiser</a>
                        <a href="{{ route('frontend.contact') }}" class="transition hover:text-mega-orange">Store
                            Locator</a>
                        <a href="tel:{{ $settings['phone_link'] ?? '1300131196' }}"
                            class="transition hover:text-mega-orange">
                            {{ $settings['phone_number'] ?? '1300 131 196' }}
                        </a>
                        <a href="mailto:{{ $settings['email'] ?? 'hello@megacarpets.com' }}"
                            class="transition hover:text-mega-orange">
                            {{ $settings['email'] ?? 'hello@megacarpets.com' }}
                        </a>
                    @endforelse
                </div>
            </div>
        </div>

        <div
            class="mt-14 flex flex-col justify-between gap-4 border-t border-mega-line pt-6 text-sm font-medium text-mega-muted md:flex-row">
            <p>{{ $copyright }}</p>
            <p>{{ $settings['footer_credit'] ?? 'Built with Laravel Blade, JavaScript and Tailwind CSS.' }}</p>
        </div>
    </div>
</footer>