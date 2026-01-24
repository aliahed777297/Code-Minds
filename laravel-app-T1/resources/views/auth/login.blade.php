<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تسجيل الدخول</title>
    <link href="{{ asset('css/global.css') }}" rel="stylesheet">
    <style>
        .login-container {
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
            background: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>تسجيل الدخول</h2>
        
        @if(session('error'))
            <div style="color: red; margin-bottom: 15px;">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div style="color: red; margin-bottom: 15px;">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>البريد الإلكتروني:</label>
                <input type="email" name="email" value="{{ old('email') }}" required>
                @error('email') <div style="color:red">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label>كلمة المرور:</label>
                <input type="password" name="password" required>
                @error('password') <div style="color:red">{{ $message }}</div> @enderror
            </div>

            <button type="submit">تسجيل الدخول</button>
        </form>
        
        <p style="text-align: center; margin-top: 15px;">
            لا تملك حساباً؟ <a href="{{ route('register') }}">أنشئ حساباً جديداً</a>
        </p>
    </div>
</body>
</html>