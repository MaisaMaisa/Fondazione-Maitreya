<div class="card-row cal-row">
  <?php foreach ($block->items()->toStructure() as $item): ?>
    <?php
      $link = $item->link();
      $hasLink = $link->isNotEmpty();
      $tag = $hasLink ? 'a' : 'div';
    ?>
    <<?= $tag ?> class="card card--event<?= $hasLink ? ' card--linked' : '' ?>"
      <?php if ($hasLink): ?>
        href="<?= $link->toUrl() ?>"
      <?php endif ?>
    >
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
    </<?= $tag ?>>
  <?php endforeach ?>
</div>