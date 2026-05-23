<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    public function run(): void
    {
        setting('about')->save([
            'status'      => true,
            'image'       => null,
            'stat_number' => '15+',
            'badge'       => [
                'ar' => 'إرثنا',
                'en' => 'Our Legacy',
            ],
            'title'       => [
                'ar' => 'نرفع معايير الأعمال في كل أنحاء المملكة.',
                'en' => 'Elevating Business Standards Across the Kingdom.',
            ],
            'description' => [
                'ar' => 'ديجي بيزنس ليست مجرد شركة استشارية؛ نحن قوة معمارية في النظام البيئي الرقمي للشرق الأوسط. نتخصص في تحويل الشركات الراسخة والشركات الناشئة الطموحة إلى رواد رقميين من خلال الجمع بين الابتكار العالمي والرؤى الثقافية المحلية العميقة.',
                'en' => 'Digi Business isn\'t just a consultancy; we are an architectural force in the digital ecosystem of the Middle East. We specialize in transforming established businesses and ambitious startups into digital leaders by blending global innovation with deep local cultural insights.',
            ],
            'stat_label'  => [
                'ar' => 'سنوات من التميز الإقليمي',
                'en' => 'Years of Regional Excellence',
            ],
            'learn_more'  => [
                'ar' => 'تعرّف أكثر على مهمتنا',
                'en' => 'Learn More About Our Mission',
            ],
            'highlights'  => [
                [
                    'title'       => [
                        'ar' => 'متوافقون مع رؤية 2030',
                        'en' => 'Vision 2030 Aligned',
                    ],
                    'description' => [
                        'ar' => 'ندعم أهداف التنويع الاقتصادي للمملكة.',
                        'en' => 'Supporting the Kingdom\'s economic diversification goals.',
                    ],
                ],
                [
                    'title'       => [
                        'ar' => 'شبكة إقليمية واسعة',
                        'en' => 'Regional Network',
                    ],
                    'description' => [
                        'ar' => 'انتشار عالمي مع مكاتب في الرياض ودبي والكويت.',
                        'en' => 'Global reach with offices in Riyadh, Dubai, and Kuwait.',
                    ],
                ],
            ],
        ]);
    }
}
