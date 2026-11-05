{{-- =========================================================================
   SFXMEC — Tensile Membrane Stadium Motion Graphic Section
   Interactive 3D procedural simulation of a tensile membrane roof rising
   over a stadium: masts, columns, cables, unfolding PTFE fabric, tensioning,
   and dusk lighting with glowing floodlights and architectural statement.
   ========================================================================= --}}
<section class="stadium" id="stadium" aria-label="A tensile membrane roof being built over a stadium">
    <div class="stadium-stage">
        <canvas class="stadium-canvas" id="stadiumCanvas" aria-hidden="true"></canvas>

        <!-- Fallback (no WebGL / reduced motion): illustrative still of a stadium roof -->
        <div class="stadium-fallback" id="stadiumFallback" hidden>
            <img src="{{ asset('assets/images/stadium-roof.webp') }}" width="1200" height="670" alt="Illustration of a stadium with a white tensile membrane roof over the stands">
        </div>
        <div class="stadium-scrim" aria-hidden="true"></div>

        <!-- Opening statement card -->
        <div class="stadium-intro" id="stadiumIntro">
            <p class="stadium-intro-title">Tensile roofs, built for real places.</p>
            <p class="stadium-intro-sub">Scroll to watch a membrane roof rise over a stadium: masts, cables, fabric, tension and light.</p>
        </div>

        <!-- Stage captions (scrubbed dynamically with scroll progression) -->
        <div class="stadium-caption" id="stadiumCaption" aria-live="off">
            <p data-cap="0" class="is-on">Every roof starts with the place it has to shelter.</p>
            <p data-cap="1">Masts and columns rise behind the stand, keeping every seat clear of structure.</p>
            <p data-cap="2">Cables tie the mast heads to the roof edge and anchor back to the ground.</p>
            <p data-cap="3">Welded fabric panels unfold forward from the rear beam.</p>
            <p data-cap="4">Jacked into tension, the membrane pulls smooth into its final saddle shape.</p>
            <p data-cap="5">At dusk the fabric glows over a column-free stand.</p>
        </div>

        <!-- Scroll HUD -->
        <p class="stadium-scroll" id="stadiumScroll"><span style="font-weight: 700; letter-spacing: 0.5px;">Scroll to build</span><i aria-hidden="true"></i></p>
        <p class="stadium-note" id="stadiumNote">Conceptual stadium for illustration, not a delivered project</p>

        <!-- Final headline over the dusk scene -->
        <div class="stadium-final" id="stadiumFinal">
            <h2 class="stadium-title">Engineering Inspiring Spaces.</h2>
            <p class="stadium-sub">Tensile membrane, lightweight and air-supported structures, designed, engineered, fabricated, installed and maintained from Dubai.</p>
            <div class="stadium-ctas">
                <a class="btn btn-light" href="#solutions" style="display: inline-flex; align-items: center; gap: 8px; padding: 0.8rem 1.6rem; font-weight: 700; border-radius: 8px; background: #ffffff; color: #081C38; text-decoration: none; box-shadow: 0 4px 14px rgba(0,0,0,0.25);">
                    Our Solutions
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
                <a class="btn btn-primary" href="{{ route('contact.index') }}" style="display: inline-flex; align-items: center; gap: 8px; padding: 0.8rem 1.6rem; font-weight: 700; border-radius: 8px; background: #008E38; color: #ffffff; text-decoration: none; box-shadow: 0 4px 14px rgba(0,142,56,0.35);">
                    Request a Consultation
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script src="{{ asset('js/vendor/three.min.js') }}"></script>
<script src="{{ asset('js/vendor/ScrollTrigger.min.js') }}"></script>
<script src="{{ asset('js/sfx-kit.js') }}"></script>
<script src="{{ asset('js/stadium-3d.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (window.gsap && window.ScrollTrigger) {
            gsap.registerPlugin(ScrollTrigger);
        }
        if (window.SFX && window.SFX.stadium3d) {
            var reduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            window.SFX.stadium3d.init(reduced);
        }
        window.addEventListener('load', function () {
            if (window.ScrollTrigger) ScrollTrigger.refresh();
        });
    });
</script>
@endpush

