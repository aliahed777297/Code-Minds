@extends('layout.main')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/order.css') }}">
@endpush

@section('content')
<div class="container">
    <div class="page-header">
        <h1 class="page-title">طلباتي</h1>
        <p class="page-description">عرض جميع الطلبات السابقة والحالية</p>
    </div>
    
    @if($orders->count() > 0)
    <div class="orders-container">
        <div class="orders-list">
            @foreach($orders as $order)
            <div class="order-card">
                <div class="order-header">
                    <div class="order-meta">
                        <h3 class="order-number">طلب #{{ $order->order_number }}</h3>
                        <div class="order-date">{{ $order->formatted_date }}</div>
                    </div>
                    <div class="order-status-badge">
                        <span class="status-badge {{ $order->status }}">
                            {{ $order->status_arabic }}
                        </span>
                        <span class="payment-badge {{ $order->payment_status }}">
                            {{ $order->payment_status_arabic }}
                        </span>
                    </div>
                </div>
                
                <div class="order-body">
                    <div class="order-items-summary">
                        <div class="items-count">
                            <i class="fas fa-list"></i>
                            {{ $order->items->count() }} خدمات
                        </div>
                        <div class="items-preview">
                            @foreach($order->items->take(2) as $item)
                            <span class="item-tag">
                                {{ $item->service_name }} ({{ $item->quantity }}x)
                            </span>
                            @endforeach
                            @if($order->items->count() > 2)
                            <span class="more-items">+{{ $order->items->count() - 2 }} أخرى</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="order-total">
                        <span class="total-label">المجموع:</span>
                        <span class="total-amount">{{ number_format($order->total, 2) }} ر.س</span>
                    </div>
                </div>
                
                <div class="order-footer">
                    <div class="order-actions">
                        <a href="{{ route('order.show', $order->id) }}" class="btn-view">
                            <i class="fas fa-eye"></i> عرض التفاصيل
                        </a>
                        <a href="{{ route('invoice.show', $order->id) }}" class="btn-invoice">
                            <i class="fas fa-file-invoice"></i> الفاتورة
                        </a>
                        @if($order->status == 'pending' && $order->payment_status == 'pending')
                        <a href="{{ route('payment.create', $order->id) }}" class="btn-pay">
                            <i class="fas fa-credit-card"></i> دفع الآن
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        @if($orders->hasPages())
        <div class="pagination-container">
            {{ $orders->links() }}
        </div>
        @endif
    </div>
    @else
    <div class="empty-state">
        <div class="empty-icon">
            <i class="fas fa-shopping-bag"></i>
        </div>
        <h2 class="empty-title">لا توجد طلبات</h2>
        <p class="empty-description">لم تقم بإنشاء أي طلبات بعد. ابدأ بالتسوق الآن!</p>
        <div class="empty-actions">
            <a href="{{ route('services.index') }}" class="btn-primary">
                <i class="fas fa-concierge-bell"></i> تصفح الخدمات
            </a>
            <a href="{{ route('home') }}" class="btn-ghost">
                <i class="fas fa-home"></i> العودة للرئيسية
            </a>
        </div>
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // تحديث حالة الطلبات
    const statusBadges = document.querySelectorAll('.status-badge');
    
    statusBadges.forEach(badge => {
        const status = badge.classList[1];
        switch(status) {
            case 'completed':
                badge.style.backgroundColor = '#10b981';
                break;
            case 'processing':
                badge.style.backgroundColor = '#f59e0b';
                break;
            case 'pending':
                badge.style.backgroundColor = '#6b7280';
                break;
            case 'cancelled':
                badge.style.backgroundColor = '#ef4444';
                break;
        }
    });
});
</script>
@endpush