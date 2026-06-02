<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class PageController extends Controller
{
    private function categories(): array
    {
        return [
            [
                'name' => 'Carpet',
                'slug' => 'carpet',
                'short' => 'Soft comfort for bedrooms, lounges and family spaces.',
                'description' => 'Carpet is ideal when the customer wants warmth, comfort and a quieter room feel. This page can later hold wool, nylon, polyester, loop pile, twist pile and plush pile products.',
                'image' => 'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?auto=format&fit=crop&w=1200&q=80',
                'best_for' => ['Bedrooms', 'Living rooms', 'Family homes', 'Stairs'],
                'features' => ['Soft underfoot', 'Warmer room feel', 'Noise reduction', 'Many texture options'],
            ],
            [
                'name' => 'Hybrid Flooring',
                'slug' => 'hybrid-flooring',
                'short' => 'Durable timber-look flooring for busy modern homes.',
                'description' => 'Hybrid flooring gives customers a practical timber-look finish with strong everyday performance. It is a good product category for family homes and rental properties.',
                'image' => 'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?auto=format&fit=crop&w=1200&q=80',
                'best_for' => ['Open living areas', 'Rental properties', 'Busy homes', 'Apartments'],
                'features' => ['Timber-look finish', 'Easy maintenance', 'Strong wear layer', 'Modern colour range'],
            ],
            [
                'name' => 'Timber',
                'slug' => 'timber',
                'short' => 'Natural warmth and premium character for refined interiors.',
                'description' => 'Timber flooring suits customers who want a premium natural look. This page can later include engineered timber, oak looks, darker tones and light natural finishes.',
                'image' => 'https://images.unsplash.com/photo-1600210492493-0946911123ea?auto=format&fit=crop&w=1200&q=80',
                'best_for' => ['Premium homes', 'Living rooms', 'Dining areas', 'Renovations'],
                'features' => ['Natural character', 'Premium appearance', 'Long-term appeal', 'Warm interior tone'],
            ],
            [
                'name' => 'Laminate',
                'slug' => 'laminate',
                'short' => 'Clean, practical and affordable flooring for everyday spaces.',
                'description' => 'Laminate is a practical product category for customers who want a neat flooring finish with a controlled budget.',
                'image' => 'https://images.unsplash.com/photo-1600566753086-00f18fb6b3ea?auto=format&fit=crop&w=1200&q=80',
                'best_for' => ['Budget renovations', 'Bedrooms', 'Rental homes', 'Small apartments'],
                'features' => ['Cost effective', 'Clean finish', 'Easy care', 'Good colour choice'],
            ],
            [
                'name' => 'Vinyl',
                'slug' => 'vinyl',
                'short' => 'Comfortable, low-maintenance flooring for practical homes.',
                'description' => 'Vinyl flooring works well for customers who want a comfortable, practical and easy-care floor for everyday living.',
                'image' => 'https://images.unsplash.com/photo-1600607688969-a5bfcd646154?auto=format&fit=crop&w=1200&q=80',
                'best_for' => ['Family homes', 'Kitchens', 'Apartments', 'Commercial spaces'],
                'features' => ['Easy cleaning', 'Comfortable feel', 'Modern patterns', 'Practical finish'],
            ],
            [
                'name' => 'Rugs',
                'slug' => 'rugs',
                'short' => 'Texture, warmth and style for finished room design.',
                'description' => 'Rugs help customers complete a room with colour, softness and visual balance. This page can later include modern, traditional, outdoor and custom rugs.',
                'image' => 'https://images.unsplash.com/photo-1600121848594-d8644e57abab?auto=format&fit=crop&w=1200&q=80',
                'best_for' => ['Living rooms', 'Bedrooms', 'Dining rooms', 'Apartments'],
                'features' => ['Adds texture', 'Defines spaces', 'Softens rooms', 'Easy style update'],
            ],
        ];
    }

    private function inspirations(): array
    {
        return [
            [
                'title' => 'Living room flooring ideas',
                'slug' => 'living-room-flooring-ideas',
                'text' => 'Simple ways to choose flooring that feels warm, practical and visually calm.',
                'image' => 'https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?auto=format&fit=crop&w=1200&q=80',
            ],
            [
                'title' => 'Bedroom carpet guide',
                'slug' => 'bedroom-carpet-guide',
                'text' => 'How to choose soft textures and neutral colours for a quieter bedroom.',
                'image' => 'https://images.unsplash.com/photo-1616594039964-ae9021a400a0?auto=format&fit=crop&w=1200&q=80',
            ],
            [
                'title' => 'Flooring colour guide',
                'slug' => 'flooring-colour-guide',
                'text' => 'How to match flooring tones with walls, furniture and natural light.',
                'image' => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?auto=format&fit=crop&w=1200&q=80',
            ],
        ];
    }

    public function home()
    {
        return view('frontend.home');
    }

    public function products()
    {
        return view('frontend.products.index', [
            'categories' => $this->categories(),
        ]);
    }

    public function productShow(string $slug)
    {
        $category = collect($this->categories())->firstWhere('slug', $slug);

        abort_if(!$category, 404);

        $related = collect($this->categories())
            ->where('slug', '!=', $slug)
            ->take(3)
            ->values()
            ->all();

        return view('frontend.products.show', [
            'category' => $category,
            'related' => $related,
        ]);
    }

    public function mobileShowroom()
    {
        return view('frontend.mobile-showroom');
    }

    public function quote()
    {
        return view('frontend.quote');
    }

    public function inspiration()
    {
        return view('frontend.inspiration.index', [
            'articles' => $this->inspirations(),
        ]);
    }

    public function contact()
    {
        return view('frontend.contact');
    }
}