const SITE = {
  defaultLang: "en",
  supportedLangs: ["en", "lt", "ru"],
  formEmail: "info@baogroup.eu"
};

async function fetchText(path) {
  const response = await fetch(path, { cache: "no-store" });
  if (!response.ok) throw new Error(`Cannot load ${path}`);
  return (await response.text()).trim();
}

async function includePartials() {
  const nodes = [...document.querySelectorAll("[data-include]")];
  await Promise.all(nodes.map(async node => {
    const path = node.getAttribute("data-include");
    node.innerHTML = await fetchText(path);
    const nested = [...node.querySelectorAll("[data-include]")];
    await Promise.all(nested.map(async child => {
      const childPath = child.getAttribute("data-include");
      child.innerHTML = await fetchText(childPath);
    }));
  }));
}

function getLanguage() {
  const saved = localStorage.getItem("bao_lang");
  if (SITE.supportedLangs.includes(saved)) return saved;
  const browserLang = (navigator.language || "").slice(0, 2).toLowerCase();
  if (SITE.supportedLangs.includes(browserLang)) return browserLang;
  return SITE.defaultLang;
}

async function loadLanguage(lang) {
  const safeLang = SITE.supportedLangs.includes(lang) ? lang : SITE.defaultLang;
  document.documentElement.lang = safeLang;
  localStorage.setItem("bao_lang", safeLang);

  const textNodes = [...document.querySelectorAll("[data-txt]")];
  await Promise.all(textNodes.map(async node => {
    const originalPath = node.getAttribute("data-txt");
    const localizedPath = originalPath.replace(/content\/(en|lt|ru)\//, `content/${safeLang}/`);
    try {
      node.textContent = await fetchText(localizedPath);
    } catch (error) {
      node.textContent = "";
      console.warn(error.message);
    }
  }));

  document.querySelectorAll("[data-lang]").forEach(button => {
    button.classList.toggle("active", button.dataset.lang === safeLang);
  });
}

function bindLanguageButtons() {
  document.querySelectorAll("[data-lang]").forEach(button => {
    button.addEventListener("click", () => loadLanguage(button.dataset.lang));
  });
}

function bindFeedbackForm() {
  const form = document.querySelector("#feedbackForm");
  if (!form) return;

  form.addEventListener("submit", event => {
    event.preventDefault();
    const data = new FormData(form);
    const name = encodeURIComponent(data.get("name") || "");
    const email = encodeURIComponent(data.get("email") || "");
    const message = encodeURIComponent(data.get("message") || "");
    const subject = encodeURIComponent("BaoGroup website request");
    const body = `Name:%20${name}%0AEmail:%20${email}%0A%0AMessage:%0A${message}`;
    window.location.href = `mailto:${SITE.formEmail}?subject=${subject}&body=${body}`;
  });
}

function revealOnScroll() {
  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add("visible");
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.12 });

  document.querySelectorAll(".reveal").forEach(node => observer.observe(node));
}

async function init() {
  await includePartials();
  bindLanguageButtons();
  bindFeedbackForm();
  await loadLanguage(getLanguage());
  revealOnScroll();
}

init().catch(error => console.error(error));
