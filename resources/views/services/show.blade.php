@extends('layout.main')

@push('styles')
    <link rel="stylesheet" href="/css/services.css">
@endpush

@section('content')
    <article class="service-detail">
        <header class="detail-header">
            <h1 class="service-title">{{ $service->name }}</h1>
            <div class="service-actions">
                <form method="POST" action="{{ route('cart.add') }}">
                    @csrf
                    <input type="hidden" name="service_id" value="{{ $service->id }}">
                    <button class="btn primary">أضف إلى السلة — {{ $service->formatted_price }}</button>
                </form>
            </div>
        </header>

        <section class="detail-body">
            <div class="media">
                <div class="placeholder-img large">صورة الخدمة</div>
            </div>
            <div class="meta">
                <h2>الوصف</h2>
                <p>{{ $service->description }}</p>

                <dl class="attributes">
                    <dt>السعر</dt>
                    <dd>{{ $service->formatted_price }}</dd>
                    @if($service->duration_formatted)
                        <dt>المدة</dt>
                        <dd>{{ $service->duration_formatted }}</dd>
                    @endif
                </dl>
            </div>
        </section>
    </article>
@endsection
