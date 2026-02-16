<?php
declare(strict_types=1);

class Router
{
    public static function dispatch(): void
    {
        $uri = trim($_SERVER['REQUEST_URI'], '/');
        $segments = $uri === '' ? [] : explode('/', $uri);

        $supportedLangs = ['fr', 'en', 'es', 'pt'];

        // 1️⃣ Détection langue
        $lang = in_array($segments[0] ?? '', $supportedLangs) ? $segments[0] : 'fr';
        Lang::setLocale($lang);

        // 2️⃣ Slug
        $slugIndex = ($segments[0] ?? '') === $lang ? 1 : 0;
        $slug = $segments[$slugIndex] ?? '';

        // 3️⃣ Mapping slug → page logique
        $page = self::slugToPage($slug);

        // 4️⃣ Appel de la page
        $controller = new PageController();
        if (method_exists($controller, $page)) {
            $controller->{$page}();
        } else {
            http_response_code(404);
            View::render('pages/404', ['title' => '404']);
        }
    }

    private static function slugToPage(string $slug): string
    {
        if ($slug === '' || $slug === 'home') {
            return 'home';
        }

        $pageSlugs = [
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
        ];

        foreach ($pageSlugs as $page => $translations) {
            foreach ($translations as $localizedSlug) {
                if ($localizedSlug === $slug) {
                    return $page;
                }
            }
        }

        return 'home'; // fallback
    }
}
