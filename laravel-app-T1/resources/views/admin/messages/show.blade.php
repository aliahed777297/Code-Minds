@extends('admin.layout')

@section('title','عرض الرسالة')

@section('content')
<div class="card">
    <h3>{{ $message->subject ?? 'رسالة جديدة' }}</h3>
    <p><strong>من:</strong> {{ $message->name }} &lt;{{ $message->email }}&gt;</p>
    <p><strong>تاريخ الاستلام:</strong> {{ $message->created_at->format('Y-m-d H:i') }}</p>

    <div style="padding:12px; background:#fff; border-radius:6px; margin-top:12px">{!! nl2br(e($message->message)) !!}</div>

    <a href="{{ route('admin.messages.index') }}" class="btn">عودة</a>
</div>
@endsection