<?php
declare(strict_types=1);

/**
 * Articles de contenu (blog) : un fichier PHP par article dans
 * app/content/articles/, retournant id, date, slugs par langue et
 * contenu (title/description/body) par langue.
 */
class Blog
{
    private static ?array $articles = null;

    /** @return array<int,array> articles tries du plus recent au plus ancien */
    public static function all(): array
    {
        if (self::$articles === null) {
            $articles = [];
            foreach (glob(__DIR__ . '/../content/articles/*.php') ?: [] as $file) {
                $article = require $file;
                if (is_array($article) && isset($article['id'], $article['slugs'], $article['i18n'])) {
                    $articles[] = $article;
                }
            }
            usort($articles, fn(array $a, array $b) => strcmp($b['date'] ?? '', $a['date'] ?? ''));
            self::$articles = $articles;
        }
        return self::$articles;
    }

    public static function find(string $id): ?array
    {
        foreach (self::all() as $article) {
            if ($article['id'] === $id) {
                return $article;
            }
        }
        return null;
    }

    public static function findBySlug(string $slug, string $lang): ?array
    {
        foreach (self::all() as $article) {
            if (($article['slugs'][$lang] ?? null) === $slug) {
                return $article;
            }
        }
        return null;
    }

    /** Contenu localise avec repli sur le francais. */
    public static function content(array $article, string $lang): array
    {
        return $article['i18n'][$lang] ?? $article['i18n']['fr'] ?? [];
    }

    /**
     * Badge du theme d'un article : label localise (prequal_tree) + icone
     * filaire SVG (meme set que prequal-loader.js pour rester coherent).
     * @return array{label:string,svg:string}|null
     */
    public static function themeBadge(?string $themeId, string $lang): ?array
    {
        if ($themeId === null || $themeId === '') {
            return null;
        }

        static $tree = null;
        if ($tree === null) {
            $tree = require __DIR__ . '/../data/prequal_tree.php';
        }

        $universes = $tree[$lang]['universes'] ?? ($tree['fr']['universes'] ?? []);
        foreach ($universes as $universe) {
            if (($universe['id'] ?? '') === $themeId) {
                return [
                    'label' => (string)($universe['label'] ?? ''),
                    'svg' => self::ICONS[$universe['icon'] ?? ''] ?? self::ICONS['spark'],
                ];
            }
        }
        return null;
    }

    /** Icones filaires (copie de universeIconMarkup dans prequal-loader.js). */
    private const ICONS = [
        'lotus' => '<svg viewBox="0 0 64 64" aria-hidden="true"><path d="M32 14c5 7 7 13 7 18 0 8-5 14-7 16-2-2-7-8-7-16 0-5 2-11 7-18Z"/><path d="M19 25c8 2 13 5 16 10 4 7 3 14 2 17-3 0-11-1-17-6-4-3-7-9-8-17 3-2 8-4 7-4Z"/><path d="M45 25c-8 2-13 5-16 10-4 7-3 14-2 17 3 0 11-1 17-6 4-3 7-9 8-17-3-2-8-4-7-4Z"/><path d="M11 42c7 1 13 2 21 2s14-1 21-2"/><path d="M14 48c6 2 12 3 18 3s12-1 18-3"/></svg>',
        'coins' => '<svg viewBox="0 0 64 64" aria-hidden="true"><ellipse cx="24" cy="18" rx="11" ry="5"/><path d="M13 18v19c0 3 5 5 11 5s11-2 11-5V18"/><path d="M13 28c0 3 5 5 11 5s11-2 11-5"/><path d="M13 37c0 3 5 5 11 5s11-2 11-5"/><circle cx="46" cy="39" r="12"/><path d="M49 32h-6v14h6"/><path d="M41 39h7"/></svg>',
        'spark' => '<svg viewBox="0 0 64 64" aria-hidden="true"><path d="M32 10l4 11 11 4-11 4-4 11-4-11-11-4 11-4 4-11Z"/><path d="M18 38l2.5 6.5L27 47l-6.5 2.5L18 56l-2.5-6.5L9 47l6.5-2.5L18 38Z"/><path d="M48 38l2.5 6.5L57 47l-6.5 2.5L48 56l-2.5-6.5L39 47l6.5-2.5L48 38Z"/></svg>',
        'plane' => '<svg viewBox="0 0 64 64" aria-hidden="true"><path d="M8 34 56 14l-12 36-10-10-10 8-4-8-12-6Z"/><path d="M24 40 56 14"/><path d="M20 32 32 38"/></svg>',
        'check' => '<svg viewBox="0 0 64 64" aria-hidden="true"><rect x="16" y="12" width="32" height="40" rx="4"/><path d="M24 32l6 6 12-14"/><path d="M24 18h16"/></svg>',
        'screen' => '<svg viewBox="0 0 64 64" aria-hidden="true"><rect x="12" y="14" width="40" height="28" rx="3"/><path d="M24 50h16"/><path d="M18 50h28"/><path d="M26 27h12"/><path d="M23 31h18"/></svg>',
    ];
}
