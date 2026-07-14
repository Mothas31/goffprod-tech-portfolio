<?php
$blogLocale = Lang::locale();
$blogFilterAllLabels = [
    'fr' => 'Tous les univers',
    'en' => 'All universes',
    'es' => 'Todos los universos',
    'pt' => 'Todos os universos',
];
$blogFilters = [];
foreach ($articles as $filterArticle) {
    $filterThemeId = (string)($filterArticle['theme'] ?? '');
    if ($filterThemeId === '' || isset($blogFilters[$filterThemeId])) {
        continue;
    }
    $filterBadge = Blog::themeBadge($filterThemeId, $blogLocale);
    if ($filterBadge !== null) {
        $blogFilters[$filterThemeId] = $filterBadge;
    }
}
$blogFilterAllLabel = $blogFilterAllLabels[$blogLocale] ?? $blogFilterAllLabels['fr'];
?>
<section class="min-h-screen bg-black text-zinc-100 px-6 py-28">
    <div class="max-w-7xl mx-auto">
        <h1 class="text-4xl sm:text-5xl font-bold tracking-tight mb-4"><?= htmlspecialchars(Lang::get('seo.blog.h1'), ENT_QUOTES, 'UTF-8') ?></h1>
        <p class="text-zinc-400 text-lg"><?= htmlspecialchars(Lang::get('seo.blog.description'), ENT_QUOTES, 'UTF-8') ?></p>

        <?php if (!empty($blogFilters)): ?>
            <nav class="blog-filters" aria-label="<?= htmlspecialchars($blogFilterAllLabel, ENT_QUOTES, 'UTF-8') ?>" data-blog-filters>
                <button class="blog-filter is-active" type="button" data-blog-filter="all" aria-pressed="true" aria-controls="blog-grid" aria-label="<?= htmlspecialchars($blogFilterAllLabel, ENT_QUOTES, 'UTF-8') ?>" title="<?= htmlspecialchars($blogFilterAllLabel, ENT_QUOTES, 'UTF-8') ?>">
                    <svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="7" cy="7" r="1.5"/><circle cx="17" cy="7" r="1.5"/><circle cx="7" cy="17" r="1.5"/><circle cx="17" cy="17" r="1.5"/></svg>
                </button>
                <?php foreach ($blogFilters as $filterThemeId => $filterBadge): ?>
                    <button class="blog-filter" type="button" data-blog-filter="<?= htmlspecialchars($filterThemeId, ENT_QUOTES, 'UTF-8') ?>" aria-pressed="false" aria-controls="blog-grid" aria-label="<?= htmlspecialchars($filterBadge['label'], ENT_QUOTES, 'UTF-8') ?>" title="<?= htmlspecialchars($filterBadge['label'], ENT_QUOTES, 'UTF-8') ?>">
                        <?= $filterBadge['svg'] ?>
                    </button>
                <?php endforeach; ?>
            </nav>
        <?php endif; ?>

        <?php if (empty($articles)): ?>
            <p class="text-zinc-500">—</p>
        <?php endif; ?>

        <div class="blog-grid" id="blog-grid">
            <?php foreach ($articles as $blogArticle): ?>
                <?php
                    $blogContent = Blog::content($blogArticle, $blogLocale);
                    $blogBadge = Blog::themeBadge($blogArticle['theme'] ?? null, $blogLocale);
                    $blogThemeId = (string)($blogArticle['theme'] ?? '');
                ?>
                <article class="blog-card" data-blog-theme="<?= htmlspecialchars($blogThemeId, ENT_QUOTES, 'UTF-8') ?>">
                    <div class="flex items-center gap-4 text-sm text-zinc-500">
                        <?php if ($blogBadge !== null): ?>
                            <span class="blog-theme-badge">
                                <span class="blog-theme-badge__icon" aria-hidden="true"><?= $blogBadge['svg'] ?></span>
                                <?= htmlspecialchars($blogBadge['label'], ENT_QUOTES, 'UTF-8') ?>
                            </span>
                        <?php endif; ?>
                        <time datetime="<?= htmlspecialchars((string)($blogArticle['date'] ?? ''), ENT_QUOTES, 'UTF-8') ?>">
                            <?= htmlspecialchars((string)($blogArticle['date'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                        </time>
                    </div>
                    <h2 class="text-2xl font-bold mt-2 mb-3">
                        <a href="<?= htmlspecialchars(Seo::pathFor('blogArticle', $blogLocale, null, $blogArticle), ENT_QUOTES, 'UTF-8') ?>" class="hover:text-white text-zinc-100">
                            <?= htmlspecialchars((string)($blogContent['title'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                        </a>
                    </h2>
                    <p class="text-zinc-400 leading-relaxed"><?= htmlspecialchars((string)($blogContent['description'] ?? ''), ENT_QUOTES, 'UTF-8') ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<script src="/assets/js/blog-filter.js?v=20260714-square-filters" defer></script>
