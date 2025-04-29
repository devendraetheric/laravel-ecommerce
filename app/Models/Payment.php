<?php

namespace App\Models;

use App\Settings\PrefixSetting;
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
        /* return 'PAY-' . strtoupper(random_int(10000, 99999)); */

        $settings = app(PrefixSetting::class);

        return $settings->payment_prefix . str_pad($settings->payment_sequence, $settings->payment_digit_length, '0', STR_PAD_LEFT);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
