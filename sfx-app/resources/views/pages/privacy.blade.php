@extends('layouts.app')

@section('title', 'Privacy Policy | ' . \App\Models\Setting::get('site_name'))
@section('description', 'Privacy policy and data governance practices of Structurflex Middle East Contracting LLC.')

@section('content')
<section style="background: #081C38; color: #fff; padding: 7.5rem 0 4.5rem; position: relative; overflow: hidden;">
  <div class="container" style="position: relative; z-index: 2; max-width: 860px;">
    <div class="breadcrumbs" style="margin-top: 1.5rem; margin-bottom: 1.5rem; font-size: 0.85rem; color: #94a3b8;">
      <a href="{{ route('home') }}" style="color: #cbd5e1; text-decoration: none;">Home</a>
      <span style="margin: 0 0.5rem;">/</span>
      <span style="color: #f3b90d;">Privacy Policy</span>
    </div>
    <h1 style="font-size: 2.85rem; font-weight: 800; color: #ffffff; margin: 0 0 0.75rem;">Privacy Policy</h1>
    <p style="font-size: 1.1rem; color: #cbd5e1; margin: 0;">Last updated: October 2026</p>
  </div>
</section>

<section class="section" style="background-color: #F8FAFC; padding: 5rem 0;">
  <div class="container" style="max-width: 860px;">
    <div style="background: #ffffff; border-radius: 12px; padding: 3rem; border: 1px solid #e2e8f0; line-height: 1.8; color: #334155;">
      <h2 style="font-size: 1.5rem; font-weight: 800; color: var(--navy-primary); margin-bottom: 1rem;">1. Introduction</h2>
      <p style="margin-bottom: 1.5rem;">Structurflex Middle East Contracting LLC ("SFXMEC", "we", "us", or "our") respects the privacy of our corporate clients, consultants, and website visitors. This Privacy Policy outlines our procedures concerning the collection, use, and protection of information submitted across our digital platforms.</p>

      <h2 style="font-size: 1.5rem; font-weight: 800; color: var(--navy-primary); margin: 2rem 0 1rem;">2. Data Collection in RFPs &amp; Scope Inquiries</h2>
      <p style="margin-bottom: 1.5rem;">When you submit an architectural RFP, consultation request, or utilize our Dynamic Scope Estimator, we collect necessary contact information (name, corporate email, telephone, company affiliation, and project location) solely to prepare feasibility calculations, structural advice, and formal commercial proposals.</p>

      <h2 style="font-size: 1.5rem; font-weight: 800; color: var(--navy-primary); margin: 2rem 0 1rem;">3. Confidentiality of Architectural Briefs</h2>
      <p style="margin-bottom: 1.5rem;">All proprietary engineering drawings, CAD files, tender specifications, and architectural documentation transmitted to SFXMEC are treated under strict commercial confidentiality and are never disclosed, sold, or shared with third parties.</p>

      <h2 style="font-size: 1.5rem; font-weight: 800; color: var(--navy-primary); margin: 2rem 0 1rem;">4. Regional Hub Contact</h2>
      <p style="margin: 0;">For inquiries regarding privacy governance, please contact our compliance desk at <strong>{{ \App\Models\Setting::get('general_email', 'info@structurflex.ae') }}</strong>.</p>
    </div>
  </div>
</section>
@endsection
