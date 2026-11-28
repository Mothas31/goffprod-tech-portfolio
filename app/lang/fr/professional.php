<?php

return [
    'home' => [
        'identity' => 'Thomas Goffinet — développeur indépendant, basé au Portugal',
        'title' => 'Je pars de votre problème, puis je choisis l’outil.',
        'lead' => 'Je reprends des applications difficiles à faire évoluer et je connecte vos outils pour supprimer les ressaisies.',
        'examples' => 'Exemples : changement de service de facturation sans changer de logiciel métier ; remplacement progressif d’un ERP vieillissant.',
        'contact' => 'Décrire mon problème',
    ],
    'development' => [
        'title' => 'Développement : partir du problème, choisir l’outil.',
        'intro' => 'Faire évoluer une application, relier vos outils, rendre une information exploitable : je pars de ce qui vous bloque et des contraintes de votre activité.',
        'proof_title' => 'Deux interventions réelles, présentées sans données internes.',
        'proofs' => [
            ['title' => 'Changer de service de facturation, conserver le logiciel métier.', 'text' => 'Intégration par API d’un nouveau service de facturation en conservant le logiciel métier existant.'],
            ['title' => 'Remplacer progressivement un ERP vieillissant.', 'text' => 'Dans le secteur du déménagement, remplacement progressif d’un ERP vieillissant, avec des données historiques conservées utilisables.'],
        ],
        'diagnostic_title' => 'Commencer par un diagnostic payant.',
        'diagnostic_text' => 'Une première intervention pour comprendre la situation et établir un plan priorisé. Le périmètre et le prix sont précisés sur devis.',
    ],
    'ai' => [
        'eyebrow' => 'IA · artisans et indépendants',
        'title' => 'Un site simple, adapté à votre activité et à votre budget.',
        'lead' => 'Vous avez besoin de présenter votre activité, vos réalisations et vos coordonnées ? Je vous accompagne avec une technologie adaptée et un périmètre centré sur l’essentiel.',
        'sections' => [
            ['title' => 'Un site vitrine accessible aux petits budgets.', 'text' => 'J’utilise l’IA pour accélérer certaines étapes de création et réduire le coût de réalisation de sites simples. Nous définissons ensemble ce que vos visiteurs doivent comprendre et comment ils peuvent vous contacter.'],
            ['title' => 'Moins de bruit. Une technologie simple.', 'text' => 'La démarche MinusVortex reste la même : partir de votre besoin, choisir des outils adaptés et limiter la complexité à ce qui rend un service réel. L’IA m’assiste ; je vérifie le résultat.'],
            ['title' => 'Faire pour vous, ou vous accompagner.', 'text' => 'Selon votre besoin, l’intervention peut prendre la forme d’un site simple réalisé pour votre activité ou d’un accompagnement pour apprendre à utiliser l’IA. Le contenu et les modalités se définissent ensemble.'],
            ['title' => 'Chaque projet fait l’objet d’un devis.', 'text' => 'Le prix dépend du périmètre convenu. Décrivons d’abord votre activité, les informations à présenter et ce que vous attendez du site ou de l’accompagnement.'],
        ],
    ],
    'nodus' => [
        'eyebrow' => 'Nodus · projet en alpha',
        'title' => 'Garder ses repères, sans enfermer ses données.',
        'lead' => 'Une application de bureau pour réunir notes, habitudes et objectifs, puis en tirer un bilan.',
        'sections' => [
            ['title' => 'Le besoin', 'text' => 'Garder notes, habitudes et objectifs au même endroit et en tirer un bilan, sans enfermer ses données dans un service.'],
            ['title' => 'Les contraintes', 'text' => 'Des fichiers Markdown lisibles sans l’application, des données d’abord sur la machine et une application sobre.'],
            ['title' => 'Markdown comme référence, SQLite comme index', 'text' => 'Les fichiers Markdown constituent la référence. SQLite sert d’index pour retrouver et exploiter les informations dans l’application.'],
            ['title' => 'Une application de bureau avec accès aux fichiers', 'text' => 'Tauri 2 a été choisi pour sa légèreté par rapport à Electron et pour construire une application de bureau avec accès aux fichiers. Rust porte la logique locale ; Svelte 5 sert une interface simple.'],
            ['title' => 'Une IA facultative et remplaçable', 'text' => 'L’IA propose ; l’utilisateur valide. Cette assistance reste facultative et remplaçable.'],
            ['title' => 'L’état actuel', 'text' => 'Nodus est une application de bureau en alpha, testée auprès d’utilisateurs. Le mobile et la synchronisation sont expérimentaux.'],
        ],
    ],
];
