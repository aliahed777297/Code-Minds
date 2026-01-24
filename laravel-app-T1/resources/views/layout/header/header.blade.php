<header class="site-header">
    <nav class="navbar container">
        <!-- زر القائمة والشعار -->
        <div class="mobile-header">
            <button class="mobile-menu-btn" id="mobileMenuBtn" aria-label="فتح القائمة" aria-expanded="false">
                <i class="fas fa-bars"></i>
            </button>

            <div class="logo-container">
                <div class="logo">
                    <a href="{{ route('home') }}" aria-label="الصفحة الرئيسية - LaundryPro">
                        <i class="fas fa-tshirt"></i>
                        <div class="logo-text">
                            <span class="logo-main">LaundryPro</span>
                            <span class="logo-tagline">مغسلة عالمية - جودة واستدامة</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- الروابط -->
        <div class="nav-right">
            <ul class="nav-links" id="navLinks" role="navigation" aria-label="القائمة الرئيسية">
                <li class="{{ request()->routeIs('home') ? 'active' : '' }}">
                    <a href="{{ route('home') }}" aria-label="الصفحة الرئيسية">
                        <i class="fas fa-home"></i>
                        <span>الرئيسية</span>
                    </a>
                </li>

                <li class="{{ request()->routeIs('services.*') ? 'active' : '' }}">
                    <a href="{{ route('services.index') }}" aria-label="الخدمات">
                        <i class="fas fa-concierge-bell"></i>
                        <span>الخدمات</span>
                    </a>
                </li>

             

              <li class="{{ request()->routeIs('cart.*') ? 'active' : '' }}">
    <a href="{{ route('cart.index') }}" aria-label="السلة">
        <i class="fas fa-shopping-cart"></i>
        <span>سلة الشراء</span>
        @php
            if (auth()->check()) {
                $cartCount = \App\Models\CartItem::where('user_id', auth()->id())->count();
            } else {
                $sessionId = session('guest_session_id') ?? session()->getId();
                $cartCount = $sessionId ? \App\Models\CartItem::where('session_id', $sessionId)->count() : 0;
            }
        @endphp
        @if($cartCount > 0)
            <span class="cart-badge">{{ $cartCount }}</span>
        @endif
    </a>
</li>

                <li class="{{ request()->routeIs('orders.*') ? 'active' : '' }}">
                    <a href="{{ route('orders.index') }}" aria-label="الطلبات">
                        <i class="fas fa-receipt"></i>
                        <span>الطلبات</span>
                    </a>
                </li>

                   <li class="{{ request()->routeIs('about') ? 'active' : '' }}">
                    <a href="{{ route('about') }}" aria-label="من نحن">
                        <i class="fas fa-users"></i>
                        <span>من نحن</span>
                    </a>
                </li>

                <li class="{{ request()->routeIs('contact.*') ? 'active' : '' }}">
                    <a href="{{ route('contact.show') }}" aria-label="تواصل معنا">
                        <i class="fas fa-phone-alt"></i>
                        <span>تواصل معنا</span>
                    </a>
                </li>
            </ul>
            <!-- أضف هذا فقط - قسم المصادقة -->
                @auth
                    <div class="user-info">
                        <span>مرحباً {{ auth()->user()->name }}</span>
                        @if(auth()->user()->is_admin ?? false)
                            <a href="{{ route('admin.dashboard') }}" class="btn admin-btn" style="margin-inline-start:8px;background:#f59e0b;color:#fff;padding:6px 10px;border-radius:6px;">
                                <i class="fas fa-user-shield" aria-hidden="true" style="margin-inline-start:6px"></i>
                                لوحة التحكم
                            </a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                            @csrf
                            <button type="submit" class="logout-btn">تسجيل الخروج</button>
                        </form>
                    </div>
                @else
                    <a href="#" class="login-btn" id="open-auth-modal">تسجيل الدخول</a>
                @endauth
        </div>
    </nav>


</header>
