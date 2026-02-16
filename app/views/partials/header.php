<?php 
$currentPage = $page ?? 'home';
$currentLang = Lang::locale();

// Mapping pour les URLs traduites
$slugMap = [
    'home' => ['fr' => 'bienvenue', 'en' => 'welcome'],
    'portfolio' => ['fr' => 'portfolio', 'en' => 'portfolio'],
];

?>
<header class="w-full bg-white text-white shadow-md fixed top-0 left-0 z-20">


    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
        <!-- Logo / Titre -->
        <div class="flex">
            <a href="/" class="text-2xl font-bold"><img src="/assets/img/logo_63.webp" alt="logo minusvortex" width="63px" height="63px"/></a>
        </div>
        <!-- Drapeaux pour changer la langue -->
        <nav class="flex gap-4">
    <?php foreach(['fr' => '🇫🇷', 'en' => '🇬🇧'] as $langCode => $flag): ?>
        <?php $targetSlug = $slugMap[$currentPage][$langCode] ?? $slugMap['home'][$langCode]; ?>
        <a href="/<?= $langCode ?>/<?= $targetSlug ?>">
            <?= $flag ?>
        </a>
    <?php endforeach; ?>
</nav>

    </div>
</header>
