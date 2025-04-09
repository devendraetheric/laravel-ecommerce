<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    protected $fillable = [
        'order_number',
        'user_id',
        'status',
        'sub_total',
        'grand_total',
        'payment_method',
        'payment_status',
    ];

    protected $casts = [
        'sub_total' => 'decimal:2',
        'grand_total' => 'decimal:2',
    ];

    public static function generateOrderNumber(): string
    {
        return 'ORD-' . strtoupper(random_int(10000, 99999));
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
