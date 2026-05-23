<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GeneralSeeder extends Seeder
{
    public function run(): void
    {
        setting('general')->save([
            'name'  => [
                'ar' => 'ديجي بيزنس',
                'en' => 'Digi Business',
            ],
            'about' => [
                'ar' => 'نعيد تعريف الحدود الرقمية لمنطقة الخليج من خلال التميز الاستراتيجي والابتكار.',
                'en' => 'Redefining the digital frontier of the Gulf through strategic excellence and innovation.',
            ],
            'phone'     => '+966 50 000 0000',
            'email'     => 'info@digibusiness.sa',
            'copyright' => [
                'ar' => 'جميع الحقوق محفوظة. المقر الرئيسي: الرياض، المملكة العربية السعودية.',
                'en' => 'All rights reserved. Headquarters: Riyadh, KSA.',
            ],
        ]);
    }
}
