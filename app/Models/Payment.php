<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $fillable = [
        'payment_number',
        'order_id',
        'reference',
        'amount',
        'method',
        'notes',
    ];


    protected $perPage = 10;


    public static function generatePaymentNumber(): string
    {
        return 'PAY-' . strtoupper(random_int(10000, 99999));
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
