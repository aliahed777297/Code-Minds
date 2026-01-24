document.addEventListener('DOMContentLoaded', function(){
    const modal = document.getElementById('global-modal');
    const modalContent = document.getElementById('modal-content');
    const openBtn = document.getElementById('open-auth-modal');
    const closeBtn = modal.querySelector('.modal-close');
    const backdrop = modal.querySelector('.modal-backdrop');

    function showPanel(id){
        modal.style.display = 'flex';
        modal.setAttribute('aria-hidden','false');
        modalContent.querySelectorAll('.auth-modal-panel').forEach(p => p.style.display = 'none');
        const panel = modalContent.querySelector('#auth-' + id);
        if(panel) panel.style.display = 'block';
    }

    function hideModal(){
        modal.style.display = 'none';
        modal.setAttribute('aria-hidden','true');
        modalContent.querySelectorAll('.auth-modal-panel').forEach(p => p.style.display = 'none');
    }

    if(openBtn){
        openBtn.addEventListener('click', function(e){
            e.preventDefault();
            showPanel('login');
        });
    }

    closeBtn.addEventListener('click', hideModal);
    backdrop.addEventListener('click', hideModal);

    // switch buttons inside modal
    modalContent.addEventListener('click', function(e){
        const btn = e.target.closest('[data-switch-to]');
        if(btn){
            const to = btn.getAttribute('data-switch-to');
            showPanel(to);
        }
    });

    // AJAX form submission for auth forms
    modalContent.addEventListener('submit', function(e){
        const form = e.target.closest('.auth-form');
        if(!form) return;

        e.preventDefault();

        const panel = form.closest('.auth-modal-panel');
        const errorBox = panel.querySelector('.auth-error');
        if(errorBox) { errorBox.style.display = 'none'; errorBox.innerHTML = ''; }

        const data = new FormData(form);
        const action = form.getAttribute('action');

        fetch(action, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            },
            body: data
        }).then(async res => {
            const json = await res.json().catch(() => null);
            if(res.ok) {
                // success: close modal and redirect or reload
                hideModal();
                if(json && json.redirect) {
                    window.location.href = json.redirect;
                } else {
                    window.location.reload();
                }
                return;
            }

            // show validation errors
            if(json && json.errors) {
                let messages = [];
                // errors may be object of arrays
                for(const key in json.errors) {
                    const val = json.errors[key];
                    if(Array.isArray(val)) messages = messages.concat(val);
                    else if(typeof val === 'string') messages.push(val);
                }

                if(errorBox) {
                    errorBox.style.display = 'block';
                    errorBox.innerHTML = '<div>' + messages.join('</div><div>') + '</div>';
                } else {
                    alert(messages.join('\n'));
                }
                return;
            }

            // fallback error
            alert('حدث خطأ أثناء الاتصال. حاول مرة أخرى.');
        }).catch(err => {
            console.error(err);
            alert('خطأ في الشبكة. تحقق من اتصالك ثم أعد المحاولة.');
        });
    });

    // close with ESC
    document.addEventListener('keydown', function(e){
        if(e.key === 'Escape') hideModal();
    });
});
