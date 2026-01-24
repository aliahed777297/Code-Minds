<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CartController;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $redirect = $request->query('redirect') ?? $request->input('redirect');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // دمج سلة الجلسة مع حساب المستخدم
            $mergedItems = CartController::mergeGuestCartWithUser(Auth::id());

            $message = 'تم تسجيل الدخول بنجاح!';
            if ($mergedItems > 0) {
                $message .= ' تم نقل ' . $mergedItems . ' عنصر من سلة التسوق إلى حسابك.';
            }

            if ($redirect) {
                return redirect()->to($redirect)->with('success', $message);
            }

            return redirect()->intended('/')->with('success', $message);
        }

        return back()
            ->withErrors([
                'email' => 'بيانات الدخول غير صحيحة.',
            ])
            ->withInput($request->except('password'))
            ->with('show_login', true);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/')->with('success', 'تم تسجيل الخروج بنجاح');
    }
}