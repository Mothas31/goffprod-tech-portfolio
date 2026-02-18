(() => {
  const root = document.getElementById('prequal-module-root');
  if (!root || root.dataset.loaded === '1') return;
  const locale = (document.documentElement.lang || 'fr').slice(0, 2).toLowerCase();

  const stylesheetId = 'prequal-module-css';
  if (!document.getElementById(stylesheetId)) {
    const link = document.createElement('link');
    link.id = stylesheetId;
    link.rel = 'stylesheet';
    link.href = '/assets/css/prequal-module.css';
    document.head.appendChild(link);
  }

  function fallbackMarkup() {
    return `
      <section class="prequal-widget" aria-labelledby="prequal-title">
        <header class="prequal-widget__header">
          <p class="prequal-widget__kicker" data-prequal-kicker>Pre-selection</p>
          <h2 id="prequal-title" data-prequal-title>Projet en 2 minutes</h2>
          <p class="prequal-widget__intro" data-prequal-intro>Reponds a quelques questions pour preparer un premier devis.</p>
        </header>
        <div class="prequal-widget__body">
          <p class="prequal-widget__question" data-prequal-question></p>
          <div class="prequal-widget__options" data-prequal-options></div>
        </div>
        <footer class="prequal-widget__footer">
          <button type="button" class="prequal-widget__ghost" data-prequal-back disabled>Retour</button>
          <button type="button" class="prequal-widget__ghost" data-prequal-reset>Recommencer</button>
        </footer>
      </section>
    `;
  }

  const I18N = {
    fr: {
      kicker: 'Pre-selection',
      title: 'Qualification strategique',
      intro: 'Quelques questions business pour cadrer votre besoin avant un premier devis.',
      resultTitle: 'Synthese de pre-qualification',
      resultQuestion: 'Resultat',
      back: 'Retour',
      reset: 'Recommencer',
      cta: 'Demarrer un premier echange',
      mailSubject: 'Pre-qualification projet',
      questions: {
        start: 'Quelle situation de depart ressemble le plus a votre contexte ?',
        offer_positioning: 'Comment positionnez-vous votre offre aujourd hui ?',
        conversion_blocker: 'Ce qui freine le plus la conversion actuellement, c est plutot...',
        legacy_context: 'Dans votre contexte legacy/ERP, le blocage principal touche surtout...',
        legacy_risk: 'Quel niveau de risque acceptez-vous pendant la transformation ?',
        business_goal: 'Votre priorite business sur les 6 prochains mois ?',
        decision_cycle: 'Comment se prend la decision cote client/interne ?',
        budget_band: 'Quel niveau d investissement vous semble coherent ?',
        urgency: 'Quand voulez-vous un premier resultat visible ?'
      },
      options: {
        start_new_offer: 'Je lance une nouvelle offre ou activite',
        start_low_conversion: 'Mon site existe mais convertit mal',
        start_legacy: 'Je reprends un ERP ou un legacy complexe',
        start_rebrand: 'Je veux repositionner mon image de marque',
        pos_price_speed: 'Prix clair + execution rapide',
        pos_premium: 'Valeur premium et expertise',
        pos_trust: 'Proximite et relation de confiance',
        pos_innovation: 'Innovation et differenciation forte',
        conv_message: 'Le message est flou pour le visiteur',
        conv_proof: 'Le visiteur ne voit pas assez de preuves',
        conv_path: 'Le parcours est trop long ou confus',
        conv_offer: 'L offre ne semble pas assez claire',
        legacy_sales: 'Le cycle commercial',
        legacy_ops: 'Les operations internes',
        legacy_data: 'La qualite/fiabilite des donnees',
        legacy_compliance: 'Les exigences conformite/securite',
        risk_low: 'Risque tres limite, changements progressifs',
        risk_balanced: 'Risque controle avec phases pilote',
        risk_high: 'Transformation rapide meme si plus engageante',
        goal_pipeline: 'Generer plus d opportunites qualifiees',
        goal_margin: 'Mieux vendre la valeur (moins de guerre de prix)',
        goal_scaling: 'Industrialiser et scaler les processus',
        goal_visibility: 'Clarifier la marque et gagner en credibilite',
        decision_founder: 'Decision rapide avec le dirigeant',
        decision_team: 'Decision en comite restreint',
        decision_complex: 'Decision multi-equipes et multi-etapes',
        budget_small: 'Cadre prudent (MVP cible)',
        budget_mid: 'Cadre intermediaire (roadmap par lots)',
        budget_high: 'Cadre ambitieux (transformation structurelle)',
        urgency_fast: 'Sous 1 mois',
        urgency_quarter: 'Sous 1 trimestre',
        urgency_flexible: 'Sans urgence forte'
      },
      insights: {
        profile_acquisition: 'Profil: acceleration acquisition',
        profile_legacy: 'Profil: modernisation legacy/ERP',
        profile_positioning: 'Profil: clarification d offre',
        reco_legacy_low: 'Recommandation: audit flash + cartographie des risques + lot pilote.',
        reco_legacy: 'Recommandation: feuille de route de transformation en lots business.',
        reco_premium: 'Recommandation: renforcer la preuve de valeur et le discours orientee ROI.',
        reco_acquisition: 'Recommandation: simplifier le parcours, clarifier la promesse et les preuves.',
        reco_default: 'Recommandation: cadrage business court puis execution par priorites.'
      }
    },
    en: {
      kicker: 'Pre-selection',
      title: 'Strategic Qualification',
      intro: 'A few business questions to frame your needs before a first estimate.',
      resultTitle: 'Pre-qualification summary',
      resultQuestion: 'Result',
      back: 'Back',
      reset: 'Reset',
      cta: 'Start a first discussion',
      mailSubject: 'Project pre-qualification',
      questions: {
        start: 'Which starting situation best matches your context?',
        offer_positioning: 'How do you position your offer today?',
        conversion_blocker: 'What is the main conversion blocker right now?',
        legacy_context: 'In your legacy/ERP context, the main pain point affects...',
        legacy_risk: 'What level of risk can you accept during transformation?',
        business_goal: 'Your business priority for the next 6 months?',
        decision_cycle: 'How are decisions usually made on your side?',
        budget_band: 'What investment level feels realistic?',
        urgency: 'When do you want a first visible result?'
      },
      options: {
        start_new_offer: 'Launching a new offer or activity',
        start_low_conversion: 'My site exists but converts poorly',
        start_legacy: 'Taking over a complex ERP/legacy stack',
        start_rebrand: 'Repositioning my brand image',
        pos_price_speed: 'Clear pricing + fast execution',
        pos_premium: 'Premium value and expertise',
        pos_trust: 'Local trust and relationships',
        pos_innovation: 'Strong innovation differentiation',
        conv_message: 'The message is unclear',
        conv_proof: 'Not enough trust/proof elements',
        conv_path: 'User journey is too long or confusing',
        conv_offer: 'Offer structure is unclear',
        legacy_sales: 'Sales cycle execution',
        legacy_ops: 'Internal operations',
        legacy_data: 'Data quality/reliability',
        legacy_compliance: 'Compliance/security constraints',
        risk_low: 'Very low risk, progressive changes',
        risk_balanced: 'Controlled risk with pilot phases',
        risk_high: 'Faster transformation, higher commitment',
        goal_pipeline: 'Generate more qualified opportunities',
        goal_margin: 'Sell value better (less price pressure)',
        goal_scaling: 'Standardize and scale processes',
        goal_visibility: 'Clarify brand and increase credibility',
        decision_founder: 'Fast founder-led decision',
        decision_team: 'Small committee decision',
        decision_complex: 'Multi-team, multi-step decision',
        budget_small: 'Lean scope (focused MVP)',
        budget_mid: 'Mid scope (phased roadmap)',
        budget_high: 'Ambitious scope (structural transformation)',
        urgency_fast: 'Within 1 month',
        urgency_quarter: 'Within 1 quarter',
        urgency_flexible: 'Flexible timeline'
      },
      insights: {
        profile_acquisition: 'Profile: acquisition acceleration',
        profile_legacy: 'Profile: legacy/ERP modernization',
        profile_positioning: 'Profile: offer clarification',
        reco_legacy_low: 'Recommendation: rapid audit + risk mapping + pilot batch.',
        reco_legacy: 'Recommendation: business-led phased transformation roadmap.',
        reco_premium: 'Recommendation: strengthen value proof and ROI-focused messaging.',
        reco_acquisition: 'Recommendation: simplify journey, clarify promise and proof.',
        reco_default: 'Recommendation: short business framing, then execution by priorities.'
      }
    },
    es: {
      kicker: 'Preseleccion',
      title: 'Calificacion estrategica',
      intro: 'Algunas preguntas de negocio para definir tu necesidad antes de un primer presupuesto.',
      resultTitle: 'Resumen de pre-calificacion',
      resultQuestion: 'Resultado',
      back: 'Atras',
      reset: 'Reiniciar',
      cta: 'Iniciar una primera conversacion',
      mailSubject: 'Pre-calificacion de proyecto',
      questions: {
        start: 'Que situacion inicial se parece mas a tu contexto?',
        offer_positioning: 'Como posicionas tu oferta hoy?',
        conversion_blocker: 'Que bloquea mas la conversion actualmente?',
        legacy_context: 'En tu contexto legacy/ERP, el principal bloqueo afecta...',
        legacy_risk: 'Que nivel de riesgo aceptas durante la transformacion?',
        business_goal: 'Tu prioridad de negocio para los proximos 6 meses?',
        decision_cycle: 'Como se toma la decision normalmente?',
        budget_band: 'Que nivel de inversion te parece realista?',
        urgency: 'Cuando quieres un primer resultado visible?'
      },
      options: {
        start_new_offer: 'Lanzo una nueva oferta o actividad',
        start_low_conversion: 'Mi sitio existe pero convierte mal',
        start_legacy: 'Retomo un ERP o legacy complejo',
        start_rebrand: 'Quiero reposicionar mi marca',
        pos_price_speed: 'Precio claro + ejecucion rapida',
        pos_premium: 'Valor premium y experiencia',
        pos_trust: 'Cercania y confianza',
        pos_innovation: 'Innovacion y diferenciacion fuerte',
        conv_message: 'El mensaje no es claro',
        conv_proof: 'Faltan pruebas de confianza',
        conv_path: 'El recorrido es largo o confuso',
        conv_offer: 'La oferta no es suficientemente clara',
        legacy_sales: 'El ciclo comercial',
        legacy_ops: 'Las operaciones internas',
        legacy_data: 'Calidad/fiabilidad de datos',
        legacy_compliance: 'Exigencias de cumplimiento/seguridad',
        risk_low: 'Riesgo muy bajo, cambios progresivos',
        risk_balanced: 'Riesgo controlado con pilotos',
        risk_high: 'Transformacion mas rapida y exigente',
        goal_pipeline: 'Generar mas oportunidades cualificadas',
        goal_margin: 'Vender mejor el valor (menos guerra de precios)',
        goal_scaling: 'Estandarizar y escalar procesos',
        goal_visibility: 'Clarificar marca y ganar credibilidad',
        decision_founder: 'Decision rapida con direccion',
        decision_team: 'Decision en comite reducido',
        decision_complex: 'Decision multi-equipo y multi-etapa',
        budget_small: 'Marco prudente (MVP enfocado)',
        budget_mid: 'Marco intermedio (roadmap por fases)',
        budget_high: 'Marco ambicioso (transformacion estructural)',
        urgency_fast: 'En menos de 1 mes',
        urgency_quarter: 'En menos de 1 trimestre',
        urgency_flexible: 'Sin urgencia fuerte'
      },
      insights: {
        profile_acquisition: 'Perfil: aceleracion de adquisicion',
        profile_legacy: 'Perfil: modernizacion legacy/ERP',
        profile_positioning: 'Perfil: clarificacion de oferta',
        reco_legacy_low: 'Recomendacion: auditoria corta + mapa de riesgos + lote piloto.',
        reco_legacy: 'Recomendacion: hoja de ruta por lotes orientada al negocio.',
        reco_premium: 'Recomendacion: reforzar prueba de valor y mensaje orientado a ROI.',
        reco_acquisition: 'Recomendacion: simplificar recorrido, promesa y pruebas.',
        reco_default: 'Recomendacion: encuadre de negocio corto y ejecucion por prioridades.'
      }
    },
    pt: {
      kicker: 'Pre-selecao',
      title: 'Qualificacao estrategica',
      intro: 'Algumas perguntas de negocio para enquadrar sua necessidade antes de um primeiro orcamento.',
      resultTitle: 'Resumo de pre-qualificacao',
      resultQuestion: 'Resultado',
      back: 'Voltar',
      reset: 'Reiniciar',
      cta: 'Iniciar uma primeira conversa',
      mailSubject: 'Pre-qualificacao de projeto',
      questions: {
        start: 'Qual situacao inicial combina mais com seu contexto?',
        offer_positioning: 'Como voce posiciona sua oferta hoje?',
        conversion_blocker: 'O que mais bloqueia a conversao atualmente?',
        legacy_context: 'No seu contexto legacy/ERP, o principal bloqueio afeta...',
        legacy_risk: 'Qual nivel de risco voce aceita durante a transformacao?',
        business_goal: 'Sua prioridade de negocio para os proximos 6 meses?',
        decision_cycle: 'Como a decisao costuma ser tomada?',
        budget_band: 'Qual nivel de investimento parece realista?',
        urgency: 'Quando voce quer um primeiro resultado visivel?'
      },
      options: {
        start_new_offer: 'Estou lancando uma nova oferta ou atividade',
        start_low_conversion: 'Meu site existe, mas converte pouco',
        start_legacy: 'Estou assumindo um ERP/legacy complexo',
        start_rebrand: 'Quero reposicionar minha marca',
        pos_price_speed: 'Preco claro + execucao rapida',
        pos_premium: 'Valor premium e expertise',
        pos_trust: 'Proximidade e confianca',
        pos_innovation: 'Inovacao e diferenciacao forte',
        conv_message: 'A mensagem esta pouco clara',
        conv_proof: 'Faltam provas de confianca',
        conv_path: 'A jornada esta longa ou confusa',
        conv_offer: 'A oferta nao esta clara',
        legacy_sales: 'O ciclo comercial',
        legacy_ops: 'As operacoes internas',
        legacy_data: 'Qualidade/confiabilidade dos dados',
        legacy_compliance: 'Exigencias de compliance/seguranca',
        risk_low: 'Risco muito baixo, mudancas graduais',
        risk_balanced: 'Risco controlado com pilotos',
        risk_high: 'Transformacao mais rapida e intensa',
        goal_pipeline: 'Gerar mais oportunidades qualificadas',
        goal_margin: 'Vender melhor valor (menos pressao por preco)',
        goal_scaling: 'Padronizar e escalar processos',
        goal_visibility: 'Clarificar marca e ganhar credibilidade',
        decision_founder: 'Decisao rapida com lideranca',
        decision_team: 'Decisao em comite reduzido',
        decision_complex: 'Decisao multi-equipes e multi-etapas',
        budget_small: 'Escopo prudente (MVP focado)',
        budget_mid: 'Escopo intermediario (roadmap por fases)',
        budget_high: 'Escopo ambicioso (transformacao estrutural)',
        urgency_fast: 'Em menos de 1 mes',
        urgency_quarter: 'Em ate 1 trimestre',
        urgency_flexible: 'Sem urgencia forte'
      },
      insights: {
        profile_acquisition: 'Perfil: aceleracao de aquisicao',
        profile_legacy: 'Perfil: modernizacao legacy/ERP',
        profile_positioning: 'Perfil: clarificacao de oferta',
        reco_legacy_low: 'Recomendacao: auditoria rapida + mapa de riscos + lote piloto.',
        reco_legacy: 'Recomendacao: roadmap por lotes orientado a negocio.',
        reco_premium: 'Recomendacao: reforcar prova de valor e narrativa orientada a ROI.',
        reco_acquisition: 'Recomendacao: simplificar jornada, promessa e provas.',
        reco_default: 'Recomendacao: enquadramento curto de negocio e execucao por prioridades.'
      }
    }
  };

  const FLOW = {
    start: {
      question: 'start',
      options: [
        { label: 'start_new_offer', next: 'offer_positioning', tag: 'new-offer' },
        { label: 'start_low_conversion', next: 'conversion_blocker', tag: 'low-conversion' },
        { label: 'start_legacy', next: 'legacy_context', tag: 'legacy-erp' },
        { label: 'start_rebrand', next: 'offer_positioning', tag: 'rebrand' }
      ]
    },
    offer_positioning: {
      question: 'offer_positioning',
      options: [
        { label: 'pos_price_speed', next: 'business_goal', tag: 'position-price-speed' },
        { label: 'pos_premium', next: 'business_goal', tag: 'position-premium' },
        { label: 'pos_trust', next: 'business_goal', tag: 'position-trust' },
        { label: 'pos_innovation', next: 'business_goal', tag: 'position-innovation' }
      ]
    },
    conversion_blocker: {
      question: 'conversion_blocker',
      options: [
        { label: 'conv_message', next: 'business_goal', tag: 'conv-message' },
        { label: 'conv_proof', next: 'business_goal', tag: 'conv-proof' },
        { label: 'conv_path', next: 'business_goal', tag: 'conv-path' },
        { label: 'conv_offer', next: 'business_goal', tag: 'conv-offer' }
      ]
    },
    legacy_context: {
      question: 'legacy_context',
      options: [
        { label: 'legacy_sales', next: 'legacy_risk', tag: 'legacy-sales' },
        { label: 'legacy_ops', next: 'legacy_risk', tag: 'legacy-ops' },
        { label: 'legacy_data', next: 'legacy_risk', tag: 'legacy-data' },
        { label: 'legacy_compliance', next: 'legacy_risk', tag: 'legacy-compliance' }
      ]
    },
    legacy_risk: {
      question: 'legacy_risk',
      options: [
        { label: 'risk_low', next: 'business_goal', tag: 'risk-low' },
        { label: 'risk_balanced', next: 'business_goal', tag: 'risk-balanced' },
        { label: 'risk_high', next: 'business_goal', tag: 'risk-high' }
      ]
    },
    business_goal: {
      question: 'business_goal',
      options: [
        { label: 'goal_pipeline', next: 'decision_cycle', tag: 'goal-pipeline' },
        { label: 'goal_margin', next: 'decision_cycle', tag: 'goal-margin' },
        { label: 'goal_scaling', next: 'decision_cycle', tag: 'goal-scaling' },
        { label: 'goal_visibility', next: 'decision_cycle', tag: 'goal-visibility' }
      ]
    },
    decision_cycle: {
      question: 'decision_cycle',
      options: [
        { label: 'decision_founder', next: 'budget_band', tag: 'decision-founder' },
        { label: 'decision_team', next: 'budget_band', tag: 'decision-team' },
        { label: 'decision_complex', next: 'budget_band', tag: 'decision-complex' }
      ]
    },
    budget_band: {
      question: 'budget_band',
      options: [
        { label: 'budget_small', next: 'urgency', tag: 'budget-small' },
        { label: 'budget_mid', next: 'urgency', tag: 'budget-mid' },
        { label: 'budget_high', next: 'urgency', tag: 'budget-high' }
      ]
    },
    urgency: {
      question: 'urgency',
      options: [
        { label: 'urgency_fast', next: 'result', tag: 'urgency-fast' },
        { label: 'urgency_quarter', next: 'result', tag: 'urgency-quarter' },
        { label: 'urgency_flexible', next: 'result', tag: 'urgency-flexible' }
      ]
    }
  };

  function setupTree() {
    const t = I18N[locale] || I18N.fr;
    const kickerEl = root.querySelector('[data-prequal-kicker]');
    const titleEl = root.querySelector('[data-prequal-title]');
    const introEl = root.querySelector('[data-prequal-intro]');
    const questionEl = root.querySelector('[data-prequal-question]');
    const optionsEl = root.querySelector('[data-prequal-options]');
    const backButton = root.querySelector('[data-prequal-back]');
    const resetButton = root.querySelector('[data-prequal-reset]');
    if (!questionEl || !optionsEl || !backButton || !resetButton) return;

    if (kickerEl) kickerEl.textContent = t.kicker;
    if (titleEl) titleEl.textContent = t.title;
    if (introEl) introEl.textContent = t.intro;
    backButton.textContent = t.back;
    resetButton.textContent = t.reset;

    let currentNodeId = 'start';
    const history = [];
    const answers = [];

    function buildInsights(tags) {
      if (tags.includes('legacy-erp')) {
        if (tags.includes('risk-low')) return [t.insights.profile_legacy, t.insights.reco_legacy_low];
        return [t.insights.profile_legacy, t.insights.reco_legacy];
      }
      if (tags.includes('position-premium') || tags.includes('goal-margin')) {
        return [t.insights.profile_positioning, t.insights.reco_premium];
      }
      if (tags.includes('low-conversion') || tags.includes('goal-pipeline')) {
        return [t.insights.profile_acquisition, t.insights.reco_acquisition];
      }
      return [t.insights.profile_positioning, t.insights.reco_default];
    }

    function renderResult() {
      const tags = answers.map((a) => a.tag);
      const list = answers.map((a) => `<li>${a.label}</li>`).join('');
      const [profile, recommendation] = buildInsights(tags);
      const mailSubject = encodeURIComponent(t.mailSubject);

      optionsEl.innerHTML = `
        <div class="prequal-widget__result">
          <h3>${t.resultTitle}</h3>
          <ul>${list}</ul>
          <p><strong>${profile}</strong></p>
          <p>${recommendation}</p>
          <a class="prequal-widget__cta" href="mailto:contact@goffprod.com?subject=${mailSubject}">${t.cta}</a>
        </div>
      `;
      questionEl.textContent = t.resultQuestion;
      backButton.disabled = history.length === 0;
    }

    function renderQuestion(nodeId) {
      const node = FLOW[nodeId];
      if (!node) return;

      currentNodeId = nodeId;
      questionEl.textContent = t.questions[node.question] || '';
      optionsEl.innerHTML = '';

      node.options.forEach((option) => {
        const button = document.createElement('button');
        button.type = 'button';
        button.className = 'prequal-widget__choice';
        button.textContent = t.options[option.label] || option.label;
        button.dataset.next = option.next;
        button.dataset.tag = option.tag;
        optionsEl.appendChild(button);
      });

      backButton.disabled = history.length === 0;
    }

    optionsEl.addEventListener('click', (event) => {
      const target = event.target;
      if (!(target instanceof HTMLButtonElement)) return;
      const nextId = target.dataset.next;
      const tag = target.dataset.tag;
      if (!nextId || !tag) return;

      history.push(currentNodeId);
      answers.push({ label: target.textContent || '', tag });

      if (nextId === 'result') {
        renderResult();
      } else {
        renderQuestion(nextId);
      }
    });

    backButton.addEventListener('click', () => {
      if (!history.length) return;
      const previous = history.pop();
      answers.pop();
      renderQuestion(previous);
    });

    resetButton.addEventListener('click', () => {
      history.length = 0;
      answers.length = 0;
      renderQuestion('start');
    });

    renderQuestion('start');
  }

  fetch('/assets/modules/prequal.html', { cache: 'force-cache' })
    .then((response) => (response.ok ? response.text() : Promise.reject(new Error('module-load-failed'))))
    .then((html) => {
      root.innerHTML = html;
      root.dataset.loaded = '1';
      setupTree();
    })
    .catch(() => {
      root.innerHTML = fallbackMarkup();
      root.dataset.loaded = '1';
      setupTree();
    });
})();
