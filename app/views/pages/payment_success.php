<section class="min-h-screen pt-32 px-6 bg-white text-slate-950">
    <div class="max-w-3xl mx-auto">
        <p class="text-sm uppercase tracking-wide text-emerald-700">Paiement</p>
        <h1 class="mt-3 text-4xl font-semibold">Paiement en cours de confirmation</h1>
        <p class="mt-6 text-lg leading-8 text-slate-700">
            Stripe a accepte le retour vers le site. La validation definitive est traitee par webhook cote serveur.
        </p>
        <p class="mt-4 text-sm text-slate-500">
            Reference session:
            <?= htmlspecialchars((string) ($_GET['session_id'] ?? 'non fournie'), ENT_QUOTES, 'UTF-8') ?>
        </p>
        <a href="/" class="inline-flex mt-8 px-5 py-3 bg-slate-950 text-white hover:bg-slate-800">
            Retour a l'accueil
        </a>
    </div>
</section>
