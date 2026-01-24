@extends('layout.main')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/invoice.css') }}">
@endpush

@section('content')
<div class="invoice-container">
    <div class="invoice-header">
        <div class="brand">
            <h2>{{ config('app.name', 'متجري') }}</h2>
            <div class="brand-sub">فاتورة شراء</div>
        </div>

        <div class="invoice-actions">
            <a href="{{ route('orders.index') }}" class="btn btn-ghost">رجوع للطلبات</a>
            <button onclick="window.print()" class="btn btn-primary">طباعة</button>
        </div>
    </div>

    <div class="invoice-card">
        <div class="invoice-top">
            <div class="bill-to">
                <h4>فاتورة إلى</h4>
                <div class="name">{{ $order->customer_name ?? 'عميل' }}</div>
                <div class="email">{{ $order->customer_email ?? '' }}</div>
                @if($order->customer_phone)
                    <div class="phone">{{ $order->customer_phone }}</div>
                @endif
            </div>

            <div class="invoice-meta">
                <div><strong>رقم الطلب:</strong> {{ $order->order_number }}</div>
                <div><strong>التاريخ:</strong> {{ $order->formatted_date }}</div>
                <div><strong>الحالة:</strong> {{ $order->status_arabic }}</div>
            </div>
        </div>

        <div class="invoice-table-wrap">
            <table class="invoice-table">
                <thead>
                    <tr>
                        <th class="w-60">الوصف</th>
                        <th class="w-10">الكمية</th>
                        <th class="w-15">سعر الوحدة</th>
                        <th class="w-15">المجموع</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                    <tr>
                        <td>
                            <div class="desc">{{ $item->service->name ?? $item->service_name }}</div>
                            @if($item->service)
                                <div class="muted">{{ Str::limit($item->service->description, 80) }}</div>
                            @endif
                        </td>
                        <td class="text-center">{{ $item->quantity }}</td>
                        <td class="text-right">{{ number_format($item->price, 2) }} ر.س</td>
                        <td class="text-right">{{ number_format($item->total, 2) }} ر.س</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="invoice-summary">
            <div class="summary-row">
                <div>المجموع الفرعي</div>
                <div>{{ number_format($order->subtotal, 2) }} ر.س</div>
            </div>
            <div class="summary-row">
                <div>الضريبة (15%)</div>
                <div>{{ number_format($order->tax, 2) }} ر.س</div>
            </div>
            <div class="summary-row grand">
                <div>الإجمالي</div>
                <div>{{ number_format($order->total, 2) }} ر.س</div>
            </div>
        </div>

        @if($order->notes)
        <div class="invoice-notes">
            <h4>ملاحظات</h4>
            <p>{{ $order->notes }}</p>
        </div>
        @endif
    </div>
</div>

@endsection
