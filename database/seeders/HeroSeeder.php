<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class HeroSeeder extends Seeder
{
    public function run(): void
    {
        setting('hero')->save([
            'status'    => true,
            'badge'     => [
                'ar' => 'حلول رقمية متكاملة',
                'en' => 'Sovereign Kinetic Solutions',
            ],
            'title'     => [
                'ar' => 'شريكك الاستراتيجي للنمو الرقمي في المملكة والخليج.',
                'en' => 'Your Strategic Partner for Digital Growth in the Kingdom and Gulf.',
            ],
            'sub_title' => [
                'ar' => 'حلول B2B متكاملة في التسويق وتطوير الويب والاستشارات. مصممة خصيصًا للبيئة الحديثة.',
                'en' => 'Integrated B2B solutions for Marketing, Web Dev, and Business Consultancy. Tailored for the modern landscape.',
            ],
            'features'  => [
                [
                    'icon'        => 'rocket_launch',
                    'title'       => [
                        'ar' => 'تسريع النمو',
                        'en' => 'Growth Acceleration',
                    ],
                    'description' => [
                        'ar' => 'خرائط طريق استراتيجية للأسواق المحلية',
                        'en' => 'Strategic roadmaps for local markets',
                    ],
                ],
                [
                    'icon'        => 'bar_chart',
                    'title'       => [
                        'ar' => 'رؤى البيانات',
                        'en' => 'Data Insights',
                    ],
                    'description' => [
                        'ar' => 'تحليلات دقيقة للمؤسسات الخليجية',
                        'en' => 'Precision analytics for Gulf enterprises',
                    ],
                ],
                [
                    'icon'        => 'star',
                    'title'       => [
                        'ar' => 'هيمنة السوق',
                        'en' => 'Market Dominance',
                    ],
                    'description' => [
                        'ar' => 'حقق ميزة تنافسية مستدامة',
                        'en' => 'Achieve sustainable competitive advantage',
                    ],
                ],
            ],
        ]);
    }
}
