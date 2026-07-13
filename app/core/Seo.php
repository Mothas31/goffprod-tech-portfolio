<?php
declare(strict_types=1);

class Seo
{
    private const LANGS = ['fr', 'en', 'es', 'pt'];
    private const DEFAULT_LANG = 'fr';

    /** Pages indexables (hors flux de paiement transactionnel). */
    private const INDEXABLE_PAGES = ['home', 'portfolio'];

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

    public static function pathFor(string $page, string $lang, ?string $alignmentTheme = null): string
    {
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

    public static function canonicalUrl(string $page, string $lang, ?string $alignmentTheme = null): string
    {
        return self::baseUrl() . self::pathFor($page, $lang, $alignmentTheme);
    }

    /** @return array<string,string> lang => url absolue, pour toutes les langues supportées */
    public static function alternateUrls(string $page, ?string $alignmentTheme = null): array
    {
        $urls = [];
        foreach (self::LANGS as $lang) {
            $urls[$lang] = self::canonicalUrl($page, $lang, $alignmentTheme);
        }
        return $urls;
    }

    public static function ogLocale(string $lang): string
    {
        $map = ['fr' => 'fr_FR', 'en' => 'en_US', 'es' => 'es_ES', 'pt' => 'pt_PT'];
        return $map[$lang] ?? 'fr_FR';
    }

    public static function sitemapXml(): string
    {
        $entries = [];
        foreach (self::INDEXABLE_PAGES as $page) {
            $entries[] = ['page' => $page, 'theme' => null];
        }
        foreach (array_keys(self::routes()['alignment']) as $theme) {
            $entries[] = ['page' => 'alignment', 'theme' => $theme];
        }

        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->startDocument('1.0', 'UTF-8');
        $xml->startElement('urlset');
        $xml->writeAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
        $xml->writeAttribute('xmlns:xhtml', 'http://www.w3.org/1999/xhtml');

        foreach ($entries as $entry) {
            $alternates = self::alternateUrls($entry['page'], $entry['theme']);

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
