import * as THREE from 'three';

const canvas = document.getElementById('minus-system-scene');

if (canvas) {
  const reducedMotionQuery = window.matchMedia('(prefers-reduced-motion: reduce)');
  let renderer = null;

  try {
    renderer = new THREE.WebGLRenderer({
      canvas,
      alpha: true,
      antialias: true,
      powerPreference: 'low-power',
    });
  } catch (error) {
    window.__minusSystemSceneStatus = 'canvas-fallback';
    console.warn('[minus-system-scene] WebGL unavailable, using canvas fallback.', error);
    drawCanvasFallback(canvas);
  }

  const syncSceneVisibility = () => {
    const intro = document.getElementById('intro');
    if (!intro) {
      canvas.classList.add('is-visible');
      canvas.style.setProperty('--minus-scene-opacity', '0.72');
      return;
    }

    const rect = intro.getBoundingClientRect();
    const startReveal = window.innerHeight * 0.58;
    const opacity = THREE.MathUtils.clamp((startReveal - rect.bottom) / startReveal, 0, 1);
    canvas.style.setProperty('--minus-scene-opacity', opacity.toFixed(3));
    canvas.classList.toggle('is-visible', opacity > 0.02);
  };

  window.addEventListener('scroll', syncSceneVisibility, { passive: true });
  window.addEventListener('resize', syncSceneVisibility, { passive: true });
  syncSceneVisibility();

  if (renderer) {
    window.__minusSystemSceneStatus = 'webgl';

    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(36, 1, 0.1, 80);
    const root = new THREE.Group();
    const ringGroup = new THREE.Group();
    const fractureGroup = new THREE.Group();
    const streaks = [];
    let rectFrame = null;
    const RECT_W = 0.96; // demi-largeur du rectangle (le "void" qui aspire la lumière)
    const RECT_H = 1.06; // demi-hauteur (légèrement portrait, façon portail)

    scene.add(root);
    root.add(ringGroup, fractureGroup);

    renderer.setPixelRatio(Math.min(window.devicePixelRatio || 1, 1.75));
    renderer.outputColorSpace = THREE.SRGBColorSpace;

    camera.position.set(0, 0, 7.9);

    const ringMaterial = new THREE.LineBasicMaterial({
      color: 0xffffff,
      transparent: true,
      opacity: 0.72,
    });
    const ghostMaterial = new THREE.LineBasicMaterial({
      color: 0xffffff,
      transparent: true,
      opacity: 0.2,
    });

    createRectFrame();
    createStreaks();

    let progress = getScrollProgress();
    let targetProgress = progress;
    let pointerX = 0;
    let pointerY = 0;
    let running = true;
    let absorb = 0; // 0 = repos, 1 = le rectangle a grandi et avale l'écran
    let absorbTarget = 0;
    let baseScale = 0.72;
    let baseX = 2.15;
    let baseY = 0.15;

    window.addEventListener('resize', resize, { passive: true });
    window.addEventListener('scroll', () => {
      targetProgress = getScrollProgress();
    }, { passive: true });
    window.addEventListener('pointermove', (event) => {
      pointerX = (event.clientX / Math.max(1, window.innerWidth) - 0.5) * 2;
      pointerY = (event.clientY / Math.max(1, window.innerHeight) - 0.5) * 2;
    }, { passive: true });
    window.addEventListener('minus:absorb', () => { absorbTarget = 1; }, { passive: true });
    document.addEventListener('visibilitychange', syncVisibility);
    reducedMotionQuery.addEventListener?.('change', renderStill);

    resize();
    renderStill();
    renderer.setAnimationLoop(tick);

    function createRectFrame() {
      const w = RECT_W;
      const h = RECT_H;
      const points = [
        new THREE.Vector3(-w, h, 0),
        new THREE.Vector3(w, h, 0),
        new THREE.Vector3(w, -h, 0),
        new THREE.Vector3(-w, -h, 0),
        new THREE.Vector3(-w, h, 0),
      ];
      const geometry = new THREE.BufferGeometry().setFromPoints(points);
      rectFrame = new THREE.Line(geometry, ringMaterial.clone());
      fractureGroup.add(rectFrame);
    }

    function createStreaks() {
      const count = 110;
      for (let i = 0; i < count; i += 1) {
        const line = createLine(ghostMaterial.clone());
        // Direction 3D quelconque : la lumière vient de tous les axes (x, y ET z).
        const dir = new THREE.Vector3(random(-1, 1), random(-1, 1), random(-1, 1));
        if (dir.lengthSq() < 1e-4) dir.set(1, 0, 0);
        dir.normalize();
        line.userData = {
          dir,
          outer: random(2.6, 4.8), // distance de départ (loin du rectangle)
          len: random(0.18, 0.55), // longueur du trait
          speed: random(0.07, 0.2), // vitesse d'aspiration
          phase: random(0, 1), // décalage temporel
        };
        ringGroup.add(line);
        streaks.push(line);
      }
    }

    function createLine(material) {
      const geometry = new THREE.BufferGeometry();
      geometry.setAttribute('position', new THREE.Float32BufferAttribute([0, 0, 0, 0, 0, 0], 3));
      return new THREE.Line(geometry, material);
    }

    function tick(timeMs) {
      if (!running) return;
      progress = THREE.MathUtils.lerp(progress, targetProgress, 0.065);
      absorb = THREE.MathUtils.lerp(absorb, absorbTarget, 0.11);
      drawSystem(timeMs * 0.001, progress, !reducedMotionQuery.matches);
      renderer.render(scene, camera);
    }

    function drawSystem(time, amount, animate) {
      // Rectangle "void" FIXE (position gérée dans resize) qui aspire la lumière.
      // Des traits convergent vers ses bords puis sont absorbés. Aucun chaos.
      // Rotation OSCILLANTE (jamais de profil) pour donner du volume sans smear.
      const energy = smooth(amount); // le scroll ajoute juste un peu d'intensité

      // Mode "absorption" : le rectangle grandit et se recentre pour avaler la page.
      const grow = 1 + absorb * absorb * 16;
      root.scale.setScalar(baseScale * grow);
      root.position.x = baseX * (1 - absorb);
      root.position.y = baseY * (1 - absorb);

      root.rotation.x = -0.12 + (animate ? Math.sin(time * 0.18) * 0.06 : 0) + pointerY * 0.05;
      root.rotation.y = (animate ? Math.sin(time * 0.22) * 0.5 : 0.25) + pointerX * 0.08;
      root.rotation.z = animate ? Math.sin(time * 0.12) * 0.03 : 0;

      if (rectFrame) {
        const pulse = animate ? 0.5 + 0.5 * Math.sin(time * 1.3) : 1;
        rectFrame.material.opacity = Math.min(1, (0.5 + 0.34 * pulse) * (0.8 + energy * 0.2) + absorb);
        const breath = 1 + (animate ? Math.sin(time * 0.6) * 0.014 : 0);
        rectFrame.scale.set(breath, breath, 1);
      }

      const speedBoost = 1 + absorb * 6; // les traits accélèrent pendant l'absorption
      streaks.forEach((line) => {
        const d = line.userData;
        const t = animate ? ((time * d.speed * speedBoost + d.phase) % 1) : (d.phase % 1);
        const eased = t * t; // accélère en s'approchant -> sensation d'aspiration

        // Origine 3D (plusieurs axes) -> convergence vers le bord du rectangle (plan z=0).
        const sx = d.dir.x * d.outer;
        const sy = d.dir.y * d.outer;
        const sz = d.dir.z * d.outer;
        const aXY = Math.atan2(sy, sx);
        const edge = rectEdge(aXY); // point d'absorption sur le contour
        const ex = Math.cos(aXY) * edge;
        const ey = Math.sin(aXY) * edge;

        const hx = THREE.MathUtils.lerp(sx, ex, eased);
        const hy = THREE.MathUtils.lerp(sy, ey, eased);
        const hz = THREE.MathUtils.lerp(sz, 0, eased);
        const tf = d.len * (1 - t); // la traîne se résorbe à l'absorption

        setLinePoints(
          line,
          new THREE.Vector3(hx, hy, hz),
          new THREE.Vector3(hx + d.dir.x * tf, hy + d.dir.y * tf, hz + d.dir.z * tf)
        );
        // apparaît de loin (0), pic au milieu, s'éteint absorbé au bord (0)
        line.material.opacity = Math.sin(t * Math.PI) * (0.4 + energy * 0.24 + absorb * 0.5);
      });
    }

    function rectEdge(angle) {
      // Distance centre -> bord du rectangle (demi-tailles RECT_W/RECT_H) sur la direction angle.
      const c = Math.abs(Math.cos(angle));
      const s = Math.abs(Math.sin(angle));
      return Math.min(
        c > 1e-4 ? RECT_W / c : Infinity,
        s > 1e-4 ? RECT_H / s : Infinity
      );
    }

    function setLinePoints(line, p1, p2) {
      const position = line.geometry.attributes.position;
      position.setXYZ(0, p1.x, p1.y, p1.z);
      position.setXYZ(1, p2.x, p2.y, p2.z);
      position.needsUpdate = true;
    }

    function getScrollProgress() {
      const intro = document.getElementById('intro');
      const prequal = document.getElementById('prequal');
      const startY = intro ? intro.offsetTop + intro.offsetHeight : 0;
      const endY = prequal
        ? prequal.offsetTop - window.innerHeight * 0.35
        : document.documentElement.scrollHeight - window.innerHeight;
      return THREE.MathUtils.clamp((window.scrollY - startY) / Math.max(1, endY - startY), 0, 1);
    }

    function resize() {
      const width = window.innerWidth || 1;
      const height = window.innerHeight || 1;
      const isMobile = width < 768;
      renderer.setSize(width, height, false);
      camera.aspect = width / height;
      camera.fov = width < 640 ? 44 : 36;
      camera.position.z = width < 640 ? 8.8 : 7.9;
      // Rectangle figé : à droite sur desktop, centré sur mobile (mise en page 1 colonne).
      baseScale = width < 640 ? 0.64 : 0.72;
      baseX = isMobile ? 0 : 2.15;
      baseY = isMobile ? 0 : 0.15;
      root.scale.setScalar(baseScale);
      root.position.set(baseX, baseY, 0);
      camera.updateProjectionMatrix();
      targetProgress = getScrollProgress();
    }

    function syncVisibility() {
      running = !document.hidden;
      if (running) renderer.setAnimationLoop(tick);
    }

    function renderStill() {
      targetProgress = getScrollProgress();
      progress = targetProgress;
      drawSystem(0, progress, false);
      renderer.render(scene, camera);
    }
  }

  function drawCanvasFallback(canvasElement) {
    const ctx = canvasElement.getContext('2d');
    if (!ctx) return;

    const resize = () => {
      const dpr = Math.min(window.devicePixelRatio || 1, 1.75);
      const width = window.innerWidth || 1;
      const height = window.innerHeight || 1;
      canvasElement.width = Math.floor(width * dpr);
      canvasElement.height = Math.floor(height * dpr);
      canvasElement.style.width = `${width}px`;
      canvasElement.style.height = `${height}px`;
      ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
      draw();
    };

    const draw = () => {
      const width = window.innerWidth || 1;
      const height = window.innerHeight || 1;
      const centerX = width * 0.68;
      const centerY = height * 0.36;
      const radius = Math.min(width, height) * 0.18;

      ctx.clearRect(0, 0, width, height);
      ctx.save();
      ctx.translate(centerX, centerY);
      ctx.rotate(-0.22);
      for (let i = 0; i < 72; i += 1) {
        const angle = (i / 72) * Math.PI * 2;
        const jitter = Math.sin(i * 13.17) * radius * 0.1;
        const x = Math.cos(angle) * (radius + jitter);
        const y = Math.sin(angle) * (radius + Math.cos(i * 8.33) * radius * 0.07);
        const len = radius * (i % 5 === 0 ? 0.13 : 0.08);
        ctx.save();
        ctx.translate(x, y);
        ctx.rotate(angle + Math.PI / 2 + Math.sin(i) * 0.32);
        ctx.strokeStyle = i % 4 === 0 ? 'rgba(255, 255, 255, 0.58)' : 'rgba(255, 255, 255, 0.34)';
        ctx.lineWidth = 1;
        ctx.beginPath();
        ctx.moveTo(-len, 0);
        ctx.lineTo(len, 0);
        ctx.stroke();
        ctx.restore();
      }
      ctx.restore();
    };

    window.addEventListener('resize', resize, { passive: true });
    resize();
  }

  function random(min, max) {
    return min + Math.random() * (max - min);
  }

  function smooth(value) {
    return value * value * (3 - 2 * value);
  }
}
