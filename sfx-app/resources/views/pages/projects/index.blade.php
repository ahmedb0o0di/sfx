@extends('layouts.app')

@section('title', 'Projects Portfolio | ' . \App\Models\Setting::get('site_name'))
@section('description', 'Explore real executed tensile membrane projects by Structurflex Middle East across MENA and globally: Al Jamea ETFE, Al Janah Pavilion, Unity Park, Abu Dhabi Shooting Club, and more.')

@section('content')
<!-- Subpage Banner -->
<section class="page-header-banner" style="background: #081C38; color: #fff; padding: 7.5rem 0 4.5rem; position: relative; overflow: hidden;">
  <div class="container" style="position: relative; z-index: 2;">
    <div class="breadcrumbs" style="margin-top: 1.5rem; margin-bottom: 1.5rem; font-size: 0.85rem; color: #94a3b8;">
      <a href="{{ route('home') }}" style="color: #cbd5e1; text-decoration: none;">Home</a>
      <span style="margin: 0 0.5rem;">/</span>
      <span style="color: #f3b90d;">Projects Portfolio</span>
    </div>
    <span class="section-tag" style="background: rgba(255, 255, 255, 0.12); color: #f3b90d; border: 1px solid rgba(255, 255, 255, 0.2); font-weight: 700; font-size: 0.78rem; text-transform: uppercase; letter-spacing: 1px; padding: 0.35rem 0.9rem; border-radius: 999px;">
      {{ \App\Models\Setting::get('stat_projects', '9,000+') }} Completed Projects Globally
    </span>
    <h1 class="page-banner-title" style="font-size: 2.85rem; font-weight: 800; color: #ffffff; margin: 1rem 0 0.75rem;">Executed Tensile &amp; Lightweight Structures</h1>
    <p class="page-banner-subtitle" style="font-size: 1.15rem; color: #cbd5e1; max-width: 720px; line-height: 1.6;">
      Explore verified commissions across the United Arab Emirates, Eastern Africa, Saudi Arabia, and international landmark sites. Sourced directly from official SFXMEC project archives.
    </p>
  </div>
</section>

<!-- Projects Portfolio Grid & Filters -->
<section class="section" style="background-color: #F4F6F9; padding: 5.5rem 0;">
  <div class="container">
    <!-- Filter Controls -->
    <div class="portfolio-filter-bar" style="display: flex; gap: 0.75rem; justify-content: center; flex-wrap: wrap; margin-bottom: 3rem;">
      <a href="{{ route('projects.index') }}" class="filter-btn {{ !$selectedCategory || $selectedCategory == 'all' ? 'active' : '' }}" style="text-decoration: none;">All Projects</a>
      @foreach($categories as $cat)
        <a href="{{ route('projects.index', ['category' => $cat->filter_tag]) }}" class="filter-btn {{ $selectedCategory == $cat->filter_tag ? 'active' : '' }}" style="text-decoration: none;">
          {{ $cat->name }}
        </a>
      @endforeach
    </div>

    <!-- Projects Grid -->
    <div class="projects-showcase-grid">
      @forelse($projects as $project)
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
          <p style="font-size: 0.84rem; color: var(--text-muted); line-height: 1.5; margin-bottom: 1rem;">
            {{ $project->short_description }}
          </p>
          <div class="project-showcase-meta">
            <span>{{ $project->client_name ?? 'SFXMEC EPC' }}</span>
            <span>{{ $project->covered_area }}</span>
          </div>
        </div>
      </article>
      @empty
      <div style="grid-column: 1 / -1; text-align: center; padding: 4rem 2rem; background: #fff; border-radius: 12px;">
        <p style="font-size: 1.1rem; color: #64748b;">No projects found for this category.</p>
        <a href="{{ route('projects.index') }}" class="btn btn-hero-white" style="margin-top: 1rem;">View All Projects</a>
      </div>
      @endforelse
    </div>
  </div>
</section>

<!-- Bottom Scope Estimator CTA -->
<section style="background: #081C38; color: #fff; padding: 4.5rem 0; text-align: center;">
  <div class="container">
    <h2 style="font-size: 2rem; font-weight: 800; color: #fff; margin-bottom: 0.75rem;">Planning a Tensile or Air Dome Project?</h2>
    <p style="color: #cbd5e1; max-width: 600px; margin: 0 auto 2rem; font-size: 1rem;">Our computational engineers can review your preliminary drawings, analyze span parameters, and provide budget estimations.</p>
    <button type="button" class="btn btn-request-consult" style="padding: 1rem 2.25rem;" onclick="document.getElementById('estimatorModal').style.display='flex'">
      <span>Open Scope &amp; Cost Estimator</span>
      <span>&rarr;</span>
    </button>
  </div>
</section>
@endsection
