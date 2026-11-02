@extends('layouts.app')

@section('title', 'Specialized Systems & Solutions | ' . \App\Models\Setting::get('site_name'))
@section('description', 'Turnkey architectural tensile envelopes, ETFE pneumatic cushions, ASATI air-supported domes, and lifecycle maintenance across the Middle East.')

@section('content')
<!-- Subpage Banner -->
<section class="page-header-banner" style="background: #081C38; color: #fff; padding: 7.5rem 0 4.5rem; position: relative; overflow: hidden;">
  <div class="container" style="position: relative; z-index: 2;">
    <div class="breadcrumbs" style="margin-top: 1.5rem; margin-bottom: 1.5rem; font-size: 0.85rem; color: #94a3b8;">
      <a href="{{ route('home') }}" style="color: #cbd5e1; text-decoration: none;">Home</a>
      <span style="margin: 0 0.5rem;">/</span>
      <span style="color: #f3b90d;">Solutions &amp; Capabilities</span>
    </div>
    <span class="section-tag" style="background: rgba(255, 255, 255, 0.12); color: #f3b90d; border: 1px solid rgba(255, 255, 255, 0.2); font-weight: 700; font-size: 0.78rem; text-transform: uppercase; letter-spacing: 1px; padding: 0.35rem 0.9rem; border-radius: 999px;">
      EPC Contracting Solutions
    </span>
    <h1 class="page-banner-title" style="font-size: 2.85rem; font-weight: 800; color: #ffffff; margin: 1rem 0 0.75rem;">
      Tensile Envelopes &amp; Air-Supported Domes
    </h1>
    <p class="page-banner-subtitle" style="font-size: 1.15rem; color: #cbd5e1; max-width: 720px; line-height: 1.6;">
      End-to-end design, FEA stress computation, cleanroom CNC pattern cutting, and laser pre-stress rigging delivered under single-point EPC contract responsibility.
    </p>
  </div>
</section>

<!-- Solutions Grid -->
<section class="section" style="background-color: #F4F6F9; padding: 5.5rem 0;">
  <div class="container">
    <div class="solutions-grid">
      @foreach($services as $service)
      <article class="solution-card">
        <div>
          <div class="solution-card-media">
            <a href="{{ route('services.show', $service->slug) }}" title="View {{ $service->title }} details">
              <img src="{{ asset($service->hero_image) }}" alt="{{ $service->title }}" loading="lazy">
            </a>
          </div>
          <div class="solution-card-body">
            <span class="solution-card-subtitle">{{ $service->subtitle }}</span>
            <h3 class="solution-card-title">
              <a href="{{ route('services.show', $service->slug) }}">
                {{ $service->title }}
              </a>
            </h3>
            <p class="solution-card-summary">{{ $service->summary }}</p>
            
            @if($service->technical_specs)
            <div class="solution-card-specs">
              @foreach($service->technical_specs as $key => $val)
                <div class="solution-spec-item">
                  <strong class="solution-spec-key">{{ $key }}:</strong>
                  <span class="solution-spec-val">{{ $val }}</span>
                </div>
              @endforeach
            </div>
            @endif
          </div>
        </div>
        <div class="solution-card-footer">
          <a href="{{ route('services.show', $service->slug) }}" class="btn btn-solution-action">
            <span>System Details &amp; Case Studies</span>
            <span class="btn-arrow">&rarr;</span>
          </a>
        </div>
      </article>
      @endforeach
    </div>
  </div>
</section>

<!-- Capabilities Anchor -->
@include('components.capabilities-section')
@endsection
