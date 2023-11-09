<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StripeSettings extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id', 'secret_key', 'status', 'mode', 'country', 'currency', 'currency_rate'
    ];
}
