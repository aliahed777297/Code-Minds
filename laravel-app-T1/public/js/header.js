(() => {
  if (window.__LaundryHeaderInit) return;
  window.__LaundryHeaderInit = true;

  document.addEventListener('DOMContentLoaded', () => {
    const btn = document.getElementById('mobileMenuBtn');
    const nav = document.getElementById('navLinks');
    const header = document.querySelector('.site-header');

    if (!btn || !nav) return;

    // overlay
    let overlay = document.querySelector('.mobile-overlay');
    if (!overlay) {
      overlay = document.createElement('div');
      overlay.className = 'mobile-overlay';
      document.body.appendChild(overlay);
    }

    let isOpen = false;
    let scrollPos = 0;

    const setBtnState = (open) => {
      btn.setAttribute('aria-expanded', open ? 'true' : 'false');
      btn.setAttribute('aria-label', open ? 'إغلاق القائمة' : 'فتح القائمة');
      btn.innerHTML = open
        ? '<i class="fas fa-times"></i>'
        : '<i class="fas fa-bars"></i>';
    };

    const disableScroll = () => {
      scrollPos = window.pageYOffset || 0;
      document.body.style.overflow = 'hidden';
      document.body.style.position = 'fixed';
      document.body.style.top = `-${scrollPos}px`;
      document.body.style.left = '0';
      document.body.style.right = '0';
      document.body.style.width = '100%';
    };

    const enableScroll = () => {
      document.body.style.overflow = '';
      document.body.style.position = '';
      document.body.style.top = '';
      document.body.style.left = '';
      document.body.style.right = '';
      document.body.style.width = '';
      window.scrollTo(0, scrollPos);
    };

    const openMenu = () => {
      if (isOpen) return;
      isOpen = true;
      nav.classList.add('active');
      overlay.classList.add('active');
      setBtnState(true);
      disableScroll();
    };

    const closeMenu = () => {
      if (!isOpen) return;
      isOpen = false;
      nav.classList.remove('active');
      overlay.classList.remove('active');
      setBtnState(false);
      enableScroll();
    };

    // Toggle
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      isOpen ? closeMenu() : openMenu();
    });

    // Close by overlay
    overlay.addEventListener('click', closeMenu);

    // Close by ESC
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') closeMenu();
    });

    // ✅ تنقّل صحيح عند الضغط على الروابط في الموبايل
    nav.querySelectorAll('a').forEach((a) => {
      a.addEventListener('click', (e) => {
        const href = a.getAttribute('href');

        if (window.innerWidth <= 768 && isOpen) {
          const isRealLink = href && href !== '#' && !href.startsWith('javascript');

          if (isRealLink) {
            e.preventDefault();
            closeMenu();
            setTimeout(() => {
              window.location.href = href;
            }, 180);
          } else {
            closeMenu();
          }
        }
      });
    });

    // Resize
    window.addEventListener('resize', () => {
      if (window.innerWidth > 768 && isOpen) closeMenu();
    });

    // header scrolled
    if (header) {
      const onScroll = () => {
        if ((window.scrollY || 0) > 50) header.classList.add('scrolled');
        else header.classList.remove('scrolled');
      };
      window.addEventListener('scroll', onScroll, { passive: true });
      onScroll();
    }

    setBtnState(false);
  });
})();
