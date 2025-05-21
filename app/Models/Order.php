<?php

namespace App\Models;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Settings\PrefixSetting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Order extends Model
{
    protected $fillable = [
        'order_number',
        'order_date',
        'user_id',
        'status',
        'sub_total',
        'delivery_charge',
        'grand_total',
        'payment_method',
        'payment_status',
        'notes'
    ];

    protected $casts = [
        'status'          => OrderStatus::class,
        'payment_status'  => PaymentStatus::class,
        'sub_total'       => 'decimal:2',
        'delivery_charge' => 'decimal:2',
        'grand_total'     => 'decimal:2',
        'paid_amount'     => 'decimal:2',
        'order_date'      => 'date:Y-m-d'
    ];

    public static function generateOrderNumber(): string
    {
        return setting('prefix.order_prefix') . str_pad(setting('prefix.order_sequence'), setting('prefix.order_digit_length'), '0', STR_PAD_LEFT);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function address(): MorphOne
    {
        return $this->morphOne(Address::class, "addressable");
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
