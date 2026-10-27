<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', \App\Models\Setting::get('site_name', 'Structurflex Middle East Contracting LLC'))</title>
  <meta name="description" content="@yield('description', 'Specialists in Tensile Membrane, Lightweight and Air-Supported Structures across the Middle East, Africa and beyond.')">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Open Graph / Social Media -->
  <meta property="og:type" content="website">
  <meta property="og:url" content="{{ url()->current() }}">
  <meta property="og:title" content="@yield('title', 'Structurflex Middle East Contracting')">
  <meta property="og:description" content="@yield('description', 'Engineering Inspiring Spaces across MENA.')">
  <meta property="og:image" content="{{ asset('assets/images/hero.jpg') }}">

  <!-- Favicon -->
  <link rel="icon" type="image/svg+xml" href="{{ asset('assets/images/favicon.svg') }}">

  <!-- Google Fonts: Inter & Plus Jakarta Sans -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">

  <!-- Core Stylesheet -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  @stack('styles')

  <!-- Schema.org Structured Data -->
  <script type="application/ld+json">
  {
    "@@context": "https://schema.org",
    "@type": "GeneralContractor",
    "name": "{{ \App\Models\Setting::get('site_name', 'Structurflex Middle East Contracting LLC') }}",
    "alternateName": "SFXMEC",
    "url": "{{ url('/') }}",
    "logo": "{{ asset('assets/images/logo.png') }}",
    "image": "{{ asset('assets/images/hero.jpg') }}",
    "description": "Specialists in Tensile Membrane, Lightweight and Air-Supported Structures across the Middle East, Africa and beyond.",
    "foundingDate": "1937",
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "{{ \App\Models\Setting::get('dubai_address') }}",
      "addressLocality": "Dubai",
      "addressCountry": "AE"
    },
    "email": "{{ \App\Models\Setting::get('general_email') }}",
    "telephone": "{{ \App\Models\Setting::get('dubai_phone') }}"
  }
  </script>
</head>
<body>
  @include('components.header')

  <main>
    @if(session('success'))
      <div class="container" style="margin-top: 5rem; margin-bottom: -3rem;">
        <div style="background: rgba(16, 185, 129, 0.15); border: 1px solid #10b981; color: #10b981; padding: 1rem 1.5rem; border-radius: 8px; font-weight: 600; display: flex; align-items: center; justify-content: space-between;">
          <span>✓ {{ session('success') }}</span>
          <button onclick="this.parentElement.remove()" style="background: none; border: none; color: #10b981; font-size: 1.25rem; cursor: pointer;">&times;</button>
        </div>
      </div>
    @endif

    @yield('content')
  </main>

  @include('components.project-modal')
  @include('components.estimator-modal')
  @include('components.footer')

  <!-- Core JavaScript -->
  <script src="{{ asset('js/app.js') }}"></script>
  @stack('scripts')
</body>
</html>
