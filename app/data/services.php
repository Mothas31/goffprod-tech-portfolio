<?php
declare(strict_types=1);

// Services affichés dans le carrousel de la home.
// 'qa' : scénario du questionnaire Développement (tag "scenario-<qa>" dans
// prequal_tree.php) ouvert directement via ?s=<qa>. null -> contact direct.
return [
    'fr' => [
        'ui' => [
            'qa' => 'Faire le point (3 min)',
            'contact' => 'Me contacter',
            'close' => 'Fermer',
        ],
        'items' => [
            [
                'id' => 'legacy',
                'qa' => 'legacy',
                'title' => 'Reprise et modernisation de legacy',
                'text' => 'Votre application PHP/Laravel vieillit, chaque évolution coûte plus cher et plus personne n’ose y toucher. Je la reprends, je la cartographie et je la modernise par étapes, sans tout réécrire.',
            ],
            [
                'id' => 'apps',
                'qa' => 'launch',
                'title' => 'Applications métier sur mesure',
                'text' => 'Un outil interne ou un produit à faire évoluer : je transforme le besoin réel en fonctionnalités Laravel livrées, testées et maintenables.',
            ],
            [
                'id' => 'performance',
                'qa' => 'performance',
                'title' => 'Performance et fiabilité',
                'text' => 'Pages lentes, requêtes SQL lourdes, mises en production stressantes : je mesure, je corrige ce qui compte et je sécurise l’exploitation (Linux, Nginx, déploiement).',
            ],
            [
                'id' => 'integrations',
                'qa' => null,
                'title' => 'Intégrations et migrations',
                'text' => 'ERP, API comptables, facture électronique, services tiers : je connecte vos outils existants aux nouvelles contraintes, sans bouleverser vos habitudes de travail.',
            ],
            [
                'id' => 'reinforcement',
                'qa' => null,
                'title' => 'Renfort Laravel pour agences et ESN',
                'text' => 'Trop de projets pour votre équipe ? J’interviens en sous-traitance ou en marque blanche sur vos projets PHP/Laravel, en français ou en anglais, à distance depuis Lisbonne.',
            ],
            [
                'id' => 'ai',
                'qa' => null,
                'title' => 'Développement assisté par IA',
                'text' => 'Livrer plus vite avec des agents IA, sans perdre le contrôle : cadrage, revue, tests et responsabilité humaine sur chaque livraison, pour vos projets ou aux côtés de votre équipe.',
            ],
        ],
    ],
    'en' => [
        'ui' => [
            'qa' => 'Quick check (3 min)',
            'contact' => 'Contact me',
            'close' => 'Close',
        ],
        'items' => [
            [
                'id' => 'legacy',
                'qa' => 'legacy',
                'title' => 'Legacy takeover and modernization',
                'text' => 'Your PHP/Laravel application is ageing, every change costs more and nobody dares to touch it anymore. I take it over, map it and modernize it step by step, without a full rewrite.',
            ],
            [
                'id' => 'apps',
                'qa' => 'launch',
                'title' => 'Custom business applications',
                'text' => 'An internal tool or a product that needs to grow: I turn the real need into Laravel features that are shipped, tested and maintainable.',
            ],
            [
                'id' => 'performance',
                'qa' => 'performance',
                'title' => 'Performance and reliability',
                'text' => 'Slow pages, heavy SQL queries, stressful releases: I measure, fix what matters and secure operations (Linux, Nginx, deployment).',
            ],
            [
                'id' => 'integrations',
                'qa' => null,
                'title' => 'Integrations and migrations',
                'text' => 'ERPs, accounting APIs, e-invoicing, third-party services: I connect your existing tools to new requirements without disrupting the way you work.',
            ],
            [
                'id' => 'reinforcement',
                'qa' => null,
                'title' => 'Laravel reinforcement for agencies',
                'text' => 'Too many projects for your team? I work as a subcontractor or white-label developer on your PHP/Laravel projects, in English or French, remotely from Lisbon.',
            ],
            [
                'id' => 'ai',
                'qa' => null,
                'title' => 'AI-assisted development',
                'text' => 'Ship faster with AI agents without losing control: scoping, review, tests and human ownership of every delivery, on your projects or alongside your team.',
            ],
        ],
    ],
    'es' => [
        'ui' => [
            'qa' => 'Hacer balance (3 min)',
            'contact' => 'Contactarme',
            'close' => 'Cerrar',
        ],
        'items' => [
            [
                'id' => 'legacy',
                'qa' => 'legacy',
                'title' => 'Recuperación y modernización de legacy',
                'text' => 'Tu aplicación PHP/Laravel envejece, cada evolución cuesta más y nadie se atreve ya a tocarla. La retomo, la mapeo y la modernizo por etapas, sin reescribirlo todo.',
            ],
            [
                'id' => 'apps',
                'qa' => 'launch',
                'title' => 'Aplicaciones de negocio a medida',
                'text' => 'Una herramienta interna o un producto que debe evolucionar: convierto la necesidad real en funcionalidades Laravel entregadas, probadas y mantenibles.',
            ],
            [
                'id' => 'performance',
                'qa' => 'performance',
                'title' => 'Rendimiento y fiabilidad',
                'text' => 'Páginas lentas, consultas SQL pesadas, puestas en producción estresantes: mido, corrijo lo que importa y aseguro la operación (Linux, Nginx, despliegue).',
            ],
            [
                'id' => 'integrations',
                'qa' => null,
                'title' => 'Integraciones y migraciones',
                'text' => 'ERP, API contables, facturación electrónica, servicios de terceros: conecto tus herramientas existentes a las nuevas exigencias sin alterar tu forma de trabajar.',
            ],
            [
                'id' => 'reinforcement',
                'qa' => null,
                'title' => 'Refuerzo Laravel para agencias',
                'text' => '¿Demasiados proyectos para tu equipo? Intervengo como subcontratista o en marca blanca en tus proyectos PHP/Laravel, en francés o inglés, en remoto desde Lisboa.',
            ],
            [
                'id' => 'ai',
                'qa' => null,
                'title' => 'Desarrollo asistido por IA',
                'text' => 'Entregar más rápido con agentes de IA sin perder el control: definición, revisión, pruebas y responsabilidad humana en cada entrega, en tus proyectos o junto a tu equipo.',
            ],
        ],
    ],
    'pt' => [
        'ui' => [
            'qa' => 'Fazer o ponto (3 min)',
            'contact' => 'Contactar-me',
            'close' => 'Fechar',
        ],
        'items' => [
            [
                'id' => 'legacy',
                'qa' => 'legacy',
                'title' => 'Recuperação e modernização de legacy',
                'text' => 'A sua aplicação PHP/Laravel está a envelhecer, cada evolução custa mais e já ninguém se atreve a mexer nela. Retomo-a, mapeio-a e modernizo-a por etapas, sem reescrever tudo.',
            ],
            [
                'id' => 'apps',
                'qa' => 'launch',
                'title' => 'Aplicações de negócio à medida',
                'text' => 'Uma ferramenta interna ou um produto que precisa de evoluir: transformo a necessidade real em funcionalidades Laravel entregues, testadas e fáceis de manter.',
            ],
            [
                'id' => 'performance',
                'qa' => 'performance',
                'title' => 'Performance e fiabilidade',
                'text' => 'Páginas lentas, consultas SQL pesadas, entradas em produção stressantes: meço, corrijo o que importa e asseguro a operação (Linux, Nginx, deploy).',
            ],
            [
                'id' => 'integrations',
                'qa' => null,
                'title' => 'Integrações e migrações',
                'text' => 'ERP, API de contabilidade, faturação eletrónica, serviços de terceiros: ligo as suas ferramentas existentes às novas exigências sem alterar a forma como trabalha.',
            ],
            [
                'id' => 'reinforcement',
                'qa' => null,
                'title' => 'Reforço Laravel para agências',
                'text' => 'Demasiados projetos para a sua equipa? Trabalho em subcontratação ou em white label nos seus projetos PHP/Laravel, em francês ou inglês, remotamente a partir de Lisboa.',
            ],
            [
                'id' => 'ai',
                'qa' => null,
                'title' => 'Desenvolvimento assistido por IA',
                'text' => 'Entregar mais depressa com agentes de IA sem perder o controlo: enquadramento, revisão, testes e responsabilidade humana em cada entrega, nos seus projetos ou ao lado da sua equipa.',
            ],
        ],
    ],
];
