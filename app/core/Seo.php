<?php
declare(strict_types=1);

class Seo
{
    private const LANGS = ['fr', 'en', 'es', 'pt'];
    private const DEFAULT_LANG = 'fr';

    /** Pages indexables (hors flux de paiement transactionnel). */
    private const INDEXABLE_PAGES = ['home', 'portfolio', 'blog'];

    private static ?array $routes = null;

    private static function routes(): array
    {
        if (self::$routes === null) {
            self::$routes = require __DIR__ . '/../config/routes.php';
        }
        return self::$routes;
    }

    public static function defaultLang(): string
    {
        return self::DEFAULT_LANG;
    }

    public static function baseUrl(): string
    {
        $configured = Env::get('APP_URL');
        if ($configured !== null && $configured !== '') {
            return rtrim($configured, '/');
        }

        $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
        return $scheme . '://' . $host;
    }

    public static function pathFor(string $page, string $lang, ?string $alignmentTheme = null, ?array $article = null): string
    {
        if ($page === 'blogArticle' && $article !== null) {
            $blogSlug = self::routes()['pages']['blog'][$lang] ?? 'blog';
            $articleSlug = $article['slugs'][$lang] ?? ($article['slugs'][self::DEFAULT_LANG] ?? '');
            return '/' . $lang . '/' . $blogSlug . '/' . $articleSlug;
        }

        if ($page === 'alignment' && $alignmentTheme !== null) {
            $slug = self::routes()['alignment'][$alignmentTheme][$lang] ?? null;
        } else {
            $slug = self::routes()['pages'][$page][$lang] ?? null;
        }

        if ($slug === null) {
            $slug = self::routes()['pages']['home'][$lang] ?? '';
        }

        return '/' . $lang . '/' . $slug;
    }

    public static function canonicalUrl(string $page, string $lang, ?string $alignmentTheme = null, ?array $article = null): string
    {
        return self::baseUrl() . self::pathFor($page, $lang, $alignmentTheme, $article);
    }

    /** @return array<string,string> lang => url absolue, pour toutes les langues supportées */
    public static function alternateUrls(string $page, ?string $alignmentTheme = null, ?array $article = null): array
    {
        $urls = [];
        foreach (self::LANGS as $lang) {
            $urls[$lang] = self::canonicalUrl($page, $lang, $alignmentTheme, $article);
        }
        return $urls;
    }

    public static function ogLocale(string $lang): string
    {
        $map = ['fr' => 'fr_FR', 'en' => 'en_US', 'es' => 'es_ES', 'pt' => 'pt_PT'];
        return $map[$lang] ?? 'fr_FR';
    }

    /**
     * llms.txt : resume du site en markdown pour les crawlers de LLM
     * (convention https://llmstxt.org). Genere depuis routes.php et les
     * fichiers de langue seo.php pour rester synchronise avec le site.
     */
    public static function llmsTxt(): string
    {
        $base = self::baseUrl();
        $seoFr = require __DIR__ . '/../lang/fr/seo.php';
        $seoEn = require __DIR__ . '/../lang/en/seo.php';

        $lines = [];
        $lines[] = '# MinusVortex';
        $lines[] = '';
        $lines[] = '> ' . ($seoFr['home.description'] ?? '');
        $lines[] = '';
        $lines[] = 'MinusVortex est une pratique de développement logiciel sobre.';
        $lines[] = 'Sa spécialité : réduire le chaos technique — dette, complexité inutile, dépendances —';
        $lines[] = 'pour livrer des systèmes sobres, performants et durables dont le client garde l\'ownership.';
        $lines[] = 'Site disponible en français (langue principale), anglais, espagnol et portugais.';
        $lines[] = '';
        $lines[] = '## Pages principales (français)';
        $lines[] = '';
        $lines[] = '- [' . ($seoFr['home.title'] ?? 'Accueil') . '](' . self::canonicalUrl('home', 'fr') . ')';
        $lines[] = '- [' . ($seoFr['portfolio.title'] ?? 'Portfolio') . '](' . self::canonicalUrl('portfolio', 'fr') . ')';

        foreach (array_keys(self::routes()['alignment']) as $theme) {
            $title = $seoFr['alignment.' . $theme . '.title'] ?? $theme;
            $description = $seoFr['alignment.' . $theme . '.description'] ?? '';
            $lines[] = '- [' . $title . '](' . self::canonicalUrl('alignment', 'fr', $theme) . '): ' . $description;
        }

        $lines[] = '';
        $lines[] = '## Articles (français)';
        $lines[] = '';
        foreach (Blog::all() as $article) {
            $content = Blog::content($article, 'fr');
            $lines[] = '- [' . ($content['title'] ?? $article['id']) . '](' . self::canonicalUrl('blogArticle', 'fr', null, $article) . '): ' . ($content['description'] ?? '');
        }

        $lines[] = '';
        $lines[] = '## Main pages (English)';
        $lines[] = '';
        $lines[] = '- [' . ($seoEn['home.title'] ?? 'Home') . '](' . self::canonicalUrl('home', 'en') . ')';
        $lines[] = '- [' . ($seoEn['portfolio.title'] ?? 'Portfolio') . '](' . self::canonicalUrl('portfolio', 'en') . ')';

        foreach (array_keys(self::routes()['alignment']) as $theme) {
            $title = $seoEn['alignment.' . $theme . '.title'] ?? $theme;
            $lines[] = '- [' . $title . '](' . self::canonicalUrl('alignment', 'en', $theme) . ')';
        }

        $lines[] = '';
        $lines[] = '## Ressources';
        $lines[] = '';
        $lines[] = '- [Sitemap](' . $base . '/sitemap.xml): toutes les URLs indexables, avec alternates es/pt';
        $lines[] = '- [GitHub](https://github.com/Mothas31)';
        $lines[] = '';

        return implode("\n", $lines);
    }

    public static function sitemapXml(): string
    {
        $entries = [];
        foreach (self::INDEXABLE_PAGES as $page) {
            $entries[] = ['page' => $page, 'theme' => null, 'article' => null];
        }
        foreach (array_keys(self::routes()['alignment']) as $theme) {
            $entries[] = ['page' => 'alignment', 'theme' => $theme, 'article' => null];
        }
        foreach (Blog::all() as $article) {
            $entries[] = ['page' => 'blogArticle', 'theme' => null, 'article' => $article];
        }

        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->startDocument('1.0', 'UTF-8');
        $xml->startElement('urlset');
        $xml->writeAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
        $xml->writeAttribute('xmlns:xhtml', 'http://www.w3.org/1999/xhtml');

        foreach ($entries as $entry) {
            $alternates = self::alternateUrls($entry['page'], $entry['theme'], $entry['article']);

            foreach (self::LANGS as $lang) {
                $xml->startElement('url');
                $xml->writeElement('loc', $alternates[$lang]);

                foreach ($alternates as $altLang => $altUrl) {
                    $xml->startElement('xhtml:link');
                    $xml->writeAttribute('rel', 'alternate');
                    $xml->writeAttribute('hreflang', $altLang);
                    $xml->writeAttribute('href', $altUrl);
                    $xml->endElement();
                }
                $xml->startElement('xhtml:link');
                $xml->writeAttribute('rel', 'alternate');
                $xml->writeAttribute('hreflang', 'x-default');
                $xml->writeAttribute('href', $alternates[self::DEFAULT_LANG]);
                $xml->endElement();

                $xml->endElement();
            }
        }

        $xml->endElement();
        $xml->endDocument();

        return $xml->outputMemory();
    }
}
