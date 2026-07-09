<!doctype html>
<html lang="<?= htmlspecialchars(Lang::locale(), ENT_QUOTES, 'UTF-8') ?>">
<head>
    <meta charset="utf-8">
    <title><?= htmlspecialchars($title ?? __('home.title'), ENT_QUOTES, 'UTF-8') ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Security Meta Tags -->
    <meta name="csrf-token" content="<?= Security::generateCsrfToken() ?>">
    <meta http-equiv="X-Content-Type-Options" content="nosniff">
    <meta http-equiv="X-XSS-Protection" content="1; mode=block">

    <!-- SEO Meta Tags --> 
    <meta name="description" content="<?= htmlspecialchars(__('common.meta_description'), ENT_QUOTES, 'UTF-8') ?>">
    <meta name="author" content="Thomas GOFFINET GOFFPROD">

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
