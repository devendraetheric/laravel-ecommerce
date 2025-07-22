<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class PaypalSetting extends Settings
{
    public bool $is_active = false;

    public bool $is_live = false;

    public string $name = 'Paypal';

    public string $description = 'Paypal payment gateway';

    public ?string $client_id;

    public ?string $client_secret;

    public static function group(): string
    {
        return 'payment_paypal';
    }
}
