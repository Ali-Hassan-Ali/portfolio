<?php

namespace App\Enums;

enum ContactTypeEnum: string
{
    case RFQ   = 'rfq';
    case QUICK = 'quick';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
