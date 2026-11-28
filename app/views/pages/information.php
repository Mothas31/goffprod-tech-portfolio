<?php
$pageId = $informationPage ?? '';
?>
<main class="min-h-screen bg-black text-white px-6 pt-32 pb-24">
    <article class="mx-auto max-w-3xl">
        <p class="text-sm uppercase tracking-widest text-zinc-400">MinusVortex</p>
        <?php if ($pageId === 'legal'): ?>
            <h1 class="mt-4 mb-10 text-4xl font-semibold">Mentions légales</h1>
            <div class="space-y-8 text-zinc-200 leading-7">
                <p class="border border-amber-400/50 bg-amber-400/10 p-4 text-sm text-amber-100">Projet de mentions à compléter avant publication définitive. Les champs entre crochets doivent être remplacés par les informations exactes de l’activité et de l’hébergeur.</p>
                <section><h2 class="mb-2 text-xl font-medium text-white">Éditeur du site</h2>
                    <p>Le site MinusVortex est édité par Thomas Goffinet, entrepreneur individuel exerçant sous le nom commercial MinusVortex.</p>
                    <p>Adresse professionnelle : <strong>[adresse professionnelle complète à renseigner]</strong><br>
                    Immatriculation / numéro d’entreprise : <strong>[numéro et registre compétent à renseigner selon le pays d’établissement]</strong><br>
                    Numéro de TVA intracommunautaire, le cas échéant : <strong>[à renseigner ou supprimer si non applicable]</strong><br>
                    E-mail : <a class="underline" href="mailto:thomas@minusvortex.com">thomas@minusvortex.com</a><br>
                    Téléphone : <strong>[à renseigner ou préciser qu’aucun numéro n’est publié]</strong></p>
                </section>
                <section><h2 class="mb-2 text-xl font-medium text-white">Directeur de la publication</h2><p>Thomas Goffinet.</p></section>
                <section><h2 class="mb-2 text-xl font-medium text-white">Hébergement</h2>
                    <p>Hébergeur : <strong>[raison sociale de l’hébergeur]</strong><br>
                    Adresse : <strong>[adresse de l’hébergeur]</strong><br>
                    Téléphone ou contact : <strong>[coordonnée de l’hébergeur]</strong></p>
                </section>
                <section><h2 class="mb-2 text-xl font-medium text-white">Propriété intellectuelle</h2><p>Sauf mention contraire, les textes, éléments graphiques et contenus de ce site sont protégés par les règles applicables à la propriété intellectuelle. Toute réutilisation substantielle nécessite l’autorisation préalable de leur titulaire.</p></section>
            </div>
        <?php elseif ($pageId === 'privacy'): ?>
            <h1 class="mt-4 mb-10 text-4xl font-semibold">Politique de confidentialité</h1>
            <div class="space-y-8 text-zinc-200 leading-7">
                <p class="border border-amber-400/50 bg-amber-400/10 p-4 text-sm text-amber-100">Projet à valider avant publication : les durées de conservation, le prestataire d’hébergement, le service d’envoi des e-mails et les transferts éventuels doivent être confirmés.</p>
                <section><h2 class="mb-2 text-xl font-medium text-white">Responsable et contact</h2><p>Le responsable du traitement est Thomas Goffinet, exerçant sous le nom MinusVortex. Pour toute question ou demande relative aux données personnelles : <a class="underline" href="mailto:thomas@minusvortex.com">thomas@minusvortex.com</a>.</p></section>
                <section><h2 class="mb-2 text-xl font-medium text-white">Données et finalités</h2><ul class="list-disc space-y-2 pl-6">
                    <li>Formulaire de contact et questionnaire : adresse e-mail, message, sujet, réponses transmises et page d’origine, afin de répondre aux demandes et d’assurer leur suivi.</li>
                    <li>Liste d’attente : adresse e-mail, thème choisi et langue, afin de gérer la demande d’information sur l’ouverture de l’offre concernée.</li>
                    <li>Paiement : les données de paiement sont saisies sur Stripe Checkout. Le site reçoit et conserve certaines informations de suivi de la transaction (dont l’identifiant de session, le statut et, selon les informations transmises par Stripe, l’adresse e-mail du client).</li>
                    <li>Fonctionnement et sécurité : une session technique peut être utilisée pour protéger les formulaires et limiter les abus.</li>
                </ul></section>
                <section><h2 class="mb-2 text-xl font-medium text-white">Base juridique</h2><p>Les demandes de contact sont traitées pour répondre à une demande et, le cas échéant, prendre des mesures avant la conclusion d’un contrat. Les inscriptions à la liste d’attente sont traitées pour fournir le suivi demandé. Les données de paiement sont traitées pour exécuter la transaction et respecter les obligations légales applicables. Les journaux de sécurité sont conservés dans la mesure nécessaire à la protection du service.</p></section>
                <section><h2 class="mb-2 text-xl font-medium text-white">Destinataires et prestataires</h2><p>Les données sont accessibles à Thomas Goffinet et, selon les opérations, aux prestataires techniques nécessaires à l’hébergement, à l’envoi des e-mails et au paiement. Stripe traite les paiements via sa page Checkout. <strong>[Indiquer le nom de l’hébergeur et du prestataire e-mail, leurs pays de traitement et les éventuels transferts hors EEE.]</strong></p></section>
                <section><h2 class="mb-2 text-xl font-medium text-white">Durée de conservation</h2><p>Les données ne sont conservées que le temps nécessaire à leur finalité et aux obligations applicables. Durées à fixer et renseigner avant publication : demandes de contact <strong>[durée]</strong> ; liste d’attente <strong>[durée ou événement de suppression]</strong> ; données de transaction <strong>[durée comptable/légale applicable]</strong> ; journaux techniques <strong>[durée]</strong>.</p></section>
                <section><h2 class="mb-2 text-xl font-medium text-white">Vos droits</h2><p>Selon la réglementation applicable, vous pouvez demander l’accès, la rectification, l’effacement ou la limitation du traitement, et vous opposer à certains traitements ou demander la portabilité de vos données. Contactez <a class="underline" href="mailto:thomas@minusvortex.com">thomas@minusvortex.com</a>. Vous pouvez également adresser une réclamation à l’autorité de protection des données compétente dans votre pays de résidence ou d’établissement.</p></section>
                <section><h2 class="mb-2 text-xl font-medium text-white">Cookies et stockage local</h2><p>Le site peut utiliser un cookie de session nécessaire à la sécurité et au fonctionnement des formulaires. <strong>[Vérifier les cookies et traceurs réellement déposés, y compris par les outils tiers, puis compléter cette section et mettre en place un consentement si nécessaire.]</strong></p></section>
                <p class="text-sm text-zinc-400">Dernière mise à jour : [date à renseigner]</p>
            </div>
        <?php else: ?>
            <h1 class="mt-4 mb-10 text-4xl font-semibold">Conditions générales de vente</h1>
            <div class="space-y-8 text-zinc-200 leading-7">
                <p class="border border-amber-400/50 bg-amber-400/10 p-4 text-sm text-amber-100">Projet de trame à compléter et valider avant toute vente en ligne. Le paiement Stripe actuellement présent dans le projet ne précise pas à lui seul l’offre, le prix, les délais ou les conditions applicables.</p>
                <section><h2 class="mb-2 text-xl font-medium text-white">Prestataire</h2><p>Les prestations sont proposées par Thomas Goffinet, exerçant sous le nom commercial MinusVortex. Adresse professionnelle, numéro d’entreprise et coordonnées : voir les <a class="underline" href="<?= htmlspecialchars(Seo::pathFor('legal', Lang::locale()), ENT_QUOTES, 'UTF-8') ?>">mentions légales</a>.</p></section>
                <section><h2 class="mb-2 text-xl font-medium text-white">Champ d’application et prestations</h2><p>Les présentes conditions encadrent les prestations de conseil, développement, reprise et optimisation logicielle présentées sur le site, lorsque le devis ou le contrat conclu avec le client s’y réfère. Le périmètre, les livrables, le calendrier et les éventuelles conditions particulières sont précisés dans le devis accepté.</p></section>
                <section><h2 class="mb-2 text-xl font-medium text-white">Prix et paiement</h2><p>Les prix, la devise, les taxes applicables, l’échéancier et les moyens de paiement sont indiqués dans le devis ou, pour une commande en ligne, avant validation de la commande. Les paiements en ligne sont traités par Stripe. <strong>[Préciser les règles de facturation, les échéances, les retards de paiement et les éventuels acomptes.]</strong></p></section>
                <section><h2 class="mb-2 text-xl font-medium text-white">Exécution et annulation</h2><p>Les délais et modalités d’exécution sont convenus dans le devis ou le contrat. <strong>[Décrire les modalités de report, d’annulation, de résiliation et leurs conséquences financières.]</strong></p></section>
                <section><h2 class="mb-2 text-xl font-medium text-white">Rétractation et médiation</h2><p>Lorsque le client est un consommateur, les règles applicables au droit de rétractation doivent être précisées avant la commande, avec les éventuelles exceptions et la demande expresse de commencement anticipé de la prestation. <strong>[Compléter selon la nature du service et le pays d’établissement.]</strong> Si des consommateurs peuvent contracter, indiquer ici les coordonnées du médiateur de la consommation compétent : <strong>[médiateur, adresse et site internet à renseigner après adhésion.]</strong></p></section>
                <section><h2 class="mb-2 text-xl font-medium text-white">Droit applicable et litiges</h2><p><strong>[À compléter selon le pays d’établissement, les clients visés et les règles impératives applicables aux consommateurs.]</strong></p></section>
                <p class="text-sm text-zinc-400">Dernière mise à jour : [date à renseigner]</p>
            </div>
        <?php endif; ?>
    </article>
</main>
