<div class="two-column-links">
  <div class="two-column-links__col">
    <a href="<?= $block->content()->get('link_left_url')->toUrl() ?>">
      <?= $block->content()->get('link_left_text')->html() ?>
      <span class="centered-link__arrow">&rarr;</span>
    </a>
  </div>
  <div class="two-column-links__col">
    <a href="<?= $block->content()->get('link_right_url')->toUrl() ?>">
      <?= $block->content()->get('link_right_text')->html() ?>
      <span class="centered-link__arrow">&rarr;</span>
    </a>
  </div>
</div>