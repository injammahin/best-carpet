<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
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
        'base_price',
        'selected_size_option_ids',
        'price_mode',
        'colour_group',
        'size_group',
        'room',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'gallery' => 'array',
        'features' => 'array',
        'selected_size_option_ids' => 'array',
        'is_active' => 'boolean',
        'base_price' => 'decimal:2',
        'rating' => 'decimal:1',
    ];

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(ProductCategory::class, 'subcategory_id');
    }

    public function galleryImages()
    {
        return $this->hasMany(ProductGalleryImage::class, 'product_range_id')
            ->orderBy('sort_order')
            ->orderBy('id');
    }

    /*
    |--------------------------------------------------------------------------
    | Old relationships kept for safety
    |--------------------------------------------------------------------------
    | These are not used in the new pricing flow, but keeping them prevents
    | old admin/frontend code from breaking if any file still references them.
    */

    public function colours()
    {
        return $this->hasMany(ProductColour::class, 'product_range_id')
            ->orderBy('sort_order')
            ->orderBy('id');
    }

    public function prices()
    {
        return $this->hasMany(ProductRangePrice::class, 'product_range_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    public function imageUrl(): string
    {
        if (!$this->main_image) {
            return asset('images/Background Pic 1.webp');
        }

        if (Str::startsWith($this->main_image, ['http://', 'https://'])) {
            return $this->main_image;
        }

        if (Str::startsWith($this->main_image, ['/storage/', 'storage/'])) {
            return asset(ltrim($this->main_image, '/'));
        }

        if (Str::startsWith($this->main_image, ['/images/', 'images/'])) {
            return asset(ltrim($this->main_image, '/'));
        }

        return Storage::disk('public')->url($this->main_image);
    }

    public function isRug(): bool
    {
        return $this->price_mode === 'fixed'
            || $this->category?->slug === 'rugs'
            || $this->subcategory?->slug === 'rugs';
    }

    public function priceFrom(): float
    {
        return (float) ($this->base_price ?? 0);
    }

    public function displayUnit(): string
    {
        return $this->isRug() ? 'item' : ($this->unit ?: 'm²');
    }

    public function selectedSizeOptions()
    {
        $ids = collect($this->selected_size_option_ids ?: [])
            ->filter()
            ->map(fn ($id) => (int) $id)
            ->unique()
            ->values()
            ->all();

        if (!count($ids)) {
            return collect();
        }

        return ProductSizeOption::query()
            ->whereIn('id', $ids)
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('sqm')
            ->get();
    }

    public function frontendSizes(): array
    {
        if ($this->isRug()) {
            return [];
        }

        $basePrice = (float) ($this->base_price ?? 0);

        return $this->selectedSizeOptions()
            ->map(function ($size) use ($basePrice) {
                $sqm = (float) $size->sqm;

                return [
                    'id' => $size->id,
                    'label' => $size->label,
                    'sqm' => $sqm,
                    'size_group' => $size->size_group,
                    'price' => round($basePrice * $sqm, 2),
                    'price_per_sqm' => $basePrice,
                ];
            })
            ->values()
            ->all();
    }

    public function frontendGallery(): array
    {
        $gallery = collect();

        if ($this->main_image) {
            $gallery->push([
                'image' => $this->imageUrl(),
                'colour_name' => 'Main image',
            ]);
        }

        foreach ($this->galleryImages as $item) {
            $gallery->push([
                'image' => $item->imageUrl(),
                'colour_name' => $item->colour_name ?: 'Gallery image',
            ]);
        }

        if (!$gallery->count()) {
            $gallery->push([
                'image' => asset('images/Background Pic 1.webp'),
                'colour_name' => 'Gallery image',
            ]);
        }

        return $gallery->values()->all();
    }
}