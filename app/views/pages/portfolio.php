<?php
$cases = Lang::getData('portfolio.cases');
$escape = static fn (string $value): string => htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
$positions = [[48, 65], [240, 65], [432, 65], [144, 260], [336, 260]];
$paths = [
    'evoluer' => 'M168 97H240M360 97H432M108 129 204 260M300 129 396 260M492 129 204 260M204 260 300 129M264 292H336M108 129 396 260',
    'relier' => 'M168 97H240M360 97H432M492 129V210H396V260M336 292H264M144 292H108V129',
    'decider' => 'M168 97H240M360 97H432M108 129V210H204V260M300 129V210H204M492 129V210H204',
];
?>
<div class="mv-cases">
    <header id="case-intro" class="mv-case-hero">
        <p class="mv-kicker"><?= $escape(__('portfolio.eyebrow')) ?></p>
        <h1><?= $escape(__('portfolio.title')) ?></h1>
        <div class="mv-case-hero-bottom">
            <p class="mv-case-lead"><?= $escape(__('portfolio.intro')) ?></p>
            <div class="mv-case-intent">
                <p><?= $escape(__('portfolio.note')) ?></p>
                <a class="mv-text-link" href="#<?= $escape($cases[0]['id']) ?>"><?= $escape(__('portfolio.jump')) ?></a>
            </div>
        </div>
    </header>

    <nav class="mv-case-nav" aria-label="<?= $escape(__('portfolio.nav')) ?>">
        <?php foreach ($cases as $index => $case): ?>
            <a href="#<?= $escape($case['id']) ?>"<?= $index === 0 ? ' aria-current="location"' : '' ?>><?= $escape($case['label']) ?></a>
        <?php endforeach; ?>
    </nav>

    <?php foreach ($cases as $case):
        $caseId = $case['id'];
        $alignmentUrl = Seo::pathFor('alignment', Lang::locale(), $case['theme']);
        if ($case['query'] !== '') $alignmentUrl .= '?s=' . rawurlencode($case['query']);
    ?>
        <article id="<?= $escape($caseId) ?>" class="mv-case" data-case>
            <div class="mv-case-heading">
                <p class="mv-kicker"><?= $escape(__('portfolio.scenario')) ?> · <?= $escape($case['label']) ?></p>
                <h2><?= nl2br($escape($case['title'])) ?></h2>
            </div>
            <div class="mv-case-body">
                <div class="mv-case-reasoning">
                    <section class="mv-case-problem">
                        <h3><?= $escape(__('portfolio.problem_label')) ?></h3>
                        <p><?= $escape($case['problem']) ?></p>
                    </section>
                    <section>
                        <h3><?= $escape(__('portfolio.constraint_label')) ?></h3>
                        <p><?= $escape($case['constraint']) ?></p>
                    </section>
                    <section class="mv-case-approach">
                        <h3><?= $escape(__('portfolio.approach_label')) ?></h3>
                        <p><?= $escape($case['approach']) ?></p>
                    </section>
                    <section>
                        <h3><?= $escape(__('portfolio.verify_label')) ?></h3>
                        <p><?= $escape($case['verify']) ?></p>
                    </section>
                    <a class="mv-text-link" href="<?= $escape($alignmentUrl) ?>"><?= $escape(__('portfolio.cta')) ?></a>
                </div>
                <div class="mv-case-visual" data-case-mode="before">
                    <div class="mv-case-controls" hidden role="group" aria-label="<?= $escape(__('portfolio.diagram_label')) ?>">
                        <button type="button" data-case-choice="before" aria-pressed="true" aria-controls="diagram-<?= $escape($caseId) ?>"><?= $escape(__('portfolio.before')) ?></button>
                        <button type="button" data-case-choice="after" aria-pressed="false" aria-controls="diagram-<?= $escape($caseId) ?>"><?= $escape(__('portfolio.after')) ?></button>
                    </div>
                    <figure>
                        <div id="diagram-<?= $escape($caseId) ?>" class="mv-case-diagram">
                            <svg viewBox="0 0 600 400" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <defs><pattern id="grid-<?= $escape($caseId) ?>" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M40 0H0V40" stroke="currentColor" stroke-opacity=".055"/></pattern></defs>
                                <rect width="600" height="400" fill="url(#grid-<?= $escape($caseId) ?>)"/>
                                <g class="mv-diagram-before">
                                    <path class="mv-case-route mv-case-route--tangled" d="<?= $paths[$caseId] ?>"/>
                                    <?php foreach ($positions as $i => [$x, $y]): ?>
                                        <g class="mv-case-node<?= $i === 4 ? ' mv-case-node--question' : '' ?>">
                                            <rect x="<?= $x ?>" y="<?= $y ?>" width="120" height="64"/>
                                            <text x="<?= $x + 60 ?>" y="<?= $y + 37 ?>"><?= $escape($case['nodes'][$i]) ?></text>
                                        </g>
                                    <?php endforeach; ?>
                                </g>
                                <g class="mv-diagram-after">
                                    <path class="mv-case-route" d="M184 192H232M368 192H416"/>
                                    <?php foreach ([48, 232, 416] as $i => $x): ?>
                                        <g class="mv-case-node mv-case-node--clear">
                                            <rect x="<?= $x ?>" y="160" width="136" height="64"/>
                                            <text x="<?= $x + 68 ?>" y="197"><?= $escape($case['nodes'][$i + 5]) ?></text>
                                        </g>
                                    <?php endforeach; ?>
                                </g>
                            </svg>
                            <div class="mv-case-mobile-diagram" aria-hidden="true">
                                <div class="mv-diagram-before">
                                    <?php foreach (array_slice($case['nodes'], 0, 5) as $node): ?>
                                        <span><?= $escape($node) ?></span>
                                    <?php endforeach; ?>
                                </div>
                                <div class="mv-diagram-after">
                                    <?php foreach (array_slice($case['nodes'], 5) as $node): ?>
                                        <span><?= $escape($node) ?></span>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <figcaption data-case-caption data-before="<?= $escape($case['before_caption']) ?>" data-after="<?= $escape($case['after_caption']) ?>" aria-live="polite"><?= $escape($case['before_caption']) ?></figcaption>
                    </figure>
                </div>
            </div>
        </article>
    <?php endforeach; ?>

    <section class="mv-case-closing">
        <p class="mv-kicker">MinusVortex</p>
        <h2><?= $escape(__('portfolio.closing_title')) ?></h2>
        <p><?= $escape(__('portfolio.closing_text')) ?></p>
        <div class="mv-actions">
            <a class="mv-button" href="mailto:thomasgoffinetfr@gmail.com?subject=<?= rawurlencode(__('portfolio.contact')) ?>"><?= $escape(__('portfolio.contact')) ?></a>
            <a class="mv-text-link" href="<?= $escape(Seo::pathFor('blog', Lang::locale())) ?>"><?= $escape(__('portfolio.signals')) ?></a>
        </div>
        <a class="mv-case-return mv-text-link" href="<?= $escape(Seo::pathFor('home', Lang::locale())) ?>"><?= $escape(__('portfolio.back')) ?></a>
    </section>
</div>
<script src="/assets/js/case-studies.js?v=20261125" defer></script>
