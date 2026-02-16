import * as THREE from '../libs/three/build/three.module.js';

document.querySelectorAll('.skill-canvas').forEach(canvas => {

    const scene = new THREE.Scene();

    const camera = new THREE.PerspectiveCamera(
        45,
        canvas.width / canvas.height,
        0.1,
        100
    );
    camera.position.z = 4;

    const renderer = new THREE.WebGLRenderer({
        canvas,
        alpha: true,
        antialias: true
    });
    renderer.setSize(canvas.width, canvas.height);
    renderer.setPixelRatio(window.devicePixelRatio);

    /* Lumière */
    const light = new THREE.DirectionalLight(0xffffff, 1);
    light.position.set(3, 3, 3);
    scene.add(light);

    /* Matériau commun */
    const material = new THREE.MeshStandardMaterial({
        color: 0xffffff,
        metalness: 0.2,
        roughness: 0.7
    });

    let mesh;
    const shape = canvas.dataset.shape;

    if (shape === 'cube') {
        mesh = new THREE.Mesh(
            new THREE.BoxGeometry(1, 1, 1),
            material
        );
    }

    if (shape === 'bar') {
        mesh = new THREE.Mesh(
            new THREE.BoxGeometry(0.4, 1.6, 0.4),
            material
        );
    }

    if (shape === 'ring') {
        mesh = new THREE.Mesh(
            new THREE.TorusGeometry(0.8, 0.2, 16, 64),
            material
        );
    }

    scene.add(mesh);

    /* Rotation sur un seul axe (Y) pour un mouvement horizontal */
    function animate() {
        mesh.rotation.y += 0.005;

        renderer.render(scene, camera);
        requestAnimationFrame(animate);
    }

    animate();
});
