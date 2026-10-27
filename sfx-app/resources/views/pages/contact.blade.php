@extends('layouts.app')

@section('title', 'Contact Regional Hubs | Dubai & Cairo | ' . \App\Models\Setting::get('site_name'))
@section('description', 'Connect directly with our structural engineering and commercial leadership in Dubai and Cairo for architectural form-finding and turnkey B2B tenders.')

@section('content')
<!-- Subpage Banner -->
<section class="page-header-banner" style="background: #081C38; color: #fff; padding: 7.5rem 0 4.5rem; position: relative; overflow: hidden;">
  <div class="container" style="position: relative; z-index: 2;">
    <div class="breadcrumbs" style="margin-top: 1.5rem; margin-bottom: 1.5rem; font-size: 0.85rem; color: #94a3b8;">
      <a href="{{ route('home') }}" style="color: #cbd5e1; text-decoration: none;">Home</a>
      <span style="margin: 0 0.5rem;">/</span>
      <span style="color: #f3b90d;">Contact &amp; Consultation</span>
    </div>
    <span class="section-tag" style="background: rgba(255, 255, 255, 0.12); color: #f3b90d; border: 1px solid rgba(255, 255, 255, 0.2); font-weight: 700; font-size: 0.78rem; text-transform: uppercase; letter-spacing: 1px; padding: 0.35rem 0.9rem; border-radius: 999px;">
      Direct Engineering Consultation
    </span>
    <h1 class="page-banner-title" style="font-size: 2.85rem; font-weight: 800; color: #ffffff; margin: 1rem 0 0.75rem;">
      Regional Engineering Hubs: Dubai &amp; Cairo
    </h1>
    <p class="page-banner-subtitle" style="font-size: 1.15rem; color: #cbd5e1; max-width: 720px; line-height: 1.6;">
      Connect directly with our structural engineering and commercial leadership in Dubai and Cairo for architectural form-finding, material specifications, and turnkey B2B budgeting.
    </p>
  </div>
</section>

<!-- Main Contact Section -->
<section class="section" id="contact" style="background-color: #F4F6F9; padding: 5.5rem 0;">
  <div class="container">
    <div style="display: grid; grid-template-columns: 1.2fr 0.8fr; gap: 3.5rem; background: #ffffff; border-radius: 12px; border: 1px solid #e2e8f0; padding: 3.5rem; box-shadow: 0 10px 30px rgba(0,0,0,0.06);">
      <!-- Left Column: Form -->
      <div>
        <span class="section-tag" style="background: #edf4fd; color: #0B5ED7; border: 1px solid rgba(11, 94, 215, 0.25); font-weight: 700; font-size: 0.78rem; text-transform: uppercase; letter-spacing: 1px; padding: 0.35rem 0.9rem; border-radius: 999px;">
          Project Inquiry
        </span>
        <h2 style="font-size: 1.85rem; font-weight: 800; color: var(--navy-primary); margin: 0.75rem 0 1.5rem;">
          Submit an RFP / Technical Inquiry
        </h2>

        <form action="{{ route('contact.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.25rem;">
            <div>
              <label style="display: block; font-size: 0.82rem; font-weight: 700; color: var(--navy-primary); margin-bottom: 0.35rem;">Full Name *</label>
              <input type="text" name="name" required placeholder="Eng. Tariq Al-Mansoor" style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.9rem;">
            </div>
            <div>
              <label style="display: block; font-size: 0.82rem; font-weight: 700; color: var(--navy-primary); margin-bottom: 0.35rem;">Corporate Email *</label>
              <input type="email" name="email" required placeholder="tariq@developer.ae" style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.9rem;">
            </div>
          </div>

          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.25rem;">
            <div>
              <label style="display: block; font-size: 0.82rem; font-weight: 700; color: var(--navy-primary); margin-bottom: 0.35rem;">Contact Telephone *</label>
              <input type="tel" name="phone" required placeholder="+971 50 000 0000" style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.9rem;">
            </div>
            <div>
              <label style="display: block; font-size: 0.82rem; font-weight: 700; color: var(--navy-primary); margin-bottom: 0.35rem;">Department / Office *</label>
              <select name="subject" style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.9rem; background: #fff;">
                <option value="Dubai Regional HQ - UAE Tenders">Dubai Regional HQ — UAE &amp; Gulf Tenders</option>
                <option value="Cairo Regional Branch - Egypt Tenders">Cairo Regional Branch — Egypt &amp; North Africa</option>
                <option value="ASATI Air Domes Partnership Desk">ASATI Air Domes Partnership Desk</option>
                <option value="Careers & Engineering Practice">Careers &amp; Engineering Practice Application</option>
                <option value="Lifecycle AMC & Inspection Request">Lifecycle AMC &amp; Inspection Request</option>
              </select>
            </div>
          </div>

          <div style="margin-bottom: 1.25rem;">
            <label style="display: block; font-size: 0.82rem; font-weight: 700; color: var(--navy-primary); margin-bottom: 0.35rem;">Project Specifications &amp; Scope *</label>
            <textarea name="message" rows="5" required placeholder="Location, estimated area (m²), structural span, target execution date..." style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.9rem;"></textarea>
          </div>

          <div style="margin-bottom: 1.5rem;">
            <label style="display: block; font-size: 0.82rem; font-weight: 700; color: var(--navy-primary); margin-bottom: 0.35rem;">Upload Technical Brief or Architectural Drawing (PDF, DWG, ZIP, Max 15MB)</label>
            <input type="file" name="attachment" style="font-size: 0.85rem; color: #64748b;">
          </div>

          <button type="submit" class="btn btn-request-consult" style="width: 100%; justify-content: center; padding: 1rem; font-size: 0.95rem;">
            <span>Send Consultation Request</span>
            <span>&rarr;</span>
          </button>
        </form>
      </div>

      <!-- Right Column: Regional Hubs Details -->
      <div style="display: flex; flex-direction: column; gap: 2rem;">
        <!-- Dubai HQ -->
        <div style="background: #F8FAFC; border-radius: 10px; padding: 2rem; border: 1px solid #e2e8f0;">
          <h3 style="font-size: 1.25rem; font-weight: 800; color: var(--navy-primary); margin-bottom: 0.75rem;">
            {{ \App\Models\Setting::get('dubai_office_title', 'Dubai Regional Headquarters') }}
          </h3>
          <p style="font-size: 0.9rem; color: #64748b; line-height: 1.6; margin-bottom: 1rem;">
            {{ \App\Models\Setting::get('dubai_address') }}
          </p>
          <div style="font-size: 0.9rem; color: var(--navy-primary); display: flex; flex-direction: column; gap: 0.5rem;">
            <div><strong>Direct Line:</strong> {{ \App\Models\Setting::get('dubai_phone') }}</div>
            <div><strong>Tender Desk:</strong> {{ \App\Models\Setting::get('dubai_email') }}</div>
          </div>
        </div>

        <!-- Cairo Branch -->
        <div style="background: #F8FAFC; border-radius: 10px; padding: 2rem; border: 1px solid #e2e8f0;">
          <h3 style="font-size: 1.25rem; font-weight: 800; color: var(--navy-primary); margin-bottom: 0.75rem;">
            {{ \App\Models\Setting::get('cairo_office_title', 'Cairo Regional Engineering Branch') }}
          </h3>
          <p style="font-size: 0.9rem; color: #64748b; line-height: 1.6; margin-bottom: 1rem;">
            {{ \App\Models\Setting::get('cairo_address') }}
          </p>
          <div style="font-size: 0.9rem; color: var(--navy-primary); display: flex; flex-direction: column; gap: 0.5rem;">
            <div><strong>Cairo Direct:</strong> {{ \App\Models\Setting::get('cairo_phone') }}</div>
            <div><strong>Engineering Desk:</strong> {{ \App\Models\Setting::get('cairo_email') }}</div>
          </div>
        </div>

        <!-- WhatsApp Quick Connect -->
        <div style="background: #081C38; border-radius: 10px; padding: 1.75rem; color: #fff; text-align: center;">
          <h4 style="font-size: 1.15rem; font-weight: 800; color: #fff; margin-bottom: 0.5rem;">Need an Urgent Feasibility Assessment?</h4>
          <p style="font-size: 0.88rem; color: #cbd5e1; margin-bottom: 1.25rem;">Chat directly with our Dubai duty engineering team on WhatsApp.</p>
          <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', \App\Models\Setting::get('whatsapp_number', '971502959942')) }}" target="_blank" class="btn btn-hero-primary" style="justify-content: center; width: 100%;">
            <span>Open WhatsApp Chat</span>
            <span>&rarr;</span>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
