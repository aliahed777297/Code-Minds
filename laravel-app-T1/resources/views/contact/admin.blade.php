@extends('layout.main')
@push('styles')
    <link rel="stylesheet" href="/css/contact.css">
@endpush
@section('content')
    <div class="container">
        <h1>رسائل الاتصال</h1>
        @if($messages->count() > 0)
            <table class="messages-table">
                <thead>
                    <tr>
                        <th>الاسم</th>
                        <th>البريد الإلكتروني</th>
                        <th>الهاتف</th>
                        <th>الرسالة</th>
                        <th>التاريخ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($messages as $message)
                        <tr>
                            <td>{{ $message->name }}</td>
                            <td>{{ $message->email ?: '-' }}</td>
                            <td>{{ $message->phone ?: '-' }}</td>
                            <td>{{ strlen($message->message) > 100 ? substr($message->message, 0, 100) . '...' : $message->message }}</td>
                            <td>{{ $message->created_at->format('Y-m-d H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $messages->links() }}
        @else
            <p>لا توجد رسائل حتى الآن.</p>
        @endif
    </div>
@endsection