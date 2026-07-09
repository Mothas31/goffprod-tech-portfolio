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
    'payment' => [
        'fr' => 'paiement.html',
        'en' => 'payment.html',
        'es' => 'pago.html',
        'pt' => 'pagamento.html',
    ],
];

$alignmentSlugMap = [
    'universe-health' => [
        'fr' => 'alignement-sante.html',
        'en' => 'alignment-health.html',
        'es' => 'alineacion-salud.html',
        'pt' => 'alinhamento-saude.html',
    ],
    'universe-finance' => [
        'fr' => 'alignement-finance.html',
        'en' => 'alignment-finance.html',
        'es' => 'alineacion-negocio.html',
        'pt' => 'alinhamento-negocio.html',
    ],
    'universe-dev' => [
        'fr' => 'alignement-developpement.html',
        'en' => 'alignment-development.html',
        'es' => 'alineacion-desarrollo.html',
        'pt' => 'alinhamento-desenvolvimento.html',
    ],
    'universe-mobility' => [
        'fr' => 'alignement-mobilite.html',
        'en' => 'alignment-mobility.html',
        'es' => 'alineacion-movilidad.html',
        'pt' => 'alinhamento-mobilidade.html',
    ],
    'universe-quality' => [
        'fr' => 'alignement-qualite.html',
        'en' => 'alignment-quality.html',
        'es' => 'alineacion-calidad.html',
        'pt' => 'alinhamento-qualidade.html',
    ],
    'universe-formation' => [
        'fr' => 'alignement-formation.html',
        'en' => 'alignment-learning.html',
        'es' => 'alineacion-formacion.html',
        'pt' => 'alinhamento-formacao.html',
    ],
    'universe-ai' => [
        'fr' => 'alignement-ia.html',
        'en' => 'alignment-ai.html',
        'es' => 'alineacion-ia.html',
        'pt' => 'alinhamento-ia.html',
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
