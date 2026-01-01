<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function confirm()
    {
        $sessionId = session()->getId();
        $items = CartItem::with('service')->where('session_id', $sessionId)->get();
        $total = $items->sum(function($i){ return $i->quantity * $i->price_at_add; });
        return view('order.confirm', compact('items','total'));
    }

    public function index()
    {
        $orders = Order::with('items.service')->orderBy('created_at','desc')->get();
        return view('order.index', compact('orders'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_name' => 'required|string|max:191',
            'customer_phone' => 'required|string|max:32',
            'customer_address' => 'nullable|string',
        ]);

        $sessionId = session()->getId();

        $order = DB::transaction(function() use ($data, $sessionId) {
            $order = Order::create([
                'session_id' => $sessionId,
                'customer_name' => $data['customer_name'],
                'customer_phone' => $data['customer_phone'],
                'customer_address' => $data['customer_address'] ?? null,
                'total_price' => 0,
            ]);

            $cartItems = CartItem::where('session_id', $sessionId)->get();
            $total = 0;
            foreach ($cartItems as $ci) {
                $subtotal = $ci->quantity * $ci->price_at_add;
                $order->items()->create([
                    'service_id' => $ci->service_id,
                    'quantity' => $ci->quantity,
                    'price' => $ci->price_at_add,
                    'subtotal' => $subtotal,
                ]);
                $total += $subtotal;
            }

            $order->update(['total_price' => $total]);
            CartItem::where('session_id', $sessionId)->delete();

            return $order;
        });

        return redirect()->route('invoice.show', [$order->id])->with('success', 'تم إنشاء الطلب');
    }

    public function show($id)
    {
        $order = Order::with('items.service')->findOrFail($id);
        return view('invoice.index', compact('order'));
    }
}
