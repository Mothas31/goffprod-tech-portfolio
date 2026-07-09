(() => {
  const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  // --- Arrivée : on nettoie le drapeau et on retire la classe une fois le cercle joué.
  // Le voile blanc lui-même est posé par un script inline dans le <head> (anti-flash),
  // et l'animation se joue toute seule en CSS (robuste même si ce script échoue).
  try {
    if (sessionStorage.getItem('minusWarp') === '1') {
      sessionStorage.removeItem('minusWarp');
      window.setTimeout(() => {
        document.documentElement.classList.remove('warp-arrive');
      }, 1000);
    }
  } catch (e) { /* sessionStorage indisponible : on ignore */ }

  if (window.minusWarpTo) return;

  let warping = false;

  function ensureVeil() {
    let veil = document.getElementById('warp-veil');
    if (!veil) {
      veil = document.createElement('div');
      veil.id = 'warp-veil';
      document.body.appendChild(veil);
    }
    return veil;
  }

  // Départ : "le rectangle 3D grandit et absorbe la page", puis navigue.
  window.minusWarpTo = (url) => {
    if (!url) return;
    if (prefersReducedMotion) {
      window.location.href = url;
      return;
    }
    if (warping) return;
    warping = true;

    try { sessionStorage.setItem('minusWarp', '1'); } catch (e) { /* ignore */ }

    const veil = ensureVeil();
    document.body.classList.add('is-warping');
    // Le rectangle de la scène 3D grossit et accélère son aspiration.
    window.dispatchEvent(new CustomEvent('minus:absorb'));
    // Voile noir final (synchronisé avec la croissance du rectangle).
    requestAnimationFrame(() => { veil.classList.add('is-active'); });

    window.setTimeout(() => { window.location.href = url; }, 850);
  };
})();
