<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إنشاء حساب</title>
    <link href="{{ asset('css/global.css') }}" rel="stylesheet">
    <style>
        .register-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        input {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
        }
        button {
            width: 100%;
            padding: 10px;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>إنشاء حساب جديد</h2>
        
        @if($errors->any())
            <div style="color: red; margin-bottom: 15px;">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>الاسم الكامل:</label>
                <input type="text" name="name" value="{{ old('name') }}" required>
                @error('name') <div style="color:red">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label>البريد الإلكتروني:</label>
                <input type="email" name="email" value="{{ old('email') }}" required>
                @error('email') <div style="color:red">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label>كلمة المرور:</label>
                <input type="password" name="password" required minlength="6">
                @error('password') <div style="color:red">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label>تأكيد كلمة المرور:</label>
                <input type="password" name="password_confirmation" required>
            </div>

            <button type="submit">إنشاء حساب</button>
        </form>
        
        <p style="text-align: center; margin-top: 15px;">
            لديك حساب بالفعل؟ <a href="{{ route('login') }}">سجل دخول</a>
        </p>
    </div>
</body>
</html>