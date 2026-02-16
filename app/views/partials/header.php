<?php 
$currentPage = $page ?? 'home';
$currentLang = Lang::locale();

// Mapping pour les URLs traduites
$slugMap = [
    'home' => [
        'fr' => 'bienvenue',
        'en' => 'welcome',
        'es' => 'bienvenido',
        'pt' => 'bem-vindo',
    ],
    'portfolio' => [
        'fr' => 'portfolio',
        'en' => 'portfolio',
        'es' => 'portafolio',
        'pt' => 'portfolio',
    ],
];

$languages = [
    'fr' => ['flag' => '🇫🇷', 'label' => 'Français'],
    'en' => ['flag' => '🇬🇧', 'label' => 'English'],
    'es' => ['flag' => '🇪🇸', 'label' => 'Español'],
    'pt' => ['flag' => '🇵🇹', 'label' => 'Português'],
];

?>
<header class="w-full bg-white text-white shadow-md fixed top-0 left-0 z-20">


    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
        <!-- Logo / Titre -->
        <div class="flex">
            <a href="/" id="site-logo-anchor" class="text-2xl font-bold"><img src="/assets/img/logo_63.webp" alt="logo minusvortex" width="63px" height="63px"/></a>
        </div>
        <!-- Drapeaux pour changer la langue -->
        <nav class="lang-switch">
    <canvas class="lang-switch__canvas" aria-hidden="true"></canvas>
    <?php foreach($languages as $langCode => $langData): ?>
        <?php $targetSlug = $slugMap[$currentPage][$langCode] ?? $slugMap['home'][$langCode]; ?>
        <?php $isCurrent = $currentLang === $langCode; ?>
        <a href="/<?= $langCode ?>/<?= $targetSlug ?>"
           aria-label="<?= $langData['label'] ?>"
           class="lang-switch__item <?= $isCurrent ? 'lang-switch__item--active' : '' ?>">
            <span class="text-lg"><?= $langData['flag'] ?></span>
        </a>
    <?php endforeach; ?>
</nav>

    </div>
</header>
