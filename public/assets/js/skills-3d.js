(() => {
  const canvases = Array.from(document.querySelectorAll('.skill-canvas'));
  if (!canvases.length) return;

  const reducedMotionQuery = window.matchMedia('(prefers-reduced-motion: reduce)');
  const states = new Map();
  const modelCache = new Map();

  let threePromise;
  let gltfLoaderPromise;

  function getThree() {
    if (!threePromise) {
      threePromise = import('three');
    }
    return threePromise;
  }

  async function getGLTFLoaderClass() {
    if (!gltfLoaderPromise) {
      gltfLoaderPromise = import('three/addons/loaders/GLTFLoader.js');
    }
    const mod = await gltfLoaderPromise;
    return mod.GLTFLoader;
  }

  function getCanvasSize(canvas) {
    return {
      width: Math.max(1, Math.floor(canvas.clientWidth || canvas.width || 160)),
      height: Math.max(1, Math.floor(canvas.clientHeight || canvas.height || 160)),
    };
  }

  function createFallbackMesh(THREE, shape) {
    const material = new THREE.MeshStandardMaterial({
      color: 0xffffff,
      metalness: 0.15,
      roughness: 0.78,
      flatShading: true,
    });

    if (shape === 'cube') return new THREE.Mesh(new THREE.BoxGeometry(1, 1, 1), material);
    if (shape === 'bar') return new THREE.Mesh(new THREE.BoxGeometry(0.4, 1.6, 0.4), material);
    if (shape === 'ring') return new THREE.Mesh(new THREE.TorusGeometry(0.8, 0.2, 16, 48), material);

    return new THREE.Mesh(new THREE.BoxGeometry(1, 1, 1), material);
  }

  async function loadModelObject(THREE, modelPath) {
    if (!modelPath) return null;

    if (modelCache.has(modelPath)) {
      return modelCache.get(modelPath).clone(true);
    }

    try {
      const GLTFLoader = await getGLTFLoaderClass();
      const loader = new GLTFLoader();

      const gltf = await new Promise((resolve, reject) => {
        loader.load(modelPath, resolve, undefined, reject);
      });

      modelCache.set(modelPath, gltf.scene);
      return gltf.scene.clone(true);
    } catch (error) {
      console.warn(`[skills-3d] Impossible de charger le modele ${modelPath}`, error);
      return null;
    }
  }

  function normalizeObject(THREE, object, targetSize = 2) {
    const box = new THREE.Box3().setFromObject(object);
    const size = box.getSize(new THREE.Vector3());
    const maxDim = Math.max(size.x, size.y, size.z) || 1;
    const scale = targetSize / maxDim;

    object.scale.multiplyScalar(scale);

    const scaledBox = new THREE.Box3().setFromObject(object);
    const center = scaledBox.getCenter(new THREE.Vector3());
    object.position.sub(center);
  }

  function applyMonoMaterial(THREE, root) {
    root.traverse((child) => {
      if (!child.isMesh) return;
      child.material = new THREE.MeshStandardMaterial({
        color: 0xffffff,
        metalness: 0.15,
        roughness: 0.78,
        flatShading: true,
      });
      child.castShadow = false;
      child.receiveShadow = false;
    });
  }

  function attachHoverHandlers(canvas, state) {
    canvas.addEventListener('pointerenter', () => {
      state.hoverPaused = true;
    });

    canvas.addEventListener('pointerleave', () => {
      state.hoverPaused = false;
    });
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

    const keyLight = new THREE.DirectionalLight(0xffffff, 0.95);
    keyLight.position.set(3, 3, 3);
    scene.add(keyLight);

    const fillLight = new THREE.DirectionalLight(0xffffff, 0.35);
    fillLight.position.set(-2, 1, 2);
    scene.add(fillLight);

    const ambient = new THREE.AmbientLight(0xffffff, 0.25);
    scene.add(ambient);

    const shape = canvas.dataset.shape || 'cube';
    const modelPath = canvas.dataset.model || '';

    let object3d = await loadModelObject(THREE, modelPath);

    if (object3d) {
      applyMonoMaterial(THREE, object3d);
      normalizeObject(THREE, object3d, 2);
    } else {
      object3d = createFallbackMesh(THREE, shape);
    }

    scene.add(object3d);

    const state = {
      canvas,
      scene,
      camera,
      renderer,
      object3d,
      running: false,
      visible: false,
      rafId: 0,
      initialized: true,
      lastFrameTime: 0,
      baseSpinSpeed: 0.005,
      currentSpinSpeed: 0.005,
      hoverPaused: false,
    };

    states.set(canvas, state);
    attachHoverHandlers(canvas, state);
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

    const targetSpeed = state.hoverPaused ? 0 : state.baseSpinSpeed;
    state.currentSpinSpeed += (targetSpeed - state.currentSpinSpeed) * 0.14;

    state.object3d.rotation.y += state.currentSpinSpeed;
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
