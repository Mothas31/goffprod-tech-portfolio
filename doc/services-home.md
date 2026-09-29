# Home orientée services (29 septembre 2026)

Positionnement : **MinusVortex — ingénierie logicielle PHP / Laravel**. Titres au nom de MinusVortex, textes à la première personne (« je »).

## Carrousel de services

Source unique : `app/data/services.php` (FR, EN, ES, PT). Rendu : `app/views/pages/home.php`, même composant que l'ancien carrousel d'univers (`theme-scroller.js`).

| Service | Sortie |
|---|---|
| Reprise et modernisation de legacy | Q&R Développement, scénario `legacy` |
| Applications métier sur mesure | Q&R Développement, scénario `launch` |
| Performance et fiabilité | Q&R Développement, scénario `performance` |
| Intégrations et migrations | Contact direct (mailto) |
| Renfort Laravel pour agences et ESN | Contact direct |
| Développement assisté par IA | Contact direct |

Le Q&R s'ouvre via `/<lang>/<slug alignement développement>?s=<scénario>` : `prequal-loader.js` saute l'énoncé de l'univers et la question de scénario. Le sélecteur de langue conserve `?s=`.

## Univers philosophiques : en brouillon

Santé, Business, Mobilité, Qualité, Formation et IA ne sont plus affichés sur la home. Leurs pages d'alignement, leurs routes et leur contenu (`app/data/prequal_tree.php`) restent en place pour ne casser aucun lien ni l'indexation. À réintégrer ailleurs (blog, page dédiée) ou à retirer plus tard, par décision explicite.

Contact actuel : `thomasgoffinetfr@gmail.com` (mailto).
