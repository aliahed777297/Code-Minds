@extends('layout.main')

@section('content')
    <h1>تسجيل الدخول</h1>

    @if($errors->any())
        <div class="errors">
            <ul>
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login.post') }}">
        @csrf
        <label for="email">البريد الإلكتروني</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>

        <label for="password">كلمة المرور</label>
        <input id="password" type="password" name="password" required>

        <label>
            <input type="checkbox" name="remember"> تذكرني
        </label>

        <button type="submit">تسجيل الدخول</button>
    </form>

@endsection
