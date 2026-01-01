@extends('layout.main')
@push('styles')
    <link rel="stylesheet" href="/css/order.css">
@endpush
@section('content')
    <h1>قائمة الطلبات</h1>
    <p>واجهة عرض لقائمة الطلبات — لا تُظهر بيانات حقيقية.</p>
    <ul class="orders-list">
        <li class="order-card">
            <div>طلب #0001 — 2025-12-30</div>
            <div>اسم: زبون تجريبي</div>
            <div>المجموع: 99.00 ر.س</div>
            <div><a class="btn" href="#">عرض الفاتورة</a></div>
        </li>
    </ul>
@endsection
