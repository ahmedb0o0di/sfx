@extends('layouts.app')

@section('title', $service->title . ' | ' . \App\Models\Setting::get('site_name'))
@section('description', $service->summary)

@section('content')
<!-- Service Banner -->
<section style="background: #081C38; color: #fff; padding: 7.5rem 0 4.5rem; position: relative; overflow: hidden;">
  <div class="container" style="position: relative; z-index: 2;">
    <div class="breadcrumbs" style="margin-top: 1.5rem; margin-bottom: 1.5rem; font-size: 0.85rem; color: #94a3b8;">
      <a href="{{ route('home') }}" style="color: #cbd5e1; text-decoration: none;">Home</a>
      <span style="margin: 0 0.5rem;">/</span>
      <a href="{{ route('services.index') }}" style="color: #cbd5e1; text-decoration: none;">Solutions</a>
      <span style="margin: 0 0.5rem;">/</span>
      <span style="color: #f3b90d;">{{ $service->title }}</span>
    </div>

    <span class="section-tag" style="background: rgba(255, 255, 255, 0.12); color: #f3b90d; border: 1px solid rgba(255, 255, 255, 0.2); font-weight: 700; font-size: 0.78rem; text-transform: uppercase; padding: 0.35rem 0.9rem; border-radius: 999px;">
      {{ $service->subtitle }}
    </span>
    <h1 style="font-size: 2.85rem; font-weight: 800; color: #ffffff; margin: 1rem 0 0.75rem;">
      {{ $service->title }}
    </h1>
    <p style="font-size: 1.15rem; color: #cbd5e1; max-width: 720px; line-height: 1.6;">
      {{ $service->summary }}
    </p>
  </div>
</section>

<!-- Content Section -->
<section class="section" style="background-color: #F8FAFC; padding: 4.5rem 0 6rem;">
  <div class="container">
    <div class="service-detail-grid">
      <div>
        @php
          $galleryItems = $service->gallery_items;
          $leadItem = $galleryItems[0] ?? [
              'type' => 'image',
              'url' => $service->image_url,
              'embed_url' => null,
              'thumbnail' => $service->image_url,
              'caption' => $service->title,
              'is_video' => false,
          ];
        @endphp

        <!-- Solution Architectural Media Showcase (Photos & Videos) -->
        <div class="service-lead-showcase" style="border-radius: 14px; overflow: hidden; margin-bottom: 1rem; box-shadow: 0 12px 30px rgba(0,0,0,0.08); background: #081C38; position: relative;">
          
          <!-- Image Host Container -->
          <div id="serviceLeadImgWrap" style="{{ $leadItem['is_video'] ? 'display: none;' : 'display: block;' }} position: relative; width: 100%; min-height: 280px; max-height: 520px; background: #081C38;">
            <img id="serviceLeadImg" src="{{ $leadItem['url'] }}" alt="{{ $leadItem['caption'] ?? $service->title }}" style="width: 100%; height: 100%; max-height: 520px; object-fit: cover; display: block; transition: opacity 0.25s ease;" loading="eager">
          </div>

          <!-- Video Host Container (HTML5 video or Iframe embed) -->
          <div id="serviceLeadVideoWrap" style="{{ $leadItem['is_video'] ? 'display: block;' : 'display: none;' }} position: relative; width: 100%; background: #000;">
            <div id="serviceVideoPlayerHost" style="width: 100%; aspect-ratio: 16/9; max-height: 520px; display: flex; align-items: center; justify-content: center; background: #000;">
              @if($leadItem['is_video'])
                @if(!empty($leadItem['embed_url']))
                  <iframe id="serviceLeadIframe" src="{{ $leadItem['embed_url'] }}" style="width: 100%; height: 100%; border: none;" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                @else
                  <video id="serviceLeadVideo" src="{{ $leadItem['url'] }}" controls playsinline style="width: 100%; height: 100%; max-height: 520px; object-fit: contain;"></video>
                @endif
              @endif
            </div>
          </div>

          <!-- Media Caption & Type Pill Overlay -->
          <div style="position: absolute; bottom: 0; left: 0; right: 0; padding: 0.85rem 1.25rem; background: linear-gradient(180deg, transparent 0%, rgba(8, 28, 56, 0.94) 100%); display: flex; align-items: center; justify-content: space-between; gap: 1rem; z-index: 2; pointer-events: none;">
            <span id="serviceMediaCaption" style="color: #ffffff; font-size: 0.88rem; font-weight: 600; text-shadow: 0 1px 3px rgba(0,0,0,0.7); overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
              {{ $leadItem['caption'] ?? $service->title }}
            </span>
            <span id="serviceMediaTypeBadge" style="background: rgba(243, 185, 13, 0.95); color: #081C38; font-size: 0.72rem; font-weight: 800; text-transform: uppercase; padding: 0.2rem 0.65rem; border-radius: 4px; letter-spacing: 0.04em; white-space: nowrap; box-shadow: 0 2px 6px rgba(0,0,0,0.25);">
              {{ $leadItem['is_video'] ? '🎥 VIDEO' : '📸 PHOTO' }}
            </span>
          </div>
        </div>

        <!-- Thumbnail Gallery Strip (Rendered when 2+ media items exist) -->
        @if(count($galleryItems) > 1)
        <div class="service-gallery-strip" id="serviceGalleryStrip" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(95px, 1fr)); gap: 0.75rem; margin-bottom: 2rem;">
          @foreach($galleryItems as $idx => $item)
          <button type="button"
                  class="service-gallery-thumb {{ $idx === 0 ? 'active' : '' }}"
                  onclick='switchServiceMedia(@json($item), this)'
                  aria-label="{{ $item['caption'] ?? 'Media ' . ($idx + 1) }}"
                  style="border-radius: 8px; overflow: hidden; height: 75px; border: 2px solid {{ $idx === 0 ? '#0B5ED7' : 'transparent' }}; cursor: pointer; background: #0f172a; padding: 0; position: relative; transition: all 0.2s ease;">
            <img src="{{ $item['thumbnail'] }}" alt="{{ $item['caption'] ?? '' }}" style="width: 100%; height: 100%; object-fit: cover; display: block;" loading="lazy">
            @if($item['is_video'])
            <div style="position: absolute; inset: 0; background: rgba(8, 28, 56, 0.55); display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 2px;">
              <span style="display: flex; align-items: center; justify-content: center; width: 26px; height: 26px; border-radius: 50%; background: #f3b90d; color: #081C38; font-size: 0.72rem; padding-left: 2px; box-shadow: 0 2px 6px rgba(0,0,0,0.5);">▶</span>
              <span style="font-size: 0.58rem; font-weight: 800; color: #fff; text-transform: uppercase; letter-spacing: 0.05em; background: rgba(0,0,0,0.7); padding: 1px 4px; border-radius: 3px;">VIDEO</span>
            </div>
            @endif
          </button>
          @endforeach
        </div>
        @endif

        <div style="background: #fff; border-radius: 12px; padding: 2.5rem; border: 1px solid #e2e8f0;" class="service-detail-body">
          <h2 style="font-size: clamp(1.4rem, 3.5vw, 1.75rem); font-weight: 800; color: var(--navy-primary); margin-bottom: 1rem;">
            System Overview &amp; Architectural Engineering
          </h2>
          <p style="font-size: 1rem; color: #475569; line-height: 1.8; margin-bottom: 1.5rem;">
            {{ $service->description }}
          </p>

          @if(!empty($service->technical_specs) && is_array($service->technical_specs))
          <h3 style="font-size: 1.35rem; font-weight: 800; color: var(--navy-primary); margin: 2rem 0 1rem;">
            Technical Performance Standards
          </h3>
          <div class="service-specs-grid">
            @foreach($service->technical_specs as $key => $val)
            <div style="background: #F8FAFC; border: 1px solid #e2e8f0; border-radius: 8px; padding: 1.25rem;">
              <span style="font-size: 0.75rem; color: #64748b; text-transform: uppercase; font-weight: 700; display: block; margin-bottom: 0.35rem;">{{ $key }}</span>
              <strong style="color: var(--navy-primary); font-size: 1rem;">{{ $val }}</strong>
            </div>
            @endforeach
          </div>
          @endif
        </div>
      </div>

      <!-- Right Column: Consultation Card -->
      <div>
        <div style="background: #fff; border-radius: 12px; padding: 2rem; border: 1px solid #e2e8f0; box-shadow: 0 10px 25px rgba(0,0,0,0.04);">
          <h3 style="font-size: 1.25rem; font-weight: 800; color: var(--navy-primary); margin-bottom: 1rem;">
            Request Feasibility Review
          </h3>
          <p style="font-size: 0.88rem; color: #64748b; line-height: 1.6; margin-bottom: 1.5rem;">
            Discuss structural feasibility, fabric selection, and budget estimations with our Dubai engineering practice.
          </p>
          <a href="{{ route('contact.index', ['solution' => $service->slug]) }}" class="btn btn-request-consult" style="width: 100%; justify-content: center; padding: 0.95rem;">
            <span>Consult Our Engineers</span>
            <span>&rarr;</span>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

@push('scripts')
<script>
  function switchServiceMedia(item, thumbBtn) {
    if (!item) return;

    const imgWrap = document.getElementById('serviceLeadImgWrap');
    const videoWrap = document.getElementById('serviceLeadVideoWrap');
    const leadImg = document.getElementById('serviceLeadImg');
    const playerHost = document.getElementById('serviceVideoPlayerHost');
    const captionEl = document.getElementById('serviceMediaCaption');
    const badgeEl = document.getElementById('serviceMediaTypeBadge');

    // Update Caption & Type Pill
    if (captionEl) captionEl.textContent = item.caption || '';
    if (badgeEl) badgeEl.textContent = item.is_video ? '🎥 VIDEO' : '📸 PHOTO';

    if (item.is_video) {
      if (imgWrap) imgWrap.style.display = 'none';
      if (videoWrap) videoWrap.style.display = 'block';

      if (playerHost) {
        if (item.embed_url) {
          playerHost.innerHTML = '<iframe src="' + item.embed_url + '" style="width: 100%; height: 100%; border: none;" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
        } else {
          playerHost.innerHTML = '<video src="' + item.url + '" controls autoplay playsinline style="width: 100%; height: 100%; max-height: 520px; object-fit: contain;"></video>';
        }
      }
    } else {
      // Clear video playback if running
      if (playerHost) playerHost.innerHTML = '';
      if (videoWrap) videoWrap.style.display = 'none';
      if (imgWrap) {
        imgWrap.style.display = 'block';
        if (leadImg) {
          leadImg.style.opacity = '0.35';
          setTimeout(() => {
            leadImg.src = item.url;
            leadImg.alt = item.caption || '';
            leadImg.style.opacity = '1';
          }, 120);
        }
      }
    }

    // Update thumbnail active indicators
    const strip = document.getElementById('serviceGalleryStrip');
    if (strip) {
      strip.querySelectorAll('.service-gallery-thumb').forEach(b => {
        b.style.borderColor = 'transparent';
        b.classList.remove('active');
      });
    }
    if (thumbBtn) {
      thumbBtn.style.borderColor = '#0B5ED7';
      thumbBtn.classList.add('active');
    }
  }
</script>
@endpush
@endsection
