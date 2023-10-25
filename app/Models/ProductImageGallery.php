<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductImageGallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 'vendor_id', 'image', 'title', 'alt', 'sort_order', 'status'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
