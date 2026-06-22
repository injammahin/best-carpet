<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductGalleryImage extends Model
{
    protected $fillable = [
        'product_range_id',
        'image',
        'colour_name',
        'sort_order',
    ];

    public function productRange()
    {
        return $this->belongsTo(ProductRange::class);
    }

    public function imageUrl(): string
    {
        if (!$this->image) {
            return asset('images/Background Pic 1.webp');
        }

        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }

        if (Str::startsWith($this->image, ['/storage/', 'storage/'])) {
            return asset(ltrim($this->image, '/'));
        }

        return Storage::disk('public')->url($this->image);
    }
}