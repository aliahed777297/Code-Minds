@extends('admin.layout')

@section('title','إدارة المستخدمين')

@section('content')
<div class="card">
    <a href="{{ route('admin.users.create') }}" class="btn" style="margin-bottom:10px">
    + إنشاء مستخدم
</a>
    <h3>المستخدمون</h3>
    <table>
        <thead>
            <tr>
                <th>الاسم</th>
                <th>البريد</th>
                <th>مشرف</th>
                <th>تاريخ الإنشاء</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->is_admin ? 'نعم' : 'لا' }}</td>
                    <td>{{ $user->created_at->format('Y-m-d') }}</td>
                    <td style="white-space:nowrap">
                        <a href="{{ route('admin.users.show', $user->id) }}" class="btn">عرض</a>
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('حذف المستخدم؟');">
                            @csrf
                            @method('DELETE')
                            <button class="btn" type="submit">حذف</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top:12px">{{ $users->links() }}</div>
</div>
@endsection