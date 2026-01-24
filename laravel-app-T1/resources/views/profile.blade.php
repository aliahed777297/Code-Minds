@extends('layout.main')

@section('content')
<div class="container">
    <h1>الملف الشخصي</h1>
    <div class="profile-card">
        <div class="profile-header">
            <i class="fas fa-user-circle fa-4x"></i>
            <h2>{{ Auth::user()->name }}</h2>
            <p>{{ Auth::user()->email }}</p>
        </div>
        <div class="profile-stats">
            <div class="stat">
                <i class="fas fa-shopping-cart"></i>
                <span>عناصر في السلة: {{ Auth::user()->cartItems()->count() }}</span>
            </div>
            <div class="stat">
                <i class="fas fa-receipt"></i>
                <span>عدد الطلبات: {{ Auth::user()->orders()->count() }}</span>
            </div>
        </div>
    </div>
</div>
@endsection