<?php
$projects = Lang::getData('portfolio.projects');
?>

<section class="mv-projects-page min-h-screen bg-black px-6 pb-24 pt-36 text-white sm:px-10 lg:px-16 lg:pt-44">
    <div class="mx-auto max-w-7xl">
        <header class="mb-14 max-w-3xl lg:mb-20">
            <p class="mb-4 text-xs font-semibold uppercase tracking-[.28em] text-zinc-500"><?= __('portfolio.eyebrow') ?></p>
            <h1 class="text-4xl font-bold tracking-tight sm:text-5xl lg:text-6xl"><?= __('portfolio.title_h1') ?></h1>
            <p class="mt-6 max-w-2xl text-lg leading-relaxed text-zinc-400 sm:text-xl"><?= __('portfolio.text_1') ?></p>
        </header>

        <div class="mv-projects-grid grid gap-10 sm:grid-cols-2 lg:gap-x-12 lg:gap-y-16">
            <?php foreach ($projects as $project): ?>
                <?php $mediaMode = $project['visual'] === 'nodus' ? 'phone' : 'screen'; ?>
                <article class="mv-project-card group">
                    <div class="mv-project-card__viewer">
                        <div class="mv-project-card__visual mv-project-card__visual--<?= htmlspecialchars($project['visual'], ENT_QUOTES, 'UTF-8') ?>" data-project-card aria-hidden="true">
                            <div class="mv-project-card__inner">
                                <div class="mv-project-card__layer mv-project-card__layer--bg"></div>
                                <div class="mv-project-card__layer mv-project-card__layer--rectangles"></div>
                                <div class="mv-project-card__layer mv-project-card__layer--shadow"></div>
                                <?php foreach (['back', 'main', 'front'] as $depth): ?>
                                    <div class="mv-project-card__layer mv-project-card__layer--media mv-project-card__layer--<?= $depth ?> mv-project-card__layer--<?= $mediaMode ?>">
                                        <?php if ($mediaMode === 'phone'): ?><div class="mv-project-card__phone"><img src="/assets/img/projects/<?= htmlspecialchars($project['image'], ENT_QUOTES, 'UTF-8') ?>" alt="" loading="lazy" decoding="async"></div>
                                        <?php else: ?><div class="mv-project-card__monitor"><img src="/assets/img/projects/<?= htmlspecialchars($project['image'], ENT_QUOTES, 'UTF-8') ?>" alt="" loading="lazy" decoding="async"></div><?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                                <div class="mv-project-card__layer mv-project-card__layer--foil"></div>
                                <div class="mv-project-card__layer mv-project-card__layer--logo"><img src="/assets/img/logo.inline.svg" alt=""></div>
                                <div class="mv-project-card__layer mv-project-card__layer--lines"></div>
                                <div class="mv-project-card__layer mv-project-card__layer--frame"></div>
                                <span class="mv-project-card__badge"><?= htmlspecialchars($project['category'], ENT_QUOTES, 'UTF-8') ?></span>
                                <div class="mv-project-card__title"><strong><?= htmlspecialchars($project['name'], ENT_QUOTES, 'UTF-8') ?></strong></div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 flex items-center justify-between gap-4 text-xs font-semibold uppercase tracking-[.18em] text-zinc-500">
                        <span><?= htmlspecialchars($project['category'], ENT_QUOTES, 'UTF-8') ?></span>
                        <span><?= htmlspecialchars($project['type'], ENT_QUOTES, 'UTF-8') ?></span>
                    </div>
                    <h2 class="mt-3 text-2xl font-semibold tracking-tight sm:text-3xl"><?= htmlspecialchars($project['name'], ENT_QUOTES, 'UTF-8') ?></h2>
                    <p class="mt-3 max-w-xl leading-relaxed text-zinc-400"><?= htmlspecialchars($project['summary'], ENT_QUOTES, 'UTF-8') ?></p>
                    <div class="mt-5 flex flex-wrap gap-2">
                        <?php foreach ($project['tags'] as $tag): ?>
                            <span class="rounded-full border border-white/15 px-3 py-1 text-xs text-zinc-400"><?= htmlspecialchars($tag, ENT_QUOTES, 'UTF-8') ?></span>
                        <?php endforeach; ?>
                    </div>
                    <?php if (!empty($project['url'])): ?>
                        <a class="mt-5 inline-flex items-center gap-2 text-sm font-semibold text-zinc-300 transition hover:text-white" href="<?= htmlspecialchars($project['url'], ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener noreferrer">
                            <?= htmlspecialchars(__('portfolio.visit_site'), ENT_QUOTES, 'UTF-8') ?> <span aria-hidden="true">↗</span>
                        </a>
                    <?php endif; ?>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<script src="/assets/js/project-cards.js" defer></script>
