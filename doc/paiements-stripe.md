# Paiements Stripe

## Objectif

Ajouter un paiement en ligne sobre et securise au portfolio, probablement via Stripe Checkout dans un premier temps.

Le besoin exact reste a confirmer: paiement ponctuel, acompte, reservation, produit numerique, prestation, abonnement, ou donation.

## Etat du code au 2026-05-27

Une premiere integration Stripe Checkout + SQLite est en place.

## Architecture actuelle pertinente

Le projet est un petit site PHP sans framework full-stack:

- entree HTTP: `public/index.php`
- routing maison: `app/core/Router.php`
- controleur pages: `app/controllers/PageController.php`
- vues: `app/views/`
- API existante hors routeur: `public/api/prequal.php`
- securite commune: `app/core/Security.php`
- dependance Stripe via Composer: `stripe/stripe-php`
- stockage local attendu: `storage/database/payments.sqlite`

## Integration retenue

Stripe Checkout heberge par Stripe.

Raisons:

- moins de surface PCI;
- pas de formulaire carte bancaire a maintenir;
- logique serveur plus simple;
- plus facile a tester en mode sandbox.

Flux cible:

1. L'utilisateur choisit une offre ou un paiement.
2. Le site appelle un endpoint serveur local qui cree une Checkout Session Stripe.
3. Le serveur renvoie une URL Stripe ou redirige directement vers Checkout.
4. Stripe redirige vers une page `success` ou `cancel`.
5. Un webhook Stripe confirme le paiement cote serveur.
6. Le site enregistre l'etat final du paiement uniquement apres webhook valide.

## Fichiers principaux

- `composer.json` / `composer.lock`: SDK officiel Stripe.
- `.env.example`: variables attendues, sans secret reel.
- `app/bootstrap.php`: chargement Composer, classes internes et `.env`.
- `app/core/Env.php`: chargeur `.env` minimal.
- `app/config/payments.php`: mapping serveur des offres Stripe.
- `app/repositories/PaymentRepository.php`: stockage SQLite.
- `app/services/StripePaymentService.php`: creation Checkout + traitement webhook.
- `public/api/create-checkout-session.php`: creation d'une session Checkout.
- `public/api/stripe-webhook.php`: reception des evenements Stripe.
- `app/views/pages/payment.php`: formulaire POST vers Checkout.
- `app/views/pages/payment_success.php`: page retour succes.
- `app/views/pages/payment_cancel.php`: page retour annulation.

## Variables d'environnement attendues

- `STRIPE_SECRET_KEY`
- `STRIPE_WEBHOOK_SECRET`
- `STRIPE_PRICE_ID` ou mapping interne des offres
- `APP_URL`

Ne jamais versionner les cles reelles.

## Points de securite

- Ne jamais faire confiance au montant envoye par le client.
- Utiliser des Price IDs Stripe ou un mapping serveur ferme.
- Verifier la signature webhook avec `STRIPE_WEBHOOK_SECRET`.
- Considerer le webhook comme source de verite pour confirmer le paiement.
- Journaliser les erreurs sans exposer les secrets.
- Eviter de stocker des donnees carte bancaire.
- Verifier l'impact sur la CSP dans `app/core/Security.php`.

## Prerequis local

Installer l'extension PHP SQLite:

```bash
sudo apt install php8.3-sqlite3
```

Puis verifier:

```bash
php -m | rg "pdo_sqlite|sqlite3"
```

Installer les dependances PHP si `vendor/` n'est pas present:

```bash
composer install
```

## Decisions restantes

- Type exact de paiement: ponctuel, abonnement, acompte, reservation, donation.
- Devise et montants dans Stripe.
- Besoin de facture Stripe ou facture externe.
- Besoin d'un espace client ou simple confirmation email.
- Politique de conservation des paiements dans SQLite.

## Risques

- Sans `pdo_sqlite`, la creation de paiement echoue avant appel Stripe.
- Une page `success` ne prouve pas le paiement; seul le webhook valide le statut.
- Les regles CSP actuelles restent compatibles avec une redirection serveur vers Checkout.

## Prochaine etape recommandee

Installer `php8.3-sqlite3`, renseigner `.env`, creer un Price Stripe de test, puis tester le flux complet avec Stripe CLI:

```bash
stripe listen --forward-to localhost:8000/api/stripe-webhook.php
```
