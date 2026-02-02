(function () {
  function showCopyFeedback(btn) {
    if (!btn) return;
    const original = btn.innerHTML;
    btn.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
    btn.disabled = true;
    setTimeout(() => {
      btn.innerHTML = original;
      btn.disabled = false;
    }, 1200);
  }

  window.copyDepositAddress = function () {
    const input = document.getElementById('trc20_deposit_link');
    const btn = document.querySelector('.copy-btn');
    if (!input) return;

    const text = (input.value || '').trim();

    // Works on https / localhost; fallback for older contexts
    if (navigator.clipboard && window.isSecureContext) {
      navigator.clipboard.writeText(text).then(() => showCopyFeedback(btn)).catch(() => fallbackCopy(input, btn));
    } else {
      fallbackCopy(input, btn);
    }
  };

  function fallbackCopy(input, btn) {
    input.removeAttribute('readonly');
    input.select();
    input.setSelectionRange(0, 999999);
    input.setAttribute('readonly', true);

    const ok = document.execCommand('copy');
    if (ok) showCopyFeedback(btn);
    else alert('Failed to copy. Please copy manually.');
  }

  // ✅ Upload area click -> open file picker + show filename
  function initUploadArea() {
    const uploadArea = document.querySelector('.upload-area');
    const fileInput = document.getElementById('payment_proof');

    if (!uploadArea || !fileInput) return;

    // Make the whole box clickable
    uploadArea.addEventListener('click', () => fileInput.click());

    // Show selected file name
    fileInput.addEventListener('change', () => {
      const existing = uploadArea.querySelector('.upload-filename');
      if (existing) existing.remove();

      if (fileInput.files && fileInput.files[0]) {
        const nameEl = document.createElement('div');
        nameEl.className = 'upload-filename';
        nameEl.textContent = `Selected: ${fileInput.files[0].name}`;
        uploadArea.appendChild(nameEl);
      }
    });
  }

  document.addEventListener('DOMContentLoaded', initUploadArea);
})();