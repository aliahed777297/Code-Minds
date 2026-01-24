@extends('admin.layout')

@section('title','عرض المستخدم')

@section('content')
<div class="card">
    <h3>{{ $user->name }}</h3>
    <p><strong>البريد:</strong> {{ $user->email }}</p>
    <p><strong>مشرف:</strong> {{ $user->is_admin ? 'نعم' : 'لا' }}</p>
    <p><strong>مُنشأ في:</strong> {{ $user->created_at->format('Y-m-d') }}</p>

    <a href="{{ route('admin.users.index') }}" class="btn">عودة</a>
</div>
@endsection