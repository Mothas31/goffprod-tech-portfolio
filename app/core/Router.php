<?php
declare(strict_types=1);

class Router
{
    public static function dispatch(): void
    {
        $uri = trim($_SERVER['REQUEST_URI'], '/');
        $segments = explode('/', $uri);

        $supportedLangs = ['fr', 'en'];

        // 1️⃣ Détection langue
        $lang = in_array($segments[0] ?? '', $supportedLangs) ? $segments[0] : 'fr';
        Lang::setLocale($lang);

        // 2️⃣ Slug
        $slug = $segments[1] ?? $segments[0] ?? 'home';

        // 3️⃣ Mapping slug → page logique
        $page = self::slugToPage($slug, $lang);

        // 4️⃣ Appel de la page
        $controller = new PageController();
        if (method_exists($controller, $page)) {
            $controller->{$page}();
        } else {
            http_response_code(404);
            View::render('pages/404', ['title' => '404']);
        }
    }

    private static function slugToPage(string $slug, string $lang): string
    {
        // Table simple de correspondance slug → page
        $routes = [
            'home' => ['fr' => 'home', 'en' => 'home'],
            'bienvenue' => ['fr' => 'home', 'en' => 'home'],
            'welcome' => ['fr' => 'home', 'en' => 'home'],
            'portfolio' => ['fr' => 'portfolio', 'en' => 'portfolio'],
            'vision' => ['fr' => 'vision', 'en' => 'vision'],
            'contact' => ['fr' => 'contact', 'en' => 'contact'],
        ];

        foreach ($routes as $slugKey => $translations) {
            if (($translations[$lang] ?? '') === $slug) {
                return $slugKey;
            }
        }

        return 'home'; // fallback
    }
}
