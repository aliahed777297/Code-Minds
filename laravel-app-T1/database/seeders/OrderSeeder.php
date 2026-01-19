<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Service;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $services = Service::all();
        if ($services->isEmpty()) return;

        $order = Order::create([
            'session_id' => 'seed-session',
            'customer_name' => 'عميل تجريبي',
            'customer_phone' => '0500000000',
            'customer_address' => 'شارع الاختبار، المدينة',
            'total_price' => 0,
        ]);

        $total = 0;
        $services->take(2)->each(function($s) use ($order, &$total) {
            $qty = rand(1,3);
            $subtotal = $qty * $s->price;
            $order->items()->create([
                'service_id' => $s->id,
                'quantity' => $qty,
                'price' => $s->price,
                'subtotal' => $subtotal,
            ]);
            $total += $subtotal;
        });

        $order->update(['total_price' => $total]);
    }
}
