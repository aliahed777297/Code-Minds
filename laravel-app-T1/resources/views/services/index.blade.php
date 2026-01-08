@extends('layout.main')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/services.css') }}">
@endpush

@section('content')
    <div class="container">
        <h1 class="fade-in">قائمة الخدمات</h1>
        <div class="services-grid" aria-live="polite">
            @forelse ($services as $service)
                @php
                    $randomImage = count($imageFiles) ? $imageFiles[array_rand($imageFiles)] : null;
                @endphp

                <div class="service-card fade-in" role="article">
                    {{-- صورة عشوائية --}}
                    @if($randomImage)
                        <div class="service-image">
                            <img src="{{ asset($randomImage) }}" alt="{{ $service->name }}">
                        </div>
                    @endif

                    <div class="service-details">
                        <h3>{{ $service->name }}</h3>
                        <p>{{ $service->description }}</p>
                        <div class="meta">
                            @if ($service->duration_minutes)
                                <span>المدة: {{ $service->duration_minutes }} دقيقة</span>
                            @endif
                        </div>
                        <div class="price">{{ number_format($service->price, 2) }} ر.س</div>
                    </div>

                    <div class="actions">
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="service_id" value="{{ $service->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="btn-primary">أضف إلى السلة</button>
                        </form>
                        <a href="{{ route('service.show', $service->id) }}" class="btn-ghost">تفاصيل</a>
                    </div>
                </div>
            @empty
                <div class="no-services-found">
                    <p>عفواً، لم يتم العثور على أي خدمات متاحة في الوقت الحالي.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/services.js') }}" defer></script>
@endpush
