@php
  $heritageLine1 = \App\Models\Setting::get('header_heritage_line1', 'Years of Heritage');
  $heritageLine2 = \App\Models\Setting::get('header_heritage_line2', '(Since 1937)');

  $ctaText = \App\Models\Setting::get('header_cta_text', 'Request a Consultation');
  $ctaUrl = \App\Models\Setting::get('header_cta_url', route('contact.index'));
  $ctaVisible = (bool) \App\Models\Setting::get('header_cta_visible', true);

  $rawNav = \App\Models\Setting::get('header_nav_menu');
  $navMenu = $rawNav ? json_decode($rawNav, true) : null;
  if (!is_array($navMenu) || empty($navMenu)) {
      $navMenu = [
          ['page' => 'home', 'label' => 'Home', 'url' => route('home'), 'is_visible' => true],
          ['page' => 'solutions', 'label' => 'Solutions', 'url' => route('services.index'), 'is_visible' => true],
          ['page' => 'projects', 'label' => 'Projects', 'url' => route('projects.index'), 'is_visible' => true],
          ['page' => 'capabilities', 'label' => 'Capabilities', 'url' => route('services.index') . '#capabilities', 'is_visible' => true],
          ['page' => 'about', 'label' => 'About Us', 'url' => route('about'), 'is_visible' => true],
          ['page' => 'blog', 'label' => 'Resources', 'url' => route('blog.index'), 'is_visible' => true],
          ['page' => 'careers', 'label' => 'Careers', 'url' => route('contact.index', ['inquiry' => 'careers']), 'is_visible' => true],
          ['page' => 'contact', 'label' => 'Contact', 'url' => route('contact.index'), 'is_visible' => true],
      ];
  }
@endphp

<header class="site-header" id="header">
  <div class="container nav-container">
    <a href="{{ route('home') }}" class="brand-logo" aria-label="Structurflex Middle East Contracting Home">
      <img src="{{ asset('assets/images/logo.png') }}" alt="Structurflex Middle East Contracting" class="brand-logo-img" style="height: 52px; width: auto;">
      @if(!empty(trim($heritageLine1 ?? '')) || !empty(trim($heritageLine2 ?? '')))
      <span class="brand-heritage">
        {{ $heritageLine1 }}
        @if(!empty(trim($heritageLine2 ?? '')))
        <span class="heritage-year">{{ $heritageLine2 }}</span>
        @endif
      </span>
      @endif
    </a>

    <nav aria-label="Main Navigation">
      <ul class="nav-menu">
        @foreach($navMenu as $item)
          @if(($item['is_visible'] ?? true) && !empty(trim($item['label'] ?? '')))
            @php
              $pageKey = $item['page'] ?? '';
              $isActive = false;
              $href = match ($pageKey) {
                  'home' => route('home'),
                  'solutions' => route('services.index'),
                  'projects' => route('projects.index'),
                  'capabilities' => route('services.index') . '#capabilities',
                  'about' => route('about'),
                  'blog' => route('blog.index'),
                  'careers' => route('contact.index', ['inquiry' => 'careers']),
                  'contact' => route('contact.index'),
                  default => $item['url'] ?? '#',
              };

              if ($pageKey === 'home' && request()->routeIs('home')) $isActive = true;
              elseif ($pageKey === 'solutions' && request()->routeIs('services.*')) $isActive = true;
              elseif ($pageKey === 'projects' && request()->routeIs('projects.*')) $isActive = true;
              elseif ($pageKey === 'about' && request()->routeIs('about')) $isActive = true;
              elseif ($pageKey === 'blog' && request()->routeIs('blog.*')) $isActive = true;
              elseif ($pageKey === 'contact' && request()->routeIs('contact.*') && !request()->has('inquiry')) $isActive = true;
            @endphp
            <li><a href="{{ $href }}" class="nav-link {{ $isActive ? 'active' : '' }}">{{ $item['label'] }}</a></li>
          @endif
        @endforeach

        <!-- Mobile Drawer Bottom Actions & Hotline -->
        <li class="mobile-drawer-cta">
          @if($ctaVisible && !empty(trim($ctaText ?? '')))
          <a href="{{ $ctaUrl }}" class="btn btn-request-consult mobile-drawer-btn">
            <span>{{ $ctaText }}</span>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
              <path d="M5 12h14M12 5l7 7-7 7" />
            </svg>
          </a>
          @endif
          <div class="mobile-drawer-contact">
            <a href="tel:+97142388455">📞 +971 4 238 8455</a>
            <a href="mailto:info@structurflex.ae">✉️ info@structurflex.ae</a>
          </div>
        </li>
      </ul>
    </nav>

    <div class="nav-actions">
      @if($ctaVisible && !empty(trim($ctaText ?? '')))
      <a href="{{ $ctaUrl }}" class="btn btn-request-consult" id="btnNavRFP">
        <span class="btn-text-full">{{ $ctaText }}</span>
        <span class="btn-text-mobile">Consult</span>
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <path d="M5 12h14M12 5l7 7-7 7" />
        </svg>
      </a>
      @endif
      <button class="mobile-toggle" aria-label="Toggle Navigation Menu" aria-expanded="false" type="button">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <line x1="3" y1="12" x2="21" y2="12"></line>
          <line x1="3" y1="6" x2="21" y2="6"></line>
          <line x1="3" y1="18" x2="21" y2="18"></line>
        </svg>
      </button>
    </div>
  </div>
</header>
