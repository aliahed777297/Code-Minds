{{-- Updated by: زياد الشاوش — قمت بتحديث واجهة services --}}
@extends('layout.main')

@push('styles')
    <link rel="stylesheet" href="/css/services.css">
@endpush

@section('content')
    <section class="services-hero">
        <h1 class="page-title">الخدمات</h1>
        <p class="lead">اختَر الخدمة المناسبة — تصميم واضح وسهل الاستخدام.</p>

        <form class="services-filter" method="GET" action="{{ route('services.index') }}" aria-label="بحث وتصفية الخدمات">
            <div class="row">
                <input name="q" type="search" placeholder="ابحث باسم الخدمة أو الوصف" value="{{ request('q') }}" aria-label="بحث"/>
                <input name="min_price" type="number" step="0.01" placeholder="السعر من" value="{{ request('min_price') }}"/>
                <input name="max_price" type="number" step="0.01" placeholder="السعر إلى" value="{{ request('max_price') }}"/>
                <input name="duration_max" type="number" placeholder="المدة (دقيقة)" value="{{ request('duration_max') }}"/>
                <select name="sort" aria-label="ترتيب">
                    <option value="">ترتيب افتراضي</option>
                    <option value="price_asc" {{ request('sort')=='price_asc' ? 'selected' : '' }}>الأقل سعراً</option>
                    <option value="price_desc" {{ request('sort')=='price_desc' ? 'selected' : '' }}>الأعلى سعراً</option>
                    <option value="duration_asc" {{ request('sort')=='duration_asc' ? 'selected' : '' }}>الأقصر مدة</option>
                    <option value="duration_desc" {{ request('sort')=='duration_desc' ? 'selected' : '' }}>الأطول مدة</option>
                </select>
                <button class="btn" type="submit">تطبيق</button>
            </div>
        </form>
    </section>

    <section class="services-grid">
        @if($services->count())
            <div class="grid">
                @foreach($services as $service)
                    @include('services.partials._card', ['service' => $service])
                @endforeach
            </div>

            <div class="pagination">{{ $services->links() }}</div>
        @else
            <div class="empty-state">لم يتم العثور على خدمات مطابقة.</div>
        @endif
    </section>

@endsection
@extends('layout.main')
@push('styles')
    <link rel="stylesheet" href="/css/home.css">
@endpush
@section('content')
    <h1 class="fade-in">قائمة الخدمات</h1>
    <div class="services-grid" aria-live="polite">
        <div class="service-card fade-in" role="article">
            <h3>خدمة تجريبية A</h3>
            <p>وصف بسيط للخدمة. gddd واجهة عرض فقط.</p>
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
