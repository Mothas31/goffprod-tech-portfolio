# MinusVortex — audit des preuves et du positionnement

Date : 25 novembre 2026. Consultation du site public les 24–25 novembre 2026.

## Périmètre et méthode

Audit éditorial et commercial : ce que le site permet de comprendre de l’offre, du savoir-faire, du jugement et des raisons de prendre contact. Deux lectures : recruteur et futur partenaire (agence, ESN, autre professionnel). Analyse menée par un seul auditeur, sur un domaine commun : la crédibilité de la proposition professionnelle.

Lecture du contenu HTML public, de deux articles complets et des textes publics du module de qualification ; comparaison ciblée avec la page projets du dépôt local. Aucun formulaire envoyé, aucune modification du site ni de la production. Ce document est le seul livrable ajouté.

Sources principales :

- [Accueil](https://minusvortex.com/fr).
- [Portfolio en ligne](https://minusvortex.com/fr/portfolio).
- [Signaux](https://minusvortex.com/fr/signaux).
- [Dette technique : trois signaux](https://minusvortex.com/fr/signaux/dette-technique-3-signaux.html).
- [Garder l’ownership de son système](https://minusvortex.com/fr/signaux/garder-l-ownership-de-son-systeme.html).
- [Parcours développement, entrée legacy](https://minusvortex.com/fr/alignement-developpement.html?s=legacy).
- [Textes publics du module](https://minusvortex.com/assets/modules/prequal.html).
- Version locale : `app/lang/fr/portfolio.php`, `app/views/pages/portfolio.php`.

## Diagnostic

Le site exprime une intention professionnelle cohérente : reprendre des applications, réduire leur fragilité et garder les systèmes compréhensibles. Les services de l’accueil décrivent des situations reconnaissables. Les articles donnent une première preuve de capacité pédagogique.

Il ne permet toutefois pas encore de reconstituer une intervention réelle : problème de départ, rôle personnel, contraintes, décision, résultat et élément vérifiable. Le visiteur doit accorder sa confiance aux promesses avant de pouvoir les examiner.

La faiblesse est particulièrement visible en production : la page portfolio affiche uniquement « Notre portfolio » et « Bonjour la compagnie ». Le dépôt local contient quatre projets, mais cette matière n’est pas actuellement présentée sur la page publique consultée. L’audit du seul dépôt aurait donc surestimé ce que voit un visiteur.

**Hypothèse commerciale principale :** la singularité et les principes peuvent susciter l’intérêt, mais les preuves disponibles ne donnent pas assez de matière pour justifier une sélection, une recommandation ou une mission. Il s’agit d’une lecture argumentée, pas d’un taux de conversion mesuré.

## Ce que les deux publics cherchent

| Question | Recruteur | Partenaire |
|---|---|---|
| Qui intervient ? | Une personne, son parcours, son niveau de responsabilité | Un interlocuteur, sa structure et les responsabilités assumées |
| Sur quoi puis-je lui faire confiance ? | Compétences effectivement exercées et décisions prises | Périmètre qu’il peut prendre en charge et limites |
| Comment travaille-t-il ? | Collaboration, autonomie, gestion des désaccords et transmission | Coordination, confidentialité, communication et passation |
| Quelle preuve m’aide à choisir ? | Cas attribuable, livrable, retour d’un tiers | Cas comparable, référence et cadre de collaboration |
| Quelle suite ? | Échanger sur un poste ou une mission | Vérifier une complémentarité puis cadrer une première intervention |

Le site ne doit pas raconter deux identités différentes. Les mêmes cas peuvent servir les deux publics, à condition d’expliciter à la fois la contribution personnelle et l’utilité pour l’organisation.

## Constats priorisés

### C1 — P1 : le principal emplacement de preuve est vide en production

**Constat démontré.** La [page portfolio publique](https://minusvortex.com/fr/portfolio) contient un titre et un texte provisoire, sans réalisation présentée. Le texte « Bonjour la compagnie » peut donner l’impression d’un site inachevé à un visiteur qui cherche une validation.

**Impact probable.** Le parcours de vérification du savoir-faire ne remplit pas sa fonction essentielle. P1 concerne cette tâche, pas une urgence technique ou un incident de production.

**Action.** Préparer une page publiable comprenant au moins un cas documenté, puis décider séparément de sa mise en ligne. Retirer le texte provisoire lors de cette publication. La présence de quatre projets dans le dépôt ne suffit pas à considérer cette action accomplie.

**Confiance : élevée** sur le contenu public observé ; impact commercial non mesuré.

### C2 — P2 : même les projets locaux décrivent surtout les produits

**Preuve.** `app/lang/fr/portfolio.php` présente Inochi, Week-End+, Water Performance et Nodus avec résumé, catégorie, tags et parfois un lien. Par exemple, Week-End+ est décrit comme un parcours de réservation relié à un agenda ; Water Performance comme un outil de diagnostic et de rapports. Ces descriptions ne précisent ni le rôle personnel, ni le point de départ, ni les arbitrages, ni un résultat constaté.

**Impact probable.** Un produit visible prouve qu’un produit existe. Il ne permet pas à lui seul d’attribuer sa conception ou ses résultats au professionnel qui le présente. Le recruteur ne peut pas estimer la responsabilité exercée ; le partenaire ne peut pas extrapoler un périmètre fiable.

**Action.** Transformer deux projets en cas : contexte → responsabilité → contrainte → décision → résultat → preuve. Préciser projet client, collaboration ou initiative personnelle, ainsi que le statut réel. Conserver le travail collectif dans le récit sans attribuer à une personne ce qui appartient à l’équipe.

**Confiance : élevée** pour la version locale ; elle ne constitue pas le contenu public actuel.

### C3 — P2 : les valeurs ne montrent pas encore le jugement en situation

**Preuve.** L’accueil promet une modernisation progressive et de la fiabilité. Les deux articles examinés exposent des principes de maîtrise et de réduction de la complexité, mais ne racontent pas une intervention attribuée, avec options concurrentes et conséquences observées.

**Impact probable.** Le visiteur peut comprendre ta doctrine sans savoir comment tu arbitres lorsqu’elle rencontre une contrainte de budget, de délai, de sécurité ou de continuité de service. Or c’est ce discernement qui peut distinguer un professionnel expérimenté d’un discours bien écrit.

**Action.** Montrer au moins un choix difficile : ce qui a été conservé malgré ses défauts, ce qui a été reporté, pourquoi une réécriture a été écartée ou retenue, et quelle limite demeure. Ajouter un artefact publiable : extrait anonymisé de diagnostic, schéma annoté, décision documentée ou exemple de passation.

**Confiance : élevée** sur l’absence de ces récits dans les pages examinées ; leur existence ailleurs reste possible.

### C4 — P2 : la personne et la responsabilité restent trop implicites

**Preuve.** L’accueil parle au nom de « nous » ; les articles consultés sont signés MinusVortex. Les pages examinées ne présentent pas clairement le parcours, le rôle personnel dans des réalisations ou l’organisation de ce « nous ».

**Impact probable.** Un recruteur doit identifier la personne qu’il pourrait intégrer. Un partenaire doit comprendre qui réalisera le travail et qui sera son interlocuteur. L’ambiguïté ajoute un effort de vérification évitable.

**Action.** Ajouter un bloc bref : personne derrière MinusVortex, spécialité, expériences pertinentes vérifiables, fonctionnement seul ou en collectif. Prévoir un accès à un parcours ou CV pour le recrutement et un contact direct pour les collaborations. Choisir « je » ou « nous » selon la réalité, puis l’expliquer.

**Confiance : élevée** sur les pages examinées, sans prétendre à une absence sur tout le domaine.

### C5 — P2 : les services sont reconnaissables, mais leurs preuves ne les accompagnent pas

**Preuve.** L’accueil nomme six interventions : legacy, applications métier, performance, intégrations, renfort Laravel et développement assisté par IA. Il n’associe pas à ces descriptions un cas, un livrable ou une référence. Les liens présents dans le HTML examiné mènent principalement au contact, à l’alignement et aux articles ; aucun lien vers le portfolio n’y apparaît.

**Impact probable.** Le visiteur reconnaît son problème, mais doit contacter le prestataire avant de pouvoir vérifier qu’il a déjà traité une situation comparable. L’étendue de l’offre peut aussi être perçue comme une généralité si aucune expérience ne lui donne de relief.

**Action.** Relier chaque service prioritaire à une preuve appropriée. Regrouper éventuellement l’offre autour d’une intervention centrale et d’interventions complémentaires. Ne supprimer aucune offre uniquement pour réduire le nombre : décider selon l’expérience démontrable et le travail recherché.

**Confiance : élevée** sur les textes et liens HTML ; navigation ajoutée dynamiquement non vérifiée.

### C6 — P2 : la proposition de partenariat s’arrête avant le cadre de travail

**Preuve.** Le service de renfort mentionne sous-traitance, marque blanche, français/anglais et travail à distance depuis Lisbonne. Cela pose un contexte utile, mais ne montre pas comment une collaboration se déroule : reprise d’un périmètre, coordination avec l’équipe, visibilité sur l’avancement, remise du travail et gestion des limites.

**Impact probable.** Le partenaire ne peut pas encore estimer le coût de coordination ni la manière dont tu protèges sa relation avec son propre client.

**Action.** Rédiger une courte présentation de collaboration : situations adaptées, responsabilités, manière de cadrer une première intervention, suivi et passation. Illustrer par une expérience autorisée. Ne promettre ni délai de réponse, ni disponibilité, ni garantie non confirmés.

**Confiance : élevée** sur les mentions observées ; pratiques réelles à confirmer.

### C7 — P3 : certains textes du parcours privilégient l’affinité avant la vérification

**Preuve.** La page alignement parle d’un mouvement « lisible, utile et durable » et affiche une orientation vers agences produit, experts no-code et CTO fractional. Le fragment public du module parle de « Première vibration » et de « sentir » l’adéquation d’un projet. Ces éléments ne suffisent pas à décrire le contenu obtenu au terme de l’échange.

**Impact plausible.** Ce langage peut renforcer l’univers de marque, mais laisser un interlocuteur professionnel incertain sur l’utilité pratique de l’étape. Le parcours interactif complet n’a pas été testé : son efficacité ne peut pas être déduite de ces seuls textes.

**Action.** Nommer le bénéfice concret de chaque étape et le résultat attendu : clarification du périmètre, premières questions ou échange de cadrage, selon ce qui est réellement fourni. Garder une voie directe pour un recrutement ou un partenariat qui n’est pas une demande de diagnostic.

**Confiance : moyenne**, car la lecture n’inclut pas une session interactive complète.

## Les acquis à conserver

- L’accueil décrit des douleurs concrètes : évolutions de plus en plus coûteuses, application que personne n’ose toucher, exploitation stressante, outils à connecter.
- La promesse de faire évoluer l’existant donne une intention plus précise qu’une simple liste de technologies.
- Les articles traduisent des sujets techniques en conséquences compréhensibles pour une organisation. Ils apportent une première preuve de pédagogie, même s’ils ne prouvent pas encore des résultats de mission.
- La version locale fournit une matière variée pour les cas. Cette variété peut montrer une adaptation à des usages différents, si la contribution personnelle est documentée.
- L’univers visuel apprécié par le propriétaire peut être conservé. Cet audit n’a pas évalué son rendu ni mesuré son effet sur les visiteurs.

## Ordre de travail recommandé

1. **Choisir la priorité commerciale.** Recrutement, missions directes ou partenariat : désigner l’objectif principal, tout en gardant une entrée explicite pour les autres.
2. **Constituer deux dossiers de preuve.** Choisir les projets selon la qualité des faits disponibles et leur proximité avec l’objectif, plutôt que leur apparence.
3. **Rédiger les cas avant de refaire les pages.** Vérifier rôle, résultats, artefacts et autorisations ; construire ensuite la présentation autour de cette matière.
4. **Rendre la personne et le mode de collaboration explicites.** Ajouter les informations nécessaires à la décision sans transformer le site en autobiographie.
5. **Relier offre, cas et contact.** Chaque promesse importante doit conduire à quelque chose que le visiteur peut examiner.

### Trame d’un cas crédible

- Qui utilisait le système et pour quelle tâche ?
- Quel problème concret existait avant ton intervention ?
- Quel était exactement ton rôle, et avec qui travaillais-tu ?
- Quelle contrainte empêchait une solution évidente ?
- Quelles options as-tu étudiées, et pourquoi ce choix ?
- Qu’as-tu personnellement livré ou changé ?
- Qu’est-ce qui a été observé ensuite, sur quelle période et avec quelle source ?
- Quelle preuve peut être montrée sans exposer de données confidentielles ?
- Qu’est-ce qui reste imparfait ou hors de ton périmètre ?

Un résultat peut être qualitatif et vérifiable : un flux auparavant manuel fonctionne désormais, une équipe peut reprendre le système, un outil existant reste utilisable pendant une migration. En l’absence de mesure fiable, le dire ; ne pas fabriquer un pourcentage, une économie ou une attribution causale.

## À confirmer avec le propriétaire

1. Quel type d’opportunité le site doit-il surtout provoquer dans les prochains mois ? Cette décision détermine la hiérarchie des preuves.
2. Pour les quatre projets locaux, quels rôles, livrables et résultats peuvent être attribués précisément à ton intervention ?
3. Quels noms, captures, extraits ou témoignages es-tu autorisé à publier ? Un cas anonymisé reste possible.
4. Qui compose réellement le « nous » et comment se répartissent les responsabilités ?
5. Quels éléments existent déjà : retours clients, avant/après, documents de décision, passation, historique d’usage ?

## Limites

Les réactions des recruteurs et partenaires sont des hypothèses de lecture à tester, pas des retours recueillis. Aucun analytics, entretien utilisateur ou historique commercial n’a été consulté. L’absence de preuve sur les pages examinées ne signifie pas absence d’expérience réelle.

Lecture éditoriale du contenu public et de ressources accessibles : aucun rendu navigateur, test visuel ou parcours JavaScript complet validé. L’accessibilité réelle des liens via l’interface dynamique reste à confirmer. Deux articles ont été lus intégralement, les autres uniquement via leurs résumés. Les sites des projets et leurs résultats n’ont pas été audités. Les versions anglaise, espagnole et portugaise sont hors périmètre, ainsi que SEO, code, sécurité et performance.

Le dépôt local et le site public diffèrent : leurs constats sont explicitement séparés. Aucune publication n’est effectuée par cet audit.
