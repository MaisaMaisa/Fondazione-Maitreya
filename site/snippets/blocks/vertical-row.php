<div class="card-row ver-row">
  <?php foreach ($block->items()->toStructure() as $item): ?>
    <?php
      $link = $item->link();
      $hasLink = $link->isNotEmpty();
      $tag = $hasLink ? 'a' : 'div';
    ?>
    <<?= $tag ?> class="card<?= $hasLink ? ' card--linked' : '' ?>"
      <?php if ($hasLink): ?>
        href="<?= $link->toUrl() ?>"
      <?php endif ?>
    >
      <?php if ($img = $item->image()->toFile()): ?>
        <img src="<?= $img->url() ?>" alt="<?= $item->title() ?>">
      <?php endif ?>
      <p class="card-title"><?= $item->title() ?></p>
      <p class="card-subtitle"><?= $item->subtitle() ?></p>
    </<?= $tag ?>>
  <?php endforeach ?>
</div>