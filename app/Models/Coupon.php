<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'code', 'qty', 'max_use', 'usages', 'start_date', 'end_date', 'discount_type', 'discount_amount', 'status'
    ];
}
