@extends('layout.main')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/order.css') }}">
@endpush

@section('content')
<div class="container">
    <div class="order-detail-container">
        <div class="order-header-section">
            <div class="back-button">
                <a href="{{ route('orders.index') }}" class="btn-back">
                    <i class="fas fa-arrow-right"></i> العودة للطلبات
                </a>
            </div>
            
            <div class="order-title-section">
                <h1 class="order-title">تفاصيل الطلب</h1>
                <div class="order-number">#{{ $order->order_number }}</div>
            </div>
            
            <div class="order-status-section">
                <div class="status-display">
                    <div class="status-item">
                        <span class="status-label">حالة الطلب:</span>
                        <span class="status-value {{ $order->status }}">{{ $order->status_arabic }}</span>
                    </div>
                    <div class="status-item">
                        <span class="status-label">حالة الدفع:</span>
                        <span class="status-value {{ $order->payment_status }}">{{ $order->payment_status_arabic }}</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="order-detail-grid">
            <div class="order-items-section">
                <div class="section-header">
                    <h2 class="section-title">الخدمات المطلوبة</h2>
                </div>
                
                <div class="items-list">
                    @foreach($order->items as $item)
                    <div class="detail-item">
                        <div class="item-info">
                            <h4 class="item-name">{{ $item->service_name }}</h4>
                            @if($item->service)
                            <p class="item-description">{{ Str::limit($item->service->description, 100) }}</p>
                            @endif
                            <div class="item-meta">
                                <span class="meta-tag">الكمية: {{ $item->quantity }}</span>
                                <span class="meta-tag">سعر الوحدة: {{ number_format($item->price, 2) }} ر.س</span>
                            </div>
                        </div>
                        <div class="item-total">
                            <span class="total-amount">{{ number_format($item->total, 2) }} ر.س</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            
            <div class="order-summary-section">
                <div class="summary-card">
                    <h3 class="summary-title">ملخص الطلب</h3>
                    
                    <div class="summary-details">
                        <div class="summary-row">
                            <span>رقم الطلب:</span>
                            <span>{{ $order->order_number }}</span>
                        </div>
                        <div class="summary-row">
                            <span>تاريخ الطلب:</span>
                            <span>{{ $order->formatted_date }}</span>
                        </div>
                        
                        @if($order->customer_name)
                        <div class="summary-row">
                            <span>اسم العميل:</span>
                            <span>{{ $order->customer_name }}</span>
                        </div>
                        @endif
                        
                        @if($order->customer_email)
                        <div class="summary-row">
                            <span>البريد الإلكتروني:</span>
                            <span>{{ $order->customer_email }}</span>
                        </div>
                        @endif
                        
                        <div class="summary-row">
                            <span>المجموع الفرعي:</span>
                            <span>{{ number_format($order->subtotal, 2) }} ر.س</span>
                        </div>
                        
                        <div class="summary-row">
                            <span>الضريبة (15%):</span>
                            <span>{{ number_format($order->tax, 2) }} ر.س</span>
                        </div>
                        
                        <div class="summary-row total">
                            <span>الإجمالي:</span>
                            <span class="grand-total">{{ number_format($order->total, 2) }} ر.س</span>
                        </div>
                    </div>
                    
                    <div class="summary-actions">
                        <a href="{{ route('invoice.show', $order->id) }}" class="btn-invoice">
                            <i class="fas fa-file-pdf"></i> تحميل الفاتورة
                        </a>
                        
                        @if($order->status == 'pending' && $order->payment_status == 'pending')
                        <a href="{{ route('payment.create', $order->id) }}" class="btn-pay-now">
                            <i class="fas fa-credit-card"></i> إتمام الدفع
                        </a>
                        @endif
                    </div>
                </div>
                
                @if($order->notes)
                <div class="notes-card">
                    <h4>ملاحظات إضافية</h4>
                    <p>{{ $order->notes }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection