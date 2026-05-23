<?php

namespace App\Enums\Admin;

enum PageTypeEnum: string
{
    case ALL    = 'all';
    case HEADER = 'header';
    case FOOTER = 'footer';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function options(): array
    {
        return [
            self::ALL->value => 'الكل',
            self::HEADER->value => 'الاعلي',
            self::FOOTER->value => 'الاسفل',
        ];
    }//end of fun

}//end of enum