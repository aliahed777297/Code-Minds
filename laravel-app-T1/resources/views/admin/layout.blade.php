<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>لوحة التحكم - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <style>
        body { font-family: sans-serif; background:#f5f7fb; }
        .admin-wrapper { display:flex; min-height:100vh; }
        .admin-sidebar { width:250px; background:#1f2937; color:#fff; padding:20px; }
        .admin-sidebar a{ color:#cbd5e1; display:block; padding:8px 0; text-decoration:none }
        .admin-sidebar a.active{ color:#fff; font-weight:600 }
        .admin-main { flex:1; padding:24px; }
        .admin-top { display:flex; justify-content:space-between; align-items:center; margin-bottom:18px }
        .card { background:#fff; border-radius:8px; padding:18px; box-shadow:0 1px 3px rgba(0,0,0,0.06); }
        .stats { display:flex; gap:12px; }
        .stat { padding:12px; background:#fff; border-radius:8px; min-width:120px; text-align:center }
        table { width:100%; border-collapse:collapse }
        th,td { padding:10px; border-bottom:1px solid #eee; text-align:right }
        .btn { display:inline-block; padding:8px 12px; border-radius:6px; text-decoration:none }
        .btn-primary{ background:#2563eb; color:#fff }
        .btn-ghost{ background:transparent; border:1px solid #ddd }
    </style>
    @stack('styles')
</head>
<body>
    <div class="admin-wrapper">
        <aside class="admin-sidebar">
            <h2 style="margin-top:0">لوحة التحكم</h2>
            <nav>
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">الرئيسية</a>
                <a href="{{ route('admin.services.index') }}" class="{{ request()->routeIs('admin.services.*') ? 'active' : '' }}">الخدمات</a>
                <a href="{{ route('admin.orders.index') }}" class="{{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">الطلبات</a>
                <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">المستخدمون</a>
                <a href="{{ route('admin.messages.index') }}" class="{{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">الرسائل</a>
                <a href="/" style="margin-top:20px">عودة للموقع</a>
            </nav>
        </aside>

        <main class="admin-main">
            <div class="admin-top">
                <div>
                    <h1>@yield('title')</h1>
                    @if(session('success'))
                        <div style="color:green">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div style="color:red">{{ session('error') }}</div>
                    @endif
                </div>
                <div>
                    <span>مرحباً، {{ auth()->user()->name ?? 'المشرف' }}</span>
                </div>
            </div>

            <div class="content">
                @yield('content')
            </div>
        </main>
    </div>

    @stack('scripts')
</body>
</html>