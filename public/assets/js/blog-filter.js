(() => {
  'use strict';

  const filters = document.querySelector('[data-blog-filters]');
  const cards = Array.from(document.querySelectorAll('[data-blog-theme]'));
  if (!filters || cards.length === 0) return;

  filters.addEventListener('click', (event) => {
    const button = event.target.closest('[data-blog-filter]');
    if (!button || !filters.contains(button)) return;

    const selectedTheme = button.dataset.blogFilter || 'all';
    filters.querySelectorAll('[data-blog-filter]').forEach((filterButton) => {
      const isActive = filterButton === button;
      filterButton.classList.toggle('is-active', isActive);
      filterButton.setAttribute('aria-pressed', String(isActive));
    });

    cards.forEach((card) => {
      card.hidden = selectedTheme !== 'all' && card.dataset.blogTheme !== selectedTheme;
    });
  });
})();
