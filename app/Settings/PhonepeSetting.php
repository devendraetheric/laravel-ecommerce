<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class PhonepeSetting extends Settings
{
    public bool $is_active = false;

    public bool $is_live = false;

    public string $name = 'Phonepe';

    public string $description = 'Phonepe payment gateway';

    public ?string $client_id;

    public ?string $client_secret;

    public int $client_version = 1;

    public static function group(): string
    {
        return 'payment_phonepe';
    }
}
