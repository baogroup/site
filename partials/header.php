<header class="site-header">
  <a class="brand" href="index.php?lang=<?= htmlspecialchars($lang) ?>" aria-label="BaoGroup home">
    <img src="assets/img/baogroup-logo.svg" alt="BaoGroup" style="height:36px">
  </a>

  <?php include __DIR__ . '/nav.php'; ?>

  <div class="language-switcher" aria-label="Language switcher">
    <a class="<?= $lang === 'en' ? 'active' : '' ?>" href="?lang=en">EN</a>
    <a class="<?= $lang === 'lt' ? 'active' : '' ?>" href="?lang=lt">LT</a>
    <a class="<?= $lang === 'ru' ? 'active' : '' ?>" href="?lang=ru">RU</a>
  </div>
</header>
