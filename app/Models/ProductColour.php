<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductColour extends Model
{
    protected $fillable = [
        'product_range_id',
        'name',
        'swatch',
        'colour_group',
        'sort_order',
    ];

    public function range(): BelongsTo
    {
        return $this->belongsTo(ProductRange::class, 'product_range_id');
    }
}