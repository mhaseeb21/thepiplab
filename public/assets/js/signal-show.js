document.addEventListener('DOMContentLoaded', () => {
  const modalEl = document.getElementById('signalImageModal');
  if (!modalEl) return;

  const imgEl = document.getElementById('signalImagePreview');
  const titleEl = document.getElementById('signalImageTitle');

  modalEl.addEventListener('show.bs.modal', (event) => {
    const trigger = event.relatedTarget;
    if (!trigger) return;

    const imgSrc = trigger.getAttribute('data-img-src');
    const imgTitle = trigger.getAttribute('data-img-title') || 'Signal';

    if (imgEl) imgEl.src = imgSrc || '';
    if (titleEl) titleEl.textContent = imgTitle;
  });

  modalEl.addEventListener('hidden.bs.modal', () => {
    if (imgEl) imgEl.src = '';
    if (titleEl) titleEl.textContent = 'Signal';
  });
});