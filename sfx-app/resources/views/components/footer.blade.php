@php
  $projects = \App\Models\Project::select('id', 'slug')->get()->keyBy('id');

  $rawSolutions = \App\Models\Setting::get('footer_solutions');
  $solutions = $rawSolutions ? json_decode($rawSolutions, true) : null;
  if (!is_array($solutions) || empty($solutions)) {
      $solutions = [
          ['link_type' => 'custom', 'label' => 'Architectural Structures', 'custom_url' => route('services.index') . '#architectural'],
          ['link_type' => 'custom', 'label' => 'Sports & Recreation', 'custom_url' => route('services.index') . '#sports'],
          ['link_type' => 'custom', 'label' => 'Commercial & Retail', 'custom_url' => route('services.index') . '#commercial'],
          ['link_type' => 'custom', 'label' => 'Transport & Infrastructure', 'custom_url' => route('services.index') . '#transport'],
          ['link_type' => 'custom', 'label' => 'Industrial & Warehouse', 'custom_url' => route('services.index') . '#industrial'],
          ['link_type' => 'custom', 'label' => 'Air-Supported Domes (ASATI)', 'custom_url' => route('services.index') . '#air-supported'],
          ['link_type' => 'custom', 'label' => 'Lifecycle Services (AMC)', 'custom_url' => route('services.index') . '#lifecycle'],
      ];
  }

  $rawCompany = \App\Models\Setting::get('footer_company_links');
  $companyLinks = $rawCompany ? json_decode($rawCompany, true) : null;
  if (!is_array($companyLinks) || empty($companyLinks)) {
      $companyLinks = [
          ['page' => 'about', 'label' => 'About Structurflex ME'],
          ['page' => 'projects', 'label' => 'Featured Projects'],
          ['page' => 'capabilities', 'label' => 'Our Capabilities'],
          ['page' => 'credentials', 'label' => 'ISO Certifications'],
          ['page' => 'blog', 'label' => 'Insights & Resources'],
          ['page' => 'careers', 'label' => 'Careers & Practice'],
          ['page' => 'contact', 'label' => 'Contact Us'],
      ];
  }

  $brandDesc = \App\Models\Setting::get('footer_brand_desc', 'From humble sail-making beginnings in 1937 (Sails & Covers Ltd) to a world leader in tensile membranes. Established in Dubai in 2005 as Structurflex Middle East Contracting LLC to engineer visionary spaces across MENA and Africa.');
  $linkedinUrl = \App\Models\Setting::get('social_linkedin', 'https://www.linkedin.com/company/structurflex/');
  $twitterUrl = \App\Models\Setting::get('social_twitter', 'https://twitter.com/structurflex');

  $address = \App\Models\Setting::get('footer_address', \App\Models\Setting::get('factory_address', 'Shed 01 (S-464), Al Ttay Area, Al Khawaneej 2 Industrial Area, Dubai, UAE'));
  $phone = \App\Models\Setting::get('footer_phone', \App\Models\Setting::get('dubai_phone', '+971 4 238 8455'));
  $email = \App\Models\Setting::get('footer_email', \App\Models\Setting::get('general_email', 'info@structurflex.ae'));
  $website = \App\Models\Setting::get('footer_website', \App\Models\Setting::get('website_url', 'www.structurflex.ae'));

  $outcome1 = \App\Models\Setting::get('footer_outcome_1', 'Stronger Brand Positioning');
  $outcome2 = \App\Models\Setting::get('footer_outcome_2', 'Increased Trust & Credibility');
  $outcome3 = \App\Models\Setting::get('footer_outcome_3', 'Higher Quality Leads');
  $outcome4 = \App\Models\Setting::get('footer_outcome_4', 'Improved Conversion Rate');
  $outcome5 = \App\Models\Setting::get('footer_outcome_5', 'Supporting Business Growth');

  $copyright = \App\Models\Setting::get('footer_copyright', 'Structurflex Middle East Contracting LLC. All rights reserved.');
@endphp

<footer class="site-footer-dark">
  <div class="container">
    <div class="footer-columns-grid">
      <!-- Col 1: Brand -->
      <div class="footer-col footer-col-brand">
        <a href="{{ route('home') }}" class="brand-logo" style="display: inline-block;">
          <img src="{{ asset('assets/images/logo-light.png') }}" alt="Structurflex Middle East Contracting"
            style="height: 52px; width: auto;">
        </a>
        <p>{{ $brandDesc }}</p>
        <div style="display: flex; gap: 0.75rem;">
          @if($linkedinUrl)
          <a href="{{ $linkedinUrl }}" target="_blank" rel="noopener noreferrer"
            style="display: inline-flex; align-items: center; justify-content: center; width: 34px; height: 34px; border-radius: 50%; background: rgba(255,255,255,0.1); color: #fff; transition: background 0.2s;" aria-label="LinkedIn">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
              <path
                d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
            </svg>
          </a>
          @endif
          @if($twitterUrl)
          <a href="{{ $twitterUrl }}" target="_blank" rel="noopener noreferrer"
            style="display: inline-flex; align-items: center; justify-content: center; width: 34px; height: 34px; border-radius: 50%; background: rgba(255,255,255,0.1); color: #fff; transition: background 0.2s;" aria-label="Twitter">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
              <path
                d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
            </svg>
          </a>
          @endif
        </div>
      </div>

      <!-- Col 2: Solutions -->
      <div class="footer-col">
        <h4>Our Solutions</h4>
        <ul class="footer-links-list">
          @foreach($solutions as $sol)
            @php
              $href = '#';
              if (($sol['link_type'] ?? '') === 'project' && !empty($sol['project_id']) && isset($projects[$sol['project_id']])) {
                  $href = route('projects.show', $projects[$sol['project_id']]->slug);
              } elseif (!empty($sol['custom_url'])) {
                  $href = $sol['custom_url'];
              }
            @endphp
            <li><a href="{{ $href }}">{{ $sol['label'] ?? 'Solution' }}</a></li>
          @endforeach
        </ul>
      </div>

      <!-- Col 3: Company -->
      <div class="footer-col">
        <h4>Company</h4>
        <ul class="footer-links-list">
          @foreach($companyLinks as $item)
            @php
              $pageKey = $item['page'] ?? '';
              $pageUrl = match ($pageKey) {
                  'about' => route('about'),
                  'projects' => route('projects.index'),
                  'capabilities' => route('home') . '#capabilities',
                  'credentials' => route('home') . '#credentials',
                  'blog' => route('blog.index'),
                  'careers' => route('contact.index', ['inquiry' => 'careers']),
                  'contact' => route('contact.index'),
                  'privacy' => route('privacy'),
                  'terms' => route('terms'),
                  default => $item['custom_url'] ?? '#',
              };
            @endphp
            <li><a href="{{ $pageUrl }}">{{ $item['label'] ?? 'Company Link' }}</a></li>
          @endforeach
        </ul>
      </div>

      <!-- Col 4: Get In Touch -->
      <div class="footer-col">
        <h4>Get In Touch</h4>
        <div class="footer-contact-details">
          @if($address)
          <div class="footer-contact-item">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
              <circle cx="12" cy="10" r="3" />
            </svg>
            <span>{{ $address }}</span>
          </div>
          @endif
          @if($phone)
          <div class="footer-contact-item">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path
                d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
            </svg>
            <span>{{ $phone }}</span>
          </div>
          @endif
          @if($email)
          <div class="footer-contact-item">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
              <polyline points="22,6 12,13 2,6" />
            </svg>
            <span>{{ $email }}</span>
          </div>
          @endif
          @if($website)
          <div class="footer-contact-item">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <circle cx="12" cy="12" r="10" />
              <line x1="2" y1="12" x2="22" y2="12" />
              <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1 4-10z" />
            </svg>
            <span>{{ $website }}</span>
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>

  <!-- Strategic Expected Outcomes Bar (Bottom Highlight: 5 Messages) -->
  <div class="outcomes-bar">
    <div class="container">
      <div class="outcomes-grid">
        <div class="outcome-badge-item">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
            <polyline points="20 6 9 17 4 12" />
          </svg>
          <span>{{ $outcome1 }}</span>
        </div>
        <div class="outcome-badge-item">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
            <polyline points="20 6 9 17 4 12" />
          </svg>
          <span>{{ $outcome2 }}</span>
        </div>
        <div class="outcome-badge-item">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
            <polyline points="20 6 9 17 4 12" />
          </svg>
          <span>{{ $outcome3 }}</span>
        </div>
        <div class="outcome-badge-item">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
            <polyline points="20 6 9 17 4 12" />
          </svg>
          <span>{{ $outcome4 }}</span>
        </div>
        <div class="outcome-badge-item">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
            <polyline points="20 6 9 17 4 12" />
          </svg>
          <span>{{ $outcome5 }}</span>
        </div>
      </div>
    </div>
  </div>

  <!-- Sub-Footer Bottom Bar -->
  <div style="background-color: #030c1d;">
    <div class="container">
      <div class="sub-footer-bottom">
        <div>
          &copy; {{ date('Y') }} {{ $copyright }}
        </div>
        <div class="sub-footer-links">
          <a href="{{ route('privacy') }}">Privacy Policy</a>
          <a href="{{ route('terms') }}">Terms of Service</a>
          <a href="{{ route('contact.index') }}">Dubai Office Map</a>
        </div>
      </div>
    </div>
  </div>
</footer>
