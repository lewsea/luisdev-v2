import { gsap } from 'gsap';

// ---------------------------------------------------------------------------
// Theme Toggle (light / dark)
// Dark mode is the default. Preference is persisted in localStorage.
// ---------------------------------------------------------------------------
function initThemeToggle() {
  const root = document.documentElement;
  const buttons = document.querySelectorAll('[data-theme-toggle]');

  if (!buttons.length) return;

  const apply = (theme) => {
    if (theme === 'dark') {
      root.classList.add('dark');
    } else {
      root.classList.remove('dark');
    }
    try {
      localStorage.setItem('theme', theme);
    } catch (e) {
      /* ignore */
    }
  };

  buttons.forEach((btn) => {
    btn.addEventListener('click', () => {
      const next = root.classList.contains('dark') ? 'light' : 'dark';
      apply(next);
    });
  });
}

// ---------------------------------------------------------------------------
// Bento card intro — randomised staggered fade-in via GSAP
// ---------------------------------------------------------------------------
function initBentoIntro() {
  const cards = Array.from(document.querySelectorAll('[data-bento-card]'));
  if (!cards.length) return;

  // Hide all cards immediately before first paint
  gsap.set(cards, { opacity: 0, y: 20, scale: 0.97 });

  // Shuffle to get a different animation order each page load
  const shuffled = cards.slice().sort(() => Math.random() - 0.5);

  gsap.to(shuffled, {
    opacity: 1,
    y: 0,
    scale: 1,
    duration: 0.55,
    ease: 'power2.out',
    stagger: 0.07,
    delay: 0.2,
    clearProps: 'opacity,transform',
  });
}

// ---------------------------------------------------------------------------
// PH Clock
// ---------------------------------------------------------------------------
function initClock() {
  const timeEl = document.getElementById('ph-time');
  const dateEl = document.getElementById('ph-date');
  if (!timeEl) return;

  const PH_TZ = 'Asia/Manila';

  function tick() {
    const now = new Date();
    timeEl.textContent = now.toLocaleTimeString('en-PH', {
      timeZone: PH_TZ,
      hour: '2-digit',
      minute: '2-digit',
      second: '2-digit',
      hour12: true,
    });
    if (dateEl) {
      dateEl.textContent = now.toLocaleDateString('en-PH', {
        timeZone: PH_TZ,
        weekday: 'long',
        month: 'long',
        day: 'numeric',
      });
    }
  }

  tick();
  setInterval(tick, 1000);
}

// ---------------------------------------------------------------------------
// Nyan Cat timer
// ---------------------------------------------------------------------------
function initNyanTimer() {
  const el = document.getElementById('nyan-timer');
  if (!el) return;
  let seconds = 0;
  setInterval(() => {
    seconds++;
    el.textContent = `You've NYANED for ${seconds} second${seconds !== 1 ? 's' : ''}`;
  }, 1000);
}

// ---------------------------------------------------------------------------
// Boot
// ---------------------------------------------------------------------------
function boot() {
  initThemeToggle();
  initBentoIntro();
  initNyanTimer();
  initClock();
}

if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', boot);
} else {
  boot();
}
