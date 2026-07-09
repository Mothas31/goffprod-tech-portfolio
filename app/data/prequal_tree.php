<?php
declare(strict_types=1);

// Questions inspirées de "The Mom Test" : on interroge des faits et des
// comportements passés, jamais des opinions ou des intentions futures.
return [
    'fr' => [
        'ui' => [
            'kicker' => 'Première vibration',
            'title' => 'Voyons si l’on parle le même langage',
            'intro' => 'Quelques questions concrètes sur votre situation réelle, pour voir si nos manières de travailler se rencontrent.',
            'entryLead' => 'Choisissez le terrain qui vous ressemble.',
            'entryQuestion' => 'Par où commence l’élan ?',
            'resultTitle' => 'Point de rencontre',
            'resultQuestion' => 'Ce que cela raconte',
            'back' => 'Retour',
            'reset' => 'Recommencer',
            'cta' => 'Partager mes infos',
            'ctaReferral' => 'Demander une orientation',
            'mailSubject' => 'Point de rencontre MinusVortex',
        ],
        'universes' => [
            [
                'id' => 'universe-health',
                'label' => 'Santé',
                'art' => 'health',
                'icon' => 'lotus',
                'path' => '/fr/alignement-sante.html',
                'statement' => 'Dans la santé, chaque décision a un souffle humain. La performance n’a de sens que si elle reste claire, fiable et douce pour celles et ceux qui l’utilisent.',
                'orientation' => 'Orientation possible : cabinets santé, qualité, parcours patient.',
                'entry_options' => [
                    ['label' => 'Plutôt d’accord', 'next' => 'value_clarity', 'tag' => 'universe-agree', 'points' => 2, 'maxPoints' => 2],
                    ['label' => 'Pas d’accord', 'next' => 'value_clarity', 'tag' => 'universe-disagree', 'points' => 0, 'maxPoints' => 2],
                ],
            ],
            [
                'id' => 'universe-finance',
                'label' => 'Business',
                'art' => 'finance',
                'icon' => 'coins',
                'path' => '/fr/alignement-finance.html',
                'statement' => 'Dans le business, la structure vaut mieux que l’agitation. On cherche des mécanismes lisibles, durables et sans théâtre inutile.',
                'orientation' => 'Orientation possible : pilotage, opérations, outils métier et réduction du chaos organisationnel.',
                'entry_options' => [
                    ['label' => 'Plutôt d’accord', 'next' => 'value_clarity', 'tag' => 'universe-agree', 'points' => 2, 'maxPoints' => 2],
                    ['label' => 'Pas d’accord', 'next' => 'value_clarity', 'tag' => 'universe-disagree', 'points' => 0, 'maxPoints' => 2],
                ],
            ],
            [
                'id' => 'universe-dev',
                'label' => 'Développement',
                'art' => 'dev',
                'icon' => 'spark',
                'path' => '/fr/alignement-developpement.html',
                'statement' => 'Dans le développement, le monde court souvent après le plus vite et le plus gros. Ici, on préfère un mouvement juste : lisible, utile et durable.',
                'orientation' => 'Orientation possible : agences produit, experts no-code, CTO fractional.',
                'entry_options' => [
                    ['label' => 'Plutôt d’accord', 'next' => 'dev_scenario', 'tag' => 'universe-agree', 'points' => 2, 'maxPoints' => 2],
                    ['label' => 'Pas d’accord', 'next' => 'dev_scenario', 'tag' => 'universe-disagree', 'points' => 0, 'maxPoints' => 2],
                ],
            ],
            [
                'id' => 'universe-mobility',
                'label' => 'Mobilité',
                'art' => 'mobility',
                'icon' => 'plane',
                'path' => '/fr/alignement-mobilite.html',
                'statement' => 'Dans la mobilité, la fluidité compte autant que la vitesse. On simplifie les parcours avant de complexifier les outils.',
                'orientation' => 'Orientation possible : experts parcours, opérations terrain, produits services.',
                'entry_options' => [
                    ['label' => 'Plutôt d’accord', 'next' => 'value_clarity', 'tag' => 'universe-agree', 'points' => 2, 'maxPoints' => 2],
                    ['label' => 'Pas d’accord', 'next' => 'value_clarity', 'tag' => 'universe-disagree', 'points' => 0, 'maxPoints' => 2],
                ],
            ],
            [
                'id' => 'universe-quality',
                'label' => 'Qualité',
                'art' => 'quality',
                'icon' => 'check',
                'path' => '/fr/alignement-qualite.html',
                'statement' => 'La qualité ne devrait pas être une couche en plus. Elle devrait déjà vivre dans la manière de concevoir, mesurer et transmettre.',
                'orientation' => 'Orientation possible : qualité, audit, fiabilisation process.',
                'entry_options' => [
                    ['label' => 'Plutôt d’accord', 'next' => 'value_clarity', 'tag' => 'universe-agree', 'points' => 2, 'maxPoints' => 2],
                    ['label' => 'Pas d’accord', 'next' => 'value_clarity', 'tag' => 'universe-disagree', 'points' => 0, 'maxPoints' => 2],
                ],
            ],
            [
                'id' => 'universe-formation',
                'label' => 'Formation',
                'art' => 'formation',
                'icon' => 'screen',
                'path' => '/fr/alignement-formation.html',
                'statement' => 'Dans la formation, la clarté n’est pas un bonus. C’est ce qui transforme une information en progression réelle.',
                'orientation' => 'Orientation possible : pédagogie, LMS, transmission de savoir.',
                'entry_options' => [
                    ['label' => 'Plutôt d’accord', 'next' => 'value_clarity', 'tag' => 'universe-agree', 'points' => 2, 'maxPoints' => 2],
                    ['label' => 'Pas d’accord', 'next' => 'value_clarity', 'tag' => 'universe-disagree', 'points' => 0, 'maxPoints' => 2],
                ],
            ],
            [
                'id' => 'universe-ai',
                'label' => 'IA',
                'art' => 'ai',
                'icon' => 'spark',
                'path' => '/fr/alignement-ia.html',
                'statement' => 'Avec l’IA, la vraie valeur n’est pas d’en mettre partout, mais de savoir où elle sert vraiment, sobrement et sans illusion.',
                'orientation' => 'Orientation possible : intégration IA utile, automatisation sobre, garde-fous.',
                'entry_options' => [
                    ['label' => 'Plutôt d’accord', 'next' => 'value_clarity', 'tag' => 'universe-agree', 'points' => 2, 'maxPoints' => 2],
                    ['label' => 'Pas d’accord', 'next' => 'value_clarity', 'tag' => 'universe-disagree', 'points' => 0, 'maxPoints' => 2],
                ],
            ],
        ],
        'nodes' => [
            'dev_scenario' => [
                'text' => 'Quel scénario de développement ressemble le plus à votre contexte actuel ?',
                'options' => [
                    ['label' => 'Lancement ou évolution de produit digital', 'next' => 'dev_launch_1', 'tag' => 'scenario-launch', 'points' => 0, 'maxPoints' => 0],
                    ['label' => 'Modernisation d’un legacy complexe', 'next' => 'dev_legacy_1', 'tag' => 'scenario-legacy', 'points' => 0, 'maxPoints' => 0],
                    ['label' => 'Optimisation performance et sobriété', 'next' => 'dev_perf_1', 'tag' => 'scenario-performance', 'points' => 0, 'maxPoints' => 0],
                ],
            ],
            'dev_launch_1' => [
                'text' => 'Comment le besoin de votre produit a-t-il été validé jusqu’ici ?',
                'options' => [
                    ['label' => 'Par des échanges réels avec des utilisateurs', 'next' => 'dev_launch_2', 'tag' => 'launch-1-strong', 'points' => 3, 'maxPoints' => 3],
                    ['label' => 'Par une étude ou des retours indirects', 'next' => 'dev_launch_2', 'tag' => 'launch-1-mid', 'points' => 2, 'maxPoints' => 3],
                    ['label' => 'Par une conviction, pas encore confrontée', 'next' => 'dev_launch_2', 'tag' => 'launch-1-low', 'points' => 0, 'maxPoints' => 3],
                ],
            ],
            'dev_launch_2' => [
                'text' => 'Qu’avez-vous déjà mis entre les mains d’utilisateurs réels ?',
                'options' => [
                    ['label' => 'Un produit ou prototype utilisé en conditions réelles', 'next' => 'dev_launch_3', 'tag' => 'launch-2-strong', 'points' => 3, 'maxPoints' => 3],
                    ['label' => 'Une démo ou maquette testée en interne', 'next' => 'dev_launch_3', 'tag' => 'launch-2-mid', 'points' => 2, 'maxPoints' => 3],
                    ['label' => 'Rien pour l’instant', 'next' => 'dev_launch_3', 'tag' => 'launch-2-low', 'points' => 0, 'maxPoints' => 3],
                ],
            ],
            'dev_launch_3' => [
                'text' => 'À quand remonte la dernière fonctionnalité retirée ou refusée ?',
                'options' => [
                    ['label' => 'Récemment, sur la base de l’usage réel', 'next' => 'dev_launch_4', 'tag' => 'launch-3-strong', 'points' => 3, 'maxPoints' => 3],
                    ['label' => 'C’est arrivé, mais c’est rare', 'next' => 'dev_launch_4', 'tag' => 'launch-3-mid', 'points' => 2, 'maxPoints' => 3],
                    ['label' => 'On n’enlève jamais rien', 'next' => 'dev_launch_4', 'tag' => 'launch-3-low', 'points' => 0, 'maxPoints' => 3],
                ],
            ],
            'dev_launch_4' => [
                'text' => 'Aujourd’hui, combien de temps pour livrer un petit changement en production ?',
                'options' => [
                    ['label' => 'Quelques heures à quelques jours', 'next' => 'dev_launch_5', 'tag' => 'launch-4-strong', 'points' => 3, 'maxPoints' => 3],
                    ['label' => 'Quelques semaines', 'next' => 'dev_launch_5', 'tag' => 'launch-4-mid', 'points' => 2, 'maxPoints' => 3],
                    ['label' => 'Difficile à dire, souvent très long', 'next' => 'dev_launch_5', 'tag' => 'launch-4-low', 'points' => 0, 'maxPoints' => 3],
                ],
            ],
            'dev_launch_5' => [
                'text' => 'Votre roadmap actuelle, qui la comprend vraiment ?',
                'options' => [
                    ['label' => 'Les équipes business comme techniques', 'next' => 'result', 'tag' => 'launch-5-strong', 'points' => 3, 'maxPoints' => 3],
                    ['label' => 'Surtout les profils techniques', 'next' => 'result', 'tag' => 'launch-5-mid', 'points' => 2, 'maxPoints' => 3],
                    ['label' => 'Elle vit surtout dans quelques têtes', 'next' => 'result', 'tag' => 'launch-5-low', 'points' => 0, 'maxPoints' => 3],
                ],
            ],
            'dev_legacy_1' => [
                'text' => 'Quelle vision avez-vous aujourd’hui de votre système existant ?',
                'options' => [
                    ['label' => 'Cartographiée : on sait ce qui dépend de quoi', 'next' => 'dev_legacy_2', 'tag' => 'legacy-1-strong', 'points' => 3, 'maxPoints' => 3],
                    ['label' => 'Partielle : il reste des zones d’ombre', 'next' => 'dev_legacy_2', 'tag' => 'legacy-1-mid', 'points' => 2, 'maxPoints' => 3],
                    ['label' => 'Personne n’a la vue d’ensemble', 'next' => 'dev_legacy_2', 'tag' => 'legacy-1-low', 'points' => 0, 'maxPoints' => 3],
                ],
            ],
            'dev_legacy_2' => [
                'text' => 'Comment s’est passée votre dernière tentative de modernisation ?',
                'options' => [
                    ['label' => 'Par étapes, intégrée au quotidien', 'next' => 'dev_legacy_3', 'tag' => 'legacy-2-strong', 'points' => 3, 'maxPoints' => 3],
                    ['label' => 'Un grand chantier dédié, difficile à finir', 'next' => 'dev_legacy_3', 'tag' => 'legacy-2-mid', 'points' => 2, 'maxPoints' => 3],
                    ['label' => 'Aucune vraie tentative pour l’instant', 'next' => 'dev_legacy_3', 'tag' => 'legacy-2-low', 'points' => 0, 'maxPoints' => 3],
                ],
            ],
            'dev_legacy_3' => [
                'text' => 'Quand une panne critique survient, que se passe-t-il concrètement ?',
                'options' => [
                    ['label' => 'On sait où chercher, l’impact reste isolé', 'next' => 'dev_legacy_4', 'tag' => 'legacy-3-strong', 'points' => 3, 'maxPoints' => 3],
                    ['label' => 'Quelques personnes clés savent réparer', 'next' => 'dev_legacy_4', 'tag' => 'legacy-3-mid', 'points' => 2, 'maxPoints' => 3],
                    ['label' => 'C’est la crise à chaque fois', 'next' => 'dev_legacy_4', 'tag' => 'legacy-3-low', 'points' => 0, 'maxPoints' => 3],
                ],
            ],
            'dev_legacy_4' => [
                'text' => 'Qu’est-ce qui a motivé le dernier gros choix technique sur ce système ?',
                'options' => [
                    ['label' => 'La maintenabilité à long terme', 'next' => 'dev_legacy_5', 'tag' => 'legacy-4-strong', 'points' => 3, 'maxPoints' => 3],
                    ['label' => 'Le délai ou le budget du moment', 'next' => 'dev_legacy_5', 'tag' => 'legacy-4-mid', 'points' => 2, 'maxPoints' => 3],
                    ['label' => 'L’habitude ou la préférence d’une personne', 'next' => 'dev_legacy_5', 'tag' => 'legacy-4-low', 'points' => 0, 'maxPoints' => 3],
                ],
            ],
            'dev_legacy_5' => [
                'text' => 'Si la personne qui connaît le mieux le système partait demain ?',
                'options' => [
                    ['label' => 'Les arbitrages sont écrits, ça tiendrait', 'next' => 'result', 'tag' => 'legacy-5-strong', 'points' => 3, 'maxPoints' => 3],
                    ['label' => 'Ce serait dur, mais gérable', 'next' => 'result', 'tag' => 'legacy-5-mid', 'points' => 2, 'maxPoints' => 3],
                    ['label' => 'Ce serait très grave', 'next' => 'result', 'tag' => 'legacy-5-low', 'points' => 0, 'maxPoints' => 3],
                ],
            ],
            'dev_perf_1' => [
                'text' => 'Quel est votre problème de performance le plus coûteux aujourd’hui ?',
                'options' => [
                    ['label' => 'Identifié et mesuré précisément', 'next' => 'dev_perf_2', 'tag' => 'perf-1-strong', 'points' => 3, 'maxPoints' => 3],
                    ['label' => 'Ressenti, mais pas encore mesuré', 'next' => 'dev_perf_2', 'tag' => 'perf-1-mid', 'points' => 2, 'maxPoints' => 3],
                    ['label' => 'On optimise un peu partout, au cas où', 'next' => 'dev_perf_2', 'tag' => 'perf-1-low', 'points' => 0, 'maxPoints' => 3],
                ],
            ],
            'dev_perf_2' => [
                'text' => 'Sur quoi portait votre dernière optimisation ?',
                'options' => [
                    ['label' => 'Un goulet identifié par des mesures', 'next' => 'dev_perf_3', 'tag' => 'perf-2-strong', 'points' => 3, 'maxPoints' => 3],
                    ['label' => 'Une zone que l’on suspectait', 'next' => 'dev_perf_3', 'tag' => 'perf-2-mid', 'points' => 2, 'maxPoints' => 3],
                    ['label' => 'Une mise à jour générale des outils', 'next' => 'dev_perf_3', 'tag' => 'perf-2-low', 'points' => 0, 'maxPoints' => 3],
                ],
            ],
            'dev_perf_3' => [
                'text' => 'Comment vérifiez-vous qu’une optimisation a réellement fonctionné ?',
                'options' => [
                    ['label' => 'Avec des indicateurs avant / après', 'next' => 'dev_perf_4', 'tag' => 'perf-3-strong', 'points' => 3, 'maxPoints' => 3],
                    ['label' => 'Au ressenti des utilisateurs', 'next' => 'dev_perf_4', 'tag' => 'perf-3-mid', 'points' => 2, 'maxPoints' => 3],
                    ['label' => 'On ne vérifie pas vraiment', 'next' => 'dev_perf_4', 'tag' => 'perf-3-low', 'points' => 0, 'maxPoints' => 3],
                ],
            ],
            'dev_perf_4' => [
                'text' => 'Six mois après un chantier de performance, que devient-elle ?',
                'options' => [
                    ['label' => 'Elle est suivie et elle tient', 'next' => 'dev_perf_5', 'tag' => 'perf-4-strong', 'points' => 3, 'maxPoints' => 3],
                    ['label' => 'Elle se dégrade doucement', 'next' => 'dev_perf_5', 'tag' => 'perf-4-mid', 'points' => 2, 'maxPoints' => 3],
                    ['label' => 'On ne regarde plus', 'next' => 'dev_perf_5', 'tag' => 'perf-4-low', 'points' => 0, 'maxPoints' => 3],
                ],
            ],
            'dev_perf_5' => [
                'text' => 'Qui arbitre entre coût, vitesse et confort d’usage chez vous ?',
                'options' => [
                    ['label' => 'Un dialogue entre business et technique', 'next' => 'result', 'tag' => 'perf-5-strong', 'points' => 3, 'maxPoints' => 3],
                    ['label' => 'La technique seule', 'next' => 'result', 'tag' => 'perf-5-mid', 'points' => 2, 'maxPoints' => 3],
                    ['label' => 'Personne clairement', 'next' => 'result', 'tag' => 'perf-5-low', 'points' => 0, 'maxPoints' => 3],
                ],
            ],
            'value_clarity' => [
                'text' => 'Pensez à votre dernière décision structurante : qu’est-ce qui l’a déclenchée ?',
                'options' => [
                    ['label' => 'Un problème précis, vécu et documenté', 'next' => 'value_performance', 'tag' => 'clarity-fact', 'points' => 2, 'maxPoints' => 2],
                    ['label' => 'Une intuition ou une opportunité', 'next' => 'value_performance', 'tag' => 'clarity-mid', 'points' => 1, 'maxPoints' => 2],
                    ['label' => 'Une urgence, il fallait agir vite', 'next' => 'value_performance', 'tag' => 'clarity-low', 'points' => 0, 'maxPoints' => 2],
                ],
            ],
            'value_performance' => [
                'text' => 'Quand votre système ralentit ou coûte trop cher, comment le savez-vous ?',
                'options' => [
                    ['label' => 'Des mesures suivies régulièrement', 'next' => 'value_sobriety', 'tag' => 'performance-fact', 'points' => 2, 'maxPoints' => 2],
                    ['label' => 'Des retours d’utilisateurs ou d’équipe', 'next' => 'value_sobriety', 'tag' => 'performance-mid', 'points' => 1, 'maxPoints' => 2],
                    ['label' => 'On ne le sait pas vraiment', 'next' => 'value_sobriety', 'tag' => 'performance-low', 'points' => 0, 'maxPoints' => 2],
                ],
            ],
            'value_sobriety' => [
                'text' => 'Ces six derniers mois, avez-vous supprimé ou simplifié quelque chose (outil, feature, process) ?',
                'options' => [
                    ['label' => 'Oui, concrètement', 'next' => 'value_pedagogy', 'tag' => 'sobriety-fact', 'points' => 2, 'maxPoints' => 2],
                    ['label' => 'On en a parlé, sans le faire', 'next' => 'value_pedagogy', 'tag' => 'sobriety-mid', 'points' => 1, 'maxPoints' => 2],
                    ['label' => 'Non, on a surtout ajouté', 'next' => 'value_pedagogy', 'tag' => 'sobriety-low', 'points' => 0, 'maxPoints' => 2],
                ],
            ],
            'value_pedagogy' => [
                'text' => 'La dernière décision technique importante : qui pouvait l’expliquer, à part son auteur ?',
                'options' => [
                    ['label' => 'Toute l’équipe, business compris', 'next' => 'value_system', 'tag' => 'pedagogy-fact', 'points' => 2, 'maxPoints' => 2],
                    ['label' => 'Les profils techniques seulement', 'next' => 'value_system', 'tag' => 'pedagogy-mid', 'points' => 1, 'maxPoints' => 2],
                    ['label' => 'Honnêtement, personne', 'next' => 'value_system', 'tag' => 'pedagogy-low', 'points' => 0, 'maxPoints' => 2],
                ],
            ],
            'value_system' => [
                'text' => 'Quand un problème traverse business, opérations et technique, que se passe-t-il ?',
                'options' => [
                    ['label' => 'On le traite ensemble, comme un tout', 'next' => 'result', 'tag' => 'system-fact', 'points' => 2, 'maxPoints' => 2],
                    ['label' => 'Chaque équipe traite sa partie', 'next' => 'result', 'tag' => 'system-mid', 'points' => 1, 'maxPoints' => 2],
                    ['label' => 'Il reste souvent sans propriétaire', 'next' => 'result', 'tag' => 'system-low', 'points' => 0, 'maxPoints' => 2],
                ],
            ],
        ],
        'verdicts' => [
            ['min' => 100, 'message' => 'Résonance pleine : on peut avancer naturellement.'],
            ['min' => 80, 'message' => 'Très belle résonance : un premier échange a du sens.'],
            ['min' => 60, 'message' => 'Le terrain est prometteur : un court cadrage peut confirmer la suite.'],
            ['min' => 40, 'message' => 'Le lien existe, mais il faudra clarifier le bon angle d’approche.'],
            ['min' => 0, 'message' => 'Le besoin semble appeler une autre forme d’accompagnement, plus juste pour vous.'],
        ],
    ],
    'en' => [
        'ui' => [
            'kicker' => 'First signal',
            'title' => 'Let’s see if we speak the same language',
            'intro' => 'A few concrete questions about your actual situation, to see whether our ways of working meet.',
            'entryLead' => 'Pick the ground that feels like yours.',
            'entryQuestion' => 'Which domain do you need help with?',
            'resultTitle' => 'Meeting point',
            'resultQuestion' => 'What this suggests',
            'back' => 'Back',
            'reset' => 'Reset',
            'cta' => 'Share my details',
            'ctaReferral' => 'Ask for referrals',
            'mailSubject' => 'MinusVortex meeting point',
        ],
        'universes' => [
            [
                'id' => 'universe-health',
                'label' => 'Health',
                'art' => 'health',
                'icon' => 'lotus',
                'path' => '/en/alignment-health.html',
                'statement' => 'In health contexts, performance matters only if it remains clear, reliable and gentle for the people using it.',
                'orientation' => 'Possible referrals: healthcare consultants, quality experts, care pathway specialists.',
                'entry_options' => [
                    ['label' => 'Mostly agree', 'next' => 'value_clarity', 'tag' => 'universe-agree', 'points' => 2, 'maxPoints' => 2],
                    ['label' => 'Disagree', 'next' => 'value_clarity', 'tag' => 'universe-disagree', 'points' => 0, 'maxPoints' => 2],
                ],
            ],
            [
                'id' => 'universe-finance',
                'label' => 'Finance',
                'art' => 'finance',
                'icon' => 'coins',
                'path' => '/en/alignment-finance.html',
                'statement' => 'In finance, structure matters more than agitation. The goal is readable, durable systems without theater.',
                'orientation' => 'Possible referrals: finance consultants, steering experts, line-of-business tools.',
                'entry_options' => [
                    ['label' => 'Mostly agree', 'next' => 'value_clarity', 'tag' => 'universe-agree', 'points' => 2, 'maxPoints' => 2],
                    ['label' => 'Disagree', 'next' => 'value_clarity', 'tag' => 'universe-disagree', 'points' => 0, 'maxPoints' => 2],
                ],
            ],
            [
                'id' => 'universe-dev',
                'label' => 'Development',
                'art' => 'dev',
                'icon' => 'spark',
                'path' => '/en/alignment-development.html',
                'statement' => 'In development, the default rhythm is often bigger and faster. Here, the priority is a cleaner motion: readable, useful and durable.',
                'orientation' => 'Possible referrals: product studios, no-code experts, fractional CTOs.',
                'entry_options' => [
                    ['label' => 'Mostly agree', 'next' => 'dev_scenario', 'tag' => 'universe-agree', 'points' => 2, 'maxPoints' => 2],
                    ['label' => 'Disagree', 'next' => 'dev_scenario', 'tag' => 'universe-disagree', 'points' => 0, 'maxPoints' => 2],
                ],
            ],
            [
                'id' => 'universe-mobility',
                'label' => 'Mobility',
                'art' => 'mobility',
                'icon' => 'plane',
                'path' => '/en/alignment-mobility.html',
                'statement' => 'In mobility, fluidity matters as much as speed. We simplify journeys before adding layers.',
                'orientation' => 'Possible referrals: journey experts, field operations, service-product teams.',
                'entry_options' => [
                    ['label' => 'Mostly agree', 'next' => 'value_clarity', 'tag' => 'universe-agree', 'points' => 2, 'maxPoints' => 2],
                    ['label' => 'Disagree', 'next' => 'value_clarity', 'tag' => 'universe-disagree', 'points' => 0, 'maxPoints' => 2],
                ],
            ],
            [
                'id' => 'universe-quality',
                'label' => 'Quality',
                'art' => 'quality',
                'icon' => 'check',
                'path' => '/en/alignment-quality.html',
                'statement' => 'Quality should not be a late layer. It should already live inside the way systems are designed, measured and transmitted.',
                'orientation' => 'Possible referrals: quality, audit, process reliability specialists.',
                'entry_options' => [
                    ['label' => 'Mostly agree', 'next' => 'value_clarity', 'tag' => 'universe-agree', 'points' => 2, 'maxPoints' => 2],
                    ['label' => 'Disagree', 'next' => 'value_clarity', 'tag' => 'universe-disagree', 'points' => 0, 'maxPoints' => 2],
                ],
            ],
            [
                'id' => 'universe-formation',
                'label' => 'Learning',
                'art' => 'formation',
                'icon' => 'screen',
                'path' => '/en/alignment-learning.html',
                'statement' => 'In learning contexts, clarity is not extra polish. It is what turns information into real progress.',
                'orientation' => 'Possible referrals: pedagogy, LMS, knowledge transfer specialists.',
                'entry_options' => [
                    ['label' => 'Mostly agree', 'next' => 'value_clarity', 'tag' => 'universe-agree', 'points' => 2, 'maxPoints' => 2],
                    ['label' => 'Disagree', 'next' => 'value_clarity', 'tag' => 'universe-disagree', 'points' => 0, 'maxPoints' => 2],
                ],
            ],
            [
                'id' => 'universe-ai',
                'label' => 'AI',
                'art' => 'ai',
                'icon' => 'spark',
                'path' => '/en/alignment-ai.html',
                'statement' => 'With AI, the real value is not putting it everywhere, but knowing where it truly helps, soberly and without illusion.',
                'orientation' => 'Possible referrals: useful AI integration, sober automation, safeguards.',
                'entry_options' => [
                    ['label' => 'Mostly agree', 'next' => 'value_clarity', 'tag' => 'universe-agree', 'points' => 2, 'maxPoints' => 2],
                    ['label' => 'Disagree', 'next' => 'value_clarity', 'tag' => 'universe-disagree', 'points' => 0, 'maxPoints' => 2],
                ],
            ],
        ],
        'nodes' => [
            'dev_scenario' => [
                'text' => 'Which development scenario best fits your current context?',
                'options' => [
                    ['label' => 'Product launch or evolution', 'next' => 'dev_launch_1', 'tag' => 'scenario-launch', 'points' => 0, 'maxPoints' => 0],
                    ['label' => 'Complex legacy modernization', 'next' => 'dev_legacy_1', 'tag' => 'scenario-legacy', 'points' => 0, 'maxPoints' => 0],
                    ['label' => 'Performance and sobriety optimization', 'next' => 'dev_perf_1', 'tag' => 'scenario-performance', 'points' => 0, 'maxPoints' => 0],
                ],
            ],
            'dev_launch_1' => [
                'text' => 'How has the need for your product been validated so far?',
                'options' => [
                    ['label' => 'Through real conversations with users', 'next' => 'dev_launch_2', 'tag' => 'launch-1-strong', 'points' => 3, 'maxPoints' => 3],
                    ['label' => 'Through studies or indirect feedback', 'next' => 'dev_launch_2', 'tag' => 'launch-1-mid', 'points' => 2, 'maxPoints' => 3],
                    ['label' => 'A strong conviction, not yet confronted', 'next' => 'dev_launch_2', 'tag' => 'launch-1-low', 'points' => 0, 'maxPoints' => 3],
                ],
            ],
            'dev_launch_2' => [
                'text' => 'What have you already put in the hands of real users?',
                'options' => [
                    ['label' => 'A product or prototype used in real conditions', 'next' => 'dev_launch_3', 'tag' => 'launch-2-strong', 'points' => 3, 'maxPoints' => 3],
                    ['label' => 'A demo or mockup tested internally', 'next' => 'dev_launch_3', 'tag' => 'launch-2-mid', 'points' => 2, 'maxPoints' => 3],
                    ['label' => 'Nothing yet', 'next' => 'dev_launch_3', 'tag' => 'launch-2-low', 'points' => 0, 'maxPoints' => 3],
                ],
            ],
            'dev_launch_3' => [
                'text' => 'When was the last time a feature was removed or turned down?',
                'options' => [
                    ['label' => 'Recently, based on real usage', 'next' => 'dev_launch_4', 'tag' => 'launch-3-strong', 'points' => 3, 'maxPoints' => 3],
                    ['label' => 'It happens, but rarely', 'next' => 'dev_launch_4', 'tag' => 'launch-3-mid', 'points' => 2, 'maxPoints' => 3],
                    ['label' => 'We never remove anything', 'next' => 'dev_launch_4', 'tag' => 'launch-3-low', 'points' => 0, 'maxPoints' => 3],
                ],
            ],
            'dev_launch_4' => [
                'text' => 'How long does it take today to ship a small change to production?',
                'options' => [
                    ['label' => 'A few hours to a few days', 'next' => 'dev_launch_5', 'tag' => 'launch-4-strong', 'points' => 3, 'maxPoints' => 3],
                    ['label' => 'A few weeks', 'next' => 'dev_launch_5', 'tag' => 'launch-4-mid', 'points' => 2, 'maxPoints' => 3],
                    ['label' => 'Hard to say, often very long', 'next' => 'dev_launch_5', 'tag' => 'launch-4-low', 'points' => 0, 'maxPoints' => 3],
                ],
            ],
            'dev_launch_5' => [
                'text' => 'Who actually understands your current roadmap?',
                'options' => [
                    ['label' => 'Business and technical teams alike', 'next' => 'result', 'tag' => 'launch-5-strong', 'points' => 3, 'maxPoints' => 3],
                    ['label' => 'Mostly the technical profiles', 'next' => 'result', 'tag' => 'launch-5-mid', 'points' => 2, 'maxPoints' => 3],
                    ['label' => 'It mostly lives in a few heads', 'next' => 'result', 'tag' => 'launch-5-low', 'points' => 0, 'maxPoints' => 3],
                ],
            ],
            'dev_legacy_1' => [
                'text' => 'How clear is your picture of the existing system today?',
                'options' => [
                    ['label' => 'Mapped: we know what depends on what', 'next' => 'dev_legacy_2', 'tag' => 'legacy-1-strong', 'points' => 3, 'maxPoints' => 3],
                    ['label' => 'Partial: some blind spots remain', 'next' => 'dev_legacy_2', 'tag' => 'legacy-1-mid', 'points' => 2, 'maxPoints' => 3],
                    ['label' => 'Nobody has the full picture', 'next' => 'dev_legacy_2', 'tag' => 'legacy-1-low', 'points' => 0, 'maxPoints' => 3],
                ],
            ],
            'dev_legacy_2' => [
                'text' => 'How did your last modernization attempt go?',
                'options' => [
                    ['label' => 'Step by step, woven into daily work', 'next' => 'dev_legacy_3', 'tag' => 'legacy-2-strong', 'points' => 3, 'maxPoints' => 3],
                    ['label' => 'A big dedicated project, hard to finish', 'next' => 'dev_legacy_3', 'tag' => 'legacy-2-mid', 'points' => 2, 'maxPoints' => 3],
                    ['label' => 'No real attempt yet', 'next' => 'dev_legacy_3', 'tag' => 'legacy-2-low', 'points' => 0, 'maxPoints' => 3],
                ],
            ],
            'dev_legacy_3' => [
                'text' => 'When a critical failure hits, what actually happens?',
                'options' => [
                    ['label' => 'We know where to look, impact stays contained', 'next' => 'dev_legacy_4', 'tag' => 'legacy-3-strong', 'points' => 3, 'maxPoints' => 3],
                    ['label' => 'A few key people know how to fix it', 'next' => 'dev_legacy_4', 'tag' => 'legacy-3-mid', 'points' => 2, 'maxPoints' => 3],
                    ['label' => 'It is a crisis every time', 'next' => 'dev_legacy_4', 'tag' => 'legacy-3-low', 'points' => 0, 'maxPoints' => 3],
                ],
            ],
            'dev_legacy_4' => [
                'text' => 'What drove the last big technical decision on this system?',
                'options' => [
                    ['label' => 'Long-term maintainability', 'next' => 'dev_legacy_5', 'tag' => 'legacy-4-strong', 'points' => 3, 'maxPoints' => 3],
                    ['label' => 'The deadline or budget of the moment', 'next' => 'dev_legacy_5', 'tag' => 'legacy-4-mid', 'points' => 2, 'maxPoints' => 3],
                    ['label' => 'Habit, or one person’s preference', 'next' => 'dev_legacy_5', 'tag' => 'legacy-4-low', 'points' => 0, 'maxPoints' => 3],
                ],
            ],
            'dev_legacy_5' => [
                'text' => 'If the person who knows the system best left tomorrow?',
                'options' => [
                    ['label' => 'Decisions are written down, it would hold', 'next' => 'result', 'tag' => 'legacy-5-strong', 'points' => 3, 'maxPoints' => 3],
                    ['label' => 'Hard, but manageable', 'next' => 'result', 'tag' => 'legacy-5-mid', 'points' => 2, 'maxPoints' => 3],
                    ['label' => 'It would be very serious', 'next' => 'result', 'tag' => 'legacy-5-low', 'points' => 0, 'maxPoints' => 3],
                ],
            ],
            'dev_perf_1' => [
                'text' => 'What is your most costly performance problem today?',
                'options' => [
                    ['label' => 'Identified and precisely measured', 'next' => 'dev_perf_2', 'tag' => 'perf-1-strong', 'points' => 3, 'maxPoints' => 3],
                    ['label' => 'Felt, but not measured yet', 'next' => 'dev_perf_2', 'tag' => 'perf-1-mid', 'points' => 2, 'maxPoints' => 3],
                    ['label' => 'We optimize a bit everywhere, just in case', 'next' => 'dev_perf_2', 'tag' => 'perf-1-low', 'points' => 0, 'maxPoints' => 3],
                ],
            ],
            'dev_perf_2' => [
                'text' => 'What did your last optimization target?',
                'options' => [
                    ['label' => 'A bottleneck identified by measurements', 'next' => 'dev_perf_3', 'tag' => 'perf-2-strong', 'points' => 3, 'maxPoints' => 3],
                    ['label' => 'An area we suspected', 'next' => 'dev_perf_3', 'tag' => 'perf-2-mid', 'points' => 2, 'maxPoints' => 3],
                    ['label' => 'A general tooling or infra update', 'next' => 'dev_perf_3', 'tag' => 'perf-2-low', 'points' => 0, 'maxPoints' => 3],
                ],
            ],
            'dev_perf_3' => [
                'text' => 'How do you check that an optimization actually worked?',
                'options' => [
                    ['label' => 'With before / after indicators', 'next' => 'dev_perf_4', 'tag' => 'perf-3-strong', 'points' => 3, 'maxPoints' => 3],
                    ['label' => 'By how it feels to users', 'next' => 'dev_perf_4', 'tag' => 'perf-3-mid', 'points' => 2, 'maxPoints' => 3],
                    ['label' => 'We do not really check', 'next' => 'dev_perf_4', 'tag' => 'perf-3-low', 'points' => 0, 'maxPoints' => 3],
                ],
            ],
            'dev_perf_4' => [
                'text' => 'Six months after a performance effort, what happens to it?',
                'options' => [
                    ['label' => 'It is monitored and it holds', 'next' => 'dev_perf_5', 'tag' => 'perf-4-strong', 'points' => 3, 'maxPoints' => 3],
                    ['label' => 'It slowly degrades', 'next' => 'dev_perf_5', 'tag' => 'perf-4-mid', 'points' => 2, 'maxPoints' => 3],
                    ['label' => 'We stop looking', 'next' => 'dev_perf_5', 'tag' => 'perf-4-low', 'points' => 0, 'maxPoints' => 3],
                ],
            ],
            'dev_perf_5' => [
                'text' => 'Who arbitrates between cost, speed and comfort of use?',
                'options' => [
                    ['label' => 'A dialogue between business and tech', 'next' => 'result', 'tag' => 'perf-5-strong', 'points' => 3, 'maxPoints' => 3],
                    ['label' => 'Tech alone', 'next' => 'result', 'tag' => 'perf-5-mid', 'points' => 2, 'maxPoints' => 3],
                    ['label' => 'Nobody clearly', 'next' => 'result', 'tag' => 'perf-5-low', 'points' => 0, 'maxPoints' => 3],
                ],
            ],
            'value_clarity' => [
                'text' => 'Think of your last structural decision: what triggered it?',
                'options' => [
                    ['label' => 'A precise problem, experienced and documented', 'next' => 'value_performance', 'tag' => 'clarity-fact', 'points' => 2, 'maxPoints' => 2],
                    ['label' => 'An intuition or an opportunity', 'next' => 'value_performance', 'tag' => 'clarity-mid', 'points' => 1, 'maxPoints' => 2],
                    ['label' => 'An emergency, we had to act fast', 'next' => 'value_performance', 'tag' => 'clarity-low', 'points' => 0, 'maxPoints' => 2],
                ],
            ],
            'value_performance' => [
                'text' => 'When your system slows down or costs too much, how do you know?',
                'options' => [
                    ['label' => 'Metrics we track regularly', 'next' => 'value_sobriety', 'tag' => 'performance-fact', 'points' => 2, 'maxPoints' => 2],
                    ['label' => 'User or team feedback', 'next' => 'value_sobriety', 'tag' => 'performance-mid', 'points' => 1, 'maxPoints' => 2],
                    ['label' => 'We do not really know', 'next' => 'value_sobriety', 'tag' => 'performance-low', 'points' => 0, 'maxPoints' => 2],
                ],
            ],
            'value_sobriety' => [
                'text' => 'In the last six months, have you removed or simplified anything (tool, feature, process)?',
                'options' => [
                    ['label' => 'Yes, concretely', 'next' => 'value_pedagogy', 'tag' => 'sobriety-fact', 'points' => 2, 'maxPoints' => 2],
                    ['label' => 'We talked about it, without doing it', 'next' => 'value_pedagogy', 'tag' => 'sobriety-mid', 'points' => 1, 'maxPoints' => 2],
                    ['label' => 'No, we mostly added things', 'next' => 'value_pedagogy', 'tag' => 'sobriety-low', 'points' => 0, 'maxPoints' => 2],
                ],
            ],
            'value_pedagogy' => [
                'text' => 'Your last major technical decision: who could explain it, besides its author?',
                'options' => [
                    ['label' => 'The whole team, business included', 'next' => 'value_system', 'tag' => 'pedagogy-fact', 'points' => 2, 'maxPoints' => 2],
                    ['label' => 'Only the technical profiles', 'next' => 'value_system', 'tag' => 'pedagogy-mid', 'points' => 1, 'maxPoints' => 2],
                    ['label' => 'Honestly, nobody', 'next' => 'value_system', 'tag' => 'pedagogy-low', 'points' => 0, 'maxPoints' => 2],
                ],
            ],
            'value_system' => [
                'text' => 'When a problem spans business, operations and tech, what happens?',
                'options' => [
                    ['label' => 'We treat it together, as one system', 'next' => 'result', 'tag' => 'system-fact', 'points' => 2, 'maxPoints' => 2],
                    ['label' => 'Each team handles its part', 'next' => 'result', 'tag' => 'system-mid', 'points' => 1, 'maxPoints' => 2],
                    ['label' => 'It often ends up with no owner', 'next' => 'result', 'tag' => 'system-low', 'points' => 0, 'maxPoints' => 2],
                ],
            ],
        ],
        'verdicts' => [
            ['min' => 100, 'message' => 'Full resonance: we should definitely connect.'],
            ['min' => 80, 'message' => 'Strong resonance: a direct conversation makes sense.'],
            ['min' => 60, 'message' => 'Clear alignment: a short framing step can confirm the path.'],
            ['min' => 40, 'message' => 'Partial alignment: I can redirect you to a better-fitted profile.'],
            ['min' => 0, 'message' => 'Low alignment for now: a specialized referral is likely wiser.'],
        ],
    ],
    'es' => [
        'ui' => [
            'kicker' => 'Primera vibración',
            'title' => 'Veamos si hablamos el mismo idioma',
            'intro' => 'Unas preguntas concretas sobre su situación real, para ver si nuestras maneras de trabajar se encuentran.',
            'entryLead' => 'Elija el terreno que más se le parece.',
            'entryQuestion' => '¿Por dónde empieza el impulso?',
            'resultTitle' => 'Punto de encuentro',
            'resultQuestion' => 'Lo que esto sugiere',
            'back' => 'Volver',
            'reset' => 'Empezar de nuevo',
            'cta' => 'Compartir mis datos',
            'ctaReferral' => 'Pedir una orientación',
            'mailSubject' => 'Punto de encuentro MinusVortex',
        ],
        'universes' => [
            [
                'id' => 'universe-health',
                'label' => 'Salud',
                'art' => 'health',
                'icon' => 'lotus',
                'path' => '/es/alineacion-salud.html',
                'statement' => 'En la salud, cada decisión tiene un aliento humano. El rendimiento solo tiene sentido si permanece claro, fiable y amable con quienes lo usan.',
                'orientation' => 'Orientación posible: consultores de salud, calidad, recorrido del paciente.',
                'entry_options' => [
                    ['label' => 'Bastante de acuerdo', 'next' => 'value_clarity', 'tag' => 'universe-agree', 'points' => 2, 'maxPoints' => 2],
                    ['label' => 'No estoy de acuerdo', 'next' => 'value_clarity', 'tag' => 'universe-disagree', 'points' => 0, 'maxPoints' => 2],
                ],
            ],
            [
                'id' => 'universe-finance',
                'label' => 'Negocio',
                'art' => 'finance',
                'icon' => 'coins',
                'path' => '/es/alineacion-negocio.html',
                'statement' => 'En el negocio, la estructura vale más que la agitación. Buscamos mecanismos legibles, duraderos y sin teatro innecesario.',
                'orientation' => 'Orientación posible: pilotaje, operaciones, herramientas de negocio y reducción del caos organizativo.',
                'entry_options' => [
                    ['label' => 'Bastante de acuerdo', 'next' => 'value_clarity', 'tag' => 'universe-agree', 'points' => 2, 'maxPoints' => 2],
                    ['label' => 'No estoy de acuerdo', 'next' => 'value_clarity', 'tag' => 'universe-disagree', 'points' => 0, 'maxPoints' => 2],
                ],
            ],
            [
                'id' => 'universe-dev',
                'label' => 'Desarrollo',
                'art' => 'dev',
                'icon' => 'spark',
                'path' => '/es/alineacion-desarrollo.html',
                'statement' => 'En el desarrollo, el mundo suele correr detrás de lo más rápido y lo más grande. Aquí preferimos un movimiento justo: legible, útil y duradero.',
                'orientation' => 'Orientación posible: estudios de producto, expertos no-code, CTO fraccional.',
                'entry_options' => [
                    ['label' => 'Bastante de acuerdo', 'next' => 'dev_scenario', 'tag' => 'universe-agree', 'points' => 2, 'maxPoints' => 2],
                    ['label' => 'No estoy de acuerdo', 'next' => 'dev_scenario', 'tag' => 'universe-disagree', 'points' => 0, 'maxPoints' => 2],
                ],
            ],
            [
                'id' => 'universe-mobility',
                'label' => 'Movilidad',
                'art' => 'mobility',
                'icon' => 'plane',
                'path' => '/es/alineacion-movilidad.html',
                'statement' => 'En la movilidad, la fluidez cuenta tanto como la velocidad. Simplificamos los recorridos antes de complejizar las herramientas.',
                'orientation' => 'Orientación posible: expertos en recorridos, operaciones de campo, productos de servicio.',
                'entry_options' => [
                    ['label' => 'Bastante de acuerdo', 'next' => 'value_clarity', 'tag' => 'universe-agree', 'points' => 2, 'maxPoints' => 2],
                    ['label' => 'No estoy de acuerdo', 'next' => 'value_clarity', 'tag' => 'universe-disagree', 'points' => 0, 'maxPoints' => 2],
                ],
            ],
            [
                'id' => 'universe-quality',
                'label' => 'Calidad',
                'art' => 'quality',
                'icon' => 'check',
                'path' => '/es/alineacion-calidad.html',
                'statement' => 'La calidad no debería ser una capa extra. Debería vivir ya en la manera de diseñar, medir y transmitir.',
                'orientation' => 'Orientación posible: calidad, auditoría, fiabilización de procesos.',
                'entry_options' => [
                    ['label' => 'Bastante de acuerdo', 'next' => 'value_clarity', 'tag' => 'universe-agree', 'points' => 2, 'maxPoints' => 2],
                    ['label' => 'No estoy de acuerdo', 'next' => 'value_clarity', 'tag' => 'universe-disagree', 'points' => 0, 'maxPoints' => 2],
                ],
            ],
            [
                'id' => 'universe-formation',
                'label' => 'Formación',
                'art' => 'formation',
                'icon' => 'screen',
                'path' => '/es/alineacion-formacion.html',
                'statement' => 'En la formación, la claridad no es un extra. Es lo que convierte la información en progreso real.',
                'orientation' => 'Orientación posible: pedagogía, LMS, transmisión de conocimiento.',
                'entry_options' => [
                    ['label' => 'Bastante de acuerdo', 'next' => 'value_clarity', 'tag' => 'universe-agree', 'points' => 2, 'maxPoints' => 2],
                    ['label' => 'No estoy de acuerdo', 'next' => 'value_clarity', 'tag' => 'universe-disagree', 'points' => 0, 'maxPoints' => 2],
                ],
            ],
            [
                'id' => 'universe-ai',
                'label' => 'IA',
                'art' => 'ai',
                'icon' => 'spark',
                'path' => '/es/alineacion-ia.html',
                'statement' => 'Con la IA, el verdadero valor no es ponerla en todas partes, sino saber dónde sirve de verdad, con sobriedad y sin ilusiones.',
                'orientation' => 'Orientación posible: integración útil de IA, automatización sobria, salvaguardas.',
                'entry_options' => [
                    ['label' => 'Bastante de acuerdo', 'next' => 'value_clarity', 'tag' => 'universe-agree', 'points' => 2, 'maxPoints' => 2],
                    ['label' => 'No estoy de acuerdo', 'next' => 'value_clarity', 'tag' => 'universe-disagree', 'points' => 0, 'maxPoints' => 2],
                ],
            ],
        ],
        'nodes' => [
            'dev_scenario' => [
                'text' => '¿Qué escenario de desarrollo se parece más a su contexto actual?',
                'options' => [
                    ['label' => 'Lanzamiento o evolución de producto digital', 'next' => 'dev_launch_1', 'tag' => 'scenario-launch', 'points' => 0, 'maxPoints' => 0],
                    ['label' => 'Modernización de un legacy complejo', 'next' => 'dev_legacy_1', 'tag' => 'scenario-legacy', 'points' => 0, 'maxPoints' => 0],
                    ['label' => 'Optimización de rendimiento y sobriedad', 'next' => 'dev_perf_1', 'tag' => 'scenario-performance', 'points' => 0, 'maxPoints' => 0],
                ],
            ],
            'dev_launch_1' => [
                'text' => '¿Cómo se ha validado hasta ahora la necesidad de su producto?',
                'options' => [
                    ['label' => 'Con conversaciones reales con usuarios', 'next' => 'dev_launch_2', 'tag' => 'launch-1-strong', 'points' => 3, 'maxPoints' => 3],
                    ['label' => 'Con estudios o retornos indirectos', 'next' => 'dev_launch_2', 'tag' => 'launch-1-mid', 'points' => 2, 'maxPoints' => 3],
                    ['label' => 'Con una convicción aún no confrontada', 'next' => 'dev_launch_2', 'tag' => 'launch-1-low', 'points' => 0, 'maxPoints' => 3],
                ],
            ],
            'dev_launch_2' => [
                'text' => '¿Qué ha puesto ya en manos de usuarios reales?',
                'options' => [
                    ['label' => 'Un producto o prototipo usado en condiciones reales', 'next' => 'dev_launch_3', 'tag' => 'launch-2-strong', 'points' => 3, 'maxPoints' => 3],
                    ['label' => 'Una demo o maqueta probada internamente', 'next' => 'dev_launch_3', 'tag' => 'launch-2-mid', 'points' => 2, 'maxPoints' => 3],
                    ['label' => 'Nada por ahora', 'next' => 'dev_launch_3', 'tag' => 'launch-2-low', 'points' => 0, 'maxPoints' => 3],
                ],
            ],
            'dev_launch_3' => [
                'text' => '¿Cuándo fue la última vez que se retiró o rechazó una funcionalidad?',
                'options' => [
                    ['label' => 'Hace poco, basándonos en el uso real', 'next' => 'dev_launch_4', 'tag' => 'launch-3-strong', 'points' => 3, 'maxPoints' => 3],
                    ['label' => 'Ha ocurrido, pero es raro', 'next' => 'dev_launch_4', 'tag' => 'launch-3-mid', 'points' => 2, 'maxPoints' => 3],
                    ['label' => 'Nunca quitamos nada', 'next' => 'dev_launch_4', 'tag' => 'launch-3-low', 'points' => 0, 'maxPoints' => 3],
                ],
            ],
            'dev_launch_4' => [
                'text' => 'Hoy, ¿cuánto tarda un cambio pequeño en llegar a producción?',
                'options' => [
                    ['label' => 'De unas horas a unos días', 'next' => 'dev_launch_5', 'tag' => 'launch-4-strong', 'points' => 3, 'maxPoints' => 3],
                    ['label' => 'Unas semanas', 'next' => 'dev_launch_5', 'tag' => 'launch-4-mid', 'points' => 2, 'maxPoints' => 3],
                    ['label' => 'Difícil de decir, a menudo mucho tiempo', 'next' => 'dev_launch_5', 'tag' => 'launch-4-low', 'points' => 0, 'maxPoints' => 3],
                ],
            ],
            'dev_launch_5' => [
                'text' => 'Su roadmap actual, ¿quién la entiende de verdad?',
                'options' => [
                    ['label' => 'Los equipos de negocio y los técnicos', 'next' => 'result', 'tag' => 'launch-5-strong', 'points' => 3, 'maxPoints' => 3],
                    ['label' => 'Sobre todo los perfiles técnicos', 'next' => 'result', 'tag' => 'launch-5-mid', 'points' => 2, 'maxPoints' => 3],
                    ['label' => 'Vive sobre todo en algunas cabezas', 'next' => 'result', 'tag' => 'launch-5-low', 'points' => 0, 'maxPoints' => 3],
                ],
            ],
            'dev_legacy_1' => [
                'text' => '¿Qué visión tiene hoy de su sistema existente?',
                'options' => [
                    ['label' => 'Cartografiada: sabemos qué depende de qué', 'next' => 'dev_legacy_2', 'tag' => 'legacy-1-strong', 'points' => 3, 'maxPoints' => 3],
                    ['label' => 'Parcial: quedan zonas de sombra', 'next' => 'dev_legacy_2', 'tag' => 'legacy-1-mid', 'points' => 2, 'maxPoints' => 3],
                    ['label' => 'Nadie tiene la visión de conjunto', 'next' => 'dev_legacy_2', 'tag' => 'legacy-1-low', 'points' => 0, 'maxPoints' => 3],
                ],
            ],
            'dev_legacy_2' => [
                'text' => '¿Cómo fue su último intento de modernización?',
                'options' => [
                    ['label' => 'Por etapas, integrado en el día a día', 'next' => 'dev_legacy_3', 'tag' => 'legacy-2-strong', 'points' => 3, 'maxPoints' => 3],
                    ['label' => 'Un gran proyecto dedicado, difícil de terminar', 'next' => 'dev_legacy_3', 'tag' => 'legacy-2-mid', 'points' => 2, 'maxPoints' => 3],
                    ['label' => 'Ningún intento real por ahora', 'next' => 'dev_legacy_3', 'tag' => 'legacy-2-low', 'points' => 0, 'maxPoints' => 3],
                ],
            ],
            'dev_legacy_3' => [
                'text' => 'Cuando ocurre una avería crítica, ¿qué pasa concretamente?',
                'options' => [
                    ['label' => 'Sabemos dónde buscar, el impacto queda aislado', 'next' => 'dev_legacy_4', 'tag' => 'legacy-3-strong', 'points' => 3, 'maxPoints' => 3],
                    ['label' => 'Algunas personas clave saben repararlo', 'next' => 'dev_legacy_4', 'tag' => 'legacy-3-mid', 'points' => 2, 'maxPoints' => 3],
                    ['label' => 'Es una crisis cada vez', 'next' => 'dev_legacy_4', 'tag' => 'legacy-3-low', 'points' => 0, 'maxPoints' => 3],
                ],
            ],
            'dev_legacy_4' => [
                'text' => '¿Qué motivó la última gran decisión técnica sobre este sistema?',
                'options' => [
                    ['label' => 'La mantenibilidad a largo plazo', 'next' => 'dev_legacy_5', 'tag' => 'legacy-4-strong', 'points' => 3, 'maxPoints' => 3],
                    ['label' => 'El plazo o el presupuesto del momento', 'next' => 'dev_legacy_5', 'tag' => 'legacy-4-mid', 'points' => 2, 'maxPoints' => 3],
                    ['label' => 'La costumbre o la preferencia de una persona', 'next' => 'dev_legacy_5', 'tag' => 'legacy-4-low', 'points' => 0, 'maxPoints' => 3],
                ],
            ],
            'dev_legacy_5' => [
                'text' => 'Si la persona que mejor conoce el sistema se fuera mañana…',
                'options' => [
                    ['label' => 'Las decisiones están escritas, aguantaría', 'next' => 'result', 'tag' => 'legacy-5-strong', 'points' => 3, 'maxPoints' => 3],
                    ['label' => 'Sería duro, pero manejable', 'next' => 'result', 'tag' => 'legacy-5-mid', 'points' => 2, 'maxPoints' => 3],
                    ['label' => 'Sería muy grave', 'next' => 'result', 'tag' => 'legacy-5-low', 'points' => 0, 'maxPoints' => 3],
                ],
            ],
            'dev_perf_1' => [
                'text' => '¿Cuál es hoy su problema de rendimiento más costoso?',
                'options' => [
                    ['label' => 'Identificado y medido con precisión', 'next' => 'dev_perf_2', 'tag' => 'perf-1-strong', 'points' => 3, 'maxPoints' => 3],
                    ['label' => 'Percibido, pero aún sin medir', 'next' => 'dev_perf_2', 'tag' => 'perf-1-mid', 'points' => 2, 'maxPoints' => 3],
                    ['label' => 'Optimizamos un poco por todas partes, por si acaso', 'next' => 'dev_perf_2', 'tag' => 'perf-1-low', 'points' => 0, 'maxPoints' => 3],
                ],
            ],
            'dev_perf_2' => [
                'text' => '¿A qué apuntaba su última optimización?',
                'options' => [
                    ['label' => 'Un cuello de botella identificado con mediciones', 'next' => 'dev_perf_3', 'tag' => 'perf-2-strong', 'points' => 3, 'maxPoints' => 3],
                    ['label' => 'Una zona que sospechábamos', 'next' => 'dev_perf_3', 'tag' => 'perf-2-mid', 'points' => 2, 'maxPoints' => 3],
                    ['label' => 'Una actualización general de herramientas', 'next' => 'dev_perf_3', 'tag' => 'perf-2-low', 'points' => 0, 'maxPoints' => 3],
                ],
            ],
            'dev_perf_3' => [
                'text' => '¿Cómo verifican que una optimización funcionó de verdad?',
                'options' => [
                    ['label' => 'Con indicadores antes / después', 'next' => 'dev_perf_4', 'tag' => 'perf-3-strong', 'points' => 3, 'maxPoints' => 3],
                    ['label' => 'Por la sensación de los usuarios', 'next' => 'dev_perf_4', 'tag' => 'perf-3-mid', 'points' => 2, 'maxPoints' => 3],
                    ['label' => 'No lo verificamos realmente', 'next' => 'dev_perf_4', 'tag' => 'perf-3-low', 'points' => 0, 'maxPoints' => 3],
                ],
            ],
            'dev_perf_4' => [
                'text' => 'Seis meses después de un trabajo de rendimiento, ¿qué ocurre?',
                'options' => [
                    ['label' => 'Se sigue midiendo y se mantiene', 'next' => 'dev_perf_5', 'tag' => 'perf-4-strong', 'points' => 3, 'maxPoints' => 3],
                    ['label' => 'Se degrada poco a poco', 'next' => 'dev_perf_5', 'tag' => 'perf-4-mid', 'points' => 2, 'maxPoints' => 3],
                    ['label' => 'Dejamos de mirar', 'next' => 'dev_perf_5', 'tag' => 'perf-4-low', 'points' => 0, 'maxPoints' => 3],
                ],
            ],
            'dev_perf_5' => [
                'text' => '¿Quién arbitra entre coste, velocidad y comodidad de uso?',
                'options' => [
                    ['label' => 'Un diálogo entre negocio y técnica', 'next' => 'result', 'tag' => 'perf-5-strong', 'points' => 3, 'maxPoints' => 3],
                    ['label' => 'Solo la técnica', 'next' => 'result', 'tag' => 'perf-5-mid', 'points' => 2, 'maxPoints' => 3],
                    ['label' => 'Nadie claramente', 'next' => 'result', 'tag' => 'perf-5-low', 'points' => 0, 'maxPoints' => 3],
                ],
            ],
            'value_clarity' => [
                'text' => 'Piense en su última decisión estructurante: ¿qué la desencadenó?',
                'options' => [
                    ['label' => 'Un problema preciso, vivido y documentado', 'next' => 'value_performance', 'tag' => 'clarity-fact', 'points' => 2, 'maxPoints' => 2],
                    ['label' => 'Una intuición o una oportunidad', 'next' => 'value_performance', 'tag' => 'clarity-mid', 'points' => 1, 'maxPoints' => 2],
                    ['label' => 'Una urgencia, había que actuar rápido', 'next' => 'value_performance', 'tag' => 'clarity-low', 'points' => 0, 'maxPoints' => 2],
                ],
            ],
            'value_performance' => [
                'text' => 'Cuando su sistema se ralentiza o cuesta demasiado, ¿cómo lo saben?',
                'options' => [
                    ['label' => 'Con mediciones seguidas regularmente', 'next' => 'value_sobriety', 'tag' => 'performance-fact', 'points' => 2, 'maxPoints' => 2],
                    ['label' => 'Por retornos de usuarios o del equipo', 'next' => 'value_sobriety', 'tag' => 'performance-mid', 'points' => 1, 'maxPoints' => 2],
                    ['label' => 'No lo sabemos realmente', 'next' => 'value_sobriety', 'tag' => 'performance-low', 'points' => 0, 'maxPoints' => 2],
                ],
            ],
            'value_sobriety' => [
                'text' => 'En los últimos seis meses, ¿han eliminado o simplificado algo (herramienta, funcionalidad, proceso)?',
                'options' => [
                    ['label' => 'Sí, concretamente', 'next' => 'value_pedagogy', 'tag' => 'sobriety-fact', 'points' => 2, 'maxPoints' => 2],
                    ['label' => 'Lo hemos hablado, sin hacerlo', 'next' => 'value_pedagogy', 'tag' => 'sobriety-mid', 'points' => 1, 'maxPoints' => 2],
                    ['label' => 'No, sobre todo hemos añadido', 'next' => 'value_pedagogy', 'tag' => 'sobriety-low', 'points' => 0, 'maxPoints' => 2],
                ],
            ],
            'value_pedagogy' => [
                'text' => 'La última decisión técnica importante: ¿quién podía explicarla, aparte de su autor?',
                'options' => [
                    ['label' => 'Todo el equipo, negocio incluido', 'next' => 'value_system', 'tag' => 'pedagogy-fact', 'points' => 2, 'maxPoints' => 2],
                    ['label' => 'Solo los perfiles técnicos', 'next' => 'value_system', 'tag' => 'pedagogy-mid', 'points' => 1, 'maxPoints' => 2],
                    ['label' => 'Sinceramente, nadie', 'next' => 'value_system', 'tag' => 'pedagogy-low', 'points' => 0, 'maxPoints' => 2],
                ],
            ],
            'value_system' => [
                'text' => 'Cuando un problema atraviesa negocio, operaciones y técnica, ¿qué pasa?',
                'options' => [
                    ['label' => 'Lo tratamos juntos, como un todo', 'next' => 'result', 'tag' => 'system-fact', 'points' => 2, 'maxPoints' => 2],
                    ['label' => 'Cada equipo trata su parte', 'next' => 'result', 'tag' => 'system-mid', 'points' => 1, 'maxPoints' => 2],
                    ['label' => 'A menudo se queda sin responsable', 'next' => 'result', 'tag' => 'system-low', 'points' => 0, 'maxPoints' => 2],
                ],
            ],
        ],
        'verdicts' => [
            ['min' => 100, 'message' => 'Resonancia plena: podemos avanzar con naturalidad.'],
            ['min' => 80, 'message' => 'Muy buena resonancia: un primer intercambio tiene sentido.'],
            ['min' => 60, 'message' => 'El terreno es prometedor: un breve encuadre puede confirmar el camino.'],
            ['min' => 40, 'message' => 'El vínculo existe, pero habrá que aclarar el ángulo adecuado.'],
            ['min' => 0, 'message' => 'La necesidad parece pedir otra forma de acompañamiento, más justa para usted.'],
        ],
    ],
    'pt' => [
        'ui' => [
            'kicker' => 'Primeira vibração',
            'title' => 'Vamos ver se falamos a mesma língua',
            'intro' => 'Algumas perguntas concretas sobre a sua situação real, para ver se as nossas formas de trabalhar se encontram.',
            'entryLead' => 'Escolha o terreno que mais se parece consigo.',
            'entryQuestion' => 'Por onde começa o impulso?',
            'resultTitle' => 'Ponto de encontro',
            'resultQuestion' => 'O que isto sugere',
            'back' => 'Voltar',
            'reset' => 'Recomeçar',
            'cta' => 'Partilhar os meus dados',
            'ctaReferral' => 'Pedir uma orientação',
            'mailSubject' => 'Ponto de encontro MinusVortex',
        ],
        'universes' => [
            [
                'id' => 'universe-health',
                'label' => 'Saúde',
                'art' => 'health',
                'icon' => 'lotus',
                'path' => '/pt/alinhamento-saude.html',
                'statement' => 'Na saúde, cada decisão tem um sopro humano. O desempenho só faz sentido se permanecer claro, fiável e suave para quem o utiliza.',
                'orientation' => 'Orientação possível: consultores de saúde, qualidade, percurso do paciente.',
                'entry_options' => [
                    ['label' => 'Concordo bastante', 'next' => 'value_clarity', 'tag' => 'universe-agree', 'points' => 2, 'maxPoints' => 2],
                    ['label' => 'Não concordo', 'next' => 'value_clarity', 'tag' => 'universe-disagree', 'points' => 0, 'maxPoints' => 2],
                ],
            ],
            [
                'id' => 'universe-finance',
                'label' => 'Negócio',
                'art' => 'finance',
                'icon' => 'coins',
                'path' => '/pt/alinhamento-negocio.html',
                'statement' => 'No negócio, a estrutura vale mais do que a agitação. Procuramos mecanismos legíveis, duradouros e sem teatro desnecessário.',
                'orientation' => 'Orientação possível: pilotagem, operações, ferramentas de negócio e redução do caos organizacional.',
                'entry_options' => [
                    ['label' => 'Concordo bastante', 'next' => 'value_clarity', 'tag' => 'universe-agree', 'points' => 2, 'maxPoints' => 2],
                    ['label' => 'Não concordo', 'next' => 'value_clarity', 'tag' => 'universe-disagree', 'points' => 0, 'maxPoints' => 2],
                ],
            ],
            [
                'id' => 'universe-dev',
                'label' => 'Desenvolvimento',
                'art' => 'dev',
                'icon' => 'spark',
                'path' => '/pt/alinhamento-desenvolvimento.html',
                'statement' => 'No desenvolvimento, o mundo corre muitas vezes atrás do mais rápido e do maior. Aqui, preferimos um movimento justo: legível, útil e duradouro.',
                'orientation' => 'Orientação possível: estúdios de produto, especialistas no-code, CTO fracionado.',
                'entry_options' => [
                    ['label' => 'Concordo bastante', 'next' => 'dev_scenario', 'tag' => 'universe-agree', 'points' => 2, 'maxPoints' => 2],
                    ['label' => 'Não concordo', 'next' => 'dev_scenario', 'tag' => 'universe-disagree', 'points' => 0, 'maxPoints' => 2],
                ],
            ],
            [
                'id' => 'universe-mobility',
                'label' => 'Mobilidade',
                'art' => 'mobility',
                'icon' => 'plane',
                'path' => '/pt/alinhamento-mobilidade.html',
                'statement' => 'Na mobilidade, a fluidez conta tanto como a velocidade. Simplificamos os percursos antes de complexificar as ferramentas.',
                'orientation' => 'Orientação possível: especialistas em percursos, operações de terreno, produtos de serviço.',
                'entry_options' => [
                    ['label' => 'Concordo bastante', 'next' => 'value_clarity', 'tag' => 'universe-agree', 'points' => 2, 'maxPoints' => 2],
                    ['label' => 'Não concordo', 'next' => 'value_clarity', 'tag' => 'universe-disagree', 'points' => 0, 'maxPoints' => 2],
                ],
            ],
            [
                'id' => 'universe-quality',
                'label' => 'Qualidade',
                'art' => 'quality',
                'icon' => 'check',
                'path' => '/pt/alinhamento-qualidade.html',
                'statement' => 'A qualidade não deveria ser uma camada extra. Deveria já viver na forma de conceber, medir e transmitir.',
                'orientation' => 'Orientação possível: qualidade, auditoria, fiabilização de processos.',
                'entry_options' => [
                    ['label' => 'Concordo bastante', 'next' => 'value_clarity', 'tag' => 'universe-agree', 'points' => 2, 'maxPoints' => 2],
                    ['label' => 'Não concordo', 'next' => 'value_clarity', 'tag' => 'universe-disagree', 'points' => 0, 'maxPoints' => 2],
                ],
            ],
            [
                'id' => 'universe-formation',
                'label' => 'Formação',
                'art' => 'formation',
                'icon' => 'screen',
                'path' => '/pt/alinhamento-formacao.html',
                'statement' => 'Na formação, a clareza não é um bónus. É o que transforma informação em progresso real.',
                'orientation' => 'Orientação possível: pedagogia, LMS, transmissão de saber.',
                'entry_options' => [
                    ['label' => 'Concordo bastante', 'next' => 'value_clarity', 'tag' => 'universe-agree', 'points' => 2, 'maxPoints' => 2],
                    ['label' => 'Não concordo', 'next' => 'value_clarity', 'tag' => 'universe-disagree', 'points' => 0, 'maxPoints' => 2],
                ],
            ],
            [
                'id' => 'universe-ai',
                'label' => 'IA',
                'art' => 'ai',
                'icon' => 'spark',
                'path' => '/pt/alinhamento-ia.html',
                'statement' => 'Com a IA, o verdadeiro valor não é colocá-la em todo o lado, mas saber onde serve de verdade, com sobriedade e sem ilusões.',
                'orientation' => 'Orientação possível: integração útil de IA, automatização sóbria, salvaguardas.',
                'entry_options' => [
                    ['label' => 'Concordo bastante', 'next' => 'value_clarity', 'tag' => 'universe-agree', 'points' => 2, 'maxPoints' => 2],
                    ['label' => 'Não concordo', 'next' => 'value_clarity', 'tag' => 'universe-disagree', 'points' => 0, 'maxPoints' => 2],
                ],
            ],
        ],
        'nodes' => [
            'dev_scenario' => [
                'text' => 'Que cenário de desenvolvimento se parece mais com o seu contexto atual?',
                'options' => [
                    ['label' => 'Lançamento ou evolução de produto digital', 'next' => 'dev_launch_1', 'tag' => 'scenario-launch', 'points' => 0, 'maxPoints' => 0],
                    ['label' => 'Modernização de um legacy complexo', 'next' => 'dev_legacy_1', 'tag' => 'scenario-legacy', 'points' => 0, 'maxPoints' => 0],
                    ['label' => 'Otimização de desempenho e sobriedade', 'next' => 'dev_perf_1', 'tag' => 'scenario-performance', 'points' => 0, 'maxPoints' => 0],
                ],
            ],
            'dev_launch_1' => [
                'text' => 'Como foi validada até agora a necessidade do seu produto?',
                'options' => [
                    ['label' => 'Com conversas reais com utilizadores', 'next' => 'dev_launch_2', 'tag' => 'launch-1-strong', 'points' => 3, 'maxPoints' => 3],
                    ['label' => 'Com estudos ou retornos indiretos', 'next' => 'dev_launch_2', 'tag' => 'launch-1-mid', 'points' => 2, 'maxPoints' => 3],
                    ['label' => 'Com uma convicção ainda não confrontada', 'next' => 'dev_launch_2', 'tag' => 'launch-1-low', 'points' => 0, 'maxPoints' => 3],
                ],
            ],
            'dev_launch_2' => [
                'text' => 'O que já colocou nas mãos de utilizadores reais?',
                'options' => [
                    ['label' => 'Um produto ou protótipo usado em condições reais', 'next' => 'dev_launch_3', 'tag' => 'launch-2-strong', 'points' => 3, 'maxPoints' => 3],
                    ['label' => 'Uma demo ou maquete testada internamente', 'next' => 'dev_launch_3', 'tag' => 'launch-2-mid', 'points' => 2, 'maxPoints' => 3],
                    ['label' => 'Nada por enquanto', 'next' => 'dev_launch_3', 'tag' => 'launch-2-low', 'points' => 0, 'maxPoints' => 3],
                ],
            ],
            'dev_launch_3' => [
                'text' => 'Quando foi a última vez que uma funcionalidade foi retirada ou recusada?',
                'options' => [
                    ['label' => 'Recentemente, com base no uso real', 'next' => 'dev_launch_4', 'tag' => 'launch-3-strong', 'points' => 3, 'maxPoints' => 3],
                    ['label' => 'Já aconteceu, mas é raro', 'next' => 'dev_launch_4', 'tag' => 'launch-3-mid', 'points' => 2, 'maxPoints' => 3],
                    ['label' => 'Nunca retiramos nada', 'next' => 'dev_launch_4', 'tag' => 'launch-3-low', 'points' => 0, 'maxPoints' => 3],
                ],
            ],
            'dev_launch_4' => [
                'text' => 'Hoje, quanto tempo demora uma pequena alteração a chegar a produção?',
                'options' => [
                    ['label' => 'De algumas horas a alguns dias', 'next' => 'dev_launch_5', 'tag' => 'launch-4-strong', 'points' => 3, 'maxPoints' => 3],
                    ['label' => 'Algumas semanas', 'next' => 'dev_launch_5', 'tag' => 'launch-4-mid', 'points' => 2, 'maxPoints' => 3],
                    ['label' => 'Difícil de dizer, muitas vezes muito tempo', 'next' => 'dev_launch_5', 'tag' => 'launch-4-low', 'points' => 0, 'maxPoints' => 3],
                ],
            ],
            'dev_launch_5' => [
                'text' => 'O seu roadmap atual, quem o compreende realmente?',
                'options' => [
                    ['label' => 'As equipas de negócio e as técnicas', 'next' => 'result', 'tag' => 'launch-5-strong', 'points' => 3, 'maxPoints' => 3],
                    ['label' => 'Sobretudo os perfis técnicos', 'next' => 'result', 'tag' => 'launch-5-mid', 'points' => 2, 'maxPoints' => 3],
                    ['label' => 'Vive sobretudo em algumas cabeças', 'next' => 'result', 'tag' => 'launch-5-low', 'points' => 0, 'maxPoints' => 3],
                ],
            ],
            'dev_legacy_1' => [
                'text' => 'Que visão tem hoje do seu sistema existente?',
                'options' => [
                    ['label' => 'Cartografada: sabemos o que depende de quê', 'next' => 'dev_legacy_2', 'tag' => 'legacy-1-strong', 'points' => 3, 'maxPoints' => 3],
                    ['label' => 'Parcial: restam zonas de sombra', 'next' => 'dev_legacy_2', 'tag' => 'legacy-1-mid', 'points' => 2, 'maxPoints' => 3],
                    ['label' => 'Ninguém tem a visão de conjunto', 'next' => 'dev_legacy_2', 'tag' => 'legacy-1-low', 'points' => 0, 'maxPoints' => 3],
                ],
            ],
            'dev_legacy_2' => [
                'text' => 'Como correu a sua última tentativa de modernização?',
                'options' => [
                    ['label' => 'Por etapas, integrada no dia a dia', 'next' => 'dev_legacy_3', 'tag' => 'legacy-2-strong', 'points' => 3, 'maxPoints' => 3],
                    ['label' => 'Um grande projeto dedicado, difícil de terminar', 'next' => 'dev_legacy_3', 'tag' => 'legacy-2-mid', 'points' => 2, 'maxPoints' => 3],
                    ['label' => 'Nenhuma tentativa real por enquanto', 'next' => 'dev_legacy_3', 'tag' => 'legacy-2-low', 'points' => 0, 'maxPoints' => 3],
                ],
            ],
            'dev_legacy_3' => [
                'text' => 'Quando surge uma falha crítica, o que acontece concretamente?',
                'options' => [
                    ['label' => 'Sabemos onde procurar, o impacto fica isolado', 'next' => 'dev_legacy_4', 'tag' => 'legacy-3-strong', 'points' => 3, 'maxPoints' => 3],
                    ['label' => 'Algumas pessoas-chave sabem reparar', 'next' => 'dev_legacy_4', 'tag' => 'legacy-3-mid', 'points' => 2, 'maxPoints' => 3],
                    ['label' => 'É uma crise de cada vez', 'next' => 'dev_legacy_4', 'tag' => 'legacy-3-low', 'points' => 0, 'maxPoints' => 3],
                ],
            ],
            'dev_legacy_4' => [
                'text' => 'O que motivou a última grande escolha técnica neste sistema?',
                'options' => [
                    ['label' => 'A manutenibilidade a longo prazo', 'next' => 'dev_legacy_5', 'tag' => 'legacy-4-strong', 'points' => 3, 'maxPoints' => 3],
                    ['label' => 'O prazo ou o orçamento do momento', 'next' => 'dev_legacy_5', 'tag' => 'legacy-4-mid', 'points' => 2, 'maxPoints' => 3],
                    ['label' => 'O hábito ou a preferência de uma pessoa', 'next' => 'dev_legacy_5', 'tag' => 'legacy-4-low', 'points' => 0, 'maxPoints' => 3],
                ],
            ],
            'dev_legacy_5' => [
                'text' => 'Se a pessoa que melhor conhece o sistema partisse amanhã?',
                'options' => [
                    ['label' => 'As decisões estão escritas, aguentaria', 'next' => 'result', 'tag' => 'legacy-5-strong', 'points' => 3, 'maxPoints' => 3],
                    ['label' => 'Seria difícil, mas gerível', 'next' => 'result', 'tag' => 'legacy-5-mid', 'points' => 2, 'maxPoints' => 3],
                    ['label' => 'Seria muito grave', 'next' => 'result', 'tag' => 'legacy-5-low', 'points' => 0, 'maxPoints' => 3],
                ],
            ],
            'dev_perf_1' => [
                'text' => 'Qual é hoje o seu problema de desempenho mais caro?',
                'options' => [
                    ['label' => 'Identificado e medido com precisão', 'next' => 'dev_perf_2', 'tag' => 'perf-1-strong', 'points' => 3, 'maxPoints' => 3],
                    ['label' => 'Sentido, mas ainda não medido', 'next' => 'dev_perf_2', 'tag' => 'perf-1-mid', 'points' => 2, 'maxPoints' => 3],
                    ['label' => 'Otimizamos um pouco por todo o lado, por precaução', 'next' => 'dev_perf_2', 'tag' => 'perf-1-low', 'points' => 0, 'maxPoints' => 3],
                ],
            ],
            'dev_perf_2' => [
                'text' => 'Qual foi o alvo da sua última otimização?',
                'options' => [
                    ['label' => 'Um gargalo identificado por medições', 'next' => 'dev_perf_3', 'tag' => 'perf-2-strong', 'points' => 3, 'maxPoints' => 3],
                    ['label' => 'Uma zona de que suspeitávamos', 'next' => 'dev_perf_3', 'tag' => 'perf-2-mid', 'points' => 2, 'maxPoints' => 3],
                    ['label' => 'Uma atualização geral de ferramentas', 'next' => 'dev_perf_3', 'tag' => 'perf-2-low', 'points' => 0, 'maxPoints' => 3],
                ],
            ],
            'dev_perf_3' => [
                'text' => 'Como verificam que uma otimização funcionou de verdade?',
                'options' => [
                    ['label' => 'Com indicadores antes / depois', 'next' => 'dev_perf_4', 'tag' => 'perf-3-strong', 'points' => 3, 'maxPoints' => 3],
                    ['label' => 'Pela sensação dos utilizadores', 'next' => 'dev_perf_4', 'tag' => 'perf-3-mid', 'points' => 2, 'maxPoints' => 3],
                    ['label' => 'Não verificamos realmente', 'next' => 'dev_perf_4', 'tag' => 'perf-3-low', 'points' => 0, 'maxPoints' => 3],
                ],
            ],
            'dev_perf_4' => [
                'text' => 'Seis meses depois de um trabalho de desempenho, o que acontece?',
                'options' => [
                    ['label' => 'É acompanhado e mantém-se', 'next' => 'dev_perf_5', 'tag' => 'perf-4-strong', 'points' => 3, 'maxPoints' => 3],
                    ['label' => 'Degrada-se lentamente', 'next' => 'dev_perf_5', 'tag' => 'perf-4-mid', 'points' => 2, 'maxPoints' => 3],
                    ['label' => 'Deixamos de olhar', 'next' => 'dev_perf_5', 'tag' => 'perf-4-low', 'points' => 0, 'maxPoints' => 3],
                ],
            ],
            'dev_perf_5' => [
                'text' => 'Quem arbitra entre custo, velocidade e conforto de uso?',
                'options' => [
                    ['label' => 'Um diálogo entre negócio e técnica', 'next' => 'result', 'tag' => 'perf-5-strong', 'points' => 3, 'maxPoints' => 3],
                    ['label' => 'Só a técnica', 'next' => 'result', 'tag' => 'perf-5-mid', 'points' => 2, 'maxPoints' => 3],
                    ['label' => 'Ninguém claramente', 'next' => 'result', 'tag' => 'perf-5-low', 'points' => 0, 'maxPoints' => 3],
                ],
            ],
            'value_clarity' => [
                'text' => 'Pense na sua última decisão estruturante: o que a desencadeou?',
                'options' => [
                    ['label' => 'Um problema preciso, vivido e documentado', 'next' => 'value_performance', 'tag' => 'clarity-fact', 'points' => 2, 'maxPoints' => 2],
                    ['label' => 'Uma intuição ou uma oportunidade', 'next' => 'value_performance', 'tag' => 'clarity-mid', 'points' => 1, 'maxPoints' => 2],
                    ['label' => 'Uma urgência, era preciso agir depressa', 'next' => 'value_performance', 'tag' => 'clarity-low', 'points' => 0, 'maxPoints' => 2],
                ],
            ],
            'value_performance' => [
                'text' => 'Quando o seu sistema abranda ou custa demasiado, como o sabem?',
                'options' => [
                    ['label' => 'Com medições acompanhadas regularmente', 'next' => 'value_sobriety', 'tag' => 'performance-fact', 'points' => 2, 'maxPoints' => 2],
                    ['label' => 'Por retornos de utilizadores ou da equipa', 'next' => 'value_sobriety', 'tag' => 'performance-mid', 'points' => 1, 'maxPoints' => 2],
                    ['label' => 'Não o sabemos realmente', 'next' => 'value_sobriety', 'tag' => 'performance-low', 'points' => 0, 'maxPoints' => 2],
                ],
            ],
            'value_sobriety' => [
                'text' => 'Nos últimos seis meses, eliminaram ou simplificaram algo (ferramenta, funcionalidade, processo)?',
                'options' => [
                    ['label' => 'Sim, concretamente', 'next' => 'value_pedagogy', 'tag' => 'sobriety-fact', 'points' => 2, 'maxPoints' => 2],
                    ['label' => 'Falámos disso, sem o fazer', 'next' => 'value_pedagogy', 'tag' => 'sobriety-mid', 'points' => 1, 'maxPoints' => 2],
                    ['label' => 'Não, sobretudo acrescentámos', 'next' => 'value_pedagogy', 'tag' => 'sobriety-low', 'points' => 0, 'maxPoints' => 2],
                ],
            ],
            'value_pedagogy' => [
                'text' => 'A última decisão técnica importante: quem podia explicá-la, além do seu autor?',
                'options' => [
                    ['label' => 'Toda a equipa, negócio incluído', 'next' => 'value_system', 'tag' => 'pedagogy-fact', 'points' => 2, 'maxPoints' => 2],
                    ['label' => 'Apenas os perfis técnicos', 'next' => 'value_system', 'tag' => 'pedagogy-mid', 'points' => 1, 'maxPoints' => 2],
                    ['label' => 'Sinceramente, ninguém', 'next' => 'value_system', 'tag' => 'pedagogy-low', 'points' => 0, 'maxPoints' => 2],
                ],
            ],
            'value_system' => [
                'text' => 'Quando um problema atravessa negócio, operações e técnica, o que acontece?',
                'options' => [
                    ['label' => 'Tratamo-lo em conjunto, como um todo', 'next' => 'result', 'tag' => 'system-fact', 'points' => 2, 'maxPoints' => 2],
                    ['label' => 'Cada equipa trata da sua parte', 'next' => 'result', 'tag' => 'system-mid', 'points' => 1, 'maxPoints' => 2],
                    ['label' => 'Fica muitas vezes sem responsável', 'next' => 'result', 'tag' => 'system-low', 'points' => 0, 'maxPoints' => 2],
                ],
            ],
        ],
        'verdicts' => [
            ['min' => 100, 'message' => 'Ressonância plena: podemos avançar com naturalidade.'],
            ['min' => 80, 'message' => 'Muito boa ressonância: uma primeira conversa faz sentido.'],
            ['min' => 60, 'message' => 'O terreno é promissor: um breve enquadramento pode confirmar o caminho.'],
            ['min' => 40, 'message' => 'A ligação existe, mas será preciso clarificar o ângulo certo.'],
            ['min' => 0, 'message' => 'A necessidade parece pedir outra forma de acompanhamento, mais justa para si.'],
        ],
    ],
];
