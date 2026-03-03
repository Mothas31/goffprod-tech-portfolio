<?php
declare(strict_types=1);

// Démarrer la session pour CSRF et sécurité
session_start();

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

// Configuration sécurité avancée
ini_set('display_errors', '0');
error_reporting(E_ALL);
ini_set('log_errors', '1');
ini_set('error_log', __DIR__ . '/../storage/logs/error.log');

// Autoload ultra simple avec sécurité
require_once __DIR__ . '/../app/core/Security.php';
require_once __DIR__ . '/../app/core/Logger.php';
require_once __DIR__ . '/../app/core/Lang.php';
require_once __DIR__ . '/../app/core/View.php';
require_once __DIR__ . '/../app/core/Router.php';
require_once __DIR__ . '/../app/core/Helper.php';
require_once __DIR__ . '/../app/controllers/PageController.php';

// Appliquer les headers de sécurité
Security::setSecurityHeaders();

// Router
try {
    Router::dispatch();
} catch (Exception $e) {
    Logger::error('Router error: ' . $e->getMessage());
    http_response_code(500);
    View::render('pages/404', ['title' => '500 - Internal Server Error']);
}
