<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $adminId = \App\Models\Admin::value('id') ?? 1;

        $items = [
            [
                'name'        => ['ar' => 'تطوير المواقع والتطبيقات', 'en' => 'Web & App Development'],
                'description' => ['ar' => 'بناء مواقع ويب ومتاجر إلكترونية وتطبيقات ذكية بمعايير عالمية، تركز على تجربة المستخدم والأداء العالي لضمان استقرار أعمالكم الرقمية', 'en' => 'High-performance digital products engineered for scalability and seamless user experience'],
                'icon'        => 'devices',
                'status'      => 1,
                'admin_id'    => $adminId,
            ],
            [
                'name'        => ['ar' => 'التسويق الرقمي الشامل', 'en' => 'Digital Marketing'],
                'description' => ['ar' => 'استراتيجيات تسويق 360 درجة تشمل تحسين محركات البحث وإدارة الحملات الإعلانية على جوجل ومنصات التواصل لتحقيق مبيعات حقيقية', 'en' => 'Precision-targeted campaigns and growth hacking strategies that dominate regional market share'],
                'icon'        => 'ads_click',
                'status'      => 1,
                'admin_id'    => $adminId,
            ],
            [
                'name'        => ['ar' => 'بناء الهوية البصرية', 'en' => 'Branding'],
                'description' => ['ar' => 'صياغة هوية بصرية قوية تعكس قيم شركتكم، من الشعار حتى الدليل الإرشادي للعلامة التجارية', 'en' => 'Visual identities that command respect and resonate with Gulf heritage'],
                'icon'        => 'palette',
                'status'      => 1,
                'admin_id'    => $adminId,
            ],
            [
                'name'        => ['ar' => 'صناعة المحتوى الإبداعي', 'en' => 'Content Creation'],
                'description' => ['ar' => 'محتوى تسويقي يخاطب جمهورك المستهدف بلغتهم، يشمل Copywriting وتصميم الجرافيك وإنتاج الفيديو', 'en' => 'Multilingual storytelling and high-impact media production for modern platforms'],
                'icon'        => 'video_library',
                'status'      => 1,
                'admin_id'    => $adminId,
            ],
            [
                'name'        => ['ar' => 'تحسين محركات البحث', 'en' => 'SEO Optimization'],
                'description' => ['ar' => 'استراتيجيات SEO متكاملة لتصدر نتائج جوجل وزيادة الزيارات العضوية وتعزيز ظهور علامتكم التجارية رقمياً', 'en' => 'Comprehensive SEO strategies to dominate search rankings and drive organic growth'],
                'icon'        => 'manage_search',
                'status'      => 1,
                'admin_id'    => $adminId,
            ],
            [
                'name'        => ['ar' => 'إدارة وسائل التواصل الاجتماعي', 'en' => 'Social Media Management'],
                'description' => ['ar' => 'إدارة احترافية لحسابات التواصل الاجتماعي مع محتوى مدروس وجداول نشر منتظمة لبناء مجتمع متفاعل حول علامتكم', 'en' => 'Professional social media management with strategic content and consistent publishing schedules'],
                'icon'        => 'groups',
                'status'      => 1,
                'admin_id'    => $adminId,
            ],
            [
                'name'        => ['ar' => 'استشارات تطوير الأعمال', 'en' => 'Business Consultancy'],
                'description' => ['ar' => 'خدمة حصرية من ديجي بزنس لتحليل السوق ودراسة المنافسين ووضع خطط التوسع الرقمي لضمان استدامة مشروعك', 'en' => 'Strategic market entry and operational optimization for the Kingdom\'s evolving landscape'],
                'icon'        => 'query_stats',
                'status'      => 1,
                'admin_id'    => $adminId,
            ],
        ];

        foreach ($items as $item) {
            Service::create($item);
        }

    }//end of run

}//end of seeder
