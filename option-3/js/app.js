/**
 * Structurflex Middle East Contracting (SFXMEC) - Option 3
 * Interactive Logic for ZIVANA-Style Aesthetic
 */

/* ==========================================================================
   1. AUTHENTIC CASE STUDY DATASET (Option 3 Project Details)
   ========================================================================== */
const opt3Projects = {
  'abu-dhabi-shooting': {
    title: 'Abu Dhabi Shooting Club PTFE Roof',
    shortTitle: 'Abu Dhabi Shooting Club',
    category: 'Sports & Leisure Landmark',
    subtitle: 'A 6,200 sq.m landmark architectural PTFE fiberglass tensile membrane roof featuring high-tension flying masts, engineered to endure harsh desert coastal winds and thermal extremes.',
    location: 'Abu Dhabi, UAE',
    area: '6,200 m²',
    material: 'PTFE Glass Fiber',
    year: '2018',
    span: '52m Flying Mast',
    client: 'Abu Dhabi Shooting Club Authority',
    heroImg: '../assets/images/projects/abu-dhabi-shooting-club.jpg',
    thumbs: [
      '../assets/images/projects/abu-dhabi-shooting-club.jpg',
      '../assets/images/projects/dubai-outlet-mall.jpg',
      '../assets/images/solutions/commercial.jpg',
      '../assets/images/solutions/architectural.png'
    ],
    overview: `
      <p class="detail-p">The Abu Dhabi Shooting Club required an iconic, sun-shading architectural envelope that could protect spectators and athletes from the extreme Arabian Gulf solar radiance while maintaining natural air circulation and daytime illumination.</p>
      <p class="detail-p">Structurflex Middle East Contracting LLC was commissioned as the specialist design-build contractor to engineer, fabricate, and erect a sweeping tensile membrane structure spanning over 6,200 square meters. The client’s vision mandated an aerodynamic silhouette inspired by traditional bedouin tents, reimagined through 21st-century aerospace tension engineering.</p>
    `,
    challenge: 'High gusting desert winds coupled with extreme ambient thermal expansion (reaching up to 55°C) created severe biaxial strain variations across the membrane panels, risking fabric ponding and stress fatigue.',
    solution: 'Implemented non-linear geometric finite element analysis (FEA) to calculate optimal biaxial compensation ratios. Integrated floating tension masts with stainless steel prestressed stay cables to absorb dynamic wind buffeting.'
  },
  'dubai-outlet-mall': {
    title: 'Dubai Outlet Mall Fast-Track Desert Roof',
    shortTitle: 'Dubai Outlet Mall',
    category: 'Retail Commercial Landmark',
    subtitle: 'Conical architectural membrane canopies providing 100% UV blockout, continuous thermal comfort, and rapid fast-track installation across outdoor shopping plazas.',
    location: 'Dubai, UAE',
    area: '4,800 m²',
    material: 'Precontraint High-Performance Membrane',
    year: '2016',
    span: 'Continuous Modular Cones',
    client: 'Dubai Outlet Mall Developers',
    heroImg: '../assets/images/projects/dubai-outlet-mall.jpg',
    thumbs: [
      '../assets/images/projects/dubai-outlet-mall.jpg',
      '../assets/images/projects/fruit-vegetable-market.jpg',
      '../assets/images/solutions/commercial.jpg',
      '../assets/images/projects/abu-dhabi-shooting-club.jpg'
    ],
    overview: `
      <p class="detail-p">Dubai Outlet Mall required an urgent architectural roofing upgrade to shade open-air retail concourses prior to peak tourist season. Structurflex Middle East engineered an accelerated design-build programme, installing high-reflectance tensile membranes that withstand intense solar heat and seasonal sandstorms.</p>
      <p class="detail-p">The resulting conical geometry channels wind turbulence away from shopping storefronts while deflecting over 80% of direct solar heat gain, creating an inviting microclimate for thousands of daily visitors.</p>
    `,
    challenge: 'Demanding fast-track schedule with zero downtime permitted for active retail shoppers, requiring sand-tight perimeter seals against violent desert dust storms.',
    solution: 'Engineered pre-assembled modular tensile umbrella clusters with high-frequency shop welding, allowing rapid nighttime crane installation without disrupting daytime foot traffic.'
  },
  'al-jamea-etfe': {
    title: 'Al Jamea University ETFE Atrium',
    shortTitle: 'Al Jamea University',
    category: 'ETFE Atrium Architecture',
    subtitle: 'Pneumatic 3-layer ETFE cushion daylighting canopy filtering solar heat while flooding educational campus halls with diffused natural light.',
    location: 'Dubai / Nairobi',
    area: '4,800 m²',
    material: 'Pneumatic 3-Layer ETFE Cushions',
    year: '2021',
    span: '34m Unsupported Curved Extrusion',
    client: 'Al Jamea Tus Saifiyah',
    heroImg: '../assets/images/projects/al-jamea-etfe.png',
    thumbs: [
      '../assets/images/projects/al-jamea-etfe.png',
      '../assets/images/solutions/architectural.png',
      '../assets/images/projects/al-janah-pavilion.png',
      '../assets/images/projects/abu-dhabi-shooting-club.jpg'
    ],
    overview: `
      <p class="detail-p">Transforming architectural concepts into reality at the heart of the campus. Structurflex Middle East Contracting LLC engineered and installed an innovative Single Skin and Multi-Layer ETFE tensile membrane roofing structure that marries cultural heritage with modern engineering precision.</p>
      <p class="detail-p">The translucent membrane delivers exceptional daylighting while maintaining thermal comfort and weather durability, achieving a 95% reduction in dead weight compared to traditional glass skylights.</p>
    `,
    challenge: 'Extreme solar heat loads in an educational setting demanding crystal clear daylighting and strict acoustic dampening during torrential rainstorms.',
    solution: 'Engineered 3-layer pneumatic cushions equipped with custom silver micro-frit shading patterns and variable inflation pressure controls to regulate solar heat gain throughout the seasons.'
  },
  'asati-dome': {
    title: 'ASATI Multi-Sport Inflatable Air Dome',
    shortTitle: 'ASATI Sports Dome',
    category: 'Air-Supported Engineering',
    subtitle: 'Column-free 4,500 sq.m air-supported structure with automated triple-redundancy HVAC inflation systems for world-class climate-controlled sporting events.',
    location: 'Sharjah & Dubai, UAE',
    area: '14,000 m²',
    material: 'Double-Skin Thermal Air Dome Membrane',
    year: '2024',
    span: '120m Column-Free Clear Span',
    client: 'Sports & Logistics Development Authority',
    heroImg: '../assets/images/projects/air-supported-asati.jpg',
    thumbs: [
      '../assets/images/projects/air-supported-asati.jpg',
      '../assets/images/solutions/sports.jpg',
      '../assets/images/projects/westlake-girls-sports.jpg',
      '../assets/images/projects/rio-tinto-stadium.jpg'
    ],
    overview: `
      <p class="detail-p">Delivered in strategic regional partnership with ASATI (Air Structures American Technologies, Inc.), this landmark facility features 100% clear-span capability, completely eliminating internal columns or load-bearing truss walls.</p>
      <p class="detail-p">Equipped with computerized internal air pressure regulation, thermal insulation blankets, and high-efficiency chillers, the dome provides year-round Olympic-standard training grounds in the middle of desert heat.</p>
    `,
    challenge: 'Sustaining positive interior static pressure in blistering summer temperatures without thermal leakage or excessive power consumption.',
    solution: 'Installed double-skin membrane envelope with patented thermal interlayers, integrated emergency diesel blowers, and smart building management sensors.'
  },
  'arena-corinthians': {
    title: 'Arena Corinthians FIFA World Cup Stadium Roof',
    shortTitle: 'Arena Corinthians',
    category: 'FIFA World Cup Stadium',
    subtitle: 'High-tensioned structural PTFE membrane roof engineered for international tournament standards and harsh acoustic resonance requirements.',
    location: 'São Paulo / International',
    area: '28,000 m²',
    material: 'Structural Acoustic PTFE Fiberglass',
    year: '2014',
    span: 'Cantilevered Stadium Bowstring Truss',
    client: 'World Cup Organizing Committee',
    heroImg: '../assets/images/projects/arena-corinthians.jpg',
    thumbs: [
      '../assets/images/projects/arena-corinthians.jpg',
      '../assets/images/projects/rio-tinto-stadium.jpg',
      '../assets/images/projects/denver-union-station.jpg',
      '../assets/images/projects/abu-dhabi-shooting-club.jpg'
    ],
    overview: `
      <p class="detail-p">Engineered to host international FIFA World Cup matches, this iconic stadium canopy required massive cantilevered spans providing complete spectator rain protection while retaining open stadium acoustics.</p>
      <p class="detail-p">Structurflex provided detailed membrane engineering, precision patterning, and specialized erection supervision for the tensioned PTFE fiberglass roof panels.</p>
    `,
    challenge: 'Huge aerodynamic wind uplift across cantilevered grandstand roofs combined with acoustic echo control for 65,000 passionate spectators.',
    solution: 'Acoustically micro-perforated PTFE membrane layers tensioned over spatial steel bowstring trusses with dampening cable anchors.'
  },
  'denver-station': {
    title: 'Denver Union Station Landmark Canopy',
    shortTitle: 'Denver Union Station',
    category: 'Transit Infrastructure',
    subtitle: '165-meter-long soaring PTFE fabric canopy supported by sweeping structural steel trusses sheltering public transit concourses.',
    location: 'Denver, Colorado',
    area: '9,800 m²',
    material: 'PTFE Coated Woven Fiberglass Net',
    year: '2014',
    span: '165m Continuous Wave',
    client: 'Regional Transit Authority',
    heroImg: '../assets/images/projects/denver-union-station.jpg',
    thumbs: [
      '../assets/images/projects/denver-union-station.jpg',
      '../assets/images/projects/al-janah-pavilion.png',
      '../assets/images/projects/ethiopia-unity-park.jpg',
      '../assets/images/projects/fruit-vegetable-market.jpg'
    ],
    overview: `
      <p class="detail-p">A landmark design-build project for a historic railway transit hub. Complex multi-stakeholder design-engineer-build execution resulting in a soaring PTFE canopy that shelters commuter platforms and celebrates architectural heritage.</p>
      <p class="detail-p">The open-air translucent wave structure provides sheltered pedestrian flow between commuter rail, light rail, and regional bus terminals.</p>
    `,
    challenge: 'Severe winter snow loading, intense thermal cycling, and continuous live commuter rail traffic underneath during crane operations.',
    solution: 'Integrated wave-form geometry shedding snow into perimeter heated drainage gutters, erected via synchronized night-shift crane maneuvers.'
  }
};

/* ==========================================================================
   2. TECHNICAL WHITEPAPER ARTICLES DATASET (Option 3 Blog Details)
   ========================================================================== */
const opt3Articles = {
  'choosing-contractor': {
    title: 'Choosing the Right Contractor for Your Tensile Project',
    shortTitle: 'Contractor Evaluation Guide',
    category: 'Client Guide · Technical Whitepaper',
    author: 'Albert Sandy',
    date: 'October 12, 2026',
    readTime: '10 min read',
    heroImg: '../assets/images/solutions/commercial.jpg',
    summary: 'Tensile architecture represents one of the most technologically demanding disciplines in civil construction. In the Middle East, where surface temperatures exceed 65°C and coastal wind buffeting can reach 160 km/h, choosing the wrong contractor can lead to catastrophic fabric tearing, unsightly ponding, or structural mast failure. This whitepaper outlines the 5 non-negotiable engineering capabilities developers must audit before tender award.'
  },
  'commercial-build-planning': {
    title: 'How to Plan Your Commercial Build Effectively',
    shortTitle: 'Commercial Planning Guide',
    category: 'Construction Tips · Technical Whitepaper',
    author: 'Albert Sandy',
    date: 'October 8, 2026',
    readTime: '8 min read',
    heroImg: '../assets/images/solutions/architectural.png',
    summary: 'From boundary reaction moments to foundation cost optimization, successful commercial tensile execution requires aligning architectural design with non-linear structural form-finding from Day 1.'
  },
  'sustainable-ptfe-etfe': {
    title: 'Why Sustainable PTFE and ETFE Systems Matter in 2026',
    shortTitle: 'Sustainable Materials Study',
    category: 'Green Building · Technical Whitepaper',
    author: 'Jordy Alita',
    date: 'September 28, 2026',
    readTime: '7 min read',
    heroImg: '../assets/images/solutions/sports.jpg',
    summary: 'Analyzing how advanced fluoropolymer membranes and pneumatic ETFE cushions slash building HVAC energy loads by over 35% through high solar reflectance (SRI) and diffused daylight penetration.'
  }
};

/* ==========================================================================
   3. DOM INITIALIZATION
   ========================================================================== */
document.addEventListener('DOMContentLoaded', () => {
  // Sticky Header Transition
  const header = document.querySelector('.site-header');
  if (header) {
    window.addEventListener('scroll', () => {
      if (window.scrollY > 50) {
        header.classList.add('scrolled');
      } else {
        header.classList.remove('scrolled');
      }
    });
  }

  // Mobile Menu Toggle
  const mobileToggle = document.querySelector('.mobile-toggle');
  const navMenu = document.querySelector('.nav-menu');
  if (mobileToggle && navMenu) {
    mobileToggle.addEventListener('click', () => {
      const isVisible = navMenu.style.display === 'flex';
      navMenu.style.display = isVisible ? 'none' : 'flex';
      if (!isVisible) {
        navMenu.style.flexDirection = 'column';
        navMenu.style.position = 'absolute';
        navMenu.style.top = '100%';
        navMenu.style.left = '0';
        navMenu.style.right = '0';
        navMenu.style.background = '#081E3D';
        navMenu.style.padding = '1.5rem';
        navMenu.style.borderBottom = '1px solid rgba(255,255,255,0.1)';
      }
    });
  }

  // Back to Top Button
  const backToTopBtn = document.querySelector('.back-to-top-circle');
  if (backToTopBtn) {
    backToTopBtn.addEventListener('click', () => {
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    });
  }

  // Quotes Contact Form Feedback
  const quotesForm = document.getElementById('opt3QuotesForm');
  const feedbackMsg = document.getElementById('quotesFormFeedback');
  if (quotesForm) {
    quotesForm.addEventListener('submit', (e) => {
      e.preventDefault();
      if (feedbackMsg) feedbackMsg.style.display = 'block';
      quotesForm.reset();
    });
  }

  // Interactive Project Thumbnails
  const galleryThumbs = document.querySelectorAll('.thumb-btn');
  const heroImg = document.getElementById('projectHeroImg');
  if (galleryThumbs.length && heroImg) {
    galleryThumbs.forEach(btn => {
      btn.addEventListener('click', () => {
        galleryThumbs.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        const targetSrc = btn.getAttribute('data-img');
        if (targetSrc) {
          heroImg.style.opacity = '0.4';
          setTimeout(() => {
            heroImg.src = targetSrc;
            heroImg.style.opacity = '1';
          }, 150);
        }
      });
    });
  }

  // Copy Link Button on Whitepaper Details
  const copyBtn = document.getElementById('btnCopyLink');
  if (copyBtn) {
    copyBtn.addEventListener('click', () => {
      navigator.clipboard.writeText(window.location.href).then(() => {
        copyBtn.textContent = 'Link Copied!';
        setTimeout(() => {
          copyBtn.textContent = 'Copy Link';
        }, 2000);
      }).catch(() => {
        alert('URL copied to clipboard: ' + window.location.href);
      });
    });
  }

  // Dynamic Query Param Loading for project-details.html
  const urlParams = new URLSearchParams(window.location.search);
  const projectId = urlParams.get('id');
  if (projectId && opt3Projects[projectId] && document.getElementById('projectTitle')) {
    const p = opt3Projects[projectId];
    document.title = `${p.title} | Structurflex Middle East - Option 3`;
    
    const elBc = document.getElementById('bcProjectTitle');
    if (elBc) elBc.textContent = p.shortTitle || p.title;

    const elBadge = document.getElementById('projectCategoryBadge');
    if (elBadge) elBadge.textContent = p.category;

    const elTitle = document.getElementById('projectTitle');
    if (elTitle) elTitle.textContent = p.title;

    const elSub = document.getElementById('projectSubtitle');
    if (elSub) elSub.textContent = p.subtitle;

    const elLoc = document.getElementById('specLocation');
    if (elLoc) elLoc.textContent = p.location;

    const elArea = document.getElementById('specArea');
    if (elArea) elArea.textContent = p.area;

    const elMat = document.getElementById('specMaterial');
    if (elMat) elMat.textContent = p.material;

    const elYr = document.getElementById('specYear');
    if (elYr) elYr.textContent = p.year;

    const elSpan = document.getElementById('specSpan');
    if (elSpan) elSpan.textContent = p.span;

    const elClient = document.getElementById('specClient');
    if (elClient) elClient.textContent = p.client;

    const elHero = document.getElementById('projectHeroImg');
    if (elHero) {
      elHero.src = p.heroImg;
      elHero.alt = p.title;
    }

    const elOverview = document.getElementById('projectOverviewBody');
    if (elOverview) elOverview.innerHTML = p.overview;

    const elGrid = document.getElementById('projectChallengesGrid');
    if (elGrid) {
      elGrid.innerHTML = `
        <div class="cs-card challenge">
          <div class="cs-title">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#EF4444" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            Structural Challenge
          </div>
          <p style="font-size: 0.92rem; color: var(--opt3-text-body); line-height: 1.6;">${p.challenge}</p>
        </div>
        <div class="cs-card solution">
          <div class="cs-title">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--opt3-green-primary)" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            Engineered Solution
          </div>
          <p style="font-size: 0.92rem; color: var(--opt3-text-body); line-height: 1.6;">${p.solution}</p>
        </div>
      `;
    }

    const elFactType = document.getElementById('factType');
    if (elFactType) elFactType.textContent = p.category;

    // Update gallery thumbs if present
    const elThumbsRow = document.getElementById('galleryThumbs');
    if (elThumbsRow && p.thumbs) {
      elThumbsRow.innerHTML = p.thumbs.map((imgUrl, idx) => `
        <button class="thumb-btn ${idx === 0 ? 'active' : ''}" data-img="${imgUrl}">
          <img src="${imgUrl}" alt="Photo ${idx + 1}">
        </button>
      `).join('');

      // re-attach listener
      elThumbsRow.querySelectorAll('.thumb-btn').forEach(btn => {
        btn.addEventListener('click', () => {
          elThumbsRow.querySelectorAll('.thumb-btn').forEach(b => b.classList.remove('active'));
          btn.classList.add('active');
          const targetSrc = btn.getAttribute('data-img');
          if (targetSrc && elHero) {
            elHero.style.opacity = '0.4';
            setTimeout(() => {
              elHero.src = targetSrc;
              elHero.style.opacity = '1';
            }, 150);
          }
        });
      });
    }
  }

  // Dynamic Query Param Loading for blog-details.html
  const articleId = urlParams.get('id');
  if (articleId && opt3Articles[articleId] && document.getElementById('articleTitle')) {
    const a = opt3Articles[articleId];
    document.title = `${a.title} | Structurflex Middle East - Option 3`;

    const elBc = document.getElementById('bcArticleTitle');
    if (elBc) elBc.textContent = a.shortTitle || a.title;

    const elBadge = document.getElementById('articleCategoryBadge');
    if (elBadge) elBadge.textContent = a.category;

    const elTitle = document.getElementById('articleTitle');
    if (elTitle) elTitle.textContent = a.title;

    const elAuthor = document.getElementById('articleAuthor');
    if (elAuthor) elAuthor.textContent = a.author;

    const elBioAuthor = document.getElementById('bioAuthorName');
    if (elBioAuthor) elBioAuthor.textContent = a.author;

    const elDate = document.getElementById('articleDate');
    if (elDate) elDate.textContent = a.date;

    const elReadTime = document.getElementById('articleReadTime');
    if (elReadTime) elReadTime.textContent = a.readTime;

    const elHero = document.getElementById('articleHeroImg');
    if (elHero) {
      elHero.src = a.heroImg;
      elHero.alt = a.title;
    }

    const elSummary = document.getElementById('articleExecSummary');
    if (elSummary) {
      elSummary.innerHTML = `<strong>Executive Summary:</strong> ${a.summary}`;
    }
  }
});
