<div class="centered-link">
  <a href="<?= $block->content()->get('link_url')->toUrl() ?>">
    <?= $block->content()->get('link_text')->html() ?>
    <span class="centered-link__arrow">&rarr;</span>
  </a>
</div>