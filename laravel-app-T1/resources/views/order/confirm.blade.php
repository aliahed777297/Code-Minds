@extends('layout.main')
@push('styles')
    <link rel="stylesheet" href="/css/confirm.css">
@endpush
@section('content')
    <h1>مراجعة الطلب</h1>
    <ul class="order-items">
        @foreach($items as $item)
            <li>{{ $item->service->name }} × {{ $item->quantity }} — {{ number_format($item->quantity * $item->price_at_add, 2) }} ر.س</li>
        @endforeach
    </ul>
    <div class="total">الإجمالي: {{ number_format($total, 2) }} ر.س</div>

    <form action="{{ route('order.store') }}" method="POST">
        @csrf
        <label>الاسم</label>
        <input type="text" name="customer_name" required>
        <label>الهاتف</label>
        <input type="text" name="customer_phone" required>
        <label>العنوان</label>
        <textarea name="customer_address"></textarea>
        <button type="submit">تأكيد وإنشاء الفاتورة</button>
    </form>
@endsection
