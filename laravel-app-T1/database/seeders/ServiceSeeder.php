<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'name' => 'غسيل عادي',
                'image' => 'images/service-washfold.jpg', // صورة للغسيل العادي - يمكن تغييرها إلى صورة أخرى إذا لزم الأمر
                'description' => 'غسيل الملابس اليومية بعناية ومجفف عند الطلب.',
                'price' => 15.00,
                'duration_minutes' => 24,
            ],
            [
                'name' => 'تنظيف جاف',
                'image' => 'images/service-dryclean.jpg', // صورة للتنظيف الجاف - يمكن تغييرها إلى صورة أخرى إذا لزم الأمر
                'description' => 'خدمة تنظيف متقدمة للقطع الحساسة والبقع الصعبة.',
                'price' => 35.00,
                'duration_minutes' => 48,
            ],
            [
                'name' => 'كيّ فقط',
                'image' => 'images/service-sanitize.jpg', // صورة للكي والتعقيم - يمكن تغييرها إلى صورة أخرى إذا لزم الأمر
                'description' => 'خدمة كيّ احترافية للتخلص من التجاعيد بسرعة.',
                'price' => 10.00,
                'duration_minutes' => 12,
            ],
            [
                'name' => 'تنظيف المفروشات',
                'image' => 'images/service-delivery.jpg', // صورة للتوصيل والتنظيف - يمكن تغييرها إلى صورة أخرى إذا لزم الأمر
                'description' => 'تنظيف السجاد والستائر والمفروشات بمواد آمنة.',
                'price' => 120.00,
                'duration_minutes' => 72,
            ],
            [
                'name' => 'غسيل العناية الخاصة',
                'image' => 'images/service-sanitize.jpg', // صورة للعناية الخاصة والتعقيم - يمكن تغييرها إلى صورة أخرى إذا لزم الأمر
                'description' => 'عناية احترافية للملابس الفاخرة والحريرية.',
                'price' => 50.00,
                'duration_minutes' => 72,
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(
                ['name' => $service['name']],
                $service
            );
        }
    }
}
