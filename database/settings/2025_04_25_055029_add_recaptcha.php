<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.is_captcha', false);
        $this->migrator->add('general.captcha_secret_key', config('app.name'));
        $this->migrator->add('general.captcha_site_key', config('app.name'));
    }
};
