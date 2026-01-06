<!doctype html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>نظام المغسلة</title>

    {{-- Icons / Fonts --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    {{-- 1) Global variables FIRST --}}
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">

    {{-- 2) Shared layout styles --}}
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">

    {{-- 3) Page-specific styles (home.css, about.css...) --}}
    @stack('styles')

    {{-- Scripts --}}
    <script defer src="{{ asset('js/header.js') }}"></script>
    @stack('scripts')
</head>

<body>
    {{-- Header component (centralized partial) --}}
    @include('layout.header.header')

    <main>
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
