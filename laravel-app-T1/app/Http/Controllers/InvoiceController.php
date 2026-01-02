<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function index($orderId)
    {

$order = Order::with('items.service')
    ->where('user_id', Auth::id())
    ->findOrFail($orderId);
        return view('invoice.index', compact('order'));
    }

    // Optional: download as PDF (not implemented here)
}
