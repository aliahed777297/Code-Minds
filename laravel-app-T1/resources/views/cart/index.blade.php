@extends('layout.main')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/cart.css') }}">
@endpush

@section('content')
<div class="cart-container">
    <h1>سلة التسوق</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($items->isEmpty())
        <div class="empty-cart">السلة فارغة</div>
    @else
        <table class="cart-table">
            <thead>
                <tr>
                    <th>الخدمة</th>
                    <th>الكمية</th>
                    <th>السعر</th>
                    <th>الإجمالي</th>
                    <th>خيارات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr>
                    <td>{{ $item->service->name }}</td>
                    <td>
                        <form action="{{ route('cart.update', $item->id) }}" method="POST">
                            @csrf
                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1">
                            <button type="submit" class="update-btn">تحديث</button>
                        </form>
                    </td>
                    <td>{{ number_format($item->price_at_add, 2) }} ريال</td>
                    <td>{{ number_format($item->quantity * $item->price_at_add, 2) }} ريال</td>
                    <td>
                        <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="danger">حذف</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="cart-summary">
            <h3>الإجمالي: {{ number_format($total, 2) }} ريال</h3>
            <form action="{{ route('cart.checkout') }}" method="POST">
                @csrf
                <button type="submit" class="checkout-btn">إتمام الشراء</button>
            </form>
        </div>
    @endif
</div>
@endsection
