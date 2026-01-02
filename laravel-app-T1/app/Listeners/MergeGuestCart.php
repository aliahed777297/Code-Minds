<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use App\Models\CartItem;
use Illuminate\Support\Facades\Log;

class MergeGuestCart
{
    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        $user = $event->user;

        // The guest session id that previously held cart items
        $guestSessionId = session()->pull('guest_session_id');

        if ($guestSessionId) {
            $guestItems = CartItem::where('session_id', $guestSessionId)->get();

            foreach ($guestItems as $gi) {
                $existing = CartItem::where('user_id', $user->id)
                    ->where('service_id', $gi->service_id)
                    ->first();

                if ($existing) {
                    $existing->quantity += $gi->quantity;
                    $existing->save();
                    $gi->delete();
                } else {
                    $gi->user_id = $user->id;
                    $gi->session_id = null;
                    $gi->save();
                }
            }
        }

        // Process a single pending add (if any)
        $pending = session()->pull('pending_cart_add');
        if ($pending) {
            $item = CartItem::where('user_id', $user->id)
                ->where('service_id', $pending['service_id'])
                ->first();

            if ($item) {
                $item->quantity += $pending['quantity'];
                $item->rating = $pending['rating'] ?? $item->rating;
                $item->comment = $pending['comment'] ?? $item->comment;
                $item->save();
            } else {
                CartItem::create([
                    'user_id' => $user->id,
                    'service_id' => $pending['service_id'],
                    'quantity' => $pending['quantity'],
                    'rating' => $pending['rating'] ?? null,
                    'comment' => $pending['comment'] ?? null,
                    'price_at_add' => $pending['price_at_add'] ?? 0,
                ]);
            }
        }
    }
}
