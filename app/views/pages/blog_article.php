<?php $blogLocale = Lang::locale(); ?>
<article class="min-h-screen bg-black text-zinc-100 px-6 py-28">
    <div class="max-w-3xl mx-auto">
        <a href="<?= htmlspecialchars(Seo::pathFor('blog', $blogLocale), ENT_QUOTES, 'UTF-8') ?>" class="text-sm text-zinc-500 hover:text-zinc-300">&larr; Blog</a>

        <h1 class="text-3xl sm:text-4xl font-bold tracking-tight mt-6 mb-4"><?= htmlspecialchars((string)($content['title'] ?? ''), ENT_QUOTES, 'UTF-8') ?></h1>
        <time datetime="<?= htmlspecialchars((string)($article['date'] ?? ''), ENT_QUOTES, 'UTF-8') ?>" class="text-sm text-zinc-500">
            <?= htmlspecialchars((string)($article['date'] ?? ''), ENT_QUOTES, 'UTF-8') ?> — Thomas Goffinet
        </time>

        <div class="blog-body mt-10">
            <?= $content['body'] ?? '' ?>
        </div>
    </div>
</article>
