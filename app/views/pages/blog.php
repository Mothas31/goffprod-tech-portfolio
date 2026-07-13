<?php $blogLocale = Lang::locale(); ?>
<section class="min-h-screen bg-black text-zinc-100 px-6 py-28">
    <div class="max-w-3xl mx-auto">
        <h1 class="text-4xl sm:text-5xl font-bold tracking-tight mb-4"><?= htmlspecialchars(Lang::get('seo.blog.h1'), ENT_QUOTES, 'UTF-8') ?></h1>
        <p class="text-zinc-400 text-lg mb-16"><?= htmlspecialchars(Lang::get('seo.blog.description'), ENT_QUOTES, 'UTF-8') ?></p>

        <?php if (empty($articles)): ?>
            <p class="text-zinc-500">—</p>
        <?php endif; ?>

        <div class="space-y-12">
            <?php foreach ($articles as $blogArticle): ?>
                <?php $blogContent = Blog::content($blogArticle, $blogLocale); ?>
                <article class="border-t border-zinc-800 pt-8">
                    <time datetime="<?= htmlspecialchars((string)($blogArticle['date'] ?? ''), ENT_QUOTES, 'UTF-8') ?>" class="text-sm text-zinc-500">
                        <?= htmlspecialchars((string)($blogArticle['date'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                    </time>
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
