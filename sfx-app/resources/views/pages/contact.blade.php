@extends('layouts.app')

@section('title', 'Contact Regional Hubs | Dubai & Cairo | ' . \App\Models\Setting::get('site_name', 'Structurflex Middle East'))
@section('description', 'Connect directly with our structural engineering and commercial leadership in Dubai and Cairo for architectural form-finding and turnkey B2B tenders.')

@section('content')
<!-- Subpage Banner -->
<section class="page-header-banner">
  <div class="container" style="position: relative; z-index: 2;">
    <div class="breadcrumbs">
      <a href="{{ route('home') }}" style="display: inline-flex; align-items: center; gap: 0.35rem; color: #f3b90d; font-weight: 700; margin-right: 0.5rem; text-decoration: none;">
        <span>&larr;</span> <span>Home</span>
      </a>
      <span style="opacity: 0.5;">/</span>
      <span style="color: #cbd5e1;">Contact Regional Hubs</span>
    </div>
    
    <span class="section-tag" style="background: rgba(243, 185, 13, 0.15); color: #f3b90d; border: 1px solid rgba(243, 185, 13, 0.3); font-weight: 700; font-size: 0.78rem; text-transform: uppercase; padding: 0.3rem 0.85rem; border-radius: 999px;">
      Direct Engineering Consultation
    </span>
    
    <h1 class="page-banner-title">
      Regional Engineering Hubs: Dubai &amp; Cairo
    </h1>
    
    <p class="page-banner-subtitle">
      Connect directly with our structural engineering and commercial leadership in Dubai and Cairo for architectural form-finding, material specifications, and turnkey B2B budgeting.
    </p>
  </div>
</section>

<!-- Main Contact Section -->
<section class="contact-section-wrap" id="contact">
  <div class="container">
    <div class="contact-card-matrix">
      
      <!-- Left Column: Inquiry Form -->
      <div>
        <div style="margin-bottom: 1.5rem;">
          <span class="section-tag" style="background: #edf4fd; color: #0B5ED7; border: 1px solid rgba(11, 94, 215, 0.25); font-weight: 700; font-size: 0.78rem; text-transform: uppercase; letter-spacing: 1px; padding: 0.35rem 0.9rem; border-radius: 999px;">
            Project Inquiry
          </span>
          <h2 style="font-size: clamp(1.4rem, 3vw, 1.85rem); font-weight: 800; color: var(--navy-primary); margin: 0.75rem 0 0.5rem;">
            Submit an RFP / Technical Inquiry
          </h2>
          <p style="font-size: 0.92rem; color: #64748b; margin: 0; line-height: 1.5;">
            Our lead engineers will review your parameters and provide initial feasibility guidance within 24 hours.
          </p>
        </div>

        <form action="{{ route('contact.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          
          <div class="contact-form-grid-2">
            <div>
              <label class="contact-form-label">Full Name *</label>
              <input type="text" name="name" required placeholder="Eng. Tariq Al-Mansoor" class="contact-form-input">
            </div>
            <div>
              <label class="contact-form-label">Corporate Email *</label>
              <input type="email" name="email" required placeholder="tariq@developer.ae" class="contact-form-input">
            </div>
          </div>

          <div class="contact-form-grid-2">
            <div>
              <label class="contact-form-label">Contact Telephone *</label>
              <input type="tel" name="phone" required placeholder="+971 50 000 0000" class="contact-form-input">
            </div>
            <div>
              <label class="contact-form-label">Department / Office *</label>
              <select name="subject" class="contact-form-select">
                <option value="Dubai Regional HQ - UAE Tenders">Dubai Regional HQ — UAE &amp; Gulf Tenders</option>
                <option value="Cairo Regional Branch - Egypt Tenders">Cairo Regional Branch — Egypt &amp; North Africa</option>
                <option value="ASATI Air Domes Partnership Desk">ASATI Air Domes Partnership Desk</option>
                <option value="Careers & Engineering Practice">Careers &amp; Engineering Practice Application</option>
                <option value="Lifecycle AMC & Inspection Request">Lifecycle AMC &amp; Inspection Request</option>
              </select>
            </div>
          </div>

          <div style="margin-bottom: 1.25rem;">
            <label class="contact-form-label">Project Specifications &amp; Scope *</label>
            <textarea name="message" rows="5" required placeholder="Location, estimated area (m²), structural span, target execution date..." class="contact-form-textarea"></textarea>
          </div>

          <div style="margin-bottom: 1.75rem;">
            <label class="contact-form-label">Upload Technical Brief or Architectural Drawing (PDF, DWG, ZIP, Max 15MB)</label>
            <input type="file" name="attachment" style="font-size: 0.85rem; color: #64748b; width: 100%; border: 1px dashed #cbd5e1; padding: 0.75rem; border-radius: 8px; background: #f8fafc;">
          </div>

          <button type="submit" class="btn btn-request-consult" style="width: 100%; justify-content: center; padding: 1rem; font-size: 1rem; border-radius: 8px;">
            <span>Send Consultation Request</span>
            <span>&rarr;</span>
          </button>
        </form>
      </div>

      <!-- Right Column: Regional Hubs Details & Fast Connect -->
      <div class="contact-hubs-col">
        
        <!-- Dubai HQ -->
        <div class="contact-office-card">
          <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.75rem;">
            <span style="font-size: 1.25rem;">📍</span>
            <h3 style="font-size: 1.15rem; font-weight: 800; color: var(--navy-primary); margin: 0;">
              {{ \App\Models\Setting::get('dubai_office_title', 'Dubai Regional Headquarters') }}
            </h3>
          </div>
          <p style="font-size: 0.88rem; color: #64748b; line-height: 1.6; margin-bottom: 1.25rem;">
            {{ \App\Models\Setting::get('dubai_address', 'Al Quoz Industrial Area 3, Dubai, United Arab Emirates') }}
          </p>
          <div style="font-size: 0.88rem; display: flex; flex-direction: column; gap: 0.65rem; border-top: 1px solid #e2e8f0; padding-top: 1rem;">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 0.25rem;">
              <span style="color: #64748b;">Direct Hotline:</span>
              <a href="tel:{{ preg_replace('/[^0-9+]/', '', \App\Models\Setting::get('dubai_phone', '+97142388455')) }}" class="contact-hub-link">
                📞 {{ \App\Models\Setting::get('dubai_phone', '+971 4 238 8455') }}
              </a>
            </div>
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 0.25rem;">
              <span style="color: #64748b;">Tender Desk:</span>
              <a href="mailto:{{ \App\Models\Setting::get('dubai_email', 'dubai@structurflex.ae') }}" class="contact-hub-link">
                ✉️ {{ \App\Models\Setting::get('dubai_email', 'dubai@structurflex.ae') }}
              </a>
            </div>
          </div>
        </div>

        <!-- Cairo Branch -->
        <div class="contact-office-card">
          <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.75rem;">
            <span style="font-size: 1.25rem;">📍</span>
            <h3 style="font-size: 1.15rem; font-weight: 800; color: var(--navy-primary); margin: 0;">
              {{ \App\Models\Setting::get('cairo_office_title', 'Cairo Regional Engineering Branch') }}
            </h3>
          </div>
          <p style="font-size: 0.88rem; color: #64748b; line-height: 1.6; margin-bottom: 1.25rem;">
            {{ \App\Models\Setting::get('cairo_address', '5th Settlement, New Cairo, Egypt') }}
          </p>
          <div style="font-size: 0.88rem; display: flex; flex-direction: column; gap: 0.65rem; border-top: 1px solid #e2e8f0; padding-top: 1rem;">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 0.25rem;">
              <span style="color: #64748b;">Cairo Direct:</span>
              <a href="tel:{{ preg_replace('/[^0-9+]/', '', \App\Models\Setting::get('cairo_phone', '+201000000000')) }}" class="contact-hub-link">
                📞 {{ \App\Models\Setting::get('cairo_phone', '+20 10 0000 0000') }}
              </a>
            </div>
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 0.25rem;">
              <span style="color: #64748b;">Engineering Desk:</span>
              <a href="mailto:{{ \App\Models\Setting::get('cairo_email', 'cairo@structurflex.ae') }}" class="contact-hub-link">
                ✉️ {{ \App\Models\Setting::get('cairo_email', 'cairo@structurflex.ae') }}
              </a>
            </div>
          </div>
        </div>

        <!-- WhatsApp Quick Connect -->
        <div class="contact-whatsapp-box">
          <span style="font-size: 1.75rem; display: block; margin-bottom: 0.4rem;">💬</span>
          <h4 style="font-size: 1.15rem; font-weight: 800; color: #fff; margin-bottom: 0.4rem;">Need Urgent Feasibility Assessment?</h4>
          <p style="font-size: 0.88rem; color: #cbd5e1; margin-bottom: 1.25rem; line-height: 1.5;">Chat directly with our Dubai duty engineering team on WhatsApp.</p>
          <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', \App\Models\Setting::get('whatsapp_number', '971502959942')) }}" target="_blank" rel="noopener noreferrer" class="contact-whatsapp-btn">
            <span>💬 Open WhatsApp Chat</span>
            <span>&rarr;</span>
          </a>
        </div>

      </div>

    </div>
  </div>
</section>
@endsection
