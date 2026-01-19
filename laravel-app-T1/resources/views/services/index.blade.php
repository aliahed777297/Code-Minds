@extends('layout.main')
@section('content')
    <h1 class="fade-in">قائمة الخدمات</h1>
    <div class="services-grid" aria-live="polite">
        <div class="service-card fade-in" role="article">
            <h3>خدمة تجريبية A</h3>
            <p>وصف بسيط للخدمة. هذه واجهة عرض فقط.</p>
            <div class="meta"><span>المدة: 30 دقيقة</span><span>المراتب: ⭐️⭐️⭐️⭐️</span></div>
            <div class="price">49.00 ر.س</div>
            <div class="actions">
                <button type="button" class="btn-ghost">تفاصيل</button>
            </div>
        </div>
        <div class="service-card fade-in" role="article">
            <h3>خدمة تجريبية B</h3>
            <p>وصف بسيط للخدمة. هذه واجهة عرض فقط.</p>
            <div class="meta"><span>المدة: 45 دقيقة</span><span>المراتب: ⭐️⭐️⭐️</span></div>
            <div class="price">69.00 ر.س</div>
            <div class="actions">
                <button type="button" class="btn-ghost">تفاصيل</button>
            </div>
        </div>
    </div>
@endsection
