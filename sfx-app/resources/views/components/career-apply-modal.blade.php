<!-- Career Application Modal -->
<div id="careerApplyModal" class="career-modal-backdrop" style="display: none; position: fixed; inset: 0; z-index: 9999; background: rgba(8, 28, 56, 0.78); backdrop-filter: blur(6px); -webkit-backdrop-filter: blur(6px); align-items: center; justify-content: center; padding: 1.5rem; overflow-y: auto;">
  <div class="career-modal-window" style="background: #ffffff; border-radius: 16px; width: 100%; max-width: 620px; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.35); overflow: hidden; position: relative; margin: auto; animation: modalFadeIn 0.25s ease-out; display: flex; flex-direction: column; max-height: 92vh;">
    
    <!-- Modal Header -->
    <div class="career-modal-header" style="background: #081C38; color: #ffffff; padding: 1.5rem 2rem; position: relative; border-bottom: 3px solid #D99B26; flex-shrink: 0;">
      <span style="background: rgba(255, 255, 255, 0.12); color: #f3b90d; font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; padding: 0.2rem 0.65rem; border-radius: 999px; display: inline-block; margin-bottom: 0.5rem;">
        Direct Application Desk
      </span>
      <h3 style="font-size: 1.35rem; font-weight: 800; color: #ffffff; margin: 0; line-height: 1.3;">
        Submit CV &amp; Response
      </h3>
      <p id="modalJobDisplay" style="color: #cbd5e1; font-size: 0.88rem; margin: 0.35rem 0 0; line-height: 1.4; padding-right: 2rem;">
        Position: <strong id="modalJobTitleText" style="color: #ffffff;">General Application</strong>
      </p>

      <button type="button" onclick="closeCareerApplyModal()" aria-label="Close modal" style="position: absolute; top: 1.25rem; right: 1.25rem; background: rgba(255,255,255,0.12); border: none; color: #ffffff; width: 34px; height: 34px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: background 0.2s ease;">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
          <line x1="18" y1="6" x2="6" y2="18"></line>
          <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg>
      </button>
    </div>

    <!-- Modal Form (Scrollable Body) -->
    <form class="career-modal-form" action="{{ route('careers.apply') }}" method="POST" enctype="multipart/form-data" style="padding: 2rem; overflow-y: auto; -webkit-overflow-scrolling: touch; flex-grow: 1;">
      @csrf
      <input type="hidden" name="career_id" id="modalCareerId" value="">
      <input type="hidden" name="job_title" id="modalJobTitleInput" value="General Application">

      <!-- Name & Email Row -->
      <div class="career-modal-row form-row-2" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.15rem;">
        <div>
          <label style="display: block; font-size: 0.82rem; font-weight: 700; color: #081C38; margin-bottom: 0.35rem;">
            Full Name *
          </label>
          <input type="text" name="name" required placeholder="e.g. Eng. Tariq Mansoor" class="career-modal-input" style="width: 100%; padding: 0.75rem 1rem; border: 1.5px solid #cbd5e1; border-radius: 8px; font-size: 0.9rem; box-sizing: border-box;">
        </div>
        <div>
          <label style="display: block; font-size: 0.82rem; font-weight: 700; color: #081C38; margin-bottom: 0.35rem;">
            Email Address *
          </label>
          <input type="email" name="email" required placeholder="tariq@example.ae" class="career-modal-input" style="width: 100%; padding: 0.75rem 1rem; border: 1.5px solid #cbd5e1; border-radius: 8px; font-size: 0.9rem; box-sizing: border-box;">
        </div>
      </div>

      <!-- Phone & Portfolio Row -->
      <div class="career-modal-row form-row-2" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.15rem;">
        <div>
          <label style="display: block; font-size: 0.82rem; font-weight: 700; color: #081C38; margin-bottom: 0.35rem;">
            Telephone / WhatsApp *
          </label>
          <input type="tel" name="phone" required placeholder="+971 50 000 0000" class="career-modal-input" style="width: 100%; padding: 0.75rem 1rem; border: 1.5px solid #cbd5e1; border-radius: 8px; font-size: 0.9rem; box-sizing: border-box;">
        </div>
        <div>
          <label style="display: block; font-size: 0.82rem; font-weight: 700; color: #081C38; margin-bottom: 0.35rem;">
            LinkedIn / Portfolio URL
          </label>
          <input type="url" name="portfolio_url" placeholder="https://linkedin.com/in/..." class="career-modal-input" style="width: 100%; padding: 0.75rem 1rem; border: 1.5px solid #cbd5e1; border-radius: 8px; font-size: 0.9rem; box-sizing: border-box;">
        </div>
      </div>

      <!-- Cover Letter / Candidate Response -->
      <div style="margin-bottom: 1.15rem;">
        <label style="display: block; font-size: 0.82rem; font-weight: 700; color: #081C38; margin-bottom: 0.35rem;">
          Candidate Response &amp; Experience Statement *
        </label>
        <textarea name="cover_letter" rows="4" required placeholder="Describe your tensile membrane background, structural software tools (ANSYS, Rhino/Grasshopper, Easy), and key architectural achievements..." class="career-modal-input" style="width: 100%; padding: 0.75rem 1rem; border: 1.5px solid #cbd5e1; border-radius: 8px; font-size: 0.9rem; line-height: 1.5; box-sizing: border-box; resize: vertical;"></textarea>
      </div>

      <!-- Upload CV File -->
      <div style="margin-bottom: 1.75rem;">
        <label style="display: block; font-size: 0.82rem; font-weight: 700; color: #081C38; margin-bottom: 0.35rem;">
          Attach Curriculum Vitae (CV / Resume) *
        </label>
        <div style="position: relative; border: 2px dashed #0B5ED7; border-radius: 10px; background: #F8FAFC; padding: 1.1rem 1rem; text-align: center; box-sizing: border-box;">
          <input type="file" name="cv" required accept=".pdf,.doc,.docx,.zip" style="width: 100%; font-size: 0.88rem; color: #475569; cursor: pointer; max-width: 100%;">
          <small style="display: block; color: #64748b; font-size: 0.78rem; margin-top: 0.45rem;">
            Supported formats: PDF, DOC, DOCX, ZIP (Max 20MB)
          </small>
        </div>
      </div>

      <!-- Submit & Cancel Buttons Container -->
      <div class="career-modal-actions">
        <button type="button" onclick="closeCareerApplyModal()" class="btn btn-outline btn-modal-cancel">
          Cancel
        </button>
        <button type="submit" class="btn btn-primary btn-modal-submit">
          <span>Submit CV &amp; Application</span>
          <span>&rarr;</span>
        </button>
      </div>
    </form>
  </div>
</div>

<style>
@keyframes modalFadeIn {
  from { opacity: 0; transform: scale(0.96) translateY(12px); }
  to { opacity: 1; transform: scale(1) translateY(0); }
}

.career-modal-backdrop[style*="display: flex"] {
  display: flex !important;
}

/* Default Desktop Actions */
.career-modal-actions {
  display: flex;
  gap: 1rem;
  align-items: center;
  justify-content: flex-end;
  padding-top: 0.5rem;
}

.btn-modal-cancel {
  padding: 0.8rem 1.4rem;
  font-size: 0.9rem;
  font-weight: 600;
}

.btn-modal-submit {
  padding: 0.8rem 1.75rem;
  font-size: 0.92rem;
  font-weight: 700;
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
}

/* Small Screens & Mobile Optimization */
@media (max-width: 640px) {
  .career-modal-backdrop {
    padding: 0.65rem !important;
    align-items: center !important;
  }

  .career-modal-window {
    max-height: calc(100vh - 1.25rem) !important;
    border-radius: 14px !important;
    margin: 0 !important;
    width: 100% !important;
  }

  .career-modal-header {
    padding: 1.15rem 1.15rem 0.95rem !important;
  }

  .career-modal-header h3 {
    font-size: 1.15rem !important;
  }

  .career-modal-form {
    padding: 1.15rem !important;
  }

  .career-modal-row {
    grid-template-columns: 1fr !important;
    gap: 0.85rem !important;
    margin-bottom: 0.85rem !important;
  }

  .career-modal-input {
    font-size: 16px !important; /* Prevents auto-zoom on mobile browsers */
  }

  /* Full display of action buttons on small screen */
  .career-modal-actions {
    display: flex !important;
    flex-direction: column-reverse !important; /* Promotes primary submit to top, cancel below */
    gap: 0.65rem !important;
    width: 100% !important;
    margin-top: 1.25rem !important;
    padding-top: 0 !important;
  }

  .career-modal-actions .btn {
    width: 100% !important;
    justify-content: center !important;
    text-align: center !important;
    box-sizing: border-box !important;
    white-space: normal !important; /* Allows wrapping if viewport is very narrow like 320px */
    padding: 0.85rem 1rem !important;
    font-size: 0.95rem !important;
    border-radius: 8px !important;
  }

  .btn-modal-submit {
    order: 1 !important;
  }

  .btn-modal-cancel {
    order: 2 !important;
  }
}

@media (max-width: 380px) {
  .career-modal-header h3 {
    font-size: 1.05rem !important;
  }
  .career-modal-form {
    padding: 0.95rem !important;
  }
  .career-modal-actions .btn {
    font-size: 0.88rem !important;
    padding: 0.75rem 0.75rem !important;
  }
}
</style>

<script>
function openCareerApplyModal(careerId, jobTitle) {
  const modal = document.getElementById('careerApplyModal');
  const modalCareerId = document.getElementById('modalCareerId');
  const modalJobTitleInput = document.getElementById('modalJobTitleInput');
  const modalJobTitleText = document.getElementById('modalJobTitleText');

  if (modalCareerId) modalCareerId.value = careerId || '';
  if (modalJobTitleInput) modalJobTitleInput.value = jobTitle || 'General Application';
  if (modalJobTitleText) modalJobTitleText.textContent = jobTitle || 'General Application';

  if (modal) {
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
  }
}

function closeCareerApplyModal() {
  const modal = document.getElementById('careerApplyModal');
  if (modal) {
    modal.style.display = 'none';
    document.body.style.overflow = '';
  }
}

// Close on backdrop click
document.addEventListener('DOMContentLoaded', function() {
  const modal = document.getElementById('careerApplyModal');
  if (modal) {
    modal.addEventListener('click', function(e) {
      if (e.target === modal) {
        closeCareerApplyModal();
      }
    });
  }

  // Close on Escape key
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
      closeCareerApplyModal();
    }
  });
});
</script>
