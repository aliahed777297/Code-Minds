@extends('layout.main')
@section('content')
    <div class="contact-hero">
        <div class="container">
            <h1>تواصل معنا</h1>
            <p>أرسل لنا رسالة وسنرد عليك في أقرب وقت.</p>
        </div>
    </div>

    <div class="container contact-form-wrap">
        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="error-messages">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="contact-form" action="{{ route('contact.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>الاسم</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="{{ $errors->has('name') ? 'input-error' : '' }}">
                @if($errors->has('name'))
                    <div class="field-error">{{ $errors->first('name') }}</div>
                @endif
            </div>

            <div class="form-group">
                <label>البريد الإلكتروني</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="{{ $errors->has('email') ? 'input-error' : '' }}">
                @if($errors->has('email'))
                    <div class="field-error">{{ $errors->first('email') }}</div>
                @endif
            </div>

            <div class="form-group">
                <label>الهاتف</label>
                <input type="text" name="phone" value="{{ old('phone') }}" required class="{{ $errors->has('phone') ? 'input-error' : '' }}">
                @if($errors->has('phone'))
                    <div class="field-error">{{ $errors->first('phone') }}</div>
                @endif
            </div>

            <div class="form-group">
                <label>الرسالة</label>
                <textarea name="message" rows="6" required class="{{ $errors->has('message') ? 'input-error' : '' }}">{{ old('message') }}</textarea>
                @if($errors->has('message'))
                    <div class="field-error">{{ $errors->first('message') }}</div>
                @endif
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
document.addEventListener('DOMContentLoaded', function() {
    const messageTextarea = document.querySelector('textarea[name="message"]');
    const charCount = document.getElementById('char-count');

    // عداد الأحرف للرسالة
    messageTextarea.addEventListener('input', function() {
        const count = this.value.length;
        charCount.textContent = count;

        // تغيير لون العداد حسب الحد
        if (count > 300) {
            charCount.style.color = '#dc3545'; // أحمر
        } else if (count > 250) {
            charCount.style.color = '#ffc107'; // أصفر
        } else {
            charCount.style.color = '#666'; // رمادي
        }
    });

    // التحقق الأولي للعداد
    messageTextarea.dispatchEvent(new Event('input'));
});
</script>
