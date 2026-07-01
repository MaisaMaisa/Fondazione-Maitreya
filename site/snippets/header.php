<!-- logo + nav menu -->

<header class="site-header">
  <h1 class="site-logo"><?= $site->title() ?></h1>

  <nav class="site-nav">
    <?php foreach ($site->children()->listed() as $item): ?>
      <a href="<?= $item->url() ?>" class="nav-link <?= $item->isOpen() ? 'is-active' : '' ?>">
        <?= $item->title() ?>
      </a>
    <?php endforeach ?>
  </nav>
</header>