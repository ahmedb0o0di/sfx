<div class="modal-overlay" id="projectModal" role="dialog" aria-modal="true" aria-labelledby="modalTitle" style="display: none;">
  <div class="modal-card">
    <button class="modal-close-btn" id="modalCloseBtn" aria-label="Close Project Modal">&times;</button>
    <div class="modal-grid">
      <!-- Modal Left: Media Showcase -->
      <div class="modal-media-col">
        <div class="modal-img-wrap">
          <img id="modalImageBackdrop" class="modal-ambient-backdrop" src="" alt="" aria-hidden="true">
          <img id="modalImage" class="modal-product-img" src="" alt="Project Showcase">
          <div class="modal-image-badge-wrap">
            <a id="modalImageExpand" href="#" target="_blank" rel="noopener noreferrer" class="product-verified-badge" title="Open full high-resolution image in new tab">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="vertical-align: -1px; margin-right: 4px;">
                <path d="M15 3h6v6M9 21H3v-6M21 3l-7 7M3 21l7-7"/>
              </svg>
              <span>Verified Installation</span>
            </a>
          </div>
        </div>
        <!-- Thumbnails Strip -->
        <div class="modal-thumbs-strip" id="modalThumbsStrip"></div>
      </div>

      <!-- Modal Right: Engineering Specifications -->
      <div class="modal-info-col">
        <div class="modal-header-meta">
          <span class="modal-tag" id="modalCategory">Architectural ETFE</span>
          <span class="modal-year-tag" id="modalYear">Handover: 2022</span>
        </div>

        <h3 class="modal-title" id="modalTitle">Project Title</h3>
        <p class="modal-desc" id="modalDescription">Detailed technical overview...</p>

        <!-- Technical Specification Matrix -->
        <div class="modal-specs-table">
          <div class="modal-spec-row">
            <span class="spec-label">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
              Location
            </span>
            <span class="spec-value" id="modalLocation">—</span>
          </div>
          <div class="modal-spec-row">
            <span class="spec-label">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3h18v18H3zM9 3v18M15 3v18M3 9h18M3 15h18"/></svg>
              Covered Area
            </span>
            <span class="spec-value" id="modalArea">—</span>
          </div>
          <div class="modal-spec-row">
            <span class="spec-label">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
              Membrane Material
            </span>
            <span class="spec-value" id="modalMaterial">—</span>
          </div>
          <div class="modal-spec-row">
            <span class="spec-label">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg>
              Client / Authority
            </span>
            <span class="spec-value" id="modalClient">—</span>
          </div>
          <div class="modal-spec-row">
            <span class="spec-label">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="m4.93 4.93 4.24 4.24M14.83 14.83l4.24 4.24M14.83 9.17l4.24-4.24M4.93 19.07l4.24-4.24"/></svg>
              Engineering Solution
            </span>
            <span class="spec-value" id="modalSpan">—</span>
          </div>
        </div>

        <!-- Modal CTA -->
        <div class="modal-actions-bar">
          <a href="{{ route('contact.index') }}" class="btn btn-consult-primary" id="modalInquireBtn">
            <span>Inquire About Similar Scope</span>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
          </a>
          <a id="modalDedicatedPageLink" href="#" class="btn btn-hero-white" style="font-size: 0.85rem; padding: 0.75rem 1.25rem;">
            <span>Case Study Page →</span>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
