<!doctype html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/colors.css">
    <link rel="stylesheet" href="/css/typography.css">
    <link rel="stylesheet" href="/css/layout.css">
    <link rel="stylesheet" href="/css/global.css">
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" href="/css/backgrounds-shapes.css">
    <link rel="stylesheet" href="/css/home.css">
    <link rel="stylesheet" href="/css/about.css">
    <link rel="stylesheet" href="/css/contact.css">
    <link rel="stylesheet" href="/css/cart.css">
    <link rel="stylesheet" href="/css/order.css">
    <link rel="stylesheet" href="/css/invoice.css">
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
