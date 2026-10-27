@extends('layouts.app')

@section('title', 'Insights & Engineering Whitepapers | ' . \App\Models\Setting::get('site_name'))
@section('description', 'Peer-reviewed research on non-linear FEA computational modeling, membrane aerodynamics, desert solar deflection, and air-supported dome technology.')

@section('content')
<!-- Subpage Banner -->
<section class="page-header-banner" style="background: #081C38; color: #fff; padding: 7.5rem 0 4.5rem; position: relative; overflow: hidden;">
  <div class="container" style="position: relative; z-index: 2;">
    <div class="breadcrumbs" style="margin-top: 1.5rem; margin-bottom: 1.5rem; font-size: 0.85rem; color: #94a3b8;">
      <a href="{{ route('home') }}" style="color: #cbd5e1; text-decoration: none;">Home</a>
      <span style="margin: 0 0.5rem;">/</span>
      <span style="color: #f3b90d;">Insights &amp; Resources</span>
    </div>
    <span class="section-tag" style="background: rgba(255, 255, 255, 0.12); color: #f3b90d; border: 1px solid rgba(255, 255, 255, 0.2); font-weight: 700; font-size: 0.78rem; text-transform: uppercase; letter-spacing: 1px; padding: 0.35rem 0.9rem; border-radius: 999px;">
      Technical Knowledge Hub
    </span>
    <h1 class="page-banner-title" style="font-size: 2.85rem; font-weight: 800; color: #ffffff; margin: 1rem 0 0.75rem;">
      Engineering Whitepapers &amp; Architectural Insights
    </h1>
    <p class="page-banner-subtitle" style="font-size: 1.15rem; color: #cbd5e1; max-width: 720px; line-height: 1.6;">
      Peer-reviewed research on non-linear FEA computational modeling, membrane aerodynamics, desert solar deflection, and air-supported dome technology.
    </p>
  </div>
</section>

<!-- Insights Grid -->
<section class="section" style="background-color: #F4F6F9; padding: 5.5rem 0;">
  <div class="container">
    <div class="insights-matrix-grid" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 2rem;">
      @foreach($posts as $post)
      <article class="insight-card" style="background: #fff; border-radius: 12px; overflow: hidden; border: 1px solid #e2e8f0; display: flex; flex-direction: column; justify-content: space-between; box-shadow: 0 10px 25px rgba(0,0,0,0.03);">
        <div>
          <div style="height: 240px; overflow: hidden;">
            <img src="{{ asset($post->featured_image) }}" alt="{{ $post->title }}" style="width: 100%; height: 100%; object-fit: cover;">
          </div>
          <div style="padding: 2rem;">
            <div style="display: flex; justify-content: space-between; font-size: 0.8rem; color: #64748b; margin-bottom: 0.75rem;">
              <span style="font-weight: 700; color: #f3b90d; text-transform: uppercase;">{{ $post->category }}</span>
              <span>{{ $post->reading_time_minutes }} Min Read</span>
            </div>
            <h3 style="font-size: 1.35rem; font-weight: 800; color: var(--navy-primary); margin-bottom: 0.75rem; line-height: 1.4;">
              <a href="{{ route('blog.show', $post->slug) }}" style="color: inherit; text-decoration: none;">
                {{ $post->title }}
              </a>
            </h3>
            <p style="font-size: 0.92rem; color: #64748b; line-height: 1.6; margin: 0;">{{ $post->excerpt }}</p>
          </div>
        </div>
        <div style="padding: 0 2rem 2rem; display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #f8fafc; padding-top: 1.25rem;">
          <span style="font-size: 0.82rem; color: #94a3b8;">{{ $post->author }}</span>
          <a href="{{ route('blog.show', $post->slug) }}" style="color: #0284c7; font-weight: 700; font-size: 0.9rem; text-decoration: none;">
            Read Publication &rarr;
          </a>
        </div>
      </article>
      @endforeach
    </div>

    <div style="margin-top: 3rem;">
      {{ $posts->links() }}
    </div>
  </div>
</section>
@endsection
