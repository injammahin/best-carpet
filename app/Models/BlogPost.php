<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogPost extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'meta_title',
        'meta_description',
        'status',
        'is_featured',
        'published_at',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function scopePublished($query)
    {
        return $query
            ->where('status', 'published')
            ->where(function ($subQuery) {
                $subQuery
                    ->whereNull('published_at')
                    ->orWhere('published_at', '<=', now());
            });
    }

    public function imageUrl(): string
    {
        if (!$this->featured_image) {
            return asset('images/Background Pic 1.webp');
        }

        if (Str::startsWith($this->featured_image, ['http://', 'https://'])) {
            return $this->featured_image;
        }

        if (Str::startsWith($this->featured_image, ['/storage/', 'storage/'])) {
            return asset(ltrim($this->featured_image, '/'));
        }

        if (Str::startsWith($this->featured_image, ['/images/', 'images/'])) {
            return asset(ltrim($this->featured_image, '/'));
        }

        return Storage::disk('public')->url($this->featured_image);
    }

    public function excerptText(): string
    {
        return $this->excerpt ?: Str::limit(strip_tags($this->content), 170);
    }
}