# Suivi - Stripe et paiements en ligne

Date: 2026-05-27

## Contexte

Demande: continuer la reflexion sur Stripe / paiements en ligne, verifier si quelque chose est deja integre, et creer deux dossiers de reprise `doc/` et `suivis/`.

## Constat initial

Aucune integration Stripe ou paiement n'a ete trouvee dans le code.

Le projet est actuellement un site PHP maison avec routeur simple, vues PHP et quelques endpoints dans `public/api/`.

## Fichiers inspectes

- `README.md`
- `public/index.php`
- `app/core/Router.php`
- `app/controllers/PageController.php`
- `app/core/Security.php`
- `package.json`

## Fichiers crees

- `doc/INDEX.md`
- `doc/paiements-stripe.md`
- `suivis/INDEX.md`
- `suivis/2026-05-27-stripe-paiements.md`
- `.env.example`
- `composer.json`
- `composer.lock`
- `app/bootstrap.php`
- `app/config/payments.php`
- `app/core/Env.php`
- `app/repositories/PaymentRepository.php`
- `app/services/StripePaymentService.php`
- `app/views/pages/payment.php`
- `app/views/pages/payment_success.php`
- `app/views/pages/payment_cancel.php`
- `public/api/create-checkout-session.php`
- `public/api/stripe-webhook.php`
- `storage/database/.gitkeep`

## Fichiers modifies

- `.gitignore`
- `README.md`
- `public/index.php`
- `app/core/Router.php`
- `app/controllers/PageController.php`
- `app/views/partials/header.php`

## Decisions

- Utiliser Stripe Checkout heberge pour la premiere version.
- Utiliser SQLite local via `PDO SQLite`, sans serveur de base de donnees.
- Ne pas versionner `.env`, `vendor/`, ni le fichier SQLite.
- Garder le montant cote serveur via `STRIPE_PRICE_ID`.
- Eviter de scanner tout le projet lors des prochaines sessions IA.

## Risques / points ouverts

- Besoin exact non tranche: paiement ponctuel, abonnement, acompte, reservation, donation.
- `pdo_sqlite` n'est pas active dans le PHP local au moment du test.
- `sudo apt install php8.3-sqlite3` demande un mot de passe sudo.
- `vendor/` est ignore: lancer `composer install` apres clone/deploiement.
- `.env` doit etre cree depuis `.env.example`.
- La page `success` ne confirme pas le paiement; seul le webhook met SQLite a jour.

## Prochaine action concrete

Activer SQLite PHP, renseigner Stripe en test, puis valider le flux sandbox:

1. `sudo apt install php8.3-sqlite3`
2. `cp .env.example .env`
3. renseigner `STRIPE_SECRET_KEY`, `STRIPE_WEBHOOK_SECRET`, `STRIPE_PRICE_ID`, `APP_URL`
4. `composer install`
5. lancer le site local
6. `stripe listen --forward-to localhost:8000/api/stripe-webhook.php`
7. tester `/paiement.html`

## Validations effectuees

- `composer require stripe/stripe-php`
- `composer update --lock`
- `composer validate --strict`
- `php -l` sur les nouveaux fichiers PHP principaux
- `curl -I http://127.0.0.1:8030/paiement.html` retourne `200`
- `POST /api/create-checkout-session.php` sans CSRF retourne `403`
- `POST /api/stripe-webhook.php` sans signature Stripe retourne `400`

Validation non terminee:

- creation effective de `storage/database/payments.sqlite`, bloquee par l'absence de `pdo_sqlite`.
