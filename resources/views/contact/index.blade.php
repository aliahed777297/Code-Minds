@extends('layout.main')
@push('styles')
    <link rel="stylesheet" href="/css/contact.css">
@endpush
@section('content')
    <div class="contact-hero">
        <div class="container">
            <h1>تواصل معنا</h1>
            <p>أرسل لنا رسالة وسنرد عليك في أقرب وقت.</p>
        </div>
    </div>

    <div class="container contact-form-wrap">
        <form id="contact-form" class="ajax-form" action="{{ route('contact.store') }}" method="POST">
            @csrf
            <label>الاسم</label>
            <input type="text" name="name" required>

            <label>البريد الإلكتروني</label>
            <input type="email" name="email">

            <label>الهاتف</label>
            <input type="text" name="phone">

            <label>الرسالة</label>
            <textarea name="message" rows="6" required></textarea>

            <button class="btn" type="submit">إرسال الرسالة</button>
        </form>
    </div>
@endsection
