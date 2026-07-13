<footer class=" text-black-500 py-6 text-center p-10">
    &copy; <?= date('Y') ?> Thomas Goffinet - <?= __('common.footer_tagline') ?>
    <nav class="mt-2 text-sm">
        <a href="<?= htmlspecialchars(Seo::pathFor('blog', Lang::locale()), ENT_QUOTES, 'UTF-8') ?>" class="text-zinc-500 hover:text-zinc-300 underline underline-offset-4">Blog</a>
    </nav>
</footer>
