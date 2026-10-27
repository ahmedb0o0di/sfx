@extends('layouts.app')

@section('title', \App\Models\Setting::get('site_name') . ' | ' . \App\Models\Setting::get('site_tagline'))
@section('description', \App\Models\Setting::get('hero_subtitle'))

@section('content')
<!-- ==========================================================================
     SECTION 2: HERO SECTION (DYNAMIC ARCHITECTURAL BANNER)
     ========================================================================== -->
<section class="hero" id="home" style="position: relative; overflow: hidden; background: #081C38;">
  <div class="hero-background" style="position: absolute; inset: 0; z-index: 1;">
    <img src="{{ asset('assets/images/hero.jpg') }}" alt="High-Resolution Architectural Tensile Structure at Twilight"
      class="hero-bg-img" fetchpriority="high" style="width: 100%; height: 100%; object-fit: cover;">
    <div class="hero-overlay"
      style="position: absolute; inset: 0; background: linear-gradient(135deg, rgba(8, 28, 56, 0.92) 0%, rgba(4, 16, 38, 0.78) 55%, rgba(8, 28, 56, 0.92) 100%);">
    </div>
  </div>

  <div class="container" style="position: relative; z-index: 2;">
    <div class="hero-blueprint-grid">
      <!-- Left Column (60%) -->
      <div class="hero-blueprint-left">
        <div class="hero-pill"
          style="display: inline-flex; align-items: center; gap: 0.6rem; background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.2); padding: 0.35rem 0.9rem; border-radius: 999px; margin-bottom: 1.5rem; backdrop-filter: blur(8px);">
          <span class="hero-pill-badge"
            style="background: #D99B26; color: #081C38; font-weight: 800; font-size: 0.7rem; padding: 0.15rem 0.5rem; border-radius: 999px; text-transform: uppercase;">85+ Years Heritage</span>
          <span class="hero-pill-text" style="color: #ffffff; font-size: 0.8rem; font-weight: 500;">Specialized Tensile &amp; Lightweight Contractor</span>
        </div>

        <h1 class="hero-blueprint-h1">
          Engineering Inspiring Spaces.<br>Delivering Lasting Performance.
        </h1>

        <p class="hero-blueprint-sub">
          Specialists in Tensile Membrane, Lightweight and Air-Supported Structures across the Middle East, Africa
          and beyond. Turnkey design development, non-linear engineering, cleanroom fabrication, and lifetime
          structural maintenance.
        </p>

        <div class="hero-blueprint-ctas">
          <a href="#solutions" class="btn btn-hero-solid">
            <span>Our Solutions</span>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
              <path d="M5 12h14M12 5l7 7-7 7" />
            </svg>
          </a>
          <a href="{{ route('projects.index') }}" class="btn btn-hero-white">
            <span>View Projects</span>
          </a>
        </div>
      </div>

      <!-- Right Column (40% - Floating ASATI Partnership Card) -->
      <div class="hero-blueprint-right">
        <div class="hero-asati-card">
          <div class="hero-asati-badge">Strategic Regional Alliance</div>
          <div class="hero-asati-logo-wrap">
            <img src="{{ asset('assets/images/asati-logo.svg') }}" alt="ASATI United Arab Emirates"
              style="height: 50px; width: auto; max-width: 100%;">
          </div>
          <h3>Delivering Air-Supported Structures Across MENA</h3>
          <p>
            In partnership with ASATI (Air Structures American Technologies, Inc.), delivering turnkey air-supported
            domes for sports arenas, industrial bulk warehousing, seasonal exhibitions, and rapid-deployment
            facilities.
          </p>
          <div class="hero-asati-specs">
            <div class="hero-asati-spec-item">
              <strong>150m+</strong>
              <span>Clear Span</span>
            </div>
            <div class="hero-asati-spec-item">
              <strong>HVAC</strong>
              <span>Climate Control</span>
            </div>
            <div class="hero-asati-spec-item">
              <strong>Rapid</strong>
              <span>Turnkey Erection</span>
            </div>
          </div>
          <a href="{{ route('services.index') }}#air-supported" class="hero-asati-link"
            onclick="const el = document.querySelector('#card-asati'); if (el) { el.scrollIntoView({behavior:'smooth'}); }">
            <span>Learn More About ASATI Air Domes</span>
            <span class="arrow">&rarr;</span>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ==========================================================================
     SECTION 3: TRUST METRICS & HERITAGE BAR (5-COLUMN MATRIX)
     ========================================================================== -->
<section class="trust-stats-bar" id="trust-metrics">
  <div class="container">
    <div class="trust-stats-grid">
      <div class="trust-stat-box">
        <div class="trust-stat-val" data-target="85" data-suffix="+">85+</div>
        <div class="trust-stat-label">Years of Heritage</div>
        <div class="trust-stat-sub">Originated in 1937</div>
      </div>

      <div class="trust-stat-box">
        <div class="trust-stat-val" data-target="9000" data-suffix="+">9,000+</div>
        <div class="trust-stat-label">Projects Delivered</div>
        <div class="trust-stat-sub">Proven Global Track Record</div>
      </div>

      <div class="trust-stat-box">
        <div class="trust-stat-val" data-target="30" data-suffix="+">30+</div>
        <div class="trust-stat-label">Countries Served</div>
        <div class="trust-stat-sub">Middle East, Africa &amp; Beyond</div>
      </div>

      <div class="trust-stat-box">
        <div class="trust-stat-val" style="font-size: 1.55rem; color: #0B5ED7;">End-to-End</div>
        <div class="trust-stat-label">Turnkey Solutions</div>
        <div class="trust-stat-sub">From Design to Lifecycle AMC</div>
      </div>

      <div class="trust-stat-box">
        <div class="trust-stat-val" style="font-size: 1.35rem; color: #008E38;">ISO Certified</div>
        <div class="trust-stat-label">Safety, Quality &amp; Eco</div>
        <div class="trust-stat-sub">ISO 9001 | 14001 | 45001</div>
      </div>
    </div>
  </div>
</section>

<!-- ==========================================================================
     SECTION 2: REALIZATION PROCESS TIMELINE
     ========================================================================== -->
<section class="section section-timeline" style="background-color: #041026; color: #fff; padding: 5rem 0;">
  <div class="container">
    <div class="section-header text-center" style="margin-bottom: 3.5rem;">
      <span class="section-tag" style="background: rgba(255, 255, 255, 0.08); color: #f3b90d; border: 1px solid rgba(255, 255, 255, 0.15);">Engineering Realization Process</span>
      <h2 style="color: #fff; font-size: 2.25rem; font-weight: 800; margin-top: 0.75rem;">From 3D Computational Model to Laser-Rigged Structure</h2>
      <p style="color: #cbd5e1; max-width: 650px; margin: 0 auto; font-size: 1rem; line-height: 1.6;">Our integrated EPC delivery model minimizes risk through non-linear FEA analysis, cleanroom CNC pattern welding, and millimeter-level pre-stressing.</p>
    </div>

    <div class="timeline-stages-grid" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem;">
      <div class="timeline-stage-card" style="background: #081C38; border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 12px; padding: 2rem; position: relative;">
        <span style="font-size: 2.5rem; font-weight: 800; color: #f3b90d; opacity: 0.35; position: absolute; top: 1rem; right: 1.5rem;">01</span>
        <h4 style="font-size: 1.2rem; font-weight: 800; color: #fff; margin-bottom: 0.5rem;">Form Finding &amp; Equilibrium</h4>
        <p style="font-size: 0.88rem; color: #94a3b8; line-height: 1.6;">3D non-linear dynamic relaxation algorithms determining optimal equilibrium shapes under minimal strain.</p>
      </div>

      <div class="timeline-stage-card" style="background: #081C38; border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 12px; padding: 2rem; position: relative;">
        <span style="font-size: 2.5rem; font-weight: 800; color: #f3b90d; opacity: 0.35; position: absolute; top: 1rem; right: 1.5rem;">02</span>
        <h4 style="font-size: 1.2rem; font-weight: 800; color: #fff; margin-bottom: 0.5rem;">Non-Linear FEA Simulation</h4>
        <p style="font-size: 0.88rem; color: #94a3b8; line-height: 1.6;">Computational wind tunnel simulation and aero-elastic deflection analysis calibrated to GCC meteorological codes.</p>
      </div>

      <div class="timeline-stage-card" style="background: #081C38; border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 12px; padding: 2rem; position: relative;">
        <span style="font-size: 2.5rem; font-weight: 800; color: #f3b90d; opacity: 0.35; position: absolute; top: 1rem; right: 1.5rem;">03</span>
        <h4 style="font-size: 1.2rem; font-weight: 800; color: #fff; margin-bottom: 0.5rem;">CNC Cutting &amp; HF Welding</h4>
        <p style="font-size: 0.88rem; color: #94a3b8; line-height: 1.6;">Automated vacuum table CNC pattern cutting and high-frequency thermal welding ensuring seamless gas-tight joints.</p>
      </div>

      <div class="timeline-stage-card" style="background: #081C38; border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 12px; padding: 2rem; position: relative;">
        <span style="font-size: 2.5rem; font-weight: 800; color: #f3b90d; opacity: 0.35; position: absolute; top: 1rem; right: 1.5rem;">04</span>
        <h4 style="font-size: 1.2rem; font-weight: 800; color: #fff; margin-bottom: 0.5rem;">Laser-Aligned Pre-Stressing</h4>
        <p style="font-size: 0.88rem; color: #94a3b8; line-height: 1.6;">Hydraulic tension jacking with laser survey verification to calibrate exact bi-axial pre-stress across boundary cables.</p>
      </div>
    </div>
  </div>
</section>

<!-- ==========================================================================
     SECTION 3: INTERACTIVE MATERIALS MATRIX
     ========================================================================== -->
<section class="section section-materials" style="background-color: #F8FAFC; padding: 5.5rem 0;">
  <div class="container">
    <div class="section-header text-center" style="margin-bottom: 3.5rem;">
      <span class="section-tag">Engineering Selection Matrix</span>
      <h2 style="font-size: 2.35rem; font-weight: 800; color: var(--navy-primary); margin-top: 0.75rem;">PTFE vs. ETFE vs. PVC Architectural Membranes</h2>
      <p style="color: var(--text-muted); max-width: 680px; margin: 0 auto; font-size: 1rem; line-height: 1.6;">
        Compare technical parameters to determine the ideal membrane solution for your structural spans, daylighting requirements, and lifecycle performance.
      </p>
    </div>

    <!-- Materials Cards Matrix -->
    <div class="materials-matrix-grid" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem; margin-bottom: 3rem;">
      @foreach($materials as $material)
      <div class="material-matrix-card" style="background: #ffffff; border-radius: 12px; border: 1px solid #e2e8f0; padding: 2rem; box-shadow: 0 10px 25px rgba(0,0,0,0.04); display: flex; flex-direction: column; justify-content: space-between;">
        <div>
          <div style="display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 1rem; border-bottom: 2px solid #f1f5f9; padding-bottom: 1rem;">
            <h3 style="font-size: 1.45rem; font-weight: 800; color: var(--navy-primary); margin: 0;">{{ $material->name }}</h3>
            <span style="background: #081C38; color: #f3b90d; font-size: 0.72rem; font-weight: 700; padding: 0.25rem 0.6rem; border-radius: 4px; text-transform: uppercase;">{{ $material->code }}</span>
          </div>

          <ul style="list-style: none; padding: 0; margin: 0; font-size: 0.88rem; display: flex; flex-direction: column; gap: 0.85rem;">
            <li style="display: flex; justify-content: space-between;"><strong style="color: #64748b;">Tensile Strength:</strong> <span style="font-weight: 600; color: var(--navy-primary);">{{ $material->tensile_strength }}</span></li>
            <li style="display: flex; justify-content: space-between;"><strong style="color: #64748b;">Light Transmission:</strong> <span style="font-weight: 600; color: #0284c7;">{{ $material->light_transmission }}</span></li>
            <li style="display: flex; justify-content: space-between;"><strong style="color: #64748b;">Solar Heat Gain:</strong> <span style="font-weight: 600; color: var(--navy-primary);">{{ $material->solar_heat_gain }}</span></li>
            <li style="display: flex; justify-content: space-between;"><strong style="color: #64748b;">Expected Lifespan:</strong> <span style="font-weight: 700; color: #059669;">{{ $material->expected_lifespan }}</span></li>
            <li style="display: flex; justify-content: space-between;"><strong style="color: #64748b;">Fire Rating:</strong> <span style="font-weight: 600; color: var(--navy-primary);">{{ $material->fire_rating }}</span></li>
            <li style="display: flex; justify-content: space-between;"><strong style="color: #64748b;">Self-Cleaning:</strong> <span style="font-weight: 600; color: var(--navy-primary);">{{ $material->self_cleaning }}</span></li>
          </ul>

          <div style="margin-top: 1.5rem; padding-top: 1.25rem; border-top: 1px solid #f1f5f9;">
            <span style="font-size: 0.75rem; font-weight: 700; text-transform: uppercase; color: #64748b; display: block; margin-bottom: 0.35rem;">Typical Applications</span>
            <p style="font-size: 0.84rem; color: #475569; line-height: 1.5; margin: 0;">{{ $material->typical_applications }}</p>
          </div>
        </div>

        <div style="margin-top: 2rem;">
          <button type="button" class="btn btn-request-consult" style="width: 100%; justify-content: center;" onclick="document.getElementById('estimatorModal').style.display='flex'">
            <span>Estimate {{ $material->code }} Structure</span>
          </button>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<!-- ==========================================================================
     SECTION 4: VERIFIED PROJECT PORTFOLIO
     ========================================================================== -->
<section class="section section-portfolio" id="projects" style="background-color: #ffffff; padding: 5.5rem 0;">
  <div class="container">
    <div class="section-header text-center" style="margin-bottom: 3rem;">
      <span class="section-tag">Verified Executed Projects</span>
      <h2 style="font-size: 2.35rem; font-weight: 800; color: var(--navy-primary); margin-top: 0.75rem;">Landmark Commissions in MENA &amp; Globally</h2>
      <p style="color: var(--text-muted); max-width: 650px; margin: 0 auto; font-size: 1rem; line-height: 1.6;">
        Explore verified structures engineered and installed by Structurflex Middle East across UAE, Eastern Africa, and international venues.
      </p>
    </div>

    <!-- Category Filter Bar -->
    <div class="portfolio-filter-bar" style="display: flex; gap: 0.75rem; justify-content: center; flex-wrap: wrap; margin-bottom: 3rem;">
      <button class="filter-btn active" data-filter="all">All Projects</button>
      @foreach($categories as $category)
        <button class="filter-btn" data-filter="{{ $category->filter_tag }}">{{ $category->name }}</button>
      @endforeach
    </div>

    <!-- Projects Grid -->
    <div class="projects-showcase-grid">
      @foreach($allProjects as $project)
      <article class="project-showcase-card" data-category="{{ $project->category ? $project->category->filter_tag : 'architectural' }}" data-id="{{ $project->slug }}" style="cursor: pointer;">
        <div class="project-showcase-img">
          <img src="{{ asset($project->thumbnail_image) }}" alt="{{ $project->title }}" loading="lazy">
          <span class="project-location-badge">{{ $project->location }}</span>
        </div>
        <div class="project-showcase-body">
          <span class="project-showcase-category">{{ $project->category ? $project->category->name : 'Architectural' }}</span>
          <h3 class="project-showcase-title">{{ $project->title }}</h3>
          <p style="font-size: 0.84rem; color: var(--text-muted); line-height: 1.5; margin-bottom: 1rem;">{{ $project->short_description }}</p>
          <div class="project-showcase-meta">
            <span>{{ $project->client_name ?? 'SFXMEC EPC' }}</span>
            <span>{{ $project->covered_area }}</span>
          </div>
        </div>
      </article>
      @endforeach
    </div>

    <div style="text-align: center; margin-top: 3.5rem;">
      <a href="{{ route('projects.index') }}" class="btn btn-hero-primary" style="display: inline-flex; padding: 1rem 2.5rem;">
        <span>View Complete 9,000+ Project Archive</span>
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7" /></svg>
      </a>
    </div>
  </div>
</section>

<!-- ==========================================================================
     SECTION 5: DYNAMIC SCOPE ESTIMATOR PROMO BANNER
     ========================================================================== -->
<section style="background: linear-gradient(135deg, #070B14 0%, #0F1D36 100%); padding: 5rem 0; color: #fff; position: relative; overflow: hidden;">
  <div class="container" style="position: relative; z-index: 2;">
    <div style="display: flex; align-items: center; justify-content: space-between; gap: 3rem; flex-wrap: wrap;">
      <div style="max-width: 650px;">
        <span style="font-size: 0.78rem; text-transform: uppercase; letter-spacing: 1.5px; color: #f3b90d; font-weight: 700;">Pre-Tender Technical Tool</span>
        <h2 style="font-size: 2.25rem; font-weight: 800; color: #fff; margin: 0.5rem 0 1rem;">Have a Project Footprint in Mind?</h2>
        <p style="color: #cbd5e1; font-size: 1.05rem; line-height: 1.6; margin: 0;">
          Use our interactive Scope &amp; Cost Estimator to model membrane tonnage, structural steel demands, and daylighting transmission for spans up to 25,000 m².
        </p>
      </div>
      <div>
        <button type="button" class="btn btn-request-consult" style="padding: 1.15rem 2.25rem; font-size: 1.05rem;" onclick="document.getElementById('estimatorModal').style.display='flex'">
          <span>Launch Scope Estimator</span>
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </button>
      </div>
    </div>
  </div>
</section>

<!-- ==========================================================================
     SECTION 6: SOLUTIONS & SYSTEMS
     ========================================================================== -->
<section class="section section-solutions" id="solutions" style="background-color: #F4F6F9; padding: 5.5rem 0;">
  <div class="container">
    <div class="section-header text-center" style="margin-bottom: 3.5rem;">
      <span class="section-tag">Specialized Systems</span>
      <h2 style="font-size: 2.35rem; font-weight: 800; color: var(--navy-primary); margin-top: 0.75rem;">Turnkey Architectural &amp; Air Dome Capabilities</h2>
      <p style="color: var(--text-muted); max-width: 650px; margin: 0 auto; font-size: 1rem; line-height: 1.6;">
        Comprehensive engineering, manufacturing, and erection across all primary tensioned envelope systems.
      </p>
    </div>

    <div class="solutions-grid" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem;">
      @foreach($services as $service)
      <article class="solution-card" style="background: #ffffff; border-radius: 12px; overflow: hidden; border: 1px solid #e2e8f0; box-shadow: 0 10px 25px rgba(0,0,0,0.04); display: flex; flex-direction: column; justify-content: space-between;">
        <div>
          <div style="height: 220px; overflow: hidden;">
            <img src="{{ asset($service->hero_image) }}" alt="{{ $service->title }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s ease;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
          </div>
          <div style="padding: 1.75rem;">
            <span style="font-size: 0.75rem; text-transform: uppercase; font-weight: 700; color: #0284c7; letter-spacing: 0.8px;">{{ $service->subtitle }}</span>
            <h3 style="font-size: 1.25rem; font-weight: 800; color: var(--navy-primary); margin: 0.4rem 0 0.75rem;">{{ $service->title }}</h3>
            <p style="font-size: 0.88rem; color: #64748b; line-height: 1.6; margin-bottom: 1rem;">{{ $service->summary }}</p>
          </div>
        </div>
        <div style="padding: 0 1.75rem 1.75rem;">
          <a href="{{ route('services.show', $service->slug) }}" class="btn btn-hero-white" style="width: 100%; justify-content: center; font-size: 0.88rem;">
            <span>Explore Technical Specs</span>
            <span>&rarr;</span>
          </a>
        </div>
      </article>
      @endforeach
    </div>
  </div>
</section>

<!-- ==========================================================================
     SECTION 7: TECHNICAL WHITEPAPERS & INSIGHTS
     ========================================================================== -->
<section class="section" style="background-color: #ffffff; padding: 5.5rem 0;">
  <div class="container">
    <div class="section-header text-center" style="margin-bottom: 3.5rem;">
      <span class="section-tag">Knowledge Hub</span>
      <h2 style="font-size: 2.35rem; font-weight: 800; color: var(--navy-primary); margin-top: 0.75rem;">Engineering Whitepapers &amp; Architectural Insights</h2>
      <p style="color: var(--text-muted); max-width: 650px; margin: 0 auto; font-size: 1rem; line-height: 1.6;">
        Technical publications from our computational modeling desk in Dubai.
      </p>
    </div>

    <div class="insights-grid" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem;">
      @foreach($latestPosts as $post)
      <article class="insight-card" style="background: #F8FAFC; border-radius: 12px; overflow: hidden; border: 1px solid #e2e8f0; display: flex; flex-direction: column; justify-content: space-between;">
        <div>
          <div style="height: 200px; overflow: hidden;">
            <img src="{{ asset($post->featured_image) }}" alt="{{ $post->title }}" style="width: 100%; height: 100%; object-fit: cover;">
          </div>
          <div style="padding: 1.75rem;">
            <div style="display: flex; justify-content: space-between; font-size: 0.75rem; color: #64748b; margin-bottom: 0.75rem;">
              <span style="font-weight: 700; color: #f3b90d;">{{ $post->category }}</span>
              <span>{{ $post->reading_time_minutes }} Min Read</span>
            </div>
            <h3 style="font-size: 1.15rem; font-weight: 800; color: var(--navy-primary); margin-bottom: 0.75rem; line-height: 1.4;">{{ $post->title }}</h3>
            <p style="font-size: 0.85rem; color: #64748b; line-height: 1.5; margin: 0;">{{ $post->excerpt }}</p>
          </div>
        </div>
        <div style="padding: 0 1.75rem 1.75rem;">
          <a href="{{ route('blog.show', $post->slug) }}" style="color: #0284c7; font-weight: 700; font-size: 0.88rem; text-decoration: none;">Read Publication &rarr;</a>
        </div>
      </article>
      @endforeach
    </div>
  </div>
</section>

<!-- ==========================================================================
     SECTION 8: DUAL-HUB CONSULTATION & RFP INQUIRY FORM
     ========================================================================== -->
<section class="section section-contact" id="contact" style="background-color: #F4F6F9; padding: 5.5rem 0;">
  <div class="container">
    <div class="section-header text-center" style="margin-bottom: 3.5rem;">
      <span class="section-tag">Direct Engineering Consultation</span>
      <h2 style="font-size: 2.35rem; font-weight: 800; color: var(--navy-primary); margin-top: 0.75rem;">Request an Architectural Scope Consultation</h2>
      <p style="color: var(--text-muted); max-width: 650px; margin: 0 auto; font-size: 1rem; line-height: 1.6;">
        Connect directly with our senior computational engineering practice in Dubai and Cairo for form-finding, feasibility reviews, and tender submissions.
      </p>
    </div>

    <div style="display: grid; grid-template-columns: 1.2fr 0.8fr; gap: 3rem; background: #ffffff; border-radius: 16px; border: 1px solid #e2e8f0; padding: 3rem; box-shadow: 0 10px 30px rgba(0,0,0,0.05);" class="contact-main-grid">
      <!-- Left: Dynamic Form -->
      <div>
        <h3 style="font-size: 1.35rem; font-weight: 800; color: var(--navy-primary); margin-bottom: 1.5rem;">Project RFP &amp; Feasibility Inquiry</h3>
        <form action="{{ route('contact.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.25rem;">
            <div>
              <label style="display: block; font-size: 0.82rem; font-weight: 700; color: var(--navy-primary); margin-bottom: 0.35rem;">Full Name *</label>
              <input type="text" name="name" required placeholder="Eng. Tariq Al-Mansoor" style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.9rem;">
            </div>
            <div>
              <label style="display: block; font-size: 0.82rem; font-weight: 700; color: var(--navy-primary); margin-bottom: 0.35rem;">Corporate Email *</label>
              <input type="email" name="email" required placeholder="tariq@developer.ae" style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.9rem;">
            </div>
          </div>

          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.25rem;">
            <div>
              <label style="display: block; font-size: 0.82rem; font-weight: 700; color: var(--navy-primary); margin-bottom: 0.35rem;">Contact Phone *</label>
              <input type="tel" name="phone" required placeholder="+971 50 000 0000" style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.9rem;">
            </div>
            <div>
              <label style="display: block; font-size: 0.82rem; font-weight: 700; color: var(--navy-primary); margin-bottom: 0.35rem;">Inquiry Subject *</label>
              <select name="subject" style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.9rem; background: #fff;">
                <option value="Dubai HQ - Architectural Tensile Tender">Dubai HQ — Architectural Tensile Tender</option>
                <option value="Cairo Branch - Engineering & Execution">Cairo Branch — Engineering &amp; Execution</option>
                <option value="ASATI Air Dome Regional Inquiry">ASATI Air Dome Regional Inquiry</option>
                <option value="Lifecycle AMC & Structural Audit">Lifecycle AMC &amp; Structural Audit</option>
                <option value="General Technical Consultation">General Technical Consultation</option>
              </select>
            </div>
          </div>

          <div style="margin-bottom: 1.25rem;">
            <label style="display: block; font-size: 0.82rem; font-weight: 700; color: var(--navy-primary); margin-bottom: 0.35rem;">Project Scope &amp; Structural Requirements *</label>
            <textarea name="message" rows="4" required placeholder="Describe location, span, target completion timeline, or structural specifications..." style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.9rem;"></textarea>
          </div>

          <div style="margin-bottom: 1.5rem;">
            <label style="display: block; font-size: 0.82rem; font-weight: 700; color: var(--navy-primary); margin-bottom: 0.35rem;">Attach Architectural CAD / RFP Brief (Optional, Max 15MB)</label>
            <input type="file" name="attachment" style="font-size: 0.85rem; color: #64748b;">
          </div>

          <button type="submit" class="btn btn-request-consult" style="width: 100%; justify-content: center; padding: 1rem; font-size: 0.95rem;">
            <span>Submit Consultation Request</span>
            <span>&rarr;</span>
          </button>
        </form>
      </div>

      <!-- Right: Official Regional Offices -->
      <div style="background: #F8FAFC; border-radius: 12px; padding: 2.25rem; border: 1px solid #e2e8f0; display: flex; flex-direction: column; justify-content: space-between;">
        <div>
          <h4 style="font-size: 1.15rem; font-weight: 800; color: var(--navy-primary); margin-bottom: 0.5rem;">{{ \App\Models\Setting::get('dubai_office_title', 'Dubai Regional Headquarters') }}</h4>
          <p style="font-size: 0.88rem; color: #64748b; line-height: 1.6; margin-bottom: 1.5rem;">
            {{ \App\Models\Setting::get('dubai_address') }}
          </p>

          <h4 style="font-size: 1.15rem; font-weight: 800; color: var(--navy-primary); margin-bottom: 0.5rem;">{{ \App\Models\Setting::get('cairo_office_title', 'Cairo Regional Engineering Branch') }}</h4>
          <p style="font-size: 0.88rem; color: #64748b; line-height: 1.6; margin-bottom: 1.5rem;">
            {{ \App\Models\Setting::get('cairo_address') }}
          </p>

          <div style="display: flex; flex-direction: column; gap: 0.85rem; font-size: 0.88rem; color: var(--navy-primary); border-top: 1px solid #e2e8f0; padding-top: 1.5rem;">
            <div style="display: flex; align-items: center; gap: 0.65rem;">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#0B5ED7" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" /></svg>
              <span><strong>Dubai Direct:</strong> {{ \App\Models\Setting::get('dubai_phone') }}</span>
            </div>
            <div style="display: flex; align-items: center; gap: 0.65rem;">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#0B5ED7" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" /><polyline points="22,6 12,13 2,6" /></svg>
              <span><strong>Engineering Desk:</strong> {{ \App\Models\Setting::get('general_email') }}</span>
            </div>
            <div style="display: flex; align-items: center; gap: 0.65rem;">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#25D366" stroke-width="2"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
              <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', \App\Models\Setting::get('whatsapp_number', '971502959942')) }}" target="_blank" style="color: #059669; font-weight: 700; text-decoration: none;">
                WhatsApp Quick-Connect
              </a>
            </div>
          </div>
        </div>

        <div style="border-top: 1px solid #e2e8f0; padding-top: 1.5rem; margin-top: 1.5rem;">
          <span style="font-size: 0.72rem; font-weight: 800; color: #059669; text-transform: uppercase; letter-spacing: 0.8px;">Licensed &amp; Accredited</span>
          <p style="font-size: 0.78rem; color: #64748b; margin-top: 0.25rem;">Dubai Economy Commercial License &amp; UAE Ministry of Public Works Registered EPC Contractor.</p>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
