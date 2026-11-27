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
<?php if (in_array($currentPage, ['home', 'portfolio'], true)):
    $homeStory = Lang::getData('philosophy.content');
    $homeBase = $currentPage === 'home' ? '' : Seo::pathFor('home', $currentLang);
    $headerEscape = static fn (string $value): string => htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
?>
<a class="mv-skip" href="<?= $currentPage === 'home' ? '#intro' : '#case-intro' ?>"><?= $headerEscape($homeStory['nav_skip']) ?></a>
<header class="mv-header">
    <a class="mv-wordmark" href="<?= $headerEscape(Seo::pathFor('home', $currentLang)) ?>" aria-label="MinusVortex">
        <img src="/assets/img/logo.svg" alt="" width="63" height="63" decoding="async">
        <span>MinusVortex</span>
    </a>
    <nav class="mv-header-nav" aria-label="<?= $headerEscape($homeStory['nav_philosophy']) ?>">
        <a href="<?= $headerEscape($homeBase) ?>#philosophie"><?= $headerEscape($homeStory['nav_philosophy']) ?></a>
        <a href="<?= $headerEscape($homeBase) ?>#themes"><?= $headerEscape($homeStory['nav_universes']) ?></a>
        <div class="mv-languages" role="group" aria-label="<?= $headerEscape($homeStory['nav_language']) ?>">
            <?php foreach ($languages as $langCode => $langData): ?>
                <a href="<?= $headerEscape(Seo::pathFor($currentPage, $langCode)) ?>" lang="<?= $langCode ?>" hreflang="<?= $langCode ?>" aria-label="<?= $headerEscape($langData['label']) ?>"<?= $currentLang === $langCode ? ' aria-current="page"' : '' ?>><?= strtoupper($langCode) ?></a>
            <?php endforeach; ?>
        </div>
    </nav>
</header>
<?php else: ?>
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
                $scenario = (string)($_GET['s'] ?? '');
                if (in_array($answer, ['agree', 'disagree'], true)) {
                    $queryString = '?a=' . rawurlencode($answer);
                } elseif (in_array($scenario, ['launch', 'legacy', 'performance'], true)) {
                    $queryString = '?s=' . rawurlencode($scenario);
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
<?php endif; ?>
