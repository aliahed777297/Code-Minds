<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        // summary stats can be added here
        $stats = [
            'services_count' => \App\Models\Service::count(),
            'orders_count' => \App\Models\Order::count(),
            'users_count' => \App\Models\User::count(),
            'messages_count' => \App\Models\ContactMessage::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
