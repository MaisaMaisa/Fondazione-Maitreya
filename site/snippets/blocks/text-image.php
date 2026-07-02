<?php
$image = $block->image()->toFile();
$layout = $block->layout()->value();
?>

<div class="text-image text-image--<?= $layout ?>">
  <div class="text-image__content">
    <?php if ($block->heading()->isNotEmpty()): ?>
      <h2><?= $block->heading()->html() ?></h2>
    <?php endif ?>
    <?= $block->text()->kirbytext() ?>
  </div>

  <?php if ($image): ?>
    <div class="text-image__media">
      <img src="<?= $image->url() ?>" alt="<?= $image->alt()->esc() ?>" loading="lazy">
    </div>
  <?php endif ?>
</div>