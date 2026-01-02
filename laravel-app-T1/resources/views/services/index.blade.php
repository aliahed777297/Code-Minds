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
                        <button type="button" class="btn-ghost js-open-details" data-id="{{ $service->id }}" data-name="{{ $service->name }}" data-desc="{{ $service->description }}" data-price="{{ number_format($service->price, 2) }}" data-duration="{{ $service->duration_minutes }}" data-image="{{ $randomImage ? asset($randomImage) : '' }}">تفاصيل</button>
                    </div>
                </div>
            @empty
                <div class="no-services-found">
                    <p>عفواً، لم يتم العثور على أي خدمات متاحة في الوقت الحالي.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Modal for Service Details -->
    <div id="svcModal" class="modal" aria-hidden="true" role="dialog" aria-labelledby="mTitle">
        <div class="modal-overlay" data-close></div>
        <div class="modal-content">
            <button class="modal-close" data-close aria-label="إغلاق النافذة">×</button>
            <div id="mImageWrap" class="modal-image-wrap">
                <img id="mImage" src="" alt="">
            </div>
            <div class="modal-body">
                <h2 id="mTitle" class="modal-title"></h2>
                <p id="mDesc" class="modal-description"></p>
                <div class="modal-meta">
                    <span id="mDuration" class="modal-duration"></span>
                    <span id="mPrice" class="modal-price"></span>
                </div>
                <div class="modal-actions">
                    <form action="{{ route('cart.add') }}" method="POST" id="add-to-cart-form">
                        @csrf
                        <input type="hidden" name="service_id" id="modal-service-id" value="">
                        <label for="modal-quantity">الكمية:</label>
                        <input type="number" id="modal-quantity" name="quantity" value="1" min="1">
                    </form>
                    <div class="modal-buttons">
                        <button type="button" class="btn-ghost" data-close>إلغاء</button>
                        <button type="submit" class="btn-primary" form="add-to-cart-form">أضف إلى السلة</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
 <script src="{{ asset('js/services.js') }}" defer></script>
@endpush
