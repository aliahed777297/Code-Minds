document.addEventListener('DOMContentLoaded', function(){
    // Auto-fade flash messages
    const flash = document.querySelector('.flash');
    if(flash){
        setTimeout(()=>{
            flash.style.transition = 'opacity .4s ease';
            flash.style.opacity = '0';
            setTimeout(()=> flash.remove(),500);
        },3000);
    }

    // Simple add-to-cart animation: fly effect (requires button inside .service-card)
    document.querySelectorAll('.service-card button').forEach(btn=>{
        btn.addEventListener('click', function(e){
            // small visual pulse
            btn.animate([{transform:'scale(1)'},{transform:'scale(.96)'},{transform:'scale(1)'}],{duration:220});
        });
    });

    // Responsive nav toggle
    const navToggle = document.querySelector('.nav-toggle');
    const navLinks = document.getElementById('primary-navigation');
    if(navToggle && navLinks){
        navToggle.addEventListener('click', ()=>{
            const open = navLinks.classList.toggle('open');
            navToggle.setAttribute('aria-expanded', open ? 'true' : 'false');
            // animate toggle icon
            navToggle.classList.toggle('open', open);
        });
    }

    // Toast helper
    function showToast(message, timeout = 3200){
        let container = document.querySelector('.toast-container');
        if(!container){
            container = document.createElement('div');
            container.className = 'toast-container';
            document.body.appendChild(container);
        }
        const t = document.createElement('div');
        t.className = 'toast';
        t.textContent = message;
        container.appendChild(t);
        // show
        requestAnimationFrame(()=> t.classList.add('show'));
        setTimeout(()=>{ t.classList.remove('show'); setTimeout(()=> t.remove(),400); }, timeout);
    }

    // AJAX add-to-cart (progressive enhancement)
    document.querySelectorAll('.service-card form').forEach(form=>{
        form.addEventListener('submit', function(e){
            e.preventDefault();
            const data = new FormData(form);
            fetch(form.action, { method: 'POST', body: data, headers: {'X-Requested-With':'XMLHttpRequest'} })
                .then(r=> r.json())
                .then(json=>{
                    showToast(json.message || 'تمت الإضافة إلى السلة');
                    // dispatch custom event so other parts can update (e.g., cart counter)
                    window.dispatchEvent(new CustomEvent('cart.updated', { detail: json }));
                })
                .catch(()=> showToast('حدث خطأ، حاول لاحقاً'));
        });
    });

    // Modal open for service details
    document.querySelectorAll('.btn-ghost[data-service]').forEach(btn=>{
        btn.addEventListener('click', ()=>{
            const svc = JSON.parse(btn.getAttribute('data-service'));
            const modal = document.getElementById('global-modal');
            const content = document.getElementById('modal-content');
            content.innerHTML = `<h2>${svc.name}</h2><p>${svc.description || ''}</p><p class="price">${parseFloat(svc.price).toFixed(2)} ر.س</p>`;
            modal.style.display = 'flex'; modal.classList.add('open'); modal.setAttribute('aria-hidden','false');
        });
    });

    // Nav link pulse on click and keyboard focus styles
    document.querySelectorAll('.nav-links a').forEach(link=>{
        link.addEventListener('click', (e)=>{
            // add pulse for feedback
            link.classList.add('pulse');
            setTimeout(()=> link.classList.remove('pulse'), 700);
        });
        link.addEventListener('keydown', (e)=>{
            if(e.key === 'Enter' || e.key === ' '){
                link.classList.add('pulse');
                setTimeout(()=> link.classList.remove('pulse'), 700);
            }
        });
    });

    // Modal close handlers
    const globalModal = document.getElementById('global-modal');
    if(globalModal){
        globalModal.querySelector('.modal-close').addEventListener('click', ()=>{ globalModal.style.display='none'; globalModal.classList.remove('open'); globalModal.setAttribute('aria-hidden','true'); });
        globalModal.querySelector('.modal-backdrop').addEventListener('click', ()=>{ globalModal.style.display='none'; globalModal.classList.remove('open'); globalModal.setAttribute('aria-hidden','true'); });
    }

    /* Carousel behaviour (home page) */
    (function(){
        const carousel = document.querySelector('.hero-carousel');
        if(!carousel) return;
        const inner = carousel.querySelector('.carousel-inner');
        const slides = Array.from(carousel.querySelectorAll('.carousel-slide'));
        const prev = carousel.querySelector('.carousel-prev');
        const next = carousel.querySelector('.carousel-next');
        const dots = Array.from(carousel.querySelectorAll('.dot'));
        let idx = slides.findIndex(s => s.classList.contains('active')) || 0;
        let timer = null;

        function show(i){
            idx = (i + slides.length) % slides.length;
            slides.forEach(s => s.classList.remove('active'));
            dots.forEach(d => d.classList.remove('active'));
            slides[idx].classList.add('active');
            dots[idx].classList.add('active');
            inner.style.transform = `translateX(-${idx * 100}%)`;
        }

        function nextSlide(){ show(idx+1); }
        function prevSlide(){ show(idx-1); }

        next.addEventListener('click', ()=>{ nextSlide(); resetTimer(); });
        prev.addEventListener('click', ()=>{ prevSlide(); resetTimer(); });
        dots.forEach((d,i)=> d.addEventListener('click', ()=>{ show(i); resetTimer(); }));

        function startTimer(){ timer = setInterval(nextSlide, 4500); }
        function resetTimer(){ clearInterval(timer); startTimer(); }
        carousel.addEventListener('mouseenter', ()=> clearInterval(timer));
        carousel.addEventListener('mouseleave', ()=> startTimer());
        show(idx);
        startTimer();
    })();

    // Update cart count in header
    function updateCartCount(count){
        const el = document.getElementById('cart-count');
        if(el) el.textContent = parseInt(count || 0, 10);
    }

    // initial fetch
    fetch('/cart/count', { headers: {'X-Requested-With':'XMLHttpRequest'} }).then(r=>r.json()).then(j=> updateCartCount(j.count)).catch(()=>{});

    // listen for cart.updated events from add-to-cart
    window.addEventListener('cart.updated', (e)=>{
        if(e.detail && e.detail.count !== undefined) updateCartCount(e.detail.count);
        else fetch('/cart/count', { headers: {'X-Requested-With':'XMLHttpRequest'} }).then(r=>r.json()).then(j=> updateCartCount(j.count)).catch(()=>{});
    });

    // AJAX handlers for cart update/remove forms on cart page
    document.querySelectorAll('.cart-action-form').forEach(f=>{
        f.addEventListener('submit', function(e){
            e.preventDefault();
            const data = new FormData(f);
            fetch(f.action, { method: 'POST', body: data, headers: {'X-Requested-With':'XMLHttpRequest'} })
                .then(r=>r.json())
                .then(json=>{
                    showToast(json.message || 'تم');
                    // update total if provided
                    if(json.total !== undefined){
                        const totalEl = document.getElementById('cart-total');
                        if(totalEl) totalEl.textContent = parseFloat(json.total).toFixed(2);
                    }
                    if(json.count !== undefined) updateCartCount(json.count);
                    // if the form had data-remove-id attribute, remove row
                    const removeId = f.dataset.removeId;
                    if(removeId){
                        const row = document.getElementById('cart-row-'+removeId);
                        if(row) row.remove();
                    }
                })
                .catch(()=> showToast('حدث خطأ'));
        });
    });

    // Generic AJAX form handler for .ajax-form (e.g., contact form)
    document.querySelectorAll('.ajax-form').forEach(form=>{
        form.addEventListener('submit', function(e){
            e.preventDefault();
            const data = new FormData(form);
            fetch(form.action, { method: form.method || 'POST', body: data, headers: {'X-Requested-With':'XMLHttpRequest'} })
                .then(r=> r.json())
                .then(json=>{
                    showToast(json.message || 'تم الإرسال');
                    form.reset();
                })
                .catch(()=> showToast('حدث خطأ، حاول لاحقاً'));
        });
    });
});

