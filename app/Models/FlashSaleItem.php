<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FlashSaleItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'flash_sale_id', 'product_id', 'status', 'home_carousel'
    ];

    public function flash_sale(): BelongsTo
    {
        return $this->belongsTo(FlashSale::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class)->with('images','category','brand','variants');
    }

    public function scopeActive(Builder $query)
    {
        return $query->with('product')->where('status', 1);
    }

    public function scopeHomeCarousel(Builder $query)
    {
        return $query->active()->where('home_carousel', 1);
    }
}
