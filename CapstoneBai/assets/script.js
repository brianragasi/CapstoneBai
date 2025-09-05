// Minimal JS for future enhancements (search, favorites)

// Scroll reveal animations
(function() {
  const els = document.querySelectorAll('.reveal');
  if (!('IntersectionObserver' in window) || !els.length) return;
  const io = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add('show');
        io.unobserve(entry.target);
      }
    });
  }, { threshold: 0.12 });
  els.forEach((el) => io.observe(el));
})();

// Lightweight ripple effect for buttons with .btn class
(function() {
  document.addEventListener('click', function(e) {
    const btn = e.target.closest('.btn');
    if (!btn) return;
    const circle = document.createElement('span');
    const diameter = Math.max(btn.clientWidth, btn.clientHeight);
    const radius = diameter / 2;
    circle.style.width = circle.style.height = `${diameter}px`;
    circle.style.left = `${e.clientX - (btn.getBoundingClientRect().left + radius)}px`;
    circle.style.top = `${e.clientY - (btn.getBoundingClientRect().top + radius)}px`;
    circle.className = 'ripple';
    const existing = btn.getElementsByClassName('ripple')[0];
    if (existing) existing.remove();
    btn.appendChild(circle);
    setTimeout(() => circle.remove(), 500);
  }, false);
})();

/* Ripple styles injected via JS if not present */
(function ensureRippleStyles(){
  if (document.getElementById('ripple-style')) return;
  const style = document.createElement('style');
  style.id = 'ripple-style';
  style.textContent = `.btn { position: relative; overflow: hidden; }
  .ripple { position: absolute; border-radius: 50%; transform: scale(0); animation: ripple 500ms linear; background: rgba(255,255,255,0.35); }
  @keyframes ripple { to { transform: scale(4); opacity: 0; } }`;
  document.head.appendChild(style);
})();
