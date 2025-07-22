<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('payment_phonepe.is_active', false);
        $this->migrator->add('payment_phonepe.name', 'Phonepe');
        $this->migrator->add('payment_phonepe.description', 'Phonepe payment gateway');
        $this->migrator->add('payment_phonepe.is_live', false);
        $this->migrator->add('payment_phonepe.client_id', '');
        $this->migrator->add('payment_phonepe.client_secret', '');
        $this->migrator->add('payment_phonepe.client_version', 1);
    }
};
