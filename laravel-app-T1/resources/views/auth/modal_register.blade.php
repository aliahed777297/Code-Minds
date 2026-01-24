<div class="auth-modal-panel" id="auth-register" style="display:none" aria-hidden="true">
    <div class="auth-inner">
        <h3>إنشاء حساب جديد</h3>

        <div class="auth-error" style="display:none">
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            @endif
        </div>

        <form action="{{ route('register') }}" method="POST" class="auth-form">
            @csrf
            <div class="form-group">
                <label>الاسم الكامل</label>
                <input type="text" name="name" required>
            </div>

            <div class="form-group">
                <label>البريد الإلكتروني</label>
                <input type="email" name="email" required>
            </div>

            <div class="form-group">
                <label>كلمة المرور</label>
                <input type="password" name="password" required minlength="6">
            </div>

            <div class="form-group">
                <label>تأكيد كلمة المرور</label>
                <input type="password" name="password_confirmation" required>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">إنشاء حساب</button>
                <button type="button" class="btn btn-ghost" data-switch-to="login">لدي حساب بالفعل</button>
            </div>
        </form>
    </div>
</div>
