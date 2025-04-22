<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.app_name', config('app.name'));
        $this->migrator->add('general.site_name', config('app.name'));
        $this->migrator->add('general.site_description', config('app.name'));

        $this->migrator->add('general.date_format', 'd/m/Y');
        $this->migrator->add('general.time_format', 'H:i');
        $this->migrator->add('general.timezone', 'UTC');
    }
};
