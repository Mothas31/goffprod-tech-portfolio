<?php
$locale = class_exists('Lang') ? Lang::locale() : 'fr';
$copy = [
    'fr' => ['text' => 'Cette page n’existe pas. Peut-être ne devrait-elle pas exister.', 'cta' => 'Revenir à l’accueil'],
    'en' => ['text' => 'This page does not exist. Maybe it should not.', 'cta' => 'Back to home'],
    'es' => ['text' => 'Esta página no existe. Quizá no debería existir.', 'cta' => 'Volver al inicio'],
    'pt' => ['text' => 'Esta página não existe. Talvez não devesse existir.', 'cta' => 'Voltar ao início'],
];
$c = $copy[$locale] ?? $copy['fr'];
?>
<section class="bg-black min-h-screen flex flex-col items-center justify-center text-center px-6 text-slate-100">
    <h1 class="text-6xl font-bold tracking-tight">404</h1>
    <p class="text-lg md:text-xl text-slate-300 mt-6 max-w-xl leading-relaxed">
        <?= htmlspecialchars($c['text'], ENT_QUOTES, 'UTF-8') ?>
    </p>
    <a href="/<?= htmlspecialchars($locale, ENT_QUOTES, 'UTF-8') ?>/"
       class="mt-10 inline-block border border-slate-500 rounded-full px-6 py-3 text-sm uppercase tracking-widest hover:border-slate-200 transition-colors">
        <?= htmlspecialchars($c['cta'], ENT_QUOTES, 'UTF-8') ?>
    </a>
</section>
