<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'meta_title',
        'meta_description',
        'image',
        'vendor_id',
        'category_id',
        'brand_id',
        'qty',
        'short_description',
        'long_description',
        'video_link',
        'sku',
        'price',
        'offer_price',
        'offer_start_date',
        'offer_end_date',
        'is_top',
        'is_best',
        'is_featured',
        'status',
        'approved'
    ];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImageGallery::class);
    }

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function flashSale(): HasOne
    {
        return $this->hasOne(FlashSaleItem::class);
    }

    public function scopeActive(Builder $query)
    {
        return $query->where('status', 1);
    }

    public function scopeApproved(Builder $query)
    {
        return $query->where('approved', 1);
    }

    public function scopeTop(Builder $query)
    {
        return $query->where('is_top', 1);
    }

    public function scopeBest(Builder $query)
    {
        return $query->where('is_best', 1);
    }

    public function scopeFeatured(Builder $query)
    {
        return $query->where('is_featured', 1);
    }

    public function scopeOffer(Builder $query, $from = null, $to = null)
    {
        if($from && $to) {
            $query->where('offer_start_date', '>=', $from);
            $query->where('offer_end_date', '<=', $to);
        }

        return $query->where('offer_price', '>', 0);
    }
}
