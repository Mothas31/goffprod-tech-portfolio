(() => {
  const cases = [...document.querySelectorAll('[data-case]')];
  if (!cases.length) return;
  cases.forEach(article => {
    const visual = article.querySelector('[data-case-mode]');
    const controls = visual.querySelector('.mv-case-controls');
    const caption = visual.querySelector('[data-case-caption]');
    const choices = [...controls.querySelectorAll('[data-case-choice]')];
    controls.hidden = false;
    choices.forEach(button => {
      button.addEventListener('click', () => {
        const mode = button.dataset.caseChoice;
        visual.dataset.caseMode = mode;
        choices.forEach(choice => choice.setAttribute('aria-pressed', String(choice === button)));
        caption.textContent = caption.dataset[mode];
      });
    });
  });

  const links = [...document.querySelectorAll('.mv-case-nav a')];
  let frame = 0;
  function updateCurrent() {
    frame = 0;
    const targetY = Math.min(innerHeight * .4, 300);
    let current = cases[0];
    for (const article of cases) {
      if (article.getBoundingClientRect().top <= targetY) current = article;
    }
    for (const link of links) {
      if (link.hash === '#' + current.id) link.setAttribute('aria-current', 'location');
      else link.removeAttribute('aria-current');
    }
  }
  window.addEventListener('scroll', () => {
    if (!frame) frame = requestAnimationFrame(updateCurrent);
  }, { passive: true });
  updateCurrent();
})();
