<?php
$inlineLogoPath = __DIR__ . '/../../../public/assets/img/logo.svg';
$inlineLogo = '';

if (is_readable($inlineLogoPath)) {
    $inlineLogo = file_get_contents($inlineLogoPath) ?: '';
    if ($inlineLogo !== '') {
        // Remove XML declaration/comments to safely inline into HTML.
        $inlineLogo = preg_replace('/<\\?xml[^>]*>\\s*/i', '', $inlineLogo);
        $inlineLogo = preg_replace('/<!--.*?-->/s', '', $inlineLogo);
        $inlineLogo = preg_replace('/fill\\s*:\\s*#[0-9a-fA-F]{3,8}/i', 'fill:#d4af37', $inlineLogo);
        $inlineLogo = preg_replace('/fill\\s*=\\s*"#[0-9a-fA-F]{3,8}"/i', 'fill="#d4af37"', $inlineLogo);
    }
}
?>
<?php
// Carrousel de services : Q&R (scénario Développement) ou contact direct.
$servicesData = require __DIR__ . '/../../data/services.php';
$serviceLocale = class_exists('Lang') ? Lang::locale() : 'fr';
$services = $servicesData[$serviceLocale] ?? $servicesData['fr'];
$serviceItems = $services['items'];
$alignmentRoutes = (require __DIR__ . '/../../config/routes.php')['alignment']['universe-dev'];
$qaBasePath = '/' . $serviceLocale . '/' . ($alignmentRoutes[$serviceLocale] ?? $alignmentRoutes['fr']);
$contactMail = 'thomasgoffinetfr@gmail.com';
?>

<nav class="side-nav">
  <span data-section="intro"></span>
    <div class="line"></div>
  <span data-section="themes"></span>
</nav>

 
<section id="intro" class="bg-black relative min-h-screen text-slate-100 overflow-hidden">

    <!-- Canvas background -->
    <canvas id="vortex-canvas"
            class="absolute inset-0 w-full h-full"></canvas>

    <!-- Logo : centre ABSOLU -->
    <div id="logo-center" class="absolute inset-0 flex items-center justify-center z-10 pointer-events-none">
        <div class="logo-vortex-frame" aria-hidden="true">
            <div class="logo-vortex-svg logo-vortex-spin" role="img" aria-label="Logo MinusVortex">
                <?php if ($inlineLogo !== ''): ?>
                    <?= $inlineLogo ?>
                <?php else: ?>
                    <img
                        src="/assets/img/logo.svg"
                        alt="Logo MinusVortex"
                        width="150"
                        height="150"
                        fetchpriority="high"
                        decoding="async"
                    />
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Contenu texte : flux normal -->
    <div id="intro-content" class="relative z-10 flex flex-col items-center text-center px-6 pt-[65vh] pb-12">

        <h1 class="text-2xl sm:text-5xl md:text-6xl font-bold tracking-tight">
            <?= __('home.title_h1') ?>
        </h1>

        <p class="text-lg md:text-2xl text-slate-300 mt-6 leading-relaxed max-w-xl">
            <?= __('home.text_1') ?>
        </p>

        <p class="text-base md:text-lg text-slate-400 mt-4 leading-relaxed max-w-xl">
            <?= __('home.text_2') ?>
        </p>

        <a href="#themes" class="scroll-indicator mt-10" aria-label="<?= __('home.link_portfolio_text') ?>">
            <span class="scroll-indicator__line" aria-hidden="true"></span>
            <svg class="scroll-indicator__arrow" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M12 5v13m0 0-5-5m5 5 5-5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </a>
    </div>

</section>

<canvas id="minus-system-scene" class="minus-system-scene" aria-hidden="true"></canvas>



<section id="themes" class="theme-scroll-shell" data-theme-scroller data-theme-count="<?= count($serviceItems) ?>">
    <div class="theme-scroll-stage">
        <div class="theme-scroll-copy" aria-live="polite">
            <?php foreach ($serviceItems as $index => $service): ?>
                <?php
                    $serviceTitle = (string)$service['title'];
                    $contactHref = 'mailto:' . $contactMail . '?subject=' . rawurlencode('MinusVortex — ' . $serviceTitle);
                    $qaHref = $service['qa'] !== null ? $qaBasePath . '?s=' . rawurlencode((string)$service['qa']) : null;
                ?>
                <article class="theme-panel<?= $index === 0 ? ' is-active' : '' ?>"
                         data-theme-panel
                         data-theme-index="<?= $index ?>"
                         data-service="<?= htmlspecialchars((string)$service['id'], ENT_QUOTES, 'UTF-8') ?>">
                    <div class="theme-panel__drift">
                        <div class="theme-panel__markers" aria-hidden="true">
                            <?php foreach ($serviceItems as $markerIndex => $markerService): ?>
                                <span class="<?= $markerIndex === $index ? 'is-current' : '' ?>"></span>
                            <?php endforeach; ?>
                        </div>
                        <h2><?= htmlspecialchars($serviceTitle, ENT_QUOTES, 'UTF-8') ?></h2>
                        <p><?= htmlspecialchars((string)$service['text'], ENT_QUOTES, 'UTF-8') ?></p>
                        <div class="theme-panel__actions">
                            <?php if ($qaHref !== null): ?>
                                <a href="<?= htmlspecialchars($contactHref, ENT_QUOTES, 'UTF-8') ?>"
                                   class="theme-choice theme-choice--muted"><?= htmlspecialchars($services['ui']['contact'], ENT_QUOTES, 'UTF-8') ?></a>
                                <a href="<?= htmlspecialchars($qaHref, ENT_QUOTES, 'UTF-8') ?>"
                                   class="theme-choice"
                                   data-theme-link><?= htmlspecialchars($services['ui']['qa'], ENT_QUOTES, 'UTF-8') ?></a>
                            <?php else: ?>
                                <a href="<?= htmlspecialchars($contactHref, ENT_QUOTES, 'UTF-8') ?>"
                                   class="theme-choice"><?= htmlspecialchars($services['ui']['contact'], ENT_QUOTES, 'UTF-8') ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>

            <div class="theme-scroll-hint" data-theme-hint aria-hidden="true">
                <span class="theme-scroll-hint__track"><span class="theme-scroll-hint__glow"></span></span>
                <span class="theme-scroll-hint__label"><?= htmlspecialchars(__('home.themes_hint'), ENT_QUOTES, 'UTF-8') ?></span>
            </div>

            <button type="button" class="theme-arrow theme-arrow--prev is-disabled" data-theme-arrow="-1" aria-label="Theme precedent">
                <span class="theme-arrow__head" aria-hidden="true"></span>
                <span class="theme-arrow__track" aria-hidden="true"><span class="theme-arrow__wave"></span></span>
            </button>
            <button type="button" class="theme-arrow theme-arrow--next" data-theme-arrow="1" aria-label="Theme suivant">
                <span class="theme-arrow__track" aria-hidden="true"><span class="theme-arrow__wave"></span></span>
                <span class="theme-arrow__head" aria-hidden="true"></span>
            </button>
        </div>

        <div class="theme-scroll-scene-space" aria-hidden="true"></div>
    </div>
</section>
 
<script>
  (() => {
    const loaded = new Set();
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const introDownLink = document.querySelector('.scroll-indicator[href="#themes"]');
    const introSection = document.getElementById('intro');
    const introCanvas = document.getElementById('vortex-canvas');
    const introLogo = document.getElementById('logo-center');
    const introContent = document.getElementById('intro-content');
    let introParallaxRaf = 0;
    let smoothScrollRaf = 0;

    function loadScript(src, type) {
      if (loaded.has(src)) return;
      const script = document.createElement('script');
      script.src = src;
      if (type === 'module') script.type = 'module';
      else script.defer = true;
      script.dataset.lazy = '1';
      loaded.add(src);
      document.body.appendChild(script);
    }

    function scheduleWork(callback, timeout = 1400) {
      if ('requestIdleCallback' in window) {
        window.requestIdleCallback(callback, { timeout });
      } else {
        window.setTimeout(callback, 500);
      }
    }

    function easeInOutSine(t) {
      return -(Math.cos(Math.PI * t) - 1) / 2;
    }

    function stopSmoothScroll() {
      if (!smoothScrollRaf) return;
      cancelAnimationFrame(smoothScrollRaf);
      smoothScrollRaf = 0;
    }

    function smoothScrollTo(targetY, duration = 1350) {
      stopSmoothScroll();

      const startY = window.scrollY || window.pageYOffset || 0;
      const maxScroll = Math.max(0, document.documentElement.scrollHeight - window.innerHeight);
      const clampedTarget = Math.max(0, Math.min(maxScroll, targetY));
      const deltaY = clampedTarget - startY;
      const start = performance.now();
      const root = document.documentElement;
      const previousBehavior = root.style.scrollBehavior;
      root.style.scrollBehavior = 'auto';

      function step(now) {
        const elapsed = now - start;
        const progress = Math.min(1, elapsed / duration);
        const eased = easeInOutSine(progress);
        window.scrollTo(0, startY + (deltaY * eased));
        if (progress < 1) {
          smoothScrollRaf = requestAnimationFrame(step);
        } else {
          smoothScrollRaf = 0;
          root.style.scrollBehavior = previousBehavior;
        }
      }

      smoothScrollRaf = requestAnimationFrame(step);
    }

    function applyIntroParallax() {
      if (!introSection || !introCanvas || !introLogo || !introContent) return;

      const rect = introSection.getBoundingClientRect();
      const viewportH = window.innerHeight || 1;

      // 0 at top of page, approaches 1 while section exits viewport.
      const progress = Math.max(0, Math.min(1, (-rect.top) / (rect.height * 0.9)));
      const eased = 1 - Math.pow(1 - progress, 2);

      const canvasY = -24 * eased;
      const logoY = -120 * eased;
      const contentY = -150 * eased;

      introCanvas.style.transform = `translate3d(0, ${canvasY}px, 0)`;
      introCanvas.style.opacity = `${1 - (0.18 * eased)}`;

      introLogo.style.transform = `translate3d(0, ${logoY}px, 0) scale(${1 - (0.08 * eased)})`;
      introLogo.style.opacity = `${1 - eased}`;

      introContent.style.transform = `translate3d(0, ${contentY}px, 0)`;
      introContent.style.opacity = `${1 - (1.12 * eased)}`;

      // Soft cutoff once almost out of view to avoid ghosted text.
      if (rect.bottom < viewportH * 0.22) {
        introLogo.style.opacity = '0';
        introContent.style.opacity = '0';
      }
    }

    function requestIntroParallax() {
      if (introParallaxRaf) return;
      introParallaxRaf = requestAnimationFrame(() => {
        introParallaxRaf = 0;
        applyIntroParallax();
      });
    }

    if (!prefersReducedMotion) {
      window.addEventListener('scroll', requestIntroParallax, { passive: true });
      window.addEventListener('resize', requestIntroParallax);
      requestIntroParallax();
    }

    if (introDownLink) {
      introDownLink.addEventListener('click', (event) => {
        const target = document.getElementById('themes');
        if (!target) return;
        event.preventDefault();

        if (prefersReducedMotion) {
          target.scrollIntoView({ behavior: 'auto', block: 'start' });
          return;
        }

        const top = target.getBoundingClientRect().top + (window.scrollY || window.pageYOffset || 0);
        smoothScrollTo(top, 1400);
      });
    }

    window.addEventListener('wheel', stopSmoothScroll, { passive: true });
    window.addEventListener('touchstart', stopSmoothScroll, { passive: true });

    if (window.innerWidth >= 768) {
      scheduleWork(() => loadScript('/assets/js/side-nav.js?v=20260713-immediate-line'));
    }

    if (!prefersReducedMotion) {
      window.addEventListener('load', () => {
        scheduleWork(() => loadScript('/assets/js/minus-vortex.js'), 1800);
      }, { once: true });
    }

    if (!prefersReducedMotion) {
      scheduleWork(() => loadScript('/assets/js/minus-system-scene.js', 'module'), 1200);
    }
    loadScript('/assets/js/theme-scroller.js?v=20260713-horizontal-only');
  })();
</script>
