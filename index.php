<?php
$lang = $_GET['lang'] ?? 'en';
$supported = ['en','lt','ru'];
if (!in_array($lang,$supported)) $lang='en';

$t = require __DIR__ . "/lang/{$lang}.php";
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars($lang) ?>">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($t['title']) ?></title>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php include __DIR__ . '/partials/header.php'; ?>

<main class="section-shell">

<section class="hero">
  <div>
    <h1><?= htmlspecialchars($t['hero_title']) ?></h1>
    <p class="lead"><?= htmlspecialchars($t['hero_lead']) ?></p>
  </div>
</section>

<section id="services" class="section-block">
  <h2><?= htmlspecialchars($t['services_title']) ?></h2>
</section>

<section id="process" class="section-block">
  <h2><?= htmlspecialchars($t['workflow_title']) ?></h2>
</section>

<section id="prices" class="section-block">
  <h2><?= htmlspecialchars($t['packages_title']) ?></h2>
</section>

<section id="contact" class="section-block">
  <h2><?= htmlspecialchars($t['contact_title']) ?></h2>

  <form method="post" action="send.php" class="feedback-form">
    <input name="name" placeholder="<?= htmlspecialchars($t['form_name']) ?>">
    <input name="email" placeholder="<?= htmlspecialchars($t['form_email']) ?>">
    <textarea name="message" placeholder="<?= htmlspecialchars($t['form_message']) ?>"></textarea>
    <button type="submit" class="btn btn-primary">
      <?= htmlspecialchars($t['form_button']) ?>
    </button>
  </form>
</section>

</main>

<?php include __DIR__ . '/partials/footer.php'; ?>

</body>
</html>
