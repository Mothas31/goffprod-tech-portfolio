(() => {
    const cards = document.querySelectorAll('[data-project-card]');
    const canHover = window.matchMedia('(hover: hover) and (pointer: fine)').matches;
    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (!canHover || reducedMotion) return;

    cards.forEach((visual) => {
        const state = { x: 0, y: 0, targetX: 0, targetY: 0, frame: 0 };

        const animate = () => {
            state.x += (state.targetX - state.x) * 0.12;
            state.y += (state.targetY - state.y) * 0.12;

            const mx = state.x * 2;
            const my = state.y * 2;
            visual.style.setProperty('--mx', mx.toFixed(4));
            visual.style.setProperty('--my', my.toFixed(4));
            visual.style.setProperty('--rx', `${(-my * 7).toFixed(3)}deg`);
            visual.style.setProperty('--ry', `${(mx * 7).toFixed(3)}deg`);

            if (Math.abs(state.x - state.targetX) > 0.0005 || Math.abs(state.y - state.targetY) > 0.0005) {
                state.frame = requestAnimationFrame(animate);
            } else {
                state.frame = 0;
            }
        };

        visual.addEventListener('pointermove', (event) => {
            const bounds = visual.getBoundingClientRect();
            const px = Math.min(1, Math.max(0, (event.clientX - bounds.left) / bounds.width));
            const py = Math.min(1, Math.max(0, (event.clientY - bounds.top) / bounds.height));
            state.targetX = px - 0.5;
            state.targetY = py - 0.5;
            visual.style.setProperty('--shine-x', `${(px * 100).toFixed(1)}%`);
            visual.style.setProperty('--shine-y', `${(py * 100).toFixed(1)}%`);
            if (!state.frame) state.frame = requestAnimationFrame(animate);
        });

        visual.addEventListener('pointerleave', () => {
            state.targetX = 0;
            state.targetY = 0;
            visual.style.setProperty('--shine-x', '50%');
            visual.style.setProperty('--shine-y', '50%');
            if (!state.frame) state.frame = requestAnimationFrame(animate);
        });
    });
})();
