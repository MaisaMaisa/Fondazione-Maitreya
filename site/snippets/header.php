<header class="site-header">
  <h1 class="site-logo">
    <a href="<?= $site->url() ?>" class="site-logo__link"><?= $site->title() ?></a>
  </h1>

  <button class="menu-toggle" type="button" aria-expanded="false" aria-controls="site-nav">
    MENU
  </button>

  <nav class="site-nav" id="site-nav">
    <?php foreach ($site->children()->listed() as $item): ?>
      <div class="nav-item <?= $item->hasChildren() ? 'has-dropdown' : '' ?>">
        <a href="<?= $item->url() ?>" class="nav-link <?= $item->isOpen() ? 'is-active' : '' ?>">
          <?= $item->title() ?>
        </a>

        <?php if ($item->hasChildren()): ?>
          <div class="nav-dropdown">
            <?php foreach ($item->children()->listed() as $child): ?>
              <a href="<?= $child->url() ?>" class="nav-dropdown__link <?= $child->isOpen() ? 'is-active' : '' ?>">
                <?= $child->title() ?>
              </a>
            <?php endforeach ?>
          </div>
        <?php endif ?>
      </div>
    <?php endforeach ?>
  </nav>
</header>

<script>
(function () {
  // mobile hamburger toggle with stagger
  const toggle = document.querySelector('.menu-toggle');
  const nav = document.getElementById('site-nav');
  const navItems = nav ? Array.from(nav.querySelectorAll('.nav-item')) : [];
  let hideTimeout;

  function openMobileMenu() {
    clearTimeout(hideTimeout);
    navItems.forEach((item, i) => {
      item.style.transitionDelay = `${i * 60}ms`;
    });
    nav.classList.add('is-open');
    toggle.setAttribute('aria-expanded', 'true');
  }

  function closeMobileMenu() {
    const count = navItems.length;
    navItems.forEach((item, i) => {
      item.style.transitionDelay = `${(count - 1 - i) * 60}ms`;
    });
    nav.classList.remove('is-open');
    toggle.setAttribute('aria-expanded', 'false');
    hideTimeout = setTimeout(() => {
      navItems.forEach(item => item.style.transitionDelay = '0ms');
    }, count * 60 + 250);
  }

  if (toggle && nav) {
    toggle.addEventListener('click', () => {
      const isOpen = nav.classList.contains('is-open');
      isOpen ? closeMobileMenu() : openMobileMenu();
    });
  }

  // desktop staggered dropdown animation (unchanged)
  document.querySelectorAll('.nav-item.has-dropdown').forEach(item => {
    const links = Array.from(item.querySelectorAll('.nav-dropdown__link'));
    let dropdownHideTimeout;

    function show() {
      clearTimeout(dropdownHideTimeout);
      links.forEach((link, i) => {
        link.style.transitionDelay = `${i * 60}ms`;
      });
      item.classList.add('is-open');
    }

    function hide() {
      const count = links.length;
      links.forEach((link, i) => {
        link.style.transitionDelay = `${(count - 1 - i) * 60}ms`;
      });
      item.classList.remove('is-open');
      dropdownHideTimeout = setTimeout(() => {
        links.forEach(link => link.style.transitionDelay = '0ms');
      }, count * 60 + 250);
    }

    item.addEventListener('mouseenter', show);
    item.addEventListener('mouseleave', hide);
    item.addEventListener('focusin', show);
    item.addEventListener('focusout', (e) => {
      if (!item.contains(e.relatedTarget)) hide();
    });
  });
})();
</script>
<main>
