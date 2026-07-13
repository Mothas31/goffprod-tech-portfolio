<?php

return [
    'id' => 'dette-technique-signaux',
    'date' => '2026-07-13',
    'slugs' => [
        'fr' => 'dette-technique-3-signaux.html',
        'en' => 'technical-debt-3-signals.html',
        'es' => 'deuda-tecnica-3-senales.html',
        'pt' => 'divida-tecnica-3-sinais.html',
    ],
    'i18n' => [
        'fr' => [
            'title' => 'Dette technique : 3 signaux qui coûtent avant de se voir',
            'description' => 'La dette technique ne se voit pas dans le code d’abord — elle se voit dans le quotidien de l’équipe. Trois signaux concrets pour la détecter avant qu’elle ne coûte cher.',
            'body' => <<<'HTML'
<p>La dette technique ne se présente jamais comme telle. Personne n’écrit « ceci est de la dette » dans un commit. Elle se voit d’abord dans le quotidien : des tâches simples qui prennent trois jours, des mises en production qui font peur, des « on ne touche pas à ce fichier ».</p>
<h2>1. Le coût des petites modifications augmente</h2>
<p>Le signal le plus fiable : comparez ce que coûte aujourd’hui un changement trivial — un libellé, un champ de formulaire — avec ce qu’il coûtait il y a six mois. Si la tendance monte alors que le produit n’a pas changé d’échelle, la structure du code résiste au changement. C’est la définition opérationnelle de la dette.</p>
<h2>2. Les mêmes bugs reviennent sous d’autres formes</h2>
<p>Un bug corrigé qui réapparaît ailleurs n’est pas un hasard : c’est une logique dupliquée ou une responsabilité mal placée. Chaque correction locale ajoute une variante de plus à maintenir. Le vrai correctif n’est presque jamais là où le bug se manifeste.</p>
<h2>3. Le savoir est dans des têtes, pas dans le système</h2>
<p>Si le déploiement, la configuration ou « pourquoi ce module marche comme ça » dépendent d’une personne précise, le système n’est pas transférable. Ce n’est pas un problème de documentation d’abord — c’est un signe que le système est trop complexe pour être expliqué simplement.</p>
<h2>Par où commencer</h2>
<p>Pas par un « grand refactoring ». Mesurez une chose : le temps réel des petites modifications. Puis retirez — une duplication, une dépendance, une étape manuelle — à chaque passage. La sobriété n’est pas un chantier, c’est une pratique.</p>
HTML,
        ],
        'en' => [
            'title' => 'Technical debt: 3 signals that cost you before you see them',
            'description' => 'Technical debt shows up in the team’s daily work before it shows up in the code. Three concrete signals to detect it before it gets expensive.',
            'body' => <<<'HTML'
<p>Technical debt never introduces itself. Nobody writes “this is debt” in a commit. You see it first in daily work: simple tasks taking three days, deployments people fear, files nobody dares to touch.</p>
<h2>1. Small changes keep getting more expensive</h2>
<p>The most reliable signal: compare what a trivial change costs today — a label, a form field — with six months ago. If the trend rises while the product hasn’t changed scale, the code structure is resisting change. That is the operational definition of debt.</p>
<h2>2. The same bugs come back in different shapes</h2>
<p>A fixed bug reappearing elsewhere is not bad luck: it is duplicated logic or a misplaced responsibility. Every local fix adds one more variant to maintain. The real fix is almost never where the bug shows up.</p>
<h2>3. Knowledge lives in heads, not in the system</h2>
<p>If deployment, configuration, or “why this module works that way” depend on one specific person, the system is not transferable. That is not primarily a documentation problem — it is a sign the system is too complex to explain simply.</p>
<h2>Where to start</h2>
<p>Not with a “big refactoring”. Measure one thing: the real time small changes take. Then remove — one duplication, one dependency, one manual step — every time you pass through. Sobriety is not a project, it is a practice.</p>
HTML,
        ],
        'es' => [
            'title' => 'Deuda técnica: 3 señales que cuestan antes de verse',
            'description' => 'La deuda técnica aparece en el día a día del equipo antes que en el código. Tres señales concretas para detectarla antes de que salga cara.',
            'body' => <<<'HTML'
<p>La deuda técnica nunca se presenta como tal. Nadie escribe «esto es deuda» en un commit. Se ve primero en el día a día: tareas simples que llevan tres días, despliegues que dan miedo, archivos que nadie se atreve a tocar.</p>
<h2>1. Los cambios pequeños cuestan cada vez más</h2>
<p>La señal más fiable: compara lo que cuesta hoy un cambio trivial — una etiqueta, un campo de formulario — con hace seis meses. Si la tendencia sube sin que el producto haya cambiado de escala, la estructura del código se resiste al cambio. Esa es la definición operativa de la deuda.</p>
<h2>2. Los mismos bugs vuelven con otras formas</h2>
<p>Un bug corregido que reaparece en otro sitio no es mala suerte: es lógica duplicada o una responsabilidad mal ubicada. Cada arreglo local añade una variante más que mantener. El arreglo real casi nunca está donde el bug se manifiesta.</p>
<h2>3. El conocimiento vive en cabezas, no en el sistema</h2>
<p>Si el despliegue, la configuración o «por qué este módulo funciona así» dependen de una persona concreta, el sistema no es transferible. No es primero un problema de documentación: es señal de que el sistema es demasiado complejo para explicarse de forma simple.</p>
<h2>Por dónde empezar</h2>
<p>No por un «gran refactoring». Mide una cosa: el tiempo real de los cambios pequeños. Luego quita — una duplicación, una dependencia, un paso manual — cada vez que pases por ahí. La sobriedad no es una obra, es una práctica.</p>
HTML,
        ],
        'pt' => [
            'title' => 'Dívida técnica: 3 sinais que custam antes de se verem',
            'description' => 'A dívida técnica aparece no dia a dia da equipa antes de aparecer no código. Três sinais concretos para a detetar antes de ficar cara.',
            'body' => <<<'HTML'
<p>A dívida técnica nunca se apresenta como tal. Ninguém escreve «isto é dívida» num commit. Vê-se primeiro no dia a dia: tarefas simples que levam três dias, deploys que metem medo, ficheiros em que ninguém ousa tocar.</p>
<h2>1. As pequenas alterações custam cada vez mais</h2>
<p>O sinal mais fiável: compare o que custa hoje uma alteração trivial — um texto, um campo de formulário — com há seis meses. Se a tendência sobe sem que o produto tenha mudado de escala, a estrutura do código resiste à mudança. É a definição operacional de dívida.</p>
<h2>2. Os mesmos bugs voltam com outras formas</h2>
<p>Um bug corrigido que reaparece noutro sítio não é azar: é lógica duplicada ou uma responsabilidade mal colocada. Cada correção local acrescenta mais uma variante para manter. A correção real quase nunca está onde o bug se manifesta.</p>
<h2>3. O conhecimento vive em cabeças, não no sistema</h2>
<p>Se o deploy, a configuração ou «porque é que este módulo funciona assim» dependem de uma pessoa específica, o sistema não é transferível. Não é primeiro um problema de documentação — é sinal de que o sistema é demasiado complexo para se explicar de forma simples.</p>
<h2>Por onde começar</h2>
<p>Não por um «grande refactoring». Meça uma coisa: o tempo real das pequenas alterações. Depois retire — uma duplicação, uma dependência, um passo manual — de cada vez que lá passar. A sobriedade não é uma obra, é uma prática.</p>
HTML,
        ],
    ],
];
