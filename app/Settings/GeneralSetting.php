<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSetting extends Settings
{
    public string $app_name;

    public string $site_name;

    public ?string $tagline;

    public string $site_description;

    public string $date_format;

    public string $time_format;

    public string $timezone;

    public ?string $admin_emails;

    public bool $is_captcha;

    public ?string $captcha_secret_key;

    public ?string $captcha_site_key;

    public ?string $logo;

    public ?string $favicon;

    public ?string $analytics_code;

    public bool $is_tax_inclusive = false;

    public int $delivery_charge;

    public ?string $free_delivery_zipcode;

    public static function group(): string
    {
        return 'general';
    }
}
