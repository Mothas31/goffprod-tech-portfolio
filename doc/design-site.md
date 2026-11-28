# Design du site MinusVortex

> Document de conception (façon game design doc). La vision long terme vit dans
> `minusvortex_vision_projet.md` — ici on opérationnalise : qui on touche, par
> quelle boucle, avec quelles preuves, et ce qu'on refuse.
> Mis à jour : 2026-07-14.

## Priorité professionnelle — 28 novembre 2026 (local)

Le brief `Brief-site-minusvortex.md`, puis les précisions du propriétaire,
font évoluer la priorité de l’accueil : identifier Thomas Goffinet,
développeur indépendant basé au Portugal, montrer les problèmes traités
et offrir un contact direct. La phrase directrice est « Je pars de votre
problème, puis je choisis l’outil ». Le canvas, le logo et le récit restent.
Cette priorité actualise les anciennes règles de discrétion sur le nom
personnel et de primauté du seul discours philosophique.

Développement est la première porte, IA la deuxième. L’offre IA est une
page accessible en français, sur devis, destinée aux petits artisans et
indépendants : sites vitrines simples ou accompagnement. Aucun prix fixe,
aucun délai et aucune économie chiffrée ne sont promis. Les autres univers
et leurs pages restent accessibles plus bas. Le contact public devient
`thomas@minusvortex.com` dans toutes les langues ; aucune configuration
SMTP ou de boîte mail n’est effectuée dans cette tâche.

La page Développement reste à `/fr/portfolio` : deux interventions réelles
anonymisées sont distinguées des trois situations types. La première
intervention proposée est un diagnostic payant avec plan priorisé, sur
devis. Nodus dispose d’une fiche française fondée uniquement sur le brief,
sans capture réelle ni dépôt lié, avec son état alpha et les limites du
mobile et de la synchronisation.

Écriture française d’abord : IA et Nodus sont des routes FR uniquement,
sans variantes EN/ES/PT ni hreflang fictifs. Le détail des écarts et des
vérifications est dans `suivis/2026-11-28-positionnement-professionnel.md`.
Cette version n’est ni poussée ni déployée.

## Évolution locale — 25 novembre 2026

L’accueil revient à la philosophie commune avant de proposer les univers.
Le premier écran conserve le canvas vortex, le logo central et son animation
d’origine. Le récit commence en dessous, après le défilement de cette entrée.
Le carrousel de services PHP/Laravel est remplacé par un récit vertical :
accumulation → discernement → retrait utile → choix d’un univers.

- Noir et blanc, typographie et géométrie filaire. Une scène Three.js avec
  perspective accompagne les chapitres au scroll : cadres dans la profondeur,
  accumulation, sélection, puis rectangle-portail vers les projets.
  À l’arrivée du rectangle, des particules convergent vers ses bords depuis
  plusieurs profondeurs. La souris incline ses axes ; le clic accélère
  l’aspiration pendant la transition. Ces mouvements sont désactivés avec
  la préférence de mouvement réduit.
  Le scroll reste natif. Un SVG en perspective sert de repli sans WebGL.
- Les sept univers renvoient aux routes d’alignement existantes. Leurs
  prolongements sont distingués : accompagnement, témoignage / livre en
  préparation, ou exploration. Aucune offre supplémentaire n’est créée.
  Ils se parcourent un par un dans un défilement horizontal natif avec
  accrochage : glissement tactile, trackpad, boutons et touches du clavier.
  Une sélection par noms rend les destinations visibles. Chaque panneau
  regroupe statut, thème, situation concrète, bénéfice et bouton « Faire le
  point » avec la mention « Questions guidées ». Le visuel filaire reste un
  repère compact, y compris sur mobile. Le défilement vertical de la page
  reste disponible ; les autres panneaux sont inactifs au clavier.
- Les projets et Signaux restent accessibles à la fin du parcours.
- Les textes et les métadonnées existent en FR, EN, ES et PT dans
  `app/lang/{locale}/philosophy.php` et `seo.php`.
- L’accueil charge `home-philosophy.css` et `home-philosophy.js`, puis le module
  `home-philosophy-scene.js` et la copie locale existante de Three.js uniquement
  lorsque le visuel 3D entre effectivement à l’écran, en observant ce visuel
  plutôt que l’ensemble du récit qui s’étend sur plusieurs écrans. Le canvas
  d’entrée ne déclenche donc pas le moteur 3D. Le rendu s’arrête hors écran
  et en onglet masqué.
  Le canvas d’entrée garde son script `minus-vortex.js` existant ; le header
  conserve le vrai logo. Les anciens carrousels et scènes ne sont pas chargés.
- Sans JavaScript, le texte et les liens restent visibles. Avec la préférence
  de mouvement réduit, la scène conserve une composition fixe.

Les styles du header et du footer sont adaptés uniquement sur l’accueil.
Les autres pages gardent leur présentation et leurs parcours existants.
Cette version est locale ; sa présence dans le dépôt ne vaut pas déploiement.

Mesure du 26 novembre 2026, Lighthouse 13.6.0 mobile sur
`http://127.0.0.1:18086/fr/bienvenue` : performance 86 → 100, temps de blocage
555 → 0 ms après correction du déclenchement 3D. Les quatre catégories
atteignent 100 sur cette mesure locale. Vérification navigateur sur mobile
et tablette : aucun chargement de Three.js à l’entrée, scène WebGL chargée
au défilement et portail fonctionnel. Les en-têtes de cache du serveur PHP
de développement restent distincts de ceux du serveur de production ;
aucun changement de cache ni déploiement n’a été effectué.

### Page de mise en pratique (`/fr/portfolio`)

La grille de réalisations et son effet de cartes superposées sont remplacés
par trois situations types : faire évoluer une application, relier des outils,
rendre les données utiles à une décision. Les anciens noms, captures et liens
de projets ne sont plus affichés. Il ne s’agit pas de cas clients anonymisés :
les textes sont explicitement des scénarios illustratifs, sans résultat de
mission revendiqué. De futurs cas réels demanderont les faits, le rôle exact
et l’attribution des éventuelles collaborations.

Chaque situation distingue problème, contrainte, piste et vérification. Le
schéma permet de comparer la friction et une piste de résolution. Le contenu
reste accessible sans JavaScript ; les contrôles sont alors masqués. Les
quatre langues et les URLs existantes sont conservées. Les textes du portail
et de la fin de l’accueil renvoient désormais à la démarche, pas à des projets
réalisés. Le header commun conserve le vrai logo et la navigation localisée.

---

## 1. L'intention en une phrase

**Le site ne vend rien : il incarne une philosophie — retirer ce qui ne devrait
pas exister — et laisse les personnes alignées trouver la sortie qui leur
correspond.**

La vente est secondaire. Elle n'existe qu'au bout de l'alignement, et elle est
différente par univers. Le logiciel n'est qu'une branche des solutions.

## 2. Le principe directeur : montrer, ne pas argumenter

Le site est son propre exemple. C'est la règle de design la plus importante :
**chaque élément doit prouver la philosophie avant de la dire.**

| La philosophie dit | Le site doit être | Mesure actuelle (2026-07-14) |
|---|---|---|
| Sobriété | Pas de framework front, pas de tracking tiers, pas de popup | PHP maison (~8 classes), 0 framework, 0 cookie tiers ✅ |
| Performance | Page servie vite, JS différé | TTFB 130 ms, HTML home 38 Ko ✅ |
| Moins de bruit | Une idée par écran, pas d'argumentaire empilé | Hero = 1 phrase ✅ |
| Ownership | Code lisible, hébergement maîtrisé (VPS), données chez nous | ✅ |
| Maîtrise | Tout est explicable simplement (doc/) | ✅ |

**Budgets à ne jamais dépasser** (sinon le message s'effondre) :
- HTML d'une page : < 60 Ko
- CSS total : < 50 Ko (aujourd'hui 31 Ko)
- JS bloquant au premier rendu : 0 (tout est `defer` ou idle)
- TTFB : < 300 ms
- Aucune requête vers un domaine tiers (CSP `self` déjà en place)

**Tension assumée** : three.js (~735 Ko) pour les scènes 3D. C'est lourd, mais
c'est l'identité visuelle — et il est chargé en différé après le premier rendu,
jamais sur le chemin critique. Règle : la 3D est un décor, jamais un prérequis.
Tout doit fonctionner (contenu, questionnaire, navigation) sans elle.

## 3. Qui on cherche à toucher

Pas des « visiteurs » : des personnes en surcharge qui sentent que quelque
chose devrait être plus simple, sans savoir quoi retirer. Par univers :

| Univers | Personne type | Douleur d'entrée | Sortie (offre) | Statut |
|---|---|---|---|---|
| Business | Dirigeant TPE/PME, indépendant | Dispersion, outils empilés, décisions floues | Accompagnement (audit / simplification) | Sortie service active |
| Développement | CTO, dev senior, porteur de produit | Dette, lenteur, dépendance à une personne | Accompagnement technique (audit, refactor, ownership) | Sortie service active |
| Santé | Personne malade chronique ou en surcharge | Métriques partout, protocoles subis | **Livre RCH** (témoignage de rémission — jamais « guérison promise ») | Email d'attente jusqu'à la page livre |
| Qualité | Responsable qualité/produit | Contrôles lourds qui ne fiabilisent rien | À définir (accompagnement ?) | Email d'attente |
| Formation | Autodidacte, responsable formation | Dispersion, accumulation sans progrès | À définir (contenu ? méthode ?) | Email d'attente |
| Mobilité | À préciser | Friction des déplacements | À définir | Email d'attente |
| IA | Dirigeant/équipe qui adopte l'IA | Dépendance, perte de jugement | Accompagnement (adoption sobre) | Email d'attente |

Le point commun : **on ne cible pas un métier, on cible un état** — la
saturation. C'est pour ça que la home ne dit pas « développement web ».

**Anti-cible (assumée)** : qui cherche un exécutant pas cher, qui veut
impressionner plutôt que durer, qui veut ajouter plutôt que retirer. Le
questionnaire existe pour les laisser partir — le bouton « Pas d'accord »
est une fonctionnalité, pas un échec.

## 4. La boucle principale (core loop)

```
ARRIVER            RESSENTIR              S'ALIGNER              SORTIR
home : une      →  scroller des 7      →  questionnaire       →  la sortie de
phrase + une       univers : la même      d'alignement           l'univers :
ambiance           idée déclinée          (2 min, filtre         livre, accom-
                                          honnête)               pagnement, ou
                       ↑                                          email d'attente
                       └── Signaux (articles) : la preuve
                           écrite, par univers, qui nourrit
                           la boucle et le SEO/IA
```

Chaque étape a UN travail :
- **Home** : donner la clé de lecture, pas convaincre. Une phrase suffit.
- **Scroller** : faire sentir que la philosophie s'applique à « mon » domaine.
- **Questionnaire** : qualifier honnêtement — dans les deux sens.
- **Sortie** : proposer l'objet aligné de CET univers. Jamais un paiement
  générique tombé de nulle part.
- **Signaux** : la preuve par l'écrit. Aussi le canal découverte (SEO, IA).

**Ligne éditoriale** : le backlog des sujets vit dans `articles.md` (racine) —
30 idées, dont 10 fondatrices. Le cœur de la thèse : le contexte comme
ressource rare à l'ère de l'IA (guerre des tokens, intelligence = compression,
ownership face à l'abstraction). Registre à suivre : affirmer et questionner
(lignes courtes, une idée, une question), pas argumenter.

## 5. État des lieux honnête

### Ce qui va (et qu'on protège)
- L'identité : noir, filaire, vortex — mémorable et cohérente partout.
- La mécanique d'alignement existe et fonctionne (7 univers, agree/disagree).
- Le site EST rapide et sobre (chiffres §2) — la preuve technique tient.
- Signaux : 6 univers couverts, 4 langues, un vocabulaire qui se répond
  d'article en article (le « au cas où », la métrique qui remplace la
  sensation…). SEO/hreflang/llms.txt en place.
- Le filtre assumé (Pas d'accord) est rare et juste.

### Ce qui ne va pas (par gravité)
1. **La clé de lecture n'est pas donnée.** Le hero est beau mais muet : on ne
   comprend pas le jeu (« une idée, sept univers, trouve le tien »). Une seule
   phrase manque — pas un argumentaire.
2. **Le questionnaire ne promet rien.** On répond sans savoir ce qu'on obtient
   à la fin. Une ligne d'intention suffit (« 2 minutes pour situer où le bruit
   te coûte »).
3. **Le portfolio est vide** (« Bonjour la compagnie ») — contre-preuve
   directe pour un site qui vend la maîtrise. Le remplir ou le dépublier.
4. La branche santé (livre RCH) n'existe pas encore sur le site. Le contrat de
   sortie `book` est prêt, mais Santé reste en attente tant que sa page manque.

## 6. Ce qu'on refuse (anti-scope)

Aussi important que le reste. On ne fera **jamais** :
- de framework front (React/Vue/…) ni de dépendance runtime non maîtrisée ;
- de tracking tiers, popup, bandeau cookie (conséquence : pas de cookie non
  essentiel), newsletter agressive, compte à rebours ;
- d'argumentaire commercial sur la home (« nos services », « pourquoi nous ») ;
- de promesse de guérison ou d'allégation santé (registre témoignage
  uniquement pour le livre RCH) ;
- de mise en avant du nom personnel (la marque porte tout) ;
- d'ajout de contenu/feature « au cas où » — chaque ajout doit servir la
  boucle du §4, sinon il attend.

## 7. Comment on mesure le succès

Sobrement — pas de dashboard, 3 constantes (comme dans l'article santé) :
1. **Alignés capturés** : emails laissés + questionnaires complétés (déjà en
   base via l'API prequal).
2. **Sorties atteintes** : ventes par univers (livre, accompagnement) — même
   petites, elles valident le modèle branche par branche.
3. **Découverte** : impressions/clics Search Console + citations IA
   (vérifiable en demandant aux assistants « MinusVortex »).

Si ces trois constantes progressent, le reste est du détail.

## 8. Chantiers, dans l'ordre

1. **Sorties par univers — fait** : config `book` / `service` / `waitlist`,
   rendu aligné dans le questionnaire et capture d'email locale. Santé basculera
   sur `book` quand sa page existera.
2. **La phrase de clé de lecture** sur la home + la ligne d'intention du
   questionnaire (deux phrases, zéro design).
3. **Portfolio** : remplir avec 2-3 cas racontés façon « chaos → retrait →
   résultat », ou dépublier en attendant.
4. **Branche santé** : page du livre RCH (témoignage, extraits, achat).
5. Mobilité/Qualité/Formation : laisser en `waitlist` tant qu'il n'y a pas
   d'offre réelle — ne rien inventer pour remplir.

---

*Règle de relecture de ce document : si une décision du site ne peut pas se
raccrocher à la boucle du §4 ou contredit le §6, c'est elle qui a tort.*
