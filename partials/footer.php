<footer class="site-footer">
  <div class="footer-inner footer-unified">
    <div class="footer-mainline">
      <span>&copy; <?= date('Y') ?> BaoGroup. All rights reserved.</span>
      <span class="footer-separator">·</span>
      <span>Bao group, MB</span>
      <span class="footer-separator">·</span>
      <a href="mailto:info@baogroup.eu">info@baogroup.eu</a>
      <span class="footer-separator">·</span>
      <a href="https://baogroup.eu">baogroup.eu</a>
    </div>

    <nav class="footer-legal footer-legal-clean" aria-label="Legal links">
      <a href="#" data-legal-open="privacy"><?= htmlspecialchars($t['privacy_title'] ?? 'Privacy Policy') ?></a>
      <span>·</span>
      <a href="#" data-legal-open="cookies"><?= htmlspecialchars($t['cookies_title'] ?? 'Cookie Policy') ?></a>
      <span>·</span>
      <a href="#" data-legal-open="terms"><?= htmlspecialchars($t['terms_title'] ?? 'Terms') ?></a>
    </nav>
  </div>
</footer>
