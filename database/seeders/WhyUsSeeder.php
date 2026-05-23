<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class WhyUsSeeder extends Seeder
{
    public function run(): void
    {
        setting('why_us')->save([
            'status'      => true,
            'title'       => [
                'ar' => 'ميزتنا التنافسية.',
                'en' => 'The Sovereign Advantage.',
            ],
            'description' => [
                'ar' => 'لا نقدم خدمات فحسب؛ نقدم ميزة تنافسية تقوم على ثلاث ركائز أساسية.',
                'en' => 'We don\'t just provide services; we provide a competitive edge defined by three core pillars.',
            ],
            'pillars'     => [
                [
                    'title'       => ['ar' => 'إتقان إقليمي', 'en' => 'Regional Fluency'],
                    'description' => [
                        'ar' => 'فهم عميق للفروق الثقافية وديناميكيات السوق في المملكة العربية السعودية والخليج.',
                        'en' => 'Unmatched understanding of cultural nuances and market dynamics in Saudi Arabia and the Gulf.',
                    ],
                ],
                [
                    'title'       => ['ar' => 'نزاهة عالية', 'en' => 'High-Trust Integrity'],
                    'description' => [
                        'ar' => 'التزام بالشفافية ومقاييس النتائج التي يعتمد عليها كبار المسؤولين التنفيذيين.',
                        'en' => 'A commitment to transparency and results-driven metrics that senior executives rely on.',
                    ],
                ],
            ],
            'features'    => [
                [
                    'title'       => ['ar' => 'قابلية توسع لا مثيل لها', 'en' => 'Unrivaled Scalability'],
                    'description' => [
                        'ar' => 'حلولنا مبنية للنمو من بطولات محلية إلى تكتلات عالمية دون أي احتكاك هيكلي.',
                        'en' => 'Our solutions are built to grow from local champions to global conglomerates without structural friction.',
                    ],
                ],
                [
                    'title'       => ['ar' => 'منظومة تقنية متطورة', 'en' => 'Elite Tech Ecosystem'],
                    'description' => [
                        'ar' => 'الاستفادة من أحدث تقنيات الذكاء الاصطناعي والتحليلات التنبؤية لمنح شركائنا أساساً مستقبلياً.',
                        'en' => 'Leveraging the latest in AI and predictive analytics to give our partners a future-proof foundation.',
                    ],
                ],
            ],
        ]);
    }
}
