/**
 * Structurflex Middle East Contracting (SFXMEC) - Option 2 Interactivity
 * Modern Architectural Design Script
 */

document.addEventListener('DOMContentLoaded', () => {
  // Sticky Navigation on Scroll
  const header = document.querySelector('.opt2-header');
  if (header) {
    window.addEventListener('scroll', () => {
      if (window.scrollY > 80) {
        header.classList.add('sticky-scrolled');
      } else {
        header.classList.remove('sticky-scrolled');
      }
    });
  }

  // Mobile Menu Toggle
  const mobileToggle = document.querySelector('.opt2-mobile-toggle');
  const navMenu = document.querySelector('.opt2-nav-menu');
  if (mobileToggle && navMenu) {
    mobileToggle.addEventListener('click', () => {
      const isVisible = navMenu.style.display === 'flex';
      navMenu.style.display = isVisible ? 'none' : 'flex';
      if (!isVisible) {
        navMenu.style.flexDirection = 'column';
        navMenu.style.position = 'absolute';
        navMenu.style.top = '100%';
        navMenu.style.left = '0';
        navMenu.style.right = '0';
        navMenu.style.background = '#0B1626';
        navMenu.style.padding = '1.5rem';
        navMenu.style.borderRadius = '16px';
        navMenu.style.marginTop = '0.5rem';
      }
    });
  }

  // Featured Projects Interactive Slider
  const projectsData = [
    {
      title: "Abu Dhabi Shooting Club PTFE Canopy",
      category: "Sports & Recreation",
      desc: "Turnkey architectural PTFE membrane roof covering 6,200 sq.m with engineered flying masts, custom tension rigging, and desert-grade wind load resistance.",
      location: "Abu Dhabi, UAE",
      material: "Premium PTFE Glass Fiber",
      img: "assets/images/projects/abu-dhabi-shooting-club.jpg"
    },
    {
      title: "Dubai Outlet Mall Tensile Canopies",
      category: "Commercial & Retail",
      desc: "Custom conical architectural tensile structures engineered to create shaded exterior retail thoroughfares with 100% UV protection and thermal comfort.",
      location: "Dubai, UAE",
      material: "High-Grade PVDF Membrane",
      img: "assets/images/projects/dubai-outlet-mall.jpg"
    },
    {
      title: "Al Jamea University ETFE Skylight Atrium",
      category: "Educational ETFE Atrium",
      desc: "3-layer pneumatic ETFE cushion system delivering diffused natural daylight while deflecting extreme solar heat gain across Dubai's harsh climate.",
      location: "Dubai, UAE",
      material: "ETFE Cushion Foil",
      img: "assets/images/projects/al-jamea-etfe.png"
    },
    {
      title: "ASATI Climate-Controlled Air Dome",
      category: "Exclusive ASATI Partner",
      desc: "Rapidly deployable air-supported sports structure spanning 4,500 sq.m with specialized triple-redundancy HVAC, thermal insulation, and backup blowers.",
      location: "Sharjah, UAE",
      material: "Heavy-Duty Vinyl Fabric",
      img: "assets/images/projects/air-supported-asati.jpg"
    },
    {
      title: "Arena Corinthians World Cup Stadium Roof",
      category: "Sports & Stadiums",
      desc: "Massive tensioned architectural membrane roof engineered for international FIFA tournament standards, non-linear seismic flexibility, and rapid drainage.",
      location: "International Landmark",
      material: "Structural PTFE Membrane",
      img: "assets/images/projects/arena-corinthians.jpg"
    }
  ];

  let currentProjectIdx = 0;
  const projectImg = document.getElementById('opt2ShowcaseImg');
  const projectTitle = document.getElementById('opt2ShowcaseTitle');
  const projectCat = document.getElementById('opt2ShowcaseCat');
  const projectDesc = document.getElementById('opt2ShowcaseDesc');
  const projectLocation = document.getElementById('opt2ShowcaseLoc');
  const projectMaterial = document.getElementById('opt2ShowcaseMat');
  const projectCounter = document.getElementById('opt2ShowcaseCounter');
  const prevBtn = document.getElementById('opt2PrevProject');
  const nextBtn = document.getElementById('opt2NextProject');

  function updateProject(idx) {
    if (!projectTitle) return;
    const p = projectsData[idx];
    
    // Smooth fade effect
    if (projectImg) {
      projectImg.style.opacity = '0';
      setTimeout(() => {
        projectImg.src = p.img;
        projectImg.alt = p.title;
        projectImg.style.opacity = '1';
      }, 200);
    }
    
    projectTitle.textContent = p.title;
    projectCat.textContent = p.category;
    projectDesc.textContent = p.desc;
    if (projectLocation) projectLocation.textContent = p.location;
    if (projectMaterial) projectMaterial.textContent = p.material;
    if (projectCounter) {
      projectCounter.innerHTML = `<span>0${idx + 1}</span> / 0${projectsData.length}`;
    }
  }

  if (prevBtn) {
    prevBtn.addEventListener('click', () => {
      currentProjectIdx = (currentProjectIdx - 1 + projectsData.length) % projectsData.length;
      updateProject(currentProjectIdx);
    });
  }

  if (nextBtn) {
    nextBtn.addEventListener('click', () => {
      currentProjectIdx = (currentProjectIdx + 1) % projectsData.length;
      updateProject(currentProjectIdx);
    });
  }

  // Testimonials Interactivity
  const testimonialCards = document.querySelectorAll('.opt2-testimonial-card');
  const tPrevBtn = document.getElementById('opt2PrevTestimonial');
  const tNextBtn = document.getElementById('opt2NextTestimonial');

  if (tPrevBtn && tNextBtn && testimonialCards.length > 0) {
    let tIndex = 0;
    const toggleTestimonial = (direction) => {
      testimonialCards.forEach(c => {
        c.style.transform = direction === 'next' ? 'translateX(5px)' : 'translateX(-5px)';
        setTimeout(() => { c.style.transform = 'none'; }, 250);
      });
    };
    tPrevBtn.addEventListener('click', () => toggleTestimonial('prev'));
    tNextBtn.addEventListener('click', () => toggleTestimonial('next'));
  }

  // Smooth Scroll for Internal Anchor Links
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
      const targetId = this.getAttribute('href');
      if (targetId === '#' || targetId === '') return;
      const targetElement = document.querySelector(targetId);
      if (targetElement) {
        e.preventDefault();
        targetElement.scrollIntoView({
          behavior: 'smooth',
          block: 'start'
        });
      }
    });
  });
});
