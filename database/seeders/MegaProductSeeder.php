<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use App\Models\ProductColour;
use App\Models\ProductRange;
use App\Models\ProductRangePrice;
use App\Models\ProductSizeOption;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class MegaProductSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            $sizes = $this->seedSizes();
            $categories = $this->seedCategories();

            $catalogue = $this->catalogue();

            $sortOrder = 1;

            foreach ($catalogue as $categorySlug => $categoryData) {
                $category = $categories[$categorySlug] ?? null;

                if (!$category) {
                    continue;
                }

                foreach ($categoryData['products'] as $productIndex => $productData) {
                    $slug = Str::slug($productData['name']);

                    $product = ProductRange::query()
                        ->where('slug', $slug)
                        ->first();

                    if (!$product) {
                        $product = new ProductRange();
                    }

                    $gallery = [
                        $productData['image'],
                        $categoryData['gallery'][0],
                        $categoryData['gallery'][1],
                    ];

                    $features = $categoryData['features'];

                    $payload = [
                        'category_id' => $category->id,
                        'subcategory_id' => null,
                        'name' => $productData['name'],
                        'slug' => $slug,
                        'badge' => $productData['badge'],
                        'short_description' => $this->shortDescription($categoryData['name'], $productData),
                        'description' => $this->description($categoryData['name'], $productData, $categoryData),
                        'rating' => $productData['rating'],
                        'unit' => $categorySlug === 'rugs' ? 'each' : 'm²',
                        'colour_group' => $categoryData['default_colour_group'],
                        'size_group' => $categorySlug === 'rugs' ? 'Rug Size' : 'Room Size',
                        'room' => $productData['room'],
                        'features' => $features,
                        'sort_order' => $sortOrder,
                        'is_active' => true,
                    ];

                    if (Schema::hasColumn('product_ranges', 'main_image')) {
                        $payload['main_image'] = $productData['image'];
                    }

                    if (Schema::hasColumn('product_ranges', 'image')) {
                        $payload['image'] = $productData['image'];
                    }

                    if (Schema::hasColumn('product_ranges', 'gallery_images')) {
                        $payload['gallery_images'] = $gallery;
                    }

                    if (Schema::hasColumn('product_ranges', 'gallery')) {
                        $payload['gallery'] = $gallery;
                    }

                    $product->forceFill($this->onlyExistingColumns('product_ranges', $payload));
                    $product->save();

                    $this->syncColours($product, $categoryData['colours']);
                    $this->syncPrices($product, $categorySlug === 'rugs' ? $sizes['rug'] : $sizes['flooring'], $productData['base_price']);

                    $sortOrder++;
                }
            }
        });
    }

    private function seedCategories(): array
    {
        $categories = [
            'carpet' => [
                'name' => 'Carpet',
                'short_description' => 'Soft, warm and quiet flooring for bedrooms, lounges, stairs and family areas.',
                'image' => 'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?auto=format&fit=crop&w=1200&q=85',
                'sort_order' => 1,
            ],
            'timber' => [
                'name' => 'Timber',
                'short_description' => 'Premium natural and engineered timber flooring with timeless interior appeal.',
                'image' => 'https://images.unsplash.com/photo-1600210491369-e753d80a41f3?auto=format&fit=crop&w=1200&q=85',
                'sort_order' => 2,
            ],
            'hybrid-flooring' => [
                'name' => 'Hybrid Flooring',
                'short_description' => 'Durable timber-look hybrid flooring for modern homes and busy spaces.',
                'image' => 'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?auto=format&fit=crop&w=1200&q=85',
                'sort_order' => 3,
            ],
            'laminate' => [
                'name' => 'Laminate',
                'short_description' => 'Affordable, stylish and easy-care hard flooring for everyday living.',
                'image' => 'https://images.unsplash.com/photo-1616047006789-b7af5afb8c20?auto=format&fit=crop&w=1200&q=85',
                'sort_order' => 4,
            ],
            'vinyl' => [
                'name' => 'Vinyl',
                'short_description' => 'Water-resistant vinyl planks for kitchens, laundries, rentals and busy family zones.',
                'image' => 'https://images.unsplash.com/photo-1600573472591-ee6b68d14c68?auto=format&fit=crop&w=1200&q=85',
                'sort_order' => 5,
            ],
            'rugs' => [
                'name' => 'Rugs',
                'short_description' => 'Designer rugs and runners to complete warm, soft and premium interiors.',
                'image' => 'https://images.unsplash.com/photo-1600121848594-d8644e57abab?auto=format&fit=crop&w=1200&q=85',
                'sort_order' => 6,
            ],
        ];

        $saved = [];

        foreach ($categories as $slug => $data) {
            $category = ProductCategory::query()
                ->where('slug', $slug)
                ->first();

            if (!$category) {
                $category = new ProductCategory();
            }

            $payload = [
                'name' => $data['name'],
                'slug' => $slug,
                'parent_id' => null,
                'short_description' => $data['short_description'],
                'sort_order' => $data['sort_order'],
                'is_active' => true,
            ];

            if (Schema::hasColumn('product_categories', 'image')) {
                $payload['image'] = $data['image'];
            }

            if (Schema::hasColumn('product_categories', 'image_url')) {
                $payload['image_url'] = $data['image'];
            }

            $category->forceFill($this->onlyExistingColumns('product_categories', $payload));
            $category->save();

            $saved[$slug] = $category;
        }

        return $saved;
    }

    private function seedSizes(): array
    {
        $flooringSizes = [
            [
                'label' => 'Small Room',
                'sqm' => 10,
                'size_group' => 'Room Size',
                'sort_order' => 1,
            ],
            [
                'label' => 'Medium Room',
                'sqm' => 16,
                'size_group' => 'Room Size',
                'sort_order' => 2,
            ],
            [
                'label' => 'Large Room',
                'sqm' => 24,
                'size_group' => 'Room Size',
                'sort_order' => 3,
            ],
            [
                'label' => 'Open Plan Area',
                'sqm' => 36,
                'size_group' => 'Room Size',
                'sort_order' => 4,
            ],
        ];

        $rugSizes = [
            [
                'label' => 'Small Rug 160 x 230 cm',
                'sqm' => 3.68,
                'size_group' => 'Rug Size',
                'sort_order' => 10,
            ],
            [
                'label' => 'Medium Rug 200 x 300 cm',
                'sqm' => 6,
                'size_group' => 'Rug Size',
                'sort_order' => 11,
            ],
            [
                'label' => 'Large Rug 250 x 350 cm',
                'sqm' => 8.75,
                'size_group' => 'Rug Size',
                'sort_order' => 12,
            ],
            [
                'label' => 'Runner 80 x 300 cm',
                'sqm' => 2.4,
                'size_group' => 'Rug Size',
                'sort_order' => 13,
            ],
        ];

        return [
            'flooring' => $this->saveSizeSet($flooringSizes),
            'rug' => $this->saveSizeSet($rugSizes),
        ];
    }

    private function saveSizeSet(array $items): array
    {
        $saved = [];

        foreach ($items as $item) {
            $size = ProductSizeOption::query()
                ->where('label', $item['label'])
                ->first();

            if (!$size) {
                $size = new ProductSizeOption();
            }

            $payload = [
                'label' => $item['label'],
                'slug' => Str::slug($item['label']),
                'sqm' => $item['sqm'],
                'size_group' => $item['size_group'],
                'sort_order' => $item['sort_order'],
                'is_active' => true,
            ];

            $size->forceFill($this->onlyExistingColumns('product_size_options', $payload));
            $size->save();

            $saved[] = $size;
        }

        return $saved;
    }

    private function syncColours(ProductRange $product, array $colours): void
    {
        if (!Schema::hasTable('product_colours')) {
            return;
        }

        ProductColour::query()
            ->where('product_range_id', $product->id)
            ->delete();

        foreach ($colours as $index => $colour) {
            $payload = [
                'product_range_id' => $product->id,
                'name' => $colour['name'],
                'swatch' => $colour['swatch'],
                'colour_group' => $colour['group'],
                'sort_order' => $index + 1,
            ];

            $model = new ProductColour();
            $model->forceFill($this->onlyExistingColumns('product_colours', $payload));
            $model->save();
        }
    }

    private function syncPrices(ProductRange $product, array $sizes, float $basePrice): void
    {
        if (!Schema::hasTable('product_range_prices')) {
            return;
        }

        $sizeForeignKey = null;

        if (Schema::hasColumn('product_range_prices', 'product_size_option_id')) {
            $sizeForeignKey = 'product_size_option_id';
        }

        if (Schema::hasColumn('product_range_prices', 'size_option_id')) {
            $sizeForeignKey = 'size_option_id';
        }

        if (!$sizeForeignKey) {
            return;
        }

        ProductRangePrice::query()
            ->where('product_range_id', $product->id)
            ->delete();

        foreach ($sizes as $index => $size) {
            $price = round($basePrice + ($index * 8), 2);
            $regularPrice = round($price * 1.18, 2);

            $payload = [
                'product_range_id' => $product->id,
                $sizeForeignKey => $size->id,
                'price' => $price,
                'regular_price' => $regularPrice,
            ];

            $model = new ProductRangePrice();
            $model->forceFill($this->onlyExistingColumns('product_range_prices', $payload));
            $model->save();
        }
    }

    private function onlyExistingColumns(string $table, array $payload): array
    {
        return collect($payload)
            ->filter(fn ($value, $column) => Schema::hasColumn($table, $column))
            ->all();
    }

    private function shortDescription(string $categoryName, array $product): string
    {
        return "{$product['badge']} {$categoryName} for {$product['room']} spaces with premium colour options, practical performance and quote-ready pricing.";
    }

    private function description(string $categoryName, array $product, array $categoryData): string
    {
        return "{$product['name']} is a premium {$categoryName} product designed for {$product['room']} spaces. It gives customers a reliable balance of comfort, appearance and long-term performance while keeping the selection process simple and easy to understand.

This range is suitable for homeowners, renovation clients, rental upgrades and light commercial projects depending on the selected room and installation requirements. The colours are selected to work with modern interiors, warm neutral palettes and practical everyday living.

Customers can compare colour options, choose an area size and request a free measure and quote before final confirmation. Final pricing may depend on site measurement, subfloor preparation, underlay, installation complexity and product availability.

Key benefits include {$categoryData['benefit_line']}. This makes {$product['name']} a strong choice for customers who want a premium look without making the flooring decision complicated.";
    }

    private function catalogue(): array
    {
        return [
            'carpet' => [
                'name' => 'Carpet',
                'default_colour_group' => 'Neutral',
                'benefit_line' => 'soft underfoot comfort, acoustic warmth, bedroom-friendly texture and family-ready durability',
                'features' => [
                    'Soft underfoot comfort',
                    'Noise reducing finish',
                    'Bedroom friendly',
                    'Free measure and quote',
                ],
                'colours' => [
                    ['name' => 'Soft Cream', 'swatch' => '#E8DED0', 'group' => 'Cream'],
                    ['name' => 'Warm Beige', 'swatch' => '#C7B8A3', 'group' => 'Beige'],
                    ['name' => 'Stone Grey', 'swatch' => '#8B8882', 'group' => 'Grey'],
                    ['name' => 'Charcoal', 'swatch' => '#3D3A36', 'group' => 'Charcoal'],
                ],
                'gallery' => [
                    'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?auto=format&fit=crop&w=1200&q=85',
                    'https://images.unsplash.com/photo-1513694203232-719a280e022f?auto=format&fit=crop&w=1200&q=85',
                ],
                'products' => [
                    ['name' => 'Aston Plush Carpet', 'room' => 'Bedroom', 'badge' => 'Best for bedrooms', 'rating' => 4.9, 'base_price' => 42, 'image' => 'https://images.unsplash.com/photo-1513694203232-719a280e022f?auto=format&fit=crop&w=1000&q=85'],
                    ['name' => 'Windsor Wool Loop Carpet', 'room' => 'Living Room', 'badge' => 'Wool loop texture', 'rating' => 4.8, 'base_price' => 58, 'image' => 'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?auto=format&fit=crop&w=1000&q=85'],
                    ['name' => 'Urban Twist Carpet', 'room' => 'Hallway', 'badge' => 'Hard wearing', 'rating' => 4.7, 'base_price' => 49, 'image' => 'https://images.unsplash.com/photo-1600121848594-d8644e57abab?auto=format&fit=crop&w=1000&q=85'],
                    ['name' => 'Alpine Wool Blend Carpet', 'room' => 'Living Room', 'badge' => 'Quiet comfort', 'rating' => 5.0, 'base_price' => 67, 'image' => 'https://images.unsplash.com/photo-1600210492493-0946911123ea?auto=format&fit=crop&w=1000&q=85'],
                    ['name' => 'First Avenue Plush Carpet', 'room' => 'Bedroom', 'badge' => 'Soft plush feel', 'rating' => 4.9, 'base_price' => 45, 'image' => 'https://images.unsplash.com/photo-1616047006789-b7af5afb8c20?auto=format&fit=crop&w=1000&q=85'],
                    ['name' => 'Haven Soft Touch Carpet', 'room' => 'Bedroom', 'badge' => 'Luxury comfort', 'rating' => 4.8, 'base_price' => 52, 'image' => 'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?auto=format&fit=crop&w=1000&q=85'],
                    ['name' => 'Graphite Commercial Loop Carpet', 'room' => 'Commercial', 'badge' => 'Commercial fitout', 'rating' => 4.6, 'base_price' => 55, 'image' => 'https://images.unsplash.com/photo-1497366754035-f200968a6e72?auto=format&fit=crop&w=1000&q=85'],
                    ['name' => 'Meadow Textured Carpet', 'room' => 'Family Room', 'badge' => 'Textured finish', 'rating' => 4.7, 'base_price' => 47, 'image' => 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?auto=format&fit=crop&w=1000&q=85'],
                    ['name' => 'Hampton Cut Pile Carpet', 'room' => 'Bedroom', 'badge' => 'Premium pile', 'rating' => 4.8, 'base_price' => 61, 'image' => 'https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?auto=format&fit=crop&w=1000&q=85'],
                    ['name' => 'Nordic Wool Berber Carpet', 'room' => 'Living Room', 'badge' => 'Natural wool look', 'rating' => 4.9, 'base_price' => 72, 'image' => 'https://images.unsplash.com/photo-1600210491892-03d54c0aaf87?auto=format&fit=crop&w=1000&q=85'],
                ],
            ],

            'timber' => [
                'name' => 'Timber',
                'default_colour_group' => 'Natural Timber',
                'benefit_line' => 'natural grain detail, premium warmth, strong long-term appeal and timeless interior value',
                'features' => [
                    'Natural timber character',
                    'Premium interior finish',
                    'Long-term value',
                    'Free measure and quote',
                ],
                'colours' => [
                    ['name' => 'Natural Oak', 'swatch' => '#D2A86D', 'group' => 'Oak'],
                    ['name' => 'Blackbutt', 'swatch' => '#C79B62', 'group' => 'Blackbutt'],
                    ['name' => 'Spotted Gum', 'swatch' => '#9B6A3E', 'group' => 'Brown'],
                    ['name' => 'Walnut', 'swatch' => '#5A351F', 'group' => 'Walnut'],
                ],
                'gallery' => [
                    'https://images.unsplash.com/photo-1600210491369-e753d80a41f3?auto=format&fit=crop&w=1200&q=85',
                    'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?auto=format&fit=crop&w=1200&q=85',
                ],
                'products' => [
                    ['name' => 'Heritage Blackbutt Timber', 'room' => 'Living Room', 'badge' => 'Premium timber', 'rating' => 4.9, 'base_price' => 118, 'image' => 'https://images.unsplash.com/photo-1600210491369-e753d80a41f3?auto=format&fit=crop&w=1000&q=85'],
                    ['name' => 'Coastal Oak Engineered Timber', 'room' => 'Dining', 'badge' => 'Engineered oak', 'rating' => 4.8, 'base_price' => 105, 'image' => 'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?auto=format&fit=crop&w=1000&q=85'],
                    ['name' => 'Spotted Gum Select Timber', 'room' => 'Living Room', 'badge' => 'Australian look', 'rating' => 4.9, 'base_price' => 132, 'image' => 'https://images.unsplash.com/photo-1600607688969-a5bfcd646154?auto=format&fit=crop&w=1000&q=85'],
                    ['name' => 'Tasmanian Oak Classic Timber', 'room' => 'Bedroom', 'badge' => 'Classic oak tone', 'rating' => 4.7, 'base_price' => 112, 'image' => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?auto=format&fit=crop&w=1000&q=85'],
                    ['name' => 'European Oak Natural Timber', 'room' => 'Open Plan', 'badge' => 'Natural oak grain', 'rating' => 4.9, 'base_price' => 126, 'image' => 'https://images.unsplash.com/photo-1600585154526-990dced4db0d?auto=format&fit=crop&w=1000&q=85'],
                    ['name' => 'Walnut Luxe Timber', 'room' => 'Formal Lounge', 'badge' => 'Rich walnut finish', 'rating' => 4.8, 'base_price' => 145, 'image' => 'https://images.unsplash.com/photo-1600573472591-ee6b68d14c68?auto=format&fit=crop&w=1000&q=85'],
                    ['name' => 'Ashford Oak Timber', 'room' => 'Hallway', 'badge' => 'Bright oak style', 'rating' => 4.6, 'base_price' => 108, 'image' => 'https://images.unsplash.com/photo-1600607687644-aac4c3eac7f4?auto=format&fit=crop&w=1000&q=85'],
                    ['name' => 'Brighton Hickory Timber', 'room' => 'Living Room', 'badge' => 'Hickory character', 'rating' => 4.7, 'base_price' => 119, 'image' => 'https://images.unsplash.com/photo-1600047509807-ba8f99d2cdde?auto=format&fit=crop&w=1000&q=85'],
                    ['name' => 'Sierra Maple Timber', 'room' => 'Bedroom', 'badge' => 'Soft maple look', 'rating' => 4.6, 'base_price' => 102, 'image' => 'https://images.unsplash.com/photo-1600121848594-d8644e57abab?auto=format&fit=crop&w=1000&q=85'],
                    ['name' => 'Grand Oak Wideboard Timber', 'room' => 'Open Plan', 'badge' => 'Wideboard luxury', 'rating' => 5.0, 'base_price' => 155, 'image' => 'https://images.unsplash.com/photo-1616486029423-aaa4789e8c9a?auto=format&fit=crop&w=1000&q=85'],
                ],
            ],

            'hybrid-flooring' => [
                'name' => 'Hybrid Flooring',
                'default_colour_group' => 'Oak',
                'benefit_line' => 'water-resistant everyday practicality, strong wear performance and timber-look style',
                'features' => [
                    'Water resistant',
                    'Timber-look finish',
                    'Family friendly',
                    'Free measure and quote',
                ],
                'colours' => [
                    ['name' => 'Honey Oak', 'swatch' => '#D6A45F', 'group' => 'Oak'],
                    ['name' => 'Coastal Sand', 'swatch' => '#D8C7AA', 'group' => 'Beige'],
                    ['name' => 'Stone Grey', 'swatch' => '#8E8A82', 'group' => 'Grey'],
                    ['name' => 'Dark Walnut', 'swatch' => '#5C3822', 'group' => 'Walnut'],
                ],
                'gallery' => [
                    'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?auto=format&fit=crop&w=1200&q=85',
                    'https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?auto=format&fit=crop&w=1200&q=85',
                ],
                'products' => [
                    ['name' => 'Avenue Oak Hybrid Flooring', 'room' => 'Kitchen', 'badge' => 'Water resistant', 'rating' => 4.8, 'base_price' => 68, 'image' => 'https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?auto=format&fit=crop&w=1000&q=85'],
                    ['name' => 'Stonewash Grey Hybrid', 'room' => 'Hallway', 'badge' => 'Modern grey tone', 'rating' => 4.7, 'base_price' => 64, 'image' => 'https://images.unsplash.com/photo-1600573472591-ee6b68d14c68?auto=format&fit=crop&w=1000&q=85'],
                    ['name' => 'Blackbutt Hybrid Plank', 'room' => 'Living Room', 'badge' => 'Blackbutt look', 'rating' => 4.9, 'base_price' => 74, 'image' => 'https://images.unsplash.com/photo-1600566752355-35792bedcfea?auto=format&fit=crop&w=1000&q=85'],
                    ['name' => 'Coastal Sand Hybrid', 'room' => 'Open Plan', 'badge' => 'Light coastal finish', 'rating' => 4.8, 'base_price' => 70, 'image' => 'https://images.unsplash.com/photo-1600210492493-0946911123ea?auto=format&fit=crop&w=1000&q=85'],
                    ['name' => 'Urban Spotted Gum Hybrid', 'room' => 'Family Room', 'badge' => 'Busy home choice', 'rating' => 4.7, 'base_price' => 76, 'image' => 'https://images.unsplash.com/photo-1600566753376-12c8ab8e17a9?auto=format&fit=crop&w=1000&q=85'],
                    ['name' => 'Alpine Oak Hybrid', 'room' => 'Bedroom', 'badge' => 'Soft oak tone', 'rating' => 4.6, 'base_price' => 62, 'image' => 'https://images.unsplash.com/photo-1600047509358-9dc75507daeb?auto=format&fit=crop&w=1000&q=85'],
                    ['name' => 'Harbour Mist Hybrid', 'room' => 'Dining', 'badge' => 'Cool neutral look', 'rating' => 4.8, 'base_price' => 66, 'image' => 'https://images.unsplash.com/photo-1600607688960-e095ff83135c?auto=format&fit=crop&w=1000&q=85'],
                    ['name' => 'Riverstone Hybrid', 'room' => 'Kitchen', 'badge' => 'Practical finish', 'rating' => 4.7, 'base_price' => 69, 'image' => 'https://images.unsplash.com/photo-1600566753086-00f18fb6b3ea?auto=format&fit=crop&w=1000&q=85'],
                    ['name' => 'Classic Walnut Hybrid', 'room' => 'Living Room', 'badge' => 'Warm walnut look', 'rating' => 4.8, 'base_price' => 78, 'image' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1000&q=85'],
                    ['name' => 'Driftwood Hybrid Flooring', 'room' => 'Open Plan', 'badge' => 'Designer driftwood', 'rating' => 4.9, 'base_price' => 82, 'image' => 'https://images.unsplash.com/photo-1600566752447-f4b450270dc7?auto=format&fit=crop&w=1000&q=85'],
                ],
            ],

            'laminate' => [
                'name' => 'Laminate',
                'default_colour_group' => 'Grey',
                'benefit_line' => 'scratch-resistant everyday value, simple maintenance and attractive timber-look design',
                'features' => [
                    'Scratch resistant',
                    'Easy maintenance',
                    'Affordable style',
                    'Free measure and quote',
                ],
                'colours' => [
                    ['name' => 'Cool Grey', 'swatch' => '#C8C3B8', 'group' => 'Grey'],
                    ['name' => 'Ash Oak', 'swatch' => '#B8A98E', 'group' => 'Oak'],
                    ['name' => 'Honey Elm', 'swatch' => '#C88941', 'group' => 'Brown'],
                    ['name' => 'Charcoal Oak', 'swatch' => '#5C5750', 'group' => 'Charcoal'],
                ],
                'gallery' => [
                    'https://images.unsplash.com/photo-1616047006789-b7af5afb8c20?auto=format&fit=crop&w=1200&q=85',
                    'https://images.unsplash.com/photo-1600210491369-e753d80a41f3?auto=format&fit=crop&w=1200&q=85',
                ],
                'products' => [
                    ['name' => 'Metro Stone Laminate', 'room' => 'Hallway', 'badge' => 'Scratch resistant', 'rating' => 4.7, 'base_price' => 39, 'image' => 'https://images.unsplash.com/photo-1616137422495-1e9e46e2aa77?auto=format&fit=crop&w=1000&q=85'],
                    ['name' => 'Coastal Oak Laminate', 'room' => 'Dining', 'badge' => 'Family friendly', 'rating' => 4.8, 'base_price' => 45, 'image' => 'https://images.unsplash.com/photo-1600210491369-e753d80a41f3?auto=format&fit=crop&w=1000&q=85'],
                    ['name' => 'Nordic Ash Laminate', 'room' => 'Bedroom', 'badge' => 'Light ash finish', 'rating' => 4.6, 'base_price' => 42, 'image' => 'https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?auto=format&fit=crop&w=1000&q=85'],
                    ['name' => 'Urban Walnut Laminate', 'room' => 'Living Room', 'badge' => 'Warm walnut look', 'rating' => 4.7, 'base_price' => 48, 'image' => 'https://images.unsplash.com/photo-1600573472591-ee6b68d14c68?auto=format&fit=crop&w=1000&q=85'],
                    ['name' => 'Whitewash Oak Laminate', 'room' => 'Open Plan', 'badge' => 'Bright modern look', 'rating' => 4.6, 'base_price' => 44, 'image' => 'https://images.unsplash.com/photo-1600566753376-12c8ab8e17a9?auto=format&fit=crop&w=1000&q=85'],
                    ['name' => 'Charcoal Oak Laminate', 'room' => 'Apartment', 'badge' => 'Dark designer tone', 'rating' => 4.8, 'base_price' => 52, 'image' => 'https://images.unsplash.com/photo-1600566753086-00f18fb6b3ea?auto=format&fit=crop&w=1000&q=85'],
                    ['name' => 'Honey Elm Laminate', 'room' => 'Family Room', 'badge' => 'Warm elm style', 'rating' => 4.7, 'base_price' => 46, 'image' => 'https://images.unsplash.com/photo-1600607687644-aac4c3eac7f4?auto=format&fit=crop&w=1000&q=85'],
                    ['name' => 'Summit Grey Laminate', 'room' => 'Hallway', 'badge' => 'Cool grey finish', 'rating' => 4.6, 'base_price' => 41, 'image' => 'https://images.unsplash.com/photo-1600566752355-35792bedcfea?auto=format&fit=crop&w=1000&q=85'],
                    ['name' => 'Classic Beech Laminate', 'room' => 'Bedroom', 'badge' => 'Classic beech look', 'rating' => 4.5, 'base_price' => 38, 'image' => 'https://images.unsplash.com/photo-1600047509807-ba8f99d2cdde?auto=format&fit=crop&w=1000&q=85'],
                    ['name' => 'Highland Oak Laminate', 'room' => 'Living Room', 'badge' => 'Oak grain effect', 'rating' => 4.8, 'base_price' => 54, 'image' => 'https://images.unsplash.com/photo-1600121848594-d8644e57abab?auto=format&fit=crop&w=1000&q=85'],
                ],
            ],

            'vinyl' => [
                'name' => 'Vinyl',
                'default_colour_group' => 'Oak',
                'benefit_line' => 'water-resistant performance, easy cleaning, soft walking feel and practical family use',
                'features' => [
                    'Water resistant',
                    'Easy to clean',
                    'Comfortable underfoot',
                    'Free measure and quote',
                ],
                'colours' => [
                    ['name' => 'Natural Oak', 'swatch' => '#D1A15C', 'group' => 'Oak'],
                    ['name' => 'Soft Taupe', 'swatch' => '#9E8D7C', 'group' => 'Taupe'],
                    ['name' => 'Slate Grey', 'swatch' => '#6A6865', 'group' => 'Grey'],
                    ['name' => 'Charcoal', 'swatch' => '#2D2D2A', 'group' => 'Charcoal'],
                ],
                'gallery' => [
                    'https://images.unsplash.com/photo-1600573472591-ee6b68d14c68?auto=format&fit=crop&w=1200&q=85',
                    'https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?auto=format&fit=crop&w=1200&q=85',
                ],
                'products' => [
                    ['name' => 'Avenue Oak Vinyl Plank', 'room' => 'Kitchen', 'badge' => 'Water resistant', 'rating' => 4.8, 'base_price' => 54, 'image' => 'https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?auto=format&fit=crop&w=1000&q=85'],
                    ['name' => 'Urban Charcoal Vinyl', 'room' => 'Bathroom', 'badge' => 'Wet area choice', 'rating' => 4.8, 'base_price' => 52, 'image' => 'https://images.unsplash.com/photo-1600573472591-ee6b68d14c68?auto=format&fit=crop&w=1000&q=85'],
                    ['name' => 'Coastal Oak Vinyl', 'room' => 'Laundry', 'badge' => 'Coastal oak look', 'rating' => 4.7, 'base_price' => 49, 'image' => 'https://images.unsplash.com/photo-1600210492493-0946911123ea?auto=format&fit=crop&w=1000&q=85'],
                    ['name' => 'Stone Grey Vinyl', 'room' => 'Kitchen', 'badge' => 'Modern stone tone', 'rating' => 4.6, 'base_price' => 47, 'image' => 'https://images.unsplash.com/photo-1600566753086-00f18fb6b3ea?auto=format&fit=crop&w=1000&q=85'],
                    ['name' => 'Honey Oak Vinyl', 'room' => 'Family Room', 'badge' => 'Warm oak finish', 'rating' => 4.8, 'base_price' => 56, 'image' => 'https://images.unsplash.com/photo-1600566753376-12c8ab8e17a9?auto=format&fit=crop&w=1000&q=85'],
                    ['name' => 'Blackbutt Vinyl Plank', 'room' => 'Living Room', 'badge' => 'Blackbutt style', 'rating' => 4.9, 'base_price' => 61, 'image' => 'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?auto=format&fit=crop&w=1000&q=85'],
                    ['name' => 'Commercial Slate Vinyl', 'room' => 'Commercial', 'badge' => 'Commercial grade', 'rating' => 4.7, 'base_price' => 65, 'image' => 'https://images.unsplash.com/photo-1497366754035-f200968a6e72?auto=format&fit=crop&w=1000&q=85'],
                    ['name' => 'Natural Elm Vinyl', 'room' => 'Apartment', 'badge' => 'Natural elm look', 'rating' => 4.6, 'base_price' => 50, 'image' => 'https://images.unsplash.com/photo-1600047509358-9dc75507daeb?auto=format&fit=crop&w=1000&q=85'],
                    ['name' => 'Soft Taupe Vinyl', 'room' => 'Bedroom', 'badge' => 'Soft neutral tone', 'rating' => 4.7, 'base_price' => 48, 'image' => 'https://images.unsplash.com/photo-1600607688960-e095ff83135c?auto=format&fit=crop&w=1000&q=85'],
                    ['name' => 'Rustic Barn Oak Vinyl', 'room' => 'Open Plan', 'badge' => 'Rustic oak style', 'rating' => 4.9, 'base_price' => 68, 'image' => 'https://images.unsplash.com/photo-1600607688969-a5bfcd646154?auto=format&fit=crop&w=1000&q=85'],
                ],
            ],

            'rugs' => [
                'name' => 'Rugs',
                'default_colour_group' => 'Neutral',
                'benefit_line' => 'soft texture, decorative warmth, flexible styling and easy room refresh value',
                'features' => [
                    'Designer texture',
                    'Soft room styling',
                    'Easy room refresh',
                    'Free showroom guidance',
                ],
                'colours' => [
                    ['name' => 'Ivory', 'swatch' => '#EFE7DA', 'group' => 'Cream'],
                    ['name' => 'Natural Jute', 'swatch' => '#C8AD83', 'group' => 'Natural'],
                    ['name' => 'Warm Taupe', 'swatch' => '#9B8874', 'group' => 'Taupe'],
                    ['name' => 'Graphite', 'swatch' => '#494743', 'group' => 'Grey'],
                ],
                'gallery' => [
                    'https://images.unsplash.com/photo-1600121848594-d8644e57abab?auto=format&fit=crop&w=1200&q=85',
                    'https://images.unsplash.com/photo-1618220179428-22790b461013?auto=format&fit=crop&w=1200&q=85',
                ],
                'products' => [
                    ['name' => 'Retreat Weave Rug', 'room' => 'Living Room', 'badge' => 'Soft neutral rug', 'rating' => 4.8, 'base_price' => 220, 'image' => 'https://images.unsplash.com/photo-1600121848594-d8644e57abab?auto=format&fit=crop&w=1000&q=85'],
                    ['name' => 'Luna Wool Rug', 'room' => 'Bedroom', 'badge' => 'Premium wool rug', 'rating' => 4.9, 'base_price' => 280, 'image' => 'https://images.unsplash.com/photo-1618220179428-22790b461013?auto=format&fit=crop&w=1000&q=85'],
                    ['name' => 'Sahara Natural Rug', 'room' => 'Living Room', 'badge' => 'Natural texture', 'rating' => 4.7, 'base_price' => 190, 'image' => 'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?auto=format&fit=crop&w=1000&q=85'],
                    ['name' => 'Oslo Flatweave Rug', 'room' => 'Dining', 'badge' => 'Flatweave finish', 'rating' => 4.6, 'base_price' => 175, 'image' => 'https://images.unsplash.com/photo-1600210491892-03d54c0aaf87?auto=format&fit=crop&w=1000&q=85'],
                    ['name' => 'Cairo Textured Rug', 'room' => 'Bedroom', 'badge' => 'Textured comfort', 'rating' => 4.8, 'base_price' => 240, 'image' => 'https://images.unsplash.com/photo-1600210492493-0946911123ea?auto=format&fit=crop&w=1000&q=85'],
                    ['name' => 'Milano Modern Rug', 'room' => 'Apartment', 'badge' => 'Modern pattern', 'rating' => 4.7, 'base_price' => 260, 'image' => 'https://images.unsplash.com/photo-1616047006789-b7af5afb8c20?auto=format&fit=crop&w=1000&q=85'],
                    ['name' => 'Hampton Border Rug', 'room' => 'Formal Lounge', 'badge' => 'Border detail', 'rating' => 4.8, 'base_price' => 310, 'image' => 'https://images.unsplash.com/photo-1600566753376-12c8ab8e17a9?auto=format&fit=crop&w=1000&q=85'],
                    ['name' => 'Alpine Soft Rug', 'room' => 'Bedroom', 'badge' => 'Soft pile rug', 'rating' => 4.9, 'base_price' => 290, 'image' => 'https://images.unsplash.com/photo-1600566753086-00f18fb6b3ea?auto=format&fit=crop&w=1000&q=85'],
                    ['name' => 'Braided Jute Rug', 'room' => 'Entryway', 'badge' => 'Natural jute', 'rating' => 4.6, 'base_price' => 160, 'image' => 'https://images.unsplash.com/photo-1600607688960-e095ff83135c?auto=format&fit=crop&w=1000&q=85'],
                    ['name' => 'Graphite Runner Rug', 'room' => 'Hallway', 'badge' => 'Hallway runner', 'rating' => 4.7, 'base_price' => 140, 'image' => 'https://images.unsplash.com/photo-1600607688969-a5bfcd646154?auto=format&fit=crop&w=1000&q=85'],
                ],
            ],
        ];
    }
}