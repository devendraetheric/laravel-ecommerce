<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {

        $this->migrator->add('prefix.order_prefix', 'ORD-');
        $this->migrator->add('prefix.order_digit_length', 5);
        $this->migrator->add('prefix.order_sequence', 1);
    }
};
