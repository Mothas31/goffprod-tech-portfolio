<?php
$locale = Lang::locale();
$relatedOfferId = $offerId === 'performance' ? 'sobriety' : 'performance';
$checkUrl = Seo::pathFor('alignment', $locale, 'universe-dev');
if ($offerId === 'performance') {
    $checkUrl .= '?s=performance';
} elseif ($offerId === 'sobriety') {
    $checkUrl .= '?s=legacy';
}
$contactUrl = 'mailto:thomas@minusvortex.com?subject=' . rawurlencode('MinusVortex — ' . $offer['eyebrow']);
?>
<article class="offer-page offer-page--<?= htmlspecialchars($offerId, ENT_QUOTES, 'UTF-8') ?>">
    <section class="offer-hero">
        <div class="offer-shell offer-hero__grid">
            <div class="offer-hero__copy">
                <p class="offer-eyebrow"><span></span><?= htmlspecialchars($offer['eyebrow'], ENT_QUOTES, 'UTF-8') ?></p>
                <h1><?= htmlspecialchars($offer['title'], ENT_QUOTES, 'UTF-8') ?></h1>
                <p class="offer-lead"><?= htmlspecialchars($offer['lead'], ENT_QUOTES, 'UTF-8') ?></p>
                <div class="offer-actions">
                    <a class="offer-button offer-button--primary" href="<?= htmlspecialchars($checkUrl, ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($offer['primary_cta'], ENT_QUOTES, 'UTF-8') ?><span aria-hidden="true">↗</span></a>
                    <a class="offer-button offer-button--quiet" href="<?= htmlspecialchars($contactUrl, ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($offer['secondary_cta'], ENT_QUOTES, 'UTF-8') ?></a>
                </div>
            </div>
            <div class="offer-hero__visual" aria-hidden="true">
                <div class="offer-orbit offer-orbit--outer"></div>
                <div class="offer-orbit offer-orbit--inner"></div>
                <div class="offer-visual-core"><span><?= $offerId === 'performance' ? 'P' : '−' ?></span></div>
                <span class="offer-visual-node offer-visual-node--one"></span>
                <span class="offer-visual-node offer-visual-node--two"></span>
                <span class="offer-visual-node offer-visual-node--three"></span>
            </div>
        </div>
        <a class="offer-scroll" href="#offer-measures"><span></span><?= htmlspecialchars($locale === 'fr' ? 'Explorer l’approche' : ($locale === 'es' ? 'Explorar el enfoque' : ($locale === 'pt' ? 'Explorar a abordagem' : 'Explore the approach')), ENT_QUOTES, 'UTF-8') ?></a>
    </section>

    <section id="offer-measures" class="offer-section offer-section--measures">
        <div class="offer-shell">
            <div class="offer-section__intro">
                <p class="offer-eyebrow"><span></span><?= htmlspecialchars($offer['eyebrow'], ENT_QUOTES, 'UTF-8') ?></p>
                <h2><?= htmlspecialchars($offer['metrics_title'], ENT_QUOTES, 'UTF-8') ?></h2>
                <p><?= htmlspecialchars($offer['metrics_intro'], ENT_QUOTES, 'UTF-8') ?></p>
            </div>
            <div class="offer-metrics">
                <?php foreach ($offer['metrics'] as $index => $metric): ?>
                    <article class="offer-metric">
                        <span class="offer-metric__index">0<?= $index + 1 ?></span>
                        <p class="offer-metric__label"><?= htmlspecialchars($metric['label'], ENT_QUOTES, 'UTF-8') ?></p>
                        <h3><?= htmlspecialchars($metric['title'], ENT_QUOTES, 'UTF-8') ?></h3>
                        <p class="offer-metric__text"><?= htmlspecialchars($metric['text'], ENT_QUOTES, 'UTF-8') ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="offer-section offer-section--proof">
        <div class="offer-shell offer-proof-grid">
            <div class="offer-score-card">
                <p class="offer-score-card__kicker"><?= htmlspecialchars($offer['score_kicker'], ENT_QUOTES, 'UTF-8') ?></p>
                <div class="offer-score-ring"><span><?= htmlspecialchars($offer['score_value'], ENT_QUOTES, 'UTF-8') ?></span><small><?= htmlspecialchars($offer['score_unit'], ENT_QUOTES, 'UTF-8') ?></small></div>
                <h2><?= htmlspecialchars($offer['score_title'], ENT_QUOTES, 'UTF-8') ?></h2>
                <p><?= htmlspecialchars($offer['score_text'], ENT_QUOTES, 'UTF-8') ?></p>
                <?php if (!empty($offer['score_link'])): ?>
                    <a class="offer-inline-link" href="https://developer.chrome.com/docs/lighthouse/performance/performance-scoring" target="_blank" rel="noopener noreferrer"><?= htmlspecialchars($offer['score_link'], ENT_QUOTES, 'UTF-8') ?><span aria-hidden="true">↗</span></a>
                <?php endif; ?>
            </div>
            <div class="offer-server-card">
                <p class="offer-eyebrow"><span></span><?= htmlspecialchars($offer['eyebrow'], ENT_QUOTES, 'UTF-8') ?></p>
                <h2><?= htmlspecialchars($offer['server_title'], ENT_QUOTES, 'UTF-8') ?></h2>
                <p><?= htmlspecialchars($offer['server_text'], ENT_QUOTES, 'UTF-8') ?></p>
                <ul>
                    <?php foreach ($offer['server_points'] as $point): ?>
                        <li><span aria-hidden="true">↗</span><?= htmlspecialchars($point, ENT_QUOTES, 'UTF-8') ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <?php if ($offerId === 'performance' && !empty($offer['source_note'])): ?>
            <p class="offer-source-note"><?= htmlspecialchars($offer['source_note'], ENT_QUOTES, 'UTF-8') ?> <a href="https://web.dev/articles/vitals" target="_blank" rel="noopener noreferrer">web.dev</a>.</p>
        <?php endif; ?>
    </section>

    <section class="offer-section offer-section--method">
        <div class="offer-shell">
            <div class="offer-section__intro">
                <p class="offer-eyebrow"><span></span>MinusVortex</p>
                <h2><?= htmlspecialchars($offer['method_title'], ENT_QUOTES, 'UTF-8') ?></h2>
            </div>
            <div class="offer-steps">
                <?php foreach ($offer['steps'] as $step): ?>
                    <article class="offer-step">
                        <span class="offer-step__number"><?= htmlspecialchars($step['number'], ENT_QUOTES, 'UTF-8') ?></span>
                        <h3><?= htmlspecialchars($step['title'], ENT_QUOTES, 'UTF-8') ?></h3>
                        <p><?= htmlspecialchars($step['text'], ENT_QUOTES, 'UTF-8') ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
            <div class="offer-deliverable">
                <span class="offer-deliverable__mark" aria-hidden="true">∴</span>
                <div><h3><?= htmlspecialchars($offer['deliverable_title'], ENT_QUOTES, 'UTF-8') ?></h3><p><?= htmlspecialchars($offer['deliverable_text'], ENT_QUOTES, 'UTF-8') ?></p></div>
            </div>
        </div>
    </section>

    <section class="offer-section offer-section--related">
        <div class="offer-shell offer-related">
            <div><p class="offer-eyebrow"><span></span><?= htmlspecialchars($offer['related_kicker'], ENT_QUOTES, 'UTF-8') ?></p><p><?= htmlspecialchars($offer['related_text'], ENT_QUOTES, 'UTF-8') ?></p></div>
            <a href="<?= htmlspecialchars(Seo::pathFor($relatedOfferId, $locale), ENT_QUOTES, 'UTF-8') ?>" class="offer-button offer-button--quiet"><?= htmlspecialchars($offer['related_cta'], ENT_QUOTES, 'UTF-8') ?><span aria-hidden="true">→</span></a>
        </div>
    </section>

    <section class="offer-final">
        <div class="offer-shell">
            <p class="offer-eyebrow"><span></span>MinusVortex</p>
            <h2><?= htmlspecialchars($offer['closing_title'], ENT_QUOTES, 'UTF-8') ?></h2>
            <p><?= htmlspecialchars($offer['closing_text'], ENT_QUOTES, 'UTF-8') ?></p>
            <div class="offer-actions">
                <a class="offer-button offer-button--primary" href="<?= htmlspecialchars($checkUrl, ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($offer['primary_cta'], ENT_QUOTES, 'UTF-8') ?><span aria-hidden="true">↗</span></a>
                <a class="offer-button offer-button--quiet" href="<?= htmlspecialchars($contactUrl, ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($offer['secondary_cta'], ENT_QUOTES, 'UTF-8') ?></a>
            </div>
        </div>
    </section>
</article>
