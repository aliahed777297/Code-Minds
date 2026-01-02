@extends('layout.main')
@push('styles')
    <link rel="stylesheet" href="/css/order.css">
@endpush
@section('content')
    <h1>قائمة الطلبات</h1>
    @if($orders->count() > 0)
        <ul class="orders-list">
            @foreach($orders as $order)
                <li class="order-card">
                    <div>طلب #{{ $order->id }} — {{ $order->created_at->format('Y-m-d') }}</div>
                    <div>اسم: {{ $order->customer_name }}</div>
                    <div>المجموع: {{ number_format($order->total_price, 2) }} ر.س</div>
                    <div><a class="btn" href="{{ route('invoice.show', $order->id) }}">عرض الفاتورة</a></div>
                </li>
            @endforeach
        </ul>
    @else
        <p>لا توجد أي طلبات بعد.</p>
    @endif
@endsection
