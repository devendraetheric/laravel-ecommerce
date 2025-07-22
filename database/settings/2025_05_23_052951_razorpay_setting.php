<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('payment_razorpay.is_active', false);
        $this->migrator->add('payment_razorpay.name', 'Razorpay');
        $this->migrator->add('payment_razorpay.description', 'Razorpay payment gateway');
        $this->migrator->add('payment_razorpay.client_id', '');
        $this->migrator->add('payment_razorpay.client_secret', '');
    }
};
