@extends('layouts.app')

@section('title', 'About Us | Heritage Since 1937 | ' . \App\Models\Setting::get('site_name'))
@section('description', 'Specialized in turnkey engineering, manufacturing, and construction of iconic tensile membrane structures, PTFE canopies, and ETFE daylighting systems across MENA.')

@section('content')
<!-- Subpage Banner -->
<section class="page-header-banner" style="background: #081C38; color: #fff; padding: 7.5rem 0 4.5rem; position: relative; overflow: hidden;">
  <div class="container" style="position: relative; z-index: 2;">
    <div class="breadcrumbs" style="margin-top: 1.5rem; margin-bottom: 1.5rem; font-size: 0.85rem; color: #94a3b8;">
      <a href="{{ route('home') }}" style="color: #cbd5e1; text-decoration: none;">Home</a>
      <span style="margin: 0 0.5rem;">/</span>
      <span style="color: #f3b90d;">About Us</span>
    </div>
    <span class="section-tag" style="background: rgba(255, 255, 255, 0.12); color: #f3b90d; border: 1px solid rgba(255, 255, 255, 0.2); font-weight: 700; font-size: 0.78rem; text-transform: uppercase; letter-spacing: 1px; padding: 0.35rem 0.9rem; border-radius: 999px;">
      A Heritage of Engineering Excellence
    </span>
    <h1 class="page-banner-title" style="font-size: 2.85rem; font-weight: 800; color: #ffffff; margin: 1rem 0 0.75rem;">
      Pioneering Tensile Architecture Since 1937
    </h1>
    <p class="page-banner-subtitle" style="font-size: 1.15rem; color: #cbd5e1; max-width: 700px; line-height: 1.6;">
      Specialized in turnkey engineering, manufacturing, and construction of iconic tensile membrane structures, PTFE canopies, and ETFE daylighting systems across the Middle East, Africa, and beyond.
    </p>
  </div>
</section>

<!-- Company Narrative & Heritage -->
<section class="section" style="background-color: #ffffff; padding: 6rem 0;">
  <div class="container">
    <div style="display: grid; grid-template-columns: 1.15fr 0.85fr; gap: 4rem; align-items: center;">
      <div class="about-text">
        <span class="section-tag" style="background: #edf4fd; color: #0B5ED7; border: 1px solid rgba(11, 94, 215, 0.25); font-weight: 700; font-size: 0.78rem; text-transform: uppercase; letter-spacing: 1px; padding: 0.35rem 0.9rem; border-radius: 999px;">
          Our Proven Heritage
        </span>
        <h2 style="font-size: 2.25rem; font-weight: 800; color: var(--navy-primary); margin: 0.85rem 0 1.25rem; line-height: 1.25;">
          From Humble Sail-Making Roots to Global Tensile Mastery
        </h2>
        <p style="font-size: 1.05rem; color: var(--text-dark); line-height: 1.7; margin-bottom: 1rem;">
          From humble sail-making beginnings, Structurflex began life as <strong>Sails &amp; Covers Ltd on 21 July 1937</strong>. Across more than eight decades, Structurflex has consistently pursued innovation, developing proprietary fabrication techniques to become one of the world's leading suppliers of innovative tensile membrane structures.
        </p>
        <p style="font-size: 1rem; color: var(--text-muted); line-height: 1.7; margin-bottom: 1rem;">
          In <strong>2005</strong>, <strong>Structurflex Middle East Contracting LLC</strong> was established in Dubai, United Arab Emirates as regional representative operations for the Structurflex Group to pursue the rapidly expanding demand in the MENA region for complex tensioned membrane architecture.
        </p>
        <p style="font-size: 1rem; color: var(--text-muted); line-height: 1.7; margin-bottom: 1.75rem;">
          In <strong>2012</strong>, management responsibility of Structurflex Middle East Contracting LLC moved to <strong>Mr. Maged Mounir</strong>, ushering in a transformative era of regional expansion, federal contracting awards, and prestigious international commissions.
        </p>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-top: 2rem;">
          <div style="background: #F4F6F9; border-radius: 8px; padding: 1.25rem; border-left: 3px solid #0B5ED7;">
            <h4 style="font-size: 1.05rem; font-weight: 700; color: var(--navy-primary); margin-bottom: 0.35rem;">Turnkey Engineering</h4>
            <p style="font-size: 0.85rem; color: var(--text-muted); margin: 0;">Parametric 3D form-finding, non-linear FEA, and structural wind tunnel simulations.</p>
          </div>
          <div style="background: #F4F6F9; border-radius: 8px; padding: 1.25rem; border-left: 3px solid #008E38;">
            <h4 style="font-size: 1.05rem; font-weight: 700; color: var(--navy-primary); margin-bottom: 0.35rem;">Cleanroom Fabrication</h4>
            <p style="font-size: 0.85rem; color: var(--text-muted); margin: 0;">Automated CNC plotting and high-frequency (HF) molecular seaming for PVC, PTFE &amp; ETFE.</p>
          </div>
        </div>
      </div>

      <div>
        <div style="border-radius: 12px; overflow: hidden; box-shadow: 0 16px 36px rgba(8, 28, 56, 0.15); border: 1px solid #e2e8f0;">
          <img src="{{ asset('assets/images/projects/al-jamea-etfe.png') }}" alt="Structurflex Al Jamea ETFE Project" style="width: 100%; height: auto; display: block;">
          <div style="padding: 1.5rem; background: #ffffff;">
            <span style="font-size: 0.75rem; font-weight: 700; color: #0B5ED7; text-transform: uppercase;">Landmark Project Case</span>
            <h4 style="font-size: 1.15rem; font-weight: 800; color: var(--navy-primary); margin: 0.25rem 0 0.5rem;">Al Jamea Tus Saifiyah (Nairobi, Kenya)</h4>
            <p style="font-size: 0.88rem; color: var(--text-muted); margin: 0;">Single Skin ETFE Tensile Membrane Roof engineered and constructed by Structurflex Middle East Contracting LLC.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Managing Partner's Message -->
<section class="section" style="background-color: #F4F6F9; padding: 6rem 0;">
  <div class="container">
    <div style="max-width: 860px; margin: 0 auto; background: #ffffff; border-radius: 12px; padding: 3.5rem; border: 1px solid #e2e8f0; box-shadow: 0 10px 30px rgba(0,0,0,0.06);">
      <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
        <div style="width: 48px; height: 48px; border-radius: 50%; background: #edf4fd; color: #0B5ED7; display: flex; align-items: center; justify-content: center;">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
        </div>
        <div>
          <span style="font-size: 0.75rem; font-weight: 700; color: #0B5ED7; text-transform: uppercase; letter-spacing: 0.8px;">Executive Leadership</span>
          <h3 style="font-size: 1.45rem; font-weight: 800; color: var(--navy-primary); margin: 0;">Managing Partner's Message</h3>
        </div>
      </div>

      <blockquote style="font-size: 1.05rem; color: var(--text-dark); line-height: 1.75; font-style: italic; margin-bottom: 1.75rem; border-left: 3px solid #D99B26; padding-left: 1.25rem;">
        "At Structurflex ME, the health and safety of our colleagues, customers, partners, and communities remains our topmost priority. We understand that meeting our customer's requirements is crucial to the success of our organization, and we have worked diligently to ensure that our clients receive exceptional service.
        <br><br>
        Furthermore, we remain steadfast in our commitment to environmental awareness and sustainability. As we strive to prevent climate change and resource depletion, we recognize the importance of preserving the environment for future generations. We remain committed to providing innovative and customized solutions to meet your needs, while contributing to the growth and development of our industry."
      </blockquote>

      <div style="display: flex; justify-content: space-between; align-items: flex-end; border-top: 1px solid #e2e8f0; padding-top: 1.5rem; flex-wrap: wrap; gap: 1rem;">
        <div>
          <strong style="font-size: 1.15rem; color: var(--navy-primary); display: block;">Mr. Maged Mounir</strong>
          <span style="font-size: 0.85rem; color: var(--text-muted);">Managing Partner, Structurflex Middle East Contracting LLC</span>
        </div>
        <div style="color: #008E38; font-weight: 700; font-size: 0.82rem; text-transform: uppercase;">
          Strategic Partner of Ministry of Public Works
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
