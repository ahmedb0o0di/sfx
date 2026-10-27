<footer class="site-footer-dark">
  <div class="container">
    <div class="footer-grid">
      <!-- Col 1: Brand Info -->
      <div class="footer-col footer-col-brand">
        <a href="{{ route('home') }}" class="footer-logo">
          <img src="{{ asset('assets/images/logo-light.png') }}" alt="Structurflex Middle East" style="height: 48px; width: auto;">
        </a>
        <p class="footer-desc">
          Engineering inspiring spaces and delivering lasting tensile performance across the Middle East, Africa, and international landmark sites since 1937.
        </p>
        <div class="footer-social-links">
          <a href="{{ \App\Models\Setting::get('social_linkedin', '#') }}" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z" />
              <rect x="2" y="9" width="4" height="12" />
              <circle cx="4" cy="4" r="2" />
            </svg>
          </a>
        </div>
      </div>

      <!-- Col 2: Solutions -->
      <div class="footer-col">
        <h4>Solutions</h4>
        <ul class="footer-links">
          <li><a href="{{ route('services.index') }}">Architectural ETFE & PTFE</a></li>
          <li><a href="{{ route('services.index') }}">Sports Stadia Canopies</a></li>
          <li><a href="{{ route('services.index') }}">ASATI Air-Supported Domes</a></li>
          <li><a href="{{ route('services.index') }}">Retail & Commercial Atriums</a></li>
          <li><a href="{{ route('services.index') }}">Transport & Transit Canopies</a></li>
          <li><a href="{{ route('services.index') }}">Lifecycle Maintenance (AMC)</a></li>
        </ul>
      </div>

      <!-- Col 3: Quick Navigation -->
      <div class="footer-col">
        <h4>Quick Navigation</h4>
        <ul class="footer-links">
          <li><a href="{{ route('about') }}">About Structurflex ME</a></li>
          <li><a href="{{ route('projects.index') }}">Featured Projects</a></li>
          <li><a href="{{ route('services.index') }}#capabilities">Our Capabilities</a></li>
          <li><a href="{{ route('home') }}#credentials">ISO Certifications</a></li>
          <li><a href="{{ route('blog.index') }}">Insights & Resources</a></li>
          <li><a href="{{ route('contact.index', ['inquiry' => 'careers']) }}">Careers & Practice</a></li>
          <li><a href="{{ route('contact.index') }}">Contact Us</a></li>
        </ul>
      </div>

      <!-- Col 4: Get In Touch -->
      <div class="footer-col">
        <h4>Regional Hubs</h4>
        <div class="footer-contact-details">
          <div class="footer-contact-item">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
              <circle cx="12" cy="10" r="3" />
            </svg>
            <span><strong>Dubai HQ:</strong> {{ \App\Models\Setting::get('dubai_address', 'Port Saeed, Deira, Dubai, UAE') }}</span>
          </div>
          <div class="footer-contact-item">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
              <circle cx="12" cy="10" r="3" />
            </svg>
            <span><strong>Cairo Office:</strong> {{ \App\Models\Setting::get('cairo_address', 'Degla, Maadi, Cairo, Egypt') }}</span>
          </div>
          <div class="footer-contact-item">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
            </svg>
            <span>{{ \App\Models\Setting::get('dubai_phone', '+971 4 295 9942') }}</span>
          </div>
          <div class="footer-contact-item">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
              <polyline points="22,6 12,13 2,6" />
            </svg>
            <span>{{ \App\Models\Setting::get('general_email', 'info@structurflex.ae') }}</span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Outcomes Bar -->
  <div class="outcomes-bar">
    <div class="container">
      <div class="outcomes-grid">
        <div class="outcome-badge-item">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12" /></svg>
          <span>Stronger Brand Positioning</span>
        </div>
        <div class="outcome-badge-item">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12" /></svg>
          <span>Increased Trust & Credibility</span>
        </div>
        <div class="outcome-badge-item">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12" /></svg>
          <span>Higher Quality Leads</span>
        </div>
        <div class="outcome-badge-item">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12" /></svg>
          <span>Improved Conversion Rate</span>
        </div>
        <div class="outcome-badge-item">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12" /></svg>
          <span>Supporting Business Growth</span>
        </div>
      </div>
    </div>
  </div>

  <!-- Sub-Footer Bottom Bar -->
  <div style="background-color: #030c1d;">
    <div class="container">
      <div class="sub-footer-bottom">
        <div>
          © {{ date('Y') }} {{ \App\Models\Setting::get('site_name', 'Structurflex Middle East Contracting LLC') }}. All rights reserved.
        </div>
        <div class="sub-footer-links">
          <a href="{{ route('privacy') }}">Privacy Policy</a>
          <a href="{{ route('terms') }}">Terms of Service</a>
          <a href="{{ route('contact.index') }}">Regional Locations</a>
        </div>
      </div>
    </div>
  </div>
</footer>
