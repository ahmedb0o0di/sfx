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
      @foreach($services as $service)
      <article class="solution-hub-card" id="solution-{{ $service->slug }}">
        <a href="{{ route('services.show', $service->slug) }}" class="solution-img-holder" style="display: block;">
          <img src="{{ $service->image_url }}"
            alt="{{ $service->title }}" loading="lazy">
          @if(!empty($service->badge_text))
          <span class="solution-tag-badge" @if(str_contains(strtolower($service->badge_text), 'asati')) style="background: #0B5ED7;" @endif>{{ $service->badge_text }}</span>
          @endif
        </a>
        <div class="solution-card-body">
          <h3>
            <a href="{{ route('services.show', $service->slug) }}" style="color: inherit; text-decoration: none;">
              {{ $service->title }}
            </a>
          </h3>
          <p>{{ $service->summary }}</p>
          <div class="solution-card-actions">
            <a href="{{ route('services.show', $service->slug) }}" class="solution-card-link" style="width: 100%; justify-content: space-between; text-decoration: none;">
              <span>View Specs &amp; Photos</span>
              <span>&rarr;</span>
            </a>
          </div>
        </div>
      </article>
      @endforeach

      <!-- Lead Gen Action Card -->
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
            <span>&rarr;</span>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ==========================================================================
     SECTION: 3D MOTION GRAPHIC STADIUM ("Tensile roofs, built for real places")
     ========================================================================== -->
@include('components.stadium-section')

@include('components.capabilities-section')

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
    <div class="portfolio-filter-bar">
      <button type="button" class="filter-btn active" data-filter="all">All Projects</button>
      @foreach($categories as $cat)
        <button type="button" class="filter-btn" data-filter="{{ $cat->filter_tag }}">{{ $cat->name }}</button>
      @endforeach
    </div>

    <!-- 4-Column Projects Showcase Grid -->
    <div class="projects-showcase-grid">
      @forelse($allProjects as $project)
      <article class="project-showcase-card"
        data-category="{{ $project->category ? $project->category->filter_tag : 'architectural' }}"
        data-id="{{ $project->slug }}"
        data-url="{{ route('projects.show', $project->slug) }}"
        data-title="{{ $project->title }}"
        data-category-label="{{ $project->category ? $project->category->name : 'Architectural' }}"
        data-location="{{ $project->location }}"
        data-client="{{ $project->client_name ?? 'SFXMEC EPC' }}"
        data-area="{{ $project->covered_area }}"
        data-material="{{ $project->membrane_material }}"
        data-year="{{ $project->year_completed }}"
        data-image="{{ $project->image_url }}"
        data-gallery="{{ json_encode($project->gallery_urls) }}"
        style="cursor: pointer;"
        onclick="if (window.innerWidth <= 992) { window.location.href = '{{ route('projects.show', $project->slug) }}'; }">
        <div class="project-showcase-img">
          <img src="{{ $project->image_url }}" alt="{{ $project->title }}" loading="lazy">
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

      <!-- Client-Side Empty State for Filters -->
      <div class="portfolio-empty-state" style="display: none; grid-column: 1 / -1; text-align: center; padding: 4rem 2rem; background: #fff; border-radius: 12px; border: 1px dashed #cbd5e1;">
        <p style="font-size: 1.1rem; color: #64748b; margin-bottom: 1rem;">No projects found for this category.</p>
        <button type="button" class="btn btn-hero-solid" style="background: transparent; color: var(--navy-primary) !important; border: 2px solid var(--navy-primary);" onclick="document.querySelector('.portfolio-filter-bar .filter-btn[data-filter=\'all\']').click();">View All Projects</button>
      </div>
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
        <a href="{{ route('blog.show', $post->slug) }}" class="insight-thumb" style="display: block; text-decoration: none; position: relative;">
          <img src="{{ $post->image_url }}" alt="{{ $post->title }}" loading="lazy">
          @if(!empty($post->video_path))
          <span style="position: absolute; bottom: 12px; right: 12px; background: rgba(8, 28, 56, 0.88); color: #f3b90d; border-radius: 999px; padding: 4px 10px; font-size: 0.75rem; font-weight: 700; display: inline-flex; align-items: center; gap: 4px; backdrop-filter: blur(4px); box-shadow: 0 2px 6px rgba(0,0,0,0.3);">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg> Video
          </span>
          @endif
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
    <div class="career-rows-container" id="career-rows-container" style="display: flex; flex-direction: column; gap: 1.75rem;">
      @forelse($careers as $career)
      <article class="career-row-card career-item" data-career-index="{{ $loop->index }}" style="{{ $loop->index >= 3 ? 'display: none;' : '' }}">
        <!-- Left: Image (clickable) -->
        <a href="{{ route('careers.show', $career->slug) }}" class="career-row-media" style="display: block; text-decoration: none;">
          <img src="{{ $career->image_url }}" alt="{{ $career->title }}" loading="lazy">
          <span class="career-badge-type">
            {{ $career->type ?? 'Full-time' }}
          </span>
        </a>

        <!-- Middle: Title, Badges & Job Description -->
        <div class="career-row-content">
          <div class="career-row-meta">
            @if(!empty($career->department))
            <span class="career-badge-dept">
              {{ $career->department }}
            </span>
            @endif
            @if(!empty($career->location))
            <span class="career-meta-location">
              📍 {{ $career->location }}
            </span>
            @endif
          </div>

          <h3 class="career-row-title">
            <a href="{{ route('careers.show', $career->slug) }}" style="color: inherit; text-decoration: none;">
              {{ $career->title }}
            </a>
          </h3>

          <p class="career-row-desc">
            {{ $career->description }}
          </p>
        </div>

        <!-- Right: Actions -->
        <div class="career-row-action">
          <a href="{{ route('careers.show', $career->slug) }}" class="btn btn-primary btn-apply">
            <span>View Role &amp; Apply</span>
            <span>&rarr;</span>
          </a>
          <button type="button" onclick="openCareerApplyModal({{ $career->id }}, '{{ addslashes($career->title) }}')" class="btn btn-outline btn-quick-apply">
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

    @if($careers->count() > 3)
    <!-- Careers Pagination Controls -->
    <nav class="career-pagination-nav" id="career-pagination" aria-label="Career Openings Pagination">
      <button type="button" class="career-page-btn career-page-prev" id="career-prev-btn" aria-label="Previous Page" disabled>
        <span aria-hidden="true">&larr;</span>
        <span>Previous</span>
      </button>

      <div class="career-page-numbers" id="career-page-numbers" role="navigation" aria-label="Page Numbers"></div>

      <button type="button" class="career-page-btn career-page-next" id="career-next-btn" aria-label="Next Page">
        <span>Next</span>
        <span aria-hidden="true">&rarr;</span>
      </button>
    </nav>
    @endif
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
                @foreach($services as $srvItem)
                <option value="{{ $srvItem->title }}">{{ $srvItem->title }}</option>
                @endforeach
                <option value="Custom Engineering / Other">Custom Engineering / Other</option>
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

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  initCareerPagination();
});

function initCareerPagination() {
  const container = document.getElementById('career-rows-container');
  if (!container) return;

  const items = Array.from(container.querySelectorAll('.career-item'));
  const totalItems = items.length;
  const itemsPerPage = 3;

  const paginationNav = document.getElementById('career-pagination');
  const prevBtn = document.getElementById('career-prev-btn');
  const nextBtn = document.getElementById('career-next-btn');
  const numbersContainer = document.getElementById('career-page-numbers');

  // If items are 3 or less, hide pagination and show all items
  if (totalItems <= itemsPerPage) {
    if (paginationNav) {
      paginationNav.style.display = 'none';
    }
    items.forEach(function (item) {
      item.style.display = '';
    });
    return;
  }

  if (!paginationNav || !prevBtn || !nextBtn || !numbersContainer) return;

  paginationNav.style.display = 'flex';
  const totalPages = Math.ceil(totalItems / itemsPerPage);
  let currentPage = 1;

  function renderPage(page, shouldScroll) {
    currentPage = page;
    const startIndex = (page - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;

    items.forEach(function (item, index) {
      if (index >= startIndex && index < endIndex) {
        item.style.display = '';
        item.classList.remove('animating-in');
        // Force reflow for CSS animation
        void item.offsetWidth;
        item.classList.add('animating-in');
      } else {
        item.style.display = 'none';
        item.classList.remove('animating-in');
      }
    });

    prevBtn.disabled = (currentPage === 1);
    nextBtn.disabled = (currentPage === totalPages);

    renderPageNumbers();

    if (shouldScroll) {
      const careersSection = document.getElementById('careers');
      if (careersSection) {
        const rect = careersSection.getBoundingClientRect();
        if (rect.top < 0 || rect.top > window.innerHeight * 0.4) {
          careersSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
      }
    }
  }

  function renderPageNumbers() {
    numbersContainer.innerHTML = '';
    for (let p = 1; p <= totalPages; p++) {
      const numBtn = document.createElement('button');
      numBtn.type = 'button';
      numBtn.className = 'career-page-num' + (p === currentPage ? ' active' : '');
      numBtn.setAttribute('aria-label', 'Go to page ' + p);
      if (p === currentPage) {
        numBtn.setAttribute('aria-current', 'page');
      }
      numBtn.textContent = p;
      numBtn.addEventListener('click', function () {
        if (p !== currentPage) {
          renderPage(p, true);
        }
      });
      numbersContainer.appendChild(numBtn);
    }
  }

  prevBtn.addEventListener('click', function () {
    if (currentPage > 1) {
      renderPage(currentPage - 1, true);
    }
  });

  nextBtn.addEventListener('click', function () {
    if (currentPage < totalPages) {
      renderPage(currentPage + 1, true);
    }
  });

  renderPage(1, false);
}
</script>
@endpush
