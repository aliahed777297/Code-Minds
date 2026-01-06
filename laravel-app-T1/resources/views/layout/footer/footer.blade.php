<footer class="site-footer" role="contentinfo">
    <div class="container footer-grid">

        {{-- Brand --}}
        <div class="footer-brand">
            <a class="footer-logo" href="{{ url('/') }}">
                <span class="logo-dot" aria-hidden="true"></span>
                مغسلة <span class="logo-accent">{{ config('app.name', 'عالمية') }}</span>
            </a>

            <p class="footer-desc">
                خدمة غسيل وكيّ وتنظيف جاف بجودة عالية — استلام وتسليم سريع، واهتمام بالتفاصيل.
            </p>

            <div class="footer-badges">
                <span class="badge">توصيل سريع</span>
                <span class="badge">تنظيف جاف</span>
                <span class="badge badge-gold">ضمان الجودة</span>
            </div>
        </div>

        {{-- Links --}}
        <nav class="footer-links" aria-label="روابط الفوتر">
            <h3 class="footer-title">روابط سريعة</h3>
            <ul class="links-list">
                <li><a href="{{ url('/services') }}">الخدمات</a></li>
                <li><a href="{{ url('/prices') }}">الأسعار</a></li>
                <li><a href="{{ url('/about') }}">من نحن</a></li>
                <li><a href="{{ url('/faq') }}">الأسئلة الشائعة</a></li>
                <li><a href="{{ url('/contact') }}">تواصل معنا</a></li>
            </ul>
        </nav>

        {{-- Contact --}}
        <div class="footer-contact">
            <h3 class="footer-title">التواصل</h3>

            <a class="contact-row" href="tel:+967000000000">
                <span class="icon-wrap" aria-hidden="true">
                    {{-- Phone --}}
                    <svg class="icon-svg" viewBox="0 0 24 24" fill="none">
                        <path d="M4.6 3.8c.5-.6 1.4-.8 2.1-.4l3 1.7c.8.4 1.1 1.4.6 2.2l-1 1.6c-.2.3-.2.7 0 1 1.1 1.8 2.6 3.3 4.4 4.4.3.2.7.2 1 0l1.6-1c.8-.5 1.8-.2 2.2.6l1.7 3c.4.7.2 1.6-.4 2.1l-1.2 1.1c-.9.8-2.1 1.2-3.3 1-7.1-1.2-12.5-6.6-13.7-13.7-.2-1.2.2-2.4 1-3.3L4.6 3.8Z"
                              fill="currentColor"/>
                    </svg>
                </span>
                <span class="contact-text">+967 000 000 000</span>
            </a>

            <a class="contact-row" href="mailto:info@laundry.com">
                <span class="icon-wrap" aria-hidden="true">
                    {{-- Mail --}}
                    <svg class="icon-svg" viewBox="0 0 24 24" fill="none">
                        <path d="M4 7.5A3.5 3.5 0 0 1 7.5 4h9A3.5 3.5 0 0 1 20 7.5v9A3.5 3.5 0 0 1 16.5 20h-9A3.5 3.5 0 0 1 4 16.5v-9Z" stroke="currentColor" stroke-width="1.8"/>
                        <path d="M6.5 8.2 12 12l5.5-3.8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
                <span class="contact-text">info@laundry.com</span>
            </a>

            <div class="contact-row contact-row-static">
                <span class="icon-wrap" aria-hidden="true">
                    {{-- Location --}}
                    <svg class="icon-svg" viewBox="0 0 24 24" fill="none">
                        <path d="M12 22s7-4.4 7-11a7 7 0 1 0-14 0c0 6.6 7 11 7 11Z" stroke="currentColor" stroke-width="1.8"/>
                        <path d="M12 11.5a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" fill="currentColor"/>
                    </svg>
                </span>
                <span class="contact-text">اليمن — صنعاء (عدّل العنوان)</span>
            </div>

            <div class="social" aria-label="روابط التواصل الاجتماعي">
                {{-- Instagram --}}
                <a class="social-btn ig" href="#" aria-label="Instagram">
                    <svg class="social-svg" viewBox="0 0 24 24" fill="none">
                        <path d="M7.5 2.8h9A4.7 4.7 0 0 1 21.2 7.5v9A4.7 4.7 0 0 1 16.5 21.2h-9A4.7 4.7 0 0 1 2.8 16.5v-9A4.7 4.7 0 0 1 7.5 2.8Z" stroke="currentColor" stroke-width="1.8"/>
                        <path d="M12 16.2A4.2 4.2 0 1 0 12 7.8a4.2 4.2 0 0 0 0 8.4Z" stroke="currentColor" stroke-width="1.8"/>
                        <path d="M17.2 6.9h.01" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
                    </svg>
                </a>

                {{-- WhatsApp --}}
                <a class="social-btn wa" href="#" aria-label="WhatsApp">
                    <svg class="social-svg" viewBox="0 0 24 24" fill="none">
                        <path d="M20.2 12a8.2 8.2 0 0 1-12.7 6.9L4 20l1.2-3.3A8.2 8.2 0 1 1 20.2 12Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
                        <path d="M10.1 9.6c.2-.3.5-.4.8-.3l.8.3c.3.1.5.5.4.8l-.3.8c-.1.3 0 .6.2.8.6.8 1.3 1.4 2.1 2.1.2.2.5.2.8.2l.8-.3c.3-.1.7.1.8.4l.3.8c.1.3 0 .6-.3.8-.6.5-1.3.7-2 .5-2.2-.6-4-2.4-4.6-4.6-.2-.7 0-1.4.5-2Z"
                              fill="currentColor"/>
                    </svg>
                </a>

                {{-- Facebook --}}
                <a class="social-btn fb" href="#" aria-label="Facebook">
                    <svg class="social-svg" viewBox="0 0 24 24" fill="none">
                        <path d="M14 8.5V7.3c0-.8.6-1.3 1.4-1.3H17V3.3h-2.2C12.8 3.3 12 4.6 12 6.8v1.7H10v2.7h2V21h3v-9.8h2.3L18 8.5H14Z"
                              fill="currentColor"/>
                    </svg>
                </a>
            </div>
        </div>

    </div>

    <div class="footer-bottom">
        <div class="container footer-bottom-inner">
            <small>© {{ now()->year }} جميع الحقوق محفوظة — {{ config('app.name', 'المغسلة') }}</small>

            <div class="bottom-links">
                <a href="{{ url('/privacy') }}">الخصوصية</a>
                <span class="sep">•</span>
                <a href="{{ url('/terms') }}">الشروط</a>
            </div>
        </div>
    </div>
</footer>
