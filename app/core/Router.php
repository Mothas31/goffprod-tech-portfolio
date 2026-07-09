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
            'payment' => [
                'fr' => 'paiement.html',
                'en' => 'payment.html',
                'es' => 'pago.html',
                'pt' => 'pagamento.html',
            ],
            'paymentSuccess' => [
                'fr' => 'paiement-succes.html',
                'en' => 'payment-success.html',
                'es' => 'pago-exitoso.html',
                'pt' => 'pagamento-sucesso.html',
            ],
            'paymentCancel' => [
                'fr' => 'paiement-annule.html',
                'en' => 'payment-cancel.html',
                'es' => 'pago-cancelado.html',
                'pt' => 'pagamento-cancelado.html',
            ],
        ];

        foreach ($pageSlugs as $page => $translations) {
            foreach ($translations as $localizedSlug) {
                if ($localizedSlug === $slug) {
                    return $page;
                }
            }
        }

        return 'notFound';
    }

    private static function slugToAlignmentTheme(string $slug, string $lang): ?string
    {
        $map = [
            'fr' => [
                'alignement-sante.html' => 'universe-health',
                'alignement-finance.html' => 'universe-finance',
                'alignement-developpement.html' => 'universe-dev',
                'alignement-mobilite.html' => 'universe-mobility',
                'alignement-qualite.html' => 'universe-quality',
                'alignement-formation.html' => 'universe-formation',
                'alignement-ia.html' => 'universe-ai',
            ],
            'en' => [
                'alignment-health.html' => 'universe-health',
                'alignment-finance.html' => 'universe-finance',
                'alignment-development.html' => 'universe-dev',
                'alignment-mobility.html' => 'universe-mobility',
                'alignment-quality.html' => 'universe-quality',
                'alignment-learning.html' => 'universe-formation',
                'alignment-ai.html' => 'universe-ai',
            ],
            'es' => [
                'alineacion-salud.html' => 'universe-health',
                'alineacion-negocio.html' => 'universe-finance',
                'alineacion-desarrollo.html' => 'universe-dev',
                'alineacion-movilidad.html' => 'universe-mobility',
                'alineacion-calidad.html' => 'universe-quality',
                'alineacion-formacion.html' => 'universe-formation',
                'alineacion-ia.html' => 'universe-ai',
            ],
            'pt' => [
                'alinhamento-saude.html' => 'universe-health',
                'alinhamento-negocio.html' => 'universe-finance',
                'alinhamento-desenvolvimento.html' => 'universe-dev',
                'alinhamento-mobilidade.html' => 'universe-mobility',
                'alinhamento-qualidade.html' => 'universe-quality',
                'alinhamento-formacao.html' => 'universe-formation',
                'alinhamento-ia.html' => 'universe-ai',
            ],
        ];

        return $map[$lang][$slug] ?? null;
    }
}
