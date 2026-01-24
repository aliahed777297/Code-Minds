@extends('admin.layout')

@section('title', 'إدارة الخدمات')

@section('content')
    <div class="card">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px">
            <h3 style="margin:0">قائمة الخدمات</h3>
            <a href="{{ route('admin.services.create') }}" class="btn btn-primary">إنشاء خدمة جديدة</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>الاسم</th>
                    <th>السعر</th>
                    <th>المدة (د)</th>
                    <th>تاريخ الإنشاء</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($services as $service)
                    <tr>
                        <td>{{ $service->name }}</td>
                        <td>{{ number_format($service->price,2) }} ر.س</td>
                        <td>{{ $service->duration_minutes }}</td>
                        <td>{{ $service->created_at->format('Y-m-d') }}</td>
                        <td style="white-space:nowrap">
                            <a href="{{ route('admin.services.edit', $service->id) }}" class="btn">تحرير</a>
                            <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('هل أنت متأكد من حذف هذه الخدمة؟');">
                                @csrf
                                @method('DELETE')
                                <button class="btn" type="submit">حذف</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="margin-top:12px">{{ $services->links() }}</div>
    </div>
@endsection