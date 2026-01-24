@extends('admin.layout')

@section('title','إدارة الطلبات')

@section('content')
<div class="card">
    <h3>الطلبات</h3>
    <table>
        <thead>
            <tr>
                <th>رقم الطلب</th>
                <th>المستخدم</th>
                <th>المجموع</th>
                <th>الحالة</th>
                <th>تاريخ الإنشاء</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>#{{ $order->id }}</td>
                    <td>{{ $order->user->name ?? 'زائر' }}</td>
                    <td>{{ number_format($order->total ?? 0,2) }} ر.س</td>
                    <td>{{ $order->status ?? '—' }}</td>
                    <td>{{ $order->created_at->format('Y-m-d') }}</td>
                    <td style="white-space:nowrap">
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn">تفاصيل</a>
                        <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('حذف الطلب؟');">
                            @csrf
                            @method('DELETE')
                            <button class="btn" type="submit">حذف</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top:12px">{{ $orders->links() }}</div>
</div>
@endsection