<?php
declare(strict_types=1);

// robots.txt fallback when all requests are rewritten to index.php.
if (parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) === '/robots.txt') {
    header('Content-Type: text/plain; charset=UTF-8');
    $host = $_SERVER['HTTP_HOST'] ?? '';
    $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';

    echo "User-agent: *\n";
    echo "Allow: /\n";
    if ($host !== '') {
        echo "Sitemap: {$scheme}://{$host}/sitemap.xml\n";
    }
    exit;
}

// Sécurité basique
ini_set('display_errors', '0');
error_reporting(E_ALL);

// Autoload ultra simple
require_once __DIR__ . '/../app/core/Lang.php';
require_once __DIR__ . '/../app/core/View.php';
require_once __DIR__ . '/../app/core/Router.php';
require_once __DIR__ . '/../app/core/Helper.php';
require_once __DIR__ . '/../app/controllers/PageController.php';


// Router
Router::dispatch();
