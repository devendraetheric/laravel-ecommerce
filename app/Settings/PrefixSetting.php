<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class PrefixSetting extends Settings
{
    public string $order_prefix;

    public string $order_digit_length;

    public string $order_sequence;

    public string $payment_prefix;

    public string $payment_digit_length;

    public string $payment_sequence;


    public static function group(): string
    {
        return 'prefix';
    }
}
