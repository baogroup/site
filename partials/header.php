<header class="site-header">
  <a class="brand" href="index.php?lang=<?= htmlspecialchars($lang) ?>" aria-label="BaoGroup home">
    <span class="brand-mark">B</span>
    <span class="brand-text">BaoGroup</span>
  </a>

  <?php include __DIR__ . '/nav.php'; ?>

  <div class="language-switcher" aria-label="Language switcher">
    <a class="<?= $lang === 'en' ? 'active' : '' ?>" href="?lang=en">EN</a>
    <a class="<?= $lang === 'lt' ? 'active' : '' ?>" href="?lang=lt">LT</a>
    <a class="<?= $lang === 'ru' ? 'active' : '' ?>" href="?lang=ru">RU</a>
  </div>
</header>
