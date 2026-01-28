
const canvas3d = document.getElementById('scene-3d');
const ctx3d = canvas3d.getContext('2d');

function resize() {
    canvas3d.width = canvas3d.offsetWidth;
    canvas3d.height = canvas3d.offsetHeight;
}
window.addEventListener('resize', resize);
resize();

// Cube 3D simple : perspective orthographique, rotation + scale
let rotation = 0;
let scale = 0.1; // cube minuscule au départ

// Fonction pour dessiner un cube pseudo-3D
function drawCube(cx, cy, size, angle) {
    // Couleurs
    const faceColor = "#9ca3af"; // gris clair
    const shadowColor = "rgba(0,0,0,0.3)";

    ctx3d.save();
    ctx3d.translate(cx, cy);
    ctx3d.rotate(angle);

    // Ombre portée simple
    ctx3d.shadowColor = shadowColor;
    ctx3d.shadowBlur = 20;
    ctx3d.shadowOffsetX = 15;
    ctx3d.shadowOffsetY = 15;

    // Cube simple (rectangle pour chaque face)
    ctx3d.fillStyle = faceColor;
    ctx3d.fillRect(-size/2, -size/2, size, size);

    ctx3d.restore();
}

// Scroll handler
let maxScroll = document.body.scrollHeight - window.innerHeight;
window.addEventListener('scroll', () => {
    const scrollY = window.scrollY;
    scale = 0.1 + 0.9 * (scrollY / maxScroll); // de 0.1 à 1
    rotation = scrollY / 100; // rotation proportionnelle au scroll
});

function animate() {
    ctx3d.clearRect(0, 0, canvas3d.width, canvas3d.height);
    const size = scale * Math.min(canvas3d.width, canvas3d.height) * 0.5; // cube dimension max = moitié du canvas
    drawCube(canvas3d.width/2, canvas3d.height/2, size, rotation);
    requestAnimationFrame(animate);
}

animate(); 

