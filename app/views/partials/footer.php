<footer id="site-footer" class="relative z-10 bg-black text-center px-6 py-10">
    <div class="max-w-3xl mx-auto border-t border-white/25 pt-8">
        <nav class="mb-4">
            <a href="<?= htmlspecialchars(Seo::pathFor('blog', Lang::locale()), ENT_QUOTES, 'UTF-8') ?>" class="text-white text-base font-medium hover:text-zinc-300"><?= htmlspecialchars(__('common.blog_cta'), ENT_QUOTES, 'UTF-8') ?> &rarr;</a>
        </nav>
        <p class="text-zinc-500 text-sm">&copy; <?= date('Y') ?> MinusVortex - <?= __('common.footer_tagline') ?></p>
    </div>
</footer>

<?php if (!in_array($page ?? '', ['blog', 'blogArticle'], true)): ?>
<!-- Rappel flottant du footer (trait + texte) : fade in dans la zone des themes,
     s'efface quand le vrai footer entre dans le viewport et prend sa place. -->
<a href="<?= htmlspecialchars(Seo::pathFor('blog', Lang::locale()), ENT_QUOTES, 'UTF-8') ?>" class="footer-float-cta is-waiting" data-footer-float-cta>
    <span class="footer-float-cta__line" aria-hidden="true"></span>
    <span class="footer-float-cta__label"><?= htmlspecialchars(__('common.blog_cta'), ENT_QUOTES, 'UTF-8') ?> <span aria-hidden="true">&rarr;</span></span>
</a>
<script>
  (() => {
    const cta = document.querySelector('[data-footer-float-cta]');
    const footer = document.getElementById('site-footer');
    if (!cta || !footer || !('IntersectionObserver' in window)) return;

    let inThemes = false;
    let footerVisible = false;
    const themes = document.getElementById('themes');

    function sync() {
      cta.classList.toggle('is-waiting', themes ? !inThemes : false);
      cta.classList.toggle('is-docked', footerVisible);
    }

    if (themes) {
      new IntersectionObserver((entries) => {
        entries.forEach((entry) => { inThemes = entry.isIntersecting; });
        sync();
      }, { threshold: 0.25 }).observe(themes);
    }

    new IntersectionObserver((entries) => {
      entries.forEach((entry) => { footerVisible = entry.isIntersecting; });
      sync();
    }, { threshold: 0.1 }).observe(footer);

    sync();
  })();
</script>
<?php endif; ?>
