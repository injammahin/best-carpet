<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductRangePrice extends Model
{
    protected $fillable = [
        'product_range_id',
        'product_size_option_id',
        'price',
        'regular_price',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'regular_price' => 'decimal:2',
    ];

    public function range(): BelongsTo
    {
        return $this->belongsTo(ProductRange::class, 'product_range_id');
    }

    public function sizeOption(): BelongsTo
    {
        return $this->belongsTo(ProductSizeOption::class, 'product_size_option_id');
    }
}