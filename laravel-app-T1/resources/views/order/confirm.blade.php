@extends('layout.main')
@push('styles')
    <link rel="stylesheet" href="/css/order.css">
@endpush
@section('content')
    <h1>مراجعة الطلب</h1>
    <p>واجهة عرض لمراجعة الطلب — لا تُحمّل بيانات فعلية.</p>
    <ul class="order-items">
        <li>خدمة تجريبية × 1 — 49.00 ر.س</li>
    </ul>
    <div class="total">الإجمالي: 49.00 ر.س</div>

    <form action="#" method="POST">
        <label>الاسم</label>
        <input type="text" name="customer_name" required>
        <label>الهاتف</label>
        <input type="text" name="customer_phone" required>
        <label>العنوان</label>
        <textarea name="customer_address"></textarea>
        <button type="submit">تأكيد وإنشاء الفاتورة</button>
    </form>
@endsection
