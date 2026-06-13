<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductSizeOption extends Model
{
    protected $fillable = [
        'label',
        'sqm',
        'size_group',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'sqm' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function prices(): HasMany
    {
        return $this->hasMany(ProductRangePrice::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}