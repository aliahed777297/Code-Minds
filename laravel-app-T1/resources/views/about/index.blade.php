@extends('layout.main')

@push('styles')
    <link rel="stylesheet" href="/css/about.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endpush

@section('content')
    <!-- Hero Section مع تأثيرات متطورة -->
    <section class="about-hero">
        <div class="hero-overlay"></div>
        <div class="animated-bg"></div>
        <div class="container">
            <div class="hero-content">
                <div class="hero-badge">
                    <span>⭐ الرائدة منذ 2010</span>
                </div>
                <h1 class="animate-on-scroll">
                    <span class="gradient-text">نظافة بمعايير</span>
                    <span class="highlight">فاخرة</span>
                </h1>
                <p class="hero-subtitle">نحول العناية بملابسك إلى تجربة استثنائية بلمسات احترافية واهتمام بالتفاصيل</p>
                <div class="hero-actions">
                    <a class="btn btn-primary" href="{{ route('contact.show') }}">
                        <i class="fas fa-comments"></i> تواصل معنا
                    </a>
                    <a class="btn btn-secondary" href="{{ route('services.index') }}">
                        <i class="fas fa-concierge-bell"></i> استعرض خدماتنا
                    </a>
                </div>
            </div>
            <div class="hero-stats">
                <div class="stat-item">
                    <h3>+15,000</h3>
                    <p>عميل واثق</p>
                </div>
                <div class="stat-item">
                    <h3>99.8%</h3>
                    <p>رضا العملاء</p>
                </div>
                <div class="stat-item">
                    <h3>24/7</h3>
                    <p>دعم فني</p>
                </div>
            </div>
        </div>
    </section>

    <!-- قيمنا مع تأثيرات hover متطورة -->
    <section class="about-values">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">ما يميزنا</h2>
                <p class="section-subtitle">التفوق في كل تفصيل</p>
            </div>
            
            <div class="values-grid">
                <div class="value-card">
                    <div class="card-icon">
                        <i class="fas fa-award"></i>
                    </div>
                    <h3>جودة مضمونة</h3>
                    <p>نستخدم مواد عضوية آمنة وتقنيات أوروبية متقدمة للحفاظ على أقمشتك وكأنها جديدة.</p>
                    <div class="card-footer">
                        <span class="certified">معتمدة من ECOCERT</span>
                    </div>
                </div>
                
                <div class="value-card">
                    <div class="card-icon">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h3>توصيل فوري</h3>
                    <p>خدمة توصيل ذكية خلال ساعتين في نطاق المدينة، مع تتبع حي لطلبك.</p>
                    <div class="card-footer">
                        <span class="certified">ضمن نطاق 50 كم</span>
                    </div>
                </div>
                
                <div class="value-card">
                    <div class="card-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h3>دعم استثنائي</h3>
                    <p>فريق خدمة عملاء مدرب على أعلى مستوى، متاح عبر الواتساب والهاتف والبريد.</p>
                    <div class="card-footer">
                        <span class="certified">متعدد اللغات</span>
                    </div>
                </div>
                
                <div class="value-card">
                    <div class="card-icon">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <h3>بيئة مستدامة</h3>
                    <p>نستخدم مواد صديقة للبيئة ونساهم في إعادة تدوير المياه بنسبة 90%.</p>
                    <div class="card-footer">
                        <span class="certified">خضراء ومسؤولة</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Process Timeline -->
    <section class="process-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">رحلة النظافة</h2>
                <p class="section-subtitle">كيف نضمن لك تجربة سلسة</p>
            </div>
            
            <div class="process-timeline">
                <div class="process-step">
                    <div class="step-number">1</div>
                    <div class="step-content">
                        <h3>الحجز الذكي</h3>
                        <p>احجز عبر التطبيق أو الموقع بخدمة التقاط من الباب</p>
                    </div>
                </div>
                
                <div class="process-step">
                    <div class="step-number">2</div>
                    <div class="step-content">
                        <h3>التصنيف الاحترافي</h3>
                        <p>فرز دقيق حسب الألوان والأقمشة ونوع البقع</p>
                    </div>
                </div>
                
                <div class="process-step">
                    <div class="step-number">3</div>
                    <div class="step-content">
                        <h3>التنظيف المتقن</h3>
                        <p>استخدام تقنيات الغسيل بالبخار والتعقيم بالأوزون</p>
                    </div>
                </div>
                
                <div class="process-step">
                    <div class="step-number">4</div>
                    <div class="step-content">
                        <h3>التسليم الفاخر</h3>
                        <p>تغليف أنيق وتسليم في الوقت المحدد</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="testimonials">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">ثقة عملائنا</h2>
                <p class="section-subtitle">كلمات تغمرنا بالفخر</p>
            </div>
            
            <div class="testimonials-grid">
                <div class="testimonial-card">
                    <div class="rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">"تجربة استثنائية! ملابسي تعود وكأنها جديدة كل مرة."</p>
                    <div class="client-info">
                        <h4>أحمد السعدون</h4>
                        <span>عميل منذ 2018</span>
                    </div>
                </div>
                
                <div class="testimonial-card">
                    <div class="rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <p class="testimonial-text">"الدقة في المواعيد والجودة الفائقة جعلتهم اختياري الدائم."</p>
                    <div class="client-info">
                        <h4>فاطمة القحطاني</h4>
                        <span>عميلة منذ 2020</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <h2>جاهزون لخدمتك</h2>
                <p>انضم إلى آلاف العملاء الراضين عن خدماتنا الفاخرة</p>
                <div class="cta-buttons">
                    <a href="tel:+966500000000" class="btn btn-light">
                        <i class="fas fa-phone"></i> اتصل الآن
                    </a>
                    <a href="https://wa.me/966500000000" class="btn btn-whatsapp">
                        <i class="fab fa-whatsapp"></i> واتساب
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        // Animation on scroll
        document.addEventListener('DOMContentLoaded', function() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animated');
                    }
                });
            }, { threshold: 0.1 });
            
            document.querySelectorAll('.animate-on-scroll').forEach(el => observer.observe(el));
            
            // Counter animation for stats
            const stats = document.querySelectorAll('.stat-item h3');
            stats.forEach(stat => {
                const target = parseInt(stat.textContent);
                let current = 0;
                const increment = target / 50;
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        current = target;
                        clearInterval(timer);
                    }
                    stat.textContent = Math.floor(current).toLocaleString();
                }, 30);
            });
        });
    </script>
@endpush