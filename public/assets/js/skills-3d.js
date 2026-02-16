(() => {
  const canvases = Array.from(document.querySelectorAll('.skill-canvas'));
  if (!canvases.length) return;

  const reducedMotionQuery = window.matchMedia('(prefers-reduced-motion: reduce)');
  const states = new Map();
  let threePromise;

  function getThree() {
    if (!threePromise) {
      threePromise = import('../libs/three/build/three.module.min.js');
    }
    return threePromise;
  }

  function getCanvasSize(canvas) {
    return {
      width: Math.max(1, Math.floor(canvas.clientWidth || canvas.width || 160)),
      height: Math.max(1, Math.floor(canvas.clientHeight || canvas.height || 160)),
    };
  }

  async function initCanvas(canvas) {
    const THREE = await getThree();
    const { width, height } = getCanvasSize(canvas);

    canvas.width = width;
    canvas.height = height;

    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(45, width / height, 0.1, 100);
    camera.position.z = 4;

    const renderer = new THREE.WebGLRenderer({
      canvas,
      alpha: true,
      antialias: true,
      powerPreference: 'low-power',
    });
    renderer.setSize(width, height, false);
    renderer.setPixelRatio(Math.min(window.devicePixelRatio || 1, 1.5));

    const light = new THREE.DirectionalLight(0xffffff, 1);
    light.position.set(3, 3, 3);
    scene.add(light);

    const material = new THREE.MeshStandardMaterial({
      color: 0xffffff,
      metalness: 0.2,
      roughness: 0.7,
    });

    const shape = canvas.dataset.shape;
    let mesh = null;

    if (shape === 'cube') mesh = new THREE.Mesh(new THREE.BoxGeometry(1, 1, 1), material);
    if (shape === 'bar') mesh = new THREE.Mesh(new THREE.BoxGeometry(0.4, 1.6, 0.4), material);
    if (shape === 'ring') mesh = new THREE.Mesh(new THREE.TorusGeometry(0.8, 0.2, 16, 64), material);
    if (!mesh) mesh = new THREE.Mesh(new THREE.BoxGeometry(1, 1, 1), material);

    scene.add(mesh);

    const state = {
      canvas,
      scene,
      camera,
      renderer,
      mesh,
      running: false,
      visible: false,
      rafId: 0,
      initialized: true,
      lastFrameTime: 0,
    };

    states.set(canvas, state);
    renderFrame(state);
  }

  function renderFrame(state) {
    state.renderer.render(state.scene, state.camera);
  }

  function animate(state, time) {
    if (!state.running) return;

    if (time - state.lastFrameTime < 33) {
      state.rafId = requestAnimationFrame((ts) => animate(state, ts));
      return;
    }
    state.lastFrameTime = time;

    state.mesh.rotation.y += 0.005;
    renderFrame(state);
    state.rafId = requestAnimationFrame((ts) => animate(state, ts));
  }

  function shouldRun(state) {
    return state.visible && !document.hidden && !reducedMotionQuery.matches;
  }

  function start(state) {
    if (state.running || !shouldRun(state)) return;
    state.running = true;
    state.rafId = requestAnimationFrame((ts) => animate(state, ts));
  }

  function stop(state) {
    if (!state.running) return;
    state.running = false;
    cancelAnimationFrame(state.rafId);
    state.rafId = 0;
  }

  function syncState(state) {
    if (shouldRun(state)) start(state);
    else stop(state);
    if (reducedMotionQuery.matches && state.initialized) renderFrame(state);
  }

  function syncAllStates() {
    states.forEach((state) => syncState(state));
  }

  const io = new IntersectionObserver(
    async (entries) => {
      for (const entry of entries) {
        const canvas = entry.target;
        const visible = entry.isIntersecting;
        let state = states.get(canvas);

        if (!state && visible) {
          await initCanvas(canvas);
          state = states.get(canvas);
        }
        if (!state) continue;

        state.visible = visible;
        syncState(state);
      }
    },
    { threshold: 0.2 }
  );

  canvases.forEach((canvas) => io.observe(canvas));
  document.addEventListener('visibilitychange', syncAllStates);
  if (typeof reducedMotionQuery.addEventListener === 'function') {
    reducedMotionQuery.addEventListener('change', syncAllStates);
  } else if (typeof reducedMotionQuery.addListener === 'function') {
    reducedMotionQuery.addListener(syncAllStates);
  }
})();
