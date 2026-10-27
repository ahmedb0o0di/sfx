@extends('layouts.app')

@section('title', 'Careers & Opportunities | ' . \App\Models\Setting::get('site_name', 'Structurflex ME'))
@section('description', 'Join our team of visionary structural engineers, parametric computational designers, master riggers, and tensile architecture project leaders across MENA.')

@section('content')
<!-- Subpage Banner -->
<section class="page-header-banner" style="background: #081C38; color: #fff; padding: 7.5rem 0 4.5rem; position: relative; overflow: hidden;">
  <div class="container" style="position: relative; z-index: 2;">
    <div class="breadcrumbs" style="margin-top: 1.5rem; margin-bottom: 1.5rem; font-size: 0.85rem; color: #94a3b8;">
      <a href="{{ route('home') }}" style="color: #cbd5e1; text-decoration: none;">Home</a>
      <span style="margin: 0 0.5rem;">/</span>
      <span style="color: #f3b90d;">Careers &amp; Opportunities</span>
    </div>
    <span class="section-tag" style="background: rgba(255, 255, 255, 0.12); color: #f3b90d; border: 1px solid rgba(255, 255, 255, 0.2); font-weight: 700; font-size: 0.78rem; text-transform: uppercase; letter-spacing: 1px; padding: 0.35rem 0.9rem; border-radius: 999px;">
      Join Our Engineering Practice
    </span>
    <h1 class="page-banner-title" style="font-size: 2.85rem; font-weight: 800; color: #ffffff; margin: 1rem 0 0.75rem;">
      Build Architectural Icons Across MENA &amp; Africa
    </h1>
    <p class="page-banner-subtitle" style="font-size: 1.15rem; color: #cbd5e1; max-width: 720px; line-height: 1.6;">
      At Structurflex Middle East, we engineer the boundaries of lightweight membrane structures, ETFE daylighting envelopes, and civic canopies. Explore current opportunities below.
    </p>
  </div>
</section>

<!-- Careers Single-Item-Per-Row List -->
<section class="section section-careers" style="background-color: #F8FAFC; padding: 5.5rem 0;">
  <div class="container">
    @if(session('career_success'))
    <div style="background: #e6f6ec; border: 1.5px solid #008e38; color: #00732d; padding: 1.25rem 1.75rem; border-radius: 10px; margin-bottom: 2.5rem; font-size: 1rem; font-weight: 700; text-align: center; max-width: 900px; margin-left: auto; margin-right: auto; box-shadow: 0 4px 12px rgba(0, 142, 56, 0.08);">
      ✓ {{ session('career_success') }}
    </div>
    @endif

    @if($errors->any())
    <div style="background: #fef2f2; border: 1.5px solid #dc2626; color: #991b1b; padding: 1.25rem 1.75rem; border-radius: 10px; margin-bottom: 2.5rem; font-size: 0.95rem; max-width: 900px; margin-left: auto; margin-right: auto;">
      <strong style="display: block; margin-bottom: 0.35rem;">Please review the following errors:</strong>
      <ul style="margin: 0; padding-left: 1.25rem;">
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

    <div class="section-header" style="text-align: center; max-width: 780px; margin: 0 auto 3.5rem;">
      <span class="section-tag" style="background: #edf4fd; color: #0B5ED7; border: 1px solid rgba(11, 94, 215, 0.25); font-weight: 700; font-size: 0.78rem; text-transform: uppercase; letter-spacing: 1px; padding: 0.35rem 0.9rem; border-radius: 999px;">
        Open Positions
      </span>
      <h2 class="section-title" style="font-size: var(--h2-size); font-weight: 800; color: var(--navy-primary); margin: 0.75rem 0 0.5rem; letter-spacing: -0.02em;">
        Current Career Opportunities
      </h2>
      <p class="section-subtitle" style="font-size: 1.05rem; color: var(--text-muted); max-width: 680px; margin: 0 auto; line-height: 1.6;">
        All positions offer competitive regional packages, hands-on exposure to landmark MENA projects, and continuous professional development.
      </p>
    </div>

    <!-- Career Cards: Single Item Per Row -->
    <div class="career-rows-container" style="display: flex; flex-direction: column; gap: 1.75rem; max-width: 1100px; margin: 0 auto;">
      @forelse($careers as $career)
      <article class="career-row-card">
        <!-- Left: Image -->
        <div class="career-row-media">
          <img src="{{ $career->image_url }}" alt="{{ $career->title }}" loading="lazy">
          <span class="career-badge-type">
            {{ $career->type ?? 'Full-time' }}
          </span>
        </div>

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
            {{ $career->title }}
          </h3>

          <p class="career-row-desc">
            {{ $career->description }}
          </p>
        </div>

        <!-- Right: Apply Action -->
        <div class="career-row-action">
          @php
            $isExternal = !empty($career->apply_url) && \Illuminate\Support\Str::startsWith($career->apply_url, ['http://', 'https://']);
          @endphp
          @if($isExternal)
            <a href="{{ $career->apply_url }}" target="_blank" rel="noopener noreferrer" class="btn btn-primary btn-apply">
              <span>Apply Now</span>
              <span>&rarr;</span>
            </a>
          @else
            <button type="button" onclick="openCareerApplyModal({{ $career->id }}, '{{ addslashes($career->title) }}')" class="btn btn-primary btn-apply">
              <span>Apply Now</span>
              <span>&rarr;</span>
            </button>
          @endif
        </div>
      </article>
      @empty
      <div style="text-align: center; padding: 4rem 2rem; background: #ffffff; border-radius: 12px; border: 1px dashed #cbd5e1;">
        <h3 style="font-size: 1.3rem; font-weight: 700; color: var(--navy-primary); margin-bottom: 0.5rem;">No Current Active Openings</h3>
        <p style="color: #64748b; font-size: 0.95rem; margin-bottom: 1.5rem; max-width: 550px; margin-left: auto; margin-right: auto;">
          We are consistently evaluating visionary structural talent. Submit your speculative application and CV to be considered for forthcoming regional projects.
        </p>
        <button type="button" onclick="openCareerApplyModal(null, 'Speculative Application')" class="btn btn-primary">
          <span>Submit Speculative CV</span>
          <span>&rarr;</span>
        </button>
      </div>
      @endforelse
    </div>

    <!-- Talent Pool / General Application Box -->
    <div style="margin-top: 4rem; background: #ffffff; border-radius: 14px; border: 1.5px solid #e2e8f0; padding: 2.5rem 3rem; display: flex; align-items: center; justify-content: space-between; gap: 2rem; flex-wrap: wrap; box-shadow: 0 4px 20px rgba(0,0,0,0.03); max-width: 1100px; margin-left: auto; margin-right: auto;">
      <div>
        <span class="section-tag" style="background: #fef8eb; color: #D99B26; border: 1px solid rgba(217, 155, 38, 0.3); font-weight: 700; font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.8px; padding: 0.25rem 0.75rem; border-radius: 999px;">
          Talent Network
        </span>
        <h3 style="font-size: 1.35rem; font-weight: 800; color: var(--navy-primary); margin: 0.5rem 0 0.35rem;">
          Don't see your specific discipline listed?
        </h3>
        <p style="color: #64748b; font-size: 0.95rem; margin: 0; max-width: 600px;">
          We frequently create bespoke positions for top-tier computational form-finders, tensile riggers, and project managers. Connect directly with our Dubai leadership team.
        </p>
      </div>
      <button type="button" onclick="openCareerApplyModal(null, 'General Practice Application')" class="btn btn-outline" style="white-space: nowrap; padding: 0.85rem 1.65rem;">
        <span>Submit General Application &rarr;</span>
      </button>
    </div>
  </div>
</section>

@include('components.career-apply-modal')
@endsection
