<?php
// app/Http/Controllers/ServiceController.php
    // تحكم في عرض الخدمات والصور المرتبطة بها
    // استيراد الفئات اللازمة
    // استخدم نموذج الخدمة للتفاعل مع قاعدة البيانات
    // استخدم فئة File لجلب الصور من المجلد العام
    // استخدم فئة Request لمعالجة طلبات HTTP
    // تعريف فئة التحكم بالخدمات
    // دالة لعرض قائمة الخدمات مع الصور
    // جلب كل الصور من مجلد public/images
    // إذا كانت هناك صور، قم بإنشاء مصفوفة بمسارات الصور
    // جلب الخدمات من قاعدة البيانات وترتيبها حسب الاسم
    // تمرير المتغيرات إلى عرض Blade
    // دالة لعرض تفاصيل خدمة واحدة
    // العثور على الخدمة حسب المعرف أو إرجاع خطأ 404
    //udate by zeyad rajeh alshawsh
    
namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    { 
        // جلب كل الصور من public/images
        $images = File::files(public_path('images'));

        $imageFiles = count($images)
            ? array_map(fn($file) => 'images/' . $file->getFilename(), $images)
            : [];

        // جلب الخدمات
        $services = Service::orderBy('name')->get();

        // تمرير المتغيرات للـBlade
        return view('services.index', compact('services', 'imageFiles'));
    }

    public function show($id)
    {
        $service = Service::findOrFail($id);

        // إذا أردت عرض صورة عشوائية في صفحة الخدمة الواحدة:
        $images = File::files(public_path('images'));
        $imageFiles = count($images)
            ? array_map(fn($file) => 'images/' . $file->getFilename(), $images)
            : [];

        return view('services.show', compact('service', 'imageFiles'));
    }
}
