<!-- ==========================================================================
     INTERACTIVE CASE STUDY DETAIL MODAL (OPTION 1 DESIGN)
     ========================================================================== -->
<div class="modal-overlay" id="projectModal" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
  <div class="modal-card">
    
    <!-- Top Sticky Action Bar -->
    <div class="modal-header-bar">
      <div class="modal-header-left">
        <span class="modal-tag" id="modalCategory">Architectural ETFE</span>
        <span class="modal-year-tag" id="modalYear">Handover: 2022</span>
      </div>

      <div class="modal-header-actions">
        <div class="modal-nav-arrows">
          <button class="modal-nav-btn" id="modalPrevBtn" aria-label="Previous Project" title="Previous Project (←)">&#8592;</button>
          <span class="modal-counter" id="modalCounter">1 / 12</span>
          <button class="modal-nav-btn" id="modalNextBtn" aria-label="Next Project" title="Next Project (→)">&#8594;</button>
        </div>
        <button class="modal-close-btn" id="modalCloseBtn" aria-label="Close Project Modal" title="Close (Esc)">&times;</button>
      </div>
    </div>

    <!-- Modal Title & Meta Section (Clean, Unobstructed Header) -->
    <div class="modal-title-bar">
      <div class="modal-hero-pill-row">
        <span class="hero-pill hero-pill-blue" id="modalHeroLocation">📍 Nairobi, Kenya</span>
        <span class="hero-pill hero-pill-dark" id="modalHeroClient">🏢 Al Jamea Authority</span>
        <span class="hero-pill hero-pill-gold">⚡ Turnkey EPC Contract</span>
      </div>
      <h2 class="modal-product-title" id="modalTitle">Project Title</h2>
    </div>

    <!-- Dedicated Product Image Showcase -->
    <div class="modal-image-showcase">
      <img id="modalImageBackdrop" class="modal-ambient-backdrop" src="{{ asset('assets/images/projects/al-jamea-etfe.png') }}" alt="" aria-hidden="true">
      <img id="modalImage" class="modal-product-img" src="{{ asset('assets/images/projects/al-jamea-etfe.png') }}" alt="Product Showcase">
    </div>

    <!-- Interactive Photo Gallery Strip (Allows clicking between multiple angles) -->
    <div class="modal-thumbs-strip" id="modalThumbsStrip">
      <!-- Rendered dynamically by JS -->
    </div>

    <!-- 6 Key Engineering Metrics -->
    <div class="modal-specs-bar">
      <div class="modal-spec-cell">
        <span class="spec-label">Covered Area</span>
        <span class="spec-val" id="modalArea">—</span>
      </div>
      <div class="modal-spec-cell">
        <span class="spec-label">Membrane Material</span>
        <span class="spec-val" id="modalMaterial">—</span>
      </div>
      <div class="modal-spec-cell">
        <span class="spec-label">Location</span>
        <span class="spec-val" id="modalLocation">—</span>
      </div>
      <div class="modal-spec-cell">
        <span class="spec-label">Clear Span</span>
        <span class="spec-val" id="modalSpan">—</span>
      </div>
      <div class="modal-spec-cell">
        <span class="spec-label">Handover Year</span>
        <span class="spec-val" id="modalYearSpec">—</span>
      </div>
      <div class="modal-spec-cell">
        <span class="spec-label">Client / Authority</span>
        <span class="spec-val" id="modalClientSpec">—</span>
      </div>
    </div>

    <!-- Two-Column Case Study Body -->
    <div class="modal-body-content">
      <!-- Left Column: Narrative & Technical Specs -->
      <div>
        <h3 class="modal-desc-heading">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
          Case Study &amp; Technical Execution
        </h3>
        <p class="modal-description" id="modalDesc">Detailed case study narrative...</p>

        <div class="modal-callout-box">
          <div class="modal-callout-title">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
            FEA Non-Linear Form-Finding &amp; Biaxial Prestress
          </div>
          <p class="modal-callout-text">
            Engineered using advanced 3D non-linear dynamic relaxation algorithms to ensure stable aerodynamic deflection and zero water-ponding under extreme Middle Eastern and international meteorological conditions.
          </p>
        </div>

        <div class="modal-highlights-grid">
          <div class="modal-highlight-item">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            <span>Class A Fire Rating (ASTM E136)</span>
          </div>
          <div class="modal-highlight-item">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            <span>Wind Rated up to 160 km/h</span>
          </div>
          <div class="modal-highlight-item">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            <span>Self-Cleaning Fluoropolymer</span>
          </div>
          <div class="modal-highlight-item">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            <span>20+ Year Design Life Cycle</span>
          </div>
        </div>
      </div>

      <!-- Right Column: Project Stewardship & Direct Action -->
      <div class="modal-sidebar-card">
        <h4 class="modal-sidebar-title">Project Fast Facts</h4>
        <ul class="modal-facts-list">
          <li><span>Contract Scope</span> <strong>Turnkey EPC</strong></li>
          <li><span>Building Code</span> <strong>ASCE 55-16 / UAE IBC</strong></li>
          <li><span>Safety Standard</span> <strong>UAE Civil Defense</strong></li>
          <li><span>Tension System</span> <strong>Prestressed Stainless Cables</strong></li>
          <li><span>Fabric Guarantee</span> <strong>20-Year Warranty</strong></li>
        </ul>

        <a href="{{ route('contact.index') }}" id="modalInquireBtn" class="modal-action-btn-primary">
          <span>Inquire About Similar Structure</span>
          <span>&rarr;</span>
        </a>

        <div class="modal-phone-direct">
          <span>Direct Engineering Line:</span>
          <strong>+971 4 238 8455</strong>
        </div>
      </div>
    </div>

    <!-- Bottom Keyboard Navigation Bar -->
    <div class="modal-bottom-bar">
      <div class="modal-key-hint">
        <span>Navigate:</span>
        <kbd>&larr;</kbd>
        <kbd>&rarr;</kbd>
        <span>or use arrow buttons to flip between case studies</span>
      </div>
      <div>
        <kbd>Esc</kbd> <span>to close</span>
      </div>
    </div>

  </div>
</div>
