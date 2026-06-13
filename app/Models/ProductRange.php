<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class ProductRange extends Model
{
    protected $fillable = [
        'category_id',
        'subcategory_id',
        'name',
        'slug',
        'badge',
        'short_description',
        'description',
        'main_image',
        'gallery',
        'features',
        'rating',
        'unit',
        'colour_group',
        'size_group',
        'room',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'gallery' => 'array',
        'features' => 'array',
        'rating' => 'decimal:1',
        'is_active' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'subcategory_id');
    }

    public function colours(): HasMany
    {
        return $this->hasMany(ProductColour::class)->orderBy('sort_order')->orderBy('name');
    }

    public function prices(): HasMany
    {
        return $this->hasMany(ProductRangePrice::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function priceFrom(): float
    {
        return (float) ($this->prices()->min('price') ?? 0);
    }

    public function imageUrl(): string
    {
        return $this->mediaUrl($this->main_image)
            ?: 'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?auto=format&fit=crop&w=900&q=80';
    }

    public function galleryImages(): array
    {
        $gallery = collect($this->gallery ?: [])
            ->map(fn ($image) => $this->mediaUrl($image))
            ->filter()
            ->values()
            ->all();

        if (!count($gallery)) {
            $gallery = [$this->imageUrl()];
        }

        return $gallery;
    }

    public function featureList(): array
    {
        return array_values($this->features ?: [
            'Free measure & quote available',
            'Premium showroom support',
            'Suitable for residential projects',
            'Professional installation advice',
        ]);
    }

    private function mediaUrl(?string $path): ?string
    {
        if (!$path) {
            return null;
        }

        if (Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }

        if (Str::startsWith($path, ['/storage/', 'storage/'])) {
            return asset(ltrim($path, '/'));
        }

        return asset('storage/' . ltrim($path, '/'));
    }

    public function toFrontendArray(): array
    {
        $this->loadMissing([
            'category',
            'subcategory',
            'colours',
            'prices.sizeOption',
        ]);

        $sizes = $this->prices
            ->filter(fn ($price) => $price->sizeOption && $price->sizeOption->is_active)
            ->sortBy(fn ($price) => $price->sizeOption->sort_order)
            ->values()
            ->map(function ($price) {
                return [
                    'id' => $price->sizeOption->id,
                    'label' => $price->sizeOption->label,
                    'sqm' => (float) $price->sizeOption->sqm,
                    'size_group' => $price->sizeOption->size_group,
                    'price' => (float) $price->price,
                    'regular' => (float) ($price->regular_price ?: $price->price),
                ];
            })
            ->values()
            ->all();

        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'name' => $this->name,
            'badge' => $this->badge,
            'category' => $this->category?->name ?: '',
            'category_slug' => $this->category?->slug ?: '',
            'subcategory' => $this->subcategory?->name,
            'subcategory_slug' => $this->subcategory?->slug,
            'short' => $this->short_description ?: '',
            'description' => $this->description ?: $this->short_description ?: '',
            'image' => $this->imageUrl(),
            'gallery' => $this->galleryImages(),
            'features' => $this->featureList(),
            'rating' => (float) $this->rating,
            'unit' => $this->unit,
            'price_from' => $this->priceFrom(),
            'colour_group' => $this->colour_group,
            'size_group' => $this->size_group,
            'room' => $this->room,
            'colours' => $this->colours
                ->map(fn ($colour) => [
                    'id' => $colour->id,
                    'name' => $colour->name,
                    'swatch' => $colour->swatch,
                    'colour_group' => $colour->colour_group,
                ])
                ->values()
                ->all(),
            'sizes' => $sizes,
            'search' => strtolower(trim(
                $this->name . ' ' .
                $this->short_description . ' ' .
                $this->category?->name . ' ' .
                $this->subcategory?->name . ' ' .
                $this->room . ' ' .
                $this->colour_group
            )),
        ];
    }
}