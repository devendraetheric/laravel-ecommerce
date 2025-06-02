<?php

namespace App\Enums;

enum TaxType: string
{
    case VAT     = 'VAT';
    case IGST    = 'IGST';
    case CGST    = 'CGST';
    case SGST    = 'SGST';

    public function label(): string
    {
        return match ($this) {
            self::VAT       => 'VAT',
            self::IGST      => 'IGST',
            self::CGST      => 'CGST',
            self::SGST      => 'SGST',
        };
    }
}
