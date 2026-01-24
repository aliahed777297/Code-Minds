@extends('layout.main')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/payment.css') }}">
@endpush

@section('content')
<div class="container">
    <div class="payment-page">
        <div class="payment-card">
            <div class="payment-header">
                <h1>إتمام الدفع</h1>
                <div class="order-meta">طلب رقم: <strong>#{{ $order->order_number }}</strong></div>
            </div>

            <div class="payment-body">
                <aside class="summary-panel">
                    <div class="summary-head">
                        <h3>ملخص الطلب</h3>
                        <div class="items-count">{{ $order->items->count() }} خدمات</div>
                    </div>

                    <div class="summary-body">
                        <div class="summary-line">
                            <span>المجموع الفرعي</span>
                            <span>{{ number_format($order->subtotal,2) }} ر.س</span>
                        </div>

                        <div class="summary-line">
                            <span>الضريبة (15%)</span>
                            <span>{{ number_format($order->tax,2) }} ر.س</span>
                        </div>

                        <div class="summary-line total-line">
                            <span>الإجمالي</span>
                            <span class="total-amount">{{ number_format($order->total,2) }} ر.س</span>
                        </div>
                    </div>

                    <div class="summary-note">سيتم تحصيل المبلغ عند إتمام الدفع آمنًا عبر بوابة الدفع.</div>
                </aside>

                <div class="form-panel">
                    <form id="payment-form" action="{{ route('payment.process', $order->id) }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label>طريقة الدفع</label>
                            <div class="payment-methods">
                                <label class="pm">
                                    <input type="radio" name="method" value="card" checked>
                                    بطاقة دفع (فيزا / ماستر كارد)
                                </label>
                                <label class="pm">
                                    <input type="radio" name="method" value="stc">
                                    STC Pay
                                </label>
                                <label class="pm disabled">
                                    <input type="radio" name="method" value="cod" disabled>
                                    الدفع عند الاستلام
                                </label>
                            </div>
                        </div>

                        <div class="card-fields">
                            <div class="form-row">
                                <label>رقم البطاقة</label>
                                <input type="text" name="card_number" placeholder="---- ---- ---- ----" autocomplete="cc-number" required>
                            </div>
                            <div class="form-row small">
                                <label>الاسم على البطاقة</label>
                                <input type="text" name="card_name" placeholder="اسم حامل البطاقة" autocomplete="cc-name" required>
                            </div>
                            <div class="form-row inline">
                                <div>
                                    <label>تاريخ الانتهاء</label>
                                    <input type="text" name="card_expiry" placeholder="MM/YY" autocomplete="cc-exp" required>
                                </div>
                                <div>
                                    <label>رمز التحقق (CVV)</label>
                                    <input type="password" name="card_cvv" placeholder="●●●" autocomplete="cc-csc" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button id="pay-btn" type="submit" class="btn btn-primary">تأكيد الدفع</button>
                            <a href="{{ route('order.show', $order->id) }}" class="btn btn-ghost">العودة لتفاصيل الطلب</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function(){
    const form = document.getElementById('payment-form');
    const btn = document.getElementById('pay-btn');
    form.addEventListener('submit', function(e){
        btn.disabled = true;
        btn.textContent = 'جارٍ المعالجة...';
    });
});
</script>
@endpush

@endsection
