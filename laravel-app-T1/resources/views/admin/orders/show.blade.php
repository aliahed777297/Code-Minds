@extends('admin.layout')

@section('title','تفاصيل الطلب')

@section('content')
<div class="card">
    <h3>طلب #{{ $order->id }}</h3>
    <p><strong>المستخدم:</strong> {{ $order->user->name ?? 'زائر' }} ({{ $order->user->email ?? '—' }})</p>
    <p><strong>المجموع:</strong> {{ number_format($order->total ?? 0,2) }} ر.س</p>
    <p><strong>الحالة:</strong> {{ $order->status ?? '—' }}</p>

    <h4>العناصر</h4>
    <table>
        <thead>
            <tr><th>الخدمة</th><th>الكمية</th><th>السعر</th></tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->service->name ?? '—' }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->price,2) }} ر.س</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('admin.orders.index') }}" class="btn">عودة</a>
</div>
@endsection