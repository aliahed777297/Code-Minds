@php $showLoginModal = session('show_login') ?? false; @endphp
<div class="auth-modal-panel" id="auth-login" style="display:{{ $showLoginModal ? 'block' : 'none' }}" aria-hidden="{{ $showLoginModal ? 'false' : 'true' }}">
    <div class="auth-inner">
        <h3>تسجيل الدخول</h3>
        <div class="auth-error" style="{{ $errors->any() ? 'display:block;color:red;margin-bottom:10px' : 'display:none' }}">
            @if($errors->any())
                @foreach($errors->all() as $err)
                    <div>{{ $err }}</div>
                @endforeach
            @endif
        </div>

        <form action="{{ route('login') }}" method="POST" class="auth-form">
            @csrf
            <div class="form-group">
                <label>البريد الإلكتروني</label>
                <input type="email" name="email" value="{{ old('email') }}" required>
                @error('email') <div style="color:red">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label>كلمة المرور</label>
                <input type="password" name="password" required>
                @error('password') <div style="color:red">{{ $message }}</div> @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">تسجيل الدخول</button>
                <button type="button" class="btn btn-ghost" data-switch-to="register">إنشاء حساب</button>
            </div>
        </form>
    </div>
</div>
