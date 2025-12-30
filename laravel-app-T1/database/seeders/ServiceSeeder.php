<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            ['name' => 'غسيل عادي', 'description' => 'غسيل الملابس اليومية بعناية ومجفف عند الطلب.', 'price' => 15.00, 'duration_minutes' => 24],
            ['name' => 'تنظيف المجلخات', 'description' => 'خدمة تنظيف متقدمة للقطع الحساسة والبقع الصعبة.', 'price' => 35.00, 'duration_minutes' => 48],
            ['name' => 'كيّ فقط', 'description' => 'خدمة كيّ احترافية للتخلص من التجاعيد بسرعة.', 'price' => 10.00, 'duration_minutes' => 12],
            ['name' => 'تنظيف المفروشات', 'description' => 'تنظيف السجاد والستائر والمفروشات بمواد آمنة.', 'price' => 120.00, 'duration_minutes' => 72],
            ['name' => 'غسيل العناية الخاصة', 'description' => 'عناية احترافية للملابس الفاخرة والحريرية.', 'price' => 50.00, 'duration_minutes' => 72],
        ];

        foreach ($services as $s) {
            Service::updateOrCreate(['name' => $s['name']], $s);
        }
    }
}
