<header class="site-header">
    <nav class="navbar">
        <div class="container">
            <a class="brand" href="{{ route('home') }}">Code Minds</a>
            <button class="nav-toggle" aria-expanded="false" aria-controls="primary-navigation">☰</button>
            <ul id="primary-navigation" class="nav-links">
                <li><a href="#home" class="{{ request()->routeIs('home') ? 'active' : '' }}">الرئيسية</a></li>
                <li><a href="#services" class="{{ request()->routeIs('services.*') ? 'active' : '' }}">الخدمات</a></li>
                <li><a href="#about" class="{{ request()->routeIs('about') ? 'active' : '' }}">من نحن</a></li>
                <li>
                    <a href="{{ route('cart.index') }}" class="{{ request()->routeIs('cart.*') ? 'active' : '' }}">سلة الشراء
                        <span id="cart-count" class="cart-badge" aria-hidden="true">0</span>
                    </a>
                </li>
                <li><a href="{{ route('orders.index') }}" class="{{ request()->routeIs('orders.*') ? 'active' : '' }}">الطلبات</a></li>
                <li><a href="/contact" class="{{ request()->routeIs('contact.*') ? 'active' : '' }}">تواصل معنا</a></li>
            </ul>
        </div>
    </nav>
</header>
