<?php

namespace App\Enums;

enum PaymentType: string
{
    case CASH         = 'cash';
    case CHECK        = 'check';
    case BANKTRANSFER = 'bank-transfer';

    public function label(): string
    {
        return match ($this) {
            self::CASH          => 'Cash',
            self::CHECK         => 'Check',
            self::BANKTRANSFER  => 'Bank Transfer',
        };
    }
}
