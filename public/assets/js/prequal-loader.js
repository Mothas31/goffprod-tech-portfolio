(() => {
  const root = document.getElementById('prequal-module-root');
  if (!root || root.dataset.loaded === '1') return;

  const ASSET_VERSION = '20260703-business-minimal-1';
  const locale = (document.documentElement.lang || 'fr').slice(0, 2).toLowerCase();
  const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  const presetThemeId = root.dataset.prequalTheme || '';
  const presetAnswer = new URLSearchParams(window.location.search).get('a') || '';
  const BUSINESS_THEME_ID = 'universe-finance';

  const TYPE_SPEED_QUESTION = 46;
  const TYPE_SPEED_JITTER = 18;
  const TYPE_PUNCTUATION_PAUSE = 110;

  const BUSINESS_GAME_COPY = {
    fr: {
      kicker: 'Prototype Business',
      title: 'Cartographier un business sobre',
      intro: 'Chaque décision ajoute un nœud à la carte. Le but n’est pas de répondre juste, mais de révéler la tension qui mérite vraiment d’être simplifiée.',
      knowledgeTitle: 'Idées ajoutées',
      emptyKnowledge: 'La carte est vide. Le premier choix donnera une forme au système.',
      resultEyebrow: 'Carte complète',
      restart: 'Rejouer',
      cta: 'Partager cette carte',
      mailSubject: 'Carte Business Goffprod',
      preset: {
        agree: 'Terrain Business validé depuis la home : on cherche une structure lisible, durable et sans agitation inutile.',
        disagree: 'Terrain Business ouvert depuis la home : on va vérifier si une autre forme d’accompagnement serait plus juste.',
        neutral: 'Choisissez une tension : la carte se construira avec vos réponses.'
      },
      profiles: {
        focus: {
          title: 'Signal Focus',
          text: 'Votre meilleur levier semble être la réduction du champ : moins d’offres, moins de canaux, moins de décisions secondaires.'
        },
        clarity: {
          title: 'Signal Clarté',
          text: 'Le système demande surtout des arbitrages explicites : nommer ce qui compte, ce qui sort du cadre, et pourquoi.'
        },
        operations: {
          title: 'Signal Opérations',
          text: 'La tension principale est dans le passage au quotidien : processus, cadence, responsabilités et boucles de décision.'
        },
        restraint: {
          title: 'Signal Sobriété',
          text: 'Le bon mouvement semble être de retirer avant d’ajouter : simplifier l’offre, les outils et les métriques.'
        },
        trust: {
          title: 'Signal Transmission',
          text: 'Le projet a besoin de devenir transmissible : moins dépendant des personnes, plus clair dans ses règles et ses rituels.'
        }
      },
      steps: [
        {
          axis: 'Tension',
          question: 'Où votre business perd-il surtout son énergie ?',
          options: [
            {
              label: 'Trop de dispersion',
              node: 'Focus',
              insight: 'Un business sobre commence souvent par réduire le nombre de fronts ouverts.',
              evidenceTitle: '37signals / Basecamp',
              evidenceText: 'Une référence utile pour penser des produits simples, rentables et moins dépendants du bruit de croissance.',
              href: 'https://37signals.com/',
              axes: { focus: 3, restraint: 1 },
              pos: [30, 42, 0.82]
            },
            {
              label: 'Trop d’outils',
              node: 'Friction outil',
              insight: 'L’empilement d’outils crée souvent plus de coordination que de vitesse.',
              evidenceTitle: 'Linear',
              evidenceText: 'Un exemple intéressant d’interface dense mais très contenue, pensée pour le travail récurrent.',
              href: 'https://linear.app/',
              axes: { operations: 2, restraint: 2 },
              pos: [34, 58, 0.72]
            },
            {
              label: 'Décisions floues',
              node: 'Arbitrage',
              insight: 'Quand les critères ne sont pas nommés, chaque décision redevient une négociation.',
              evidenceTitle: 'Amazon narratives',
              evidenceText: 'Les mémos narratifs montrent comment une organisation peut forcer la clarté avant la décision.',
              href: 'https://www.aboutamazon.com/news/workplace/why-amazon-uses-written-narratives',
              axes: { clarity: 3, trust: 1 },
              pos: [37, 35, 0.68]
            },
            {
              label: 'Trop de dépendance humaine',
              node: 'Transmission',
              insight: 'Si tout tient dans quelques têtes, la croissance augmente la fragilité au lieu de la réduire.',
              evidenceTitle: 'GitLab handbook',
              evidenceText: 'Un exemple radical de documentation ouverte pour rendre les règles de fonctionnement transmissibles.',
              href: 'https://handbook.gitlab.com/',
              axes: { trust: 3, operations: 1 },
              pos: [32, 69, 0.62]
            }
          ]
        },
        {
          axis: 'Coupe',
          question: 'Si vous deviez simplifier demain, où couperiez-vous d’abord ?',
          options: [
            {
              label: 'Une offre secondaire',
              node: 'Offre resserrée',
              insight: 'Couper une offre libère souvent plus d’attention que gagner un nouvel outil.',
              evidenceTitle: 'Do less, better',
              evidenceText: 'Une logique simple : moins de promesses, plus de profondeur dans ce qui reste.',
              href: 'https://basecamp.com/',
              axes: { focus: 3, restraint: 1 },
              pos: [48, 31, 0.76]
            },
            {
              label: 'Un processus qui ralentit',
              node: 'Flux court',
              insight: 'Un processus sobre supprime les passages qui ne changent pas la qualité de la décision.',
              evidenceTitle: 'Toyota way',
              evidenceText: 'La chasse au gaspillage reste une base solide pour penser la sobriété opérationnelle.',
              href: 'https://global.toyota/en/company/vision-and-philosophy/production-system/',
              axes: { operations: 3, restraint: 1 },
              pos: [51, 48, 0.8]
            },
            {
              label: 'Un canal d’acquisition',
              node: 'Canal choisi',
              insight: 'Un canal assumé donne plus de signal qu’une présence faible partout.',
              evidenceTitle: 'Patagonia',
              evidenceText: 'Une marque utile à observer pour la cohérence entre message, canal et choix de croissance.',
              href: 'https://www.patagonia.com/',
              axes: { focus: 2, clarity: 2 },
              pos: [49, 63, 0.66]
            }
          ]
        },
        {
          axis: 'Compromis',
          question: 'Quel compromis êtes-vous prêt à accepter pour gagner en lisibilité ?',
          options: [
            {
              label: 'Moins de fonctionnalités',
              node: 'Moins de surface',
              insight: 'Moins de surface produit signifie moins de support, moins de dette et plus de compréhension.',
              evidenceTitle: 'MVP sobre',
              evidenceText: 'Le MVP utile n’est pas petit par principe : il est petit pour apprendre sans brouiller le signal.',
              href: 'https://basecamp.com/shapeup',
              axes: { restraint: 3, focus: 1 },
              pos: [63, 28, 0.84]
            },
            {
              label: 'Décider moins vite mais mieux',
              node: 'Décision claire',
              insight: 'Ralentir une décision critique peut accélérer tout ce qui vient ensuite.',
              evidenceTitle: 'Written thinking',
              evidenceText: 'Écrire avant de décider réduit l’ambiguïté et rend le désaccord plus productif.',
              href: 'https://www.aboutamazon.com/news/workplace/why-amazon-uses-written-narratives',
              axes: { clarity: 3, trust: 1 },
              pos: [66, 45, 0.74]
            },
            {
              label: 'Moins d’indicateurs',
              node: 'Mesure utile',
              insight: 'Trop de métriques peut masquer le seul signal qui change vraiment le comportement.',
              evidenceTitle: 'North Star metric',
              evidenceText: 'Une métrique principale force le débat sur la valeur produite, pas seulement l’activité.',
              href: 'https://www.amplitude.com/blog/north-star-metric',
              axes: { clarity: 2, operations: 2 },
              pos: [61, 62, 0.7]
            }
          ]
        },
        {
          axis: 'Preuve',
          question: 'Quel signe prouverait que le système fonctionne mieux ?',
          options: [
            {
              label: 'Moins de questions support',
              node: 'Autonomie',
              insight: 'Quand le système est clair, les utilisateurs demandent moins d’aide pour faire l’action attendue.',
              evidenceTitle: 'Clarté produit',
              evidenceText: 'Un bon signe de minimalisme : les frictions disparaissent avant même d’être expliquées.',
              href: 'https://www.nngroup.com/articles/minimalism-flat-design/',
              axes: { clarity: 2, trust: 2 },
              pos: [76, 35, 0.7]
            },
            {
              label: 'Des cycles plus courts',
              node: 'Cadence',
              insight: 'La sobriété se voit quand une équipe peut livrer sans réinventer la manière de décider.',
              evidenceTitle: 'Shape Up',
              evidenceText: 'Une méthode intéressante pour cadrer le travail par cycles et limiter la dérive du périmètre.',
              href: 'https://basecamp.com/shapeup',
              axes: { operations: 3, focus: 1 },
              pos: [78, 53, 0.78]
            },
            {
              label: 'Plus de marge d’attention',
              node: 'Attention',
              insight: 'La marge n’est pas seulement financière : c’est aussi la capacité à penser sans urgence constante.',
              evidenceTitle: 'Small Giants',
              evidenceText: 'Une piste de lecture sur les entreprises qui choisissent la qualité de croissance plutôt que la taille.',
              href: 'https://smallgiants.org/',
              axes: { restraint: 2, focus: 2 },
              pos: [73, 68, 0.62]
            }
          ]
        },
        {
          axis: 'Mouvement',
          question: 'Le prochain mouvement juste serait plutôt…',
          options: [
            {
              label: 'Auditer le bruit',
              node: 'Audit du bruit',
              insight: 'On liste ce qui consomme de l’attention sans produire de décision, puis on coupe par ordre d’impact.',
              evidenceTitle: 'Premier mouvement',
              evidenceText: 'Cartographier les irritants évite de confondre symptôme visible et cause structurelle.',
              href: 'https://37signals.com/books/',
              axes: { clarity: 2, restraint: 2 },
              pos: [88, 31, 0.78]
            },
            {
              label: 'Tester un flux pilote',
              node: 'Pilote',
              insight: 'Un flux pilote permet de prouver la simplification sans réorganiser tout le système.',
              evidenceTitle: 'Prototype opérationnel',
              evidenceText: 'Un test limité donne vite un signal sur ce qui simplifie réellement le travail.',
              href: 'https://basecamp.com/shapeup',
              axes: { operations: 3, trust: 1 },
              pos: [88, 50, 0.84]
            },
            {
              label: 'Écrire les règles du jeu',
              node: 'Règles claires',
              insight: 'Documenter les arbitrages transforme une intuition en système transmissible.',
              evidenceTitle: 'Handbook first',
              evidenceText: 'Quand les règles sont visibles, l’équipe dépend moins des implicites et des corrections tardives.',
              href: 'https://handbook.gitlab.com/',
              axes: { trust: 3, clarity: 1 },
              pos: [85, 69, 0.68]
            }
          ]
        }
      ]
    },
    en: {
      kicker: 'Business Prototype',
      title: 'Map a sober business system',
      intro: 'Each decision adds one node to the map. The goal is not to answer correctly, but to reveal the tension worth simplifying.',
      knowledgeTitle: 'Added ideas',
      emptyKnowledge: 'The map is empty. Your first choice will give the system a shape.',
      resultEyebrow: 'Complete map',
      restart: 'Replay',
      cta: 'Share this map',
      mailSubject: 'Goffprod Business Map',
      preset: {
        agree: 'Business terrain confirmed from the home page: we are looking for readable, durable structure without unnecessary noise.',
        disagree: 'Business terrain opened from the home page: we will verify whether another form of support is wiser.',
        neutral: 'Choose a tension: the map will grow from your answers.'
      },
      profiles: {
        focus: { title: 'Focus Signal', text: 'The strongest lever seems to be reducing the field: fewer offers, fewer channels, fewer secondary decisions.' },
        clarity: { title: 'Clarity Signal', text: 'The system mostly needs explicit tradeoffs: what matters, what leaves the scope, and why.' },
        operations: { title: 'Operations Signal', text: 'The main tension lives in daily execution: process, cadence, responsibilities and decision loops.' },
        restraint: { title: 'Restraint Signal', text: 'The right move seems to be removing before adding: simplify offers, tools and metrics.' },
        trust: { title: 'Transmission Signal', text: 'The project needs to become transferable: less dependent on people, clearer in rules and rituals.' }
      },
      steps: []
    }
  };

  const stylesheetId = 'prequal-module-css';
  if (!document.getElementById(stylesheetId)) {
    const link = document.createElement('link');
    link.id = stylesheetId;
    link.rel = 'stylesheet';
    link.href = `/assets/css/prequal-module.css?v=${ASSET_VERSION}`;
    document.head.appendChild(link);
  }

  function fallbackMarkup() {
    return `
      <section class="prequal-widget" aria-labelledby="prequal-title" data-prequal-widget>
        <header class="prequal-widget__header">
          <p class="prequal-widget__kicker" data-prequal-kicker>Première vibration</p>
          <h2 id="prequal-title" data-prequal-title>Voyons si l’on parle le même langage</h2>
          <p class="prequal-widget__intro" data-prequal-intro>Quelques choix simples pour sentir si votre projet appelle une réponse claire, sobre et durable.</p>
        </header>
        <div class="prequal-widget__entry" data-prequal-entry>
          <div class="prequal-cta">
            <p class="prequal-cta__lead" data-prequal-entry-lead></p>
            <p class="prequal-cta__question" data-prequal-entry-question></p>
            <div class="prequal-theme-pills" data-prequal-universes></div>
          </div>
        </div>
        <div class="prequal-widget__quiz" data-prequal-quiz>
          <div class="prequal-widget__body">
            <div class="prequal-widget__progress" data-prequal-progress aria-hidden="true"></div>
            <p class="prequal-widget__question" data-prequal-question></p>
            <div class="prequal-widget__options" data-prequal-options></div>
          </div>
        </div>
      </section>
    `;
  }

  function wait(ms) {
    return new Promise((resolve) => {
      window.setTimeout(resolve, ms);
    });
  }

  function scoreFromAnswers(answers) {
    return answers.reduce((sum, answer) => sum + (Number.isFinite(answer.points) ? answer.points : 0), 0);
  }

  function maxScoreFromAnswers(answers) {
    return answers.reduce((sum, answer) => sum + (Number.isFinite(answer.maxPoints) ? answer.maxPoints : 0), 0);
  }

  function percentageScore(rawScore, rawMax) {
    if (!rawMax) return 0;
    return Math.max(0, Math.min(100, Math.round((rawScore / rawMax) * 100)));
  }

  function resolveVerdict(tree, score) {
    return (tree.verdicts || []).find((item) => score >= item.min)?.message || '';
  }

  function toMailBody(answers, score, tree, universeLabel) {
    const lines = answers.map((answer) => {
      if (!answer.maxPoints) return `- ${answer.label}`;
      return `- ${answer.label} (${answer.points}/${answer.maxPoints})`;
    });

    return encodeURIComponent([
      `${tree.ui.resultTitle}: ${score}%`,
      `Univers: ${universeLabel || '-'}`,
      '',
      ...lines
    ].join('\n'));
  }

  async function fetchTreeData() {
    const response = await fetch(`/api/prequal.php?lang=${encodeURIComponent(locale)}&v=${ASSET_VERSION}`, {
      cache: 'no-store'
    });
    if (!response.ok) {
      throw new Error('prequal-data-load-failed');
    }

    const payload = await response.json();
    if (!payload || !payload.tree || !payload.tree.ui || !payload.tree.nodes || !payload.tree.universes) {
      throw new Error('prequal-data-invalid');
    }

    return payload.tree;
  }

  function universeIconMarkup(icon) {
    const icons = {
      lotus: '<svg viewBox="0 0 64 64" aria-hidden="true"><path d="M32 14c5 7 7 13 7 18 0 8-5 14-7 16-2-2-7-8-7-16 0-5 2-11 7-18Z"/><path d="M19 25c8 2 13 5 16 10 4 7 3 14 2 17-3 0-11-1-17-6-4-3-7-9-8-17 3-2 8-4 7-4Z"/><path d="M45 25c-8 2-13 5-16 10-4 7-3 14-2 17 3 0 11-1 17-6 4-3 7-9 8-17-3-2-8-4-7-4Z"/><path d="M11 42c7 1 13 2 21 2s14-1 21-2"/><path d="M14 48c6 2 12 3 18 3s12-1 18-3"/></svg>',
      coins: '<svg viewBox="0 0 64 64" aria-hidden="true"><ellipse cx="24" cy="18" rx="11" ry="5"/><path d="M13 18v19c0 3 5 5 11 5s11-2 11-5V18"/><path d="M13 28c0 3 5 5 11 5s11-2 11-5"/><path d="M13 37c0 3 5 5 11 5s11-2 11-5"/><circle cx="46" cy="39" r="12"/><path d="M49 32h-6v14h6"/><path d="M41 39h7"/></svg>',
      spark: '<svg viewBox="0 0 64 64" aria-hidden="true"><path d="M32 10l4 11 11 4-11 4-4 11-4-11-11-4 11-4 4-11Z"/><path d="M18 38l2.5 6.5L27 47l-6.5 2.5L18 56l-2.5-6.5L9 47l6.5-2.5L18 38Z"/><path d="M48 38l2.5 6.5L57 47l-6.5 2.5L48 56l-2.5-6.5L39 47l6.5-2.5L48 38Z"/></svg>',
      plane: '<svg viewBox="0 0 64 64" aria-hidden="true"><path d="M8 34 56 14l-12 36-10-10-10 8-4-8-12-6Z"/><path d="M24 40 56 14"/><path d="M20 32 32 38"/></svg>',
      check: '<svg viewBox="0 0 64 64" aria-hidden="true"><rect x="16" y="12" width="32" height="40" rx="4"/><path d="M24 32l6 6 12-14"/><path d="M24 18h16"/></svg>',
      screen: '<svg viewBox="0 0 64 64" aria-hidden="true"><rect x="12" y="14" width="40" height="28" rx="3"/><path d="M24 50h16"/><path d="M18 50h28"/><path d="M26 27h12"/><path d="M23 31h18"/></svg>'
    };

    return icons[icon] || icons.spark;
  }

  function universeFrameMarkup(id) {
    const safeId = String(id || 'theme').replace(/[^a-z0-9_-]/gi, '-');
    const glowId = `prequal-glow-${safeId}`;

    return `
      <svg viewBox="0 0 620 620" aria-hidden="true" preserveAspectRatio="none">
        <defs>
          <filter id="${glowId}" x="-30%" y="-30%" width="160%" height="160%">
            <feGaussianBlur stdDeviation="2.2" result="blur" />
            <feMerge>
              <feMergeNode in="blur" />
              <feMergeNode in="SourceGraphic" />
            </feMerge>
          </filter>
        </defs>
        <circle class="prequal-theme-card__particle prequal-theme-card__particle--one" cx="154" cy="126" r="2.1" filter="url(#${glowId})"><animate attributeName="opacity" values=".12;.9;.28;.12" dur="3.6s" begin="-.2s" repeatCount="indefinite" /><animate attributeName="r" values="1.3;2.8;1.8;1.3" dur="3.6s" begin="-.2s" repeatCount="indefinite" /><animateTransform attributeName="transform" type="translate" values="0 0;-4 -3;1 2;0 0" dur="3.6s" begin="-.2s" repeatCount="indefinite" /></circle>
        <circle class="prequal-theme-card__particle prequal-theme-card__particle--two" cx="226" cy="104" r="1.4" filter="url(#${glowId})"><animate attributeName="opacity" values=".08;.62;.18;.08" dur="4.7s" begin="-1.1s" repeatCount="indefinite" /><animate attributeName="r" values=".9;2.1;1.2;.9" dur="4.7s" begin="-1.1s" repeatCount="indefinite" /><animateTransform attributeName="transform" type="translate" values="0 0;-1 -5;2 1;0 0" dur="4.7s" begin="-1.1s" repeatCount="indefinite" /></circle>
        <circle class="prequal-theme-card__particle prequal-theme-card__particle--one" cx="394" cy="104" r="1.7" filter="url(#${glowId})"><animate attributeName="opacity" values=".1;.78;.24;.1" dur="4.1s" begin="-2.2s" repeatCount="indefinite" /><animate attributeName="r" values="1;2.4;1.5;1" dur="4.1s" begin="-2.2s" repeatCount="indefinite" /><animateTransform attributeName="transform" type="translate" values="0 0;1 -5;-2 1;0 0" dur="4.1s" begin="-2.2s" repeatCount="indefinite" /></circle>
        <circle class="prequal-theme-card__particle prequal-theme-card__particle--two" cx="466" cy="126" r="2" filter="url(#${glowId})"><animate attributeName="opacity" values=".08;.7;.2;.08" dur="5.2s" begin="-.7s" repeatCount="indefinite" /><animate attributeName="r" values="1.1;2.6;1.4;1.1" dur="5.2s" begin="-.7s" repeatCount="indefinite" /><animateTransform attributeName="transform" type="translate" values="0 0;4 -3;-1 2;0 0" dur="5.2s" begin="-.7s" repeatCount="indefinite" /></circle>
        <circle class="prequal-theme-card__particle prequal-theme-card__particle--one" cx="516" cy="246" r="1.5" filter="url(#${glowId})"><animate attributeName="opacity" values=".1;.76;.2;.1" dur="4.4s" begin="-3s" repeatCount="indefinite" /><animate attributeName="r" values=".9;2.3;1.2;.9" dur="4.4s" begin="-3s" repeatCount="indefinite" /><animateTransform attributeName="transform" type="translate" values="0 0;5 -1;-1 -2;0 0" dur="4.4s" begin="-3s" repeatCount="indefinite" /></circle>
        <circle class="prequal-theme-card__particle prequal-theme-card__particle--two" cx="516" cy="374" r="1.8" filter="url(#${glowId})"><animate attributeName="opacity" values=".08;.66;.18;.08" dur="3.9s" begin="-1.6s" repeatCount="indefinite" /><animate attributeName="r" values="1;2.5;1.3;1" dur="3.9s" begin="-1.6s" repeatCount="indefinite" /><animateTransform attributeName="transform" type="translate" values="0 0;5 1;-2 -1;0 0" dur="3.9s" begin="-1.6s" repeatCount="indefinite" /></circle>
        <circle class="prequal-theme-card__particle prequal-theme-card__particle--one" cx="466" cy="494" r="1.5" filter="url(#${glowId})"><animate attributeName="opacity" values=".12;.8;.26;.12" dur="5s" begin="-2.8s" repeatCount="indefinite" /><animate attributeName="r" values=".9;2.4;1.2;.9" dur="5s" begin="-2.8s" repeatCount="indefinite" /><animateTransform attributeName="transform" type="translate" values="0 0;4 4;-2 -1;0 0" dur="5s" begin="-2.8s" repeatCount="indefinite" /></circle>
        <circle class="prequal-theme-card__particle prequal-theme-card__particle--two" cx="394" cy="516" r="2.1" filter="url(#${glowId})"><animate attributeName="opacity" values=".08;.68;.2;.08" dur="4.3s" begin="-.4s" repeatCount="indefinite" /><animate attributeName="r" values="1.1;2.8;1.5;1.1" dur="4.3s" begin="-.4s" repeatCount="indefinite" /><animateTransform attributeName="transform" type="translate" values="0 0;1 5;-2 -1;0 0" dur="4.3s" begin="-.4s" repeatCount="indefinite" /></circle>
        <circle class="prequal-theme-card__particle prequal-theme-card__particle--one" cx="226" cy="516" r="1.6" filter="url(#${glowId})"><animate attributeName="opacity" values=".1;.74;.22;.1" dur="4.8s" begin="-2s" repeatCount="indefinite" /><animate attributeName="r" values=".9;2.3;1.3;.9" dur="4.8s" begin="-2s" repeatCount="indefinite" /><animateTransform attributeName="transform" type="translate" values="0 0;-1 5;2 -1;0 0" dur="4.8s" begin="-2s" repeatCount="indefinite" /></circle>
        <circle class="prequal-theme-card__particle prequal-theme-card__particle--two" cx="154" cy="494" r="1.9" filter="url(#${glowId})"><animate attributeName="opacity" values=".08;.64;.18;.08" dur="5.3s" begin="-1.3s" repeatCount="indefinite" /><animate attributeName="r" values="1;2.5;1.4;1" dur="5.3s" begin="-1.3s" repeatCount="indefinite" /><animateTransform attributeName="transform" type="translate" values="0 0;-4 4;1 -2;0 0" dur="5.3s" begin="-1.3s" repeatCount="indefinite" /></circle>
        <circle class="prequal-theme-card__particle prequal-theme-card__particle--one" cx="104" cy="374" r="1.4" filter="url(#${glowId})"><animate attributeName="opacity" values=".1;.76;.2;.1" dur="4s" begin="-3.4s" repeatCount="indefinite" /><animate attributeName="r" values=".8;2.2;1.1;.8" dur="4s" begin="-3.4s" repeatCount="indefinite" /><animateTransform attributeName="transform" type="translate" values="0 0;-5 1;1 -2;0 0" dur="4s" begin="-3.4s" repeatCount="indefinite" /></circle>
        <circle class="prequal-theme-card__particle prequal-theme-card__particle--two" cx="104" cy="246" r="1.8" filter="url(#${glowId})"><animate attributeName="opacity" values=".08;.66;.22;.08" dur="4.6s" begin="-.9s" repeatCount="indefinite" /><animate attributeName="r" values="1;2.5;1.3;1" dur="4.6s" begin="-.9s" repeatCount="indefinite" /><animateTransform attributeName="transform" type="translate" values="0 0;-5 -1;2 1;0 0" dur="4.6s" begin="-.9s" repeatCount="indefinite" /></circle>
        <path
          class="prequal-theme-card__border-main"
          d="M160 160 H460 V460 H160 Z"
          filter="url(#${glowId})"
        />
        <path
          class="prequal-theme-card__border-echo"
          d="M178 178 H442 V442 H178 Z"
          filter="url(#${glowId})"
        />
      </svg>
    `;
  }

  function shouldUseBusinessPrototype() {
    return presetThemeId === BUSINESS_THEME_ID && locale === 'fr';
  }

  function escapeHtml(value) {
    return String(value ?? '')
      .replace(/&/g, '&amp;')
      .replace(/</g, '&lt;')
      .replace(/>/g, '&gt;')
      .replace(/"/g, '&quot;')
      .replace(/'/g, '&#039;');
  }

  function businessMarkup() {
    return `
      <section class="business-game" aria-labelledby="business-game-title" data-business-game>
        <div class="business-game__copy">
          <h2 id="business-game-title" data-business-title></h2>

          <div class="business-game__progress" data-business-progress aria-hidden="true"></div>
          <p class="business-game__status" data-business-status></p>
          <p class="business-game__question" data-business-question></p>
          <div class="business-game__choices" data-business-choices></div>
        </div>

        <div class="business-game__map" aria-label="Carte d'alignement business">
          <div class="business-network">
            <svg class="business-network__lines" viewBox="0 0 100 100" preserveAspectRatio="none" data-business-lines aria-hidden="true"></svg>
            <div class="business-network__nodes" data-business-nodes></div>
          </div>
        </div>
      </section>
    `;
  }

  function setupBusinessGame(tree) {
    const gameEl = root.querySelector('[data-business-game]');
    const titleEl = root.querySelector('[data-business-title]');
    const progressEl = root.querySelector('[data-business-progress]');
    const statusEl = root.querySelector('[data-business-status]');
    const questionEl = root.querySelector('[data-business-question]');
    const choicesEl = root.querySelector('[data-business-choices]');
    const mapEl = root.querySelector('.business-game__map');
    const linesEl = root.querySelector('[data-business-lines]');
    const nodesEl = root.querySelector('[data-business-nodes]');
    const config = BUSINESS_GAME_COPY.fr;

    if (!gameEl || !questionEl || !choicesEl || !linesEl || !nodesEl) {
      return false;
    }

    root.classList.add('prequal-module-root--business');
    titleEl.textContent = config.title;

    const universe = tree.universes?.find((item) => item.id === BUSINESS_THEME_ID) || null;
    const answers = [];
    let stepIndex = 0;
    let renderToken = 0;

    function baseNode() {
      return {
        id: 'business-origin',
        label: universe?.label || 'Business',
        x: 14,
        y: 50,
        z: 0.72,
        kind: 'origin'
      };
    }

    function answerNodes() {
      return answers.map((answer, index) => ({
        id: `business-node-${index}`,
        label: answer.option.node,
        x: answer.option.pos[0],
        y: answer.option.pos[1],
        z: answer.option.pos[2],
        answer,
        kind: index === answers.length - 1 ? 'active' : 'answered'
      }));
    }

    function renderProgress() {
      progressEl.innerHTML = config.steps.map((step, index) => {
        const state = index < answers.length ? 'is-filled' : index === stepIndex ? 'is-current' : '';
        return `<span class="${state}" title="${escapeHtml(step.axis)}"></span>`;
      }).join('');
    }

    function renderNetwork() {
      const nodes = [baseNode(), ...answerNodes()];
      const lines = [];

      for (let index = 1; index < nodes.length; index += 1) {
        const from = nodes[index - 1];
        const to = nodes[index];
        const opacity = Math.max(0.26, Math.min(0.92, (from.z + to.z) / 2));
        lines.push(`<line x1="${from.x}" y1="${from.y}" x2="${to.x}" y2="${to.y}" style="--line-opacity:${opacity.toFixed(2)}"></line>`);
      }

      linesEl.innerHTML = lines.join('');
      nodesEl.innerHTML = nodes.map((node, index) => {
        const scale = 0.78 + (node.z * 0.24);
        const delay = prefersReducedMotion ? 0 : index * 70;
        const answerIndex = index - 1;
        const info = node.answer ? `
          <article class="business-network__info business-network__info--slot-${answerIndex % 5}" style="--item-delay:${prefersReducedMotion ? 0 : answerIndex * 80}ms">
            <p class="business-network__axis">${escapeHtml(node.answer.step.axis)}</p>
            <h3>${escapeHtml(node.answer.option.node)}</h3>
            <p>${escapeHtml(node.answer.option.insight)}</p>
          </article>
        ` : '';
        return `
          <div class="business-network__node business-network__node--${node.kind}"
                style="left:${node.x}%; top:${node.y}%; --node-scale:${scale.toFixed(2)}; --node-delay:${delay}ms">
            <span class="business-network__dot"></span>
            <span class="business-network__label">${escapeHtml(node.label)}</span>
            ${info}
          </div>
        `;
      }).join('');
    }

    async function typeBusinessText(element, text, token, speed = 50) {
      if (prefersReducedMotion) {
        element.textContent = text;
        return true;
      }

      element.classList.add('is-typing');
      element.textContent = '';
      for (let index = 0; index < text.length; index += 1) {
        if (token !== renderToken) {
          element.classList.remove('is-typing');
          return false;
        }
        const char = text.charAt(index);
        element.textContent += char;
        const pause = /[.,;:!?]/.test(char) ? 120 : 0;
        const jitter = Math.floor(Math.random() * 13);
        await wait(speed + pause + jitter);
      }

      element.classList.remove('is-typing');
      return token === renderToken;
    }

    function renderChoices(step, token) {
      choicesEl.innerHTML = step.options.map((option, index) => `
        <button type="button"
                class="business-game__choice business-game__choice--hidden"
                data-business-option="${index}"
                disabled>
          <span>${escapeHtml(option.label)}</span>
          <small>${escapeHtml(option.node)}</small>
        </button>
      `).join('');

      if (prefersReducedMotion) {
        choicesEl.querySelectorAll('.business-game__choice').forEach((button) => {
          button.classList.remove('business-game__choice--hidden');
          button.classList.add('business-game__choice--visible');
          button.disabled = false;
        });
        return;
      }

      choicesEl.querySelectorAll('.business-game__choice').forEach((button, index) => {
        window.setTimeout(() => {
          if (token !== renderToken) return;
          button.classList.remove('business-game__choice--hidden');
          button.classList.add('business-game__choice--visible');
          button.disabled = false;
        }, 120 + (index * 165));
      });
    }

    async function renderStep() {
      const step = config.steps[stepIndex];
      if (!step) return;

      const token = ++renderToken;
      gameEl.classList.remove('business-game--result');
      statusEl.textContent = `${step.axis} ${stepIndex + 1}/${config.steps.length}`;
      choicesEl.innerHTML = '';

      renderProgress();
      renderNetwork();

      const typed = await typeBusinessText(questionEl, step.question, token);
      if (!typed || token !== renderToken) return;
      renderChoices(step, token);
    }

    function dominantSignal() {
      const scores = {
        focus: 0,
        clarity: 0,
        operations: 0,
        restraint: 0,
        trust: 0
      };

      answers.forEach((answer) => {
        Object.entries(answer.option.axes || {}).forEach(([axis, value]) => {
          if (Object.prototype.hasOwnProperty.call(scores, axis)) {
            scores[axis] += Number(value || 0);
          }
        });
      });

      return Object.entries(scores).sort((a, b) => b[1] - a[1])[0]?.[0] || 'focus';
    }

    function businessMailBody(profile) {
      return encodeURIComponent([
        `${config.resultEyebrow}: ${profile.title}`,
        '',
        profile.text,
        '',
        ...answers.map((answer) => `- ${answer.step.axis}: ${answer.option.label} -> ${answer.option.node}`)
      ].join('\n'));
    }

    async function renderResult() {
      const profile = config.profiles[dominantSignal()] || config.profiles.focus;
      const mailHref = `mailto:contact@goffprod.com?subject=${encodeURIComponent(config.mailSubject)}&body=${businessMailBody(profile)}`;
      const token = ++renderToken;

      gameEl.classList.add('business-game--result');
      statusEl.textContent = config.resultEyebrow;
      choicesEl.innerHTML = '';

      renderProgress();
      renderNetwork();

      const typed = await typeBusinessText(questionEl, profile.title, token, 46);
      if (!typed || token !== renderToken) return;

      choicesEl.innerHTML = `
        <div class="business-game__result">
          <p>${escapeHtml(profile.text)}</p>
          <div class="business-game__result-actions">
            <a href="${mailHref}" class="business-game__cta">${escapeHtml(config.cta)}</a>
            <button type="button" class="business-game__reset" data-business-reset>${escapeHtml(config.restart)}</button>
          </div>
        </div>
      `;
    }

    function chooseOption(optionIndex) {
      const step = config.steps[stepIndex];
      const option = step?.options[optionIndex];
      if (!step || !option) return;

      answers.push({ step, option });
      if (stepIndex >= config.steps.length - 1) {
        renderResult();
        return;
      }

      stepIndex += 1;
      renderStep();
    }

    function resetGame() {
      answers.length = 0;
      stepIndex = 0;
      renderStep();
    }

    function setupPointerMotion() {
      if (!mapEl || prefersReducedMotion) return;
      if (!window.matchMedia('(hover: hover) and (pointer: fine)').matches) return;

      let raf = 0;
      let targetX = 0;
      let targetY = 0;

      function applyMotion() {
        raf = 0;
        mapEl.style.setProperty('--business-tilt-x', `${(-targetY * 5).toFixed(2)}deg`);
        mapEl.style.setProperty('--business-tilt-y', `${(targetX * 7).toFixed(2)}deg`);
        mapEl.style.setProperty('--business-shift-x', `${(targetX * 0.55).toFixed(2)}rem`);
        mapEl.style.setProperty('--business-shift-y', `${(targetY * 0.45).toFixed(2)}rem`);
      }

      function scheduleMotion(event) {
        const width = Math.max(1, window.innerWidth);
        const height = Math.max(1, window.innerHeight);
        targetX = (event.clientX / width - 0.5) * 2;
        targetY = (event.clientY / height - 0.5) * 2;
        if (!raf) raf = requestAnimationFrame(applyMotion);
      }

      function resetMotion() {
        targetX = 0;
        targetY = 0;
        if (!raf) raf = requestAnimationFrame(applyMotion);
      }

      window.addEventListener('pointermove', scheduleMotion, { passive: true });
      window.addEventListener('pointerleave', resetMotion, { passive: true });
      document.addEventListener('visibilitychange', () => {
        if (document.hidden) resetMotion();
      });
    }

    choicesEl.addEventListener('click', (event) => {
      const target = event.target;
      if (!(target instanceof Element)) return;

      const resetButton = target.closest('[data-business-reset]');
      if (resetButton) {
        resetGame();
        return;
      }

      const optionButton = target.closest('[data-business-option]');
      if (!optionButton) return;
      chooseOption(Number(optionButton.getAttribute('data-business-option') || 0));
    });

    setupPointerMotion();
    renderStep();
    return true;
  }

  function setupTree(tree) {
    const widgetEl = root.querySelector('[data-prequal-widget]');
    const kickerEl = root.querySelector('[data-prequal-kicker]');
    const titleEl = root.querySelector('[data-prequal-title]');
    const introEl = root.querySelector('[data-prequal-intro]');
    const entryQuestionEl = root.querySelector('[data-prequal-entry-question]');
    const entryLeadEl = root.querySelector('[data-prequal-entry-lead]');
    const universeNodesEl = root.querySelector('[data-prequal-universes]');
    const quizEl = root.querySelector('[data-prequal-quiz]');
    const questionEl = root.querySelector('[data-prequal-question]');
    const optionsEl = root.querySelector('[data-prequal-options]');
    const progressEl = root.querySelector('[data-prequal-progress]');
    if (!widgetEl || !universeNodesEl || !quizEl || !questionEl || !optionsEl) {
      return false;
    }

    kickerEl.textContent = tree.ui.kicker || '';
    titleEl.textContent = tree.ui.title || '';
    introEl.textContent = tree.ui.intro || '';
    entryQuestionEl.textContent = tree.ui.entryQuestion || '';
    if (entryLeadEl) entryLeadEl.textContent = tree.ui.entryLead || tree.ui.intro || '';
    let stage = 'entry';
    let selectedUniverse = null;
    let currentNodeId = null;
    let questionToken = 0;
    const history = [];
    const answers = [];

    function renderProgress() {
      if (!progressEl) return;
      const total = selectedUniverse?.id === 'universe-dev' ? 6 : 5;
      const filled = Math.max(0, Math.min(total, answers.filter((answer) => answer.maxPoints > 0).length));
      progressEl.innerHTML = Array.from({ length: total }, (_, index) => (
        `<span class="${index < filled ? 'is-filled' : ''}"></span>`
      )).join('');
    }

    async function typeText(element, text, getToken, token, speed = TYPE_SPEED_QUESTION) {
      if (prefersReducedMotion) {
        element.textContent = text;
        return true;
      }

      element.textContent = '';
      for (let index = 0; index < text.length; index += 1) {
        if (token !== getToken()) return false;
        const char = text.charAt(index);
        element.textContent += char;
        const extraPause = /[.,;:!?]/.test(char) ? TYPE_PUNCTUATION_PAUSE : 0;
        const jitter = Math.floor((Math.random() * ((TYPE_SPEED_JITTER * 2) + 1)) - TYPE_SPEED_JITTER);
        await wait(Math.max(8, speed + jitter + extraPause));
      }

      return token === getToken();
    }

    function getNode(nodeId) {
      if (nodeId === 'universe_statement') {
        if (!selectedUniverse) return null;
        return {
          text: selectedUniverse.statement,
          options: selectedUniverse.entry_options
        };
      }

      return tree.nodes[nodeId] || null;
    }

    function renderUniverses() {
      universeNodesEl.innerHTML = '';
      const isPreset = presetThemeId !== '';
      tree.universes.forEach((universe) => {
        const card = document.createElement(isPreset ? 'button' : 'a');
        card.className = 'prequal-theme-pill';
        card.dataset.universeId = universe.id;
        card.dataset.art = universe.art || 'other';

        if (isPreset) {
          card.type = 'button';
        } else {
          card.href = universe.path || '#';
        }

        card.innerHTML = `
          <span class="prequal-theme-pill__icon">${universeIconMarkup(universe.icon || 'spark')}</span>
          <span class="prequal-theme-pill__label">${universe.label}</span>
        `;

        universeNodesEl.appendChild(card);
      });
    }

    async function renderQuestion(nodeId, animate = true) {
      const node = getNode(nodeId);
      if (!node) return;

      currentNodeId = nodeId;
      stage = 'quiz';
      optionsEl.innerHTML = '';
      questionEl.textContent = '';

      const token = ++questionToken;
      if (animate) {
        await typeText(questionEl, node.text || '', () => questionToken, token);
      } else {
        questionEl.textContent = node.text || '';
      }

      if (token !== questionToken) return;

      renderProgress();

      node.options.forEach((option, index) => {
        const button = document.createElement('button');
        button.type = 'button';
        button.className = 'prequal-widget__choice';
        button.textContent = option.label;
        button.dataset.next = option.next;
        button.dataset.tag = option.tag;
        button.dataset.points = String(option.points);
        button.dataset.maxPoints = String(option.maxPoints);

        if (!prefersReducedMotion) {
          button.classList.add('prequal-widget__choice--hidden');
          button.style.transitionDelay = `${index * 90}ms`;
          requestAnimationFrame(() => {
            button.classList.add('prequal-widget__choice--visible');
          });
        }

        optionsEl.appendChild(button);
      });
    }

    function applyOption(option) {
      if (!option?.next || !option?.tag) return;

      const optionButtons = optionsEl.querySelectorAll('button');
      optionButtons.forEach((button) => {
        button.disabled = true;
      });

      history.push(currentNodeId);
      answers.push({
        label: option.label || '',
        tag: option.tag,
        points: Number(option.points || 0),
        maxPoints: Number(option.maxPoints || 0)
      });

      if (option.next === 'result') {
        renderProgress();
        renderResult();
        return;
      }

      renderQuestion(option.next, true);
    }

    function renderResult() {
      stage = 'result';

      const rawScore = scoreFromAnswers(answers);
      const rawMax = maxScoreFromAnswers(answers);
      const score = percentageScore(rawScore, rawMax);
      const verdict = resolveVerdict(tree, score);
      const orientation = selectedUniverse?.orientation || '';
      const contactHref = `mailto:contact@goffprod.com?subject=${encodeURIComponent(tree.ui.mailSubject)}&body=${toMailBody(answers, score, tree, selectedUniverse?.label || '')}`;
      const referralHref = `mailto:contact@goffprod.com?subject=${encodeURIComponent(`${tree.ui.mailSubject} - Orientation`)}&body=${encodeURIComponent(`${tree.ui.resultTitle}: ${score}%\n${orientation}`)}`;

      const answerList = answers.map((answer) => {
        if (!answer.maxPoints) return `<li>${answer.label}</li>`;
        return `<li>${answer.label} (${answer.points}/${answer.maxPoints})</li>`;
      }).join('');

      questionEl.textContent = tree.ui.resultQuestion || '';
      optionsEl.innerHTML = `
        <div class="prequal-widget__result">
          <p class="prequal-widget__score">${score}%</p>
          <h3>${tree.ui.resultTitle}</h3>
          <p>${verdict}</p>
          <ul>${answerList}</ul>
          ${score < 60 ? `<p>${orientation}</p>` : ''}
          <div class="prequal-widget__result-actions">
            <a class="prequal-widget__cta" href="${contactHref}">${tree.ui.cta}</a>
            ${score < 60 ? `<a class="prequal-widget__cta-secondary" href="${referralHref}">${tree.ui.ctaReferral}</a>` : ''}
          </div>
        </div>
      `;
    }

    function transitionToQuiz() {
      stage = 'quiz';
      widgetEl.classList.add('prequal-widget--quiz');
      quizEl.style.display = 'block';
    }

    function backToEntry() {
      stage = 'entry';
      selectedUniverse = null;
      currentNodeId = null;
      questionToken += 1;
      history.length = 0;
      answers.length = 0;
      renderProgress();
      questionEl.textContent = '';
      optionsEl.innerHTML = '';
      widgetEl.classList.remove('prequal-widget--quiz');
    }

    async function startFromUniverse(universeId) {
      selectedUniverse = tree.universes.find((item) => item.id === universeId) || null;
      if (!selectedUniverse) return;

      history.length = 0;
      answers.length = 0;
      transitionToQuiz();
      await renderQuestion('universe_statement', true);

      const normalizedAnswer = ['agree', 'disagree'].includes(presetAnswer) ? presetAnswer : '';
      const presetOption = normalizedAnswer
        ? selectedUniverse.entry_options?.find((option) => option.tag === `universe-${normalizedAnswer}`)
        : null;
      if (presetOption) {
        await wait(prefersReducedMotion ? 0 : 260);
        applyOption(presetOption);
      }
    }

    universeNodesEl.addEventListener('click', (event) => {
      const target = event.target;
      const card = target instanceof Element ? target.closest('.prequal-theme-pill') : null;
      if (!card) return;

      if (card instanceof HTMLButtonElement) {
        startFromUniverse(card.dataset.universeId || '');
        return;
      }

      // Pastille = lien <a> : on joue la transition "vortex" avant de naviguer.
      const href = card.getAttribute('href');
      if (href && href !== '#' && typeof window.minusWarpTo === 'function') {
        event.preventDefault();
        window.minusWarpTo(href);
      }
    });

    optionsEl.addEventListener('click', (event) => {
      const target = event.target;
      if (!(target instanceof HTMLButtonElement)) return;

      const tag = target.dataset.tag;
      const option = {
        label: target.textContent || '',
        tag,
        next: target.dataset.next,
        points: Number(target.dataset.points || 0),
        maxPoints: Number(target.dataset.maxPoints || 0)
      };
      applyOption(option);
    });

    window.addEventListener('resize', renderUniverses);

    renderUniverses();
    backToEntry();

    if (presetThemeId !== '') {
      const presetUniverse = tree.universes.find((item) => item.id === presetThemeId);
      if (presetUniverse) {
        startFromUniverse(presetUniverse.id);
      }
    }
    return true;
  }

  Promise.all([
    fetch(`/assets/modules/prequal.html?v=${ASSET_VERSION}`, { cache: 'no-store' }).then((response) => {
      if (!response.ok) throw new Error('module-load-failed');
      return response.text();
    }),
    fetchTreeData()
  ])
    .then(([html, tree]) => {
      root.dataset.loaded = '1';
      if (shouldUseBusinessPrototype()) {
        root.innerHTML = businessMarkup();
        if (setupBusinessGame(tree)) return;
      }

      root.innerHTML = html;
      if (!setupTree(tree)) {
        root.innerHTML = fallbackMarkup();
        setupTree(tree);
      }
    })
    .catch(() => {
      root.dataset.loaded = '1';
      fetchTreeData()
        .then((tree) => {
          if (shouldUseBusinessPrototype()) {
            root.innerHTML = businessMarkup();
            if (setupBusinessGame(tree)) return;
          }

          root.innerHTML = fallbackMarkup();
          setupTree(tree);
        })
        .catch(() => {
          root.innerHTML = '';
        });
    });
})();
