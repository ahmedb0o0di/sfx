@extends('layouts.app')

@section('title', $project->title . ' | Case Study | ' . \App\Models\Setting::get('site_name'))
@section('description', Str::limit(strip_tags($project->full_overview ?? $project->short_description), 160))

@section('content')
<!-- Project Hero Header -->
<section style="background: #081C38; color: #fff; padding: 7.5rem 0 4.5rem; position: relative; overflow: hidden;">
  <div class="container" style="position: relative; z-index: 2;">
    <div class="breadcrumbs" style="margin-top: 1.5rem; margin-bottom: 1.5rem; font-size: 0.85rem; color: #94a3b8;">
      <a href="{{ route('home') }}" style="color: #cbd5e1; text-decoration: none;">Home</a>
      <span style="margin: 0 0.5rem;">/</span>
      <a href="{{ route('projects.index') }}" style="color: #cbd5e1; text-decoration: none;">Projects</a>
      <span style="margin: 0 0.5rem;">/</span>
      <span style="color: #f3b90d;">{{ $project->title }}</span>
    </div>

    <div style="display: flex; gap: 0.75rem; align-items: center; margin-bottom: 1rem;">
      <span class="section-tag" style="background: rgba(255, 255, 255, 0.12); color: #f3b90d; border: 1px solid rgba(255, 255, 255, 0.2); font-weight: 700; font-size: 0.78rem; text-transform: uppercase; padding: 0.35rem 0.9rem; border-radius: 999px;">
        {{ $project->category ? $project->category->name : 'Architectural' }}
      </span>
      <span style="font-size: 0.85rem; color: #94a3b8;">Handover: {{ $project->year_completed ?? 'Verified' }}</span>
    </div>

    <h1 style="font-size: 2.85rem; font-weight: 800; color: #ffffff; margin: 0 0 1rem; line-height: 1.2;">
      {{ $project->title }}
    </h1>
    <p style="font-size: 1.15rem; color: #cbd5e1; max-width: 780px; line-height: 1.6;">
      {{ $project->short_description }}
    </p>
  </div>
</section>

<!-- Main Case Study Content -->
<section class="section" style="background-color: #F8FAFC; padding: 5rem 0;">
  <div class="container">
    <div style="display: grid; grid-template-columns: 1.3fr 0.7fr; gap: 3rem; align-items: start;">
      
      <!-- Left Column: Media & Technical Case Study -->
      <div>
        <!-- Main Lead Photo -->
        <div style="border-radius: 12px; overflow: hidden; box-shadow: 0 15px 35px rgba(0,0,0,0.1); margin-bottom: 2rem;">
          <img src="{{ asset($project->thumbnail_image) }}" alt="{{ $project->title }}" style="width: 100%; height: auto; display: block;">
        </div>

        <!-- Project Photo Gallery -->
        @if($project->images->count() > 1)
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin-bottom: 2.5rem;">
          @foreach($project->images as $img)
          <div style="border-radius: 8px; overflow: hidden; height: 140px; border: 1px solid #e2e8f0;">
            <a href="{{ asset($img->image_path) }}" target="_blank" rel="noopener noreferrer">
              <img src="{{ asset($img->image_path) }}" alt="{{ $project->title }} Gallery Photo" style="width: 100%; height: 100%; object-fit: cover;">
            </a>
          </div>
          @endforeach
        </div>
        @endif

        <!-- Case Study Narrative -->
        <div style="background: #ffffff; border-radius: 12px; padding: 2.5rem; border: 1px solid #e2e8f0; margin-bottom: 2rem;">
          <h2 style="font-size: 1.65rem; font-weight: 800; color: var(--navy-primary); margin-bottom: 1rem;">
            Engineering Case Study &amp; Technical Scope
          </h2>
          <p style="font-size: 1rem; color: #475569; line-height: 1.8; margin-bottom: 1.5rem;">
            {{ $project->full_overview ?? $project->short_description }}
          </p>

          @if($project->structural_challenge)
          <div style="background: #F1F5F9; border-left: 4px solid #f3b90d; padding: 1.5rem; border-radius: 0 8px 8px 0; margin-bottom: 1.5rem;">
            <h4 style="font-size: 1.05rem; font-weight: 800; color: var(--navy-primary); margin-bottom: 0.4rem;">The Structural Challenge</h4>
            <p style="font-size: 0.92rem; color: #475569; line-height: 1.6; margin: 0;">{{ $project->structural_challenge }}</p>
          </div>
          @endif

          @if($project->engineering_solution)
          <div style="background: rgba(2, 132, 199, 0.06); border-left: 4px solid #0284c7; padding: 1.5rem; border-radius: 0 8px 8px 0;">
            <h4 style="font-size: 1.05rem; font-weight: 800; color: var(--navy-primary); margin-bottom: 0.4rem;">The SFXMEC Engineering Solution</h4>
            <p style="font-size: 0.92rem; color: #475569; line-height: 1.6; margin: 0;">{{ $project->engineering_solution }}</p>
          </div>
          @endif
        </div>
      </div>

      <!-- Right Column: Fast Facts & RFP Inquiry -->
      <div>
        <div style="background: #ffffff; border-radius: 12px; padding: 2rem; border: 1px solid #e2e8f0; box-shadow: 0 10px 25px rgba(0,0,0,0.04); margin-bottom: 2rem;">
          <h3 style="font-size: 1.25rem; font-weight: 800; color: var(--navy-primary); margin-bottom: 1.25rem; border-bottom: 2px solid #f1f5f9; padding-bottom: 0.75rem;">
            Project Specifications
          </h3>

          <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 1rem; font-size: 0.9rem;">
            <li style="display: flex; justify-content: space-between; border-bottom: 1px solid #f8fafc; padding-bottom: 0.5rem;">
              <span style="color: #64748b;">Location:</span>
              <strong style="color: var(--navy-primary);">{{ $project->location }}</strong>
            </li>
            <li style="display: flex; justify-content: space-between; border-bottom: 1px solid #f8fafc; padding-bottom: 0.5rem;">
              <span style="color: #64748b;">Covered Area:</span>
              <strong style="color: #f3b90d;">{{ $project->covered_area }}</strong>
            </li>
            <li style="display: flex; justify-content: space-between; border-bottom: 1px solid #f8fafc; padding-bottom: 0.5rem;">
              <span style="color: #64748b;">Material:</span>
              <strong style="color: var(--navy-primary);">{{ $project->membrane_material }}</strong>
            </li>
            <li style="display: flex; justify-content: space-between; border-bottom: 1px solid #f8fafc; padding-bottom: 0.5rem;">
              <span style="color: #64748b;">Client / Authority:</span>
              <strong style="color: var(--navy-primary);">{{ $project->client_name ?? 'Confidential' }}</strong>
            </li>
            <li style="display: flex; justify-content: space-between; border-bottom: 1px solid #f8fafc; padding-bottom: 0.5rem;">
              <span style="color: #64748b;">Handover Year:</span>
              <strong style="color: var(--navy-primary);">{{ $project->year_completed ?? 'Verified Record' }}</strong>
            </li>
            <li style="display: flex; justify-content: space-between;">
              <span style="color: #64748b;">Contract Delivery:</span>
              <strong style="color: #059669;">Turnkey EPC</strong>
            </li>
          </ul>

          <div style="margin-top: 2rem;">
            <a href="{{ route('contact.index', ['inquiry' => 'project-' . $project->slug]) }}" class="btn btn-request-consult" style="width: 100%; justify-content: center; padding: 0.95rem;">
              <span>Inquire About Similar Scope</span>
              <span>&rarr;</span>
            </a>
          </div>
        </div>

        <!-- Estimator Widget Card -->
        <div style="background: #081C38; border-radius: 12px; padding: 2rem; color: #fff; text-align: center;">
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

    <!-- Related Projects -->
    @if(isset($relatedProjects) && $relatedProjects->count() > 0)
    <div style="margin-top: 4rem; border-top: 1px solid #e2e8f0; padding-top: 3.5rem;">
      <h3 style="font-size: 1.65rem; font-weight: 800; color: var(--navy-primary); margin-bottom: 2rem; text-align: center;">
        Related Executed Structures
      </h3>
      <div class="projects-showcase-grid">
        @foreach($relatedProjects as $rel)
        <article class="project-showcase-card" style="cursor: pointer;" onclick="window.location='{{ route('projects.show', $rel->slug) }}'">
          <div class="project-showcase-img">
            <img src="{{ asset($rel->thumbnail_image) }}" alt="{{ $rel->title }}" loading="lazy">
            <span class="project-location-badge">{{ $rel->location }}</span>
          </div>
          <div class="project-showcase-body">
            <span class="project-showcase-category">{{ $rel->category ? $rel->category->name : 'Architectural' }}</span>
            <h4 class="project-showcase-title">{{ $rel->title }}</h4>
            <div class="project-showcase-meta">
              <span>{{ $rel->client_name }}</span>
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
@endsection
