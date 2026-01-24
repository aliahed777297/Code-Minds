(() => {
  const root = document.querySelector('[data-glb-carousel]');
  if (!root) return;

  const track = root.querySelector('[data-glb-track]');
  const slides = Array.from(root.querySelectorAll('[data-glb-slide]'));
  const prevBtn = root.querySelector('[data-glb-prev]');
  const nextBtn = root.querySelector('[data-glb-next]');
  const dotsWrap = root.querySelector('[data-glb-dots]');

  if (!track || slides.length === 0) return;

  let index = 0;
  let autoplay = true;
  let timer = null;

  // Create dots
  const dots = slides.map((_, i) => {
    const b = document.createElement('button');
    b.type = 'button';
    b.className = 'glb-dot';
    b.setAttribute('aria-label', `انتقال إلى الشريحة ${i + 1}`);
    b.setAttribute('aria-current', i === 0 ? 'true' : 'false');
    b.addEventListener('click', () => goTo(i, true));
    dotsWrap?.appendChild(b);
    return b;
  });

  function update() {
    track.style.transform = `translateX(${index * 100}%)`; // RTL: flex left-to-right but we translate normally
    slides.forEach((s, i) => {
      s.setAttribute('aria-hidden', i === index ? 'false' : 'true');
    });
    dots.forEach((d, i) => d.setAttribute('aria-current', i === index ? 'true' : 'false'));
  }

  function goTo(i, userAction = false) {
    index = (i + slides.length) % slides.length;
    update();
    if (userAction) restartAutoplay();
  }

  function next(userAction = false) { goTo(index + 1, userAction); }
  function prev(userAction = false) { goTo(index - 1, userAction); }

  prevBtn?.addEventListener('click', () => prev(true));
  nextBtn?.addEventListener('click', () => next(true));

  // Keyboard arrows
  root.addEventListener('keydown', (e) => {
    if (e.key === 'ArrowLeft') next(true);
    if (e.key === 'ArrowRight') prev(true);
  });

  // Autoplay
  function startAutoplay() {
    if (!autoplay) return;
    stopAutoplay();
    timer = setInterval(() => next(false), 4500);
  }

  function stopAutoplay() {
    if (timer) clearInterval(timer);
    timer = null;
  }

  function restartAutoplay() {
    stopAutoplay();
    startAutoplay();
  }

  // Pause on hover/focus (desktop)
  root.addEventListener('mouseenter', () => { autoplay = false; stopAutoplay(); });
  root.addEventListener('mouseleave', () => { autoplay = true; startAutoplay(); });
  root.addEventListener('focusin', () => { autoplay = false; stopAutoplay(); });
  root.addEventListener('focusout', () => { autoplay = true; startAutoplay(); });

  // Touch swipe (mobile)
  let startX = 0;
  let deltaX = 0;
  let touching = false;

  const viewport = root.querySelector('[data-glb-viewport]') || root;

  viewport.addEventListener('touchstart', (e) => {
    touching = true;
    startX = e.touches[0].clientX;
    deltaX = 0;
    autoplay = false;
    stopAutoplay();
  }, { passive: true });

  viewport.addEventListener('touchmove', (e) => {
    if (!touching) return;
    deltaX = e.touches[0].clientX - startX;
  }, { passive: true });

  viewport.addEventListener('touchend', () => {
    touching = false;
    const threshold = 45;
    if (Math.abs(deltaX) > threshold) {
      // swipe left -> next, swipe right -> prev
      if (deltaX < 0) next(true);
      else prev(true);
    }
    autoplay = true;
    startAutoplay();
  });

  // Reveal on scroll (stats + gallery)
  const revealItems = Array.from(document.querySelectorAll('.reveal-on-scroll'));
  if ('IntersectionObserver' in window && revealItems.length) {
    const io = new IntersectionObserver((entries) => {
      entries.forEach((en) => {
        if (en.isIntersecting) en.target.classList.add('is-visible');
      });
    }, { threshold: 0.15 });
    revealItems.forEach((el) => io.observe(el));
  } else {
    revealItems.forEach((el) => el.classList.add('is-visible'));
  }

  // Count up
  const counters = Array.from(document.querySelectorAll('.countup'));
  function animateCount(el, to) {
    const duration = 900;
    const start = performance.now();
    const from = 0;

    function tick(now) {
      const t = Math.min(1, (now - start) / duration);
      const value = Math.floor(from + (to - from) * (t * (2 - t)));
      el.textContent = value.toLocaleString('en-US');
      if (t < 1) requestAnimationFrame(tick);
    }
    requestAnimationFrame(tick);
  }

  counters.forEach((el) => {
    const n = Number(el.getAttribute('data-count') || '0');
    animateCount(el, n);
  });

  // init
  update();
  startAutoplay();
})();
