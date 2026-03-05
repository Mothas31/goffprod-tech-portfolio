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
        $inlineLogo = preg_replace('/fill\\s*=\\s*"#[0-9a-fA-F]{3,8}"/i', 'fill="#d43737ff"', $inlineLogo);
    }
}
?>

<nav class="side-nav">
  <span data-section="intro"></span>
    <div class="line"></div>
  <span data-section="competences"></span>
    <div class="line"></div> 
    <span data-section="prequal"></span>     
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

        <a href="#competences" class="scroll-indicator mt-10" aria-label="<?= __('home.link_portfolio_text') ?>">
            <span class="scroll-indicator__line" aria-hidden="true"></span>
            <svg class="scroll-indicator__arrow" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M12 5v13m0 0-5-5m5 5 5-5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </a>
    </div>

</section>



<!-- Section compétences -->
<section id="competences"
         class="competences-surface w-full min-h-screen py-24 flex flex-col items-center justify-center text-slate-100">

    <div class="max-w-6xl mx-auto grid md:grid-cols-3 gap-12">

        <!-- Card 1 -->
        <div class="p-6 bg-black rounded-xl shadow transition flex flex-col items-center">
            <canvas class="skill-canvas"
                    data-shape="cube"
                    width="160"
                    height="160"></canvas>

            <h2 class="text-xl font-bold mt-6 mb-2">  <?= __('home.title_3') ?></h2>
            <p class="text-slate-300 text-sm text-center">
                <?= __('home.skills_card_1_text') ?>
            </p>
        </div>

        <!-- Card 2 -->
        <div class="p-6 bg-black rounded-xl shadow transition flex flex-col items-center">
            <canvas class="skill-canvas"
                    data-shape="bar"
                    width="160"
                    height="160"></canvas>

            <h2 class="text-xl font-bold mt-6 mb-2"><?= __('home.skills_card_2_title') ?></h2>
            <p class="text-slate-300 text-sm text-center">
                <?= __('home.skills_card_2_text') ?>
            </p>
        </div>

        <!-- Card 3 -->
        <div class="p-6 bg-black rounded-xl shadow transition flex flex-col items-center">
            <canvas class="skill-canvas"
                    data-shape="ring"
                    width="160"
                    height="160"></canvas>

            <h2 class="text-xl font-bold mt-6 mb-2"><?= __('home.skills_card_3_title') ?></h2>
            <p class="text-slate-300 text-sm text-center">
                <?= __('home.skills_card_3_text') ?>
            </p>
        </div>

    </div>

    <a href="#prequal" class="cta-gold mt-14" aria-label="Continuer la visite">
        <span class="cta-gold__label" data-text="Continuer la visite">Continuer la visite</span>
    </a>
</section>

 

<section class="value-surface relative min-h-screen flex items-center justify-center overflow-hidden px-6 py-24">
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-28 left-[18%] w-44 h-44 rounded-full bg-white/5 blur-3xl"></div>
        <div class="absolute bottom-24 right-[18%] w-52 h-52 rounded-full bg-white/6 blur-3xl"></div>
    </div>

    <div class="relative z-10 w-full max-w-6xl mx-auto grid md:grid-cols-2 gap-12 items-center">
        <div>
            <p class="text-zinc-300 text-sm uppercase tracking-tight mb-4"><?= __('home.value_kicker') ?></p>
            <h2 class="text-3xl sm:text-5xl font-bold text-white mb-6"><?= __('home.value_title') ?></h2>
            <p class="text-lg text-zinc-300 leading-relaxed max-w-xl">
                <?= __('home.value_text') ?>
            </p>
        </div>

        <div class="grid gap-4">
            <article class="bg-black/72 ring ring-zinc-300/20 rounded-xl p-6">
                <h3 class="text-white font-semibold text-lg mb-2"><?= __('home.value_point_1_title') ?></h3>
                <p class="text-zinc-300"><?= __('home.value_point_1_text') ?></p>
            </article>

            <article class="bg-black/72 ring ring-zinc-300/20 rounded-xl p-6">
                <h3 class="text-white font-semibold text-lg mb-2"><?= __('home.value_point_2_title') ?></h3>
                <p class="text-zinc-300"><?= __('home.value_point_2_text') ?></p>
            </article>

            <article class="bg-black/72 ring ring-zinc-300/20 rounded-xl p-6">
                <h3 class="text-white font-semibold text-lg mb-2"><?= __('home.value_point_3_title') ?></h3>
                <p class="text-zinc-300"><?= __('home.value_point_3_text') ?></p>
            </article>
        </div>
    </div>
</section>


<section id="prequal" class="prequal-surface relative min-h-screen flex items-center justify-center overflow-hidden px-6 py-24">
    <div id="prequal-module-root" class="w-full max-w-4xl" aria-live="polite">
        <noscript>
            <div class="bg-black/72 ring ring-zinc-300/20 rounded-xl p-6 text-zinc-100 text-center">
                <h2 class="text-2xl sm:text-3xl font-bold mb-4">Qualification de projet</h2>
                <p class="text-zinc-300">Active JavaScript pour utiliser le questionnaire de pré-sélection.</p>
            </div>
        </noscript>
    </div>
</section>
 
<script>
  (() => {
    const loaded = new Set();
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const introDownLink = document.querySelector('.scroll-indicator[href="#competences"]');
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
        const target = document.getElementById('competences');
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
      scheduleWork(() => loadScript('/assets/js/side-nav.js'));
    }

    if (!prefersReducedMotion) {
      window.addEventListener('load', () => {
        scheduleWork(() => loadScript('/assets/js/minus-vortex.js'), 1800);
      }, { once: true });
    }

    const skillsSection = document.getElementById('competences');
    if (skillsSection) {
      const observer = new IntersectionObserver((entries, io) => {
        if (!entries[0]?.isIntersecting) return;
        io.disconnect();
        scheduleWork(() => loadScript('/assets/js/skills-3d.js', 'module'));
      }, { rootMargin: '350px 0px' });
      observer.observe(skillsSection);
    }

    const prequalSection = document.getElementById('prequal');
    if (prequalSection) {
      const observer = new IntersectionObserver((entries, io) => {
        if (!entries[0]?.isIntersecting) return;
        io.disconnect();
        scheduleWork(() => loadScript('/assets/js/prequal-loader.js'));
      }, { rootMargin: '250px 0px' });
      observer.observe(prequalSection);
    }
  })();
</script>
