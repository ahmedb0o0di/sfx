@php
  $wfVisible = (bool) \App\Models\Setting::get('workflow_section_visible', true);
  $wfTag = \App\Models\Setting::get('workflow_section_tag', 'Turnkey Workflow');
  $wfTitle = \App\Models\Setting::get('workflow_section_title', 'OUR CAPABILITIES');
  $wfSubtitle = \App\Models\Setting::get('workflow_section_subtitle', 'From initial mathematical form-finding to lifetime structural stewardship, Structurflex Middle East manages the entire project lifecycle in-house.');
  
  $wfStepsRaw = \App\Models\Setting::get('workflow_steps');
  if ($wfStepsRaw) {
      $wfSteps = json_decode($wfStepsRaw, true);
  } else {
      $wfSteps = [
          ['step_num' => 'Step 01', 'title' => 'Design', 'icon' => 'design', 'description' => 'Parametric form-finding, 3D architectural geometry, conceptual equilibrium modeling & digital prototyping.', 'is_visible' => true],
          ['step_num' => 'Step 02', 'title' => 'Engineering', 'icon' => 'engineering', 'description' => 'Advanced membrane analysis, non-linear FEA, computational wind load modeling, and structural cable sizing.', 'is_visible' => true],
          ['step_num' => 'Step 03', 'title' => 'Fabrication', 'icon' => 'fabrication', 'description' => 'State-of-the-art cleanroom manufacturing, automated CNC precision cutting, and high-frequency molecular seaming.', 'is_visible' => true],
          ['step_num' => 'Step 04', 'title' => 'Installation', 'icon' => 'installation', 'description' => 'Expert site execution, certified master rigging, crane erection, laser-measured pre-stressing, and stringent HSE.', 'is_visible' => true],
          ['step_num' => 'Step 05', 'title' => 'Inspection & AMC', 'icon' => 'maintenance', 'description' => 'Regular membrane condition audits, non-destructive cleaning, cable re-tensioning, and lifetime preventive maintenance.', 'is_visible' => true],
      ];
  }
  $visibleWfSteps = array_filter($wfSteps ?? [], fn($s) => !isset($s['is_visible']) || $s['is_visible']);
@endphp

@if($wfVisible)
<!-- ==========================================================================
     SECTION: OUR CAPABILITIES (END-TO-END PROCESS WORKFLOW)
     ========================================================================== -->
<section class="capabilities-deep-section" id="capabilities">
  <div class="container">
    <div class="section-header text-center" style="margin-bottom: 2rem;">
      <span class="section-tag"
        style="background: rgba(11, 94, 215, 0.2); color: #60a5fa; border: 1px solid rgba(11, 94, 215, 0.4); font-weight: 700; font-size: 0.78rem; text-transform: uppercase; letter-spacing: 1px; padding: 0.35rem 0.9rem; border-radius: 999px;">{{ $wfTag }}</span>
      <h2 class="section-title" style="margin-top: 0.75rem;">{{ $wfTitle }}</h2>
      <p class="section-subtitle">
        {{ $wfSubtitle }}
      </p>
    </div>

    <div class="capabilities-chain">
      @foreach($visibleWfSteps as $index => $step)
      <div class="capability-step-card">
        <div class="capability-icon-bubble">
          @php $icon = $step['icon'] ?? ($index === 0 ? 'design' : ($index === 1 ? 'engineering' : ($index === 2 ? 'fabrication' : ($index === 3 ? 'installation' : 'maintenance')))); @endphp
          @if($icon === 'design')
          <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M12 20h9" />
            <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z" />
          </svg>
          @elseif($icon === 'engineering')
          <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M2 12h20" />
            <path d="M20 12v6a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-6" />
            <path d="M12 2v20" />
            <path d="M7 7l5-5 5 5" />
          </svg>
          @elseif($icon === 'fabrication')
          <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <rect x="2" y="7" width="20" height="14" rx="2" ry="2" />
            <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16" />
          </svg>
          @elseif($icon === 'installation')
          <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
            <polyline points="14 2 14 8 20 8" />
            <line x1="16" y1="13" x2="8" y2="13" />
            <line x1="16" y1="17" x2="8" y2="17" />
          </svg>
          @else
          <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
            <polyline points="9 12 11 14 15 10" />
          </svg>
          @endif
        </div>
        <div class="capability-step-content">
          <div class="capability-step-num">{{ $step['step_num'] ?? ('Step ' . sprintf('%02d', $loop->iteration)) }}</div>
          <h3 class="capability-step-title">{{ $step['title'] ?? '' }}</h3>
          <p class="capability-step-desc">{{ $step['description'] ?? '' }}</p>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>
@endif

