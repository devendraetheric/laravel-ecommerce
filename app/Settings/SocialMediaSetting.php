<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class SocialMediaSetting extends Settings
{
    public string $facebook;

    public string $instagram;

    public string $youtube;

    public string $twitter;

    public static function group(): string
    {
        return 'social_media';
    }
}
