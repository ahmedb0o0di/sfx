@extends('layouts.app')

@section('title', $career->title . ' | Careers | ' . \App\Models\Setting::get('site_name', 'Structurflex ME'))
@section('description', 'Explore opening for ' . $career->title . ' at Structurflex Middle East. Join our team engineering landmark tensile architecture and ETFE structures across MENA.')

@section('content')
<!-- Hero Banner -->
<section class="page-header-banner" style="background: #081C38; color: #fff; padding: 7.5rem 0 4rem; position: relative; overflow: hidden;">
  <div class="container" style="position: relative; z-index: 2;">
    <div class="breadcrumbs" style="margin-top: 1.5rem; margin-bottom: 1.5rem; font-size: 0.85rem; color: #94a3b8;">
      <a href="{{ route('home') }}" style="color: #cbd5e1; text-decoration: none;">Home</a>
      <span style="margin: 0 0.5rem;">/</span>
      <a href="{{ route('careers.index') }}" style="color: #cbd5e1; text-decoration: none;">Careers</a>
      <span style="margin: 0 0.5rem;">/</span>
      <span style="color: #f3b90d;">{{ $career->title }}</span>
    </div>

    <div style="display: flex; gap: 0.75rem; align-items: center; flex-wrap: wrap; margin-bottom: 1rem;">
      @if(!empty($career->department))
      <span style="background: rgba(11, 94, 215, 0.25); color: #60a5fa; border: 1px solid rgba(96, 165, 250, 0.3); font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.8px; padding: 0.3rem 0.85rem; border-radius: 999px;">
        {{ $career->department }}
      </span>
      @endif
      @if(!empty($career->location))
      <span style="color: #cbd5e1; font-size: 0.88rem; display: inline-flex; align-items: center; gap: 0.35rem;">
        📍 {{ $career->location }}
      </span>
      @endif
      <span style="color: #cbd5e1; font-size: 0.88rem; display: inline-flex; align-items: center; gap: 0.35rem;">
        ⏱ {{ $career->type ?? 'Full-time' }}
      </span>
    </div>

    <h1 class="page-banner-title" style="font-size: 2.65rem; font-weight: 800; color: #ffffff; margin: 0 0 1rem; line-height: 1.25;">
      {{ $career->title }}
    </h1>
    <p class="page-banner-subtitle" style="font-size: 1.1rem; color: #cbd5e1; max-width: 720px; line-height: 1.6; margin: 0;">
      Join Structurflex Middle East's regional practice engineering world-class lightweight membrane architecture, ETFE daylighting systems, and high-tension civic canopies.
    </p>
  </div>
</section>

<!-- Main Details & Application Layout -->
<section class="section" style="background-color: #F8FAFC; padding: 5rem 0;">
  <div class="container">

    @if(session('career_success'))
    <div style="background: #e6f6ec; border: 1.5px solid #008e38; color: #00732d; padding: 1.5rem 2rem; border-radius: 12px; margin-bottom: 3rem; font-size: 1.05rem; font-weight: 700; text-align: center; box-shadow: 0 4px 15px rgba(0, 142, 56, 0.1);">
      ✓ {{ session('career_success') }}
    </div>
    @endif

    @if($errors->any())
    <div style="background: #fef2f2; border: 1.5px solid #dc2626; color: #991b1b; padding: 1.5rem 2rem; border-radius: 12px; margin-bottom: 3rem; font-size: 0.95rem;">
      <strong style="display: block; margin-bottom: 0.5rem; font-size: 1.05rem;">Please review the following requirements:</strong>
      <ul style="margin: 0; padding-left: 1.25rem; line-height: 1.6;">
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

    <div style="display: grid; grid-template-columns: 1.15fr 0.85fr; gap: 3.5rem; align-items: start;" class="career-detail-grid">
      
      <!-- Left Column: Role Details & Scope -->
      <div class="career-detail-main">
        
        <!-- Role Visual -->
        @if(!empty($career->image_url))
        <div style="width: 100%; height: 320px; border-radius: 14px; overflow: hidden; margin-bottom: 2.5rem; box-shadow: 0 8px 24px rgba(8, 28, 56, 0.08); background: #081C38;">
          <img src="{{ $career->image_url }}" alt="{{ $career->title }}" style="width: 100%; height: 100%; object-fit: cover;">
        </div>
        @endif

        <!-- Role Overview Section -->
        <div style="background: #ffffff; border: 1.5px solid #e2e8f0; border-radius: 14px; padding: 2.5rem; margin-bottom: 2rem; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
          <span class="section-tag" style="background: #edf4fd; color: #0B5ED7; border: 1px solid rgba(11, 94, 215, 0.25); font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.8px; padding: 0.25rem 0.75rem; border-radius: 999px;">
            Position Overview
          </span>
          <h2 style="font-size: 1.75rem; font-weight: 800; color: var(--navy-primary); margin: 0.85rem 0 1.25rem; line-height: 1.3;">
            About this Opportunity
          </h2>
          <div style="color: #334155; font-size: 1rem; line-height: 1.75; white-space: pre-line;">
            {{ $career->description }}
          </div>
        </div>

        <!-- Practice Highlights Box -->
        <div style="background: #ffffff; border: 1.5px solid #e2e8f0; border-radius: 14px; padding: 2.5rem; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
          <h3 style="font-size: 1.35rem; font-weight: 800; color: var(--navy-primary); margin-top: 0; margin-bottom: 1.25rem;">
            Why Build Your Career at Structurflex ME?
          </h3>
          <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 1rem;">
            <li style="display: flex; gap: 0.85rem; align-items: flex-start;">
              <span style="color: #0B5ED7; font-size: 1.15rem; line-height: 1.4;">✓</span>
              <div>
                <strong style="color: var(--navy-primary); display: block; font-size: 0.95rem;">Landmark Regional Portfolios</strong>
                <span style="color: #64748b; font-size: 0.88rem; line-height: 1.5;">Direct involvement in high-visibility civic canopies, aviation terminals, and stadium daylighting envelopes across UAE, KSA, and North Africa.</span>
              </div>
            </li>
            <li style="display: flex; gap: 0.85rem; align-items: flex-start;">
              <span style="color: #008E38; font-size: 1.15rem; line-height: 1.4;">✓</span>
              <div>
                <strong style="color: var(--navy-primary); display: block; font-size: 0.95rem;">Turnkey Engineering Integration</strong>
                <span style="color: #64748b; font-size: 0.88rem; line-height: 1.5;">Collaborate across computational form-finding, specialized CNC cleanroom membrane fabrication, and certified high-altitude rigging erection.</span>
              </div>
            </li>
            <li style="display: flex; gap: 0.85rem; align-items: flex-start;">
              <span style="color: #D99B26; font-size: 1.15rem; line-height: 1.4;">✓</span>
              <div>
                <strong style="color: var(--navy-primary); display: block; font-size: 0.95rem;">Global Engineering Heritage</strong>
                <span style="color: #64748b; font-size: 0.88rem; line-height: 1.5;">Rooted in over 85 years of membrane innovation since 1937, operating from modern regional headquarters in Dubai, UAE.</span>
              </div>
            </li>
          </ul>
        </div>
      </div>

      <!-- Right Column: Dedicated Apply CV Form -->
      <div class="career-detail-sidebar" style="position: sticky; top: 100px;">
        <div style="background: #ffffff; border: 1.5px solid #e2e8f0; border-radius: 16px; overflow: hidden; box-shadow: 0 10px 30px rgba(8, 28, 56, 0.08);">
          
          <!-- Form Header -->
          <div style="background: #081C38; color: #ffffff; padding: 1.75rem 2rem; border-bottom: 3px solid #D99B26;">
            <span style="background: rgba(255, 255, 255, 0.12); color: #f3b90d; font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; padding: 0.2rem 0.65rem; border-radius: 999px; display: inline-block; margin-bottom: 0.5rem;">
              Direct Application
            </span>
            <h3 style="font-size: 1.35rem; font-weight: 800; color: #ffffff; margin: 0; line-height: 1.3;">
              Apply for this Position
            </h3>
            <p style="color: #cbd5e1; font-size: 0.85rem; margin: 0.35rem 0 0; line-height: 1.4;">
              Submit your CV &amp; response statement directly to our engineering desk.
            </p>
          </div>

          <!-- Application Form -->
          <form id="applyJobForm" action="{{ route('careers.apply') }}" method="POST" enctype="multipart/form-data" style="padding: 2rem;">
            @csrf
            <input type="hidden" name="career_id" value="{{ $career->id }}">
            <input type="hidden" name="job_title" value="{{ $career->title }}">

            <!-- Full Name -->
            <div style="margin-bottom: 1.15rem;">
              <label style="display: block; font-size: 0.82rem; font-weight: 700; color: var(--navy-primary); margin-bottom: 0.35rem;">
                Full Name *
              </label>
              <input type="text" name="name" value="{{ old('name') }}" required placeholder="e.g. Eng. Tariq Al-Mansoor" style="width: 100%; padding: 0.75rem 1rem; border: 1.5px solid #cbd5e1; border-radius: 8px; font-size: 0.9rem;">
            </div>

            <!-- Email Address -->
            <div style="margin-bottom: 1.15rem;">
              <label style="display: block; font-size: 0.82rem; font-weight: 700; color: var(--navy-primary); margin-bottom: 0.35rem;">
                Corporate or Personal Email *
              </label>
              <input type="email" name="email" value="{{ old('email') }}" required placeholder="tariq@developer.ae" style="width: 100%; padding: 0.75rem 1rem; border: 1.5px solid #cbd5e1; border-radius: 8px; font-size: 0.9rem;">
            </div>

            <!-- Phone Number -->
            <div style="margin-bottom: 1.15rem;">
              <label style="display: block; font-size: 0.82rem; font-weight: 700; color: var(--navy-primary); margin-bottom: 0.35rem;">
                Contact Telephone / WhatsApp *
              </label>
              <input type="tel" name="phone" value="{{ old('phone') }}" required placeholder="+971 50 000 0000" style="width: 100%; padding: 0.75rem 1rem; border: 1.5px solid #cbd5e1; border-radius: 8px; font-size: 0.9rem;">
            </div>

            <!-- Portfolio / LinkedIn -->
            <div style="margin-bottom: 1.15rem;">
              <label style="display: block; font-size: 0.82rem; font-weight: 700; color: var(--navy-primary); margin-bottom: 0.35rem;">
                LinkedIn / Portfolio URL
              </label>
              <input type="url" name="portfolio_url" value="{{ old('portfolio_url') }}" placeholder="https://linkedin.com/in/..." style="width: 100%; padding: 0.75rem 1rem; border: 1.5px solid #cbd5e1; border-radius: 8px; font-size: 0.9rem;">
            </div>

            <!-- Response / Cover Note -->
            <div style="margin-bottom: 1.25rem;">
              <label style="display: block; font-size: 0.82rem; font-weight: 700; color: var(--navy-primary); margin-bottom: 0.35rem;">
                Candidate Response &amp; Cover Statement *
              </label>
              <textarea name="cover_letter" rows="4" required placeholder="Outline your technical expertise with tensile structures, computational tools (ANSYS, Rhino, Easy), and why you're a great fit..." style="width: 100%; padding: 0.75rem 1rem; border: 1.5px solid #cbd5e1; border-radius: 8px; font-size: 0.9rem; line-height: 1.5;">{{ old('cover_letter') }}</textarea>
            </div>

            <!-- Upload CV File -->
            <div style="margin-bottom: 1.75rem;">
              <label style="display: block; font-size: 0.82rem; font-weight: 700; color: var(--navy-primary); margin-bottom: 0.35rem;">
                Attach Curriculum Vitae (CV / Resume) *
              </label>
              <div style="border: 2px dashed #0B5ED7; border-radius: 10px; background: #F8FAFC; padding: 1rem; text-align: center;">
                <input type="file" name="cv" required accept=".pdf,.doc,.docx,.zip" style="width: 100%; font-size: 0.85rem; color: #475569; cursor: pointer;">
                <small style="display: block; color: #64748b; font-size: 0.75rem; margin-top: 0.35rem;">
                  PDF, DOC, DOCX, ZIP (Max 20MB)
                </small>
              </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center; padding: 0.95rem 1.5rem; font-size: 0.95rem; font-weight: 700; border-radius: 8px;">
              <span>Submit CV for this Position</span>
              <span>&rarr;</span>
            </button>
          </form>
        </div>
      </div>
    </div>

    <!-- Other Positions Section -->
    @if($otherCareers->count() > 0)
    <div style="margin-top: 5.5rem; border-top: 1px solid #e2e8f0; padding-top: 4rem;">
      <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;">
        <div>
          <span class="section-tag" style="background: #edf4fd; color: #0B5ED7; border: 1px solid rgba(11, 94, 215, 0.25); font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.8px; padding: 0.25rem 0.75rem; border-radius: 999px;">
            Other Opportunities
          </span>
          <h3 style="font-size: 1.6rem; font-weight: 800; color: var(--navy-primary); margin: 0.5rem 0 0;">
            Explore More Career Openings
          </h3>
        </div>
        <a href="{{ route('careers.index') }}" class="btn btn-outline" style="padding: 0.65rem 1.25rem; font-size: 0.88rem;">
          <span>View All Positions &rarr;</span>
        </a>
      </div>

      <div class="career-rows-container">
        @foreach($otherCareers as $other)
        <article class="career-row-card">
          <div class="career-row-media">
            <img src="{{ $other->image_url }}" alt="{{ $other->title }}" loading="lazy">
            <span class="career-badge-type">
              {{ $other->type ?? 'Full-time' }}
            </span>
          </div>

          <div class="career-row-content">
            <div class="career-row-meta">
              @if(!empty($other->department))
              <span class="career-badge-dept">{{ $other->department }}</span>
              @endif
              @if(!empty($other->location))
              <span class="career-meta-location">📍 {{ $other->location }}</span>
              @endif
            </div>

            <h3 class="career-row-title">
              <a href="{{ route('careers.show', $other->slug) }}" style="color: inherit; text-decoration: none;">
                {{ $other->title }}
              </a>
            </h3>

            <p class="career-row-desc">
              {{ $other->description }}
            </p>
          </div>

          <div class="career-row-action">
            <a href="{{ route('careers.show', $other->slug) }}" class="btn btn-primary btn-apply">
              <span>View Details &amp; Apply &rarr;</span>
            </a>
          </div>
        </article>
        @endforeach
      </div>
    </div>
    @endif

  </div>
</section>

<style>
@media (max-width: 991px) {
  .career-detail-grid {
    grid-template-columns: 1fr !important;
    gap: 2.5rem !important;
  }
  .career-detail-sidebar {
    position: static !important;
  }
}
</style>
@endsection
