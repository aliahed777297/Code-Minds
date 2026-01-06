@extends('layout.main')

@push('styles')
    <link rel="stylesheet" href="/css/home.css">
@endpush

@push('scripts')
    <script defer src="/js/home.js"></script>
@endpush

@section('content')
<div class="home-root" dir="rtl" lang="ar">

    {{-- 1) Top Section – Services Carousel (UI Only) --}}
    <section class="home-hero" aria-label="خدمات المغسلة">
        <div class="container">
            <header class="hero-head">
                <div class="hero-text">
                    <h1 class="hero-title">مغسلة موثوقة… نظافة تليق بك</h1>
                    <p class="hero-subtitle">
                        خدمات غسيل وكي وتنظيف جاف بجودة عالية   
                    </p>
                </div>
            </header>

            <div class="glb-carousel" data-glb-carousel aria-roledescription="carousel" aria-label="سلايدر الخدمات">
                <div class="glb-viewport" data-glb-viewport>
                    <div class="glb-track" data-glb-track>

                        {{-- Slide 1 --}}
                        <article class="glb-slide" data-glb-slide aria-label="1 من 4">
                            <div class="glb-media">
                                <img class="glb-img" src="/images/gallery/service-dryclean.jpg" alt="تنظيف جاف احترافي">
                            </div>
                            <div class="glb-overlay" aria-hidden="true"></div>

                            {{-- Hover text (CENTERED) --}}
                            <div class="glb-hover" aria-hidden="true">
                                <div class="glb-hover-inner">
                                    <h3 class="glb-hover-title">تنظيف جاف احترافي</h3>
                                    <p class="glb-hover-text">
                                        عناية بالبدلات والفساتين والأقمشة الحساسة بنتائج فاخرة ورائحة منعشة.
                                    </p>
                                </div>
                            </div>
                        </article>

                        {{-- Slide 2 --}}
                        <article class="glb-slide" data-glb-slide aria-label="2 من 4">
                            <div class="glb-media">
                                <img class="glb-img" src="/images/gallery/service-washfold.jpg" alt="غسيل وكوي يومي">
                            </div>
                            <div class="glb-overlay" aria-hidden="true"></div>

                            <div class="glb-hover" aria-hidden="true">
                                <div class="glb-hover-inner">
                                    <h3 class="glb-hover-title">غسيل وكوي يومي</h3>
                                    <p class="glb-hover-text">
                                        تنظيف مرتب، كوي احترافي، وتغليف أنيق — مناسب للعائلات والطلاب.
                                    </p>
                                </div>
                            </div>
                        </article>

                        {{-- Slide 3 --}}
                        <article class="glb-slide" data-glb-slide aria-label="3 من 4">
                            <div class="glb-media">
                                <img class="glb-img" src="/images/gallery/service-sanitize.jpg" alt="تعقيم وتنظيف آمن">
                            </div>
                            <div class="glb-overlay" aria-hidden="true"></div>

                            <div class="glb-hover" aria-hidden="true">
                                <div class="glb-hover-inner">
                                    <h3 class="glb-hover-title">تعقيم وتنظيف آمن</h3>
                                    <p class="glb-hover-text">
                                        تنظيف يراعي القماش ويقلّل الحساسية… مع اهتمام بالتفاصيل.
                                    </p>
                                </div>
                            </div>
                        </article>

                        {{-- Slide 4 --}}
                        <article class="glb-slide" data-glb-slide aria-label="4 من 4">
                            <div class="glb-media">
                                <img class="glb-img" src="/images/gallery/service-delivery.jpg" alt="استلام وتسليم سريع">
                            </div>
                            <div class="glb-overlay" aria-hidden="true"></div>

                            <div class="glb-hover" aria-hidden="true">
                                <div class="glb-hover-inner">
                                    <h3 class="glb-hover-title">استلام وتسليم سريع</h3>
                                    <p class="glb-hover-text">
                                        نستلم ونوصل حسب الموعد — خدمة مريحة لتوفير وقتك.
                                    </p>
                                </div>
                            </div>
                        </article>

                    </div>
                </div>

                {{-- Navigation (خارجي — ليس أزرار داخل السلايد) --}}
                <button class="glb-nav prev" type="button" data-glb-prev aria-label="السابق">‹</button>
                <button class="glb-nav next" type="button" data-glb-next aria-label="التالي">›</button>

                <div class="glb-dots" data-glb-dots aria-label="مؤشرات السلايدر"></div>
            </div>

        </div>
    </section>

    {{-- 2) Statistics & Customer Satisfaction --}}
    <section class="home-stats" aria-label="إحصائيات وثقة العملاء">
        <div class="container">
            <header class="section-head">
                <h2 class="section-title">ثقة العملاء بالأرقام</h2>
                <p class="section-subtitle">مؤشرات ثابتة (Placeholder) لرفع الثقة وتشجيع التفاعل.</p>
            </header>

            <div class="stats-grid">
                <article class="stat-card reveal-on-scroll">
                    <div class="stat-top">
                        <div class="stat-icon" aria-hidden="true">⭐</div>
                        <div class="stat-value">
                            <span class="countup" data-count="98">0</span><span class="unit">%</span>
                        </div>
                    </div>
                    <div class="stat-label">رضا العملاء</div>
                    <div class="progress" role="progressbar" aria-label="نسبة رضا العملاء" aria-valuemin="0" aria-valuemax="100" aria-valuenow="98">
                        <span class="progress-fill" style="--fill:98%"></span>
                    </div>
                    <p class="stat-hint">تقييمات مرتفعة بفضل الجودة والالتزام بالمواعيد.</p>
                </article>

                <article class="stat-card reveal-on-scroll">
                    <div class="stat-top">
                        <div class="stat-icon" aria-hidden="true">🧺</div>
                        <div class="stat-value">
                            <span class="countup" data-count="12450">0</span><span class="unit">+</span>
                        </div>
                    </div>
                    <div class="stat-label">طلبات مكتملة</div>
                    <div class="progress" role="progressbar" aria-label="مؤشر الطلبات المكتملة" aria-valuemin="0" aria-valuemax="100" aria-valuenow="86">
                        <span class="progress-fill" style="--fill:86%"></span>
                    </div>
                    <p class="stat-hint">حجم تنفيذ كبير مع معايير جودة ثابتة.</p>
                </article>

                <article class="stat-card reveal-on-scroll">
                    <div class="stat-top">
                        <div class="stat-icon" aria-hidden="true">😊</div>
                        <div class="stat-value">
                            <span class="countup" data-count="8900">0</span><span class="unit">+</span>
                        </div>
                    </div>
                    <div class="stat-label">عملاء سعداء</div>
                    <div class="progress" role="progressbar" aria-label="مؤشر العملاء السعداء" aria-valuemin="0" aria-valuemax="100" aria-valuenow="92">
                        <span class="progress-fill" style="--fill:92%"></span>
                    </div>
                    <p class="stat-hint">نكرر التجربة لأن الخدمة تستحق.</p>
                </article>
            </div>
        </div>
    </section>

    {{-- 3) Laundry Work Gallery --}}
    section class="home-gallery" aria-label="معرض أعمال المغسلة">
  <div class="container">
    <header class="section-head">
      <h2 class="section-title">معرض الأعمال</h2>
      <p class="section-subtitle">نماذج من نتائج الغسيل والكوي والتغليف — صور حقيقية.</p>
    </header>

    <div class="gallery-grid" data-gallery>
      @php
        $gallery = [
          ['src' => '/images/gallery/1.png', 'title' => 'تنظيف جاف', 'desc' => 'نتيجة نظيفة بدون تأثير على القماش'],
          ['src' => '/images/gallery/2.png', 'title' => 'كوي احترافي', 'desc' => 'تسوية مرتبة وتجعيدات أقل'],
          ['src' => '/images/gallery/3.png', 'title' => 'غسيل عائلي', 'desc' => 'ترتيب وتغليف جاهز للاستلام'],
          ['src' => '/images/gallery/4.png', 'title' => 'تعقيم', 'desc' => 'تنظيف آمن ورائحة منعشة'],
          ['src' => '/images/gallery/5.png', 'title' => 'قبل/بعد', 'desc' => 'فرق واضح في النظافة واللمعة'],
          ['src' => '/images/gallery/6.png', 'title' => 'أقمشة حساسة', 'desc' => 'عناية خاصة للأقمشة الفخمة'],
          ['src' => '/images/gallery/7.png', 'title' => 'تغليف أنيق', 'desc' => 'تغليف مرتب يحافظ على الكوي'],
          ['src' => '/images/gallery/8.png', 'title' => 'جاهز للتسليم', 'desc' => 'تجهيز سريع مع جودة ثابتة'],
        ];
      @endphp

      @foreach($gallery as $item)
        <figure class="gallery-card reveal-on-scroll" tabindex="0">
          <div class="gallery-media">
            <img class="gallery-img" src="{{ $item['src'] }}" alt="{{ $item['title'] }}">
            <div class="gallery-overlay" aria-hidden="true">
              <div class="gallery-overlay-text">
                <div class="g-title">{{ $item['title'] }}</div>
                <div class="g-desc">{{ $item['desc'] }}</div>
              </div>
            </div>
          </div>
        </figure>
      @endforeach
    </div>
  </div>
   </section>

</div>
@endsection
