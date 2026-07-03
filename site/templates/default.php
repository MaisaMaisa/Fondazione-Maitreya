<!DOCTYPE html>
<html lang="it">
<?php snippet('head') ?>
<body>

<?php snippet('header') ?>

<?php snippet('heading', [
  'subtitle' => $page->content()->get('heading_subtitle')->kirbytext()
]) ?>

<?= $page->blocks()->toBlocks() ?>

<?php snippet('footer') ?>

</body>
</html>