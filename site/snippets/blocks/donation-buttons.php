<?php
$buttons = $block->content()->get('buttons')->toStructure();
$uid = 'donation-buttons-' . $block->id();
?>

<div class="donate-block" id="<?= $uid ?>">
  <div class="donate-block__amounts">
    <?php foreach ($buttons as $i => $item): ?>
      <div class="donate-block__option">
        <a href="<?= $item->link()->esc() ?>" class="donate-block__amount <?= $i === 0 ? 'is-selected' : '' ?>" target="_blank" rel="noopener">
          <?= $item->label()->html() ?>
        </a>
      </div>
    <?php endforeach ?>
  </div>
</div>