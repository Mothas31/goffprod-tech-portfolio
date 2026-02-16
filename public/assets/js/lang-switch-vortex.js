(() => {
  const switchers = document.querySelectorAll('.lang-switch');
  const logo = document.getElementById('logo-center') || document.getElementById('site-logo-anchor');

  if (!switchers.length || !logo) {
    return;
  }

  switchers.forEach((switcher) => {
    const canvas = switcher.querySelector('.lang-switch__canvas');
    if (!canvas) return;

    const ctx = canvas.getContext('2d');
    if (!ctx) return;

    const lines = [];
    let width = 0;
    let height = 0;
    let dpr = 1;
    let lastLineSpawn = 0;

    function resize() {
      const rect = switcher.getBoundingClientRect();
      width = Math.max(1, Math.floor(rect.width));
      height = Math.max(1, Math.floor(rect.height));
      dpr = Math.min(window.devicePixelRatio || 1, 2);

      canvas.width = Math.floor(width * dpr);
      canvas.height = Math.floor(height * dpr);
      canvas.style.width = `${width}px`;
      canvas.style.height = `${height}px`;

      ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
    }

    function logoCenter() {
      const rect = logo.getBoundingClientRect();
      return {
        x: rect.left + rect.width / 2,
        y: rect.top + rect.height / 2,
      };
    }

    function switcherRect() {
      return switcher.getBoundingClientRect();
    }

    function spawnLine() {
      const edge = Math.floor(Math.random() * 4);
      let x;
      let y;

      if (edge === 0) { // top
        x = Math.random() * width;
        y = -6 - Math.random() * 8;
      } else if (edge === 1) { // right
        x = width + 6 + Math.random() * 8;
        y = Math.random() * height;
      } else if (edge === 2) { // bottom
        x = Math.random() * width;
        y = height + 6 + Math.random() * 8;
      } else { // left
        x = -6 - Math.random() * 8;
        y = Math.random() * height;
      }

      lines.push({
        x,
        y,
        speed: 0.5 + Math.random() * 0.5,
        life: 0,
        maxLife: 64 + Math.random() * 52,
        length: 11 + Math.random() * 13,
        alpha: 0.22 + Math.random() * 0.14,
        thickness: 0.75 + Math.random() * 0.45,
      });
    }

    function animate(ts) {
      ctx.clearRect(0, 0, width, height);
      ctx.globalCompositeOperation = 'lighter';
      const rect = switcherRect();
      const target = logoCenter();

      if (ts - lastLineSpawn > 90) {
        spawnLine();
        if (Math.random() > 0.9) spawnLine();
        lastLineSpawn = ts;
      }

      for (let i = lines.length - 1; i >= 0; i--) {
        const p = lines[i];
        const globalX = rect.left + p.x;
        const globalY = rect.top + p.y;
        const jitterX = (Math.random() - 0.5) * 70;
        const jitterY = (Math.random() - 0.5) * 70;
        const dx = (target.x + jitterX) - globalX;
        const dy = (target.y + jitterY) - globalY;
        const dist = Math.hypot(dx, dy) || 1;
        const nx = dx / dist;
        const ny = dy / dist;
        const accel = Math.min(1.5, Math.max(0.45, dist / 430));

        p.x += nx * p.speed * accel;
        p.y += ny * p.speed * accel;
        p.life += 1;

        const fade = Math.max(0, 1 - p.life / p.maxLife);
        ctx.strokeStyle = `rgba(255,255,255,${p.alpha * fade})`;
        ctx.lineWidth = p.thickness * fade;
        ctx.beginPath();
        ctx.moveTo(p.x, p.y);
        ctx.lineTo(p.x - nx * p.length, p.y - ny * p.length);
        ctx.stroke();

        const outside = p.x < -20 || p.x > width + 20 || p.y < -20 || p.y > height + 20;
        if (outside || p.life > p.maxLife) lines.splice(i, 1);
      }

      requestAnimationFrame(animate);
    }

    resize();
    window.addEventListener('resize', resize, { passive: true });
    requestAnimationFrame(animate);
  });
})();
