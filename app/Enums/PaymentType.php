<?php

namespace App\Enums;

enum PaymentType: string
{
    case CASH         = 'cash';
    case CHECK        = 'check';
    case BANKTRANSFER = 'bank-transfer';
    case PHONEPE        = 'PhonePe';

    public function label(): string
    {
        return match ($this) {
            self::CASH          => 'Cash',
            self::CHECK         => 'Check',
            self::BANKTRANSFER  => 'Bank Transfer',
            self::PHONEPE       => 'Phone Pe',
        };
    }
}
