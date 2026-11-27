(() => {
  const carousel = document.querySelector('[data-universe-carousel]');
  if (!carousel) return;
  const track = carousel.querySelector('[data-universe-track]');
  const slides = [...track.querySelectorAll('[data-universe-slide]')];
  const controls = [...carousel.querySelectorAll('[data-universe-controls]')];
  const dots = [...carousel.querySelectorAll('[data-universe-go]')];
  const steps = [...carousel.querySelectorAll('[data-universe-step]')];
  const position = carousel.querySelector('[data-universe-position]');
  const motion = matchMedia('(prefers-reduced-motion: reduce)');
  let current = -1;
  let frame = 0;

  function sync() {
    frame = 0;
    const next = Math.max(0, Math.min(slides.length - 1, Math.round(track.scrollLeft / Math.max(1, track.clientWidth))));
    if (next === current) return;
    current = next;
    slides.forEach((slide, index) => {
      slide.inert = index !== current;
      slide.setAttribute('aria-hidden', String(index !== current));
    });
    dots.forEach((dot, index) => {
      if (index === current) dot.setAttribute('aria-current', 'true');
      else dot.removeAttribute('aria-current');
    });
    const selected = dots[current];
    const selector = selected.parentElement;
    const left = selected.offsetLeft;
    if (left < selector.scrollLeft) selector.scrollTo({ left, behavior: 'instant' });
    else if (left + selected.offsetWidth > selector.scrollLeft + selector.clientWidth) {
      selector.scrollTo({ left: left + selected.offsetWidth - selector.clientWidth, behavior: 'instant' });
    }
    steps.forEach(button => {
      button.disabled = Number(button.dataset.universeStep) < 0 ? current === 0 : current === slides.length - 1;
    });
    position.textContent = `${slides[current].dataset.title} · ${current + 1} / ${slides.length}`;
  }

  function goTo(index, instant = false) {
    const next = Math.max(0, Math.min(slides.length - 1, index));
    if (track.contains(document.activeElement) && document.activeElement !== track) track.focus({ preventScroll: true });
    track.scrollTo({ left: next * track.clientWidth, behavior: instant || motion.matches ? 'instant' : 'smooth' });
  }
  steps.forEach(button => button.addEventListener('click', () => goTo(current + Number(button.dataset.universeStep))));
  dots.forEach(button => button.addEventListener('click', () => goTo(Number(button.dataset.universeGo))));
  track.addEventListener('keydown', event => {
    if (!['ArrowLeft', 'ArrowRight', 'Home', 'End'].includes(event.key)) return;
    event.preventDefault();
    goTo(event.key === 'Home' ? 0 : event.key === 'End' ? slides.length - 1 : current + (event.key === 'ArrowRight' ? 1 : -1));
  });
  track.addEventListener('scroll', () => { if (!frame) frame = requestAnimationFrame(sync); }, { passive: true });
  let width = track.clientWidth;
  new ResizeObserver(() => {
    if (Math.abs(track.clientWidth - width) < 1) return;
    width = track.clientWidth;
    goTo(Math.max(0, current), true);
  }).observe(track);
  controls.forEach(control => { control.hidden = false; });
  sync();
})();
