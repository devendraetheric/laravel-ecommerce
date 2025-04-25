<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('prefix.payment_prefix', 'PAY-');
        $this->migrator->add('prefix.payment_digit_length', 5);
        $this->migrator->add('prefix.payment_sequence', 1);
    }
};
