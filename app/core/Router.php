<?php
declare(strict_types=1);

class Router
{
    public static function dispatch(): void
    {
        try {
            // Validation et sanitization de l'URI
            $requestUri = (string) ($_SERVER['REQUEST_URI'] ?? '');
            $path = parse_url($requestUri, PHP_URL_PATH);
            $uri = Security::sanitizeUrl((string) ($path ?? ''));
            $uri = str_replace(['//', '../'], ['/', ''], $uri);
            $uri = trim($uri, '/');
            $segments = $uri === '' ? [] : explode('/', $uri);

            $supportedLangs = ['fr', 'en', 'es', 'pt'];

            // 1️⃣ Détection langue avec validation
            $lang = in_array($segments[0] ?? '', $supportedLangs) ? $segments[0] : 'fr';
            Lang::setLocale($lang);

            // 2️⃣ Slug avec validation
            $slugIndex = ($segments[0] ?? '') === $lang ? 1 : 0;
            $slug = Security::sanitizeInput($segments[$slugIndex] ?? '');

            // 3️⃣ Mapping slug → page logique
            $alignmentTheme = self::slugToAlignmentTheme($slug, $lang);
            if ($alignmentTheme !== null) {
                $controller = new PageController();
                $controller->alignment($alignmentTheme);
                return;
            }

            $page = self::slugToPage($slug);

            // 4️⃣ Appel de la page
            $controller = new PageController();
            if (method_exists($controller, $page)) {
                $controller->{$page}();
            } else {
                Logger::warning("Page not found: $page for slug: $slug");
                http_response_code(404);
                View::render('pages/404', ['title' => '404']);
            }
        } catch (Exception $e) {
            Logger::error('Routing error: ' . $e->getMessage());
            http_response_code(500);
            View::render('pages/404', ['title' => '500 - Internal Server Error']);
        }
    }

    private static function routes(): array
    {
        static $routes = null;
        if ($routes === null) {
            $routes = require __DIR__ . '/../config/routes.php';
        }
        return $routes;
    }

    private static function slugToPage(string $slug): string
    {
        if ($slug === '' || $slug === 'home') {
            return 'home';
        }

        foreach (self::routes()['pages'] as $page => $translations) {
            if (in_array($slug, $translations, true)) {
                return $page;
            }
        }

        return 'notFound';
    }

    private static function slugToAlignmentTheme(string $slug, string $lang): ?string
    {
        foreach (self::routes()['alignment'] as $themeId => $translations) {
            if (($translations[$lang] ?? null) === $slug) {
                return $themeId;
            }
        }

        return null;
    }
}
