<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('payment_paypal.is_active', false);
        $this->migrator->add('payment_paypal.name', 'Paypal');
        $this->migrator->add('payment_paypal.description', 'Paypal payment gateway');
        $this->migrator->add('payment_paypal.is_live', false);
        $this->migrator->add('payment_paypal.client_id', '');
        $this->migrator->add('payment_paypal.client_secret', '');
    }
};
