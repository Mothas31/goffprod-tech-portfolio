<?php
declare(strict_types=1);

if (PHP_SAPI === 'cli-server') {
    $requestPath = (string) parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
    $staticFile = realpath(__DIR__ . $requestPath);
    if (
        $requestPath !== '/'
        && $staticFile !== false
        && str_starts_with($staticFile, realpath(__DIR__) ?: '')
        && is_file($staticFile)
    ) {
        return false;
    }
}

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

$requestPath = (string) parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$apiFile = realpath(__DIR__ . $requestPath);
if (
    str_starts_with($requestPath, '/api/')
    && $apiFile !== false
    && str_starts_with($apiFile, realpath(__DIR__ . '/api') ?: '')
    && is_file($apiFile)
) {
    require $apiFile;
    exit;
}

require_once __DIR__ . '/../app/bootstrap.php';

// Appliquer les headers de sécurité
Security::setSecurityHeaders();

// sitemap.xml généré dynamiquement à partir des routes (app/config/routes.php)
if (parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) === '/sitemap.xml') {
    header('Content-Type: application/xml; charset=UTF-8');
    echo Seo::sitemapXml();
    exit;
}

// llms.txt : resume markdown du site pour les crawlers de LLM (llmstxt.org)
if (parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) === '/llms.txt') {
    header('Content-Type: text/plain; charset=UTF-8');
    echo Seo::llmsTxt();
    exit;
}

// Router
try {
    Router::dispatch();
} catch (Exception $e) {
    Logger::error('Router error: ' . $e->getMessage());
    http_response_code(500);
    View::render('pages/404', ['title' => '500 - Internal Server Error']);
}
