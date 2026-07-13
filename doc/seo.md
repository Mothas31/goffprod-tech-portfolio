# SEO multilingue

## Objectif

Rendre les pages publiques (home, portfolio, 7 pages d'alignement) correctement indexables en 4 langues (fr/en/es/pt), avec des titres et descriptions uniques par page, sans exposer les pages transactionnelles (paiement, 404) aux moteurs.

## Flux

1. Une requete arrive sur `public/index.php`. Deux URLs sont interceptees avant le routeur:
   - `/robots.txt` -> genere en PHP (Allow all + lien vers le sitemap). Necessaire car toutes les requetes sont reecrites vers `index.php` en prod, un fichier statique ne serait pas servi de facon fiable.
   - `/sitemap.xml` -> `Seo::sitemapXml()` genere le XML a la volee depuis `app/config/routes.php`.
2. Le routeur resout la langue + le slug localise et appelle `PageController`.
3. Le controleur passe a la vue `title` et `metaDescription` lus dans `app/lang/<locale>/seo.php` (cles `seo.<page>.title` / `.description`).
4. `app/views/layout.php` rend le `<head>`: title, description (fallback `common.meta_description` si le controleur n'en passe pas), meta robots, canonical, hreflang x4 + `x-default`, Open Graph, Twitter Card, JSON-LD Person.

Complements :

- `/llms.txt` -> `Seo::llmsTxt()` : resume markdown du site pour les crawlers de LLM (convention llmstxt.org), genere depuis routes.php + lang/seo.php + Blog.
- Pages d'alignement : le label, le statement et l'orientation du theme sont rendus cote serveur dans `#prequal-module-root` (les crawlers IA n'executent pas le JS) ; le module interactif remplace ce contenu au chargement.
- Blog : `/{lang}/signaux` (listing, slug localise via routes.php) et `/{lang}/signaux/{slug}` (article). Un article = un fichier `app/content/articles/*.php` avec id, date, slugs par langue et title/description/body par langue. Integre automatiquement au sitemap, au llms.txt, au canonical/hreflang et au JSON-LD BlogPosting.

## Fichiers concernes

- `app/core/Seo.php` — source de verite des URLs SEO: base URL (`APP_URL` ou detection), canonical, alternates hreflang, sitemap XML.
- `app/config/routes.php` — slugs localises par page et par theme d'alignement; alimente a la fois le routeur et le sitemap (une seule source, pas de desynchronisation possible).
- `app/lang/{fr,en,es,pt}/seo.php` — titres et meta descriptions par page. Cles plates `page.champ` (ex. `alignment.universe-ai.title`) car `Lang::get` ne decoupe que sur le premier point.
- `app/controllers/PageController.php` — passe `title`, `metaDescription`, `page`, `noindex` a la vue.
- `app/views/layout.php` — rend toutes les balises SEO du `<head>`.
- `public/index.php` — robots.txt et sitemap.xml dynamiques.

## Responsabilites

- `Seo` ne connait que les URLs; le contenu editorial (titres/descriptions) vit dans `app/lang/*/seo.php`.
- La liste des pages indexables est `Seo::INDEXABLE_PAGES` (home, portfolio) + tous les themes de `routes.php['alignment']`. Ajouter une page indexable = l'ajouter la, plus ses slugs dans `routes.php` et ses cles dans les 4 `seo.php`.
- `noindex` est decide par le controleur (`'noindex' => true`); la 404 est noindex d'office dans le layout.

## Decisions importantes

- **robots.txt et sitemap.xml en PHP, pas en fichiers statiques**: tout passe par `index.php`, et le sitemap doit refleter `routes.php` sans maintenance manuelle. `public/robots.txt` a ete supprime volontairement.
- **Pages paiement (payment, paymentSuccess, paymentCancel) = noindex et hors sitemap**: flux transactionnel, aucune valeur de recherche. Elles gardent quand meme canonical/hreflang (`$__hasSeoRoute`) pour eviter du duplicate si un moteur les decouvre.
- **Une description unique par page d'alignement**: ces 7 pages sont les landing pages thematiques; leur contenu reel est rendu en JS (`prequal-loader.js`), donc le title + la meta description sont pratiquement le seul texte indexable. Le wording reprend le vocabulaire MinusVortex (bruit, sobriete, maitrise, levier).
- **`x-default` pointe vers le francais** (`Seo::DEFAULT_LANG = 'fr'`), langue principale du site.
- **Fallback description**: si un controleur ne passe pas `metaDescription`, le layout retombe sur `common.meta_description` (traduite). Aucune page ne sort sans description.

## Ajouter un article de blog

1. Copier `app/content/articles/dette-technique-signaux.php`, changer `id`, `date`, `slugs` (4 langues) et `i18n` (title/description/body par langue).
2. C'est tout : routes, sitemap, llms.txt, hreflang et JSON-LD suivent automatiquement.

## Risques

- Ajouter un theme dans `routes.php` sans ajouter les cles dans les 4 `seo.php`: `Lang::get` renvoie la cle brute, le `<title>` afficherait `seo.alignment.<theme>.title`. Pas de garde-fou automatique.
- Un article sans slug pour une langue retombe sur le slug francais dans les hreflang : verifier que `slugs` couvre bien les 4 langues.
- `APP_URL` absent en prod: la base URL est deduite de `HTTP_HOST`, manipulable par header. Definir `APP_URL` dans l'environnement de prod.

## Dette technique

- Image OG/Twitter = logo 300px carre; un visuel 1200x630 serait mieux pour les partages.
- Pas de `lastmod` dans le sitemap.
- Les pages `vision` et `contact` ne passent pas par le systeme (`$__hasSeoRoute` les exclut du canonical); a integrer si elles redeviennent publiques.

## Ameliorations futures

- Test automatise qui verifie que chaque theme de `routes.php` a ses cles title/description dans les 4 langues.
- JSON-LD specifique par type de page (Service/FAQ pour les pages d'alignement).

## Validation

```bash
php -S 127.0.0.1:8099 -t public public/index.php
curl -s http://127.0.0.1:8099/fr/bienvenue | grep -E '<title>|description|canonical|hreflang'
curl -s http://127.0.0.1:8099/sitemap.xml | head -30
curl -s http://127.0.0.1:8099/robots.txt
```
