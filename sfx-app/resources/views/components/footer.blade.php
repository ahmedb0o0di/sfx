@php
  $projects = \App\Models\Project::select('id', 'slug')->get()->keyBy('id');

  // Solutions Column Links
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
  $activeSolutions = array_filter($solutions, fn($item) => !empty(trim($item['label'] ?? '')));

  // Company Column Links
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
  $activeCompanyLinks = array_filter($companyLinks, fn($item) => !empty(trim($item['label'] ?? '')));

  // Brand description
  $brandDesc = \App\Models\Setting::get('footer_brand_desc', 'From humble sail-making beginnings in 1937 (Sails & Covers Ltd) to a world leader in tensile membranes. Established in Dubai in 2005 as Structurflex Middle East Contracting LLC to engineer visionary spaces across MENA and Africa.');

  // All Social Media Channels (hide any empty values)
  $allSocials = [
      'linkedin' => [
          'name' => 'LinkedIn',
          'url' => \App\Models\Setting::get('social_linkedin', 'https://www.linkedin.com/company/structurflex/'),
          'svg' => '<path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>',
      ],
      'twitter' => [
          'name' => 'X',
          'url' => \App\Models\Setting::get('social_twitter', \App\Models\Setting::get('social_x', 'https://x.com/structurflex')),
          'svg' => '<path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>',
      ],
      'facebook' => [
          'name' => 'Facebook',
          'url' => \App\Models\Setting::get('social_facebook', ''),
          'svg' => '<path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/>',
      ],
      'instagram' => [
          'name' => 'Instagram',
          'url' => \App\Models\Setting::get('social_instagram', ''),
          'svg' => '<path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>',
      ],
      'youtube' => [
          'name' => 'YouTube',
          'url' => \App\Models\Setting::get('social_youtube', ''),
          'svg' => '<path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>',
      ],
      'whatsapp' => [
          'name' => 'WhatsApp',
          'url' => \App\Models\Setting::get('social_whatsapp', ''),
          'svg' => '<path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>',
      ],
      'tiktok' => [
          'name' => 'TikTok',
          'url' => \App\Models\Setting::get('social_tiktok', ''),
          'svg' => '<path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.24 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/>',
      ],
      'pinterest' => [
          'name' => 'Pinterest',
          'url' => \App\Models\Setting::get('social_pinterest', ''),
          'svg' => '<path d="M12 0c-6.627 0-12 5.372-12 12 0 5.084 3.163 9.426 7.627 11.174-.105-.949-.2-2.405.042-3.441.218-.937 1.407-5.965 1.407-5.965s-.359-.719-.359-1.782c0-1.668.967-2.914 2.171-2.914 1.023 0 1.518.769 1.518 1.69 0 1.029-.655 2.568-.994 3.995-.283 1.194.599 2.169 1.777 2.169 2.133 0 3.772-2.249 3.772-5.495 0-2.873-2.064-4.882-5.012-4.882-3.414 0-5.418 2.561-5.418 5.207 0 1.031.397 2.138.893 2.738.098.119.112.224.083.345-.09.375-.291 1.199-.332 1.369-.057.24-.191.291-.441.175-1.649-.768-2.679-3.178-2.679-5.116 0-4.168 3.028-8 8.736-8 4.588 0 8.154 3.27 8.154 7.64 0 4.558-2.873 8.228-6.86 8.228-1.34 0-2.6-.696-3.031-1.52l-.826 3.144c-.299 1.144-1.109 2.578-1.653 3.456 1.207.373 2.49.574 3.82.574 6.627 0 12-5.373 12-12 0-6.628-5.373-12-12-12z"/>',
      ],
  ];
  $activeSocials = array_filter($allSocials, fn($item) => !empty(trim($item['url'] ?? '')));

  // Get In Touch Contact Details (hide empty)
  $address = \App\Models\Setting::get('footer_address', \App\Models\Setting::get('factory_address', 'Shed 01 (S-464), Al Ttay Area, Al Khawaneej 2 Industrial Area, Dubai, UAE'));
  $phone = \App\Models\Setting::get('footer_phone', \App\Models\Setting::get('dubai_phone', '+971 4 238 8455'));
  $email = \App\Models\Setting::get('footer_email', \App\Models\Setting::get('general_email', 'info@structurflex.ae'));
  $website = \App\Models\Setting::get('footer_website', \App\Models\Setting::get('website_url', 'www.structurflex.ae'));
  $hasContactInfo = !empty(trim($address ?? '')) || !empty(trim($phone ?? '')) || !empty(trim($email ?? '')) || !empty(trim($website ?? ''));

  // 5 Messages Outcomes Bar (hide empty items and bar if all empty)
  $outcomes = array_filter([
      \App\Models\Setting::get('footer_outcome_1', 'Stronger Brand Positioning'),
      \App\Models\Setting::get('footer_outcome_2', 'Increased Trust & Credibility'),
      \App\Models\Setting::get('footer_outcome_3', 'Higher Quality Leads'),
      \App\Models\Setting::get('footer_outcome_4', 'Improved Conversion Rate'),
      \App\Models\Setting::get('footer_outcome_5', 'Supporting Business Growth'),
  ], fn($msg) => !empty(trim($msg ?? '')));

  // Copyright Notice
  $copyright = \App\Models\Setting::get('footer_copyright', 'Structurflex Middle East Contracting LLC. All rights reserved.');
@endphp

<footer class="site-footer-dark">
  <div class="container">
    <div class="footer-columns-grid">
      <!-- Col 1: Brand & Socials -->
      <div class="footer-col footer-col-brand">
        <a href="{{ route('home') }}" class="brand-logo" style="display: inline-block;">
          <img src="{{ asset('assets/images/logo-light.png') }}" alt="Structurflex Middle East Contracting"
            style="height: 52px; width: auto;">
        </a>
        
        @if(!empty(trim($brandDesc ?? '')))
          <p>{{ $brandDesc }}</p>
        @endif

        @if(count($activeSocials) > 0)
          <div style="display: flex; gap: 0.65rem; flex-wrap: wrap; margin-top: 1.25rem;">
            @foreach($activeSocials as $social)
              <a href="{{ $social['url'] }}" target="_blank" rel="noopener noreferrer"
                style="display: inline-flex; align-items: center; justify-content: center; width: 34px; height: 34px; border-radius: 50%; background: rgba(255,255,255,0.1); color: #fff; transition: all 0.2s ease;"
                aria-label="{{ $social['name'] }}"
                title="{{ $social['name'] }}">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                  {!! $social['svg'] !!}
                </svg>
              </a>
            @endforeach
          </div>
        @endif
      </div>

      <!-- Col 2: Solutions -->
      @if(count($activeSolutions) > 0)
      <div class="footer-col">
        <h4>Our Solutions</h4>
        <ul class="footer-links-list">
          @foreach($activeSolutions as $sol)
            @php
              $href = '#';
              if (($sol['link_type'] ?? '') === 'project' && !empty($sol['project_id']) && isset($projects[$sol['project_id']])) {
                  $href = route('projects.show', $projects[$sol['project_id']]->slug);
              } elseif (!empty($sol['custom_url'])) {
                  $href = $sol['custom_url'];
              }
            @endphp
            <li><a href="{{ $href }}">{{ $sol['label'] }}</a></li>
          @endforeach
        </ul>
      </div>
      @endif

      <!-- Col 3: Company -->
      @if(count($activeCompanyLinks) > 0)
      <div class="footer-col">
        <h4>Company</h4>
        <ul class="footer-links-list">
          @foreach($activeCompanyLinks as $item)
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
            <li><a href="{{ $pageUrl }}">{{ $item['label'] }}</a></li>
          @endforeach
        </ul>
      </div>
      @endif

      <!-- Col 4: Get In Touch (hide if all empty) -->
      @if($hasContactInfo)
      <div class="footer-col">
        <h4>Get In Touch</h4>
        <div class="footer-contact-details">
          @if(!empty(trim($address ?? '')))
          <div class="footer-contact-item">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
              <circle cx="12" cy="10" r="3" />
            </svg>
            <span>{{ $address }}</span>
          </div>
          @endif

          @if(!empty(trim($phone ?? '')))
          <div class="footer-contact-item">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path
                d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
            </svg>
            <span>{{ $phone }}</span>
          </div>
          @endif

          @if(!empty(trim($email ?? '')))
          <div class="footer-contact-item">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
              <polyline points="22,6 12,13 2,6" />
            </svg>
            <span>{{ $email }}</span>
          </div>
          @endif

          @if(!empty(trim($website ?? '')))
          <div class="footer-contact-item">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <circle cx="12" cy="12" r="10" />
              <line x1="2" y1="12" x2="22" y2="12" />
              <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z" />
            </svg>
            <span>{{ $website }}</span>
          </div>
          @endif
        </div>
      </div>
      @endif
    </div>
  </div>

  <!-- Strategic Expected Outcomes Bar (Bottom Highlight: only displays non-empty messages) -->
  @if(count($outcomes) > 0)
  <div class="outcomes-bar">
    <div class="container">
      <div class="outcomes-grid" style="grid-template-columns: repeat({{ count($outcomes) }}, minmax(0, 1fr));">
        @foreach($outcomes as $msg)
        <div class="outcome-badge-item">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
            <polyline points="20 6 9 17 4 12" />
          </svg>
          <span>{{ $msg }}</span>
        </div>
        @endforeach
      </div>
    </div>
  </div>
  @endif

  <!-- Sub-Footer Bottom Bar -->
  <div style="background-color: #030c1d;">
    <div class="container">
      <div class="sub-footer-bottom">
        @if(!empty(trim($copyright ?? '')))
        <div>
          &copy; {{ date('Y') }} {{ $copyright }}
        </div>
        @else
        <div>&copy; {{ date('Y') }} Structurflex Middle East Contracting LLC.</div>
        @endif
        <div class="sub-footer-links">
          <a href="{{ route('privacy') }}">Privacy Policy</a>
          <a href="{{ route('terms') }}">Terms of Service</a>
          <a href="{{ route('contact.index') }}">Dubai Office Map</a>
        </div>
      </div>
    </div>
  </div>
</footer>
