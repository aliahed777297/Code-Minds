<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\CartController;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);

        // دمج سلة الجلسة مع حساب المستخدم الجديد
        $mergedItems = CartController::mergeGuestCartWithUser($user->id);

        $message = 'تم إنشاء الحساب بنجاح!';
        if ($mergedItems > 0) {
            $message .= ' تم نقل ' . $mergedItems . ' عنصر من سلة التسوق إلى حسابك الجديد.';
        }

        $redirect = $request->query('redirect') ?? $request->input('redirect');
        if ($redirect) {
            return redirect()->to($redirect)->with('success', $message);
        }

        return redirect('/')->with('success', $message);
    }
}