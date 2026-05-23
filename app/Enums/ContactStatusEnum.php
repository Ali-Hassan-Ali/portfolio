<?php

namespace App\Enums;

enum ContactStatusEnum: string
{
    case NEW     = 'new';
    case READ    = 'read';
    case REPLIED = 'replied';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
