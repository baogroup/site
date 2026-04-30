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
  <link rel="stylesheet" href="assets/css/services.css">
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
          <div class="terminal-line muted">website: one-page / PHP</div>
          <div class="terminal-line muted">seo: audit / content / structure</div>
          <div class="terminal-line muted">support: written workflow</div>
          <div class="terminal-scan"></div>
        </div>
        <div class="metric-row">
          <div><strong>99 €</strong><span><?= e($t['metric_web'] ?? '') ?></span></div>
          <div><strong>19.99 €</strong><span><?= e($t['metric_txt'] ?? '') ?></span></div>
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
        <?php foreach (($t['service_cards'] ?? []) as $card): ?>
          <article class="card service-card">
            <div class="card-price"><?= e($card['price'] ?? '') ?></div>
            <h3><?= e($card['title'] ?? '') ?></h3>
            <p><?= e($card['text'] ?? '') ?></p>
            <?php if (!empty($card['items']) && is_array($card['items'])): ?>
              <ul class="feature-list">
                <?php foreach ($card['items'] as $item): ?>
                  <li><?= e($item) ?></li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>
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

    <section id="prices" class="section-shell section-block reveal visible">
      <div class="section-heading">
        <p class="eyebrow"><?= e($t['packages_eyebrow'] ?? 'Prices') ?></p>
        <h2><?= e($t['packages_title']) ?></h2>
        <p><?= e($t['packages_lead'] ?? '') ?></p>
      </div>
      <div class="pricing pricing-expanded">
        <?php foreach (($t['price_cards'] ?? []) as $package): ?>
          <div class="price-card <?= !empty($package['featured']) ? 'featured' : '' ?>">
            <?php if (!empty($package['badge'])): ?><span class="badge"><?= e($package['badge']) ?></span><?php endif; ?>
            <h3><?= e($package['title'] ?? '') ?></h3>
            <strong><?= e($package['price'] ?? '') ?></strong>
            <p><?= e($package['text'] ?? '') ?></p>
            <?php if (!empty($package['items']) && is_array($package['items'])): ?>
              <ul class="feature-list compact">
                <?php foreach ($package['items'] as $item): ?>
                  <li><?= e($item) ?></li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
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
          <p class="feedback-note"><?= e($t['sent_ok'] ?? 'Message sent successfully.') ?></p>
        <?php endif; ?>
        <?php if (isset($_GET['error'])): ?>
          <p class="feedback-note"><?= e($t['sent_error'] ?? 'Message could not be sent. Please try again later.') ?></p>
        <?php endif; ?>
      </div>
      <form method="post" action="send.php" class="feedback-form">
        <input name="name" placeholder="<?= e($t['form_name']) ?>" required>
        <input name="email" type="email" placeholder="<?= e($t['form_email']) ?>" required>
        <textarea name="message" placeholder="<?= e($t['form_message']) ?>" required></textarea>
        <input type="hidden" name="lang" value="<?= e($lang) ?>">
        <button type="submit" class="btn btn-primary"><?= e($t['form_button']) ?></button>
        <p class="feedback-note"><?= e($t['form_note'] ?? '') ?></p>
      </form>
    </section>
  </main>

  <?php include __DIR__ . '/partials/footer.php'; ?>
</body>
</html>
