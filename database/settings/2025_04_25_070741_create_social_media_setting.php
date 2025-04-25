<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {

        $this->migrator->add('social_media.facebook', config('app.name'));
        $this->migrator->add('social_media.instagram', config('app.name'));
        $this->migrator->add('social_media.youtube', config('app.name'));
        $this->migrator->add('social_media.twitter', config('app.name'));

    }
};
