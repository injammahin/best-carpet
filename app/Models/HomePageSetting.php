<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HomePageSetting extends Model
{
    protected $fillable = [
        'hero_side_image_one',
        'hero_side_image_two',
        'hero_card_kicker',
        'hero_card_text',
        'hero_slides',

        'visualizer_image',
        'visualizer_kicker',
        'visualizer_title',
        'visualizer_text',
        'visualizer_features',

        'shop_room_image',
        'shop_room_kicker',
        'shop_room_title',
        'shop_room_text',
        'shop_room_items',

        'recent_work_concepts',

        'quote_image',
        'quote_kicker',
        'quote_title',
        'quote_text',
        'quote_phone',
    ];

    protected $casts = [
        'hero_slides' => 'array',
        'visualizer_features' => 'array',
        'shop_room_items' => 'array',
        'recent_work_concepts' => 'array',
    ];

    public static function defaultData(): array
    {
        return [
            'hero_side_image_one' => '/images/Mega small van wrap idea.png',
            'hero_side_image_two' => '/images/mega man logo.png',
            'hero_card_kicker' => 'Premium demo ready',
            'hero_card_text' => 'A quote-first showroom experience for serious flooring buyers.',

            'hero_slides' => self::defaultHeroSlides(),

            'visualizer_image' => 'https://images.unsplash.com/photo-1600121848594-d8644e57abab?auto=format&fit=crop&w=1500&q=85',
            'visualizer_kicker' => 'Room visualiser concept',
            'visualizer_title' => 'Let customers imagine the floor before they book.',
            'visualizer_text' => 'Customers can compare colour direction, save favourites and move toward quote request.',
            'visualizer_features' => [
                'Upload room idea',
                'Compare colours',
                'Save favourites',
                'Request a quote',
            ],

            'shop_room_image' => '/images/Timber Flooring Pic -2 .webp',
            'shop_room_kicker' => 'Shop the room',
            'shop_room_title' => 'A premium inspiration block like a real showroom catalogue.',
            'shop_room_text' => 'Connect product discovery with full-room ideas so the website feels more useful and premium.',
            'shop_room_items' => [
                [
                    'type' => 'Curtains/Sheers',
                    'name' => 'Bali Driftwood',
                    'color' => '#dcd8cd',
                ],
                [
                    'type' => 'Rugs',
                    'name' => 'Retreat Weave',
                    'color' => '#bcae96',
                ],
                [
                    'type' => 'Timber',
                    'name' => 'Parky Summit',
                    'color' => '#c9a77b',
                ],
                [
                    'type' => 'Carpet',
                    'name' => 'Aston Soft Pile',
                    'color' => '#9e9284',
                ],
            ],

            'recent_work_concepts' => self::defaultRecentWork(),

            'quote_image' => '/images/Mega small van wrap idea.png',
            'quote_kicker' => 'Book a free consultation',
            'quote_title' => 'Request a measure, quote or product advice.',
            'quote_text' => 'Submit your flooring details and our team will follow up with quote support.',
            'quote_phone' => '1300 131 196',
        ];
    }

    public static function defaultHeroSlides(): array
    {
        return [
            [
                'eyebrow' => 'Premium flooring showroom',
                'title' => 'Choose a floor. Book a consultation. Get a clear quote.',
                'text' => 'Browse carpet, vinyl, timber and laminate ranges, save your favourites, then request a free measure and quote.',
                'image' => '/images/Carpet Pic.webp',
            ],
            [
                'eyebrow' => 'Quote-first product journey',
                'title' => 'A showroom experience with stronger visual impact.',
                'text' => 'Clean product cards, premium category blocks, room inspiration and quote-ready product selection.',
                'image' => '/images/Timber Flooring Pic -2 .webp',
            ],
            [
                'eyebrow' => 'Built for flooring enquiries',
                'title' => 'Browse ranges, compare options and save products.',
                'text' => 'Customers select colour, type and price indication before adding products to their quote list.',
                'image' => '/images/Background Pic 2.webp',
            ],
        ];
    }

    public static function defaultRecentWork(): array
    {
        return [
            [
                'title' => 'Family lounge refresh',
                'type' => 'Soft carpet installation',
                'location' => 'Residential home',
                'image' => 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?auto=format&fit=crop&w=1000&q=80',
            ],
            [
                'title' => 'Modern apartment upgrade',
                'type' => 'Hybrid vinyl planks',
                'location' => 'Apartment living',
                'image' => 'https://images.unsplash.com/photo-1600607688969-a5bfcd646154?auto=format&fit=crop&w=1000&q=80',
            ],
            [
                'title' => 'Retail showroom finish',
                'type' => 'Laminate and entrance carpet',
                'location' => 'Commercial fitout',
                'image' => 'https://images.unsplash.com/photo-1600566752355-35792bedcfea?auto=format&fit=crop&w=1000&q=80',
            ],
        ];
    }

    public function imageUrl(?string $path, ?string $fallback = null): ?string
    {
        if (!$path && !$fallback) {
            return null;
        }

        $path = $path ?: $fallback;

        if (Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }

        if (Str::startsWith($path, '/')) {
            return asset(ltrim($path, '/'));
        }

        return Storage::disk('public')->url($path);
    }

    public function heroSlidesForView(): array
    {
        $slides = $this->hero_slides ?: self::defaultHeroSlides();

        return collect($slides)->map(function ($slide) {
            return [
                'eyebrow' => $slide['eyebrow'] ?? '',
                'title' => $slide['title'] ?? '',
                'text' => $slide['text'] ?? '',
                'image' => $this->imageUrl($slide['image'] ?? null),
            ];
        })->values()->all();
    }

    public function visualizerFeaturesForView(): array
    {
        return $this->visualizer_features ?: self::defaultData()['visualizer_features'];
    }

    public function shopRoomItemsForView(): array
    {
        return $this->shop_room_items ?: self::defaultData()['shop_room_items'];
    }

    public function recentWorkForView(): array
    {
        $items = $this->recent_work_concepts ?: self::defaultRecentWork();

        return collect($items)->map(function ($item) {
            return [
                'title' => $item['title'] ?? '',
                'type' => $item['type'] ?? '',
                'location' => $item['location'] ?? '',
                'image' => $this->imageUrl($item['image'] ?? null),
            ];
        })->values()->all();
    }
}