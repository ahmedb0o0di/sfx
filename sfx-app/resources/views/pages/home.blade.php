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
        @php
          $pillBadge = \App\Models\Setting::get('hero_pill_badge', '85+ Years Heritage');
          $pillText = \App\Models\Setting::get('hero_pill_text', 'Specialized Tensile & Lightweight Contractor');
        @endphp
        @if(!empty(trim($pillBadge ?? '')) || !empty(trim($pillText ?? '')))
        <div class="hero-pill"
          style="display: inline-flex; align-items: center; gap: 0.6rem; background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.2); padding: 0.35rem 0.9rem; border-radius: 999px; margin-bottom: 1.5rem; backdrop-filter: blur(8px);">
          @if(!empty(trim($pillBadge ?? '')))
          <span class="hero-pill-badge"
            style="background: #D99B26; color: #081C38; font-weight: 800; font-size: 0.7rem; padding: 0.15rem 0.5rem; border-radius: 999px; text-transform: uppercase;">{{ $pillBadge }}</span>
          @endif
          @if(!empty(trim($pillText ?? '')))
          <span class="hero-pill-text" style="color: #ffffff; font-size: 0.8rem; font-weight: 500;">{{ $pillText }}</span>
          @endif
        </div>
        @endif

        <h1 class="hero-blueprint-h1">
          {!! \App\Models\Setting::get('hero_title', 'Engineering Inspiring Spaces.<br>Delivering Lasting Performance.') !!}
        </h1>

        <p class="hero-blueprint-sub">
          {{ \App\Models\Setting::get('hero_subtitle', 'Specialists in Tensile Membrane, Lightweight and Air-Supported Structures across the Middle East, Africa and beyond. Turnkey design development, non-linear engineering, cleanroom fabrication, and lifetime structural maintenance.') }}
        </p>

        <div class="hero-blueprint-ctas">
          @php
            $btn1Text = \App\Models\Setting::get('hero_btn1_text', 'Our Solutions');
            $btn1Url = \App\Models\Setting::get('hero_btn1_url', '#solutions');
            $btn2Text = \App\Models\Setting::get('hero_btn2_text', 'View Projects');
            $btn2Url = \App\Models\Setting::get('hero_btn2_url', route('projects.index'));
          @endphp
          @if(!empty(trim($btn1Text ?? '')))
          <a href="{{ $btn1Url }}" class="btn btn-hero-solid">
            <span>{{ $btn1Text }}</span>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
              <path d="M5 12h14M12 5l7 7-7 7" />
            </svg>
          </a>
          @endif
          @if(!empty(trim($btn2Text ?? '')))
          <a href="{{ $btn2Url }}" class="btn btn-hero-white">
            <span>{{ $btn2Text }}</span>
          </a>
          @endif
        </div>
      </div>

      <!-- Right Column (40% - Floating ASATI Partnership Card) -->
      <div class="hero-blueprint-right">
        <div class="hero-asati-card">
          <div class="hero-asati-badge">{{ \App\Models\Setting::get('hero_asati_badge', 'Strategic Regional Alliance') }}</div>
          <div class="hero-asati-logo-wrap">
            <img src="{{ asset('assets/images/asati-logo.svg') }}" alt="ASATI United Arab Emirates"
              style="height: 50px; width: auto; max-width: 100%;">
          </div>
          <h3>{{ \App\Models\Setting::get('hero_asati_title', 'Delivering Air-Supported Structures Across MENA') }}</h3>
          <p>
            {{ \App\Models\Setting::get('hero_asati_desc', 'In partnership with ASATI (Air Structures American Technologies, Inc.), delivering turnkey air-supported domes for sports arenas, industrial bulk warehousing, seasonal exhibitions, and rapid-deployment facilities.') }}
          </p>
          <div class="hero-asati-specs">
            <div class="hero-asati-spec-item">
              <strong>{{ \App\Models\Setting::get('hero_asati_spec1_val', '150m+') }}</strong>
              <span>{{ \App\Models\Setting::get('hero_asati_spec1_label', 'Clear Span') }}</span>
            </div>
            <div class="hero-asati-spec-item">
              <strong>{{ \App\Models\Setting::get('hero_asati_spec2_val', 'HVAC') }}</strong>
              <span>{{ \App\Models\Setting::get('hero_asati_spec2_label', 'Climate Control') }}</span>
            </div>
            <div class="hero-asati-spec-item">
              <strong>{{ \App\Models\Setting::get('hero_asati_spec3_val', 'Rapid') }}</strong>
              <span>{{ \App\Models\Setting::get('hero_asati_spec3_label', 'Turnkey Erection') }}</span>
            </div>
          </div>
          <a href="{{ \App\Models\Setting::get('hero_asati_link_url', route('services.index') . '#air-supported') }}" class="hero-asati-link"
            onclick="const el = document.querySelector('#card-asati'); if (el) { el.scrollIntoView({behavior:'smooth'}); }">
            <span>{{ \App\Models\Setting::get('hero_asati_link_text', 'Learn More About ASATI Air Domes') }}</span>
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
      @php
        $stats = [
            [
                'val' => \App\Models\Setting::get('stat_1_val', '85+'),
                'label' => \App\Models\Setting::get('stat_1_label', 'Years of Heritage'),
                'sub' => \App\Models\Setting::get('stat_1_sub', 'Originated in 1937'),
                'color' => null,
            ],
            [
                'val' => \App\Models\Setting::get('stat_2_val', '9,000+'),
                'label' => \App\Models\Setting::get('stat_2_label', 'Projects Delivered'),
                'sub' => \App\Models\Setting::get('stat_2_sub', 'Proven Global Track Record'),
                'color' => null,
            ],
            [
                'val' => \App\Models\Setting::get('stat_3_val', '30+'),
                'label' => \App\Models\Setting::get('stat_3_label', 'Countries Served'),
                'sub' => \App\Models\Setting::get('stat_3_sub', 'Middle East, Africa & Beyond'),
                'color' => null,
            ],
            [
                'val' => \App\Models\Setting::get('stat_4_val', 'End-to-End'),
                'label' => \App\Models\Setting::get('stat_4_label', 'Turnkey Solutions'),
                'sub' => \App\Models\Setting::get('stat_4_sub', 'From Design to Lifecycle AMC'),
                'color' => '#0B5ED7',
            ],
            [
                'val' => \App\Models\Setting::get('stat_5_val', 'ISO Certified'),
                'label' => \App\Models\Setting::get('stat_5_label', 'Safety, Quality & Eco'),
                'sub' => \App\Models\Setting::get('stat_5_sub', 'ISO 9001 | 14001 | 45001'),
                'color' => '#008E38',
            ],
        ];
      @endphp
      @foreach($stats as $st)
        @if(!empty(trim($st['val'] ?? '')))
        <div class="trust-stat-box">
          <div class="trust-stat-val @if($st['color']) trust-stat-val-text @endif" data-target="{{ preg_replace('/[^0-9]/', '', $st['val']) }}" data-suffix="{{ preg_replace('/[0-9]/', '', $st['val']) }}" @if($st['color']) style="color: {{ $st['color'] }};" @endif>
            {{ $st['val'] }}
          </div>
          <div class="trust-stat-label">{{ $st['label'] }}</div>
          <div class="trust-stat-sub">{{ $st['sub'] }}</div>
        </div>
        @endif
      @endforeach
    </div>
  </div>
</section>

<!-- ==========================================================================
     SECTION 2: OUR SOLUTIONS (SEGMENTED GRID HUB)
     ========================================================================== -->
<section class="section" id="solutions" style="background-color: #ffffff; padding: 5.5rem 0;">
  <div class="container">
    <div class="section-header text-center" style="margin-bottom: 3.5rem;">
      <span class="section-tag"
        style="background: #edf4fd; color: #0B5ED7; border: 1px solid rgba(11, 94, 215, 0.25); font-weight: 700; font-size: 0.78rem; text-transform: uppercase; letter-spacing: 1px; padding: 0.35rem 0.9rem; border-radius: 999px;">Engineering
        Portfolios</span>
      <h2 class="section-title"
        style="font-size: var(--h2-size); font-weight: 800; color: var(--navy-primary); margin: 0.75rem 0 0.5rem; letter-spacing: -0.02em;">
        OUR SOLUTIONS</h2>
      <p class="section-subtitle"
        style="font-size: 1.1rem; color: var(--text-muted); max-width: 620px; margin: 0 auto; line-height: 1.6;">Innovative structures
        engineered for every architectural, recreational, and industrial requirement.</p>
    </div>

    <div class="solutions-segmented-grid">
      <!-- Card 1: Architectural Structures -->
      <article class="solution-hub-card">
        <a href="{{ route('services.show', 'architectural-tensile') }}" class="solution-img-holder" style="display: block;">
          <img src="{{ asset('assets/images/solutions/architectural.png') }}"
            alt="Architectural Tensile Structures - Al Jamea ETFE" loading="lazy">
          <span class="solution-tag-badge">ETFE & PTFE</span>
        </a>
        <div class="solution-card-body">
          <h3>
            <a href="{{ route('services.show', 'architectural-tensile') }}" style="color: inherit; text-decoration: none;">
              Architectural Structures
            </a>
          </h3>
          <p>Iconic translucent single skin and cushion ETFE daylighting systems, sculptural PTFE envelopes, and
            bespoke building atriums that elevate architectural vision.</p>
          <div class="solution-card-actions">
            <a href="{{ route('services.show', 'architectural-tensile') }}" class="solution-card-link" style="width: 100%; justify-content: space-between; text-decoration: none;">
              <span>View Specs &amp; Photos</span>
              <span>&rarr;</span>
            </a>
          </div>
        </div>
      </article>

      <!-- Card 2: Sports & Recreation Structures -->
      <article class="solution-hub-card">
        <a href="{{ route('services.show', 'sports-canopies') }}" class="solution-img-holder" style="display: block;">
          <img src="{{ asset('assets/images/solutions/sports.jpg') }}" alt="Sports and Recreation Tensile Canopies" loading="lazy">
          <span class="solution-tag-badge">Stadia & Arenas</span>
        </a>
        <div class="solution-card-body">
          <h3>
            <a href="{{ route('services.show', 'sports-canopies') }}" style="color: inherit; text-decoration: none;">
              Sports &amp; Recreation Structures
            </a>
          </h3>
          <p>Column-free sports court canopies, grandstand stadium roofs, Olympic aquatics shelters, and school
            sports complexes engineered for maximum thermal protection.</p>
          <div class="solution-card-actions">
            <a href="{{ route('services.show', 'sports-canopies') }}" class="solution-card-link" style="width: 100%; justify-content: space-between; text-decoration: none;">
              <span>View Specs &amp; Photos</span>
              <span>&rarr;</span>
            </a>
          </div>
        </div>
      </article>

      <!-- Card 3: Commercial & Retail Structures -->
      <article class="solution-hub-card">
        <a href="{{ route('services.show', 'commercial-atriums') }}" class="solution-img-holder" style="display: block;">
          <img src="{{ asset('assets/images/solutions/commercial.jpg') }}"
            alt="Commercial and Retail Tensile Roofing - Dubai Outlet Mall" loading="lazy">
          <span class="solution-tag-badge">Malls & Atriums</span>
        </a>
        <div class="solution-card-body">
          <h3>
            <a href="{{ route('services.show', 'commercial-atriums') }}" style="color: inherit; text-decoration: none;">
              Commercial &amp; Retail Structures
            </a>
          </h3>
          <p>Desert-proof shopping center roofs, open-air retail canopies, hotel terraces, and civic bazaar canopies
            providing soft ambient daylight and cool microclimates.</p>
          <div class="solution-card-actions">
            <a href="{{ route('services.show', 'commercial-atriums') }}" class="solution-card-link" style="width: 100%; justify-content: space-between; text-decoration: none;">
              <span>View Specs &amp; Photos</span>
              <span>&rarr;</span>
            </a>
          </div>
        </div>
      </article>

      <!-- Card 4: Transport & Infrastructure Structures -->
      <article class="solution-hub-card">
        <a href="{{ route('services.show', 'transport-infrastructure') }}" class="solution-img-holder" style="display: block;">
          <img src="{{ asset('assets/images/solutions/transport.jpg') }}" alt="Transport and Infrastructure Tensile Canopies"
            loading="lazy">
          <span class="solution-tag-badge">Transit Hubs</span>
        </a>
        <div class="solution-card-body">
          <h3>
            <a href="{{ route('services.show', 'transport-infrastructure') }}" style="color: inherit; text-decoration: none;">
              Transport &amp; Infrastructure Structures
            </a>
          </h3>
          <p>RTA marine floating transit hubs, airport concourse canopies, rail terminal tension roofs, and
            pedestrian bridge shades with heavy-duty aerodynamic durability.</p>
          <div class="solution-card-actions">
            <a href="{{ route('services.show', 'transport-infrastructure') }}" class="solution-card-link" style="width: 100%; justify-content: space-between; text-decoration: none;">
              <span>View Specs &amp; Photos</span>
              <span>&rarr;</span>
            </a>
          </div>
        </div>
      </article>

      <!-- Card 5: Industrial & Warehouse Structures -->
      <article class="solution-hub-card">
        <a href="{{ route('services.show', 'industrial-logistics') }}" class="solution-img-holder" style="display: block;">
          <img src="{{ asset('assets/images/solutions/industrial.jpg') }}" alt="Industrial and Warehouse Tensile Structures"
            loading="lazy">
          <span class="solution-tag-badge">Bulk Logistics</span>
        </a>
        <div class="solution-card-body">
          <h3>
            <a href="{{ route('services.show', 'industrial-logistics') }}" style="color: inherit; text-decoration: none;">
              Industrial &amp; Warehouse Structures
            </a>
          </h3>
          <p>Wide-span storage enclosures, bulk material protection, agricultural sunscreens, and rapidly deployable
            logistics shelters engineered for harsh Middle Eastern weather.</p>
          <div class="solution-card-actions">
            <a href="{{ route('services.show', 'industrial-logistics') }}" class="solution-card-link" style="width: 100%; justify-content: space-between; text-decoration: none;">
              <span>View Specs &amp; Photos</span>
              <span>&rarr;</span>
            </a>
          </div>
        </div>
      </article>

      <!-- Card 6: Air-Supported Structures (ASATI) -->
      <article class="solution-hub-card">
        <a href="{{ route('services.show', 'air-supported-domes') }}" class="solution-img-holder" style="display: block;">
          <img src="{{ asset('assets/images/solutions/air-supported-asati.jpg') }}" alt="ASATI Air-Supported Dome Structures"
            loading="lazy">
          <span class="solution-tag-badge" style="background: #0B5ED7;">ASATI UAE Partner</span>
        </a>
        <div class="solution-card-body">
          <h3>
            <a href="{{ route('services.show', 'air-supported-domes') }}" style="color: inherit; text-decoration: none;">
              Air-Supported Structures (ASATI)
            </a>
          </h3>
          <p>State-of-the-art air domes clear-spanning up to 150m+ with automated pressure control, complete thermal
            HVAC, and rapid deployment for indoor sports and warehousing.</p>
          <div class="solution-card-actions">
            <a href="{{ route('services.show', 'air-supported-domes') }}" class="solution-card-link" style="width: 100%; justify-content: space-between; text-decoration: none;">
              <span>View Specs &amp; Photos</span>
              <span>&rarr;</span>
            </a>
          </div>
        </div>
      </article>

      <!-- Card 7: Lifecycle Services (Inspection & AMC) -->
      <article class="solution-hub-card">
        <a href="{{ route('services.show', 'lifecycle-maintenance') }}" class="solution-img-holder" style="display: block;">
          <img src="{{ asset('assets/images/solutions/lifecycle-amc.jpg') }}" alt="Lifecycle Services Inspection and AMC"
            loading="lazy">
          <span class="solution-tag-badge">Asset Stewardship</span>
        </a>
        <div class="solution-card-body">
          <h3>
            <a href="{{ route('services.show', 'lifecycle-maintenance') }}" style="color: inherit; text-decoration: none;">
              Lifecycle Services (Inspection &amp; AMC)
            </a>
          </h3>
          <p>Comprehensive condition audits, biaxial membrane tension calibration, ultrasonic weld verification,
            specialized cleaning, and certified annual maintenance contracts.</p>
          <div class="solution-card-actions">
            <a href="{{ route('services.show', 'lifecycle-maintenance') }}" class="solution-card-link" style="width: 100%; justify-content: space-between; text-decoration: none;">
              <span>View Specs &amp; Photos</span>
              <span>&rarr;</span>
            </a>
          </div>
        </div>
      </article>

      <!-- Card 8: Lead Gen Action Card -->
      <div class="solution-lead-cta-card">
        <div>
          <span class="lead-cta-badge">Ready To Build?</span>
          <h3>Have a Project in Mind?</h3>
          <p>
            Let's build something great together. Partner directly with our Middle East engineering leadership for
            initial form-finding equilibrium, material advice, and turnkey B2B budgeting.
          </p>
        </div>
        <div>
          <a href="{{ route('contact.index') }}" class="btn btn-lead-white">
            <span>GET IN TOUCH</span>
            <span>→</span>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

@php
  $wfVisible = (bool) \App\Models\Setting::get('workflow_section_visible', true);
  $wfTag = \App\Models\Setting::get('workflow_section_tag', 'Turnkey Workflow');
  $wfTitle = \App\Models\Setting::get('workflow_section_title', 'OUR CAPABILITIES');
  $wfSubtitle = \App\Models\Setting::get('workflow_section_subtitle', 'From initial mathematical form-finding to lifetime structural stewardship, Structurflex Middle East manages the entire project lifecycle in-house.');
  
  $wfStepsRaw = \App\Models\Setting::get('workflow_steps');
  if ($wfStepsRaw) {
      $wfSteps = json_decode($wfStepsRaw, true);
  } else {
      $wfSteps = [
          ['step_num' => 'Step 01', 'title' => 'Design', 'icon' => 'design', 'description' => 'Parametric form-finding, 3D architectural geometry, conceptual equilibrium modeling & digital prototyping.', 'is_visible' => true],
          ['step_num' => 'Step 02', 'title' => 'Engineering', 'icon' => 'engineering', 'description' => 'Advanced membrane analysis, non-linear FEA, computational wind load modeling, and structural cable sizing.', 'is_visible' => true],
          ['step_num' => 'Step 03', 'title' => 'Fabrication', 'icon' => 'fabrication', 'description' => 'State-of-the-art cleanroom manufacturing, automated CNC precision cutting, and high-frequency molecular seaming.', 'is_visible' => true],
          ['step_num' => 'Step 04', 'title' => 'Installation', 'icon' => 'installation', 'description' => 'Expert site execution, certified master rigging, crane erection, laser-measured pre-stressing, and stringent HSE.', 'is_visible' => true],
          ['step_num' => 'Step 05', 'title' => 'Inspection & AMC', 'icon' => 'maintenance', 'description' => 'Regular membrane condition audits, non-destructive cleaning, cable re-tensioning, and lifetime preventive maintenance.', 'is_visible' => true],
      ];
  }
  $visibleWfSteps = array_filter($wfSteps ?? [], fn($s) => !isset($s['is_visible']) || $s['is_visible']);
@endphp

@if($wfVisible)
<!-- ==========================================================================
     SECTION: OUR CAPABILITIES (END-TO-END PROCESS WORKFLOW)
     ========================================================================== -->
<section class="capabilities-deep-section" id="capabilities">
  <div class="container">
    <div class="section-header text-center" style="margin-bottom: 2rem;">
      <span class="section-tag"
        style="background: rgba(11, 94, 215, 0.2); color: #60a5fa; border: 1px solid rgba(11, 94, 215, 0.4); font-weight: 700; font-size: 0.78rem; text-transform: uppercase; letter-spacing: 1px; padding: 0.35rem 0.9rem; border-radius: 999px;">{{ $wfTag }}</span>
      <h2 class="section-title" style="margin-top: 0.75rem;">{{ $wfTitle }}</h2>
      <p class="section-subtitle">
        {{ $wfSubtitle }}
      </p>
    </div>

    <div class="capabilities-chain">
      @foreach($visibleWfSteps as $index => $step)
      <div class="capability-step-card">
        <div class="capability-icon-bubble">
          @php $icon = $step['icon'] ?? ($index === 0 ? 'design' : ($index === 1 ? 'engineering' : ($index === 2 ? 'fabrication' : ($index === 3 ? 'installation' : 'maintenance')))); @endphp
          @if($icon === 'design')
          <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M12 20h9" />
            <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z" />
          </svg>
          @elseif($icon === 'engineering')
          <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M2 12h20" />
            <path d="M20 12v6a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-6" />
            <path d="M12 2v20" />
            <path d="M7 7l5-5 5 5" />
          </svg>
          @elseif($icon === 'fabrication')
          <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <rect x="2" y="7" width="20" height="14" rx="2" ry="2" />
            <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16" />
          </svg>
          @elseif($icon === 'installation')
          <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
            <polyline points="14 2 14 8 20 8" />
            <line x1="16" y1="13" x2="8" y2="13" />
            <line x1="16" y1="17" x2="8" y2="17" />
          </svg>
          @else
          <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
            <polyline points="9 12 11 14 15 10" />
          </svg>
          @endif
        </div>
        <div class="capability-step-content">
          <div class="capability-step-num">{{ $step['step_num'] ?? ('Step ' . sprintf('%02d', $loop->iteration)) }}</div>
          <h3 class="capability-step-title">{{ $step['title'] ?? '' }}</h3>
          <p class="capability-step-desc">{{ $step['description'] ?? '' }}</p>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>
@endif

<!-- ==========================================================================
     SECTION: FEATURED PROJECTS SHOWCASE (EXECUTED LANDMARKS)
     ========================================================================== -->
<section class="section" id="projects" style="background-color: #F4F6F9; padding: 5.5rem 0;">
  <div class="container">
    <div class="section-header text-center" style="margin-bottom: 2.5rem;">
      <span class="section-tag"
        style="background: #e6f6ec; color: #008E38; border: 1px solid rgba(0, 142, 56, 0.3); font-weight: 700; font-size: 0.78rem; text-transform: uppercase; letter-spacing: 1px; padding: 0.35rem 0.9rem; border-radius: 999px;">Executed
        Landmarks</span>
      <h2 class="section-title"
        style="font-size: var(--h2-size); font-weight: 800; color: var(--navy-primary); margin: 0.75rem 0 0.5rem; letter-spacing: -0.02em;">
        FEATURED PROJECTS</h2>
      <p class="section-subtitle"
        style="font-size: 1.1rem; color: var(--text-muted); max-width: 650px; margin: 0 auto; line-height: 1.6;">Select iconic tensile
        and lightweight membrane structures engineered and delivered across the globe.</p>
    </div>

    <!-- Filter Tabs -->
    <div class="portfolio-filter-bar"
      style="display: flex; gap: 0.65rem; justify-content: center; flex-wrap: wrap; margin-bottom: 2.75rem;">
      <button class="filter-btn active" data-filter="all">All Projects</button>
      <button class="filter-btn" data-filter="architectural">Architectural</button>
      <button class="filter-btn" data-filter="sports">Sports &amp; Stadia</button>
      <button class="filter-btn" data-filter="air-supported">Air-Supported Domes</button>
      <button class="filter-btn" data-filter="infrastructure">Infrastructure</button>
    </div>

    <!-- 4-Column Projects Showcase Grid -->
    <div class="projects-showcase-grid">
      @forelse($allProjects as $project)
      <article class="project-showcase-card"
        data-category="{{ $project->category ? $project->category->filter_tag : 'architectural' }}"
        data-id="{{ $project->slug }}"
        data-url="{{ route('projects.show', $project->slug) }}"
        style="cursor: pointer;"
        onclick="if (window.innerWidth <= 992) { window.location.href = '{{ route('projects.show', $project->slug) }}'; }">
        <div class="project-showcase-img">
          <img src="{{ asset($project->thumbnail_image) }}" alt="{{ $project->title }}" loading="lazy">
          <span class="project-location-badge">{{ $project->location }}</span>
        </div>
        <div class="project-showcase-body">
          <span class="project-showcase-category">{{ $project->category ? $project->category->name : 'Architectural' }}</span>
          <h3 class="project-showcase-title">
            <a href="{{ route('projects.show', $project->slug) }}" style="color: inherit; text-decoration: none;">
              {{ $project->title }}
            </a>
          </h3>
          <div class="project-showcase-meta">
            <span>{{ $project->membrane_material ?? ($project->client_name ?? 'Tensile Membrane') }}</span>
            <span>{{ $project->covered_area }}</span>
          </div>
        </div>
      </article>
      @empty
      <!-- Fallback project cards from Option-1 -->
      <article class="project-showcase-card"
        data-category="architectural"
        data-id="al-jamea"
        data-url="{{ route('projects.show', 'al-jamea') }}"
        style="cursor: pointer;"
        onclick="if (window.innerWidth <= 992) { window.location.href = '{{ route('projects.show', 'al-jamea') }}'; }">
        <div class="project-showcase-img">
          <img src="{{ asset('assets/images/projects/al-jamea-etfe.png') }}" alt="Al Jamea Tus Saifiyah Single Skin ETFE Membrane" loading="lazy">
          <span class="project-location-badge">Nairobi, Kenya</span>
        </div>
        <div class="project-showcase-body">
          <span class="project-showcase-category">Architectural ETFE</span>
          <h3 class="project-showcase-title">
            <a href="{{ route('projects.show', 'al-jamea') }}" style="color: inherit; text-decoration: none;">
              Al Jamea Tus Saifiyah ETFE Roof
            </a>
          </h3>
          <div class="project-showcase-meta">
            <span>Single Skin ETFE</span>
            <span>4,800 m²</span>
          </div>
        </div>
      </article>
      @endforelse
    </div>

    <!-- View All Projects Button -->
    <div style="text-align: center; margin-top: 3.5rem;">
      <a href="{{ route('projects.index') }}" class="btn btn-hero-solid"
        style="background: transparent; color: var(--navy-primary) !important; border: 2px solid var(--navy-primary); text-decoration: none;">
        <span>VIEW ALL PROJECTS</span>
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <path d="M5 12h14M12 5l7 7-7 7" />
        </svg>
      </a>
    </div>
  </div>
</section>


@php
  $partnersSectionVisible = (bool) \App\Models\Setting::get('partners_section_visible', true);
  $partnersTag = \App\Models\Setting::get('partners_section_tag', 'Trust & Alliances');
  $partnersTitle = \App\Models\Setting::get('partners_section_title', 'TRUSTED BY LEADING CLIENTS & PARTNERS');
  $partnersSubtitle = \App\Models\Setting::get('partners_section_subtitle', 'Collaborating with government ministries, master developers, and international engineering leaders.');

  $partnersRaw = \App\Models\Setting::get('partners_items');
  if ($partnersRaw) {
      $partnerItems = json_decode($partnersRaw, true);
  } else {
      $partnerItems = [
          ['name' => 'ASATI', 'subtitle' => 'Air Structures American Technologies', 'link_url' => '', 'is_visible' => true],
          ['name' => 'Ministry of Public Works', 'subtitle' => 'Strategic Partner (14 Projects)', 'link_url' => '', 'is_visible' => true],
          ['name' => 'RTA Dubai', 'subtitle' => 'Roads & Transport Authority', 'link_url' => '', 'is_visible' => true],
          ['name' => 'Oromia Regional Govt', 'subtitle' => 'Unity Park Project', 'link_url' => '', 'is_visible' => true],
          ['name' => 'Nakheel & Emaar', 'subtitle' => 'Master Developers', 'link_url' => '', 'is_visible' => true],
          ['name' => 'Al Ain Municipality', 'subtitle' => 'Civic Architectural Projects', 'link_url' => '', 'is_visible' => true],
      ];
  }
  $visiblePartners = array_filter($partnerItems ?? [], fn($p) => !isset($p['is_visible']) || $p['is_visible']);

  $certsVisible = (bool) \App\Models\Setting::get('certifications_section_visible', true);
  $certsRaw = \App\Models\Setting::get('certifications_items');
  if ($certsRaw) {
      $certItems = json_decode($certsRaw, true);
  } else {
      $certItems = [
          ['title' => 'ISO 9001:2015', 'description' => 'Quality Management System Certification across design, fabrication & erection.', 'icon' => 'shield', 'accent_border' => false, 'is_visible' => true],
          ['title' => 'ISO 14001:2015', 'description' => 'Environmental Management System ensuring sustainable lifecycle practices.', 'icon' => 'globe', 'accent_border' => false, 'is_visible' => true],
          ['title' => 'ISO 45001:2018', 'description' => 'Occupational Health & Safety certified for high-altitude tension rigging.', 'icon' => 'heart', 'accent_border' => false, 'is_visible' => true],
          ['title' => 'Ministry Award', 'description' => 'Special Strategic Partner Award from UAE Ministry of Public Works (14 successful projects).', 'icon' => 'award', 'accent_border' => true, 'is_visible' => true],
      ];
  }
  $visibleCerts = array_filter($certItems ?? [], fn($c) => !isset($c['is_visible']) || $c['is_visible']);
@endphp

@if($partnersSectionVisible || $certsVisible)
<!-- ==========================================================================
     SECTION: STRATEGIC CREDENTIALS & PARTNERSHIPS MATRIX
     ========================================================================== -->
<section class="credentials-bar" id="credentials">
  <div class="container">
    @if($partnersSectionVisible)
    <!-- Sub-Section A: Clients & Partners -->
    <div class="section-header text-center" style="margin-bottom: 2.5rem;">
      @if(!empty(trim($partnersTag ?? '')))
      <span class="section-tag"
        style="background: #edf4fd; color: #0B5ED7; border: 1px solid rgba(11, 94, 215, 0.25); font-weight: 700; font-size: 0.78rem; text-transform: uppercase; letter-spacing: 1px; padding: 0.35rem 0.9rem; border-radius: 999px;">{{ $partnersTag }}</span>
      @endif
      @if(!empty(trim($partnersTitle ?? '')))
      <h2 class="section-title"
        style="font-size: 1.85rem; font-weight: 800; color: var(--navy-primary); margin: 0.65rem 0 0.35rem;">{{ $partnersTitle }}</h2>
      @endif
      @if(!empty(trim($partnersSubtitle ?? '')))
      <p class="section-subtitle" style="font-size: 0.95rem; color: var(--text-muted); max-width: 650px; margin: 0 auto;">{{ $partnersSubtitle }}</p>
      @endif
    </div>

    @if(!empty($visiblePartners))
    <div class="partner-logo-matrix" style="margin-bottom: {{ $certsVisible ? '4rem' : '0' }};">
      @foreach($visiblePartners as $partner)
        @php
          $hasUrl = !empty(trim($partner['link_url'] ?? ''));
          $itemTag = $hasUrl ? 'a' : 'div';
        @endphp
        <{{ $itemTag }} @if($hasUrl) href="{{ $partner['link_url'] }}" target="_blank" rel="noopener" @endif class="partner-badge-item" style="text-decoration: none; color: inherit;">
          <strong>{{ $partner['name'] ?? '' }}</strong>
          @if(!empty(trim($partner['subtitle'] ?? '')))
          <span>{{ $partner['subtitle'] }}</span>
          @endif
        </{{ $itemTag }}>
      @endforeach
    </div>
    @endif
    @endif

    @if($certsVisible && !empty($visibleCerts))
    <!-- Sub-Section B: Certifications -->
    <div class="certifications-row" style="{{ $partnersSectionVisible ? 'margin-top: 2.5rem;' : '' }}">
      @foreach($visibleCerts as $cert)
        @php
          $isGold = !empty($cert['accent_border']);
          $icon = $cert['icon'] ?? 'shield';
        @endphp
        <div class="cert-card" @if($isGold) style="border-left: 3px solid #D99B26;" @endif>
          <div class="cert-icon-box" @if($isGold) style="background: #fef8eb; color: #D99B26;" @endif>
            @if($icon === 'globe')
            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
              <circle cx="12" cy="12" r="10" />
              <path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20" />
              <path d="M2 12h20" />
            </svg>
            @elseif($icon === 'heart')
            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
              <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
            </svg>
            @elseif($icon === 'award')
            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
              <circle cx="12" cy="8" r="7" />
              <polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88" />
            </svg>
            @elseif($icon === 'star')
            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
              <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
            </svg>
            @else
            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
              <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
              <path d="m9 12 2 2 4-4" />
            </svg>
            @endif
          </div>
          <div class="cert-info">
            <h4>{{ $cert['title'] ?? '' }}</h4>
            <p>{{ $cert['description'] ?? '' }}</p>
          </div>
        </div>
      @endforeach
    </div>
    @endif
  </div>
</section>
@endif

<!-- ==========================================================================
     SECTION 8: INSIGHTS & RESOURCES HUB (ENGINEERING KNOWLEDGE)
     ========================================================================== -->
<section class="section" id="resources" style="background-color: #F4F6F9; padding: 5.5rem 0;">
  <div class="container">
    <div class="section-header text-center" style="margin-bottom: 3.5rem;">
      <span class="section-tag"
        style="background: #edf4fd; color: #0B5ED7; border: 1px solid rgba(11, 94, 215, 0.25); font-weight: 700; font-size: 0.78rem; text-transform: uppercase; letter-spacing: 1px; padding: 0.35rem 0.9rem; border-radius: 999px;">Engineering Knowledge</span>
      <h2 class="section-title"
        style="font-size: var(--h2-size); font-weight: 800; color: var(--navy-primary); margin: 0.75rem 0 0.5rem; letter-spacing: -0.02em;">
        INSIGHTS &amp; RESOURCES</h2>
      <p class="section-subtitle"
        style="font-size: 1.1rem; color: var(--text-muted); max-width: 620px; margin: 0 auto; line-height: 1.6;">Technical
        whitepapers, tensile engineering case studies, and daylighting research from our MENA technical teams.</p>
    </div>

    <div class="insights-matrix-grid">
      @forelse($latestPosts as $post)
      <article class="insight-card">
        <a href="{{ route('blog.show', $post->slug) }}" class="insight-thumb" style="display: block; text-decoration: none;">
          <img src="{{ asset($post->featured_image) }}" alt="{{ $post->title }}" loading="lazy">
        </a>
        <div class="insight-body">
          <div class="insight-meta">
            <span class="insight-tag">{{ $post->category }}</span>
            <span>{{ $post->reading_time_minutes ?? 6 }} Min Read</span>
          </div>
          <h3 class="insight-title">
            <a href="{{ route('blog.show', $post->slug) }}" style="color: inherit; text-decoration: none;">
              {{ $post->title }}
            </a>
          </h3>
          <p class="insight-excerpt">{{ $post->excerpt }}</p>
          @php
            $actionWord = match($post->category) {
              'Whitepaper' => 'Whitepaper',
              'Engineering Guide' => 'Guide',
              'Maintenance Protocol' => 'Protocol',
              default => 'Article',
            };
          @endphp
          <a href="{{ route('blog.show', $post->slug) }}" class="insight-link">Read {{ $actionWord }} &rarr;</a>
        </div>
      </article>
      @empty
      <!-- Fallback Option-1 Articles -->
      <article class="insight-card">
        <a href="{{ route('blog.index') }}" class="insight-thumb" style="display: block; text-decoration: none;">
          <img src="{{ asset('assets/images/solutions/architectural.png') }}" alt="Evolution of ETFE Architecture" loading="lazy">
        </a>
        <div class="insight-body">
          <div class="insight-meta">
            <span class="insight-tag">Whitepaper</span>
            <span>6 Min Read</span>
          </div>
          <h3 class="insight-title">The Evolution of ETFE: From Aerospace to Architectural Icons</h3>
          <p class="insight-excerpt">How single skin and multi-layer pneumatic ETFE cushions revolutionized high-performance daylighting in modern Middle Eastern atriums.</p>
          <a href="{{ route('blog.index') }}" class="insight-link">Read Whitepaper &rarr;</a>
        </div>
      </article>
      <article class="insight-card">
        <a href="{{ route('blog.index') }}" class="insight-thumb" style="display: block; text-decoration: none;">
          <img src="{{ asset('assets/images/solutions/commercial.jpg') }}" alt="Wind & Desert Resilient Tensile Engineering" loading="lazy">
        </a>
        <div class="insight-body">
          <div class="insight-meta">
            <span class="insight-tag">Engineering Guide</span>
            <span>8 Min Read</span>
          </div>
          <h3 class="insight-title">Engineering High-Wind & Desert Resilient Tensile Membranes</h3>
          <p class="insight-excerpt">Finite element modeling (FEA) and anti-wicking lacquers engineered to resist sandstorms, solar UV degradation, and thermal expansion in the GCC.</p>
          <a href="{{ route('blog.index') }}" class="insight-link">Read Guide &rarr;</a>
        </div>
      </article>
      <article class="insight-card">
        <a href="{{ route('blog.index') }}" class="insight-thumb" style="display: block; text-decoration: none;">
          <img src="{{ asset('assets/images/solutions/air-supported-asati.jpg') }}" alt="ASATI Air-Supported Domes" loading="lazy">
        </a>
        <div class="insight-body">
          <div class="insight-meta">
            <span class="insight-tag">Technology Insight</span>
            <span>5 Min Read</span>
          </div>
          <h3 class="insight-title">Air-Supported Dome Structures: The ASATI Partnership Advantage</h3>
          <p class="insight-excerpt">Evaluating total cost of ownership, clear-span flexibility up to 150m+, and energy savings of modern air-supported domes for athletics and industry.</p>
          <a href="{{ route('blog.index') }}" class="insight-link">Read Article &rarr;</a>
        </div>
      </article>
      <article class="insight-card">
        <a href="{{ route('blog.index') }}" class="insight-thumb" style="display: block; text-decoration: none;">
          <img src="{{ asset('assets/images/solutions/lifecycle-amc.jpg') }}" alt="Lifecycle Maintenance and Inspection" loading="lazy">
        </a>
        <div class="insight-body">
          <div class="insight-meta">
            <span class="insight-tag">Maintenance Protocol</span>
            <span>7 Min Read</span>
          </div>
          <h3 class="insight-title">Lifecycle Maintenance & Inspection: Preserving Structural Integrity</h3>
          <p class="insight-excerpt">Laser cable re-tensioning, specialized non-abrasive washing protocols, and structural audits that extend membrane life past 35+ years.</p>
          <a href="{{ route('blog.index') }}" class="insight-link">Read Protocol &rarr;</a>
        </div>
      </article>
      @endforelse
    </div>
  </div>
</section>

<!-- ==========================================================================
     CAREERS OPENINGS SECTION (SINGLE ITEM PER ROW LIST)
     ========================================================================== -->
<section class="section section-careers" id="careers" style="background-color: #ffffff; padding: 5.5rem 0;">
  <div class="container">
    <div class="section-header" style="text-align: center; max-width: 780px; margin: 0 auto 3.5rem;">
      <span class="section-tag" style="background: #fef8eb; color: #D99B26; border: 1px solid rgba(217, 155, 38, 0.3); font-weight: 700; font-size: 0.78rem; text-transform: uppercase; letter-spacing: 1px; padding: 0.35rem 0.9rem; border-radius: 999px;">
        Join Our Engineering Practice
      </span>
      <h2 class="section-title" style="font-size: var(--h2-size); font-weight: 800; color: var(--navy-primary); margin: 0.75rem 0 0.5rem; letter-spacing: -0.02em;">
        Build Architectural Icons Across MENA &amp; Africa
      </h2>
      <p class="section-subtitle" style="font-size: 1.05rem; color: var(--text-muted); max-width: 680px; margin: 0 auto; line-height: 1.6;">
        We are consistently seeking visionary structural engineers, parametric computational designers, master riggers, and project managers for landmark commissions.
      </p>
    </div>

    <!-- Single Item per Row Career List -->
    <div class="career-rows-container" style="display: flex; flex-direction: column; gap: 1.75rem;">
      @forelse($careers as $career)
      <article class="career-row-card" style="background: #ffffff; border: 1.5px solid #e2e8f0; border-radius: 14px; padding: 1.75rem; box-shadow: 0 4px 18px rgba(8, 28, 56, 0.05); transition: all 0.3s ease; display: grid; grid-template-columns: 240px 1fr auto; gap: 2rem; align-items: center;">
        <!-- Left: Image (clickable) -->
        <a href="{{ route('careers.show', $career->slug) }}" class="career-row-media" style="width: 100%; height: 160px; border-radius: 10px; overflow: hidden; background: #081C38; position: relative; display: block; text-decoration: none;">
          <img src="{{ $career->image_url }}" alt="{{ $career->title }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s ease;">
          <span style="position: absolute; top: 10px; left: 10px; background: rgba(8, 28, 56, 0.85); backdrop-filter: blur(4px); color: #fff; font-size: 0.68rem; font-weight: 700; padding: 0.2rem 0.55rem; border-radius: 4px; text-transform: uppercase; letter-spacing: 0.5px;">
            {{ $career->type ?? 'Full-time' }}
          </span>
        </a>

        <!-- Middle: Title, Badges & Job Description -->
        <div class="career-row-content">
          <div style="display: flex; align-items: center; gap: 0.65rem; margin-bottom: 0.5rem; flex-wrap: wrap;">
            @if(!empty($career->department))
            <span style="background: #edf4fd; color: #0B5ED7; font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.6px; padding: 0.25rem 0.65rem; border-radius: 999px;">
              {{ $career->department }}
            </span>
            @endif
            @if(!empty($career->location))
            <span style="color: #64748b; font-size: 0.82rem; display: inline-flex; align-items: center; gap: 0.3rem;">
              📍 {{ $career->location }}
            </span>
            @endif
          </div>

          <h3 style="font-size: 1.3rem; font-weight: 800; color: var(--navy-primary); margin: 0 0 0.65rem; line-height: 1.3;">
            <a href="{{ route('careers.show', $career->slug) }}" style="color: inherit; text-decoration: none;">
              {{ $career->title }}
            </a>
          </h3>

          <p style="color: #475569; font-size: 0.92rem; line-height: 1.6; margin: 0;">
            {{ $career->description }}
          </p>
        </div>

        <!-- Right: Actions -->
        <div class="career-row-action" style="flex-shrink: 0; display: flex; flex-direction: column; gap: 0.65rem; align-items: stretch;">
          <a href="{{ route('careers.show', $career->slug) }}" class="btn btn-primary" style="white-space: nowrap; padding: 0.75rem 1.45rem; font-size: 0.9rem; font-weight: 700; justify-content: center;">
            <span>View Role &amp; Apply</span>
            <span>&rarr;</span>
          </a>
          <button type="button" onclick="openCareerApplyModal({{ $career->id }}, '{{ addslashes($career->title) }}')" class="btn btn-outline" style="white-space: nowrap; padding: 0.65rem 1.15rem; font-size: 0.85rem; font-weight: 700; justify-content: center;">
            <span>Quick Apply</span>
          </button>
        </div>
      </article>
      @empty
      <div style="text-align: center; padding: 3rem; background: #F8FAFC; border-radius: 12px; border: 1px dashed #cbd5e1;">
        <p style="color: #64748b; font-size: 1rem; margin-bottom: 1rem;">We are always welcoming exceptional structural talents to join our talent pool.</p>
        <button type="button" onclick="openCareerApplyModal(null, 'Speculative Application')" class="btn btn-primary">
          <span>Submit Speculative CV</span>
          <span>&rarr;</span>
        </button>
      </div>
      @endforelse
    </div>
  </div>
</section>

@include('components.career-apply-modal')

<!-- ==========================================================================
     SECTION 8: PROJECT INQUIRIES & CONSULTATION
     ========================================================================== -->
<section class="section" id="contact" style="background-color: #F4F6F9;">
  <div class="container">
    <div class="section-header">
      <span class="section-tag"
        style="background: #edf4fd; color: #0B5ED7; border: 1px solid rgba(11, 94, 215, 0.25); font-weight: 700; font-size: 0.78rem; text-transform: uppercase; letter-spacing: 1px; padding: 0.35rem 0.9rem; border-radius: 999px;">Project
        Inquiries</span>
      <h2 class="section-title"
        style="font-size: var(--h2-size); font-weight: 800; color: var(--navy-primary); margin: 0.75rem 0 0.5rem; letter-spacing: -0.02em;">
        REQUEST A CONSULTATION</h2>
      <p class="section-subtitle"
        style="font-size: 1.1rem; color: var(--text-muted); max-width: 620px; margin: 0 auto;">Connect directly with
        our senior engineering practice in Dubai for architectural form-finding, feasibility, and tenders.</p>
    </div>

    @if(session('success'))
    <div style="background: #e6f6ec; border: 1.5px solid #008e38; color: #00732d; padding: 1.25rem 1.5rem; border-radius: 8px; margin-bottom: 2rem; font-size: 0.95rem; font-weight: 700; text-align: center;">
      {{ session('success') }}
    </div>
    @endif

    <div
      style="display: grid; grid-template-columns: 1.2fr 0.8fr; gap: 3rem; background: #ffffff; border-radius: 12px; border: 1px solid #e2e8f0; padding: 3rem; box-shadow: 0 10px 30px rgba(0,0,0,0.05);"
      class="contact-main-grid">
      <!-- Left: RFP Form -->
      <div>
        <h3 style="font-size: 1.35rem; font-weight: 800; color: var(--navy-primary); margin-bottom: 1.5rem;">Project
          RFP &amp; Feasibility Inquiry</h3>
        <form id="contactForm" class="contact-form" action="{{ route('contact.store') }}" method="POST">
          @csrf
          <div class="form-row-2"
            style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.25rem;">
            <div class="form-group">
              <label for="contactName"
                style="display: block; font-size: 0.82rem; font-weight: 700; color: var(--navy-primary); margin-bottom: 0.35rem;">Full
                Name *</label>
              <input type="text" id="contactName" name="name" required placeholder="e.g. Eng. Tariq Al-Mansoor"
                style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.9rem;">
            </div>
            <div class="form-group">
              <label for="contactEmail"
                style="display: block; font-size: 0.82rem; font-weight: 700; color: var(--navy-primary); margin-bottom: 0.35rem;">Corporate
                Email *</label>
              <input type="email" id="contactEmail" name="email" required placeholder="tariq@developer.ae"
                style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.9rem;">
            </div>
          </div>

          <div class="form-row-2"
            style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.25rem;">
            <div class="form-group">
              <label for="contactPhone"
                style="display: block; font-size: 0.82rem; font-weight: 700; color: var(--navy-primary); margin-bottom: 0.35rem;">Contact
                Phone *</label>
              <input type="tel" id="contactPhone" name="phone" required placeholder="+971 50 000 0000"
                style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.9rem;">
            </div>
            <div class="form-group">
              <label for="contactSolution"
                style="display: block; font-size: 0.82rem; font-weight: 700; color: var(--navy-primary); margin-bottom: 0.35rem;">Solution
                Interest *</label>
              <select id="contactSolution" name="solution"
                style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.9rem; background: #fff;">
                <option value="Architectural Structures (ETFE / PTFE)">Architectural Structures (ETFE / PTFE)</option>
                <option value="Sports & Recreation Canopies">Sports &amp; Recreation Canopies</option>
                <option value="Commercial & Retail Atriums">Commercial &amp; Retail Atriums</option>
                <option value="Transport & Infrastructure">Transport &amp; Infrastructure</option>
                <option value="Industrial & Bulk Storage">Industrial &amp; Bulk Storage</option>
                <option value="Air-Supported Structures (ASATI)">Air-Supported Structures (ASATI)</option>
                <option value="Lifecycle Inspection & AMC">Lifecycle Inspection &amp; AMC</option>
              </select>
            </div>
          </div>

          <div class="form-group" style="margin-bottom: 1.5rem;">
            <label for="contactMessage"
              style="display: block; font-size: 0.82rem; font-weight: 700; color: var(--navy-primary); margin-bottom: 0.35rem;">Project
              Scope &amp; Requirements *</label>
            <textarea id="contactMessage" name="message" rows="4" required
              placeholder="Describe location, span, target completion timeline, or structural specifications..."
              style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.9rem;"></textarea>
          </div>

          <button type="submit" class="btn btn-request-consult"
            style="width: 100%; justify-content: center; padding: 1rem; font-size: 0.95rem;">
            <span>Submit Consultation Request</span>
            <span>&rarr;</span>
          </button>
        </form>
      </div>

      <!-- Right: Official Office Credentials -->
      <div
        style="background: #F4F6F9; border-radius: 8px; padding: 2rem; border: 1px solid #e2e8f0; display: flex; flex-direction: column; justify-content: space-between;">
        <div>
          <h4 style="font-size: 1.15rem; font-weight: 800; color: var(--navy-primary); margin-bottom: 1rem;">
            Regional Headquarters</h4>
          <p style="font-size: 0.9rem; color: var(--text-muted); line-height: 1.6; margin-bottom: 1.5rem;">
            <strong>Structurflex Middle East Contracting LLC</strong><br>
            Shed 01 (S-464), Al Ttay Area,<br>
            Al Khawaneej 2 Industrial Area,<br>
            Dubai, United Arab Emirates
          </p>

          <div
            style="display: flex; flex-direction: column; gap: 0.85rem; font-size: 0.9rem; color: var(--navy-primary);">
            <div style="display: flex; align-items: center; gap: 0.65rem;">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#0B5ED7" stroke-width="2">
                <path
                  d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
              </svg>
              <span><strong>Tel:</strong> {{ \App\Models\Setting::get('dubai_phone', '+971 4 238 8455') }}</span>
            </div>
            <div style="display: flex; align-items: center; gap: 0.65rem;">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#0B5ED7" stroke-width="2">
                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                <polyline points="22,6 12,13 2,6" />
              </svg>
              <span><strong>Email:</strong> {{ \App\Models\Setting::get('general_email', 'info@structurflex.ae') }}</span>
            </div>
            <div style="display: flex; align-items: center; gap: 0.65rem;">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#0B5ED7" stroke-width="2">
                <circle cx="12" cy="12" r="10" />
                <polyline points="12 6 12 12 16 14" />
              </svg>
              <span><strong>Hours:</strong> Mon - Fri: 8:00 AM - 5:30 PM (GST)</span>
            </div>
          </div>
        </div>

        <div style="border-top: 1px solid #cbd5e1; padding-top: 1.5rem; margin-top: 1.5rem;">
          <span
            style="font-size: 0.72rem; font-weight: 800; color: #008E38; text-transform: uppercase; letter-spacing: 0.8px;">Licensed
            &amp; Accredited</span>
          <p style="font-size: 0.78rem; color: var(--text-muted); margin-top: 0.25rem;">Dubai Economy Commercial
            License &amp; UAE Ministry of Public Works Strategic Registered Contractor.</p>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
