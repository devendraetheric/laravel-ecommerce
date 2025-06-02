<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class RazorpaySetting extends Settings
{
    public bool $is_active = false;

    public string $name = 'Razorpay';

    public string $description = 'Razorpay payment gateway';

    public ?string $client_id;

    public ?string $client_secret;

    public static function group(): string
    {
        return 'payment_razorpay';
    }
}
