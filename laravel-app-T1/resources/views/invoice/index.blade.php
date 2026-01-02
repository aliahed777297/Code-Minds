@extends('layout.main')
@push('styles')
    <link rel="stylesheet" href="/css/invoice.css">
@endpush
@section('content')
    <h1>فاتورة الطلب #{{ $order->id }}</h1>
    <div class="customer">
        <p>الاسم: {{ $order->customer_name }}</p>
        <p>الهاتف: {{ $order->customer_phone }}</p>
        @if($order->customer_address)
            <p>العنوان: {{ $order->customer_address }}</p>
        @endif
        <p>التاريخ: {{ $order->created_at->format('Y-m-d H:i') }}</p>
    </div>
    <table class="invoice-table">
        <thead>
            <tr><th>الخدمة</th><th>الكمية</th><th>سعر الوحدة</th><th>المجموع</th></tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->service->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->price, 2) }}</td>
                    <td>{{ number_format($item->subtotal, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="invoice-total">الإجمالي: {{ number_format($order->total_price, 2) }} ر.س</div>
@endsection
