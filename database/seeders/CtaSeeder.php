<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CtaSeeder extends Seeder
{
    public function run(): void
    {
        setting('cta')->save([
            'status'        => true,
            'title'         => [
                'ar' => 'هل أنت مستعد لبناء مستقبلك؟',
                'en' => 'Ready to Architect Your Future?',
            ],
            'description'   => [
                'ar' => 'دعنا نناقش كيف يمكن لـ ديجي بيزنس أن يحوّل بصمتك الإقليمية وقدراتك الرقمية.',
                'en' => 'Let\'s discuss how Digi Business can transform your regional footprint and digital capability.',
            ],
            'btn_primary'   => [
                'ar' => 'احجز استشارة',
                'en' => 'Schedule a Consultation',
            ],
            'btn_secondary' => [
                'ar' => 'تواصل مع مكتب الرياض',
                'en' => 'Contact Our Riyadh Office',
            ],
        ]);
    }
}
