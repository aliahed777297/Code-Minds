<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact.index');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:191',
            'email' => 'nullable|email|max:191',
            'phone' => 'nullable|string|max:32',
            'message' => 'required|string',
        ]);

        $msg = ContactMessage::create($data);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['message' => 'تم استلام رسالتك، سنتواصل معك قريباً', 'id' => $msg->id]);
        }

        return back()->with('success', 'تم استلام رسالتك، سنتواصل معك قريباً');
    }
}
