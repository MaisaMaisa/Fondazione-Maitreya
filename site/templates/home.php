<!DOCTYPE html>
<html lang="it">
<?php snippet('head') ?>
<body>

<?php snippet('header') ?>

<?php snippet('heading', [
  'title'    => 'Fondazione Maitreya ti dà il benvenuto.',
  'subtitle' => 'Fondata nel 1982, Fondazione Maitreya promuove in Italia la conoscenza e la pratica del Dharma buddhista, in modo non settario e aperto a tutti.'
]) ?>

<?php snippet('spacer', ['height' => 'medium']) ?>

<?= $page->blocks()->toBlocks() ?>

<?php snippet('footer') ?>

</body>
</html>