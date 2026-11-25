<section class="min-h-screen pt-32 px-6 bg-white text-slate-950">
    <div class="max-w-3xl mx-auto">
        <p class="text-sm uppercase tracking-wide text-slate-500">Stripe Checkout</p>
        <h1 class="mt-3 text-4xl font-semibold">Paiement en ligne</h1>
        <p class="mt-6 text-lg leading-8 text-slate-700">
            Le paiement est traite sur Stripe. Le montant et l'offre sont definis cote serveur.
        </p>

        <form method="post" action="/api/create-checkout-session.php" class="mt-8">
            <input type="hidden" name="csrf_token" value="<?= Security::generateCsrfToken() ?>">
            <input type="hidden" name="product" value="default">
            <button type="submit" class="inline-flex px-5 py-3 bg-slate-950 text-white hover:bg-slate-800">
                Continuer vers Stripe
            </button>
        </form>
        <p class="mt-5 text-sm text-slate-600">
            En poursuivant, consultez les <a class="underline" href="<?= htmlspecialchars(Seo::pathFor('terms', Lang::locale()), ENT_QUOTES, 'UTF-8') ?>">conditions de vente</a>
            et la <a class="underline" href="<?= htmlspecialchars(Seo::pathFor('privacy', Lang::locale()), ENT_QUOTES, 'UTF-8') ?>">politique de confidentialité</a>.
        </p>
    </div>
</section>
