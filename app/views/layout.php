<!doctype html>
<html lang="<?= htmlspecialchars(Lang::locale(), ENT_QUOTES, 'UTF-8') ?>">
<head>
    <meta charset="utf-8">
    <title><?= htmlspecialchars($title ?? __('home.title'), ENT_QUOTES, 'UTF-8') ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Security Meta Tags -->
    <meta name="csrf-token" content="<?= Security::generateCsrfToken() ?>">

    <?php
    $__page = $page ?? 'home';
    $__alignmentTheme = $alignmentTheme ?? null;
    $__isNoindex = ($noindex ?? false) === true || $__page === '404';
    $__hasSeoRoute = $__page !== '404' && array_key_exists(
        $__page,
        ['home' => 1, 'portfolio' => 1, 'payment' => 1, 'paymentSuccess' => 1, 'paymentCancel' => 1, 'alignment' => 1]
    );
    $__title = htmlspecialchars($title ?? __('home.title'), ENT_QUOTES, 'UTF-8');
    $__metaDescription = htmlspecialchars($metaDescription ?? __('common.meta_description'), ENT_QUOTES, 'UTF-8');
    ?>

    <!-- SEO Meta Tags -->
    <meta name="description" content="<?= $__metaDescription ?>">
    <meta name="author" content="Thomas GOFFINET GOFFPROD">
    <meta name="robots" content="<?= $__isNoindex ? 'noindex, follow' : 'index, follow' ?>">

    <?php if ($__hasSeoRoute): ?>
    <link rel="canonical" href="<?= htmlspecialchars(Seo::canonicalUrl($__page, Lang::locale(), $__alignmentTheme), ENT_QUOTES, 'UTF-8') ?>">
    <?php foreach (Seo::alternateUrls($__page, $__alignmentTheme) as $__hrefLang => $__hrefUrl): ?>
    <link rel="alternate" hreflang="<?= $__hrefLang ?>" href="<?= htmlspecialchars($__hrefUrl, ENT_QUOTES, 'UTF-8') ?>">
    <?php endforeach; ?>
    <link rel="alternate" hreflang="x-default" href="<?= htmlspecialchars(Seo::canonicalUrl($__page, Seo::defaultLang(), $__alignmentTheme), ENT_QUOTES, 'UTF-8') ?>">
    <?php endif; ?>

    <!-- Open Graph / Twitter -->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="MinusVortex — Thomas Goffinet">
    <meta property="og:title" content="<?= $__title ?>">
    <meta property="og:description" content="<?= $__metaDescription ?>">
    <meta property="og:locale" content="<?= Seo::ogLocale(Lang::locale()) ?>">
    <meta property="og:image" content="<?= htmlspecialchars(Seo::baseUrl(), ENT_QUOTES, 'UTF-8') ?>/assets/img/logo_300.webp">
    <?php if ($__hasSeoRoute): ?>
    <meta property="og:url" content="<?= htmlspecialchars(Seo::canonicalUrl($__page, Lang::locale(), $__alignmentTheme), ENT_QUOTES, 'UTF-8') ?>">
    <?php endif; ?>
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="<?= $__title ?>">
    <meta name="twitter:description" content="<?= $__metaDescription ?>">
    <meta name="twitter:image" content="<?= htmlspecialchars(Seo::baseUrl(), ENT_QUOTES, 'UTF-8') ?>/assets/img/logo_300.webp">

    <!-- Structured Data -->
    <script type="application/ld+json"><?= json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'Person',
        'name' => 'Thomas Goffinet',
        'alternateName' => 'MinusVortex',
        'url' => Seo::baseUrl(),
        'image' => Seo::baseUrl() . '/assets/img/logo_300.webp',
        'jobTitle' => 'Développeur logiciel',
        'description' => __('common.meta_description'),
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>

    <?php if (($page ?? '') === 'home'): ?>
    <link rel="preload" as="image" href="/assets/img/logo_63.webp" imagesrcset="/assets/img/logo_63.webp 1x, /assets/img/logo_95.webp 1.5x, /assets/img/logo_126.webp 2x" imagesizes="63px" fetchpriority="high">
    <?php endif; ?>

    <link rel="stylesheet" href="/assets/css/output.css">
    <link rel="stylesheet" href="/assets/css/side-nav.css" media="screen and (min-width: 768px)">
    <script type="importmap">
    {
      "imports": {
        "three": "/assets/libs/three/build/three.module.min.js",
        "three/addons/": "/assets/libs/three/examples/jsm/"
      }
    }
    </script>

    <!-- Transition d'arrivée (cercle blanc) : posé avant le rendu pour éviter tout flash. -->
    <script>try{if(sessionStorage.getItem('minusWarp')==='1'){document.documentElement.classList.add('warp-arrive');}}catch(e){}</script>

</head>
<body class="w-full bg-black">

<?php require __DIR__ . '/partials/header.php'; ?>

<main class="w-full">
    <?php require __DIR__ . '/' . $view . '.php'; ?>
</main>

<?php require __DIR__ . '/partials/footer.php'; ?>

<script src="/assets/js/page-warp.js" defer></script>
<script src="/assets/js/app.js" defer></script>
<script src="/assets/js/lang-switch-vortex.js" defer></script>
</body>
</html>
