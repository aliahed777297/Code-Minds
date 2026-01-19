<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::latest()->paginate(20);
        return view('contact.admin', compact('messages'));
    }

    public function show()
    {
        return view('contact.index');
    }

    public function store(Request $request)
    {
        $errors = [];

        // تنظيف المدخلات من XSS
        $name = trim(strip_tags($request->input('name')));
        $email = trim(strip_tags($request->input('email')));
        $phone = trim(strip_tags($request->input('phone')));
        $message = trim(strip_tags($request->input('message')));

        // التحقق من الاسم - أكثر مرونة
        if (empty($name)) {
            $errors['name'] = "الاسم مطلوب";
        } elseif (!preg_match("/^[\p{Arabic}a-zA-Z\s\-']+$/u", $name)) {
            $errors['name'] = "الاسم يجب أن يحتوي على أحرف عربية أو إنجليزية فقط";
        } elseif (strlen($name) > 191) {
            $errors['name'] = "الاسم يجب ألا يزيد عن 191 حرف";
        }

        // التحقق من البريد الإلكتروني - أكثر مرونة
        if (empty($email)) {
            $errors['email'] = "البريد الإلكتروني مطلوب";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "تنسيق البريد الإلكتروني غير صحيح";
        } elseif (strlen($email) > 191) {
            $errors['email'] = "البريد الإلكتروني يجب ألا يزيد عن 191 حرف";
        }

        // التحقق من الهاتف - أكثر مرونة
        if (empty($phone)) {
            $errors['phone'] = "رقم الهاتف مطلوب";
        } elseif (!preg_match("/^[\+]?[0-9\s\-\(\)]{8,15}$/", $phone)) {
            $errors['phone'] = "رقم الهاتف يجب أن يحتوي على 8-15 رقم ويمكن أن يبدأ بـ +";
        }

        // التحقق من الرسالة - غير فارغة، بدون رموز، أقل من 300 حرف، منع الحقن
        if (empty($message)) {
            $errors['message'] = "الرسالة مطلوبة";
        } elseif (strlen($message) > 300) {
            $errors['message'] = "الرسالة يجب ألا تزيد عن 300 حرف";
        } elseif (preg_match("/[<>\"'&]/", $message)) {
            $errors['message'] = "الرسالة تحتوي على رموز غير مسموحة";
        } elseif (preg_match("/(script|javascript|vbscript|onload|onerror|onclick)/i", $message)) {
            $errors['message'] = "تم اكتشاف محاولة حقن كود خبيث";
        }

        // إذا كان هناك أخطاء، أعد توجيه المستخدم مع الأخطاء والمدخلات القديمة
        if (!empty($errors)) {
            return back()->withErrors($errors)->withInput();
        }

        // إذا لم يكن هناك أخطاء، احفظ البيانات
        $data = [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'message' => $message,
        ];

        $msg = ContactMessage::create($data);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['message' => 'تم استلام رسالتك، سنتواصل معك قريباً', 'id' => $msg->id]);
        }

        return back()->with('success', 'تم استلام رسالتك، سنتواصل معك قريباً');
    }
}
