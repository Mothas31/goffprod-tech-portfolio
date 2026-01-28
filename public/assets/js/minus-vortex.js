 
const canvas = document.getElementById('vortex-canvas');
const ctx = canvas.getContext('2d');

let w, h, cx, cy;
let lines = [];
let lastSpawn = 0;

function resize() {
  w = canvas.width = window.innerWidth;
  h = canvas.height = window.innerHeight;
  cx = w / 2;
  cy = h / 2;
}
window.addEventListener('resize', resize);
resize();

/* -------------------------
   Ligne aspirée
-------------------------- */
class Line {
  constructor() {
    const side = Math.floor(Math.random() * 4);
    const margin = 40;

    if (side === 0) { // top
      this.x = Math.random() * w;
      this.y = -margin;
    } else if (side === 1) { // right
      this.x = w + margin;
      this.y = Math.random() * h;
    } else if (side === 2) { // bottom
      this.x = Math.random() * w;
      this.y = h + margin;
    } else { // left
      this.x = -margin;
      this.y = Math.random() * h;
    }

    const dx = cx - this.x;
    const dy = cy - this.y;
    const dist = Math.hypot(dx, dy);

    this.vx = (dx / dist) * (2 + Math.random() * 3);
    this.vy = (dy / dist) * (2 + Math.random() * 3);

    this.life = 0;
    //La durré des trait dépend de la largeur de l'écran 
    this.maxLife = (w / 5)  + (Math.random());
    this.baseLength = 8 + Math.random() * 12;
    this.length = this.baseLength;
    this.alpha = 0.15 + Math.random() * 0.25;
    this.lineWidth = 0.5 + Math.random() * 1.5;
    this.angleOffset = (Math.random() - 0.5) * 0.3;
    this.speed = 1.5 + Math.random() * 2.5;


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

    // facteur d’attraction (plus proche = plus rapide)
    const force = Math.min(1.2, Math.max(0.2, dist / 200));

    this.x += this.vx * force;
    this.y += this.vy * force;

    this.life++;
  }


  draw() {
    const fade = Math.max(0, 1 - this.life / this.maxLife);
    ctx.strokeStyle = `rgba(255,255,255,${this.alpha * fade})`; 
    ctx.lineWidth = this.lineWidth * (1 - this.life / this.maxLife);

    ctx.beginPath();
    ctx.moveTo(this.x, this.y);
    ctx.lineTo(
      this.x - this.vx * this.length,
      this.y - this.vy * this.length
    );
    ctx.stroke();
  

  }

  isDead() {
    // rayon au centre = 20px
    const distCenter = Math.hypot(this.x - cx, this.y - cy);
    return distCenter < 20 || this.life > this.maxLife;
    }

}

/* -------------------------
   Animation loop
-------------------------- */
function animate(time) {
  ctx.globalCompositeOperation = 'source-over';
  ctx.clearRect(0, 0, w, h);

  ctx.globalCompositeOperation = 'lighter';

  if (time - lastSpawn > 60) {
    const batch = 2 + Math.floor(Math.random() * 3);
    for (let i = 0; i < batch; i++) {
      lines.push(new Line());
    }
    lastSpawn = time;
  }

  lines.forEach(line => {
    line.update();
    line.draw();
  });

  lines = lines.filter(line => !line.isDead());

  requestAnimationFrame(animate);
}

requestAnimationFrame(animate); 