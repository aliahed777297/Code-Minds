(() => {
  const modal = document.getElementById('svcModal');
  if (!modal) return;

  const mTitle = document.getElementById('mTitle');
  const mDesc  = document.getElementById('mDesc');
  const mPrice = document.getElementById('mPrice');
  const mDuration = document.getElementById('mDuration');
  const mImage = document.getElementById('mImage');
  const mImageWrap = document.getElementById('mImageWrap');

  const openBtns = document.querySelectorAll('.js-open-details');

  function openModal(data){
    // Fill
    mTitle.textContent = data.name || '';
    mDesc.textContent  = data.desc || 'لا يوجد وصف.';
    mPrice.textContent = `${data.price || '0.00'} ر.س`;

    if (data.duration) {
      mDuration.style.display = 'inline-flex';
      mDuration.textContent = `المدة: ${data.duration} دقيقة`;
    } else {
      mDuration.style.display = 'none';
      mDuration.textContent = '';
    }

    if (data.image) {
      mImage.src = data.image;
      mImage.alt = data.name || '';
      mImageWrap.style.display = 'block';
    } else {
      // لو ما في صورة نخفي الجزء
      mImage.removeAttribute('src');
      mImage.alt = '';
      mImageWrap.style.display = 'none';
    }

    // Set service ID for the form
    document.getElementById('modal-service-id').value = data.id || '';

    modal.classList.add('is-open');
    modal.setAttribute('aria-hidden','false');
    document.body.style.overflow = 'hidden';
  }

  function closeModal(){
    modal.classList.remove('is-open');
    modal.setAttribute('aria-hidden','true');
    document.body.style.overflow = '';
  }

  openBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      openModal({
        id: btn.dataset.id,
        name: btn.dataset.name,
        desc: btn.dataset.desc,
        price: btn.dataset.price,
        duration: btn.dataset.duration,
        image: btn.dataset.image
      });
    });
  });

  modal.addEventListener('click', (e) => {
    if (e.target?.hasAttribute('data-close')) closeModal();
  });

  window.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && modal.classList.contains('is-open')) closeModal();
  });
})();