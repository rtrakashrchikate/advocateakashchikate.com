(function () {
  'use strict';
  var root = document.documentElement;

  /* Office-hours pill: Mon-Sat 10:00-19:00 India time. Falls back to the static text if Intl is unavailable. */
  try {
    var pill = document.getElementById('h2-status');
    var txt = document.getElementById('h2-status-text');
    if (pill && txt && pill.hasAttribute('data-live') && window.Intl && Intl.DateTimeFormat) {
      var parts = new Intl.DateTimeFormat('en-GB', {
        timeZone: 'Asia/Kolkata', weekday: 'short', hour: 'numeric', minute: 'numeric', hour12: false
      }).formatToParts(new Date());
      var get = function (t) { var p = parts.filter(function (x) { return x.type === t; })[0]; return p ? p.value : ''; };
      var day = get('weekday');
      var mins = (parseInt(get('hour'), 10) % 24) * 60 + parseInt(get('minute'), 10);
      var order = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
      var di = order.indexOf(day);
      if (di > -1) {
        var working = di <= 5;
        if (working && mins >= 600 && mins < 1140) {
          pill.setAttribute('data-state', 'open');
          txt.textContent = 'Office open now · until 7 PM';
        } else {
          pill.setAttribute('data-state', 'closed');
          var next;
          if (working && mins < 600) { next = 'today 10 AM'; }
          else if (di === 5 || di === 6) { next = 'Monday 10 AM'; }
          else { next = 'tomorrow 10 AM'; }
          txt.textContent = 'Office closed · opens ' + next;
        }
      }
    }
  } catch (e) { /* keep static text */ }

  /* Scroll reveal for the situation cards. Cards stay visible if JS or IntersectionObserver is missing. */
  try {
    var cards = document.querySelectorAll('.sit2-card, .gde2-card, .mth2-grid li, .prc2-steps li, .svc2-grid li');
    if (cards.length && 'IntersectionObserver' in window && !(window.CSS && CSS.supports && CSS.supports('animation-timeline: view()')) &&
        !(window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches)) {
      root.classList.add('h2-js');
      var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (en) {
          if (en.isIntersecting) {
            var el = en.target;
            var i = Array.prototype.indexOf.call(cards, el);
            el.style.transitionDelay = (i % 4) * 90 + 'ms';
            el.classList.add('is-in');
            io.unobserve(el);
          }
        });
      }, { threshold: 0.15, rootMargin: '0px 0px -40px 0px' });
      cards.forEach(function (c) { io.observe(c); });
    }
  } catch (e) { /* cards remain visible */ }

  /* Smooth scroll to #situations, leaving room for the fixed navbar. */
  var find = document.querySelector('.h2-find');
  if (find) {
    find.addEventListener('click', function (ev) {
      var target = document.getElementById('situations');
      if (!target) { return; }
      ev.preventDefault();
      var y = target.getBoundingClientRect().top + window.pageYOffset - 70;
      window.scrollTo({ top: y, behavior: 'smooth' });
    });
  }

  /* Gentle pointer parallax on the hero portrait and arches (mouse only, never for reduced motion). */
  try {
    var hero = document.querySelector('.hero2');
    var fine = window.matchMedia && window.matchMedia('(hover: hover) and (pointer: fine)').matches;
    var calm = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (hero && fine && !calm) {
      var raf = 0, tx = 0, ty = 0;
      hero.addEventListener('pointermove', function (ev) {
        var r = hero.getBoundingClientRect();
        tx = ((ev.clientX - r.left) / r.width - 0.5) * 2;
        ty = ((ev.clientY - r.top) / r.height - 0.5) * 2;
        if (!raf) {
          raf = requestAnimationFrame(function () {
            raf = 0;
            hero.style.setProperty('--mx', tx.toFixed(3));
            hero.style.setProperty('--my', ty.toFixed(3));
          });
        }
      }, { passive: true });
      hero.addEventListener('pointerleave', function () {
        hero.style.setProperty('--mx', 0);
        hero.style.setProperty('--my', 0);
      });
    }
  } catch (e) { /* no parallax */ }
})();
