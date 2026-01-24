<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    // Show a simple payment page
    public function create($orderId)
    {
        $order = Order::where('id', $orderId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('payment.create', compact('order'));
    }

    // Process (simulate) payment
    public function process(Request $request, $orderId)
    {
        $order = Order::where('id', $orderId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Simulate payment succeeded
        $order->payment_status = 'paid';
        $order->status = 'paid';
        $order->save();

        return redirect()->route('order.show', $order->id)->with('success', 'تم تأكيد الدفع بنجاح');
    }
}
