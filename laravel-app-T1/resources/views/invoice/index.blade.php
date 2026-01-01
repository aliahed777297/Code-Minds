@extends('layout.main')
@push('styles')
    <link rel="stylesheet" href="/css/invoice.css">
@endpush
@section('content')
    <h1>فاتورة (عرض فقط)</h1>
    <div class="customer">
        <p>الاسم: زبون تجريبي</p>
        <p>الهاتف: 0500000000</p>
        <p>التاريخ: 2025-12-30 12:00</p>
    </div>
    <table class="invoice-table">
        <thead>
            <tr><th>الخدمة</th><th>الكمية</th><th>سعر الوحدة</th><th>المجموع</th></tr>
        </thead>
        <tbody>
            <tr>
                <td>خدمة تجريبية</td>
                <td>1</td>
                <td>49.00</td>
                <td>49.00</td>
            </tr>
        </tbody>
    </table>
    <div class="invoice-total">الإجمالي: 49.00 ر.س</div>
@endsection
