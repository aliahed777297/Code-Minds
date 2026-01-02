<?php
namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    private function cartOwner()
    {
        return Auth::check()
            ? ['user_id' => Auth::id()]
            : ['session_id' => session()->getId()];
    }

    public function index()
    {
        $owner = $this->cartOwner();

        $items = CartItem::with('service')
            ->where($owner)
            ->get();

        $total = $items->sum(fn($i) => $i->quantity * $i->price_at_add);

        return view('cart.index', compact('items','total'));
    }

    public function count()
    {
        $owner = $this->cartOwner();

        $count = CartItem::where($owner)->sum('quantity');

        return response()->json(['count' => (int) $count]);
    }

    public function add(Request $request)
    {
        $data = $request->validate([
            'service_id' => 'required|exists:services,id',
            'quantity' => 'required|integer|min:1',
            'rating' => 'nullable|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        // Require authentication for adding to cart: guests are redirected to login
        if (!Auth::check()) {
            $service = Service::findOrFail($data['service_id']);

            // store pending add and guest session id so it can be processed after login
            session()->put('pending_cart_add', [
                'service_id' => $service->id,
                'quantity' => $data['quantity'],
                'rating' => $data['rating'] ?? null,
                'comment' => $data['comment'] ?? null,
                'price_at_add' => $service->price,
            ]);

            session()->put('guest_session_id', session()->getId());

            return redirect()->route('login');
        }

        $service = Service::findOrFail($data['service_id']);
        $owner = $this->cartOwner();

        $cart = CartItem::where($owner)
            ->where('service_id', $service->id)
            ->first();

        if ($cart) {
            $cart->quantity += $data['quantity'];
            $cart->rating = $data['rating'] ?? $cart->rating;
            $cart->comment = $data['comment'] ?? $cart->comment;
            $cart->save();
        } else {
            CartItem::create(array_merge($owner, [
                'service_id'   => $service->id,
                'quantity'     => $data['quantity'],
                'rating'       => $data['rating'] ?? null,
                'comment'      => $data['comment'] ?? null,
                'price_at_add' => $service->price,
            ]));
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'message' => 'تمت الإضافة إلى السلة',
                'service' => $service->only(['id','name','price'])
            ]);
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

        $owner = $this->cartOwner();
        $items = CartItem::with('service')->where($owner)->get();

        return response()->json([
            'message' => 'تم تحديث عنصر السلة',
            'total' => $items->sum(fn($i) => $i->quantity * $i->price_at_add),
            'count' => (int) $items->sum('quantity')
        ]);
    }

    public function remove($id)
    {
        CartItem::findOrFail($id)->delete();

        $owner = $this->cartOwner();
        $items = CartItem::with('service')->where($owner)->get();

        return response()->json([
            'message' => 'تم حذف العنصر',
            'total' => $items->sum(fn($i) => $i->quantity * $i->price_at_add),
            'count' => (int) $items->sum('quantity')
        ]);
    }

    public function checkout()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $owner = $this->cartOwner();
        $items = CartItem::where($owner)->get();

        if ($items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'السلة فارغة');
        }

        return redirect()->route('order.confirm');
    }
}
