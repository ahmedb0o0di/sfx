@extends('layouts.app')

@section('title', 'About Us | Heritage Since 1937 | ' . \App\Models\Setting::get('site_name', 'Structurflex ME'))
@section('description', 'Specialized in turnkey engineering, manufacturing, and construction of iconic tensile membrane structures, PTFE canopies, and ETFE daylighting systems across MENA.')

@section('content')
<!-- Subpage Banner -->
<section class="page-header-banner" style="background: #081C38; color: #fff; padding: clamp(5.5rem, 10vw, 7.5rem) 0 clamp(3rem, 6vw, 4.5rem); position: relative; overflow: hidden;">
  <div class="container" style="position: relative; z-index: 2;">
    <div class="breadcrumbs" style="margin-top: 1.5rem; margin-bottom: 1.25rem; font-size: 0.85rem; color: #94a3b8; display: flex; flex-wrap: wrap; align-items: center; gap: 0.35rem;">
      <a href="{{ route('home') }}" style="color: #cbd5e1; text-decoration: none;">Home</a>
      <span style="color: #64748b;">/</span>
      <span style="color: #f3b90d;">About Us</span>
    </div>
    <span class="section-tag" style="background: rgba(255, 255, 255, 0.12); color: #f3b90d; border: 1px solid rgba(255, 255, 255, 0.2); font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; padding: 0.3rem 0.85rem; border-radius: 999px; display: inline-block;">
      {{ \App\Models\Setting::get('about_hero_tag', 'A Heritage of Engineering Excellence') }}
    </span>
    <h1 class="page-banner-title" style="font-size: clamp(1.85rem, 5vw, 2.85rem); font-weight: 800; color: #ffffff; margin: 0.85rem 0 0.75rem; line-height: 1.25;">
      {{ \App\Models\Setting::get('about_hero_title', 'Pioneering Tensile Architecture Since 1937') }}
    </h1>
    <p class="page-banner-subtitle" style="font-size: clamp(0.95rem, 2.2vw, 1.15rem); color: #cbd5e1; max-width: 700px; line-height: 1.6; margin: 0;">
      {{ \App\Models\Setting::get('about_hero_subtitle', 'Specialized in turnkey engineering, manufacturing, and construction of iconic tensile membrane structures, PTFE canopies, and ETFE daylighting systems across the Middle East, Africa, and beyond.') }}
    </p>
  </div>
</section>

<!-- Company Narrative & Heritage -->
<section class="section about-section" style="background-color: #ffffff; padding: 5.5rem 0;">
  <div class="container">
    <div class="about-heritage-grid">
      <div class="about-text">
        <span class="section-tag" style="background: #edf4fd; color: #0B5ED7; border: 1px solid rgba(11, 94, 215, 0.25); font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; padding: 0.3rem 0.85rem; border-radius: 999px; display: inline-block;">
          {{ \App\Models\Setting::get('about_narrative_tag', 'Our Proven Heritage') }}
        </span>
        <h2 style="font-size: clamp(1.5rem, 4vw, 2.25rem); font-weight: 800; color: var(--navy-primary); margin: 0.85rem 0 1.25rem; line-height: 1.25;">
          {{ \App\Models\Setting::get('about_narrative_title', 'From Humble Sail-Making Roots to Global Tensile Mastery') }}
        </h2>
        <p style="font-size: clamp(0.92rem, 2vw, 1.05rem); color: var(--text-dark); line-height: 1.7; margin-bottom: 1rem;">
          {!! nl2br(e(\App\Models\Setting::get('about_narrative_p1', "From humble sail-making beginnings, Structurflex began life as Sails & Covers Ltd on 21 July 1937. Across more than eight decades, Structurflex has consistently pursued innovation, developing proprietary fabrication techniques to become one of the world's leading suppliers of innovative tensile membrane structures."))) !!}
        </p>
        <p style="font-size: clamp(0.9rem, 1.8vw, 1rem); color: var(--text-muted); line-height: 1.7; margin-bottom: 1rem;">
          {!! nl2br(e(\App\Models\Setting::get('about_narrative_p2', "In 2005, Structurflex Middle East Contracting LLC was established in Dubai, United Arab Emirates as regional representative operations for the Structurflex Group to pursue the rapidly expanding demand in the MENA region for complex tensioned membrane architecture."))) !!}
        </p>
        <p style="font-size: clamp(0.9rem, 1.8vw, 1rem); color: var(--text-muted); line-height: 1.7; margin-bottom: 1.75rem;">
          {!! nl2br(e(\App\Models\Setting::get('about_narrative_p3', "In 2012, management responsibility of Structurflex Middle East Contracting LLC moved to Mr. Maged Mounir, ushering in a transformative era of regional expansion, federal contracting awards, and prestigious international commissions."))) !!}
        </p>

        <!-- Feature Points Grid (Responsive 2-col to 1-col) -->
        <div class="about-features-grid">
          <div style="background: #F4F6F9; border-radius: 8px; padding: 1.25rem; border-left: 3px solid #0B5ED7;">
            <h4 style="font-size: 1.05rem; font-weight: 700; color: var(--navy-primary); margin-bottom: 0.35rem;">
              {{ \App\Models\Setting::get('about_feature1_title', 'Turnkey Engineering') }}
            </h4>
            <p style="font-size: 0.85rem; color: var(--text-muted); margin: 0; line-height: 1.5;">
              {{ \App\Models\Setting::get('about_feature1_desc', 'Parametric 3D form-finding, non-linear FEA, and structural wind tunnel simulations.') }}
            </p>
          </div>
          <div style="background: #F4F6F9; border-radius: 8px; padding: 1.25rem; border-left: 3px solid #008E38;">
            <h4 style="font-size: 1.05rem; font-weight: 700; color: var(--navy-primary); margin-bottom: 0.35rem;">
              {{ \App\Models\Setting::get('about_feature2_title', 'Cleanroom Fabrication') }}
            </h4>
            <p style="font-size: 0.85rem; color: var(--text-muted); margin: 0; line-height: 1.5;">
              {{ \App\Models\Setting::get('about_feature2_desc', 'Automated CNC plotting and high-frequency (HF) molecular seaming for PVC, PTFE & ETFE.') }}
            </p>
          </div>
        </div>
      </div>

      <!-- Project Case Card -->
      <div>
        <div class="about-case-card">
          <img src="{{ asset(\App\Models\Setting::get('about_case_image', 'assets/images/projects/al-jamea-etfe.png')) }}" alt="{{ \App\Models\Setting::get('about_case_title', 'Structurflex Al Jamea ETFE Project') }}" style="width: 100%; height: auto; display: block;" loading="lazy">
          <div class="about-case-body">
            <span style="font-size: 0.72rem; font-weight: 700; color: #0B5ED7; text-transform: uppercase; letter-spacing: 0.6px; display: block; margin-bottom: 0.25rem;">
              {{ \App\Models\Setting::get('about_case_badge', 'Landmark Project Case') }}
            </span>
            <h4 style="font-size: 1.15rem; font-weight: 800; color: var(--navy-primary); margin: 0 0 0.5rem; line-height: 1.35;">
              {{ \App\Models\Setting::get('about_case_title', 'Al Jamea Tus Saifiyah (Nairobi, Kenya)') }}
            </h4>
            <p style="font-size: 0.88rem; color: var(--text-muted); margin: 0; line-height: 1.55;">
              {{ \App\Models\Setting::get('about_case_desc', 'Single Skin ETFE Tensile Membrane Roof engineered and constructed by Structurflex Middle East Contracting LLC.') }}
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Managing Partner's Message -->
<section class="section about-section" style="background-color: #F4F6F9; padding: 5.5rem 0;">
  <div class="container">
    <div class="about-leadership-card">
      <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
        <div style="width: 48px; height: 48px; border-radius: 50%; background: #edf4fd; color: #0B5ED7; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
        </div>
        <div>
          <span style="font-size: 0.72rem; font-weight: 700; color: #0B5ED7; text-transform: uppercase; letter-spacing: 0.8px;">
            {{ \App\Models\Setting::get('about_message_tag', 'Executive Leadership') }}
          </span>
          <h3 style="font-size: clamp(1.2rem, 3.5vw, 1.45rem); font-weight: 800; color: var(--navy-primary); margin: 0; line-height: 1.3;">
            {{ \App\Models\Setting::get('about_message_title', "Managing Partner's Message") }}
          </h3>
        </div>
      </div>

      <blockquote style="font-size: clamp(0.92rem, 2vw, 1.05rem); color: var(--text-dark); line-height: 1.75; font-style: italic; margin-bottom: 1.75rem; border-left: 3px solid #D99B26; padding-left: 1.25rem;">
        {!! nl2br(e(\App\Models\Setting::get('about_message_quote', "At Structurflex ME, the health and safety of our colleagues, customers, partners, and communities remains our topmost priority. We understand that meeting our customer's requirements is crucial to the success of our organization, and we have worked diligently to ensure that our clients receive exceptional service.\n\nFurthermore, we remain steadfast in our commitment to environmental awareness and sustainability. As we strive to prevent climate change and resource depletion, we recognize the importance of preserving the environment for future generations. We remain committed to providing innovative and customized solutions to meet your needs, while contributing to the growth and development of our industry."))) !!}
      </blockquote>

      <div class="about-leadership-footer" style="display: flex; justify-content: space-between; align-items: flex-end; border-top: 1px solid #e2e8f0; padding-top: 1.5rem; flex-wrap: wrap; gap: 1rem;">
        <div>
          <strong style="font-size: 1.1rem; color: var(--navy-primary); display: block;">
            {{ \App\Models\Setting::get('about_leader_name', 'Mr. Maged Mounir') }}
          </strong>
          <span style="font-size: 0.85rem; color: var(--text-muted); display: block; margin-top: 0.2rem;">
            {{ \App\Models\Setting::get('about_leader_title', 'Managing Partner, Structurflex Middle East Contracting LLC') }}
          </span>
        </div>
        <div style="color: #008E38; font-weight: 700; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px;">
          ✓ {{ \App\Models\Setting::get('about_leader_badge', 'Strategic Partner of Ministry of Public Works') }}
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Strategic Recognition / Award -->
<section class="section about-section" style="background-color: #ffffff; padding: 5rem 0;">
  <div class="container">
    <div class="about-recognition-grid">
      <div class="about-award-card">
        @php
          $awardImgRaw = \App\Models\Setting::get('about_award_image', 'assets/images/credentials/ministry-public-works-award.png');
          if (str_starts_with($awardImgRaw, 'http://') || str_starts_with($awardImgRaw, 'https://')) {
              $awardImgUrl = $awardImgRaw;
          } elseif (str_starts_with($awardImgRaw, 'storage/') || str_starts_with($awardImgRaw, 'assets/')) {
              $awardImgUrl = asset($awardImgRaw);
          } elseif (\Illuminate\Support\Facades\Storage::disk('public')->exists($awardImgRaw)) {
              $awardImgUrl = \Illuminate\Support\Facades\Storage::disk('public')->url($awardImgRaw);
          } else {
              $awardImgUrl = asset($awardImgRaw);
          }
        @endphp
        <img src="{{ $awardImgUrl }}" alt="{{ \App\Models\Setting::get('about_award_title', 'Ministry of Public Works Strategic Partner Award') }}" style="max-height: 320px; width: auto; margin: 0 auto; display: block; border-radius: 8px;" loading="lazy">
        <span style="font-size: 0.75rem; color: var(--text-muted); margin-top: 0.75rem; display: block;">
          {{ \App\Models\Setting::get('about_award_caption', 'Official UAE Ministry of Public Works Award') }}
        </span>
      </div>

      <div class="about-recognition-text">
        <span class="section-tag" style="background: #fef8eb; color: #D99B26; border: 1px solid rgba(217, 155, 38, 0.3); font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; padding: 0.3rem 0.85rem; border-radius: 999px; display: inline-block;">
          {{ \App\Models\Setting::get('about_award_tag', 'Strategic Recognition') }}
        </span>
        <h2 style="font-size: clamp(1.5rem, 4vw, 2.15rem); font-weight: 800; color: var(--navy-primary); margin: 0.75rem 0 1rem; line-height: 1.25;">
          {{ \App\Models\Setting::get('about_award_title', 'Ministry of Public Works Strategic Partner Award') }}
        </h2>
        <p style="font-size: clamp(0.92rem, 2vw, 1.05rem); color: var(--text-dark); line-height: 1.7; margin-bottom: 1rem;">
          {!! nl2br(e(\App\Models\Setting::get('about_award_p1', 'Structurflex Middle East Contracting LLC was formally honored by the United Arab Emirates Ministry of Public Works on Tuesday, 17th June 2014 as one of the strategic partners collaborating in achieving the ministry\'s national infrastructure vision.'))) !!}
        </p>
        <p style="font-size: clamp(0.88rem, 1.8vw, 0.95rem); color: var(--text-muted); line-height: 1.7; margin-bottom: 1.5rem;">
          {!! nl2br(e(\App\Models\Setting::get('about_award_p2', 'Structurflex Middle East has successfully engineered and executed 14 successful projects with the Ministry of Public Works since 2007, establishing an unblemished record for high-precision tensile engineering, structural safety, and durability.'))) !!}
        </p>
        <a href="{{ url(\App\Models\Setting::get('about_award_btn_url', '/contact')) }}" class="btn btn-primary" style="background: var(--navy-primary); color: #fff; border: none; padding: 0.85rem 1.75rem; border-radius: 6px; font-weight: 700;">
          <span>{{ \App\Models\Setting::get('about_award_btn_text', 'Partner With Our UAE Practice') }}</span>
          <span>&rarr;</span>
        </a>
      </div>
    </div>
  </div>
</section>
@endsection
