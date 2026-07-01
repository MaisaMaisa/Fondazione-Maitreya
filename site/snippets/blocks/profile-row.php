<div class="card-row card-row--team">
  <?php foreach ($block->items()->toStructure() as $item): ?>
    <div class="card card--square">
      <?php if ($img = $item->image()->toFile()): ?>
        <img src="<?= $img->url() ?>" alt="<?= $item->name() ?>">
      <?php endif ?>
      <p class="card-title"><?= $item->name() ?></p>
      <p class="card-subtitle"><?= $item->role() ?></p>
    </div>
  <?php endforeach ?>
</div>