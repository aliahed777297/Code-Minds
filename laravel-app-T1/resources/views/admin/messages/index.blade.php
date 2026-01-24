@extends('admin.layout')

@section('title','الرسائل')

@section('content')
<div class="card">
    <h3>رسائل التواصل</h3>
    <table>
        <thead>
            <tr>
                <th>الاسم</th>
                <th>البريد</th>
                <th>الموضوع</th>
                <th>تاريخ الاستلام</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($messages as $message)
                <tr>
                    <td>{{ $message->name }}</td>
                    <td>{{ $message->email }}</td>
                    <td>{{ Str::limit($message->subject ?? $message->message, 50) }}</td>
                    <td>{{ $message->created_at->format('Y-m-d') }}</td>
                    <td style="white-space:nowrap">
                        <a href="{{ route('admin.messages.show', $message->id) }}" class="btn">عرض</a>
                        <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('حذف الرسالة؟');">
                            @csrf
                            @method('DELETE')
                            <button class="btn" type="submit">حذف</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top:12px">{{ $messages->links() }}</div>
</div>
@endsection