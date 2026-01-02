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
        <p>سيتم استخدام بيانات الحساب لإنشاء الفاتورة.</p>
        <button type="submit">تأكيد وإنشاء الفاتورة</button>
    </form>
@endsection
