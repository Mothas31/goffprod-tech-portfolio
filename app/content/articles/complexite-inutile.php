<?php

return [
    'id' => 'complexite-inutile',
    'theme' => 'universe-quality',
    'date' => '2026-07-01',
    'slugs' => [
        'fr' => 'complexite-inutile-le-prix-du-au-cas-ou.html',
        'en' => 'needless-complexity-the-price-of-just-in-case.html',
        'es' => 'complejidad-inutil-el-precio-del-por-si-acaso.html',
        'pt' => 'complexidade-inutil-o-preco-do-por-precaucao.html',
    ],
    'i18n' => [
        'fr' => [
            'title' => 'Complexité inutile : le prix du « au cas où »',
            'description' => 'Chaque couche ajoutée « au cas où » se paie tous les jours : en lecture, en tests, en onboarding. Comment reconnaître la complexité qui ne sert personne.',
            'body' => <<<'HTML'
<p>La complexité inutile ne naît presque jamais d’une mauvaise intention. Elle naît d’une bonne : « au cas où on aurait besoin de plusieurs bases de données », « au cas où il faudrait brancher un autre prestataire », « au cas où l’équipe grossit ». Chaque « au cas où » ajoute une couche. Et chaque couche se paie — pas le jour où on l’écrit, mais tous les jours d’après.</p>
<h2>Le coût est quotidien, le bénéfice est hypothétique</h2>
<p>Une abstraction « au cas où » se lit à chaque debug, se contourne à chaque évolution, s’explique à chaque arrivée dans l’équipe. Le scénario qu’elle prépare, lui, n’arrive souvent jamais — ou arrive sous une forme que l’abstraction n’avait pas prévue, et il faut la défaire quand même.</p>
<h2>Trois questions pour trier</h2>
<p>Devant une couche existante ou une couche qu’on s’apprête à écrire : est-ce qu’un cas réel l’utilise aujourd’hui ? Si on la retirait, qu’est-ce qui casserait concrètement ? Est-ce que la personne qui lira ce code dans un an comprendra pourquoi elle existe sans qu’on lui explique ? Trois « non » = une couche à retirer.</p>
<h2>La sobriété n’est pas la naïveté</h2>
<p>Il ne s’agit pas d’écrire du code simpliste qui ignore les vrais besoins. Il s’agit d’attendre que le besoin existe pour le payer. Un système sobre peut accueillir de la complexité — quand elle est justifiée par un cas réel, elle s’intègre proprement. C’est la complexité spéculative qui pourrit : elle structure le code autour de scénarios imaginaires.</p>
HTML,
        ],
        'en' => [
            'title' => 'Needless complexity: the price of “just in case”',
            'description' => 'Every layer added “just in case” is paid for daily: in reading, testing, onboarding. How to spot the complexity that serves no one.',
            'body' => <<<'HTML'
<p>Needless complexity is almost never born from bad intent. It is born from good intent: “in case we need multiple databases”, “in case we plug in another provider”, “in case the team grows”. Every “just in case” adds a layer. And every layer is paid for — not the day you write it, but every day after.</p>
<h2>The cost is daily, the benefit is hypothetical</h2>
<p>A “just in case” abstraction is read at every debug session, worked around at every change, explained at every onboarding. The scenario it prepares for often never happens — or happens in a shape the abstraction did not anticipate, and you have to undo it anyway.</p>
<h2>Three questions to sort it out</h2>
<p>Facing an existing layer, or one you are about to write: does a real case use it today? If you removed it, what would concretely break? Will the person reading this code in a year understand why it exists without being told? Three “no”s = a layer to remove.</p>
<h2>Sobriety is not naivety</h2>
<p>This is not about writing simplistic code that ignores real needs. It is about waiting for the need to exist before paying for it. A sober system can host complexity — when justified by a real case, it integrates cleanly. It is speculative complexity that rots: it structures the code around imaginary scenarios.</p>
HTML,
        ],
        'es' => [
            'title' => 'Complejidad inútil: el precio del «por si acaso»',
            'description' => 'Cada capa añadida «por si acaso» se paga a diario: al leer, al testear, al incorporar gente. Cómo reconocer la complejidad que no sirve a nadie.',
            'body' => <<<'HTML'
<p>La complejidad inútil casi nunca nace de una mala intención. Nace de una buena: «por si necesitamos varias bases de datos», «por si conectamos otro proveedor», «por si el equipo crece». Cada «por si acaso» añade una capa. Y cada capa se paga — no el día que se escribe, sino todos los días siguientes.</p>
<h2>El coste es diario, el beneficio es hipotético</h2>
<p>Una abstracción «por si acaso» se lee en cada debug, se rodea en cada evolución, se explica en cada incorporación. El escenario que prepara, en cambio, muchas veces nunca llega — o llega con una forma que la abstracción no había previsto, y hay que deshacerla igualmente.</p>
<h2>Tres preguntas para filtrar</h2>
<p>Ante una capa existente o una que estás a punto de escribir: ¿la usa hoy un caso real? Si la quitaras, ¿qué se rompería concretamente? ¿La persona que lea este código dentro de un año entenderá por qué existe sin que se lo expliquen? Tres «no» = una capa que quitar.</p>
<h2>La sobriedad no es ingenuidad</h2>
<p>No se trata de escribir código simplista que ignore las necesidades reales. Se trata de esperar a que la necesidad exista antes de pagarla. Un sistema sobrio puede acoger complejidad — cuando la justifica un caso real, se integra limpiamente. La que pudre es la complejidad especulativa: estructura el código alrededor de escenarios imaginarios.</p>
HTML,
        ],
        'pt' => [
            'title' => 'Complexidade inútil: o preço do «por precaução»',
            'description' => 'Cada camada acrescentada «por precaução» paga-se todos os dias: na leitura, nos testes, no onboarding. Como reconhecer a complexidade que não serve ninguém.',
            'body' => <<<'HTML'
<p>A complexidade inútil quase nunca nasce de má intenção. Nasce de uma boa: «caso precisemos de várias bases de dados», «caso liguemos outro fornecedor», «caso a equipa cresça». Cada «por precaução» acrescenta uma camada. E cada camada paga-se — não no dia em que se escreve, mas todos os dias seguintes.</p>
<h2>O custo é diário, o benefício é hipotético</h2>
<p>Uma abstração «por precaução» lê-se em cada debug, contorna-se em cada evolução, explica-se em cada chegada à equipa. O cenário que ela prepara, esse, muitas vezes nunca chega — ou chega com uma forma que a abstração não previu, e é preciso desfazê-la na mesma.</p>
<h2>Três perguntas para filtrar</h2>
<p>Perante uma camada existente ou uma que está prestes a escrever: um caso real usa-a hoje? Se a retirasse, o que partiria concretamente? A pessoa que ler este código daqui a um ano perceberá porque existe sem que lho expliquem? Três «não» = uma camada a retirar.</p>
<h2>A sobriedade não é ingenuidade</h2>
<p>Não se trata de escrever código simplista que ignora necessidades reais. Trata-se de esperar que a necessidade exista antes de a pagar. Um sistema sóbrio pode acolher complexidade — quando justificada por um caso real, integra-se de forma limpa. O que apodrece é a complexidade especulativa: estrutura o código à volta de cenários imaginários.</p>
HTML,
        ],
    ],
];
