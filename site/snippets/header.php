<!-- logo + nav menu -->

<header class="site-header">
  <h1 class="site-logo"><?= $site->title() ?></h1>

  <nav class="site-nav">
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