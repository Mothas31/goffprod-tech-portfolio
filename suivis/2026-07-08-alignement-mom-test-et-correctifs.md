# Suivi - Questionnaire Mom Test + correctifs prioritaires

Date: 2026-07-08

## Contexte

Demande: auditer la coherence du contenu textuel du site face a `minusvortex_vision_projet.md`, puis integrer la logique du livre "The Mom Test" (Rob Fitzpatrick) dans le questionnaire d'alignement, et appliquer les correctifs prioritaires identifies pendant l'audit.

## Constat initial (audit)

- Le module d'alignement (`app/data/prequal_tree.php`) etait le plus fidele a la vision, mais posait des questions d'opinion ("Vous privilegiez la clarte plutot que le bruit ?") auxquelles tout le monde repond oui — l'anti-Mom Test.
- La home vendait encore "un developpeur" plutot que "de la reduction de chaos". Le mot "ownership", pilier central de la vision, etait absent du site.
- Incoherence de marque: sujet de mail "Point de rencontre **Goffprod**" alors que tout le site est MinusVortex.
- Le module d'alignement n'existait qu'en FR/EN alors que le router et le header exposent aussi ES/PT (fallback silencieux vers du contenu francais pour ces langues).
- 38 Mo de three.js (repo complet: src, examples, build) deploye alors que seul un sous-ensemble est utilise.
- CSP auto-neutralisee par `unsafe-inline`/`unsafe-eval` (non traite, hors perimetre de cette session).
- Router: tout slug inconnu retombait sur la home en 200 au lieu d'un 404 (et la vue `pages/404.php` n'existait meme pas malgre l'appel deja present dans `Router.php`/`PageController.php`).
- Bug logo: la regex de recoloriage du SVG mettait `#d43737ff` (rouge) au lieu de l'or `#d4af37`.

## Fichiers inspectes

- `minusvortex_vision_projet.md`
- `app/data/prequal_tree.php`, `app/lang/{fr,en,es,pt}/{home,common}.php`
- `app/core/Router.php`, `app/controllers/PageController.php`, `app/core/Security.php`
- `app/views/layout.php`, `app/views/pages/home.php`, `app/views/partials/header.php`
- `public/index.php`, `public/api/{prequal,create-checkout-session,stripe-webhook}.php`
- `public/assets/js/prequal-loader.js`, `public/assets/libs/three/**`

## Decisions

- Reecrire toutes les questions du questionnaire (univers + noeuds "value_*" + scenarios dev) en questions factuelles sur le passe ("Ces 6 derniers mois, avez-vous supprime quelque chose ?", "Si la personne qui connait le mieux le systeme partait demain ?") plutot que des opinions sur le futur.
- Traduire l'integralite du tree en ES et PT (decision utilisateur via question posee) plutot que retirer ces langues ou les laisser en fallback FR.
- Reecrire le hero de la home (4 langues) autour du probleme client et de l'ownership: "Moins de bruit, plus de maitrise." / "Less noise, more ownership." etc., au lieu de "Sobriete, efficacite et empreinte durable".
- Remplacer "Goffprod" par "MinusVortex" dans les sujets de mail du questionnaire.
- Purger three.js: ne garder que `build/three.module.min.js`, `GLTFLoader.js`, `DRACOLoader.js`, `BufferGeometryUtils.js` et le decodeur draco `gltf/` (seul chemin reellement reference par le code) — 38 Mo -> 1,3 Mo.
- Ajouter une vraie route 404 (`PageController::notFound()` + `app/views/pages/404.php`) au lieu du fallback silencieux vers `home`.
- Laisser de cote la CSP (`unsafe-inline`/`unsafe-eval`) et la duplication des maps de slugs Router/header — signales mais non traites, a la demande explicite de prioriser le reste.

## Fichiers modifies

- `app/data/prequal_tree.php` (reecriture complete FR/EN + ajout ES/PT, format Mom Test)
- `app/lang/{fr,en,es,pt}/home.php` (title_h2, text_1, text_2, concept_text)
- `app/lang/{fr,en,es,pt}/common.php` (ajout `meta_description` localisee)
- `app/views/layout.php` (meta description dynamique au lieu du texte en dur "Port folio techn sobre", suppression du meta keywords)
- `app/views/pages/home.php` (fix couleur logo `#d4af37`, labels agree/disagree localises par langue)
- `app/core/Router.php` (fallback slug inconnu -> `notFound` au lieu de `home`)
- `app/controllers/PageController.php` (ajout methode `notFound()`)
- `public/assets/libs/three/**` (purge des fichiers non utilises)

## Fichiers crees

- `app/views/pages/404.php` (n'existait pas malgre les appels existants dans le code)
- `suivis/2026-07-08-alignement-mom-test-et-correctifs.md`

## Risques / points ouverts

- CSP toujours `unsafe-inline`/`unsafe-eval` — a traiter en extrayant le script inline de `home.php`.
- Duplication des maps de slugs (Router.php + header.php, x4 langues) — deux sources de verite qui peuvent diverger.
- `X-XSS-Protection` obsolete toujours envoye par `Security.php`.
- Le ton du questionnaire ("Premiere vibration", "Par ou commence l'elan ?") reste lyrique; a challenger si un client B2B/ETI le percoit comme du bruit plutot que de la sobriete.

## Validations effectuees

- `php -l` sur tous les fichiers PHP modifies/crees: OK
- Verification programmatique du graphe `prequal_tree.php` (tous les `next` pointent vers un noeud existant ou `result`) dans les 4 langues: OK
- Serveur de dev lance avec `php -S host:port public/index.php`:
  - `/fr/`, `/en/welcome`, home ES/PT: hero et scroller de themes affichent le nouveau texte localise
  - `/fr/nimportequoi` -> 404 avec le contenu de la nouvelle vue
  - `/{fr,en,es,pt}/alignement-*.html` (et equivalents ES/PT) -> 200
  - `GET /api/prequal.php?lang=es` et `?lang=pt` renvoient bien 21 noeuds et les verdicts traduits
  - `/assets/libs/three/build/three.module.min.js` toujours servi apres la purge (200)

## Prochaine action concrete

1. Lancer le serveur de dev (`php -S 127.0.0.1:8000 public/index.php`) et faire tester manuellement le questionnaire (FR/EN/ES/PT) et la home par l'utilisateur.
2. Si valide: traiter la CSP (`unsafe-inline`/`unsafe-eval`) en extrayant le script inline de `home.php`.
3. Centraliser les maps de slugs (Router.php / header.php) dans un seul fichier de config.
