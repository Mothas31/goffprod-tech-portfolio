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
}
