<?php $tag = $block->level()->or('h2'); ?>

<<?= $tag ?> class="centered-title">
  <?= $block->title()->html() ?>
</<?= $tag ?>>