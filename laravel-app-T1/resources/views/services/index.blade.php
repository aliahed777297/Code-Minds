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
>>>>>>> Stashed changes
    </div>

    <div class="services-grid" aria-live="polite">
      @forelse ($services as $service)
        <article class="svc-card" role="article">
          <div class="svc-media" style="--ar: 4/3;">
            @if($service->image)
              <img
                src="{{ asset($service->image) }}"
                alt="{{ $service->name }}"
                loading="lazy"
                decoding="async"
              >
            @else
              <div class="svc-media__placeholder" aria-hidden="true">No Image</div>
            @endif
            <div class="svc-media__overlay" aria-hidden="true"></div>
          </div>

          <div class="svc-body">
            <h3 class="svc-title" title="{{ $service->name }}">{{ $service->name }}</h3>

            <p class="svc-desc">
              {{ $service->description ?? 'وصف مختصر للخدمة سيظهر هنا.' }}
            </p>

            <div class="svc-meta">
              @if ($service->duration_minutes)
                <span class="svc-chip">المدة: {{ $service->duration_minutes }} دقيقة</span>
              @endif
              <span class="svc-price">{{ number_format($service->price, 2) }} <small>ر.س</small></span>
            </div>
          </div>

          <div class="svc-actions">
            <form action="{{ route('cart.add') }}" method="POST" class="svc-form">
              @csrf
              <input type="hidden" name="service_id" value="{{ $service->id }}">
              <input type="hidden" name="quantity" value="1">
              <button type="submit" class="btn btn-primary">أضف إلى السلة</button>
            </form>

            <button
              type="button"
              class="btn btn-secondary js-open-details"
              data-id="{{ $service->id }}"
              data-name="{{ e($service->name) }}"
              data-desc="{{ e($service->description ?? '') }}"
              data-price="{{ number_format($service->price, 2) }}"
              data-duration="{{ $service->duration_minutes ?? '' }}"
              data-image="{{ $service->image ? asset($service->image) : '' }}"
              aria-haspopup="dialog"
            >
              <span class="btn-ic" aria-hidden="true">👁</span>
              التفاصيل
            </button>
          </div>
        </article>
      @empty
        <div class="no-services-found">
          <p>عفواً، لم يتم العثور على أي خدمات متاحة في الوقت الحالي.</p>
        </div>
      @endforelse
    </div>
  </div>

  {{-- Modal --}}
  <div class="svc-modal" id="svcModal" aria-hidden="true" role="dialog" aria-modal="true">
    <div class="svc-modal__backdrop" data-close="1"></div>

    <div class="svc-modal__panel" role="document">
      <button class="svc-modal__close" type="button" data-close="1" aria-label="إغلاق">✕</button>

      <div class="svc-modal__content">
        <div class="svc-modal__media" id="mImageWrap">
          <img id="mImage" alt="" />
          <div class="svc-modal__overlay" aria-hidden="true"></div>
        </div>

        <div class="svc-modal__body">
          <h3 class="svc-modal__title" id="mTitle"></h3>
          <p class="svc-modal__desc" id="mDesc"></p>

          <div class="svc-modal__meta">
            <span class="svc-modal__price" id="mPrice"></span>
            <span class="svc-modal__chip" id="mDuration"></span>
          </div>

          <div class="svc-modal__note">
            <strong>ملاحظة:</strong> تنفيذ احترافي + عناية بالخامة + ضمان جودة.
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script src="{{ asset('js/services.js') }}" defer></script>
@endpush
=======
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
=======
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
>>>>>>> Stashed changes
    </div>

    <div class="services-grid" aria-live="polite">
      @forelse ($services as $service)
        <article class="svc-card" role="article">
          <div class="svc-media" style="--ar: 4/3;">
            @if($service->image)
              <img
                src="{{ asset($service->image) }}"
                alt="{{ $service->name }}"
                loading="lazy"
                decoding="async"
              >
            @else
              <div class="svc-media__placeholder" aria-hidden="true">No Image</div>
            @endif
            <div class="svc-media__overlay" aria-hidden="true"></div>
          </div>

          <div class="svc-body">
            <h3 class="svc-title" title="{{ $service->name }}">{{ $service->name }}</h3>

            <p class="svc-desc">
              {{ $service->description ?? 'وصف مختصر للخدمة سيظهر هنا.' }}
            </p>

            <div class="svc-meta">
              @if ($service->duration_minutes)
                <span class="svc-chip">المدة: {{ $service->duration_minutes }} دقيقة</span>
              @endif
              <span class="svc-price">{{ number_format($service->price, 2) }} <small>ر.س</small></span>
            </div>
          </div>

          <div class="svc-actions">
            <form action="{{ route('cart.add') }}" method="POST" class="svc-form">
              @csrf
              <input type="hidden" name="service_id" value="{{ $service->id }}">
              <input type="hidden" name="quantity" value="1">
              <button type="submit" class="btn btn-primary">أضف إلى السلة</button>
            </form>

            <button
              type="button"
              class="btn btn-secondary js-open-details"
              data-id="{{ $service->id }}"
              data-name="{{ e($service->name) }}"
              data-desc="{{ e($service->description ?? '') }}"
              data-price="{{ number_format($service->price, 2) }}"
              data-duration="{{ $service->duration_minutes ?? '' }}"
              data-image="{{ $service->image ? asset($service->image) : '' }}"
              aria-haspopup="dialog"
            >
              <span class="btn-ic" aria-hidden="true">👁</span>
              التفاصيل
            </button>
          </div>
        </article>
      @empty
        <div class="no-services-found">
          <p>عفواً، لم يتم العثور على أي خدمات متاحة في الوقت الحالي.</p>
        </div>
      @endforelse
    </div>
  </div>

  {{-- Modal --}}
  <div class="svc-modal" id="svcModal" aria-hidden="true" role="dialog" aria-modal="true">
    <div class="svc-modal__backdrop" data-close="1"></div>

    <div class="svc-modal__panel" role="document">
      <button class="svc-modal__close" type="button" data-close="1" aria-label="إغلاق">✕</button>

      <div class="svc-modal__content">
        <div class="svc-modal__media" id="mImageWrap">
          <img id="mImage" alt="" />
          <div class="svc-modal__overlay" aria-hidden="true"></div>
        </div>

        <div class="svc-modal__body">
          <h3 class="svc-modal__title" id="mTitle"></h3>
          <p class="svc-modal__desc" id="mDesc"></p>

          <div class="svc-modal__meta">
            <span class="svc-modal__price" id="mPrice"></span>
            <span class="svc-modal__chip" id="mDuration"></span>
          </div>

          <div class="svc-modal__note">
            <strong>ملاحظة:</strong> تنفيذ احترافي + عناية بالخامة + ضمان جودة.
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script src="{{ asset('js/services.js') }}" defer></script>
@endpush
