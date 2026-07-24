<header class="site-header">
  <h1 class="site-logo">
    <a href="<?= $site->url() ?>" class="site-logo__link"><?= $site->title() ?></a>
  </h1>

  <button class="menu-toggle" type="button" aria-expanded="false" aria-controls="site-nav">
    MENU
  </button>

  <nav class="site-nav" id="site-nav">
    <?php foreach ($site->navigation()->toStructure() as $entry): ?>
      <?php
        $type = $entry->type()->or('page')->value();
        $page = $type === 'page' ? $entry->page()->toPage() : null;

        if ($type === 'page' && !$page) continue; // page picker entry got deleted/moved

        $children = $entry->children()->toPages()->filter(fn ($p) => $p !== null);
        $label    = $entry->label()->or($page ? $page->title() : '')->value();

        $childIsOpen = $children->count() && $children->filter(fn ($c) => $c->isOpen())->count();
        $isActive    = $page ? $page->isOpen() : $childIsOpen;
      ?>
      <div class="nav-item <?= $children->count() ? 'has-dropdown' : '' ?>">
        <?php if ($page): ?>
          <a href="<?= $page->url() ?>" class="nav-link <?= $isActive ? 'is-active' : '' ?>">
            <?= $label ?>
          </a>
        <?php else: ?>
          <button type="button" class="nav-link nav-link--label <?= $isActive ? 'is-active' : '' ?>">
            <?= $label ?>
          </button>
        <?php endif ?>

        <?php if ($children->count()): ?>
          <div class="nav-dropdown">
            <?php foreach ($children as $child): ?>
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
    const toggle = document.querySelector('.menu-toggle');
    const nav = document.getElementById('site-nav');
    const navItems = nav ? Array.from(nav.querySelectorAll('.nav-item')) : [];
    let hideTimeout;
    let submenuHideTimeout;

    function isMobile() {
      return window.matchMedia('(max-width: 768px)').matches;
    }

    function resetDrilldown() {
      nav.classList.remove('is-drilled');
      navItems.forEach(item => item.classList.remove('is-open'));
    }

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
        resetDrilldown(); // start fresh next time it opens
      }, count * 60 + 250);
    }

    if (toggle && nav) {
      toggle.addEventListener('click', () => {
        const isOpen = nav.classList.contains('is-open');
        isOpen ? closeMobileMenu() : openMobileMenu();
      });
    }

    // staggered open/close of submenu links (mobile drilldown)
    function openSubmenu(item) {
      const subLinks = Array.from(item.querySelectorAll('.nav-dropdown__link'));
      clearTimeout(submenuHideTimeout);
      subLinks.forEach((link, i) => {
        link.style.transitionDelay = `${i * 60}ms`;
      });
      item.classList.add('is-open');
      nav.classList.add('is-drilled');
    }

    function closeSubmenu(item) {
      const subLinks = Array.from(item.querySelectorAll('.nav-dropdown__link'));
      const count = subLinks.length;
      subLinks.forEach((link, i) => {
        link.style.transitionDelay = `${(count - 1 - i) * 60}ms`;
      });
      item.classList.remove('is-open');
      nav.classList.remove('is-drilled');
      submenuHideTimeout = setTimeout(() => {
        subLinks.forEach(link => link.style.transitionDelay = '0ms');
      }, count * 60 + 250);
    }

    // mobile drill-down for items with submenus
    navItems.forEach(item => {
      if (!item.classList.contains('has-dropdown')) return;
      const link = item.querySelector(':scope > .nav-link');

      link.addEventListener('click', (e) => {
        if (!isMobile() || !nav.classList.contains('is-open')) return; // desktop: normal hover/click behavior

        e.preventDefault();

        const alreadyOpen = item.classList.contains('is-open');

        if (alreadyOpen) {
          closeSubmenu(item);
        } else {
          navItems.forEach(other => {
            if (other !== item && other.classList.contains('is-open')) {
              closeSubmenu(other);
            }
          });
          openSubmenu(item);
        }
      });
    });

    // desktop staggered dropdown animation
    document.querySelectorAll('.nav-item.has-dropdown').forEach(item => {
      const links = Array.from(item.querySelectorAll('.nav-dropdown__link'));
      let dropdownHideTimeout;

      function show() {
        if (isMobile()) return;
        clearTimeout(dropdownHideTimeout);
        links.forEach((link, i) => {
          link.style.transitionDelay = `${i * 60}ms`;
        });
        item.classList.add('is-open');
      }

      function hide() {
        if (isMobile()) return;
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

    // reset drilldown state if window crosses the mobile breakpoint
    window.addEventListener('resize', () => {
      resetDrilldown();
    });
  })();
</script>

<main>
