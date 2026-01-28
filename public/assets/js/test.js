<script>
const canvas = document.getElementById('scene-3d');
const ctx = canvas.getContext('2d');

function resize() {
    canvas.width = canvas.offsetWidth;
    canvas.height = canvas.offsetHeight;
}
window.addEventListener('resize', resize);
resize();

// Test visuel : cube simple
let x = 0;
function animate() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.fillStyle = '#0ea5e9';
    ctx.fillRect(canvas.width/2 - 50 + Math.sin(x)*20, canvas.height/2 - 50, 100, 100);
    x += 0.05;
    requestAnimationFrame(animate);
}
animate();
</script>
