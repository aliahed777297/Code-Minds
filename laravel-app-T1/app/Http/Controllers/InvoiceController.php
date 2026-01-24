<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    // عرض الفاتورة
    public function index($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'يجب تسجيل الدخول لعرض الفاتورة');
        }

        // Allow access to invoices for orders that belong to the
        // authenticated user by `user_id` or by matching `customer_email`.
        $order = Order::with(['items.service', 'user'])
            ->where(function ($q) {
                $q->where('user_id', Auth::id())
                  ->orWhere('customer_email', Auth::user()->email);
            })
            ->findOrFail($id);

        return view('invoice.show', compact('order'));
    }
}