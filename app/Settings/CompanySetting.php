<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class CompanySetting extends Settings
{
    public string $name;

    public string $email;

    public string $phone;

    public string $website;

    public string $address;

    public string $country;

    public string $state;

    public string $city;

    public string $zipcode;


    public static function group(): string
    {
        return 'company';
    }
}
