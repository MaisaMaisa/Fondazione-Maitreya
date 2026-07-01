<div class="card-row cal-row">
  <?php foreach ($block->items()->toStructure() as $item): ?>
    <div class="card card--event">
      <?php if ($img = $item->image()->toFile()): ?>
        <img src="<?= $img->url() ?>" alt="<?= $item->title() ?>">
      <?php endif ?>
      <div class="card-info">
        <span class="card-date"><?= $item->date() ?></span>
        <div class="card-text">
          <p class="card-title"><?= $item->title() ?></p>
          <p class="card-subtitle"><?= $item->subtitle() ?></p>
        </div>
      </div>
    </div>
  <?php endforeach ?>
</div>