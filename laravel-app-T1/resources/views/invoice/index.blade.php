<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فاتورة الطلب #{{ $order->order_number }}</title>
    <link rel="stylesheet" href="{{ asset('css/invoice.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @media print {
            .no-print { display: none !important; }
            body { margin: 0; padding: 0; }
            .invoice-container { box-shadow: none !important; }
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="no-print invoice-actions">
            <button onclick="window.print()" class="btn-print">
                <i class="fas fa-print"></i> طباعة الفاتورة
            </button>
            <a href="{{ route('order.show', $order->id) }}" class="btn-back">
                <i class="fas fa-arrow-right"></i> العودة للطلب
            </a>
        </div>
        
        <div class="invoice-header">
            <div class="company-info">
                <h1 class="company-name">شركة الخدمات المتكاملة</h1>
                <div class="company-details">
                    <p><i class="fas fa-map-marker-alt"></i> الرياض، المملكة العربية السعودية</p>
                    <p><i class="fas fa-phone"></i> +966 11 123 4567</p>
                    <p><i class="fas fa-envelope"></i> info@company.com</p>
                    <p><i class="fas fa-globe"></i> www.company.com</p>
                </div>
            </div>
            
            <div class="invoice-title">
                <h2>فاتورة ضريبية</h2>
                <div class="invoice-number">رقم الفاتورة: {{ $order->order_number }}</div>
                <div class="invoice-date">تاريخ الفاتورة: {{ $order->formatted_date }}</div>
            </div>
        </div>
        
        <div class="invoice-body">
            <div class="customer-info">
                <h3>معلومات العميل</h3>
                <div class="customer-details">
                    <div class="detail-row">
                        <span>الاسم:</span>
                        <span>{{ $order->customer_name ?? $order->user->name ?? 'عميل' }}</span>
                    </div>
                    @if($order->customer_email ?? $order->user->email)
                    <div class="detail-row">
                        <span>البريد الإلكتروني:</span>
                        <span>{{ $order->customer_email ?? $order->user->email }}</span>
                    </div>
                    @endif
                    @if($order->customer_phone)
                    <div class="detail-row">
                        <span>رقم الهاتف:</span>
                        <span>{{ $order->customer_phone }}</span>
                    </div>
                    @endif
                </div>
            </div>
            
            <div class="invoice-items">
                <table class="items-table">
                    <thead>
                        <tr>
                            <th width="50">#</th>
                            <th>الخدمة</th>
                            <th width="100">الكمية</th>
                            <th width="120">سعر الوحدة</th>
                            <th width="150">المجموع</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->service_name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format($item->price, 2) }} ر.س</td>
                            <td>{{ number_format($item->total, 2) }} ر.س</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="invoice-summary">
                <div class="summary-section">
                    <div class="summary-row">
                        <span>المجموع الفرعي:</span>
                        <span>{{ number_format($order->subtotal, 2) }} ر.س</span>
                    </div>
                    <div class="summary-row">
                        <span>الضريبة المضافة (15%):</span>
                        <span>{{ number_format($order->tax, 2) }} ر.س</span>
                    </div>
                    <div class="summary-row total">
                        <span>الإجمالي المستحق:</span>
                        <span>{{ number_format($order->total, 2) }} ر.س</span>
                    </div>
                </div>
            </div>
            
            <div class="invoice-footer">
                <div class="payment-info">
                    <h4>معلومات الدفع</h4>
                    <p>حالة الدفع: <strong>{{ $order->payment_status_arabic }}</strong></p>
                    <p>طريقة الدفع: تحويل بنكي / بطاقة ائتمان</p>
                </div>
                
                <div class="company-stamp">
                    <div class="stamp">
                        <span>مختوم</span>
                    </div>
                </div>
            </div>
            
            <div class="invoice-notes">
                <h4>ملاحظات هامة</h4>
                <ul>
                    <li>يجب سداد المبلغ خلال 7 أيام من تاريخ الفاتورة</li>
                    <li>الفاتورة صالحة للخصم الضريبي</li>
                    <li>للاستفسارات يرجى الاتصال على 773389273</li>
                </ul>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.print();
        });
    </script>
</body>
</html>