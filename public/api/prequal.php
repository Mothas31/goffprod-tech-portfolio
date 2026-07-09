<?php
declare(strict_types=1);

header('Content-Type: application/json; charset=UTF-8');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');

$lang = strtolower((string) ($_GET['lang'] ?? 'fr'));
$supported = ['fr', 'en', 'es', 'pt'];
if (!in_array($lang, $supported, true)) {
    $lang = 'fr';
}

$data = require __DIR__ . '/../../app/data/prequal_tree.php';
$resolvedLang = $lang;
if (!isset($data[$resolvedLang])) {
    $resolvedLang = $lang === 'fr' ? 'fr' : 'en';
}

echo json_encode(
    [
        'locale' => $resolvedLang,
        'tree' => $data[$resolvedLang],
    ],
    JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
);
