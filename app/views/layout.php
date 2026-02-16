<!doctype html>
<html lang="<?= htmlspecialchars(Lang::locale(), ENT_QUOTES, 'UTF-8') ?>">
<head>
    <meta charset="utf-8">
    <title><?= htmlspecialchars($title ?? __('home.title'), ENT_QUOTES, 'UTF-8') ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

     <!-- SEO Meta Tags --> 
    <meta name="description" content="Port folio techn sobre">
    <meta name="keywords" content="portfolio">
    <meta name="author" content="Thomas GOFFINET GOFFPROD">

    <link rel="stylesheet" href="/assets/css/output.css">
    <link rel="stylesheet" href="/assets/css/side-nav.css" media="screen and (min-width: 768px)">

</head>
<body class="w-full">

<?php require __DIR__ . '/partials/header.php'; ?>

<main class="w-full">
    <?php require __DIR__ . '/' . $view . '.php'; ?>
</main>

<?php require __DIR__ . '/partials/footer.php'; ?>

<script src="/assets/js/app.js" defer></script>
</body>
</html>
