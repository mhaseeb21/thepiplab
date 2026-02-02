document.addEventListener('DOMContentLoaded', () => {
  // Image Modal
  const imageModal = document.getElementById('imageModal');
  if (imageModal) {
    imageModal.addEventListener('show.bs.modal', function (event) {
      const trigger = event.relatedTarget;
      if (!trigger) return;

      const image = trigger.getAttribute('data-image');
      const title = trigger.getAttribute('data-title');

      const modalImage = document.getElementById('modalImage');
      const modalTitle = document.getElementById('imageModalTitle');

      if (modalImage) modalImage.src = image || '';
      if (modalTitle) modalTitle.textContent = title || 'Signal Image';
    });

    imageModal.addEventListener('hidden.bs.modal', function () {
      const modalImage = document.getElementById('modalImage');
      if (modalImage) modalImage.src = '';
    });
  }
});

// Load Signal Details (kept global because your HTML calls it)
window.loadSignalDetails = function (signalId) {
  const detailContent = document.getElementById('signalDetailContent');
  if (!detailContent) return;

  detailContent.innerHTML = `
    <div class="text-center py-4">
      <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>
  `;

  fetch(`/api/signals/${signalId}`)
    .then(response => {
      if (!response.ok) throw new Error('Failed to load signal');
      return response.json();
    })
    .then(data => {
      let html = `
        <div class="signal-detail-view">
          <div class="detail-section mb-4">
            <h6 class="fw-700 mb-2" style="color:#091E3E;">Pair Information</h6>
            <div class="detail-row">
              <span class="detail-key">Pair:</span>
              <span class="detail-val">${data.pair_name || 'N/A'}</span>
            </div>
            <div class="detail-row">
              <span class="detail-key">Signal Type:</span>
              <span class="detail-val">${data.signal_type === 'buy' ? '🟢 Bullish (Buy)' : '🔴 Bearish (Sell)'}</span>
            </div>
            <div class="detail-row">
              <span class="detail-key">Status:</span>
              <span class="detail-val">${data.result_label || 'Pending'}</span>
            </div>
          </div>

          <div class="detail-section mb-4">
            <h6 class="fw-700 mb-2" style="color:#091E3E;">Entry & Targets</h6>
      `;

      if (data.entry_criteria) {
        html += `
          <div class="detail-row">
            <span class="detail-key">Entry Criteria:</span>
            <span class="detail-val">${data.entry_criteria}</span>
          </div>
        `;
      }

      if (data.tp1) {
        html += `
          <div class="detail-row">
            <span class="detail-key">TP1:</span>
            <span class="detail-val" style="color:#4CAF50; font-weight:700;">${data.tp1}</span>
          </div>
        `;
      }

      if (data.tp2) {
        html += `
          <div class="detail-row">
            <span class="detail-key">TP2:</span>
            <span class="detail-val" style="color:#4CAF50; font-weight:700;">${data.tp2}</span>
          </div>
        `;
      }

      if (data.stop_loss) {
        html += `
          <div class="detail-row">
            <span class="detail-key">Stop Loss:</span>
            <span class="detail-val" style="color:#ff6464; font-weight:700;">${data.stop_loss}</span>
          </div>
        `;
      }

      html += `</div>`;

      if (data.description) {
        html += `
          <div class="detail-section mb-4">
            <h6 class="fw-700 mb-2" style="color:#091E3E;">Description</h6>
            <p class="mb-0" style="color:#666; line-height:1.6;">${data.description}</p>
          </div>
        `;
      }

      html += `
        <div class="detail-section">
          <h6 class="fw-700 mb-2" style="color:#091E3E;">Timeline</h6>
          <div class="detail-row">
            <span class="detail-key">Created:</span>
            <span class="detail-val">${new Date(data.created_at).toLocaleString()}</span>
          </div>
      `;

      if (data.completed_at) {
        html += `
          <div class="detail-row">
            <span class="detail-key">Completed:</span>
            <span class="detail-val">${new Date(data.completed_at).toLocaleString()}</span>
          </div>
        `;
      }

      html += `</div></div>`;
      detailContent.innerHTML = html;
    })
    .catch(err => {
      console.error(err);
      detailContent.innerHTML = `
        <div class="alert alert-warning mb-0">
          <i class="fas fa-exclamation-triangle me-2"></i>
          Failed to load signal details. Please try again.
        </div>
      `;
    });
};