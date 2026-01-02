<?php
namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    private function cartOwner()
    {
        return Auth::check()
            ? ['user_id' => Auth::id()]
            : ['session_id' => session()->getId()];
    }

    public function confirm()
    {
        $owner = $this->cartOwner();

        $items = CartItem::with('service')->where($owner)->get();
        $total = $items->sum(fn($i) => $i->quantity * $i->price_at_add);

        return view('order.confirm', compact('items','total'));
    }

    public function index()
    {
        $orders = Order::with('items.service')
            ->where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->get();

        return view('order.index', compact('orders'));
    }

    public function store()
    {
        $owner = $this->cartOwner();

        $order = DB::transaction(function () use ($owner) {

            $order = Order::create([
                'user_id' => Auth::id(),
                'total_price' => 0,
                'customer_name' => Auth::user()?->name ?? '',
                'customer_phone' => '',
            ]);

            $cartItems = CartItem::where($owner)->get();
            $total = 0;

            foreach ($cartItems as $ci) {
                $subtotal = $ci->quantity * $ci->price_at_add;

                $order->items()->create([
                    'service_id' => $ci->service_id,
                    'quantity'   => $ci->quantity,
                    'price'      => $ci->price_at_add,
                    'subtotal'   => $subtotal,
                ]);

                $total += $subtotal;
            }

            $order->update(['total_price' => $total]);

            CartItem::where($owner)->delete();

            return $order;
        });

        return redirect()->route('invoice.show', $order->id)
            ->with('success', 'تم إنشاء الطلب');
    }

    public function show($id)
    {
        $order = Order::with('items.service')
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('invoice.index', compact('order'));
    }
}
