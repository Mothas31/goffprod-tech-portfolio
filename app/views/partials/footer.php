<footer class="bg-black text-center px-6 py-10">
    <div class="max-w-3xl mx-auto border-t border-white/25 pt-8">
        <nav class="mb-4">
            <a href="<?= htmlspecialchars(Seo::pathFor('blog', Lang::locale()), ENT_QUOTES, 'UTF-8') ?>" class="text-white text-base font-medium hover:text-zinc-300">Blog</a>
        </nav>
        <p class="text-zinc-500 text-sm">&copy; <?= date('Y') ?> MinusVortex - <?= __('common.footer_tagline') ?></p>
    </div>
</footer>
