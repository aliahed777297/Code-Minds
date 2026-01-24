<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;



// ===== مسارات المصادقة =====
Route::get('login', function() {
    return view('auth.login');
})->name('login');

Route::post('login', function(\Illuminate\Http\Request $request) {
    $data = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (\Illuminate\Support\Facades\Auth::attempt($data)) {
        $request->session()->regenerate();
        // Merge any guest cart items into the authenticated user's cart
        \App\Http\Controllers\CartController::mergeGuestCartWithUser(\Illuminate\Support\Facades\Auth::id());

        $intended = url()->previous();

        if ($request->wantsJson() || $request->ajax() || $request->expectsJson()) {
            return response()->json(['success' => true, 'redirect' => url('/')]);
        }

        return redirect()->intended('/');
    }

    if ($request->wantsJson() || $request->ajax() || $request->expectsJson()) {
        return response()->json(['errors' => ['email' => ['بيانات الدخول غير صحيحة']]], 422);
    }

    return back()->withErrors(['email' => 'بيانات الدخول غير صحيحة']);
});

Route::get('register', function() {
    return view('auth.register');
})->name('register');

Route::post('register', function(\Illuminate\Http\Request $request) {
    $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6|confirmed',
    ]);

    if ($validator->fails()) {
        if ($request->wantsJson() || $request->ajax() || $request->expectsJson()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        return back()->withErrors($validator)->withInput();
    }

    $validated = $validator->validated();

    $user = \App\Models\User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => \Illuminate\Support\Facades\Hash::make($validated['password']),
    ]);

    \Illuminate\Support\Facades\Auth::login($user);
    // Move any guest cart into the new user's cart
    \App\Http\Controllers\CartController::mergeGuestCartWithUser($user->id);

    if ($request->wantsJson() || $request->ajax() || $request->expectsJson()) {
        return response()->json(['success' => true, 'redirect' => url('/')]);
    }

    return redirect('/')->with('success', 'تم إنشاء الحساب بنجاح!');
});

Route::post('logout', function(\Illuminate\Http\Request $request) {
    \Illuminate\Support\Facades\Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    
    return redirect('/');
})->name('logout');

// ===== الصفحات العامة =====
Route::view('/', 'home.index')->name('home');
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/service/{id}', [ServiceController::class, 'show'])->name('service.show');
Route::view('/about', 'about.index')->name('about');
Route::get('/contact', [\App\Http\Controllers\ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [\App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');

// ===== المسارات المحمية =====
Route::middleware('auth')->group(function () {
    // Protected order list & invoice
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/order/{id}', [OrderController::class, 'show'])->name('order.show');
    Route::get('/invoice/{id}', [InvoiceController::class, 'index'])->name('invoice.show');
    // Payment routes (protected)
    Route::get('/payment/{order}/create', [\App\Http\Controllers\PaymentController::class, 'create'])->name('payment.create');
    Route::post('/payment/{order}', [\App\Http\Controllers\PaymentController::class, 'process'])->name('payment.process');
});

// Order confirmation & store are available for guests and users
Route::get('/order/confirm', [OrderController::class, 'confirm'])->name('order.confirm');
Route::post('/order', [OrderController::class, 'store'])->name('order.store');

// مسارات السلة - متاحة للزوار والمستخدمين المسجلين
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/{id}/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/{id}/remove', [CartController::class, 'remove'])->name('cart.remove');

// ===== مسارات إضافية غير محمية =====
Route::get('/cart/count', [CartController::class, 'count'])->name('cart.count');
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');


// ===== لوحة المشرف (Admin) =====
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\UserController;

    

Route::prefix('admin')
    ->name('admin.')
    ->middleware([\App\Http\Middleware\EnsureUserIsAdmin::class])
    ->group(function () {

        Route::get('/', [AdminController::class, 'index'])->name('dashboard');

        Route::resource('services', AdminServiceController::class);
        Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class);
        Route::resource('users', UserController::class); // 👈 هذا المهم
        Route::resource('messages', \App\Http\Controllers\Admin\ContactMessageController::class);
    });


