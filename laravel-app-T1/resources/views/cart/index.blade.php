@extends('layout.main')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
@endpush

@section('content')
<div class="container">
    <h1 class="page-title">سلة التسوق</h1>
    
    @if($cartItems->count() > 0)
        <div class="cart-container">
            <div class="cart-grid">
                <div class="cart-items-list">
                @foreach($cartItems as $item)
                <div class="cart-item" data-item-id="{{ $item->id }}">
                    <div class="item-image">
                        @php
                            // pool of available fallback images in public/images
                            $imagePool = ['service-delivery.jpg','service-dryclean.jpg','service-sanitize.jpg','service-washfold.jpg'];
                            $serviceId = optional($item->service)->id ?? $item->service_id ?? 0;
                            $fallback = $imagePool[count($imagePool) ? $serviceId % count($imagePool) : 0] ?? $imagePool[0];
                            $imageName = optional($item->service)->image ?? $fallback;

                            // Normalize path: if stored value already contains 'images/' prefix, don't double it
                            if (strpos($imageName, 'images/') === 0 || strpos($imageName, '/images/') === 0) {
                                $image = ltrim($imageName, '/');
                            } else {
                                $image = 'images/' . $imageName;
                            }
                        @endphp
                        <img src="{{ asset($image) }}" alt="{{ optional($item->service)->name ?? 'خدمة' }}">
                    </div>
                    
                    <div class="item-details">
                        <h3 class="item-name">{{ optional($item->service)->name ?? 'خدمة' }}</h3>
                        <p class="item-description">{{ optional($item->service)->description ?? '' }}</p>
                        
                        <div class="item-meta">
                            <span class="price">
                                {{ number_format(optional($item->service)->price ?? $item->price_at_add, 2) }} ر.س
                            </span>
                            @if(optional($item->service)->duration_minutes)
                                <span class="duration">
                                    <i class="fas fa-clock"></i>
                                    {{ optional($item->service)->duration_minutes }} دقيقة
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="item-quantity">
                        <form action="{{ route('cart.update', $item->id) }}" method="POST" class="quantity-form">
                            @csrf
                            <div class="qty-control">
                                <button type="button" class="qty-btn minus" data-action="decrease">-</button>
                                <input type="number" name="quantity" value="{{ $item->quantity }}" 
                                    min="1" max="10" class="qty-input" readonly>
                                <button type="button" class="qty-btn plus" data-action="increase">+</button>
                            </div>
                        </form>
                    </div>
                    
                    <div class="item-subtotal">
                        <span class="subtotal">
                            {{ number_format($item->total, 2) }} ر.س
                        </span>
                    </div>
                    
                    <div class="item-actions">
                        <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="remove-btn" title="حذف">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
                </div>

                <div class="cart-summary">
                <div class="summary-card">
                    <h3>ملخص الطلب</h3>
                    
                    <div class="summary-row">
                        <span>عدد العناصر:</span>
                        <span>{{ $cartItems->count() }}</span>
                    </div>
                    
                    <div class="summary-row">
                        <span>المجموع الفرعي:</span>
                        <span>{{ number_format($total, 2) }} ر.س</span>
                    </div>
                    
                    <div class="summary-row">
                        <span>الضريبة (15%):</span>
                        <span>{{ number_format($total * 0.15, 2) }} ر.س</span>
                    </div>
                    
                    <div class="summary-row total">
                        <span>الإجمالي:</span>
                        <span>{{ number_format($total * 1.15, 2) }} ر.س</span>
                    </div>
                    
                    <div class="summary-actions">
                        <a href="{{ route('services.index') }}" class="btn-continue">
                            <i class="fas fa-arrow-right"></i> متابعة التسوق
                        </a>
                        
                        @auth
                        <form action="{{ route('order.store') }}" method="POST">
                            @csrf
                            <button type="submit" class="checkout-btn">
                                <i class="fas fa-shopping-bag"></i> إنشاء طلب
                            </button>
                        </form>
                        @else
                        <div class="login-required">
                            <p class="muted">يجب تسجيل الدخول لإنشاء طلب.</p>
                            <a href="{{ route('login') }}?redirect={{ urlencode(request()->fullUrl()) }}" class="checkout-btn">
                                <i class="fas fa-sign-in-alt"></i> تسجيل الدخول
                            </a>
                        </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
        
    @else
        <div class="empty-cart">
            <div class="empty-icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <h2>سلة التسوق فارغة</h2>
            <p>لم تقم بإضافة أي خدمات إلى السلة بعد</p>
            <a href="{{ route('services.index') }}" class="btn-primary">
                <i class="fas fa-concierge-bell"></i> تصفح الخدمات
            </a>
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // تحديث الكمية
    document.querySelectorAll('.qty-btn').forEach(button => {
        button.addEventListener('click', function() {
            const action = this.dataset.action;
            const input = this.parentElement.querySelector('.qty-input');
            let value = parseInt(input.value);
            
            if (action === 'increase' && value < 10) {
                input.value = value + 1;
                updateCartItem(this);
            } else if (action === 'decrease' && value > 1) {
                input.value = value - 1;
                updateCartItem(this);
            }
        });
    });
    
    function updateCartItem(button) {
        const form = button.closest('.quantity-form');
        form.submit();
    }
});
</script>
@endpush