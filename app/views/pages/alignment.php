<?php
// Contenu rendu cote serveur (SEO / crawlers IA sans JS) : le module
// interactif remplace le innerHTML du root une fois charge.
$prequalTree = require __DIR__ . '/../../data/prequal_tree.php';
$ssrLocale = class_exists('Lang') ? Lang::locale() : 'fr';
$ssrUniverses = $prequalTree[$ssrLocale]['universes'] ?? ($prequalTree['fr']['universes'] ?? []);
$ssrUniverse = null;
foreach ($ssrUniverses as $universe) {
    if (($universe['id'] ?? '') === ($alignmentTheme ?? '')) {
        $ssrUniverse = $universe;
        break;
    }
}
?>
<section id="prequal" class="prequal-surface prequal-surface--alignment relative min-h-screen flex items-stretch justify-center overflow-hidden px-6 py-24">
    <div
        id="prequal-module-root"
        class="w-full self-stretch flex"
        aria-live="polite"
        data-prequal-theme="<?= htmlspecialchars($alignmentTheme ?? '', ENT_QUOTES, 'UTF-8') ?>"
    >
        <?php if ($ssrUniverse !== null): ?>
            <div class="self-center mx-auto max-w-2xl text-zinc-100 text-center">
                <h1 class="text-3xl sm:text-4xl font-bold mb-6"><?= htmlspecialchars((string)($ssrUniverse['label'] ?? ''), ENT_QUOTES, 'UTF-8') ?></h1>
                <p class="text-zinc-300 text-lg leading-relaxed mb-4"><?= htmlspecialchars((string)($ssrUniverse['statement'] ?? ''), ENT_QUOTES, 'UTF-8') ?></p>
                <?php if (!empty($ssrUniverse['orientation'])): ?>
                    <p class="text-zinc-400"><?= htmlspecialchars((string)$ssrUniverse['orientation'], ENT_QUOTES, 'UTF-8') ?></p>
                <?php endif; ?>
                <noscript>
                    <p class="text-zinc-400 mt-6">Active JavaScript pour utiliser le module interactif d'alignement.</p>
                </noscript>
            </div>
        <?php else: ?>
            <noscript>
                <div class="bg-black/72 ring ring-zinc-300/20 rounded-xl p-6 text-zinc-100 text-center">
                    <h2 class="text-2xl sm:text-3xl font-bold mb-4">Alignement</h2>
                    <p class="text-zinc-300">Active JavaScript pour utiliser le module interactif.</p>
                </div>
            </noscript>
        <?php endif; ?>
    </div>
</section>

<script src="/assets/js/prequal-loader.js?v=20260703-business-minimal-1" defer></script>
