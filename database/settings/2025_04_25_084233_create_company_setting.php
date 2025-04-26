<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('company.name', config('app.name'));
        $this->migrator->add('company.email', config('app.name'));
        $this->migrator->add('company.phone', config('app.name'));
        $this->migrator->add('company.website', config('app.name'));
        $this->migrator->add('company.address', config('app.name'));
        $this->migrator->add('company.country', '233');
        $this->migrator->add('company.state', '1460');
        $this->migrator->add('company.city', config('app.name'));
        $this->migrator->add('company.zipcode', config('app.name'));
    }
};
