<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Service;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $sessionId = session()->getId();
        $items = CartItem::with('service')->where('session_id', $sessionId)->get();
        $total = $items->sum(function($i){ return $i->quantity * $i->price_at_add; });
        return view('cart.index', compact('items','total'));

    }

    // Return JSON count for header badge
    public function count()
    {
        $sessionId = session()->getId();
        $count = CartItem::where('session_id', $sessionId)->sum('quantity');
        return response()->json(['count' => (int)$count]);
    }

    public function add(Request $request)
    {
        $data = $request->validate([
            'service_id' => 'required|exists:services,id',
            'quantity' => 'required|integer|min:1',
            'rating' => 'nullable|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $sessionId = session()->getId();
        $service = Service::findOrFail($data['service_id']);

        $cart = CartItem::where('session_id', $sessionId)->where('service_id', $service->id)->first();
        if ($cart) {
            $cart->quantity += $data['quantity'];
            $cart->rating = $data['rating'] ?? $cart->rating;
            $cart->comment = $data['comment'] ?? $cart->comment;
            $cart->save();
        } else {
            CartItem::create([
                'session_id' => $sessionId,
                'service_id' => $service->id,
                'quantity' => $data['quantity'],
                'rating' => $data['rating'] ?? null,
                'comment' => $data['comment'] ?? null,
                'price_at_add' => $service->price,
            ]);
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['message' => 'تمت الإضافة إلى السلة', 'service' => $service->only(['id','name','price'])]);
        }

        return redirect()->route('cart.index')->with('success', 'تمت الإضافة إلى السلة');
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'quantity' => 'required|integer|min:1',
            'rating' => 'nullable|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $item = CartItem::findOrFail($id);
        $item->update($data);

        if ($request->ajax() || $request->wantsJson()) {
            $sessionId = session()->getId();
            $items = CartItem::with('service')->where('session_id', $sessionId)->get();
            $total = $items->sum(function($i){ return $i->quantity * $i->price_at_add; });
            $count = $items->sum('quantity');
            return response()->json(['message' => 'تم تحديث عنصر السلة', 'total' => $total, 'count' => (int)$count]);
        }

        return back()->with('success', 'تم تحديث عنصر السلة');
    }

    public function remove($id)
    {
        $item = CartItem::findOrFail($id);
        $item->delete();

        if (request()->ajax() || request()->wantsJson()) {
            $sessionId = session()->getId();
            $items = CartItem::with('service')->where('session_id', $sessionId)->get();
            $total = $items->sum(function($i){ return $i->quantity * $i->price_at_add; });
            $count = $items->sum('quantity');
            return response()->json(['message' => 'تم حذف العنصر', 'total' => $total, 'count' => (int)$count]);
        }

        return back()->with('success', 'تم حذف العنصر');
    }

    public function checkout()
    {
        $sessionId = session()->getId();
        $items = CartItem::where('session_id', $sessionId)->get();

        if ($items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'السلة فارغة');
        }

        return redirect()->route('order.confirm');
    }
}
