@extends('admin.layout')

@section('title', 'لوحة التحكم')

@section('content')
    <div class="card">
        <div class="stats">
            <div class="stat">
                <div style="font-size:20px">{{ $stats['services_count'] }}</div>
                خدمات
            </div>
            <div class="stat">
                <div style="font-size:20px">{{ $stats['orders_count'] }}</div>
                طلبات
            </div>
            <div class="stat">
                <div style="font-size:20px">{{ $stats['users_count'] }}</div>
                مستخدمون
            </div>
            <div class="stat">
                <div style="font-size:20px">{{ $stats['messages_count'] }}</div>
                رسائل
            </div>
        </div>
    </div>

    <div style="margin-top:18px">
        <div class="card">
            <h3>آخر الخدمات</h3>
            <p>يمكنك إدارة الخدمات من صفحة الخدمات.</p>
        </div>
    </div>
@endsection