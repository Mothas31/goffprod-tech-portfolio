(() => {
  const shell = document.querySelector('[data-theme-scroller]');
  if (!shell) return;

  const panels = Array.from(shell.querySelectorAll('[data-theme-panel]'));
  const dots = Array.from(shell.querySelectorAll('[data-theme-dot]'));
  const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  let activeIndex = 0;
  let lockedUntil = 0;
  let touchStartY = 0;
  let pinRaf = 0;

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

  function setActive(index) {
    const nextIndex = Math.max(0, Math.min(panels.length - 1, index));
    if (nextIndex === activeIndex) return false;

    const previousIndex = activeIndex;
    const direction = nextIndex > previousIndex ? 'down' : 'up';
    activeIndex = nextIndex;
    shell.classList.toggle('is-going-down', direction === 'down');
    shell.classList.toggle('is-going-up', direction === 'up');

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

    dots.forEach((dot, dotIndex) => {
      dot.classList.toggle('is-active', dotIndex === activeIndex);
    });
    syncSceneProgress();
    return true;
  }

  function maybeStep(direction, event) {
    if (!isShellFocused()) return;

    const now = performance.now();
    if (now < lockedUntil) {
      event.preventDefault();
      pinShell();
      return;
    }

    const atStart = activeIndex === 0;
    const atEnd = activeIndex === panels.length - 1;
    if (direction < 0 && atStart) {
      return;
    }

    if (direction > 0 && atEnd) {
      event.preventDefault();
      pinShell();
      return;
    }

    event.preventDefault();
    pinShell();
    const changed = setActive(activeIndex + direction);
    if (changed && !prefersReducedMotion) {
      lockedUntil = now + 620;
    }
  }

  window.addEventListener('wheel', (event) => {
    if (Math.abs(event.deltaY) < 18) return;
    maybeStep(event.deltaY > 0 ? 1 : -1, event);
  }, { passive: false });

  window.addEventListener('touchstart', (event) => {
    touchStartY = event.touches[0]?.clientY || 0;
  }, { passive: true });

  window.addEventListener('touchmove', (event) => {
    const currentY = event.touches[0]?.clientY || touchStartY;
    const delta = touchStartY - currentY;
    if (Math.abs(delta) < 34) return;
    maybeStep(delta > 0 ? 1 : -1, event);
    touchStartY = currentY;
  }, { passive: false });

  window.addEventListener('keydown', (event) => {
    if (!isShellFocused()) return;
    if (['ArrowDown', 'PageDown', 'Space'].includes(event.code)) {
      maybeStep(1, event);
    } else if (['ArrowUp', 'PageUp'].includes(event.code)) {
      maybeStep(-1, event);
    }
  });

  shell.addEventListener('click', (event) => {
    const target = event.target;
    const dot = target instanceof Element ? target.closest('[data-theme-dot]') : null;
    if (dot instanceof HTMLButtonElement) {
      event.preventDefault();
      const nextIndex = Number(dot.dataset.themeTarget);
      if (!Number.isFinite(nextIndex)) return;
      pinShell();
      setActive(nextIndex);
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
  syncSceneProgress();
})();
