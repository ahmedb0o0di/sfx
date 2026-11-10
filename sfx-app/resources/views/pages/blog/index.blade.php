@extends('layouts.app')

@section('title', 'Insights & Engineering Whitepapers | ' . \App\Models\Setting::get('site_name', 'Structurflex ME'))
@section('description', 'Peer-reviewed research on non-linear FEA computational modeling, membrane aerodynamics, desert solar deflection, and air-supported dome technology.')

@section('content')
<!-- Subpage Banner -->
<section class="page-header-banner" style="background: #081C38; color: #fff; padding: clamp(5.5rem, 10vw, 7.5rem) 0 clamp(3rem, 6vw, 4.5rem); position: relative; overflow: hidden;">
  <div class="container" style="position: relative; z-index: 2;">
    <div class="breadcrumbs" style="margin-top: 1.5rem; margin-bottom: 1.25rem; font-size: 0.85rem; color: #94a3b8; display: flex; flex-wrap: wrap; align-items: center; gap: 0.35rem;">
      <a href="{{ route('home') }}" style="color: #cbd5e1; text-decoration: none;">Home</a>
      <span style="color: #64748b;">/</span>
      <span style="color: #f3b90d;">Insights &amp; Resources</span>
    </div>

    <span class="section-tag" style="background: rgba(255, 255, 255, 0.12); color: #f3b90d; border: 1px solid rgba(255, 255, 255, 0.2); font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; padding: 0.3rem 0.85rem; border-radius: 999px; display: inline-block;">
      Technical Knowledge Hub
    </span>

    <h1 class="page-banner-title" style="font-size: clamp(1.85rem, 5vw, 2.75rem); font-weight: 800; color: #ffffff; margin: 0.85rem 0 0.75rem; line-height: 1.25;">
      Engineering Whitepapers &amp; Architectural Insights
    </h1>

    <p class="page-banner-subtitle" style="font-size: clamp(0.95rem, 2.2vw, 1.15rem); color: #cbd5e1; max-width: 720px; line-height: 1.6; margin: 0;">
      Peer-reviewed research on non-linear FEA computational modeling, membrane aerodynamics, desert solar deflection, and air-supported dome technology.
    </p>
  </div>
</section>

<!-- Insights Grid Section -->
<section class="section insights-section" style="background-color: #F4F6F9; padding: 5rem 0;">
  <div class="container">

    <!-- Category Filter Bar (Touch-scrollable on mobile) -->
    @if(isset($categories) && count($categories) > 0)
    <div class="insights-filter-bar">
      <button type="button" class="insights-filter-btn {{ empty($selectedCategory) || $selectedCategory === 'all' ? 'active' : '' }}" data-filter="all">
        All Publications
      </button>
      @foreach($categories as $category)
      <button type="button" class="insights-filter-btn {{ $selectedCategory === $category ? 'active' : '' }}" data-filter="{{ $category }}">
        {{ $category }}
      </button>
      @endforeach
    </div>
    @endif

    <!-- Publications Matrix Grid (1 column on mobile, 2 columns on desktop) -->
    <div class="insights-matrix-grid">
      @forelse($posts as $post)
      <article class="insight-card" data-category="{{ $post->category }}">
        <div>
          <!-- Article Cover Media -->
          <a href="{{ route('blog.show', $post->slug) }}" class="insight-card-media" style="position: relative;">
            <img src="{{ $post->image_url }}" alt="{{ $post->title }}" loading="lazy">
            @if(!empty($post->video_path))
            <span style="position: absolute; bottom: 12px; right: 12px; background: rgba(8, 28, 56, 0.88); color: #f3b90d; border-radius: 999px; padding: 4px 10px; font-size: 0.75rem; font-weight: 700; display: inline-flex; align-items: center; gap: 4px; backdrop-filter: blur(4px); box-shadow: 0 2px 6px rgba(0,0,0,0.3);">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg> Video
            </span>
            @endif
          </a>

          <!-- Article Content -->
          <div class="insight-card-body">
            <div class="insight-card-meta">
              <span class="insight-card-badge">{{ $post->category }}</span>
              <span>⏱ {{ $post->reading_time_minutes ?? 6 }} Min Read</span>
            </div>

            <h3 class="insight-card-title">
              <a href="{{ route('blog.show', $post->slug) }}">
                {{ $post->title }}
              </a>
            </h3>

            <p class="insight-card-excerpt">
              {{ $post->excerpt }}
            </p>
          </div>
        </div>

        <!-- Article Card Footer -->
        <div class="insight-card-footer">
          <span class="insight-card-author">
            By {{ $post->author ?? 'Structurflex Technical Practice' }}
          </span>
          <a href="{{ route('blog.show', $post->slug) }}" class="insight-card-link">
            <span>Read Publication</span>
            <span>&rarr;</span>
          </a>
        </div>
      </article>
      @empty
      <div style="grid-column: 1 / -1; text-align: center; padding: 4rem 2rem; background: #ffffff; border-radius: 14px; border: 1px dashed #cbd5e1;">
        <h3 style="font-size: 1.3rem; font-weight: 800; color: var(--navy-primary); margin-bottom: 0.5rem;">
          No Publications Found
        </h3>
        <p style="color: #64748b; font-size: 0.95rem; margin-bottom: 1.5rem;">
          There are currently no whitepapers listed.
        </p>
        <a href="{{ route('blog.index') }}" class="btn btn-primary" style="padding: 0.75rem 1.5rem;">
          <span>View All Publications &rarr;</span>
        </a>
      </div>
      @endforelse

      <!-- Client-Side Empty State for Filters -->
      <div class="insights-empty-state" style="display: none; grid-column: 1 / -1; text-align: center; padding: 4rem 2rem; background: #ffffff; border-radius: 14px; border: 1px dashed #cbd5e1;">
        <h3 style="font-size: 1.3rem; font-weight: 800; color: var(--navy-primary); margin-bottom: 0.5rem;">
          No Publications Found
        </h3>
        <p style="color: #64748b; font-size: 0.95rem; margin-bottom: 1.5rem;">
          There are currently no whitepapers or articles listed under this category.
        </p>
        <button type="button" class="btn btn-hero-solid" style="background: transparent; color: var(--navy-primary) !important; border: 2px solid var(--navy-primary);" onclick="document.querySelector('.insights-filter-bar .insights-filter-btn[data-filter=\'all\']').click();">
          View All Publications &rarr;
        </button>
      </div>
    </div>

  </div>
</section>
@endsection
