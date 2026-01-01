@extends('layout.main')
@push('styles')
    <link rel="stylesheet" href="/css/home.css">
@endpush
@section('content')
    <div class="home-root">
    {{-- واجهة عرض ثابتة للصفحة الرئيسية — لا تُحمّل بيانات ديناميكية --}}
    <section class="hero-static fade-in" aria-label="الصفحة الرئيسية">
        <div class="container">
            <h1>الصفحة الرئيسية</h1>
            <p>واجهة عرض فقط: هنا تعرض صفحة الهوم بدون بيانات تجريبية أو ديناميكية.</p>
            <div class="placeholder-cards">
                <div class="card">شريط ترويجي 1 (نص تجريبي)</div>
                <div class="card">شريط ترويجي 2 (نص تجريبي)</div>
                <div class="card">شريط ترويجي 3 (نص تجريبي)</div>
            </div>
        </div>
    </section>
    </div>
@endsection
