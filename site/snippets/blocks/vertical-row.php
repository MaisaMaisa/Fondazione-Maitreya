<div class="card-row ver-row">
  <?php foreach ($block->items()->toStructure() as $item): ?>
    <div class="card">
      <?php if ($img = $item->image()->toFile()): ?>
        <img src="<?= $img->url() ?>" alt="<?= $item->title() ?>">
      <?php endif ?>
      <p class="card-title"><?= $item->title() ?></p>
      <p class="card-subtitle"><?= $item->subtitle() ?></p>
    </div>
  <?php endforeach ?>
</div>