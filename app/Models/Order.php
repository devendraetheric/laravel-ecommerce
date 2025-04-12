<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'order_number',
        'order_date',
        'user_id',
        'status',
        'sub_total',
        'grand_total',
        'payment_method',
        'payment_status',
        'notes'
    ];

    protected $casts = [
        'status'        => OrderStatus::class,
        'sub_total'     => 'decimal:2',
        'grand_total'   => 'decimal:2',
        'order_date'    => 'date:Y-m-d'
    ];

    public static function generateOrderNumber(): string
    {
        return 'ORD-' . strtoupper(random_int(10000, 99999));
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
