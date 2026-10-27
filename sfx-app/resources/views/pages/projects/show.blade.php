@extends('layouts.app')

@section('title', $project->title . ' | Case Study | ' . \App\Models\Setting::get('site_name', 'Structurflex Middle East'))
@section('description', Str::limit(strip_tags($project->full_overview ?? $project->short_description), 160))

@section('content')
<!-- Project Hero Header -->
<section class="project-details-hero">
  <div class="container" style="position: relative; z-index: 2;">
    
    <!-- Breadcrumbs & Quick Back Navigation -->
    <div class="project-hero-breadcrumbs">
      <a href="{{ route('projects.index') }}" style="display: inline-flex; align-items: center; gap: 0.35rem; color: #f3b90d; font-weight: 700; margin-right: 0.5rem; text-decoration: none;">
        <span>&larr;</span> <span>All Projects</span>
      </a>
      <span style="opacity: 0.5;">/</span>
      <a href="{{ route('home') }}">Home</a>
      <span style="opacity: 0.5;">/</span>
      <span style="color: #cbd5e1; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 280px;">{{ $project->title }}</span>
    </div>

    <!-- Meta Badges Row -->
    <div class="project-hero-meta-row">
      <span class="section-tag" style="background: rgba(243, 185, 13, 0.15); color: #f3b90d; border: 1px solid rgba(243, 185, 13, 0.3); font-weight: 700; font-size: 0.78rem; text-transform: uppercase; padding: 0.3rem 0.85rem; border-radius: 999px;">
        {{ $project->category ? $project->category->name : 'Architectural' }}
      </span>
      <span style="font-size: 0.82rem; color: #94a3b8; background: rgba(255,255,255,0.08); padding: 0.3rem 0.75rem; border-radius: 999px; border: 1px solid rgba(255,255,255,0.12);">
        Handover: {{ $project->year_completed ?? 'Verified Record' }}
      </span>
      <span style="font-size: 0.82rem; color: #94a3b8; background: rgba(255,255,255,0.08); padding: 0.3rem 0.75rem; border-radius: 999px; border: 1px solid rgba(255,255,255,0.12);">
        📍 {{ $project->location }}
      </span>
    </div>

    <h1 class="project-hero-title">
      {{ $project->title }}
    </h1>

    <p class="project-hero-desc">
      {{ $project->short_description }}
    </p>

  </div>
</section>

<!-- Main Case Study Content -->
<section class="project-details-section">
  <div class="container">
    <div class="project-details-grid">
      
      <!-- Left Column: Lead Media, Quick Specs & Technical Narrative -->
      <div>
        
        <!-- Main Lead Photo Showcase -->
        <div class="project-lead-showcase">
          <img id="projectLeadImg" src="{{ asset($project->thumbnail_image) }}" alt="{{ $project->title }}" loading="eager">
          <span class="project-location-badge" style="position: absolute; bottom: 1rem; left: 1rem; z-index: 2; font-size: 0.82rem; padding: 0.4rem 0.85rem; box-shadow: 0 4px 12px rgba(0,0,0,0.3);">
            📍 {{ $project->location }}
          </span>
        </div>

        <!-- Interactive Photo Gallery Strip (Allows switching lead image on touch/click) -->
        @php
          $allImages = collect([$project->thumbnail_image]);
          if ($project->images && $project->images->count() > 0) {
              $allImages = $allImages->merge($project->images->pluck('image_path'))->unique();
          }
        @endphp

        @if($allImages->count() > 1)
        <div class="project-gallery-strip" id="projectGalleryStrip">
          @foreach($allImages as $idx => $imgPath)
          <button type="button" class="project-gallery-thumb {{ $idx === 0 ? 'active' : '' }}" onclick="switchProjectImage('{{ asset($imgPath) }}', this)" aria-label="View photo {{ $idx + 1 }}">
            <img src="{{ asset($imgPath) }}" alt="{{ $project->title }} angle {{ $idx + 1 }}" loading="lazy">
          </button>
          @endforeach
        </div>
        @endif

        <!-- Mobile Quick Specs Matrix (Visible only on small screens <= 992px) -->
        <div class="project-mobile-quick-specs">
          <div class="mobile-spec-pill">
            <span class="pill-lbl">Covered Area</span>
            <span class="pill-val" style="color: #f3b90d;">{{ $project->covered_area }}</span>
          </div>
          <div class="mobile-spec-pill">
            <span class="pill-lbl">Membrane</span>
            <span class="pill-val">{{ $project->membrane_material }}</span>
          </div>
          <div class="mobile-spec-pill">
            <span class="pill-lbl">Client / Authority</span>
            <span class="pill-val">{{ $project->client_name ?? 'Confidential' }}</span>
          </div>
          <div class="mobile-spec-pill">
            <span class="pill-lbl">Delivery Model</span>
            <span class="pill-val" style="color: #059669;">Turnkey EPC</span>
          </div>
        </div>

        <!-- Case Study Narrative Card -->
        <div class="project-content-card">
          <h2>
            Engineering Scope &amp; Structural Architecture
          </h2>
          
          <div style="font-size: 1rem; color: #475569; line-height: 1.8; margin-bottom: 2rem;">
            {!! nl2br(e($project->full_overview ?? $project->short_description)) !!}
          </div>

          @if($project->structural_challenge)
          <div style="background: #FFFBEB; border-left: 4px solid #f3b90d; padding: 1.25rem 1.5rem; border-radius: 0 10px 10px 0; margin-bottom: 1.5rem;">
            <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.4rem;">
              <span style="font-size: 1.1rem;">⚠️</span>
              <h3 style="font-size: 1.05rem; font-weight: 800; color: #92400E; margin: 0;">The Structural Challenge</h3>
            </div>
            <p style="font-size: 0.94rem; color: #78350F; line-height: 1.6; margin: 0;">
              {{ $project->structural_challenge }}
            </p>
          </div>
          @endif

          @if($project->engineering_solution)
          <div style="background: #F0F9FF; border-left: 4px solid #0284c7; padding: 1.25rem 1.5rem; border-radius: 0 10px 10px 0;">
            <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.4rem;">
              <span style="font-size: 1.1rem;">⚡</span>
              <h3 style="font-size: 1.05rem; font-weight: 800; color: #0369A1; margin: 0;">The SFXMEC Engineering Solution</h3>
            </div>
            <p style="font-size: 0.94rem; color: #0C4A6E; line-height: 1.6; margin: 0;">
              {{ $project->engineering_solution }}
            </p>
          </div>
          @endif
        </div>

      </div>

      <!-- Right Column: Fast Specs Sidebar & Direct Consultation -->
      <div>
        
        <div class="project-specs-sidebar">
          <h3 style="font-size: 1.25rem; font-weight: 800; color: var(--navy-primary); margin-bottom: 1.25rem; border-bottom: 2px solid #f1f5f9; padding-bottom: 0.75rem; display: flex; justify-content: space-between; align-items: center;">
            <span>Project Specifications</span>
            <span style="font-size: 0.72rem; color: #64748b; font-weight: 600; text-transform: uppercase;">EPC Record</span>
          </h3>

          <ul class="project-specs-list">
            <li class="project-spec-item">
              <span class="project-spec-label">Location:</span>
              <span class="project-spec-value">{{ $project->location }}</span>
            </li>
            <li class="project-spec-item">
              <span class="project-spec-label">Covered Area:</span>
              <span class="project-spec-value" style="color: #f3b90d;">{{ $project->covered_area }}</span>
            </li>
            <li class="project-spec-item">
              <span class="project-spec-label">Membrane Material:</span>
              <span class="project-spec-value">{{ $project->membrane_material }}</span>
            </li>
            <li class="project-spec-item">
              <span class="project-spec-label">Client / Authority:</span>
              <span class="project-spec-value">{{ $project->client_name ?? 'Confidential' }}</span>
            </li>
            <li class="project-spec-item">
              <span class="project-spec-label">Handover Year:</span>
              <span class="project-spec-value">{{ $project->year_completed ?? 'Verified Record' }}</span>
            </li>
            <li class="project-spec-item" style="border-bottom: none;">
              <span class="project-spec-label">Contract Scope:</span>
              <span class="project-spec-value" style="color: #059669;">Turnkey EPC</span>
            </li>
          </ul>

          <div style="margin-top: 1.75rem;">
            <a href="{{ route('contact.index', ['inquiry' => 'project-' . $project->slug]) }}" class="btn btn-request-consult" style="width: 100%; justify-content: center; padding: 0.95rem; text-decoration: none;">
              <span>Inquire About Similar Scope</span>
              <span>&rarr;</span>
            </a>
          </div>

          <div style="margin-top: 1.25rem; padding-top: 1.25rem; border-top: 1px solid #f1f5f9; text-align: center;">
            <span style="font-size: 0.78rem; color: #64748b; display: block; margin-bottom: 0.25rem;">Direct Engineering Desk:</span>
            <a href="tel:+97142388455" style="color: var(--navy-primary); font-weight: 800; font-size: 0.98rem; text-decoration: none;">
              📞 +971 4 238 8455
            </a>
          </div>
        </div>

        <!-- Estimator Widget Card -->
        <div style="background: #081C38; border-radius: 14px; padding: clamp(1.5rem, 3vw, 2rem); color: #fff; text-align: center; box-shadow: 0 10px 25px rgba(8, 28, 56, 0.15);">
          <span style="font-size: 1.75rem; display: block; margin-bottom: 0.5rem;">📐</span>
          <h4 style="font-size: 1.2rem; font-weight: 800; color: #fff; margin-bottom: 0.5rem;">Estimate Similar Structure</h4>
          <p style="font-size: 0.88rem; color: #cbd5e1; line-height: 1.5; margin-bottom: 1.5rem;">
            Calculate membrane tonnage and turnaround timeline for your footprint.
          </p>
          <button type="button" class="btn btn-hero-white" style="width: 100%; justify-content: center;" onclick="document.getElementById('estimatorModal').style.display='flex'">
            <span>Launch Estimator</span>
          </button>
        </div>

      </div>

    </div>

    <!-- Related Projects Section -->
    @if(isset($relatedProjects) && $relatedProjects->count() > 0)
    <div style="margin-top: 4.5rem; border-top: 1px solid #e2e8f0; padding-top: 3.5rem;">
      <div style="text-align: center; margin-bottom: 2.5rem;">
        <span class="section-tag" style="background: #edf4fd; color: #0B5ED7; border: 1px solid rgba(11, 94, 215, 0.25); font-weight: 700; font-size: 0.78rem; text-transform: uppercase; letter-spacing: 1px; padding: 0.35rem 0.9rem; border-radius: 999px;">
          Proven Heritage
        </span>
        <h3 style="font-size: clamp(1.4rem, 3vw, 1.85rem); font-weight: 800; color: var(--navy-primary); margin: 0.75rem 0 0;">
          Related Executed Structures
        </h3>
      </div>

      <div class="projects-showcase-grid">
        @foreach($relatedProjects as $rel)
        <article class="project-showcase-card"
          data-category="{{ $rel->category ? $rel->category->filter_tag : 'architectural' }}"
          data-id="{{ $rel->slug }}"
          data-url="{{ route('projects.show', $rel->slug) }}"
          style="cursor: pointer;"
          onclick="window.location.href = '{{ route('projects.show', $rel->slug) }}';">
          <div class="project-showcase-img">
            <img src="{{ asset($rel->thumbnail_image) }}" alt="{{ $rel->title }}" loading="lazy">
            <span class="project-location-badge">{{ $rel->location }}</span>
          </div>
          <div class="project-showcase-body">
            <span class="project-showcase-category">{{ $rel->category ? $rel->category->name : 'Architectural' }}</span>
            <h4 class="project-showcase-title">
              <a href="{{ route('projects.show', $rel->slug) }}" style="color: inherit; text-decoration: none;">
                {{ $rel->title }}
              </a>
            </h4>
            <div class="project-showcase-meta">
              <span>{{ $rel->client_name ?? 'SFXMEC EPC' }}</span>
              <span>{{ $rel->covered_area }}</span>
            </div>
          </div>
        </article>
        @endforeach
      </div>
    </div>
    @endif

  </div>
</section>

<!-- Mobile Sticky Bottom Action Bar (<= 768px) -->
<aside class="project-mobile-action-bar" aria-label="Mobile quick actions">
  <div class="action-inner">
    <a href="tel:+97142388455" class="btn" style="background: #f1f5f9; color: var(--navy-primary); border: 1px solid #cbd5e1; padding: 0.75rem 1rem; border-radius: 8px; font-weight: 700; font-size: 0.85rem; text-decoration: none; flex: 0 0 auto; display: flex; align-items: center; justify-content: center;">
      <span>📞 Call</span>
    </a>
    <a href="{{ route('contact.index', ['inquiry' => 'project-' . $project->slug]) }}" class="btn btn-request-consult" style="flex: 1; justify-content: center; padding: 0.75rem 1rem; font-size: 0.88rem; text-decoration: none;">
      <span>Inquire Scope &rarr;</span>
    </a>
  </div>
</aside>

@push('scripts')
<script>
  function switchProjectImage(newSrc, thumbBtn) {
    const leadImg = document.getElementById('projectLeadImg');
    if (!leadImg || !newSrc) return;
    
    leadImg.style.opacity = '0.4';
    setTimeout(() => {
      leadImg.src = newSrc;
      leadImg.style.opacity = '1';
    }, 120);

    const strip = document.getElementById('projectGalleryStrip');
    if (strip) {
      strip.querySelectorAll('.project-gallery-thumb').forEach(b => b.classList.remove('active'));
    }
    if (thumbBtn) {
      thumbBtn.classList.add('active');
    }
  }
</script>
@endpush
@endsection
