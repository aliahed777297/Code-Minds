<!doctype html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>نظام المغسلة</title>
    <link rel="stylesheet" href="/css/global.css">
    <link rel="stylesheet" href="/css/header.css">
    @stack('styles')
</head>
<body>
    {{-- Header component (centralized partial) --}}
    @include('layout.header.header')

    <main class="container">
        @if(session('success'))
            <div class="flash success">{{ session('success') }}</div>
        @endif
        @yield('content')
    </main>

    {{-- Footer component (centralized partial) --}}
    @include('layout.footer.footer')
    <script src="/js/app.js"></script>
    
    <!-- Global modal placeholder -->
    <div id="global-modal" class="modal" style="display:none" aria-hidden="true">
        <div class="modal-backdrop"></div>
        <div class="modal-panel" role="dialog" aria-modal="true">
            <button class="modal-close" aria-label="إغلاق">✕</button>
            <div id="modal-content"></div>
        </div>
    </div>
</body>
</html>
