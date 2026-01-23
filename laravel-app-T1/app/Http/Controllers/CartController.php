<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Service;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // الحصول على معرف المالك الحالي (user_id أو session_id)
    private function getCartOwner()
    {
        if (Auth::check()) {
            return ['user_id' => Auth::id()];
        }
        
        return ['session_id' => $this->getOrCreateSessionId()];
    }

    // إنشاء أو استرجاع session_id
    private function getOrCreateSessionId()
    {
        $sessionId = session()->getId();
        
        // إذا لم يكن هناك session_id، أنشئ واحداً
        if (empty($sessionId)) {
            $sessionId = 'guest_' . uniqid() . '_' . time();
            session()->put('guest_session_id', $sessionId);
        }
        
        return $sessionId;
    }

    // عرض السلة
    public function index()
    {
        $owner = $this->getCartOwner();
        
        $cartItems = CartItem::with('service')
            ->where($owner)
            ->get();
            
        $total = $cartItems->sum('total');

        return view('cart.index', compact('cartItems', 'total'));
    }

    // إضافة عنصر للسلة
    public function add(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'quantity' => 'required|integer|min:1|max:10'
        ]);

        $service = Service::findOrFail($request->service_id);
        $owner = $this->getCartOwner();

        // البحث عن العنصر الموجود
        $cartItem = CartItem::where($owner)
            ->where('service_id', $request->service_id)
            ->first();

        if ($cartItem) {
            // تحديث الكمية
            $cartItem->increment('quantity', $request->quantity);
            $message = 'تم تحديث الكمية في السلة';
        } else {
            // إضافة عنصر جديد
            CartItem::create(array_merge($owner, [
                'service_id' => $request->service_id,
                'quantity' => $request->quantity,
                'price_at_add' => $service->price,
            ]));
            $message = 'تمت إضافة الخدمة إلى السلة';
        }

        $count = CartItem::where($owner)->count();
        $total = CartItem::with('service')->where($owner)->get()->sum('total');

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'message' => $message,
                'count' => $count,
                'total' => number_format((float) $total, 2, '.', ''),
            ]);
        }

        return redirect()->route('cart.index')
            ->with('success', $message);
    }

    // تحديث الكمية
    public function update(Request $request, $id)
    {
        $owner = $this->getCartOwner();
        
        $request->validate([
            'quantity' => 'required|integer|min:1|max:10'
        ]);

        $cartItem = CartItem::where($owner)->findOrFail($id);
        $cartItem->update(['quantity' => $request->quantity]);

        $count = CartItem::where($owner)->count();
        $total = CartItem::where($owner)->get()->sum('total');

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'message' => 'تم تحديث السلة بنجاح',
                'count' => $count,
                'total' => number_format((float) $total, 2, '.', ''),
            ]);
        }

        return redirect()->route('cart.index')
            ->with('success', 'تم تحديث السلة بنجاح');
    }

    // حذف عنصر
    public function remove($id)
    {
        $owner = $this->getCartOwner();
        
        $cartItem = CartItem::where($owner)->findOrFail($id);
        $cartItem->delete();

        $count = CartItem::where($owner)->count();
        $total = CartItem::where($owner)->get()->sum('total');

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'message' => 'تم حذف العنصر من السلة',
                'count' => $count,
                'total' => number_format((float) $total, 2, '.', ''),
            ]);
        }

        return redirect()->route('cart.index')
            ->with('success', 'تم حذف العنصر من السلة');
    }

    // عدد العناصر في السلة (للعرض في الهيدر)
    public function count()
    {
        $owner = $this->getCartOwner();
        $count = CartItem::where($owner)->count();
        
        return response()->json(['count' => $count]);
    }

    // تفريغ السلة
    public function clear()
    {
        $owner = $this->getCartOwner();
        CartItem::where($owner)->delete();

        return redirect()->route('cart.index')
            ->with('success', 'تم تفريغ السلة بنجاح');
    }

    // دمج سلة الجلسة مع حساب المستخدم عند تسجيل الدخول
    public static function mergeGuestCartWithUser($userId)
    {
        $sessionId = session('guest_session_id') ?? session()->getId();
        
        if (!$sessionId) {
            return 0;
        }

        // نقل العناصر من الجلسة إلى المستخدم
        $migrated = CartItem::migrateSessionToUser($sessionId, $userId);
        
        // حذف session_id القديم من الجلسة
        session()->forget('guest_session_id');
        
        return $migrated;
    }

    // تنفيذ عملية الدفع/إنشاء الطلب من السلة (يدعم AJAX)
    public function checkout(Request $request)
    {
        if (!Auth::check()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['message' => 'يجب تسجيل الدخول لإتمام الشراء'], 403);
            }

            return redirect()->route('login')->with('error', 'يجب تسجيل الدخول لإنشاء طلب');
        }

        $userId = Auth::id();

        $cartItems = CartItem::with('service')
            ->where('user_id', $userId)
            ->get();

        if ($cartItems->isEmpty()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['message' => 'السلة فارغة'], 422);
            }

            return redirect()->route('cart.index')->with('error', 'السلة فارغة');
        }

        DB::beginTransaction();

        try {
            $subtotal = $cartItems->sum('total');
            $tax = $subtotal * 0.15;
            $total = $subtotal + $tax;

            $order = Order::create([
                'user_id' => $userId,
                'order_number' => Order::generateOrderNumber(),
                'customer_name' => Auth::user()->name,
                'customer_email' => Auth::user()->email,
                'subtotal' => $subtotal,
                'tax' => $tax,
                'total' => $total,
                'status' => 'pending',
                'payment_status' => 'pending',
            ]);

            foreach ($cartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'service_id' => $cartItem->service_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->price_at_add,
                    'subtotal' => $cartItem->total,
                ]);
            }

            // حذف عناصر السلة
            CartItem::where('user_id', $userId)->delete();

            DB::commit();

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'message' => 'تم إنشاء الطلب بنجاح',
                    'order_id' => $order->id,
                    'order_number' => $order->order_number,
                ]);
            }

            return redirect()->route('order.show', $order->id)
                ->with('success', 'تم إنشاء الطلب بنجاح! رقم الطلب: ' . $order->order_number);

        } catch (\Exception $e) {
            DB::rollBack();

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['message' => 'حدث خطأ أثناء إنشاء الطلب: ' . $e->getMessage()], 500);
            }

            return redirect()->route('cart.index')
                ->with('error', 'حدث خطأ أثناء إنشاء الطلب: ' . $e->getMessage());
        }
    }
}