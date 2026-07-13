<?php
$currentPage = $page ?? 'home';
$currentLang = Lang::locale();

// Mapping pour les URLs traduites (source unique : app/config/routes.php)
$routes = require __DIR__ . '/../../config/routes.php';
$slugMap = $routes['pages'];
$alignmentSlugMap = $routes['alignment'];

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
            <a href="/" id="site-logo-anchor" class="text-2xl font-bold"><img src="/assets/img/logo_63.webp" srcset="/assets/img/logo_63.webp 1x, /assets/img/logo_95.webp 1.5x, /assets/img/logo_126.webp 2x" alt="logo minusvortex" width="63" height="63" decoding="async"/></a>
        </div>
        <!-- Drapeaux pour changer la langue -->
        <nav class="lang-switch">
    <canvas class="lang-switch__canvas" aria-hidden="true"></canvas>
    <?php foreach($languages as $langCode => $langData): ?>
        <?php
            $targetSlug = $slugMap[$currentPage][$langCode] ?? $slugMap['home'][$langCode];
            if ($currentPage === 'alignment' && isset($alignmentTheme, $alignmentSlugMap[$alignmentTheme][$langCode])) {
                $targetSlug = $alignmentSlugMap[$alignmentTheme][$langCode];
            }
            $queryString = '';
            if ($currentPage === 'alignment') {
                $answer = (string)($_GET['a'] ?? '');
                if (in_array($answer, ['agree', 'disagree'], true)) {
                    $queryString = '?a=' . rawurlencode($answer);
                }
            }
        ?>
        <?php $isCurrent = $currentLang === $langCode; ?>
        <a href="/<?= $langCode ?>/<?= $targetSlug ?><?= $queryString ?>"
           aria-label="<?= $langData['label'] ?>"
           class="lang-switch__item <?= $isCurrent ? 'lang-switch__item--active' : '' ?>">
            <span class="text-lg"><?= $langData['flag'] ?></span>
        </a>
    <?php endforeach; ?>
</nav>

    </div>
</header>
