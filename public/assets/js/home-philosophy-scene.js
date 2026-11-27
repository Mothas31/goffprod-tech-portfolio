import * as THREE from 'three';

export function createPhilosophyScene(story) {
  const host = story.querySelector('[data-mv-depth]');
  const canvas = host.querySelector('[data-mv-depth-canvas]');
  const portalLink = host.querySelector('[data-mv-portal]');
  const motion = window.matchMedia('(prefers-reduced-motion: reduce)');
  let renderer;
  try {
    renderer = new THREE.WebGLRenderer({ canvas, alpha: true, antialias: true, powerPreference: 'low-power' });
  } catch {
    host.dataset.scene = 'fallback';
    return null;
  }
  const scene = new THREE.Scene();
  scene.fog = new THREE.FogExp2(0x080808, .065);
  const camera = new THREE.PerspectiveCamera(36, 1, .1, 50);
  const root = new THREE.Group();
  scene.add(root);
  renderer.setPixelRatio(Math.min(devicePixelRatio || 1, innerWidth < 768 ? 1 : 1.5));
  renderer.outputColorSpace = THREE.SRGBColorSpace;

  const frameGeometry = new THREE.BufferGeometry().setFromPoints([
    new THREE.Vector3(-1.05, -1.4, 0), new THREE.Vector3(1.05, -1.4, 0),
    new THREE.Vector3(1.05, 1.4, 0), new THREE.Vector3(-1.05, 1.4, 0),
    new THREE.Vector3(-1.05, -1.4, 0),
  ]);
  const frames = [];
  for (let i = 0; i < 24; i++) {
    const material = new THREE.LineBasicMaterial({ color: 0xf5f5ef, transparent: true, opacity: .4, depthWrite: false });
    const line = new THREE.Line(frameGeometry, material);
    root.add(line);
    frames.push(line);
  }
  const portal = new THREE.Line(frameGeometry, new THREE.LineBasicMaterial({ color: 0xffffff, transparent: true, opacity: 0 }));
  root.add(portal);

  // As in the original portal: light trails travel through depth into its edges.
  // A single line-segment buffer keeps the whole particle field in one draw call.
  const particleCapacity = 100;
  const particleGeometry = new THREE.BufferGeometry();
  const particlePositions = new THREE.Float32BufferAttribute(new Float32Array(particleCapacity * 6), 3);
  const particleColors = new THREE.Float32BufferAttribute(new Float32Array(particleCapacity * 6), 3);
  particlePositions.setUsage(THREE.DynamicDrawUsage);
  particleColors.setUsage(THREE.DynamicDrawUsage);
  particleGeometry.setAttribute('position', particlePositions);
  particleGeometry.setAttribute('color', particleColors);
  const particleMaterial = new THREE.LineBasicMaterial({ vertexColors: true, transparent: true, opacity: 0, depthWrite: false });
  const particles = new THREE.LineSegments(particleGeometry, particleMaterial);
  particles.frustumCulled = false;
  root.add(particles);
  const fraction = n => n - Math.floor(n);
  const trails = Array.from({ length: particleCapacity }, (_, i) => {
    const angle = i * 2.3999632297;
    const dx = Math.cos(angle), dy = Math.sin(angle);
    const edge = Math.min(1.05 / Math.max(.0001, Math.abs(dx)), 1.4 / Math.max(.0001, Math.abs(dy)));
    const outer = edge + 1.3 + fraction(i * .713) * 1.6;
    return {
      sx: dx * outer, sy: dy * outer, sz: (fraction(i * .417 + .2) - .5) * 6,
      ex: dx * edge, ey: dy * edge,
      phase: fraction(i * .618 + .1), speed: .13 + fraction(i * .379) * .13,
      length: .07 + fraction(i * .571) * .09,
    };
  });
  let particleCount = innerWidth < 768 ? 36 : particleCapacity;
  particleGeometry.setDrawRange(0, particleCount * 2);

  // A quiet ground plane makes the perspective legible without adding surfaces.
  const grid = new THREE.GridHelper(14, 28, 0x555555, 0x444444);
  grid.position.set(0, -2.15, -1.5);
  grid.material.transparent = true;
  grid.material.opacity = .14;
  grid.material.depthWrite = false;
  scene.add(grid);

  const poses = frames.map((_, i) => {
    const angle = i * .37;
    const selected = i % 8 === 0;
    return [
      { x: Math.sin(angle) * .3, y: Math.cos(angle) * .18, z: .7 - i * .22, rx: .04 * Math.sin(angle), ry: .08 * Math.cos(angle), rz: i * .055, scale: 1, alpha: .68 - i * .018 },
      { x: Math.sin(i * 2.4) * 1.25, y: Math.cos(i * 1.7) * 1.1, z: Math.sin(i * .9) * 1.7 - 1, rx: Math.sin(i) * .6, ry: Math.cos(i * .8) * .8, rz: Math.sin(i * 1.4) * .7, scale: .45 + (i % 5) * .12, alpha: selected ? .85 : .27 },
      { x: selected ? 0 : Math.sin(i * 2.4) * 2.5, y: selected ? 0 : Math.cos(i * 1.7) * 2.2, z: selected ? .3 - i * .2 : -3, rx: 0, ry: 0, rz: selected ? 0 : .5, scale: selected ? 1 : .5, alpha: selected ? .8 - i * .02 : .045 },
      { x: 0, y: 0, z: 0, rx: 0, ry: 0, rz: 0, scale: 1, alpha: 0 },
    ];
  });

  let progress = 0;
  let inView = false;
  let raf = 0;
  let previousTime = 0;
  let drift = 0;
  let pointerX = 0, pointerY = 0;
  let targetX = 0, targetY = 0;
  let absorbing = false;
  let absorbStarted = 0;
  let contextLost = false;
  let portalHovered = false;
  let portalFocused = false;
  const v = new THREE.Vector3();
  const mix = THREE.MathUtils.lerp;
  const clamp = THREE.MathUtils.clamp;

  function syncPortal() {
    const visible = progress > 2.94 && !contextLost;
    portalLink.hidden = !visible;
    portalLink.tabIndex = visible ? 0 : -1;
    if (!visible) return;
    // Project the actual portal bounds so the hit area follows the 3D rectangle.
    root.updateMatrixWorld(true);
    camera.updateMatrixWorld(true);
    const points = [[-1.05, 1.4], [1.05, 1.4], [-1.05, -1.4], [1.05, -1.4]].map(([x, y]) => {
      v.set(x, y, 0).applyMatrix4(portal.matrixWorld).project(camera);
      return { x: (v.x + 1) * host.clientWidth / 2, y: (1 - v.y) * host.clientHeight / 2 };
    });
    const left = Math.min(...points.map(p => p.x)), top = Math.min(...points.map(p => p.y));
    portalLink.style.left = `${left}px`;
    portalLink.style.top = `${top}px`;
    portalLink.style.width = `${Math.max(...points.map(p => p.x)) - left}px`;
    portalLink.style.height = `${Math.max(...points.map(p => p.y)) - top}px`;
  }

  function render(now = performance.now()) {
    if (contextLost) return;
    const delta = Math.min(.05, Math.max(0, (now - previousTime) / 1000));
    previousTime = now;
    if (!motion.matches) drift += delta * .11;
    pointerX = mix(pointerX, targetX, .065);
    pointerY = mix(pointerY, targetY, .065);
    const p = motion.matches ? 3 : progress;
    const stage = Math.min(2, Math.floor(p));
    const t = p - stage;
    const resolve = (a, b, key) => mix(a[key], b[key], t);
    frames.forEach((frame, i) => {
      const a = poses[i][stage], b = poses[i][stage + 1];
      frame.position.set(resolve(a,b,'x'), resolve(a,b,'y'), resolve(a,b,'z'));
      frame.rotation.set(resolve(a,b,'rx'), resolve(a,b,'ry'), resolve(a,b,'rz'));
      frame.scale.setScalar(resolve(a,b,'scale'));
      frame.material.opacity = resolve(a,b,'alpha');
      frame.visible = frame.material.opacity > .005;
    });
    const finish = THREE.MathUtils.smoothstep(p, 2.25, 3);
    const calm = 1 - finish;
    const animate = !motion.matches;
    root.rotation.set(
      animate ? (Math.sin(drift * .7) * .035 + pointerY * .035) * calm + finish * (-.09 + Math.sin(drift * .7) * .025 + pointerY * .24) : 0,
      animate ? (Math.sin(drift) * .07 + pointerX * .06) * calm + finish * (Math.sin(drift * .6) * .12 + pointerX * .46) : 0,
      animate ? finish * Math.sin(drift * .4) * .012 : 0
    );
    camera.position.set(mix(3.8, 0, finish), mix(1.7, .05, finish), mix(8.5, 8.8, finish));
    camera.lookAt(0, 0, -.8 * calm);
    const interacting = portalHovered || portalFocused;
    portal.material.opacity = finish * (animate ? .82 + Math.sin(drift * 8) * .08 + (interacting ? .1 : 0) : .95);
    grid.material.opacity = mix(.13, .035, finish);
    const warp = absorbing && animate ? clamp((now - absorbStarted) / 800, 0, 1) : 0;
    const attraction = animate ? THREE.MathUtils.smoothstep(p, 2.55, 3) : 0;
    particles.visible = attraction > .001;
    particleMaterial.opacity = attraction * (.72 + (interacting ? .15 : 0));
    if (particles.visible) {
      for (let i = 0; i < particleCount; i++) {
        const trail = trails[i];
        trail.phase = (trail.phase + delta * trail.speed * (1 + warp * 6 + (interacting ? .25 : 0))) % 1;
        const phase = trail.phase;
        const head = phase * phase;
        const tail = Math.max(0, head - trail.length * (1 - phase));
        const offset = i * 2;
        particlePositions.setXYZ(offset, mix(trail.sx, trail.ex, head), mix(trail.sy, trail.ey, head), trail.sz * (1 - head));
        particlePositions.setXYZ(offset + 1, mix(trail.sx, trail.ex, tail), mix(trail.sy, trail.ey, tail), trail.sz * (1 - tail));
        const light = Math.sin(phase * Math.PI);
        particleColors.setXYZ(offset, light, light, light);
        particleColors.setXYZ(offset + 1, light * .08, light * .08, light * .08);
      }
      particlePositions.needsUpdate = true;
      particleColors.needsUpdate = true;
    }
    if (absorbing && !motion.matches) {
      root.scale.setScalar(1 + warp * warp * 28);
    }
    renderer.render(scene, camera);
    syncPortal();
  }

  function loop(now) {
    raf = 0;
    if (!inView || document.hidden || motion.matches || contextLost) return;
    if (now - previousTime >= 32) render(now);
    raf = requestAnimationFrame(loop);
  }
  function syncAnimation() {
    if (raf) cancelAnimationFrame(raf);
    raf = 0;
    previousTime = performance.now();
    if (inView && !document.hidden && !contextLost) {
      render();
      if (!motion.matches) raf = requestAnimationFrame(loop);
    }
  }
  function resize() {
    if (!host.clientWidth || !host.clientHeight) return;
    renderer.setSize(host.clientWidth, host.clientHeight, false);
    particleCount = innerWidth < 768 ? 36 : particleCapacity;
    particleGeometry.setDrawRange(0, particleCount * 2);
    camera.aspect = host.clientWidth / host.clientHeight;
    camera.updateProjectionMatrix();
    render();
  }

  new ResizeObserver(resize).observe(host);
  new IntersectionObserver(entries => {
    inView = entries[0].isIntersecting;
    syncAnimation();
  }, { threshold: .05 }).observe(host);
  motion.addEventListener('change', syncAnimation);
  document.addEventListener('visibilitychange', syncAnimation);
  story.addEventListener('pointermove', event => {
    if (event.pointerType !== 'mouse' || motion.matches) return;
    const rect = host.getBoundingClientRect();
    targetX = clamp(((event.clientX - rect.left) / rect.width - .5) * 2, -1, 1);
    targetY = clamp(((event.clientY - rect.top) / rect.height - .5) * 2, -1, 1);
  }, { passive: true });
  story.addEventListener('pointerleave', () => { targetX = 0; targetY = 0; });
  portalLink.addEventListener('pointerenter', () => { portalHovered = true; });
  portalLink.addEventListener('pointerleave', () => { portalHovered = false; });
  portalLink.addEventListener('focus', () => { portalFocused = true; });
  portalLink.addEventListener('blur', () => { portalFocused = false; });
  portalLink.addEventListener('click', event => {
    if (event.button !== 0 || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey || motion.matches || !window.minusWarpTo) return;
    event.preventDefault();
    window.minusWarpTo(portalLink.href);
  });
  window.addEventListener('minus:absorb', () => {
    absorbing = true;
    absorbStarted = performance.now();
  });
  canvas.addEventListener('webglcontextlost', event => {
    event.preventDefault();
    contextLost = true;
    host.classList.remove('is-ready');
    host.dataset.scene = 'fallback';
    portalLink.hidden = true;
    syncAnimation();
  });
  canvas.addEventListener('webglcontextrestored', () => {
    contextLost = false;
    host.dataset.scene = 'webgl';
    host.classList.add('is-ready');
    resize();
    syncAnimation();
  });
  resize();
  host.classList.add('is-ready');
  host.dataset.scene = 'webgl';
  return { setProgress(value) { progress = clamp(value, 0, 3); if (motion.matches || !raf) render(); } };
}
