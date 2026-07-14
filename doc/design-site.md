# Design du site MinusVortex

> Document de conception (façon game design doc). La vision long terme vit dans
> `minusvortex_vision_projet.md` — ici on opérationnalise : qui on touche, par
> quelle boucle, avec quelles preuves, et ce qu'on refuse.
> Mis à jour : 2026-07-14.

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
| Business | Dirigeant TPE/PME, indépendant | Dispersion, outils empilés, décisions floues | Accompagnement (audit / simplification) | Paiement générique — à spécialiser |
| Développement | CTO, dev senior, porteur de produit | Dette, lenteur, dépendance à une personne | Accompagnement technique (audit, refactor, ownership) | Paiement générique — à spécialiser |
| Santé | Personne malade chronique ou en surcharge | Métriques partout, protocoles subis | **Livre RCH** (témoignage de rémission — jamais « guérison promise ») | À construire |
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
1. **Toutes les portes mènent à la même sortie.** Un seul produit Stripe
   générique (« Paiement Goffprod ») quel que soit l'univers. C'est LA
   incohérence avec le modèle écosystème. → chantier n°1.
2. **La clé de lecture n'est pas donnée.** Le hero est beau mais muet : on ne
   comprend pas le jeu (« une idée, sept univers, trouve le tien »). Une seule
   phrase manque — pas un argumentaire.
3. **Le questionnaire ne promet rien.** On répond sans savoir ce qu'on obtient
   à la fin. Une ligne d'intention suffit (« 2 minutes pour situer où le bruit
   te coûte »).
4. **Pas de sortie douce.** L'aligné pas prêt à acheter n'a nulle part où
   laisser une trace (email). Dans un modèle où la vente est secondaire, c'est
   la conversion principale qui manque.
5. **Le portfolio est vide** (« Bonjour la compagnie ») — contre-preuve
   directe pour un site qui vend la maîtrise. Le remplir ou le dépublier.
6. La branche santé (livre RCH) n'existe pas encore sur le site.

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

1. **Sorties par univers** — config par branche (type : `book` / `service` /
   `waitlist`), écran d'orientation du questionnaire qui présente la sortie
   alignée, capture d'email comme sortie par défaut. C'est le chantier qui
   rend le modèle réel.
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
