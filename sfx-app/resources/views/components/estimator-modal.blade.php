<div class="modal-overlay" id="estimatorModal" role="dialog" aria-modal="true" aria-labelledby="estimatorModalTitle" style="display: none;">
  <div class="modal-card" style="max-width: 860px; padding: 2.5rem; background: #070B14; border: 1px solid rgba(243, 185, 13, 0.3); border-radius: 16px; color: #fff; box-shadow: 0 25px 60px rgba(0,0,0,0.8);">
    <button class="modal-close-btn" id="estimatorCloseBtn" aria-label="Close Estimator Modal" style="color: #cbd5e1; font-size: 1.8rem; top: 1.25rem; right: 1.5rem;">&times;</button>
    
    <div style="margin-bottom: 2rem;">
      <span style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1.5px; color: #f3b90d; font-weight: 700;">Interactive Engineering Calculator</span>
      <h3 id="estimatorModalTitle" style="font-size: 1.85rem; font-weight: 800; color: #ffffff; margin-top: 0.35rem;">Dynamic Scope &amp; RFP Cost Estimator</h3>
      <p style="color: #94a3b8; font-size: 0.9rem; line-height: 1.5; margin-top: 0.25rem;">
        Configure footprint area, structural typology, and membrane specifications to generate instant preliminary structural calculations and submit a formal tender inquiry.
      </p>
    </div>

    <form id="scopeEstimatorForm">
      @csrf
      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
        <!-- Structure Typology -->
        <div>
          <label style="display: block; font-size: 0.8rem; font-weight: 700; color: #cbd5e1; margin-bottom: 0.5rem; text-transform: uppercase;">Structure Typology</label>
          <select id="estStructureType" name="structure_type" style="width: 100%; padding: 0.85rem 1rem; background: #0c1527; border: 1px solid #1e293b; border-radius: 8px; color: #fff; font-size: 0.9rem;">
            <option value="Architectural Tensile Canopy">Architectural Tensile Canopy (Conical / Saddle)</option>
            <option value="Single/Double Skin ETFE Atrium">Single/Double Skin ETFE Atrium Skylight</option>
            <option value="ASATI Air-Supported Multisport Dome">ASATI Air-Supported Multisport Dome</option>
            <option value="Sports Spectator Grandstand Canopy">Sports Spectator Grandstand Canopy</option>
            <option value="Transport Concourse Membrane">Transport Concourse Membrane</option>
          </select>
        </div>

        <!-- Membrane Selection -->
        <div>
          <label style="display: block; font-size: 0.8rem; font-weight: 700; color: #cbd5e1; margin-bottom: 0.5rem; text-transform: uppercase;">Membrane Specification</label>
          <select id="estMembrane" name="membrane_choice" style="width: 100%; padding: 0.85rem 1rem; background: #0c1527; border: 1px solid #1e293b; border-radius: 8px; color: #fff; font-size: 0.9rem;">
            <option value="PTFE" data-rate="1.3" data-light="12% – 20%" data-life="35+ Years">PTFE Coated Fiberglass (Class A1 Non-Combustible)</option>
            <option value="ETFE" data-rate="1.8" data-light="85% – 95%" data-life="50+ Years">ETFE Fluoropolymer Foil (Pneumatic Cushion / Single)</option>
            <option value="PVC" data-rate="1.0" data-light="6% – 12%" data-life="18 – 25 Years">High-Tensile PVC/PVDF (Heavy Duty Composite)</option>
          </select>
        </div>
      </div>

      <!-- Area Slider -->
      <div style="background: #0c1527; border: 1px solid #1e293b; border-radius: 12px; padding: 1.5rem; margin-bottom: 1.75rem;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem;">
          <span style="font-size: 0.85rem; font-weight: 700; color: #cbd5e1; text-transform: uppercase;">Covered Footprint Area</span>
          <span style="font-size: 1.35rem; font-weight: 800; color: #f3b90d;"><span id="estAreaDisplay">2,500</span> m²</span>
        </div>
        <input type="range" id="estAreaSlider" name="footprint_area" min="100" max="25000" step="50" value="2500" style="width: 100%; accent-color: #f3b90d; cursor: pointer;">
        <div style="display: flex; justify-content: space-between; font-size: 0.75rem; color: #64748b; margin-top: 0.5rem;">
          <span>100 m² (Small Canopy)</span>
          <span>10,000 m² (Arena)</span>
          <span>25,000 m² (Mega-Hub)</span>
        </div>
      </div>

      <!-- Live Calculation Dashboard -->
      <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-bottom: 2rem;" class="est-metrics-grid">
        <div style="background: rgba(243, 185, 13, 0.08); border: 1px solid rgba(243, 185, 13, 0.2); border-radius: 8px; padding: 1rem; text-align: center;">
          <span style="font-size: 0.72rem; color: #94a3b8; text-transform: uppercase; font-weight: 700; display: block;">Est. Membrane Weight</span>
          <span id="estWeight" style="font-size: 1.25rem; font-weight: 800; color: #fff;">3.8 Tons</span>
        </div>
        <div style="background: rgba(255, 255, 255, 0.04); border: 1px solid #1e293b; border-radius: 8px; padding: 1rem; text-align: center;">
          <span style="font-size: 0.72rem; color: #94a3b8; text-transform: uppercase; font-weight: 700; display: block;">Light Transmission</span>
          <span id="estLight" style="font-size: 1.15rem; font-weight: 700; color: #38bdf8;">12% – 20%</span>
        </div>
        <div style="background: rgba(255, 255, 255, 0.04); border: 1px solid #1e293b; border-radius: 8px; padding: 1rem; text-align: center;">
          <span style="font-size: 0.72rem; color: #94a3b8; text-transform: uppercase; font-weight: 700; display: block;">Expected Life</span>
          <span id="estLifespan" style="font-size: 1.15rem; font-weight: 700; color: #10b981;">35+ Years</span>
        </div>
        <div style="background: rgba(255, 255, 255, 0.04); border: 1px solid #1e293b; border-radius: 8px; padding: 1rem; text-align: center;">
          <span style="font-size: 0.72rem; color: #94a3b8; text-transform: uppercase; font-weight: 700; display: block;">Turnaround Schedule</span>
          <span id="estSchedule" style="font-size: 1.15rem; font-weight: 700; color: #f3b90d;">12 – 16 Wks</span>
        </div>
      </div>

      <!-- Contact Capture to Request Formal Tender Quote -->
      <div style="border-top: 1px solid #1e293b; padding-top: 1.5rem;">
        <span style="font-size: 0.85rem; font-weight: 700; color: #cbd5e1; text-transform: uppercase; display: block; margin-bottom: 1rem;">
          Submit Specifications for Formal Engineering Tender &amp; Pricing
        </span>
        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
          <input type="text" name="client_name" required placeholder="Your Full Name *" style="padding: 0.75rem 1rem; background: #0c1527; border: 1px solid #1e293b; border-radius: 6px; color: #fff; font-size: 0.88rem;">
          <input type="email" name="client_email" required placeholder="Corporate Email *" style="padding: 0.75rem 1rem; background: #0c1527; border: 1px solid #1e293b; border-radius: 6px; color: #fff; font-size: 0.88rem;">
          <input type="tel" name="client_phone" required placeholder="Phone / WhatsApp *" style="padding: 0.75rem 1rem; background: #0c1527; border: 1px solid #1e293b; border-radius: 6px; color: #fff; font-size: 0.88rem;">
        </div>
        <div style="display: flex; gap: 1rem;">
          <input type="text" name="company_name" placeholder="Company / Practice Name" style="flex: 1; padding: 0.75rem 1rem; background: #0c1527; border: 1px solid #1e293b; border-radius: 6px; color: #fff; font-size: 0.88rem;">
          <input type="text" name="project_location" placeholder="Project City / Country (e.g. Dubai, UAE)" style="flex: 1; padding: 0.75rem 1rem; background: #0c1527; border: 1px solid #1e293b; border-radius: 6px; color: #fff; font-size: 0.88rem;">
        </div>
      </div>

      <div style="margin-top: 1.5rem; display: flex; align-items: center; justify-content: space-between;">
        <div id="estimatorFeedback" style="font-size: 0.88rem; font-weight: 600;"></div>
        <button type="submit" id="btnSubmitEstimator" class="btn btn-request-consult" style="padding: 0.85rem 2rem;">
          <span>Generate RFP Tender Inquiry</span>
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </button>
      </div>
    </form>
  </div>
</div>
