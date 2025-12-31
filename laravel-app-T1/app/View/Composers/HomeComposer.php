<?php

namespace App\View\Composers;

use App\Models\Service;
use App\Models\Order;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;

class HomeComposer
{
    public function compose(View $view)
    {
        // Cache home-specific data for 5 minutes to reduce DB load
        $homeData = Cache::remember('home.data', now()->addMinutes(5), function () {
            $services = Service::orderBy('name')->get();
            $slides = $services->take(4)->values();

            $ordersCount = Order::count();
            $usersCount = User::count();
            $satisfaction = $ordersCount ? min(99, 90 + ($ordersCount % 10)) : 95;

            return [
                'slides' => $slides,
                'ordersCount' => $ordersCount,
                'usersCount' => $usersCount,
                'satisfaction' => $satisfaction,
            ];
        });

        $view->with('homeData', $homeData);
    }
}
