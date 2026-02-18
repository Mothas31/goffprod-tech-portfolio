const navDots = document.querySelectorAll('.side-nav span');
const navLines = document.querySelectorAll('.side-nav .line');
const sections = Array.from(navDots)
  .map((dot) => document.getElementById(dot.dataset.section))
  .filter(Boolean);
const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

// Mettre à jour la hauteur des lignes
function updateLinesHeight() {
  navLines.forEach((line, i) => {
    const dot = navDots[i];
    const nextDot = navDots[i + 1];
    if (!nextDot) return;

    const top = dot.offsetTop + dot.offsetHeight / 2;
    const bottom = nextDot.offsetTop + nextDot.offsetHeight / 2;
    line.style.top = `${top}px`;
    line.style.height = `${bottom - top}px`;
  });
}

window.addEventListener('load', updateLinesHeight);
window.addEventListener('resize', updateLinesHeight);

// Intersection Observer
const observer = new IntersectionObserver(
  entries => {
    entries.forEach(entry => {
      const index = Array.from(sections).indexOf(entry.target);

      if (entry.isIntersecting) {
        if (index < 0 || index >= navDots.length) {
          return;
        }

        // Mettre à jour les points
        navDots.forEach(dot => dot.classList.remove('active'));
        navDots[index].classList.add('active');

        // Mettre à jour les lignes
        navLines.forEach((line, i) => {
          if (i < index) {
            line.classList.add('active'); // ligne avant active
          } else {
            line.classList.remove('active'); // ligne après inactive
          }
        });
      }
    });
  },
  { threshold: 0.5 }
);

sections.forEach(section => observer.observe(section));

function scrollToSectionByDot(dot) {
  const id = dot.dataset.section;
  if (!id) return;
  const target = document.getElementById(id);
  if (!target) return;

  target.scrollIntoView({
    behavior: prefersReducedMotion ? 'auto' : 'smooth',
    block: 'start'
  });
}

navDots.forEach((dot) => {
  dot.setAttribute('role', 'button');
  dot.setAttribute('tabindex', '0');
  dot.setAttribute('aria-label', `Aller a la section ${dot.dataset.section || ''}`);

  dot.addEventListener('click', () => {
    scrollToSectionByDot(dot);
  });

  dot.addEventListener('keydown', (event) => {
    if (event.key !== 'Enter' && event.key !== ' ') return;
    event.preventDefault();
    scrollToSectionByDot(dot);
  });
});
