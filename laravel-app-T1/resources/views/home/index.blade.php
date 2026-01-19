@extends('layout.main')
@section('content')
    <div class="home-root">
        {{-- القسم الرئيسي --}}
        <section class="section hero-section" id="home" style="min-height: 80vh; display: flex; align-items: center;">
            {{-- الأشكال الهندسية --}}
            <div class="shape-circle shape-1"></div>
            <div class="shape-triangle shape-1"></div>
            <div class="shape-star shape-1"></div>
            <div class="shape-hexagon shape-1"></div>

            <div class="container">
                <h1 class="display-text text-gradient text-balance" style="text-align: center; margin-bottom: var(--spacing-24);">
                    منصة الخدمات التقنية
                </h1>
                <p class="body-large text-balance" style="text-align: center; color: var(--text-white); margin-bottom: var(--spacing-48); max-width: 600px; margin-left: auto; margin-right: auto;">
                    نقدم خدمات تقنية متميزة بأعلى جودة واحترافية مع تصميم جذاب يجذب الزوار
                </p>

                {{-- إحصائيات الثقة --}}
                <div class="trust-stats">
                    <div class="stat-card">
                        <div class="stat-value">500+</div>
                        <div class="stat-label">عميل راضي</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value">50+</div>
                        <div class="stat-label">خدمة تقنية</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value">98%</div>
                        <div class="stat-label">رضا العملاء</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value">24/7</div>
                        <div class="stat-label">دعم فني</div>
                    </div>
                </div>
            </div>
        </section>

        {{-- الخدمات --}}
        <section class="section services-section" id="services">
            {{-- الأشكال الهندسية --}}
            <div class="shape-circle shape-2"></div>
            <div class="shape-square shape-1"></div>
            <div class="shape-triangle shape-2"></div>
            <div class="shape-star shape-2"></div>

            <div class="container">
                <h2 class="heading-1 text-balance" style="text-align: center; margin-bottom: var(--spacing-48); position: relative;">
                    خدماتنا التقنية
                    <div style="width: 100px; height: 4px; background: var(--gradient-primary); margin: var(--spacing-16) auto 0; border-radius: var(--radius-4);"></div>
                </h2>
                <div class="services-grid">
                    <div class="service-card">
                        <div class="service-image service-web-dev"></div>
                        <h3>تطوير المواقع</h3>
                        <p>نصمم ونطور مواقع إلكترونية احترافية بأحدث التقنيات</p>
                        <div class="price">ابتداءً من 500 ريال</div>
                        <div class="meta">
                            <span>مدة التسليم: 7-14 يوم</span>
                            <span>⭐ 4.8</span>
                        </div>
                        <div class="actions">
                            <button class="btn-ghost">عرض التفاصيل</button>
                            <form style="display: inline;">
                                <input type="number" value="1" min="1" style="width: 60px;">
                                <button class="btn" style="padding: 8px 16px;">إضافة للسلة</button>
                            </form>
                        </div>
                    </div>

                    <div class="service-card">
                        <div class="service-image service-mobile-app"></div>
                        <h3>تطبيقات الهاتف</h3>
                        <p>نطور تطبيقات الهواتف الذكية للأندرويد والآيفون</p>
                        <div class="price">ابتداءً من 2000 ريال</div>
                        <div class="meta">
                            <span>مدة التسليم: 21-30 يوم</span>
                            <span>⭐ 4.9</span>
                        </div>
                        <div class="actions">
                            <button class="btn-ghost">عرض التفاصيل</button>
                            <form style="display: inline;">
                                <input type="number" value="1" min="1" style="width: 60px;">
                                <button class="btn" style="padding: 8px 16px;">إضافة للسلة</button>
                            </form>
                        </div>
                    </div>

                    <div class="service-card">
                        <div class="service-image service-consultation"></div>
                        <h3>استشارات تقنية</h3>
                        <p>نقدم استشارات تقنية متخصصة لحل المشاكل التقنية</p>
                        <div class="price">ابتداءً من 200 ريال/ساعة</div>
                        <div class="meta">
                            <span>مدة التسليم: حسب الطلب</span>
                            <span>⭐ 5.0</span>
                        </div>
                        <div class="actions">
                            <button class="btn-ghost">عرض التفاصيل</button>
                            <form style="display: inline;">
                                <input type="number" value="1" min="1" style="width: 60px;">
                                <button class="btn" style="padding: 8px 16px;">إضافة للسلة</button>
                            </form>
                        </div>
                    </div>

                    <div class="service-card">
                        <div class="service-image service-seo"></div>
                        <h3>تحسين محركات البحث</h3>
                        <p>نحسن ظهور موقعك في نتائج البحث وزيادة الزوار</p>
                        <div class="price">ابتداءً من 300 ريال</div>
                        <div class="meta">
                            <span>مدة التسليم: 15-30 يوم</span>
                            <span>⭐ 4.7</span>
                        </div>
                        <div class="actions">
                            <button class="btn-ghost">عرض التفاصيل</button>
                            <form style="display: inline;">
                                <input type="number" value="1" min="1" style="width: 60px;">
                                <button class="btn" style="padding: 8px 16px;">إضافة للسلة</button>
                            </form>
                        </div>
                    </div>

                    <div class="service-card">
                        <div class="service-image service-design"></div>
                        <h3>تصميم الجرافيك</h3>
                        <p>نصمم هويات بصرية ومواد تسويقية احترافية</p>
                        <div class="price">ابتداءً من 150 ريال</div>
                        <div class="meta">
                            <span>مدة التسليم: 3-7 أيام</span>
                            <span>⭐ 4.6</span>
                        </div>
                        <div class="actions">
                            <button class="btn-ghost">عرض التفاصيل</button>
                            <form style="display: inline;">
                                <input type="number" value="1" min="1" style="width: 60px;">
                                <button class="btn" style="padding: 8px 16px;">إضافة للسلة</button>
                            </form>
                        </div>
                    </div>

                    <div class="service-card">
                        <div class="service-image service-maintenance"></div>
                        <h3>صيانة المواقع</h3>
                        <p>نقدم خدمات صيانة وتحديث المواقع باستمرار</p>
                        <div class="price">ابتداءً من 100 ريال/شهر</div>
                        <div class="meta">
                            <span>مدة التسليم: مستمرة</span>
                            <span>⭐ 4.9</span>
                        </div>
                        <div class="actions">
                            <button class="btn-ghost">عرض التفاصيل</button>
                            <form style="display: inline;">
                                <input type="number" value="1" min="1" style="width: 60px;">
                                <button class="btn" style="padding: 8px 16px;">إضافة للسلة</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- من نحن --}}
        <section class="section about-section" id="about">
            {{-- الأشكال الهندسية --}}
            <div class="shape-hexagon shape-2"></div>
            <div class="shape-circle shape-3"></div>
            <div class="shape-square shape-2"></div>

            <div class="container">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: center;">
                    <div>
                        <h2 style="margin-bottom: 2rem; position: relative;">
                            من نحن
                            <div style="width: 80px; height: 4px; background: var(--gradient-primary); margin-top: 1rem; border-radius: 2px;"></div>
                        </h2>
                        <p style="font-size: 1.1rem; line-height: 1.8; margin-bottom: 1.5rem; color: var(--text-secondary);">
                            نحن فريق من المطورين والمصممين المتخصصين في تقديم حلول تقنية متميزة للأفراد والشركات.
                            نؤمن بأن التكنولوجيا يجب أن تكون سهلة الاستخدام وفعالة في تحقيق أهداف عملائنا.
                        </p>
                        <p style="font-size: 1.1rem; line-height: 1.8; margin-bottom: 2rem; color: var(--text-secondary);">
                            خبرتنا تمتد لأكثر من 5 سنوات في مجال التطوير والتصميم، وقد ساعدنا مئات العملاء في تحويل أفكارهم إلى واقع ملموس.
                        </p>
                        <div style="display: flex; gap: 1rem;">
                            <button class="btn">تعرف علينا أكثر</button>
                            <button class="btn btn-outline">مشاهدة أعمالنا</button>
                        </div>
                    </div>
                    <div style="position: relative;">
                        <div style="width: 100%; height: 400px; background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); border-radius: var(--radius-xl); position: relative; overflow: hidden;">
                            <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; color: white;">
                                <h3 style="font-size: 2rem; margin-bottom: 1rem;">خبرة +5 سنوات</h3>
                                <p>في مجال التطوير والتصميم</p>
                            </div>
                            {{-- جسيمات متحركة --}}
                            <div class="particles">
                                <div class="particle"></div>
                                <div class="particle"></div>
                                <div class="particle"></div>
                                <div class="particle"></div>
                                <div class="particle"></div>
                                <div class="particle"></div>
                                <div class="particle"></div>
                                <div class="particle"></div>
                                <div class="particle"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- نموذج اتصال --}}
        <section class="section contact-section" id="contact">
            {{-- الأشكال الهندسية --}}
            <div class="shape-triangle shape-1"></div>
            <div class="shape-star shape-1"></div>
            <div class="shape-circle shape-2"></div>

            <div class="container">
                <h2 style="text-align: center; margin-bottom: 2rem; position: relative;">
                    تواصل معنا
                    <div style="width: 100px; height: 4px; background: var(--gradient-primary); margin: 1rem auto 0; border-radius: 2px;"></div>
                </h2>
                <div style="max-width: 500px; margin: 0 auto;">
                    <form class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label class="form-label">الاسم الكامل</label>
                                <input type="text" class="form-control" placeholder="أدخل اسمك الكامل">
                            </div>
                            <div class="form-group">
                                <label class="form-label">البريد الإلكتروني</label>
                                <input type="email" class="form-control" placeholder="example@email.com">
                            </div>
                            <div class="form-group">
                                <label class="form-label">رقم الهاتف</label>
                                <input type="tel" class="form-control" placeholder="05xxxxxxxx">
                            </div>
                            <div class="form-group">
                                <label class="form-label">الرسالة</label>
                                <textarea class="form-control" rows="4" placeholder="اكتب رسالتك هنا..."></textarea>
                            </div>
                            <button class="btn" style="width: 100%;">إرسال الرسالة</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>

    <script>
        // تأثير الشريط المنزلق عند التمرير
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 100) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // تحريك البطاقات عند الظهور
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // إضافة تأثير التحريك للبطاقات
        document.querySelectorAll('.service-card').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(card);
        });
    </script>
@endsection
