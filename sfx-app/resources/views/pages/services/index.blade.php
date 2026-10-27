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
      <article class="solution-card" style="background: #ffffff; border-radius: 12px; overflow: hidden; border: 1px solid #e2e8f0; box-shadow: 0 10px 25px rgba(0,0,0,0.04); display: flex; flex-direction: column; justify-content: space-between;">
        <div>
          <div style="height: 220px; overflow: hidden; position: relative;">
            <a href="{{ route('services.show', $service->slug) }}" style="display: block; width: 100%; height: 100%;" title="View {{ $service->title }} details">
              <img src="{{ asset($service->hero_image) }}" alt="{{ $service->title }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s ease;" onmouseover="this.style.transform='scale(1.06)'" onmouseout="this.style.transform='scale(1)'">
            </a>
          </div>
          <div style="padding: 1.75rem;">
            <span style="font-size: 0.75rem; text-transform: uppercase; font-weight: 700; color: #0284c7; letter-spacing: 0.8px;">{{ $service->subtitle }}</span>
            <h3 style="font-size: 1.25rem; font-weight: 800; color: var(--navy-primary); margin: 0.4rem 0 0.75rem;">
              <a href="{{ route('services.show', $service->slug) }}" style="color: inherit; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#0B5ED7'" onmouseout="this.style.color='var(--navy-primary)'">
                {{ $service->title }}
              </a>
            </h3>
            <p style="font-size: 0.88rem; color: #64748b; line-height: 1.6; margin-bottom: 1rem;">{{ $service->summary }}</p>
            
            @if($service->technical_specs)
            <div style="background: #F8FAFC; border-radius: 8px; padding: 1rem; margin-top: 1rem; font-size: 0.82rem;">
              @foreach($service->technical_specs as $key => $val)
                <div style="display: flex; justify-content: space-between; margin-bottom: 0.35rem;">
                  <strong style="color: #64748b;">{{ $key }}:</strong>
                  <span style="color: var(--navy-primary); font-weight: 600;">{{ $val }}</span>
                </div>
              @endforeach
            </div>
            @endif
          </div>
        </div>
        <div style="padding: 0 1.75rem 1.75rem;">
          <a href="{{ route('services.show', $service->slug) }}" class="btn btn-hero-white" style="width: 100%; justify-content: center; font-size: 0.88rem;">
            <span>System Details &amp; Case Studies</span>
            <span>&rarr;</span>
          </a>
        </div>
      </article>
      @endforeach
    </div>
  </div>
</section>

<!-- Capabilities Anchor -->
<section id="capabilities" class="services-capabilities-section">
  <div class="container">
    <div class="section-header text-center" style="margin-bottom: 3.5rem;">
      <span class="section-tag" style="background: rgba(255, 255, 255, 0.12); color: #f3b90d; border: 1px solid rgba(255, 255, 255, 0.2);">In-House Capabilities</span>
      <h2 style="font-size: clamp(1.6rem, 4vw, 2.35rem); font-weight: 800; color: #ffffff; margin-top: 0.75rem;">Turnkey EPC Engineering Stewardship</h2>
      <p style="color: #cbd5e1; max-width: 650px; margin: 0 auto; font-size: clamp(0.92rem, 2vw, 1rem); line-height: 1.6;">
        From parametric form-finding to crane rigging, all phases are controlled in-house to guarantee structural safety and handover milestones.
      </p>
    </div>

    <div class="services-capabilities-grid">
      <div class="services-capability-card">
        <h4 class="services-capability-title">3D Form Finding</h4>
        <p class="services-capability-desc">Parametric non-linear relaxation models to achieve minimal surface tension and aerodynamic stability.</p>
      </div>
      <div class="services-capability-card">
        <h4 class="services-capability-title">Structural FEA</h4>
        <p class="services-capability-desc">Wind tunnel computational dynamics and ASCE 55-16 stress simulation for severe desert thermal gusts.</p>
      </div>
      <div class="services-capability-card">
        <h4 class="services-capability-title">CNC Fabrication</h4>
        <p class="services-capability-desc">Computerized vacuum-bed cutting and high-frequency thermal welding ensuring gas-tight tolerances.</p>
      </div>
      <div class="services-capability-card">
        <h4 class="services-capability-title">Laser Pre-Stressing</h4>
        <p class="services-capability-desc">Hydraulic cable tensioning and total-station optical survey verification ensuring zero sag or ponding.</p>
      </div>
    </div>
  </div>
</section>
@endsection
