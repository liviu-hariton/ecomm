<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_name',
        'layout',
        'contact_email',
        'currency_name',
        'currency_icon',
        'timezone'
    ];
}
