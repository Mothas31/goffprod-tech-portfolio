<?php $escape = static fn (string $value): string => htmlspecialchars($value, ENT_QUOTES, 'UTF-8'); ?>
<article class="mv-cases mv-professional-page">
    <header id="case-intro" class="mv-case-hero">
        <p class="mv-kicker"><?= $escape($professional['eyebrow']) ?></p>
        <h1><?= $escape($professional['title']) ?></h1>
        <p class="mv-professional-page-lead"><?= $escape($professional['lead']) ?></p>
        <a class="mv-button" href="mailto:thomas@minusvortex.com?subject=<?= rawurlencode('Décrire mon problème') ?>">Décrire mon problème</a>
    </header>
    <div class="mv-professional-sections">
        <?php foreach ($professional['sections'] as $section): ?>
            <section class="mv-professional-section">
                <h2><?= $escape($section['title']) ?></h2>
                <p><?= $escape($section['text']) ?></p>
            </section>
        <?php endforeach; ?>
    </div>
    <section class="mv-case-closing">
        <p class="mv-kicker">Thomas Goffinet · MinusVortex</p>
        <h2>Partons de votre besoin.</h2>
        <div class="mv-actions">
            <a class="mv-button" href="mailto:thomas@minusvortex.com?subject=<?= rawurlencode('Décrire mon problème') ?>">Décrire mon problème</a>
            <a class="mv-text-link" href="<?= $escape(Seo::pathFor('portfolio', 'fr')) ?>">Développement et intégrations</a>
            <a class="mv-text-link" href="<?= $escape(Seo::pathFor('home', 'fr')) ?>">Revenir à MinusVortex</a>
        </div>
    </section>
</article>
