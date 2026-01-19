@extends('layout.main')
@section('content')
    <h1>سلة الشراء</h1>
    <p>هذه واجهة عرض للسلة فقط — لا تُحمّل بيانات من قاعدة البيانات.</p>
    <table class="cart-table">
        <thead>
            <tr>
                <th>الخدمة</th>
                <th>الكمية</th>
                <th>السعر لكل وحدة</th>
                <th>الإجمالي</th>
            </tr>
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
    <div class="cart-summary">المجموع: <span id="cart-total">49.00</span> ر.س</div>
    <a class="btn" href="#">تأكيد الطلب</a>
@endsection
