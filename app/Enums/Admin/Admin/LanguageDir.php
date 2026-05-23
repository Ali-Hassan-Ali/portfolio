<?php

namespace App\Enums\Admin;

enum LanguageDir: string
{
    case LTR = 'LTR';
    case RTL = 'RTL';

    public static function array(): array
    {
    	return [
    		'LTR' => trans('admin.managements.languages.ltr'),
    		'RTL' => trans('admin.managements.languages.rtl'),
    	];

    }//end of fun

}//end of enum