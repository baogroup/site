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
          <div class="terminal-line muted">content: php-based</div>
          <div class="terminal-line muted">status: fast / clean / multilingual</div>
          <div class="terminal-scan"></div>
        </div>
        <div class="metric-row">
          <div><strong>PHP</strong><span><?= e($t['metric_txt'] ?? '') ?></span></div>
          <div><strong>SEO</strong><span><?= e($t['metric_seo'] ?? '') ?></span></div>
          <div><strong>WEB</strong><span><?= e($t['metric_web'] ?? '') ?></span></div>
        </div>
      </div>
    </section>

    <section id="services" class="section-shell section-block reveal visible">
      <div class="section-heading">
        <p class="eyebrow">Services</p>
        <h2><?= e($t['services_title']) ?></h2>
        <p><?= e($t['services_lead'] ?? '') ?></p>
      </div>
      <div class="cards">
        <article class="card"><h3><?= e($t['service_support_title'] ?? '') ?></h3><p><?= e($t['service_support'] ?? '') ?></p></article>
        <article class="card"><h3><?= e($t['service_articles_title'] ?? '') ?></h3><p><?= e($t['service_articles'] ?? '') ?></p></article>
        <article class="card"><h3><?= e($t['service_languages_title'] ?? '') ?></h3><p><?= e($t['service_languages'] ?? '') ?></p></article>
      </div>
    </section>

    <section id="process" class="section-shell split-section reveal visible">
      <div>
        <p class="eyebrow">Workflow</p>
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
        <p class="eyebrow">Packages</p>
        <h2><?= e($t['packages_title']) ?></h2>
        <p><?= e($t['packages_lead'] ?? '') ?></p>
      </div>
      <div class="pricing">
        <div class="price-card"><h3>Start</h3><strong>from 19.99 €</strong><p><?= e($t['package_start'] ?? '') ?></p></div>
        <div class="price-card featured"><h3>Content</h3><strong>2 articles / week</strong><p><?= e($t['package_content'] ?? '') ?></p></div>
        <div class="price-card"><h3>Care</h3><strong>custom</strong><p><?= e($t['package_care'] ?? '') ?></p></div>
      </div>
    </section>

    <section id="contact" class="section-shell contact-panel reveal visible">
      <div>
        <p class="eyebrow">Contact</p>
        <h2><?= e($t['contact_title']) ?></h2>
        <p><?= e($t['contact'] ?? '') ?></p>
        <?php if (isset($_GET['sent'])): ?>
          <p class="feedback-note"><?= e($t['sent_ok'] ?? 'Message sent successfully.') ?></p>
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
