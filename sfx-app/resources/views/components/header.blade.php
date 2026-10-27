<header class="site-header" id="header">
  <div class="container nav-container">
    <a href="{{ route('home') }}" class="brand-logo" aria-label="Structurflex Middle East Contracting Home">
      <img src="{{ asset('assets/images/logo.png') }}" alt="Structurflex Middle East Contracting" class="brand-logo-img" style="height: 52px; width: auto;">
      <span class="brand-heritage">
        Years of Heritage
        <span class="heritage-year">(Since 1937)</span>
      </span>
    </a>

    <nav aria-label="Main Navigation">
      <ul class="nav-menu">
        <li><a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
        <li><a href="{{ route('services.index') }}" class="nav-link {{ request()->routeIs('services.*') ? 'active' : '' }}">Solutions</a></li>
        <li><a href="{{ route('projects.index') }}" class="nav-link {{ request()->routeIs('projects.*') ? 'active' : '' }}">Projects</a></li>
        <li><a href="{{ route('services.index') }}#capabilities" class="nav-link">Capabilities</a></li>
        <li><a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">About Us</a></li>
        <li><a href="{{ route('blog.index') }}" class="nav-link {{ request()->routeIs('blog.*') ? 'active' : '' }}">Resources</a></li>
        <li><a href="{{ route('contact.index', ['inquiry' => 'careers']) }}" class="nav-link">Careers</a></li>
        <li><a href="{{ route('contact.index') }}" class="nav-link {{ request()->routeIs('contact.*') ? 'active' : '' }}">Contact</a></li>
      </ul>
    </nav>

    <div class="nav-actions">
      <a href="{{ route('contact.index') }}" class="btn btn-request-consult" id="btnNavRFP">
        <span>Request a Consultation</span>
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <path d="M5 12h14M12 5l7 7-7 7" />
        </svg>
      </a>
      <button class="mobile-toggle" aria-label="Toggle Navigation Menu" aria-expanded="false">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <line x1="3" y1="12" x2="21" y2="12"></line>
          <line x1="3" y1="6" x2="21" y2="6"></line>
          <line x1="3" y1="18" x2="21" y2="18"></line>
        </svg>
      </button>
    </div>
  </div>
</header>
