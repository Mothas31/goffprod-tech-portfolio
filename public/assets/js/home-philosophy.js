(() => {
  const story = document.querySelector('[data-mv-story]');
  if (!story) return;
  const steps = [...story.querySelectorAll('[data-mv-step]')];
  const labels = [...story.querySelectorAll('[data-mv-label]')];
  const progressLine = document.querySelector('[data-mv-progress]');
  let centers = [];
  let frame = 0;
  let activeLabel = -1;
  let scene = null;
  let position = 0;
  const clamp = value => Math.max(0, Math.min(1, value));

  function measure() {
    centers = steps.map(step => {
      const rect = step.getBoundingClientRect();
      return window.scrollY + rect.top + rect.height / 2;
    });
    requestDraw();
  }

  function draw() {
    frame = 0;
    const y = window.scrollY + window.innerHeight / 2;
    let stage = 0;
    while (stage < centers.length - 2 && y > centers[stage + 1]) stage++;
    const t = clamp((y - centers[stage]) / Math.max(1, centers[stage + 1] - centers[stage]));
    position = stage + t * t * (3 - 2 * t);
    const label = Math.round(position);
    if (label !== activeLabel) {
      labels.forEach((el, i) => el.classList.toggle('is-active', i === label));
      activeLabel = label;
    }
    const total = document.documentElement.scrollHeight - window.innerHeight;
    progressLine.style.transform = `scaleX(${clamp(window.scrollY / Math.max(1, total))})`;
    scene?.setProgress(position);
  }

  function requestDraw() {
    if (!frame) frame = requestAnimationFrame(draw);
  }

  // The story spans several screens. Observe the visual itself so WebGL does
  // not compete with the entrance canvas before the 3D is actually on screen.
  const loader = new IntersectionObserver(entries => {
    if (!entries.some(entry => entry.isIntersecting)) return;
    loader.disconnect();
    import('/assets/js/home-philosophy-scene.js?v=20261125-portal').then(module => {
      scene = module.createPhilosophyScene(story);
      scene?.setProgress(position);
    }).catch(() => { /* The perspective SVG remains when WebGL or the module is unavailable. */ });
  }, { threshold: .01 });
  loader.observe(story.querySelector('[data-mv-depth]'));
  window.addEventListener('scroll', requestDraw, { passive: true });
  window.addEventListener('resize', measure);
  window.addEventListener('pageshow', measure);
  new ResizeObserver(measure).observe(story);
  document.fonts.ready.then(measure);
  measure();
})();
