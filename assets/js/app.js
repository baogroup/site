function revealOnScroll() {
  const nodes = document.querySelectorAll('.reveal');
  if (!('IntersectionObserver' in window)) {
    nodes.forEach(node => node.classList.add('visible'));
    return;
  }

  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.12 });

  nodes.forEach(node => observer.observe(node));
}

function fillList(node, items) {
  if (!node) return;
  node.innerHTML = '';
  (items || []).forEach(item => {
    const li = document.createElement('li');
    li.textContent = item;
    node.appendChild(li);
  });
}

function initServiceModal() {
  const modal = document.getElementById('serviceModal');
  const services = Array.isArray(window.BAO_SERVICES) ? window.BAO_SERVICES : [];
  if (!modal || !services.length) return;

  const title = document.getElementById('serviceModalTitle');
  const price = document.getElementById('serviceModalPrice');
  const text = document.getElementById('serviceModalText');
  const included = document.getElementById('serviceModalIncluded');
  const excluded = document.getElementById('serviceModalExcluded');
  const order = document.getElementById('serviceModalOrder');
  const serviceSelect = document.getElementById('service-select') || document.getElementById('serviceSelect');

  let activeLabel = '';

  function serviceLabel(data) {
    return `${data.title || ''} — ${data.price || ''}`.trim();
  }

  function openModal(index) {
    const data = services[index];
    if (!data) return;

    activeLabel = serviceLabel(data);
    if (title) title.textContent = data.title || '';
    if (price) price.textContent = data.price || '';
    if (text) text.textContent = data.details || data.text || '';
    fillList(included, data.included || data.items || []);
    fillList(excluded, data.excluded || []);

    modal.classList.add('is-open');
    modal.setAttribute('aria-hidden', 'false');
    document.body.classList.add('modal-open');
  }

  function closeModal() {
    modal.classList.remove('is-open');
    modal.setAttribute('aria-hidden', 'true');
    document.body.classList.remove('modal-open');
  }

  document.addEventListener('click', event => {
    if (event.target.closest('[data-service-close], [data-close-modal]')) {
      event.preventDefault();
      closeModal();
      return;
    }

    const card = event.target.closest('[data-service-index]');
    if (!card) return;
    event.preventDefault();
    openModal(Number(card.dataset.serviceIndex));
  });

  document.addEventListener('keydown', event => {
    if (event.key === 'Escape' && modal.classList.contains('is-open')) {
      closeModal();
      return;
    }

    if (event.key !== 'Enter' && event.key !== ' ') return;
    const card = event.target.closest('[data-service-index]');
    if (!card) return;
    event.preventDefault();
    openModal(Number(card.dataset.serviceIndex));
  });

  if (order) {
    order.addEventListener('click', event => {
      event.preventDefault();
      if (serviceSelect && activeLabel) {
        serviceSelect.value = activeLabel;
        if (serviceSelect.value !== activeLabel) {
          const option = document.createElement('option');
          option.value = activeLabel;
          option.textContent = activeLabel;
          serviceSelect.appendChild(option);
          serviceSelect.value = activeLabel;
        }
      }
      closeModal();
      const contact = document.getElementById('contact');
      if (contact) contact.scrollIntoView({ behavior: 'smooth', block: 'start' });
      setTimeout(() => { if (serviceSelect) serviceSelect.focus(); }, 450);
    });
  }
}

document.addEventListener('DOMContentLoaded', () => {
  revealOnScroll();
  initServiceModal();
});
