<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('company.name', config('app.name'));
        $this->migrator->add('company.email', '');
        $this->migrator->add('company.phone', '');
        $this->migrator->add('company.website', '');
        $this->migrator->add('company.address', '');
        $this->migrator->add('company.country', '233');
        $this->migrator->add('company.state', '');
        $this->migrator->add('company.city', '');
        $this->migrator->add('company.zipcode', '');
    }
};
