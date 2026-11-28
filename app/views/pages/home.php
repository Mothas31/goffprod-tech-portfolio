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
$story = Lang::getData('philosophy.content');
$locale = Lang::locale();
$professional = $locale === 'fr' ? Lang::getData('professional.home') : null;
$escape = static fn (string $value): string => htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
$lines = static fn (array $values): string => implode('<br>', array_map($escape, $values));
if ($professional !== null) {
    $priority = ['universe-dev', 'universe-ai'];
    usort($story['universes'], static fn ($a, $b) => (array_search($a['id'], $priority, true) === false ? 2 : array_search($a['id'], $priority, true)) <=> (array_search($b['id'], $priority, true) === false ? 2 : array_search($b['id'], $priority, true)));
}
$universeShapes = [
    'universe-finance' => '<path d="M9 30h30M15 38V22m9 16V10m9 28V17"/>',
    'universe-dev' => '<rect x="10" y="10" width="28" height="28"/><path d="M18 24h12"/>',
    'universe-health' => '<circle cx="24" cy="24" r="15"/><path d="M9 24h9l3-6 6 12 3-6h9"/>',
    'universe-formation' => '<path d="M10 36V12h28M18 30l8-8 8 3"/>',
    'universe-quality' => '<circle cx="24" cy="24" r="15"/><path d="m17 24 5 5 10-11"/>',
    'universe-mobility' => '<path d="M9 34h13a7 7 0 0 0 0-14h-2a7 7 0 0 1 0-14h19"/><circle cx="9" cy="34" r="3"/>',
    'universe-ai' => '<path d="m24 7 17 17-17 17L7 24Z"/><path d="M18 24h12m-6-6v12"/>',
];
?>
<div class="mv-home">
    <div class="mv-reading-progress" aria-hidden="true"><span data-mv-progress></span></div>
<section id="intro" class="mv-canvas-intro" aria-labelledby="mv-brand-title">

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

        <?php if ($professional !== null): ?>
            <p class="mv-professional-identity"><?= $escape($professional['identity']) ?></p>
            <h1 id="mv-brand-title"><?= $escape($professional['title']) ?></h1>
            <p class="mv-professional-lead"><?= $escape($professional['lead']) ?></p>
            <p class="mv-professional-examples"><?= $escape($professional['examples']) ?></p>
            <a class="mv-button mv-professional-contact" href="mailto:thomas@minusvortex.com?subject=<?= rawurlencode($professional['contact']) ?>"><?= $escape($professional['contact']) ?></a>
            <nav class="mv-professional-doors" aria-label="Les deux interventions principales">
                <a href="<?= $escape(Seo::pathFor('portfolio', 'fr')) ?>">Développement</a>
                <a href="<?= $escape(Seo::pathFor('ai', 'fr')) ?>">IA · sites simples et accompagnement</a>
            </nav>
        <?php else: ?>
            <h1 id="mv-brand-title" class="text-2xl sm:text-5xl md:text-6xl font-bold tracking-tight"><?= __('home.title_h1') ?></h1>
            <p class="text-lg md:text-2xl text-slate-300 mt-6 leading-relaxed max-w-xl"><?= $escape($story['footer']) ?></p>
            <p class="text-base md:text-lg text-slate-400 mt-4 leading-relaxed max-w-xl"><?= $escape($story['hero_text']) ?></p>
        <?php endif; ?>

        <a href="#philosophie" class="scroll-indicator mt-10" aria-label="<?= $escape($story['hero_cta']) ?>">
            <span class="scroll-indicator__line" aria-hidden="true"></span>
            <svg class="scroll-indicator__arrow" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M12 5v13m0 0-5-5m5 5 5-5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </a>
    </div>

</section>
    <div class="mv-story" data-mv-story>
        <div class="mv-stage">
            <div class="mv-stage-inner">
                <div class="mv-depth-visual" data-mv-depth>
                    <svg class="mv-geometry mv-depth-fallback" viewBox="0 0 600 600" fill="none" stroke="currentColor" aria-hidden="true">
                        <g stroke-opacity=".2"><path d="M124 156 341 101 472 205 255 260ZM124 156v265l131 78 217-55V205M255 260v239M341 101v265l131 78M124 421l217-55"/></g>
                        <g stroke-opacity=".45"><path d="m158 187 185-43 96 80-185 43Zm0 0v220l96 62 185-44V224M254 267v202"/></g>
                        <path d="m203 217 132-29 60 51v166l-132 31-60-42Zm0 0 60 51 132-29M263 268v168"/>
                    </svg>
                    <canvas class="mv-depth-canvas" data-mv-depth-canvas aria-hidden="true"></canvas>
                    <a class="mv-depth-portal" data-mv-portal hidden href="<?= $escape(Seo::pathFor('portfolio', $locale)) ?>" aria-label="<?= $escape($story['projects']) ?>">
                        <span><?= $escape($story['projects']) ?></span>
                    </a>
                </div>
                <div class="mv-scene-caption" aria-hidden="true">
                    <span class="mv-scene-rule"></span>
                    <div class="mv-scene-labels">
                        <?php foreach ($story['scene_labels'] as $index => $label): ?>
                            <span data-mv-label="<?= $index ?>"<?= $index === 0 ? ' class="is-active"' : '' ?>><?= $escape($label) ?></span>
                        <?php endforeach; ?>
                    </div>
                    <span class="mv-scene-symbol">−</span>
                </div>
            </div>
        </div>

        <div class="mv-story-content">
            <section id="philosophie" class="mv-chapter mv-hero" data-mv-step="0" aria-labelledby="mv-title">
                <p class="mv-kicker"><?= $escape($story['eyebrow']) ?></p>
                <h2 id="mv-title"><?= $lines($story['hero_lines']) ?></h2>
                <p class="mv-copy"><?= $escape($story['hero_text']) ?></p>
                <div class="mv-actions">
                    <a class="mv-button" href="#accumuler"><?= $escape($story['hero_cta']) ?></a>
                    <a class="mv-text-link" href="#themes"><?= $escape($story['hero_skip']) ?></a>
                </div>
                <p class="mv-scroll-note"><span aria-hidden="true"></span><?= $escape($story['scroll_hint']) ?></p>
            </section>
            <?php foreach ($story['chapters'] as $index => $chapter): ?>
                <section id="<?= $escape($chapter['id']) ?>" class="mv-chapter" data-mv-step="<?= $index + 1 ?>" aria-labelledby="mv-title-<?= $index ?>">
                    <p class="mv-kicker"><?= $escape($chapter['kicker']) ?></p>
                    <h2 id="mv-title-<?= $index ?>"><?= $lines($chapter['lines']) ?></h2>
                    <p class="mv-copy"><?= $escape($chapter['text']) ?></p>
                    <p class="mv-example"><?= $escape($chapter['example']) ?></p>
                </section>
            <?php endforeach; ?>
        </div>
    </div>

    <section class="mv-bridge" aria-labelledby="mv-bridge-title">
        <div class="mv-bridge-mark" aria-hidden="true"><img src="/assets/img/logo.svg" alt="" width="72" height="72" decoding="async"></div>
        <p class="mv-kicker"><?= $escape($story['bridge_kicker']) ?></p>
        <h2 id="mv-bridge-title"><?= $escape($story['bridge_line_1']) ?><br><span><?= $escape($story['bridge_line_2']) ?></span></h2>
        <p class="mv-copy"><?= $escape($story['bridge_text']) ?></p>
    </section>

    <section id="themes" class="mv-universes" aria-labelledby="mv-universes-title">
        <div class="mv-universes-intro">
            <p class="mv-kicker"><?= $escape($story['universes_kicker']) ?></p>
            <h2 id="mv-universes-title"><?= nl2br($escape($story['universes_title'])) ?></h2>
            <p class="mv-copy"><?= $escape($story['universes_text']) ?></p>
        </div>
        <div class="mv-universe-carousel" data-universe-carousel>
            <div class="mv-universe-selector" data-universe-controls hidden>
                <p class="mv-universe-select-label"><?= $escape($story['universe_select']) ?></p>
                <nav class="mv-universe-tabs" aria-label="<?= $escape($story['universe_nav']) ?>">
                    <?php foreach ($story['universes'] as $index => $universe): ?>
                        <button type="button" data-universe-go="<?= $index ?>" aria-controls="mv-universe-track"<?= $index === 0 ? ' aria-current="true"' : '' ?>><?= $escape($universe['title']) ?></button>
                    <?php endforeach; ?>
                </nav>
            </div>
            <div id="mv-universe-track" class="mv-universe-track" data-universe-track tabindex="0" role="region" aria-label="<?= $escape($story['carousel_label']) ?>">
                <?php foreach ($story['universes'] as $index => $universe):
                    $primary = $locale === 'fr' && in_array($universe['id'], ['universe-dev', 'universe-ai'], true);
                    $universeUrl = $primary ? Seo::pathFor($universe['id'] === 'universe-dev' ? 'portfolio' : 'ai', 'fr') : Seo::pathFor('alignment', $locale, $universe['id']);
                    ?>
                    <article class="mv-universe-slide" data-universe-slide data-title="<?= $escape($universe['title']) ?>" aria-labelledby="universe-title-<?= $index ?>">
                        <div class="mv-universe-drawing" aria-hidden="true">
                            <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1"><?= $universeShapes[$universe['id']] ?></svg>
                        </div>
                        <div class="mv-universe-floating-copy">
                            <p class="mv-universe-status"><?= $escape($universe['status']) ?></p>
                            <h3 id="universe-title-<?= $index ?>"><?= $escape($universe['title']) ?></h3>
                            <p class="mv-universe-situation"><?= $escape($universe['situation']) ?></p>
                            <p class="mv-universe-description"><?= $escape($universe['text']) ?></p>
                            <div class="mv-universe-entry">
                                <a class="mv-button" href="<?= $escape($universeUrl) ?>"><?= $escape($primary ? 'Découvrir l’intervention' : $story['universe_action']) ?></a>
                                <span><?= $escape($primary ? 'Sur devis' : $story['universe_format']) ?></span>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
            <div class="mv-universe-controls" data-universe-controls hidden>
                <button type="button" class="mv-universe-step" data-universe-step="-1" aria-label="<?= $escape($story['previous_universe']) ?>" aria-controls="mv-universe-track"><?= $escape($story['previous_short']) ?></button>
                <p data-universe-position aria-live="polite" aria-atomic="true"><?= $escape($story['universes'][0]['title']) ?> · 1 / <?= count($story['universes']) ?></p>
                <button type="button" class="mv-universe-step" data-universe-step="1" aria-label="<?= $escape($story['next_universe']) ?>" aria-controls="mv-universe-track"><?= $escape($story['next_short']) ?></button>
            </div>
            <div class="mv-universe-meta">
                <p><?= $escape($story['swipe_hint']) ?></p>
            </div>
        </div>
    </section>

    <section class="mv-proof" aria-labelledby="mv-proof-title">
        <div><h2 id="mv-proof-title"><?= $escape($story['proof_title']) ?></h2><p><?= $escape($story['proof_text']) ?></p></div>
        <div class="mv-actions">
            <a class="mv-text-link" href="<?= $escape(Seo::pathFor('portfolio', $locale)) ?>"><?= $escape($story['projects']) ?></a>
            <a class="mv-text-link" href="<?= $escape(Seo::pathFor('blog', $locale)) ?>"><?= $escape($story['signals']) ?></a>
        </div>
    </section>
</div>
<script src="/assets/js/universe-carousel.js?v=20261126-clarity" defer></script>
<script src="/assets/js/minus-vortex.js" defer></script>
<script src="/assets/js/home-philosophy.js?v=20261126-lazy" defer></script>
