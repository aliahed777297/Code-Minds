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

    {{-- رسالة النجاح --}}
    @if (session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif

    {{-- أخطاء عامة --}}
    @if ($errors->any())
        <div class="error-messages">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="contact-form" action="{{ route('contact.store') }}" method="POST" novalidate>
        @csrf

        {{-- الاسم --}}
        <div class="form-group">
            <label for="name">الاسم</label>
            <input
                id="name"
                type="text"
                name="name"
                value="{{ old('name') }}"
                class="@error('name') input-error @enderror"
                required
            >
            @error('name')
                <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        {{-- البريد --}}
        <div class="form-group">
            <label for="email">البريد الإلكتروني</label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                class="@error('email') input-error @enderror"
                required
            >
            @error('email')
                <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        {{-- الهاتف --}}
        <div class="form-group">
            <label for="phone">الهاتف</label>
            <input
                id="phone"
                type="text"
                name="phone"
                value="{{ old('phone') }}"
                class="@error('phone') input-error @enderror"
                required
            >
            @error('phone')
                <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        {{-- الرسالة --}}
        <div class="form-group">
            <label for="message">الرسالة</label>
            <textarea
                id="message"
                name="message"
                rows="6"
                maxlength="300"
                class="@error('message') input-error @enderror"
                required
            >{{ old('message') }}</textarea>

            @error('message')
                <div class="field-error">{{ $message }}</div>
            @enderror

            <div class="char-counter">
                عدد الأحرف: <span id="char-count">0</span>/300
            </div>
        </div>

        <button class="btn" type="submit">إرسال الرسالة</button>
    </form>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const textarea = document.getElementById('message');
    const counter = document.getElementById('char-count');

    const updateCounter = () => {
        const count = textarea.value.length;
        counter.textContent = count;

        counter.style.color =
            count > 300 ? '#dc3545' :
            count > 250 ? '#ffc107' :
            '#666';
    };

    textarea.addEventListener('input', updateCounter);
    updateCounter();
});
</script>
@endpush
