<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'min_price' => 'nullable|numeric|min:0',
            'max_price' => 'nullable|numeric|min:0',
            'duration_max' => 'nullable|integer|min:0',
            'q' => 'nullable|string|max:255',
            'sort' => 'nullable|string',
        ]);

        $query = Service::query();
        $query->search($request->input('q'));
        $query->priceBetween($request->input('min_price'), $request->input('max_price'));
        $query->durationMax($request->input('duration_max'));
        $query->ordered($request->input('sort'));

        $services = $query->paginate(12)->withQueryString();

        return view('services.index', compact('services'));
    }

    public function show(Service $service)
    {
        return view('services.show', compact('service'));
    }
}
     