<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class SiteSetting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'group',
    ];

    public static function defaults(): array
    {
        return [
            'site_name' => 'Mega Carpets',
            'site_tagline' => 'Premium flooring showroom',
            'site_logo' => '/images/logo/mega_logo_3-removebg-preview.webp',
            'footer_logo' => '/images/logo/mega_logo_3-removebg-preview.webp',
            'favicon' => '',

            'default_meta_title' => 'Mega Carpets | Premium Flooring Showroom',
            'default_meta_description' => 'Shop carpets, timber, hybrid, laminate, vinyl and rugs with free measure and quote booking.',

            'topbar_left' => 'Free local measure & quote',
            'topbar_middle' => 'Carpet · Timber · Hybrid · Laminate · Vinyl · Rugs',
            'topbar_right' => 'Premium flooring showroom',

            'consultation_button_text' => 'Book a free Measure & Quote',
            'phone_number' => '1300 131 196',
            'phone_link' => '1300131196',
            'email' => 'hello@megacarpets.com',
            'address' => 'Melbourne, Australia',

            'show_header_admin_login' => '1',
            'show_wishlist_button' => '1',
            'show_quote_button' => '1',

            'footer_description' => 'A premium single-vendor flooring website for carpets, vinyl, timber, laminate, rugs and quote-first consultation booking.',
            'footer_copyright' => '© {year} Mega Carpets. All rights reserved.',
            'footer_credit' => 'Built with Laravel Blade, JavaScript and Tailwind CSS.',

            'footer_help_title' => 'Help Centre',
            'footer_help_links' => "FAQs|#faq\nWarranty Information|#services\nProduct Advice|#products\nInstallation Guide|#services\nCare & Maintenance|#inspiration",

            'footer_company_title' => 'Our Company',
            'footer_company_links' => "About Us|/about-us\nMega Range|#collections\nMega Service|#services\nMega Value|#projects\nCareers|#quote",

            'footer_touch_title' => 'Get In Touch',
            'footer_touch_links' => "Book a Consultation|/free-measure-quote\nRoom Visualiser|#visualizer\nStore Locator|/contact\n1300 131 196|tel:1300131196\nhello@megacarpets.com|mailto:hello@megacarpets.com",

            'facebook_url' => '#',
            'instagram_url' => '#',
            'pinterest_url' => '#',
            'youtube_url' => '#',
            'show_footer_socials' => '1',
        ];
    }

    public static function frontend(): array
    {
        return Cache::rememberForever('mega_site_settings', function () {
            $settings = self::query()
                ->pluck('value', 'key')
                ->toArray();

            return array_merge(self::defaults(), $settings);
        });
    }

    public static function setValue(string $key, mixed $value, ?string $group = null): void
    {
        self::updateOrCreate(
            ['key' => $key],
            [
                'value' => is_null($value) ? null : (string) $value,
                'group' => $group,
            ]
        );

        Cache::forget('mega_site_settings');
    }

    public static function imageUrl(?string $path, ?string $fallback = null): ?string
    {
        $resolved = self::resolveMediaPath($path);

        if ($resolved) {
            return $resolved;
        }

        return self::resolveMediaPath($fallback);
    }

    private static function resolveMediaPath(?string $path): ?string
    {
        if (!$path) {
            return null;
        }

        $path = trim($path);

        if ($path === '') {
            return null;
        }

        if (Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }

        if (Str::startsWith($path, ['/storage/', 'storage/'])) {
            return asset(ltrim($path, '/'));
        }

        if (Str::startsWith($path, ['/images/', 'images/', '/favicon', 'favicon'])) {
            return asset(ltrim($path, '/'));
        }

        if (Str::startsWith($path, ['/'])) {
            return asset(ltrim($path, '/'));
        }

        return asset('storage/' . ltrim($path, '/'));
    }

    public static function links(?string $text): array
    {
        return collect(preg_split('/\r\n|\r|\n/', $text ?: ''))
            ->map(fn ($line) => trim($line))
            ->filter()
            ->map(function ($line) {
                $parts = explode('|', $line, 2);

                return [
                    'label' => trim($parts[0] ?? ''),
                    'url' => trim($parts[1] ?? '#') ?: '#',
                ];
            })
            ->filter(fn ($link) => $link['label'] !== '')
            ->values()
            ->all();
    }
}