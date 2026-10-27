@extends('layouts.app')

@section('title', $service->title . ' | ' . \App\Models\Setting::get('site_name'))
@section('description', $service->summary)

@section('content')
<!-- Service Banner -->
<section style="background: #081C38; color: #fff; padding: 7.5rem 0 4.5rem; position: relative; overflow: hidden;">
  <div class="container" style="position: relative; z-index: 2;">
    <div class="breadcrumbs" style="margin-top: 1.5rem; margin-bottom: 1.5rem; font-size: 0.85rem; color: #94a3b8;">
      <a href="{{ route('home') }}" style="color: #cbd5e1; text-decoration: none;">Home</a>
      <span style="margin: 0 0.5rem;">/</span>
      <a href="{{ route('services.index') }}" style="color: #cbd5e1; text-decoration: none;">Solutions</a>
      <span style="margin: 0 0.5rem;">/</span>
      <span style="color: #f3b90d;">{{ $service->title }}</span>
    </div>

    <span class="section-tag" style="background: rgba(255, 255, 255, 0.12); color: #f3b90d; border: 1px solid rgba(255, 255, 255, 0.2); font-weight: 700; font-size: 0.78rem; text-transform: uppercase; padding: 0.35rem 0.9rem; border-radius: 999px;">
      {{ $service->subtitle }}
    </span>
    <h1 style="font-size: 2.85rem; font-weight: 800; color: #ffffff; margin: 1rem 0 0.75rem;">
      {{ $service->title }}
    </h1>
    <p style="font-size: 1.15rem; color: #cbd5e1; max-width: 720px; line-height: 1.6;">
      {{ $service->summary }}
    </p>
  </div>
</section>

<!-- Content Section -->
<section class="section" style="background-color: #F8FAFC; padding: 5rem 0;">
  <div class="container">
    <div style="display: grid; grid-template-columns: 1.3fr 0.7fr; gap: 3rem; align-items: start;">
      <div>
        <div style="border-radius: 12px; overflow: hidden; margin-bottom: 2rem; box-shadow: 0 10px 25px rgba(0,0,0,0.06);">
          <img src="{{ asset($service->hero_image) }}" alt="{{ $service->title }}" style="width: 100%; height: auto; display: block;">
        </div>

        <div style="background: #fff; border-radius: 12px; padding: 2.5rem; border: 1px solid #e2e8f0;">
          <h2 style="font-size: 1.75rem; font-weight: 800; color: var(--navy-primary); margin-bottom: 1rem;">
            System Overview &amp; Architectural Engineering
          </h2>
          <p style="font-size: 1rem; color: #475569; line-height: 1.8; margin-bottom: 1.5rem;">
            {{ $service->description }}
          </p>

          @if($service->technical_specs)
          <h3 style="font-size: 1.35rem; font-weight: 800; color: var(--navy-primary); margin: 2rem 0 1rem;">
            Technical Performance Standards
          </h3>
          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
            @foreach($service->technical_specs as $key => $val)
            <div style="background: #F8FAFC; border: 1px solid #e2e8f0; border-radius: 8px; padding: 1.25rem;">
              <span style="font-size: 0.75rem; color: #64748b; text-transform: uppercase; font-weight: 700; display: block; margin-bottom: 0.35rem;">{{ $key }}</span>
              <strong style="color: var(--navy-primary); font-size: 1rem;">{{ $val }}</strong>
            </div>
            @endforeach
          </div>
          @endif
        </div>
      </div>

      <!-- Right Column: Consultation Card & Estimator -->
      <div>
        <div style="background: #fff; border-radius: 12px; padding: 2rem; border: 1px solid #e2e8f0; box-shadow: 0 10px 25px rgba(0,0,0,0.04); margin-bottom: 2rem;">
          <h3 style="font-size: 1.25rem; font-weight: 800; color: var(--navy-primary); margin-bottom: 1rem;">
            Request Feasibility Review
          </h3>
          <p style="font-size: 0.88rem; color: #64748b; line-height: 1.6; margin-bottom: 1.5rem;">
            Discuss structural feasibility, fabric selection, and budget estimations with our Dubai engineering practice.
          </p>
          <a href="{{ route('contact.index', ['solution' => $service->slug]) }}" class="btn btn-request-consult" style="width: 100%; justify-content: center; padding: 0.95rem;">
            <span>Consult Our Engineers</span>
            <span>&rarr;</span>
          </a>
        </div>

        <div style="background: #081C38; border-radius: 12px; padding: 2rem; color: #fff; text-align: center;">
          <h4 style="font-size: 1.2rem; font-weight: 800; color: #fff; margin-bottom: 0.5rem;">Model Scope &amp; Budget</h4>
          <p style="font-size: 0.88rem; color: #cbd5e1; line-height: 1.5; margin-bottom: 1.5rem;">
            Test different materials and area footprints with our interactive calculator.
          </p>
          <button type="button" class="btn btn-hero-white" style="width: 100%; justify-content: center;" onclick="document.getElementById('estimatorModal').style.display='flex'">
            <span>Launch Estimator</span>
          </button>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
