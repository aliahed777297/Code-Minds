@extends('layout.main')
@push('styles')
    <link rel="stylesheet" href="/css/about.css">
@endpush
@section('content')
    <section class="about-hero">
        <div class="container">
            <h1>نبذة عن المغسلة</h1>
            <p>نحن نقدم خدمات غسيل وكي وتنظيف مفروشات بمستوى احترافي واهتمام بالتفاصيل. مهمتنا هي توفير نظافة موثوقة بسرعة وراحة.</p>
            <a class="btn" href="{{ route('contact.show') }}">تواصل معنا</a>
        </div>
    </section>

    <section class="about-values container">
        <div class="card elevate">
            <h3>جودة مضمونة</h3>
            <p>نستخدم مواد آمنة وتقنيات متقدمة للحفاظ على ملابسك.</p>
        </div>
        <div class="card elevate">
            <h3>توصيل سريع</h3>
            <p>خدمات سريعة ومرنة لتلبية احتياجاتك اليومية.</p>
        </div>
        <div class="card elevate">
            <h3>خدمة عملاء مميزة</h3>
            <p>فريقنا جاهز لمساعدتك والإجابة عن استفساراتك.</p>
        </div>
    </section>
@endsection
