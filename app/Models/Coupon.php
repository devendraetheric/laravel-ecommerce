<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'code',
        'description',
        'type',
        'value',
        'start_date',
        'end_date',
        'total_quantity',
        'use_per_user',
        'used_quantity',
        'max_discount_value',
        'min_cart_value',
        'max_cart_value',
        'is_for_new_user',
    ];


    protected $perPage = 10;

    protected $casts = [
        'start_date'   => 'date:Y-m-d',
        'end_date'     => 'date:Y-m-d',
    ];
}
