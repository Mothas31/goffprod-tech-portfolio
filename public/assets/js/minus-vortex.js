(() => {
  const canvas = document.getElementById('vortex-canvas');
  if (!canvas) return;

  const ctx = canvas.getContext('2d');
  if (!ctx) return;

  const reducedMotionQuery = window.matchMedia('(prefers-reduced-motion: reduce)');

  let w = 0;
  let h = 0;
  let cx = 0;
  let cy = 0;
  let lines = [];
  let lastSpawn = 0;
  let rafId = 0;
  let running = false;
  let inView = false;
  let lastFrameTime = 0;

  function maxLinesCount() {
    if (w <= 640) return 90;
    if (w <= 1024) return 130;
    return 170;
  }

  function resize() {
    w = canvas.width = window.innerWidth;
    h = canvas.height = window.innerHeight;
    cx = w / 2;
    cy = h / 2;
  }

  class Line {
    constructor() {
      const side = Math.floor(Math.random() * 4);
      const margin = 40;

      if (side === 0) {
        this.x = Math.random() * w;
        this.y = -margin;
      } else if (side === 1) {
        this.x = w + margin;
        this.y = Math.random() * h;
      } else if (side === 2) {
        this.x = Math.random() * w;
        this.y = h + margin;
      } else {
        this.x = -margin;
        this.y = Math.random() * h;
      }

      const dx = cx - this.x;
      const dy = cy - this.y;
      const dist = Math.hypot(dx, dy) || 1;

      this.vx = (dx / dist) * (2 + Math.random() * 2);
      this.vy = (dy / dist) * (2 + Math.random() * 2);
      this.life = 0;
      this.maxLife = w / 5 + Math.random();
      this.baseLength = 8 + Math.random() * 12;
      this.length = this.baseLength;
      this.alpha = 0.15 + Math.random() * 0.2;
      this.lineWidth = 0.5 + Math.random();
      this.angleOffset = (Math.random() - 0.5) * 0.3;
      this.speed = 1.5 + Math.random() * 2;
    }

    update() {
      const dx = cx - this.x;
      const dy = cy - this.y;
      const dist = Math.hypot(dx, dy);
      const lifeRatio = this.life / this.maxLife;
      this.length = this.baseLength * Math.max(0, 1 - lifeRatio);

      const angle = Math.atan2(dy, dx) + this.angleOffset;
      this.vx = Math.cos(angle) * this.speed;
      this.vy = Math.sin(angle) * this.speed;

      const force = Math.min(1.2, Math.max(0.2, dist / 200));
      this.x += this.vx * force;
      this.y += this.vy * force;
      this.life += 1;
    }

    draw() {
      const fade = Math.max(0, 1 - this.life / this.maxLife);
      ctx.strokeStyle = `rgba(255,255,255,${this.alpha * fade})`;
      ctx.lineWidth = this.lineWidth * fade;
      ctx.beginPath();
      ctx.moveTo(this.x, this.y);
      ctx.lineTo(this.x - this.vx * this.length, this.y - this.vy * this.length);
      ctx.stroke();
    }

    isDead() {
      const distCenter = Math.hypot(this.x - cx, this.y - cy);
      return distCenter < 20 || this.life > this.maxLife;
    }
  }

  function drawStaticFrame() {
    ctx.globalCompositeOperation = 'source-over';
    ctx.clearRect(0, 0, w, h);
  }

  function animate(time) {
    if (!running) return;

    if (time - lastFrameTime < 33) {
      rafId = requestAnimationFrame(animate);
      return;
    }
    lastFrameTime = time;

    ctx.globalCompositeOperation = 'source-over';
    ctx.clearRect(0, 0, w, h);
    ctx.globalCompositeOperation = 'lighter';

    if (time - lastSpawn > 75 && lines.length < maxLinesCount()) {
      const batch = 2 + Math.floor(Math.random() * 2);
      for (let i = 0; i < batch; i += 1) lines.push(new Line());
      lastSpawn = time;
    }

    lines.forEach((line) => {
      line.update();
      line.draw();
    });
    lines = lines.filter((line) => !line.isDead());

    rafId = requestAnimationFrame(animate);
  }

  function shouldRun() {
    return inView && !document.hidden && !reducedMotionQuery.matches;
  }

  function start() {
    if (running || !shouldRun()) return;
    running = true;
    rafId = requestAnimationFrame(animate);
  }

  function stop() {
    if (!running) return;
    running = false;
    cancelAnimationFrame(rafId);
    rafId = 0;
  }

  function syncAnimationState() {
    if (shouldRun()) start();
    else stop();
    if (reducedMotionQuery.matches) drawStaticFrame();
  }

  const io = new IntersectionObserver(
    (entries) => {
      const [entry] = entries;
      inView = Boolean(entry && entry.isIntersecting);
      syncAnimationState();
    },
    { threshold: 0.1 }
  );

  window.addEventListener('resize', resize, { passive: true });
  document.addEventListener('visibilitychange', syncAnimationState);
  if (typeof reducedMotionQuery.addEventListener === 'function') {
    reducedMotionQuery.addEventListener('change', syncAnimationState);
  } else if (typeof reducedMotionQuery.addListener === 'function') {
    reducedMotionQuery.addListener(syncAnimationState);
  }

  resize();
  io.observe(canvas);
  syncAnimationState();
})();
