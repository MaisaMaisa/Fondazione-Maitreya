<?php
$level = $block->level()->or('h2')->value();
$tag = $level === 'body' ? 'p' : $level;
?>

<<?= $tag ?> class="centered-title centered-title--<?= $level ?>">
  <?= $block->heading_text()->html() ?>
</<?= $tag ?>>