@extends('admin.layout')

@section('title','إنشاء مستخدم')

@section('content')
<div class="card">
    <h3>إنشاء مستخدم جديد</h3>

    <form method="POST" action="{{ route('admin.users.store') }}">
        @csrf

        <div>
            <label>الاسم</label>
            <input type="text" name="name" required>
        </div>

        <div>
            <label>البريد الإلكتروني</label>
            <input type="email" name="email" required>
        </div>

        <div>
            <label>كلمة المرور</label>
            <input type="password" name="password" required>
        </div>

        <div>
            <label>تأكيد كلمة المرور</label>
            <input type="password" name="password_confirmation" required>
        </div>

        <div>
            <label>
                <input type="checkbox" name="is_admin" value="1">
                مشرف
            </label>
        </div>

        <button type="submit" class="btn">حفظ</button>
        <a href="{{ route('admin.users.index') }}" class="btn">إلغاء</a>
    </form>
</div>
@endsection
