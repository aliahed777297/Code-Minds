<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactMessageRequest;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    // صفحة الإدارة
    public function index()
    {
        $messages = ContactMessage::latest()->paginate(20);

        return view('contact.admin', compact('messages'));
    }

    // صفحة نموذج التواصل
    public function show()
    {
        return view('contact.index');
    }

    // حفظ الرسالة
    public function store(StoreContactMessageRequest $request)
    {
        // البيانات validated وجاهزة
        $message = ContactMessage::create($request->validated());

        // دعم JSON / AJAX
        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'تم استلام رسالتك، سنتواصل معك قريباً',
                'id' => $message->id,
            ]);
        }

        return back()->with('success', 'تم استلام رسالتك، سنتواصل معك قريباً');
    }
}
