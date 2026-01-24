@extends('admin.layout')

@section('title', 'تعديل خدمة')

@section('content')
    <div class="card">
        <form action="{{ route('admin.services.update', $service->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div style="margin-bottom:12px">
                <label>الاسم</label>
                <input type="text" name="name" value="{{ old('name', $service->name) }}" required style="width:100%;padding:8px">
                @error('name') <div style="color:red">{{ $message }}</div> @enderror
            </div>

            <div style="margin-bottom:12px">
                <label>الوصف</label>
                <textarea name="description" style="width:100%;padding:8px">{{ old('description', $service->description) }}</textarea>
                @error('description') <div style="color:red">{{ $message }}</div> @enderror
            </div>

            <div style="display:flex; gap:8px; margin-bottom:12px">
                <div style="flex:1">
                    <label>السعر (ر.س)</label>
                    <input type="number" name="price" step="0.01" value="{{ old('price', $service->price) }}" required style="width:100%;padding:8px">
                    @error('price') <div style="color:red">{{ $message }}</div> @enderror
                </div>
                <div style="width:140px">
                    <label>المدة (دقائق)</label>
                    <input type="number" name="duration_minutes" value="{{ old('duration_minutes', $service->duration_minutes) }}" style="width:100%;padding:8px">
                    @error('duration_minutes') <div style="color:red">{{ $message }}</div> @enderror
                </div>
            </div>

            <button class="btn btn-primary" type="submit">تحديث</button>
            <a href="{{ route('admin.services.index') }}" class="btn">إلغاء</a>
        </form>
    </div>
@endsection