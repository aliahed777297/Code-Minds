<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // تأكيد الطلب
    public function confirm()
    {
        // Determine owner (user or session)
        if (Auth::check()) {
            $cartItems = CartItem::with('service')
                ->where('user_id', Auth::id())
                ->get();
            $customer = [
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'phone' => Auth::user()->phone ?? '',
            ];
        } else {
            $sessionId = session('guest_session_id') ?? session()->getId();
            $cartItems = CartItem::with('service')
                ->where('session_id', $sessionId)
                ->whereNull('user_id')
                ->get();

            $customer = [
                'name' => session('guest_name') ?? '',
                'email' => session('guest_email') ?? '',
                'phone' => session('guest_phone') ?? '',
            ];
        }

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'السلة فارغة');
        }

        $total = $cartItems->sum('total');

        return view('order.confirm', compact('cartItems', 'total', 'customer'));
    }

    // Store order (supports guest and authenticated users)
    public function store(Request $request)
    {
        // Support guests: if authenticated use user cart, otherwise use session cart and guest details
        if (Auth::check()) {
            $cartItems = CartItem::with('service')
                ->where('user_id', Auth::id())
                ->get();
            $customerData = [
                'user_id' => Auth::id(),
                'customer_name' => Auth::user()->name,
                'customer_email' => Auth::user()->email,
                'customer_phone' => Auth::user()->phone ?? null,
            ];
        } else {
            $sessionId = session('guest_session_id') ?? session()->getId();
            $cartItems = CartItem::with('service')
                ->where('session_id', $sessionId)
                ->whereNull('user_id')
                ->get();

            $request->validate([
                'customer_name' => 'required|string|max:255',
                'customer_email' => 'required|email|max:255',
                'customer_phone' => 'nullable|string|max:50',
            ]);

            // save guest details in session for convenience
            session([ 'guest_name' => $request->customer_name, 'guest_email' => $request->customer_email, 'guest_phone' => $request->customer_phone ]);

            $customerData = [
                'user_id' => null,
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_email,
                'customer_phone' => $request->customer_phone,
            ];
        }

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'السلة فارغة');
        }

        DB::beginTransaction();

        try {
            $subtotal = $cartItems->sum('total');
            $tax = $subtotal * 0.15; // 15% tax
            $total = $subtotal + $tax;

            $orderPayload = array_merge($customerData, [
                'order_number' => Order::generateOrderNumber(),
                'subtotal' => $subtotal,
                'tax' => $tax,
                'total' => $total,
                'status' => 'pending',
                'payment_status' => 'pending',
            ]);

            $order = Order::create($orderPayload);

            foreach ($cartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'service_id' => $cartItem->service_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->price_at_add,
                    'subtotal' => $cartItem->total,
                ]);
            }

            // delete cart items (by user or session)
            if ($order->user_id) {
                CartItem::where('user_id', $order->user_id)->delete();
            } else {
                CartItem::where('session_id', session('guest_session_id') ?? session()->getId())->whereNull('user_id')->delete();
            }

            DB::commit();

            return redirect()->route('order.show', $order->id)
                ->with('success', 'تم إنشاء الطلب بنجاح! رقم الطلب: ' . $order->order_number);

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('cart.index')
                ->with('error', 'حدث خطأ أثناء إنشاء الطلب: ' . $e->getMessage());
        }
    }

    // عرض تفاصيل طلب
    public function show($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Allow access to orders belonging to the authenticated user either
        // by `user_id` or by matching the `customer_email` (for guest->registered flow)
        $order = Order::with('items.service')
            ->where(function($q) {
                $q->where('user_id', Auth::id())
                  ->orWhere('customer_email', Auth::user()->email);
            })
            ->findOrFail($id);

        return view('order.show', compact('order'));
    }

    // قائمة الطلبات للمستخدم الحالي (فلترة بحسب البريد المسجّل)
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $email = Auth::user()->email;

        $orders = Order::with('items')
            ->where('customer_email', $email)
            ->orWhere(function($q) use ($email) {
                $q->where('user_id', Auth::id());
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('order.index', compact('orders'));
    }
}