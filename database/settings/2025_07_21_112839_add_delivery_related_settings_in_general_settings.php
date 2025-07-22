<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.is_tax_inclusive', false);
        $this->migrator->add('general.delivery_charge', 0);
        $this->migrator->add('general.free_delivery_zipcode', null);
    }
    public function down(): void
    {
        $this->migrator->delete('general.is_tax_inclusive');
        $this->migrator->delete('general.delivery_charge');
        $this->migrator->delete('general.free_delivery_zipcode');
    }
};
