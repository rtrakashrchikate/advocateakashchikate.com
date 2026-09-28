/* ============================================================
   ADVOCATE AKASH CHIKATE — Main JavaScript
   ============================================================ */

document.addEventListener('DOMContentLoaded', function () {

  /* ── 1. NAVBAR SCROLL EFFECT ─────────────────────────── */
  const navbar = document.getElementById('navbar');
  const scrollBtn = document.querySelector('.float-scroll');

  window.addEventListener('scroll', () => {
    const y = window.scrollY;
    if (navbar) {
      navbar.classList.toggle('scrolled', y > 60);
    }
    if (scrollBtn) {
      scrollBtn.classList.toggle('show', y > 400);
    }
  }, { passive: true });

  /* ── 2. MOBILE MENU ──────────────────────────────────── */
  const hamburger = document.querySelector('.hamburger');
  const mobileNav = document.querySelector('.mobile-nav');
  const mobileClose = document.querySelector('.mobile-nav-close');

  if (hamburger && mobileNav) {
    hamburger.addEventListener('click', () => mobileNav.classList.add('open'));
    if (mobileClose) mobileClose.addEventListener('click', () => mobileNav.classList.remove('open'));
    mobileNav.querySelectorAll('a').forEach(a => {
      a.addEventListener('click', () => mobileNav.classList.remove('open'));
    });
  }

  /* ── 3. SCROLL REVEAL ANIMATIONS ────────────────────── */
  const revealEls = document.querySelectorAll('.reveal, .reveal-left, .reveal-right');
  if (revealEls.length) {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12, rootMargin: '0px 0px -50px 0px' });

    revealEls.forEach(el => observer.observe(el));
  }

  /* ── 4. ANIMATED STAT COUNTERS ───────────────────────── */
  function animateCounter(el) {
    const target = parseInt(el.dataset.target, 10);
    const duration = 2000;
    const start = performance.now();

    function update(now) {
      const elapsed = now - start;
      const progress = Math.min(elapsed / duration, 1);
      // Easing: ease-out cubic
      const eased = 1 - Math.pow(1 - progress, 3);
      el.textContent = Math.floor(eased * target);
      if (progress < 1) requestAnimationFrame(update);
      else el.textContent = target;
    }
    requestAnimationFrame(update);
  }

  const counters = document.querySelectorAll('[data-target]');
  if (counters.length) {
    const counterObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          animateCounter(entry.target);
          counterObserver.unobserve(entry.target);
        }
      });
    }, { threshold: 0.15 });
    counters.forEach(c => counterObserver.observe(c));
  }

  /* ── 5. FAQ ACCORDION ────────────────────────────────── */
  document.querySelectorAll('.faq-question').forEach(btn => {
    btn.addEventListener('click', () => {
      const item = btn.closest('.faq-item');
      const isOpen = item.classList.contains('open');
      // Close all
      document.querySelectorAll('.faq-item').forEach(i => i.classList.remove('open'));
      // Toggle clicked
      if (!isOpen) item.classList.add('open');
    });
  });

  /* ── 6. SMOOTH SCROLL FOR ANCHORS ───────────────────── */
  document.querySelectorAll('a[href^="#"]').forEach(link => {
    link.addEventListener('click', e => {
      const target = document.querySelector(link.getAttribute('href'));
      if (target) {
        e.preventDefault();
        const offset = 80;
        const top = target.getBoundingClientRect().top + window.scrollY - offset;
        window.scrollTo({ top, behavior: 'smooth' });
      }
    });
  });

  /* ── 7. ACTIVE NAV LINK ON SCROLL ────────────────────── */
  const sections = document.querySelectorAll('section[id]');
  const navLinks = document.querySelectorAll('.nav-links a');

  if (sections.length && navLinks.length) {
    window.addEventListener('scroll', () => {
      const y = window.scrollY + 120;
      sections.forEach(sec => {
        const top = sec.offsetTop;
        const bottom = top + sec.offsetHeight;
        const id = sec.getAttribute('id');
        const link = document.querySelector(`.nav-links a[href="#${id}"]`);
        if (link) {
          link.classList.toggle('active', y >= top && y < bottom);
        }
      });
    }, { passive: true });
  }

  /* ── 8. SCROLL-TO-TOP BUTTON ─────────────────────────── */
  if (scrollBtn) {
    scrollBtn.addEventListener('click', () => {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }

  /* ── 9. CONSULTATION FORM SUBMISSION ─────────────────── */
  document.querySelectorAll('form.consult-form').forEach(form => {
    form.addEventListener('submit', e => {
      e.preventDefault();
      const btn = form.querySelector('[type="submit"]');
      const successEl = form.closest('.cta-form, .contact-form-wrap')?.querySelector('.form-success');

      // Fake submission animation
      if (btn) {
        btn.disabled = true;
        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Sending...';
      }

      setTimeout(() => {
        form.style.display = 'none';
        if (successEl) successEl.style.display = 'block';
      }, 1500);
    });
  });

  /* ── 10. DISCLAIMER BANNER ───────────────────────────── */
  const banner = document.getElementById('disclaimer-banner');
  const bannerClose = document.getElementById('disclaimer-close');

  if (banner) {
    const dismissed = sessionStorage.getItem('disclaimer-dismissed');
    if (!dismissed) {
      setTimeout(() => banner.classList.add('show'), 1500);
    }
  }
  if (bannerClose && banner) {
    bannerClose.addEventListener('click', () => {
      banner.classList.remove('show');
      sessionStorage.setItem('disclaimer-dismissed', '1');
    });
  }

  /* ── 11. ACTIVE PAGE NAV HIGHLIGHT ──────────────────── */
  const currentPage = window.location.pathname.split('/').pop() || 'index.html';
  document.querySelectorAll('.nav-links a, .mobile-nav a').forEach(a => {
    const href = a.getAttribute('href');
    if (href && href.includes(currentPage)) {
      a.classList.add('active');
    }
  });

  /* ── 12. TYPING EFFECT FOR HERO (optional) ───────────── */
  const typingEl = document.getElementById('hero-typing');
  if (typingEl) {
    const words = ['Criminal Cases', 'Bail Applications', 'Cyber Crimes', 'Family Disputes', 'Corporate Matters'];
    let wordIndex = 0;
    let charIndex = 0;
    let isDeleting = false;

    function type() {
      const word = words[wordIndex];
      if (isDeleting) {
        typingEl.textContent = word.substring(0, charIndex--);
      } else {
        typingEl.textContent = word.substring(0, charIndex++);
      }

      let delay = isDeleting ? 60 : 100;

      if (!isDeleting && charIndex === word.length + 1) {
        delay = 2000;
        isDeleting = true;
      } else if (isDeleting && charIndex === 0) {
        isDeleting = false;
        wordIndex = (wordIndex + 1) % words.length;
        delay = 400;
      }
      setTimeout(type, delay);
    }
    setTimeout(type, 1000);
  }

  /* ── 13. STICKY CTA MOBILE ───────────────────────────── */
  const mobileCTA = document.getElementById('mobile-cta-bar');
  if (mobileCTA) {
    window.addEventListener('scroll', () => {
      mobileCTA.classList.toggle('visible', window.scrollY > 300);
    }, { passive: true });
  }

});
