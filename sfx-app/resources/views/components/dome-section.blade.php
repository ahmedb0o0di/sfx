{{-- =========================================================================
   SFXMEC — ASATI Air-Supported Dome Motion Graphic Section ("A roof held up by air")
   Features interactive 3D WebGL procedural membrane inflation over football pitch,
   seamless crossfade to ASATI reference photograph, and high-contrast HUD cards.
   ========================================================================= --}}
<section class="dome" id="dome" aria-labelledby="domeTitle">
    <div class="dome-stage">
        <canvas class="dome-canvas" id="domeCanvas" aria-hidden="true"></canvas>
        <figure class="dome-photo" id="domePhoto">
            <img src="{{ asset('assets/images/air-dome.webp') }}" width="1200" height="670" loading="lazy" alt="ASATI large-span air-supported dome over a sports stadium pitch">
            <figcaption>ASATI Air-Supported Clear Span Facility</figcaption>
        </figure>
        <div class="dome-card">
            <p class="partner-chip">In partnership with ASATI</p>
            <h2 id="domeTitle" class="h-section">A roof held up by air</h2>
            <p>With Air Structures American Technologies, Inc. (ASATI) we engineer air-supported domes with clear spans of 150&nbsp;m and more, for sports, events and bulk storage. A continuous, precision-controlled micro-pressure differential carries the high-performance membrane: zero columns and zero trusses.</p>
            <ul class="dome-facts">
                <li><b>150 m+</b><span>Clear Span</span></li>
                <li><b>0</b><span>Internal Columns</span></li>
                <li><b>One System</b><span>Inflation, HVAC &amp; Safety</span></li>
            </ul>
            <div class="dome-cta-row">
                <a href="{{ route('services.show', 'air-supported-domes') }}" class="btn btn-primary" style="display: inline-flex; align-items: center; gap: 8px; padding: 0.75rem 1.4rem; font-size: 0.92rem; font-weight: 700; text-decoration: none; border-radius: 8px; background: #0B5ED7; color: #fff; box-shadow: 0 4px 14px rgba(11,94,215,0.3);">
                    Explore Air Domes
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
                <a href="{{ route('contact.index') }}" class="btn btn-outline" style="display: inline-flex; align-items: center; padding: 0.75rem 1.2rem; font-size: 0.92rem; font-weight: 600; text-decoration: none; border-radius: 8px; border: 1.5px solid rgba(8,28,56,0.25); color: #081C38;">
                    Request Feasibility
                </a>
            </div>
            <p class="dome-note" id="domeNote">3D Interactive Inflation Simulation &bull; Scroll to inflate</p>
        </div>
    </div>
</section>

@push('scripts')
<script src="{{ asset('js/vendor/ScrollTrigger.min.js') }}"></script>
<script src="{{ asset('js/vendor/three.min.js') }}"></script>
<script src="{{ asset('js/sfx-kit.js') }}"></script>
<script src="{{ asset('js/dome-3d.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (window.gsap && window.ScrollTrigger) {
            gsap.registerPlugin(ScrollTrigger);
        }
        if (window.SFX && window.SFX.dome3d) {
            var reduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            window.SFX.dome3d.init(reduced);
        }
        window.addEventListener('load', function () {
            if (window.ScrollTrigger) ScrollTrigger.refresh();
        });
    });
</script>
@endpush
