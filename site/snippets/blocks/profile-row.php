<div class="card-row card-row--team">
  <?php foreach ($block->items()->toStructure() as $item): ?>
    <?php
      $link = $item->link();
      $hasLink = $link->isNotEmpty();
      $tag = $hasLink ? 'a' : 'div';
    ?>
    <<?= $tag ?> class="card card--square<?= $hasLink ? ' card--linked' : '' ?>"
      <?php if ($hasLink): ?>
        href="<?= $link->toUrl() ?>"
      <?php endif ?>
    >
      <?php if ($img = $item->image()->toFile()): ?>
        <img src="<?= $img->url() ?>" alt="<?= $item->name() ?>">
      <?php endif ?>
      <p class="card-title"><?= $item->name() ?></p>
      <p class="card-subtitle"><?= $item->role() ?></p>
    </<?= $tag ?>>
  <?php endforeach ?>
</div>