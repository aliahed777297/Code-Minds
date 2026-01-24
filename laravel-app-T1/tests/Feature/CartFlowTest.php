<?php

namespace Tests\Feature;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_add_service_to_cart()
    {
        $service = Service::create([
            'name' => 'Test Service',
            'description' => 'Desc',
            'price' => 50.00,
            'duration_minutes' => 30,
        ]);

        $response = $this->post(route('cart.add'), [
            'service_id' => $service->id,
            'quantity' => 2,
        ]);

        $response->assertRedirect(route('cart.index'));

        $this->assertDatabaseHas('cart_items', [
            'service_id' => $service->id,
            'quantity' => 2,
        ]);

        $cartItem = CartItem::first();
        $this->assertNotNull($cartItem->session_id);
        $this->assertNull($cartItem->user_id);
    }

    public function test_authenticated_user_can_checkout_and_create_order()
    {
        $user = User::factory()->create();

        $service = Service::create([
            'name' => 'User Service',
            'description' => 'Desc',
            'price' => 100.00,
            'duration_minutes' => 45,
        ]);

        $this->actingAs($user)
            ->post(route('cart.add'), [
                'service_id' => $service->id,
                'quantity' => 1,
            ])
            ->assertRedirect(route('cart.index'));

        $this->assertDatabaseHas('cart_items', [
            'service_id' => $service->id,
            'user_id' => $user->id,
        ]);

        // Proceed to create order
        $this->actingAs($user)
            ->post(route('order.store'))
            ->assertRedirect();

        // Ensure an order was created for the user
        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id,
            'status' => 'pending',
        ]);

        // Ensure cart items were removed
        $this->assertDatabaseCount('cart_items', 0);

        $order = Order::first();

        $this->assertNotNull($order);
        $this->assertEquals($user->id, $order->user_id);
    }
}
