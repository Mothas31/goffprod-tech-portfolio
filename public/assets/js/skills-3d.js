(() => {
  const canvases = Array.from(document.querySelectorAll('.skill-canvas'));
  if (!canvases.length) return;

  const reducedMotionQuery = window.matchMedia('(prefers-reduced-motion: reduce)');
  const states = new Map();
  const modelCache = new Map();
  const loadingCanvases = new Set();

  let threePromise;
  let gltfLoaderPromise;
  let dracoLoaderPromise;
  let sharedDracoLoader;

  function getThree() {
    if (!threePromise) threePromise = import('three');
    return threePromise;
  }

  async function getGLTFLoaderClass() {
    if (!gltfLoaderPromise) {
      gltfLoaderPromise = import('three/addons/loaders/GLTFLoader.js');
    }
    return (await gltfLoaderPromise).GLTFLoader;
  }

  async function ensureDracoLoader() {
    if (sharedDracoLoader) return sharedDracoLoader;
    if (!dracoLoaderPromise) {
      dracoLoaderPromise = import('three/addons/loaders/DRACOLoader.js');
    }
    const { DRACOLoader } = await dracoLoaderPromise;
    sharedDracoLoader = new DRACOLoader();
    sharedDracoLoader.setDecoderPath('/assets/libs/three/examples/jsm/libs/draco/gltf/');
    sharedDracoLoader.preload();
    return sharedDracoLoader;
  }

  function getCanvasSize(canvas) {
    return {
      width:  Math.max(1, Math.floor(canvas.clientWidth  || canvas.width  || 160)),
      height: Math.max(1, Math.floor(canvas.clientHeight || canvas.height || 160)),
    };
  }

  function createFallbackMesh(THREE, shape) {
    const mat = new THREE.MeshStandardMaterial({ color: 0xffffff, metalness: 0.15, roughness: 0.78, flatShading: true });
    if (shape === 'cube') return new THREE.Mesh(new THREE.BoxGeometry(1, 1, 1), mat);
    if (shape === 'bar')  return new THREE.Mesh(new THREE.BoxGeometry(0.4, 1.6, 0.4), mat);
    if (shape === 'ring') return new THREE.Mesh(new THREE.TorusGeometry(0.8, 0.2, 16, 48), mat);
    return new THREE.Mesh(new THREE.BoxGeometry(1, 1, 1), mat);
  }

  async function loadModelObject(THREE, modelPath) {
    if (!modelPath) return null;
    if (modelCache.has(modelPath)) return modelCache.get(modelPath).clone(true);
    try {
      const [GLTFLoader, dracoLoader] = await Promise.all([
        getGLTFLoaderClass(),
        ensureDracoLoader(),
      ]);
      const loader = new GLTFLoader();
      loader.setDRACOLoader(dracoLoader);
      const loadPromise = new Promise((resolve, reject) => {
        loader.load(modelPath, resolve, undefined, reject);
      });
      const timeout = new Promise((_, reject) =>
        setTimeout(() => reject(new Error('load-timeout')), 8000)
      );
      const gltf = await Promise.race([loadPromise, timeout]);
      modelCache.set(modelPath, gltf.scene);
      return gltf.scene.clone(true);
    } catch (err) {
      console.warn(`[skills-3d] Chargement échoué : ${modelPath}`, err);
      return null;
    }
  }

  function normalizeObject(THREE, object, targetSize = 2) {
    const box = new THREE.Box3().setFromObject(object);
    const size = box.getSize(new THREE.Vector3());
    const maxDim = Math.max(size.x, size.y, size.z) || 1;
    object.scale.multiplyScalar(targetSize / maxDim);
    const center = new THREE.Box3().setFromObject(object).getCenter(new THREE.Vector3());
    object.position.sub(center);
  }

  function applyWireMaterial(THREE, root, wireframe = false) {
    root.traverse((child) => {
      if (child.isMesh) {
        child.material = new THREE.MeshBasicMaterial({ color: 0xffffff, wireframe });
        child.castShadow = false;
        child.receiveShadow = false;
      } else if (child.isLine) {
        child.material = new THREE.LineBasicMaterial({ color: 0xffffff });
      }
    });
  }

  async function initCanvas(canvas) {
    const THREE = await getThree();
    const { width, height } = getCanvasSize(canvas);

    canvas.width  = width;
    canvas.height = height;

    const scene    = new THREE.Scene();
    const camera   = new THREE.PerspectiveCamera(45, width / height, 0.1, 100);
    camera.position.z = 4;

    const renderer = new THREE.WebGLRenderer({ canvas, alpha: true, antialias: true, powerPreference: 'low-power' });
    renderer.setSize(width, height, false);
    renderer.setPixelRatio(Math.min(window.devicePixelRatio || 1, 1.5));

    const animationType = canvas.dataset.animation || 'spin';
    const modelPath     = canvas.dataset.model     || '';
    const shape         = canvas.dataset.shape     || 'cube';

    let object3d = await loadModelObject(THREE, modelPath);
    let baseScale = 1.0;

    if (object3d) {
      const useWireframe = !modelPath.includes('_wire.');
      applyWireMaterial(THREE, object3d, useWireframe);

      // Wrap in a pivot so orientation correction (rotation.x) is independent
      // from the animation rotation applied on world axes.
      const pivot = new THREE.Group();
      if (animationType === 'heart') {
     
        object3d.rotation.y = -Math.PI;
      } else if (animationType === 'leaf') {
        object3d.rotation.x = -Math.PI / 2;
      }
      pivot.add(object3d);
      normalizeObject(THREE, pivot, 2);
      baseScale = pivot.scale.x;
      object3d = pivot;
    } else {
      // Fallback géométrique : lumières nécessaires pour MeshStandardMaterial
      const key = new THREE.DirectionalLight(0xffffff, 0.95);
      key.position.set(3, 3, 3);
      scene.add(key);
      const fill = new THREE.DirectionalLight(0xffffff, 0.35);
      fill.position.set(-2, 1, 2);
      scene.add(fill);
      scene.add(new THREE.AmbientLight(0xffffff, 0.25));
      object3d = createFallbackMesh(THREE, shape);
    }

    scene.add(object3d);

    const state = {
      canvas, scene, camera, renderer, object3d,
      running: false, visible: false, rafId: 0, initialized: true,
      lastFrameTime: 0, animationType, baseScale,
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

    const obj  = state.object3d;
    const anim = state.animationType;
    const t    = time * 0.001; // secondes

    if (anim === 'heart') {
      // Spin vertical (world Y) via le pivot — l'objet interne a rotation.x=-π/2
      obj.rotation.y += 0.008;
      const phase = t % 1.8;
      let s = 1.0;
      if (phase < 0.15)      s = 1 + 0.18 * Math.sin((phase / 0.15) * Math.PI);
      else if (phase < 0.35) s = 1 + 0.09 * Math.sin(((phase - 0.2) / 0.15) * Math.PI);
      obj.scale.setScalar(state.baseScale * s);

    } else if (anim === 'vortex') {
      // Rotation rapide + bascule oscillante → effet toupie / gyroscope
      obj.rotation.y += 0.022;
      obj.rotation.x  = Math.sin(t * 0.7) * 0.35;

    } else if (anim === 'leaf') {
      // Balancement doux gauche-droite (Z) via le pivot — rotation.x=-π/2 sur l'objet interne
      obj.rotation.z  = Math.sin(t * 1.1) * 0.22;
      obj.rotation.y += 0.004;

    } else {
      obj.rotation.y += 0.005;
    }

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

  const io = new IntersectionObserver(async (entries) => {
    for (const entry of entries) {
      const canvas  = entry.target;
      const visible = entry.isIntersecting;
      let state = states.get(canvas);

      if (!state && visible && !loadingCanvases.has(canvas)) {
        loadingCanvases.add(canvas);
        try {
          await initCanvas(canvas);
        } catch (err) {
          console.warn('[skills-3d] initCanvas error:', err);
        } finally {
          loadingCanvases.delete(canvas);
        }
        state = states.get(canvas);
      }
      if (!state) continue;

      state.visible = visible;
      syncState(state);
    }
  }, { threshold: 0.2 });

  canvases.forEach((canvas) => io.observe(canvas));
  document.addEventListener('visibilitychange', syncAllStates);
  if (typeof reducedMotionQuery.addEventListener === 'function') {
    reducedMotionQuery.addEventListener('change', syncAllStates);
  } else if (typeof reducedMotionQuery.addListener === 'function') {
    reducedMotionQuery.addListener(syncAllStates);
  }
})();
