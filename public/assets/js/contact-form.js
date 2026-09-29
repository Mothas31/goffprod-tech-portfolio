// Formulaire de contact partagé (home et fin de questionnaire).
// window.MinusContactForm.mount(container, { topic, answers, lang })
// Envoie vers /api/contact.php ; la demande est enregistrée côté serveur
// puis notifiée par mail.
(() => {
  if (window.MinusContactForm) return;

  const FALLBACK_MAIL = 'thomasgoffinetfr@gmail.com';

  const COPY = {
    fr: {
      email: 'Votre e-mail',
      message: 'Votre message',
      messageOptional: 'Un mot sur votre contexte (facultatif)',
      placeholder: 'Votre projet, votre contexte, vos délais…',
      submit: 'Envoyer',
      sending: 'Envoi…',
      privacy: 'Votre e-mail sert uniquement à vous répondre.',
      success: 'Merci, c’est bien reçu. Je vous réponds personnellement dès que possible.',
      invalid: 'Vérifiez votre e-mail et écrivez au moins quelques mots.',
      error: `L’envoi a échoué. Réessayez, ou écrivez directement à ${FALLBACK_MAIL}.`
    },
    en: {
      email: 'Your email',
      message: 'Your message',
      messageOptional: 'A word about your context (optional)',
      placeholder: 'Your project, your context, your timeline…',
      submit: 'Send',
      sending: 'Sending…',
      privacy: 'Your email is only used to reply to you.',
      success: 'Thank you, it’s received. I’ll reply to you personally as soon as possible.',
      invalid: 'Check your email and write at least a few words.',
      error: `Sending failed. Try again, or write directly to ${FALLBACK_MAIL}.`
    },
    es: {
      email: 'Tu e-mail',
      message: 'Tu mensaje',
      messageOptional: 'Unas palabras sobre tu contexto (opcional)',
      placeholder: 'Tu proyecto, tu contexto, tus plazos…',
      submit: 'Enviar',
      sending: 'Enviando…',
      privacy: 'Tu e-mail solo se usa para responderte.',
      success: 'Gracias, lo he recibido. Te responderé personalmente lo antes posible.',
      invalid: 'Revisa tu e-mail y escribe al menos unas palabras.',
      error: `El envío ha fallado. Inténtalo de nuevo o escribe directamente a ${FALLBACK_MAIL}.`
    },
    pt: {
      email: 'O seu e-mail',
      message: 'A sua mensagem',
      messageOptional: 'Uma palavra sobre o seu contexto (opcional)',
      placeholder: 'O seu projeto, o seu contexto, os seus prazos…',
      submit: 'Enviar',
      sending: 'A enviar…',
      privacy: 'O seu e-mail serve apenas para lhe responder.',
      success: 'Obrigado, está recebido. Respondo-lhe pessoalmente assim que possível.',
      invalid: 'Verifique o seu e-mail e escreva pelo menos algumas palavras.',
      error: `O envio falhou. Tente novamente ou escreva diretamente para ${FALLBACK_MAIL}.`
    }
  };

  let uid = 0;

  function mount(container, options = {}) {
    const lang = COPY[options.lang] ? options.lang : 'fr';
    const copy = COPY[lang];
    const answers = Array.isArray(options.answers) ? options.answers : [];
    const messageRequired = answers.length === 0;
    const id = `contact-${++uid}`;

    container.innerHTML = `
      <form class="contact-form" novalidate>
        <label class="contact-form__field" for="${id}-email">
          <span>${copy.email}</span>
          <input id="${id}-email" type="email" name="email" required maxlength="254" autocomplete="email">
        </label>
        <label class="contact-form__field" for="${id}-message">
          <span>${messageRequired ? copy.message : copy.messageOptional}</span>
          <textarea id="${id}-message" name="message" rows="4" maxlength="3000" placeholder="${copy.placeholder}"${messageRequired ? ' required' : ''}></textarea>
        </label>
        <label class="contact-form__trap" aria-hidden="true">
          Website <input type="text" name="website" tabindex="-1" autocomplete="off">
        </label>
        <button type="submit" class="contact-form__submit">${copy.submit}</button>
        <p class="contact-form__privacy">${copy.privacy}</p>
        <p class="contact-form__status" role="status" aria-live="polite" hidden></p>
      </form>
    `;

    const form = container.querySelector('form');
    const submit = form.querySelector('button[type="submit"]');
    const status = form.querySelector('.contact-form__status');

    function showStatus(text, isError) {
      status.textContent = text;
      status.hidden = false;
      status.classList.toggle('is-error', Boolean(isError));
    }

    form.addEventListener('submit', async (event) => {
      event.preventDefault();
      const email = form.email.value.trim();
      const message = form.message.value.trim();

      if (!form.email.checkValidity() || email === '' || (messageRequired && message.length < 10)) {
        showStatus(copy.invalid, true);
        return;
      }

      submit.disabled = true;
      submit.textContent = copy.sending;

      try {
        const response = await fetch('/api/contact.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({
            email,
            message,
            topic: options.topic || '',
            answers,
            lang,
            website: form.website.value
          })
        });
        const result = await response.json().catch(() => ({}));
        if (!response.ok || !result.ok) throw new Error(result.error || 'server');

        form.innerHTML = `<p class="contact-form__success">${copy.success}</p>`;
        if (typeof options.onSuccess === 'function') options.onSuccess();
      } catch (error) {
        showStatus(error.message === 'invalid' ? copy.invalid : copy.error, true);
        submit.disabled = false;
        submit.textContent = copy.submit;
      }
    });

    return form;
  }

  window.MinusContactForm = { mount };
})();
