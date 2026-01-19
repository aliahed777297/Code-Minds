<div class="container">
    <h2 style="text-align: center; margin-bottom: 2rem; position: relative;">
        تواصل معنا
        <div style="width: 100px; height: 4px; background: var(--gradient-primary); margin: 1rem auto 0; border-radius: 2px;"></div>
    </h2>
    <div style="max-width: 500px; margin: 0 auto;">
        <form class="card" action="{{ route('contact.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">الاسم الكامل</label>
                    <input type="text" name="name" class="form-control" placeholder="أدخل اسمك الكامل" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">البريد الإلكتروني</label>
                    <input type="email" name="email" class="form-control" placeholder="example@email.com" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">رقم الهاتف</label>
                    <input type="tel" name="phone" class="form-control" placeholder="05xxxxxxxx" value="{{ old('phone') }}" required>
                    @error('phone')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">الرسالة</label>
                    <textarea name="message" class="form-control" rows="4" placeholder="اكتب رسالتك هنا..." required>{{ old('message') }}</textarea>
                    @error('message')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <button class="btn" style="width: 100%;">إرسال الرسالة</button>
            </div>
        </form>
    </div>
</div>