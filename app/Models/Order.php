<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id','user_id','subtotal','amount','currency_name','currency_icon','product_qty','payment_method','payment_status','order_address','shipping_method','coupon','order_status'
    ];

    public function products(): HasMany
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function transaction(): HasOne
    {
        return $this->hasOne(Transaction::class);
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function shippingAddress()
    {
        return json_decode($this->order_address);
    }

    public function shippingMethod()
    {
        return json_decode($this->shipping_method);
    }

    public function coupon()
    {
        return json_decode($this->coupon);
    }
}
