<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use App\Models\ProductColour;
use App\Models\ProductRange;
use App\Models\ProductRangePrice;
use App\Models\ProductSizeOption;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DynamicProductSeeder extends Seeder
{
    public function run(): void
    {
        $topCategories = [
            ['name' => 'Carpet', 'slug' => 'carpet', 'short' => 'Soft, durable carpet ranges for bedrooms, stairs and living spaces.'],
            ['name' => 'Timber', 'slug' => 'timber', 'short' => 'Premium timber flooring with natural warmth.'],
            ['name' => 'Hybrid Flooring', 'slug' => 'hybrid-flooring', 'short' => 'Water-resistant hybrid floors for modern homes.'],
            ['name' => 'Laminate', 'slug' => 'laminate', 'short' => 'Practical laminate flooring in modern styles.'],
            ['name' => 'Vinyl', 'slug' => 'vinyl', 'short' => 'Comfortable vinyl floors for busy homes.'],
            ['name' => 'Rugs', 'slug' => 'rugs', 'short' => 'Designer rugs and soft finishing pieces.'],
        ];

        foreach ($topCategories as $index => $item) {
            ProductCategory::updateOrCreate(
                ['slug' => $item['slug']],
                [
                    'name' => $item['name'],
                    'short_description' => $item['short'],
                    'sort_order' => $index + 1,
                    'is_active' => true,
                ]
            );
        }

        $carpet = ProductCategory::where('slug', 'carpet')->first();

        $subcategories = [
            ['name' => 'Wool Carpets', 'slug' => 'wool-carpets', 'short' => 'Natural comfort, premium softness and a refined showroom finish.'],
            ['name' => 'Nylon Carpets', 'slug' => 'nylon-carpets', 'short' => 'Durable family carpet for bedrooms, stairs and busy living areas.'],
            ['name' => 'Triexta Carpets', 'slug' => 'triexta-carpets', 'short' => 'Soft, stain-resistant and practical for modern homes.'],
            ['name' => 'Polyester Carpets', 'slug' => 'polyester-carpets', 'short' => 'Comfortable, stylish and value-friendly carpet options.'],
        ];

        foreach ($subcategories as $index => $item) {
            ProductCategory::updateOrCreate(
                ['slug' => $item['slug']],
                [
                    'parent_id' => $carpet->id,
                    'name' => $item['name'],
                    'short_description' => $item['short'],
                    'image' => 'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?auto=format&fit=crop&w=500&q=80',
                    'sort_order' => $index + 1,
                    'is_active' => true,
                ]
            );
        }

        $sizes = [
            ['label' => 'Small Room', 'sqm' => 10, 'size_group' => 'Small'],
            ['label' => 'Medium Room', 'sqm' => 18, 'size_group' => 'Medium'],
            ['label' => 'Large Room', 'sqm' => 28, 'size_group' => 'Large'],
            ['label' => 'Whole Area', 'sqm' => 45, 'size_group' => 'Large'],
        ];

        foreach ($sizes as $index => $item) {
            ProductSizeOption::updateOrCreate(
                ['label' => $item['label']],
                [
                    'sqm' => $item['sqm'],
                    'size_group' => $item['size_group'],
                    'sort_order' => $index + 1,
                    'is_active' => true,
                ]
            );
        }

        $nylon = ProductCategory::where('slug', 'nylon-carpets')->first();

        $range = ProductRange::updateOrCreate(
            ['slug' => 'aurora-nylon-carpet-range'],
            [
                'category_id' => $carpet->id,
                'subcategory_id' => $nylon->id,
                'name' => 'Aurora Nylon Carpet Range',
                'badge' => 'Best Seller',
                'short_description' => 'A durable nylon carpet range available in multiple colours.',
                'description' => 'Aurora is a family-friendly nylon carpet range suitable for bedrooms, lounges and busy living areas.',
                'main_image' => 'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?auto=format&fit=crop&w=900&q=80',
                'gallery' => [
                    'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?auto=format&fit=crop&w=900&q=80',
                    'https://images.unsplash.com/photo-1600121848594-d8644e57abab?auto=format&fit=crop&w=900&q=80',
                ],
                'features' => [
                    'Durable nylon fibre',
                    'Multiple colour options',
                    'Family friendly',
                    'Free measure and quote available',
                ],
                'rating' => 4.9,
                'unit' => 'm²',
                'colour_group' => 'Neutral',
                'size_group' => 'Standard',
                'room' => 'Bedroom',
                'sort_order' => 1,
                'is_active' => true,
            ]
        );

        $range->colours()->delete();

        $colours = [
            ['name' => 'Warm Beige', 'swatch' => '#cbb79e', 'group' => 'Neutral'],
            ['name' => 'Soft Grey', 'swatch' => '#9ca3af', 'group' => 'Grey'],
            ['name' => 'Charcoal', 'swatch' => '#374151', 'group' => 'Grey'],
            ['name' => 'Natural Cream', 'swatch' => '#eadfce', 'group' => 'Neutral'],
        ];

        foreach ($colours as $index => $colour) {
            ProductColour::create([
                'product_range_id' => $range->id,
                'name' => $colour['name'],
                'swatch' => $colour['swatch'],
                'colour_group' => $colour['group'],
                'sort_order' => $index + 1,
            ]);
        }

        $range->prices()->delete();

        foreach (ProductSizeOption::orderBy('sort_order')->get() as $size) {
            $price = match ($size->label) {
                'Small Room' => 399,
                'Medium Room' => 649,
                'Large Room' => 899,
                default => 1299,
            };

            ProductRangePrice::create([
                'product_range_id' => $range->id,
                'product_size_option_id' => $size->id,
                'price' => $price,
                'regular_price' => $price + 120,
            ]);
        }
    }
}