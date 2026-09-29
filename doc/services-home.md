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

## Formulaire de contact

Les boutons « Me contacter » de la home ouvrent une fenêtre (`<dialog>`), et la fin du questionnaire service affiche le même formulaire (`public/assets/js/contact-form.js`, textes FR/EN/ES/PT). Sans JavaScript, le lien mailto vers `thomasgoffinetfr@gmail.com` reste disponible. `contact@goffprod.com` n'existe pas.

`POST /api/contact.php` : champ piège anti-robot, 5 demandes par session, message obligatoire s'il n'y a pas de réponses de questionnaire. Deux canaux indépendants, la demande est acceptée si l'un des deux réussit :

- notification SMTP via PHPMailer (`app/services/ContactMailer.php`), avec Reply-To sur l'e-mail du prospect ;
- une ligne JSON par demande dans `storage/contact/requests.jsonl` (ignoré par Git), avec `mail_sent` / `mail_error`.

Configuration dans le `.env` du serveur :

```
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=thomasgoffinetfr@gmail.com
MAIL_PASSWORD=<mot de passe d'application Google>
MAIL_TO=thomasgoffinetfr@gmail.com
# MAIL_FROM (défaut : MAIL_USERNAME), MAIL_ENCRYPTION=tls|ssl|none
```

Relire les demandes sur le serveur : `tail -n 20 /var/www/minusvortex/storage/contact/requests.jsonl`.
