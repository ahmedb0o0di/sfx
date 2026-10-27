/**
 * SFXMEC (Structurflex Middle East Contracting) - Interactive Application Logic
 */

document.addEventListener('DOMContentLoaded', () => {
  initNavbar();
  initStatCounters();
  initMaterialTabs();
  initPortfolioFilters();
  initProjectModals();
  initConversationalEstimator();
  initContactForm();
});

/* ==========================================================================
   1. NAVIGATION & SCROLL LISTENER
   ========================================================================== */
function initNavbar() {
  const header = document.querySelector('.site-header');
  const mobileToggle = document.querySelector('.mobile-toggle');
  const navMenu = document.querySelector('.nav-menu');
  const navLinks = document.querySelectorAll('.nav-link');

  // Sticky header class on scroll
  window.addEventListener('scroll', () => {
    if (window.scrollY > 30) {
      header.classList.add('scrolled');
    } else {
      header.classList.remove('scrolled');
    }
  });

  // Mobile menu toggle
  if (mobileToggle && navMenu) {
    mobileToggle.addEventListener('click', () => {
      navMenu.classList.toggle('open');
      const isOpen = navMenu.classList.contains('open');
      mobileToggle.setAttribute('aria-expanded', isOpen);
      mobileToggle.innerHTML = isOpen
        ? `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>`
        : `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>`;
    });

    // Close menu when clicking link
    navLinks.forEach(link => {
      link.addEventListener('click', () => {
        navMenu.classList.remove('open');
        mobileToggle.setAttribute('aria-expanded', 'false');
        mobileToggle.innerHTML = `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>`;
      });
    });
  }

  // Multi-page active link highlighting
  const currentPath = window.location.pathname;
  let pageFilename = currentPath.substring(currentPath.lastIndexOf('/') + 1);
  if (!pageFilename || pageFilename === '/') pageFilename = 'index.html';

  navLinks.forEach(link => {
    const href = link.getAttribute('href');
    if (!href) return;
    const hrefPage = href.split('#')[0].split('?')[0];
    if (hrefPage === pageFilename || (pageFilename === 'index.html' && (hrefPage === '' || hrefPage === 'index.html'))) {
      link.classList.add('active');
    } else {
      link.classList.remove('active');
    }
  });
}

/* ==========================================================================
   2. ANIMATED NUMBER COUNTERS (SUPPORTS MONUMENTAL TYPOGRAPHY & STATS)
   ========================================================================== */
function initStatCounters() {
  const statNumbers = document.querySelectorAll('.stat-number, .counter');
  let animated = false;

  const countUp = () => {
    statNumbers.forEach(stat => {
      const target = parseInt(stat.getAttribute('data-target'), 10);
      if (isNaN(target)) return;
      const suffix = stat.getAttribute('data-suffix') || '';
      let count = 0;
      const step = Math.ceil(target / 40);
      const timer = setInterval(() => {
        count += step;
        if (count >= target) {
          stat.textContent = target.toLocaleString();
          clearInterval(timer);
        } else {
          stat.textContent = count.toLocaleString();
        }
      }, 35);
    });
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting && !animated) {
        countUp();
        animated = true;
      }
    });
  }, { threshold: 0.2 });

  const statsTarget = document.querySelector('.hero-monument-stats') || document.querySelector('.hero-stats');
  if (statsTarget) {
    observer.observe(statsTarget);
  }
}

/* ==========================================================================
   3. INTERACTIVE MATERIAL COMPARATOR MATRIX (LIVE ARCHITECTURAL CONSOLE)
   ========================================================================== */
const materialMatrixData = {
  ptfe: {
    lifespan: '35+',
    lifespanUnit: 'Years',
    lifespanBar: '100%',
    lifespanSub: 'Permanent Non-Combustible',
    heat: '85%',
    heatUnit: 'Deflection',
    heatBar: '85%',
    heatSub: 'Blocks 85% Infrared Load',
    strength: '8,000',
    strengthUnit: 'N/5cm',
    strengthBar: '95%',
    strengthSub: 'Woven Glass Fiber Base',
    light: '15%',
    lightUnit: 'Glare-Free',
    lightBar: '25%',
    lightSub: 'Soft Diffused Lux Level',
    badge: 'NON-COMBUSTIBLE • DIN 4102 A2 • ASTM E108',
    title: 'PTFE Architectural Fiberglass',
    desc: 'The premier choice for permanent monumental tensile architecture. Woven glass fiber coated with chemically inert Teflon™ PTFE. Completely impervious to Middle Eastern UV radiation, self-cleaning under rain, with an expected lifespan exceeding 35 years.',
    chemical: 'Woven Silica Glass Core Encapsulated in Dupont Teflon Fluoropolymer',
    cleaning: 'Photocatalytic TiO2 top-coat oxidizes organic airborne dust and soot',
    benchmark: 'Abu Dhabi Ladies Club PTFE Roof, Al Wasl Grand Arena, Terminal 1 Airport Concourse',
    tableRows: [
      { criterion: 'Fire Resistance Classification', rating: '<strong class="highlight-val">Class A / Non-Burning (ASTM E108)</strong>' },
      { criterion: 'Weight per m²', rating: '1.45 kg/m² (~1% weight of insulated glass)' },
      { criterion: 'Thermal Insulation U-Value', rating: '4.5 W/m²K (Single Layer) | 1.8 W/m²K (Insulated Aerogel)' },
      { criterion: 'Middle Eastern UV Resistance', rating: '100% Inert — Zero Photodegradation over 35+ Years' },
      { criterion: 'Standard Joint Methodology', rating: 'High-Temperature Thermal Compression Fusion Seams' }
    ]
  },
  etfe: {
    lifespan: '25 - 30',
    lifespanUnit: 'Years',
    lifespanBar: '80%',
    lifespanSub: 'Self-Extinguishing Fluoropolymer',
    heat: '75%',
    heatUnit: 'Deflection',
    heatBar: '75%',
    heatSub: 'Custom Ceramic Frit Shading',
    strength: '3,500',
    strengthUnit: 'N/5cm',
    strengthBar: '60%',
    strengthSub: 'Biaxially Oriented Extruded Foil',
    light: '92%',
    lightUnit: 'Transparent',
    lightBar: '95%',
    lightSub: 'Glass Clarity at 1% Weight',
    badge: 'GLASS REPLACEMENT • EN 13501-1 B-s1,d0 • 92% LUX',
    title: 'ETFE Pneumatic Foil Cushions',
    desc: 'Transparent architectural foil cushions stabilized with low-pressure pneumatic air supply units. Provides maximum natural daylighting for commercial retail atriums and botanical enclosures with negligible structural dead load.',
    chemical: '100% Recyclable Ethylene Tetrafluoroethylene Fluoropolymer Copolymer',
    cleaning: 'Low-friction surface naturally sheds desert sand and dust via rainwater',
    benchmark: 'Mall Atrium Skylights, Luxury Botanical Gardens, Concourse Enclosures',
    tableRows: [
      { criterion: 'Fire Resistance Classification', rating: '<strong class="highlight-val">Class B1 / Self-Extinguishing (DIN 4102)</strong>' },
      { criterion: 'Weight per m²', rating: '0.35 - 0.70 kg/m² (~1% weight of insulated glass)' },
      { criterion: 'Thermal Insulation U-Value', rating: '1.6 - 2.0 W/m²K (3-Layer Pneumatic Cushion)' },
      { criterion: 'Middle Eastern UV Resistance', rating: '95%+ Transparency; Zero UV-induced embrittlement' },
      { criterion: 'Standard Joint Methodology', rating: 'Continuous CNC Perimeter Aluminum Extrusion Clamping' }
    ]
  },
  pvc: {
    lifespan: '15 - 20+',
    lifespanUnit: 'Years',
    lifespanBar: '55%',
    lifespanSub: 'Flame-Retardant PVDF Topcoat',
    heat: '78%',
    heatUnit: 'Deflection',
    heatBar: '78%',
    heatSub: 'High Solar Reflectance Index',
    strength: '6,000',
    strengthUnit: 'N/5cm',
    strengthBar: '75%',
    strengthSub: 'High-Tenacity Polyester Core',
    light: '10%',
    lightUnit: 'Diffused',
    lightBar: '18%',
    lightSub: 'Uniform Soft Ambient Shade',
    badge: 'HIGH VERSATILITY • NFPA 701 • DIN 4102 B1',
    title: 'PVC / PVDF Tensile Composite',
    desc: 'High-strength woven polyester base fabric coated with plasticized PVC and sealed with a fluoropolymer PVDF protective lacquer. Highly ductile, cost-efficient, and optimized for rapid turnkey fabrication and erection across the GCC.',
    chemical: 'High-Tenacity Woven Polyester Core with Multi-Layer PVDF Protective Lacquer',
    cleaning: 'Fluoro-polymer lacquer resists dust adhering; periodic pressure wash recommended',
    benchmark: 'Golden Gate Mirdif Center, School Courtyard Canopies, Commercial Car Shades',
    tableRows: [
      { criterion: 'Fire Resistance Classification', rating: '<strong class="highlight-val">Flame Retardant (DIN 4102 B1 / NFPA 701)</strong>' },
      { criterion: 'Weight per m²', rating: '0.95 - 1.35 kg/m² (Type II to Type IV grades)' },
      { criterion: 'Thermal Insulation U-Value', rating: '5.2 W/m²K (Single Layer Membrane)' },
      { criterion: 'Middle Eastern UV Resistance', rating: 'PVDF Sealed against photo-oxidation; antifungal treated' },
      { criterion: 'Standard Joint Methodology', rating: 'High-Frequency (HF) Electronic Molecular Seaming' }
    ]
  }
};

function initMaterialTabs() {
  const switchBtns = document.querySelectorAll('.mat-switch-btn');
  if (!switchBtns.length) return;

  const updateMaterialConsole = (matKey) => {
    const data = materialMatrixData[matKey];
    if (!data) return;

    // Update active tab buttons
    switchBtns.forEach(btn => {
      const isTarget = btn.getAttribute('data-material') === matKey;
      btn.classList.toggle('active', isTarget);
      btn.setAttribute('aria-selected', isTarget ? 'true' : 'false');
    });

    // Update KPIs
    const dynLifespan = document.getElementById('dynLifespan');
    const dynHeat = document.getElementById('dynHeat');
    const dynStrength = document.getElementById('dynStrength');
    const dynLight = document.getElementById('dynLight');

    if (dynLifespan) dynLifespan.innerHTML = `${data.lifespan} <span class="kpi-unit">${data.lifespanUnit}</span>`;
    if (dynHeat) dynHeat.innerHTML = `${data.heat} <span class="kpi-unit">${data.heatUnit}</span>`;
    if (dynStrength) dynStrength.innerHTML = `${data.strength} <span class="kpi-unit">${data.strengthUnit}</span>`;
    if (dynLight) dynLight.innerHTML = `${data.light} <span class="kpi-unit">${data.lightUnit}</span>`;

    // Update meter bars
    const dynLifespanBar = document.getElementById('dynLifespanBar');
    const dynHeatBar = document.getElementById('dynHeatBar');
    const dynStrengthBar = document.getElementById('dynStrengthBar');
    const dynLightBar = document.getElementById('dynLightBar');

    if (dynLifespanBar) dynLifespanBar.style.width = data.lifespanBar;
    if (dynHeatBar) dynHeatBar.style.width = data.heatBar;
    if (dynStrengthBar) dynStrengthBar.style.width = data.strengthBar;
    if (dynLightBar) dynLightBar.style.width = data.lightBar;

    // Update sub labels
    const dynLifespanSub = document.getElementById('dynLifespanSub');
    const dynHeatSub = document.getElementById('dynHeatSub');
    const dynStrengthSub = document.getElementById('dynStrengthSub');
    const dynLightSub = document.getElementById('dynLightSub');

    if (dynLifespanSub) dynLifespanSub.textContent = data.lifespanSub;
    if (dynHeatSub) dynHeatSub.textContent = data.heatSub;
    if (dynStrengthSub) dynStrengthSub.textContent = data.strengthSub;
    if (dynLightSub) dynLightSub.textContent = data.lightSub;

    // Update Spec Narrative
    const dynBadge = document.getElementById('dynBadge');
    const dynTitle = document.getElementById('dynTitle');
    const dynDesc = document.getElementById('dynDesc');
    const dynChemical = document.getElementById('dynChemical');
    const dynCleaning = document.getElementById('dynCleaning');
    const dynBenchmark = document.getElementById('dynBenchmark');

    if (dynBadge) dynBadge.textContent = data.badge;
    if (dynTitle) dynTitle.textContent = data.title;
    if (dynDesc) dynDesc.textContent = data.desc;
    if (dynChemical) dynChemical.textContent = data.chemical;
    if (dynCleaning) dynCleaning.textContent = data.cleaning;
    if (dynBenchmark) dynBenchmark.textContent = data.benchmark;

    // Update Spec Table
    const dynTableBody = document.getElementById('dynTableBody');
    if (dynTableBody && data.tableRows) {
      dynTableBody.innerHTML = data.tableRows.map(row => `
        <tr>
          <td>${row.criterion}</td>
          <td>${row.rating}</td>
        </tr>
      `).join('');
    }
  };

  switchBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      const mat = btn.getAttribute('data-material');
      updateMaterialConsole(mat);
    });
  });
}

/* ==========================================================================
   4. PORTFOLIO FILTERING
   ========================================================================== */
function initPortfolioFilters() {
  const filterBtns = document.querySelectorAll('.filter-btn');
  const projectCards = document.querySelectorAll('.project-card, .project-showcase-card');

  filterBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      filterBtns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');

      const filter = btn.getAttribute('data-filter');

      projectCards.forEach(card => {
        const category = card.getAttribute('data-category');
        if (filter === 'all' || category === filter) {
          card.style.display = 'flex';
          card.style.animation = 'fadeIn 0.35s ease forwards';
        } else {
          card.style.display = 'none';
        }
      });
    });
  });

  // Deep linking via URL parameter (e.g. projects.html?cat=education)
  try {
    const urlParams = new URLSearchParams(window.location.search);
    const cat = urlParams.get('cat');
    if (cat) {
      const targetBtn = Array.from(filterBtns).find(btn => btn.getAttribute('data-filter') === cat);
      if (targetBtn) {
        targetBtn.click();
      }
    }
  } catch (e) {
    // Ignore URL parse error
  }
}

/* ==========================================================================
   5. PROJECT CASE STUDY MODALS (FEATURING ORIGINAL SFXMEC EXECUTED PROJECTS)
   ========================================================================== */
const projectData = {
  'al-jamea': {
    title: 'Al Jamea Tus Saifiyah ETFE Roof Structure',
    category: 'architectural',
    categoryLabel: 'Architectural Structures',
    location: 'Nairobi, Kenya (Eastern Africa)',
    area: '4,800 m²',
    material: 'Single Skin ETFE Tensile Membrane',
    year: '2022',
    client: 'Al Jamea Tus Saifiyah',
    span: '34m Unsupported Curved Extrusion',
    image: 'assets/images/projects/al-jamea-etfe.png',
    description: 'Transforming architectural concepts into reality at the heart of Nairobi, Kenya. Structurflex Middle East Contracting LLC engineered and installed an innovative Single Skin ETFE tensile membrane roofing structure that marries cultural heritage with modern engineering precision. The translucent membrane delivers exceptional daylighting while maintaining thermal comfort and weather durability.'
  },
  'al-janah': {
    title: 'The Al Janah Landmark Pavilion',
    category: 'architectural',
    categoryLabel: 'Architectural Structures',
    location: 'Dubai, United Arab Emirates',
    area: '6,200 m²',
    material: 'Architectural PTFE & Custom Steel Truss',
    year: '2021',
    client: 'Landmark Expo Pavilion Authority',
    span: '42m Cantilevered Wing Architecture',
    image: 'assets/images/projects/al-janah-pavilion.png',
    description: 'Structurflex Middle East Contracting LLC played a crucial role in bringing this breathtaking design concept into reality. Featuring sculptural tensile geometry with dual curvature, this pavilion stands as a symbol of architectural elegance and engineering excellence.'
  },
  'ethiopia': {
    title: 'Ethiopia Pavilion — Unity Park',
    category: 'architectural',
    categoryLabel: 'Architectural Structures',
    location: 'Addis Ababa, Ethiopia',
    area: '3,900 m²',
    material: 'High-Tensile PVC/PVDF Architectural Membrane',
    year: '2019',
    client: 'Oromia Regional Government',
    span: '30m Multi-Cone Sculptural Shade',
    image: 'assets/images/projects/ethiopia-unity-park.jpg',
    description: 'A breathtaking pavilion seamlessly integrated into the historic Unity Park in Addis Ababa. Structurflex Middle East executed the full engineering, fabrication, and on-site installation, delivering solar protection and an iconic civic landmark.'
  },
  'abu-dhabi-shooting': {
    title: 'Abu Dhabi Shooting Club Tensile Roof',
    category: 'sports',
    categoryLabel: 'Sports & Recreation',
    location: 'Abu Dhabi, UAE',
    area: '7,500 m²',
    material: 'Heavy-Duty Architectural Tensile Membrane',
    year: '2018',
    client: 'Abu Dhabi Shooting Club Authority',
    span: '52m Integrated Cable-Tension Truss',
    image: 'assets/images/projects/abu-dhabi-shooting-club.jpg',
    description: 'The challenge was to improve an existing design concept to create a more practical, wind-stable, and aesthetically distinctive roof for Abu Dhabi\'s first premier shooting club. Structurflex ME optimized cable pre-stressing and thermal deflection for extreme desert conditions.'
  },
  'dubai-outlet-mall': {
    title: 'Dubai Outlet Mall Fast-Track Desert Roof',
    category: 'architectural',
    categoryLabel: 'Commercial & Retail',
    location: 'Dubai, UAE',
    area: '12,400 m²',
    material: 'Precontraint High-Performance Membrane',
    year: '2016',
    client: 'Dubai Outlet Mall Developers',
    span: 'Continuous High-Frequency Seamed Modules',
    image: 'assets/images/projects/dubai-outlet-mall.jpg',
    description: 'The challenge was to develop a desert-proof roof design at extremely short notice. Structurflex engineered an accelerated design-build programme, installing high-reflectance tensile membranes that withstand intense solar heat and seasonal sandstorms.'
  },
  'westlake-girls': {
    title: 'Westlake Girls Sports Facility Canopy',
    category: 'sports',
    categoryLabel: 'Sports & Recreation',
    location: 'Auckland / International Facility',
    area: '8,200 m²',
    material: 'Translucent High-Tensile PVC/PVDF',
    year: '2019',
    client: 'Educational & Sports Authority',
    span: 'Continuous Multi-Court Canopy',
    image: 'assets/images/projects/westlake-girls-sports.jpg',
    description: 'An iconic sporting venue that proves a winner for netball and tennis courts. Structurflex created a continuous clear-span canopy that eliminates interior columns, shielding athletes from rain and UV while illuminating courts with natural diffused daylight.'
  },
  'asati-dome': {
    title: 'ASATI Air-Supported Multisport Dome',
    category: 'air-supported',
    categoryLabel: 'Air-Supported Structures',
    location: 'Dubai & Northern Emirates, UAE',
    area: '14,000 m²',
    material: 'Double-Skin Thermal Insulated Air Dome Membrane',
    year: '2024',
    client: 'Sports & Logistics Development Authority',
    span: '120m Unsupported Air Pressure Clear Span',
    image: 'assets/images/solutions/air-supported-asati.jpg',
    description: 'Delivered in strategic partnership with ASATI (Air Structures American Technologies, Inc.). Features 100% clear-span capability up to 150m+, advanced automated HVAC pressure management, rapid seasonal installation, and superior energy efficiency for regional sports, exhibitions, and industrial warehousing.'
  },
  'vmf-market': {
    title: 'Vegetable, Meat & Fruit (VMF) Market',
    category: 'infrastructure',
    categoryLabel: 'Transport & Infrastructure',
    location: 'Al Ain, UAE',
    area: '18,600 m²',
    material: 'Architectural Tensile Membrane & Sand-Proof Seals',
    year: '2017',
    client: 'Al Ain Municipality',
    span: 'Conical High-Peak Traditional Shade Network',
    image: 'assets/images/projects/fruit-vegetable-market.jpg',
    description: 'A sophisticated outdoor market with a traditional Emirati architectural look and feel. The challenge was mitigating desert heat and dust while preserving an open, inviting bazaar atmosphere. Delivered under turnkey contract with Al Ain Municipality.'
  },
  'rio-tinto': {
    title: 'Rio Tinto MLS Stadium Canopy',
    category: 'sports',
    categoryLabel: 'Sports & Recreation',
    location: 'Sandy, Utah / Major League Soccer',
    area: '19,500 m²',
    material: 'High-Tensile PTFE Architectural Fiberglass',
    year: '2015',
    client: 'Major League Soccer Franchise',
    span: 'Aerodynamic Cantilevered Grandstand Truss',
    image: 'assets/images/projects/rio-tinto-stadium.jpg',
    description: 'A unique tensile canopy that gives this soccer stadium an unmistakable aesthetic point of difference. Engineered to handle seismic criteria, high snow loads, and aerodynamic uplift while giving every spectator an unobstructed view.'
  },
  'denver-station': {
    title: 'Denver Union Station Landmark Canopy',
    category: 'infrastructure',
    categoryLabel: 'Transport & Infrastructure',
    location: 'Denver, Colorado',
    area: '9,800 m²',
    material: 'PTFE Coated Woven Fiberglass Net',
    year: '2014',
    client: 'Regional Transit Authority',
    span: 'Arch-Supported Tension Wave Concourse',
    image: 'assets/images/projects/denver-union-station.jpg',
    description: 'A landmark design-build project for a historic railway station. Complex multi-stakeholder design-engineer-build execution resulting in a soaring PTFE canopy that shelters commuter platforms and celebrates architectural heritage.'
  },
  'rta-marine': {
    title: 'RTA Marine Floating Transit Stations',
    category: 'infrastructure',
    categoryLabel: 'Transport & Infrastructure',
    location: 'Dubai Canal & Creek, UAE',
    area: '4,200 m²',
    material: 'ETFE & PTFE Domes & Inverted Cones',
    year: '2019',
    client: 'Roads & Transport Authority (RTA Dubai)',
    span: 'Floating Marine Pontoon Canopies',
    image: 'assets/images/solutions/transport.jpg',
    gallery: [
      'assets/images/solutions/transport.jpg',
      'assets/images/projects/denver-union-station.jpg',
      'assets/images/projects/al-janah-pavilion.png'
    ],
    description: 'High-performance ETFE domes and inverted tensile cones custom engineered for Dubai Roads & Transport Authority (RTA) marine transit stations. Built to endure high humidity, marine salinity, and coastal wind loading.'
  },
  'arena-corinthians': {
    title: 'Arena Corinthians 2014 FIFA World Cup Stadium',
    category: 'sports',
    categoryLabel: 'Sports & Recreation',
    location: 'São Paulo, Brazil',
    area: '28,000 m²',
    material: 'Smooth Acoustic & Reflective Tensile Membrane',
    year: '2014',
    client: 'World Cup Organizing Committee',
    span: 'Full Underside Grandstand Ceiling',
    image: 'assets/images/projects/arena-corinthians.jpg',
    gallery: [
      'assets/images/projects/arena-corinthians.jpg',
      'assets/images/projects/rio-tinto-stadium.jpg',
      'assets/images/solutions/sports.jpg',
      'assets/images/projects/abu-dhabi-shooting-club.jpg'
    ],
    description: 'Smooth membrane ceiling for FIFA World Cup opening match stadium. Fast-track installation from the underside of the massive cantilevered roof steelwork, delivering clean aesthetics, integrated lighting concealment, and stadium acoustics.'
  },
  'sol-architectural': {
    title: 'Architectural Tensile & ETFE Structures',
    category: 'architectural',
    categoryLabel: 'Product & System Solution',
    location: 'Middle East & Global Installations',
    area: 'Custom Typologies up to 50,000 m²',
    material: 'PTFE Fiberglass & Pneumatic Multi-Layer ETFE',
    year: 'Continuous',
    client: 'Commercial & Institutional Developers',
    span: 'Clear Spans exceeding 60m',
    image: 'assets/images/solutions/architectural.png',
    gallery: [
      'assets/images/solutions/architectural.png',
      'assets/images/projects/al-jamea-etfe.png',
      'assets/images/projects/al-janah-pavilion.png',
      'assets/images/solutions/commercial.jpg'
    ],
    description: 'Iconic translucent single skin and cushion ETFE daylighting systems, sculptural PTFE envelopes, and bespoke building atriums that elevate architectural vision while providing over 80% solar heat deflection in desert environments.'
  },
  'sol-sports': {
    title: 'Sports & Recreation Stadia Canopies',
    category: 'sports',
    categoryLabel: 'Product & System Solution',
    location: 'Regional Stadiums & Arenas',
    area: 'Grandstands & Arenas up to 30,000 m²',
    material: 'Heavy-Duty High-Tensile PTFE & PVC/PVDF',
    year: 'Continuous',
    client: 'Sports Authorities & Municipalities',
    span: 'Cantilevered Grandstand Bowstring Trusses',
    image: 'assets/images/solutions/sports.jpg',
    gallery: [
      'assets/images/solutions/sports.jpg',
      'assets/images/projects/abu-dhabi-shooting-club.jpg',
      'assets/images/projects/arena-corinthians.jpg',
      'assets/images/projects/rio-tinto-stadium.jpg'
    ],
    description: 'Column-free sports court canopies, grandstand stadium roofs, Olympic aquatics shelters, and school sports complexes engineered for maximum thermal protection, seismic resistance, and acoustic performance.'
  },
  'sol-commercial': {
    title: 'Commercial & Retail Shading Envelopes',
    category: 'architectural',
    categoryLabel: 'Product & System Solution',
    location: 'UAE & GCC Shopping Destinations',
    area: 'Retail Plazas up to 25,000 m²',
    material: 'Precontraint High-Performance Membranes',
    year: 'Continuous',
    client: 'Retail Developers & Malls',
    span: 'Modular High-Frequency Seamed Umbrellas',
    image: 'assets/images/solutions/commercial.jpg',
    gallery: [
      'assets/images/solutions/commercial.jpg',
      'assets/images/projects/dubai-outlet-mall.jpg',
      'assets/images/projects/fruit-vegetable-market.jpg',
      'assets/images/solutions/architectural.png'
    ],
    description: 'Desert-proof shopping center roofs, open-air retail canopies, hotel terraces, and civic bazaar canopies providing soft ambient daylight, 100% UV blockout, and cool microclimates for shoppers.'
  },
  'sol-transport': {
    title: 'Transport & Infrastructure Transit Hubs',
    category: 'infrastructure',
    categoryLabel: 'Product & System Solution',
    location: 'Airports, Marine & Commuter Hubs',
    area: 'Concourses & Terminals',
    material: 'High-Tensile Woven PTFE & ETFE Domes',
    year: 'Continuous',
    client: 'Roads & Transport Authorities (RTA)',
    span: 'Continuous Arch-Supported Wave Networks',
    image: 'assets/images/solutions/transport.jpg',
    gallery: [
      'assets/images/solutions/transport.jpg',
      'assets/images/projects/denver-union-station.jpg',
      'assets/images/projects/al-janah-pavilion.png'
    ],
    description: 'Marine floating transit hubs, airport concourse canopies, rail terminal tension roofs, and pedestrian bridge shades engineered with heavy-duty aerodynamic durability and marine-grade corrosion resistance.'
  },
  'sol-industrial': {
    title: 'Industrial & Bulk Logistics Enclosures',
    category: 'infrastructure',
    categoryLabel: 'Product & System Solution',
    location: 'Ports, Mines & Industrial Freezones',
    area: 'Bulk Warehousing up to 60,000 m²',
    material: 'Heavy-Duty UV Stabilized Structural PVC/PVDF',
    year: 'Continuous',
    client: 'Industrial & Logistics Operators',
    span: 'Clear-Span Steel Truss & Fabric Cladding',
    image: 'assets/images/solutions/industrial.jpg',
    gallery: [
      'assets/images/solutions/industrial.jpg',
      'assets/images/solutions/air-supported-asati.jpg',
      'assets/images/solutions/commercial.jpg'
    ],
    description: 'Wide-span storage enclosures, bulk material protection, agricultural sunscreens, and rapidly deployable logistics shelters engineered for harsh Middle Eastern weather and dusty industrial conditions.'
  },
  'sol-lifecycle': {
    title: 'Lifecycle Maintenance, Inspection & AMC',
    category: 'maintenance',
    categoryLabel: 'Product & System Solution',
    location: 'UAE, GCC & North Africa Facilities',
    area: 'Regional Asset Fleet (>150,000 m²)',
    material: 'All High-Tensile Membranes & Cable Networks',
    year: 'Continuous',
    client: 'Facility Management & Government Authorities',
    span: 'Structural Health Audits & In-Situ Repair',
    image: 'assets/images/solutions/lifecycle-amc.jpg',
    gallery: [
      'assets/images/solutions/lifecycle-amc.jpg',
      'assets/images/solutions/architectural.png',
      'assets/images/solutions/commercial.jpg'
    ],
    description: 'Comprehensive condition audits, laser and biaxial membrane tension calibration, ultrasonic weld verification, specialized cleaning, seam repair, and certified annual maintenance contracts ensuring maximum asset lifespan.'
  }
};

// Augment existing primary projects with galleries if not set
if (projectData['al-jamea']) {
  projectData['al-jamea'].gallery = [
    'assets/images/projects/al-jamea-etfe.png',
    'assets/images/projects/al-jamea-interior.png',
    'assets/images/solutions/architectural.png'
  ];
}
if (projectData['al-janah']) {
  projectData['al-janah'].gallery = [
    'assets/images/projects/al-janah-pavilion.png',
    'assets/images/solutions/architectural.png',
    'assets/images/projects/al-ain-kindergartens.jpg'
  ];
}
if (projectData['ethiopia']) {
  projectData['ethiopia'].gallery = [
    'assets/images/projects/ethiopia-unity-park.jpg',
    'assets/images/solutions/architectural.png',
    'assets/images/projects/fruit-vegetable-market.jpg'
  ];
}
if (projectData['abu-dhabi-shooting']) {
  projectData['abu-dhabi-shooting'].gallery = [
    'assets/images/projects/abu-dhabi-shooting-club.jpg',
    'assets/images/projects/dubai-outlet-mall.jpg',
    'assets/images/solutions/sports.jpg'
  ];
}
if (projectData['dubai-outlet-mall']) {
  projectData['dubai-outlet-mall'].gallery = [
    'assets/images/projects/dubai-outlet-mall.jpg',
    'assets/images/solutions/commercial.jpg',
    'assets/images/projects/fruit-vegetable-market.jpg'
  ];
}
if (projectData['westlake-girls']) {
  projectData['westlake-girls'].gallery = [
    'assets/images/projects/westlake-girls-sports.jpg',
    'assets/images/solutions/sports.jpg',
    'assets/images/projects/rio-tinto-stadium.jpg'
  ];
}
if (projectData['asati-dome']) {
  projectData['asati-dome'].gallery = [
    'assets/images/solutions/air-supported-asati.jpg',
    'assets/images/projects/air-supported-asati.jpg',
    'assets/images/solutions/sports.jpg'
  ];
}
if (projectData['vmf-market']) {
  projectData['vmf-market'].gallery = [
    'assets/images/projects/fruit-vegetable-market.jpg',
    'assets/images/solutions/commercial.jpg',
    'assets/images/projects/dubai-outlet-mall.jpg'
  ];
}
if (projectData['rio-tinto']) {
  projectData['rio-tinto'].gallery = [
    'assets/images/projects/rio-tinto-stadium.jpg',
    'assets/images/projects/ppl-park-stadium.jpg',
    'assets/images/solutions/sports.jpg'
  ];
}
if (projectData['denver-station']) {
  projectData['denver-station'].gallery = [
    'assets/images/projects/denver-union-station.jpg',
    'assets/images/solutions/transport.jpg',
    'assets/images/projects/al-janah-pavilion.png'
  ];
}

function initProjectModals() {
  const modalOverlay = document.getElementById('projectModal');
  if (!modalOverlay) return;

  const closeBtn = modalOverlay.querySelector('.modal-close-btn');
  const prevBtn = document.getElementById('modalPrevBtn');
  const nextBtn = document.getElementById('modalNextBtn');
  const counterEl = document.getElementById('modalCounter');
  const modalImg = document.getElementById('modalImage');
  const modalBackdrop = document.getElementById('modalImageBackdrop');
  const modalExpand = document.getElementById('modalImageExpand');
  const projectCards = document.querySelectorAll('.project-card, .project-showcase-card');
  const projectIds = Object.keys(projectData);
  let currentIndex = 0;

  const isSmallScreen = () => {
    return window.innerWidth <= 992 || (window.matchMedia && window.matchMedia('(max-width: 992px)').matches);
  };

  const openModal = (id, targetUrl) => {
    // If on small screens (mobile / tablet <= 992px), never open modal and never freeze scroll
    if (isSmallScreen()) {
      const dest = targetUrl || (id ? `/projects/${id}` : null);
      if (dest) {
        window.location.href = dest;
      }
      return;
    }

    const data = projectData[id];
    if (!data) {
      if (targetUrl) {
        window.location.href = targetUrl;
      }
      return;
    }

    currentIndex = projectIds.indexOf(id);
    if (currentIndex === -1) currentIndex = 0;

    // 1. Immediately display the product image with 100% full uncropped clarity & ambient glow
    const imgPath = data.image ? (data.image.startsWith('/') || data.image.startsWith('http') ? data.image : '/' + data.image) : '';
    if (modalImg) {
      modalImg.src = imgPath;
      modalImg.alt = data.title;
      modalImg.style.opacity = '1';
    }

    if (modalBackdrop) {
      modalBackdrop.src = imgPath;
    }

    if (modalExpand) {
      modalExpand.href = imgPath;
    }

    // 2. Render interactive photo gallery thumbnails strip
    const thumbsStrip = document.getElementById('modalThumbsStrip');
    if (thumbsStrip) {
      const galleryList = (data.gallery && data.gallery.length) ? data.gallery : [imgPath];
      thumbsStrip.innerHTML = galleryList.map((gImg, idx) => {
        const fullGImg = gImg.startsWith('/') || gImg.startsWith('http') ? gImg : '/' + gImg;
        return `
        <button class="modal-thumb-item ${idx === 0 ? 'active' : ''}" data-img="${fullGImg}" type="button" aria-label="View photo angle ${idx + 1}">
          <img src="${fullGImg}" alt="${data.title} photo ${idx + 1}">
        </button>
      `;
      }).join('');

      thumbsStrip.querySelectorAll('.modal-thumb-item').forEach((btn, bIdx) => {
        btn.addEventListener('click', (e) => {
          e.stopPropagation();
          thumbsStrip.querySelectorAll('.modal-thumb-item').forEach(b => b.classList.remove('active'));
          btn.classList.add('active');
          const targetSrc = btn.getAttribute('data-img');
          if (targetSrc && modalImg) {
            modalImg.src = targetSrc;
            modalImg.style.opacity = '1';
            if (modalBackdrop) {
              modalBackdrop.src = targetSrc;
            }
          }
        });
      });
    }

    // 3. Populate textual and technical spec details
    const titleEl = document.getElementById('modalTitle');
    if (titleEl) titleEl.textContent = data.title;

    const catEl = document.getElementById('modalCategory');
    if (catEl) catEl.textContent = data.categoryLabel || data.category;

    const yrEl = document.getElementById('modalYear');
    if (yrEl) yrEl.textContent = 'Handover: ' + (data.year || '2022');

    const heroLoc = document.getElementById('modalHeroLocation');
    if (heroLoc) heroLoc.textContent = '📍 ' + data.location;

    const heroClient = document.getElementById('modalHeroClient');
    if (heroClient) heroClient.textContent = '🏢 ' + (data.client || 'Turnkey Client');

    const areaEl = document.getElementById('modalArea');
    if (areaEl) areaEl.textContent = data.area;

    const matEl = document.getElementById('modalMaterial');
    if (matEl) matEl.textContent = data.material;

    const locEl = document.getElementById('modalLocation');
    if (locEl) locEl.textContent = data.location;

    const spanEl = document.getElementById('modalSpan');
    if (spanEl) spanEl.textContent = data.span;

    const yrSpecEl = document.getElementById('modalYearSpec');
    if (yrSpecEl) yrSpecEl.textContent = data.year || '2022';

    const clientSpecEl = document.getElementById('modalClientSpec');
    if (clientSpecEl) clientSpecEl.textContent = data.client || 'Authority Client';

    const descEl = document.getElementById('modalDesc');
    if (descEl) descEl.textContent = data.description;

    if (counterEl) {
      counterEl.textContent = `${currentIndex + 1} / ${projectIds.length}`;
    }

    const inquireBtn = document.getElementById('modalInquireBtn');
    if (inquireBtn) {
      inquireBtn.href = `/contact?project=${encodeURIComponent(data.title)}`;
    }

    modalOverlay.classList.add('open');
    document.body.style.overflow = 'hidden';
  };

  const closeModal = () => {
    modalOverlay.classList.remove('open');
    document.body.style.overflow = '';
  };

  const showNext = () => {
    currentIndex = (currentIndex + 1) % projectIds.length;
    openModal(projectIds[currentIndex]);
  };

  const showPrev = () => {
    currentIndex = (currentIndex - 1 + projectIds.length) % projectIds.length;
    openModal(projectIds[currentIndex]);
  };

  projectCards.forEach(card => {
    card.addEventListener('click', (e) => {
      const id = card.getAttribute('data-id');
      const targetUrl = card.getAttribute('data-url') || (id ? `/projects/${id}` : null);

      if (!id && !targetUrl) return;

      // On small screens (<= 992px), navigate directly to the separate project details page
      if (isSmallScreen()) {
        const dest = targetUrl || (id ? `/projects/${id}` : null);
        if (dest) {
          window.location.href = dest;
        }
        return;
      }

      // If user clicked a direct link or interactive anchor on desktop, allow normal navigation
      if (e.target.closest('a, button, input, select, textarea')) return;

      // On desktop screens (> 992px), open the pop-up modal if data exists
      if (id && projectData[id]) {
        openModal(id, targetUrl);
      } else if (targetUrl) {
        window.location.href = targetUrl;
      }
    });
  });

  const closeButtons = modalOverlay.querySelectorAll('.modal-close-btn, #modalCloseBtn');
  closeButtons.forEach(btn => btn.addEventListener('click', closeModal));

  if (nextBtn) {
    nextBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      showNext();
    });
  }

  if (prevBtn) {
    prevBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      showPrev();
    });
  }

  modalOverlay.addEventListener('click', (e) => {
    if (e.target === modalOverlay) {
      closeModal();
    }
  });

  window.addEventListener('keydown', (e) => {
    if (!modalOverlay.classList.contains('open')) return;
    if (e.key === 'Escape') {
      closeModal();
    } else if (e.key === 'ArrowRight') {
      showNext();
    } else if (e.key === 'ArrowLeft') {
      showPrev();
    }
  });
}

/* ==========================================================================
   6. CONVERSATIONAL STEPPED SCOPE ESTIMATOR
   ========================================================================== */
function initConversationalEstimator() {
  const estimatorCard = document.querySelector('.estimator-stepped-card');
  if (!estimatorCard) return;

  const state = {
    currentStep: 1,
    typology: 'hospitality',
    typologyName: 'Hospitality & Outdoor Dining',
    area: 2500,
    environment: 'coastal',
    region: 'UAE',
    material: 'ptfe',
    materialPriority: 'permanent'
  };

  const panes = document.querySelectorAll('.est-pane');
  const stepPills = document.querySelectorAll('.step-pill');
  const progressBar = document.getElementById('estProgressBar');
  const nextBtns = document.querySelectorAll('.est-btn-next');
  const backBtns = document.querySelectorAll('.est-btn-back');
  const restartBtn = document.getElementById('btnRestartEstimator');
  const typeCards = document.querySelectorAll('.est-type-card');
  const presetChips = document.querySelectorAll('.est-preset-chip');
  const areaSlider = document.getElementById('convAreaSlider');
  const areaDisplay = document.getElementById('convAreaDisplay');
  const envCards = document.querySelectorAll('.est-env-card');
  const regionSelect = document.getElementById('convRegion');
  const priorityCards = document.querySelectorAll('.est-priority-card');
  const submitBriefBtn = document.getElementById('btnSubmitBriefToContact');

  const goToStep = (step) => {
    state.currentStep = step;

    // Update panes
    panes.forEach(pane => pane.classList.remove('active'));
    const targetPane = document.getElementById(`estPane${step}`);
    if (targetPane) targetPane.classList.add('active');

    // Update stepper pills
    stepPills.forEach(pill => {
      const pillStep = parseInt(pill.getAttribute('data-step-target'), 10);
      pill.classList.remove('active', 'completed');
      if (pillStep === step) {
        pill.classList.add('active');
      } else if (pillStep < step) {
        pill.classList.add('completed');
      }
    });

    // Update progress bar
    if (progressBar) {
      progressBar.style.width = `${(step / 4) * 100}%`;
    }

    // If step 4, calculate output
    if (step === 4) {
      calculateBrief();
    }

    // Scroll to top of estimator smoothly if needed
    estimatorCard.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  };

  // Step 1: Typology selection
  typeCards.forEach(card => {
    card.addEventListener('click', () => {
      typeCards.forEach(c => c.classList.remove('active'));
      card.classList.add('active');

      state.typology = card.getAttribute('data-type');
      state.typologyName = card.getAttribute('data-type-name') || 'Architectural Structure';
      const defaultArea = parseInt(card.getAttribute('data-default-area'), 10);
      const defaultMat = card.getAttribute('data-default-mat');

      if (!isNaN(defaultArea)) {
        state.area = defaultArea;
        if (areaSlider) areaSlider.value = defaultArea;
        if (areaDisplay) areaDisplay.textContent = `${defaultArea.toLocaleString()} m²`;

        // Match preset chip if possible
        presetChips.forEach(chip => {
          const chipArea = parseInt(chip.getAttribute('data-area'), 10);
          chip.classList.toggle('active', chipArea === defaultArea);
        });
      }

      if (defaultMat) {
        state.material = defaultMat;
        priorityCards.forEach(pCard => {
          pCard.classList.toggle('active', pCard.getAttribute('data-mat') === defaultMat);
        });
      }
    });
  });

  // Step 2: Scale & Context
  presetChips.forEach(chip => {
    chip.addEventListener('click', () => {
      presetChips.forEach(c => c.classList.remove('active'));
      chip.classList.add('active');
      const area = parseInt(chip.getAttribute('data-area'), 10);
      state.area = area;
      if (areaSlider) areaSlider.value = area;
      if (areaDisplay) areaDisplay.textContent = `${area.toLocaleString()} m²`;
    });
  });

  if (areaSlider) {
    areaSlider.addEventListener('input', (e) => {
      const val = parseInt(e.target.value, 10);
      state.area = val;
      if (areaDisplay) areaDisplay.textContent = `${val.toLocaleString()} m²`;

      presetChips.forEach(chip => {
        const chipArea = parseInt(chip.getAttribute('data-area'), 10);
        chip.classList.toggle('active', chipArea === val);
      });
    });
  }

  envCards.forEach(card => {
    card.addEventListener('click', () => {
      envCards.forEach(c => c.classList.remove('active'));
      card.classList.add('active');
      const input = card.querySelector('input[type="radio"]');
      if (input) {
        input.checked = true;
        state.environment = input.value;
      }
    });
  });

  if (regionSelect) {
    regionSelect.addEventListener('change', (e) => {
      state.region = e.target.value;
    });
  }

  // Step 3: Priority selection
  priorityCards.forEach(card => {
    card.addEventListener('click', () => {
      priorityCards.forEach(c => c.classList.remove('active'));
      card.classList.add('active');
      state.material = card.getAttribute('data-mat') || 'ptfe';
      state.materialPriority = card.getAttribute('data-priority') || 'permanent';
    });
  });

  // Step Navigation Next / Back
  nextBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      const nextStep = parseInt(btn.getAttribute('data-next'), 10);
      if (!isNaN(nextStep)) {
        goToStep(nextStep);
      }
    });
  });

  backBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      const backStep = parseInt(btn.getAttribute('data-back'), 10);
      if (!isNaN(backStep)) {
        goToStep(backStep);
      }
    });
  });

  stepPills.forEach(pill => {
    pill.addEventListener('click', () => {
      const targetStep = parseInt(pill.getAttribute('data-step-target'), 10);
      if (!isNaN(targetStep)) {
        goToStep(targetStep);
      }
    });
  });

  if (restartBtn) {
    restartBtn.addEventListener('click', () => {
      goToStep(1);
    });
  }

  // Step 4: Calculate Engineering Output
  const calculateBrief = () => {
    const area = state.area;
    const mat = state.material;
    const env = state.environment;

    // Multipliers
    let weightPerM2 = 1.45; // kg/m²
    let steelDensity = 26; // kg steel per m²
    let matTitle = 'PTFE Fiberglass';
    let lifespanText = '35+ Year Design Life';
    let heatText = '85% Deflection';
    let timelineWeeks = Math.max(8, Math.round(Math.sqrt(area) * 0.35));

    if (mat === 'etfe') {
      weightPerM2 = 0.55;
      steelDensity = 18;
      matTitle = 'ETFE Foil Cushions';
      lifespanText = '25 - 30 Year Life';
      heatText = '75% Deflection';
      timelineWeeks = Math.max(10, Math.round(Math.sqrt(area) * 0.38));
    } else if (mat === 'pvc') {
      weightPerM2 = 1.15;
      steelDensity = 22;
      matTitle = 'PVC / PVDF Composite';
      lifespanText = '15 - 20+ Year Life';
      heatText = '78% Deflection';
      timelineWeeks = Math.max(6, Math.round(Math.sqrt(area) * 0.30));
    }

    const fabricTons = ((area * weightPerM2) / 1000).toFixed(1);
    const steelTons = Math.round((area * steelDensity) / 1000);
    const codeNum = Math.floor(1000 + Math.random() * 9000);

    // Populate brief outputs
    const briefCode = document.getElementById('briefCode');
    const briefTitle = document.getElementById('briefTitle');
    const outArea = document.getElementById('outArea');
    const outTypology = document.getElementById('outTypology');
    const outMat = document.getElementById('outMat');
    const outLifespan = document.getElementById('outLifespan');
    const outFabWeight = document.getElementById('outFabWeight');
    const outSteelWeight = document.getElementById('outSteelWeight');
    const outHeatDeflect = document.getElementById('outHeatDeflect');
    const outTimeline = document.getElementById('outTimeline');
    const outRiggingDesc = document.getElementById('outRiggingDesc');
    const outCodesDesc = document.getElementById('outCodesDesc');

    if (briefCode) briefCode.textContent = `2026-${codeNum}`;
    if (briefTitle) briefTitle.textContent = `${state.typologyName} Scope Brief`;
    if (outArea) outArea.innerHTML = `${area.toLocaleString()} <span class="unit">m²</span>`;
    if (outTypology) outTypology.textContent = state.typologyName;
    if (outMat) outMat.innerHTML = `${matTitle}`;
    if (outLifespan) outLifespan.textContent = lifespanText;
    if (outFabWeight) outFabWeight.innerHTML = `${fabricTons} <span class="unit">Tons</span>`;
    if (outSteelWeight) outSteelWeight.innerHTML = `~${steelTons} <span class="unit">Tons</span>`;
    if (outHeatDeflect) outHeatDeflect.innerHTML = `${heatText} <span class="unit">Thermal Drop</span>`;
    if (outTimeline) outTimeline.innerHTML = `${timelineWeeks} - ${timelineWeeks + 4} <span class="unit">Weeks</span>`;

    // Environment-specific rigging description
    if (outRiggingDesc) {
      if (env === 'coastal') {
        outRiggingDesc.textContent = 'Specified with electro-polished AISI 316 and 2205 Duplex marine stainless rigging, Teflon isolation gaskets, and ASTM B117 salt-fog rated cables for marine environments.';
      } else if (env === 'desert') {
        outRiggingDesc.textContent = 'High-grade galvanized S355 structural steel with 3-coat C5M epoxy paint system, UV-resistant PVDF lacquer, and anti-abrasion sand seals.';
      } else {
        outRiggingDesc.textContent = 'Architectural grade swaged stainless rigging, concealed rainwater drainage channels, and acoustic textile integration for urban spaces.';
      }
    }

    if (outCodesDesc) {
      const reg = state.region;
      if (reg === 'UAE') {
        outCodesDesc.textContent = 'Compliant with UAE Civil Defense Fire Code, ASCE 7-16 wind design loads (up to 160 km/h), and Dubai Municipality / Abu Dhabi DMT regulations.';
      } else if (reg === 'KSA') {
        outCodesDesc.textContent = 'Compliant with Saudi Building Code (SBC 301 / 801), MOMRA regulations, and Red Sea / NEOM environmental sustainability guidelines.';
      } else {
        outCodesDesc.textContent = 'Engineered under ASCE 7-16, DIN 4102 / ASTM E108 non-combustibility standards, and localized municipal building codes.';
      }
    }
  };

  // Submit Brief to Contact Form
  if (submitBriefBtn) {
    submitBriefBtn.addEventListener('click', () => {
      const area = state.area;
      const type = state.typologyName;
      const mat = state.material.toUpperCase();
      const env = state.environment.toUpperCase();
      const regText = regionSelect ? regionSelect.options[regionSelect.selectedIndex].text : state.region;

      const messageBox = document.getElementById('contactMessage');
      const subjectSelect = document.getElementById('contactSubject');
      if (subjectSelect) subjectSelect.value = 'RFP Proposal Request';

      if (messageBox) {
        messageBox.value = `Hello Structurflex Middle East Engineering Team,\n\nI have generated an Engineering Specification Brief via the Intelligent Scope Estimator:\n- Typology: ${type}\n- Planned Footprint: ${area.toLocaleString()} m²\n- Specified Material: ${mat}\n- Environmental Context: ${env}\n- Regional Code: ${regText}\n\nPlease contact me to review the preliminary engineering calculations, structural steel sizing, and formal consultation schedule.`;
      }

      const contactSection = document.getElementById('contact');
      if (contactSection) {
        contactSection.scrollIntoView({ behavior: 'smooth' });
        if (messageBox) messageBox.focus();
      }
    });
  }
}

/* ==========================================================================
   7. CONTACT FORM HANDLER & FEEDBACK
   ========================================================================== */
function initContactForm() {
  const form = document.getElementById('inquiryForm');
  const alertBox = document.getElementById('formSuccessAlert');

  if (!form) return;

  form.addEventListener('submit', (e) => {
    e.preventDefault();

    const submitBtn = form.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;

    // Loading state
    submitBtn.disabled = true;
    submitBtn.innerHTML = `<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="spin-icon"><path d="M21 12a9 9 0 1 1-6.219-8.56"></path></svg> Transmitting Specification...`;

    // Simulated network transmission
    setTimeout(() => {
      submitBtn.disabled = false;
      submitBtn.innerHTML = originalText;
      form.reset();

      if (alertBox) {
        alertBox.style.display = 'block';
        alertBox.scrollIntoView({ behavior: 'smooth', block: 'nearest' });

        setTimeout(() => {
          alertBox.style.display = 'none';
        }, 7000);
      }
    }, 1000);
  });
}

/* ==========================================================================
   8. DYNAMIC ESTIMATOR MODAL ENGINE & CSRF SUBMISSION
   ========================================================================== */
function initDynamicEstimatorModal() {
  const modal = document.getElementById('estimatorModal');
  const closeBtn = document.getElementById('estimatorCloseBtn');
  const slider = document.getElementById('estAreaSlider');
  const areaDisplay = document.getElementById('estAreaDisplay');
  const membraneSelect = document.getElementById('estMembrane');
  const weightDisplay = document.getElementById('estWeight');
  const lightDisplay = document.getElementById('estLight');
  const lifespanDisplay = document.getElementById('estLifespan');
  const scheduleDisplay = document.getElementById('estSchedule');
  const form = document.getElementById('scopeEstimatorForm');
  const feedback = document.getElementById('estimatorFeedback');

  if (!modal) return;

  const updateCalculations = () => {
    if (!slider || !membraneSelect) return;
    const area = parseFloat(slider.value) || 2500;
    if (areaDisplay) areaDisplay.textContent = area.toLocaleString();

    const selectedOpt = membraneSelect.options[membraneSelect.selectedIndex];
    const rate = parseFloat(selectedOpt.dataset.rate) || 1.3;
    const light = selectedOpt.dataset.light || '12% – 20%';
    const life = selectedOpt.dataset.life || '35+ Years';

    const tonnage = ((area * 1.45 * rate) / 1000).toFixed(1);
    if (weightDisplay) weightDisplay.textContent = tonnage + ' Tons';
    if (lightDisplay) lightDisplay.textContent = light;
    if (lifespanDisplay) lifespanDisplay.textContent = life;

    let schedule = '10 – 14 Wks';
    if (area > 10000) schedule = '20 – 26 Wks';
    else if (area > 4000) schedule = '14 – 18 Wks';
    else if (area < 1000) schedule = '6 – 10 Wks';
    if (scheduleDisplay) scheduleDisplay.textContent = schedule;
  };

  if (slider) slider.addEventListener('input', updateCalculations);
  if (membraneSelect) membraneSelect.addEventListener('change', updateCalculations);

  if (closeBtn) {
    closeBtn.addEventListener('click', () => {
      modal.style.display = 'none';
    });
  }

  modal.addEventListener('click', (e) => {
    if (e.target === modal) modal.style.display = 'none';
  });

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && modal.style.display === 'flex') {
      modal.style.display = 'none';
    }
  });

  if (form) {
    form.addEventListener('submit', function (e) {
      e.preventDefault();
      const submitBtn = document.getElementById('btnSubmitEstimator');
      const originalText = submitBtn ? submitBtn.innerHTML : '';
      if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.innerHTML = 'Transmitting RFP...';
      }
      if (feedback) {
        feedback.textContent = 'Calculating and submitting scope...';
        feedback.style.color = '#38bdf8';
      }

      const csrfMeta = document.querySelector('meta[name="csrf-token"]');
      const csrfToken = csrfMeta ? csrfMeta.getAttribute('content') : '';

      const formData = new FormData(form);
      const dataObj = Object.fromEntries(formData.entries());

      // Append calculated values
      const area = parseFloat(slider.value) || 2500;
      const selectedOpt = membraneSelect.options[membraneSelect.selectedIndex];
      const rate = parseFloat(selectedOpt.dataset.rate) || 1.3;
      dataObj.calculated_tonnage = ((area * 1.45 * rate) / 1000).toFixed(2);
      dataObj.estimated_weeks = scheduleDisplay ? scheduleDisplay.textContent : '12 – 16 Wks';

      fetch('/api/estimator/submit', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': csrfToken,
        },
        body: JSON.stringify(dataObj)
      })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          if (feedback) {
            feedback.innerHTML = `<span style="color: #10b981;">✓ ${data.message} Ref: <strong>${data.reference_id}</strong></span>`;
          }
          if (submitBtn) {
            submitBtn.innerHTML = '✓ Tender Inquiry Dispatched';
            submitBtn.style.background = '#10b981';
          }
          setTimeout(() => {
            modal.style.display = 'none';
            if (submitBtn) {
              submitBtn.disabled = false;
              submitBtn.innerHTML = originalText;
              submitBtn.style.background = '';
            }
            if (feedback) feedback.innerHTML = '';
            form.reset();
            updateCalculations();
          }, 3500);
        } else {
          if (feedback) {
            feedback.innerHTML = `<span style="color: #ef4444;">Please check all required fields.</span>`;
          }
          if (submitBtn) {
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
          }
        }
      })
      .catch(err => {
        console.error('Estimator error:', err);
        if (feedback) {
          feedback.innerHTML = `<span style="color: #ef4444;">Submission error. Please email rfp@structurflex.ae</span>`;
        }
        if (submitBtn) {
          submitBtn.disabled = false;
          submitBtn.innerHTML = originalText;
        }
      });
    });
  }

  updateCalculations();
}

document.addEventListener('DOMContentLoaded', () => {
  initDynamicEstimatorModal();
});
