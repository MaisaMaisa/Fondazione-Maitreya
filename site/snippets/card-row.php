<!-- reusable row of N image cards (used for both centers AND news/calendar) -->
 <!-- I'm making card-row.php generic so it powers both your 3-image "centers" row and your calendar row — same component, different data. -->


<?php
// expects: $items — an array of ['image' => Kirby File or url, 'title' => '', 'subtitle' => '']
$items = $items ?? [];
?>
<div class="card-row">
  <?php foreach ($items as $item): ?>
    <div class="card">
      <?php if (!empty($item['image'])): ?>
        <img src="<?= $item['image'] ?>" alt="<?= $item['title'] ?? '' ?>">
      <?php endif ?>
      <p class="card-title"><?= $item['title'] ?? '' ?></p>
      <p class="card-subtitle"><?= $item['subtitle'] ?? '' ?></p>
    </div>
  <?php endforeach ?>
</div>