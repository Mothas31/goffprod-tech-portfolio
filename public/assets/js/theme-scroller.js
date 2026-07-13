(() => {
  const shell = document.querySelector('[data-theme-scroller]');
  if (!shell) return;

  const panels = Array.from(shell.querySelectorAll('[data-theme-panel]'));
  const arrows = Array.from(shell.querySelectorAll('[data-theme-arrow]'));
  const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  let activeIndex = 0;
  let lockedUntil = 0;
  let touchStartX = 0;
  let pinRaf = 0;
  let hasInteracted = false;

  function markInteracted() {
    if (hasInteracted) return;
    hasInteracted = true;
    shell.classList.add('theme-scroll-shell--interacted');
  }

  function isShellFocused() {
    const rect = shell.getBoundingClientRect();
    const viewportH = window.innerHeight || 1;
    return rect.top < viewportH * 0.72 && rect.bottom > viewportH * 0.28;
  }

  function pinShell() {
    if (pinRaf) return;
    pinRaf = requestAnimationFrame(() => {
      pinRaf = 0;
      const rect = shell.getBoundingClientRect();
      if (Math.abs(rect.top) < 2) return;
      shell.scrollIntoView({ block: 'start', behavior: 'auto' });
    });
  }

  function syncSceneProgress() {
    const max = Math.max(1, panels.length - 1);
    window.__minusThemeProgress = activeIndex / max;
    window.dispatchEvent(new CustomEvent('minus:theme-change', {
      detail: { index: activeIndex, total: panels.length }
    }));
  }

  function syncArrows() {
    arrows.forEach((arrow) => {
      const direction = Number(arrow.dataset.themeArrow);
      const disabled = direction < 0 ? activeIndex === 0 : activeIndex === panels.length - 1;
      arrow.classList.toggle('is-disabled', disabled);
      arrow.setAttribute('aria-disabled', disabled ? 'true' : 'false');
    });
  }

  function setActive(index) {
    const nextIndex = Math.max(0, Math.min(panels.length - 1, index));
    if (nextIndex === activeIndex) return false;

    const previousIndex = activeIndex;
    const direction = nextIndex > previousIndex ? 'right' : 'left';
    activeIndex = nextIndex;
    shell.classList.toggle('is-going-right', direction === 'right');
    shell.classList.toggle('is-going-left', direction === 'left');

    panels.forEach((panel, panelIndex) => {
      const active = panelIndex === activeIndex;
      const leaving = panelIndex === previousIndex;
      panel.classList.toggle('is-active', active);
      panel.classList.toggle('is-leaving', leaving);
      panel.setAttribute('aria-hidden', active ? 'false' : 'true');
    });

    window.setTimeout(() => {
      panels[previousIndex]?.classList.remove('is-leaving');
    }, prefersReducedMotion ? 0 : 520);

    syncArrows();
    syncSceneProgress();
    return true;
  }

  function step(direction) {
    markInteracted();

    const now = performance.now();
    if (now < lockedUntil) return;

    pinShell();
    const changed = setActive(activeIndex + direction);
    if (changed && !prefersReducedMotion) {
      lockedUntil = now + 620;
    }
  }

  function maybeStep(direction, event) {
    if (!isShellFocused()) return;

    const atStart = activeIndex === 0;
    const atEnd = activeIndex === panels.length - 1;
    if ((direction < 0 && atStart) || (direction > 0 && atEnd)) return;

    event.preventDefault();
    step(direction);
  }

  // Seul le scroll HORIZONTAL change de theme; le scroll vertical garde
  // son comportement natif de defilement de page.
  window.addEventListener('wheel', (event) => {
    if (Math.abs(event.deltaX) <= Math.abs(event.deltaY)) return;
    if (Math.abs(event.deltaX) < 18) return;
    maybeStep(event.deltaX > 0 ? 1 : -1, event);
  }, { passive: false });

  window.addEventListener('touchstart', (event) => {
    touchStartX = event.touches[0]?.clientX || 0;
  }, { passive: true });

  window.addEventListener('touchmove', (event) => {
    const currentX = event.touches[0]?.clientX || touchStartX;
    const delta = touchStartX - currentX;
    if (Math.abs(delta) < 34) return;
    maybeStep(delta > 0 ? 1 : -1, event);
    touchStartX = currentX;
  }, { passive: false });

  window.addEventListener('keydown', (event) => {
    if (!isShellFocused()) return;
    if (event.code === 'ArrowRight') {
      maybeStep(1, event);
    } else if (event.code === 'ArrowLeft') {
      maybeStep(-1, event);
    }
  });

  shell.addEventListener('click', (event) => {
    const target = event.target;
    const arrow = target instanceof Element ? target.closest('[data-theme-arrow]') : null;
    if (arrow instanceof HTMLButtonElement) {
      event.preventDefault();
      const direction = Number(arrow.dataset.themeArrow);
      if (direction !== 1 && direction !== -1) return;
      step(direction);
      return;
    }

    const link = target instanceof Element ? target.closest('[data-theme-link]') : null;
    if (!(link instanceof HTMLAnchorElement)) return;

    const href = link.getAttribute('href');
    if (!href || href === '#' || typeof window.minusWarpTo !== 'function') return;

    event.preventDefault();
    window.minusWarpTo(href);
  });

  panels.forEach((panel, panelIndex) => {
    panel.setAttribute('aria-hidden', panelIndex === activeIndex ? 'false' : 'true');
  });
  syncArrows();
  syncSceneProgress();
})();
