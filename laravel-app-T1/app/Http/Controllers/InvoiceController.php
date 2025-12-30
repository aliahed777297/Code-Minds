<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index($orderId)
    {
        $order = Order::with('items.service')->findOrFail($orderId);
        return view('invoice.index', compact('order'));
    }

    // Optional: download as PDF (not implemented here)
}
