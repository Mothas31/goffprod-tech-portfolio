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
        <img
            src="/assets/img/logo_150.webp"
            srcset="/assets/img/logo_150.webp 1x, /assets/img/logo_225.webp 1.5x, /assets/img/logo_300.webp 2x"
            alt="Logo MinusVortex"
            width="150"
            height="150"
            fetchpriority="high"
            decoding="async"
            class="opacity-90"
        />
    </div>

    <!-- Contenu texte : flux normal -->
    <div class="relative z-10 flex flex-col items-center text-center px-6 pt-[65vh] pb-12">

        <h1 class="text-2xl sm:text-5xl md:text-6xl font-bold tracking-tight">
            <?= __('home.title_h1') ?>
        </h1>

        <p class="text-lg md:text-2xl text-slate-300 mt-6 leading-relaxed max-w-xl">
            <?= __('home.text_1') ?>
        </p>

        <a href="<?= __('home.link_portfolio') ?>"
           class="inline-block mt-8 px-8 py-4 rounded-lg font-semibold
                  text-black bg-white hover:bg-white-300 transition">
            <?= __('home.link_portfolio_text') ?>
        </a>
    </div>

</section>



<!-- Section compétences -->
<section id="competences"
         class="w-full min-h-screen py-24 flex flex-col items-center justify-center  text-slate-100">

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
</section>

 

<section class="relative min-h-screen flex items-center justify-center overflow-hidden bg-slate-950 px-6 py-24">
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-20 left-[10%] w-72 h-72 rounded-full bg-white/5 blur-3xl"></div>
        <div class="absolute bottom-16 right-[12%] w-80 h-80 rounded-full bg-slate-100/10 blur-3xl"></div>
    </div>

    <div class="relative z-10 w-full max-w-6xl mx-auto grid md:grid-cols-2 gap-12 items-center">
        <div>
            <p class="text-slate-300 text-sm uppercase tracking-tight mb-4"><?= __('home.value_kicker') ?></p>
            <h2 class="text-3xl sm:text-5xl font-bold text-white mb-6"><?= __('home.value_title') ?></h2>
            <p class="text-lg text-slate-300 leading-relaxed max-w-xl">
                <?= __('home.value_text') ?>
            </p>
        </div>

        <div class="grid gap-4">
            <article class="bg-black/70 ring ring-slate-400/20 rounded-xl p-6">
                <h3 class="text-white font-semibold text-lg mb-2"><?= __('home.value_point_1_title') ?></h3>
                <p class="text-slate-300"><?= __('home.value_point_1_text') ?></p>
            </article>

            <article class="bg-black/70 ring ring-slate-400/20 rounded-xl p-6">
                <h3 class="text-white font-semibold text-lg mb-2"><?= __('home.value_point_2_title') ?></h3>
                <p class="text-slate-300"><?= __('home.value_point_2_text') ?></p>
            </article>

            <article class="bg-black/70 ring ring-slate-400/20 rounded-xl p-6">
                <h3 class="text-white font-semibold text-lg mb-2"><?= __('home.value_point_3_title') ?></h3>
                <p class="text-slate-300"><?= __('home.value_point_3_text') ?></p>
            </article>
        </div>
    </div>
</section>


<section id="prequal" class="relative min-h-screen flex items-center justify-center overflow-hidden bg-slate-950 px-6 py-24">
    <div id="prequal-module-root" class="w-full max-w-4xl" aria-live="polite">
        <noscript>
            <div class="bg-black/70 ring ring-slate-400/20 rounded-xl p-6 text-slate-100 text-center">
                <h2 class="text-2xl sm:text-3xl font-bold mb-4">Qualification de projet</h2>
                <p class="text-slate-300">Active JavaScript pour utiliser le questionnaire de pré-sélection.</p>
            </div>
        </noscript>
    </div>
</section>
 
<script>
  (() => {
    const loaded = new Set();
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

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
