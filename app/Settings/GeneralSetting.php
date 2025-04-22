<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSetting extends Settings
{
    public string $app_name;

    public string $site_name;

    public string $site_description;

    public string $date_format;

    public string $time_format;

    public string $timezone;

    public static function group(): string
    {
        return 'general';
    }
}
