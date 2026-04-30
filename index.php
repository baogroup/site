<?php
$lang = $_GET['lang'] ?? 'en';
$supported = ['en','lt','ru'];
if (!in_array($lang, $supported, true)) {
  $lang = 'en';
}

$base = require __DIR__ . '/lang/en.php';
$current = require __DIR__ . "/lang/{$lang}.php";
$t = array_merge($base, $current);

function e($value) {
  return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

$services = $t['service_cards'] ?? [];
?>
<!DOCTYPE html>
<html lang="<?= e($lang) ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= e($t['title']) ?></title>
  <meta name="description" content="<?= e($t['description'] ?? $base['description']) ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/interactive.css">
  <link rel="stylesheet" href="assets/css/fixes.css?v=20260430-2">
</head>
<body id="top">
  <div class="bg-grid"></div>
  <div class="orb orb-a"></div>
  <div class="orb orb-b"></div>

  <?php include __DIR__ . '/partials/header.php'; ?>

  <main>
    <section class="hero section-shell">
      <div class="hero-copy reveal visible">
        <p class="eyebrow"><?= e($t['eyebrow'] ?? 'BaoGroup') ?></p>
        <h1><?= e($t['hero_title']) ?></h1>
        <p class="lead"><?= e($t['hero_lead']) ?></p>
        <div class="hero-actions">
          <a class="btn btn-primary" href="#contact"><?= e($t['button_contact'] ?? $t['form_button']) ?></a>
          <a class="btn btn-ghost" href="#services"><?= e($t['button_services'] ?? $t['nav_services']) ?></a>
        </div>
      </div>

      <div class="hero-panel reveal visible" aria-label="BaoGroup system preview">
        <div class="terminal-card">
          <div class="terminal-top"><span></span><span></span><span></span></div>
          <div class="terminal-line"><b>bao.system</b> / site-care</div>
          <div class="terminal-line muted">website: domain / hosting / email</div>
          <div class="terminal-line muted">seo: audit / articles / structure</div>
          <div class="terminal-line muted">support: written workflow</div>
          <div class="terminal-scan"></div>
        </div>
        <div class="metric-row">
          <div><strong>249 €</strong><span><?= e($t['metric_web'] ?? '') ?></span></div>
          <div><strong>69 €</strong><span><?= e($t['metric_txt'] ?? '') ?></span></div>
          <div><strong>SEO</strong><span><?= e($t['metric_seo'] ?? '') ?></span></div>
        </div>
      </div>
    </section>

    <section id="services" class="section-shell section-block reveal visible">
      <div class="section-heading">
        <p class="eyebrow"><?= e($t['services_eyebrow'] ?? 'Services') ?></p>
        <h2><?= e($t['services_title']) ?></h2>
        <p><?= e($t['services_lead'] ?? '') ?></p>
      </div>
      <div class="cards service-grid">
        <?php foreach ($services as $i => $card): ?>
          <article class="card service-card service-card-clickable" tabindex="0" role="button" data-service-index="<?= (int)$i ?>" aria-label="<?= e(($t['modal_open_prefix'] ?? 'Open service') . ': ' . ($card['title'] ?? '')) ?>">
            <div class="service-icon"><?= e($card['icon'] ?? '•') ?></div>
            <div class="card-price"><?= e($card['price'] ?? '') ?></div>
            <h3><?= e($card['title'] ?? '') ?></h3>
            <p><?= e($card['text'] ?? '') ?></p>
            <?php if (!empty($card['items']) && is_array($card['items'])): ?>
              <ul class="feature-list">
                <?php foreach (array_slice($card['items'], 0, 4) as $item): ?>
                  <li><?= e($item) ?></li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>
            <span class="service-more"><?= e($t['service_more'] ?? 'Details') ?></span>
          </article>
        <?php endforeach; ?>
      </div>
      <div class="section-note">
        <strong><?= e($t['service_note_title'] ?? '') ?></strong>
        <span><?= e($t['service_note_text'] ?? '') ?></span>
      </div>
    </section>

    <section id="about" class="section-shell about-panel reveal visible">
      <div class="about-photo">
        <img src="assets/img/owner.jpg" alt="BaoGroup" onerror="this.style.display='none';this.parentElement.classList.add('no-photo');">
        <span><?= e($t['about_photo_label'] ?? 'Photo') ?></span>
      </div>
      <div class="about-copy">
        <p class="eyebrow"><?= e($t['about_eyebrow'] ?? 'About') ?></p>
        <h2><?= e($t['about_title']) ?></h2>
        <p><?= e($t['about_text_1']) ?></p>
        <p><?= e($t['about_text_2']) ?></p>
        <div class="company-card">
          <strong><?= e($t['company_name']) ?></strong>
          <span><?= e($t['company_line_1']) ?></span>
          <span><?= e($t['company_line_2']) ?></span>
          <span><?= e($t['company_line_3']) ?></span>
        </div>
      </div>
    </section>

    <section id="process" class="section-shell split-section reveal visible">
      <div>
        <p class="eyebrow"><?= e($t['workflow_eyebrow'] ?? 'Workflow') ?></p>
        <h2><?= e($t['workflow_title']) ?></h2>
      </div>
      <div class="steps">
        <div class="step"><span>01</span><p><?= e($t['workflow_step_1'] ?? '') ?></p></div>
        <div class="step"><span>02</span><p><?= e($t['workflow_step_2'] ?? '') ?></p></div>
        <div class="step"><span>03</span><p><?= e($t['workflow_step_3'] ?? '') ?></p></div>
      </div>
    </section>

    <section class="section-shell section-block reveal visible">
      <div class="section-heading">
        <p class="eyebrow"><?= e($t['limits_eyebrow'] ?? 'Important') ?></p>
        <h2><?= e($t['limits_title'] ?? '') ?></h2>
        <p><?= e($t['limits_lead'] ?? '') ?></p>
      </div>
      <div class="limits-grid">
        <?php foreach (($t['limits_items'] ?? []) as $item): ?>
          <div class="limit-item"><?= e($item) ?></div>
        <?php endforeach; ?>
      </div>
      <p class="fine-print"><?= e($t['limits_note'] ?? '') ?></p>
    </section>

    <section id="contact" class="section-shell contact-panel reveal visible">
      <div>
        <p class="eyebrow"><?= e($t['contact_eyebrow'] ?? 'Contact') ?></p>
        <h2><?= e($t['contact_title']) ?></h2>
        <p><?= e($t['contact'] ?? '') ?></p>
        <?php if (isset($_GET['sent'])): ?>
          <p class="feedback-note feedback-success"><?= e($t['sent_ok'] ?? 'Message sent successfully.') ?></p>
        <?php endif; ?>
        <?php if (isset($_GET['error'])): ?>
          <p class="feedback-note feedback-error"><?= e($t['sent_error'] ?? 'Message could not be sent. Please try again later.') ?></p>
        <?php endif; ?>
      </div>
      <form method="post" action="send.php" class="feedback-form">
        <input name="name" placeholder="<?= e($t['form_name']) ?>" required>
        <input name="email" type="email" placeholder="<?= e($t['form_email']) ?>" required>
        <select name="service" id="serviceSelect" required>
          <option value=""><?= e($t['form_service_placeholder'] ?? 'Choose service') ?></option>
          <?php foreach ($services as $card): ?>
            <option value="<?= e(($card['title'] ?? '') . ' — ' . ($card['price'] ?? '')) ?>"><?= e(($card['title'] ?? '') . ' — ' . ($card['price'] ?? '')) ?></option>
          <?php endforeach; ?>
        </select>
        <textarea name="message" placeholder="<?= e($t['form_message']) ?>" required></textarea>
        <input class="honeypot" type="text" name="website" tabindex="-1" autocomplete="off">
        <input type="hidden" name="lang" value="<?= e($lang) ?>">
        <button type="submit" class="btn btn-primary"><?= e($t['form_button']) ?></button>
        <p class="feedback-note"><?= e($t['form_note'] ?? '') ?></p>
      </form>
    </section>
  </main>

  <div class="service-modal" id="serviceModal" aria-hidden="true">
    <div class="service-modal-backdrop" data-close-modal></div>
    <div class="service-modal-dialog" role="dialog" aria-modal="true" aria-labelledby="serviceModalTitle">
      <button class="service-modal-close" type="button" data-close-modal aria-label="Close">×</button>
      <h2 id="serviceModalTitle"></h2>
      <div class="service-modal-price" id="serviceModalPrice"></div>
      <p class="service-modal-text" id="serviceModalText"></p>
      <div class="service-modal-columns">
        <div>
          <h3><?= e($t['modal_included'] ?? 'Included') ?></h3>
          <ul id="serviceModalIncluded"></ul>
        </div>
        <div>
          <h3><?= e($t['modal_not_included'] ?? 'Not included') ?></h3>
          <ul id="serviceModalExcluded"></ul>
        </div>
      </div>
      <button class="btn btn-primary service-modal-order" type="button" id="serviceModalOrder"><?= e($t['modal_order'] ?? 'Order this service') ?></button>
    </div>
  </div>

  <script>
    window.BAO_SERVICES = <?= json_encode($services, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?>;
  </script>
  <script src="assets/js/app.js?v=20260430-2"></script>

  <?php include __DIR__ . '/partials/footer.php'; ?>
</body>
</html>
